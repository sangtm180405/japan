<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\UserAnswer;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    public function show(Exercise $exercise)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('exercises.show', compact('exercise'));
    }

    public function submit(Exercise $exercise, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'user_answer' => 'required|string',
        ]);

        $userAnswer = $request->input('user_answer');
        $isCorrect = $this->checkAnswer($exercise, $userAnswer);
        $pointsEarned = $isCorrect ? $exercise->points : 0;

        // Lưu câu trả lời
        UserAnswer::create([
            'user_id' => Auth::id(),
            'exercise_id' => $exercise->id,
            'user_answer' => $userAnswer,
            'is_correct' => $isCorrect,
            'points_earned' => $pointsEarned,
            'answered_at' => now(),
        ]);

        // Cập nhật tiến độ bài học
        $lessonCompleted = $this->updateLessonProgress($exercise, $isCorrect, $pointsEarned);

        return response()->json([
            'is_correct' => $isCorrect,
            'correct_answer' => $exercise->correct_answer,
            'explanation' => $exercise->explanation,
            'points_earned' => $pointsEarned,
            'lesson_completed' => $lessonCompleted,
        ]);
    }

    private function updateLessonProgress(Exercise $exercise, bool $isCorrect, int $pointsEarned)
    {
        $userId = Auth::id();
        $lessonId = $exercise->lesson_id;

        // Tìm hoặc tạo UserProgress
        $userProgress = UserProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'lesson_id' => $lessonId
            ],
            [
                'started_at' => now(),
                'score' => 0,
                'total_questions' => 0,
                'correct_answers' => 0,
                'is_completed' => false
            ]
        );

        // Cập nhật thống kê
        $userProgress->increment('total_questions');
        if ($isCorrect) {
            $userProgress->increment('correct_answers');
        }
        $userProgress->increment('score', $pointsEarned);

        // Kiểm tra xem đã hoàn thành tất cả bài tập chưa
        $totalExercises = $exercise->lesson->exercises()->count();
        $completedExercises = UserAnswer::where('user_id', $userId)
            ->whereHas('exercise', function($query) use ($lessonId) {
                $query->where('lesson_id', $lessonId);
            })
            ->distinct('exercise_id')
            ->count();

        // Nếu đã làm hết bài tập, đánh dấu hoàn thành
        $lessonCompleted = false;
        if ($completedExercises >= $totalExercises && !$userProgress->is_completed) {
            $userProgress->update([
                'is_completed' => true,
                'completed_at' => now()
            ]);
            $lessonCompleted = true;
        }

        $userProgress->save();
        
        return $lessonCompleted;
    }

    private function checkAnswer(Exercise $exercise, string $userAnswer)
    {
        $correctAnswer = strtolower(trim($exercise->correct_answer));
        $userAnswer = strtolower(trim($userAnswer));

        // For multiple choice questions, check exact match
        if ($exercise->type === 'multiple_choice') {
            return $correctAnswer === $userAnswer;
        }

        // For other types, allow some flexibility
        return $correctAnswer === $userAnswer || 
               str_contains($correctAnswer, $userAnswer) ||
               str_contains($userAnswer, $correctAnswer);
    }
}
