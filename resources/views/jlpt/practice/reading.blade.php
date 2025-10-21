<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Luyện tập Đọc hiểu N{{ $data['level'] }} ({{ count($data['reading']) }} bài)
                </h5>
            </div>
            <div class="card-body">
                <!-- Practice Mode Selector -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'reading', 'mode' => 'practice']) }}" 
                               class="btn {{ $data['mode'] == 'practice' ? 'btn-info' : 'btn-outline-info' }}">
                                <i class="fas fa-book-open me-2"></i>Luyện tập
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'reading', 'mode' => 'test']) }}" 
                               class="btn {{ $data['mode'] == 'test' ? 'btn-info' : 'btn-outline-info' }}">
                                <i class="fas fa-clipboard-check me-2"></i>Kiểm tra
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'reading', 'mode' => 'review']) }}" 
                               class="btn {{ $data['mode'] == 'review' ? 'btn-info' : 'btn-outline-info' }}">
                                <i class="fas fa-redo me-2"></i>Ôn tập
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Reading Passages -->
                @foreach($data['reading'] as $index => $reading)
                <div class="card practice-item mb-4">
                    <div class="card-body">
                        <div class="reading-header mb-4">
                            <h4 class="text-info">{{ $reading['title'] }}</h4>
                            <div class="reading-meta">
                                <span class="badge bg-secondary me-2">N{{ $data['level'] }}</span>
                                <span class="text-muted">
                                    <?php
                                        $characters = function_exists('mb_strlen') ? mb_strlen($reading['content'], 'UTF-8') : strlen($reading['content']);
                                        $wordEstimate = (int) ceil($characters / 2); // rough estimate for Japanese
                                        $minutes = (int) max(1, ceil($wordEstimate / 200));
                                    ?>
                                    <i class="fas fa-clock me-1"></i>Thời gian đọc: ~{{ $minutes }} phút
                                </span>
                            </div>
                        </div>
                        
                        <div class="reading-content mb-4">
                            <div class="passage-box p-4 bg-light rounded">
                                <div class="japanese-text reading-text">{{ $reading['content'] }}</div>
                            </div>
                        </div>
                        
                        <div class="questions-section">
                            <h5 class="mb-3">Câu hỏi:</h5>
                            @foreach($reading['questions'] as $qIndex => $question)
                            <div class="question-item mb-4">
                                <div class="question-header">
                                    <h6 class="question-number">Câu {{ $qIndex + 1 }}:</h6>
                                    <p class="question-text">{{ $question['question'] }}</p>
                                </div>
                                
                                @if($data['mode'] == 'practice' || $data['mode'] == 'review')
                                    <div class="answer-section">
                                        <div class="options">
                                            @foreach($question['options'] as $optIndex => $option)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="reading_{{ $index }}_{{ $qIndex }}" value="{{ $option }}" id="reading_{{ $index }}_{{ $qIndex }}_{{ $optIndex }}">
                                                <label class="form-check-label" for="reading_{{ $index }}_{{ $qIndex }}_{{ $optIndex }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="correct-answer mt-2">
                                            <div class="alert alert-success">
                                                <strong>Đáp án:</strong> {{ $question['options'][$question['answer']] }}
                                            </div>
                                        </div>
                                    </div>
                                @elseif($data['mode'] == 'test')
                                    <div class="test-options">
                                        @foreach($question['options'] as $optIndex => $option)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="reading_{{ $index }}_{{ $qIndex }}" value="{{ $option }}" id="test_reading_{{ $index }}_{{ $qIndex }}_{{ $optIndex }}">
                                            <label class="form-check-label" for="test_reading_{{ $index }}_{{ $qIndex }}_{{ $optIndex }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="correct-answer d-none text-success mt-2">
                                        <strong>Đáp án:</strong> {{ $question['options'][$question['answer']] }}
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="reading-actions mt-4">
                            @if($data['mode'] == 'test')
                                <button class="btn btn-outline-success" onclick="checkReadingAnswers({{ $index }})">
                                    <i class="fas fa-check me-2"></i>Kiểm tra đáp án
                                </button>
                            @endif
                            <button class="btn btn-outline-info" onclick="toggleReadingFavorite(this, {{ $index }})">
                                <i class="far fa-heart me-2"></i>Yêu thích
                            </button>
                            <button class="btn btn-outline-primary" onclick="playReadingAudio('{{ $reading['content'] }}')">
                                <i class="fas fa-volume-up me-2"></i>Đọc to
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Progress and Statistics -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6>Tiến độ luyện tập</h6>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%" id="reading-progress"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Đã luyện: <span id="practiced-count">0</span>/{{ count($data['reading']) }}</small>
                                    <small class="text-muted">Độ chính xác: <span id="accuracy">0%</span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6>Thống kê</h6>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="h5 text-success" id="correct-count">0</div>
                                        <small class="text-muted">Đúng</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="h5 text-danger" id="incorrect-count">0</div>
                                        <small class="text-muted">Sai</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="h5 text-info" id="favorite-count">0</div>
                                        <small class="text-muted">Yêu thích</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let practicedCount = 0;
let correctCount = 0;
let incorrectCount = 0;
let favoriteCount = 0;

function checkReadingAnswers(readingIndex) {
    const readingCard = document.querySelectorAll('.practice-item')[readingIndex];
    const questions = readingCard.querySelectorAll('.question-item');
    let readingCorrect = 0;
    let readingTotal = questions.length;
    
    questions.forEach((question, qIndex) => {
        const selectedOption = question.querySelector('input[name^="reading_"]:checked');
        const correctAnswer = question.querySelector('.correct-answer');
        
        if (selectedOption) {
            const userAnswer = selectedOption.value;
            const actualAnswer = correctAnswer.textContent.split(': ')[1].trim();
            
            if (userAnswer === actualAnswer) {
                selectedOption.classList.add('is-valid');
                readingCorrect++;
                correctCount++;
            } else {
                selectedOption.classList.add('is-invalid');
                incorrectCount++;
            }
        } else {
            incorrectCount++;
        }
        
        correctAnswer.classList.remove('d-none');
    });
    
    practicedCount++;
    updateProgress();
    
    // Show reading result
    const readingAccuracy = Math.round((readingCorrect / readingTotal) * 100);
    alert(`Kết quả bài đọc: ${readingCorrect}/${readingTotal} (${readingAccuracy}%)`);
}

function updateProgress() {
    const progressBar = document.getElementById('reading-progress');
    const practicedSpan = document.getElementById('practiced-count');
    const accuracySpan = document.getElementById('accuracy');
    const correctSpan = document.getElementById('correct-count');
    const incorrectSpan = document.getElementById('incorrect-count');
    
    const progress = (practicedCount / {{ count($data['reading']) }}) * 100;
    const accuracy = practicedCount > 0 ? Math.round((correctCount / (correctCount + incorrectCount)) * 100) : 0;
    
    progressBar.style.width = progress + '%';
    practicedSpan.textContent = practicedCount;
    accuracySpan.textContent = accuracy + '%';
    correctSpan.textContent = correctCount;
    incorrectSpan.textContent = incorrectCount;
    
    if (progress >= 100) {
        showCompletionMessage();
    }
}

function showCompletionMessage() {
    const accuracy = Math.round((correctCount / (correctCount + incorrectCount)) * 100);
    let message = '';
    
    if (accuracy >= 90) {
        message = 'Xuất sắc! Bạn đã hoàn thành bài luyện tập đọc hiểu với độ chính xác ' + accuracy + '%';
    } else if (accuracy >= 70) {
        message = 'Tốt! Bạn đã hoàn thành bài luyện tập đọc hiểu với độ chính xác ' + accuracy + '%';
    } else {
        message = 'Bạn đã hoàn thành bài luyện tập đọc hiểu với độ chính xác ' + accuracy + '%. Hãy ôn tập thêm!';
    }
    
    alert(message);
}

function toggleReadingFavorite(button, readingIndex) {
    const icon = button.querySelector('i');
    const isFavorited = icon.classList.contains('fas');
    
    if (isFavorited) {
        icon.classList.remove('fas');
        icon.classList.add('far');
        button.classList.remove('btn-info');
        button.classList.add('btn-outline-info');
        favoriteCount--;
    } else {
        icon.classList.remove('far');
        icon.classList.add('fas');
        button.classList.remove('btn-outline-info');
        button.classList.add('btn-info');
        favoriteCount++;
    }
    
    document.getElementById('favorite-count').textContent = favoriteCount;
    
    console.log('Toggled favorite for reading index:', readingIndex);
}

function playReadingAudio(text) {
    if (typeof AudioPlayer !== 'undefined') {
        AudioPlayer.playText(text);
    }
}

// Estimate reading time (simplified)
function estimateReadingTime(content) {
    const wordsPerMinute = 200; // Average reading speed
    const wordCount = content.length / 2; // Rough estimate for Japanese
    return Math.ceil(wordCount / wordsPerMinute);
}
</script>

<style>
.reading-header {
    border-bottom: 2px solid #17a2b8;
    padding-bottom: 15px;
}

.practice-item {
    transition: all 0.3s ease;
}

.practice-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.passage-box {
    border-left: 4px solid #17a2b8;
    line-height: 1.8;
}

.reading-text {
    font-size: 1.1em;
    line-height: 1.8;
}

.question-item {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #17a2b8;
}

.question-number {
    color: #17a2b8;
    font-weight: bold;
}

.form-check-input.is-valid {
    border-color: #28a745;
}

.form-check-input.is-invalid {
    border-color: #dc3545;
}

.reading-meta .badge {
    font-size: 0.8em;
}
</style>
