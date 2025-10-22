<?php

namespace App\Http\Controllers;

use App\Models\ListeningExercise;
use App\Models\UserAnswer;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListeningController extends Controller
{
    public function index()
    {
        $exercises = ListeningExercise::where('is_active', true)
            ->orderBy('level')
            ->orderBy('difficulty_level')
            ->get()
            ->groupBy('level');

        return view('listening.index', compact('exercises'));
    }

    public function show(ListeningExercise $listeningExercise)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('listening.show', compact('listeningExercise'));
    }

    public function submit(ListeningExercise $listeningExercise, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string'
        ]);

        $userAnswers = $request->input('answers');
        $questions = $listeningExercise->questions;
        $correctAnswers = $listeningExercise->correct_answers;
        
        $results = [];
        $totalCorrect = 0;
        $totalQuestions = count($questions);

        // Check each answer
        foreach ($questions as $index => $question) {
            $userAnswer = $userAnswers[$index] ?? '';
            $correctAnswer = $correctAnswers[$index] ?? '';
            $isCorrect = $this->checkAnswer($userAnswer, $correctAnswer);
            
            if ($isCorrect) {
                $totalCorrect++;
            }
            
            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $correctAnswer,
                'is_correct' => $isCorrect
            ];
        }

        $accuracy = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100, 2) : 0;
        $pointsEarned = $isCorrect ? $listeningExercise->points : 0;

        // Save user answer
        UserAnswer::create([
            'user_id' => Auth::id(),
            'exercise_id' => null, // Listening exercises don't have exercise_id
            'user_answer' => json_encode($userAnswers),
            'is_correct' => $accuracy >= 70, // 70% threshold
            'points_earned' => $pointsEarned,
            'answered_at' => now(),
        ]);

        return response()->json([
            'results' => $results,
            'total_correct' => $totalCorrect,
            'total_questions' => $totalQuestions,
            'accuracy' => $accuracy,
            'points_earned' => $pointsEarned,
            'passed' => $accuracy >= 70
        ]);
    }

    private function checkAnswer($userAnswer, $correctAnswer)
    {
        $userAnswer = strtolower(trim($userAnswer));
        $correctAnswer = strtolower(trim($correctAnswer));
        
        return $userAnswer === $correctAnswer;
    }

    public function practice()
    {
        $exercises = ListeningExercise::where('is_active', true)
            ->orderBy('level')
            ->orderBy('difficulty_level')
            ->get();

        return view('listening.practice', compact('exercises'));
    }

    public function levelPractice($level)
    {
        $exercises = ListeningExercise::where('is_active', true)
            ->where('level', $level)
            ->orderBy('difficulty_level')
            ->get();

        $levelName = [
            1 => 'N5',
            2 => 'N4', 
            3 => 'N3',
            4 => 'N2',
            5 => 'N1'
        ][$level] ?? 'Unknown';

        return view('listening.level-practice', compact('exercises', 'level', 'levelName'));
    }
}
