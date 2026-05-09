<?php
/**
 * Template part for displaying article cards in grids
 * Enhanced version with more layout options
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

$card_class = isset($args['class']) ? ' ' . $args['class'] : '';
$show_excerpt = isset($args['show_excerpt']) ? $args['show_excerpt'] : true;
$excerpt_length = isset($args['excerpt_length']) ? intval($args['excerpt_length']) : 20;
$show_author = isset($args['show_author']) ? $args['show_author'] : true;
$image_size = isset($args['image_size']) ? $args['image_size'] : 'rowhome-article-card';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-card-enhanced' . $card_class); ?>>
    <a href="<?php the_permalink(); ?>" class="article-card-enhanced__link">
        <div class="article-card-enhanced__image">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail($image_size, array('loading' => 'lazy')); ?>
            <?php else : ?>
                <?php
                $philly_imgs = array('/assets/images/hero-1.jpg','/assets/images/hero-2.jpg','/assets/images/hero-3.jpg','/assets/images/about-hero.jpg','/assets/images/subscribe-hero.jpg');
                $fallback = get_template_directory_uri() . $philly_imgs[get_the_ID() % count($philly_imgs)];
                ?>
                <img src="<?php echo esc_url($fallback); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            <?php endif; ?>
        </div>
        <div class="article-card-enhanced__content">
            <?php
            $departments = get_the_terms(get_the_ID(), 'department_category');
            if ($departments && !is_wp_error($departments)) :
                $dept = array_shift($departments);
            ?>
                <span class="article-card-enhanced__category"><?php echo esc_html($dept->name); ?></span>
            <?php endif; ?>

            <h3 class="article-card-enhanced__title"><?php the_title(); ?></h3>

            <?php if ($show_excerpt) : ?>
                <p class="article-card-enhanced__excerpt"><?php echo wp_trim_words(get_the_excerpt(), $excerpt_length); ?></p>
            <?php endif; ?>

            <?php if ($show_author) : ?>
                <div class="article-card-enhanced__meta">
                    <span class="article-card-enhanced__author"><?php echo esc_html(get_the_author() ?: 'RowHome Staff'); ?></span>
                    <span class="article-card-enhanced__date"><?php echo esc_html(get_the_date()); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </a>
</article>
