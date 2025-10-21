<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-book me-2"></i>
                    Luyện tập Từ vựng N{{ $data['level'] }} ({{ $data['vocabulary']->count() }} từ)
                </h5>
            </div>
            <div class="card-body">
                <!-- Practice Mode Selector -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'vocabulary', 'mode' => 'practice']) }}" 
                               class="btn {{ $data['mode'] == 'practice' ? 'btn-success' : 'btn-outline-success' }}">
                                <i class="fas fa-book-open me-2"></i>Luyện tập
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'vocabulary', 'mode' => 'test']) }}" 
                               class="btn {{ $data['mode'] == 'test' ? 'btn-success' : 'btn-outline-success' }}">
                                <i class="fas fa-clipboard-check me-2"></i>Kiểm tra
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'vocabulary', 'mode' => 'review']) }}" 
                               class="btn {{ $data['mode'] == 'review' ? 'btn-success' : 'btn-outline-success' }}">
                                <i class="fas fa-redo me-2"></i>Ôn tập
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vocabulary Grid -->
                <div class="row">
                    @foreach($data['vocabulary'] as $vocab)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card practice-item h-100">
                            <div class="card-body">
                                <div class="vocab-header text-center mb-3">
                                    <div class="japanese-text h4 mb-2">{{ $vocab->japanese }}</div>
                                    <div class="romaji text-muted mb-2">{{ $vocab->romaji }}</div>
                                </div>
                                
                                @if($data['mode'] == 'practice' || $data['mode'] == 'review')
                                    <div class="vocab-info">
                                        <div class="meaning h6 mb-3 text-center">{{ $vocab->vietnamese }}</div>
                                        
                                        @if($vocab->example)
                                            <div class="example mb-3">
                                                <div class="example-label small text-muted mb-1">Ví dụ:</div>
                                                <div class="japanese-text small">{{ $vocab->example }}</div>
                                                @if($vocab->example_meaning)
                                                    <div class="example-meaning small text-muted">{{ $vocab->example_meaning }}</div>
                                                @endif
                                            </div>
                                        @endif
                                        
                                        @if($vocab->part_of_speech)
                                            <div class="part-of-speech mb-2">
                                                <span class="badge bg-secondary">{{ $vocab->part_of_speech }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @elseif($data['mode'] == 'test')
                                    <div class="test-mode">
                                        <input type="text" class="form-control answer-input mb-2" placeholder="Nhập nghĩa tiếng Việt...">
                                        <div class="correct-answer d-none text-success">
                                            <strong>Đáp án:</strong> {{ $vocab->vietnamese }}
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="card-actions text-center">
                                    <button class="btn btn-sm btn-outline-primary" onclick="playAudio('{{ $vocab->japanese }}')">
                                        <i class="fas fa-volume-up me-1"></i>Âm thanh
                                    </button>
                                    @if($data['mode'] == 'test')
                                        <button class="btn btn-sm btn-outline-success" onclick="checkVocabularyAnswer(this)">
                                            <i class="fas fa-check me-1"></i>Kiểm tra
                                        </button>
                                    @endif
                                    @if($data['mode'] == 'practice' || $data['mode'] == 'review')
                                        <button class="btn btn-sm btn-outline-info" onclick="toggleFavorite(this, {{ $vocab->id }})">
                                            <i class="far fa-heart me-1"></i>Yêu thích
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Progress and Statistics -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6>Tiến độ luyện tập</h6>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%" id="vocab-progress"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Đã luyện: <span id="practiced-count">0</span>/{{ $data['vocabulary']->count() }}</small>
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

function checkVocabularyAnswer(button) {
    const card = button.closest('.card');
    const input = card.querySelector('.answer-input');
    const correctAnswer = card.querySelector('.correct-answer');
    const userAnswer = input.value.trim().toLowerCase();
    const actualAnswer = correctAnswer.textContent.split(': ')[1].toLowerCase();
    
    if (userAnswer === actualAnswer) {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        correctCount++;
    } else {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        incorrectCount++;
    }
    
    correctAnswer.classList.remove('d-none');
    practicedCount++;
    updateProgress();
}

function updateProgress() {
    const progressBar = document.getElementById('vocab-progress');
    const practicedSpan = document.getElementById('practiced-count');
    const accuracySpan = document.getElementById('accuracy');
    const correctSpan = document.getElementById('correct-count');
    const incorrectSpan = document.getElementById('incorrect-count');
    
    const progress = (practicedCount / {{ $data['vocabulary']->count() }}) * 100;
    const accuracy = practicedCount > 0 ? Math.round((correctCount / practicedCount) * 100) : 0;
    
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
    const accuracy = Math.round((correctCount / practicedCount) * 100);
    let message = '';
    
    if (accuracy >= 90) {
        message = 'Xuất sắc! Bạn đã hoàn thành bài luyện tập từ vựng với độ chính xác ' + accuracy + '%';
    } else if (accuracy >= 70) {
        message = 'Tốt! Bạn đã hoàn thành bài luyện tập từ vựng với độ chính xác ' + accuracy + '%';
    } else {
        message = 'Bạn đã hoàn thành bài luyện tập từ vựng với độ chính xác ' + accuracy + '%. Hãy ôn tập thêm!';
    }
    
    alert(message);
}

function toggleFavorite(button, vocabId) {
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
    
    // Here you would typically save to database
    console.log('Toggled favorite for vocabulary ID:', vocabId);
}

function playAudio(text) {
    if (typeof AudioPlayer !== 'undefined') {
        AudioPlayer.playText(text);
    }
}
</script>

<style>
.vocab-header {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 15px;
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

.example {
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    border-left: 3px solid #28a745;
}

.part-of-speech .badge {
    font-size: 0.75em;
}
</style>
