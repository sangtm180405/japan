<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\UserProgress;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::where('is_active', true)
            ->orderBy('level')
            ->orderBy('order')
            ->get()
            ->groupBy('level');

        $userProgress = collect();
        if (Auth::check()) {
            $userProgress = UserProgress::where('user_id', Auth::id())
                ->get()
                ->keyBy('lesson_id');
        }

        return view('lessons.index', compact('lessons', 'userProgress'));
    }

    public function show(Lesson $lesson)
    {
        // Check if user can access this lesson
        if (Auth::check() && !Auth::user()->canAccessLesson($lesson)) {
            $requiredCourse = $this->getRequiredCourse($lesson->level);
            return redirect()->route('course.enrollment', ['type' => $requiredCourse])
                ->with('error', 'Bạn cần đăng ký khóa học ' . $this->getCourseName($requiredCourse) . ' để truy cập bài học này.');
        }

        $vocabularies = $lesson->vocabularies()->orderBy('id')->get();
        $grammars = $lesson->grammars()->orderBy('id')->get();
        $exercises = $lesson->exercises()->orderBy('id')->get();
        $videos = $lesson->videos()->where('is_active', true)->orderBy('order')->get();

        $userProgress = null;
        if (Auth::check()) {
            $userProgress = UserProgress::where('user_id', Auth::id())
                ->where('lesson_id', $lesson->id)
                ->first();
        }

        return view('lessons.show', compact('lesson', 'vocabularies', 'grammars', 'exercises', 'videos', 'userProgress'));
    }

    private function getRequiredCourse($level)
    {
        $levelCourses = [
            1 => 'n5',
            2 => 'n4', 
            3 => 'n3',
            4 => 'n2',
            5 => 'n1'
        ];

        return $levelCourses[$level] ?? 'premium';
    }

    private function getCourseName($courseType)
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

        return $courses[$courseType] ?? $courseType;
    }

    public function start(Lesson $lesson)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userProgress = UserProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'lesson_id' => $lesson->id
            ],
            [
                'started_at' => now(),
            ]
        );

        return redirect()->route('lessons.show', $lesson);
    }

    public function complete(Lesson $lesson, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userProgress = UserProgress::where('user_id', Auth::id())
            ->where('lesson_id', $lesson->id)
            ->first();

        if (!$userProgress) {
            return redirect()->route('lessons.show', $lesson);
        }

        $userProgress->update([
            'is_completed' => true,
            'completed_at' => now(),
            'score' => $request->input('score', 0),
            'total_questions' => $request->input('total_questions', 0),
            'correct_answers' => $request->input('correct_answers', 0),
        ]);

        return redirect()->route('lessons.show', $lesson)
            ->with('success', 'Chúc mừng! Bạn đã hoàn thành bài học này.');
    }
}
