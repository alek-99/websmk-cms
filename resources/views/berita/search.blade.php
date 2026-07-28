@extends('layouts.berita')

@section('title', 'Hasil Pencarian: ' . request('q') . ' - SMK Maulana Hasanudin')
@section('meta_description', 'Hasil pencarian untuk "' . request('q') . '" di portal berita SMK Maulana Hasanudin')
@section('robots', 'noindex, follow')

@push('meta_tags')
    <meta property="og:title" content="Hasil Pencarian: {{ request('q') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ route('berita.search') }}">
@endpush

@section('content')

{{-- Hero Section --}}
<section class="position-relative overflow-hidden py-5" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); min-height: 250px;">
    <div class="container position-relative text-white py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white bg-opacity-25 px-3 py-2 rounded">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}" class="text-white text-decoration-none">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('berita.index') }}" class="text-white text-decoration-none">Berita</a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">Pencarian</li>
            </ol>
        </nav>

        <h1 class="display-6 fw-bold mb-3">Hasil Pencarian</h1>
        <p class="lead text-white-50 mb-0">
            Mencari: <strong class="text-white">"{{ $query }}"</strong>
        </p>
    </div>
</section>

<div class="bg-light py-5">
    <div class="container">
        
        {{-- Search Box --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('berita.search') }}" role="search">
                    <div class="row g-2">
                        <div class="col-md-9">
                            <input type="search" 
                                   name="q" 
                                   class="form-control form-control-lg" 
                                   placeholder="Cari artikel lain..." 
                                   value="{{ $query }}"
                                   required
                                   autofocus>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($beritas->count() > 0)
            
            {{-- Results Info --}}
            <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>
                    Ditemukan <strong>{{ $beritas->total() }}</strong> hasil untuk pencarian "<strong>{{ $query }}</strong>"
                </div>
            </div>

            {{-- Articles Grid --}}
            <div class="row g-4 mb-5">
                @foreach($beritas as $article)
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                 class="card-img-top h-100 object-fit-cover" 
                                 alt="{{ $article->featured_image_alt }}"
                                 loading="lazy">
                            @if($article->categories->count() > 0)
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-primary">
                                    {{ $article->categories->first()->name }}
                                </span>
                            </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-dark bg-opacity-75">
                                    <i class="bi bi-eye"></i> {{ number_format($article->views) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex gap-2 text-muted small mb-2">
                                <span><i class="bi bi-calendar3"></i> {{ $article->published_at?->translatedFormat('d M Y') }}</span>
                                <span>•</span>
                                <span><i class="bi bi-clock"></i> {{ $article->reading_time }} min</span>
                            </div>
                            <h3 class="card-title h6 fw-bold mb-2 line-clamp-2">
                                <a href="{{ route('berita.show', $article->slug) }}" class="text-dark text-decoration-none stretched-link">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="card-text small text-muted flex-grow-1 line-clamp-3">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                            </p>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
          {{ $beritas->links() }}


        @else
            
            {{-- Empty State --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-search display-1 text-muted mb-4"></i>
                    <h2 class="h4 fw-bold mb-3">Tidak Ada Hasil Ditemukan</h2>
                    <p class="text-muted mb-4">
                        Maaf, tidak ada artikel yang cocok dengan pencarian "<strong>{{ $query }}</strong>".
                    </p>
                    
                    <div class="alert alert-info d-inline-block text-start mb-4">
                        <strong>Saran Pencarian:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Gunakan kata kunci yang lebih umum</li>
                            <li>Periksa ejaan kata kunci</li>
                            <li>Coba kata kunci yang berbeda</li>
                            <li>Gunakan lebih sedikit kata kunci</li>
                        </ul>
                    </div>
                    
                    <div>
                        <a href="{{ route('berita.index') }}" class="btn btn-primary me-2">
                            <i class="bi bi-arrow-left"></i> Lihat Semua Artikel
                        </a>
                        <a href="{{ route('welcome') }}" class="btn btn-outline-primary">
                            <i class="bi bi-house-door"></i> Ke Beranda
                        </a>
                    </div>
                </div>
            </div>

        @endif

    </div>
</div>

@endsection

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush

@push('scripts')
<script>
    // Track search queries
    if (typeof gtag !== 'undefined') {
        gtag('event', 'search', {
            'search_term': '{{ $query }}',
            'results_count': {{ $beritas->total() }}
        });
    }
</script>
@endpush