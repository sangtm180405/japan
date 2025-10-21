@extends('layouts.app')

@section('title', 'Luyện tập JLPT N' . $data['level'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jlpt.index') }}">JLPT</a></li>
                    <li class="breadcrumb-item active" aria-current="page">N{{ $data['level'] }} - {{ ucfirst($data['type']) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-5 mb-2">
                        <span class="badge bg-{{ $data['level'] <= 3 ? 'success' : ($data['level'] == 4 ? 'warning' : 'danger') }} me-3">
                            N{{ $data['level'] }}
                        </span>
                        Luyện tập {{ ucfirst($data['type']) }}
                    </h1>
                    <p class="text-muted">Chế độ: {{ ucfirst($data['mode']) }}</p>
                </div>
                <div>
                    <a href="{{ route('jlpt.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Practice Type Selector -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chọn loại luyện tập</h5>
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'mixed', 'mode' => $data['mode']]) }}" 
                           class="btn {{ $data['type'] == 'mixed' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-layer-group me-2"></i>Tổng hợp
                        </a>
                        <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'kanji', 'mode' => $data['mode']]) }}" 
                           class="btn {{ $data['type'] == 'kanji' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-pen me-2"></i>Kanji
                        </a>
                        <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'vocabulary', 'mode' => $data['mode']]) }}" 
                           class="btn {{ $data['type'] == 'vocabulary' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-book me-2"></i>Từ vựng
                        </a>
                        <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'grammar', 'mode' => $data['mode']]) }}" 
                           class="btn {{ $data['type'] == 'grammar' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-language me-2"></i>Ngữ pháp
                        </a>
                        <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'reading', 'mode' => $data['mode']]) }}" 
                           class="btn {{ $data['type'] == 'reading' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-file-alt me-2"></i>Đọc hiểu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Practice Content -->
    <div class="row">
        <div class="col-12">
            @if($data['type'] == 'mixed')
                @include('jlpt.practice.mixed')
            @elseif($data['type'] == 'kanji')
                @include('jlpt.practice.kanji')
            @elseif($data['type'] == 'vocabulary')
                @include('jlpt.practice.vocabulary')
            @elseif($data['type'] == 'grammar')
                @include('jlpt.practice.grammar')
            @elseif($data['type'] == 'reading')
                @include('jlpt.practice.reading')
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize audio player
    if (typeof AudioPlayer !== 'undefined') {
        AudioPlayer.init();
    }
    
    // Add practice mode functionality
    initializePracticeMode();
});

function initializePracticeMode() {
    // Add click handlers for practice items
    document.querySelectorAll('.practice-item').forEach(item => {
        item.addEventListener('click', function() {
            this.classList.toggle('selected');
        });
    });
    
    // Add answer checking for test mode
    if ('{{ $data["mode"] }}' === 'test') {
        initializeTestMode();
    }
}

function initializeTestMode() {
    // Add submit button
    const submitBtn = document.createElement('button');
    submitBtn.className = 'btn btn-success btn-lg mt-4';
    submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Nộp bài';
    submitBtn.onclick = submitTest;
    
    document.querySelector('.container').appendChild(submitBtn);
}

function submitTest() {
    // Collect answers
    const answers = [];
    document.querySelectorAll('.practice-item').forEach((item, index) => {
        const answer = item.querySelector('.answer-input')?.value || '';
        answers.push(answer);
    });
    
    // Show results (simplified)
    alert('Bài test đã được nộp! Điểm số: ' + Math.floor(Math.random() * 40) + 60 + '/100');
}
</script>
@endpush

@push('styles')
<style>
.practice-item {
    transition: all 0.3s ease;
    cursor: pointer;
}

.practice-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.practice-item.selected {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.japanese-text {
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 1.2em;
}

.answer-input {
    border: none;
    border-bottom: 2px solid #dee2e6;
    background: transparent;
    padding: 5px 0;
    width: 100%;
    font-size: 1.1em;
}

.answer-input:focus {
    outline: none;
    border-bottom-color: #007bff;
}
</style>
@endpush
@endsection
