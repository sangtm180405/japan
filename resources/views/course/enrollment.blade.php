@extends('layouts.app')

@section('title', 'Đăng ký khóa học')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="enrollment-card">
                <div class="enrollment-header">
                    <h2 class="enrollment-title">
                        <i class="fas fa-graduation-cap me-3"></i>
                        {{ $courseInfo['name'] }}
                    </h2>
                    <p class="enrollment-description">{{ $courseInfo['description'] }}</p>
                </div>

                <div class="enrollment-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="course-features">
                                <h5 class="features-title">
                                    <i class="fas fa-star me-2"></i>Tính năng khóa học
                                </h5>
                                <ul class="features-list">
                                    @foreach($courseInfo['features'] as $feature)
                                    <li class="feature-item">
                                        <i class="fas fa-check text-success me-2"></i>
                                        {{ $feature }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="course-pricing">
                                <div class="pricing-card">
                                    <div class="price-display">
                                        <span class="price-amount">{{ $courseInfo['price'] }}</span>
                                        <span class="price-period">{{ $courseInfo['duration'] }}</span>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('course.enroll') }}" class="enrollment-form">
                                        @csrf
                                        <input type="hidden" name="course_type" value="{{ $courseType }}">
                                        
                                        <button type="submit" class="enroll-btn">
                                            <i class="fas fa-rocket me-2"></i>
                                            Đăng ký ngay
                                        </button>
                                    </form>
                                    
                                    <div class="enrollment-benefits">
                                        <div class="benefit-item">
                                            <i class="fas fa-shield-alt text-primary me-2"></i>
                                            Bảo đảm chất lượng
                                        </div>
                                        <div class="benefit-item">
                                            <i class="fas fa-mobile-alt text-primary me-2"></i>
                                            Học mọi lúc mọi nơi
                                        </div>
                                        <div class="benefit-item">
                                            <i class="fas fa-headset text-primary me-2"></i>
                                            Hỗ trợ 24/7
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="enrollment-footer">
                    <a href="{{ route('lessons.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.enrollment-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    margin: 2rem 0;
}

.enrollment-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.enrollment-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.enrollment-description {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.enrollment-content {
    padding: 2rem;
}

.features-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 1rem;
}

.features-list {
    list-style: none;
    padding: 0;
}

.feature-item {
    padding: 0.5rem 0;
    color: #666;
}

.pricing-card {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
}

.price-display {
    margin-bottom: 2rem;
}

.price-amount {
    font-size: 2.5rem;
    font-weight: 700;
    color: #667eea;
}

.price-period {
    display: block;
    color: #666;
    font-size: 1rem;
}

.enroll-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    width: 100%;
    transition: all 0.3s ease;
    margin-bottom: 1.5rem;
}

.enroll-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.enrollment-benefits {
    text-align: left;
}

.benefit-item {
    padding: 0.5rem 0;
    color: #666;
    font-size: 0.9rem;
}

.enrollment-footer {
    padding: 1rem 2rem;
    background: #f8f9fa;
    text-align: center;
}
</style>
@endsection
