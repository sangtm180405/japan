@extends('layouts.app')

@section('title', 'Quản lý từ vựng')

@section('content')
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">
            <i class="fas fa-language me-2"></i>
            Quản lý từ vựng
        </h1>
        <a href="{{ route('admin.vocabularies.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Thêm từ vựng mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiếng Nhật</th>
                            <th>Hiragana</th>
                            <th>Romaji</th>
                            <th>Tiếng Việt</th>
                            <th>Bài học</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vocabularies as $vocabulary)
                        <tr>
                            <td>{{ $vocabulary->id }}</td>
                            <td>
                                <strong class="japanese-text">{{ $vocabulary->japanese }}</strong>
                                @if($vocabulary->kanji)
                                    <br><small class="text-muted">Kanji: {{ $vocabulary->kanji }}</small>
                                @endif
                            </td>
                            <td class="japanese-text">{{ $vocabulary->hiragana }}</td>
                            <td>{{ $vocabulary->romaji }}</td>
                            <td>{{ $vocabulary->vietnamese }}</td>
                            <td>
                                <a href="{{ route('admin.lessons.edit', $vocabulary->lesson) }}" class="text-decoration-none">
                                    {{ $vocabulary->lesson->title }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.vocabularies.edit', $vocabulary) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vocabularies.destroy', $vocabulary) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa từ vựng này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-language fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Chưa có từ vựng nào</p>
                                <a href="{{ route('admin.vocabularies.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Thêm từ vựng đầu tiên
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($vocabularies->hasPages())
            <div class="d-flex justify-content-center">
                {{ $vocabularies->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
