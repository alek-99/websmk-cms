<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

   @vite(['resources/css/app.css', 'resources/js/app.js'])
  {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@stack('styles')
    <style>
        body {
            overflow-x: hidden;
        }

        /* =========================
           SIDEBAR (SCROLL ENABLED)
           ========================= */
        .sidebar {
            width: 250px;
            height: 100vh;          /* tinggi penuh layar */
            overflow-y: auto;       /* scroll vertikal aktif */
            overflow-x: hidden;
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar .nav-link {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-size: 14px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: #60a5fa;
            padding-left: 24px;
        }

        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            border-left-color: #60a5fa;
            font-weight: 600;
        }

        .sidebar h6 {
            color: rgba(255,255,255,0.75);
            margin-bottom: 8px;
        }

        .badge {
            border-radius: 20px;
            font-size: 10px;
            padding: 2px 6px;
        }

        .bg-blue-500 { background-color: #3b82f6 !important; }
        .bg-red-500  { background-color: #ef4444 !important; }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* =========================
           MOBILE
           ========================= */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
                transition: 0.3s;
                z-index: 1050;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                margin-left: 0;
            }
        }

        /* Optional: scrollbar elegan */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- =========================
     SIDEBAR
     ========================= -->
<div id="sidebar" class="sidebar position-fixed">

    <div class="p-6 text-center border-bottom bg-gradient-to-r from-blue-600 to-blue-800">
        <img src="{{ asset('storage/images/logo.png') }}" alt="logo"
             style="width: 100px; height: auto; display: block; margin: auto;">
        <h5 class="text-white mt-2 text-center">Admin Panel</h5>
    </div>

    <nav class="flex flex-col">

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <div class="mt-6 px-4">
            <h6 class="text-white text-xs font-bold uppercase tracking-wider opacity-75">
                Manajemen Konten
            </h6>
        </div>


        <a href="{{ route('admin.poster.index') }}" class="nav-link">
            <i class="bi bi-book me-2"></i> Poster
        </a>

        <a href="{{ route('admin.berita.index') }}"
           class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper me-2"></i> Berita & Artikel
        </a>

         <a href="{{ route('admin.pengaturan.index') }}"
           class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper me-2"></i> Pengaturan
        </a>
         <a href="{{ route('admin.program.index') }}"
           class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper me-2"></i> Program
        </a>



        <a href="{{ route('admin.galeri.index') }}"
           class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 7v14H5V7m14 0H5m14 0l-2-4H7L5 7"/>
                        </svg> Galeri
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-folder me-2"></i> Kategori
            <span class="badge bg-blue-500 text-xs ms-auto">Manage</span>
        </a>

        <a href="{{ route('admin.tags.index') }}"
           class="nav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
            <i class="bi bi-tags me-2"></i> Tag & Keyword
            <span class="badge bg-blue-500 text-xs ms-auto">Organize</span>
        </a>

        <a href="{{ route('admin.media.index') }}"
           class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <i class="bi bi-images me-2"></i> Media Library
            <span class="badge bg-blue-500 text-xs ms-auto">Upload</span>
        </a>

        <div class="mt-6 px-4">
            <h6 class="text-white text-xs font-bold uppercase tracking-wider opacity-75">
                Analytics & Laporan
            </h6>
        </div>

        <a href="{{ route('admin.analytics.index') }}"
           class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up me-2"></i> Analytics
            <span class="badge bg-red-500 text-xs ms-auto">Stats</span>
        </a>

        <div class="mt-6 px-4">
            <h6 class="text-white text-xs font-bold uppercase tracking-wider opacity-75">
                Lainnya
            </h6>
        </div>

        <a href="{{ route('admin.messages.index') }}"
           class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="bi bi-envelope me-2"></i> Pesan
        </a>

        <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link">
            <i class="bi bi-people me-2"></i> Data Siswa
        </a>

        

        <hr class="my-4 border-blue-500 opacity-25">

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                    class="w-full nav-link text-red-300 hover:bg-red-600/20 hover:text-red-200">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>

    </nav>
</div>

<!-- =========================
     CONTENT
     ========================= -->
<div class="content">

    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded shadow-sm mb-4">
        <div class="container-fluid">

            <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <span class="navbar-brand mb-0 h5">
                @yield('title', 'Dashboard')
            </span>

            <div class="ms-auto">
                <span class="me-3">
                    <i class="bi bi-person-circle"></i> Admin
                </span>
            </div>

        </div>
    </nav>

    <div class="border-0">
        <div class="card-body">
            @yield('content')
        </div>
    </div>

</div>

@stack('scripts')
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
