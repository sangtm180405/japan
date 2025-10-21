@extends('layouts.app')

@section('title', 'Chủ đề JLPT N' . $level)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3>Chủ đề từ vựng N{{ $level }}</h3>
            <a href="{{ route('jlpt.vocabulary-bank', ['level' => $level]) }}" class="btn btn-outline-primary">Xem kho từ vựng</a>
        </div>
    </div>

    <div class="row">
        @forelse($topics as $t)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h6 class="mb-2">{{ $t->topic }}</h6>
                    <div class="text-muted mb-3">{{ $t->total }} từ</div>
                    <a class="mt-auto btn btn-sm btn-outline-secondary" href="{{ route('jlpt.vocabulary-bank', ['level' => $level, 'topic' => $t->topic]) }}">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">Chưa có chủ đề. Vui lòng chạy backfill hoặc thêm từ vựng.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection


