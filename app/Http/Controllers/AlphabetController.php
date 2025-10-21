<?php

namespace App\Http\Controllers;

use App\Models\Alphabet;
use Illuminate\Http\Request;

class AlphabetController extends Controller
{
    public function index(Request $request)
    {
        $query = Alphabet::where('is_active', true);

        // Lọc theo loại bảng chữ cái
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        // Lọc theo cấp độ
        if ($request->has('level') && $request->level) {
            $query->where('difficulty_level', $request->level);
        }

        // Lọc theo danh mục
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $alphabets = $query->orderBy('type')->orderBy('order')->get();

        // Lấy thống kê từ database gốc
        $stats = [
            'hiragana' => Alphabet::where('is_active', true)->where('type', 'hiragana')->count(),
            'katakana' => Alphabet::where('is_active', true)->where('type', 'katakana')->count(),
            'kanji' => Alphabet::where('is_active', true)->where('type', 'kanji')->count(),
            'romaji' => Alphabet::where('is_active', true)->where('type', 'romaji')->count(),
        ];

        return view('alphabets.index', compact('alphabets', 'stats'));
    }

    public function show(Alphabet $alphabet)
    {
        // Lấy các ký tự liên quan
        $related = Alphabet::where('type', $alphabet->type)
            ->where('id', '!=', $alphabet->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(10)
            ->get();

        return view('alphabets.show', compact('alphabet', 'related'));
    }

    public function practice()
    {
        $hiragana = Alphabet::where('type', 'hiragana')->where('is_active', true)->orderBy('order')->get();
        $katakana = Alphabet::where('type', 'katakana')->where('is_active', true)->orderBy('order')->get();
        $kanji = Alphabet::where('type', 'kanji')->where('is_active', true)->orderBy('difficulty_level')->get();

        return view('alphabets.practice', compact('hiragana', 'katakana', 'kanji'));
    }
}
