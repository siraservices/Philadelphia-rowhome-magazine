<?php
/**
 * The template for displaying archive pages
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<div class="container">
    <main id="primary" class="site-main archive-page">

        <?php if (have_posts()) : ?>

            <header class="page-header" style="margin-bottom: 40px;">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description" style="color: #666; font-size: 1.1rem; margin-top: 15px;">', '</div>');
                ?>
                
                <?php if (is_tax('department_category')) : ?>
                    <p style="margin-top: 20px; color: #666;">
                        <?php echo $wp_query->found_posts; ?> article<?php echo $wp_query->found_posts !== 1 ? 's' : ''; ?> in this department
                    </p>
                <?php endif; ?>
            </header>

            <div class="article-grid grid-3">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'card');
                endwhile;
                ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('&laquo; Previous', 'rowhome-magazine'),
                'next_text' => __('Next &raquo;', 'rowhome-magazine'),
            ));

        else :
            ?>

            <div class="no-results" style="text-align: center; padding: 60px 20px;">
                <h1 class="page-title"><?php esc_html_e('Nothing Found', 'rowhome-magazine'); ?></h1>
                <p style="font-size: 1.2rem; margin: 20px 0; color: #666;">
                    <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rowhome-magazine'); ?>
                </p>
                <?php get_search_form(); ?>
            </div>

        <?php endif; ?>

    </main>
</div>

<?php
get_footer();
?>

