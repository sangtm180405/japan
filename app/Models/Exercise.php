<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'type',
        'question',
        'options',
        'correct_answer',
        'explanation',
        'audio_file',
        'points',
        'difficulty_level'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    public function getTypeNameAttribute()
    {
        $types = [
            'multiple_choice' => 'Trắc nghiệm',
            'fill_blank' => 'Điền từ',
            'translation' => 'Dịch thuật',
            'listening' => 'Nghe hiểu'
        ];
        
        return $types[$this->type] ?? 'Unknown';
    }
}
