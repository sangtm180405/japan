@extends('layouts.app')

@section('title', 'Quản lý bài tập')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-pencil-alt me-2"></i>
            Quản lý bài tập
        </h1>
        <a href="{{ route('admin.exercises.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Thêm bài tập mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Câu hỏi</th>
                            <th>Loại</th>
                            <th>Điểm</th>
                            <th>Bài học</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($exercises as $exercise)
                        <tr>
                            <td>{{ $exercise->id }}</td>
                            <td>
                                <strong>{{ Str::limit($exercise->question, 50) }}</strong>
                                @if($exercise->explanation)
                                    <br><small class="text-muted">{{ Str::limit($exercise->explanation, 30) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $exercise->type_name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $exercise->points }} điểm</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.lessons.edit', $exercise->lesson) }}" class="text-decoration-none">
                                    {{ $exercise->lesson->title }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.exercises.edit', $exercise) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.exercises.destroy', $exercise) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa bài tập này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-pencil-alt fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Chưa có bài tập nào</p>
                                <a href="{{ route('admin.exercises.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Thêm bài tập đầu tiên
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($exercises->hasPages())
            <div class="d-flex justify-content-center">
                {{ $exercises->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
