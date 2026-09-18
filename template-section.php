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

set_query_var( 'rh_section_term', $section_term ? $section_term : false );
get_template_part( 'template-parts/section-landing' );

get_footer();
