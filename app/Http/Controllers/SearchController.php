<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Alphabet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $type = $request->get('type', 'all');
        $level = $request->get('level', 'all');
        
        if (empty($query)) {
            return view('search.index', [
                'results' => collect(),
                'query' => '',
                'type' => $type,
                'level' => $level
            ]);
        }

        $results = $this->performSearch($query, $type, $level);
        
        return view('search.index', compact('results', 'query', 'type', 'level'));
    }

    private function performSearch($query, $type, $level)
    {
        $results = collect();
        
        // Search lessons
        if ($type === 'all' || $type === 'lessons') {
            $lessonQuery = Lesson::where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                });
                
            if ($level !== 'all') {
                $lessonQuery->where('level', $level);
            }
            
            $lessons = $lessonQuery->get()->map(function($lesson) {
                return [
                    'type' => 'lesson',
                    'title' => $lesson->title,
                    'description' => $lesson->description,
                    'level' => $lesson->level_name,
                    'url' => route('lessons.show', ['lesson' => $lesson->id]),
                    'icon' => 'fas fa-book'
                ];
            });
            
            $results = $results->merge($lessons);
        }
        
        // Search vocabulary
        if ($type === 'all' || $type === 'vocabulary') {
            $vocabQuery = Vocabulary::where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('japanese', 'LIKE', "%{$query}%")
                      ->orWhere('hiragana', 'LIKE', "%{$query}%")
                      ->orWhere('romaji', 'LIKE', "%{$query}%")
                      ->orWhere('vietnamese', 'LIKE', "%{$query}%");
                })
                ->with('lesson');
                
            if ($level !== 'all') {
                $vocabQuery->whereHas('lesson', function($q) use ($level) {
                    $q->where('level', $level);
                });
            }
            
            $vocabularies = $vocabQuery->get()
                // Bỏ các từ vựng không gắn với bài học để tránh thiếu tham số route
                ->filter(function($vocab) {
                    return !is_null($vocab->lesson);
                })
                ->map(function($vocab) {
                    return [
                        'type' => 'vocabulary',
                        'title' => $vocab->japanese . ' (' . $vocab->hiragana . ')',
                        'description' => $vocab->vietnamese,
                        'level' => $vocab->lesson->level_name ?? 'N/A',
                        'url' => route('lessons.show', ['lesson' => $vocab->lesson->id]),
                        'icon' => 'fas fa-language'
                    ];
                })->values();
            
            $results = $results->merge($vocabularies);
        }
        
        // Search alphabets (kanji, hiragana, katakana)
        if ($type === 'all' || $type === 'alphabets') {
            $alphabetQuery = Alphabet::where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('character', 'LIKE', "%{$query}%")
                      ->orWhere('romaji', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                });
                
            if ($level !== 'all') {
                $alphabetQuery->where('difficulty_level', $level);
            }
            
            $alphabets = $alphabetQuery->get()->map(function($alphabet) {
                return [
                    'type' => 'alphabet',
                    'title' => $alphabet->character,
                    'description' => $alphabet->romaji . ' - ' . $alphabet->description,
                    'level' => $alphabet->difficulty_level_name,
                    'url' => route('alphabets.show', $alphabet),
                    'icon' => 'fas fa-font'
                ];
            });
            
            $results = $results->merge($alphabets);
        }
        
        return $results->sortBy('title');
    }

    public function suggestions(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        // Cache suggestions for 1 hour
        $suggestions = Cache::remember('search_suggestions_' . md5($query), 3600, function () use ($query) {
            $suggestions = collect();
            
            // Get vocabulary suggestions
            $vocabSuggestions = Vocabulary::where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('japanese', 'LIKE', "%{$query}%")
                      ->orWhere('vietnamese', 'LIKE', "%{$query}%");
                })
                ->limit(5)
                ->get()
                ->map(function($vocab) {
                    return [
                        'text' => $vocab->japanese . ' - ' . $vocab->vietnamese,
                        'type' => 'vocabulary'
                    ];
                });
            
            $suggestions = $suggestions->merge($vocabSuggestions);
            
            // Get lesson suggestions
            $lessonSuggestions = Lesson::where('is_active', true)
                ->where('title', 'LIKE', "%{$query}%")
                ->limit(3)
                ->get()
                ->map(function($lesson) {
                    return [
                        'text' => $lesson->title,
                        'type' => 'lesson'
                    ];
                });
            
            $suggestions = $suggestions->merge($lessonSuggestions);
            
            return $suggestions->take(8)->values();
        });
        
        return response()->json($suggestions);
    }
}
