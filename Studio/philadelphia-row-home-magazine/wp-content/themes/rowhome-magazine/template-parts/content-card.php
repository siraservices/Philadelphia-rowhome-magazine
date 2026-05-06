<?php
/**
 * Template part for displaying article cards
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="article-image">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail('rowhome-article-card'); ?>
            </a>
        </div>
    <?php else : ?>
        <div class="article-image">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                $philly_imgs = array('uploads/2026/05/row-homes.jpg','uploads/2026/05/magic-garden.jpg','uploads/2026/05/independence-hall.jpg','uploads/2026/05/philly-mural.jpg','uploads/2026/05/cheesesteak-menu.jpg','uploads/2026/02/800-1.jpg','uploads/2026/02/800-2.jpg','uploads/2026/02/800-3.jpg','uploads/2026/02/800-4.jpg','uploads/2026/02/800-5.jpg','uploads/2026/02/800-6.jpg');
                $fallback = content_url($philly_imgs[get_the_ID() % count($philly_imgs)]);
                ?>
                <img src="<?php echo esc_url($fallback); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            </a>
        </div>
    <?php endif; ?>
    
    <div class="article-content">
        <?php rowhome_magazine_department_badge(); ?>
        
        <h3 class="article-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="article-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
        </div>
        
        <?php rowhome_magazine_article_meta(); ?>
    </div>
</article>

