<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng ký - Japanese Learning App</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            min-height: 600px;
        }
        
        .auth-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex: 1;
        }
        
        .auth-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }
        
        .auth-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .auth-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .auth-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-floating .form-control {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem 0.75rem;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .form-floating .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .form-floating label {
            color: #6c757d;
            font-weight: 500;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .password-strength {
            margin-top: 10px;
        }
        
        .strength-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 5px;
        }
        
        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .strength-weak { background: #dc3545; width: 25%; }
        .strength-fair { background: #ffc107; width: 50%; }
        .strength-good { background: #17a2b8; width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }
        
        .strength-text {
            font-size: 0.875rem;
            margin-top: 5px;
        }
        
        .terms-check {
            margin: 20px 0;
        }
        
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .form-check-label {
            color: #6c757d;
            font-weight: 500;
        }
        
        .terms-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .terms-link:hover {
            color: #764ba2;
        }
        
        .auth-switch {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
        }
        
        .auth-switch a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .auth-switch a:hover {
            color: #764ba2;
        }
        
        .social-login {
            margin-top: 30px;
        }
        
        .social-btn {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            background: white;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }
        
        .social-btn:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-1px);
        }
        
        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
            color: #6c757d;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e9ecef;
        }
        
        .divider span {
            background: white;
            padding: 0 20px;
            position: relative;
        }
        
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                max-width: 400px;
            }
            
            .auth-left {
                padding: 40px 30px;
            }
            
            .auth-right {
                padding: 40px 30px;
            }
            
            .auth-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left Side - Branding -->
        <div class="auth-left">
            <div class="auth-logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="auth-title">Tham gia cùng chúng tôi!</h1>
            <p class="auth-subtitle">
                Bắt đầu hành trình học tiếng Nhật ngay hôm nay
            </p>
            <div class="mt-4">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-book text-warning me-2"></i>
                    <span>1000+ từ vựng JLPT</span>
                </div>
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-play-circle text-warning me-2"></i>
                    <span>Video bài học chất lượng</span>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-users text-warning me-2"></i>
                    <span>Cộng đồng học tập</span>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Register Form -->
        <div class="auth-right">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Tạo tài khoản</h2>
                <p class="text-muted">Điền thông tin để bắt đầu học</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Họ và tên"
                           required 
                           autofocus>
                    <label for="name">
                        <i class="fas fa-user me-2"></i>Họ và tên
                    </label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Email"
                           required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Email
                    </label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Mật khẩu"
                           required>
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Mật khẩu
                    </label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <!-- Password Strength Indicator -->
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Nhập mật khẩu</div>
                    </div>
                </div>
                
                <div class="form-floating">
                    <input type="password" 
                           class="form-control" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           placeholder="Xác nhận mật khẩu"
                           required>
                    <label for="password_confirmation">
                        <i class="fas fa-lock me-2"></i>Xác nhận mật khẩu
                    </label>
                </div>
                
                <div class="terms-check">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Tôi đồng ý với <a href="#" class="terms-link">Điều khoản sử dụng</a> và <a href="#" class="terms-link">Chính sách bảo mật</a>
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register">
                    <i class="fas fa-user-plus me-2"></i>Tạo tài khoản
                </button>
            </form>
            
            <div class="divider">
                <span>Hoặc</span>
            </div>
            
            <div class="social-login">
                <button class="btn social-btn">
                    <i class="fab fa-google me-2"></i>Đăng ký với Google
                </button>
                <button class="btn social-btn">
                    <i class="fab fa-facebook me-2"></i>Đăng ký với Facebook
                </button>
            </div>
            
            <div class="auth-switch">
                <p class="mb-0">
                    Đã có tài khoản? 
                    <a href="{{ route('login') }}">Đăng nhập ngay</a>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let strengthClass = '';
            let strengthLabel = '';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            switch (strength) {
                case 0:
                case 1:
                    strengthClass = 'strength-weak';
                    strengthLabel = 'Mật khẩu yếu';
                    break;
                case 2:
                    strengthClass = 'strength-fair';
                    strengthLabel = 'Mật khẩu trung bình';
                    break;
                case 3:
                case 4:
                    strengthClass = 'strength-good';
                    strengthLabel = 'Mật khẩu tốt';
                    break;
                case 5:
                    strengthClass = 'strength-strong';
                    strengthLabel = 'Mật khẩu mạnh';
                    break;
            }
            
            strengthFill.className = 'strength-fill ' + strengthClass;
            strengthText.textContent = strengthLabel;
        });
        
        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Mật khẩu xác nhận không khớp!');
                return;
            }
            
            if (!terms) {
                e.preventDefault();
                alert('Vui lòng đồng ý với điều khoản sử dụng!');
                return;
            }
        });
    </script>
</body>
</html>