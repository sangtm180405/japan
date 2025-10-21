<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lesson;
use App\Models\UserProgress;
use App\Models\Exercise;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Display analytics dashboard
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Cache analytics data for 30 minutes
        $analytics = Cache::remember('analytics_' . $user->id, 1800, function () use ($user) {
            return $this->getAnalyticsData($user);
        });

        return view('analytics.index', compact('analytics'));
    }

    /**
     * Get learning progress analytics
     */
    public function getProgressAnalytics()
    {
        $user = Auth::user();
        
        $progress = Cache::remember('progress_analytics_' . $user->id, 1800, function () use ($user) {
            return $this->getProgressData($user);
        });

        return response()->json($progress);
    }

    /**
     * Get performance analytics
     */
    public function getPerformanceAnalytics()
    {
        $user = Auth::user();
        
        $performance = Cache::remember('performance_analytics_' . $user->id, 1800, function () use ($user) {
            return $this->getPerformanceData($user);
        });

        return response()->json($performance);
    }

    /**
     * Get learning streak analytics
     */
    public function getStreakAnalytics()
    {
        $user = Auth::user();
        
        $streak = Cache::remember('streak_analytics_' . $user->id, 1800, function () use ($user) {
            return $this->getStreakData($user);
        });

        return response()->json($streak);
    }

    /**
     * Get comprehensive analytics data
     */
    private function getAnalyticsData(User $user)
    {
        return [
            'overview' => $this->getOverviewData($user),
            'progress' => $this->getProgressData($user),
            'performance' => $this->getPerformanceData($user),
            'streak' => $this->getStreakData($user),
            'level_distribution' => $this->getLevelDistribution($user),
            'recent_activity' => $this->getRecentActivity($user)
        ];
    }

    /**
     * Get overview statistics
     */
    private function getOverviewData(User $user)
    {
        $totalLessons = Lesson::where('is_active', true)->count();
        $completedLessons = $user->progress()->where('is_completed', true)->count();
        $totalScore = $user->total_score ?? 0;
        $averageScore = $user->progress()->where('is_completed', true)->avg('score') ?? 0;

        return [
            'total_lessons' => $totalLessons,
            'completed_lessons' => $completedLessons,
            'completion_rate' => $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100, 2) : 0,
            'total_score' => $totalScore,
            'average_score' => round($averageScore, 2),
            'current_level' => $this->getCurrentLevel($user),
            'next_level_progress' => $this->getNextLevelProgress($user)
        ];
    }

    /**
     * Get progress data
     */
    private function getProgressData(User $user)
    {
        $progressByLevel = $user->progress()
            ->join('lessons', 'user_progress.lesson_id', '=', 'lessons.id')
            ->select('lessons.level', DB::raw('COUNT(*) as total'), DB::raw('SUM(CASE WHEN is_completed = 1 THEN 1 ELSE 0 END) as completed'))
            ->groupBy('lessons.level')
            ->orderBy('lessons.level')
            ->get();

        $weeklyProgress = $user->progress()
            ->where('created_at', '>=', now()->subWeeks(4))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as lessons'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'by_level' => $progressByLevel,
            'weekly_progress' => $weeklyProgress,
            'total_study_time' => $this->calculateStudyTime($user)
        ];
    }

    /**
     * Get performance data
     */
    private function getPerformanceData(User $user)
    {
        $exerciseStats = UserAnswer::where('user_id', $user->id)
            ->select(
                DB::raw('COUNT(*) as total_attempts'),
                DB::raw('SUM(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) as correct_answers'),
                DB::raw('AVG(CASE WHEN is_correct = 1 THEN points_earned ELSE 0 END) as average_points')
            )
            ->first();

        $accuracyRate = $exerciseStats->total_attempts > 0 
            ? round(($exerciseStats->correct_answers / $exerciseStats->total_attempts) * 100, 2) 
            : 0;

        $difficultyPerformance = UserAnswer::join('exercises', 'user_answers.exercise_id', '=', 'exercises.id')
            ->where('user_answers.user_id', $user->id)
            ->select('exercises.difficulty_level', DB::raw('AVG(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) as accuracy'))
            ->groupBy('exercises.difficulty_level')
            ->orderBy('exercises.difficulty_level')
            ->get();

        return [
            'total_attempts' => $exerciseStats->total_attempts ?? 0,
            'correct_answers' => $exerciseStats->correct_answers ?? 0,
            'accuracy_rate' => $accuracyRate,
            'average_points' => round($exerciseStats->average_points ?? 0, 2),
            'by_difficulty' => $difficultyPerformance
        ];
    }

    /**
     * Get streak data
     */
    private function getStreakData(User $user)
    {
        $currentStreak = $this->calculateCurrentStreak($user);
        $longestStreak = $this->calculateLongestStreak($user);
        $studyDays = $this->getStudyDays($user);

        return [
            'current_streak' => $currentStreak,
            'longest_streak' => $longestStreak,
            'study_days' => $studyDays,
            'streak_goal' => 30, // 30-day streak goal
            'streak_progress' => min(($currentStreak / 30) * 100, 100)
        ];
    }

    /**
     * Get level distribution
     */
    private function getLevelDistribution(User $user)
    {
        return $user->progress()
            ->join('lessons', 'user_progress.lesson_id', '=', 'lessons.id')
            ->select('lessons.level', DB::raw('COUNT(*) as count'))
            ->groupBy('lessons.level')
            ->orderBy('lessons.level')
            ->get()
            ->pluck('count', 'level');
    }

    /**
     * Get recent activity
     */
    private function getRecentActivity(User $user)
    {
        return $user->progress()
            ->with('lesson')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Calculate current streak
     */
    private function calculateCurrentStreak(User $user)
    {
        $studyDays = $user->progress()
            ->select(DB::raw('DATE(created_at) as study_date'))
            ->distinct()
            ->orderBy('study_date', 'desc')
            ->pluck('study_date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date);
            });

        $streak = 0;
        $currentDate = now()->startOfDay();

        foreach ($studyDays as $studyDate) {
            if ($studyDate->isSameDay($currentDate) || $studyDate->isSameDay($currentDate->subDay())) {
                $streak++;
                $currentDate = $studyDate;
            } else {
                break;
            }
        }

        return $streak;
    }

    /**
     * Calculate longest streak
     */
    private function calculateLongestStreak(User $user)
    {
        $studyDays = $user->progress()
            ->select(DB::raw('DATE(created_at) as study_date'))
            ->distinct()
            ->orderBy('study_date')
            ->pluck('study_date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date);
            });

        $maxStreak = 0;
        $currentStreak = 0;
        $previousDay = null;

        foreach ($studyDays as $studyDay) {
            if ($previousDay === null || $studyDay->diffInDays($previousDay) === 1) {
                $currentStreak++;
            } else {
                $maxStreak = max($maxStreak, $currentStreak);
                $currentStreak = 1;
            }
            $previousDay = $studyDay;
        }

        return max($maxStreak, $currentStreak);
    }

    /**
     * Get study days count
     */
    private function getStudyDays(User $user)
    {
        return $user->progress()
            ->select(DB::raw('DATE(created_at) as study_date'))
            ->distinct()
            ->count();
    }

    /**
     * Calculate total study time (in minutes)
     */
    private function calculateStudyTime(User $user)
    {
        // Estimate 10 minutes per lesson
        $completedLessons = $user->progress()->where('is_completed', true)->count();
        return $completedLessons * 10;
    }

    /**
     * Get current level based on progress
     */
    private function getCurrentLevel(User $user)
    {
        $completedLessons = $user->progress()->where('is_completed', true)->count();
        
        if ($completedLessons >= 100) return 'N1';
        if ($completedLessons >= 80) return 'N2';
        if ($completedLessons >= 60) return 'N3';
        if ($completedLessons >= 40) return 'N4';
        if ($completedLessons >= 20) return 'N5';
        
        return 'Beginner';
    }

    /**
     * Get next level progress
     */
    private function getNextLevelProgress(User $user)
    {
        $completedLessons = $user->progress()->where('is_completed', true)->count();
        
        if ($completedLessons < 20) {
            return ['level' => 'N5', 'progress' => ($completedLessons / 20) * 100];
        } elseif ($completedLessons < 40) {
            return ['level' => 'N4', 'progress' => (($completedLessons - 20) / 20) * 100];
        } elseif ($completedLessons < 60) {
            return ['level' => 'N3', 'progress' => (($completedLessons - 40) / 20) * 100];
        } elseif ($completedLessons < 80) {
            return ['level' => 'N2', 'progress' => (($completedLessons - 60) / 20) * 100];
        } elseif ($completedLessons < 100) {
            return ['level' => 'N1', 'progress' => (($completedLessons - 80) / 20) * 100];
        }
        
        return ['level' => 'Master', 'progress' => 100];
    }
}