<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_type',
        'status',
        'enrolled_at',
        'expires_at'
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        return $this->status === 'active' && 
               ($this->expires_at === null || $this->expires_at->isFuture());
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function getCourseNameAttribute()
    {
        $courses = [
            'free' => 'Miễn phí',
            'premium' => 'Premium',
            'n5' => 'JLPT N5',
            'n4' => 'JLPT N4',
            'n3' => 'JLPT N3',
            'n2' => 'JLPT N2',
            'n1' => 'JLPT N1',
        ];

        return $courses[$this->course_type] ?? $this->course_type;
    }
}
