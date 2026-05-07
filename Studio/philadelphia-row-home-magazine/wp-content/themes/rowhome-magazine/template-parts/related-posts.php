<?php
/**
 * Template part for displaying related articles grid
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

$current_post_id = get_the_ID();
$heading = isset($args['heading']) ? $args['heading'] : __('Related Articles', 'rowhome-magazine');
$count = isset($args['count']) ? intval($args['count']) : 3;

// Get related posts by department_category first, then by category
$related_terms = wp_get_post_terms($current_post_id, 'department_category', array('fields' => 'ids'));

$query_args = array(
    'post_type'      => array('post', 'department'),
    'posts_per_page' => $count,
    'post__not_in'   => array($current_post_id),
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if (!empty($related_terms) && !is_wp_error($related_terms)) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'department_category',
            'field'    => 'term_id',
            'terms'    => $related_terms,
        ),
    );
} else {
    $categories = wp_get_post_categories($current_post_id, array('fields' => 'ids'));
    if (!empty($categories)) {
        $query_args['category__in'] = $categories;
    }
}

$related_query = new WP_Query($query_args);

if ($related_query->have_posts()) :
?>
<section class="related-posts" aria-label="<?php echo esc_attr($heading); ?>">
    <h2 class="related-posts__heading"><?php echo esc_html($heading); ?></h2>
    <div class="related-posts__grid">
        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
            <article class="related-posts__card">
                <a href="<?php the_permalink(); ?>" class="related-posts__link">
                    <div class="related-posts__image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('rowhome-article-card'); ?>
                        <?php else : ?>
                            <?php
                            $philly_imgs = array('/assets/images/hero-1.jpg','/assets/images/hero-2.jpg','/assets/images/hero-3.jpg','/assets/images/about-hero.jpg','/assets/images/subscribe-hero.jpg');
                            $fallback = get_template_directory_uri() . $philly_imgs[get_the_ID() % count($philly_imgs)];
                            ?>
                            <img src="<?php echo esc_url($fallback); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <div class="related-posts__content">
                        <?php
                        $departments = get_the_terms(get_the_ID(), 'department_category');
                        if ($departments && !is_wp_error($departments)) :
                            $dept = array_shift($departments);
                        ?>
                            <span class="related-posts__category"><?php echo esc_html($dept->name); ?></span>
                        <?php endif; ?>
                        <h3 class="related-posts__title"><?php the_title(); ?></h3>
                        <div class="related-posts__meta">
                            <?php echo esc_html(get_the_author() ?: 'RowHome Staff'); ?> &middot; <?php echo esc_html(get_the_date()); ?>
                        </div>
                    </div>
                </a>
            </article>
        <?php endwhile; ?>
    </div>
</section>
<?php
    wp_reset_postdata();
endif;
?>
