<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    public function importFromJson(Request $request)
    {
        $request->validate([
            'data' => 'required|array',
            'data.lessons' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            $importedData = [
                'lessons' => 0,
                'vocabularies' => 0,
                'grammars' => 0,
                'exercises' => 0,
            ];

            foreach ($request->data['lessons'] as $lessonData) {
                // Create lesson
                $lesson = Lesson::create([
                    'title' => $lessonData['title'],
                    'description' => $lessonData['description'],
                    'level' => $lessonData['level'],
                    'order' => $lessonData['order'],
                    'is_active' => $lessonData['is_active'] ?? true,
                ]);
                $importedData['lessons']++;

                // Create vocabularies
                if (isset($lessonData['vocabularies'])) {
                    foreach ($lessonData['vocabularies'] as $vocabData) {
                        Vocabulary::create(array_merge($vocabData, ['lesson_id' => $lesson->id]));
                        $importedData['vocabularies']++;
                    }
                }

                // Create grammars
                if (isset($lessonData['grammars'])) {
                    foreach ($lessonData['grammars'] as $grammarData) {
                        Grammar::create(array_merge($grammarData, ['lesson_id' => $lesson->id]));
                        $importedData['grammars']++;
                    }
                }

                // Create exercises
                if (isset($lessonData['exercises'])) {
                    foreach ($lessonData['exercises'] as $exerciseData) {
                        Exercise::create(array_merge($exerciseData, ['lesson_id' => $lesson->id]));
                        $importedData['exercises']++;
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Import thành công!',
                'data' => $importedData
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi import: ' . $e->getMessage()
            ], 500);
        }
    }

    public function exportToJson()
    {
        $lessons = Lesson::with(['vocabularies', 'grammars', 'exercises'])->get();
        
        $exportData = [
            'lessons' => $lessons->map(function ($lesson) {
                return [
                    'title' => $lesson->title,
                    'description' => $lesson->description,
                    'level' => $lesson->level,
                    'order' => $lesson->order,
                    'is_active' => $lesson->is_active,
                    'vocabularies' => $lesson->vocabularies->map(function ($vocab) {
                        return [
                            'japanese' => $vocab->japanese,
                            'hiragana' => $vocab->hiragana,
                            'katakana' => $vocab->katakana,
                            'kanji' => $vocab->kanji,
                            'romaji' => $vocab->romaji,
                            'vietnamese' => $vocab->vietnamese,
                            'english' => $vocab->english,
                            'example_sentence' => $vocab->example_sentence,
                            'example_translation' => $vocab->example_translation,
                            'difficulty_level' => $vocab->difficulty_level,
                        ];
                    })->toArray(),
                    'grammars' => $lesson->grammars->map(function ($grammar) {
                        return [
                            'title' => $grammar->title,
                            'explanation' => $grammar->explanation,
                            'structure' => $grammar->structure,
                            'examples' => $grammar->examples,
                            'usage_notes' => $grammar->usage_notes,
                            'difficulty_level' => $grammar->difficulty_level,
                        ];
                    })->toArray(),
                    'exercises' => $lesson->exercises->map(function ($exercise) {
                        return [
                            'type' => $exercise->type,
                            'question' => $exercise->question,
                            'options' => $exercise->options,
                            'correct_answer' => $exercise->correct_answer,
                            'explanation' => $exercise->explanation,
                            'points' => $exercise->points,
                            'difficulty_level' => $exercise->difficulty_level,
                        ];
                    })->toArray(),
                ];
            })->toArray()
        ];

        return response()->json($exportData);
    }
}
