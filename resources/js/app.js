// import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    window.AOS?.init({
        duration: 700,
        once: true,
        offset: 80,
    });

    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const dropdowns = document.querySelectorAll('.site-dropdown');

    navToggle?.addEventListener('click', () => {
        const isOpen = navMenu?.classList.toggle('nav--open') ?? false;
        navToggle.setAttribute('aria-expanded', String(isOpen));
    });

    dropdowns.forEach((dropdown) => {
        const toggle = dropdown.querySelector('.site-dropdown__toggle');

        toggle?.addEventListener('click', (event) => {
            event.stopPropagation();

            dropdowns.forEach((item) => {
                if (item !== dropdown) {
                    item.classList.remove('is-open');
                    item.querySelector('.site-dropdown__toggle')?.setAttribute('aria-expanded', 'false');
                }
            });

            const isOpen = dropdown.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', String(isOpen));
        });
    });

    document.addEventListener('click', () => {
        dropdowns.forEach((dropdown) => {
            dropdown.classList.remove('is-open');
            dropdown.querySelector('.site-dropdown__toggle')?.setAttribute('aria-expanded', 'false');
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const targetId = link.getAttribute('href');
            if (!targetId || targetId === '#') return;

            const target = document.querySelector(targetId);
            if (!target) return;

            event.preventDefault();

            const headerHeight = document.getElementById('site-header')?.offsetHeight ?? 0;
            const targetTop = target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;

            window.scrollTo({
                top: Math.max(targetTop, 0),
                behavior: 'smooth',
            });

            window.history.pushState(null, '', targetId);
            navMenu?.classList.remove('nav--open');
            navToggle?.setAttribute('aria-expanded', 'false');
        });
    });

    const slider = document.querySelector('[data-luxury-slider]');
    const slides = Array.from(document.querySelectorAll('.luxury-slide'));
    const dots = Array.from(document.querySelectorAll('[data-slide-dot]'));
    const prevButton = document.querySelector('[data-slide-prev]');
    const nextButton = document.querySelector('[data-slide-next]');
    let activeSlide = 0;
    let slideTimer;

    const showSlide = (index) => {
        if (!slider || slides.length === 0) return;

        activeSlide = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            slide.classList.toggle('is-active', slideIndex === activeSlide);
        });

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('is-active', dotIndex === activeSlide);
        });
    };

    const restartSlider = () => {
        window.clearInterval(slideTimer);
        slideTimer = window.setInterval(() => showSlide(activeSlide + 1), 5500);
    };

    if (slider && slides.length > 1) {
        prevButton?.addEventListener('click', () => {
            showSlide(activeSlide - 1);
            restartSlider();
        });

        nextButton?.addEventListener('click', () => {
            showSlide(activeSlide + 1);
            restartSlider();
        });

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                showSlide(Number(dot.getAttribute('data-slide-dot')));
                restartSlider();
            });
        });

        restartSlider();
    }
});
