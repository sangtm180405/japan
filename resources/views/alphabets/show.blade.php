@extends('layouts.app')

@section('title', $alphabet->character . ' - ' . $alphabet->type_name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('alphabets.index') }}">Bảng chữ cái</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $alphabet->character }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">
                        <span class="display-1">{{ $alphabet->character }}</span>
                        <small class="text-muted">{{ $alphabet->type_name }}</small>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Thông tin cơ bản</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Ký tự:</strong></td>
                                    <td><span class="display-4">{{ $alphabet->character }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Romaji:</strong></td>
                                    <td><span class="h4 text-primary">{{ $alphabet->romaji }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Loại:</strong></td>
                                    <td><span class="badge bg-info">{{ $alphabet->type_name }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Danh mục:</strong></td>
                                    <td><span class="badge bg-secondary">{{ $alphabet->category_name }}</span></td>
                                </tr>
                                @if($alphabet->difficulty_level)
                                <tr>
                                    <td><strong>Cấp độ:</strong></td>
                                    <td><span class="badge bg-warning">{{ $alphabet->difficulty_level_name }}</span></td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Mô tả</h5>
                            <p class="lead">{{ $alphabet->description }}</p>
                            
                            @if($alphabet->example_word)
                            <h6>Ví dụ:</h6>
                            <p>
                                <strong>{{ $alphabet->example_word }}</strong>
                                @if($alphabet->example_reading)
                                <br><small class="text-muted">({{ $alphabet->example_reading }})</small>
                                @endif
                                @if($alphabet->example_meaning)
                                <br><small class="text-info">{{ $alphabet->example_meaning }}</small>
                                @endif
                            </p>
                            @endif
                        </div>
                    </div>

                    @if($alphabet->stroke_order && is_array($alphabet->stroke_order))
                    <div class="mt-4">
                        <h5>Thứ tự nét vẽ</h5>
                        <div class="row">
                            @foreach($alphabet->stroke_order as $index => $stroke)
                            <div class="col-md-2 col-sm-3 col-4 mb-2">
                                <div class="card text-center">
                                    <div class="card-body p-2">
                                        <div class="h5 mb-1">{{ $index + 1 }}</div>
                                        <div class="small">{{ $stroke }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ký tự liên quan</h5>
                </div>
                <div class="card-body">
                    @if($related->count() > 0)
                    <div class="row">
                        @foreach($related as $relatedAlphabet)
                        <div class="col-6 mb-2">
                            <a href="{{ route('alphabets.show', $relatedAlphabet) }}" class="text-decoration-none">
                                <div class="card h-100">
                                    <div class="card-body text-center p-2">
                                        <div class="h4 mb-1">{{ $relatedAlphabet->character }}</div>
                                        <div class="small text-muted">{{ $relatedAlphabet->romaji }}</div>
                                        <div class="small">
                                            <span class="badge bg-light text-dark">{{ $relatedAlphabet->type_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted">Không có ký tự liên quan.</p>
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body text-center">
                    <a href="{{ route('alphabets.practice') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-play me-2"></i>Luyện tập
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
