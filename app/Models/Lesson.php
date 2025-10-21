<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'level',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }

    public function grammars()
    {
        return $this->hasMany(Grammar::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

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
}
