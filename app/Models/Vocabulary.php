<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'japanese',
        'hiragana',
        'katakana',
        'kanji',
        'romaji',
        'vietnamese',
        'english',
        'example_sentence',
        'example_translation',
        'audio_file',
        'difficulty_level',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function getDisplayTextAttribute()
    {
        $text = $this->japanese;
        if ($this->kanji) {
            $text .= " ({$this->kanji})";
        }
        return $text;
    }
}
