/**
 * RowHome Magazine - Gallery Lightbox
 * Lightweight vanilla JS lightbox for the gallery/pictorial template
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

(function() {
    'use strict';

    var lightbox = null;
    var images = [];
    var currentIndex = 0;

    function init() {
        var galleryItems = document.querySelectorAll('.gallery-grid__item');
        if (!galleryItems.length) return;

        // Collect image data
        galleryItems.forEach(function(item, index) {
            var img = item.querySelector('img');
            if (!img) return;

            images.push({
                src: img.dataset.full || img.src,
                caption: img.alt || '',
                element: item
            });

            item.addEventListener('click', function() {
                openLightbox(index);
            });
        });

        if (images.length) {
            createLightbox();
            bindEvents();
        }
    }

    function createLightbox() {
        lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.setAttribute('role', 'dialog');
        lightbox.setAttribute('aria-label', 'Image lightbox');
        lightbox.innerHTML =
            '<button class="lightbox__close" aria-label="Close lightbox">&times;</button>' +
            '<button class="lightbox__nav lightbox__nav--prev" aria-label="Previous image">&#8249;</button>' +
            '<button class="lightbox__nav lightbox__nav--next" aria-label="Next image">&#8250;</button>' +
            '<div class="lightbox__image-container">' +
                '<img class="lightbox__image" src="" alt="" />' +
            '</div>' +
            '<div class="lightbox__info">' +
                '<div class="lightbox__counter"></div>' +
                '<div class="lightbox__caption-text"></div>' +
            '</div>';

        document.body.appendChild(lightbox);
    }

    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Focus trap
        lightbox.querySelector('.lightbox__close').focus();
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';

        // Return focus to the gallery item
        if (images[currentIndex] && images[currentIndex].element) {
            images[currentIndex].element.focus();
        }
    }

    function updateLightbox() {
        var data = images[currentIndex];
        if (!data) return;

        var img = lightbox.querySelector('.lightbox__image');
        var counter = lightbox.querySelector('.lightbox__counter');
        var caption = lightbox.querySelector('.lightbox__caption-text');

        img.src = data.src;
        img.alt = data.caption;
        counter.textContent = 'Photo ' + (currentIndex + 1) + ' of ' + images.length;
        caption.textContent = data.caption;
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        updateLightbox();
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateLightbox();
    }

    function bindEvents() {
        // Close button
        lightbox.querySelector('.lightbox__close').addEventListener('click', closeLightbox);

        // Navigation
        lightbox.querySelector('.lightbox__nav--next').addEventListener('click', nextImage);
        lightbox.querySelector('.lightbox__nav--prev').addEventListener('click', prevImage);

        // Click on backdrop to close
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox || e.target.classList.contains('lightbox__image-container')) {
                closeLightbox();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!lightbox.classList.contains('active')) return;

            switch (e.key) {
                case 'Escape':
                    closeLightbox();
                    break;
                case 'ArrowRight':
                    nextImage();
                    break;
                case 'ArrowLeft':
                    prevImage();
                    break;
            }
        });

        // Touch/swipe support
        var touchStartX = 0;
        var touchEndX = 0;

        lightbox.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        lightbox.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            var diff = touchStartX - touchEndX;

            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    nextImage();
                } else {
                    prevImage();
                }
            }
        }, { passive: true });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
