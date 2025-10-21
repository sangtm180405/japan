<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\UserAnswer;
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

        UserAnswer::create([
            'user_id' => Auth::id(),
            'exercise_id' => $exercise->id,
            'user_answer' => $userAnswer,
            'is_correct' => $isCorrect,
            'points_earned' => $pointsEarned,
            'answered_at' => now(),
        ]);

        return response()->json([
            'is_correct' => $isCorrect,
            'correct_answer' => $exercise->correct_answer,
            'explanation' => $exercise->explanation,
            'points_earned' => $pointsEarned,
        ]);
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
