<section id="about" class="py-20 bg-gradient-to-b from-white to-gray-50 overflow-hidden">
    <div class="container mx-auto px-4 lg:px-10">

        {{-- 1. MAIN ABOUT SECTION (PROFILE & STATS) --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-20">

            {{-- Kolom Gambar dengan Efek Dekoratif --}}
            <div class="relative group" data-aos="fade-right">
                <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl transform group-hover:scale-[1.01] transition-all duration-500">
                    <img src="{{ asset('storage/images/hero2.jpeg') }}"
                         alt="SMK Maulana Hasanuddin"
                         class="w-full h-auto object-cover"
                         onerror="this.src='https://images.unsplash.com/photo-1523050853063-8802a6359566?auto=format&fit=crop&q=80'">
                </div>


            {{-- Kolom Teks Deskripsi --}}
            <div class="space-y-6" data-aos="fade-left">
                <div>
                    <span class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest">
                        <i class="bi bi-building-fill mr-2"></i>Tentang Kami
                    </span>
                </div>
            </div>



                <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">
                    SMK Maulana Hasanudin
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mt-2">
                        Sekolah Berbasis Pesantren Industri
                    </span>
                </h2>

                <p class="text-gray-600 text-lg leading-relaxed">
                    SMK Maulana Hasanudin hadir sebagai solusi pendidikan masa kini yang menggabungkan kecanggihan <strong>Teknologi Informasi</strong> dengan kekuatan karakter pesantren. Kami mencetak lulusan yang siap kerja, siap kuliah, dan siap berwirausaha.
                </p>

                {{-- Angka Statistik Interaktif --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-8 border-t border-b border-gray-100 mt-8">
                    <div class="text-center">
                        <h3 class="text-3xl font-black text-blue-600 stat-number" data-target="7">7</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mt-1 leading-tight">Tahun<br>Berpengalaman</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl font-black text-green-600 stat-number" data-target="15">15</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mt-1 leading-tight">Tenaga<br>Pengajar</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl font-black text-purple-600 stat-number" data-target="90">90</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mt-1 leading-tight">Murid<br>Aktif</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl font-black text-indigo-600 stat-number" data-target="16">16</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mt-1 leading-tight">Alumni<br>Penerima<br>Bea Siswa Program<br>SMK MH</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="#profil-program" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white rounded-full font-bold shadow-lg hover:bg-blue-700 hover:shadow-blue-200 transition-all active:scale-95">
                        <i class="bi bi-lightning-fill mr-2"></i>Lihat Program
                    </a>
                    <a href="https://wa.me/6281293201023" class="inline-flex items-center justify-center px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-full font-bold hover:bg-blue-600 hover:text-white transition-all active:scale-95">
                        <i class="bi bi-whatsapp mr-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. VISION & MISSION SECTION --}}
        <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto mb-28">
            {{-- Visi --}}
            <div class="bg-gradient-to-br from-blue-600 to-indigo-800 p-10 rounded-[2.5rem] text-white shadow-xl relative overflow-hidden group hover:-translate-y-2 transition-all duration-500">
                <i class="bi bi-eye absolute -bottom-6 -right-6 text-[150px] opacity-10 group-hover:rotate-12 transition-transform duration-700"></i>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="bi bi-lightbulb-fill text-3xl text-yellow-300"></i>
                    </div>
                    <h3 class="text-3xl font-black mb-6 italic tracking-tight">Visi Kami</h3>
                    <p class="text-blue-50 leading-relaxed text-lg font-medium">
                        "Menjadi SMK Termaju dan mitra dunia usaha atau industri serta menghasilkan lulusan unggul berdaya saing nasional dan global yang berlandaskan nilai-nilai keislaman Ahlusunnah Wal Jamaah."
                    </p>
                </div>
            </div>

            {{-- Misi --}}
            <div class="bg-gradient-to-br from-orange-500 to-red-600 p-10 rounded-[2.5rem] text-white shadow-xl group hover:-translate-y-2 transition-all duration-500">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="bi bi-bullseye text-3xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-black mb-6 italic tracking-tight">Misi Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-white/30 p-1 rounded-full"><i class="bi bi-check-lg text-sm"></i></div>
                            <span class="text-orange-50 font-medium">Pendidikan bermutu tinggi, unggul, berbudi luhur, dan berakhlak mulia.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-white/30 p-1 rounded-full"><i class="bi bi-check-lg text-sm"></i></div>
                            <span class="text-orange-50 font-medium">Mengembangkan keahlian kompetensi agar mampu bersaing di dunia kerja.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-white/30 p-1 rounded-full"><i class="bi bi-check-lg text-sm"></i></div>
                            <span class="text-orange-50 font-medium">Meningkatkan sarana prasarana untuk proses pembelajaran optimal.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 3. JURUSAN TKJ SECTION --}}
        <div id="section-jurusan" class="mb-28 scroll-mt-24">
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-2xl border border-gray-100">
                <div class="grid lg:grid-cols-2">
                    {{-- Foto Kolom Kiri --}}
                    <div class="relative min-h-[450px]">
                        <img src="{{ asset('storage/images/logotkj.webp') }}"
                             alt="Praktik TKJ"
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-900/20 to-transparent lg:bg-gradient-to-r"></div>
                        {{-- Label Jurusan --}}
                        <div class="absolute bottom-8 left-8 text-white">
                            <p class="text-xs font-black uppercase tracking-[0.3em] mb-1 opacity-80">Department of</p>
                            <h4 class="text-3xl font-black">Information Technology</h4>
                        </div>
                    </div>

                    {{-- Konten Kolom Kanan --}}
                    <div class="p-10 lg:p-16 flex flex-col justify-center bg-white">
                        <span class="w-fit px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-xs font-black uppercase mb-4 tracking-widest">Utama</span>
                        <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-8 leading-tight">
                            Teknik Komputer <br>& Jaringan <span class="text-blue-600">(TKJ)</span>
                        </h2>

                        {{-- List Keahlian Interaktif --}}
                        <div class="space-y-4">
                            <div class="flex items-center gap-5 p-4 bg-gray-50 rounded-2xl hover:bg-blue-600 hover:text-white transition-all duration-300 group cursor-pointer active:scale-95 border border-transparent hover:border-blue-200">
                                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition-all">
                                    <i class="bi bi-router-fill text-2xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-lg leading-tight">Manajemen Jaringan</h5>
                                    <p class="text-xs text-gray-400 group-hover:text-blue-100">Instalasi Mikrotik & Cisco Expert</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 p-4 bg-gray-50 rounded-2xl hover:bg-green-600 hover:text-white transition-all duration-300 group cursor-pointer active:scale-95 border border-transparent hover:border-green-200">
                                <div class="w-14 h-14 bg-green-100 text-green-600 rounded-xl flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition-all">
                                    <i class="bi bi-pc-display-horizontal text-2xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-lg leading-tight">Teknisi Komputer</h5>
                                    <p class="text-xs text-gray-400 group-hover:text-green-100">Perakitan & Troubleshooting PC</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 p-4 bg-gray-50 rounded-2xl hover:bg-purple-600 hover:text-white transition-all duration-300 group cursor-pointer active:scale-95 border border-transparent hover:border-purple-200">
                                <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition-all">
                                    <i class="bi bi-shield-lock-fill text-2xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-lg leading-tight">Cyber Security</h5>
                                    <p class="text-xs text-gray-400 group-hover:text-purple-100">Keamanan Data & Manajemen Server</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. PROGRAM UNGGULAN SECTION (MULTI-COLOR CARDS) --}}
        <section id="section-unggulan" class="py-16 px-6 md:px-12 bg-slate-100 rounded-[3.5rem] border border-gray-200 shadow-inner scroll-mt-24">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-black tracking-[0.3em] uppercase text-xs">Extra Programs</span>
                <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mt-2">Program <span class="text-blue-600">Unggulan</span></h2>
                <div class="w-24 h-2 bg-yellow-400 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-[6px] border-emerald-500 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                        <i class="bi bi-book-half text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-800 mb-3">Kajian Kitab Kuning</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Pendidikan spiritual dan akhlakul karimah melalui kitab klasik pesantren.</p>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-[6px] border-pink-500 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-600 group-hover:text-white transition-all duration-500">
                        <i class="bi bi-palette-fill text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-800 mb-3">Mahir Desain Grafis</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Kreativitas visual profesional menggunakan Adobe Photoshop & CorelDraw.</p>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-[6px] border-blue-500 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                        <i class="bi bi-file-earmark-spreadsheet-fill text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-800 mb-3">Mahir MS. Office</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Penguasaan administrasi perkantoran digital Word, Excel, dan PowerPoint.</p>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-[6px] border-orange-500 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-600 group-hover:text-white transition-all duration-500">
                        <i class="bi bi-printer-fill text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-800 mb-3">Wirausaha Sablon</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Praktik produksi Sablon Kaos & ID Card sebagai bekal entrepreneur santri.</p>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-[6px] border-indigo-500 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <i class="bi bi-cpu-fill text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-800 mb-3">Teknisi Komputer</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Pemeliharaan hardware dan instalasi infrastruktur jaringan komputer.</p>
                </div>

                <div class="bg-gradient-to-br from-blue-700 to-indigo-900 p-8 rounded-[2.5rem] shadow-xl text-white hover:scale-[1.03] transition-all duration-500 group relative overflow-hidden cursor-pointer">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="bi bi-mortarboard-fill text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-black mb-3 italic">Beasiswa Kuliah S1</h4>
                    <p class="text-blue-100 text-sm leading-relaxed">Layanan eksklusif bimbingan dan penyaluran beasiswa kuliah gratis bagi alumni SMK MH.</p>
                    {{-- Decor --}}
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                </div>

            </div>
        </section>

    </div>
</section>

{{-- SCRIPT PENDUKUNG (PASTIKAN JALAN) --}}
<script>
    // Fungsi Animasi Angka
    function animateStats() {
        const stats = document.querySelectorAll('.stat-number');
        stats.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-target'));
            if (isNaN(target)) return; // Lewati jika bukan angka

            const duration = 2000; // Durasi 2 detik
            const frameRate = 1000 / 60; // 60fps
            const totalFrames = Math.round(duration / frameRate);
            const increment = target / totalFrames;
            let current = 0;
            let frame = 0;

            const updateStat = () => {
                frame++;
                current += increment;

                if (frame < totalFrames) {
                    stat.textContent = Math.floor(current);
                    requestAnimationFrame(updateStat);
                } else {
                    stat.textContent = target + "+";
                }
            };
            updateStat();
        });
    }

    // Trigger otomatis saat halaman selesai dimuat (Backup jika observer gagal)
    window.addEventListener('DOMContentLoaded', () => {
        // Gunakan Intersection Observer agar lebih pro (animasi jalan saat discroll)
        const observerOptions = { threshold: 0.2 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.disconnect(); // Jalankan hanya sekali
                }
            });
        }, observerOptions);

        // Pastikan menargetkan elemen yang ada (section id="about")
        const targetSection = document.getElementById('about');
        if (targetSection) {
            observer.observe(targetSection);
        } else {
            // Jika ID "about" tidak ketemu, langsung jalankan saja
            animateStats();
        }
    });
</script>
