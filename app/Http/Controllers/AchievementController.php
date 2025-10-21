<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $achievements = Achievement::where('is_active', true)->get();
        $userAchievements = $user->achievements()->pluck('achievement_id')->toArray();
        
        return view('achievements.index', compact('achievements', 'userAchievements'));
    }

    public function checkAchievements(User $user)
    {
        $newAchievements = [];
        
        // Check lesson achievements
        $completedLessons = $user->completed_lessons_count;
        $lessonAchievements = Achievement::where('type', 'lesson')
            ->where('is_active', true)
            ->where('requirement', '<=', $completedLessons)
            ->get();
            
        foreach ($lessonAchievements as $achievement) {
            if (!$user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                $user->achievements()->attach($achievement->id, ['earned_at' => now()]);
                $newAchievements[] = $achievement;
            }
        }
        
        // Check streak achievements
        $streak = $user->streak;
        $streakAchievements = Achievement::where('type', 'streak')
            ->where('is_active', true)
            ->where('requirement', '<=', $streak)
            ->get();
            
        foreach ($streakAchievements as $achievement) {
            if (!$user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                $user->achievements()->attach($achievement->id, ['earned_at' => now()]);
                $newAchievements[] = $achievement;
            }
        }
        
        // Check score achievements
        $totalScore = $user->total_score;
        $scoreAchievements = Achievement::where('type', 'score')
            ->where('is_active', true)
            ->where('requirement', '<=', $totalScore)
            ->get();
            
        foreach ($scoreAchievements as $achievement) {
            if (!$user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                $user->achievements()->attach($achievement->id, ['earned_at' => now()]);
                $newAchievements[] = $achievement;
            }
        }
        
        return $newAchievements;
    }
}
