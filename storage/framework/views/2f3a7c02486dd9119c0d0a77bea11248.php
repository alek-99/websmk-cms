<header id="site-header" class="site-header">
    <div class="site-topbar">
        <div class="site-shell site-topbar__inner">
            <div class="site-topbar__links">
                <span class="site-topbar__label">Hubungi Kami</span>
                <a href="https://wa.me/6281293201023" target="_blank" rel="noopener">
                    <i class="bi bi-whatsapp"></i>
                    +62 812-9320-1023
                </a>
                <a href="mailto:info@smkmaulanahasanudin.sch.id">
                    <i class="bi bi-envelope-fill"></i>
                    info@smkmaulanahasanudin.sch.id
                </a>
            </div>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="site-topbar__login">Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="site-topbar__login"
            <?php endif; ?>
        </div>
    </div>

    <div class="site-brandbar">
        <div class="site-shell site-brandbar__inner">
            <a href="#home" class="site-brand">
                <span class="site-brand__logo">
                    <img src="<?php echo e(asset('storage/images/Logo Smk MH.png')); ?>" alt="Logo SMK Maulana Hasanuddin">
                </span>
                <span>
                    <strong>SMK Maulana Hasanuddin</strong>
                    <small>Sekolah Berbasis Pesantren Industri</small>
                </span>
            </a>

            <form action="<?php echo e(route('berita.search')); ?>" method="GET" class="site-search">
                <input type="search" name="q" placeholder="Search" aria-label="Cari berita">
                <button type="submit" aria-label="Cari">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <button id="nav-toggle" type="button" class="site-menu-toggle" aria-controls="nav-menu" aria-expanded="false" aria-label="Buka menu">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>

    <nav class="site-nav">
        <div class="site-shell site-nav__inner" id="nav-menu">
            <a href="#home" class="site-nav__link active">Home</a>
            <a href="<?php echo e(route('pendaftaran')); ?>" class="site-nav__link">SPMB 2026</a>

            <div class="site-dropdown">
                <button type="button" class="site-nav__link site-dropdown__toggle" aria-expanded="false">
                    Profil Sekolah
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="site-dropdown__menu">
                    <a href="#profil-visi">Visi Misi</a>
                    <a href="#profil-program">Program Sekolah</a>
                </div>
            </div>

            <div class="site-dropdown">
                <button type="button" class="site-nav__link site-dropdown__toggle" aria-expanded="false">
                    Berita
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="site-dropdown__menu site-dropdown__menu--small">
                    <a href="#berita">Berita Terbaru</a>
                    <a href="<?php echo e(route('berita.index')); ?>">Semua Berita</a>
                    <a href="#galeri">Galeri Kegiatan</a>
                </div>
            </div>

            <div class="site-dropdown">
                <button type="button" class="site-nav__link site-dropdown__toggle" aria-expanded="false">
                    Program Keahlian
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="site-dropdown__menu site-dropdown__menu--small">
                    <a href="#section-jurusan">Teknik Komputer dan Jaringan</a>
                    <a href="#profil-program">Desain Grafis</a>
                    <a href="#profil-program">Teknisi Komputer</a>
                    <a href="#profil-program">Wirausaha Sablon</a>
                </div>
            </div>

            <div class="site-dropdown">
                <button type="button" class="site-nav__link site-dropdown__toggle" aria-expanded="false">
                    GTK & Siswa
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="site-dropdown__menu site-dropdown__menu--small">
                    <a href="#about">Tenaga Pendidik</a>
                    <a href="#about">Tenaga Kependidikan</a>
                    <a href="#galeri">Kegiatan Siswa</a>
                </div>
            </div>

            <div class="site-dropdown">
                <button type="button" class="site-nav__link site-dropdown__toggle" aria-expanded="false">
                    Layanan Aplikasi
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="site-dropdown__menu site-dropdown__menu--small">
                    <a href="<?php echo e(route('pendaftaran')); ?>">Formulir SPMB</a>
                    <a href="#kontak">Konsultasi PPDB</a>

                </div>
            </div>

            <a href="#kontak" class="site-nav__link">Kontak</a>
        </div>
    </nav>
</header>
<?php /**PATH D:\SMK-MK\resources\views/content/nav.blade.php ENDPATH**/ ?>