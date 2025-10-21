<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompleteJLPTSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Bắt đầu tạo nội dung JLPT đầy đủ...');
        
        // N5 (đã có)
        $this->command->info('Đang tạo nội dung N5...');
        $this->call(SimpleN5LessonsSeeder::class);
        
        // N4
        $this->command->info('Đang tạo nội dung N4...');
        $this->call(N4LessonsSeeder::class);
        
        // N3
        $this->command->info('Đang tạo nội dung N3...');
        $this->call(N3LessonsSeeder::class);
        
        // N2
        $this->command->info('Đang tạo nội dung N2...');
        $this->call(N2LessonsSeeder::class);
        
        // N1
        $this->command->info('Đang tạo nội dung N1...');
        $this->call(N1LessonsSeeder::class);
        
        // Achievements
        $this->command->info('Đang tạo achievements...');
        $this->call(AchievementSeeder::class);
        
        $this->command->info('✅ Hoàn thành tạo nội dung JLPT đầy đủ!');
        $this->command->info('📊 Thống kê:');
        $this->command->info('- N5: 25 bài học');
        $this->command->info('- N4: 20 bài học');
        $this->command->info('- N3: 20 bài học');
        $this->command->info('- N2: 20 bài học');
        $this->command->info('- N1: 20 bài học');
        $this->command->info('- Tổng cộng: 105 bài học');
    }
}
