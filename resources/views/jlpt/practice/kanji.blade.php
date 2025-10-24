    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-pen me-2"></i>
                    Luyện tập Kanji N{{ $data['level'] }} ({{ $data['kanji']->count() }} từ)
                </h5>
            </div>
            <div class="card-body">
                <!-- Practice Mode Selector -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'kanji', 'mode' => 'practice']) }}" 
                               class="btn {{ $data['mode'] == 'practice' ? 'btn-primary' : 'btn-outline-primary' }}">
                                <i class="fas fa-book-open me-2"></i>Luyện tập
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'kanji', 'mode' => 'test']) }}" 
                               class="btn {{ $data['mode'] == 'test' ? 'btn-primary' : 'btn-outline-primary' }}">
                                <i class="fas fa-clipboard-check me-2"></i>Kiểm tra
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'kanji', 'mode' => 'review']) }}" 
                               class="btn {{ $data['mode'] == 'review' ? 'btn-primary' : 'btn-outline-primary' }}">
                                <i class="fas fa-redo me-2"></i>Ôn tập
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kanji Grid -->
                <div class="row">
                    @foreach($data['kanji'] as $kanji)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card practice-item h-100">
                            <div class="card-body text-center">
                                <div class="kanji-character japanese-text display-4 mb-3">{{ $kanji->character }}</div>
                                
                                @if($data['mode'] == 'practice' || $data['mode'] == 'review')
                                    <div class="kanji-info">
                                        <div class="romaji text-muted mb-2">{{ $kanji->romaji }}</div>
                                        <div class="meaning h6 mb-2">{{ $kanji->description }}</div>
                                        @if($kanji->stroke_count)
                                            <div class="stroke-count small text-muted mb-2">
                                                <i class="fas fa-pen-nib me-1"></i>{{ $kanji->stroke_count }} nét
                                            </div>
                                        @endif
                                        @if($kanji->kun_reading)
                                            <div class="readings small">
                                                <div class="kun-reading">
                                                    <strong>Kun:</strong> {{ $kanji->kun_reading }}
                                                </div>
                                                @if($kanji->on_reading)
                                                <div class="on-reading">
                                                    <strong>On:</strong> {{ $kanji->on_reading }}
                                                </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @elseif($data['mode'] == 'test')
                                    <div class="test-mode">
                                        <div class="romaji text-muted mb-3">{{ $kanji->romaji }}</div>
                                        <input type="text" class="form-control answer-input" placeholder="Nhập nghĩa tiếng Việt...">
                                        <div class="correct-answer d-none text-success mt-2" data-answer="{{ $kanji->description }}">
                                            <strong>Đáp án:</strong> {{ $kanji->description }}
                                        </div>
                                        <div class="result-feedback mt-2"></div>
                                    </div>
                                @endif
                                
                                <div class="card-actions mt-3">
                                    <button class="btn btn-sm btn-outline-primary" onclick="playAudio('{{ $kanji->character }}')">
                                        <i class="fas fa-volume-up me-1"></i>Âm thanh
                                    </button>
                                    @if($data['mode'] == 'test')
                                        <button class="btn btn-sm btn-outline-success" onclick="checkAnswer(this)">
                                            <i class="fas fa-check me-1"></i>Kiểm tra
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Progress Bar -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6>Tiến độ luyện tập</h6>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" id="kanji-progress"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Đã luyện: <span id="practiced-count">0</span>/{{ $data['kanji']->count() }}</small>
                                    <small class="text-muted">Độ chính xác: <span id="accuracy">0%</span></small>
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

function checkAnswer(button) {
    const card = button.closest('.card');
    const input = card.querySelector('.answer-input');
    const correctAnswer = card.querySelector('.correct-answer');
    const feedback = card.querySelector('.result-feedback');
    
    if (!input || !correctAnswer) {
        console.error('Không tìm thấy input hoặc correctAnswer element');
        alert('Lỗi: Không tìm thấy phần tử cần thiết!');
        return;
    }
    
    const userAnswer = input.value.trim().toLowerCase();
    
    // Lấy đáp án đúng từ data attribute
    let actualAnswer = '';
    if (correctAnswer.dataset.answer) {
        actualAnswer = correctAnswer.dataset.answer.toLowerCase().trim();
    } else {
        // Fallback: lấy từ text content
        const answerText = correctAnswer.textContent;
        if (answerText.includes(': ')) {
            actualAnswer = answerText.split(': ')[1].toLowerCase().trim();
        } else {
            actualAnswer = answerText.replace('Đáp án:', '').toLowerCase().trim();
        }
    }
    
    // Hiển thị đáp án ngay lập tức
    correctAnswer.classList.remove('d-none');
    
    if (userAnswer === actualAnswer) {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        correctCount++;
        
        if (feedback) {
            feedback.innerHTML = '<div class="alert alert-success alert-sm mb-0"><i class="fas fa-check me-1"></i>Chính xác!</div>';
        }
    } else {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        
        if (feedback) {
            feedback.innerHTML = '<div class="alert alert-danger alert-sm mb-0"><i class="fas fa-times me-1"></i>Sai rồi!</div>';
        }
    }
    
    // Vô hiệu hóa nút kiểm tra sau khi đã kiểm tra
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-check me-1"></i>Đã kiểm tra';
    button.classList.remove('btn-outline-success');
    button.classList.add('btn-secondary');
    
    practicedCount++;
    updateProgress();
}

function updateProgress() {
    const progressBar = document.getElementById('kanji-progress');
    const practicedSpan = document.getElementById('practiced-count');
    const accuracySpan = document.getElementById('accuracy');
    
    const progress = (practicedCount / {{ $data['kanji']->count() }}) * 100;
    const accuracy = practicedCount > 0 ? Math.round((correctCount / practicedCount) * 100) : 0;
    
    progressBar.style.width = progress + '%';
    practicedSpan.textContent = practicedCount;
    accuracySpan.textContent = accuracy + '%';
    
    if (progress >= 100) {
        showCompletionMessage();
    }
}

function showCompletionMessage() {
    const accuracy = Math.round((correctCount / practicedCount) * 100);
    let message = '';
    
    if (accuracy >= 90) {
        message = 'Xuất sắc! Bạn đã hoàn thành bài luyện tập với độ chính xác ' + accuracy + '%';
    } else if (accuracy >= 70) {
        message = 'Tốt! Bạn đã hoàn thành bài luyện tập với độ chính xác ' + accuracy + '%';
    } else {
        message = 'Bạn đã hoàn thành bài luyện tập với độ chính xác ' + accuracy + '%. Hãy ôn tập thêm!';
    }
    
    alert(message);
}

function playAudio(text) {
    if (typeof AudioPlayer !== 'undefined') {
        AudioPlayer.playText(text);
    }
}

</script>

<style>
.kanji-character {
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: bold;
    color: #2c3e50;
}

.practice-item {
    transition: all 0.3s ease;
    cursor: pointer;
}

.practice-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.answer-input.is-valid {
    border-color: #28a745;
}

.answer-input.is-invalid {
    border-color: #dc3545;
}

.readings {
    background-color: #f8f9fa;
    padding: 8px;
    border-radius: 4px;
    margin-top: 8px;
}

.alert-sm {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
}

.correct-answer {
    font-weight: bold;
    background-color: #d4edda;
    padding: 0.5rem;
    border-radius: 0.375rem;
    border: 1px solid #c3e6cb;
}

.result-feedback {
    min-height: 2rem;
}
</style>
