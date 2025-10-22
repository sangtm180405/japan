<?php

namespace App\Http\Controllers;

use App\Models\Alphabet;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    public function index()
    {
        $stats = [
            'hiragana' => Alphabet::where('type', 'hiragana')->where('is_active', true)->count(),
            'katakana' => Alphabet::where('type', 'katakana')->where('is_active', true)->count(),
            'kanji_n5' => Alphabet::where('type', 'kanji')->where('difficulty_level', 1)->where('is_active', true)->count(),
            'kanji_n4' => Alphabet::where('type', 'kanji')->where('difficulty_level', 2)->where('is_active', true)->count(),
            'kanji_n3' => Alphabet::where('type', 'kanji')->where('difficulty_level', 3)->where('is_active', true)->count(),
            'vocabularies' => Vocabulary::where('is_active', true)->count(),
            'lessons' => Lesson::where('is_active', true)->count(),
        ];

        return view('practice.index', compact('stats'));
    }

    public function alphabetPractice(Request $request)
    {
        $type = $request->get('type', 'hiragana');
        $level = $request->get('level', 1);
        $mode = $request->get('mode', 'recognition'); // recognition, writing, pronunciation

        $query = Alphabet::where('is_active', true);
        
        if ($type !== 'all') {
            $query->where('type', $type);
        }
        
        if ($level && $type === 'kanji') {
            $query->where('difficulty_level', $level);
        }

        $characters = $query->inRandomOrder()->limit(20)->get();

        return view('practice.alphabet', compact('characters', 'type', 'level', 'mode'));
    }

    public function hiraganaPractice(Request $request)
    {
        $mode = $request->get('mode', 'recognition'); // recognition, writing, pronunciation

        $characters = Alphabet::where('type', 'hiragana')
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(20)
            ->get();

        return view('practice.hiragana', compact('characters', 'mode'));
    }

    public function katakanaPractice(Request $request)
    {
        $mode = $request->get('mode', 'recognition'); // recognition, writing, pronunciation

        $characters = Alphabet::where('type', 'katakana')
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(20)
            ->get();

        return view('practice.katakana', compact('characters', 'mode'));
    }

    public function vocabularyPractice(Request $request)
    {
        $level = $request->get('level', 1);
        $mode = $request->get('mode', 'translation'); // translation, japanese, audio

        $query = Vocabulary::where('is_active', true);
        
        if ($level) {
            $query->whereHas('lesson', function($q) use ($level) {
                $q->where('level', $level);
            });
        }

        $vocabularies = $query->inRandomOrder()->limit(20)->get();

        return view('practice.vocabulary', compact('vocabularies', 'level', 'mode'));
    }

    public function kanjiPractice(Request $request)
    {
        $level = $request->get('level', 1);
        $mode = $request->get('mode', 'recognition'); // recognition, writing, meaning

        $kanji = Alphabet::where('type', 'kanji')
            ->where('difficulty_level', $level)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(20)
            ->get();

        return view('practice.kanji', compact('kanji', 'level', 'mode'));
    }

    public function mixedPractice(Request $request)
    {
        $level = $request->get('level', 1);
        $types = $request->get('types', ['hiragana', 'katakana', 'kanji']);

        $characters = collect();

        foreach ($types as $type) {
            $query = Alphabet::where('type', $type)->where('is_active', true);
            
            if ($type === 'kanji') {
                $query->where('difficulty_level', $level);
            }

            $characters = $characters->merge(
                $query->inRandomOrder()->limit(10)->get()
            );
        }

        $characters = $characters->shuffle()->take(20);

        return view('practice.mixed', compact('characters', 'level', 'types'));
    }

    public function levelTest(Request $request)
    {
        $level = $request->get('level', 1);
        $type = $request->get('type', 'mixed'); // mixed, alphabet, vocabulary, kanji

        $questions = collect();

        if ($type === 'mixed' || $type === 'alphabet') {
            // Hiragana questions
            $hiragana = Alphabet::where('type', 'hiragana')
                ->where('is_active', true)
                ->inRandomOrder()
                ->limit(5)
                ->get();
            
            foreach ($hiragana as $char) {
                $questions->push([
                    'type' => 'alphabet',
                    'question' => $char->character,
                    'correct_answer' => $char->romaji,
                    'options' => $this->generateAlphabetOptions($char->romaji, 'hiragana'),
                    'character_type' => 'hiragana'
                ]);
            }

            // Katakana questions
            $katakana = Alphabet::where('type', 'katakana')
                ->where('is_active', true)
                ->inRandomOrder()
                ->limit(5)
                ->get();
            
            foreach ($katakana as $char) {
                $questions->push([
                    'type' => 'alphabet',
                    'question' => $char->character,
                    'correct_answer' => $char->romaji,
                    'options' => $this->generateAlphabetOptions($char->romaji, 'katakana'),
                    'character_type' => 'katakana'
                ]);
            }
        }

        if ($type === 'mixed' || $type === 'kanji') {
            // Kanji questions
            $kanji = Alphabet::where('type', 'kanji')
                ->where('difficulty_level', $level)
                ->where('is_active', true)
                ->inRandomOrder()
                ->limit(10)
                ->get();
            
            foreach ($kanji as $char) {
                $questions->push([
                    'type' => 'kanji',
                    'question' => $char->character,
                    'correct_answer' => $char->description,
                    'options' => $this->generateKanjiOptions($char->description, $level),
                    'character_type' => 'kanji',
                    'romaji' => $char->romaji
                ]);
            }
        }

        if ($type === 'mixed' || $type === 'vocabulary') {
            // Vocabulary questions
            $vocabularies = Vocabulary::whereHas('lesson', function($q) use ($level) {
                $q->where('level', $level);
            })
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(10)
            ->get();
            
            foreach ($vocabularies as $vocab) {
                $questions->push([
                    'type' => 'vocabulary',
                    'question' => $vocab->japanese,
                    'correct_answer' => $vocab->vietnamese,
                    'options' => $this->generateVocabularyOptions($vocab->vietnamese, $level),
                    'character_type' => 'vocabulary',
                    'romaji' => $vocab->romaji
                ]);
            }
        }

        $questions = $questions->shuffle()->take(30);

        return view('practice.level-test', compact('questions', 'level', 'type'));
    }

    public function submitTest(Request $request)
    {
        $answers = $request->get('answers', []);
        $questions = $request->get('questions', []);
        
        $correct = 0;
        $total = count($questions);
        $results = [];

        foreach ($questions as $index => $question) {
            $userAnswer = $answers[$index] ?? '';
            $isCorrect = $userAnswer === $question['correct_answer'];
            
            if ($isCorrect) {
                $correct++;
            }

            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question['correct_answer'],
                'is_correct' => $isCorrect
            ];
        }

        $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

        return view('practice.test-results', compact('results', 'score', 'correct', 'total'));
    }

    private function generateAlphabetOptions($correct, $type)
    {
        $options = [$correct];
        
        // Get random options from same type
        $otherChars = Alphabet::where('type', $type)
            ->where('is_active', true)
            ->where('romaji', '!=', $correct)
            ->inRandomOrder()
            ->limit(3)
            ->pluck('romaji')
            ->toArray();
        
        $options = array_merge($options, $otherChars);
        shuffle($options);
        
        return array_slice($options, 0, 4);
    }

    private function generateKanjiOptions($correct, $level)
    {
        $options = [$correct];
        
        // Get random options from same level
        $otherKanji = Alphabet::where('type', 'kanji')
            ->where('difficulty_level', $level)
            ->where('is_active', true)
            ->where('description', '!=', $correct)
            ->inRandomOrder()
            ->limit(3)
            ->pluck('description')
            ->toArray();
        
        $options = array_merge($options, $otherKanji);
        shuffle($options);
        
        return array_slice($options, 0, 4);
    }

    private function generateVocabularyOptions($correct, $level)
    {
        $options = [$correct];
        
        // Get random options from same level
        $otherVocab = Vocabulary::whereHas('lesson', function($q) use ($level) {
            $q->where('level', $level);
        })
        ->where('is_active', true)
        ->where('vietnamese', '!=', $correct)
        ->inRandomOrder()
        ->limit(3)
        ->pluck('vietnamese')
        ->toArray();
        
        $options = array_merge($options, $otherVocab);
        shuffle($options);
        
        return array_slice($options, 0, 4);
    }
}
