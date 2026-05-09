<?php
/**
 * Template part for displaying author bio/byline block
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

$author_id = get_the_author_meta('ID');
$author_name = get_the_author() ?: 'RowHome Staff';
$author_bio = get_the_author_meta('description');
$author_url = $author_id ? get_author_posts_url($author_id) : home_url('/');
?>

<div class="author-bio-block">
    <div class="author-bio-block__avatar">
        <a href="<?php echo esc_url($author_url); ?>">
            <?php echo get_avatar($author_id, 80); ?>
        </a>
    </div>
    <div class="author-bio-block__info">
        <span class="author-bio-block__label"><?php esc_html_e('Written by', 'rowhome-magazine'); ?></span>
        <h4 class="author-bio-block__name">
            <a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a>
        </h4>
        <?php if ($author_bio) : ?>
            <p class="author-bio-block__description"><?php echo esc_html($author_bio); ?></p>
        <?php endif; ?>
    </div>
</div>
