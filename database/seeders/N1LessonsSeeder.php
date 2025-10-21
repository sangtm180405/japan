<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class N1LessonsSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing N1 lessons
        Lesson::where('level', 5)->delete();
        Vocabulary::whereHas('lesson', function($query) {
            $query->where('level', 5);
        })->delete();
        Grammar::whereHas('lesson', function($query) {
            $query->where('level', 5);
        })->delete();
        Exercise::whereHas('lesson', function($query) {
            $query->where('level', 5);
        })->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $n1Lessons = [
            // Bài 1-5: N1 Cơ bản
            ['title' => 'N1 - Kính ngữ cao cấp', 'description' => 'Học cách sử dụng kính ngữ cao cấp', 'level' => 5, 'order' => 1, 'is_active' => true],
            ['title' => 'N1 - Thể khiêm tốn cao cấp', 'description' => 'Học cách sử dụng thể khiêm tốn cao cấp', 'level' => 5, 'order' => 2, 'is_active' => true],
            ['title' => 'N1 - Ngữ pháp cao cấp', 'description' => 'Học ngữ pháp cao cấp N1', 'level' => 5, 'order' => 3, 'is_active' => true],
            ['title' => 'N1 - Từ vựng học thuật', 'description' => 'Học từ vựng học thuật N1', 'level' => 5, 'order' => 4, 'is_active' => true],
            ['title' => 'N1 - Từ vựng chuyên ngành', 'description' => 'Học từ vựng chuyên ngành N1', 'level' => 5, 'order' => 5, 'is_active' => true],
            // Bài 6-10: N1 Trung cấp
            ['title' => 'N1 - Văn học cổ điển', 'description' => 'Học từ vựng về văn học cổ điển', 'level' => 5, 'order' => 6, 'is_active' => true],
            ['title' => 'N1 - Triết học Đông Tây', 'description' => 'Học từ vựng về triết học Đông Tây', 'level' => 5, 'order' => 7, 'is_active' => true],
            ['title' => 'N1 - Khoa học tự nhiên', 'description' => 'Học từ vựng về khoa học tự nhiên', 'level' => 5, 'order' => 8, 'is_active' => true],
            ['title' => 'N1 - Khoa học xã hội', 'description' => 'Học từ vựng về khoa học xã hội', 'level' => 5, 'order' => 9, 'is_active' => true],
            ['title' => 'N1 - Nghệ thuật và thẩm mỹ', 'description' => 'Học từ vựng về nghệ thuật và thẩm mỹ', 'level' => 5, 'order' => 10, 'is_active' => true],
            // Bài 11-15: N1 Nâng cao
            ['title' => 'N1 - Chính trị quốc tế', 'description' => 'Học từ vựng về chính trị quốc tế', 'level' => 5, 'order' => 11, 'is_active' => true],
            ['title' => 'N1 - Kinh tế toàn cầu', 'description' => 'Học từ vựng về kinh tế toàn cầu', 'level' => 5, 'order' => 12, 'is_active' => true],
            ['title' => 'N1 - Công nghệ tiên tiến', 'description' => 'Học từ vựng về công nghệ tiên tiến', 'level' => 5, 'order' => 13, 'is_active' => true],
            ['title' => 'N1 - Môi trường và khí hậu', 'description' => 'Học từ vựng về môi trường và khí hậu', 'level' => 5, 'order' => 14, 'is_active' => true],
            ['title' => 'N1 - Y học hiện đại', 'description' => 'Học từ vựng về y học hiện đại', 'level' => 5, 'order' => 15, 'is_active' => true],
            // Bài 16-20: N1 Thực hành
            ['title' => 'N1 - Đọc hiểu cao cấp', 'description' => 'Luyện tập đọc hiểu cao cấp N1', 'level' => 5, 'order' => 16, 'is_active' => true],
            ['title' => 'N1 - Nghe hiểu cao cấp', 'description' => 'Luyện tập nghe hiểu cao cấp N1', 'level' => 5, 'order' => 17, 'is_active' => true],
            ['title' => 'N1 - Viết luận cao cấp', 'description' => 'Học cách viết luận cao cấp N1', 'level' => 5, 'order' => 18, 'is_active' => true],
            ['title' => 'N1 - Hội thoại chuyên gia', 'description' => 'Luyện tập hội thoại chuyên gia N1', 'level' => 5, 'order' => 19, 'is_active' => true],
            ['title' => 'N1 - Tổng hợp và ôn tập', 'description' => 'Tổng hợp và ôn tập toàn bộ kiến thức N1', 'level' => 5, 'order' => 20, 'is_active' => true]
        ];

        foreach ($n1Lessons as $lessonData) {
            $lesson = Lesson::create($lessonData);
            $this->createVocabularyForLesson($lesson);
            $this->createGrammarForLesson($lesson);
            $this->createExercisesForLesson($lesson);
        }

        $this->command->info('Đã tạo ' . count($n1Lessons) . ' bài học N1 với đầy đủ nội dung');
    }

    private function createVocabularyForLesson($lesson)
    {
        $vocabularies = [
            ['japanese' => '例', 'hiragana' => 'れい', 'romaji' => 'rei', 'vietnamese' => 'ví dụ', 'topic' => 'Danh từ'],
            ['japanese' => '練習', 'hiragana' => 'れんしゅう', 'romaji' => 'renshuu', 'vietnamese' => 'luyện tập', 'topic' => 'Danh từ'],
            ['japanese' => '勉強', 'hiragana' => 'べんきょう', 'romaji' => 'benkyou', 'vietnamese' => 'học tập', 'topic' => 'Danh từ'],
            ['japanese' => '仕事', 'hiragana' => 'しごと', 'romaji' => 'shigoto', 'vietnamese' => 'công việc', 'topic' => 'Danh từ'],
            ['japanese' => '生活', 'hiragana' => 'せいかつ', 'romaji' => 'seikatsu', 'vietnamese' => 'cuộc sống', 'topic' => 'Danh từ']
        ];

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
        $grammars = [
            [
                'title' => 'Ngữ pháp cơ bản N1',
                'explanation' => 'Ngữ pháp cơ bản cho trình độ N1',
                'structure' => 'Cấu trúc câu cơ bản',
                'examples' => 'Ví dụ sử dụng',
                'usage_notes' => 'Lưu ý sử dụng'
            ]
        ];

        foreach ($grammars as $grammar) {
            Grammar::create([
                'lesson_id' => $lesson->id,
                'title' => $grammar['title'],
                'explanation' => $grammar['explanation'],
                'structure' => $grammar['structure'],
                'examples' => $grammar['examples'],
                'usage_notes' => $grammar['usage_notes'],
                'difficulty_level' => 5
            ]);
        }
    }

    private function createExercisesForLesson($lesson)
    {
        $exercises = [];

        for ($i = 1; $i <= 3; $i++) {
            $exercises[] = [
                'type' => 'multiple_choice',
                'question' => 'Chọn đáp án đúng cho câu hỏi N1 bài ' . $lesson->order,
                'options' => json_encode(['A', 'B', 'C', 'D']),
                'correct_answer' => 'A',
                'explanation' => 'Giải thích đáp án đúng',
                'points' => 25,
                'difficulty_level' => 5
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