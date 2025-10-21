@extends('layouts.app')

@section('title', 'Chỉnh sửa video')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-edit me-2"></i>
            Chỉnh sửa video
        </h1>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.videos.update', $video) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lesson_id" class="form-label">Bài học *</label>
                            <select class="form-select @error('lesson_id') is-invalid @enderror" 
                                    id="lesson_id" name="lesson_id" required>
                                <option value="">Chọn bài học</option>
                                @foreach($lessons as $lesson)
                                <option value="{{ $lesson->id }}" {{ old('lesson_id', $video->lesson_id) == $lesson->id ? 'selected' : '' }}>
                                    {{ $lesson->level_name }} - {{ $lesson->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('lesson_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề video *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $video->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $video->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="video_url" class="form-label">URL Video *</label>
                            <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                                   id="video_url" name="video_url" value="{{ old('video_url', $video->video_url) }}" 
                                   placeholder="https://www.youtube.com/watch?v=..." required>
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Hỗ trợ YouTube URL hoặc link video trực tiếp
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Loại video *</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" name="type" required>
                                <option value="">Chọn loại video</option>
                                <option value="youtube" {{ old('type', $video->type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="upload" {{ old('type', $video->type) == 'upload' ? 'selected' : '' }}>Upload</option>
                                <option value="external" {{ old('type', $video->type) == 'external' ? 'selected' : '' }}>External</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="thumbnail_url" class="form-label">URL Thumbnail</label>
                            <input type="url" class="form-control @error('thumbnail_url') is-invalid @enderror" 
                                   id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url', $video->thumbnail_url) }}"
                                   placeholder="https://example.com/thumbnail.jpg">
                            @error('thumbnail_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Để trống nếu sử dụng YouTube (sẽ tự động lấy thumbnail)
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="duration_seconds" class="form-label">Thời lượng (giây)</label>
                            <input type="number" class="form-control @error('duration_seconds') is-invalid @enderror" 
                                   id="duration_seconds" name="duration_seconds" value="{{ old('duration_seconds', $video->duration_seconds) }}" min="1"
                                   placeholder="300">
                            @error('duration_seconds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Ví dụ: 300 giây = 5 phút
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="order" class="form-label">Thứ tự *</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', $video->order) }}" min="1" required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                   value="1" {{ old('is_active', $video->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Kích hoạt video
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Hủy
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cập nhật video
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
