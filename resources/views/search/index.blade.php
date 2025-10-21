@extends('layouts.app')

@section('title', 'Tìm kiếm')

@section('content')
<div class="main-content">
    <!-- Search Header -->
    <div class="search-header mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 text-center mb-4">
                    <i class="fas fa-search me-3"></i>
                    Tìm kiếm
                </h1>
            </div>
        </div>
        
        <!-- Search Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form method="GET" action="{{ route('search.index') }}" class="search-form">
                    <div class="input-group input-group-lg">
                        <input type="text" 
                               name="q" 
                               value="{{ $query }}" 
                               class="form-control search-input" 
                               placeholder="Tìm kiếm bài học, từ vựng, kanji..."
                               autocomplete="off"
                               id="search-input">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <!-- Search Filters -->
                    <div class="search-filters mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Loại tìm kiếm:</label>
                                <select name="type" class="form-select">
                                    <option value="all" {{ $type === 'all' ? 'selected' : '' }}>Tất cả</option>
                                    <option value="lessons" {{ $type === 'lessons' ? 'selected' : '' }}>Bài học</option>
                                    <option value="vocabulary" {{ $type === 'vocabulary' ? 'selected' : '' }}>Từ vựng</option>
                                    <option value="alphabets" {{ $type === 'alphabets' ? 'selected' : '' }}>Chữ cái</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cấp độ:</label>
                                <select name="level" class="form-select">
                                    <option value="all" {{ $level === 'all' ? 'selected' : '' }}>Tất cả</option>
                                    <option value="1" {{ $level === '1' ? 'selected' : '' }}>N5</option>
                                    <option value="2" {{ $level === '2' ? 'selected' : '' }}>N4</option>
                                    <option value="3" {{ $level === '3' ? 'selected' : '' }}>N3</option>
                                    <option value="4" {{ $level === '4' ? 'selected' : '' }}>N2</option>
                                    <option value="5" {{ $level === '5' ? 'selected' : '' }}>N1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    @if(!empty($query))
        <div class="search-results">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>
                            <i class="fas fa-list me-2"></i>
                            Kết quả tìm kiếm cho "{{ $query }}"
                        </h3>
                        <span class="badge bg-primary fs-6">{{ $results->count() }} kết quả</span>
                    </div>
                    
                    @if($results->count() > 0)
                        <div class="search-results-list">
                            @foreach($results as $result)
                                <div class="search-result-item">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="result-icon">
                                                        <i class="{{ $result['icon'] }}"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h5 class="card-title mb-1">
                                                        <a href="{{ $result['url'] }}" class="text-decoration-none">
                                                            {{ $result['title'] }}
                                                        </a>
                                                    </h5>
                                                    <p class="card-text text-muted mb-1">{{ $result['description'] }}</p>
                                                    <div class="result-meta">
                                                        <span class="badge bg-secondary me-2">{{ $result['level'] }}</span>
                                                        <span class="badge bg-info">{{ ucfirst($result['type']) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="{{ $result['url'] }}" class="btn btn-outline-primary">
                                                        <i class="fas fa-arrow-right me-1"></i>
                                                        Xem
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-results text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4>Không tìm thấy kết quả</h4>
                            <p class="text-muted">Thử tìm kiếm với từ khóa khác hoặc thay đổi bộ lọc</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <!-- Search Tips -->
        <div class="search-tips">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="mb-3">Mẹo tìm kiếm</h4>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="tip-item">
                                        <i class="fas fa-book fa-2x text-primary mb-2"></i>
                                        <h6>Tìm bài học</h6>
                                        <p class="small text-muted">Nhập tên bài học hoặc từ khóa</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="tip-item">
                                        <i class="fas fa-language fa-2x text-success mb-2"></i>
                                        <h6>Tìm từ vựng</h6>
                                        <p class="small text-muted">Tìm bằng tiếng Nhật, hiragana hoặc tiếng Việt</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="tip-item">
                                        <i class="fas fa-font fa-2x text-warning mb-2"></i>
                                        <h6>Tìm chữ cái</h6>
                                        <p class="small text-muted">Tìm kanji, hiragana, katakana</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.search-form .search-input {
    border-radius: 25px 0 0 25px;
    border-right: none;
}

.search-form .btn {
    border-radius: 0 25px 25px 0;
}

.search-result-item .card {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.search-result-item .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border-left-color: #4f46e5;
}

.result-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.search-tips .tip-item {
    padding: 1rem;
    border-radius: 10px;
    background: rgba(255,255,255,0.5);
    transition: all 0.3s ease;
}

.search-tips .tip-item:hover {
    background: rgba(255,255,255,0.8);
    transform: translateY(-2px);
}

.no-results {
    background: rgba(255,255,255,0.5);
    border-radius: 15px;
    margin: 2rem 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const suggestionsContainer = document.createElement('div');
    suggestionsContainer.className = 'search-suggestions position-absolute w-100';
    suggestionsContainer.style.display = 'none';
    suggestionsContainer.style.zIndex = '1000';
    
    searchInput.parentNode.style.position = 'relative';
    searchInput.parentNode.appendChild(suggestionsContainer);
    
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            suggestionsContainer.style.display = 'none';
            return;
        }
        
        searchTimeout = setTimeout(() => {
            fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(suggestions => {
                    if (suggestions.length > 0) {
                        suggestionsContainer.innerHTML = suggestions.map(suggestion => 
                            `<div class="suggestion-item p-2 border-bottom bg-white" style="cursor: pointer;">
                                <i class="fas fa-${suggestion.type === 'vocabulary' ? 'language' : 'book'} me-2"></i>
                                ${suggestion.text}
                            </div>`
                        ).join('');
                        suggestionsContainer.style.display = 'block';
                    } else {
                        suggestionsContainer.style.display = 'none';
                    }
                })
                .catch(() => {
                    suggestionsContainer.style.display = 'none';
                });
        }, 300);
    });
    
    suggestionsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('suggestion-item')) {
            const text = e.target.textContent.trim();
            searchInput.value = text;
            suggestionsContainer.style.display = 'none';
            searchInput.form.submit();
        }
    });
    
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.style.display = 'none';
        }
    });
});
</script>
@endsection
