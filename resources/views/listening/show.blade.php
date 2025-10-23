@extends('layouts.app')

@section('title', 'Luyện nghe - ' . $listeningExercise->title)

@section('content')
<div class="main-content">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h1 class="h2 mb-1">{{ $listeningExercise->title }}</h1>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary me-3">{{ $listeningExercise->level_name }}</span>
                        <span class="badge bg-success me-3">{{ $listeningExercise->points }} điểm</span>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            {{ $listeningExercise->formatted_duration }}
                        </small>
                    </div>
                </div>
                <a href="{{ route('listening.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Audio Player -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-volume-up me-2"></i>
                        Audio
                    </h5>
                </div>
                <div class="card-body">
                    <div class="audio-player-container">
                        <div id="ttsPlayer">
                            <!-- Audio Controls -->
                            <div class="audio-controls mb-4">
                                <div class="row align-items-center justify-content-center">
                                    <!-- TTS Speed Control -->
                                    <div class="col-auto mb-3 mb-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="form-label me-2 mb-0 fw-semibold">
                                                <i class="fas fa-tachometer-alt me-1 text-primary"></i>
                                            </label>
                                            <select class="form-select form-select-sm" id="ttsSpeed" style="min-width: 140px;">
                                                <option value="0.8">0.8x (Chậm)</option>
                                                <option value="1.0" selected>1.0x (Bình thường)</option>
                                                <option value="1.2">1.2x (Nhanh)</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Control Buttons -->
                                    <div class="col-auto">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary btn-lg px-4" onclick="playTTS()">
                                                <i class="fas fa-play me-2"></i>Phát audio
                                            </button>
                                            <button class="btn btn-outline-secondary btn-lg px-4" onclick="stopTTS()">
                                                <i class="fas fa-stop me-2"></i>Dừng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Transcript Display -->
                            <div class="transcript-section">
                                <h6 class="mb-3">
                                    <i class="fas fa-file-text me-2"></i>
                                    Nội dung audio:
                                </h6>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-primary">Tiếng Nhật:</h6>
                                                <p class="fs-5 mb-3">{{ $listeningExercise->transcript }}</p>
                                                
                                                <h6 class="text-success">Romaji:</h6>
                                                <p class="text-muted">{{ $listeningExercise->transcript_romaji }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-info">Tiếng Việt:</h6>
                                                <p class="text-muted">{{ $listeningExercise->transcript_vietnamese }}</p>
                                                
                                                <h6 class="text-warning">English:</h6>
                                                <p class="text-muted">{{ $listeningExercise->transcript_english }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Questions Form -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Câu hỏi ({{ count($listeningExercise->questions) }} câu)
                    </h5>
                </div>
                <div class="card-body">
                    <form id="listeningForm">
                        @csrf
                        @foreach($listeningExercise->questions as $index => $question)
                        <div class="mb-4">
                            <div class="question-item">
                                <h6 class="question-title">
                                    Câu {{ $index + 1 }}: {{ $question['question'] }}
                                </h6>
                                
                                @if($question['type'] === 'multiple_choice')
                                    <div class="mt-2">
                                        @foreach($question['options'] as $optionIndex => $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="answers[{{ $index }}]" 
                                                   id="q{{ $index }}_option{{ $optionIndex }}" 
                                                   value="{{ $option }}">
                                            <label class="form-check-label" for="q{{ $index }}_option{{ $optionIndex }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                @elseif($question['type'] === 'fill_blank')
                                    <div class="mt-2">
                                        <input type="text" class="form-control" 
                                               name="answers[{{ $index }}]" 
                                               placeholder="Nhập đáp án của bạn...">
                                    </div>
                                @elseif($question['type'] === 'true_false')
                                    <div class="mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="answers[{{ $index }}]" 
                                                   id="q{{ $index }}_true" 
                                                   value="true">
                                            <label class="form-check-label" for="q{{ $index }}_true">
                                                Đúng
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="answers[{{ $index }}]" 
                                                   id="q{{ $index }}_false" 
                                                   value="false">
                                            <label class="form-check-label" for="q{{ $index }}_false">
                                                Sai
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary" onclick="submitAnswers()">
                                <i class="fas fa-paper-plane me-2"></i>Nộp bài
                            </button>
                            
                            <button type="button" class="btn btn-outline-secondary" onclick="playTTS()">
                                <i class="fas fa-redo me-2"></i>Nghe lại
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Result Section -->
            <div id="resultSection" class="card mt-4" style="display: none;">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Kết quả
                    </h5>
                </div>
                <div class="card-body">
                    <div id="resultContent"></div>
                    
                    <div class="mt-3">
                        <a href="{{ route('listening.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                        </a>
                        <button type="button" class="btn btn-outline-primary" onclick="resetExercise()">
                            <i class="fas fa-redo me-2"></i>Làm lại
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentUtterance = null;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize TTS
    if ('speechSynthesis' in window) {
        console.log('TTS is supported');
    } else {
        console.log('TTS is not supported');
    }
});

function playTTS() {
    try {
        const transcript = '{{ $listeningExercise->transcript }}';
        
        // Get selected speed
        const speedSelect = document.getElementById('ttsSpeed');
        const selectedSpeed = parseFloat(speedSelect.value);
        
        // Stop any current speech first
        if (currentUtterance || speechSynthesis.speaking) {
            speechSynthesis.cancel();
        }
        
        currentUtterance = new SpeechSynthesisUtterance(transcript);
        currentUtterance.lang = 'ja-JP';
        currentUtterance.rate = selectedSpeed;
        currentUtterance.pitch = 1;
        currentUtterance.volume = 1;
    
    // Try to use Japanese voice
    const voices = speechSynthesis.getVoices();
    const japaneseVoice = voices.find(voice => 
        voice.lang.includes('ja') || 
        voice.name.includes('Japanese') ||
        voice.name.includes('Yuki') ||
        voice.name.includes('Kyoko')
    );
    
    if (japaneseVoice) {
        currentUtterance.voice = japaneseVoice;
        console.log('Using Japanese voice:', japaneseVoice.name);
    } else {
        console.log('No Japanese voice found, using default');
    }
    
    currentUtterance.onstart = function() {
        console.log('TTS started');
    };
    
    currentUtterance.onend = function() {
        console.log('TTS ended');
        currentUtterance = null;
    };
    
    currentUtterance.onerror = function(event) {
        console.error('TTS error:', event.error);
        // Removed alert popup - just log to console
        currentUtterance = null;
    };
    
    speechSynthesis.speak(currentUtterance);
    } catch (error) {
        console.error('TTS play error:', error);
        // Don't show alert - just log the error
        currentUtterance = null;
    }
}

function stopTTS() {
    try {
        if (currentUtterance) {
            // Cancel current utterance
            speechSynthesis.cancel();
            currentUtterance = null;
            console.log('TTS stopped successfully');
        }
        
        // Also cancel any pending speech
        if (speechSynthesis.speaking) {
            speechSynthesis.cancel();
        }
    } catch (error) {
        console.log('Stop TTS error (ignored):', error);
        // Ignore errors when stopping - this is normal behavior
    }
}

function submitAnswers() {
    const form = document.getElementById('listeningForm');
    const formData = new FormData(form);
    
    // Show loading
    const submitBtn = document.querySelector('button[onclick="submitAnswers()"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang chấm bài...';
    submitBtn.disabled = true;
    
    fetch('{{ route("listening.submit", $listeningExercise) }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        showResult(data);
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại.');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

function showResult(data) {
    const resultSection = document.getElementById('resultSection');
    const resultContent = document.getElementById('resultContent');
    
    let resultHtml = `
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="h2 ${data.passed ? 'text-success' : 'text-danger'}">${data.accuracy}%</div>
                    <small class="text-muted">Độ chính xác</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="h2 text-primary">${data.total_correct}/${data.total_questions}</div>
                    <small class="text-muted">Câu đúng</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="h2 text-warning">${data.points_earned}</div>
                    <small class="text-muted">Điểm nhận được</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="h2 ${data.passed ? 'text-success' : 'text-danger'}">
                        <i class="fas fa-${data.passed ? 'check' : 'times'}"></i>
                    </div>
                    <small class="text-muted">${data.passed ? 'Đạt' : 'Chưa đạt'}</small>
                </div>
            </div>
        </div>
    `;
    
    if (data.passed) {
        resultHtml += `
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Chúc mừng!</strong> Bạn đã hoàn thành bài luyện nghe này.
            </div>
        `;
    } else {
        resultHtml += `
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Cần cải thiện!</strong> Hãy nghe lại và làm bài cẩn thận hơn.
            </div>
        `;
    }
    
    // Show detailed results
    resultHtml += '<h6>Chi tiết câu trả lời:</h6>';
    resultHtml += '<div class="accordion" id="resultsAccordion">';
    
    data.results.forEach((result, index) => {
        resultHtml += `
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading${index}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}">
                        Câu ${index + 1}: ${result.is_correct ? '✅ Đúng' : '❌ Sai'}
                    </button>
                </h2>
                <div id="collapse${index}" class="accordion-collapse collapse" data-bs-parent="#resultsAccordion">
                    <div class="accordion-body">
                        <p><strong>Câu hỏi:</strong> ${result.question}</p>
                        <p><strong>Đáp án của bạn:</strong> ${result.user_answer}</p>
                        <p><strong>Đáp án đúng:</strong> ${result.correct_answer}</p>
                    </div>
                </div>
            </div>
        `;
    });
    
    resultHtml += '</div>';
    
    resultContent.innerHTML = resultHtml;
    resultSection.style.display = 'block';
    
    // Scroll to result
    resultSection.scrollIntoView({ behavior: 'smooth' });
}

function resetExercise() {
    document.getElementById('listeningForm').reset();
    document.getElementById('resultSection').style.display = 'none';
    stopTTS();
}
</script>
@endsection

@section('styles')
<style>
    .japanese-text {
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 1.2em;
        font-weight: 500;
    }
    
    .transcript-section {
        margin-top: 20px;
    }
    
    .audio-player-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    
    .audio-controls {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .btn-group .btn {
        border-radius: 10px;
        margin: 0 3px;
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 140px;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .btn-group .btn:first-child {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        margin-right: 0;
    }
    
    .btn-group .btn:last-child {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        margin-left: 0;
    }
    
    .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .form-label {
        color: #495057;
        font-size: 0.95rem;
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .audio-controls {
            padding: 15px;
        }
        
        .btn-group .btn {
            min-width: 120px;
            font-size: 0.9rem;
            padding: 8px 16px;
        }
        
        .form-select {
            font-size: 0.9rem;
        }
    }
    
    /* Loading States */
    .btn.loading {
        position: relative;
        pointer-events: none;
    }
    
    .btn.loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection
