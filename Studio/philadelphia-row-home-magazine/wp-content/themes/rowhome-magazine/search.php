<?php
/**
 * The template for displaying search results pages
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<div class="container">
    <main id="primary" class="site-main search-results">

        <?php if (have_posts()) : ?>

            <header class="page-header" style="margin-bottom: 40px;">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__('Search Results for: %s', 'rowhome-magazine'),
                        '<span style="color: #FF0000;">"' . get_search_query() . '"</span>'
                    );
                    ?>
                </h1>
                <p style="color: #666; font-size: 1.1rem; margin-top: 10px;">
                    Found <?php echo $wp_query->found_posts; ?> result<?php echo $wp_query->found_posts !== 1 ? 's' : ''; ?>
                </p>
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

            <header class="page-header" style="margin-bottom: 40px;">
                <h1 class="page-title">
                    <?php esc_html_e('Nothing Found', 'rowhome-magazine'); ?>
                </h1>
            </header>

            <div class="no-results" style="text-align: center; padding: 60px 20px;">
                <p style="font-size: 1.2rem; margin-bottom: 30px; color: #666;">
                    <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rowhome-magazine'); ?>
                </p>
                
                <div style="max-width: 600px; margin: 0 auto;">
                    <?php get_search_form(); ?>
                </div>

                <div style="margin-top: 60px;">
                    <h3 style="margin-bottom: 20px;">Browse by Department</h3>
                    <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                        <?php
                        $departments = array('LIFE', 'BUSINESS', 'HEALTH', 'REAL ESTATE', 'MENU', '2025 HOTSPOTS');
                        foreach ($departments as $dept) {
                            $slug = sanitize_title($dept);
                            echo '<a href="' . home_url('/department/' . $slug) . '" style="padding: 10px 20px; background-color: #f5f5f5; border-radius: 4px;">' . esc_html($dept) . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </main>
</div>

<?php
get_footer();
?>

