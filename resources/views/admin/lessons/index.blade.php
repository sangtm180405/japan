@extends('layouts.app')

@section('title', 'Quản lý bài học')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-book me-2"></i>
            Quản lý bài học
        </h1>
        <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Thêm bài học mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Cấp độ</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->id }}</td>
                            <td>
                                <strong>{{ $lesson->title }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($lesson->description, 50) }}</small>
                            </td>
                            <td>
                                <span class="level-badge">{{ $lesson->level_name }}</span>
                            </td>
                            <td>{{ $lesson->order }}</td>
                            <td>
                                @if($lesson->is_active)
                                    <span class="badge bg-success">Hoạt động</span>
                                @else
                                    <span class="badge bg-secondary">Tạm dừng</span>
                                @endif
                            </td>
                            <td>{{ $lesson->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa bài học này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-book fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Chưa có bài học nào</p>
                                <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Thêm bài học đầu tiên
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($lessons->hasPages())
            <div class="d-flex justify-content-center">
                {{ $lessons->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
