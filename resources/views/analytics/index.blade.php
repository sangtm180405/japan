@extends('layouts.app')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">📊 Analytics Dashboard</h1>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary" onclick="refreshAnalytics()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                    <button type="button" class="btn btn-outline-success" onclick="exportAnalytics()">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Completion Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $analytics['overview']['completion_rate'] }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Score
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($analytics['overview']['total_score']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Current Level
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $analytics['overview']['current_level'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Study Streak
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $analytics['streak']['current_streak'] }} days
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fire fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Progress Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Learning Progress</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="progressChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Level Distribution -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Level Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="levelChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Row -->
    <div class="row mb-4">
        <!-- Accuracy Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Accuracy by Difficulty</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="accuracyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Streak Progress -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Streak Progress</h6>
                </div>
                <div class="card-body">
                    <div class="progress mb-3">
                        <div class="progress-bar bg-warning" role="progressbar" 
                             style="width: {{ $analytics['streak']['streak_progress'] }}%"
                             aria-valuenow="{{ $analytics['streak']['streak_progress'] }}" 
                             aria-valuemin="0" aria-valuemax="100">
                            {{ round($analytics['streak']['streak_progress'], 1) }}%
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <div class="h4 mb-0">{{ $analytics['streak']['current_streak'] }}</div>
                                <div class="text-xs text-muted">Current Streak</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="h4 mb-0">{{ $analytics['streak']['longest_streak'] }}</div>
                                <div class="text-xs text-muted">Longest Streak</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Lesson</th>
                                <th>Level</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($analytics['recent_activity'] as $activity)
                            <tr>
                                <td>{{ $activity->lesson->title ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-{{ $activity->lesson->level == 1 ? 'success' : ($activity->lesson->level == 2 ? 'info' : ($activity->lesson->level == 3 ? 'warning' : ($activity->lesson->level == 4 ? 'danger' : 'dark'))) }}">
                                        N{{ 6 - $activity->lesson->level }}
                                    </span>
                                </td>
                                <td>{{ $activity->score ?? 0 }}</td>
                                <td>
                                    @if($activity->is_completed)
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-warning">In Progress</span>
                                    @endif
                                </td>
                                <td>{{ $activity->updated_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Progress Chart
const progressCtx = document.getElementById('progressChart').getContext('2d');
const progressChart = new Chart(progressCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($analytics['progress']['weekly_progress']->pluck('date')) !!},
        datasets: [{
            label: 'Lessons Completed',
            data: {!! json_encode($analytics['progress']['weekly_progress']->pluck('lessons')) !!},
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Level Distribution Chart
const levelCtx = document.getElementById('levelChart').getContext('2d');
const levelChart = new Chart(levelCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($analytics['level_distribution']->keys()->map(function($level) { return 'N' . (6 - $level); })) !!},
        datasets: [{
            data: {!! json_encode($analytics['level_distribution']->values()) !!},
            backgroundColor: [
                '#28a745',
                '#17a2b8', 
                '#ffc107',
                '#dc3545',
                '#6c757d'
            ]
        }]
    },
    options: {
        responsive: true
    }
});

// Accuracy Chart
const accuracyCtx = document.getElementById('accuracyChart').getContext('2d');
const accuracyChart = new Chart(accuracyCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($analytics['performance']['by_difficulty']->pluck('difficulty_level')) !!},
        datasets: [{
            label: 'Accuracy Rate (%)',
            data: {!! json_encode($analytics['performance']['by_difficulty']->pluck('accuracy')->map(function($acc) { return round($acc * 100, 1); })) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});

function refreshAnalytics() {
    location.reload();
}

function exportAnalytics() {
    // Implement export functionality
    alert('Export functionality coming soon!');
}
</script>
@endsection
