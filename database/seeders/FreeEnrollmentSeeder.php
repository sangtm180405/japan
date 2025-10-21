<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CourseEnrollment;

class FreeEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Give all existing users free enrollment
        $users = User::all();
        
        foreach ($users as $user) {
            // Check if user already has free enrollment
            if (!$user->hasEnrollment('free')) {
                CourseEnrollment::create([
                    'user_id' => $user->id,
                    'course_type' => 'free',
                    'status' => 'active',
                    'enrolled_at' => now(),
                    'expires_at' => null // Free enrollment never expires
                ]);
            }
        }
        
        $this->command->info('Free enrollments created for ' . $users->count() . ' users');
    }
}
