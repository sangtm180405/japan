@extends('layouts.app')

@section('title', 'Bảng chữ cái tiếng Nhật')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-language me-2"></i>
            Bảng chữ cái tiếng Nhật
        </h1>
        <a href="{{ route('alphabets.practice') }}" class="btn btn-primary">
            <i class="fas fa-pencil-alt me-2"></i>Luyện tập
        </a>
    </div>

    <!-- Bộ lọc -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('alphabets.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="type" class="form-label">Loại bảng chữ cái</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">Tất cả</option>
                        <option value="hiragana" {{ request('type') == 'hiragana' ? 'selected' : '' }}>Hiragana</option>
                        <option value="katakana" {{ request('type') == 'katakana' ? 'selected' : '' }}>Katakana</option>
                        <option value="kanji" {{ request('type') == 'kanji' ? 'selected' : '' }}>Kanji</option>
                        <option value="romaji" {{ request('type') == 'romaji' ? 'selected' : '' }}>Romaji</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="level" class="form-label">Cấp độ</label>
                    <select class="form-select" id="level" name="level">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>N5 - Dễ</option>
                        <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>N4 - Trung bình</option>
                        <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>N3 - Khó</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Danh mục</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Tất cả</option>
                        <option value="vowel" {{ request('category') == 'vowel' ? 'selected' : '' }}>Nguyên âm</option>
                        <option value="consonant" {{ request('category') == 'consonant' ? 'selected' : '' }}>Phụ âm</option>
                        <option value="number" {{ request('category') == 'number' ? 'selected' : '' }}>Số đếm</option>
                        <option value="basic" {{ request('category') == 'basic' ? 'selected' : '' }}>Cơ bản</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i>Lọc
                        </button>
                        <a href="{{ route('alphabets.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Xóa
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Thống kê -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $stats['hiragana'] }}</h5>
                    <p class="card-text">Hiragana</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-success">{{ $stats['katakana'] }}</h5>
                    <p class="card-text">Katakana</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-warning">{{ $stats['kanji'] }}</h5>
                    <p class="card-text">Kanji</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-info">{{ $stats['romaji'] }}</h5>
                    <p class="card-text">Romaji</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách ký tự -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse($alphabets as $alphabet)
                <div class="col-md-3 col-lg-2 mb-3">
                    <div class="card h-100 alphabet-card" data-type="{{ $alphabet->type }}">
                        <div class="card-body text-center">
                            <div class="alphabet-character mb-2">
                                <span class="display-4">{{ $alphabet->character }}</span>
                            </div>
                            <div class="alphabet-romaji mb-2">
                                <strong>{{ $alphabet->romaji }}</strong>
                            </div>
                            <div class="alphabet-description mb-2">
                                <small class="text-muted">{{ $alphabet->description }}</small>
                            </div>
                            <div class="alphabet-badges">
                                <span class="badge bg-{{ $alphabet->type == 'hiragana' ? 'primary' : ($alphabet->type == 'katakana' ? 'success' : ($alphabet->type == 'kanji' ? 'warning' : 'info')) }}">
                                    {{ $alphabet->type_name }}
                                </span>
                                <span class="badge bg-secondary">{{ $alphabet->difficulty_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-language fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Không tìm thấy ký tự nào</h5>
                    <p class="text-muted">Hãy thử thay đổi bộ lọc để tìm kiếm</p>
                </div>
                @endforelse
            </div>
            
            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-4">
                {{ $alphabets->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<style>
.alphabet-card {
    transition: transform 0.2s;
    cursor: pointer;
}

.alphabet-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.alphabet-character {
    font-family: 'Noto Sans JP', sans-serif;
}

.alphabet-card[data-type="hiragana"] {
    border-left: 4px solid #007bff;
}

.alphabet-card[data-type="katakana"] {
    border-left: 4px solid #28a745;
}

.alphabet-card[data-type="kanji"] {
    border-left: 4px solid #ffc107;
}

.alphabet-card[data-type="romaji"] {
    border-left: 4px solid #17a2b8;
}

/* Phân trang styling */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}

.pagination .page-item.disabled .page-link {
    background: #6c757d;
    opacity: 0.6;
}

.pagination .page-item.disabled .page-link:hover {
    transform: none;
    box-shadow: none;
}
</style>
@endsection
