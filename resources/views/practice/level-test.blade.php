@extends('layouts.app')

@section('title', 'Kiểm tra trình độ N' . $level)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('practice.index') }}">Luyện tập</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kiểm tra N{{ $level }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 mb-3">
                <i class="fas fa-clipboard-check me-2"></i>
                Kiểm tra trình độ N{{ $level }}
            </h1>
            <p class="lead text-muted">
                Bài kiểm tra gồm {{ count($questions) }} câu hỏi. Hãy chọn đáp án đúng cho mỗi câu.
            </p>
        </div>
    </div>

    <form id="test-form" action="{{ route('practice.submit-test') }}" method="POST">
        @csrf
        <input type="hidden" name="questions" value="{{ json_encode($questions) }}">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">Câu hỏi <span id="current-question">1</span>/{{ count($questions) }}</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="progress" style="width: 200px; height: 8px;">
                                    <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Questions will be displayed here -->
                        <div id="questions-container">
                            @foreach($questions as $index => $question)
                            <div class="question-item {{ $index === 0 ? 'active' : '' }}" data-question="{{ $index }}">
                                <div class="question-content mb-4">
                                    <h5 class="mb-3">
                                        @if($question['type'] === 'alphabet')
                                            <span class="badge bg-primary me-2">{{ strtoupper($question['character_type']) }}</span>
                                            Nhận diện ký tự
                                        @elseif($question['type'] === 'kanji')
                                            <span class="badge bg-warning me-2">KANJI</span>
                                            Nghĩa của Kanji
                                        @elseif($question['type'] === 'vocabulary')
                                            <span class="badge bg-success me-2">TỪ VỰNG</span>
                                            Dịch từ vựng
                                        @endif
                                    </h5>
                                    
                                    <div class="question-display mb-4">
                                        @if($question['type'] === 'alphabet')
                                            <div class="display-1 japanese-text text-center mb-3">{{ $question['question'] }}</div>
                                        @elseif($question['type'] === 'kanji')
                                            <div class="display-1 japanese-text text-center mb-3">{{ $question['question'] }}</div>
                                            @if(isset($question['romaji']))
                                            <div class="text-center text-muted h5">{{ $question['romaji'] }}</div>
                                            @endif
                                        @elseif($question['type'] === 'vocabulary')
                                            <div class="display-3 japanese-text text-center mb-3">{{ $question['question'] }}</div>
                                            @if(isset($question['romaji']))
                                            <div class="text-center text-muted h5">{{ $question['romaji'] }}</div>
                                            @endif
                                        @endif
                                    </div>
                                    
                                    <div class="answer-options">
                                        @foreach($question['options'] as $optionIndex => $option)
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" 
                                                   name="answers[{{ $index }}]" 
                                                   id="answer_{{ $index }}_{{ $optionIndex }}" 
                                                   value="{{ $option }}">
                                            <label class="form-check-label w-100" for="answer_{{ $index }}_{{ $optionIndex }}">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="h5 mb-0">{{ $option }}</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Navigation -->
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" id="prev-btn" disabled>
                                <i class="fas fa-arrow-left me-2"></i>Câu trước
                            </button>
                            <button type="button" class="btn btn-primary" id="next-btn">
                                Câu tiếp <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Submit Button -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <button type="button" class="btn btn-success btn-lg" id="submit-test" style="display: none;">
                <i class="fas fa-check me-2"></i>Nộp bài
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const questions = @json($questions);
    let currentQuestion = 0;
    const totalQuestions = questions.length;
    
    const questionItems = document.querySelectorAll('.question-item');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-test');
    const currentQuestionSpan = document.getElementById('current-question');
    const progressBar = document.getElementById('progress-bar');
    
    function showQuestion(index) {
        questionItems.forEach((item, i) => {
            item.classList.toggle('active', i === index);
        });
        
        currentQuestionSpan.textContent = index + 1;
        progressBar.style.width = ((index + 1) / totalQuestions) * 100 + '%';
        
        prevBtn.disabled = index === 0;
        nextBtn.style.display = index === totalQuestions - 1 ? 'none' : 'inline-block';
        submitBtn.style.display = index === totalQuestions - 1 ? 'block' : 'none';
    }
    
    function updateProgress() {
        const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
        const progress = (answeredQuestions / totalQuestions) * 100;
        progressBar.style.width = progress + '%';
        
        if (answeredQuestions === totalQuestions) {
            submitBtn.classList.remove('btn-success');
            submitBtn.classList.add('btn-warning');
            submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Nộp bài (Đã hoàn thành)';
        }
    }
    
    // Event listeners
    prevBtn.addEventListener('click', function() {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    });
    
    nextBtn.addEventListener('click', function() {
        if (currentQuestion < totalQuestions - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    });
    
    // Update progress when answers change
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', updateProgress);
    });
    
    // Submit form
    submitBtn.addEventListener('click', function() {
        const form = document.getElementById('test-form');
        const formData = new FormData(form);
        
        // Check if all questions are answered
        const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
        if (answeredQuestions < totalQuestions) {
            if (confirm('Bạn chưa trả lời hết các câu hỏi. Bạn có chắc chắn muốn nộp bài?')) {
                form.submit();
            }
        } else {
            form.submit();
        }
    });
    
    // Initialize
    showQuestion(0);
    updateProgress();
});
</script>
@endpush

@push('styles')
<style>
.question-item {
    display: none;
}

.question-item.active {
    display: block;
}

.answer-options .form-check-input:checked + .form-check-label .card {
    border-color: #0d6efd;
    background-color: #f8f9fa;
}

.answer-options .form-check-input:checked + .form-check-label .card .card-body {
    background-color: #e7f3ff;
}

.japanese-text {
    font-family: 'Noto Sans JP', sans-serif;
}
</style>
@endpush
@endsection
