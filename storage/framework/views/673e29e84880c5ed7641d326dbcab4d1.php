
<section id="kontak" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">

        
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                <i class="bi bi-envelope mr-2"></i>Hubungi Kami
            </span>
            <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">Kontak Kami</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut,
                jangan ragu untuk menghubungi kami melalui detail kontak di bawah ini.
            </p>
        </div>

        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">

            
            <div class="contact-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-t-4 border-blue-500 group" data-aos="fade-up" data-aos-delay="0">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <i class="bi bi-telephone-fill text-blue-600 text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-gray-800 mb-2">Telepon</h5>
                <p class="text-sm text-gray-500 mb-3">Senin - Jumat, 08:00 - 16:00</p>
                <a href="tel:+622112345567" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-300">
                    +62 812-9320-1023
                </a>
            </div>

            
            <div class="contact-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-t-4 border-green-500 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <i class="bi bi-envelope-fill text-green-600 text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-gray-800 mb-2">Email</h5>
                <p class="text-sm text-gray-500 mb-3">Kirim pesan kapan saja</p>
                <a href="mailto:info@smkmaulanahasanudin.sch.id" class="text-green-600 font-semibold hover:text-green-700 transition-colors duration-300 break-all text-sm">
                    info@smkmaulanahasanudin.sch.id
                </a>
            </div>

            
            <div class="contact-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-t-4 border-orange-500 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <i class="bi bi-geo-alt-fill text-orange-600 text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-gray-800 mb-2">Alamat</h5>
                <p class="text-sm text-gray-500 mb-3">Kunjungi sekretariat kami</p>
                <p class="text-orange-600 font-semibold text-sm">
                    Kec. Cileles, Kab. Lebak, Banten
                </p>
            </div>

            
            <div class="contact-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-t-4 border-purple-500 group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <i class="bi bi-clock-fill text-purple-600 text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-gray-800 mb-2">Jam Operasional</h5>
                <p class="text-sm text-gray-500 mb-2">Senin - Jumat</p>
                <p class="text-purple-600 font-semibold">08:00 - 16:00 WIB</p>
            </div>
        </div>

        
        <div class="grid lg:grid-cols-5 gap-8">

            
            <div class="lg:col-span-2" data-aos="fade-right">
                <div class="bg-white rounded-3xl shadow-2xl p-8">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                    <form id="contactForm" class="space-y-5" action="<?php echo e(route('messages.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="nama" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-300"
                                   placeholder="Masukkan nama Anda">
                            <p class="text-red-500 text-sm mt-1 hidden error-message">Nama harus diisi</p>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-300"
                                   placeholder="nama@email.com">
                            <p class="text-red-500 text-sm mt-1 hidden error-message">Email valid harus diisi</p>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" name="no_wa" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-300"
                                   placeholder="08xx xxxx xxxx">
                            <p class="text-red-500 text-sm mt-1 hidden error-message">Nomor telepon harus diisi</p>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Pesan</label>
                            <textarea id="message" name="pesan" rows="5" required
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-300 resize-none"
                                      placeholder="Tulis pesan Anda..."></textarea>
                            <p class="text-red-500 text-sm mt-1 hidden error-message">Pesan harus diisi</p>
                        </div>

                        <button type="submit"
                                class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold hover:shadow-lg hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                            <i class="bi bi-send mr-2"></i>
                            <span>Kirim Pesan</span>
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="lg:col-span-3" data-aos="fade-left">
                <div class="space-y-6">
                    <h3 class="text-3xl font-bold text-gray-900">Lokasi Kami</h3>

                    
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-200">
                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-pin-map-fill text-white text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="text-xl font-bold text-gray-900 mb-2">Alamat Lengkap</h5>
                                <p class="text-gray-700 mb-4 leading-relaxed">
                                    Jl. Raya Sampai-Gunung Kencana Kp.Pasir Binglu,<br>
                                    Ds. Cipadang, Kec. Cileles,<br>
                                    Kab. Lebak, Banten
                                </p>
                                <a href="https://maps.app.goo.gl/wSWeFmoJTJt8QL9KA"
                                   target="_blank"
                                   class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 hover:scale-105 transition-all duration-300">
                                    <i class="bi bi-box-arrow-up-right mr-2"></i>Lihat di Google Maps
                                </a>
                            </div>
                        </div>
                    </div>

                    
                    <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                        <iframe
    src="https://www.google.com/maps?q=Desa+Cipadang,+Cileles,+Lebak,+Banten&output=embed"
    width="100%"
    height="450"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    class="w-full">
</iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="follow" class="py-20 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white relative overflow-hidden">
    
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div data-aos="fade-right">
                <h2 class="text-4xl lg:text-5xl font-extrabold mb-4">Ikuti Media Sosial Kami</h2>
                <p class="text-xl text-blue-100 leading-relaxed">
                    Tetap terhubung dengan kami untuk mendapatkan informasi terbaru,
                    kegiatan sekolah, dan pengumuman penting lainnya.
                </p>
            </div>

            <div class="flex flex-wrap gap-4 justify-center lg:justify-end" data-aos="fade-left">
                <a href="https://www.facebook.com/maulana.hasanuddin.5268" target="_blank"
                   class="group w-16 h-16 bg-white text-blue-600 rounded-2xl flex items-center justify-center hover:scale-110 hover:rotate-6 transition-all duration-300 shadow-lg hover:shadow-2xl">
                    <i class="bi bi-facebook text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                </a>



                <a href="https://www.instagram.com/smk.mh?igsh=MWgweWlkdmk2NXUydg==" target="_blank"
                   class="group w-16 h-16 bg-white text-pink-600 rounded-2xl flex items-center justify-center hover:scale-110 hover:rotate-6 transition-all duration-300 shadow-lg hover:shadow-2xl">
                    <i class="bi bi-instagram text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                </a>



                <a href="https://youtube.com/@maulanahasanuddin_psb?si=kp18kgsa7ml1qMBi" target="_blank"
                   class="group w-16 h-16 bg-white text-red-600 rounded-2xl flex items-center justify-center hover:scale-110 hover:rotate-6 transition-all duration-300 shadow-lg hover:shadow-2xl">
                    <i class="bi bi-youtube text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                </a>

                <a href="https://www.tiktok.com/@smk_mh19?_r=1&_t=ZS-93wpH728UWT" target="_blank"
                   class="group w-16 h-16 bg-white text-gray-900 rounded-2xl flex items-center justify-center hover:scale-110 hover:rotate-6 transition-all duration-300 shadow-lg hover:shadow-2xl">
                    <i class="bi bi-tiktok text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if(session('success')): ?>

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "<?php echo e(session('success')); ?>",
        confirmButtonColor: '#16a34a',
        timer: 2500,
        showConfirmButton: false
    });

<?php endif; ?>

    // Initialize AOS if available
    // if (typeof AOS !== 'undefined') {
    //     AOS.init({
    //         duration: 1000,
    //         once: true,
    //         offset: 100
    //     });
    // }
</script>
<?php /**PATH C:\SMK-MK\resources\views/content/kontak.blade.php ENDPATH**/ ?>