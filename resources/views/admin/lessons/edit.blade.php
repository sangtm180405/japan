@extends('layouts.app')

@section('title', 'Chỉnh sửa bài học')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-edit me-2"></i>
            Chỉnh sửa bài học
        </h1>
        <a href="{{ route('admin.lessons.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề bài học *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $lesson->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả bài học *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $lesson->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="level" class="form-label">Cấp độ *</label>
                            <select class="form-select @error('level') is-invalid @enderror" 
                                    id="level" name="level" required>
                                <option value="">Chọn cấp độ</option>
                                <option value="1" {{ old('level', $lesson->level) == 1 ? 'selected' : '' }}>N5 - Cơ bản</option>
                                <option value="2" {{ old('level', $lesson->level) == 2 ? 'selected' : '' }}>N4 - Sơ cấp</option>
                                <option value="3" {{ old('level', $lesson->level) == 3 ? 'selected' : '' }}>N3 - Trung cấp</option>
                                <option value="4" {{ old('level', $lesson->level) == 4 ? 'selected' : '' }}>N2 - Trung cao cấp</option>
                                <option value="5" {{ old('level', $lesson->level) == 5 ? 'selected' : '' }}>N1 - Cao cấp</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="order" class="form-label">Thứ tự *</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', $lesson->order) }}" min="1" required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                   value="1" {{ old('is_active', $lesson->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Kích hoạt bài học
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.lessons.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Hủy
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cập nhật bài học
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
