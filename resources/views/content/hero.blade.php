<section id="home" class="luxury-hero" aria-label="Beranda SMK Maulana Hasanuddin">
    <div class="luxury-slider" data-luxury-slider>
        <div class="luxury-slide is-active">
            <img src="{{ asset('storage/images/foto_smk_pramuka.jpeg') }}" alt="Kegiatan Pramuka SMK Maulana Hasanuddin">
            <div class="luxury-slide__shade"></div>
        </div>
        <div class="luxury-slide">
            <img src="{{ asset('storage/images/hero2.jpeg') }}" alt="Lingkungan sekolah SMK Maulana Hasanuddin">
            <div class="luxury-slide__shade"></div>
        </div>
        <div class="luxury-slide">
            <img src="{{ asset('storage/images/praktekkomputer.jpeg') }}" alt="Praktik komputer siswa SMK Maulana Hasanuddin">
            <div class="luxury-slide__shade"></div>
        </div>
        <div class="luxury-slide">
            <img src="{{ asset('storage/images/about.jpeg') }}" alt="Kegiatan SMK Maulana Hasanuddin">
            <div class="luxury-slide__shade"></div>
        </div>
    </div>

    <div class="luxury-hero__content">
        <div class="luxury-hero__eyebrow">
            <span></span>
            Sekolah Berbasis Pesantren Industri
        </div>

        <h1>SMK Maulana Hasanuddin</h1>
        <p>
            Mendidik santri yang berakhlak, kompeten teknologi, siap kerja, siap kuliah,
            dan siap berwirausaha melalui budaya pesantren dan praktik industri.
        </p>

        <div class="luxury-hero__actions">
            <a href="{{ route('pendaftaran') }}" class="luxury-btn luxury-btn--primary">
                <i class="bi bi-pencil-square"></i>
                Daftar SPMB
            </a>
            <a href="#section-jurusan" class="luxury-btn luxury-btn--outline">
                <i class="bi bi-cpu"></i>
                Lihat Jurusan
            </a>
        </div>
    </div>

    <div class="luxury-hero__panel">
        <div>
            <strong>TKJ</strong>
            <span>Komputer dan Jaringan</span>
        </div>
        <div>
            <strong>Pesantren</strong>
            <span>Akhlak dan Disiplin</span>
        </div>
        <div>
            <strong>Industri</strong>
            <span>Praktik dan Portofolio</span>
        </div>
    </div>

    <div class="luxury-slider__controls" aria-label="Kontrol slide foto">
        <button type="button" class="luxury-slider__arrow" data-slide-prev aria-label="Slide sebelumnya">
            <i class="bi bi-chevron-left"></i>
        </button>
        <div class="luxury-slider__dots">
            <button type="button" class="is-active" data-slide-dot="0" aria-label="Tampilkan slide 1"></button>
            <button type="button" data-slide-dot="1" aria-label="Tampilkan slide 2"></button>
            <button type="button" data-slide-dot="2" aria-label="Tampilkan slide 3"></button>
            <button type="button" data-slide-dot="3" aria-label="Tampilkan slide 4"></button>
        </div>
        <button type="button" class="luxury-slider__arrow" data-slide-next aria-label="Slide berikutnya">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
</section>
