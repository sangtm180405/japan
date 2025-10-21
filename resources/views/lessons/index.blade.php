@extends('layouts.app')

@section('title', 'Danh sách bài học')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-book me-2"></i>
            Danh sách bài học
        </h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
    </div>

    @if($lessons->count() > 0)
    <div class="row">
        @foreach($lessons as $level => $levelLessons)
        <div class="col-12 mb-5">
            <div class="d-flex align-items-center mb-3">
                <h2 class="h3 mb-0 me-3">
                    <span class="level-badge">{{ $levelLessons->first()->level_name }}</span>
                </h2>
                <span class="text-muted">{{ $levelLessons->count() }} bài học</span>
            </div>
            
            <div class="row">
                @foreach($levelLessons as $lesson)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $lesson->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($lesson->description, 120) }}</p>
                            
                            @php
                                $progress = $userProgress->get($lesson->id);
                            @endphp
                            
                            @if($progress)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="text-muted">Tiến độ</small>
                                        <small class="text-muted">{{ $progress->accuracy_percentage }}%</small>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ $progress->accuracy_percentage }}%"></div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-star me-1"></i>{{ $progress->score }} điểm
                                    </span>
                                    
                                    @if($progress->is_completed)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Hoàn thành
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-clock me-1"></i>Đang học
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-play me-1"></i>Chưa bắt đầu
                                </span>
                            @endif
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('lessons.show', $lesson) }}" class="btn btn-primary w-100">
                                <i class="fas fa-book-open me-2"></i>
                                {{ $progress && $progress->is_completed ? 'Xem lại' : 'Bắt đầu học' }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-book fa-3x text-muted mb-3"></i>
        <h3 class="text-muted">Chưa có bài học nào</h3>
        <p class="text-muted">Vui lòng liên hệ quản trị viên để thêm bài học.</p>
    </div>
    @endif
</div>
@endsection
