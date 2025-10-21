@extends('layouts.app')

@section('title', 'Bài học JLPT N' . $level)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3>Bài học N{{ $level }}</h3>
            <a href="{{ route('jlpt.index') }}" class="btn btn-outline-secondary">Quay lại JLPT</a>
        </div>
    </div>

    <div class="row">
        @forelse($lessons as $lesson)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Bài {{ $lesson['order'] }}: {{ $lesson['title'] }}</h6>
                        <span class="badge bg-info">{{ $lesson['vocab_count'] }} từ</span>
                    </div>
                    <p class="text-muted mb-3">{{ $lesson['description'] }}</p>
                    <div class="mt-auto d-flex gap-2">
                        <a class="btn btn-sm btn-primary" href="{{ route('lessons.show', $lesson['id']) }}">Vào bài</a>
                        <a class="btn btn-sm btn-outline-success" href="{{ route('jlpt.vocabulary-bank', ['level' => $level]) }}">Từ vựng</a>
                        <span class="ms-auto text-muted small">Video: {{ $lesson['video_count'] }} · BT: {{ $lesson['exercise_count'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">Chưa có bài học cho cấp này.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection


