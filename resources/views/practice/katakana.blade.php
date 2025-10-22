@extends('layouts.app')

@section('title', 'Luyện tập Katakana')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-language me-2"></i>
                        Luyện tập Katakana
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Practice Mode Selector -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="mode" id="recognition" value="recognition" checked>
                                <label class="btn btn-outline-primary" for="recognition">
                                    <i class="fas fa-eye me-1"></i>Nhận diện
                                </label>
                                
                                <input type="radio" class="btn-check" name="mode" id="pronunciation" value="pronunciation">
                                <label class="btn btn-outline-primary" for="pronunciation">
                                    <i class="fas fa-volume-up me-1"></i>Phát âm
                                </label>
                                
                                <input type="radio" class="btn-check" name="mode" id="writing" value="writing">
                                <label class="btn btn-outline-primary" for="writing">
                                    <i class="fas fa-pen me-1"></i>Viết
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-success" onclick="startPractice()">
                                <i class="fas fa-play me-2"></i>Bắt đầu luyện tập
                            </button>
                        </div>
                    </div>

                    <!-- Practice Cards -->
                    <div class="row" id="practiceCards">
                        @foreach($characters as $character)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card practice-card h-100" data-character="{{ $character->character }}">
                                <div class="card-body text-center">
                                    <!-- Character Display -->
                                    <div class="character-display mb-3">
                                        <div class="japanese-character" style="font-size: 3rem; font-weight: bold; color: #dc2626;">
                                            {{ $character->character }}
                                        </div>
                                    </div>
                                    
                                    <!-- Romaji Display -->
                                    <div class="romaji-display mb-3">
                                        <span class="badge bg-danger fs-6">{{ $character->romaji }}</span>
                                    </div>
                                    
                                    <!-- Audio Button -->
                                    <div class="audio-controls mb-3">
                                        <button class="btn btn-outline-danger play-audio" 
                                                data-character="{{ $character->character }}" 
                                                data-type="katakana"
                                                data-title="{{ $character->character }} ({{ $character->romaji }})">
                                            <i class="fas fa-volume-up me-1"></i>Nghe
                                        </button>
                                    </div>
                                    
                                    <!-- Answer Display (Hidden by default) -->
                                    <div class="answer-display" style="display: none;">
                                        <div class="alert alert-info mb-2">
                                            <strong>Romaji:</strong> {{ $character->romaji }}
                                        </div>
                                        @if($character->description)
                                        <div class="alert alert-secondary mb-0">
                                            <strong>Mô tả:</strong> {{ $character->description }}
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Show Answer Button -->
                                    <button class="btn btn-outline-secondary btn-sm show-answer" 
                                            data-target="{{ $character->id }}">
                                        <i class="fas fa-eye me-1"></i>Xem đáp án
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Practice Statistics -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-chart-bar me-2"></i>Thống kê luyện tập
                                    </h6>
                                    <div class="row text-center">
                                        <div class="col-md-3">
                                            <div class="stat-item">
                                                <div class="stat-number text-danger">{{ $characters->count() }}</div>
                                                <div class="stat-label">Ký tự</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="stat-item">
                                                <div class="stat-number text-success" id="correctCount">0</div>
                                                <div class="stat-label">Đúng</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="stat-item">
                                                <div class="stat-number text-danger" id="incorrectCount">0</div>
                                                <div class="stat-label">Sai</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="stat-item">
                                                <div class="stat-number text-info" id="accuracy">0%</div>
                                                <div class="stat-label">Độ chính xác</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let correctCount = 0;
    let incorrectCount = 0;
    let totalAttempts = 0;

    // Show answer functionality
    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const answerDiv = document.querySelector(`[data-character] .answer-display`);
            if (answerDiv) {
                answerDiv.style.display = answerDiv.style.display === 'none' ? 'block' : 'none';
            }
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
                // Use enhanced audio system
                if (window.unifiedAudio) {
                    await window.unifiedAudio.playCharacter(character, 'katakana');
                } else {
                    // Fallback to original system
                    await window.playCharacterAudio(character, 'katakana');
                }
            } catch (error) {
                console.error('Audio playback error:', error);
                // Show pronunciation guide as fallback
                const guide = window.japaneseAudioPlayer?.getPronunciationGuide(character, 'katakana') || 
                             `${character} - Phát âm tiếng Nhật`;
                alert(`Phát âm: ${character}\nHướng dẫn: ${guide}`);
            } finally {
                // Restore button state
                button.innerHTML = originalHTML;
                button.disabled = false;
            }
        });
    });

    // Practice mode change
    document.querySelectorAll('input[name="mode"]').forEach(radio => {
        radio.addEventListener('change', function() {
            updatePracticeMode(this.value);
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

    function updatePracticeMode(mode) {
        const cards = document.querySelectorAll('.practice-card');
        
        cards.forEach(card => {
            const characterDisplay = card.querySelector('.character-display');
            const romajiDisplay = card.querySelector('.romaji-display');
            const audioControls = card.querySelector('.audio-controls');
            const answerDisplay = card.querySelector('.answer-display');
            
            switch(mode) {
                case 'recognition':
                    characterDisplay.style.display = 'block';
                    romajiDisplay.style.display = 'none';
                    audioControls.style.display = 'block';
                    answerDisplay.style.display = 'none';
                    break;
                    
                case 'pronunciation':
                    characterDisplay.style.display = 'block';
                    romajiDisplay.style.display = 'none';
                    audioControls.style.display = 'block';
                    answerDisplay.style.display = 'none';
                    break;
                    
                case 'writing':
                    characterDisplay.style.display = 'none';
                    romajiDisplay.style.display = 'block';
                    audioControls.style.display = 'block';
                    answerDisplay.style.display = 'none';
                    break;
            }
        });
    }

    function startPractice() {
        const selectedMode = document.querySelector('input[name="mode"]:checked').value;
        
        // Reset statistics
        correctCount = 0;
        incorrectCount = 0;
        totalAttempts = 0;
        updateStatistics();
        
        // Show practice instructions
        alert(`Bắt đầu luyện tập chế độ: ${getModeName(selectedMode)}`);
        
        // Update display based on mode
        updatePracticeMode(selectedMode);
    }

    function getModeName(mode) {
        const modes = {
            'recognition': 'Nhận diện',
            'pronunciation': 'Phát âm',
            'writing': 'Viết'
        };
        return modes[mode] || mode;
    }

    function updateStatistics() {
        document.getElementById('correctCount').textContent = correctCount;
        document.getElementById('incorrectCount').textContent = incorrectCount;
        
        const accuracy = totalAttempts > 0 ? Math.round((correctCount / totalAttempts) * 100) : 0;
        document.getElementById('accuracy').textContent = accuracy + '%';
    }

    // Initialize with recognition mode
    updatePracticeMode('recognition');
});
</script>
@endpush
