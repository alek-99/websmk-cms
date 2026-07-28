    <!-- ===== FOOTER ===== -->
    <footer class="footer" id="footer">

        <div class="footer__blob footer__blob--blue"></div>
        <div class="footer__blob footer__blob--gold"></div>

        <div class="footer__main">

            <!-- Kolom 1: Brand & Social -->
            <div class="footer__col">
                <div class="footer__brand">
                    <img src="<?php echo e(asset('storage/images/Logo Smk MH.png')); ?>"
                         alt="Logo SMK MH" class="footer__logo"
                         onerror="this.style.display='none'">
                    <div>
                        <div class="footer__brand-name">SMK Maulana Hasanuddin</div>
                        <div class="footer__brand-sub">Pesantren Industri</div>
                    </div>
                </div>
                <p class="footer__about-text">
                    Lembaga pendidikan kejuruan berbasis pesantren yang berkomitmen mencetak lulusan
                    unggul, berkarakter Islami, dan siap bersaing di era global.
                </p>
                <p class="footer__social-label">Ikuti Kami</p>
                <div class="footer__social-row">
                    <a href="https://www.facebook.com/maulana.hasanuddin.5268" class="footer__social-btn footer__social-btn--fb" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/smk.mh?igsh=MWgweWlkdmk2NXUydg==" class="footer__social-btn footer__social-btn--ig" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="https://youtube.com/@maulanahasanuddin_psb?si=kp18kgsa7ml1qMBi" class="footer__social-btn footer__social-btn--yt" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.tiktok.com/@smk_mh19?_r=1&_t=ZS-93wpH728UWT" class="footer__social-btn footer__social-btn--tt" target="_blank" rel="noopener" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>

            <!-- Kolom 2: Quick Links -->
            <div class="footer__col">
                <h5 class="footer__col-title">Quick Links</h5>
                <ul class="footer__links">
                    <li><a href="#home"             class="footer__link"><i class="bi bi-chevron-right"></i>Home</a></li>
                    <li><a href="#about"            class="footer__link"><i class="bi bi-chevron-right"></i>Tentang Kami</a></li>
                    <li><a href="#section-jurusan"  class="footer__link"><i class="bi bi-chevron-right"></i>Jurusan TKJ</a></li>
                    <li><a href="#profil-program" class="footer__link"><i class="bi bi-chevron-right"></i>Program Unggulan</a></li>
                    <li><a href="#galeri"            class="footer__link"><i class="bi bi-chevron-right"></i>Galeri</a></li>
                    <li><a href="#berita"            class="footer__link"><i class="bi bi-chevron-right"></i>Berita</a></li>
                    <li><a href="<?php echo e(route('pendaftaran')); ?>" class="footer__link"><i class="bi bi-chevron-right"></i>Pendaftaran PPDB</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Kontak -->
            <div class="footer__col">
                <h5 class="footer__col-title">Kontak Kami</h5>
                <ul class="footer__contact-list">
                    <li class="footer__contact-item">
                        <div class="footer__contact-icon footer__contact-icon--location">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <span class="footer__contact-text">
                            Jl. Raya Sampai-Gunung Kencana,<br>
                            Kec. Cileles, Kab. Lebak, Banten
                        </span>
                    </li>
                    <li class="footer__contact-item">
                        <div class="footer__contact-icon footer__contact-icon--phone">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <a href="https://wa.me/6281293201023" class="footer__contact-text" target="_blank" rel="noopener">
                            +62 812-9320-1023
                        </a>
                    </li>
                    <li class="footer__contact-item">
                        <div class="footer__contact-icon footer__contact-icon--email">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <a href="mailto:info@smkmaulanahasanudin.sch.id" class="footer__contact-text">
                            info@smkmaulanahasanudin.sch.id
                        </a>
                    </li>
                    <li class="footer__contact-item">
                        <div class="footer__contact-icon footer__contact-icon--time">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <span class="footer__contact-text">
                            Senin – Jumat<br>07:00 – 16:00 WIB
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Lokasi -->
            <div class="footer__col">
                <h5 class="footer__col-title">Lokasi Kami</h5>
                <p class="footer__about-text" style="margin-bottom:0;">
                    Temukan kami di Google Maps untuk petunjuk arah terlengkap ke sekolah.
                </p>
                <div class="footer__map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3!2d106.15!3d-6.55!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzMnMDAuMCJTIDEwNsKwMDknMDAuMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi SMK Maulana Hasanuddin">
                    </iframe>
                </div>
                <a href="https://maps.google.com/?q=SMK+Maulana+Hasanuddin+Cileles+Lebak"
                   target="_blank" rel="noopener"
                   class="footer__link"
                   style="margin-top:12px; display:inline-flex;">
                    <i class="bi bi-chevron-right"></i> Buka di Google Maps
                </a>
            </div>

        </div>

        <div class="footer__divider">
            <hr class="footer__divider-line">
        </div>

        <div class="footer__bottom">
            <p class="footer__copyright">
                &copy; <span id="footer-year"></span>
                <span>SMK Maulana Hasanuddin</span>. All rights reserved.
            </p>
        </div>

    </footer>

    <!-- Scroll to Top -->
    <button class="scroll-top-btn" id="scrollTopBtn" aria-label="Kembali ke atas">
        <i class="bi bi-arrow-up"></i>
    </button>
<?php /**PATH D:\SMK-MK\resources\views/content/footer.blade.php ENDPATH**/ ?>