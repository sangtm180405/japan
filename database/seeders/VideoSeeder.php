<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\Lesson;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy các bài học đã có
        $lessons = Lesson::all();
        
        if ($lessons->count() == 0) {
            $this->command->info('Không có bài học nào. Vui lòng chạy StandardJapaneseLessonsSeeder trước.');
            return;
        }

        // Video cho bài học Hiragana (N5 - Bài 1)
        $lesson1 = $lessons->where('title', 'Hiragana - Nguyên âm và phụ âm cơ bản')->first();
        if ($lesson1) {
            Video::create([
                'lesson_id' => $lesson1->id,
                'title' => 'Học Hiragana cơ bản - Nguyên âm あいうえお',
                'description' => 'Video hướng dẫn học 5 nguyên âm cơ bản trong tiếng Nhật với cách phát âm chuẩn.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 600, // 10 phút
                'order' => 1,
                'is_active' => true,
            ]);

            Video::create([
                'lesson_id' => $lesson1->id,
                'title' => 'Học Hiragana - Phụ âm K (かきくけこ)',
                'description' => 'Video hướng dẫn học phụ âm K trong Hiragana với các ví dụ thực tế.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 480, // 8 phút
                'order' => 2,
                'is_active' => true,
            ]);
        }

        // Video cho bài học Số đếm (N5 - Bài 2)
        $lesson2 = $lessons->where('title', 'Số đếm từ 1-10')->first();
        if ($lesson2) {
            Video::create([
                'lesson_id' => $lesson2->id,
                'title' => 'Học số đếm tiếng Nhật từ 1-10',
                'description' => 'Video hướng dẫn cách đếm số từ 1 đến 10 trong tiếng Nhật với phát âm chuẩn.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 420, // 7 phút
                'order' => 1,
                'is_active' => true,
            ]);

            Video::create([
                'lesson_id' => $lesson2->id,
                'title' => 'Cách sử dụng số đếm trong câu',
                'description' => 'Video hướng dẫn cách sử dụng số đếm trong các câu tiếng Nhật thực tế.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 360, // 6 phút
                'order' => 2,
                'is_active' => true,
            ]);
        }

        // Video cho bài học Chào hỏi (N5 - Bài 3)
        $lesson3 = $lessons->where('title', 'Chào hỏi cơ bản')->first();
        if ($lesson3) {
            Video::create([
                'lesson_id' => $lesson3->id,
                'title' => 'Cách chào hỏi trong tiếng Nhật',
                'description' => 'Video hướng dẫn các cách chào hỏi cơ bản theo thời gian trong ngày.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 540, // 9 phút
                'order' => 1,
                'is_active' => true,
            ]);

            Video::create([
                'lesson_id' => $lesson3->id,
                'title' => 'Luyện tập hội thoại chào hỏi',
                'description' => 'Video luyện tập các tình huống chào hỏi thực tế trong cuộc sống.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 480, // 8 phút
                'order' => 2,
                'is_active' => true,
            ]);
        }

        // Video cho bài học Động từ (N4 - Bài 1)
        $lesson4 = $lessons->where('title', 'Động từ cơ bản - Thể từ điển')->first();
        if ($lesson4) {
            Video::create([
                'lesson_id' => $lesson4->id,
                'title' => 'Động từ cơ bản trong tiếng Nhật',
                'description' => 'Video giới thiệu các động từ cơ bản và cách sử dụng thể từ điển.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 720, // 12 phút
                'order' => 1,
                'is_active' => true,
            ]);

            Video::create([
                'lesson_id' => $lesson4->id,
                'title' => 'Luyện tập với động từ',
                'description' => 'Video luyện tập sử dụng động từ trong các câu ví dụ thực tế.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 600, // 10 phút
                'order' => 2,
                'is_active' => true,
            ]);
        }

        // Video cho bài học Tính từ (N4 - Bài 2)
        $lesson5 = $lessons->where('title', 'Tính từ - Tính từ đuôi い và な')->first();
        if ($lesson5) {
            Video::create([
                'lesson_id' => $lesson5->id,
                'title' => 'Tính từ đuôi い và な trong tiếng Nhật',
                'description' => 'Video giải thích sự khác biệt giữa tính từ đuôi い và な.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 660, // 11 phút
                'order' => 1,
                'is_active' => true,
            ]);

            Video::create([
                'lesson_id' => $lesson5->id,
                'title' => 'Luyện tập với tính từ',
                'description' => 'Video luyện tập sử dụng tính từ trong các câu ví dụ.',
                'video_url' => 'https://www.youtube.com/watch?v=8IpHiUxgNqg',
                'type' => 'youtube',
                'duration' => 540, // 9 phút
                'order' => 2,
                'is_active' => true,
            ]);
        }

        $this->command->info('Đã tạo ' . Video::count() . ' video học tập.');
    }
}
