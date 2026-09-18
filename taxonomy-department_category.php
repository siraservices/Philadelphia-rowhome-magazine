<?php
/**
 * Department archive — every department_category term gets the same section
 * landing layout as the page-based sections (/life/, /business/ ...).
 *
 * @package RowHome_Magazine
 * @since 2.1.0
 */

get_header();

$term = get_queried_object();
set_query_var( 'rh_section_term', ( $term instanceof WP_Term ) ? $term : false );
get_template_part( 'template-parts/section-landing' );

get_footer();
