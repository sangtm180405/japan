@extends('layouts.app')

@section('title', $lesson->title)

@section('content')
<div class="main-content">
    <!-- Lesson Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h1 class="h2 mb-1">{{ $lesson->title }}</h1>
                    <div class="d-flex align-items-center">
                        <span class="level-badge me-3">{{ $lesson->level_name }}</span>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Cập nhật: {{ $lesson->updated_at->format('d/m/Y') }}
                        </small>
                    </div>
                </div>
                <a href="{{ route('lessons.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $lesson->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Section -->
    @if($videos->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">
                <i class="fas fa-play-circle me-2"></i>
                Video học tập ({{ $videos->count() }} video)
            </h3>
            
            <div class="row">
                @foreach($videos as $video)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="ratio ratio-16x9 mb-3">
                                @if($video->type === 'youtube')
                                <iframe src="{{ $video->embed_url }}" 
                                        title="{{ $video->title }}"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                </iframe>
                                @else
                                <video controls>
                                    <source src="{{ $video->video_url }}" type="video/mp4">
                                    Trình duyệt của bạn không hỗ trợ video.
                                </video>
                                @endif
                            </div>
                            
                            <h6 class="card-title">{{ $video->title }}</h6>
                            @if($video->description)
                            <p class="card-text text-muted">{{ Str::limit($video->description, 100) }}</p>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>{{ $video->duration_formatted }}
                                </small>
                                <span class="badge bg-info">{{ ucfirst($video->type) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Gate content: require user to start the lesson first --}}
    @if(!$userProgress)
    <div class="row mb-4">
        <div class="col-12">
            <div class="lesson-gate">
                <div class="gate-left">
                    <div class="gate-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h2 class="gate-title">Bắt đầu bài học</h2>
                    <p class="gate-subtitle">Mở khóa toàn bộ nội dung: Video, Từ vựng, Ngữ pháp và Bài tập.</p>
                    <div class="gate-actions">
                        <form action="{{ route('lessons.start', $lesson) }}" method="POST" onsubmit="this.querySelector('button[type=submit]').disabled=true; this.querySelector('button[type=submit]').innerHTML='<i class=\'fas fa-spinner fa-spin me-2\'></i>Đang bắt đầu...';">
                            @csrf
                            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                            <button type="submit" class="btn gate-primary">
                                <i class="fas fa-play me-2"></i>Bắt đầu học ngay
                            </button>
                        </form>
                        <a href="{{ route('lessons.index') }}" class="btn gate-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                        </a>
                    </div>
                    <ul class="gate-benefits">
                        <li><i class="fas fa-check"></i> Theo dõi tiến độ và điểm số</li>
                        <li><i class="fas fa-check"></i> Tự động lưu hoạt động gần đây</li>
                        <li><i class="fas fa-check"></i> Mở khóa bài tập thực hành</li>
                    </ul>
                </div>
                <div class="gate-right">
                    <div class="gate-illustration">
                        <div class="bubble b1"></div>
                        <div class="bubble b2"></div>
                        <div class="bubble b3"></div>
                        <div class="book-card">
                            <div class="book-spine"></div>
                            <div class="book-pages"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .lesson-gate{display:flex;gap:32px;align-items:center;background:linear-gradient(135deg,#f8faff 0%,#eef2ff 100%);border-radius:20px;padding:32px;border:1px solid #e9ecff;box-shadow:0 10px 30px rgba(102,126,234,.15)}
    .gate-left{flex:1;min-width:0}
    .gate-right{width:340px;display:none}
    @media(min-width:992px){.gate-right{display:block}}
    .gate-icon{width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:28px;margin-bottom:16px;box-shadow:0 12px 30px rgba(118,75,162,.25)}
    .gate-title{margin:0 0 8px;font-weight:800;color:#1f2a56}
    .gate-subtitle{margin:0 0 20px;color:#5b6b95}
    .gate-actions{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:12px}
    .gate-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border:none;padding:12px 20px;border-radius:12px;font-weight:700}
    .gate-primary:hover{transform:translateY(-1px);box-shadow:0 10px 24px rgba(102,126,234,.25)}
    .gate-secondary{border:1px solid #cdd5ff;color:#4252a2;background:#fff;padding:12px 16px;border-radius:12px}
    .gate-benefits{list-style:none;padding:0;margin:8px 0 0;display:flex;gap:16px;flex-wrap:wrap;color:#4b5a89}
    .gate-benefits li{display:flex;align-items:center;gap:8px}
    .gate-benefits i{color:#22c55e}
    .gate-illustration{position:relative;height:180px}
    .bubble{position:absolute;border-radius:50%;background:linear-gradient(135deg,#a5b4fc,#c4b5fd);opacity:.6}
    .b1{width:80px;height:80px;top:0;right:40px}
    .b2{width:50px;height:50px;top:90px;right:0}
    .b3{width:36px;height:36px;top:30px;right:140px}
    .book-card{position:absolute;bottom:0;right:60px;width:150px;height:110px;background:#fff;border-radius:14px;border:1px solid #e8eaff;box-shadow:0 12px 28px rgba(31,42,86,.12);overflow:hidden}
    .book-spine{position:absolute;left:0;top:0;bottom:0;width:18px;background:linear-gradient(180deg,#667eea,#7f8cf5)}
    .book-pages{position:absolute;left:26px;right:16px;top:16px;bottom:16px;background:repeating-linear-gradient(#f8f9ff,#f8f9ff 10px,#eef1ff 11px)}
    </style>
    @else

    <!-- User Progress -->
    @if($userProgress)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Tiến độ của bạn
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="h4 text-primary">{{ $userProgress->score }}</div>
                            <small class="text-muted">Điểm số</small>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="h4 text-success">{{ $userProgress->accuracy_percentage }}%</div>
                            <small class="text-muted">Độ chính xác</small>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="h4 text-info">{{ $userProgress->correct_answers }}/{{ $userProgress->total_questions }}</div>
                            <small class="text-muted">Câu đúng</small>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            @if($userProgress->is_completed)
                                <div class="h4 text-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <small class="text-muted">Hoàn thành</small>
                            @else
                                <div class="h4 text-warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <small class="text-muted">Đang học</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Vocabulary Section -->
    @if($vocabularies->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">
                <i class="fas fa-language me-2"></i>
                Từ vựng ({{ $vocabularies->count() }} từ)
            </h3>
            
            <div class="row">
                @foreach($vocabularies as $vocabulary)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="vocabulary-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="japanese-text mb-0">{{ $vocabulary->japanese }}</h5>
                            @if($vocabulary->audio_file)
                            <button class="btn btn-sm btn-light" onclick="playAudio('{{ $vocabulary->audio_file }}')">
                                <i class="fas fa-play"></i>
                            </button>
                            @endif
                        </div>
                        
                        <div class="mb-2">
                            <small class="opacity-75">Hiragana:</small>
                            <span class="japanese-text">{{ $vocabulary->hiragana }}</span>
                        </div>
                        
                        @if($vocabulary->kanji)
                        <div class="mb-2">
                            <small class="opacity-75">Kanji:</small>
                            <span class="japanese-text">{{ $vocabulary->kanji }}</span>
                        </div>
                        @endif
                        
                        <div class="mb-2">
                            <small class="opacity-75">Romaji:</small>
                            <span>{{ $vocabulary->romaji }}</span>
                        </div>
                        
                        <div class="mb-2">
                            <strong>Tiếng Việt:</strong> {{ $vocabulary->vietnamese }}
                        </div>
                        
                        @if($vocabulary->english)
                        <div class="mb-2">
                            <strong>English:</strong> {{ $vocabulary->english }}
                        </div>
                        @endif
                        
                        @if($vocabulary->example_sentence)
                        <div class="mt-3">
                            <small class="opacity-75">Ví dụ:</small>
                            <div class="japanese-text">{{ $vocabulary->example_sentence }}</div>
                            <div class="small">{{ $vocabulary->example_translation }}</div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Grammar Section -->
    @if($grammars->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">
                <i class="fas fa-book-open me-2"></i>
                Ngữ pháp ({{ $grammars->count() }} điểm)
            </h3>
            
            @foreach($grammars as $grammar)
            <div class="grammar-card mb-3">
                <h5>{{ $grammar->title }}</h5>
                <p>{{ $grammar->explanation }}</p>
                
                <div class="mb-3">
                    <strong>Cấu trúc:</strong>
                    <div class="japanese-text mt-1">{{ $grammar->structure }}</div>
                </div>
                
                @if($grammar->examples)
                <div class="mb-3">
                    <strong>Ví dụ:</strong>
                    <div class="mt-2">
                        <div class="japanese-text">{{ $grammar->examples }}</div>
                    </div>
                </div>
                @endif
                
                @if($grammar->usage_notes)
                <div class="alert alert-light">
                    <strong>Lưu ý:</strong>
                    <div class="mt-2">{{ $grammar->usage_notes }}</div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Exercises Section -->
    @if($exercises->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">
                <i class="fas fa-pencil-alt me-2"></i>
                Bài tập ({{ $exercises->count() }} câu)
            </h3>
            
            <div class="row">
                @foreach($exercises as $exercise)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="exercise-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6>{{ $exercise->type_name }}</h6>
                            <span class="badge bg-light text-dark">{{ $exercise->points }} điểm</span>
                        </div>
                        
                        <p class="mb-3">{{ Str::limit($exercise->question, 100) }}</p>
                        
                        <a href="{{ route('exercises.show', $exercise) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-play me-1"></i>Làm bài
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    @if(!$userProgress->is_completed)
                    <button type="button" class="btn btn-success btn-lg" onclick="completeLesson()">
                        <i class="fas fa-check me-2"></i>Hoàn thành bài học
                    </button>
                    @else
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        Bạn đã hoàn thành bài học này! Chúc mừng!
                    </div>
                    @endif
                    
                    <a href="{{ route('lessons.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Complete Lesson Modal -->
<div class="modal fade" id="completeLessonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hoàn thành bài học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn hoàn thành bài học này không?</p>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Sau khi hoàn thành, bạn sẽ không thể thay đổi điểm số nữa.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form action="{{ route('lessons.complete', $lesson) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="score" value="{{ $userProgress ? $userProgress->score : 0 }}">
                    <input type="hidden" name="total_questions" value="{{ $exercises->count() }}">
                    <input type="hidden" name="correct_answers" value="{{ $userProgress ? $userProgress->correct_answers : 0 }}">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i>Hoàn thành
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function playAudio(audioFile) {
    const audio = new Audio(audioFile);
    audio.play().catch(e => console.log('Audio play failed:', e));
}

function completeLesson() {
    const modal = new bootstrap.Modal(document.getElementById('completeLessonModal'));
    modal.show();
}
</script>
@endsection
