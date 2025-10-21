@extends('layouts.app')

@section('title', 'Chỉnh sửa bài tập')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-edit me-2"></i>
            Chỉnh sửa bài tập
        </h1>
        <a href="{{ route('admin.exercises.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.exercises.update', $exercise) }}" method="POST">
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
                                <option value="{{ $lesson->id }}" {{ old('lesson_id', $exercise->lesson_id) == $lesson->id ? 'selected' : '' }}>
                                    {{ $lesson->level_name }} - {{ $lesson->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('lesson_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Loại bài tập *</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" name="type" required>
                                <option value="">Chọn loại bài tập</option>
                                <option value="multiple_choice" {{ old('type', $exercise->type) == 'multiple_choice' ? 'selected' : '' }}>Trắc nghiệm</option>
                                <option value="fill_blank" {{ old('type', $exercise->type) == 'fill_blank' ? 'selected' : '' }}>Điền từ</option>
                                <option value="translation" {{ old('type', $exercise->type) == 'translation' ? 'selected' : '' }}>Dịch thuật</option>
                                <option value="listening" {{ old('type', $exercise->type) == 'listening' ? 'selected' : '' }}>Nghe hiểu</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="question" class="form-label">Câu hỏi *</label>
                            <textarea class="form-control @error('question') is-invalid @enderror" 
                                      id="question" name="question" rows="3" required>{{ old('question', $exercise->question) }}</textarea>
                            @error('question')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Đáp án đúng *</label>
                            <input type="text" class="form-control @error('correct_answer') is-invalid @enderror" 
                                   id="correct_answer" name="correct_answer" value="{{ old('correct_answer', $exercise->correct_answer) }}" required>
                            @error('correct_answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div id="options-section" style="{{ old('type', $exercise->type) == 'multiple_choice' ? 'display: block;' : 'display: none;' }}">
                            <div class="mb-3">
                                <label class="form-label">Các lựa chọn (cho trắc nghiệm)</label>
                                <div id="options-container">
                                    @if(old('type', $exercise->type) == 'multiple_choice' && $exercise->options)
                                        @foreach($exercise->options as $index => $option)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="options[]" value="{{ $option }}" placeholder="Lựa chọn {{ $index + 1 }}">
                                            <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="options[]" placeholder="Lựa chọn 1">
                                            <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption()">
                                    <i class="fas fa-plus me-1"></i>Thêm lựa chọn
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="explanation" class="form-label">Giải thích</label>
                            <textarea class="form-control @error('explanation') is-invalid @enderror" 
                                      id="explanation" name="explanation" rows="3">{{ old('explanation', $exercise->explanation) }}</textarea>
                            @error('explanation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="points" class="form-label">Điểm số *</label>
                            <input type="number" class="form-control @error('points') is-invalid @enderror" 
                                   id="points" name="points" value="{{ old('points', $exercise->points) }}" min="1" required>
                            @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="difficulty_level" class="form-label">Mức độ khó *</label>
                            <select class="form-select @error('difficulty_level') is-invalid @enderror" 
                                    id="difficulty_level" name="difficulty_level" required>
                                <option value="">Chọn mức độ</option>
                                <option value="1" {{ old('difficulty_level', $exercise->difficulty_level) == 1 ? 'selected' : '' }}>Rất dễ</option>
                                <option value="2" {{ old('difficulty_level', $exercise->difficulty_level) == 2 ? 'selected' : '' }}>Dễ</option>
                                <option value="3" {{ old('difficulty_level', $exercise->difficulty_level) == 3 ? 'selected' : '' }}>Trung bình</option>
                                <option value="4" {{ old('difficulty_level', $exercise->difficulty_level) == 4 ? 'selected' : '' }}>Khó</option>
                                <option value="5" {{ old('difficulty_level', $exercise->difficulty_level) == 5 ? 'selected' : '' }}>Rất khó</option>
                            </select>
                            @error('difficulty_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.exercises.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Hủy
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cập nhật bài tập
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('type').addEventListener('change', function() {
    const optionsSection = document.getElementById('options-section');
    if (this.value === 'multiple_choice') {
        optionsSection.style.display = 'block';
    } else {
        optionsSection.style.display = 'none';
    }
});

function addOption() {
    const container = document.getElementById('options-container');
    const optionCount = container.children.length + 1;
    
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="options[]" placeholder="Lựa chọn ${optionCount}">
        <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
            <i class="fas fa-trash"></i>
        </button>
    `;
    
    container.appendChild(div);
}

function removeOption(button) {
    button.parentElement.remove();
}
</script>
@endsection
