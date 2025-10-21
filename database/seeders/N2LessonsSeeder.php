<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class N2LessonsSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing N2 lessons
        Lesson::where('level', 4)->delete();
        Vocabulary::whereHas('lesson', function($query) {
            $query->where('level', 4);
        })->delete();
        Grammar::whereHas('lesson', function($query) {
            $query->where('level', 4);
        })->delete();
        Exercise::whereHas('lesson', function($query) {
            $query->where('level', 4);
        })->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $n2Lessons = [
            // Bài 1-5: N2 Cơ bản
            ['title' => 'N2 - Kính ngữ nâng cao', 'description' => 'Học cách sử dụng kính ngữ nâng cao', 'level' => 4, 'order' => 1, 'is_active' => true],
            ['title' => 'N2 - Thể khiêm tốn nâng cao', 'description' => 'Học cách sử dụng thể khiêm tốn nâng cao', 'level' => 4, 'order' => 2, 'is_active' => true],
            ['title' => 'N2 - Điều kiện phức tạp nâng cao', 'description' => 'Học các điều kiện phức tạp nâng cao', 'level' => 4, 'order' => 3, 'is_active' => true],
            ['title' => 'N2 - Thể giả định', 'description' => 'Học cách sử dụng thể giả định', 'level' => 4, 'order' => 4, 'is_active' => true],
            ['title' => 'N2 - Thể liên tiếp', 'description' => 'Học cách sử dụng thể liên tiếp', 'level' => 4, 'order' => 5, 'is_active' => true],
            // Bài 6-10: N2 Trung cấp
            ['title' => 'N2 - Văn học và nghệ thuật', 'description' => 'Học từ vựng về văn học và nghệ thuật', 'level' => 4, 'order' => 6, 'is_active' => true],
            ['title' => 'N2 - Khoa học và nghiên cứu', 'description' => 'Học từ vựng về khoa học và nghiên cứu', 'level' => 4, 'order' => 7, 'is_active' => true],
            ['title' => 'N2 - Chính trị và xã hội', 'description' => 'Học từ vựng về chính trị và xã hội', 'level' => 4, 'order' => 8, 'is_active' => true],
            ['title' => 'N2 - Kinh tế và tài chính', 'description' => 'Học từ vựng về kinh tế và tài chính', 'level' => 4, 'order' => 9, 'is_active' => true],
            ['title' => 'N2 - Công nghệ và kỹ thuật', 'description' => 'Học từ vựng về công nghệ và kỹ thuật', 'level' => 4, 'order' => 10, 'is_active' => true],
            // Bài 11-15: N2 Nâng cao
            ['title' => 'N2 - Triết học và tư tưởng', 'description' => 'Học từ vựng về triết học và tư tưởng', 'level' => 4, 'order' => 11, 'is_active' => true],
            ['title' => 'N2 - Lịch sử và văn hóa', 'description' => 'Học từ vựng về lịch sử và văn hóa', 'level' => 4, 'order' => 12, 'is_active' => true],
            ['title' => 'N2 - Tâm lý và xã hội học', 'description' => 'Học từ vựng về tâm lý và xã hội học', 'level' => 4, 'order' => 13, 'is_active' => true],
            ['title' => 'N2 - Y học và sức khỏe', 'description' => 'Học từ vựng về y học và sức khỏe', 'level' => 4, 'order' => 14, 'is_active' => true],
            ['title' => 'N2 - Pháp luật và quy định', 'description' => 'Học từ vựng về pháp luật và quy định', 'level' => 4, 'order' => 15, 'is_active' => true],
            // Bài 16-20: N2 Thực hành
            ['title' => 'N2 - Đọc hiểu nâng cao', 'description' => 'Luyện tập đọc hiểu nâng cao N2', 'level' => 4, 'order' => 16, 'is_active' => true],
            ['title' => 'N2 - Nghe hiểu nâng cao', 'description' => 'Luyện tập nghe hiểu nâng cao N2', 'level' => 4, 'order' => 17, 'is_active' => true],
            ['title' => 'N2 - Viết luận nâng cao', 'description' => 'Học cách viết luận nâng cao N2', 'level' => 4, 'order' => 18, 'is_active' => true],
            ['title' => 'N2 - Hội thoại chuyên nghiệp', 'description' => 'Luyện tập hội thoại chuyên nghiệp N2', 'level' => 4, 'order' => 19, 'is_active' => true],
            ['title' => 'N2 - Tổng hợp và ôn tập', 'description' => 'Tổng hợp và ôn tập toàn bộ kiến thức N2', 'level' => 4, 'order' => 20, 'is_active' => true]
        ];

        foreach ($n2Lessons as $lessonData) {
            $lesson = Lesson::create($lessonData);
            $this->createVocabularyForLesson($lesson);
            $this->createGrammarForLesson($lesson);
            $this->createExercisesForLesson($lesson);
        }

        $this->command->info('Đã tạo ' . count($n2Lessons) . ' bài học N2 với đầy đủ nội dung');
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
                'title' => 'Ngữ pháp cơ bản N2',
                'explanation' => 'Ngữ pháp cơ bản cho trình độ N2',
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
                'difficulty_level' => 4
            ]);
        }
    }

    private function createExercisesForLesson($lesson)
    {
        $exercises = [];

        for ($i = 1; $i <= 3; $i++) {
            $exercises[] = [
                'type' => 'multiple_choice',
                'question' => 'Chọn đáp án đúng cho câu hỏi N2 bài ' . $lesson->order,
                'options' => json_encode(['A', 'B', 'C', 'D']),
                'correct_answer' => 'A',
                'explanation' => 'Giải thích đáp án đúng',
                'points' => 20,
                'difficulty_level' => 4
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