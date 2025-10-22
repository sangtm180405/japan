<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeningExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'level',
        'audio_file',
        'transcript',
        'transcript_romaji',
        'transcript_english',
        'transcript_vietnamese',
        'duration',
        'difficulty_level',
        'questions',
        'correct_answers',
        'points',
        'is_active'
    ];

    protected $casts = [
        'questions' => 'array',
        'correct_answers' => 'array',
        'is_active' => 'boolean',
    ];

    public function getLevelNameAttribute()
    {
        $levels = [
            1 => 'N5',
            2 => 'N4', 
            3 => 'N3',
            4 => 'N2',
            5 => 'N1'
        ];
        
        return $levels[$this->level] ?? 'Unknown';
    }

    public function getDifficultyNameAttribute()
    {
        $difficulties = [
            1 => 'Rất dễ',
            2 => 'Dễ',
            3 => 'Trung bình',
            4 => 'Khó',
            5 => 'Rất khó'
        ];
        
        return $difficulties[$this->difficulty_level] ?? 'Unknown';
    }

    public function getFormattedDurationAttribute()
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        
        if ($minutes > 0) {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
        
        return sprintf('%d giây', $seconds);
    }
}
