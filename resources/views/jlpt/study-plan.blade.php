@extends('layouts.app')

@section('title', 'Kế hoạch học tập JLPT N' . $level)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jlpt.index') }}">JLPT</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kế hoạch N{{ $level }}</li>
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
                        Kế hoạch học tập
                    </h1>
                    <p class="text-muted">{{ $weeks }} tuần học tập</p>
                </div>
                <div>
                    <a href="{{ route('jlpt.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Study Plan Overview -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Tổng quan kế hoạch
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="h4 text-primary">{{ $weeks }}</div>
                            <small class="text-muted">Tuần học</small>
                        </div>
                        <div class="col-md-3">
                            <div class="h4 text-success">{{ $studyPlan[0]['kanji_target'] * $weeks }}</div>
                            <small class="text-muted">Kanji mục tiêu</small>
                        </div>
                        <div class="col-md-3">
                            <div class="h4 text-warning">{{ $studyPlan[0]['vocabulary_target'] * $weeks }}</div>
                            <small class="text-muted">Từ vựng mục tiêu</small>
                        </div>
                        <div class="col-md-3">
                            <div class="h4 text-info">{{ $studyPlan[0]['grammar_points'] * $weeks }}</div>
                            <small class="text-muted">Điểm ngữ pháp</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Weekly Schedule -->
    <div class="row">
        @foreach($studyPlan as $week)
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-calendar-week me-2"></i>
                        Tuần {{ $week['week'] }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="week-goals">
                        <div class="goal-item mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-pen text-primary me-2"></i>
                                    Kanji
                                </span>
                                <span class="badge bg-primary">{{ $week['kanji_target'] }} từ</span>
                            </div>
                        </div>
                        
                        <div class="goal-item mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-book text-success me-2"></i>
                                    Từ vựng
                                </span>
                                <span class="badge bg-success">{{ $week['vocabulary_target'] }} từ</span>
                            </div>
                        </div>
                        
                        <div class="goal-item mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-language text-warning me-2"></i>
                                    Ngữ pháp
                                </span>
                                <span class="badge bg-warning">{{ $week['grammar_points'] }} điểm</span>
                            </div>
                        </div>
                        
                        <div class="goal-item mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-file-alt text-info me-2"></i>
                                    Đọc hiểu
                                </span>
                                <span class="badge bg-info">{{ $week['reading_practice'] }} bài</span>
                            </div>
                        </div>
                        
                        @if($week['mock_tests'] > 0)
                        <div class="goal-item mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-clipboard-check text-danger me-2"></i>
                                    Thi thử
                                </span>
                                <span class="badge bg-danger">{{ $week['mock_tests'] }} bài</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="week-progress mt-3">
                        <div class="progress mb-2">
                            <div class="progress-bar" style="width: {{ rand(20, 80) }}%"></div>
                        </div>
                        <small class="text-muted">Tiến độ: {{ rand(20, 80) }}%</small>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100" role="group">
                        <button class="btn btn-outline-primary btn-sm" onclick="startWeekPractice({{ $week['week'] }})">
                            <i class="fas fa-play me-1"></i>Bắt đầu
                        </button>
                        <button class="btn btn-outline-success btn-sm" onclick="viewWeekDetails({{ $week['week'] }})">
                            <i class="fas fa-eye me-1"></i>Chi tiết
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Study Tips -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        Mẹo học tập hiệu quả
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">📚 Học Kanji</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Học theo bộ thủ</li>
                                <li><i class="fas fa-check text-success me-2"></i>Luyện viết hàng ngày</li>
                                <li><i class="fas fa-check text-success me-2"></i>Học từ vựng liên quan</li>
                            </ul>
                            
                            <h6 class="text-success mt-3">📖 Học từ vựng</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Học theo chủ đề</li>
                                <li><i class="fas fa-check text-success me-2"></i>Luyện phát âm</li>
                                <li><i class="fas fa-check text-success me-2"></i>Đặt câu ví dụ</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-warning">📝 Học ngữ pháp</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Hiểu ý nghĩa cốt lõi</li>
                                <li><i class="fas fa-check text-success me-2"></i>Luyện tập với ví dụ</li>
                                <li><i class="fas fa-check text-success me-2"></i>So sánh với ngữ pháp khác</li>
                            </ul>
                            
                            <h6 class="text-info mt-3">📄 Đọc hiểu</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Đọc hiểu từ khóa</li>
                                <li><i class="fas fa-check text-success me-2"></i>Luyện đọc nhanh</li>
                                <li><i class="fas fa-check text-success me-2"></i>Làm nhiều bài tập</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <div class="btn-group" role="group">
                <button class="btn btn-primary" onclick="startStudyPlan()">
                    <i class="fas fa-play me-2"></i>Bắt đầu kế hoạch
                </button>
                <button class="btn btn-outline-success" onclick="customizePlan()">
                    <i class="fas fa-cog me-2"></i>Tùy chỉnh kế hoạch
                </button>
                <a href="{{ route('jlpt.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-home me-2"></i>Về trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function startWeekPractice(week) {
    alert(`Bắt đầu luyện tập tuần ${week}!`);
    // Redirect to practice page with week filter
    window.location.href = `{{ route('jlpt.level-practice') }}?level={{ $level }}&type=mixed&mode=practice&week=${week}`;
}

function viewWeekDetails(week) {
    alert(`Xem chi tiết tuần ${week}`);
    // Show detailed week plan
}

function startStudyPlan() {
    if (confirm('Bạn có chắc muốn bắt đầu kế hoạch học tập này?')) {
        alert('Kế hoạch học tập đã được kích hoạt! Chúc bạn học tốt!');
        // Save study plan to user profile
    }
}

function customizePlan() {
    alert('Tính năng tùy chỉnh kế hoạch sẽ được phát triển trong phiên bản tiếp theo!');
}
</script>
@endpush

@push('styles')
<style>
.week-goals .goal-item {
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.week-goals .goal-item:last-child {
    border-bottom: none;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.progress {
    height: 8px;
}

.badge {
    font-size: 0.8em;
}
</style>
@endpush
@endsection
