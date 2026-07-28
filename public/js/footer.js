 /* ===== FOOTER TAHUN & FADE ===== */
        document.getElementById('footer-year').textContent = new Date().getFullYear();

        const footerCols = document.querySelectorAll('.footer__col');
        const footerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    footerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        footerCols.forEach(col => footerObserver.observe(col));

        /* ===== SCROLL TO TOP ===== */
        const scrollTopBtn = document.getElementById('scrollTopBtn');

        window.addEventListener('scroll', () => {
            scrollTopBtn.classList.toggle('visible', window.scrollY > 300);
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });