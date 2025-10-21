<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class N3LessonsSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing N3 lessons
        Lesson::where('level', 3)->delete();
        Vocabulary::whereHas('lesson', function($query) {
            $query->where('level', 3);
        })->delete();
        Grammar::whereHas('lesson', function($query) {
            $query->where('level', 3);
        })->delete();
        Exercise::whereHas('lesson', function($query) {
            $query->where('level', 3);
        })->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $n3Lessons = [
            // Bài 1-5: N3 Cơ bản
            [
                'title' => 'N3 - Thể bị động nâng cao',
                'description' => 'Học cách sử dụng thể bị động trong các tình huống phức tạp',
                'level' => 3,
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Thể sai khiến nâng cao',
                'description' => 'Học cách sử dụng thể sai khiến trong các tình huống khác nhau',
                'level' => 3,
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Điều kiện phức tạp',
                'description' => 'Học các điều kiện phức tạp: なら, としたら, とすれば',
                'level' => 3,
                'order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'N3 - So sánh nâng cao',
                'description' => 'Học cách so sánh phức tạp và các mẫu câu so sánh',
                'level' => 3,
                'order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Thể khả năng',
                'description' => 'Học cách sử dụng thể khả năng và các mẫu câu liên quan',
                'level' => 3,
                'order' => 5,
                'is_active' => true
            ],
            // Bài 6-10: N3 Trung cấp
            [
                'title' => 'N3 - Thể ý chí và quyết định',
                'description' => 'Học cách diễn tả ý chí và quyết định',
                'level' => 3,
                'order' => 6,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Thể nghi vấn và phỏng đoán',
                'description' => 'Học cách diễn tả nghi vấn và phỏng đoán',
                'level' => 3,
                'order' => 7,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Thể kính ngữ cơ bản',
                'description' => 'Học cách sử dụng kính ngữ cơ bản',
                'level' => 3,
                'order' => 8,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Thể khiêm tốn cơ bản',
                'description' => 'Học cách sử dụng thể khiêm tốn cơ bản',
                'level' => 3,
                'order' => 9,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Từ nối và liên từ',
                'description' => 'Học các từ nối và liên từ phức tạp',
                'level' => 3,
                'order' => 10,
                'is_active' => true
            ],
            // Bài 11-15: N3 Nâng cao
            [
                'title' => 'N3 - Văn hóa và xã hội',
                'description' => 'Học từ vựng về văn hóa và xã hội Nhật Bản',
                'level' => 3,
                'order' => 11,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Kinh tế và thương mại',
                'description' => 'Học từ vựng về kinh tế và thương mại',
                'level' => 3,
                'order' => 12,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Khoa học và công nghệ',
                'description' => 'Học từ vựng về khoa học và công nghệ',
                'level' => 3,
                'order' => 13,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Môi trường và thiên nhiên',
                'description' => 'Học từ vựng về môi trường và thiên nhiên',
                'level' => 3,
                'order' => 14,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Giáo dục và nghiên cứu',
                'description' => 'Học từ vựng về giáo dục và nghiên cứu',
                'level' => 3,
                'order' => 15,
                'is_active' => true
            ],
            // Bài 16-20: N3 Thực hành
            [
                'title' => 'N3 - Đọc hiểu trung cấp',
                'description' => 'Luyện tập đọc hiểu trung cấp N3',
                'level' => 3,
                'order' => 16,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Nghe hiểu trung cấp',
                'description' => 'Luyện tập nghe hiểu trung cấp N3',
                'level' => 3,
                'order' => 17,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Viết luận cơ bản',
                'description' => 'Học cách viết luận cơ bản N3',
                'level' => 3,
                'order' => 18,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Hội thoại nâng cao',
                'description' => 'Luyện tập hội thoại nâng cao N3',
                'level' => 3,
                'order' => 19,
                'is_active' => true
            ],
            [
                'title' => 'N3 - Tổng hợp và ôn tập',
                'description' => 'Tổng hợp và ôn tập toàn bộ kiến thức N3',
                'level' => 3,
                'order' => 20,
                'is_active' => true
            ]
        ];

        foreach ($n3Lessons as $lessonData) {
            $lesson = Lesson::create($lessonData);
            $this->createVocabularyForLesson($lesson);
            $this->createGrammarForLesson($lesson);
            $this->createExercisesForLesson($lesson);
        }

        $this->command->info('Đã tạo ' . count($n3Lessons) . ' bài học N3 với đầy đủ nội dung');
    }

    private function createVocabularyForLesson($lesson)
    {
        $vocabularies = [];

        switch ($lesson->order) {
            case 1: // Thể bị động nâng cao
                $vocabularies = [
                    ['japanese' => '作られる', 'hiragana' => 'つくられる', 'romaji' => 'tsukurareru', 'vietnamese' => 'được làm', 'topic' => 'Động từ'],
                    ['japanese' => '教えられる', 'hiragana' => 'おしえられる', 'romaji' => 'oshierareru', 'vietnamese' => 'được dạy', 'topic' => 'Động từ'],
                    ['japanese' => '見られる', 'hiragana' => 'みられる', 'romaji' => 'mirareru', 'vietnamese' => 'được xem', 'topic' => 'Động từ'],
                    ['japanese' => '聞かれる', 'hiragana' => 'きかれる', 'romaji' => 'kikareru', 'vietnamese' => 'được nghe', 'topic' => 'Động từ'],
                    ['japanese' => '読まれる', 'hiragana' => 'よまれる', 'romaji' => 'yomareru', 'vietnamese' => 'được đọc', 'topic' => 'Động từ'],
                    ['japanese' => '書かれる', 'hiragana' => 'かかれる', 'romaji' => 'kakareru', 'vietnamese' => 'được viết', 'topic' => 'Động từ'],
                    ['japanese' => '使われる', 'hiragana' => 'つかわれる', 'romaji' => 'tsukawareru', 'vietnamese' => 'được sử dụng', 'topic' => 'Động từ'],
                    ['japanese' => '考えられる', 'hiragana' => 'かんがえられる', 'romaji' => 'kangaerareru', 'vietnamese' => 'được suy nghĩ', 'topic' => 'Động từ']
                ];
                break;

            case 2: // Thể sai khiến nâng cao
                $vocabularies = [
                    ['japanese' => '作らせる', 'hiragana' => 'つくらせる', 'romaji' => 'tsukuraseru', 'vietnamese' => 'bắt làm', 'topic' => 'Động từ'],
                    ['japanese' => '教えさせる', 'hiragana' => 'おしえさせる', 'romaji' => 'oshiesaseru', 'vietnamese' => 'bắt dạy', 'topic' => 'Động từ'],
                    ['japanese' => '見させる', 'hiragana' => 'みさせる', 'romaji' => 'misaseru', 'vietnamese' => 'bắt xem', 'topic' => 'Động từ'],
                    ['japanese' => '聞かせる', 'hiragana' => 'きかせる', 'romaji' => 'kikaseru', 'vietnamese' => 'bắt nghe', 'topic' => 'Động từ'],
                    ['japanese' => '読ませる', 'hiragana' => 'よませる', 'romaji' => 'yomaseru', 'vietnamese' => 'bắt đọc', 'topic' => 'Động từ'],
                    ['japanese' => '書かせる', 'hiragana' => 'かかせる', 'romaji' => 'kakaseru', 'vietnamese' => 'bắt viết', 'topic' => 'Động từ'],
                    ['japanese' => '使わせる', 'hiragana' => 'つかわせる', 'romaji' => 'tsukawaseru', 'vietnamese' => 'bắt sử dụng', 'topic' => 'Động từ'],
                    ['japanese' => '考えさせる', 'hiragana' => 'かんがえさせる', 'romaji' => 'kangaesaseru', 'vietnamese' => 'bắt suy nghĩ', 'topic' => 'Động từ']
                ];
                break;

            case 3: // Điều kiện phức tạp
                $vocabularies = [
                    ['japanese' => 'もし', 'hiragana' => 'もし', 'romaji' => 'moshi', 'vietnamese' => 'nếu', 'topic' => 'Trạng từ'],
                    ['japanese' => '仮に', 'hiragana' => 'かりに', 'romaji' => 'karini', 'vietnamese' => 'giả sử', 'topic' => 'Trạng từ'],
                    ['japanese' => '万一', 'hiragana' => 'まんいち', 'romaji' => 'manichi', 'vietnamese' => 'trong trường hợp', 'topic' => 'Trạng từ'],
                    ['japanese' => '場合', 'hiragana' => 'ばあい', 'romaji' => 'baai', 'vietnamese' => 'trường hợp', 'topic' => 'Danh từ'],
                    ['japanese' => '状況', 'hiragana' => 'じょうきょう', 'romaji' => 'joukyou', 'vietnamese' => 'tình huống', 'topic' => 'Danh từ'],
                    ['japanese' => '条件', 'hiragana' => 'じょうけん', 'romaji' => 'jouken', 'vietnamese' => 'điều kiện', 'topic' => 'Danh từ'],
                    ['japanese' => '可能性', 'hiragana' => 'かのうせい', 'romaji' => 'kanousei', 'vietnamese' => 'khả năng', 'topic' => 'Danh từ'],
                    ['japanese' => '確率', 'hiragana' => 'かくりつ', 'romaji' => 'kakuritsu', 'vietnamese' => 'xác suất', 'topic' => 'Danh từ']
                ];
                break;

            case 4: // So sánh nâng cao
                $vocabularies = [
                    ['japanese' => '比較', 'hiragana' => 'ひかく', 'romaji' => 'hikaku', 'vietnamese' => 'so sánh', 'topic' => 'Danh từ'],
                    ['japanese' => '対比', 'hiragana' => 'たいひ', 'romaji' => 'taihi', 'vietnamese' => 'đối chiếu', 'topic' => 'Danh từ'],
                    ['japanese' => '相違', 'hiragana' => 'そうい', 'romaji' => 'soui', 'vietnamese' => 'sự khác biệt', 'topic' => 'Danh từ'],
                    ['japanese' => '類似', 'hiragana' => 'るいじ', 'romaji' => 'ruiji', 'vietnamese' => 'tương tự', 'topic' => 'Danh từ'],
                    ['japanese' => '優劣', 'hiragana' => 'ゆうれつ', 'romaji' => 'yuuretsu', 'vietnamese' => 'ưu khuyết', 'topic' => 'Danh từ'],
                    ['japanese' => '長所', 'hiragana' => 'ちょうしょ', 'romaji' => 'chousho', 'vietnamese' => 'ưu điểm', 'topic' => 'Danh từ'],
                    ['japanese' => '短所', 'hiragana' => 'たんしょ', 'romaji' => 'tansho', 'vietnamese' => 'khuyết điểm', 'topic' => 'Danh từ'],
                    ['japanese' => '特徴', 'hiragana' => 'とくちょう', 'romaji' => 'tokuchou', 'vietnamese' => 'đặc điểm', 'topic' => 'Danh từ']
                ];
                break;

            case 5: // Thể khả năng
                $vocabularies = [
                    ['japanese' => 'できる', 'hiragana' => 'できる', 'romaji' => 'dekiru', 'vietnamese' => 'có thể', 'topic' => 'Động từ'],
                    ['japanese' => '可能', 'hiragana' => 'かのう', 'romaji' => 'kanou', 'vietnamese' => 'khả năng', 'topic' => 'Danh từ'],
                    ['japanese' => '能力', 'hiragana' => 'のうりょく', 'romaji' => 'nouryoku', 'vietnamese' => 'năng lực', 'topic' => 'Danh từ'],
                    ['japanese' => '技術', 'hiragana' => 'ぎじゅつ', 'romaji' => 'gijutsu', 'vietnamese' => 'kỹ thuật', 'topic' => 'Danh từ'],
                    ['japanese' => '技能', 'hiragana' => 'ぎのう', 'romaji' => 'ginou', 'vietnamese' => 'kỹ năng', 'topic' => 'Danh từ'],
                    ['japanese' => '才能', 'hiragana' => 'さいのう', 'romaji' => 'sainou', 'vietnamese' => 'tài năng', 'topic' => 'Danh từ'],
                    ['japanese' => '経験', 'hiragana' => 'けいけん', 'romaji' => 'keiken', 'vietnamese' => 'kinh nghiệm', 'topic' => 'Danh từ'],
                    ['japanese' => '実力', 'hiragana' => 'じつりょく', 'romaji' => 'jitsuryoku', 'vietnamese' => 'thực lực', 'topic' => 'Danh từ']
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
            case 1: // Thể bị động nâng cao
                $grammars = [
                    [
                        'title' => 'Thể bị động của động từ nhóm I',
                        'explanation' => 'Động từ nhóm I: う → われる, く → かれる, ぐ → がれる, す → される, つ → たれる, ぬ → なれる, む → まれる, る → られる',
                        'structure' => 'Vられる + ています',
                        'examples' => '作られています (Đang được làm)',
                        'usage_notes' => 'Dùng để diễn tả hành động đang được thực hiện'
                    ],
                    [
                        'title' => 'Thể bị động của động từ nhóm II',
                        'explanation' => 'Động từ nhóm II: Bỏ る + られる',
                        'structure' => 'Vられる + ました',
                        'examples' => '教えられました (Đã được dạy)',
                        'usage_notes' => 'Dùng để diễn tả hành động đã được thực hiện'
                    ]
                ];
                break;

            case 2: // Thể sai khiến nâng cao
                $grammars = [
                    [
                        'title' => 'Thể sai khiến của động từ nhóm I',
                        'explanation' => 'Động từ nhóm I: う → わせる, く → かせる, ぐ → がせる, す → させる, つ → たせる, ぬ → なせる, む → ませる, る → らせる',
                        'structure' => 'Vさせる + てください',
                        'examples' => '作らせてください (Hãy để tôi làm)',
                        'usage_notes' => 'Dùng để yêu cầu cho phép làm gì'
                    ]
                ];
                break;

            default:
                $grammars = [
                    [
                        'title' => 'Ngữ pháp cơ bản N3',
                        'explanation' => 'Ngữ pháp cơ bản cho trình độ N3',
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
                'difficulty_level' => 3
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
                'question' => 'Chọn đáp án đúng cho câu hỏi N3 bài ' . $lesson->order,
                'options' => json_encode(['A', 'B', 'C', 'D']),
                'correct_answer' => 'A',
                'explanation' => 'Giải thích đáp án đúng',
                'points' => 15,
                'difficulty_level' => 3
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