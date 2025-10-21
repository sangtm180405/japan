@extends('layouts.app')

@section('title', 'Thành tích')

@section('content')
<div class="main-content">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 text-center mb-4">
                <i class="fas fa-trophy me-3"></i>
                Thành tích của bạn
            </h1>
        </div>
    </div>

    <div class="row">
        @foreach($achievements as $achievement)
            @php
                $isEarned = in_array($achievement->id, $userAchievements);
            @endphp
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card achievement-card {{ $isEarned ? 'earned' : 'locked' }}">
                    <div class="card-body text-center">
                        <div class="achievement-icon mb-3">
                            <i class="{{ $achievement->icon }} fa-3x {{ $isEarned ? 'text-warning' : 'text-muted' }}"></i>
                        </div>
                        <h5 class="card-title">{{ $achievement->name }}</h5>
                        <p class="card-text text-muted">{{ $achievement->description }}</p>
                        <div class="achievement-meta">
                            <span class="badge bg-primary">{{ $achievement->points }} điểm</span>
                            @if($isEarned)
                                <span class="badge bg-success">Đã đạt được</span>
                            @else
                                <span class="badge bg-secondary">Chưa đạt</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.achievement-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.achievement-card.earned {
    border-color: #28a745;
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
}

.achievement-card.locked {
    opacity: 0.7;
    background: rgba(0,0,0,0.05);
}

.achievement-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.achievement-icon {
    position: relative;
}

.achievement-icon::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(45deg, #ffd700, #ffed4e);
    opacity: 0.1;
    z-index: -1;
}

.achievement-card.earned .achievement-icon::after {
    opacity: 0.3;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
    50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.1; }
    100% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
}
</style>
@endsection
