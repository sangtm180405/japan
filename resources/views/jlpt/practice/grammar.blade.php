<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">
                    <i class="fas fa-language me-2"></i>
                    Luyện tập Ngữ pháp N{{ $data['level'] }} ({{ count($data['grammar']) }} điểm)
                </h5>
            </div>
            <div class="card-body">
                <!-- Practice Mode Selector -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'grammar', 'mode' => 'practice']) }}" 
                               class="btn {{ $data['mode'] == 'practice' ? 'btn-warning' : 'btn-outline-warning' }}">
                                <i class="fas fa-book-open me-2"></i>Luyện tập
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'grammar', 'mode' => 'test']) }}" 
                               class="btn {{ $data['mode'] == 'test' ? 'btn-warning' : 'btn-outline-warning' }}">
                                <i class="fas fa-clipboard-check me-2"></i>Kiểm tra
                            </a>
                            <a href="{{ route('jlpt.level-practice', ['level' => $data['level'], 'type' => 'grammar', 'mode' => 'review']) }}" 
                               class="btn {{ $data['mode'] == 'review' ? 'btn-warning' : 'btn-outline-warning' }}">
                                <i class="fas fa-redo me-2"></i>Ôn tập
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Grammar Points -->
                <div class="row">
                    @foreach($data['grammar'] as $index => $grammar)
                    <div class="col-lg-6 mb-4">
                        <div class="card practice-item h-100">
                            <div class="card-body">
                                <div class="grammar-header mb-3">
                                    <h5 class="card-title text-warning">{{ $grammar['point'] }}</h5>
                                    <p class="card-text text-muted">{{ $grammar['meaning'] }}</p>
                                </div>
                                
                                @if($data['mode'] == 'practice' || $data['mode'] == 'review')
                                    <div class="grammar-content">
                                        <div class="example-section mb-3">
                                            <h6 class="text-primary">Ví dụ:</h6>
                                            <div class="example-box p-3 bg-light rounded">
                                                <div class="japanese-text mb-2">{{ $grammar['example'] }}</div>
                                                <div class="translation text-muted">{{ $grammar['translation'] }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="usage-notes">
                                            <h6 class="text-info">Cách sử dụng:</h6>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check text-success me-2"></i>Được sử dụng trong tình huống trang trọng</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Thường đi với động từ thể ます</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Biểu thị ý nghĩa khẳng định</li>
                                            </ul>
                                        </div>
                                    </div>
                                @elseif($data['mode'] == 'test')
                                    <div class="test-mode">
                                        <div class="question mb-3">
                                            <h6>Điền vào chỗ trống:</h6>
                                            <div class="japanese-text mb-2">私は学生___。</div>
                                            <div class="options">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="grammar_{{ $index }}" value="です">
                                                    <label class="form-check-label">です</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="grammar_{{ $index }}" value="だ">
                                                    <label class="form-check-label">だ</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="grammar_{{ $index }}" value="である">
                                                    <label class="form-check-label">である</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="grammar_{{ $index }}" value="であります">
                                                    <label class="form-check-label">であります</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="correct-answer d-none text-success">
                                            <strong>Đáp án:</strong> です
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="card-actions mt-3">
                                    @if($data['mode'] == 'test')
                                        <button class="btn btn-sm btn-outline-success" onclick="checkGrammarAnswer(this)">
                                            <i class="fas fa-check me-1"></i>Kiểm tra
                                        </button>
                                    @endif
                                    <button class="btn btn-sm btn-outline-info" onclick="toggleGrammarFavorite(this, {{ $index }})">
                                        <i class="far fa-heart me-1"></i>Yêu thích
                                    </button>
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
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" id="grammar-progress"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Đã luyện: <span id="practiced-count">0</span>/{{ count($data['grammar']) }}</small>
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

function checkGrammarAnswer(button) {
    const card = button.closest('.card');
    const selectedOption = card.querySelector('input[name^="grammar_"]:checked');
    const correctAnswer = card.querySelector('.correct-answer');
    
    if (!selectedOption) {
        alert('Vui lòng chọn một đáp án!');
        return;
    }
    
    const userAnswer = selectedOption.value;
    const actualAnswer = correctAnswer.textContent.split(': ')[1].trim();
    
    if (userAnswer === actualAnswer) {
        selectedOption.classList.add('is-valid');
        correctCount++;
    } else {
        selectedOption.classList.add('is-invalid');
        incorrectCount++;
    }
    
    correctAnswer.classList.remove('d-none');
    practicedCount++;
    updateProgress();
}

function updateProgress() {
    const progressBar = document.getElementById('grammar-progress');
    const practicedSpan = document.getElementById('practiced-count');
    const accuracySpan = document.getElementById('accuracy');
    const correctSpan = document.getElementById('correct-count');
    const incorrectSpan = document.getElementById('incorrect-count');
    
    const progress = (practicedCount / {{ count($data['grammar']) }}) * 100;
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
        message = 'Xuất sắc! Bạn đã hoàn thành bài luyện tập ngữ pháp với độ chính xác ' + accuracy + '%';
    } else if (accuracy >= 70) {
        message = 'Tốt! Bạn đã hoàn thành bài luyện tập ngữ pháp với độ chính xác ' + accuracy + '%';
    } else {
        message = 'Bạn đã hoàn thành bài luyện tập ngữ pháp với độ chính xác ' + accuracy + '%. Hãy ôn tập thêm!';
    }
    
    alert(message);
}

function toggleGrammarFavorite(button, grammarIndex) {
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
    
    console.log('Toggled favorite for grammar index:', grammarIndex);
}
</script>

<style>
.grammar-header {
    border-bottom: 2px solid #ffc107;
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

.example-box {
    border-left: 4px solid #007bff;
}

.usage-notes {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border-left: 4px solid #17a2b8;
}

.form-check-input.is-valid {
    border-color: #28a745;
}

.form-check-input.is-invalid {
    border-color: #dc3545;
}
</style>
