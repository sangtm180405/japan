<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::with('lesson')->orderBy('lesson_id')->orderBy('id')->paginate(20);
        return view('admin.exercises.index', compact('exercises'));
    }

    public function create()
    {
        $lessons = Lesson::where('is_active', true)->orderBy('level')->orderBy('order')->get();
        return view('admin.exercises.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'type' => 'required|in:multiple_choice,fill_blank,translation,listening',
            'question' => 'required|string',
            'options' => 'nullable|array',
            'correct_answer' => 'required|string',
            'explanation' => 'nullable|string',
            'points' => 'required|integer|min:1',
            'difficulty_level' => 'required|integer|min:1|max:5',
        ]);

        $data = $request->all();
        if ($request->has('options') && is_array($request->options)) {
            $data['options'] = array_filter($request->options); // Remove empty options
        }

        Exercise::create($data);

        return redirect()->route('admin.exercises.index')
            ->with('success', 'Bài tập đã được thêm thành công!');
    }

    public function edit(Exercise $exercise)
    {
        $lessons = Lesson::where('is_active', true)->orderBy('level')->orderBy('order')->get();
        return view('admin.exercises.edit', compact('exercise', 'lessons'));
    }

    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'type' => 'required|in:multiple_choice,fill_blank,translation,listening',
            'question' => 'required|string',
            'options' => 'nullable|array',
            'correct_answer' => 'required|string',
            'explanation' => 'nullable|string',
            'points' => 'required|integer|min:1',
            'difficulty_level' => 'required|integer|min:1|max:5',
        ]);

        $data = $request->all();
        if ($request->has('options') && is_array($request->options)) {
            $data['options'] = array_filter($request->options);
        }

        $exercise->update($data);

        return redirect()->route('admin.exercises.index')
            ->with('success', 'Bài tập đã được cập nhật thành công!');
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect()->route('admin.exercises.index')
            ->with('success', 'Bài tập đã được xóa thành công!');
    }
}
