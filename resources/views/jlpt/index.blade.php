@extends('layouts.app')

@section('title', 'Luyện tập JLPT')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 text-center mb-4">
                <i class="fas fa-graduation-cap me-3"></i>
                Luyện tập JLPT
            </h1>
            <p class="lead text-center text-muted">
                Chuẩn bị cho kỳ thi Năng lực Nhật ngữ (JLPT) từ N5 đến N1
            </p>
        </div>
    </div>

    <!-- JLPT Levels Overview -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">Các cấp độ JLPT</h3>
            <div class="row">
                @foreach([5, 4, 3, 2, 1] as $level)
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <div class="card h-100 level-card" data-level="{{ $level }}">
                        <div class="card-body text-center">
                            <div class="level-badge mb-3">
                                <span class="badge bg-{{ $level <= 3 ? 'success' : ($level == 4 ? 'warning' : 'danger') }} fs-4">
                                    N{{ $level }}
                                </span>
                            </div>
                            <h6 class="card-title">
                                @if($level == 5)
                                    Cơ bản
                                @elseif($level == 4)
                                    Sơ cấp
                                @elseif($level == 3)
                                    Trung cấp
                                @elseif($level == 2)
                                    Trung thượng cấp
                                @else
                                    Thượng cấp
                                @endif
                            </h6>
                            <div class="stats">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="h6 text-primary">{{ $stats["n{$level}"]['kanji'] }}</div>
                                        <small class="text-muted">Kanji</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="h6 text-success">{{ $stats["n{$level}"]['vocabulary'] }}</div>
                                        <small class="text-muted">Từ vựng</small>
                                    </div>
                                    <div class="col-4">
                                        <a class="h6 text-info d-block text-decoration-none" href="{{ route('jlpt.lessons', ['level' => $level]) }}">{{ $stats["n{$level}"]['lessons'] }}</a>
                                        <small class="text-muted"><a class="text-decoration-none" href="{{ route('jlpt.lessons', ['level' => $level]) }}">Bài học</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Practice Types -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">Loại luyện tập</h3>
            <div class="row">
                <!-- Level Practice -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-book-open fa-3x text-primary"></i>
                            </div>
                            <h4 class="card-title">Luyện tập theo cấp độ</h4>
                            <p class="card-text">Luyện tập Kanji, từ vựng, ngữ pháp theo từng cấp độ JLPT</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary" id="practice-btn">
                                    <i class="fas fa-play me-2"></i>Bắt đầu luyện tập
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mock Tests -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-clipboard-check fa-3x text-warning"></i>
                            </div>
                            <h4 class="card-title">Thi thử JLPT</h4>
                            <p class="card-text">Làm bài thi thử với format giống kỳ thi thật</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-warning" id="test-btn">
                                    <i class="fas fa-graduation-cap me-2"></i>Bắt đầu thi thử
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Tracking -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-chart-line fa-3x text-success"></i>
                            </div>
                            <h4 class="card-title">Theo dõi tiến độ</h4>
                            <p class="card-text">Xem tiến độ học tập và điểm số của bạn</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-success" id="progress-btn">
                                    <i class="fas fa-chart-bar me-2"></i>Xem tiến độ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Study Plan -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-calendar-alt fa-3x text-info"></i>
                            </div>
                            <h4 class="card-title">Kế hoạch học tập</h4>
                            <p class="card-text">Lập kế hoạch học tập cá nhân cho kỳ thi JLPT</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-info" id="plan-btn">
                                    <i class="fas fa-calendar me-2"></i>Tạo kế hoạch
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Practice -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-bolt fa-3x text-danger"></i>
                            </div>
                            <h4 class="card-title">Luyện tập nhanh</h4>
                            <p class="card-text">Bài tập ngắn để luyện tập hàng ngày</p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('practice.index') }}" class="btn btn-outline-danger">
                                    <i class="fas fa-play me-2"></i>Luyện tập nhanh
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sentence Patterns -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-comments fa-3x text-info"></i>
                            </div>
                            <h4 class="card-title">Mẫu câu giao tiếp</h4>
                            <p class="card-text">Học các mẫu câu cơ bản cho giao tiếp hàng ngày</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-info" id="patterns-btn">
                                    <i class="fas fa-comments me-2"></i>Xem mẫu câu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Dialogues -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-users fa-3x text-purple"></i>
                            </div>
                            <h4 class="card-title">Hội thoại mẫu</h4>
                            <p class="card-text">Thực hành các tình huống giao tiếp thực tế</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-purple" id="dialogues-btn">
                                    <i class="fas fa-users me-2"></i>Xem hội thoại
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-book fa-3x text-secondary"></i>
                            </div>
                            <h4 class="card-title">Tài liệu học tập</h4>
                            <p class="card-text">Truy cập các tài liệu và bài học</p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('lessons.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-book me-2"></i>Xem tài liệu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Level Selector Modal -->
<div class="modal fade" id="levelSelectorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Chọn cấp độ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach([5, 4, 3, 2, 1] as $level)
                    <div class="col-6 mb-3">
                        <button class="btn btn-outline-primary w-100 level-select-btn" data-level="{{ $level }}">
                            <div class="h5 mb-1">N{{ $level }}</div>
                            <small class="text-muted">
                                @if($level == 5)
                                    Cơ bản
                                @elseif($level == 4)
                                    Sơ cấp
                                @elseif($level == 3)
                                    Trung cấp
                                @elseif($level == 2)
                                    Trung thượng cấp
                                @else
                                    Thượng cấp
                                @endif
                            </small>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentAction = '';

function showLevelSelector(action) {
    console.log('showLevelSelector called with action:', action);
    currentAction = action;
    
    // Update modal title based on action
    const titles = {
        'practice': 'Chọn cấp độ để luyện tập',
        'test': 'Chọn cấp độ để thi thử',
        'progress': 'Chọn cấp độ để xem tiến độ',
        'plan': 'Chọn cấp độ để tạo kế hoạch',
        'patterns': 'Chọn cấp độ để xem mẫu câu',
        'dialogues': 'Chọn cấp độ để xem hội thoại'
    };
    
    document.getElementById('modalTitle').textContent = titles[action] || 'Chọn cấp độ';
    
    // Show modal
    const modalElement = document.getElementById('levelSelectorModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing JLPT page...');
    
    // Add event listeners to main action buttons
    document.getElementById('practice-btn').addEventListener('click', function() {
        console.log('Practice button clicked');
        showLevelSelector('practice');
    });
    
    document.getElementById('test-btn').addEventListener('click', function() {
        console.log('Test button clicked');
        showLevelSelector('test');
    });
    
    document.getElementById('progress-btn').addEventListener('click', function() {
        console.log('Progress button clicked');
        showLevelSelector('progress');
    });
    
    document.getElementById('plan-btn').addEventListener('click', function() {
        console.log('Plan button clicked');
        showLevelSelector('plan');
    });
    
    document.getElementById('patterns-btn').addEventListener('click', function() {
        console.log('Patterns button clicked');
        showLevelSelector('patterns');
    });
    
    document.getElementById('dialogues-btn').addEventListener('click', function() {
        console.log('Dialogues button clicked');
        showLevelSelector('dialogues');
    });
    
    // Handle level selection
    document.querySelectorAll('.level-select-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('Level button clicked:', this.getAttribute('data-level'));
            const level = this.getAttribute('data-level');
            
            // Hide modal
            const modalElement = document.getElementById('levelSelectorModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
            
            // Redirect based on action
            let url = '';
            switch(currentAction) {
                case 'practice':
                    url = `{{ route('jlpt.level-practice') }}?level=${level}&type=mixed&mode=practice`;
                    break;
                case 'test':
                    url = `{{ route('jlpt.mock-test') }}?level=${level}&section=all`;
                    break;
                case 'progress':
                    url = `{{ route('jlpt.progress') }}?level=${level}`;
                    break;
                case 'plan':
                    url = `{{ route('jlpt.study-plan') }}?level=${level}&weeks=12`;
                    break;
                case 'patterns':
                    url = `{{ route('jlpt.patterns') }}?level=${level}`;
                    break;
                case 'dialogues':
                    url = `{{ route('jlpt.dialogues') }}?level=${level}`;
                    break;
                default:
                    console.error('Unknown action:', currentAction);
                    return;
            }
            
            console.log('Redirecting to:', url);
            window.location.href = url;
        });
    });
    
    // Add hover effects to level cards
    document.querySelectorAll('.level-card').forEach(card => {
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
.level-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.level-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.level-badge .badge {
    padding: 10px 15px;
    border-radius: 50px;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.text-purple {
    color: #6f42c1 !important;
}

.btn-outline-purple {
    color: #6f42c1;
    border-color: #6f42c1;
}

.btn-outline-purple:hover {
    color: #fff;
    background-color: #6f42c1;
    border-color: #6f42c1;
}
</style>
@endpush
@endsection
