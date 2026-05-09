<?php
/**
 * Template part for displaying social sharing buttons
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

$share_url     = esc_attr( rawurlencode( get_permalink() ) );
$share_title   = esc_attr( rawurlencode( get_the_title() ) );
$share_excerpt = esc_attr( rawurlencode( wp_trim_words( get_the_excerpt(), 20, '' ) ) );
?>

<div class="social-share-bar" aria-label="<?php esc_attr_e('Share this article', 'rowhome-magazine'); ?>">
    <span class="social-share-bar__label"><?php esc_html_e('Share', 'rowhome-magazine'); ?></span>
    <div class="social-share-bar__buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>"
           target="_blank" rel="noopener noreferrer"
           class="social-share-bar__btn social-share-bar__btn--facebook"
           aria-label="<?php esc_attr_e('Share on Facebook', 'rowhome-magazine'); ?>">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
        </a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $share_title; ?>"
           target="_blank" rel="noopener noreferrer"
           class="social-share-bar__btn social-share-bar__btn--twitter"
           aria-label="<?php esc_attr_e('Share on X (Twitter)', 'rowhome-magazine'); ?>">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
        </a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>&title=<?php echo $share_title; ?>&summary=<?php echo $share_excerpt; ?>"
           target="_blank" rel="noopener noreferrer"
           class="social-share-bar__btn social-share-bar__btn--linkedin"
           aria-label="<?php esc_attr_e('Share on LinkedIn', 'rowhome-magazine'); ?>">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
        </a>
        <a href="mailto:?subject=<?php echo $share_title; ?>&body=<?php echo $share_url; ?>"
           class="social-share-bar__btn social-share-bar__btn--email"
           aria-label="<?php esc_attr_e('Share via Email', 'rowhome-magazine'); ?>">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
            </svg>
        </a>
        <button class="social-share-bar__btn social-share-bar__btn--copy" data-url="<?php echo esc_attr(get_permalink()); ?>"
                aria-label="<?php esc_attr_e('Copy link', 'rowhome-magazine'); ?>">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
            </svg>
        </button>
    </div>
</div>
