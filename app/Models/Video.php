<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'video_url',
        'embed_url',
        'thumbnail_url',
        'duration_seconds',
        'type',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function getDurationFormattedAttribute()
    {
        if (!$this->duration_seconds) {
            return 'N/A';
        }

        $minutes = floor($this->duration_seconds / 60);
        $seconds = $this->duration_seconds % 60;
        
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function getYouTubeIdAttribute()
    {
        if ($this->type !== 'youtube') {
            return null;
        }

        // Extract YouTube video ID from URL
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $this->video_url, $matches);
        
        return isset($matches[1]) ? $matches[1] : null;
    }

    public function getEmbedUrlAttribute()
    {
        if ($this->type !== 'youtube' || !$this->youtube_id) {
            return $this->video_url;
        }

        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }
}
