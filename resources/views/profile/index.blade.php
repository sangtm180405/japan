@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="main-content">
    <!-- Profile Header -->
    <div class="profile-header mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="profile-info">
                    <div class="profile-avatar">
                        <div class="avatar-circle">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="avatar-badge">
                            <i class="fas fa-crown text-warning"></i>
                        </div>
                    </div>
                    <div class="profile-details">
                        <h1 class="profile-name">{{ $user->name }}</h1>
                        <p class="profile-email">{{ $user->email }}</p>
                        <div class="profile-stats">
                            <div class="stat-item">
                                <span class="stat-number">{{ $stats['total_score'] }}</span>
                                <span class="stat-label">Điểm tích lũy</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ $stats['completed_lessons'] }}</span>
                                <span class="stat-label">Bài hoàn thành</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ $stats['average_accuracy'] }}%</span>
                                <span class="stat-label">Độ chính xác</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="profile-actions">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="quick-stats mb-5">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['total_score'] }}</h3>
                        <p>Tổng điểm</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['completed_lessons'] }}</h3>
                        <p>Bài hoàn thành</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['average_accuracy'] }}%</h3>
                        <p>Độ chính xác TB</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $user->created_at->diffInDays(now()) }}</h3>
                        <p>Ngày tham gia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Learning Progress -->
    <div class="learning-progress mb-5">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-chart-line me-2"></i>Tiến độ học tập
            </h3>
        </div>
        
        @if($progress->count() > 0)
        <div class="progress-timeline">
            @foreach($progress as $p)
            <div class="timeline-item">
                <div class="timeline-marker">
                    @if($p->is_completed)
                        <i class="fas fa-check-circle text-success"></i>
                    @else
                        <i class="fas fa-clock text-warning"></i>
                    @endif
                </div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h6 class="timeline-title">
                            @if($p->lesson)
                                <a href="{{ route('lessons.show', $p->lesson) }}" class="text-decoration-none">
                                    {{ $p->lesson->title }}
                                </a>
                            @else
                                <span class="text-muted">Bài học không tồn tại</span>
                            @endif
                        </h6>
                        <div class="timeline-meta">
                            <span class="timeline-score">
                                <i class="fas fa-star me-1"></i>{{ $p->score }} điểm
                            </span>
                            <span class="timeline-accuracy">{{ $p->accuracy_percentage }}% chính xác</span>
                        </div>
                    </div>
                    <div class="timeline-footer">
                        <div class="timeline-status">
                            @if($p->is_completed)
                                <span class="status-badge completed">
                                    <i class="fas fa-check me-1"></i>Hoàn thành
                                </span>
                            @else
                                <span class="status-badge in-progress">
                                    <i class="fas fa-clock me-1"></i>Đang học
                                </span>
                            @endif
                        </div>
                        <div class="timeline-date">
                            {{ $p->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $progress->links() }}
        </div>
        @else
        <div class="empty-progress">
            <div class="empty-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h4>Chưa có tiến độ học tập</h4>
            <p>Hãy bắt đầu học bài đầu tiên để theo dõi tiến độ của bạn!</p>
            <a href="{{ route('lessons.index') }}" class="btn btn-primary">
                <i class="fas fa-play me-2"></i>Bắt đầu học ngay
            </a>
        </div>
        @endif
    </div>

    <!-- Achievements -->
    <div class="achievements-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-trophy me-2"></i>Thành tích
            </h3>
        </div>
        
        <div class="achievements-grid">
            <div class="achievement-card earned">
                <div class="achievement-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="achievement-info">
                    <h6>Người mới bắt đầu</h6>
                    <p>Hoàn thành bài học đầu tiên</p>
                </div>
                <div class="achievement-status">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
            </div>
            
            <div class="achievement-card earned">
                <div class="achievement-icon">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="achievement-info">
                    <h6>Chuỗi học tập</h6>
                    <p>Học liên tiếp 7 ngày</p>
                </div>
                <div class="achievement-status">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
            </div>
            
            <div class="achievement-card earned">
                <div class="achievement-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="achievement-info">
                    <h6>Thông thái</h6>
                    <p>Đạt 1000 điểm</p>
                </div>
                <div class="achievement-status">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
            </div>
            
            <div class="achievement-card locked">
                <div class="achievement-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="achievement-info">
                    <h6>Chuyên gia</h6>
                    <p>Hoàn thành 50 bài học</p>
                </div>
                <div class="achievement-status">
                    <i class="fas fa-lock text-muted"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">
                    <i class="fas fa-user-edit me-2"></i>Chỉnh sửa thông tin cá nhân
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="password-section">
                        <h6 class="section-subtitle">Thay đổi mật khẩu (tùy chọn)</h6>
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                       id="new_password" name="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" 
                                       id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Profile Header */
.profile-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 40px;
    color: white;
    position: relative;
    overflow: hidden;
}

.profile-header::before {
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

.profile-info {
    display: flex;
    align-items: center;
    gap: 30px;
}

.profile-avatar {
    position: relative;
}

.avatar-circle {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    backdrop-filter: blur(10px);
}

.avatar-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #ffc107;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.profile-details {
    flex: 1;
}

.profile-name {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.profile-email {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 25px;
}

.profile-stats {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.profile-actions {
    display: flex;
    gap: 15px;
    flex-direction: column;
}

/* Quick Stats */
.quick-stats {
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: #2d3748;
}

.stat-content p {
    color: #718096;
    margin: 0;
    font-weight: 500;
}

/* Section Headers */
.section-header {
    margin-bottom: 25px;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}

/* Learning Progress */
.learning-progress {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.progress-timeline {
    position: relative;
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    padding: 25px 0;
    border-bottom: 1px solid #f1f5f9;
    position: relative;
}

.timeline-item:last-child {
    border-bottom: none;
}

.timeline-marker {
    width: 50px;
    height: 50px;
    background: #f8fafc;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.timeline-content {
    flex: 1;
}

.timeline-header {
    margin-bottom: 15px;
}

.timeline-title {
    font-weight: 600;
    margin-bottom: 8px;
    color: #2d3748;
}

.timeline-meta {
    display: flex;
    gap: 20px;
    font-size: 0.9rem;
}

.timeline-score {
    color: #667eea;
    font-weight: 500;
}

.timeline-accuracy {
    color: #718096;
}

.timeline-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-badge.completed {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.in-progress {
    background: #fef3c7;
    color: #92400e;
}

.timeline-date {
    color: #a0aec0;
    font-size: 0.85rem;
}

/* Empty Progress */
.empty-progress {
    text-align: center;
    padding: 60px 20px;
}

.empty-icon {
    font-size: 4rem;
    color: #cbd5e0;
    margin-bottom: 20px;
}

.empty-progress h4 {
    color: #2d3748;
    margin-bottom: 10px;
}

.empty-progress p {
    color: #718096;
    margin-bottom: 30px;
}

/* Achievements */
.achievements-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.achievements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.achievement-card {
    background: #f8fafc;
    border-radius: 15px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.achievement-card.earned {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    border-color: #10b981;
}

.achievement-card.locked {
    opacity: 0.6;
}

.achievement-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.achievement-icon {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: #667eea;
}

.achievement-card.earned .achievement-icon {
    background: #10b981;
    color: white;
}

.achievement-info {
    flex: 1;
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

.achievement-status {
    font-size: 1.2rem;
}

/* Modal Styles */
.modal-content {
    border-radius: 15px;
    border: none;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border-bottom: none;
}

.modal-title {
    font-weight: 600;
}

.password-section {
    margin-top: 30px;
    padding-top: 30px;
    border-top: 1px solid #e2e8f0;
}

.section-subtitle {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-info {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    
    .profile-name {
        font-size: 2rem;
    }
    
    .profile-stats {
        gap: 20px;
    }
    
    .stat-card {
        flex-direction: column;
        text-align: center;
    }
    
    .achievements-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-actions {
        flex-direction: row;
        justify-content: center;
    }
}
</style>
@endpush
@endsection