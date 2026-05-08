<?php
/**
 * Custom template tags for this theme
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display department badge
 */
function rowhome_magazine_department_badge() {
    $departments = get_the_terms(get_the_ID(), 'department_category');
    
    if ($departments && !is_wp_error($departments)) {
        $department = array_shift($departments);
        echo '<span class="article-category">' . esc_html($department->name) . '</span>';
    }
}

/**
 * Display article meta information
 */
function rowhome_magazine_article_meta() {
    echo '<div class="article-meta">';
    $author_name = get_the_author() ?: 'RowHome Staff';
    echo 'by <span class="article-author">' . esc_html($author_name) . '</span>';
    echo ' | ' . get_the_date();
    echo '</div>';
}

/**
 * Display social share buttons
 */
function rowhome_magazine_social_share() {
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    
    echo '<div class="social-share">';
    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" rel="noopener" class="share-facebook">Facebook</a>';
    echo '<a href="https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title . '" target="_blank" rel="noopener" class="share-twitter">Twitter</a>';
    echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '" target="_blank" rel="noopener" class="share-linkedin">LinkedIn</a>';
    echo '</div>';
}

/**
 * Get department articles
 */
function rowhome_magazine_get_department_articles($department_slug, $limit = 4) {
    $args = array(
        'post_type' => array('post', 'department'),
        'posts_per_page' => $limit,
        'tax_query' => array(
            array(
                'taxonomy' => 'department_category',
                'field' => 'slug',
                'terms' => $department_slug,
            ),
        ),
    );
    
    return new WP_Query($args);
}

/**
 * Display breadcrumbs
 */
function rowhome_magazine_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<a href="' . home_url('/') . '">Home</a>';
    
    if (is_category() || is_single()) {
        echo ' / ';
        the_category(' / ');
        
        if (is_single()) {
            echo ' / ';
            the_title();
        }
    } elseif (is_page()) {
        echo ' / ';
        the_title();
    }
    
    echo '</nav>';
}

/**
 * Get related articles
 */
function rowhome_magazine_related_articles($post_id, $limit = 3) {
    $departments = wp_get_post_terms($post_id, 'department_category', array('fields' => 'ids'));
    
    if (empty($departments)) {
        return null;
    }
    
    $args = array(
        'post_type' => array('post', 'department'),
        'posts_per_page' => $limit,
        'post__not_in' => array($post_id),
        'tax_query' => array(
            array(
                'taxonomy' => 'department_category',
                'field' => 'term_id',
                'terms' => $departments,
            ),
        ),
    );
    
    return new WP_Query($args);
}

/**
 * Display post reading time
 */
function rowhome_magazine_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
    
    echo '<span class="reading-time">' . $reading_time . ' min read</span>';
}

