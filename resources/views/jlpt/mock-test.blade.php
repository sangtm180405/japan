@extends('layouts.app')

@section('title', 'Thi thử JLPT N' . $level)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jlpt.index') }}">JLPT</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thi thử N{{ $level }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-5 mb-2">
                        <span class="badge bg-{{ $level <= 3 ? 'success' : ($level == 4 ? 'warning' : 'danger') }} me-3">
                            N{{ $level }}
                        </span>
                        Thi thử JLPT
                    </h1>
                    <p class="text-muted">Thời gian: {{ $testData['time_limit'] }} phút | Số câu: {{ count($testData['questions']) }}</p>
                </div>
                <div>
                    <a href="{{ route('jlpt.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Test Timer -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="timer-display">
                        <h2 class="text-primary" id="timer">00:00</h2>
                        <p class="text-muted">Thời gian còn lại</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Test Form -->
    <form id="testForm" method="POST" action="{{ route('jlpt.submit-test') }}">
        @csrf
        <input type="hidden" name="level" value="{{ $level }}">
        <input type="hidden" name="section" value="{{ $section }}">
        <input type="hidden" name="test_data" value="{{ json_encode($testData) }}">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @foreach($testData['questions'] as $index => $question)
                        <div class="question-item mb-4">
                            <div class="question-header mb-3">
                                <h5 class="question-number">Câu {{ $index + 1 }}:</h5>
                                <p class="question-text">{{ $question['question'] }}</p>
                            </div>
                            
                            @if(isset($question['options']))
                                <div class="options">
                                    @foreach($question['options'] as $optIndex => $option)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" 
                                               name="answers[{{ $index }}]" 
                                               value="{{ $option }}" 
                                               id="q{{ $index }}_opt{{ $optIndex }}">
                                        <label class="form-check-label" for="q{{ $index }}_opt{{ $optIndex }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="text" class="form-control" 
                                           name="answers[{{ $index }}]" 
                                           placeholder="Nhập câu trả lời...">
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                    <i class="fas fa-check me-2"></i>Nộp bài
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
let timeLeft = {{ $testData['time_limit'] * 60 }}; // Convert to seconds
let timerInterval;

document.addEventListener('DOMContentLoaded', function() {
    startTimer();
    
    // Auto-save answers
    document.querySelectorAll('input[type="radio"], input[type="text"]').forEach(input => {
        input.addEventListener('change', function() {
            saveAnswer(this);
        });
    });
    
    // Load saved answers
    loadSavedAnswers();
});

function startTimer() {
    updateTimerDisplay();
    timerInterval = setInterval(function() {
        timeLeft--;
        updateTimerDisplay();
        
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert('Hết thời gian! Bài thi sẽ được nộp tự động.');
            document.getElementById('testForm').submit();
        }
    }, 1000);
}

function updateTimerDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    const display = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    document.getElementById('timer').textContent = display;
    
    // Change color when time is running low
    if (timeLeft <= 300) { // 5 minutes
        document.getElementById('timer').className = 'text-danger';
    } else if (timeLeft <= 600) { // 10 minutes
        document.getElementById('timer').className = 'text-warning';
    }
}

function saveAnswer(input) {
    const questionIndex = input.name.match(/\[(\d+)\]/)[1];
    const answer = input.value;
    localStorage.setItem(`jlpt_test_${questionIndex}`, answer);
}

function loadSavedAnswers() {
    document.querySelectorAll('input[type="radio"], input[type="text"]').forEach(input => {
        const questionIndex = input.name.match(/\[(\d+)\]/)[1];
        const savedAnswer = localStorage.getItem(`jlpt_test_${questionIndex}`);
        
        if (savedAnswer) {
            if (input.type === 'radio') {
                if (input.value === savedAnswer) {
                    input.checked = true;
                }
            } else {
                input.value = savedAnswer;
            }
        }
    });
}

// Confirm before submit
document.getElementById('testForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked, input[type="text"]:not([value=""])').length;
    const totalQuestions = {{ count($testData['questions']) }};
    
    if (answeredQuestions < totalQuestions) {
        if (!confirm(`Bạn chỉ trả lời ${answeredQuestions}/${totalQuestions} câu. Bạn có chắc muốn nộp bài?`)) {
            return;
        }
    }
    
    // Clear saved answers
    for (let i = 0; i < totalQuestions; i++) {
        localStorage.removeItem(`jlpt_test_${i}`);
    }
    
    this.submit();
});
</script>
@endpush

@push('styles')
<style>
.question-item {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #f8f9fa;
}

.question-number {
    color: #007bff;
    font-weight: bold;
}

.timer-display {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px;
    padding: 20px;
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.form-check-label {
    cursor: pointer;
    padding-left: 5px;
}
</style>
@endpush
@endsection
