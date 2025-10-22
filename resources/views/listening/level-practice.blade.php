@extends('layouts.app')

@section('title', 'Luyện nghe - Cấp độ ' . $levelName)

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-headphones me-2"></i>
            Luyện nghe - Cấp độ {{ $levelName }}
        </h1>
        <a href="{{ route('listening.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Hướng dẫn:</strong> Các bài luyện nghe cấp độ {{ $levelName }} được thiết kế phù hợp với trình độ của bạn. 
                Hãy nghe audio cẩn thận và trả lời các câu hỏi.
            </div>
        </div>
    </div>

    @if($exercises->count() > 0)
        <div class="row">
            @foreach($exercises as $exercise)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary">{{ $exercise->level_name }}</span>
                        <span class="badge bg-success">{{ $exercise->points }} điểm</span>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $exercise->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($exercise->description, 120) }}</p>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $exercise->formatted_duration }}
                                </small>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">
                                    <i class="fas fa-star me-1"></i>
                                    {{ $exercise->difficulty_name }}
                                </small>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-info">{{ count($exercise->questions) }} câu hỏi</span>
                            <span class="badge bg-warning">{{ $exercise->level_name }}</span>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('listening.show', $exercise) }}" class="btn btn-primary w-100">
                            <i class="fas fa-play me-2"></i>Bắt đầu luyện nghe
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-headphones fa-3x text-muted mb-3"></i>
            <h3 class="text-muted">Chưa có bài luyện nghe nào cho cấp độ {{ $levelName }}</h3>
            <p class="text-muted">Vui lòng liên hệ quản trị viên để thêm bài luyện nghe cho cấp độ này.</p>
        </div>
    @endif
</div>
@endsection
