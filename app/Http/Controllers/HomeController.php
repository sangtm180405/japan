<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Cache lessons for 1 hour
        $lessons = Cache::remember('lessons_active', 3600, function () {
            return Lesson::where('is_active', true)
                ->orderBy('level')
                ->orderBy('order')
                ->get()
                ->groupBy('level');
        });

        $userProgress = collect();
        if (Auth::check()) {
            // Cache user progress for 30 minutes
            $userProgress = Cache::remember('user_progress_' . Auth::id(), 1800, function () {
                return UserProgress::where('user_id', Auth::id())
                    ->get()
                    ->keyBy('lesson_id');
            });
        }

        return view('home', compact('lessons', 'userProgress'));
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Cache recent progress for 15 minutes
        $recentProgress = Cache::remember('recent_progress_' . $user->id, 900, function () use ($user) {
            return $user->progress()
                ->with('lesson')
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
        });

        // Cache stats for 1 hour
        $stats = Cache::remember('dashboard_stats_' . $user->id, 3600, function () use ($user) {
            return [
                'total_score' => $user->total_score,
                'completed_lessons' => $user->completed_lessons_count,
                'total_lessons' => Lesson::where('is_active', true)->count(),
            ];
        });

        return view('dashboard', compact('user', 'recentProgress', 'stats'));
    }
}
