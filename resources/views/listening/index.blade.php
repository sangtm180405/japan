@extends('layouts.app')

@section('title', 'Luyện nghe tiếng Nhật')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-headphones me-2"></i>
            Luyện nghe tiếng Nhật
        </h1>
        <a href="{{ route('listening.practice') }}" class="btn btn-primary">
            <i class="fas fa-play me-2"></i>Bắt đầu luyện nghe
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Hướng dẫn:</strong> Chọn bài luyện nghe phù hợp với trình độ của bạn. 
                Nghe audio và trả lời các câu hỏi để cải thiện kỹ năng nghe hiểu.
            </div>
        </div>
    </div>

    @if($exercises->count() > 0)
        @foreach($exercises as $level => $levelExercises)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-3">
                <h3 class="h4 mb-0 me-3">
                    <span class="badge bg-primary">{{ $levelExercises->first()->level_name }}</span>
                    Cấp độ {{ $levelExercises->first()->level_name }}
                </h3>
                <span class="text-muted">{{ $levelExercises->count() }} bài luyện nghe</span>
            </div>
            
            <div class="row">
                @foreach($levelExercises as $exercise)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $exercise->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($exercise->description, 100) }}</p>
                            
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
                                <span class="badge bg-success">{{ $exercise->points }} điểm</span>
                                <span class="badge bg-info">{{ count($exercise->questions) }} câu hỏi</span>
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
        </div>
        @endforeach
    @else
        <div class="text-center py-5">
            <i class="fas fa-headphones fa-3x text-muted mb-3"></i>
            <h3 class="text-muted">Chưa có bài luyện nghe nào</h3>
            <p class="text-muted">Vui lòng liên hệ quản trị viên để thêm bài luyện nghe.</p>
        </div>
    @endif
</div>
@endsection
