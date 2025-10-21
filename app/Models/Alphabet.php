<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alphabet extends Model
{
    use HasFactory;

    protected $fillable = [
        'character',
        'romaji',
        'type',
        'category',
        'description',
        'stroke_order',
        'difficulty_level',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getTypeNameAttribute()
    {
        $types = [
            'hiragana' => 'Hiragana',
            'katakana' => 'Katakana',
            'kanji' => 'Kanji',
            'romaji' => 'Romaji'
        ];

        return $types[$this->type] ?? $this->type;
    }

    public function getCategoryNameAttribute()
    {
        $categories = [
            'vowel' => 'Nguyên âm',
            'consonant' => 'Phụ âm',
            'number' => 'Số đếm',
            'basic' => 'Cơ bản',
            'advanced' => 'Nâng cao'
        ];

        return $categories[$this->category] ?? $this->category;
    }

    public function getDifficultyLevelNameAttribute()
    {
        $levels = [
            1 => 'N5',
            2 => 'N4',
            3 => 'N3',
            4 => 'N2',
            5 => 'N1',
        ];
        return $levels[$this->difficulty_level] ?? 'N/A';
    }
}
