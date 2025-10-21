@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">
    <!-- Welcome Section -->
    <div class="welcome-section mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="welcome-content">
                    <h1 class="welcome-title">
                        <i class="fas fa-sun me-3 text-warning"></i>
                        Chào mừng trở lại, {{ $user->name }}!
                    </h1>
                    <p class="welcome-subtitle">
                        Hôm nay bạn muốn học gì? Hãy tiếp tục hành trình chinh phục tiếng Nhật của bạn.
                    </p>
                    <div class="welcome-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $stats['completed_lessons'] }}</span>
                            <span class="stat-label">Bài đã hoàn thành</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $stats['total_score'] }}</span>
                            <span class="stat-label">Điểm tích lũy</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $stats['total_lessons'] }}</span>
                            <span class="stat-label">Tổng bài học</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="welcome-avatar">
                    <div class="avatar-circle">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="avatar-badge">
                        <i class="fas fa-crown text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions mb-5">
        <h3 class="section-title">
            <i class="fas fa-bolt me-2"></i>Hành động nhanh
        </h3>
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('lessons.index') }}" class="quick-action-card">
                    <div class="action-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5>Bài học</h5>
                    <p>Tiếp tục học các bài học</p>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('practice.index') }}" class="quick-action-card">
                    <div class="action-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h5>Luyện tập</h5>
                    <p>Ôn tập và thực hành</p>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('jlpt.index') }}" class="quick-action-card">
                    <div class="action-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h5>JLPT</h5>
                    <p>Luyện thi chứng chỉ</p>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('alphabets.index') }}" class="quick-action-card">
                    <div class="action-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <h5>Bảng chữ cái</h5>
                    <p>Học Hiragana, Katakana, Kanji</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Progress Overview -->
    <div class="progress-section mb-5">
        <div class="row">
            <div class="col-md-8">
                <div class="progress-card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-chart-line me-2"></i>Tiến độ học tập
                        </h4>
                        <div class="progress-percentage">
                            {{ $stats['total_lessons'] > 0 ? round(($stats['completed_lessons'] / $stats['total_lessons']) * 100, 1) : 0 }}%
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="progress-container">
                            <div class="progress-bar-custom">
                                <div class="progress-fill" 
                                     style="width: {{ $stats['total_lessons'] > 0 ? round(($stats['completed_lessons'] / $stats['total_lessons']) * 100, 1) : 0 }}%">
                                </div>
                            </div>
                            <div class="progress-info">
                                <span class="progress-text">
                                    Bạn đã hoàn thành <strong>{{ $stats['completed_lessons'] }}</strong> 
                                    trong tổng số <strong>{{ $stats['total_lessons'] }}</strong> bài học
                                </span>
                            </div>
                        </div>
                        
                        <!-- Level Progress -->
                        <div class="level-progress mt-4">
                            <h6 class="mb-3">Tiến độ theo cấp độ</h6>
                            <div class="level-bars">
                                <div class="level-bar">
                                    <div class="level-info">
                                        <span class="level-name">N5</span>
                                        <span class="level-percentage">75%</span>
                                    </div>
                                    <div class="level-progress-bar">
                                        <div class="level-fill" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div class="level-bar">
                                    <div class="level-info">
                                        <span class="level-name">N4</span>
                                        <span class="level-percentage">45%</span>
                                    </div>
                                    <div class="level-progress-bar">
                                        <div class="level-fill" style="width: 45%"></div>
                                    </div>
                                </div>
                                <div class="level-bar">
                                    <div class="level-info">
                                        <span class="level-name">N3</span>
                                        <span class="level-percentage">20%</span>
                                    </div>
                                    <div class="level-progress-bar">
                                        <div class="level-fill" style="width: 20%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="achievements-card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-trophy me-2"></i>Thành tích
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="achievement-item">
                            <div class="achievement-icon">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <div class="achievement-info">
                                <h6>Người mới bắt đầu</h6>
                                <p>Hoàn thành bài học đầu tiên</p>
                            </div>
                        </div>
                        <div class="achievement-item">
                            <div class="achievement-icon">
                                <i class="fas fa-fire text-danger"></i>
                            </div>
                            <div class="achievement-info">
                                <h6>Chuỗi học tập</h6>
                                <p>Học liên tiếp 7 ngày</p>
                            </div>
                        </div>
                        <div class="achievement-item">
                            <div class="achievement-icon">
                                <i class="fas fa-brain text-info"></i>
                            </div>
                            <div class="achievement-info">
                                <h6>Thông thái</h6>
                                <p>Đạt 1000 điểm</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    @if($recentProgress->count() > 0)
    <div class="recent-activity mb-5">
        <h3 class="section-title">
            <i class="fas fa-history me-2"></i>Hoạt động gần đây
        </h3>
        <div class="activity-timeline">
            @foreach($recentProgress as $progress)
            <div class="activity-item">
                <div class="activity-icon">
                    @if($progress->is_completed)
                        <i class="fas fa-check-circle text-success"></i>
                    @else
                        <i class="fas fa-clock text-warning"></i>
                    @endif
                </div>
                <div class="activity-content">
                    <h6 class="activity-title">
                        <a href="{{ route('lessons.show', $progress->lesson) }}" class="text-decoration-none">
                            {{ $progress->lesson->title }}
                        </a>
                    </h6>
                    <p class="activity-description">
                        @if($progress->is_completed)
                            Đã hoàn thành với {{ $progress->score }} điểm
                        @else
                            Đang học - {{ $progress->accuracy_percentage }}% chính xác
                        @endif
                    </p>
                    <div class="activity-meta">
                        <span class="activity-level">{{ $progress->lesson->level_name }}</span>
                        <span class="activity-time">{{ $progress->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-content">
            <div class="empty-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h4>Chưa có hoạt động nào</h4>
            <p>Hãy bắt đầu học bài đầu tiên để theo dõi tiến độ của bạn!</p>
            <a href="{{ route('lessons.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-play me-2"></i>Bắt đầu học ngay
            </a>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
/* Welcome Section */
.welcome-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 40px;
    color: white;
    position: relative;
    overflow: hidden;
}

.welcome-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.welcome-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 30px;
}

.welcome-stats {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.welcome-avatar {
    position: relative;
    text-align: center;
}

.avatar-circle {
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin: 0 auto;
    backdrop-filter: blur(10px);
}

.avatar-badge {
    position: absolute;
    top: -10px;
    right: 20px;
    background: #ffc107;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

/* Quick Actions */
.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 25px;
    color: #2d3748;
}

.quick-action-card {
    display: block;
    background: white;
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.quick-action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    border-color: #667eea;
    color: inherit;
}

.action-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
    color: white;
}

.quick-action-card h5 {
    font-weight: 600;
    margin-bottom: 10px;
    color: #2d3748;
}

.quick-action-card p {
    color: #718096;
    margin: 0;
}

/* Progress Section */
.progress-card, .achievements-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: none;
}

.card-header {
    background: transparent;
    border-bottom: 1px solid #e2e8f0;
    padding: 25px 25px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    color: #2d3748;
}

.progress-percentage {
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
}

.card-body {
    padding: 25px;
}

.progress-container {
    margin-bottom: 20px;
}

.progress-bar-custom {
    height: 12px;
    background: #e2e8f0;
    border-radius: 6px;
    overflow: hidden;
    margin-bottom: 15px;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 6px;
    transition: width 0.8s ease;
}

.progress-info {
    text-align: center;
}

.progress-text {
    color: #718096;
    font-size: 0.95rem;
}

/* Level Progress */
.level-bars {
    space-y: 15px;
}

.level-bar {
    margin-bottom: 15px;
}

.level-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

.level-name {
    font-weight: 600;
    color: #2d3748;
}

.level-percentage {
    font-weight: 600;
    color: #667eea;
}

.level-progress-bar {
    height: 8px;
    background: #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
}

.level-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 4px;
    transition: width 0.8s ease;
}

/* Achievements */
.achievement-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f1f5f9;
}

.achievement-item:last-child {
    border-bottom: none;
}

.achievement-icon {
    width: 40px;
    height: 40px;
    background: #f8fafc;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 1.2rem;
}

.achievement-info h6 {
    font-weight: 600;
    margin-bottom: 5px;
    color: #2d3748;
}

.achievement-info p {
    color: #718096;
    margin: 0;
    font-size: 0.9rem;
}

/* Recent Activity */
.activity-timeline {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.activity-item {
    display: flex;
    align-items: flex-start;
    padding: 20px 0;
    border-bottom: 1px solid #f1f5f9;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    background: #f8fafc;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 1.1rem;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    margin-bottom: 5px;
    color: #2d3748;
}

.activity-description {
    color: #718096;
    margin-bottom: 10px;
    font-size: 0.9rem;
}

.activity-meta {
    display: flex;
    gap: 15px;
    font-size: 0.85rem;
}

.activity-level {
    background: #667eea;
    color: white;
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: 500;
}

.activity-time {
    color: #a0aec0;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.empty-icon {
    font-size: 4rem;
    color: #cbd5e0;
    margin-bottom: 20px;
}

.empty-content h4 {
    color: #2d3748;
    margin-bottom: 10px;
}

.empty-content p {
    color: #718096;
    margin-bottom: 30px;
}

/* Responsive */
@media (max-width: 768px) {
    .welcome-title {
        font-size: 2rem;
    }
    
    .welcome-stats {
        gap: 20px;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .quick-action-card {
        padding: 20px 15px;
    }
    
    .action-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}
</style>
@endpush
@endsection