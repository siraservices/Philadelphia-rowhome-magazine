<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<div class="container">
    <main id="primary" class="site-main">

        <?php if (have_posts()) : ?>

            <header class="page-header">
                <?php
                if (is_home() && !is_front_page()) :
                    ?>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php
                elseif (is_archive()) :
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                elseif (is_search()) :
                    ?>
                    <h1 class="page-title">
                        <?php
                        printf(
                            esc_html__('Search Results for: %s', 'rowhome-magazine'),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                <?php endif; ?>
            </header>

            <div class="article-grid grid-3">
                <?php
                // Start the Loop
                while (have_posts()) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'card');

                endwhile;
                ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('&laquo; Previous', 'rowhome-magazine'),
                'next_text' => __('Next &raquo;', 'rowhome-magazine'),
                'class'     => 'pagination',
            ));

        else :

            ?>
            <div class="no-results">
                <h1 class="page-title"><?php esc_html_e('Nothing Found', 'rowhome-magazine'); ?></h1>
                <div class="page-content">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>

                        <p>
                            <?php
                            printf(
                                wp_kses(
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rowhome-magazine'),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url(admin_url('post-new.php'))
                            );
                            ?>
                        </p>

                    <?php elseif (is_search()) : ?>

                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rowhome-magazine'); ?></p>
                        <?php get_search_form(); ?>

                    <?php else : ?>

                        <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rowhome-magazine'); ?></p>
                        <?php get_search_form(); ?>

                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>

    </main>
</div>

<?php
get_footer();
?>

