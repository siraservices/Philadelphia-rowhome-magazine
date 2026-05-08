<?php
/**
 * The template for displaying all pages
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<div class="container">
    <main id="primary" class="site-main">

        <?php
        while (have_posts()) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('rowhome-featured'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'rowhome-magazine'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

            </article>

            <?php
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main>
</div>

<?php
get_footer();
?>

