@extends('layouts.admin')
@section('title','Dashboard Admin')
@section('content')

<div class="min-h-screen bg-gray-50">
    
    {{-- PAGE HEADER --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-blue-100 text-lg">Kelola seluruh konten dan data SMK Maulana Hasanudin dari sini</p>
        <p class="text-blue-200 text-sm mt-2">
            <i class="bi bi-calendar3"></i> {{ now()->translatedFormat('l, d F Y') }}
        </p>
    </div>

    {{-- STATS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        {{-- Total Berita --}}
        <a href="{{ route('admin.berita.index') }}" class="group">
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Berita</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBerita ?? 0 }}</p>
                        <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                            <i class="bi bi-newspaper"></i> Artikel dipublikasikan
                        </p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-4 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                        <i class="bi bi-newspaper text-2xl"></i>
                    </div>
                </div>
            </div>
        </a>

        {{-- Total Kategori --}}
        <a href="{{ route('admin.categories.index') }}" class="group">
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Kategori</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCategories ?? 0 }}</p>
                        <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                            <i class="bi bi-folder"></i> Kategori aktif
                        </p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-4 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition">
                        <i class="bi bi-folder text-2xl"></i>
                    </div>
                </div>
            </div>
        </a>

        {{-- Total Tags --}}
        <a href="{{ route('admin.tags.index') }}" class="group">
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Tag</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalTags ?? 0 }}</p>
                        <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                            <i class="bi bi-tags"></i> Tag yang digunakan
                        </p>
                    </div>
                    <div class="bg-green-100 rounded-full p-4 text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                        <i class="bi bi-tags text-2xl"></i>
                    </div>
                </div>
            </div>
        </a>

        {{-- Total Pesan --}}
        <a href="{{ route('admin.messages.index') }}" class="group">
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Pesan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPesan ?? 0 }}</p>
                        <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                            <i class="bi bi-envelope"></i> Pesan masuk
                        </p>
                    </div>
                    <div class="bg-red-100 rounded-full p-4 text-red-600 group-hover:bg-red-600 group-hover:text-white transition">
                        <i class="bi bi-envelope text-2xl"></i>
                    </div>
                </div>
            </div>
        </a>

    </div>

    {{-- QUICK ACCESS SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        
        {{-- QUICK ACTIONS --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="bi bi-lightning text-yellow-500"></i> Akses Cepat
            </h2>
            <div class="space-y-2">
                <a href="{{ route('admin.berita.create') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-blue-600 transition">
                    <i class="bi bi-plus-circle text-blue-600"></i>
                    <span class="font-medium">Buat Berita Baru</span>
                </a>
                <a href="{{ route('admin.media.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-purple-600 transition">
                    <i class="bi bi-cloud-upload text-purple-600"></i>
                    <span class="font-medium">Upload Media</span>
                </a>
                <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-green-600 transition">
                    <i class="bi bi-folder-plus text-green-600"></i>
                    <span class="font-medium">Tambah Kategori</span>
                </a>
                <a href="{{ route('admin.tags.create') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-indigo-600 transition">
                    <i class="bi bi-plus-square text-indigo-600"></i>
                    <span class="font-medium">Buat Tag Baru</span>
                </a>
            </div>
        </div>

        {{-- MODULES NAVIGATION --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="bi bi-boxes text-blue-600"></i> Modul Manajemen
            </h2>
            <div class="space-y-2">
                <a href="{{ route('admin.berita.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-blue-50 transition group">
                    <span class="flex items-center gap-2 text-gray-700 group-hover:text-blue-600 font-medium">
                        <i class="bi bi-newspaper"></i> Berita
                    </span>
                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-blue-600"></i>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-purple-50 transition group">
                    <span class="flex items-center gap-2 text-gray-700 group-hover:text-purple-600 font-medium">
                        <i class="bi bi-folder"></i> Kategori
                    </span>
                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-purple-600"></i>
                </a>
                <a href="{{ route('admin.tags.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-green-50 transition group">
                    <span class="flex items-center gap-2 text-gray-700 group-hover:text-green-600 font-medium">
                        <i class="bi bi-tags"></i> Tag
                    </span>
                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-green-600"></i>
                </a>
                <a href="{{ route('admin.media.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-orange-50 transition group">
                    <span class="flex items-center gap-2 text-gray-700 group-hover:text-orange-600 font-medium">
                        <i class="bi bi-images"></i> Media
                    </span>
                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-orange-600"></i>
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-red-50 transition group">
                    <span class="flex items-center gap-2 text-gray-700 group-hover:text-red-600 font-medium">
                        <i class="bi bi-graph-up"></i> Analytics
                    </span>
                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-red-600"></i>
                </a>
            </div>
        </div>

        {{-- SYSTEM INFO --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="bi bi-info-circle text-gray-600"></i> Informasi Sistem
            </h2>
            <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-gray-600">Nama Website</span>
                    <span class="font-semibold text-gray-900">Pusat Informasi Dan Pendaftaran SMK MH</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-gray-600">Tech Stack</span>
                    <span class="font-semibold text-gray-900">Laravel12</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-gray-600">Tahun Rilis Website</span>
                    <span class="font-semibold text-gray-900">2026</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Pengelola</span>
                    <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

    </div>

    {{-- HELPFUL TIPS --}}
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <div class="flex gap-4">
            <div class="text-blue-600 text-2xl">
                <i class="bi bi-lightbulb"></i>
            </div>
            <div>
                <h3 class="font-bold text-blue-900 mb-1">💡 Tips Penggunaan</h3>
                <ul class="text-sm text-blue-800 space-y-1 ml-4 list-disc">
                    <li>Buat kategori dan tag terlebih dahulu sebelum membuat berita baru</li>
                    <li>Upload media/gambar melalui Media Library untuk organisasi yang lebih baik</li>
                    <li>Gunakan fitur Analytics untuk melihat berita yang paling banyak dibaca</li>
                    <li>Optimalkan SEO setiap artikel untuk hasil pencarian yang lebih baik</li>
                    <li>Jangan lupa publish berita agar tampil di halaman publik</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection