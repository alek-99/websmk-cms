@extends('layouts.berita')

@section('title', 'Tag: ' . $tag->name . ' - SMK Maulana Hasanudin')
@section('meta_description', 'Baca semua artikel dengan tag ' . $tag->name . ' dari SMK Maulana Hasanudin')

@push('meta_tags')
    <meta property="og:title" content="Tag: {{ $tag->name }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')

<div class="bg-white">
    
    {{-- BREADCRUMB --}}
    <div class="bg-gray-100 border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex items-center gap-2 text-sm" aria-label="breadcrumb">
                <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-700 flex items-center gap-1">
                    <i class="bi bi-house"></i> Home
                </a>
                <i class="bi bi-chevron-right text-gray-400"></i>
                <a href="{{ route('berita.index') }}" class="text-blue-600 hover:text-blue-700">Berita</a>
                <i class="bi bi-chevron-right text-gray-400"></i>
                <span class="text-gray-600">Tag: {{ $tag->name }}</span>
            </nav>
        </div>
    </div>

    {{-- PAGE HEADER --}}
    <div class="bg-gradient-to-r from-blue-800 to-purple-800 text-white py-12 sm:py-16 flex-row d-flex">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-3 mb-4">
                <i class="bi bi-hash text-4xl"></i>
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">{{ $tag->name }}</h1>
            <p class="text-purple-100 text-lg">
                Jelajahi semua artikel yang ditandai dengan <strong>"{{ $tag->name }}"</strong>
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            {{-- SIDEBAR --}}
            <aside class="lg:col-span-1">
                
                {{-- INFO CARD --}}
                <div class="bg-white rounded-xl shadow-md p-6 mb-6 sticky top-20">
                    
                    <div class="text-center mb-6">
                        <div class="inline-block bg-purple-100 text-purple-600 px-6 py-3 rounded-full mb-4">
                            <i class="bi bi-hash text-2xl"></i> {{ $tag->name }}
                        </div>
                        <p class="text-gray-700 font-semibold">
                            <strong>{{ $beritas->total() }}</strong> artikel
                        </p>
                    </div>

                    <hr class="my-6">

                    {{-- POPULAR TAGS --}}
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <i class="bi bi-tags"></i> Tag Terkait
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($popularTags->where('id', '!=', $tag->id)->take(8) as $relatedTag)
                            <a href="{{ route('berita.tag', $relatedTag->slug) }}"
                               class="inline-flex items-center gap-1 bg-purple-100 hover:bg-purple-600 text-purple-700 hover:text-white px-3 py-2 rounded-full text-xs font-semibold transition"
                               title="{{ $relatedTag->beritas_count }} berita">
                                <i class="bi bi-hash"></i> {{ $relatedTag->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </aside>

            {{-- MAIN CONTENT --}}
            <main class="lg:col-span-3">
                
                {{-- FILTER RESULTS INFO --}}
                <div class="mb-6 p-4 bg-purple-50 border-l-4 border-purple-600 rounded">
                    <p class="text-gray-700">
                        Menampilkan <strong>{{ $beritas->count() }}</strong> dari <strong>{{ $beritas->total() }}</strong> artikel dengan tag <strong>#{{ $tag->name }}</strong>
                    </p>
                </div>

                {{-- ARTICLES GRID --}}
                @if($beritas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @foreach($beritas as $article)
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group flex flex-col h-full">
                        
                        {{-- IMAGE CONTAINER --}}
                        <div class="relative h-56 overflow-hidden bg-gray-200">
                            <img src="{{ asset('storage/'.$article->featured_image) }}"
                                 alt="{{ $article->featured_image_alt }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                 loading="lazy">
                            
                            {{-- CATEGORY BADGE --}}
                            @if($article->categories->count() > 0)
                            <div class="absolute top-3 left-3">
                                <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $article->categories->first()?->name }}
                                </span>
                            </div>
                            @endif

                            {{-- VIEW COUNT --}}
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                                <i class="bi bi-eye"></i> {{ number_format($article->views) }}
                            </div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="p-6 flex flex-col flex-grow">
                            
                            {{-- META INFO --}}
                            <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 mb-3 pb-3 border-b border-gray-200">
                                <div class="flex items-center gap-1">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $article->published_at?->translatedFormat('d F Y') }}
                                </div>
                                <span class="text-gray-300">•</span>
                                <div class="flex items-center gap-1">
                                    <i class="bi bi-clock"></i>
                                    {{ $article->reading_time }} menit
                                </div>
                            </div>

                            {{-- TITLE --}}
                            <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition">
                                <a href="{{ route('berita.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h2>

                            {{-- EXCERPT --}}
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 150) }}
                            </p>

                            {{-- TAGS --}}
                            @if($article->tags->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($article->tags as $t)
                                <a href="{{ route('berita.tag', $t->slug) }}"
                                   class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-2 py-1 rounded transition">
                                    #{{ $t->name }}
                                </a>
                                @endforeach
                            </div>
                            @endif

                            {{-- CTA BUTTON --}}
                            <a href="{{ route('berita.show', $article->slug) }}"
                               class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center gap-2 group/btn text-sm">
                                Baca Selengkapnya
                                <i class="bi bi-arrow-right group-hover/btn:translate-x-1 transition"></i>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                <div class="mb-8">
                    {{ $beritas->links() }}
                </div>

                @else
                {{-- EMPTY STATE --}}
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <i class="bi bi-inbox text-6xl text-gray-300 mb-4 block"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Artikel</h3>
                    <p class="text-gray-600 mb-6">
                        Belum ada artikel dengan tag <strong>#{{ $tag->name }}</strong>
                    </p>
                    <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                        <i class="bi bi-arrow-left"></i> Kembali ke Semua Artikel
                    </a>
                </div>
                @endif

            </main>
        </div>
    </div>

</div>

@endsection
