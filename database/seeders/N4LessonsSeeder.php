<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class N4LessonsSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing N4 lessons
        Lesson::where('level', 2)->delete();
        Vocabulary::whereHas('lesson', function($query) {
            $query->where('level', 2);
        })->delete();
        Grammar::whereHas('lesson', function($query) {
            $query->where('level', 2);
        })->delete();
        Exercise::whereHas('lesson', function($query) {
            $query->where('level', 2);
        })->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $n4Lessons = [
            // Bài 1-5: N4 Cơ bản
            [
                'title' => 'N4 - Động từ thể て (Te-form)',
                'description' => 'Học cách chia động từ thể て và cách sử dụng trong câu',
                'level' => 2,
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Động từ thể た (Ta-form)',
                'description' => 'Học cách chia động từ thể た và cách sử dụng',
                'level' => 2,
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Động từ thể ない (Nai-form)',
                'description' => 'Học cách chia động từ thể ない và cách sử dụng',
                'level' => 2,
                'order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Tính từ đuôi い và な',
                'description' => 'Học cách sử dụng tính từ đuôi い và な trong câu',
                'level' => 2,
                'order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Trợ từ に, で, を, が',
                'description' => 'Học cách sử dụng các trợ từ cơ bản trong tiếng Nhật',
                'level' => 2,
                'order' => 5,
                'is_active' => true
            ],
            // Bài 6-10: N4 Trung cấp
            [
                'title' => 'N4 - Thể bị động (Passive)',
                'description' => 'Học cách sử dụng thể bị động trong tiếng Nhật',
                'level' => 2,
                'order' => 6,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Thể sai khiến (Causative)',
                'description' => 'Học cách sử dụng thể sai khiến',
                'level' => 2,
                'order' => 7,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Điều kiện たら, ば, と',
                'description' => 'Học cách sử dụng các điều kiện trong tiếng Nhật',
                'level' => 2,
                'order' => 8,
                'is_active' => true
            ],
            [
                'title' => 'N4 - So sánh より, ほど, くらい',
                'description' => 'Học cách so sánh trong tiếng Nhật',
                'level' => 2,
                'order' => 9,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Thời gian và lịch trình',
                'description' => 'Học từ vựng và ngữ pháp về thời gian',
                'level' => 2,
                'order' => 10,
                'is_active' => true
            ],
            // Bài 11-15: N4 Nâng cao
            [
                'title' => 'N4 - Gia đình và mối quan hệ',
                'description' => 'Học từ vựng về gia đình và các mối quan hệ',
                'level' => 2,
                'order' => 11,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Công việc và nghề nghiệp',
                'description' => 'Học từ vựng về công việc và nghề nghiệp',
                'level' => 2,
                'order' => 12,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Mua sắm và thương mại',
                'description' => 'Học từ vựng về mua sắm và thương mại',
                'level' => 2,
                'order' => 13,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Du lịch và phương tiện',
                'description' => 'Học từ vựng về du lịch và phương tiện đi lại',
                'level' => 2,
                'order' => 14,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Sức khỏe và y tế',
                'description' => 'Học từ vựng về sức khỏe và y tế',
                'level' => 2,
                'order' => 15,
                'is_active' => true
            ],
            // Bài 16-20: N4 Thực hành
            [
                'title' => 'N4 - Hội thoại hàng ngày',
                'description' => 'Học các mẫu hội thoại hàng ngày',
                'level' => 2,
                'order' => 16,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Viết email và thư',
                'description' => 'Học cách viết email và thư trong tiếng Nhật',
                'level' => 2,
                'order' => 17,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Đọc hiểu cơ bản',
                'description' => 'Luyện tập đọc hiểu cơ bản N4',
                'level' => 2,
                'order' => 18,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Nghe hiểu cơ bản',
                'description' => 'Luyện tập nghe hiểu cơ bản N4',
                'level' => 2,
                'order' => 19,
                'is_active' => true
            ],
            [
                'title' => 'N4 - Tổng hợp và ôn tập',
                'description' => 'Tổng hợp và ôn tập toàn bộ kiến thức N4',
                'level' => 2,
                'order' => 20,
                'is_active' => true
            ]
        ];

        foreach ($n4Lessons as $lessonData) {
            $lesson = Lesson::create($lessonData);
            $this->createVocabularyForLesson($lesson);
            $this->createGrammarForLesson($lesson);
            $this->createExercisesForLesson($lesson);
        }

        $this->command->info('Đã tạo ' . count($n4Lessons) . ' bài học N4 với đầy đủ nội dung');
    }

    private function createVocabularyForLesson($lesson)
    {
        $vocabularies = [];

        switch ($lesson->order) {
            case 1: // Te-form
                $vocabularies = [
                    ['japanese' => '食べる', 'hiragana' => 'たべる', 'romaji' => 'taberu', 'vietnamese' => 'ăn', 'topic' => 'Động từ'],
                    ['japanese' => '飲む', 'hiragana' => 'のむ', 'romaji' => 'nomu', 'vietnamese' => 'uống', 'topic' => 'Động từ'],
                    ['japanese' => '行く', 'hiragana' => 'いく', 'romaji' => 'iku', 'vietnamese' => 'đi', 'topic' => 'Động từ'],
                    ['japanese' => '来る', 'hiragana' => 'くる', 'romaji' => 'kuru', 'vietnamese' => 'đến', 'topic' => 'Động từ'],
                    ['japanese' => 'する', 'hiragana' => 'する', 'romaji' => 'suru', 'vietnamese' => 'làm', 'topic' => 'Động từ'],
                    ['japanese' => '見る', 'hiragana' => 'みる', 'romaji' => 'miru', 'vietnamese' => 'xem', 'topic' => 'Động từ'],
                    ['japanese' => '聞く', 'hiragana' => 'きく', 'romaji' => 'kiku', 'vietnamese' => 'nghe', 'topic' => 'Động từ'],
                    ['japanese' => '話す', 'hiragana' => 'はなす', 'romaji' => 'hanasu', 'vietnamese' => 'nói', 'topic' => 'Động từ']
                ];
                break;

            case 2: // Ta-form
                $vocabularies = [
                    ['japanese' => '買う', 'hiragana' => 'かう', 'romaji' => 'kau', 'vietnamese' => 'mua', 'topic' => 'Động từ'],
                    ['japanese' => '売る', 'hiragana' => 'うる', 'romaji' => 'uru', 'vietnamese' => 'bán', 'topic' => 'Động từ'],
                    ['japanese' => '作る', 'hiragana' => 'つくる', 'romaji' => 'tsukuru', 'vietnamese' => 'làm, tạo', 'topic' => 'Động từ'],
                    ['japanese' => '読む', 'hiragana' => 'よむ', 'romaji' => 'yomu', 'vietnamese' => 'đọc', 'topic' => 'Động từ'],
                    ['japanese' => '書く', 'hiragana' => 'かく', 'romaji' => 'kaku', 'vietnamese' => 'viết', 'topic' => 'Động từ'],
                    ['japanese' => '勉強する', 'hiragana' => 'べんきょうする', 'romaji' => 'benkyou suru', 'vietnamese' => 'học', 'topic' => 'Động từ'],
                    ['japanese' => '働く', 'hiragana' => 'はたらく', 'romaji' => 'hataraku', 'vietnamese' => 'làm việc', 'topic' => 'Động từ'],
                    ['japanese' => '休む', 'hiragana' => 'やすむ', 'romaji' => 'yasumu', 'vietnamese' => 'nghỉ ngơi', 'topic' => 'Động từ']
                ];
                break;

            case 3: // Nai-form
                $vocabularies = [
                    ['japanese' => '分かる', 'hiragana' => 'わかる', 'romaji' => 'wakaru', 'vietnamese' => 'hiểu', 'topic' => 'Động từ'],
                    ['japanese' => '知る', 'hiragana' => 'しる', 'romaji' => 'shiru', 'vietnamese' => 'biết', 'topic' => 'Động từ'],
                    ['japanese' => '覚える', 'hiragana' => 'おぼえる', 'romaji' => 'oboeru', 'vietnamese' => 'nhớ', 'topic' => 'Động từ'],
                    ['japanese' => '忘れる', 'hiragana' => 'わすれる', 'romaji' => 'wasureru', 'vietnamese' => 'quên', 'topic' => 'Động từ'],
                    ['japanese' => '考える', 'hiragana' => 'かんがえる', 'romaji' => 'kangaeru', 'vietnamese' => 'suy nghĩ', 'topic' => 'Động từ'],
                    ['japanese' => '思う', 'hiragana' => 'おもう', 'romaji' => 'omou', 'vietnamese' => 'nghĩ', 'topic' => 'Động từ'],
                    ['japanese' => '決める', 'hiragana' => 'きめる', 'romaji' => 'kimeru', 'vietnamese' => 'quyết định', 'topic' => 'Động từ'],
                    ['japanese' => '選ぶ', 'hiragana' => 'えらぶ', 'romaji' => 'erabu', 'vietnamese' => 'chọn', 'topic' => 'Động từ']
                ];
                break;

            case 4: // Tính từ
                $vocabularies = [
                    ['japanese' => '大きい', 'hiragana' => 'おおきい', 'romaji' => 'ookii', 'vietnamese' => 'to, lớn', 'topic' => 'Tính từ'],
                    ['japanese' => '小さい', 'hiragana' => 'ちいさい', 'romaji' => 'chiisai', 'vietnamese' => 'nhỏ', 'topic' => 'Tính từ'],
                    ['japanese' => '高い', 'hiragana' => 'たかい', 'romaji' => 'takai', 'vietnamese' => 'cao, đắt', 'topic' => 'Tính từ'],
                    ['japanese' => '低い', 'hiragana' => 'ひくい', 'romaji' => 'hikui', 'vietnamese' => 'thấp, rẻ', 'topic' => 'Tính từ'],
                    ['japanese' => '新しい', 'hiragana' => 'あたらしい', 'romaji' => 'atarashii', 'vietnamese' => 'mới', 'topic' => 'Tính từ'],
                    ['japanese' => '古い', 'hiragana' => 'ふるい', 'romaji' => 'furui', 'vietnamese' => 'cũ', 'topic' => 'Tính từ'],
                    ['japanese' => 'きれい', 'hiragana' => 'きれい', 'romaji' => 'kirei', 'vietnamese' => 'đẹp, sạch', 'topic' => 'Tính từ'],
                    ['japanese' => '静か', 'hiragana' => 'しずか', 'romaji' => 'shizuka', 'vietnamese' => 'yên tĩnh', 'topic' => 'Tính từ']
                ];
                break;

            case 5: // Trợ từ
                $vocabularies = [
                    ['japanese' => '学校', 'hiragana' => 'がっこう', 'romaji' => 'gakkou', 'vietnamese' => 'trường học', 'topic' => 'Danh từ'],
                    ['japanese' => '会社', 'hiragana' => 'かいしゃ', 'romaji' => 'kaisha', 'vietnamese' => 'công ty', 'topic' => 'Danh từ'],
                    ['japanese' => '家', 'hiragana' => 'いえ', 'romaji' => 'ie', 'vietnamese' => 'nhà', 'topic' => 'Danh từ'],
                    ['japanese' => '病院', 'hiragana' => 'びょういん', 'romaji' => 'byouin', 'vietnamese' => 'bệnh viện', 'topic' => 'Danh từ'],
                    ['japanese' => '銀行', 'hiragana' => 'ぎんこう', 'romaji' => 'ginkou', 'vietnamese' => 'ngân hàng', 'topic' => 'Danh từ'],
                    ['japanese' => '駅', 'hiragana' => 'えき', 'romaji' => 'eki', 'vietnamese' => 'ga tàu', 'topic' => 'Danh từ'],
                    ['japanese' => '店', 'hiragana' => 'みせ', 'romaji' => 'mise', 'vietnamese' => 'cửa hàng', 'topic' => 'Danh từ'],
                    ['japanese' => '公園', 'hiragana' => 'こうえん', 'romaji' => 'kouen', 'vietnamese' => 'công viên', 'topic' => 'Danh từ']
                ];
                break;

            default:
                // Tạo vocabulary mẫu cho các bài khác
                $vocabularies = [
                    ['japanese' => '例', 'hiragana' => 'れい', 'romaji' => 'rei', 'vietnamese' => 'ví dụ', 'topic' => 'Danh từ'],
                    ['japanese' => '練習', 'hiragana' => 'れんしゅう', 'romaji' => 'renshuu', 'vietnamese' => 'luyện tập', 'topic' => 'Danh từ'],
                    ['japanese' => '勉強', 'hiragana' => 'べんきょう', 'romaji' => 'benkyou', 'vietnamese' => 'học tập', 'topic' => 'Danh từ'],
                    ['japanese' => '仕事', 'hiragana' => 'しごと', 'romaji' => 'shigoto', 'vietnamese' => 'công việc', 'topic' => 'Danh từ'],
                    ['japanese' => '生活', 'hiragana' => 'せいかつ', 'romaji' => 'seikatsu', 'vietnamese' => 'cuộc sống', 'topic' => 'Danh từ']
                ];
                break;
        }

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'lesson_id' => $lesson->id,
                'japanese' => $vocab['japanese'],
                'hiragana' => $vocab['hiragana'],
                'romaji' => $vocab['romaji'],
                'vietnamese' => $vocab['vietnamese'],
                'topic' => $vocab['topic'],
                'is_active' => true
            ]);
        }
    }

    private function createGrammarForLesson($lesson)
    {
        $grammars = [];

        switch ($lesson->order) {
            case 1: // Te-form
                $grammars = [
                    [
                        'title' => 'Thể て của động từ nhóm I',
                        'explanation' => 'Động từ nhóm I: う → って, く → いて, ぐ → いで, す → して, つ → って, ぬ → んで, む → んで, る → って',
                        'structure' => 'Vて + ください',
                        'examples' => '食べてください (Hãy ăn đi)',
                        'usage_notes' => 'Dùng để yêu cầu lịch sự'
                    ],
                    [
                        'title' => 'Thể て của động từ nhóm II',
                        'explanation' => 'Động từ nhóm II: Bỏ る + て',
                        'structure' => 'Vて + います',
                        'examples' => '食べています (Đang ăn)',
                        'usage_notes' => 'Dùng để diễn tả hành động đang diễn ra'
                    ]
                ];
                break;

            case 2: // Ta-form
                $grammars = [
                    [
                        'title' => 'Thể た của động từ',
                        'explanation' => 'Thể た được tạo giống như thể て nhưng thay て bằng た',
                        'structure' => 'Vた + ことがあります',
                        'examples' => '食べたことがあります (Đã từng ăn)',
                        'usage_notes' => 'Dùng để diễn tả kinh nghiệm'
                    ]
                ];
                break;

            default:
                $grammars = [
                    [
                        'title' => 'Ngữ pháp cơ bản N4',
                        'explanation' => 'Ngữ pháp cơ bản cho trình độ N4',
                        'structure' => 'Cấu trúc câu cơ bản',
                        'examples' => 'Ví dụ sử dụng',
                        'usage_notes' => 'Lưu ý sử dụng'
                    ]
                ];
                break;
        }

        foreach ($grammars as $grammar) {
            Grammar::create([
                'lesson_id' => $lesson->id,
                'title' => $grammar['title'],
                'explanation' => $grammar['explanation'],
                'structure' => $grammar['structure'],
                'examples' => $grammar['examples'],
                'usage_notes' => $grammar['usage_notes'],
                'difficulty_level' => 2
            ]);
        }
    }

    private function createExercisesForLesson($lesson)
    {
        $exercises = [];

        // Tạo 3 bài tập cho mỗi bài học
        for ($i = 1; $i <= 3; $i++) {
            $exercises[] = [
                'type' => 'multiple_choice',
                'question' => 'Chọn đáp án đúng cho câu hỏi N4 bài ' . $lesson->order,
                'options' => json_encode(['A', 'B', 'C', 'D']),
                'correct_answer' => 'A',
                'explanation' => 'Giải thích đáp án đúng',
                'points' => 10,
                'difficulty_level' => 2
            ];
        }

        foreach ($exercises as $exercise) {
            Exercise::create([
                'lesson_id' => $lesson->id,
                'type' => $exercise['type'],
                'question' => $exercise['question'],
                'options' => $exercise['options'],
                'correct_answer' => $exercise['correct_answer'],
                'explanation' => $exercise['explanation'],
                'points' => $exercise['points'],
                'difficulty_level' => $exercise['difficulty_level']
            ]);
        }
    }
}