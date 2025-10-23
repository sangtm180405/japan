@extends('layouts.app')

@section('title', 'Luyện tập bảng chữ cái')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('practice.index') }}">Luyện tập</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bảng chữ cái</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 mb-3">
                <i class="fas fa-language me-2"></i>
                Luyện tập bảng chữ cái
            </h1>
            
            <!-- Practice Options -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="type" class="form-label">Loại ký tự</label>
                            <select class="form-select" id="type" name="type">
                                <option value="hiragana" {{ $type === 'hiragana' ? 'selected' : '' }}>Hiragana</option>
                                <option value="katakana" {{ $type === 'katakana' ? 'selected' : '' }}>Katakana</option>
                                <option value="kanji" {{ $type === 'kanji' ? 'selected' : '' }}>Kanji</option>
                                <option value="all" {{ $type === 'all' ? 'selected' : '' }}>Tất cả</option>
                            </select>
                        </div>
                        
                        @if($type === 'kanji' || $type === 'all')
                        <div class="col-md-3">
                            <label for="level" class="form-label">Cấp độ</label>
                            <select class="form-select" id="level" name="level">
                                <option value="1" {{ $level == 1 ? 'selected' : '' }}>N5</option>
                                <option value="2" {{ $level == 2 ? 'selected' : '' }}>N4</option>
                                <option value="3" {{ $level == 3 ? 'selected' : '' }}>N3</option>
                            </select>
                        </div>
                        @endif
                        
                        <div class="col-md-3">
                            <label for="mode" class="form-label">Chế độ luyện tập</label>
                            <select class="form-select" id="mode" name="mode">
                                <option value="recognition" {{ $mode === 'recognition' ? 'selected' : '' }}>Nhận diện</option>
                                <option value="writing" {{ $mode === 'writing' ? 'selected' : '' }}>Viết</option>
                                <option value="pronunciation" {{ $mode === 'pronunciation' ? 'selected' : '' }}>Phát âm</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="ttsSpeed" class="form-label">Tốc độ phát âm</label>
                            <select class="form-select" id="ttsSpeed" name="ttsSpeed">
                                <option value="0.8">0.8x (Chậm)</option>
                                <option value="1.0" selected>1.0x (Bình thường)</option>
                                <option value="1.2">1.2x (Nhanh)</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3 d-flex align-items-end">
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
                        Luyện tập {{ ucfirst($type) }}
                        @if($type === 'kanji') - N{{ $level }} @endif
                    </h5>
                </div>
                <div class="card-body">
                    @if($mode === 'recognition')
                        <!-- Recognition Mode -->
                        <div class="row" id="recognition-practice">
                            @foreach($characters as $index => $character)
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <div class="card practice-card" data-character="{{ $character->character }}" data-romaji="{{ $character->romaji }}">
                                    <div class="card-body text-center">
                                        <div class="display-4 mb-3 japanese-text">{{ $character->character }}</div>
                                        <div class="btn-group w-100" role="group">
                                            <button type="button" class="btn btn-outline-primary btn-sm show-answer" data-target="{{ $index }}">
                                                <i class="fas fa-eye me-1"></i>Xem
                                            </button>
                                            <button type="button" class="btn btn-outline-success btn-sm play-audio" data-character="{{ $character->character }}">
                                                <i class="fas fa-volume-up me-1"></i>Âm thanh
                                            </button>
                                        </div>
                                        <div class="answer mt-2" id="answer-{{ $index }}" style="display: none;">
                                            <strong class="text-primary">{{ $character->romaji }}</strong>
                                            @if($character->description)
                                            <br><small class="text-muted">{{ $character->description }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif($mode === 'writing')
                        <!-- Writing Mode -->
                        <div class="row" id="writing-practice">
                            @foreach($characters as $index => $character)
                            <div class="col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Viết ký tự:</h5>
                                                <div class="h2 text-primary mb-3">{{ $character->romaji }}</div>
                                                @if($character->description)
                                                <p class="text-muted">{{ $character->description }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="writing-area border rounded p-3 mb-3" style="min-height: 100px; background: #f8f9fa;">
                                                    <div class="text-center text-muted">
                                                        <i class="fas fa-pen fa-2x mb-2"></i>
                                                        <br>Viết ký tự ở đây
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm show-correct" data-target="{{ $index }}">
                                                    <i class="fas fa-check me-1"></i>Xem đáp án
                                                </button>
                                            </div>
                                        </div>
                                        <div class="correct-answer mt-3" id="correct-{{ $index }}" style="display: none;">
                                            <div class="alert alert-success">
                                                <strong>Đáp án:</strong>
                                                <div class="display-4 japanese-text">{{ $character->character }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif($mode === 'pronunciation')
                        <!-- Pronunciation Mode -->
                        <div class="row" id="pronunciation-practice">
                            @foreach($characters as $index => $character)
                            <div class="col-md-4 col-sm-6 col-12 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="display-3 japanese-text mb-3">{{ $character->character }}</div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-primary btn-lg play-audio" data-character="{{ $character->character }}">
                                                <i class="fas fa-play me-2"></i>Phát âm
                                            </button>
                                        </div>
                                        <div class="answer">
                                            <strong class="text-primary">{{ $character->romaji }}</strong>
                                            @if($character->description)
                                            <br><small class="text-muted">{{ $character->description }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
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

    // Show correct answer functionality
    document.querySelectorAll('.show-correct').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const correctDiv = document.getElementById('correct-' + target);
            correctDiv.style.display = correctDiv.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Play audio functionality
    document.querySelectorAll('.play-audio').forEach(button => {
        button.addEventListener('click', async function() {
            const character = this.getAttribute('data-character');
            const button = this;
            
            // Get selected speed
            const speedSelect = document.getElementById('ttsSpeed');
            const selectedSpeed = parseFloat(speedSelect.value);
            
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
                
                // Use enhanced audio system with speed control
                if (window.unifiedAudio) {
                    await window.unifiedAudio.playCharacter(character, type, { rate: selectedSpeed });
                } else if (window.enhancedTTS) {
                    // Use enhanced TTS with speed control
                    await window.enhancedTTS.speak(character, { 
                        rate: selectedSpeed, 
                        lang: 'ja-JP' 
                    });
                } else {
                    // Fallback to original system with speed
                    await window.playCharacterAudio(character, type, selectedSpeed);
                }
            } catch (error) {
                console.error('Audio playback error:', error);
                // Không hiển thị alert gây phiền, chỉ log lỗi
            } finally {
                // Restore button state
                button.innerHTML = originalHTML;
                button.disabled = false;
            }
        });
    });
});

// Fallback function for character audio playback with speed control
window.playCharacterAudio = async function(character, type, speed = 1.0) {
    return new Promise((resolve, reject) => {
        if (!('speechSynthesis' in window)) {
            reject(new Error('Speech synthesis not supported'));
            return;
        }

        // Cancel any ongoing speech
        speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(character);
        utterance.lang = 'ja-JP';
        utterance.rate = speed;
        utterance.pitch = 1.0;
        utterance.volume = 1.0;

        // Try to find Japanese voice
        const voices = speechSynthesis.getVoices();
        const japaneseVoice = voices.find(voice => 
            voice.lang.includes('ja-JP') || 
            voice.lang.includes('ja') ||
            voice.name.includes('Japanese')
        );
        
        if (japaneseVoice) {
            utterance.voice = japaneseVoice;
        }

        utterance.onend = () => resolve();
        utterance.onerror = (event) => reject(new Error(event.error));

        speechSynthesis.speak(utterance);
    });
};
</script>
@endpush
@endsection
