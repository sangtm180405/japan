<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;

class BackfillVocabularyTopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map lesson titles to topic names (simple heuristic)
        $mappings = [
            'Hiragana' => 'Bảng chữ cái',
            'Katakana' => 'Bảng chữ cái',
            'Số đếm' => 'Số đếm',
            'Chào hỏi' => 'Chào hỏi',
            'Động từ' => 'Động từ cơ bản',
            'Tính từ' => 'Tính từ cơ bản',
            'gia đình' => 'Gia đình',
            'Màu sắc' => 'Màu sắc',
            'Thời gian' => 'Thời gian & Ngày tháng',
            'Thức ăn' => 'Thức ăn & Đồ uống',
            'Nghề nghiệp' => 'Nghề nghiệp',
            'Địa điểm' => 'Địa điểm & Phương hướng',
            'Thời tiết' => 'Thời tiết & Mùa',
            'Cảm xúc' => 'Cảm xúc & Tính cách',
            'Thể thao' => 'Thể thao & Hoạt động',
        ];

        $lessons = Lesson::all(['id', 'title']);

        foreach ($lessons as $lesson) {
            $topic = null;
            foreach ($mappings as $needle => $mappedTopic) {
                if (mb_stripos($lesson->title, $needle) !== false) {
                    $topic = $mappedTopic;
                    break;
                }
            }

            if ($topic) {
                Vocabulary::where('lesson_id', $lesson->id)
                    ->whereNull('topic')
                    ->update(['topic' => $topic]);
            }
        }
    }
}


