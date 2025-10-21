@extends('layouts.app')

@section('title', 'Quản lý video')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-video me-2"></i>
            Quản lý video
        </h1>
        <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Thêm video mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Video</th>
                            <th>Tiêu đề</th>
                            <th>Bài học</th>
                            <th>Loại</th>
                            <th>Thời lượng</th>
                            <th>Thứ tự</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $video)
                        <tr>
                            <td>{{ $video->id }}</td>
                            <td>
                                @if($video->type === 'youtube' && $video->youtube_id)
                                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg" 
                                     alt="Thumbnail" class="img-thumbnail" style="width: 80px; height: 60px;">
                                @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                     style="width: 80px; height: 60px;">
                                    <i class="fas fa-video text-white"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $video->title }}</strong>
                                @if($video->description)
                                    <br><small class="text-muted">{{ Str::limit($video->description, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.lessons.edit', $video->lesson) }}" class="text-decoration-none">
                                    {{ $video->lesson->title }}
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($video->type) }}</span>
                            </td>
                            <td>{{ $video->duration_formatted }}</td>
                            <td>{{ $video->order }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa video này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-video fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Chưa có video nào</p>
                                <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Thêm video đầu tiên
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($videos->hasPages())
            <div class="d-flex justify-content-center">
                {{ $videos->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
