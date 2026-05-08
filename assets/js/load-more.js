/**
 * RowHome Magazine - Load More Posts
 * AJAX-based load more functionality for section landing pages
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

(function() {
    'use strict';

    function init() {
        var loadMoreBtn = document.querySelector('.load-more-btn');
        if (!loadMoreBtn) return;

        var page = 2;
        var category = loadMoreBtn.dataset.category || '';
        var maxPages = parseInt(loadMoreBtn.dataset.maxPages, 10) || 1;
        var grid = document.querySelector('.section-articles__grid');

        if (!grid) return;

        loadMoreBtn.addEventListener('click', function() {
            if (loadMoreBtn.disabled) return;

            var originalText = loadMoreBtn.textContent;
            loadMoreBtn.textContent = 'Loading...';
            loadMoreBtn.disabled = true;

            var formData = new FormData();
            formData.append('action', 'rowhome_section_load_more');
            formData.append('nonce', rowhomeAjax.nonce);
            formData.append('page', page);
            formData.append('category', category);

            fetch(rowhomeAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success && data.data.html) {
                    // Create a temporary container to parse the HTML
                    var temp = document.createElement('div');
                    temp.innerHTML = data.data.html;

                    // Append each child to the grid
                    while (temp.firstChild) {
                        var node = temp.firstChild;
                        grid.appendChild(node);
                    }

                    page++;

                    // Update max pages if returned
                    if (data.data.max_pages) {
                        maxPages = parseInt(data.data.max_pages, 10);
                    }

                    if (page > maxPages) {
                        loadMoreBtn.style.display = 'none';
                    } else {
                        loadMoreBtn.textContent = originalText;
                        loadMoreBtn.disabled = false;
                    }

                    // Trigger fade-in for new cards
                    var newCards = grid.querySelectorAll('.article-card-enhanced');
                    newCards.forEach(function(card) {
                        if (card.style.opacity === '') {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(15px)';
                            card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';

                            requestAnimationFrame(function() {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            });
                        }
                    });
                } else {
                    loadMoreBtn.textContent = 'No More Articles';
                    loadMoreBtn.disabled = true;
                }
            })
            .catch(function(error) {
                console.error('Load more error:', error);
                loadMoreBtn.textContent = originalText;
                loadMoreBtn.disabled = false;
            });
        });
    }

    // Copy link functionality for social share
    function initCopyLink() {
        var copyBtns = document.querySelectorAll('.social-share-bar__btn--copy');
        copyBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var url = btn.dataset.url;
                if (!url) return;

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(function() {
                        showCopyFeedback(btn);
                    });
                } else {
                    // Fallback for older browsers
                    var textarea = document.createElement('textarea');
                    textarea.value = url;
                    textarea.style.position = 'fixed';
                    textarea.style.left = '-9999px';
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                    showCopyFeedback(btn);
                }
            });
        });
    }

    function showCopyFeedback(btn) {
        var originalHTML = btn.innerHTML;
        btn.innerHTML = '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>';
        btn.style.backgroundColor = '#28a745';
        btn.style.color = '#fff';

        setTimeout(function() {
            btn.innerHTML = originalHTML;
            btn.style.backgroundColor = '';
            btn.style.color = '';
        }, 2000);
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            init();
            initCopyLink();
        });
    } else {
        init();
        initCopyLink();
    }
})();
