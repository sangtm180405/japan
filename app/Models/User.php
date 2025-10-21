<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function answers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    public function getTotalScoreAttribute()
    {
        return $this->progress()->sum('score');
    }

    public function getCompletedLessonsCountAttribute()
    {
        return $this->progress()->where('is_completed', true)->count();
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function hasEnrollment($courseType)
    {
        return $this->enrollments()
            ->where('course_type', $courseType)
            ->where('status', 'active')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    public function canAccessLesson($lesson)
    {
        // Premium users can access all lessons
        if ($this->hasEnrollment('premium')) {
            return true;
        }

        // Level-specific enrollments
        $levelCourses = [
            1 => 'n5',
            2 => 'n4', 
            3 => 'n3',
            4 => 'n2',
            5 => 'n1'
        ];

        $requiredCourse = $levelCourses[$lesson->level] ?? null;
        if ($requiredCourse) {
            return $this->hasEnrollment($requiredCourse);
        }

        return false;
    }

    public function getStreakAttribute()
    {
        // Calculate current streak
        $lastProgress = $this->progress()
            ->where('is_completed', true)
            ->orderBy('completed_at', 'desc')
            ->first();
            
        if (!$lastProgress) return 0;
        
        $streak = 1;
        $currentDate = $lastProgress->completed_at->startOfDay();
        
        while (true) {
            $previousDate = $currentDate->copy()->subDay();
            $hasProgress = $this->progress()
                ->where('is_completed', true)
                ->whereDate('completed_at', $previousDate)
                ->exists();
                
            if (!$hasProgress) break;
            
            $streak++;
            $currentDate = $previousDate;
        }
        
        return $streak;
    }
}
