@extends('layouts.app')

@section('title', 'Quản lý Audio Files')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý Audio</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 mb-3">
                <i class="fas fa-music me-2"></i>
                Quản lý Audio Files
            </h1>
        </div>
    </div>

    <!-- Audio Generator Controls -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Tạo Audio Files
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Tạo các file âm thanh mẫu cho Hiragana, Katakana và từ vựng.
                        <strong>Lưu ý:</strong> Đây là file âm thanh mẫu (silent MP3) để demo.
                    </p>
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary" id="generate-audio-btn">
                            <i class="fas fa-play me-2"></i>Tạo Audio Files
                        </button>
                        <button type="button" class="btn btn-outline-info" id="list-audio-btn">
                            <i class="fas fa-list me-2"></i>Danh sách Files
                        </button>
                        <a href="{{ route('audio.generate') }}" class="btn btn-outline-success" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>API Generate
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Audio Files List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-folder me-2"></i>
                        Danh sách Audio Files
                    </h5>
                </div>
                <div class="card-body">
                    <div id="audio-files-container">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-music fa-3x mb-3"></i>
                            <p>Chưa có audio files nào. Nhấn "Tạo Audio Files" để bắt đầu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Audio Statistics -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Thống kê Audio
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row" id="audio-stats">
                        <div class="col-md-3 text-center">
                            <div class="h3 text-primary" id="hiragana-count">0</div>
                            <small class="text-muted">Hiragana</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="h3 text-success" id="katakana-count">0</div>
                            <small class="text-muted">Katakana</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="h3 text-warning" id="vocabulary-count">0</div>
                            <small class="text-muted">Vocabulary</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="h3 text-info" id="total-count">0</div>
                            <small class="text-muted">Tổng cộng</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('generate-audio-btn');
    const listBtn = document.getElementById('list-audio-btn');
    const container = document.getElementById('audio-files-container');
    
    // Generate audio files
    generateBtn.addEventListener('click', async function() {
        const button = this;
        const originalHTML = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tạo...';
        button.disabled = true;
        
        try {
            const response = await fetch('{{ route("audio.generate") }}');
            const data = await response.json();
            
            if (response.ok) {
                showSuccess(`Đã tạo thành công ${data.total} audio files!`);
                loadAudioFiles();
            } else {
                showError('Lỗi khi tạo audio files: ' + data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Lỗi khi tạo audio files: ' + error.message);
        } finally {
            button.innerHTML = originalHTML;
            button.disabled = false;
        }
    });
    
    // List audio files
    listBtn.addEventListener('click', function() {
        loadAudioFiles();
    });
    
    // Load audio files
    async function loadAudioFiles() {
        try {
            const response = await fetch('{{ route("audio.list") }}');
            const data = await response.json();
            
            if (response.ok) {
                displayAudioFiles(data.audio_files);
                updateStats(data.audio_files);
            } else {
                showError('Lỗi khi tải danh sách audio files');
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Lỗi khi tải danh sách audio files');
        }
    }
    
    // Display audio files
    function displayAudioFiles(files) {
        if (files.length === 0) {
            container.innerHTML = `
                <div class="text-center text-muted py-4">
                    <i class="fas fa-music fa-3x mb-3"></i>
                    <p>Chưa có audio files nào.</p>
                </div>
            `;
            return;
        }
        
        const groupedFiles = files.reduce((acc, file) => {
            if (!acc[file.type]) {
                acc[file.type] = [];
            }
            acc[file.type].push(file);
            return acc;
        }, {});
        
        let html = '';
        
        Object.keys(groupedFiles).forEach(type => {
            const typeFiles = groupedFiles[type];
            const typeName = type.charAt(0).toUpperCase() + type.slice(1);
            const typeColor = type === 'hiragana' ? 'primary' : type === 'katakana' ? 'success' : 'warning';
            
            html += `
                <div class="mb-4">
                    <h6 class="text-${typeColor} mb-3">
                        <i class="fas fa-folder me-2"></i>${typeName} (${typeFiles.length} files)
                    </h6>
                    <div class="row">
            `;
            
            typeFiles.forEach(file => {
                html += `
                    <div class="col-md-3 col-sm-4 col-6 mb-2">
                        <div class="card">
                            <div class="card-body text-center p-2">
                                <div class="h5 japanese-text mb-2">${file.character}</div>
                                <div class="small text-muted mb-2">${file.filename}</div>
                                <div class="btn-group w-100" role="group">
                                    <button class="btn btn-sm btn-outline-primary" onclick="playAudio('${file.url}')">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <a href="${file.url}" class="btn btn-sm btn-outline-success" target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += `
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
    }
    
    // Update statistics
    function updateStats(files) {
        const stats = files.reduce((acc, file) => {
            acc[file.type] = (acc[file.type] || 0) + 1;
            acc.total = (acc.total || 0) + 1;
            return acc;
        }, {});
        
        document.getElementById('hiragana-count').textContent = stats.hiragana || 0;
        document.getElementById('katakana-count').textContent = stats.katakana || 0;
        document.getElementById('vocabulary-count').textContent = stats.vocabulary || 0;
        document.getElementById('total-count').textContent = stats.total || 0;
    }
    
    // Play audio
    window.playAudio = function(url) {
        const audio = new Audio(url);
        audio.play().catch(error => {
            console.error('Audio play error:', error);
            showError('Không thể phát âm thanh');
        });
    };
    
    // Show success message
    function showSuccess(message) {
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show';
        alert.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.container').insertBefore(alert, document.querySelector('.row'));
        
        setTimeout(() => {
            if (alert.parentNode) {
                alert.parentNode.removeChild(alert);
            }
        }, 5000);
    }
    
    // Show error message
    function showError(message) {
        const alert = document.createElement('div');
        alert.className = 'alert alert-danger alert-dismissible fade show';
        alert.innerHTML = `
            <i class="fas fa-exclamation-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.container').insertBefore(alert, document.querySelector('.row'));
        
        setTimeout(() => {
            if (alert.parentNode) {
                alert.parentNode.removeChild(alert);
            }
        }, 5000);
    }
    
    // Load audio files on page load
    loadAudioFiles();
});
</script>
@endpush

@push('styles')
<style>
.japanese-text {
    font-family: 'Noto Sans JP', sans-serif;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endpush
@endsection
