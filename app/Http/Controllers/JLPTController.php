<?php

namespace App\Http\Controllers;

use App\Models\Alphabet;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class JLPTController extends Controller
{
    /**
     * JLPT Practice Dashboard
     */
    public function index()
    {
        // Debug: Force refresh stats without cache
        $uiLevels = [5, 4, 3, 2, 1];
        $stats = [];

        foreach ($uiLevels as $uiLevel) {
            $internalLevel = $this->normalizeLevel($uiLevel);
            
            // Debug logging
            \Log::info("JLPT Stats Debug", [
                'uiLevel' => $uiLevel,
                'internalLevel' => $internalLevel
            ]);
            
            $stats["n{$uiLevel}"] = [
                'kanji' => Alphabet::where('type', 'kanji')
                    ->where('difficulty_level', $internalLevel)
                    ->where('is_active', true)
                    ->count(),
                'vocabulary' => Vocabulary::whereHas('lesson', function($q) use ($internalLevel) {
                        $q->where('level', $internalLevel);
                    })
                    ->where('is_active', true)
                    ->count(),
                'lessons' => Lesson::where('level', $internalLevel)
                    ->where('is_active', true)
                    ->count(),
            ];
        }

        return view('jlpt.index', compact('stats'));
    }
    
    /**
     * JLPT Level Practice
     */
    public function levelPractice(Request $request)
    {
        $uiLevel = (int) $request->get('level', 1);
        $level = $this->normalizeLevel($uiLevel);
        $type = $request->get('type', 'mixed'); // mixed, kanji, vocabulary, grammar, reading
        $mode = $request->get('mode', 'practice'); // practice, test, review
        
        // Debug: Log request parameters
        \Log::info('JLPT Level Practice Request', [
            'uiLevel' => $uiLevel,
            'level' => $level,
            'type' => $type,
            'mode' => $mode,
            'kanji_limit' => $request->get('kanji_limit'),
            'vocab_limit' => $request->get('vocab_limit'),
            'all_params' => $request->all()
        ]);
        
        $data = [
            'level' => $uiLevel,
            'type' => $type,
            'mode' => $mode,
        ];
        
        switch ($type) {
            case 'kanji':
                $data['kanji'] = $this->getKanjiForLevel($level, $mode);
                break;
            case 'vocabulary':
                $data['vocabulary'] = $this->getVocabularyForLevel($level, $mode);
                break;
            case 'grammar':
                $data['grammar'] = $this->getGrammarForLevel($level, $mode);
                break;
            case 'reading':
                $data['reading'] = $this->getReadingForLevel($level, $mode);
                break;
            case 'mixed':
            default:
                $data['mixed'] = $this->getMixedContentForLevel($level, $mode, $request);
                break;
        }
        
        return view('jlpt.level-practice', compact('data'));
    }
    
    /**
     * JLPT Mock Test
     */
    public function mockTest(Request $request)
    {
        $uiLevel = (int) $request->get('level', 1);
        $level = $this->normalizeLevel($uiLevel);
        $section = $request->get('section', 'all'); // all, vocabulary, grammar, reading, listening
        
        $testData = $this->generateMockTest($level, $section);
        
        $level = $uiLevel; // keep original for display
        return view('jlpt.mock-test', compact('testData', 'level', 'section'));
    }
    
    /**
     * Submit Mock Test
     */
    public function submitMockTest(Request $request)
    {
        $answers = $request->get('answers', []);
        $testData = $request->get('test_data', []);
        $level = $request->get('level', 1);
        
        $results = $this->calculateTestResults($answers, $testData, $level);
        
        return view('jlpt.test-results', compact('results', 'level'));
    }
    
    /**
     * JLPT Progress Tracking
     */
    public function progress(Request $request)
    {
        $uiLevel = (int) $request->get('level', 1);
        $level = $this->normalizeLevel($uiLevel);
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem tiến độ');
        }
        
        $user = Auth::user();
        $progress = $this->getUserProgress($user, $level);
        
        $level = $uiLevel; // for display
        return view('jlpt.progress', compact('progress', 'level'));
    }
    
    /**
     * JLPT Study Plan
     */
    public function studyPlan(Request $request)
    {
        $uiLevel = (int) $request->get('level', 1);
        $level = $this->normalizeLevel($uiLevel);
        $weeks = $request->get('weeks', 12);
        
        $studyPlan = $this->generateStudyPlan($level, $weeks);
        
        $level = $uiLevel; // for display
        return view('jlpt.study-plan', compact('studyPlan', 'level', 'weeks'));
    }

    /**
     * JLPT Vocabulary Bank by level
     */
    public function vocabularyBank(Request $request)
    {
        $uiLevel = (int) $request->get('level', 5); // default N5
        $level = $this->normalizeLevel($uiLevel);
        $q = trim((string) $request->get('q', ''));
        $topic = trim((string) $request->get('topic', ''));

        $query = Vocabulary::whereHas('lesson', function($sub) use ($level) {
            $sub->where('level', $level);
        })->where('is_active', true);

        if ($q !== '') {
            $query->where(function($w) use ($q) {
                $w->where('japanese', 'like', "%$q%")
                  ->orWhere('romaji', 'like', "%$q%")
                  ->orWhere('vietnamese', 'like', "%$q%")
                  ->orWhere('topic', 'like', "%$q%");
            });
        }

        if ($topic !== '') {
            $query->where('topic', $topic);
        }

        $vocabularies = $query->orderBy('topic')->orderBy('id')->paginate(30)->withQueryString();

        // Distinct topics for filter
        $topics = Vocabulary::whereHas('lesson', function($sub) use ($level) {
            $sub->where('level', $level);
        })->select('topic')->whereNotNull('topic')->distinct()->orderBy('topic')->pluck('topic');

        $level = $uiLevel; // for display
        return view('jlpt.vocabulary-bank', compact('level', 'vocabularies', 'topics', 'q', 'topic'));
    }

    /**
     * JLPT Topics overview by level
     */
    public function topics(Request $request)
    {
        $uiLevel = (int) $request->get('level', 5); // default N5
        $level = $this->normalizeLevel($uiLevel);

        // Count vocab per topic for this level
        $topics = Vocabulary::whereHas('lesson', function($sub) use ($level) {
                $sub->where('level', $level);
            })
            ->select('topic')
            ->whereNotNull('topic')
            ->groupBy('topic')
            ->orderBy('topic')
            ->selectRaw('topic, COUNT(*) as total')
            ->get();

        $level = $uiLevel; // display as UI level
        return view('jlpt.topics', compact('level', 'topics'));
    }

    /**
     * JLPT Lessons list by level
     */
    public function lessons(Request $request)
    {
        $uiLevel = (int) $request->get('level', 5); // default N5 UI
        $level = $this->normalizeLevel($uiLevel);

        $lessons = Lesson::where('level', $level)
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($lesson) {
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'description' => $lesson->description,
                    'order' => $lesson->order,
                    'vocab_count' => $lesson->vocabularies()->where('is_active', true)->count(),
                    'exercise_count' => $lesson->exercises()->count(),
                    'video_count' => $lesson->videos()->count(),
                ];
            });

        $level = $uiLevel; // display as UI level
        return view('jlpt.lessons', compact('level', 'lessons'));
    }

    /**
     * JLPT Sentence Patterns by level
     */
    public function patterns(Request $request)
    {
        $uiLevel = (int) $request->get('level', 5); // default N5 UI
        $level = $this->normalizeLevel($uiLevel);

        $patterns = $this->getPatternsForLevel($level);

        $level = $uiLevel; // display as UI level
        return view('jlpt.patterns', compact('level', 'patterns'));
    }

    /**
     * JLPT Sample Dialogues by level
     */
    public function dialogues(Request $request)
    {
        $uiLevel = (int) $request->get('level', 5); // default N5 UI
        $level = $this->normalizeLevel($uiLevel);

        $dialogues = $this->getDialoguesForLevel($level);

        $level = $uiLevel; // display as UI level
        return view('jlpt.dialogues', compact('level', 'dialogues'));
    }
    
    /**
     * Get Kanji for specific level
     */
    private function getKanjiForLevel($level, $mode, $limit = null)
    {
        $query = Alphabet::where('type', 'kanji')
            ->where('difficulty_level', $level)
            ->where('is_active', true);
        
        if ($mode === 'test') {
            return $query->inRandomOrder()->limit(20)->get();
        }
        
        if ($limit) {
            return $query->orderBy('order')->limit($limit)->get();
        }
        
        return $query->orderBy('order')->get();
    }
    
    /**
     * Get Vocabulary for specific level
     */
    private function getVocabularyForLevel($level, $mode, $limit = null)
    {
        $query = Vocabulary::whereHas('lesson', function($q) use ($level) {
            $q->where('level', $level);
        })->where('is_active', true);
        
        if ($mode === 'test') {
            return $query->inRandomOrder()->limit(30)->get();
        }
        
        if ($limit) {
            return $query->orderBy('id')->limit($limit)->get();
        }
        
        return $query->orderBy('id')->get();
    }
    
    /**
     * Get Grammar for specific level
     */
    private function getGrammarForLevel($level, $mode)
    {
        // This would come from a grammar table in a real implementation
        $grammarPoints = [
            1 => [
                ['point' => 'です/だ', 'meaning' => 'Là', 'example' => '私は学生です。', 'translation' => 'Tôi là học sinh.'],
                ['point' => 'ます形', 'meaning' => 'Thể ます', 'example' => '食べます', 'translation' => 'Ăn'],
                ['point' => 'て形', 'meaning' => 'Thể て', 'example' => '食べて', 'translation' => 'Ăn (thể て)'],
            ],
            2 => [
                ['point' => 'ば形', 'meaning' => 'Thể ば', 'example' => '食べれば', 'translation' => 'Nếu ăn'],
                ['point' => 'た形', 'meaning' => 'Thể た', 'example' => '食べた', 'translation' => 'Đã ăn'],
            ],
        ];
        
        return $grammarPoints[$level] ?? [];
    }
    
    /**
     * Get Reading comprehension for specific level
     */
    private function getReadingForLevel($level, $mode)
    {
        // This would come from a reading comprehension table
        $readings = [
            1 => [
                [
                    'title' => '自己紹介',
                    'content' => '私は田中です。25歳です。東京に住んでいます。会社員です。',
                    'questions' => [
                        ['question' => '田中さんは何歳ですか？', 'options' => ['20歳', '25歳', '30歳', '35歳'], 'answer' => 1],
                        ['question' => '田中さんはどこに住んでいますか？', 'options' => ['大阪', '東京', '京都', '名古屋'], 'answer' => 1],
                    ]
                ]
            ],
            2 => [
                [
                    'title' => '日本の文化',
                    'content' => '日本には四季があります。春は桜が咲いて、とても美しいです。夏は暑くて、花火大会があります。',
                    'questions' => [
                        ['question' => '日本には何がありますか？', 'options' => ['三季', '四季', '五季', '六季'], 'answer' => 1],
                    ]
                ]
            ],
        ];
        
        return $readings[$level] ?? [];
    }

    /**
     * Get sentence patterns for specific level
     */
    private function getPatternsForLevel(int $level): array
    {
        $patterns = [
            1 => [ // N5
                [
                    'pattern' => 'N は N です',
                    'meaning' => 'N là N',
                    'example' => '私は学生です。',
                    'translation' => 'Tôi là học sinh.',
                ],
                [
                    'pattern' => 'N は N じゃありません',
                    'meaning' => 'N không phải là N',
                    'example' => '彼は先生じゃありません。',
                    'translation' => 'Anh ấy không phải là giáo viên.',
                ],
                [
                    'pattern' => '疑問詞 + ですか',
                    'meaning' => 'Câu hỏi với nghi vấn từ',
                    'example' => 'これは何ですか。',
                    'translation' => 'Cái này là gì?',
                ],
                [
                    'pattern' => '場所 に 行きます',
                    'meaning' => 'Đi đến địa điểm',
                    'example' => '駅に行きます。',
                    'translation' => 'Tôi đi đến nhà ga.',
                ],
            ],
        ];

        return $patterns[$level] ?? [];
    }

    /**
     * Get sample dialogues for specific level
     */
    private function getDialoguesForLevel(int $level): array
    {
        $dialogues = [
            1 => [ // N5
                [
                    'title' => '挨拶 (Chào hỏi)',
                    'lines' => [
                        ['speaker' => 'A', 'jp' => 'こんにちは。', 'vi' => 'Xin chào.'],
                        ['speaker' => 'B', 'jp' => 'こんにちは。お元気ですか。', 'vi' => 'Xin chào. Bạn khỏe không?'],
                        ['speaker' => 'A', 'jp' => '元気です。ありがとうございます。', 'vi' => 'Mình khỏe. Cảm ơn bạn.'],
                    ],
                ],
                [
                    'title' => '自己紹介 (Giới thiệu bản thân)',
                    'lines' => [
                        ['speaker' => 'A', 'jp' => 'はじめまして。田中です。', 'vi' => 'Rất hân hạnh. Tôi là Tanaka.'],
                        ['speaker' => 'B', 'jp' => 'はじめまして。ニックです。', 'vi' => 'Rất hân hạnh. Tôi là Nick.'],
                        ['speaker' => 'A', 'jp' => 'どうぞよろしくお願いします。', 'vi' => 'Mong được giúp đỡ.'],
                    ],
                ],
            ],
        ];

        return $dialogues[$level] ?? [];
    }
    
    /**
     * Get mixed content for level
     */
    private function getMixedContentForLevel($level, $mode, $request = null)
    {
        $kanjiLimit = $request ? (int) $request->get('kanji_limit', 6) : 6;
        $vocabLimit = $request ? (int) $request->get('vocab_limit', 6) : 6;
        
        // Get total counts
        $totalKanji = Alphabet::where('type', 'kanji')
            ->where('difficulty_level', $level)
            ->where('is_active', true)->count();
            
        $totalVocab = Vocabulary::whereHas('lesson', function($q) use ($level) {
            $q->where('level', $level);
        })->where('is_active', true)->count();
        
        return [
            'kanji' => $this->getKanjiForLevel($level, $mode, $kanjiLimit),
            'vocabulary' => $this->getVocabularyForLevel($level, $mode, $vocabLimit),
            'grammar' => $this->getGrammarForLevel($level, $mode),
            'reading' => $this->getReadingForLevel($level, $mode),
            'totalKanji' => $totalKanji,
            'totalVocab' => $totalVocab,
        ];
    }
    
    /**
     * Generate mock test
     */
    private function generateMockTest($level, $section)
    {
        $testData = [
            'level' => $level,
            'section' => $section,
            'questions' => [],
            'time_limit' => $this->getTimeLimit($level, $section),
        ];
        
        switch ($section) {
            case 'vocabulary':
                $testData['questions'] = $this->generateVocabularyQuestions($level);
                break;
            case 'grammar':
                $testData['questions'] = $this->generateGrammarQuestions($level);
                break;
            case 'reading':
                $testData['questions'] = $this->generateReadingQuestions($level);
                break;
            case 'all':
            default:
                $testData['questions'] = array_merge(
                    $this->generateVocabularyQuestions($level),
                    $this->generateGrammarQuestions($level),
                    $this->generateReadingQuestions($level)
                );
                break;
        }
        
        // Shuffle questions
        shuffle($testData['questions']);
        
        return $testData;
    }
    
    /**
     * Generate vocabulary questions
     */
    private function generateVocabularyQuestions($level)
    {
        $vocabularies = Vocabulary::whereHas('lesson', function($q) use ($level) {
            $q->where('level', $level);
        })->where('is_active', true)->inRandomOrder()->limit(20)->get();
        
        $questions = [];
        
        foreach ($vocabularies as $vocab) {
            $questions[] = [
                'type' => 'vocabulary',
                'question' => $vocab->japanese,
                'options' => $this->generateVocabularyOptions($vocab->vietnamese, $level),
                'correct_answer' => $vocab->vietnamese,
                'romaji' => $vocab->romaji,
            ];
        }
        
        return $questions;
    }
    
    /**
     * Generate grammar questions
     */
    private function generateGrammarQuestions($level)
    {
        // This would come from a grammar questions table
        $grammarQuestions = [
            1 => [
                [
                    'type' => 'grammar',
                    'question' => '私は学生___。',
                    'options' => ['です', 'だ', 'である', 'であります'],
                    'correct_answer' => 'です',
                ],
                [
                    'type' => 'grammar',
                    'question' => '本を___。',
                    'options' => ['読みます', '読む', '読んで', '読んだ'],
                    'correct_answer' => '読みます',
                ],
            ],
        ];
        
        return $grammarQuestions[$level] ?? [];
    }
    
    /**
     * Generate reading questions
     */
    private function generateReadingQuestions($level)
    {
        $readings = $this->getReadingForLevel($level, 'test');
        $questions = [];
        
        foreach ($readings as $reading) {
            foreach ($reading['questions'] as $q) {
                $questions[] = [
                    'type' => 'reading',
                    'passage' => $reading['content'],
                    'question' => $q['question'],
                    'options' => $q['options'],
                    'correct_answer' => $q['options'][$q['answer']],
                ];
            }
        }
        
        return $questions;
    }
    
    /**
     * Generate vocabulary options
     */
    private function generateVocabularyOptions($correct, $level)
    {
        $options = [$correct];
        
        $otherVocab = Vocabulary::whereHas('lesson', function($q) use ($level) {
            $q->where('level', $level);
        })->where('is_active', true)
        ->where('vietnamese', '!=', $correct)
        ->inRandomOrder()
        ->limit(3)
        ->pluck('vietnamese')
        ->toArray();
        
        $options = array_merge($options, $otherVocab);
        shuffle($options);
        
        return array_slice($options, 0, 4);
    }
    
    /**
     * Get time limit for test
     */
    private function getTimeLimit($level, $section)
    {
        $timeLimits = [
            'vocabulary' => [1 => 25, 2 => 30, 3 => 30, 4 => 30, 5 => 30],
            'grammar' => [1 => 50, 2 => 60, 3 => 70, 4 => 60, 5 => 60],
            'reading' => [1 => 50, 2 => 60, 3 => 70, 4 => 60, 5 => 60],
            'all' => [1 => 125, 2 => 150, 3 => 170, 4 => 150, 5 => 150],
        ];
        
        return $timeLimits[$section][$level] ?? 60;
    }
    
    /**
     * Calculate test results
     */
    private function calculateTestResults($answers, $testData, $level)
    {
        $correct = 0;
        $total = count($testData['questions']);
        $results = [];
        
        foreach ($testData['questions'] as $index => $question) {
            $userAnswer = $answers[$index] ?? '';
            $isCorrect = $userAnswer === $question['correct_answer'];
            
            if ($isCorrect) {
                $correct++;
            }
            
            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question['correct_answer'],
                'is_correct' => $isCorrect,
            ];
        }
        
        $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
        $passingScore = $this->getPassingScore($level);
        $passed = $score >= $passingScore;
        
        return [
            'level' => $level,
            'score' => $score,
            'correct' => $correct,
            'total' => $total,
            'passed' => $passed,
            'passing_score' => $passingScore,
            'results' => $results,
            'recommendations' => $this->getRecommendations($score, $level),
        ];
    }
    
    /**
     * Get passing score for level
     */
    private function getPassingScore($level)
    {
        $passingScores = [1 => 60, 2 => 60, 3 => 60, 4 => 60, 5 => 60];
        return $passingScores[$level] ?? 60;
    }
    
    /**
     * Get recommendations based on score
     */
    private function getRecommendations($score, $level)
    {
        if ($score >= 80) {
            return [
                'message' => 'Xuất sắc! Bạn đã sẵn sàng cho kỳ thi JLPT',
                'suggestions' => [
                    'Tiếp tục luyện tập để duy trì trình độ',
                    'Thử làm bài test ở cấp độ cao hơn',
                    'Tập trung vào kỹ năng nghe và nói',
                ]
            ];
        } elseif ($score >= 60) {
            return [
                'message' => 'Tốt! Bạn đã đạt điểm đậu, nhưng cần cải thiện thêm',
                'suggestions' => [
                    'Luyện tập thêm từ vựng và ngữ pháp',
                    'Làm nhiều bài đọc hiểu',
                    'Ôn tập lại các điểm yếu',
                ]
            ];
        } else {
            return [
                'message' => 'Cần cải thiện nhiều hơn để đạt điểm đậu',
                'suggestions' => [
                    'Ôn tập lại kiến thức cơ bản',
                    'Luyện tập từ vựng hàng ngày',
                    'Làm bài tập ngữ pháp nhiều hơn',
                    'Đọc sách tiếng Nhật đơn giản',
                ]
            ];
        }
    }

    /**
     * Normalize UI level (N5=5..N1=1) to internal level (N5=1..N1=5)
     */
    private function normalizeLevel(int $uiLevel): int
    {
        if ($uiLevel < 1 || $uiLevel > 5) {
            return 1;
        }
        return 6 - $uiLevel;
    }
    
    /**
     * Get user progress
     */
    private function getUserProgress($user, $level)
    {
        // This would come from user progress tracking in a real implementation
        return [
            'level' => $level,
            'kanji_mastered' => 0,
            'vocabulary_mastered' => 0,
            'grammar_mastered' => 0,
            'tests_completed' => 0,
            'average_score' => 0,
            'study_time' => 0,
            'streak_days' => 0,
        ];
    }
    
    /**
     * Generate study plan
     */
    private function generateStudyPlan($level, $weeks)
    {
        $plan = [];
        $totalKanji = Alphabet::where('type', 'kanji')->where('difficulty_level', $level)->count();
        $totalVocab = Vocabulary::whereHas('lesson', function($q) use ($level) {
            $q->where('level', $level);
        })->count();
        
        $kanjiPerWeek = ceil($totalKanji / $weeks);
        $vocabPerWeek = ceil($totalVocab / $weeks);
        
        for ($week = 1; $week <= $weeks; $week++) {
            $plan[] = [
                'week' => $week,
                'kanji_target' => min($kanjiPerWeek, $totalKanji - ($week - 1) * $kanjiPerWeek),
                'vocabulary_target' => min($vocabPerWeek, $totalVocab - ($week - 1) * $vocabPerWeek),
                'grammar_points' => 3,
                'reading_practice' => 2,
                'mock_tests' => $week % 2 == 0 ? 1 : 0,
            ];
        }
        
        return $plan;
    }
}
