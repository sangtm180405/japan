@extends('layouts.app')

@section('title', 'Luyện tập bảng chữ cái')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-pencil-alt me-2"></i>
            Luyện tập bảng chữ cái
        </h1>
        <a href="{{ route('alphabets.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <!-- Hướng dẫn -->
    <div class="alert alert-info">
        <h5><i class="fas fa-info-circle me-2"></i>Hướng dẫn luyện tập</h5>
        <p class="mb-0">Chọn loại bảng chữ cái để bắt đầu luyện tập. Bạn sẽ được hiển thị ký tự và cần nhập cách đọc romaji chính xác.</p>
    </div>

    <!-- Chọn loại bảng chữ cái -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card h-100 practice-card" data-type="hiragana">
                <div class="card-body text-center">
                    <div class="practice-icon mb-3">
                        <i class="fas fa-font fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Hiragana</h5>
                    <p class="card-text">Bảng chữ cái cơ bản của tiếng Nhật</p>
                    <div class="practice-stats">
                        <small class="text-muted">{{ $hiragana->count() }} ký tự</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 practice-card" data-type="katakana">
                <div class="card-body text-center">
                    <div class="practice-icon mb-3">
                        <i class="fas fa-font fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">Katakana</h5>
                    <p class="card-text">Dùng để viết từ nước ngoài</p>
                    <div class="practice-stats">
                        <small class="text-muted">{{ $katakana->count() }} ký tự</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 practice-card" data-type="kanji">
                <div class="card-body text-center">
                    <div class="practice-icon mb-3">
                        <i class="fas fa-font fa-3x text-warning"></i>
                    </div>
                    <h5 class="card-title">Kanji</h5>
                    <p class="card-text">Chữ Hán, phức tạp nhất</p>
                    <div class="practice-stats">
                        <small class="text-muted">{{ $kanji->count() }} ký tự</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 practice-card" data-type="all">
                <div class="card-body text-center">
                    <div class="practice-icon mb-3">
                        <i class="fas fa-random fa-3x text-info"></i>
                    </div>
                    <h5 class="card-title">Tất cả</h5>
                    <p class="card-text">Luyện tập tất cả bảng chữ cái</p>
                    <div class="practice-stats">
                        <small class="text-muted">{{ $hiragana->count() + $katakana->count() + $kanji->count() }} ký tự</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Khu vực luyện tập -->
    <div id="practice-area" class="card" style="display: none;">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Luyện tập: <span id="practice-type"></span></h5>
                <div class="practice-controls">
                    <span class="badge bg-primary me-2">Điểm: <span id="score">0</span></span>
                    <span class="badge bg-secondary me-2">Câu: <span id="current-question">0</span>/<span id="total-questions">0</span></span>
                    <button class="btn btn-sm btn-outline-danger" onclick="endPractice()">Kết thúc</button>
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <div id="question-area">
                <div class="question-character mb-4">
                    <span id="question-char" class="display-1"></span>
                </div>
                <div class="question-description mb-4">
                    <p id="question-desc" class="text-muted"></p>
                </div>
                <div class="answer-input mb-4">
                    <input type="text" id="answer-input" class="form-control form-control-lg text-center" 
                           placeholder="Nhập cách đọc romaji..." autocomplete="off">
                </div>
                <div class="answer-buttons">
                    <button class="btn btn-primary btn-lg" onclick="checkAnswer()">
                        <i class="fas fa-check me-2"></i>Kiểm tra
                    </button>
                    <button class="btn btn-outline-secondary btn-lg ms-2" onclick="skipQuestion()">
                        <i class="fas fa-forward me-2"></i>Bỏ qua
                    </button>
                </div>
            </div>
            <div id="result-area" style="display: none;">
                <div id="result-message" class="mb-4"></div>
                <button class="btn btn-primary btn-lg" onclick="nextQuestion()">
                    <i class="fas fa-arrow-right me-2"></i>Câu tiếp theo
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.practice-card {
    transition: transform 0.2s;
    cursor: pointer;
}

.practice-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.question-character {
    font-family: 'Noto Sans JP', sans-serif;
}

#answer-input {
    font-size: 1.5rem;
    padding: 1rem;
}

.correct-answer {
    color: #28a745;
    font-weight: bold;
}

.wrong-answer {
    color: #dc3545;
    font-weight: bold;
}
</style>

<script>
let practiceData = [];
let currentQuestion = 0;
let score = 0;
let practiceType = '';

function startPractice(type) {
    practiceType = type;
    
    // Lấy dữ liệu luyện tập
    if (type === 'hiragana') {
        practiceData = @json($hiragana);
    } else if (type === 'katakana') {
        practiceData = @json($katakana);
    } else if (type === 'kanji') {
        practiceData = @json($kanji);
    } else if (type === 'all') {
        practiceData = @json($hiragana->merge($katakana)->merge($kanji));
    }
    
    // Xáo trộn dữ liệu
    practiceData = practiceData.sort(() => Math.random() - 0.5);
    
    // Khởi tạo
    currentQuestion = 0;
    score = 0;
    
    // Hiển thị khu vực luyện tập
    document.getElementById('practice-area').style.display = 'block';
    document.getElementById('practice-type').textContent = type.toUpperCase();
    document.getElementById('total-questions').textContent = practiceData.length;
    
    // Hiển thị câu hỏi đầu tiên
    showQuestion();
}

function showQuestion() {
    if (currentQuestion >= practiceData.length) {
        endPractice();
        return;
    }
    
    const question = practiceData[currentQuestion];
    
    document.getElementById('question-char').textContent = question.character;
    document.getElementById('question-desc').textContent = question.description;
    document.getElementById('answer-input').value = '';
    document.getElementById('answer-input').focus();
    
    document.getElementById('question-area').style.display = 'block';
    document.getElementById('result-area').style.display = 'none';
    document.getElementById('current-question').textContent = currentQuestion + 1;
}

function checkAnswer() {
    const userAnswer = document.getElementById('answer-input').value.toLowerCase().trim();
    const correctAnswer = practiceData[currentQuestion].romaji.toLowerCase();
    
    const resultArea = document.getElementById('result-area');
    const resultMessage = document.getElementById('result-message');
    
    if (userAnswer === correctAnswer) {
        score++;
        resultMessage.innerHTML = `
            <div class="alert alert-success">
                <h5><i class="fas fa-check-circle me-2"></i>Chính xác!</h5>
                <p class="mb-0">Cách đọc đúng là: <strong>${practiceData[currentQuestion].romaji}</strong></p>
            </div>
        `;
    } else {
        resultMessage.innerHTML = `
            <div class="alert alert-danger">
                <h5><i class="fas fa-times-circle me-2"></i>Sai rồi!</h5>
                <p class="mb-0">Cách đọc đúng là: <strong>${practiceData[currentQuestion].romaji}</strong></p>
                <p class="mb-0">Bạn đã nhập: <strong>${userAnswer}</strong></p>
            </div>
        `;
    }
    
    document.getElementById('question-area').style.display = 'none';
    resultArea.style.display = 'block';
    document.getElementById('score').textContent = score;
}

function nextQuestion() {
    currentQuestion++;
    showQuestion();
}

function skipQuestion() {
    nextQuestion();
}

function endPractice() {
    const resultArea = document.getElementById('result-area');
    const resultMessage = document.getElementById('result-message');
    
    resultMessage.innerHTML = `
        <div class="alert alert-info">
            <h5><i class="fas fa-trophy me-2"></i>Kết thúc luyện tập!</h5>
            <p class="mb-0">Điểm số: <strong>${score}/${practiceData.length}</strong></p>
            <p class="mb-0">Tỷ lệ đúng: <strong>${Math.round((score / practiceData.length) * 100)}%</strong></p>
        </div>
    `;
    
    document.getElementById('question-area').style.display = 'none';
    resultArea.style.display = 'block';
}

// Xử lý sự kiện click
document.querySelectorAll('.practice-card').forEach(card => {
    card.addEventListener('click', function() {
        const type = this.dataset.type;
        startPractice(type);
    });
});

// Xử lý phím Enter
document.getElementById('answer-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        checkAnswer();
    }
});
</script>
@endsection
