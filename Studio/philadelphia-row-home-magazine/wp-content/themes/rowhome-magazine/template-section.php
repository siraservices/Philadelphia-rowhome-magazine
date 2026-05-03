<?php
/**
 * Template Name: Section Landing Page
 *
 * Landing page for editorial departments (Life, Business, Health, etc.)
 * Assign this template to pages that represent section landing pages.
 * Set a custom field '_section_category' with the category/taxonomy slug.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();

// Get the section category slug from custom field or page slug
$section_slug = get_post_meta(get_the_ID(), '_section_category', true);
if (!$section_slug) {
    $section_slug = get_post_field('post_name', get_the_ID());
}

// Try to get the department_category term (try prefixed slug if unprefixed fails)
$section_term = get_term_by('slug', $section_slug, 'department_category');
if (!$section_term && strpos($section_slug, 'dept-') !== 0) {
    $section_term = get_term_by('slug', 'dept-' . $section_slug, 'department_category');
}
$section_name = $section_term ? $section_term->name : get_the_title();
$section_description = $section_term ? $section_term->description : get_the_excerpt();

// Map parent sections to their sub-department slugs (matches header navigation structure)
// Keys and values listed without dept- prefix; lookup tries both forms.
$section_children_map = array(
    'life'      => array('health', 'fashion', 'brides-guide', 'community', 'writers-block'),
    'business'  => array('real-estate', 'tech', 'education', 'politics'),
    'arts'      => array('music-art', 'film', 'flashback', 'history'),
    'lifestyle' => array('menu', 'travel', '2025-hotspots', 'events'),
);

// Build array of all term IDs to query (parent + children)
$section_term_ids = array();
if ($section_term) {
    $section_term_ids[] = $section_term->term_id;
    // Normalize slug: strip dept- prefix for map lookup
    $current_slug = $section_term->slug;
    $map_key = preg_replace('/^dept-/', '', $current_slug);
    if (isset($section_children_map[$map_key])) {
        foreach ($section_children_map[$map_key] as $child_slug) {
            // Try bare slug first, then dept- prefixed
            $child_term = get_term_by('slug', $child_slug, 'department_category');
            if (!$child_term) {
                $child_term = get_term_by('slug', 'dept-' . $child_slug, 'department_category');
            }
            if ($child_term) {
                $section_term_ids[] = $child_term->term_id;
            }
        }
    }
}

// Build the tax_query used by all queries on this page
$section_tax_query = !empty($section_term_ids) ? array(
    array(
        'taxonomy' => 'department_category',
        'field'    => 'term_id',
        'terms'    => $section_term_ids,
    ),
) : array();

// Count total posts in this section (including sub-departments)
$count_query = new WP_Query(array(
    'post_type'      => array('post', 'department'),
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'no_found_rows'  => false,
    'tax_query'      => $section_tax_query,
));
$total_posts = $count_query->found_posts;
wp_reset_postdata();
?>

<!-- Section Hero Banner -->
<div class="section-hero<?php echo has_post_thumbnail() ? ' section-hero--with-bg' : ''; ?>"
     <?php if (has_post_thumbnail()) : ?>style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>');"<?php endif; ?>>
    <div class="container">
        <div class="section-hero__content">
            <div class="section-hero__breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'rowhome-magazine'); ?></a>
                <span> / </span>
                <span><?php echo esc_html($section_name); ?></span>
            </div>
            <h1 class="section-hero__title"><?php echo esc_html($section_name); ?></h1>
            <?php if ($section_description) : ?>
                <p class="section-hero__tagline"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
            <?php if ($total_posts > 0) : ?>
                <p class="section-hero__count"><?php echo $total_posts; ?> article<?php echo $total_posts !== 1 ? 's' : ''; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container section-landing">
    <div class="section-layout">

        <!-- Main Content -->
        <main class="section-main" id="primary">

            <?php
            // Featured Article (latest post in this section)
            $featured_args = array(
                'post_type'      => array('post', 'department'),
                'posts_per_page' => 1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            if (!empty($section_tax_query)) {
                $featured_args['tax_query'] = $section_tax_query;
            }

            $featured_query = new WP_Query($featured_args);
            $exclude_ids = array();

            if ($featured_query->have_posts()) :
                while ($featured_query->have_posts()) : $featured_query->the_post();
                    $exclude_ids[] = get_the_ID();
            ?>
                <section class="section-featured">
                    <a href="<?php the_permalink(); ?>" class="section-featured__card">
                        <div class="section-featured__image">
                            <?php
                            $feat_thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'rowhome-featured');
                            if (!$feat_thumb_url) {
                                $feat_thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            }
                            if ($feat_thumb_url) : ?>
                                <img src="<?php echo esc_url($feat_thumb_url); ?>" alt="<?php the_title_attribute(); ?>" loading="eager">
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" alt="<?php the_title_attribute(); ?>" loading="eager">
                            <?php endif; ?>
                        </div>
                        <div class="section-featured__content">
                            <span class="section-featured__category"><?php echo esc_html($section_name); ?></span>
                            <h2 class="section-featured__title"><?php the_title(); ?></h2>
                            <p class="section-featured__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                            <div class="section-featured__meta">
                                By <span class="section-featured__author"><?php echo esc_html(get_the_author()); ?></span> &middot; <?php echo esc_html(get_the_date()); ?>
                            </div>
                        </div>
                    </a>
                </section>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>

            <!-- Article Grid -->
            <div class="section-articles">
                <div class="section-articles__grid" id="sectionArticlesGrid">
                    <?php
                    $grid_args = array(
                        'post_type'      => array('post', 'department'),
                        'posts_per_page' => 6,
                        'post__not_in'   => $exclude_ids,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );

                    if (!empty($section_tax_query)) {
                        $grid_args['tax_query'] = $section_tax_query;
                    }

                    $grid_query = new WP_Query($grid_args);
                    $max_pages = $grid_query->max_num_pages;

                    if ($grid_query->have_posts()) :
                        while ($grid_query->have_posts()) : $grid_query->the_post();
                            get_template_part('template-parts/content-article-card', null, array(
                                'show_excerpt'   => true,
                                'excerpt_length' => 15,
                                'show_author'    => true,
                            ));
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                        <p style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                            <?php esc_html_e('No articles found in this section yet.', 'rowhome-magazine'); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if ($max_pages > 1) : ?>
                    <div class="load-more-wrapper">
                        <button class="load-more-btn"
                                data-category="<?php echo esc_attr($section_slug); ?>"
                                data-max-pages="<?php echo esc_attr($max_pages); ?>">
                            <?php esc_html_e('Load More Articles', 'rowhome-magazine'); ?>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

        </main>

        <!-- Sidebar -->
        <aside class="section-sidebar" aria-label="<?php esc_attr_e('Section sidebar', 'rowhome-magazine'); ?>">

            <!-- Ad Slot -->
            <div class="sidebar-widget">
                <?php get_template_part('template-parts/ad-slot', null, array('position' => 'sidebar', 'class' => 'ad-slot--sidebar')); ?>
            </div>

            <!-- Popular in Section -->
            <div class="sidebar-widget">
                <h3 class="sidebar-widget__title"><?php printf(esc_html__('Popular in %s', 'rowhome-magazine'), esc_html($section_name)); ?></h3>
                <ol class="popular-articles__list">
                    <?php
                    $popular_args = array(
                        'post_type'      => array('post', 'department'),
                        'posts_per_page' => 5,
                        'orderby'        => 'comment_count',
                        'order'          => 'DESC',
                    );

                    if (!empty($section_tax_query)) {
                        $popular_args['tax_query'] = $section_tax_query;
                    }

                    $popular_query = new WP_Query($popular_args);

                    if ($popular_query->have_posts()) :
                        while ($popular_query->have_posts()) : $popular_query->the_post();
                    ?>
                        <li class="popular-articles__item">
                            <a href="<?php the_permalink(); ?>" class="popular-articles__link"><?php the_title(); ?></a>
                        </li>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Placeholder popular articles
                        $placeholders = array(
                            'The Best of Philadelphia ' . date('Y'),
                            'Hidden Gems You Need to Visit',
                            'Our Editor\'s Top Picks This Month',
                            'What\'s New in the Neighborhood',
                            'Community Spotlight: Local Heroes',
                        );
                        foreach ($placeholders as $title) :
                    ?>
                        <li class="popular-articles__item">
                            <a href="#" class="popular-articles__link"><?php echo esc_html($title); ?></a>
                        </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ol>
            </div>

            <!-- Newsletter Signup -->
            <div class="sidebar-widget">
                <h3 class="sidebar-widget__title"><?php esc_html_e('Newsletter', 'rowhome-magazine'); ?></h3>
                <p class="newsletter-widget__text">
                    <?php printf(esc_html__('Get the latest %s articles delivered to your inbox.', 'rowhome-magazine'), esc_html($section_name)); ?>
                </p>
                <form class="newsletter-widget__form" id="sectionNewsletterForm">
                    <input type="email" name="email" class="newsletter-widget__input" placeholder="<?php esc_attr_e('Your email address', 'rowhome-magazine'); ?>" required aria-label="<?php esc_attr_e('Email address', 'rowhome-magazine'); ?>">
                    <button type="submit" class="newsletter-widget__submit"><?php esc_html_e('Subscribe', 'rowhome-magazine'); ?></button>
                </form>
            </div>

        </aside>

    </div>
</div>

<?php get_footer(); ?>
