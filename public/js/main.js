// Main JavaScript File for SMK Maulana Hasanudin Website
// Modern, Interactive, and Powerful Features

// ============================================================================
// SMOOTH SCROLL BEHAVIOR
// ============================================================================
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize smooth scroll
    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                
                // Ignore if it's just # or empty
                if (href === '#' || href.length <= 1) return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    const navbar = document.getElementById('navbar');
                    const navbarHeight = navbar ? navbar.offsetHeight : 0;
                    const targetPosition = target.offsetTop - navbarHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    };

    // ============================================================================
    // NAVBAR ACTIVE STATE & SCROLL EFFECTS
    // ============================================================================
    const handleNavbarScroll = () => {
        const navbar = document.getElementById('navbar');
        const sections = document.querySelectorAll('section[id], header[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;
            
            // Add shadow on scroll
            if (scrollY > 50) {
                navbar?.classList.add('shadow-xl');
            } else {
                navbar?.classList.remove('shadow-xl');
            }
            
            // Update active nav link
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                const sectionHeight = section.offsetHeight;
                
                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('text-blue-600');
                const href = link.getAttribute('href');
                if (href === `#${current}`) {
                    link.classList.add('text-blue-600');
                }
            });
        });
    };

    // ============================================================================
    // INTERSECTION OBSERVER FOR ANIMATIONS
    // ============================================================================
    const observeElements = () => {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);

        // Observe all elements with data-aos attribute
        document.querySelectorAll('[data-aos]').forEach(el => {
            el.style.opacity = '0';
            observer.observe(el);
        });
    };

    // ============================================================================
    // PARALLAX EFFECT
    // ============================================================================
    const initParallax = () => {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('[data-parallax]');
            
            parallaxElements.forEach(el => {
                const speed = el.dataset.parallax || 0.5;
                el.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
    };

    // ============================================================================
    // IMAGE LAZY LOADING
    // ============================================================================
    const lazyLoadImages = () => {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    };

    // ============================================================================
    // PRELOADER
    // ============================================================================
    const handlePreloader = () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            window.addEventListener('load', () => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 300);
            });
        }
    };

    // ============================================================================
    // TYPING EFFECT
    // ============================================================================
    const typingEffect = (element, texts, speed = 100) => {
        if (!element) return;
        
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        const type = () => {
            const currentText = texts[textIndex];
            
            if (isDeleting) {
                element.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
            } else {
                element.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
            }
            
            let typeSpeed = isDeleting ? speed / 2 : speed;
            
            if (!isDeleting && charIndex === currentText.length) {
                typeSpeed = 2000;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                typeSpeed = 500;
            }
            
            setTimeout(type, typeSpeed);
        };
        
        type();
    };

    // ============================================================================
    // COUNT UP ANIMATION
    // ============================================================================
    const countUpAnimation = (element, target, duration = 2000) => {
        if (!element) return;
        
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;
        
        const updateCount = () => {
            current += increment;
            if (current < target) {
                element.textContent = Math.floor(current);
                requestAnimationFrame(updateCount);
            } else {
                element.textContent = target;
            }
        };
        
        updateCount();
    };

    // ============================================================================
    // FORM VALIDATION ENHANCEMENT
    // ============================================================================
    const enhanceFormValidation = () => {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Real-time validation
                input.addEventListener('blur', () => {
                    validateInput(input);
                });
                
                input.addEventListener('input', () => {
                    if (input.classList.contains('border-red-500')) {
                        validateInput(input);
                    }
                });
            });
            
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                
                let isValid = true;
                inputs.forEach(input => {
                    if (!validateInput(input)) {
                        isValid = false;
                    }
                });
                
                if (isValid) {
                    // Handle form submission
                    console.log('Form is valid, submitting...');
                    // You can add AJAX submission here
                }
            });
        });
    };

    const validateInput = (input) => {
        const value = input.value.trim();
        const type = input.type;
        const required = input.hasAttribute('required');
        
        let isValid = true;
        
        if (required && !value) {
            isValid = false;
        } else if (type === 'email' && value && !isValidEmail(value)) {
            isValid = false;
        } else if (type === 'tel' && value && !isValidPhone(value)) {
            isValid = false;
        }
        
        if (!isValid) {
            input.classList.add('border-red-500', 'border-2');
            input.classList.remove('border-green-500');
        } else if (value) {
            input.classList.add('border-green-500', 'border-2');
            input.classList.remove('border-red-500');
        } else {
            input.classList.remove('border-red-500', 'border-green-500');
        }
        
        return isValid;
    };

    const isValidEmail = (email) => {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    };

    const isValidPhone = (phone) => {
        return /^[0-9\s\-\+\(\)]+$/.test(phone);
    };

    // ============================================================================
    // CURSOR TRAIL EFFECT (Optional - can be enabled)
    // ============================================================================
    const cursorTrail = () => {
        const canvas = document.createElement('canvas');
        canvas.style.position = 'fixed';
        canvas.style.top = '0';
        canvas.style.left = '0';
        canvas.style.pointerEvents = 'none';
        canvas.style.zIndex = '9999';
        document.body.appendChild(canvas);
        
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const particles = [];
        
        window.addEventListener('mousemove', (e) => {
            particles.push({
                x: e.clientX,
                y: e.clientY,
                size: Math.random() * 3 + 1,
                speedX: Math.random() * 2 - 1,
                speedY: Math.random() * 2 - 1,
                life: 1
            });
        });
        
        const animate = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            particles.forEach((particle, index) => {
                particle.life -= 0.02;
                particle.x += particle.speedX;
                particle.y += particle.speedY;
                
                ctx.fillStyle = `rgba(59, 130, 246, ${particle.life})`;
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                ctx.fill();
                
                if (particle.life <= 0) {
                    particles.splice(index, 1);
                }
            });
            
            requestAnimationFrame(animate);
        };
        
        animate();
        
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    };

    // ============================================================================
    // INITIALIZE ALL FEATURES
    // ============================================================================
    initSmoothScroll();
    handleNavbarScroll();
    observeElements();
    initParallax();
    lazyLoadImages();
    handlePreloader();
    enhanceFormValidation();
    
    // Optional: Uncomment to enable cursor trail
    // cursorTrail();

    // ============================================================================
    // UTILITY FUNCTIONS
    // ============================================================================
    
    // Debounce function
    const debounce = (func, wait) => {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    };

    // Throttle function
    const throttle = (func, limit) => {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    };

    // ============================================================================
    // PERFORMANCE MONITORING
    // ============================================================================
    console.log('%c🚀 SMK Maulana Hasanudin Website Loaded Successfully!', 
                'color: #3b82f6; font-size: 16px; font-weight: bold;');
    console.log('%c✨ Developed with Tailwind CSS & Modern JavaScript', 
                'color: #10b981; font-size: 12px;');
});

// ============================================================================
// EXPORT UTILITIES (if using modules)
// ============================================================================
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        debounce,
        throttle,
        isValidEmail,
        isValidPhone
    };
}