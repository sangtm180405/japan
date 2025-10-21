@extends('layouts.app')

@section('title', 'Kết quả kiểm tra')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('practice.index') }}">Luyện tập</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kết quả</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 mb-3">
                <i class="fas fa-chart-line me-2"></i>
                Kết quả kiểm tra
            </h1>
        </div>
    </div>

    <!-- Score Summary -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="h1 {{ $score >= 80 ? 'text-success' : ($score >= 60 ? 'text-warning' : 'text-danger') }}">
                                {{ $score }}%
                            </div>
                            <p class="text-muted">Điểm số</p>
                        </div>
                        <div class="col-md-3">
                            <div class="h1 text-primary">{{ $correct }}</div>
                            <p class="text-muted">Câu đúng</p>
                        </div>
                        <div class="col-md-3">
                            <div class="h1 text-secondary">{{ $total - $correct }}</div>
                            <p class="text-muted">Câu sai</p>
                        </div>
                        <div class="col-md-3">
                            <div class="h1 text-info">{{ $total }}</div>
                            <p class="text-muted">Tổng câu hỏi</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        @if($score >= 80)
                            <div class="alert alert-success">
                                <h4 class="alert-heading">
                                    <i class="fas fa-trophy me-2"></i>Xuất sắc!
                                </h4>
                                <p class="mb-0">Bạn đã hoàn thành rất tốt bài kiểm tra. Tiếp tục phát huy nhé!</p>
                            </div>
                        @elseif($score >= 60)
                            <div class="alert alert-warning">
                                <h4 class="alert-heading">
                                    <i class="fas fa-thumbs-up me-2"></i>Khá tốt!
                                </h4>
                                <p class="mb-0">Bạn đã làm khá tốt. Hãy luyện tập thêm để cải thiện điểm số.</p>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <h4 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Cần cải thiện!
                                </h4>
                                <p class="mb-0">Hãy luyện tập thêm để nâng cao trình độ tiếng Nhật của bạn.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Results -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Chi tiết câu trả lời
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($results as $index => $result)
                    <div class="result-item mb-4 p-3 border rounded {{ $result['is_correct'] ? 'border-success bg-light' : 'border-danger bg-light' }}">
                        <div class="row">
                            <div class="col-md-1 text-center">
                                <div class="h4 mb-0">
                                    @if($result['is_correct'])
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </div>
                                <small class="text-muted">Câu {{ $index + 1 }}</small>
                            </div>
                            
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>
                                            @if($result['question']['type'] === 'alphabet')
                                                <span class="badge bg-primary me-2">{{ strtoupper($result['question']['character_type']) }}</span>
                                                Nhận diện ký tự
                                            @elseif($result['question']['type'] === 'kanji')
                                                <span class="badge bg-warning me-2">KANJI</span>
                                                Nghĩa của Kanji
                                            @elseif($result['question']['type'] === 'vocabulary')
                                                <span class="badge bg-success me-2">TỪ VỰNG</span>
                                                Dịch từ vựng
                                            @endif
                                        </h6>
                                        
                                        <div class="question-display mb-3">
                                            @if($result['question']['type'] === 'alphabet')
                                                <div class="display-4 japanese-text">{{ $result['question']['question'] }}</div>
                                            @elseif($result['question']['type'] === 'kanji')
                                                <div class="display-4 japanese-text">{{ $result['question']['question'] }}</div>
                                                @if(isset($result['question']['romaji']))
                                                <div class="text-muted h5">{{ $result['question']['romaji'] }}</div>
                                                @endif
                                            @elseif($result['question']['type'] === 'vocabulary')
                                                <div class="display-4 japanese-text">{{ $result['question']['question'] }}</div>
                                                @if(isset($result['question']['romaji']))
                                                <div class="text-muted h5">{{ $result['question']['romaji'] }}</div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="text-success">Đáp án đúng:</h6>
                                                <div class="p-2 bg-success bg-opacity-10 rounded">
                                                    <strong>{{ $result['correct_answer'] }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="text-danger">Câu trả lời của bạn:</h6>
                                                <div class="p-2 {{ $result['is_correct'] ? 'bg-success bg-opacity-10' : 'bg-danger bg-opacity-10' }} rounded">
                                                    <strong>{{ $result['user_answer'] ?: 'Chưa trả lời' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('practice.index') }}" class="btn btn-outline-primary me-3">
                <i class="fas fa-home me-2"></i>Về trang luyện tập
            </a>
            <button type="button" class="btn btn-primary" onclick="location.reload()">
                <i class="fas fa-redo me-2"></i>Làm lại bài kiểm tra
            </button>
        </div>
    </div>
</div>

@push('styles')
<style>
.japanese-text {
    font-family: 'Noto Sans JP', sans-serif;
}

.result-item {
    transition: all 0.3s ease;
}

.result-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-success-rgb), 0.1) !important;
}

.bg-danger.bg-opacity-10 {
    background-color: rgba(var(--bs-danger-rgb), 0.1) !important;
}
</style>
@endpush
@endsection
