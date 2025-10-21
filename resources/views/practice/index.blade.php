@extends('layouts.app')

@section('title', 'Luyện tập tiếng Nhật')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 text-center mb-4">
                <i class="fas fa-dumbbell me-3"></i>
                Luyện tập tiếng Nhật
            </h1>
            <p class="lead text-center text-muted">
                Chọn loại luyện tập phù hợp với trình độ của bạn
            </p>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-3">Thống kê tài liệu học tập</h3>
            <div class="row">
                <div class="col-md-2 col-sm-4 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 text-primary">{{ $stats['hiragana'] }}</div>
                            <small class="text-muted">Hiragana</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 text-success">{{ $stats['katakana'] }}</div>
                            <small class="text-muted">Katakana</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 text-warning">{{ $stats['kanji_n5'] }}</div>
                            <small class="text-muted">Kanji N5</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 text-info">{{ $stats['kanji_n4'] }}</div>
                            <small class="text-muted">Kanji N4</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 text-danger">{{ $stats['kanji_n3'] }}</div>
                            <small class="text-muted">Kanji N3</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 text-secondary">{{ $stats['vocabularies'] }}</div>
                            <small class="text-muted">Từ vựng</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Practice Types -->
    <div class="row">
        <!-- Alphabet Practice -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-language fa-3x text-primary"></i>
                    </div>
                    <h4 class="card-title">Luyện tập bảng chữ cái</h4>
                    <p class="card-text">Luyện tập Hiragana, Katakana và Kanji cơ bản</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('practice.alphabet', ['type' => 'hiragana']) }}" class="btn btn-outline-primary">
                            <i class="fas fa-play me-2"></i>Hiragana
                        </a>
                        <a href="{{ route('practice.alphabet', ['type' => 'katakana']) }}" class="btn btn-outline-success">
                            <i class="fas fa-play me-2"></i>Katakana
                        </a>
                        <a href="{{ route('practice.alphabet', ['type' => 'kanji', 'level' => 1]) }}" class="btn btn-outline-warning">
                            <i class="fas fa-play me-2"></i>Kanji N5
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vocabulary Practice -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-book fa-3x text-success"></i>
                    </div>
                    <h4 class="card-title">Luyện tập từ vựng</h4>
                    <p class="card-text">Học và luyện tập từ vựng theo cấp độ JLPT</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('practice.vocabulary', ['level' => 1]) }}" class="btn btn-outline-primary">
                            <i class="fas fa-play me-2"></i>N5 - Cơ bản
                        </a>
                        <a href="{{ route('practice.vocabulary', ['level' => 2]) }}" class="btn btn-outline-info">
                            <i class="fas fa-play me-2"></i>N4 - Trung bình
                        </a>
                        <a href="{{ route('practice.vocabulary', ['level' => 3]) }}" class="btn btn-outline-warning">
                            <i class="fas fa-play me-2"></i>N3 - Nâng cao
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mixed Practice -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-random fa-3x text-info"></i>
                    </div>
                    <h4 class="card-title">Luyện tập tổng hợp</h4>
                    <p class="card-text">Kết hợp nhiều loại bài tập khác nhau</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('practice.mixed', ['level' => 1]) }}" class="btn btn-outline-primary">
                            <i class="fas fa-play me-2"></i>N5 - Tổng hợp
                        </a>
                        <a href="{{ route('practice.mixed', ['level' => 2]) }}" class="btn btn-outline-info">
                            <i class="fas fa-play me-2"></i>N4 - Tổng hợp
                        </a>
                        <a href="{{ route('practice.mixed', ['level' => 3]) }}" class="btn btn-outline-warning">
                            <i class="fas fa-play me-2"></i>N3 - Tổng hợp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Level Tests -->
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-clipboard-check fa-3x text-warning"></i>
                    </div>
                    <h4 class="card-title">Kiểm tra trình độ</h4>
                    <p class="card-text">Đánh giá khả năng tiếng Nhật của bạn</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('practice.level-test', ['level' => 1, 'type' => 'mixed']) }}" class="btn btn-outline-primary">
                            <i class="fas fa-graduation-cap me-2"></i>Test N5
                        </a>
                        <a href="{{ route('practice.level-test', ['level' => 2, 'type' => 'mixed']) }}" class="btn btn-outline-info">
                            <i class="fas fa-graduation-cap me-2"></i>Test N4
                        </a>
                        <a href="{{ route('practice.level-test', ['level' => 3, 'type' => 'mixed']) }}" class="btn btn-outline-warning">
                            <i class="fas fa-graduation-cap me-2"></i>Test N3
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Practice -->
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-bolt fa-3x text-danger"></i>
                    </div>
                    <h4 class="card-title">Luyện tập nhanh</h4>
                    <p class="card-text">Bài tập ngắn để luyện tập hàng ngày</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('practice.alphabet', ['type' => 'all', 'mode' => 'recognition']) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-2"></i>Nhận diện ký tự
                        </a>
                        <a href="{{ route('practice.vocabulary', ['level' => 1, 'mode' => 'translation']) }}" class="btn btn-outline-success">
                            <i class="fas fa-language me-2"></i>Dịch từ vựng
                        </a>
                        <a href="{{ route('practice.kanji', ['level' => 1, 'mode' => 'recognition']) }}" class="btn btn-outline-warning">
                            <i class="fas fa-pen me-2"></i>Viết Kanji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
