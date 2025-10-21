@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-particles"></div>
        </div>
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <i class="fas fa-star me-2"></i>
                            <span>Học tiếng Nhật thông minh</span>
                        </div>
                        <h1 class="hero-title">
                            Chinh phục tiếng Nhật từ
                            <span class="gradient-text">N5 đến N1</span>
                        </h1>
                        <p class="hero-description">
                            Lộ trình học tập toàn diện với bài học tương tác, luyện tập thông minh, 
                            thi thử JLPT và theo dõi tiến độ chi tiết.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('jlpt.index') }}" class="btn btn-primary btn-lg hero-btn">
                                <i class="fas fa-rocket me-2"></i>
                                Bắt đầu ngay
                            </a>
                            <a href="{{ route('practice.index') }}" class="btn btn-primary btn-lg hero-btn">
                                <i class="fas fa-play me-2"></i>
                                Luyện tập
                            </a>
                        </div>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number">1000+</div>
                                <div class="stat-label">Từ vựng</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Bài học</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">5</div>
                                <div class="stat-label">Cấp độ JLPT</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="floating-cards">
                            <div class="floating-card card-1">
                                <div class="card-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="card-content">
                                    <h6>JLPT N5</h6>
                                    <p>Khởi đầu</p>
                                </div>
                            </div>
                            <div class="floating-card card-2">
                                <div class="card-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="card-content">
                                    <h6>JLPT N1</h6>
                                    <p>Chuyên sâu</p>
                                </div>
                            </div>
                            <div class="floating-card card-3">
                                <div class="card-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="card-content">
                                    <h6>Tiến độ</h6>
                                    <p>Theo dõi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Tại sao chọn chúng tôi?</h2>
                <p class="section-subtitle">Hệ thống học tiếng Nhật toàn diện và hiệu quả</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>Học thông minh</h4>
                        <p>AI phân tích điểm yếu và đề xuất bài học phù hợp với trình độ của bạn</p>
                        <div class="feature-image">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=200&fit=crop&crop=center" alt="Smart Learning">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-volume-up"></i>
                        </div>
                        <h4>Phát âm chuẩn</h4>
                        <p>Luyện phát âm với công nghệ TTS tiên tiến và audio chất lượng cao</p>
                        <div class="feature-image">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=300&h=200&fit=crop&crop=center" alt="Pronunciation">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h4>Gamification</h4>
                        <p>Học tập thông qua game, thử thách và hệ thống điểm thưởng hấp dẫn</p>
                        <div class="feature-image">
                            <img src="https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=300&h=200&fit=crop&crop=center" alt="Gamification">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Theo dõi tiến độ</h4>
                        <p>Biểu đồ chi tiết về tiến độ học tập, điểm mạnh và điểm cần cải thiện</p>
                        <div class="feature-image">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=300&h=200&fit=crop&crop=center" alt="Progress Tracking">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4>Thi thử JLPT</h4>
                        <p>Làm bài thi thử giống kỳ thi thật với đếm giờ và chấm điểm tự động</p>
                        <div class="feature-image">
                            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=300&h=200&fit=crop&crop=center" alt="JLPT Test">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Học mọi lúc mọi nơi</h4>
                        <p>Ứng dụng responsive, học trên mọi thiết bị với đồng bộ dữ liệu</p>
                        <div class="feature-image">
                            <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=300&h=200&fit=crop&crop=center" alt="Mobile Learning">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JLPT Levels Section -->
    <section class="jlpt-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Lộ trình JLPT</h2>
                <p class="section-subtitle">Từ cơ bản đến chuyên sâu, chinh phục mọi cấp độ</p>
            </div>
            
            <div class="jlpt-levels">
                <div class="level-card" data-level="N5">
                    <div class="level-header">
                        <div class="level-number">N5</div>
                        <div class="level-info">
                            <h4>Cơ bản</h4>
                            <p>Khởi đầu hành trình</p>
                        </div>
                    </div>
                    <div class="level-content">
                        <div class="level-stats">
                            <div class="stat">
                                <span class="stat-number">100</span>
                                <span class="stat-label">Kanji</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number">800</span>
                                <span class="stat-label">Từ vựng</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number">50</span>
                                <span class="stat-label">Bài học</span>
                            </div>
                        </div>
                        <div class="level-image">
                            <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=250&fit=crop&crop=center" alt="JLPT N5">
                        </div>
                        <a href="{{ route('jlpt.level-practice', ['level' => 5]) }}" class="level-btn">
                            <i class="fas fa-play me-2"></i>Bắt đầu N5
                        </a>
                    </div>
                </div>
                
                <div class="level-card" data-level="N4">
                    <div class="level-header">
                        <div class="level-number">N4</div>
                        <div class="level-info">
                            <h4>Sơ cấp</h4>
                            <p>Nâng cao kiến thức</p>
                        </div>
                    </div>
                    <div class="level-content">
                        <div class="level-stats">
                            <div class="stat">
                                <span class="stat-number">300</span>
                                <span class="stat-label">Kanji</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number">1500</span>
                                <span class="stat-label">Từ vựng</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number">80</span>
                                <span class="stat-label">Bài học</span>
                            </div>
                        </div>
                        <div class="level-image">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=250&fit=crop&crop=center" alt="JLPT N4">
                        </div>
                        <a href="{{ route('jlpt.level-practice', ['level' => 4]) }}" class="level-btn">
                            <i class="fas fa-play me-2"></i>Bắt đầu N4
                        </a>
                    </div>
                </div>
                
                <div class="level-card" data-level="N3">
                    <div class="level-header">
                        <div class="level-number">N3</div>
                        <div class="level-info">
                            <h4>Trung cấp</h4>
                            <p>Giao tiếp thực tế</p>
                        </div>
                    </div>
                    <div class="level-content">
                        <div class="level-stats">
                            <div class="stat">
                                <span class="stat-number">650</span>
                                <span class="stat-label">Kanji</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number">3000</span>
                                <span class="stat-label">Từ vựng</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number">120</span>
                                <span class="stat-label">Bài học</span>
                            </div>
                        </div>
                        <div class="level-image">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=250&fit=crop&crop=center" alt="JLPT N3">
                        </div>
                        <a href="{{ route('jlpt.level-practice', ['level' => 3]) }}" class="level-btn">
                            <i class="fas fa-play me-2"></i>Bắt đầu N3
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lessons Section -->
    @if($lessons->count() > 0)
    <section class="lessons-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Bài học nổi bật</h2>
                <p class="section-subtitle">Khám phá các bài học được yêu thích nhất</p>
            </div>
            
            @foreach($lessons as $level => $levelLessons)
            <div class="lesson-level mb-5">
                <div class="level-header">
                    <h3 class="level-title">
                        <span class="level-badge">{{ $levelLessons->first()->level_name }}</span>
                        Bài học cấp độ {{ $levelLessons->first()->level_name }}
                    </h3>
                    <a href="{{ route('lessons.index') }}" class="view-all-btn">
                        <i class="fas fa-arrow-right me-2"></i>Xem tất cả
                    </a>
                </div>
                
                <div class="lessons-grid">
                    @foreach($levelLessons->take(3) as $lesson)
                    <div class="lesson-card">
                        <div class="lesson-image">
                            @php
                                // Generate appropriate image based on lesson title and content
                                $imageUrl = '';
                                $title = strtolower($lesson->title);
                                $description = strtolower($lesson->description ?? '');
                                
                                // Define image mappings for different topics
                                $imageMappings = [
                                    // Alphabet & Writing
                                    'hiragana' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=200&fit=crop&crop=center',
                                    'katakana' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=200&fit=crop&crop=center',
                                    'kanji' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=200&fit=crop&crop=center',
                                    'bảng chữ cái' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=200&fit=crop&crop=center',
                                    
                                    // Vocabulary & Words
                                    'vocabulary' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=200&fit=crop&crop=center',
                                    'từ vựng' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=200&fit=crop&crop=center',
                                    'words' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=200&fit=crop&crop=center',
                                    
                                    // Numbers & Counting
                                    'số' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                    'đếm' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                    'number' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                    'counting' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                    
                                    // Grammar & Verbs
                                    'động từ' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=200&fit=crop&crop=center',
                                    'verb' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=200&fit=crop&crop=center',
                                    'tính từ' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=200&fit=crop&crop=center',
                                    'adjective' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=200&fit=crop&crop=center',
                                    'grammar' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=200&fit=crop&crop=center',
                                    'ngữ pháp' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=200&fit=crop&crop=center',
                                    
                                    // People & Jobs
                                    'nghề nghiệp' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=200&fit=crop&crop=center',
                                    'occupation' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=200&fit=crop&crop=center',
                                    'job' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=200&fit=crop&crop=center',
                                    'con người' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=200&fit=crop&crop=center',
                                    
                                    // Reading & Listening
                                    'reading' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=200&fit=crop&crop=center',
                                    'đọc' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=200&fit=crop&crop=center',
                                    'listening' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=200&fit=crop&crop=center',
                                    'nghe' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=200&fit=crop&crop=center',
                                    
                                    // Food & Daily Life
                                    'food' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400&h=200&fit=crop&crop=center',
                                    'đồ ăn' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400&h=200&fit=crop&crop=center',
                                    'thức ăn' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400&h=200&fit=crop&crop=center',
                                    'cuộc sống' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=200&fit=crop&crop=center',
                                    
                                    // Time & Dates
                                    'time' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                    'thời gian' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                    'ngày' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                    'tháng' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop&crop=center',
                                ];
                                
                                // Search for matching keywords
                                $foundMatch = false;
                                foreach ($imageMappings as $keyword => $url) {
                                    if (strpos($title, $keyword) !== false || strpos($description, $keyword) !== false) {
                                        $imageUrl = $url;
                                        $foundMatch = true;
                                        break;
                                    }
                                }
                                
                                // If no match found, use level-based defaults
                                if (!$foundMatch) {
                                    $levelImages = [
                                        1 => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=200&fit=crop&crop=center', // N5 - Basic
                                        2 => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=200&fit=crop&crop=center', // N4 - Elementary
                                        3 => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=200&fit=crop&crop=center', // N3 - Intermediate
                                        4 => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=200&fit=crop&crop=center', // N2 - Advanced
                                        5 => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=200&fit=crop&crop=center', // N1 - Expert
                                    ];
                                    
                                    $imageUrl = $levelImages[$lesson->level] ?? 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=200&fit=crop&crop=center';
                                }
                            @endphp
                            <img data-src="{{ $imageUrl }}" alt="{{ $lesson->title }}" class="lazy" loading="lazy">
                            <div class="lesson-overlay">
                                <div class="lesson-level-badge">{{ $lesson->level_name }}</div>
                            </div>
                        </div>
                        <div class="lesson-content">
                            <h5 class="lesson-title">{{ $lesson->title }}</h5>
                            <p class="lesson-description">{{ Str::limit($lesson->description, 100) }}</p>
                            
                            @auth
                                @php
                                    $progress = $userProgress->get($lesson->id);
                                    $canAccess = Auth::user()->canAccessLesson($lesson);
                                @endphp
                                
                                @if($canAccess)
                                    @if($progress)
                                        <div class="lesson-progress">
                                            <div class="progress-info">
                                                <span class="progress-label">Tiến độ</span>
                                                <span class="progress-percentage">{{ $progress->accuracy_percentage }}%</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: {{ $progress->accuracy_percentage }}%"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="lesson-status">
                                            @if($progress->is_completed)
                                                <span class="status-badge completed">
                                                    <i class="fas fa-check me-1"></i>Hoàn thành
                                                </span>
                                            @else
                                                <span class="status-badge in-progress">
                                                    <i class="fas fa-clock me-1"></i>Đang học
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="lesson-status">
                                            <span class="status-badge not-started">
                                                <i class="fas fa-play me-1"></i>Chưa bắt đầu
                                            </span>
                                        </div>
                                    @endif
                                @else
                                    <div class="lesson-status">
                                        <span class="status-badge locked">
                                            <i class="fas fa-lock me-1"></i>Cần đăng ký
                                        </span>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        
                        <div class="lesson-footer">
                            @auth
                                <a href="{{ route('lessons.show', $lesson) }}" class="lesson-btn">
                                    <i class="fas fa-book-open me-2"></i>
                                    {{ $progress && $progress->is_completed ? 'Xem lại' : 'Bắt đầu học' }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="lesson-btn outline">
                                    <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập để học
                                </a>
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Quick Actions Section -->
    <section class="quick-actions-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Bắt đầu ngay</h2>
                <p class="section-subtitle">Chọn cách học phù hợp với bạn</p>
            </div>
            
            <div class="quick-actions-grid">
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="action-image">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=300&h=200&fit=crop&crop=center" alt="JLPT Test">
                    </div>
                    <div class="action-content">
                        <h4>Thi thử JLPT</h4>
                        <p>Làm bài thi thử giống kỳ thi thật, có đếm giờ và chấm điểm tự động</p>
                        <a href="{{ route('jlpt.mock-test', ['level' => 5, 'section' => 'all']) }}" class="action-btn">
                            <i class="fas fa-play me-2"></i>Bắt đầu thi N5
                        </a>
                    </div>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-volume-up"></i>
                    </div>
                    <div class="action-image">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=300&h=200&fit=crop&crop=center" alt="Pronunciation">
                    </div>
                    <div class="action-content">
                        <h4>Luyện phát âm</h4>
                        <p>Phát âm Hiragana, Katakana, từ vựng với công nghệ TTS tiên tiến</p>
                        <a href="{{ route('practice.alphabet') }}" class="action-btn">
                            <i class="fas fa-play me-2"></i>Luyện bảng chữ
                        </a>
                    </div>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="action-image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=300&h=200&fit=crop&crop=center" alt="Progress">
                    </div>
                    <div class="action-content">
                        <h4>Tiến độ học tập</h4>
                        <p>Theo dõi điểm số, số bài hoàn thành, chuỗi học tập chi tiết</p>
                        <a href="{{ route('jlpt.progress', ['level' => 5]) }}" class="action-btn">
                            <i class="fas fa-chart-bar me-2"></i>Xem tiến độ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Section for Authenticated Users -->
    @auth
    <section class="dashboard-section">
        <div class="container">
            <div class="dashboard-card">
                <div class="dashboard-content">
                    <div class="dashboard-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <div class="dashboard-info">
                        <h3>Dashboard của bạn</h3>
                        <p>Theo dõi tiến độ học tập và điểm số của bạn một cách chi tiết</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="dashboard-btn">
                        <i class="fas fa-arrow-right me-2"></i>Xem Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endauth
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe all cards and sections
    document.querySelectorAll('.feature-card, .level-card, .lesson-card, .action-card').forEach(card => {
        observer.observe(card);
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.hero-particles');
        if (parallax) {
            parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/\D/g, ''));
            const increment = target / 100;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target + (counter.textContent.includes('+') ? '+' : '');
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current) + (counter.textContent.includes('+') ? '+' : '');
                }
            }, 20);
        });
    }

    // Trigger counter animation when stats section is visible
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                statsObserver.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector('.hero-stats');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Add hover effects to cards
    document.querySelectorAll('.feature-card, .level-card, .lesson-card, .action-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading animation
    document.body.classList.add('loaded');
});
</script>
@endpush

@push('styles')
<style>
/* Hero Section */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.hero-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
    animation: float 20s linear infinite;
}

@keyframes float {
    0% { transform: translateY(0px); }
    100% { transform: translateY(-100px); }
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 20px;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
}

.gradient-text {
    background: linear-gradient(45deg, #ffd700, #ffed4e);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.hero-description {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 30px;
    line-height: 1.6;
}

.hero-actions {
    display: flex;
    gap: 20px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.hero-btn {
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}

.hero-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.hero-stats {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.8;
}

/* Hero Visual */
.hero-visual {
    position: relative;
    z-index: 2;
}

.floating-cards {
    position: relative;
    height: 400px;
}

.floating-card {
    position: absolute;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 15px;
    animation: floatCard 6s ease-in-out infinite;
}

.floating-card.card-1 {
    top: 50px;
    left: 50px;
    animation-delay: 0s;
}

.floating-card.card-2 {
    top: 150px;
    right: 50px;
    animation-delay: 2s;
}

.floating-card.card-3 {
    bottom: 50px;
    left: 100px;
    animation-delay: 4s;
}

@keyframes floatCard {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(2deg); }
}

.card-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.card-content h6 {
    font-weight: 600;
    margin-bottom: 5px;
    color: #2d3748;
}

.card-content p {
    color: #718096;
    margin: 0;
    font-size: 0.9rem;
}

/* Section Headers */
.section-header {
    margin-bottom: 50px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #718096;
    margin: 0;
}

/* Features Section */
.features-section {
    padding: 100px 0;
    background: #f8fafc;
}

.feature-card {
    background: white;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    border: 2px solid transparent;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: #667eea;
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 2rem;
    color: white;
}

.feature-card h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #2d3748;
}

.feature-card p {
    color: #718096;
    margin-bottom: 25px;
    line-height: 1.6;
}

.feature-image {
    border-radius: 15px;
    overflow: hidden;
    margin-top: 20px;
}

.feature-image img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.feature-card:hover .feature-image img {
    transform: scale(1.05);
}

/* JLPT Section */
.jlpt-section {
    padding: 100px 0;
    background: white;
}

.jlpt-levels {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.level-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.level-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: #667eea;
}

.level-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 30px;
    display: flex;
    align-items: center;
    gap: 20px;
}

.level-number {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
}

.level-info h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.level-info p {
    opacity: 0.9;
    margin: 0;
}

.level-content {
    padding: 30px;
}

.level-stats {
    display: flex;
    justify-content: space-around;
    margin-bottom: 25px;
}

.stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.8rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: #718096;
}

.level-image {
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 25px;
}

.level-image img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.level-btn {
    display: block;
    width: 100%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    padding: 15px;
    border-radius: 15px;
    text-align: center;
    font-weight: 600;
    transition: all 0.3s ease;
}

.level-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    color: white;
}

/* Lessons Section */
.lessons-section {
    padding: 100px 0;
    background: #f8fafc;
}

.lesson-level {
    margin-bottom: 60px;
}

.level-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.level-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}

.level-badge {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-right: 15px;
}

.view-all-btn {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.view-all-btn:hover {
    color: #764ba2;
}

.lessons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

.lesson-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;            /* ensure equal height structure */
    flex-direction: column;   /* stack sections vertically */
    height: 100%;             /* allow grid to equalize heights */
}

.lesson-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.lesson-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.lesson-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.lesson-card:hover .lesson-image img {
    transform: scale(1.05);
}

.lesson-overlay {
    position: absolute;
    top: 15px;
    right: 15px;
}

.lesson-level-badge {
    background: rgba(102, 126, 234, 0.9);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.lesson-content {
    padding: 25px;
    flex: 1;                  /* take up remaining space */
}

.lesson-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #2d3748;
}

.lesson-description {
    color: #718096;
    margin-bottom: 20px;
    line-height: 1.5;
}

.lesson-progress {
    margin-bottom: 15px;
}

.progress-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

.progress-label {
    font-size: 0.9rem;
    color: #718096;
}

.progress-percentage {
    font-size: 0.9rem;
    font-weight: 600;
    color: #667eea;
}

.progress-bar {
    height: 8px;
    background: #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 4px;
    transition: width 0.3s ease;
}

.lesson-status {
    margin-bottom: 20px;
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

.status-badge.not-started {
    background: #e5e7eb;
    color: #6b7280;
}

.lesson-footer {
    padding: 0 25px 25px;
    margin-top: auto;         /* push footer to bottom */
}

.lesson-btn {
    display: block;
    width: 100%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    padding: 12px;
    border-radius: 15px;
    text-align: center;
    font-weight: 500;
    transition: all 0.3s ease;
}

.lesson-btn.outline {
    background: transparent;
    color: #667eea;
    border: 2px solid #667eea;
}

.lesson-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    color: white;
}

.lesson-btn.outline:hover {
    background: #667eea;
    color: white;
}

/* Quick Actions Section */
.quick-actions-section {
    padding: 100px 0;
    background: white;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.action-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: #667eea;
}

.action-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    z-index: 2;
}

.action-image {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.action-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.action-card:hover .action-image img {
    transform: scale(1.05);
}

.action-content {
    padding: 30px;
}

.action-content h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #2d3748;
}

.action-content p {
    color: #718096;
    margin-bottom: 25px;
    line-height: 1.6;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    color: white;
}

/* Dashboard Section */
.dashboard-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.dashboard-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.dashboard-content {
    display: flex;
    align-items: center;
    gap: 30px;
    color: #2d3748;
}

.dashboard-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    flex-shrink: 0;
}

.dashboard-info {
    flex: 1;
}

.dashboard-info h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.dashboard-info p {
    font-size: 1.1rem;
    color: #718096;
    margin: 0;
}

.dashboard-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.dashboard-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
    color: white;
}

/* Animation Classes */
.animate-in {
    animation: slideInUp 0.6s ease-out forwards;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading Animation */
body:not(.loaded) {
    overflow: hidden;
}

body:not(.loaded)::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

body:not(.loaded)::after {
    content: '';
    position: fixed;
    top: 50%;
    left: 50%;
    width: 50px;
    height: 50px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top: 3px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 10000;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Enhanced Hover Effects */
.feature-card, .level-card, .lesson-card, .action-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.feature-card:hover, .level-card:hover, .lesson-card:hover, .action-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* Staggered Animation */
.feature-card:nth-child(1) { animation-delay: 0.1s; }
.feature-card:nth-child(2) { animation-delay: 0.2s; }
.feature-card:nth-child(3) { animation-delay: 0.3s; }
.feature-card:nth-child(4) { animation-delay: 0.4s; }
.feature-card:nth-child(5) { animation-delay: 0.5s; }
.feature-card:nth-child(6) { animation-delay: 0.6s; }

.level-card:nth-child(1) { animation-delay: 0.1s; }
.level-card:nth-child(2) { animation-delay: 0.2s; }
.level-card:nth-child(3) { animation-delay: 0.3s; }

/* Pulse Animation for Icons */
.feature-icon, .action-icon, .dashboard-icon {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Gradient Text Animation */
.gradient-text {
    background: linear-gradient(45deg, #ffd700, #ffed4e, #ffd700);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Floating Cards Enhanced Animation */
.floating-card {
    animation: floatCard 6s ease-in-out infinite, glow 4s ease-in-out infinite alternate;
}

@keyframes glow {
    from { box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    to { box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2); }
}

/* Progress Bar Animation */
.progress-fill {
    animation: progressFill 1.5s ease-out;
}

@keyframes progressFill {
    from { width: 0%; }
    to { width: var(--progress-width); }
}

/* Button Hover Effects */
.hero-btn, .level-btn, .lesson-btn, .action-btn, .dashboard-btn {
    position: relative;
    overflow: hidden;
}

.hero-btn::before, .level-btn::before, .lesson-btn::before, .action-btn::before, .dashboard-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.hero-btn:hover::before, .level-btn:hover::before, .lesson-btn:hover::before, .action-btn:hover::before, .dashboard-btn:hover::before {
    left: 100%;
}

/* Image Hover Effects */
.lesson-image img, .action-image img, .level-image img, .feature-image img {
    transition: transform 0.5s ease, filter 0.3s ease;
}

.lesson-card:hover .lesson-image img,
.action-card:hover .action-image img,
.level-card:hover .level-image img,
.feature-card:hover .feature-image img {
    transform: scale(1.1);
    filter: brightness(1.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-actions {
        flex-direction: column;
    }
    
    .hero-stats {
        gap: 20px;
    }
    
    .floating-cards {
        height: 300px;
    }
    
    .floating-card {
        padding: 20px;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .dashboard-content {
        flex-direction: column;
        text-align: center;
    }
    
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
    
    .lessons-grid {
        grid-template-columns: 1fr;
    }
    
    .jlpt-levels {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush
@endsection