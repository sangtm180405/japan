@extends('layouts.app')

@section('title', 'Chỉnh sửa từ vựng')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-edit me-2"></i>
            Chỉnh sửa từ vựng
        </h1>
        <a href="{{ route('admin.vocabularies.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.vocabularies.update', $vocabulary) }}" method="POST">
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
                                <option value="{{ $lesson->id }}" {{ old('lesson_id', $vocabulary->lesson_id) == $lesson->id ? 'selected' : '' }}>
                                    {{ $lesson->level_name }} - {{ $lesson->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('lesson_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="japanese" class="form-label">Tiếng Nhật *</label>
                            <input type="text" class="form-control @error('japanese') is-invalid @enderror" 
                                   id="japanese" name="japanese" value="{{ old('japanese', $vocabulary->japanese) }}" required>
                            @error('japanese')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="hiragana" class="form-label">Hiragana *</label>
                            <input type="text" class="form-control @error('hiragana') is-invalid @enderror" 
                                   id="hiragana" name="hiragana" value="{{ old('hiragana', $vocabulary->hiragana) }}" required>
                            @error('hiragana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="katakana" class="form-label">Katakana</label>
                            <input type="text" class="form-control @error('katakana') is-invalid @enderror" 
                                   id="katakana" name="katakana" value="{{ old('katakana', $vocabulary->katakana) }}">
                            @error('katakana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kanji" class="form-label">Kanji</label>
                            <input type="text" class="form-control @error('kanji') is-invalid @enderror" 
                                   id="kanji" name="kanji" value="{{ old('kanji', $vocabulary->kanji) }}">
                            @error('kanji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="romaji" class="form-label">Romaji *</label>
                            <input type="text" class="form-control @error('romaji') is-invalid @enderror" 
                                   id="romaji" name="romaji" value="{{ old('romaji', $vocabulary->romaji) }}" required>
                            @error('romaji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="vietnamese" class="form-label">Tiếng Việt *</label>
                            <input type="text" class="form-control @error('vietnamese') is-invalid @enderror" 
                                   id="vietnamese" name="vietnamese" value="{{ old('vietnamese', $vocabulary->vietnamese) }}" required>
                            @error('vietnamese')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="english" class="form-label">English</label>
                            <input type="text" class="form-control @error('english') is-invalid @enderror" 
                                   id="english" name="english" value="{{ old('english', $vocabulary->english) }}">
                            @error('english')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="example_sentence" class="form-label">Câu ví dụ</label>
                            <textarea class="form-control @error('example_sentence') is-invalid @enderror" 
                                      id="example_sentence" name="example_sentence" rows="2">{{ old('example_sentence', $vocabulary->example_sentence) }}</textarea>
                            @error('example_sentence')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="example_translation" class="form-label">Bản dịch ví dụ</label>
                            <textarea class="form-control @error('example_translation') is-invalid @enderror" 
                                      id="example_translation" name="example_translation" rows="2">{{ old('example_translation', $vocabulary->example_translation) }}</textarea>
                            @error('example_translation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="difficulty_level" class="form-label">Mức độ khó *</label>
                            <select class="form-select @error('difficulty_level') is-invalid @enderror" 
                                    id="difficulty_level" name="difficulty_level" required>
                                <option value="">Chọn mức độ</option>
                                <option value="1" {{ old('difficulty_level', $vocabulary->difficulty_level) == 1 ? 'selected' : '' }}>Rất dễ</option>
                                <option value="2" {{ old('difficulty_level', $vocabulary->difficulty_level) == 2 ? 'selected' : '' }}>Dễ</option>
                                <option value="3" {{ old('difficulty_level', $vocabulary->difficulty_level) == 3 ? 'selected' : '' }}>Trung bình</option>
                                <option value="4" {{ old('difficulty_level', $vocabulary->difficulty_level) == 4 ? 'selected' : '' }}>Khó</option>
                                <option value="5" {{ old('difficulty_level', $vocabulary->difficulty_level) == 5 ? 'selected' : '' }}>Rất khó</option>
                            </select>
                            @error('difficulty_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.vocabularies.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Hủy
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cập nhật từ vựng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
