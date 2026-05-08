<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments
 */
function rowhome_magazine_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'rowhome_magazine_pingback_header');

/**
 * Customize the [...] on the_excerpt()
 */
function rowhome_magazine_new_excerpt_more($more) {
    if (!is_admin()) {
        global $post;
        return '... <a class="read-more" href="' . get_permalink($post->ID) . '">Read More</a>';
    }
}
add_filter('excerpt_more', 'rowhome_magazine_new_excerpt_more');

/**
 * Add custom classes to navigation menu items
 */
function rowhome_magazine_nav_menu_css_class($classes, $item, $args, $depth) {
    if ($args->theme_location == 'department') {
        $classes[] = 'department-menu-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'rowhome_magazine_nav_menu_css_class', 10, 4);

/**
 * Modify the main query for homepage
 */
function rowhome_magazine_home_query($query) {
    if ($query->is_home() && $query->is_main_query() && !is_admin()) {
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'rowhome_magazine_home_query');

/**
 * Add async/defer attributes to enqueued scripts
 */
function rowhome_magazine_script_loader_tag($tag, $handle) {
    if ('rowhome-magazine-scripts' === $handle) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'rowhome_magazine_script_loader_tag', 10, 2);

/**
 * Remove unnecessary WordPress head items
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/**
 * Optimize WordPress queries
 */
function rowhome_magazine_optimize_queries() {
    if (is_admin()) {
        return;
    }
    
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'rowhome_magazine_optimize_queries');

/**
 * Add preconnect for Google Fonts
 */
function rowhome_magazine_resource_hints($urls, $relation_type) {
    if (wp_style_is('rowhome-google-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'rowhome_magazine_resource_hints', 10, 2);

