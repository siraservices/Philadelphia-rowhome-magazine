<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<div class="container">
    <main id="primary" class="site-main error-404">

        <section class="error-404-content" style="text-align: center; padding: 100px 20px; min-height: 60vh;">
            <h1 class="page-title" style="font-size: 8rem; margin-bottom: 20px; color: #FF0000;">404</h1>
            <h2 style="font-size: 2rem; margin-bottom: 30px;">Oops! That page can't be found.</h2>
            <p style="font-size: 1.2rem; margin-bottom: 40px; color: #666;">
                It looks like nothing was found at this location. Maybe try a search?
            </p>

            <div style="max-width: 600px; margin: 0 auto 40px;">
                <?php get_search_form(); ?>
            </div>

            <p style="margin-bottom: 30px;">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="subscribe-btn" style="display: inline-block; padding: 15px 40px; font-size: 1.1rem;">
                    Return to Homepage
                </a>
            </p>

            <div style="margin-top: 60px;">
                <h3 style="margin-bottom: 20px;">Popular Departments</h3>
                <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(home_url('/department/dept-life')); ?>" style="padding: 10px 20px; background-color: #f5f5f5; border-radius: 4px;">LIFE</a>
                    <a href="<?php echo esc_url(home_url('/department/dept-business')); ?>" style="padding: 10px 20px; background-color: #f5f5f5; border-radius: 4px;">BUSINESS</a>
                    <a href="<?php echo esc_url(home_url('/department/dept-menu')); ?>" style="padding: 10px 20px; background-color: #f5f5f5; border-radius: 4px;">MENU</a>
                    <a href="<?php echo esc_url(home_url('/department/dept-real-estate')); ?>" style="padding: 10px 20px; background-color: #f5f5f5; border-radius: 4px;">REAL ESTATE</a>
                    <a href="<?php echo esc_url(home_url('/department/dept-arts')); ?>" style="padding: 10px 20px; background-color: #f5f5f5; border-radius: 4px;">ARTS</a>
                </div>
            </div>
        </section>

    </main>
</div>

<?php
get_footer();
?>

