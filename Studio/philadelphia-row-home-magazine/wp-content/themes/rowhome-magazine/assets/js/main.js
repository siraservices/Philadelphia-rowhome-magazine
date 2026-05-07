/**
 * RowHome Magazine - Main JavaScript
 * 
 * @package RowHome_Magazine
 * @since 1.0.0
 */

(function($) {
    'use strict';

    /**
     * Hero Carousel Functionality
     */
    function initCarousel() {
        const carousel = document.getElementById('heroCarousel');
        if (!carousel) return;

        const slides = carousel.querySelectorAll('.carousel-slide');
        const dots = carousel.querySelectorAll('.carousel-dot');
        let currentSlide = 0;
        let autoplayInterval;

        // Show specific slide
        function showSlide(index) {
            // Remove active class from all slides and dots
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Add active class to current slide and dot
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            currentSlide = index;
        }

        // Next slide
        function nextSlide() {
            let next = currentSlide + 1;
            if (next >= slides.length) {
                next = 0;
            }
            showSlide(next);
        }

        // Previous slide
        function prevSlide() {
            let prev = currentSlide - 1;
            if (prev < 0) {
                prev = slides.length - 1;
            }
            showSlide(prev);
        }

        // Start autoplay
        function startAutoplay() {
            autoplayInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
        }

        // Stop autoplay
        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        // Dot click handlers
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
                stopAutoplay();
                startAutoplay(); // Restart autoplay after manual interaction
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                prevSlide();
                stopAutoplay();
                startAutoplay();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                stopAutoplay();
                startAutoplay();
            }
        });

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                nextSlide();
                stopAutoplay();
                startAutoplay();
            }
            if (touchEndX > touchStartX + 50) {
                prevSlide();
                stopAutoplay();
                startAutoplay();
            }
        }

        // Pause autoplay on hover
        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);

        // Start the carousel
        startAutoplay();
    }

    /**
     * Search Overlay Functionality
     */
    function initSearch() {
        const searchToggle = document.getElementById('search-toggle');
        const searchOverlay = document.getElementById('search-overlay');
        const searchClose = document.getElementById('search-close');
        const searchField = searchOverlay ? searchOverlay.querySelector('.search-field') : null;

        if (searchToggle && searchOverlay) {
            // Open search overlay
            searchToggle.addEventListener('click', () => {
                searchOverlay.style.display = 'flex';
                setTimeout(() => {
                    if (searchField) searchField.focus();
                }, 100);
            });

            // Close search overlay
            if (searchClose) {
                searchClose.addEventListener('click', () => {
                    searchOverlay.style.display = 'none';
                });
            }

            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && searchOverlay.style.display === 'flex') {
                    searchOverlay.style.display = 'none';
                }
            });

            // Close on overlay click (not content)
            searchOverlay.addEventListener('click', (e) => {
                if (e.target === searchOverlay) {
                    searchOverlay.style.display = 'none';
                }
            });
        }
    }

    /**
     * Newsletter Form Submission
     */
    function initNewsletter() {
        const form = document.getElementById('newsletterForm');
        const messageDiv = document.getElementById('newsletterMessage');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                formData.append('action', 'newsletter_subscribe');
                formData.append('nonce', rowhomeAjax.nonce);

                // Show loading state
                const submitBtn = form.querySelector('.footer-newsletter-submit');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Subscribing...';
                submitBtn.disabled = true;

                // Send AJAX request
                fetch(rowhomeAjax.ajaxurl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    messageDiv.style.display = 'block';
                    
                    if (data.success) {
                        messageDiv.style.color = '#28a745';
                        messageDiv.textContent = data.data.message;
                        form.reset();
                    } else {
                        messageDiv.style.color = '#dc3545';
                        messageDiv.textContent = data.data.message;
                    }

                    // Reset button
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;

                    // Hide message after 5 seconds
                    setTimeout(() => {
                        messageDiv.style.display = 'none';
                    }, 5000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    messageDiv.style.display = 'block';
                    messageDiv.style.color = '#dc3545';
                    messageDiv.textContent = 'An error occurred. Please try again.';
                    
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                });
            });
        }
    }

    /**
     * Sticky Header on Scroll
     */
    function initStickyHeader() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.2)';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }

            lastScroll = currentScroll;
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '#0') return;

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerOffset = 100;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Lazy Load Images Enhancement
     */
    function initLazyLoad() {
        if ('loading' in HTMLImageElement.prototype) {
            // Browser supports native lazy loading
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        } else {
            // Fallback for browsers that don't support lazy loading
            const images = document.querySelectorAll('img[loading="lazy"]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                        }
                        img.removeAttribute('loading');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }
    }

    /**
     * Department Navigation Dropdown Functionality
     */
    function initDepartmentNav() {
        const menuItems = document.querySelectorAll('.department-menu .menu-item.has-dropdown');
        if (!menuItems.length) return;

        // Handle mobile touch events
        if ('ontouchstart' in window) {
            menuItems.forEach(item => {
                const link = item.querySelector('a');
                const dropdown = item.querySelector('.dropdown-menu');
                
                if (!dropdown) return;

                let isOpen = false;

                link.addEventListener('click', (e) => {
                    // On mobile, first click opens dropdown, second click follows link
                    if (!isOpen) {
                        e.preventDefault();
                        
                        // Close other dropdowns
                        menuItems.forEach(otherItem => {
                            if (otherItem !== item) {
                                otherItem.classList.remove('dropdown-open');
                            }
                        });
                        
                        item.classList.add('dropdown-open');
                        isOpen = true;
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.menu-item.has-dropdown')) {
                    menuItems.forEach(item => {
                        item.classList.remove('dropdown-open');
                    });
                }
            });
        }

        // Desktop: Close dropdown when mouse leaves
        menuItems.forEach(item => {
            item.addEventListener('mouseleave', () => {
                item.classList.remove('dropdown-open');
            });
        });

        // Position dropdowns below the header
        function positionDropdowns() {
            const header = document.querySelector('.site-header');
            if (header) {
                const headerBottom = header.getBoundingClientRect().bottom + window.scrollY;
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                dropdowns.forEach(dropdown => {
                    dropdown.style.top = headerBottom + 'px';
                });
            }
        }

        // Set initial position and update on resize
        positionDropdowns();
        window.addEventListener('resize', positionDropdowns);
        window.addEventListener('scroll', positionDropdowns);
    }

    /**
     * Article Card Animations
     */
    function initArticleCards() {
        const cards = document.querySelectorAll('.article-card');
        
        if ('IntersectionObserver' in window) {
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        cardObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                cardObserver.observe(card);
            });
        }
    }

    /**
     * Load More Posts (if needed)
     */
    function initLoadMore() {
        const loadMoreBtn = document.getElementById('loadMorePosts');
        if (!loadMoreBtn) return;

        let page = 2;
        const department = loadMoreBtn.dataset.department || '';

        loadMoreBtn.addEventListener('click', function() {
            const btn = this;
            btn.textContent = 'Loading...';
            btn.disabled = true;

            const formData = new FormData();
            formData.append('action', 'load_more_posts');
            formData.append('nonce', rowhomeAjax.nonce);
            formData.append('page', page);
            formData.append('department', department);

            fetch(rowhomeAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const container = document.querySelector('.article-grid');
                    container.insertAdjacentHTML('beforeend', data.data.html);
                    page++;

                    if (page > data.data.max_pages) {
                        btn.style.display = 'none';
                    } else {
                        btn.textContent = 'Load More';
                        btn.disabled = false;
                    }

                    // Reinitialize animations for new cards
                    initArticleCards();
                } else {
                    btn.textContent = 'No More Posts';
                    btn.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.textContent = 'Error Loading';
                btn.disabled = true;
            });
        });
    }

    /**
     * Initialize All Functions on Document Ready
     */
    /**
     * Mobile Hamburger Menu
     */
    function initMobileMenu() {
        const toggle = document.getElementById('menu-toggle');
        const nav = document.getElementById('mobile-nav');
        if (!toggle || !nav) return;

        toggle.addEventListener('click', function() {
            const isOpen = nav.classList.toggle('mobile-nav-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!nav.contains(e.target) && e.target !== toggle && !toggle.contains(e.target)) {
                nav.classList.remove('mobile-nav-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /**
     * User Avatar Dropdown Toggle
     */
    function initUserMenu() {
        var btn = document.querySelector('.user-avatar-btn');
        var dropdown = document.getElementById('user-dropdown');
        if (!btn || !dropdown) return;

        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = dropdown.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target) && e.target !== btn && !btn.contains(e.target)) {
                dropdown.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
            }
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && dropdown.classList.contains('is-open')) {
                dropdown.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
                btn.focus();
            }
        });
    }

    function init() {
        initCarousel();
        initSearch();
        initNewsletter();
        initStickyHeader();
        initSmoothScroll();
        initLazyLoad();
        initDepartmentNav();
        initArticleCards();
        initLoadMore();
        initMobileMenu();
        initUserMenu();

        // Theme initialized
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})(jQuery);

