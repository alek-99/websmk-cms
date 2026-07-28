@extends('layouts.admin')
@section('title', 'Analytics Dashboard')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-chart-line fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Analytics Dashboard</h3>
            <p class="text-muted mb-0">Analisis performa berita dan statistik pembaca</p>
        </div>
    </div>

    {{-- PERIOD FILTER --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" class="d-flex gap-2">
                <select name="period" class="form-select" style="max-width: 200px;">
                    <option value="week" {{ $period === 'week' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="month" {{ $period === 'month' ? 'selected' : '' }}>30 Hari Terakhir</option>
                    <option value="year" {{ $period === 'year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <form method="GET" action="{{ route('admin.analytics.export') }}" class="d-inline">
                <input type="hidden" name="period" value="{{ $period }}">
                <select name="format" class="form-select d-inline" style="max-width: 150px;">
                    <option value="csv">CSV</option>
                    <option value="excel">Excel</option>
                </select>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-download"></i> Export
                </button>
            </form>
        </div>
    </div>

    {{-- KEY STATISTICS --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-muted mb-2">Total Views</h5>
                            <h2 class="fw-bold text-primary">{{ number_format($totalViews) }}</h2>
                        </div>
                        <i class="fa-solid fa-eye fa-2x text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-muted mb-2">Unique Views</h5>
                            <h2 class="fw-bold text-success">{{ number_format($totalUniqueViews) }}</h2>
                        </div>
                        <i class="fa-solid fa-users fa-2x text-success opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-muted mb-2">Shares</h5>
                            <h2 class="fw-bold text-warning">{{ number_format($totalShares) }}</h2>
                        </div>
                        <i class="fa-solid fa-share-nodes fa-2x text-warning opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-muted mb-2">Avg Reading Time</h5>
                            <h2 class="fw-bold text-info">{{ round($avgReadingTime, 1) }}</h2>
                            <small class="text-muted">menit</small>
                        </div>
                        <i class="fa-solid fa-hourglass-end fa-2x text-info opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        {{-- VIEWS CHART --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fa-solid fa-chart-line"></i> Grafik Views
                    </h5>
                    <canvas id="viewsChart" height="80"></canvas>
                </div>
            </div>
        </div>

        {{-- READING TIME HEATMAP --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fa-solid fa-fire"></i> Avg Reading Time
                    </h5>
                    <div class="list-group list-group-flush">
                        @forelse($readingTimeData->slice(0, 10) as $date => $time)
                        <div class="list-group-item d-flex justify-content-between">
                            <small>{{ \Carbon\Carbon::parse($date)->format('d M') }}</small>
                            <strong>{{ round($time, 1) }} min</strong>
                        </div>
                        @empty
                        <p class="text-muted text-center">Belum ada data</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TOP PERFORMING ARTICLES --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fa-solid fa-crown"></i> Top 10 Berita
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul Berita</th>
                                    <th width="15%" class="text-end">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topArticles as $article)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('berita.show', $article->slug) }}"
                                           target="_blank"
                                           class="text-decoration-none">
                                            {{ Str::limit($article->title, 40) }}
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-primary">{{ number_format($article->total_views) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- CATEGORY STATISTICS --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fa-solid fa-folder-open"></i> Statistik Kategori
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th width="15%" class="text-end">Berita</th>
                                    <th width="15%" class="text-end">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categoryStats as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-end">
                                        <span class="badge bg-info">{{ $category->count }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-success">{{ number_format($category->total_views) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Views Chart
    const chartData = @json($chartData);
    const labels = chartData.map(d => new Date(d.date).toLocaleDateString('id-ID', { day: '2-digit', month: 'short' }));
    const views = chartData.map(d => d.views);
    const uniqueViews = chartData.map(d => d.unique_views);

    const ctx = document.getElementById('viewsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Views',
                    data: views,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Unique Views',
                    data: uniqueViews,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

@endsection
