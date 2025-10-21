<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- PWA Meta Tags -->
    <meta name="application-name" content="Japanese Learning App">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="JLearn">
    <meta name="description" content="Ứng dụng học tiếng Nhật toàn diện với JLPT N5-N1">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="msapplication-config" content="/icons/browserconfig.xml">
    <meta name="msapplication-TileColor" content="#6f42c1">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="theme-color" content="#6f42c1">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">
    
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" href="/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/icon-192x192.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/icons/icon-192x192.png">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/icon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/icon-16x16.png">
    <link rel="shortcut icon" href="/icons/icon-192x192.png">
    <title>@yield('title', 'Học Tiếng Nhật') - Japanese Learning App</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></noscript>
    
    <!-- Font Awesome with preload -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"></noscript>
    
    <!-- Google Fonts with display=swap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .navbar .nav-link.active { font-weight: 600; color: #4f46e5 !important; }
        .navbar .brand-mark {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700;
        }
        
        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 20px auto;
            padding: 30px;
        }
        .main-container { margin-top: 90px; margin-bottom: 40px; }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .japanese-text {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.2em;
            font-weight: 500;
        }
        
        .level-badge {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: 600;
        }
        
        .progress-bar {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 10px;
        }
        
        .vocabulary-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin: 10px 0;
        }
        
        .grammar-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin: 10px 0;
        }
        
        .exercise-card {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin: 10px 0;
        }

        footer.site-footer {
            color: #111;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(0,0,0,0.06);
        }
        footer .footer-link { color: #6b7280; text-decoration: none; }
        footer .footer-link:hover { color: #111; text-decoration: underline; }
        
        /* Lazy Loading Styles */
        .lazy {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .lazy.loaded {
            opacity: 1;
        }
        
        .progressive-image {
            transition: filter 0.3s ease;
        }
        
        .progressive-image.low-res {
            filter: blur(5px);
        }
        
        .progressive-image.high-res {
            filter: blur(0);
        }
        
        /* Loading placeholder */
        .image-placeholder {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
    
    @yield('styles')
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="brand-mark">日</span>
                <span>Japanese Learning</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Trang chủ
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessons.*') ? 'active' : '' }}" href="{{ route('lessons.index') }}">
                            <i class="fas fa-book me-1"></i>Bài học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('alphabets.*') ? 'active' : '' }}" href="{{ route('alphabets.index') }}">
                            <i class="fas fa-language me-1"></i>Bảng chữ cái
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('practice.*') ? 'active' : '' }}" href="{{ route('practice.index') }}">
                            <i class="fas fa-dumbbell me-1"></i>Luyện tập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('jlpt.*') ? 'active' : '' }}" href="{{ route('jlpt.index') }}">
                            <i class="fas fa-graduation-cap me-1"></i>JLPT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('achievements.*') ? 'active' : '' }}" href="{{ route('achievements.index') }}">
                            <i class="fas fa-trophy me-1"></i>Thành tích
                        </a>
                    </li>
                    @endauth
                </ul>
                
                <!-- Search Bar -->
                <div class="navbar-search me-3">
                    <form method="GET" action="{{ route('search.index') }}" class="d-flex">
                        <div class="input-group">
                            <input type="text" 
                                   name="q" 
                                   class="form-control search-navbar" 
                                   placeholder="Tìm kiếm..."
                                   value="{{ request('q') }}"
                                   style="border-radius: 20px 0 0 20px; border-right: none;">
                            <button class="btn btn-outline-primary" type="submit" style="border-radius: 0 20px 20px 0;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i>Đăng ký
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">
                                <i class="fas fa-user-cog me-2"></i>Hồ sơ
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('analytics.index') }}">
                                <i class="fas fa-chart-line me-2"></i>Thống kê
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container main-container" id="app" role="main">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @yield('content')
    </div>
    
    <footer class="site-footer py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="brand-mark" style="width:28px;height:28px;font-size:.9rem;">日</span>
                        <span class="fw-semibold">Japanese Learning</span>
                        <span class="text-muted">© {{ date('Y') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end gap-3">
                        <a class="footer-link" href="{{ route('jlpt.index') }}">JLPT</a>
                        <a class="footer-link" href="{{ route('lessons.index') }}">Bài học</a>
                        <a class="footer-link" href="{{ route('practice.index') }}">Luyện tập</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Performance Optimization -->
    <script src="{{ asset('js/performance.js') }}" defer></script>
    <!-- Lazy Loading Script -->
    <script src="{{ asset('js/lazy-loading.js') }}" defer></script>
    <!-- Japanese Audio Player -->
    <script src="{{ asset('js/audio-player.js') }}" defer></script>
    <!-- PWA Install Handler -->
    <script src="{{ asset('js/pwa-install.js') }}" defer></script>
    
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>
