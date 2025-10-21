@extends('layouts.app')

@section('title', 'Kết quả thi thử JLPT N' . $level)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jlpt.index') }}">JLPT</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kết quả N{{ $level }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-5 mb-2">
                        <span class="badge bg-{{ $level <= 3 ? 'success' : ($level == 4 ? 'warning' : 'danger') }} me-3">
                            N{{ $level }}
                        </span>
                        Kết quả thi thử
                    </h1>
                </div>
                <div>
                    <a href="{{ route('jlpt.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Score Summary -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="score-display mb-4">
                        <div class="score-circle mx-auto mb-3">
                            <div class="score-number {{ $results['passed'] ? 'text-success' : 'text-danger' }}">
                                {{ $results['score'] }}%
                            </div>
                        </div>
                        <h3 class="{{ $results['passed'] ? 'text-success' : 'text-danger' }}">
                            {{ $results['passed'] ? 'ĐẬU' : 'RỚT' }}
                        </h3>
                        <p class="text-muted">
                            {{ $results['correct'] }}/{{ $results['total'] }} câu đúng
                        </p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="h4 text-primary">{{ $results['correct'] }}</div>
                                <small class="text-muted">Câu đúng</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="h4 text-danger">{{ $results['total'] - $results['correct'] }}</div>
                                <small class="text-muted">Câu sai</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="h4 text-info">{{ $results['passing_score'] }}%</div>
                                <small class="text-muted">Điểm đậu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendations -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        Đánh giá và khuyến nghị
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert {{ $results['passed'] ? 'alert-success' : 'alert-warning' }}">
                        <h6>{{ $results['recommendations']['message'] }}</h6>
                    </div>
                    
                    <h6>Khuyến nghị:</h6>
                    <ul class="list-unstyled">
                        @foreach($results['recommendations']['suggestions'] as $suggestion)
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            {{ $suggestion }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Results -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Chi tiết từng câu
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($results['results'] as $index => $result)
                    <div class="question-result mb-3 p-3 {{ $result['is_correct'] ? 'bg-light-success' : 'bg-light-danger' }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h6 class="mb-2">
                                    Câu {{ $index + 1 }}: 
                                    <span class="badge {{ $result['is_correct'] ? 'bg-success' : 'bg-danger' }}">
                                        {{ $result['is_correct'] ? 'Đúng' : 'Sai' }}
                                    </span>
                                </h6>
                                <p class="mb-2">{{ $result['question']['question'] }}</p>
                                
                                @if(isset($result['question']['options']))
                                    <div class="options">
                                        @foreach($result['question']['options'] as $option)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" disabled 
                                                       {{ $option == $result['user_answer'] ? 'checked' : '' }}
                                                       {{ $option == $result['correct_answer'] ? 'style="background-color: #28a745;"' : '' }}>
                                                <label class="form-check-label {{ $option == $result['correct_answer'] ? 'text-success fw-bold' : '' }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="answer-comparison">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Đáp án của bạn:</strong>
                                                <div class="p-2 bg-light rounded">{{ $result['user_answer'] ?: 'Không trả lời' }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Đáp án đúng:</strong>
                                                <div class="p-2 bg-success text-white rounded">{{ $result['correct_answer'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12 text-center">
            <div class="btn-group" role="group">
                <a href="{{ route('jlpt.mock-test', ['level' => $level, 'section' => 'all']) }}" class="btn btn-primary">
                    <i class="fas fa-redo me-2"></i>Thi lại
                </a>
                <a href="{{ route('jlpt.level-practice', ['level' => $level, 'type' => 'mixed', 'mode' => 'practice']) }}" class="btn btn-success">
                    <i class="fas fa-book-open me-2"></i>Luyện tập thêm
                </a>
                <a href="{{ route('jlpt.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-home me-2"></i>Về trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.score-circle {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: bold;
}

.bg-light-success {
    background-color: #d4edda !important;
    border-left: 4px solid #28a745;
}

.bg-light-danger {
    background-color: #f8d7da !important;
    border-left: 4px solid #dc3545;
}

.stat-item {
    text-align: center;
    padding: 15px;
}

.question-result {
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.answer-comparison .bg-light {
    border: 1px solid #dee2e6;
}

.answer-comparison .bg-success {
    border: 1px solid #28a745;
}
</style>
@endpush
@endsection
