<?php
/**
 * RowHome Magazine Theme Functions
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function rowhome_magazine_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Set default thumbnail size
    set_post_thumbnail_size(800, 600, true);
    
    // Add custom image sizes
    add_image_size('rowhome-featured', 1200, 600, true);
    add_image_size('rowhome-article-card', 800, 500, true);
    add_image_size('rowhome-small-card', 400, 300, true);
    add_image_size('rowhome-hero', 1400, 700, true);
    add_image_size('rowhome-gallery', 800, 800, false);
    add_image_size('rowhome-gallery-full', 1600, 1200, false);

    // Add support for wide and full alignment in block editor
    add_theme_support('align-wide');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'rowhome-magazine'),
        'department' => __('Department Menu', 'rowhome-magazine'),
        'top-bar' => __('Top Bar Menu', 'rowhome-magazine'),
        'footer' => __('Footer Menu', 'rowhome-magazine'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'rowhome_magazine_setup');

/**
 * Set the content width in pixels
 */
function rowhome_magazine_content_width() {
    $GLOBALS['content_width'] = apply_filters('rowhome_magazine_content_width', 1200);
}
add_action('after_setup_theme', 'rowhome_magazine_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function rowhome_magazine_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('rowhome-google-fonts', 'https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Montserrat:wght@400;700;900&display=swap', array(), null);
    
    // Enqueue main stylesheet
    wp_enqueue_style('rowhome-magazine-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue custom JavaScript
    wp_enqueue_script('rowhome-magazine-scripts', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('rowhome-magazine-scripts', 'rowhomeAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('rowhome-nonce')
    ));
    
    // Enqueue template styles
    wp_enqueue_style('rowhome-templates-style', get_template_directory_uri() . '/assets/css/templates.css', array('rowhome-magazine-style'), '1.0.0');

    // Enqueue load-more and copy-link JS on all pages
    wp_enqueue_script('rowhome-load-more', get_template_directory_uri() . '/assets/js/load-more.js', array(), '1.0.0', true);

    // Enqueue gallery lightbox JS only on pictorial single pages
    if (is_singular('pictorial')) {
        wp_enqueue_script('rowhome-gallery-lightbox', get_template_directory_uri() . '/assets/js/gallery-lightbox.js', array(), '1.0.0', true);
    }

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'rowhome_magazine_scripts');

/**
 * Register widget areas
 */
function rowhome_magazine_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'rowhome-magazine'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'rowhome-magazine'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 1', 'rowhome-magazine'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'rowhome-magazine'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 2', 'rowhome-magazine'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'rowhome-magazine'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 3', 'rowhome-magazine'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'rowhome-magazine'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 4', 'rowhome-magazine'),
        'id'            => 'footer-4',
        'description'   => __('Add widgets here to appear in your footer.', 'rowhome-magazine'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => __('Section Sidebar', 'rowhome-magazine'),
        'id'            => 'section-sidebar',
        'description'   => __('Widgets for section landing page sidebars.', 'rowhome-magazine'),
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar-widget__title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'rowhome_magazine_widgets_init');

/**
 * Register Custom Post Type - Departments
 */
function rowhome_magazine_register_departments() {
    $labels = array(
        'name'                  => _x('Departments', 'Post Type General Name', 'rowhome-magazine'),
        'singular_name'         => _x('Department', 'Post Type Singular Name', 'rowhome-magazine'),
        'menu_name'             => __('Departments', 'rowhome-magazine'),
        'name_admin_bar'        => __('Department', 'rowhome-magazine'),
        'archives'              => __('Department Archives', 'rowhome-magazine'),
        'attributes'            => __('Department Attributes', 'rowhome-magazine'),
        'parent_item_colon'     => __('Parent Department:', 'rowhome-magazine'),
        'all_items'             => __('All Departments', 'rowhome-magazine'),
        'add_new_item'          => __('Add New Department', 'rowhome-magazine'),
        'add_new'               => __('Add New', 'rowhome-magazine'),
        'new_item'              => __('New Department', 'rowhome-magazine'),
        'edit_item'             => __('Edit Department', 'rowhome-magazine'),
        'update_item'           => __('Update Department', 'rowhome-magazine'),
        'view_item'             => __('View Department', 'rowhome-magazine'),
        'view_items'            => __('View Departments', 'rowhome-magazine'),
        'search_items'          => __('Search Department', 'rowhome-magazine'),
        'not_found'             => __('Not found', 'rowhome-magazine'),
        'not_found_in_trash'    => __('Not found in Trash', 'rowhome-magazine'),
    );

    $args = array(
        'label'                 => __('Department', 'rowhome-magazine'),
        'description'           => __('Magazine departments', 'rowhome-magazine'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments', 'revisions', 'custom-fields'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-layout',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('department', $args);
}
add_action('init', 'rowhome_magazine_register_departments', 0);

/**
 * Register Custom Taxonomy - Department Categories
 */
function rowhome_magazine_register_department_taxonomy() {
    $labels = array(
        'name'                       => _x('Department Categories', 'Taxonomy General Name', 'rowhome-magazine'),
        'singular_name'              => _x('Department Category', 'Taxonomy Singular Name', 'rowhome-magazine'),
        'menu_name'                  => __('Department Categories', 'rowhome-magazine'),
        'all_items'                  => __('All Categories', 'rowhome-magazine'),
        'parent_item'                => __('Parent Category', 'rowhome-magazine'),
        'parent_item_colon'          => __('Parent Category:', 'rowhome-magazine'),
        'new_item_name'              => __('New Category Name', 'rowhome-magazine'),
        'add_new_item'               => __('Add New Category', 'rowhome-magazine'),
        'edit_item'                  => __('Edit Category', 'rowhome-magazine'),
        'update_item'                => __('Update Category', 'rowhome-magazine'),
        'view_item'                  => __('View Category', 'rowhome-magazine'),
        'separate_items_with_commas' => __('Separate categories with commas', 'rowhome-magazine'),
        'add_or_remove_items'        => __('Add or remove categories', 'rowhome-magazine'),
        'choose_from_most_used'      => __('Choose from the most used', 'rowhome-magazine'),
        'popular_items'              => __('Popular Categories', 'rowhome-magazine'),
        'search_items'               => __('Search Categories', 'rowhome-magazine'),
        'not_found'                  => __('Not Found', 'rowhome-magazine'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('department_category', array('department', 'post'), $args);
}
add_action('init', 'rowhome_magazine_register_department_taxonomy', 0);

/**
 * Custom excerpt length
 */
function rowhome_magazine_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'rowhome_magazine_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function rowhome_magazine_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'rowhome_magazine_excerpt_more');

/**
 * Add custom body classes
 */
function rowhome_magazine_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }

    // Add class for homepage
    if (is_front_page()) {
        $classes[] = 'homepage';
    }

    return $classes;
}
add_filter('body_class', 'rowhome_magazine_body_classes');

/**
 * AJAX Newsletter Subscription Handler
 */
function rowhome_magazine_newsletter_subscribe() {
    check_ajax_referer('rowhome-nonce', 'nonce');

    $email = sanitize_email($_POST['email']);

    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    // Always save locally as a backup subscriber list
    $subscribers = get_option('rowhome_newsletter_subscribers', array());
    if (in_array($email, $subscribers)) {
        wp_send_json_error(array('message' => 'This email is already subscribed.'));
    }
    $subscribers[] = $email;
    update_option('rowhome_newsletter_subscribers', $subscribers);

    // Mailchimp integration — activate by defining MAILCHIMP_API_KEY and MAILCHIMP_LIST_ID in wp-config.php
    if (defined('MAILCHIMP_API_KEY') && defined('MAILCHIMP_LIST_ID') && MAILCHIMP_API_KEY) {
        $api_key    = MAILCHIMP_API_KEY;
        $list_id    = MAILCHIMP_LIST_ID;
        $data_center = substr($api_key, strpos($api_key, '-') + 1); // e.g. "us21"
        $url        = "https://{$data_center}.api.mailchimp.com/3.0/lists/{$list_id}/members";

        $response = wp_remote_post($url, array(
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode('anystring:' . $api_key),
                'Content-Type'  => 'application/json',
            ),
            'body'    => wp_json_encode(array(
                'email_address' => $email,
                'status'        => 'subscribed',
            )),
            'timeout' => 10,
        ));

        if (is_wp_error($response)) {
            // Log Mailchimp error but still return success (local save succeeded)
            error_log('Mailchimp subscribe error: ' . $response->get_error_message());
        }
    }

    wp_send_json_success(array('message' => 'Thank you for subscribing!'));
}
add_action('wp_ajax_newsletter_subscribe', 'rowhome_magazine_newsletter_subscribe');
add_action('wp_ajax_nopriv_newsletter_subscribe', 'rowhome_magazine_newsletter_subscribe');

/**
 * Load More Posts AJAX Handler
 */
function rowhome_magazine_load_more_posts() {
    check_ajax_referer('rowhome-nonce', 'nonce');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $department = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';

    $args = array(
        'post_type' => array('post', 'department'),
        'posts_per_page' => 12,
        'paged' => $paged,
    );

    if (!empty($department)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'department_category',
                'field' => 'slug',
                'terms' => $department,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'card');
        }
        $html = ob_get_clean();
        
        wp_send_json_success(array(
            'html' => $html,
            'max_pages' => $query->max_num_pages
        ));
    } else {
        wp_send_json_error(array('message' => 'No more posts found.'));
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_posts', 'rowhome_magazine_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'rowhome_magazine_load_more_posts');

/**
 * Add Schema Markup for Articles
 */
function rowhome_magazine_article_schema() {
    if (is_singular('post') || is_singular('department')) {
        global $post;
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_template_directory_uri() . '/assets/images/rowhome-logo.png',
                ),
            ),
        );

        $schema['url']         = get_permalink();
        $schema['description'] = has_excerpt( $post ) ? strip_tags( get_the_excerpt() ) : wp_trim_words( strip_tags( $post->post_content ), 30 );
        $schema['mainEntityOfPage'] = array(
            '@type' => 'WebPage',
            '@id'   => get_permalink(),
        );

        if (has_post_thumbnail()) {
            $schema['image'] = get_the_post_thumbnail_url(null, 'full');
        }

        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';
    }
}
add_action('wp_head', 'rowhome_magazine_article_schema');

/**
 * Include custom functions
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/custom-login.php';

/**
 * Add support for lazy loading images
 */
function rowhome_magazine_lazy_load_images($attr, $attachment, $size) {
    if (!isset($attr['loading']) || $attr['loading'] !== 'eager') {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'rowhome_magazine_lazy_load_images', 10, 3);

/**
 * Google AdSense Integration
 * 
 * Get your AdSense Publisher ID from: https://www.google.com/adsense/
 * Add it to wp-config.php: define('GOOGLE_ADSENSE_PUBLISHER_ID', 'ca-pub-XXXXXXXXXX');
 * Or set it in the theme customizer
 */

/**
 * Get Google AdSense Publisher ID
 */
function rowhome_magazine_get_adsense_publisher_id() {
    // Check wp-config.php first
    if (defined('GOOGLE_ADSENSE_PUBLISHER_ID')) {
        return GOOGLE_ADSENSE_PUBLISHER_ID;
    }
    
    // Check theme options
    $publisher_id = get_theme_mod('google_adsense_publisher_id', '');
    
    // Return default if empty (you can set a default for testing)
    return !empty($publisher_id) ? $publisher_id : '';
}

/**
 * Display Google AdSense Ad
 * 
 * @param string $ad_slot - The ad slot ID (e.g., '1234567890')
 * @param string $ad_format - The ad format: 'auto', 'horizontal', 'vertical', 'rectangle', 'square'
 * @param string $ad_size - The ad size: 'responsive', '728x90', '300x250', '300x600', etc.
 * @param string $ad_style - Additional CSS classes
 * @param bool $show_label - Whether to show "Advertisement" label
 */
function rowhome_magazine_display_adsense_ad($ad_slot = '', $ad_format = 'auto', $ad_size = 'responsive', $ad_style = '', $show_label = false) {
    $publisher_id = rowhome_magazine_get_adsense_publisher_id();
    
    // If no publisher ID or ad slot, show placeholder
    if (empty($publisher_id) || empty($ad_slot)) {
        $label_class = $show_label ? 'ad-banner-label' : '';
        $style_class = !empty($ad_style) ? ' ' . esc_attr($ad_style) : '';
        echo '<div class="ad-banner' . $style_class . '">';
        if ($show_label) {
            echo '<div class="' . $label_class . '">Web Banner</div>';
        }
        echo '</div>';
        return;
    }
    
    // Generate unique ID for this ad
    $ad_id = 'adsense-' . sanitize_html_class($ad_slot) . '-' . uniqid();
    
    // Determine ad size attributes
    $ad_size_attr = '';
    if ($ad_size === 'responsive') {
        $ad_size_attr = 'data-ad-format="' . esc_attr($ad_format) . '" data-full-width-responsive="true"';
    } else {
        $ad_size_attr = 'data-ad-format="' . esc_attr($ad_format) . '" data-ad-slot="' . esc_attr($ad_slot) . '"';
        // Parse size if provided as "WIDTHxHEIGHT"
        if (strpos($ad_size, 'x') !== false) {
            list($width, $height) = explode('x', $ad_size);
            $ad_size_attr .= ' style="display:inline-block;width:' . intval($width) . 'px;height:' . intval($height) . 'px;"';
        }
    }
    
    $style_class = !empty($ad_style) ? ' ' . esc_attr($ad_style) : '';
    $label_class = $show_label ? 'ad-banner-label' : '';
    
    // Output the ad
    echo '<div class="ad-banner adsense-container' . $style_class . '" id="' . esc_attr($ad_id) . '">';
    
    if ($show_label) {
        echo '<div class="' . $label_class . '">Advertisement</div>';
    }
    
    echo '<ins class="adsbygoogle"';
    echo ' style="display:block;"';
    echo ' data-ad-client="' . esc_attr($publisher_id) . '"';
    echo ' data-ad-slot="' . esc_attr($ad_slot) . '"';
    if ($ad_size === 'responsive') {
        echo ' data-ad-format="' . esc_attr($ad_format) . '"';
        echo ' data-full-width-responsive="true"';
    } else {
        echo ' data-ad-format="' . esc_attr($ad_format) . '"';
    }
    echo '></ins>';
    echo '<script>';
    echo '(adsbygoogle = window.adsbygoogle || []).push({});';
    echo '</script>';
    echo '</div>';
}

/**
 * Enqueue Google AdSense script in header
 */
function rowhome_magazine_adsense_script() {
    $publisher_id = rowhome_magazine_get_adsense_publisher_id();
    
    if (!empty($publisher_id)) {
        echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . esc_attr($publisher_id) . '" crossorigin="anonymous"></script>' . "\n";
    }
}
add_action('wp_head', 'rowhome_magazine_adsense_script', 5);

/**
 * AJAX handler for Section Landing Page - Load More
 */
function rowhome_magazine_section_load_more() {
    check_ajax_referer('rowhome-nonce', 'nonce');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 2;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = array(
        'post_type'      => array('post', 'department'),
        'posts_per_page' => 6,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if (!empty($category)) {
        // Try to find the term (with dept- prefix fallback)
        $term = get_term_by('slug', $category, 'department_category');
        if (!$term && strpos($category, 'dept-') !== 0) {
            $term = get_term_by('slug', 'dept-' . $category, 'department_category');
        }
        if ($term) {
            // Include sub-department terms (matches header nav structure)
            $section_children_map = array(
                'dept-life'      => array('dept-health', 'dept-fashion', 'dept-brides-guide', 'dept-community', 'dept-writers-block'),
                'dept-business'  => array('dept-real-estate', 'dept-tech', 'dept-education', 'dept-politics'),
                'dept-arts'      => array('dept-music-art', 'dept-film', 'dept-flashback', 'dept-history'),
                'dept-lifestyle' => array('dept-menu', 'dept-travel', 'dept-2025-hotspots', 'dept-events'),
            );
            $term_ids = array($term->term_id);
            if (isset($section_children_map[$term->slug])) {
                foreach ($section_children_map[$term->slug] as $child_slug) {
                    $child_term = get_term_by('slug', $child_slug, 'department_category');
                    if ($child_term) {
                        $term_ids[] = $child_term->term_id;
                    }
                }
            }
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'department_category',
                    'field'    => 'term_id',
                    'terms'    => $term_ids,
                ),
            );
        }
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content-article-card', null, array(
                'show_excerpt'   => true,
                'excerpt_length' => 15,
                'show_author'    => true,
            ));
        }
        $html = ob_get_clean();

        wp_send_json_success(array(
            'html'      => $html,
            'max_pages' => $query->max_num_pages,
        ));
    } else {
        wp_send_json_error(array('message' => 'No more articles found.'));
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_rowhome_section_load_more', 'rowhome_magazine_section_load_more');
add_action('wp_ajax_nopriv_rowhome_section_load_more', 'rowhome_magazine_section_load_more');

/**
 * Add Post Layout meta box
 * Allows editors to switch between 'feature' and 'blog' layouts for posts
 */
function rowhome_magazine_post_layout_meta_box() {
    add_meta_box(
        'post_layout',
        __('Post Layout', 'rowhome-magazine'),
        'rowhome_magazine_post_layout_callback',
        array('post', 'department'),
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'rowhome_magazine_post_layout_meta_box');

function rowhome_magazine_post_layout_callback($post) {
    wp_nonce_field('rowhome_post_layout', 'rowhome_post_layout_nonce');
    $layout = get_post_meta($post->ID, '_post_layout', true);
    ?>
    <p>
        <label>
            <input type="radio" name="post_layout" value="" <?php checked($layout, ''); checked($layout, false); ?>>
            <?php esc_html_e('Feature Article (default)', 'rowhome-magazine'); ?>
        </label>
    </p>
    <p>
        <label>
            <input type="radio" name="post_layout" value="blog" <?php checked($layout, 'blog'); ?>>
            <?php esc_html_e('Blog / Short-Form', 'rowhome-magazine'); ?>
        </label>
    </p>
    <p class="description"><?php esc_html_e('Feature: full-bleed hero, magazine layout. Blog: standard image, simpler layout.', 'rowhome-magazine'); ?></p>
    <?php
}

function rowhome_magazine_save_post_layout($post_id) {
    if (!isset($_POST['rowhome_post_layout_nonce']) || !wp_verify_nonce($_POST['rowhome_post_layout_nonce'], 'rowhome_post_layout')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $layout = isset($_POST['post_layout']) ? sanitize_text_field($_POST['post_layout']) : '';
    update_post_meta($post_id, '_post_layout', $layout);
}
add_action('save_post', 'rowhome_magazine_save_post_layout');

/**
 * Add custom body classes for templates
 */
function rowhome_magazine_template_body_classes($classes) {
    if (is_singular(array('post', 'department'))) {
        $layout = get_post_meta(get_the_ID(), '_post_layout', true);
        if ($layout === 'blog') {
            $classes[] = 'layout-blog';
        } else {
            $classes[] = 'layout-feature';
        }
    }

    if (is_singular('pictorial')) {
        $classes[] = 'layout-gallery';
    }

    if (is_page_template('template-section.php')) {
        $classes[] = 'layout-section';
    }

    return $classes;
}
add_filter('body_class', 'rowhome_magazine_template_body_classes');

/**
 * Auto-create required utility pages if they do not exist.
 * Runs once on admin_init; skips any page already present.
 * Pages: About, Contact, Privacy Policy, Terms of Use, Advertise With Us.
 */
function rowhome_magazine_create_required_pages() {
    if ( get_option( 'rowhome_pages_created' ) ) {
        return;
    }

    $pages = array(
        array(
            'title'    => 'About',
            'slug'     => 'about',
            'template' => 'template-about.php',
            'content'  => '',
        ),
        array(
            'title'    => 'Contact',
            'slug'     => 'contact',
            'template' => 'template-contact.php',
            'content'  => '',
        ),
        array(
            'title'    => 'Privacy Policy',
            'slug'     => 'privacy',
            'template' => 'template-privacy.php',
            'content'  => '',
        ),
        array(
            'title'    => 'Terms of Use',
            'slug'     => 'terms',
            'template' => 'template-terms.php',
            'content'  => '',
        ),
        array(
            'title'    => 'Advertise With Us',
            'slug'     => 'advertise',
            'template' => 'template-advertise.php',
            'content'  => '',
        ),
    );

    foreach ( $pages as $page ) {
        // Skip if a page with this slug already exists.
        $existing = get_page_by_path( $page['slug'] );
        if ( $existing ) {
            continue;
        }

        $page_id = wp_insert_post( array(
            'post_title'   => $page['title'],
            'post_name'    => $page['slug'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => $page['content'],
        ) );

        if ( $page_id && ! is_wp_error( $page_id ) && $page['template'] ) {
            update_post_meta( $page_id, '_wp_page_template', $page['template'] );
        }
    }

    update_option( 'rowhome_pages_created', true );
}
add_action( 'admin_init', 'rowhome_magazine_create_required_pages' );

/**
 * Auto-create primary and footer navigation menus if they don't exist.
 * Adds: Home, Subscribe, Issues, About, Contact to primary menu.
 * Adds: About, Contact, Advertise, Privacy, Terms to footer menu.
 */
function rowhome_magazine_create_default_menus() {
    if ( get_option( 'rowhome_menus_created' ) ) {
        return;
    }

    // Primary Menu
    $primary_menu_name = 'Primary Menu';
    $primary_menu_id   = wp_create_nav_menu( $primary_menu_name );

    if ( ! is_wp_error( $primary_menu_id ) ) {
        $primary_items = array(
            array( 'title' => 'Home',      'url' => home_url( '/' ) ),
            array( 'title' => 'Subscribe', 'url' => home_url( '/subscribe' ) ),
            array( 'title' => 'Issues',    'url' => home_url( '/issues' ) ),
            array( 'title' => 'About',     'url' => home_url( '/about' ) ),
            array( 'title' => 'Contact',   'url' => home_url( '/contact' ) ),
        );

        foreach ( $primary_items as $item ) {
            wp_update_nav_menu_item( $primary_menu_id, 0, array(
                'menu-item-title'  => $item['title'],
                'menu-item-url'    => $item['url'],
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom',
            ) );
        }

        // Assign to theme location
        $locations = get_theme_mod( 'nav_menu_locations', array() );
        $locations['primary'] = $primary_menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    // Footer Menu
    $footer_menu_name = 'Footer Menu';
    $footer_menu_id   = wp_create_nav_menu( $footer_menu_name );

    if ( ! is_wp_error( $footer_menu_id ) ) {
        $footer_items = array(
            array( 'title' => 'About Us',        'url' => home_url( '/about' ) ),
            array( 'title' => 'Contact Us',       'url' => home_url( '/contact' ) ),
            array( 'title' => 'Advertise With Us','url' => home_url( '/advertise' ) ),
            array( 'title' => 'Privacy Policy',   'url' => home_url( '/privacy' ) ),
            array( 'title' => 'Terms of Use',     'url' => home_url( '/terms' ) ),
        );

        foreach ( $footer_items as $item ) {
            wp_update_nav_menu_item( $footer_menu_id, 0, array(
                'menu-item-title'  => $item['title'],
                'menu-item-url'    => $item['url'],
                'menu-item-status' => 'publish',
                'menu-item-type'   => 'custom',
            ) );
        }

        $locations          = get_theme_mod( 'nav_menu_locations', array() );
        $locations['footer'] = $footer_menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    update_option( 'rowhome_menus_created', true );
}
add_action( 'admin_init', 'rowhome_magazine_create_default_menus' );

/**
 * Output favicon links in <head>
 */
function rowhome_magazine_favicon() {
    $uri = get_template_directory_uri();
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( $uri . '/assets/images/favicon.svg' ) . '">' . "\n";
    echo '<link rel="alternate icon" href="' . esc_url( $uri . '/assets/images/favicon.svg' ) . '">' . "\n";
    echo '<meta name="theme-color" content="#000000">' . "\n";
}
add_action( 'wp_head', 'rowhome_magazine_favicon', 1 );

/**
 * Output SEO meta tags and Open Graph / Twitter Card tags
 */
function rowhome_magazine_seo_meta() {
    // Skip if Yoast SEO is active — it handles these
    if ( defined( 'WPSEO_VERSION' ) ) {
        return;
    }

    global $post;

    $site_name    = get_bloginfo( 'name' );
    $site_desc    = get_bloginfo( 'description' );
    if ( empty( $site_desc ) ) {
        $site_desc = 'Philadelphia\'s neighborhood magazine covering life, business, arts, food, real estate, and culture. River to River. One Neighborhood.';
    }
    $http_host    = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '';
    $request_uri  = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';
    $current_url  = ( is_ssl() ? 'https' : 'http' ) . '://' . $http_host . $request_uri;
    $og_type      = 'website';
    $title        = '';
    $description  = '';
    $image        = get_template_directory_uri() . '/assets/images/rowhome-logo.png';

    if ( is_singular() && $post ) {
        $og_type     = 'article';
        $title       = get_the_title( $post );
        $description = has_excerpt( $post ) ? strip_tags( get_the_excerpt() ) : wp_trim_words( strip_tags( $post->post_content ), 30 );

        // Section landing pages — use taxonomy description if available
        $page_template = get_page_template_slug( $post );
        if ( 'template-section.php' === $page_template ) {
            $og_type      = 'website';
            $section_slug = get_post_meta( $post->ID, '_section_category', true );
            if ( ! $section_slug ) {
                $section_slug = $post->post_name;
            }
            $section_term = get_term_by( 'slug', $section_slug, 'department_category' );
            if ( ! $section_term && strpos( $section_slug, 'dept-' ) !== 0 ) {
                $section_term = get_term_by( 'slug', 'dept-' . $section_slug, 'department_category' );
            }
            if ( $section_term && $section_term->description ) {
                $description = $section_term->description;
            }
        }

        if ( has_post_thumbnail( $post ) ) {
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'rowhome-hero' );
            if ( $thumb ) {
                $image = $thumb[0];
            }
        }
    } elseif ( is_home() || is_front_page() ) {
        $title       = $site_name;
        $description = $site_desc;
    } elseif ( is_archive() ) {
        $title       = get_the_archive_title();
        $description = get_the_archive_description() ?: $site_desc;
    } elseif ( is_search() ) {
        $title       = sprintf( 'Search results for "%s"', get_search_query() );
        $description = $site_desc;
    } else {
        $title       = $site_name;
        $description = $site_desc;
    }

    $title       = esc_attr( $title );
    $description = esc_attr( wp_strip_all_tags( $description ) );
    $image       = esc_url( $image );
    $current_url = esc_url( $current_url );

    if ( $description ) {
        echo '<meta name="description" content="' . $description . '">' . "\n";
    }

    // Open Graph
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
    echo '<meta property="og:title" content="' . $title . '">' . "\n";
    echo '<meta property="og:description" content="' . $description . '">' . "\n";
    echo '<meta property="og:url" content="' . $current_url . '">' . "\n";
    echo '<meta property="og:image" content="' . $image . '">' . "\n";
    echo '<meta property="og:image:width" content="1400">' . "\n";
    echo '<meta property="og:image:height" content="700">' . "\n";

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . $title . '">' . "\n";
    echo '<meta name="twitter:description" content="' . $description . '">' . "\n";
    echo '<meta name="twitter:image" content="' . $image . '">' . "\n";

    // Canonical URL
    if ( is_singular() && $post ) {
        echo '<link rel="canonical" href="' . esc_url( get_permalink( $post ) ) . '">' . "\n";
    } elseif ( is_home() || is_front_page() ) {
        echo '<link rel="canonical" href="' . esc_url( home_url( '/' ) ) . '">' . "\n";
    } elseif ( is_category() || is_tag() || is_tax() ) {
        $term_link = get_term_link( get_queried_object() );
        if ( ! is_wp_error( $term_link ) ) {
            echo '<link rel="canonical" href="' . esc_url( $term_link ) . '">' . "\n";
        }
    } elseif ( is_post_type_archive() ) {
        echo '<link rel="canonical" href="' . esc_url( get_post_type_archive_link( get_queried_object()->name ) ) . '">' . "\n";
    } elseif ( is_author() ) {
        echo '<link rel="canonical" href="' . esc_url( get_author_posts_url( get_queried_object_id() ) ) . '">' . "\n";
    } elseif ( is_search() ) {
        echo '<link rel="canonical" href="' . esc_url( get_search_link( get_search_query() ) ) . '">' . "\n";
    }

    // Article-specific OG tags for publish time
    if ( is_singular() && $post ) {
        echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c', $post ) ) . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c', $post ) ) . '">' . "\n";
        $categories = get_the_category( $post->ID );
        if ( $categories ) {
            echo '<meta property="article:section" content="' . esc_attr( $categories[0]->name ) . '">' . "\n";
        }
    }
}
add_action( 'wp_head', 'rowhome_magazine_seo_meta', 2 );

/**
 * LocalBusiness + Magazine schema for About and Contact pages
 */
function rowhome_magazine_local_business_schema() {
    if ( ! is_page() ) {
        return;
    }
    $template = get_page_template_slug();
    if ( ! in_array( $template, array( 'template-about.php', 'template-contact.php' ), true ) ) {
        return;
    }
    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => array( 'LocalBusiness', 'NewsMediaOrganization' ),
        'name'            => 'Philadelphia RowHome Magazine',
        'url'             => home_url( '/' ),
        'logo'            => get_template_directory_uri() . '/assets/images/rowhome-logo.png',
        'description'     => 'Philadelphia\'s neighborhood magazine covering row home architecture, renovation, neighborhood guides, history, and lifestyle.',
        'address'         => array(
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Philadelphia',
            'addressRegion'   => 'PA',
            'addressCountry'  => 'US',
        ),
        'areaServed'      => array(
            '@type' => 'City',
            'name'  => 'Philadelphia',
        ),
        'sameAs'          => array(
            'https://www.instagram.com/phillyrowhome',
            'https://www.facebook.com/phillyrowhomemagazine',
        ),
    );
    echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'rowhome_magazine_local_business_schema', 3 );

/**
 * SEO-optimized document titles via title-tag
 */
function rowhome_magazine_document_title_parts( $title ) {
    if ( is_front_page() ) {
        $title['title']   = get_bloginfo( 'name' );
        $title['tagline'] = get_bloginfo( 'description' ) ?: 'Philadelphia\'s Neighborhood Magazine';
    }
    if ( is_singular( 'pictorial' ) ) {
        $title['title'] = get_the_title() . ' — Photo Gallery';
    }
    if ( is_search() ) {
        $title['title'] = sprintf( 'Search results for "%s"', get_search_query() );
    }
    return $title;
}
add_filter( 'document_title_parts', 'rowhome_magazine_document_title_parts' );

/**
 * Custom document title separator
 */
function rowhome_magazine_document_title_separator() {
    return '—';
}
add_filter( 'document_title_separator', 'rowhome_magazine_document_title_separator' );

/**
 * Pictorial (ImageGallery) JSON-LD schema for single pictorial posts
 */
function rowhome_magazine_pictorial_schema() {
    if ( ! is_singular( 'pictorial' ) ) {
        return;
    }
    global $post;

    $images      = array();
    $gallery_ids = get_post_meta( $post->ID, '_pictorial_gallery', true );
    if ( ! empty( $gallery_ids ) && is_array( $gallery_ids ) ) {
        foreach ( $gallery_ids as $img_id ) {
            $url = wp_get_attachment_url( $img_id );
            if ( $url ) {
                $images[] = $url;
            }
        }
    }
    if ( has_post_thumbnail( $post ) ) {
        $thumb_url = get_the_post_thumbnail_url( $post, 'full' );
        if ( $thumb_url && ! in_array( $thumb_url, $images, true ) ) {
            array_unshift( $images, $thumb_url );
        }
    }

    $photographer = get_post_meta( $post->ID, '_pictorial_photographer', true );
    $location     = get_post_meta( $post->ID, '_pictorial_location', true );

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'ImageGallery',
        'name'            => get_the_title( $post ),
        'description'     => has_excerpt( $post ) ? wp_strip_all_tags( get_the_excerpt() ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 30 ),
        'url'             => get_permalink( $post ),
        'datePublished'   => get_the_date( 'c', $post ),
        'dateModified'    => get_the_modified_date( 'c', $post ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id'   => get_permalink( $post ),
        ),
        'publisher'       => array(
            '@type' => 'Organization',
            'name'  => get_bloginfo( 'name' ),
            'logo'  => array(
                '@type' => 'ImageObject',
                'url'   => get_template_directory_uri() . '/assets/images/rowhome-logo.png',
            ),
        ),
    );

    if ( $photographer ) {
        $schema['author'] = array(
            '@type' => 'Person',
            'name'  => $photographer,
        );
    }
    if ( $location ) {
        $schema['contentLocation'] = array(
            '@type' => 'Place',
            'name'  => $location,
        );
    }
    if ( ! empty( $images ) ) {
        $schema['image'] = $images;
    }

    echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'rowhome_magazine_pictorial_schema', 4 );

/**
 * Add sitemap URL to robots.txt
 */
function rowhome_magazine_robots_txt( $output, $public ) {
    if ( '0' === $public ) {
        return $output;
    }
    $sitemap_url = home_url( '/wp-sitemap.xml' );
    if ( strpos( $output, 'Sitemap:' ) === false ) {
        $output .= "\nSitemap: " . esc_url( $sitemap_url ) . "\n";
    }
    return $output;
}
add_filter( 'robots_txt', 'rowhome_magazine_robots_txt', 10, 2 );

/**
 * Ensure pictorial CPT and department CPT appear in WordPress built-in sitemap
 */
function rowhome_magazine_sitemap_post_types( $post_types ) {
    if ( ! isset( $post_types['pictorial'] ) ) {
        $pictorial = get_post_type_object( 'pictorial' );
        if ( $pictorial ) {
            $post_types['pictorial'] = $pictorial;
        }
    }
    if ( ! isset( $post_types['department'] ) ) {
        $department = get_post_type_object( 'department' );
        if ( $department ) {
            $post_types['department'] = $department;
        }
    }
    return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'rowhome_magazine_sitemap_post_types' );

/**
 * Include department_category and gallery_category taxonomies in sitemap
 */
function rowhome_magazine_sitemap_taxonomies( $taxonomies ) {
    if ( ! isset( $taxonomies['department_category'] ) ) {
        $dept_tax = get_taxonomy( 'department_category' );
        if ( $dept_tax ) {
            $taxonomies['department_category'] = $dept_tax;
        }
    }
    if ( ! isset( $taxonomies['gallery_category'] ) ) {
        $gal_tax = get_taxonomy( 'gallery_category' );
        if ( $gal_tax ) {
            $taxonomies['gallery_category'] = $gal_tax;
        }
    }
    return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'rowhome_magazine_sitemap_taxonomies' );
