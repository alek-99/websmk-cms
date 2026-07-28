<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo $__env->yieldContent('title', config('app.name', 'SMK Maulana Hasanudin')); ?></title>

    
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Website resmi SMK Maulana Hasanudin sebagai pusat informasi kegiatan sekolah'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'smk, sekolah kejuruan, berita, pendidikan, maulana hasanudin'); ?>">
    <meta name="author" content="<?php echo e(config('app.name', 'SMK Maulana Hasanudin')); ?>">
    
    
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', config('app.name')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', 'Website resmi SMK Maulana Hasanudin'); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('storage/images/logo.png')); ?>">
    <meta property="og:type" content="website">

    
    <link rel="icon" type="image/png" href="<?php echo e(asset('storage/images/logo.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('storage/images/logo.png')); ?>">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    
<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            overflow-x: hidden;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            font-weight: 500;
            position: relative;
            transition: var(--transition);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }

        /* Floating Button Styles */
        .floating-btn {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            z-index: 999;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .floating-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        #scrollToTop {
            transition: var(--transition), opacity 0.3s, visibility 0.3s;
        }

        /* Footer Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-animate {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Footer css */
        .hover-primary:hover {
        color: var(--primary-color) !important;
        padding-left: 5px;
        transition: var(--transition);
    }

    .social-icon {
        transition: var(--transition);
    }

    .social-icon:hover {
        transform: translateY(-3px);
        color: var(--primary-color) !important;
    }

    /* floatin button */
       @media (max-width: 768px) {
        .floating-btn {
            width: 50px;
            height: 50px;
            font-size: 24px;
        }
        
    }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo $__env->yieldPushContent('meta_tags'); ?>
</head>
<body>

    
   
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" id="mainNavbar">
    <div class="container">

        
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo e(route('welcome')); ?>">
            <img src="<?php echo e(asset('storage/images/logo.png')); ?>" 
                 width="40" 
                 height="40"
                 alt="<?php echo e(config('app.name')); ?> Logo"
                 loading="lazy">
            <span class="d-none d-md-inline">SMK MH CILELES</span>
            <span class="d-md-none">SMK MH</span>
        </a>    
    </div>
</nav>

    
    <main id="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
 
<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4">

            
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="<?php echo e(asset('storage/images/logo.png')); ?>" 
                         width="50" 
                         height="50"
                         alt="<?php echo e(config('app.name')); ?> Logo"
                         loading="lazy">
                    <h5 class="fw-bold mb-0">SMK MAULANA HASANUDIN</h5>
                </div>
                
                <p class="text-secondary mb-3">
                    Website resmi SMK Maulana Hasanudin sebagai pusat informasi
                    kegiatan sekolah, berita terbaru, dan pengumuman penting.
                </p>

                
                <div class="text-secondary small">
                    <div class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>Cileles, Indonesia</span>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:+6281292361172" class="text-secondary text-decoration-none">
                            +62 812-9236-1172
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-2 col-md-6 animate-on-scroll">
                <h5 class="fw-bold mb-3">Menu</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="<?php echo e(route('welcome')); ?>" class="text-secondary text-decoration-none hover-primary">
                            <i class="fas fa-chevron-right me-2 small"></i>Beranda
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="<?php echo e(route('berita.index')); ?>" class="text-secondary text-decoration-none hover-primary">
                            <i class="fas fa-chevron-right me-2 small"></i>Berita
                        </a>
                    </li>
                    <?php echo $__env->yieldPushContent('footer-links'); ?>
                </ul>
            </div>

            
            <div class="col-lg-2 col-md-6 animate-on-scroll">
                <h5 class="fw-bold mb-3">Informasi</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none hover-primary">
                            <i class="fas fa-chevron-right me-2 small"></i>Tentang Kami
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none hover-primary">
                            <i class="fas fa-chevron-right me-2 small"></i>Kontak
                        </a>
                    </li>
                </ul>
            </div>

            
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <h5 class="fw-bold mb-3">Ikuti Kami</h5>

                <div class="d-flex gap-3 mb-3">
                    <a href="https://www.facebook.com/maulana.hasanuddin.5268" 
                       class="text-light fs-4 social-icon"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a href="https://www.instagram.com/smk.mh?igsh=MWgweWlkdmk2NXUydg==" 
                       class="text-light fs-4 social-icon"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://youtube.com/@maulanahasanuddin_psb?si=kp18kgsa7ml1qMBi" 
                       class="text-light fs-4 social-icon"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a href="https://www.tiktok.com/@smk_mh19?_r=1&_t=ZS-93wpH728UWT" 
                       class="text-light fs-4 social-icon"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>

                <p class="text-secondary small mb-0">
                    Hubungi kami melalui media sosial untuk informasi lebih lanjut.
                </p>
            </div>

        </div>

        
        <hr class="border-secondary my-4">

        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <p class="text-secondary mb-0 small">
                    &copy; <span id="currentYear"></span> SMK Maulana Hasanudin. All rights reserved.
                </p>
            </div>
            
        </div>
    </div>
</footer>


    

    
  


<a href="https://wa.me/6281292361172"
   target="_blank"
   rel="noopener noreferrer"
   class="floating-btn btn btn-success rounded-circle shadow position-fixed bottom-0 end-0 left-0 m-4"
   
   aria-label="Contact via WhatsApp"
   title="Chat WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>


<button id="scrollToTop"
        class="floating-btn btn btn-primary rounded-circle shadow position-fixed bottom-0 end-0 m-4 opacity-0 invisible"
        aria-label="Scroll to top"
        title="Kembali ke atas">
    <i class="bi bi-arrow-up"></i>
</button>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    
    <script>
        // Utility Functions
        const AppUtils = {
            // Current Year
            setCurrentYear() {
                const yearElement = document.getElementById('currentYear');
                if (yearElement) {
                    yearElement.textContent = new Date().getFullYear();
                }
            },

            // Scroll to Top
            initScrollToTop() {
                const scrollBtn = document.getElementById('scrollToTop');
                if (!scrollBtn) return;

                window.addEventListener('scroll', () => {
                    if (window.pageYOffset > 300) {
                        scrollBtn.classList.remove('opacity-0', 'invisible');
                        scrollBtn.classList.add('opacity-100', 'visible');
                    } else {
                        scrollBtn.classList.add('opacity-0', 'invisible');
                        scrollBtn.classList.remove('opacity-100', 'visible');
                    }
                });

                scrollBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            },

            // Active Navigation
            setActiveNav() {
                const currentPath = window.location.pathname;
                document.querySelectorAll('.nav-link').forEach(link => {
                    if (link.getAttribute('href') === currentPath) {
                        link.classList.add('active');
                    }
                });
            },

            // Footer Animation
            animateFooter() {
                const footerObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('footer-animate');
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('footer .animate-on-scroll').forEach(el => {
                    footerObserver.observe(el);
                });
            },

            // Initialize all
            init() {
                this.setCurrentYear();
                this.initScrollToTop();
                this.setActiveNav();
                this.animateFooter();
            }
        };

        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', () => {
            AppUtils.init();
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH C:\SMK-MK\resources\views/layouts/berita.blade.php ENDPATH**/ ?>