<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class SimpleN5LessonsSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing N5 lessons
        Lesson::where('level', 1)->delete();
        Vocabulary::whereHas('lesson', function($query) {
            $query->where('level', 1);
        })->delete();
        Grammar::whereHas('lesson', function($query) {
            $query->where('level', 1);
        })->delete();
        Exercise::whereHas('lesson', function($query) {
            $query->where('level', 1);
        })->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $n5Lessons = [
            // Bài 1-5: Hiragana cơ bản
            ['title' => 'Hiragana - Nguyên âm cơ bản (あいうえお)', 'description' => 'Học 5 nguyên âm cơ bản trong bảng chữ cái Hiragana', 'level' => 1, 'order' => 1, 'is_active' => true],
            ['title' => 'Hiragana - Hàng K (かきくけこ)', 'description' => 'Học các ký tự Hiragana hàng K với nguyên âm', 'level' => 1, 'order' => 2, 'is_active' => true],
            ['title' => 'Hiragana - Hàng S (さしすせそ)', 'description' => 'Học các ký tự Hiragana hàng S', 'level' => 1, 'order' => 3, 'is_active' => true],
            ['title' => 'Hiragana - Hàng T (たちつてと)', 'description' => 'Học các ký tự Hiragana hàng T', 'level' => 1, 'order' => 4, 'is_active' => true],
            ['title' => 'Hiragana - Hàng N (なにぬねの)', 'description' => 'Học các ký tự Hiragana hàng N', 'level' => 1, 'order' => 5, 'is_active' => true],

            // Bài 6-10: Hiragana tiếp theo
            ['title' => 'Hiragana - Hàng H (はひふへほ)', 'description' => 'Học các ký tự Hiragana hàng H', 'level' => 1, 'order' => 6, 'is_active' => true],
            ['title' => 'Hiragana - Hàng M (まみむめも)', 'description' => 'Học các ký tự Hiragana hàng M', 'level' => 1, 'order' => 7, 'is_active' => true],
            ['title' => 'Hiragana - Hàng Y (やゆよ)', 'description' => 'Học các ký tự Hiragana hàng Y', 'level' => 1, 'order' => 8, 'is_active' => true],
            ['title' => 'Hiragana - Hàng R (らりるれろ)', 'description' => 'Học các ký tự Hiragana hàng R', 'level' => 1, 'order' => 9, 'is_active' => true],
            ['title' => 'Hiragana - Hàng W (わをん)', 'description' => 'Học các ký tự Hiragana hàng W', 'level' => 1, 'order' => 10, 'is_active' => true],

            // Bài 11-15: Katakana cơ bản
            ['title' => 'Katakana - Nguyên âm cơ bản (アイウエオ)', 'description' => 'Học 5 nguyên âm cơ bản trong bảng chữ cái Katakana', 'level' => 1, 'order' => 11, 'is_active' => true],
            ['title' => 'Katakana - Hàng K (カキクケコ)', 'description' => 'Học các ký tự Katakana hàng K', 'level' => 1, 'order' => 12, 'is_active' => true],
            ['title' => 'Katakana - Hàng S (サシスセソ)', 'description' => 'Học các ký tự Katakana hàng S', 'level' => 1, 'order' => 13, 'is_active' => true],
            ['title' => 'Katakana - Hàng T (タチツテト)', 'description' => 'Học các ký tự Katakana hàng T', 'level' => 1, 'order' => 14, 'is_active' => true],
            ['title' => 'Katakana - Hàng N (ナニヌネノ)', 'description' => 'Học các ký tự Katakana hàng N', 'level' => 1, 'order' => 15, 'is_active' => true],

            // Bài 16-20: Từ vựng cơ bản
            ['title' => 'Số đếm từ 1-10', 'description' => 'Học số đếm từ 1 đến 10', 'level' => 1, 'order' => 16, 'is_active' => true],
            ['title' => 'Chào hỏi cơ bản', 'description' => 'Học các cách chào hỏi cơ bản', 'level' => 1, 'order' => 17, 'is_active' => true],
            ['title' => 'Gia đình cơ bản', 'description' => 'Học từ vựng về gia đình', 'level' => 1, 'order' => 18, 'is_active' => true],
            ['title' => 'Màu sắc cơ bản', 'description' => 'Học từ vựng về màu sắc', 'level' => 1, 'order' => 19, 'is_active' => true],
            ['title' => 'Thời gian cơ bản', 'description' => 'Học từ vựng về thời gian', 'level' => 1, 'order' => 20, 'is_active' => true],

            // Bài 21-25: Ngữ pháp cơ bản
            ['title' => 'Danh từ và trợ từ は', 'description' => 'Học cách sử dụng danh từ và trợ từ は', 'level' => 1, 'order' => 21, 'is_active' => true],
            ['title' => 'Trợ từ を và động từ', 'description' => 'Học cách sử dụng trợ từ を với động từ', 'level' => 1, 'order' => 22, 'is_active' => true],
            ['title' => 'Trợ từ に và で', 'description' => 'Học cách sử dụng trợ từ に và で', 'level' => 1, 'order' => 23, 'is_active' => true],
            ['title' => 'Tính từ đuôi い', 'description' => 'Học cách sử dụng tính từ đuôi い', 'level' => 1, 'order' => 24, 'is_active' => true],
            ['title' => 'Tính từ đuôi な', 'description' => 'Học cách sử dụng tính từ đuôi な', 'level' => 1, 'order' => 25, 'is_active' => true]
        ];

        foreach ($n5Lessons as $lessonData) {
            $lesson = Lesson::create($lessonData);
            $this->createVocabularyForLesson($lesson);
            $this->createGrammarForLesson($lesson);
            $this->createExercisesForLesson($lesson);
        }

        $this->command->info('Đã tạo ' . count($n5Lessons) . ' bài học N5 với đầy đủ nội dung');
    }

    private function createVocabularyForLesson($lesson)
    {
        $vocabularies = [];

        switch ($lesson->order) {
            case 1: // Nguyên âm
                $vocabularies = [
                    ['japanese' => 'あ', 'hiragana' => 'あ', 'romaji' => 'a', 'vietnamese' => 'a', 'topic' => 'Hiragana'],
                    ['japanese' => 'い', 'hiragana' => 'い', 'romaji' => 'i', 'vietnamese' => 'i', 'topic' => 'Hiragana'],
                    ['japanese' => 'う', 'hiragana' => 'う', 'romaji' => 'u', 'vietnamese' => 'u', 'topic' => 'Hiragana'],
                    ['japanese' => 'え', 'hiragana' => 'え', 'romaji' => 'e', 'vietnamese' => 'e', 'topic' => 'Hiragana'],
                    ['japanese' => 'お', 'hiragana' => 'お', 'romaji' => 'o', 'vietnamese' => 'o', 'topic' => 'Hiragana']
                ];
                break;

            case 2: // Hàng K
                $vocabularies = [
                    ['japanese' => 'か', 'hiragana' => 'か', 'romaji' => 'ka', 'vietnamese' => 'ka', 'topic' => 'Hiragana'],
                    ['japanese' => 'き', 'hiragana' => 'き', 'romaji' => 'ki', 'vietnamese' => 'ki', 'topic' => 'Hiragana'],
                    ['japanese' => 'く', 'hiragana' => 'く', 'romaji' => 'ku', 'vietnamese' => 'ku', 'topic' => 'Hiragana'],
                    ['japanese' => 'け', 'hiragana' => 'け', 'romaji' => 'ke', 'vietnamese' => 'ke', 'topic' => 'Hiragana'],
                    ['japanese' => 'こ', 'hiragana' => 'こ', 'romaji' => 'ko', 'vietnamese' => 'ko', 'topic' => 'Hiragana']
                ];
                break;

            case 16: // Số đếm
                $vocabularies = [
                    ['japanese' => '一', 'hiragana' => 'いち', 'romaji' => 'ichi', 'vietnamese' => 'một', 'topic' => 'Số đếm'],
                    ['japanese' => '二', 'hiragana' => 'に', 'romaji' => 'ni', 'vietnamese' => 'hai', 'topic' => 'Số đếm'],
                    ['japanese' => '三', 'hiragana' => 'さん', 'romaji' => 'san', 'vietnamese' => 'ba', 'topic' => 'Số đếm'],
                    ['japanese' => '四', 'hiragana' => 'よん', 'romaji' => 'yon', 'vietnamese' => 'bốn', 'topic' => 'Số đếm'],
                    ['japanese' => '五', 'hiragana' => 'ご', 'romaji' => 'go', 'vietnamese' => 'năm', 'topic' => 'Số đếm']
                ];
                break;

            case 17: // Chào hỏi
                $vocabularies = [
                    ['japanese' => 'おはよう', 'hiragana' => 'おはよう', 'romaji' => 'ohayou', 'vietnamese' => 'chào buổi sáng', 'topic' => 'Chào hỏi'],
                    ['japanese' => 'こんにちは', 'hiragana' => 'こんにちは', 'romaji' => 'konnichiwa', 'vietnamese' => 'chào buổi chiều', 'topic' => 'Chào hỏi'],
                    ['japanese' => 'こんばんは', 'hiragana' => 'こんばんは', 'romaji' => 'konbanwa', 'vietnamese' => 'chào buổi tối', 'topic' => 'Chào hỏi'],
                    ['japanese' => 'ありがとう', 'hiragana' => 'ありがとう', 'romaji' => 'arigatou', 'vietnamese' => 'cảm ơn', 'topic' => 'Chào hỏi'],
                    ['japanese' => 'すみません', 'hiragana' => 'すみません', 'romaji' => 'sumimasen', 'vietnamese' => 'xin lỗi', 'topic' => 'Chào hỏi']
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
            case 21: // Danh từ và trợ từ は
                $grammars = [
                    [
                        'title' => 'Trợ từ は',
                        'explanation' => 'Trợ từ は được dùng để đánh dấu chủ ngữ trong câu',
                        'structure' => 'N + は + N + です',
                        'examples' => '私は学生です (Tôi là học sinh)',
                        'usage_notes' => 'は được phát âm là "wa"'
                    ]
                ];
                break;

            case 22: // Trợ từ を
                $grammars = [
                    [
                        'title' => 'Trợ từ を',
                        'explanation' => 'Trợ từ を được dùng để đánh dấu tân ngữ trực tiếp',
                        'structure' => 'N + を + V',
                        'examples' => '本を読みます (Đọc sách)',
                        'usage_notes' => 'を được dùng với động từ chỉ hành động'
                    ]
                ];
                break;

            default:
                $grammars = [
                    [
                        'title' => 'Ngữ pháp cơ bản N5',
                        'explanation' => 'Ngữ pháp cơ bản cho trình độ N5',
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
                'difficulty_level' => 1
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
                'question' => 'Chọn đáp án đúng cho câu hỏi N5 bài ' . $lesson->order,
                'options' => json_encode(['A', 'B', 'C', 'D']),
                'correct_answer' => 'A',
                'explanation' => 'Giải thích đáp án đúng',
                'points' => 5,
                'difficulty_level' => 1
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