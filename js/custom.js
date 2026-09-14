(() => {
    'use strict';

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    function initHeader() {
        const headers = [...document.querySelectorAll('.site-navigation, .trans-navigation')];
        if (!headers.length) return;

        let previousState;
        let scheduled = false;
        const update = () => {
            const scrolled = window.scrollY > 70;
            if (scrolled !== previousState) {
                headers.forEach((header) => header.classList.toggle('header-white', scrolled));
                previousState = scrolled;
            }
            scheduled = false;
        };
        const measure = () => {
            const height = Math.max(
                ...headers.map((header) => header.getBoundingClientRect().height),
            );
            document.documentElement.style.setProperty(
                '--header-offset',
                `${Math.ceil(height) + 16}px`,
            );
        };

        update();
        measure();
        window.addEventListener(
            'scroll',
            () => {
                if (!scheduled) {
                    scheduled = true;
                    window.requestAnimationFrame(update);
                }
            },
            { passive: true },
        );
        window.addEventListener('pageshow', update);
        if ('ResizeObserver' in window) {
            const observer = new ResizeObserver(measure);
            headers.forEach((header) => observer.observe(header));
        } else {
            window.addEventListener('resize', measure, { passive: true });
        }
    }

    function initCounters() {
        const counters = document.querySelectorAll('.counter');
        if (!counters.length || reducedMotion.matches || !('IntersectionObserver' in window))
            return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    observer.unobserve(entry.target);
                    if (reducedMotion.matches) return;

                    const counter = entry.target;
                    const original = counter.textContent.trim();
                    const normalized = original.replace(/\s/g, '');
                    if (!/^\d+(?:\.\d+)?$/.test(normalized)) return;
                    const target = Number(normalized);
                    if (!Number.isFinite(target)) return;
                    const precision = normalized.split('.')[1]?.length || 0;

                    // Screen readers receive the final value, not every animation frame.
                    const visual = document.createElement('span');
                    visual.setAttribute('aria-hidden', 'true');
                    visual.textContent = '0';
                    const accessible = document.createElement('span');
                    accessible.className = 'visually-hidden';
                    accessible.textContent = original;
                    counter.replaceChildren(visual, accessible);

                    let start;
                    const tick = (timestamp) => {
                        start ??= timestamp;
                        const progress = Math.min((timestamp - start) / 1000, 1);
                        if (progress === 1 || reducedMotion.matches) {
                            counter.textContent = original;
                            return;
                        }
                        const eased = 1 - Math.pow(1 - progress, 3);
                        visual.textContent = (target * eased).toFixed(precision);
                        window.requestAnimationFrame(tick);
                    };
                    window.requestAnimationFrame(tick);
                });
            },
            { threshold: 0.15 },
        );
        counters.forEach((counter) => observer.observe(counter));
    }

    function initNavigation() {
        if (!window.bootstrap) return;

        document.querySelectorAll('.navbar-collapse').forEach((menu) => {
            const toggler = menu.closest('.navbar')?.querySelector('.navbar-toggler');
            if (!toggler) return;

            const mobileMenuVisible = () => window.getComputedStyle(toggler).display !== 'none';
            const close = () =>
                window.bootstrap.Collapse.getOrCreateInstance(menu, { toggle: false }).hide();

            menu.addEventListener('click', (event) => {
                if (!(event.target instanceof Element)) return;
                const link = event.target.closest('a');
                if (!link || link.matches('[data-bs-toggle="dropdown"]') || !mobileMenuVisible())
                    return;

                menu.querySelectorAll('[data-bs-toggle="dropdown"]').forEach((toggle) => {
                    window.bootstrap.Dropdown.getInstance(toggle)?.hide();
                });
                close();
            });
            menu.addEventListener('keydown', (event) => {
                if (
                    event.key !== 'Escape' ||
                    !menu.classList.contains('show') ||
                    menu.querySelector('.dropdown-menu.show') ||
                    !mobileMenuVisible()
                )
                    return;
                close();
                toggler.focus();
            });
        });
    }

    function initCarousels() {
        if (!window.bootstrap) return;
        document.querySelectorAll('.carousel').forEach((carousel) => {
            window.bootstrap.Carousel.getOrCreateInstance(carousel, {
                interval: 8000,
                ride: 'carousel',
            });
        });
    }

    function initStaticForms() {
        document.querySelectorAll('[data-static-form]').forEach((form) => {
            form.addEventListener('submit', (event) => event.preventDefault());
        });
    }

    function initBlogSearch() {
        const blog = document.querySelector('[data-blog-index]');
        const input = document.querySelector('[data-blog-search]');
        const status = document.querySelector('[data-blog-search-status]');
        if (!blog || !input || !status) return;

        const query = new URLSearchParams(window.location.search).get('q')?.trim() || '';
        if (!query) return;

        input.value = query;
        const normalizedQuery = query.toLocaleLowerCase('ru');
        let matches = 0;

        blog.querySelectorAll('.blog-post').forEach((post) => {
            const item = post.closest('.col-lg-6, .col-lg-12');
            if (!item) return;

            const visible = post.textContent.toLocaleLowerCase('ru').includes(normalizedQuery);
            item.hidden = !visible;
            if (visible) matches += 1;
        });

        status.hidden = false;
        status.textContent = matches
            ? `Найдено статей: ${matches}`
            : `По запросу «${query}» ничего не найдено`;
    }

    function init() {
        initHeader();
        initCounters();
        initNavigation();
        initCarousels();
        initStaticForms();
        initBlogSearch();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init, { once: true });
    } else {
        init();
    }
})();
