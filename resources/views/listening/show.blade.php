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
                            <div class="text-center mb-3">
                                <button class="btn btn-primary btn-lg" onclick="playTTS()">
                                    <i class="fas fa-play me-2"></i>Phát audio (TTS)
                                </button>
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
                            
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Hướng dẫn:</strong> Nhấn nút "Phát audio" để nghe phát âm tiếng Nhật. 
                                Bạn có thể nghe nhiều lần trước khi trả lời câu hỏi.
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary" onclick="playTTS()">
                                        <i class="fas fa-play me-2"></i>Phát audio
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="stopTTS()">
                                        <i class="fas fa-stop me-2"></i>Dừng
                                    </button>
                                </div>
                                <div class="col-md-6 text-end">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Bạn có thể nghe audio nhiều lần
                                    </small>
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
    const transcript = '{{ $listeningExercise->transcript }}';
    
    if (currentUtterance) {
        speechSynthesis.cancel();
    }
    
    currentUtterance = new SpeechSynthesisUtterance(transcript);
    currentUtterance.lang = 'ja-JP';
    currentUtterance.rate = 0.8;
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
        alert('Lỗi phát âm: ' + event.error);
    };
    
    speechSynthesis.speak(currentUtterance);
}

function stopTTS() {
    if (currentUtterance) {
        speechSynthesis.cancel();
        currentUtterance = null;
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
