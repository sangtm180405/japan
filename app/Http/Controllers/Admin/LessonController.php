<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::orderBy('level')->orderBy('order')->paginate(10);
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        return view('admin.lessons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|integer|min:1|max:5',
            'order' => 'required|integer|min:1',
        ]);

        Lesson::create($request->all());

        return redirect()->route('admin.lessons.index')
            ->with('success', 'Bài học đã được tạo thành công!');
    }

    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|integer|min:1|max:5',
            'order' => 'required|integer|min:1',
        ]);

        $lesson->update($request->all());

        return redirect()->route('admin.lessons.index')
            ->with('success', 'Bài học đã được cập nhật thành công!');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.lessons.index')
            ->with('success', 'Bài học đã được xóa thành công!');
    }
}
