<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateInputMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Sanitize all input data
        $this->sanitizeInput($request);
        
        // Validate specific routes
        $this->validateRoute($request);
        
        return $next($request);
    }

    /**
     * Sanitize input data
     */
    protected function sanitizeInput(Request $request): void
    {
        $input = $request->all();
        
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                // Remove potentially dangerous characters
                $value = strip_tags($value);
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = trim($value);
                
                $input[$key] = $value;
            }
        }
        
        $request->merge($input);
    }

    /**
     * Validate specific routes
     */
    protected function validateRoute(Request $request): void
    {
        $route = $request->route()?->getName();
        
        switch ($route) {
            case 'lessons.start':
                $this->validateLessonStart($request);
                break;
            case 'lessons.complete':
                $this->validateLessonComplete($request);
                break;
            case 'exercises.submit':
                $this->validateExerciseSubmit($request);
                break;
            case 'api.audio.generate':
                $this->validateAudioGenerate($request);
                break;
        }
    }

    /**
     * Validate lesson start request
     */
    protected function validateLessonStart(Request $request): void
    {
        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required|integer|exists:lessons,id'
        ]);

        if ($validator->fails()) {
            abort(422, 'Invalid lesson data');
        }
    }

    /**
     * Validate lesson complete request
     */
    protected function validateLessonComplete(Request $request): void
    {
        $validator = Validator::make($request->all(), [
            'score' => 'required|integer|min:0|max:100',
            'total_questions' => 'required|integer|min:1',
            'correct_answers' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            abort(422, 'Invalid completion data');
        }
    }

    /**
     * Validate exercise submit request
     */
    protected function validateExerciseSubmit(Request $request): void
    {
        $validator = Validator::make($request->all(), [
            'user_answer' => 'required|string|max:1000',
            'exercise_id' => 'required|integer|exists:exercises,id'
        ]);

        if ($validator->fails()) {
            abort(422, 'Invalid exercise data');
        }
    }

    /**
     * Validate audio generation request
     */
    protected function validateAudioGenerate(Request $request): void
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:500',
            'type' => 'required|string|in:hiragana,katakana,vocabulary,kanji,sentence'
        ]);

        if ($validator->fails()) {
            abort(422, 'Invalid audio generation data');
        }
    }
}