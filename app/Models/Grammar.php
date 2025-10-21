<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grammar extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'explanation',
        'structure',
        'examples',
        'usage_notes',
        'difficulty_level'
    ];

    protected $casts = [
        'examples' => 'array',
        'usage_notes' => 'array',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
