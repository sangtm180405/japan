@extends('layouts.app')

@section('title', 'Luyện tập từ vựng')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('practice.index') }}">Luyện tập</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Từ vựng</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 mb-3">
                <i class="fas fa-book me-2"></i>
                Luyện tập từ vựng
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
                            <label for="mode" class="form-label">Chế độ luyện tập</label>
                            <select class="form-select" id="mode" name="mode">
                                <option value="translation" {{ $mode === 'translation' ? 'selected' : '' }}>Dịch từ vựng</option>
                                <option value="japanese" {{ $mode === 'japanese' ? 'selected' : '' }}>Viết tiếng Nhật</option>
                                <option value="audio" {{ $mode === 'audio' ? 'selected' : '' }}>Nghe và viết</option>
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
                        Luyện tập từ vựng N{{ $level }}
                    </h5>
                </div>
                <div class="card-body">
                    @if($mode === 'translation')
                        <!-- Translation Mode -->
                        <div class="row" id="translation-practice">
                            @foreach($vocabularies as $index => $vocabulary)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card practice-card">
                                    <div class="card-body text-center">
                                        <div class="display-4 japanese-text mb-3">{{ $vocabulary->japanese }}</div>
                                        @if($vocabulary->romaji)
                                        <div class="text-muted h5 mb-3">{{ $vocabulary->romaji }}</div>
                                        @endif
                                        
                                        <div class="btn-group w-100 mb-3" role="group">
                                            <button type="button" class="btn btn-outline-primary btn-sm show-answer" data-target="{{ $index }}">
                                                <i class="fas fa-eye me-1"></i>Xem nghĩa
                                            </button>
                                            @if($vocabulary->audio_file)
                                            <button type="button" class="btn btn-outline-success btn-sm play-audio" data-audio="{{ $vocabulary->audio_file }}">
                                                <i class="fas fa-volume-up me-1"></i>Âm thanh
                                            </button>
                                            @endif
                                        </div>
                                        
                                        <div class="answer" id="answer-{{ $index }}" style="display: none;">
                                            <div class="alert alert-success">
                                                <strong>{{ $vocabulary->vietnamese }}</strong>
                                                @if($vocabulary->english)
                                                <br><small class="text-muted">{{ $vocabulary->english }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif($mode === 'japanese')
                        <!-- Japanese Writing Mode -->
                        <div class="row" id="japanese-practice">
                            @foreach($vocabularies as $index => $vocabulary)
                            <div class="col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Viết từ tiếng Nhật:</h5>
                                                <div class="h4 text-primary mb-3">{{ $vocabulary->vietnamese }}</div>
                                                @if($vocabulary->english)
                                                <p class="text-muted">{{ $vocabulary->english }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="writing-area border rounded p-3 mb-3" style="min-height: 100px; background: #f8f9fa;">
                                                    <div class="text-center text-muted">
                                                        <i class="fas fa-pen fa-2x mb-2"></i>
                                                        <br>Viết từ tiếng Nhật ở đây
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
                                                <div class="display-4 japanese-text">{{ $vocabulary->japanese }}</div>
                                                @if($vocabulary->romaji)
                                                <div class="text-muted h5">{{ $vocabulary->romaji }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif($mode === 'audio')
                        <!-- Audio Mode -->
                        <div class="row" id="audio-practice">
                            @foreach($vocabularies as $index => $vocabulary)
                            <div class="col-md-4 col-sm-6 col-12 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        @if($vocabulary->audio_file)
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-primary btn-lg play-audio" data-audio="{{ $vocabulary->audio_file }}">
                                                <i class="fas fa-play me-2"></i>Phát âm
                                            </button>
                                        </div>
                                        @else
                                        <div class="mb-3">
                                            <div class="text-muted">Không có âm thanh</div>
                                        </div>
                                        @endif
                                        
                                        <div class="writing-area border rounded p-3 mb-3" style="min-height: 80px; background: #f8f9fa;">
                                            <div class="text-center text-muted">
                                                <i class="fas fa-pen fa-2x mb-2"></i>
                                                <br>Viết từ bạn nghe được
                                            </div>
                                        </div>
                                        
                                        <button type="button" class="btn btn-outline-primary btn-sm show-correct" data-target="{{ $index }}">
                                            <i class="fas fa-check me-1"></i>Xem đáp án
                                        </button>
                                        
                                        <div class="correct-answer mt-3" id="correct-{{ $index }}" style="display: none;">
                                            <div class="alert alert-success">
                                                <div class="display-4 japanese-text">{{ $vocabulary->japanese }}</div>
                                                @if($vocabulary->romaji)
                                                <div class="text-muted h5">{{ $vocabulary->romaji }}</div>
                                                @endif
                                                <div class="text-primary">{{ $vocabulary->vietnamese }}</div>
                                            </div>
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
            const audioFile = this.getAttribute('data-audio');
            const button = this;
            
            // Show loading state
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang phát...';
            button.disabled = true;
            
            try {
                // Get vocabulary text from the card
                const card = button.closest('.card');
                const japaneseText = card.querySelector('.japanese-text')?.textContent;
                
                if (japaneseText) {
                    await window.playVocabularyAudio(japaneseText, audioFile);
                } else {
                    throw new Error('Không tìm thấy từ vựng');
                }
            } catch (error) {
                console.error('Audio playback error:', error);
                alert('Không thể phát âm thanh. Vui lòng thử lại.');
            } finally {
                // Restore button state
                button.innerHTML = originalHTML;
                button.disabled = false;
            }
        });
    });
});
</script>
@endpush
@endsection
