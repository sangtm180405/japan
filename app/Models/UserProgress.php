<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'is_completed',
        'score',
        'total_questions',
        'correct_answers',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function getAccuracyPercentageAttribute()
    {
        if ($this->total_questions == 0) {
            return 0;
        }
        
        return round(($this->correct_answers / $this->total_questions) * 100, 2);
    }
}
