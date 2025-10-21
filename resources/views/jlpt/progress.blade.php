@extends('layouts.app')

@section('title', 'Tiến độ JLPT N' . $level)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jlpt.index') }}">JLPT</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tiến độ N{{ $level }}</li>
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
                        Theo dõi tiến độ
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

    <!-- Progress Overview -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="h2 text-primary">{{ $progress['kanji_mastered'] }}</div>
                    <small class="text-muted">Kanji đã học</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="h2 text-success">{{ $progress['vocabulary_mastered'] }}</div>
                    <small class="text-muted">Từ vựng đã học</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="h2 text-warning">{{ $progress['grammar_mastered'] }}</div>
                    <small class="text-muted">Ngữ pháp đã học</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="h2 text-info">{{ $progress['tests_completed'] }}</div>
                    <small class="text-muted">Bài test đã làm</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Study Statistics -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-chart-line me-2"></i>
                        Thống kê học tập
                    </h5>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h4 text-primary">{{ $progress['average_score'] }}%</div>
                            <small class="text-muted">Điểm trung bình</small>
                        </div>
                        <div class="col-6">
                            <div class="h4 text-success">{{ $progress['study_time'] }}h</div>
                            <small class="text-muted">Thời gian học</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-fire me-2"></i>
                        Chuỗi học tập
                    </h5>
                    <div class="text-center">
                        <div class="h2 text-warning">{{ $progress['streak_days'] }}</div>
                        <small class="text-muted">Ngày liên tiếp</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Charts -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Biểu đồ tiến độ
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="progressChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        Hoạt động gần đây
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6>Hoàn thành bài test N{{ $level }}</h6>
                                <p class="text-muted mb-1">Điểm: 85% - 2 giờ trước</p>
                                <small class="text-muted">Luyện tập từ vựng</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6>Học 15 Kanji mới</h6>
                                <p class="text-muted mb-1">Độ chính xác: 90% - 1 ngày trước</p>
                                <small class="text-muted">Luyện tập Kanji</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6>Ôn tập ngữ pháp</h6>
                                <p class="text-muted mb-1">10 điểm ngữ pháp - 2 ngày trước</p>
                                <small class="text-muted">Luyện tập ngữ pháp</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Goals and Achievements -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-target me-2"></i>
                        Mục tiêu tuần này
                    </h5>
                </div>
                <div class="card-body">
                    <div class="goal-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Học 50 Kanji mới</span>
                            <span class="badge bg-primary">15/50</span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar" style="width: 30%"></div>
                        </div>
                    </div>
                    <div class="goal-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Làm 3 bài test</span>
                            <span class="badge bg-success">2/3</span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-success" style="width: 67%"></div>
                        </div>
                    </div>
                    <div class="goal-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Học 100 từ vựng</span>
                            <span class="badge bg-warning">75/100</span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>
                        Thành tích
                    </h5>
                </div>
                <div class="card-body">
                    <div class="achievement-item mb-3">
                        <div class="d-flex align-items-center">
                            <div class="achievement-icon me-3">
                                <i class="fas fa-medal text-warning fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Học viên chăm chỉ</h6>
                                <small class="text-muted">Học liên tiếp 7 ngày</small>
                            </div>
                        </div>
                    </div>
                    <div class="achievement-item mb-3">
                        <div class="d-flex align-items-center">
                            <div class="achievement-icon me-3">
                                <i class="fas fa-star text-success fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Điểm cao</h6>
                                <small class="text-muted">Đạt 90% trong bài test</small>
                            </div>
                        </div>
                    </div>
                    <div class="achievement-item">
                        <div class="d-flex align-items-center">
                            <div class="achievement-icon me-3">
                                <i class="fas fa-fire text-danger fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Chuỗi học tập</h6>
                                <small class="text-muted">Học liên tiếp 30 ngày</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create progress chart
    const ctx = document.getElementById('progressChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
            datasets: [{
                label: 'Điểm số',
                data: [65, 72, 78, 85],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4
            }, {
                label: 'Số câu đúng',
                data: [13, 14, 16, 17],
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.goal-item {
    padding: 10px 0;
}

.achievement-item {
    padding: 10px 0;
    border-bottom: 1px solid #dee2e6;
}

.achievement-item:last-child {
    border-bottom: none;
}

.achievement-icon {
    width: 50px;
    text-align: center;
}
</style>
@endpush
@endsection
