@extends('layouts.app')

@section('title', 'Luyện tập tổng hợp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('practice.index') }}">Luyện tập</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tổng hợp</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 mb-3">
                <i class="fas fa-random me-2"></i>
                Luyện tập tổng hợp
            </h1>
            
            <!-- Practice Options -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="level" class="form-label">Cấp độ</label>
                            <select class="form-select" id="level" name="level">
                                <option value="1" {{ $level == 1 ? 'selected' : '' }}>N5 - Cơ bản</option>
                                <option value="2" {{ $level == 2 ? 'selected' : '' }}>N4 - Trung bình</option>
                                <option value="3" {{ $level == 3 ? 'selected' : '' }}>N3 - Nâng cao</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="types" class="form-label">Loại ký tự</label>
                            <select class="form-select" id="types" name="types[]" multiple>
                                <option value="hiragana" {{ in_array('hiragana', $types) ? 'selected' : '' }}>Hiragana</option>
                                <option value="katakana" {{ in_array('katakana', $types) ? 'selected' : '' }}>Katakana</option>
                                <option value="kanji" {{ in_array('kanji', $types) ? 'selected' : '' }}>Kanji</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync me-2"></i>Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Practice Area -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-play me-2"></i>
                        Luyện tập tổng hợp N{{ $level }}
                    </h5>
                    <small class="text-muted">
                        Bao gồm: {{ implode(', ', array_map('ucfirst', $types)) }}
                    </small>
                </div>
                <div class="card-body">
                    <div class="row" id="mixed-practice">
                        @foreach($characters as $index => $character)
                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                            <div class="card practice-card" data-character="{{ $character->character }}" data-romaji="{{ $character->romaji }}">
                                <div class="card-body text-center">
                                    <!-- Character Type Badge -->
                                    <div class="mb-2">
                                        @if($character->type === 'hiragana')
                                            <span class="badge bg-primary">HIRAGANA</span>
                                        @elseif($character->type === 'katakana')
                                            <span class="badge bg-success">KATAKANA</span>
                                        @elseif($character->type === 'kanji')
                                            <span class="badge bg-warning">KANJI N{{ $character->difficulty_level }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Character Display -->
                                    <div class="display-2 japanese-text mb-3">{{ $character->character }}</div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="btn-group w-100 mb-3" role="group">
                                        <button type="button" class="btn btn-outline-primary btn-sm show-answer" data-target="{{ $index }}">
                                            <i class="fas fa-eye me-1"></i>Xem
                                        </button>
                                        <button type="button" class="btn btn-outline-success btn-sm play-audio" data-character="{{ $character->character }}">
                                            <i class="fas fa-volume-up me-1"></i>Âm thanh
                                        </button>
                                    </div>
                                    
                                    <!-- Answer Display -->
                                    <div class="answer" id="answer-{{ $index }}" style="display: none;">
                                        <div class="alert alert-info">
                                            <strong class="text-primary">{{ $character->romaji }}</strong>
                                            @if($character->description)
                                            <br><small class="text-muted">{{ $character->description }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Practice Controls -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ route('practice.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>
            <button type="button" class="btn btn-primary" onclick="location.reload()">
                <i class="fas fa-sync me-2"></i>Luyện tập lại
            </button>
            <a href="{{ route('practice.level-test', ['level' => $level, 'type' => 'mixed']) }}" class="btn btn-success ms-2">
                <i class="fas fa-clipboard-check me-2"></i>Kiểm tra trình độ
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show answer functionality
    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const answerDiv = document.getElementById('answer-' + target);
            answerDiv.style.display = answerDiv.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Play audio functionality
    document.querySelectorAll('.play-audio').forEach(button => {
        button.addEventListener('click', async function() {
            const character = this.getAttribute('data-character');
            const button = this;
            
            // Show loading state
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang phát...';
            button.disabled = true;
            
            try {
                // Determine character type based on the character itself
                let type = 'hiragana';
                if (/[ア-ン]/.test(character)) {
                    type = 'katakana';
                } else if (/[一-龯]/.test(character)) {
                    type = 'kanji';
                }
                
                await window.playCharacterAudio(character, type);
            } catch (error) {
                console.error('Audio playback error:', error);
                // Show pronunciation guide as fallback
                const guide = window.japaneseAudioPlayer.getPronunciationGuide(character, type);
                alert(`Phát âm: ${character}\nHướng dẫn: ${guide}`);
            } finally {
                // Restore button state
                button.innerHTML = originalHTML;
                button.disabled = false;
            }
        });
    });

    // Add hover effects
    document.querySelectorAll('.practice-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.practice-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.practice-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.japanese-text {
    font-family: 'Noto Sans JP', sans-serif;
}

.answer {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush
@endsection
