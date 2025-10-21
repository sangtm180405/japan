@extends('layouts.app')

@section('title', 'Kho từ vựng JLPT N' . $level)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jlpt.index') }}">JLPT</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kho từ vựng N{{ $level }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <span class="badge bg-{{ $level <= 3 ? 'success' : ($level == 4 ? 'warning' : 'danger') }} me-2">N{{ $level }}</span>
                Kho từ vựng
            </h1>
            <a href="{{ route('jlpt.vocabulary-bank', ['level' => $level]) }}" class="btn btn-outline-secondary btn-sm">Làm mới</a>
        </div>
    </div>

    <!-- Filters -->
    <form class="card mb-4" method="GET" action="{{ route('jlpt.vocabulary-bank') }}">
        <input type="hidden" name="level" value="{{ $level }}">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Tìm kiếm</label>
                    <input type="text" class="form-control" name="q" value="{{ $q }}" placeholder="Nhập tiếng Nhật / romaji / nghĩa / chủ đề">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Chủ đề</label>
                    <select class="form-select" name="topic">
                        <option value="">Tất cả</option>
                        @foreach($topics as $t)
                            <option value="{{ $t }}" {{ $topic === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100" type="submit">
                        <i class="fas fa-search me-1"></i>Lọc
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Vocabulary list -->
    <div class="card">
        <div class="card-body">
            @if($vocabularies->count() === 0)
                <div class="text-center text-muted py-5">
                    <i class="fas fa-box-open fa-2x mb-3"></i>
                    <div>Chưa có từ vựng cho N{{ $level }}. Hãy nhập dữ liệu hoặc chạy Seeder.</div>
                </div>
            @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 140px;">Tiếng Nhật</th>
                            <th style="width: 160px;">Romaji</th>
                            <th>Nghĩa</th>
                            <th style="width: 160px;">Chủ đề</th>
                            <th style="width: 120px;" class="text-center">Âm thanh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vocabularies as $v)
                        <tr>
                            <td class="japanese-text h5">{{ $v->japanese }}</td>
                            <td class="text-muted">{{ $v->romaji }}</td>
                            <td>{{ $v->vietnamese }}</td>
                            <td><span class="badge bg-light text-dark">{{ $v->topic ?? '—' }}</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" onclick="playText('{{ $v->japanese }}')">
                                    <i class="fas fa-volume-up"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    Hiển thị {{ $vocabularies->firstItem() ?? 0 }} đến {{ $vocabularies->lastItem() ?? 0 }} trong tổng số {{ $vocabularies->total() }} từ
                </div>
                <div>
                    {{ $vocabularies->appends(request()->query())->links('vendor.pagination.simple') }}
                </div>  
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function playText(text){
    if (typeof AudioPlayer !== 'undefined') {
        AudioPlayer.playText(text);
    } else if (window.playText) {
        window.playText(text, { lang: 'ja-JP' });
    } else {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'ja-JP';
        speechSynthesis.speak(utterance);
    }
}
</script>
@endpush

@push('styles')
<style>
.pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    color: #007bff;
    border-color: #dee2e6;
    padding: 0.5rem 0.75rem;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.pagination .page-link:hover {
    color: #0056b3;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.japanese-text {
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 1.1em;
}

.table th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    vertical-align: middle;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>
@endpush
