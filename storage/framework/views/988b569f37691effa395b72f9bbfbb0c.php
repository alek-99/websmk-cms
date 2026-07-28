<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <title>SMK Maulana Hasanuddin - Sekolah Berbasis Pesantren Industri | Cileles, Lebak, Banten</title>
    <meta name="description"
        content="SMK Maulana Hasanuddin adalah sekolah kejuruan berbasis pesantren industri di Cileles, Lebak, Banten. Jurusan TKJ, program unggulan desain grafis, beasiswa kuliah, dan lingkungan islami Ahlussunnah Wal Jamaah.">
    <meta name="keywords"
        content="SMK Maulana Hasanuddin, SMK Cileles, SMK Lebak, TKJ Banten, pesantren industri, pendaftaran SMK, sekolah kejuruan islami">
    <meta name="author" content="SMK Maulana Hasanuddin">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url('/')); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url('/')); ?>">
    <meta property="og:title" content="SMK Maulana Hasanuddin - Sekolah Berbasis Pesantren Industri">
    <meta property="og:description"
        content="Sekolah kejuruan terbaik di Lebak Banten yang menggabungkan teknologi dan nilai islami. Daftar sekarang!">
    <meta property="og:image" content="<?php echo e(asset('storage/images/hero3.jpeg')); ?>">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SMK Maulana Hasanuddin">
    <meta name="twitter:description" content="Sekolah kejuruan berbasis pesantren industri di Cileles, Lebak, Banten.">
    <meta name="twitter:image" content="<?php echo e(asset('storage/images/hero3.jpeg')); ?>">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/welcome.css')); ?>">
    <style>

    </style>
</head>

<body>

    <?php echo $__env->make('content.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('content.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- ===== ABOUT SECTION ===== -->
    <section id="about">
        <div class="about__container">

            <!-- 1. MAIN ABOUT -->
            <div class="about__main-grid">

                <div class="about__img-wrapper" data-aos="fade-right" data-aos-duration="800">
                    <img src="<?php echo e(asset('storage/images/hero2.jpeg')); ?>"
                         alt="SMK Maulana Hasanuddin"
                         onerror="this.src='https://images.unsplash.com/photo-1523050853063-8802a6359566?auto=format&fit=crop&q=80'">
                </div>

                <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                    <div class="about__badge">
                        <i class="bi bi-building-fill"></i>
                        Tentang Kami
                    </div>

                    <h2 class="about__heading">
                        SMK Maulana Hasanuddin
                        <span class="about__heading-gradient">Sekolah Berbasis Pesantren Industri</span>
                    </h2>

                    <p class="about__desc">
                        SMK Maulana Hasanuddin hadir sebagai solusi pendidikan masa kini yang menggabungkan kecanggihan
                        <strong style="color:rgba(255,255,255,0.85);">Teknologi Informasi</strong>
                        dengan kekuatan karakter pesantren. Kami mencetak lulusan yang siap kerja, siap kuliah, dan siap berwirausaha.
                    </p>

                    <div class="about__stats">
                        <div class="about__stat-item" data-aos="zoom-in" data-aos-delay="0">
                            <span class="about__stat-number about__stat-number--blue stat-number" data-target="7">0</span>
                            <span class="about__stat-label">Tahun Berpengalaman</span>
                        </div>
                        <div class="about__stat-item" data-aos="zoom-in" data-aos-delay="100">
                            <span class="about__stat-number about__stat-number--green stat-number" data-target="20">0</span>
                            <span class="about__stat-label">Tenaga Pengajar</span>
                        </div>
                        <div class="about__stat-item" data-aos="zoom-in" data-aos-delay="200">
                            <span class="about__stat-number about__stat-number--purple stat-number" data-target="98">0</span>
                            <span class="about__stat-label">Murid Aktif</span>
                        </div>
                        <div class="about__stat-item" data-aos="zoom-in" data-aos-delay="300">
                            <span class="about__stat-number about__stat-number--gold stat-number" data-target="16">0</span>
                            <span class="about__stat-label">Alumni Penerima Beasiswa SMK MH</span>
                        </div>
                    </div>

                    <div class="about__cta">
                        <a href="#profil-program" class="about__btn--primary">
                            <i class="bi bi-lightning-fill"></i> Lihat Program
                        </a>
                        <a href="https://wa.me/6281293201023" class="about__btn--outline" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp"></i> Daftar Sekarang
                        </a>
                    </div>
                </div>

            </div>

            <!-- 2. VISI & MISI -->
            <div id="profil-visi" class="about__vismis-grid">

                <div class="about__vismis-card about__vismis-card--vision"
                     data-aos="fade-right" data-aos-duration="700">
                    <div class="about__vismis-icon about__vismis-icon--vision">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>
                    <h3 class="about__vismis-title">Visi Kami</h3>
                    <p class="about__vismis-text">
                        "Menjadi SMK Termaju dan mitra dunia usaha atau industri serta menghasilkan lulusan unggul
                        berdaya saing nasional dan global yang berlandaskan nilai-nilai keislaman Ahlusunnah Wal Jamaah."
                    </p>
                </div>

                <div class="about__vismis-card about__vismis-card--mission"
                     data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                    <div class="about__vismis-icon about__vismis-icon--mission">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="about__vismis-title">Misi Kami</h3>
                    <ul class="about__mission-list">
                        <li class="about__mission-item">
                            <span class="about__mission-check"><i class="bi bi-check-lg"></i></span>
                            Pendidikan bermutu tinggi, unggul, berbudi luhur, dan berakhlak mulia.
                        </li>
                        <li class="about__mission-item">
                            <span class="about__mission-check"><i class="bi bi-check-lg"></i></span>
                            Mengembangkan keahlian kompetensi agar mampu bersaing di dunia kerja.
                        </li>
                        <li class="about__mission-item">
                            <span class="about__mission-check"><i class="bi bi-check-lg"></i></span>
                            Meningkatkan sarana prasarana untuk proses pembelajaran optimal.
                        </li>
                    </ul>
                </div>

            </div>

            <!-- 3. STRUKTUR ORGANISASI -->
            
            </div>

            <!-- 4. JURUSAN TKJ -->
            <div id="section-jurusan" class="about__tkj" data-aos="fade-up" data-aos-duration="800">
                <div class="about__tkj-grid">

                    <div class="about__tkj-img-col">
                        <img src="<?php echo e(asset('storage/images/logotkj.webp')); ?>" alt="Praktik TKJ">
                        <div class="about__tkj-img-overlay"></div>
                        <div class="about__tkj-img-label">
                            <p>Department of</p>
                            <h4>Information Technology</h4>
                        </div>
                    </div>

                    <div class="about__tkj-content">
                        <span class="about__tkj-badge">Jurusan Utama</span>
                        <h2 class="about__tkj-title">
                            Teknik Komputer<br>&amp; Jaringan <span>(TKJ)</span>
                        </h2>

                        <div class="about__skill-list">
                            <div class="about__skill-item skill--blue"
                                 data-aos="fade-left" data-aos-delay="0" data-aos-duration="500">
                                <div class="about__skill-icon about__skill-icon--blue">
                                    <i class="bi bi-router-fill"></i>
                                </div>
                                <div>
                                    <p class="about__skill-name">Manajemen Jaringan</p>
                                    <p class="about__skill-sub">Instalasi Mikrotik &amp; Cisco Expert</p>
                                </div>
                            </div>
                            <div class="about__skill-item skill--green"
                                 data-aos="fade-left" data-aos-delay="100" data-aos-duration="500">
                                <div class="about__skill-icon about__skill-icon--green">
                                    <i class="bi bi-pc-display-horizontal"></i>
                                </div>
                                <div>
                                    <p class="about__skill-name">Teknisi Komputer</p>
                                    <p class="about__skill-sub">Perakitan &amp; Troubleshooting PC</p>
                                </div>
                            </div>
                            <div class="about__skill-item skill--purple"
                                 data-aos="fade-left" data-aos-delay="200" data-aos-duration="500">
                                <div class="about__skill-icon about__skill-icon--purple">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>
                                <div>
                                    <p class="about__skill-name">Cyber Security</p>
                                    <p class="about__skill-sub">Keamanan Data &amp; Manajemen Server</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- 5. PROGRAM UNGGULAN -->
            <div id="profil-program" class="about__unggulan">

                <div style="text-align:center;" data-aos="fade-up" data-aos-duration="600">
                    <span class="about__section-label">Extra Programs</span>
                    <h2 class="about__section-title">Program <span>Unggulan</span></h2>
                    <div class="about__divider"></div>
                </div>

                <div class="about__unggulan-grid">
                    <div class="about__program-card about__program-card--emerald"
                         data-aos="fade-up" data-aos-delay="0" data-aos-duration="500">
                        <div class="about__program-icon about__program-icon--emerald">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <h4 class="about__program-title">Kajian Kitab Kuning</h4>
                        <p class="about__program-desc">Pendidikan spiritual dan akhlakul karimah melalui kitab klasik pesantren.</p>
                    </div>

                    <div class="about__program-card about__program-card--pink"
                         data-aos="fade-up" data-aos-delay="80" data-aos-duration="500">
                        <div class="about__program-icon about__program-icon--pink">
                            <i class="bi bi-palette-fill"></i>
                        </div>
                        <h4 class="about__program-title">Mahir Desain Grafis</h4>
                        <p class="about__program-desc">Kreativitas visual profesional menggunakan Adobe Photoshop &amp; CorelDraw.</p>
                    </div>

                    <div class="about__program-card about__program-card--blue"
                         data-aos="fade-up" data-aos-delay="160" data-aos-duration="500">
                        <div class="about__program-icon about__program-icon--blue">
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        </div>
                        <h4 class="about__program-title">Mahir MS. Office</h4>
                        <p class="about__program-desc">Penguasaan administrasi perkantoran digital Word, Excel, dan PowerPoint.</p>
                    </div>

                    <div class="about__program-card about__program-card--orange"
                         data-aos="fade-up" data-aos-delay="0" data-aos-duration="500">
                        <div class="about__program-icon about__program-icon--orange">
                            <i class="bi bi-printer-fill"></i>
                        </div>
                        <h4 class="about__program-title">Wirausaha Sablon</h4>
                        <p class="about__program-desc">Praktik produksi Sablon Kaos &amp; ID Card sebagai bekal entrepreneur santri.</p>
                    </div>

                    <div class="about__program-card about__program-card--indigo"
                         data-aos="fade-up" data-aos-delay="80" data-aos-duration="500">
                        <div class="about__program-icon about__program-icon--indigo">
                            <i class="bi bi-cpu-fill"></i>
                        </div>
                        <h4 class="about__program-title">Teknisi Komputer</h4>
                        <p class="about__program-desc">Pemeliharaan hardware dan instalasi infrastruktur jaringan komputer.</p>
                    </div>

                    <div class="about__program-card about__program-card--special"
                         data-aos="fade-up" data-aos-delay="160" data-aos-duration="500">
                        <div class="about__program-decor"></div>
                        <div class="about__program-icon about__program-icon--special">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h4 class="about__program-title">Beasiswa Kuliah S1</h4>
                        <p class="about__program-desc about__program-desc--special">
                            Layanan eksklusif bimbingan dan penyaluran beasiswa kuliah gratis bagi alumni SMK MH.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section id="berita" class="bg-slate-50 py-20">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-sm font-bold text-emerald-700">
                        <i class="bi bi-newspaper"></i>
                        Informasi Sekolah
                    </span>
                    <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">Berita dan Pengumuman Terbaru</h2>
                    <p class="mt-3 max-w-2xl text-slate-600">Update kegiatan santri, informasi SPMB, prestasi, dan agenda penting SMK Maulana Hasanuddin.</p>
                </div>
                <a href="<?php echo e(route('berita.index')); ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 font-bold text-slate-900 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-500 hover:text-emerald-700">
                    Semua Berita
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-xl">
                        <a href="<?php echo e(route('berita.show', $berita->slug)); ?>" class="block">
                            <div class="aspect-[16/10] overflow-hidden bg-slate-200">
                                <img src="<?php echo e($berita->featured_image ? asset('storage/'.$berita->featured_image) : asset('storage/images/hero2.jpeg')); ?>"
                                     alt="<?php echo e($berita->title); ?>"
                                     class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            </div>
                            <div class="p-6">
                                <div class="mb-3 flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">
                                    <span><i class="bi bi-calendar-event me-1"></i><?php echo e($berita->published_at?->format('d M Y') ?? 'Terbaru'); ?></span>
                                    <span><i class="bi bi-eye me-1"></i><?php echo e(number_format($berita->views ?? 0)); ?></span>
                                </div>
                                <h3 class="line-clamp-2 text-xl font-extrabold leading-snug text-slate-950 group-hover:text-emerald-700"><?php echo e($berita->title); ?></h3>
                                <p class="mt-3 line-clamp-3 text-sm leading-7 text-slate-600">
                                    <?php echo e($berita->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($berita->content), 130)); ?>

                                </p>
                                <span class="mt-5 inline-flex items-center gap-2 font-bold text-emerald-700">
                                    Baca Selengkapnya
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-600">
                        Belum ada berita yang dipublikasikan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php echo $__env->make('content.galeri', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('content.kontak', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<?php echo $__env->make('content.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- ===== SCRIPTS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

</body>
</html>
<?php /**PATH C:\SMK-MK\resources\views/welcome.blade.php ENDPATH**/ ?>