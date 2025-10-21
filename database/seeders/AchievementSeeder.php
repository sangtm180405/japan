<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        $achievements = [
            // Lesson achievements
            [
                'name' => 'Bắt đầu hành trình',
                'description' => 'Hoàn thành bài học đầu tiên',
                'icon' => 'fas fa-play',
                'type' => 'lesson',
                'requirement' => 1,
                'points' => 10
            ],
            [
                'name' => 'Học viên chăm chỉ',
                'description' => 'Hoàn thành 5 bài học',
                'icon' => 'fas fa-book',
                'type' => 'lesson',
                'requirement' => 5,
                'points' => 50
            ],
            [
                'name' => 'Chuyên gia N5',
                'description' => 'Hoàn thành tất cả bài học N5',
                'icon' => 'fas fa-trophy',
                'type' => 'lesson',
                'requirement' => 25,
                'points' => 200
            ],
            
            // Streak achievements
            [
                'name' => 'Ngày đầu tiên',
                'description' => 'Học liên tục 1 ngày',
                'icon' => 'fas fa-calendar-day',
                'type' => 'streak',
                'requirement' => 1,
                'points' => 5
            ],
            [
                'name' => 'Tuần học tập',
                'description' => 'Học liên tục 7 ngày',
                'icon' => 'fas fa-calendar-week',
                'type' => 'streak',
                'requirement' => 7,
                'points' => 100
            ],
            [
                'name' => 'Tháng kiên trì',
                'description' => 'Học liên tục 30 ngày',
                'icon' => 'fas fa-calendar-alt',
                'type' => 'streak',
                'requirement' => 30,
                'points' => 500
            ],
            
            // Score achievements
            [
                'name' => 'Điểm cao đầu tiên',
                'description' => 'Đạt 100 điểm',
                'icon' => 'fas fa-star',
                'type' => 'score',
                'requirement' => 100,
                'points' => 20
            ],
            [
                'name' => 'Thiên tài học tập',
                'description' => 'Đạt 1000 điểm',
                'icon' => 'fas fa-gem',
                'type' => 'score',
                'requirement' => 1000,
                'points' => 300
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
