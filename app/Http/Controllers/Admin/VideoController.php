<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('lesson')->orderBy('lesson_id')->orderBy('order')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $lessons = Lesson::orderBy('order')->get();
        return view('admin.videos.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:204800', // 200MB
            'type' => 'required|in:youtube,upload,external',
            'duration_seconds' => 'nullable|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['video_file']);
        $data['is_active'] = $request->has('is_active');

        if ($request->type === 'youtube') {
            $youtubeId = $this->getYoutubeVideoId($request->video_url);
            if ($youtubeId) {
                $data['embed_url'] = "https://www.youtube.com/embed/{$youtubeId}";
                $data['thumbnail_url'] = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";
            } else {
                return back()->withErrors(['video_url' => 'URL YouTube không hợp lệ.'])->withInput();
            }
        } elseif ($request->type === 'upload' && $request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('videos', 'public');
            $data['video_url'] = Storage::url($path);
        }

        Video::create($data);

        return redirect()->route('admin.videos.index')->with('success', 'Video đã được tạo thành công!');
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $lessons = Lesson::orderBy('order')->get();
        return view('admin.videos.edit', compact('video', 'lessons'));
    }

    public function update(Request $request, Video $video)
    {
        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:204800', // 200MB
            'type' => 'required|in:youtube,upload,external',
            'duration_seconds' => 'nullable|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['video_file']);
        $data['is_active'] = $request->has('is_active');

        if ($request->type === 'youtube') {
            $youtubeId = $this->getYoutubeVideoId($request->video_url);
            if ($youtubeId) {
                $data['embed_url'] = "https://www.youtube.com/embed/{$youtubeId}";
                $data['thumbnail_url'] = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";
            } else {
                return back()->withErrors(['video_url' => 'URL YouTube không hợp lệ.'])->withInput();
            }
            // Clear video_file related data if changing to youtube
            if ($video->type === 'upload' && $video->video_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $video->video_url));
            }
            $data['video_url'] = $request->video_url; // Store original YouTube URL
        } elseif ($request->type === 'upload') {
            if ($request->hasFile('video_file')) {
                // Delete old file if exists
                if ($video->type === 'upload' && $video->video_url) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $video->video_url));
                }
                $path = $request->file('video_file')->store('videos', 'public');
                $data['video_url'] = Storage::url($path);
            }
            $data['embed_url'] = null;
            $data['thumbnail_url'] = null;
        } else { // external
            $data['embed_url'] = null;
            $data['thumbnail_url'] = null;
        }

        $video->update($data);

        return redirect()->route('admin.videos.index')->with('success', 'Video đã được cập nhật thành công!');
    }

    public function destroy(Video $video)
    {
        if ($video->type === 'upload' && $video->video_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $video->video_url));
        }
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video đã được xóa thành công!');
    }

    private function getYoutubeVideoId($url)
    {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/|)([\w-]{11})(?:\S+)?/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}