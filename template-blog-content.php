<?php
/**
 * Blog post content partial
 * Loaded by single.php when _post_layout custom field is 'blog'
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */
?>

<div class="container">
    <article class="blog-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <!-- Standard Hero -->
        <?php get_template_part('template-parts/content-hero', null, array('style' => 'standard', 'show_meta' => true, 'show_category' => true)); ?>

        <!-- Read Time -->
        <div class="blog-post__read-time">
            <?php rowhome_magazine_reading_time(); ?>
        </div>

        <!-- Author Bio -->
        <?php get_template_part('template-parts/author-bio'); ?>

        <!-- Content -->
        <div class="blog-post__content entry-content">
            <?php
            the_content();
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'rowhome-magazine'),
                'after'  => '</div>',
            ));
            ?>
        </div>

        <!-- Tags -->
        <?php
        $tags_list = get_the_tag_list('', ' ');
        if ($tags_list) :
        ?>
            <div class="blog-post__tags">
                <?php echo $tags_list; ?>
            </div>
        <?php endif; ?>

        <!-- Social Share -->
        <?php get_template_part('template-parts/social-share'); ?>

        <!-- Ad Slot -->
        <div class="blog-post__ad">
            <?php get_template_part('template-parts/ad-slot', null, array('position' => 'below-content', 'class' => 'ad-slot--leaderboard')); ?>
        </div>

    </article>

    <!-- Related Posts -->
    <?php
    $section_name = '';
    $departments = get_the_terms(get_the_ID(), 'department_category');
    if ($departments && !is_wp_error($departments)) {
        $dept = array_shift($departments);
        $section_name = $dept->name;
    }
    $heading = $section_name ? sprintf(__('More from %s', 'rowhome-magazine'), $section_name) : __('More Articles', 'rowhome-magazine');
    get_template_part('template-parts/related-posts', null, array('heading' => $heading, 'count' => 3));
    ?>

    <!-- Comments -->
    <?php if (comments_open() || get_comments_number()) : ?>
        <div class="comments-section">
            <?php comments_template(); ?>
        </div>
    <?php endif; ?>

</div>
