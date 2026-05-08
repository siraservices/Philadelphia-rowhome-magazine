/**
 * Article TOC builder + copy-link handler (Direction B)
 * SIR-776 — runs only on single post pages via conditional enqueue.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var content = document.getElementById('rh-article-content');
        var tocEl   = document.getElementById('rh-toc');
        var tocNav  = tocEl ? tocEl.querySelector('.rh-article-toc__nav') : null;

        // ---- Build TOC from h2 headings ----
        if (content && tocNav) {
            var headings = content.querySelectorAll('h2');

            if (headings.length < 2) {
                // Not enough headings to warrant a TOC
                if (tocEl) tocEl.style.display = 'none';
            } else {
                headings.forEach(function (h, i) {
                    var id = h.id || ('rh-section-' + i);
                    h.id = id;

                    var link = document.createElement('a');
                    link.href = '#' + id;
                    link.className = 'rh-article-toc__link';
                    link.textContent = h.textContent;
                    tocNav.appendChild(link);
                });

                // Highlight active section on scroll (IntersectionObserver)
                if ('IntersectionObserver' in window) {
                    var observer = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            var link = tocNav.querySelector('[href="#' + entry.target.id + '"]');
                            if (link) {
                                link.classList.toggle('rh-article-toc__link--active', entry.isIntersecting);
                            }
                        });
                    }, { rootMargin: '-10% 0px -70% 0px' });

                    headings.forEach(function (h) { observer.observe(h); });
                }
            }
        }

        // ---- Copy-link button ----
        var copyBtn = document.querySelector('.rh-article-share__btn--copy');
        if (copyBtn && navigator.clipboard) {
            copyBtn.addEventListener('click', function () {
                var url = copyBtn.dataset.url || location.href;
                navigator.clipboard.writeText(url).then(function () {
                    var origLabel = copyBtn.getAttribute('aria-label');
                    copyBtn.setAttribute('aria-label', 'Copied!');
                    setTimeout(function () {
                        copyBtn.setAttribute('aria-label', origLabel);
                    }, 2000);
                });
            });
        }
    });
}());
