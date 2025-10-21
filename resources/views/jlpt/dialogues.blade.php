@extends('layouts.app')

@section('title', 'JLPT N' . $level . ' - Hội thoại mẫu')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <span class="badge bg-danger me-2">N{{ $level }}</span>
            Hội thoại mẫu (Sample Dialogues)
        </h1>
        <a class="btn btn-outline-secondary" href="{{ route('jlpt.index') }}">
            <i class="fas fa-arrow-left me-1"></i>Quay lại JLPT
        </a>
    </div>

    @if(empty($dialogues))
        <div class="alert alert-info">Chưa có dữ liệu hội thoại cho cấp độ này.</div>
    @else
        <div class="accordion" id="dialoguesAccordion">
            @foreach($dialogues as $idx => $d)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $idx }}">
                    <button class="accordion-button {{ $idx === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idx }}" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $idx }}">
                        {{ $d['title'] }}
                    </button>
                </h2>
                <div id="collapse{{ $idx }}" class="accordion-collapse collapse {{ $idx === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $idx }}" data-bs-parent="#dialoguesAccordion">
                    <div class="accordion-body">
                        <div class="list-group">
                            @foreach($d['lines'] as $line)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="small text-muted mb-1">{{ $line['speaker'] }}</div>
                                        <div class="fs-5">{{ $line['jp'] }}</div>
                                        <div class="text-muted">{{ $line['vi'] }}</div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary" onclick="playJapaneseText('{{ e($line['jp']) }}')">
                                        <i class="fas fa-volume-up me-1"></i>Nghe
                                    </button>
                                </div>
                            </div>
                            @endforeach
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


