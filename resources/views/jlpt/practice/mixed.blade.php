<div class="row">
    <!-- Kanji Section -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-pen me-2"></i>
                    Kanji ({{ $data['mixed']['kanji']->count() }} từ)
                </h5>
            </div>
            <div class="card-body" id="kanji-section">
                <div class="row">
                    @foreach($data['mixed']['kanji'] as $kanji)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card practice-item">
                            <div class="card-body text-center">
                                <div class="japanese-text h4 mb-2">{{ $kanji->character }}</div>
                                <div class="text-muted small mb-2">{{ $kanji->romaji }}</div>
                                <div class="meaning">{{ $kanji->meaning }}</div>
                                @if($data['mode'] == 'test')
                                    <input type="text" class="form-control mt-2 answer-input" placeholder="Nhập nghĩa...">
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @php
                    $kanjiCount = $data['mixed']['kanji']->count();
                    $kanjiLimit = request('kanji_limit', 6);
                    $totalKanji = $data['mixed']['totalKanji'] ?? 0;
                    // Debug: Log the values
                    \Log::info('Mixed practice debug', [
                        'kanjiCount' => $kanjiCount,
                        'kanjiLimit' => $kanjiLimit,
                        'totalKanji' => $totalKanji,
                        'data_keys' => array_keys($data['mixed'] ?? [])
                    ]);
                @endphp
                @if($kanjiLimit < $totalKanji)
                <div class="text-center">
                    <button class="btn btn-outline-primary" onclick="loadMoreKanji()" id="kanji-load-more-btn">
                        <i class="fas fa-plus me-2"></i>Xem thêm ({{ $totalKanji - $kanjiLimit }} còn lại)
                    </button>
                </div>
                @else
                <div class="text-center">
                    <div class="alert alert-info">Đã hiển thị tất cả Kanji ({{ $totalKanji }} từ)</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Vocabulary Section -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-book me-2"></i>
                    Từ vựng ({{ $data['mixed']['vocabulary']->count() }} từ)
                </h5>
            </div>
            <div class="card-body" id="vocab-section">
                <div class="row">
                    @foreach($data['mixed']['vocabulary'] as $vocab)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card practice-item">
                            <div class="card-body text-center">
                                <div class="japanese-text h5 mb-2">{{ $vocab->japanese }}</div>
                                <div class="text-muted small mb-2">{{ $vocab->romaji }}</div>
                                <div class="meaning">{{ $vocab->vietnamese }}</div>
                                <button class="btn btn-sm btn-outline-primary mt-2" onclick="playAudio('{{ $vocab->japanese }}')">
                                    <i class="fas fa-volume-up"></i>
                                </button>
                                @if($data['mode'] == 'test')
                                    <input type="text" class="form-control mt-2 answer-input" placeholder="Nhập nghĩa...">
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @php
                    $vocabCount = $data['mixed']['vocabulary']->count();
                    $vocabLimit = request('vocab_limit', 6);
                    $totalVocab = $data['mixed']['totalVocab'] ?? 0;
                @endphp
                @if($vocabLimit < $totalVocab)
                <div class="text-center">
                    <button class="btn btn-outline-success" onclick="loadMoreVocabulary()" id="vocab-load-more-btn">
                        <i class="fas fa-plus me-2"></i>Xem thêm ({{ $totalVocab - $vocabLimit }} còn lại)
                    </button>
                </div>
                @else
                <div class="text-center">
                    <div class="alert alert-info">Đã hiển thị tất cả từ vựng ({{ $totalVocab }} từ)</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Grammar Section -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">
                    <i class="fas fa-language me-2"></i>
                    Ngữ pháp ({{ count($data['mixed']['grammar']) }} điểm)
                </h5>
            </div>
            <div class="card-body">
                @foreach($data['mixed']['grammar'] as $grammar)
                <div class="card practice-item mb-3">
                    <div class="card-body">
                        <h6 class="card-title">{{ $grammar['point'] }}</h6>
                        <p class="card-text text-muted">{{ $grammar['meaning'] }}</p>
                        <div class="example">
                            <strong>Ví dụ:</strong>
                            <div class="japanese-text mt-1">{{ $grammar['example'] }}</div>
                            <div class="text-muted small">{{ $grammar['translation'] }}</div>
                        </div>
                        @if($data['mode'] == 'test')
                            <input type="text" class="form-control mt-2 answer-input" placeholder="Giải thích ngữ pháp...">
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Reading Section -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Đọc hiểu ({{ count($data['mixed']['reading']) }} bài)
                </h5>
            </div>
            <div class="card-body">
                @foreach($data['mixed']['reading'] as $reading)
                <div class="card practice-item mb-3">
                    <div class="card-body">
                        <h6 class="card-title">{{ $reading['title'] }}</h6>
                        <div class="reading-content mb-3">
                            <div class="japanese-text">{{ $reading['content'] }}</div>
                        </div>
                        <div class="questions">
                            @foreach($reading['questions'] as $question)
                            <div class="question mb-2">
                                <div class="question-text">{{ $question['question'] }}</div>
                                @if($data['mode'] == 'test')
                                    <div class="options mt-2">
                                        @foreach($question['options'] as $index => $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="reading_{{ $loop->parent->index }}_{{ $loop->index }}" value="{{ $option }}">
                                            <label class="form-check-label">{{ $option }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="answer text-success small mt-1">
                                        Đáp án: {{ $question['options'][$question['answer']] }}
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
console.log('=== Mixed practice script loaded ===');

// Get current limits from URL parameters
const urlParams = new URLSearchParams(window.location.search);
const kanjiLimit = parseInt(urlParams.get('kanji_limit')) || 6;
const vocabLimit = parseInt(urlParams.get('vocab_limit')) || 6;

// Get totals from PHP
const totalKanji = {{ $totalKanji ?? 0 }};
const totalVocab = {{ $totalVocab ?? 0 }};

console.log('Current state:', { 
    kanjiLimit, 
    vocabLimit, 
    totalKanji, 
    totalVocab,
    url: window.location.href 
});

function loadMoreKanji() {
    console.log('=== loadMoreKanji called ===');
    
    const currentKanjiLimit = window.kanjiLimit || kanjiLimit;
    if (currentKanjiLimit >= totalKanji) {
        alert('Đã hiển thị tất cả Kanji!');
        return;
    }
    
    const btn = document.getElementById('kanji-load-more-btn');
    if (!btn) {
        console.error('Kanji button not found!');
        return;
    }
    
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tải...';
    btn.disabled = true;
    
    // AJAX request instead of page reload
    const url = new URL(window.location);
    const newLimit = Math.min(currentKanjiLimit + 6, totalKanji);
    url.searchParams.set('kanji_limit', newLimit);
    
    fetch(url.toString())
        .then(response => response.text())
        .then(html => {
            // Parse the response and extract only the kanji section
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newKanjiSection = doc.querySelector('#kanji-section');
            
            if (newKanjiSection) {
                // Replace the kanji section
                const currentKanjiSection = document.querySelector('#kanji-section');
                if (currentKanjiSection) {
                    currentKanjiSection.innerHTML = newKanjiSection.innerHTML;
                }
                
                // Update button
                if (newLimit >= totalKanji) {
                    btn.parentElement.innerHTML = '<div class="alert alert-info">Đã hiển thị tất cả Kanji (' + totalKanji + ' từ)</div>';
                } else {
                    btn.innerHTML = '<i class="fas fa-plus me-2"></i>Xem thêm (' + (totalKanji - newLimit) + ' còn lại)';
                    btn.disabled = false;
                }
                
                // Update global variables
                window.kanjiLimit = newLimit;
                
                // Update URL without reload
                window.history.pushState({}, '', url.toString());
            }
        })
        .catch(error => {
            console.error('Error loading more kanji:', error);
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert('Có lỗi khi tải dữ liệu. Vui lòng thử lại.');
        });
}

function loadMoreVocabulary() {
    console.log('=== loadMoreVocabulary called ===');
    
    const currentVocabLimit = window.vocabLimit || vocabLimit;
    if (currentVocabLimit >= totalVocab) {
        alert('Đã hiển thị tất cả từ vựng!');
        return;
    }
    
    const btn = document.getElementById('vocab-load-more-btn');
    if (!btn) {
        console.error('Vocabulary button not found!');
        return;
    }
    
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tải...';
    btn.disabled = true;
    
    // AJAX request instead of page reload
    const url = new URL(window.location);
    const newLimit = Math.min(currentVocabLimit + 6, totalVocab);
    url.searchParams.set('vocab_limit', newLimit);
    
    fetch(url.toString())
        .then(response => response.text())
        .then(html => {
            // Parse the response and extract only the vocabulary section
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newVocabSection = doc.querySelector('#vocab-section');
            
            if (newVocabSection) {
                // Replace the vocabulary section
                const currentVocabSection = document.querySelector('#vocab-section');
                if (currentVocabSection) {
                    currentVocabSection.innerHTML = newVocabSection.innerHTML;
                }
                
                // Update button
                if (newLimit >= totalVocab) {
                    btn.parentElement.innerHTML = '<div class="alert alert-info">Đã hiển thị tất cả từ vựng (' + totalVocab + ' từ)</div>';
                } else {
                    btn.innerHTML = '<i class="fas fa-plus me-2"></i>Xem thêm (' + (totalVocab - newLimit) + ' còn lại)';
                    btn.disabled = false;
                }
                
                // Update global variables
                window.vocabLimit = newLimit;
                
                // Update URL without reload
                window.history.pushState({}, '', url.toString());
            }
        })
        .catch(error => {
            console.error('Error loading more vocabulary:', error);
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert('Có lỗi khi tải dữ liệu. Vui lòng thử lại.');
        });
}

function playAudio(text) {
    console.log('playAudio called with:', text);
    if (typeof AudioPlayer !== 'undefined') {
        AudioPlayer.playText(text);
    } else if (window.playText) {
        window.playText(text, { lang: 'ja-JP' });
    } else {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'ja-JP';
        speechSynthesis.speak(utterance);
    }
}

// Make functions globally available
window.loadMoreKanji = loadMoreKanji;
window.loadMoreVocabulary = loadMoreVocabulary;
window.playAudio = playAudio;

// Initialize global variables
window.kanjiLimit = kanjiLimit;
window.vocabLimit = vocabLimit;

console.log('Functions registered globally');
console.log('=== Script initialization complete ===');
</script>
@endpush
