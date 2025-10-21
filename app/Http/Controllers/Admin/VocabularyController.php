<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    public function index()
    {
        $vocabularies = Vocabulary::with('lesson')->orderBy('lesson_id')->orderBy('id')->paginate(20);
        return view('admin.vocabularies.index', compact('vocabularies'));
    }

    public function create()
    {
        $lessons = Lesson::where('is_active', true)->orderBy('level')->orderBy('order')->get();
        return view('admin.vocabularies.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'japanese' => 'required|string|max:255',
            'hiragana' => 'required|string|max:255',
            'katakana' => 'nullable|string|max:255',
            'kanji' => 'nullable|string|max:255',
            'romaji' => 'required|string|max:255',
            'vietnamese' => 'required|string|max:255',
            'english' => 'nullable|string|max:255',
            'example_sentence' => 'nullable|string',
            'example_translation' => 'nullable|string',
            'difficulty_level' => 'required|integer|min:1|max:5',
        ]);

        Vocabulary::create($request->all());

        return redirect()->route('admin.vocabularies.index')
            ->with('success', 'Từ vựng đã được thêm thành công!');
    }

    public function edit(Vocabulary $vocabulary)
    {
        $lessons = Lesson::where('is_active', true)->orderBy('level')->orderBy('order')->get();
        return view('admin.vocabularies.edit', compact('vocabulary', 'lessons'));
    }

    public function update(Request $request, Vocabulary $vocabulary)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'japanese' => 'required|string|max:255',
            'hiragana' => 'required|string|max:255',
            'katakana' => 'nullable|string|max:255',
            'kanji' => 'nullable|string|max:255',
            'romaji' => 'required|string|max:255',
            'vietnamese' => 'required|string|max:255',
            'english' => 'nullable|string|max:255',
            'example_sentence' => 'nullable|string',
            'example_translation' => 'nullable|string',
            'difficulty_level' => 'required|integer|min:1|max:5',
        ]);

        $vocabulary->update($request->all());

        return redirect()->route('admin.vocabularies.index')
            ->with('success', 'Từ vựng đã được cập nhật thành công!');
    }

    public function destroy(Vocabulary $vocabulary)
    {
        $vocabulary->delete();
        return redirect()->route('admin.vocabularies.index')
            ->with('success', 'Từ vựng đã được xóa thành công!');
    }
}
