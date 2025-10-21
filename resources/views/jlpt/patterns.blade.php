@extends('layouts.app')

@section('title', 'JLPT N' . $level . ' - Mẫu câu')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <span class="badge bg-danger me-2">N{{ $level }}</span>
            Mẫu câu (Sentence Patterns)
        </h1>
        <a class="btn btn-outline-secondary" href="{{ route('jlpt.index') }}">
            <i class="fas fa-arrow-left me-1"></i>Quay lại JLPT
        </a>
    </div>

    @if(empty($patterns))
        <div class="alert alert-info">Chưa có dữ liệu mẫu câu cho cấp độ này.</div>
    @else
        <div class="row g-3">
            @foreach($patterns as $p)
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ $p['pattern'] }}</h5>
                            <button class="btn btn-sm btn-outline-primary" onclick="playJapaneseText('{{ e($p['example']) }}')">
                                <i class="fas fa-volume-up me-1"></i>Nghe
                            </button>
                        </div>
                        <p class="text-muted mb-2">Ý nghĩa: {{ $p['meaning'] }}</p>
                        <div class="p-3 bg-light rounded mb-2">
                            <div class="fw-semibold">Ví dụ</div>
                            <div class="fs-5">{{ $p['example'] }}</div>
                            <div class="text-muted">{{ $p['translation'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
<script src="/js/audio-player.js"></script>
<script>
function playJapaneseText(text) {
    if (window.playText) {
        window.playText(text, { lang: 'ja-JP' });
    } else {
        const utter = new SpeechSynthesisUtterance(text);
        utter.lang = 'ja-JP';
        speechSynthesis.speak(utter);
    }
}
</script>
@endpush
@endsection


