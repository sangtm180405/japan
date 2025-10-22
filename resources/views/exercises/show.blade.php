@extends('layouts.app')

@section('title', 'Bài tập')

@section('content')
<div class="main-content">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h1 class="h2 mb-1">{{ $exercise->type_name }}</h1>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary me-3">{{ $exercise->points }} điểm</span>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Bài học: {{ $exercise->lesson->title }}
                        </small>
                    </div>
                </div>
                <a href="{{ route('lessons.show', $exercise->lesson) }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại bài học
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Câu hỏi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6>{{ $exercise->question ?? 'Câu hỏi không có nội dung' }}</h6>
                    </div>

                    @if($exercise->type === 'multiple_choice')
                    <form id="exerciseForm">
                        @csrf
                        <div class="mb-3">
                            @php
                                // Normalize options into array of [label, text, value]
                                $raw = is_string($exercise->options) ? json_decode($exercise->options, true) : $exercise->options;
                                $raw = is_array($raw) ? $raw : [];
                                $letters = ['A','B','C','D','E','F'];
                                $normalized = [];

                                $isAssoc = array_keys($raw) !== range(0, count($raw) - 1);
                                if ($isAssoc) {
                                    // Shape: { 'A': 'Tokyo', 'B': 'Osaka', ... } or { 'A': {text:'Tokyo', value:'A'} }
                                    foreach ($raw as $k => $v) {
                                        if (is_array($v)) {
                                            $normalized[] = [
                                                'label' => (string)$k,
                                                'text' => $v['text'] ?? ($v['label'] ?? $k),
                                                'value' => $v['value'] ?? $k,
                                            ];
                                        } else {
                                            $normalized[] = [
                                                'label' => (string)$k,
                                                'text' => (string)$v,
                                                'value' => (string)$k,
                                            ];
                                        }
                                    }
                                } else {
                                    // Shape: ['Tokyo','Osaka',...] or [{label:'A',text:'Tokyo',value:'A'}]
                                    foreach ($raw as $i => $v) {
                                        if (is_array($v)) {
                                            $normalized[] = [
                                                'label' => $v['label'] ?? ($letters[$i] ?? (string)$i),
                                                'text' => $v['text'] ?? ($v['value'] ?? ''),
                                                'value' => $v['value'] ?? ($v['text'] ?? ''),
                                            ];
                                        } else {
                                            $normalized[] = [
                                                'label' => $letters[$i] ?? (string)$i,
                                                'text' => (string)$v,
                                                'value' => (string)$v,
                                            ];
                                        }
                                    }
                                }
                            @endphp
                            @foreach($normalized as $idx => $opt)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="user_answer" 
                                       id="option{{ $idx }}" value="{{ $opt['value'] }}">
                                <label class="form-check-label" for="option{{ $idx }}">
                                    @if($opt['text'] === $opt['label'])
                                        {{ $opt['label'] }}
                                    @else
                                        <strong>{{ $opt['label'] }}.</strong> {{ $opt['text'] }}
                                    @endif
                                </label>
                            </div>
                            @endforeach
                        </div>
                    @elseif($exercise->type === 'fill_blank')
                    <form id="exerciseForm">
                        @csrf
                        <div class="mb-3">
                            <label for="user_answer" class="form-label">Đáp án của bạn:</label>
                            <input type="text" class="form-control" id="user_answer" name="user_answer" 
                                   placeholder="Nhập đáp án...">
                        </div>
                    @elseif($exercise->type === 'translation')
                    <form id="exerciseForm">
                        @csrf
                        <div class="mb-3">
                            <label for="user_answer" class="form-label">Bản dịch của bạn:</label>
                            <textarea class="form-control" id="user_answer" name="user_answer" 
                                      rows="3" placeholder="Nhập bản dịch..."></textarea>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" onclick="submitAnswer()">
                            <i class="fas fa-paper-plane me-2"></i>Gửi đáp án
                        </button>
                        
                        @if($exercise->audio_file)
                        <button type="button" class="btn btn-outline-secondary" onclick="playAudio()">
                            <i class="fas fa-play me-2"></i>Phát âm thanh
                        </button>
                        @endif
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
                        <a href="{{ route('lessons.show', $exercise->lesson) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại bài học
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
function submitAnswer() {
    const form = document.getElementById('exerciseForm');
    const formData = new FormData(form);
    
    // Show loading
    const submitBtn = document.querySelector('button[onclick="submitAnswer()"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
    submitBtn.disabled = true;
    
    fetch('{{ route("exercises.submit", $exercise) }}', {
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
    
    let resultHtml = '';
    
    if (data.is_correct) {
        resultHtml = `
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Chính xác!</strong> Bạn đã trả lời đúng.
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Đáp án đúng:</strong> ${data.correct_answer}
                </div>
                <div class="col-md-6">
                    <strong>Điểm nhận được:</strong> <span class="badge bg-success">${data.points_earned}</span>
                </div>
            </div>
        `;
    } else {
        resultHtml = `
            <div class="alert alert-danger">
                <i class="fas fa-times-circle me-2"></i>
                <strong>Sai rồi!</strong> Đáp án của bạn không chính xác.
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Đáp án của bạn:</strong> ${document.querySelector('input[name="user_answer"]:checked')?.value || document.getElementById('user_answer').value}
                </div>
                <div class="col-md-6">
                    <strong>Đáp án đúng:</strong> ${data.correct_answer}
                </div>
            </div>
        `;
    }
    
    if (data.explanation) {
        resultHtml += `
            <div class="mt-3">
                <strong>Giải thích:</strong>
                <p class="mt-2">${data.explanation}</p>
            </div>
        `;
    }
    
    // Kiểm tra xem có hoàn thành bài học không
    if (data.lesson_completed) {
        resultHtml += `
            <div class="alert alert-info mt-3">
                <i class="fas fa-trophy me-2"></i>
                <strong>Chúc mừng!</strong> Bạn đã hoàn thành bài học này. Tiến độ và điểm số đã được cập nhật.
            </div>
        `;
    }
    
    resultContent.innerHTML = resultHtml;
    resultSection.style.display = 'block';
    
    // Scroll to result
    resultSection.scrollIntoView({ behavior: 'smooth' });
}

function playAudio() {
    const audio = new Audio('{{ $exercise->audio_file }}');
    audio.play().catch(e => console.log('Audio play failed:', e));
}

function resetExercise() {
    document.getElementById('exerciseForm').reset();
    document.getElementById('resultSection').style.display = 'none';
}
</script>
@endsection
