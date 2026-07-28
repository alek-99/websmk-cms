@extends('layouts.berita')

@section('meta')
<title>{{ $berita->meta_title ?? $berita->title }}</title>
<meta name="description" content="{{ $berita->meta_description }}">
<link rel="canonical" href="{{ $berita->canonical_url ?? url()->current() }}">
@endsection

@section('content')

{{-- ================= HERO ================= --}}
<div class="news-hero">

    @if($berita->featured_image)
        <img src="{{ asset('storage/'.$berita->featured_image) }}" class="hero-bg">
    @endif

    <div class="hero-overlay"></div>

    <div class="container hero-content">

        {{-- Category --}}
        <div class="mb-3">
            @foreach($berita->categories as $cat)
                <span class="badge"
                      style="background: {{ $cat->color ?? '#0d6efd' }}">
                    {{ $cat->name }}
                </span>
            @endforeach
        </div>

        {{-- Title --}}
        <h1 class="hero-title">{{ $berita->title }}</h1>

        {{-- Meta --}}
        <div class="hero-meta">
            <span><i class="fas fa-user"></i> {{ $berita->author->name ?? 'Admin' }}</span>
            <span><i class="fas fa-calendar"></i> {{ $berita->formatted_date }}</span>
            <span><i class="fas fa-clock"></i> {{ $berita->reading_time_minutes }} menit baca</span>
            <span><i class="fas fa-eye"></i> {{ number_format($berita->views) }} views</span>
        </div>

    </div>
</div>

{{-- ================= FLOAT SHARE ================= --}}
<div class="floating-share">

    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
        <i class="fab fa-facebook-f"></i>
    </a>

    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank">
        <i class="fab fa-twitter"></i>
    </a>

    <a href="https://wa.me/?text={{ urlencode($berita->title.' '.url()->current()) }}" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <button onclick="copyLink()">
        <i class="fas fa-link"></i>
    </button>

</div>

{{-- ================= CONTENT ================= --}}
<div class="container py-5">

    {{-- Excerpt --}}
    @if($berita->excerpt)
        <div class="lead-box mb-4">
            {{ $berita->excerpt }}
        </div>
    @endif

    {{-- Article --}}
    <article class="article-content">
        {!! $berita->content !!}
    </article>

    {{-- Tags --}}
    @if($berita->tags->count())
    <div class="mt-5">
        @foreach($berita->tags as $tag)
            <a href="{{ route('berita.tag',$tag->slug) }}" class="tag">
                #{{ $tag->name }}
            </a>
        @endforeach
    </div>
    @endif

</div>

{{-- ================= AUTHOR ================= --}}
@if($berita->author)
<div class="container mb-5">
    <div class="author-box">

        <div class="author-avatar">
            {{ strtoupper(substr($berita->author->name,0,1)) }}
        </div>

        <div>
            <h5 class="mb-1">{{ $berita->author->name }}</h5>
            <p class="text-muted mb-0">Penulis Artikel</p>
        </div>

    </div>
</div>
@endif

{{-- ================= RELATED ================= --}}
@if($related->count())
<div class="container pb-5">
    <h3 class="fw-bold mb-4">Berita Terkait</h3>

    <div class="row g-4">

        @foreach($related as $r)
        <div class="col-md-4">
            <a href="{{ route('berita.show',$r->slug) }}" class="related-card">

                @if($r->featured_image)
                <img src="{{ asset('storage/'.$r->featured_image) }}">
                @endif

                <div class="p-3">
                    <h6>{{ Str::limit($r->title,60) }}</h6>
                    <small class="text-muted">
                        {{ $r->published_at->format('d M Y') }}
                    </small>
                </div>

            </a>
        </div>
        @endforeach

    </div>
</div>
@endif

@endsection

{{-- ================= STYLES ================= --}}
@push('styles')
<style>

.news-hero{
    position:relative;
    height:480px;
    overflow:hidden;
    color:white;
}

.hero-bg{
    width:100%;
    height:100%;
    object-fit:cover;
}

.hero-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(to top, rgba(0,0,0,.85), rgba(0,0,0,.2));
}

.hero-content{
    position:absolute;
    bottom:40px;
    z-index:2;
}

.hero-title{
    font-size:2.6rem;
    font-weight:800;
}

.hero-meta span{
    margin-right:18px;
    opacity:.9;
}

.floating-share{
    position:fixed;
    top:100px;
    right:10px;
    display:flex;
    flex-direction:column;
    gap:10px;
    z-index:999;
}

.floating-share a,
.floating-share button{
    background:#0d6efd;
    color:white;
    border:none;
    width:42px;
    height:42px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
}

.lead-box{
    background:#f8f9fa;
    border-left:5px solid #0d6efd;
    padding:18px;
    font-size:1.2rem;
}

.article-content{
    font-size:1.15rem;
    line-height:1.9;
}

.article-content img{
    max-width:100%;
    border-radius:10px;
    margin:2rem 0;
}

.tag{
    background:#e9ecef;
    padding:6px 12px;
    border-radius:20px;
    text-decoration:none;
    margin-right:8px;
    color:#333;
}

.author-box{
    display:flex;
    align-items:center;
    gap:20px;
    padding:20px;
    border-radius:12px;
    background:#f8f9fa;
}

.author-avatar{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#0d6efd;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.related-card{
    display:block;
    text-decoration:none;
    color:inherit;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 18px rgba(0,0,0,.08);
    transition:.3s;
}

.related-card img{
    width:100%;
    height:180px;
    object-fit:cover;
}

.related-card:hover{
    transform:translateY(-6px);
}

 @media (max-width: 768px) {
    .badge {
        margin-top : 100x;
    }
 }

</style>
@endpush

{{-- ================= SCRIPTS ================= --}}
@push('scripts')
<script>

function copyLink(){
    navigator.clipboard.writeText(window.location.href);
    alert("Link berhasil disalin!");
}

// Reading progress
window.addEventListener('scroll', function(){
    const winScroll=document.documentElement.scrollTop;
    const height=document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled=(winScroll/height)*100;

    let bar=document.getElementById('progressBar');

    if(!bar){
        bar=document.createElement('div');
        bar.id='progressBar';
        bar.style.cssText='position:fixed;top:0;left:0;height:4px;background:#0d6efd;z-index:9999;';
        document.body.appendChild(bar);
    }

    bar.style.width=scrolled+"%";
});

</script>
@endpush
