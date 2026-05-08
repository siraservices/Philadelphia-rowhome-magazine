<?php
/**
 * Template Name: Blog Post
 *
 * Shorter, simpler layout for quick updates, opinion pieces, listicles.
 * Can be assigned as a page template, or triggered via custom field
 * '_post_layout' = 'blog' on single posts.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

    <div class="container">
        <article class="blog-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Standard Hero (not full-bleed) -->
            <?php get_template_part('template-parts/content-hero', null, array('style' => 'standard', 'show_meta' => true, 'show_category' => true)); ?>

            <!-- Estimated Read Time -->
            <div class="blog-post__read-time">
                <?php rowhome_magazine_reading_time(); ?>
            </div>

            <!-- Author Bio -->
            <?php get_template_part('template-parts/author-bio'); ?>

            <!-- Article Content -->
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

            <!-- Ad Slot between content and comments -->
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

<?php endwhile; ?>

<?php get_footer(); ?>
