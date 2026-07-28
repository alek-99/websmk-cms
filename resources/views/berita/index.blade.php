@extends('layouts.berita')

@section('title', 'Berita & Artikel - SMK Maulana Hasanudin')
@section('meta_description', 'Berita terbaru, artikel, dan informasi penting dari SMK Maulana Hasanudin')
@section('meta_keywords', 'berita sekolah, SMK Maulana Hasanudin, artikel pendidikan')

@push('meta_tags')
<meta property="og:title" content="Berita & Artikel - SMK Maulana Hasanudin">
<meta property="og:description" content="Berita terbaru dari SMK Maulana Hasanudin">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('storage/images/og-image.png') }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')

{{-- ================= HEADER ================= --}}
<div class="bg-primary text-white py-5">
    <div class="container">
        <h1 class="fw-bold">Berita & Artikel</h1>
        <p class="mb-0 opacity-75">
            Informasi terbaru dari SMK Maulana Hasanudin
        </p>
    </div>
</div>

{{-- ================= MAIN CONTENT ================= --}}
<div class="container py-5">

    <div class="row g-4">

        {{-- ================= SIDEBAR ================= --}}
        <div class="col-lg-4">

            {{-- SEARCH --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-search me-2"></i>Cari Berita
                    </h5>

                    <form method="GET" action="{{ route('berita.search') }}">
                        <div class="input-group">
                            <input type="text"
                                   name="q"
                                   value="{{ request('q') }}"
                                   class="form-control"
                                   placeholder="Ketik kata kunci...">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- CATEGORIES --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">
                    <i class="fas fa-folder me-2"></i>Kategori
                </div>
                <div class="list-group list-group-flush">
                    @foreach($categories as $cat)
                        <a href="{{ route('berita.category', $cat->slug) }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span>{{ $cat->name }}</span>
                            <span class="badge bg-primary rounded-pill">
                                {{ $cat->beritas_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- TAGS --}}
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    <i class="fas fa-tags me-2"></i>Tag Populer
                </div>
                <div class="card-body">
                    @foreach($popularTags as $tag)
                        <a href="{{ route('berita.tag', $tag->slug) }}"
                           class="badge bg-light text-dark me-1 mb-2">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ================= ARTICLES ================= --}}
        <div class="col-lg-8">

            {{-- INFO --}}
            <div class="alert alert-primary">
                Menampilkan {{ $beritas->count() }}
                dari {{ $beritas->total() }} artikel
            </div>

            {{-- ARTICLES LIST --}}
            @foreach($beritas as $article)
            <div class="card shadow-sm mb-4">

                <div class="row g-0">

                    {{-- IMAGE --}}
                    <div class="col-md-4">
                        <img src="{{ asset('storage/'.$article->featured_image) }}"
                             class="img-fluid rounded-start h-100"
                             style="object-fit:cover"
                             alt="{{ $article->title }}">
                    </div>

                    {{-- CONTENT --}}
                    <div class="col-md-8">
                        <div class="card-body">

                            {{-- META --}}
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $article->published_at?->format('d M Y') }}
                                •
                                <i class="fas fa-eye ms-2 me-1"></i>
                                {{ number_format($article->views) }} views
                            </small>

                            {{-- TITLE --}}
                            <h5 class="fw-bold mt-2">
                                <a href="{{ route('berita.show', $article->slug) }}"
                                   class="text-dark text-decoration-none">
                                    {{ $article->title }}
                                </a>
                            </h5>

                            {{-- EXCERPT --}}
                            <p class="text-muted">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 150) }}
                            </p>

                            {{-- BUTTON --}}
                            <a href="{{ route('berita.show', $article->slug) }}"
                               class="btn btn-primary btn-sm">
                                Baca Selengkapnya →
                            </a>

                        </div>
                    </div>

                </div>

            </div>
            @endforeach

            {{-- PAGINATION --}}
            <div class="mt-4">
                {{ $beritas->links() }}
            </div>

        </div>

    </div>

</div>

{{-- ================= NEWSLETTER ================= --}}
<div class="bg-dark text-white py-5">
    <div class="container text-center">

        <h3 class="fw-bold">Jangan Lewatkan Berita Terbaru</h3>
        <p class="opacity-75">
            Daftarkan email untuk mendapatkan update terbaru
        </p>

     

    </div>
</div>

@endsection
