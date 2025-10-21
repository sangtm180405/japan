@extends('layouts.app')

@section('title', 'Luyện tập Kanji')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('practice.index') }}">Luyện tập</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kanji</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 mb-3">
                <i class="fas fa-pen me-2"></i>
                Luyện tập Kanji
            </h1>
            
            <!-- Practice Options -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="level" class="form-label">Cấp độ</label>
                            <select class="form-select" id="level" name="level">
                                <option value="1" {{ $level == 1 ? 'selected' : '' }}>N5 - Cơ bản</option>
                                <option value="2" {{ $level == 2 ? 'selected' : '' }}>N4 - Trung bình</option>
                                <option value="3" {{ $level == 3 ? 'selected' : '' }}>N3 - Nâng cao</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="mode" class="form-label">Chế độ luyện tập</label>
                            <select class="form-select" id="mode" name="mode">
                                <option value="recognition" {{ $mode === 'recognition' ? 'selected' : '' }}>Nhận diện nghĩa</option>
                                <option value="writing" {{ $mode === 'writing' ? 'selected' : '' }}>Viết Kanji</option>
                                <option value="meaning" {{ $mode === 'meaning' ? 'selected' : '' }}>Tìm Kanji theo nghĩa</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync me-2"></i>Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Practice Area -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-play me-2"></i>
                        Luyện tập Kanji N{{ $level }}
                    </h5>
                </div>
                <div class="card-body">
                    @if($mode === 'recognition')
                        <!-- Recognition Mode -->
                        <div class="row" id="recognition-practice">
                            @foreach($kanji as $index => $char)
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <div class="card practice-card" data-kanji="{{ $char->character }}" data-meaning="{{ $char->description }}">
                                    <div class="card-body text-center">
                                        <div class="display-1 japanese-text mb-3">{{ $char->character }}</div>
                                        
                                        <div class="btn-group w-100 mb-3" role="group">
                                            <button type="button" class="btn btn-outline-primary btn-sm show-answer" data-target="{{ $index }}">
                                                <i class="fas fa-eye me-1"></i>Xem nghĩa
                                            </button>
                                            <button type="button" class="btn btn-outline-success btn-sm show-reading" data-target="{{ $index }}">
                                                <i class="fas fa-volume-up me-1"></i>Âm đọc
                                            </button>
                                        </div>
                                        
                                        <div class="answer" id="answer-{{ $index }}" style="display: none;">
                                            <div class="alert alert-success">
                                                <strong>{{ $char->description }}</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="reading" id="reading-{{ $index }}" style="display: none;">
                                            <div class="alert alert-info">
                                                <strong>{{ $char->romaji }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif($mode === 'writing')
                        <!-- Writing Mode -->
                        <div class="row" id="writing-practice">
                            @foreach($kanji as $index => $char)
                            <div class="col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Viết Kanji:</h5>
                                                <div class="h4 text-primary mb-3">{{ $char->description }}</div>
                                                <div class="text-muted h5 mb-3">{{ $char->romaji }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="writing-area border rounded p-3 mb-3" style="min-height: 120px; background: #f8f9fa;">
                                                    <div class="text-center text-muted">
                                                        <i class="fas fa-pen fa-2x mb-2"></i>
                                                        <br>Viết Kanji ở đây
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm show-correct" data-target="{{ $index }}">
                                                    <i class="fas fa-check me-1"></i>Xem đáp án
                                                </button>
                                            </div>
                                        </div>
                                        <div class="correct-answer mt-3" id="correct-{{ $index }}" style="display: none;">
                                            <div class="alert alert-success">
                                                <strong>Đáp án:</strong>
                                                <div class="display-1 japanese-text">{{ $char->character }}</div>
                                                <div class="text-muted h5">{{ $char->romaji }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif($mode === 'meaning')
                        <!-- Meaning Mode -->
                        <div class="row" id="meaning-practice">
                            @foreach($kanji as $index => $char)
                            <div class="col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Tìm Kanji có nghĩa:</h5>
                                                <div class="h4 text-primary mb-3">{{ $char->description }}</div>
                                                <div class="text-muted h5 mb-3">{{ $char->romaji }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="writing-area border rounded p-3 mb-3" style="min-height: 120px; background: #f8f9fa;">
                                                    <div class="text-center text-muted">
                                                        <i class="fas fa-pen fa-2x mb-2"></i>
                                                        <br>Viết Kanji ở đây
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm show-correct" data-target="{{ $index }}">
                                                    <i class="fas fa-check me-1"></i>Xem đáp án
                                                </button>
                                            </div>
                                        </div>
                                        <div class="correct-answer mt-3" id="correct-{{ $index }}" style="display: none;">
                                            <div class="alert alert-success">
                                                <strong>Đáp án:</strong>
                                                <div class="display-1 japanese-text">{{ $char->character }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Practice Controls -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ route('practice.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>
            <button type="button" class="btn btn-primary" onclick="location.reload()">
                <i class="fas fa-sync me-2"></i>Luyện tập lại
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show answer functionality
    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const answerDiv = document.getElementById('answer-' + target);
            answerDiv.style.display = answerDiv.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Show reading functionality
    document.querySelectorAll('.show-reading').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const readingDiv = document.getElementById('reading-' + target);
            readingDiv.style.display = readingDiv.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Show correct answer functionality
    document.querySelectorAll('.show-correct').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const correctDiv = document.getElementById('correct-' + target);
            correctDiv.style.display = correctDiv.style.display === 'none' ? 'block' : 'none';
        });
    });
});
</script>
@endpush
@endsection
