/**
 * Header interactions — Discover mega-menu, account dropdown, search toggle state.
 * Vanilla JS, no dependencies.
 */
(function () {
    'use strict';

    var header  = document.getElementById('site-header');
    var toggle  = document.getElementById('discover-toggle');
    var panel   = document.getElementById('discover-panel');
    var label   = toggle ? toggle.querySelector('.rh-discover-btn__label') : null;

    function setOpen(open) {
        if (!toggle || !panel) return;
        panel.hidden = !open;
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (label) label.textContent = open ? (label.dataset.close || 'Close') : (label.dataset.open || 'Discover');
        document.body.classList.toggle('rh-discover-open', open);
        if (open) {
            var first = panel.querySelector('a, button, input');
            if (first) first.focus({ preventScroll: true });
        }
    }

    if (toggle && panel) {
        toggle.addEventListener('click', function () {
            setOpen(panel.hidden);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !panel.hidden) {
                setOpen(false);
                toggle.focus();
            }
        });
        document.addEventListener('click', function (e) {
            if (panel.hidden) return;
            if (header && !header.contains(e.target)) setOpen(false);
        });
    }

    // Account dropdown
    var userBtn = document.querySelector('.rh-user__btn');
    if (userBtn) {
        var wrap = userBtn.closest('.rh-user');
        userBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            var open = !wrap.classList.contains('is-open');
            wrap.classList.toggle('is-open', open);
            userBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        document.addEventListener('click', function () {
            wrap.classList.remove('is-open');
            userBtn.setAttribute('aria-expanded', 'false');
        });
    }

    // Keep search toggle's aria state in sync with the overlay (main.js opens/closes it)
    var searchToggle = document.getElementById('search-toggle');
    var overlay = document.getElementById('search-overlay');
    if (searchToggle && overlay && 'MutationObserver' in window) {
        new MutationObserver(function () {
            searchToggle.setAttribute('aria-expanded', overlay.style.display === 'flex' ? 'true' : 'false');
        }).observe(overlay, { attributes: true, attributeFilter: ['style'] });
        searchToggle.addEventListener('click', function () { setOpen(false); });
    }
})();
