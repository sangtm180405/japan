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
    <link rel="icon" href="/favicon.ico">
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

        /* Mobile Navigation Styles */
        .mobile-nav {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .mobile-nav .navbar-brand {
            font-size: 1.1rem;
        }

        .mobile-nav .brand-text {
            font-weight: 700;
            color: #333;
        }

        /* Mobile Search Toggle */
        .search-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .search-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }

        /* Mobile Search Bar */
        .mobile-search-bar {
            background: rgba(248, 249, 250, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(0,0,0,0.05);
            padding: 15px 0;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Navigation Links */
        .mobile-nav .nav-link {
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            min-height: 44px; /* Touch-friendly */
        }

        .mobile-nav .nav-link:hover {
            background: rgba(0,123,255,0.1);
            transform: translateX(5px);
        }

        .mobile-nav .nav-link.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white !important;
            font-weight: 600;
        }

        .mobile-nav .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Mobile Dropdown */
        .mobile-nav .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 12px;
            margin-top: 8px;
        }

        .mobile-nav .dropdown-item {
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 8px;
            transition: all 0.3s ease;
        }

        .mobile-nav .dropdown-item:hover {
            background: rgba(0,123,255,0.1);
            transform: translateX(5px);
        }

        /* Mobile Navbar Toggle */
        .mobile-nav .navbar-toggler {
            border: none;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .mobile-nav .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
        }

        .mobile-nav .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 37, 41, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .mobile-nav .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                border-radius: 12px;
                margin: 10px;
                padding: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }

            .mobile-nav .navbar-nav {
                margin: 0;
            }

            .mobile-nav .navbar-nav .nav-item {
                margin: 0;
            }
        }

        @media (max-width: 575.98px) {
            .mobile-nav .container-fluid {
                padding: 0 15px;
            }

            .mobile-nav .brand-text {
                font-size: 0.9rem;
            }

            .search-toggle {
                width: 36px;
                height: 36px;
            }
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
    <!-- Mobile-First Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mobile-nav">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="brand-mark">日</span>
                <span class="brand-text d-none d-sm-inline">Japanese Learning</span>
                <span class="brand-text d-sm-none">JLearn</span>
            </a>
            
            <!-- Mobile Search Toggle -->
            <button class="btn btn-outline-primary d-lg-none me-2 search-toggle" type="button" id="mobileSearchToggle">
                <i class="fas fa-search"></i>
            </button>
            
            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Main Navigation -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-2"></i>
                            <span>Trang chủ</span>
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessons.*') ? 'active' : '' }}" href="{{ route('lessons.index') }}">
                            <i class="fas fa-book me-2"></i>
                            <span>Bài học</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('alphabets.*') ? 'active' : '' }}" href="{{ route('alphabets.index') }}">
                            <i class="fas fa-language me-2"></i>
                            <span>Bảng chữ cái</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('practice.*') ? 'active' : '' }}" href="{{ route('practice.index') }}">
                            <i class="fas fa-dumbbell me-2"></i>
                            <span>Luyện tập</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('jlpt.*') ? 'active' : '' }}" href="{{ route('jlpt.index') }}">
                            <i class="fas fa-graduation-cap me-2"></i>
                            <span>JLPT</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('listening.*') ? 'active' : '' }}" href="{{ route('listening.index') }}">
                            <i class="fas fa-headphones me-2"></i>
                            <span>Luyện nghe</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('achievements.*') ? 'active' : '' }}" href="{{ route('achievements.index') }}">
                            <i class="fas fa-trophy me-2"></i>
                            <span>Thành tích</span>
                        </a>
                    </li>
                    @endauth
                </ul>
                
                <!-- Search Bar - Desktop -->
                <div class="navbar-search d-none d-lg-block me-3">
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
                
                <!-- User Menu -->
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <span>Đăng nhập</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-2"></i>
                            <span>Đăng ký</span>
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>
                            <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
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
        
        <!-- Mobile Search Bar -->
        <div class="mobile-search-bar d-lg-none" id="mobileSearchBar" style="display: none;">
            <div class="container-fluid">
                <form method="GET" action="{{ route('search.index') }}" class="d-flex">
                    <div class="input-group">
                        <input type="text" 
                               name="q" 
                               class="form-control" 
                               placeholder="Tìm kiếm..."
                               value="{{ request('q') }}"
                               style="border-radius: 20px 0 0 20px; border-right: none;">
                        <button class="btn btn-primary" type="submit" style="border-radius: 0 20px 20px 0;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
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
    
    <!-- Mobile Navigation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Search Toggle
            const mobileSearchToggle = document.getElementById('mobileSearchToggle');
            const mobileSearchBar = document.getElementById('mobileSearchBar');
            
            if (mobileSearchToggle && mobileSearchBar) {
                mobileSearchToggle.addEventListener('click', function() {
                    if (mobileSearchBar.style.display === 'none' || mobileSearchBar.style.display === '') {
                        mobileSearchBar.style.display = 'block';
                        mobileSearchBar.querySelector('input').focus();
                        mobileSearchToggle.innerHTML = '<i class="fas fa-times"></i>';
                    } else {
                        mobileSearchBar.style.display = 'none';
                        mobileSearchToggle.innerHTML = '<i class="fas fa-search"></i>';
                    }
                });
            }
            
            // Close mobile search when clicking outside
            document.addEventListener('click', function(event) {
                if (mobileSearchBar && mobileSearchToggle) {
                    if (!mobileSearchBar.contains(event.target) && 
                        !mobileSearchToggle.contains(event.target) && 
                        window.innerWidth < 992) {
                        mobileSearchBar.style.display = 'none';
                        mobileSearchToggle.innerHTML = '<i class="fas fa-search"></i>';
                    }
                }
            });
            
            // Navbar scroll effect
            let lastScrollTop = 0;
            const navbar = document.querySelector('.mobile-nav');
            
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // Scrolling down
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    // Scrolling up
                    navbar.style.transform = 'translateY(0)';
                }
                
                lastScrollTop = scrollTop;
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
            
            // Auto-close mobile menu when clicking on a link
            const mobileMenuLinks = document.querySelectorAll('.mobile-nav .nav-link');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();
                    }
                });
            });
            
            // Touch gestures for mobile
            let touchStartX = 0;
            let touchEndX = 0;
            
            document.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            document.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });
            
            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swipe left - could open search
                        if (window.innerWidth < 992 && !mobileSearchBar.style.display) {
                            mobileSearchToggle.click();
                        }
                    } else {
                        // Swipe right - could close search
                        if (window.innerWidth < 992 && mobileSearchBar.style.display === 'block') {
                            mobileSearchToggle.click();
                        }
                    }
                }
            }
        });
    </script>
    
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>
