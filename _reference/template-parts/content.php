<?php
/**
 * Template part for displaying posts
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>
        
        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php rowhome_magazine_article_meta(); ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail() && is_singular()) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('rowhome-featured'); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if (is_singular()) :
            the_content();
            
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'rowhome-magazine'),
                'after'  => '</div>',
            ));
        else :
            the_excerpt();
        endif;
        ?>
    </div>

    <?php if (is_singular()) : ?>
        <footer class="entry-footer">
            <?php rowhome_magazine_social_share(); ?>
        </footer>
    <?php endif; ?>
</article>

