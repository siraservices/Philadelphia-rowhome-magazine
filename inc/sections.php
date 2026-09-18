<?php
/**
 * Editorial sections — Omar's 25 magazine sections as the canonical list.
 *
 * - rowhome_sections()            canonical list (name, slug, taxonomy, notes)
 * - rowhome_magazine_seed_sections()  creates missing terms + landing pages (versioned, admin_init)
 * - rowhome_departments() ordering + rowhome_dept_url() use this list.
 *
 * @package RowHome_Magazine
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Omar's section list in magazine order.
 *
 * type: 'dept' => department_category term (+ landing page), 'gallery' => gallery_category term.
 * page: slug of the Section Landing page to create for dept sections (bare, no dept- prefix).
 */
function rowhome_sections() {
    return array(
        array( 'name' => 'From the Publisher', 'slug' => 'dept-from-the-publisher', 'type' => 'dept',    'page' => 'from-the-publisher' ),
        array( 'name' => 'MailBox',            'slug' => 'dept-mailbox',            'type' => 'dept',    'page' => 'mailbox' ),
        array( 'name' => 'Neighborhood Noir',  'slug' => 'gallery-neighborhood-noir','type' => 'gallery' ),
        array( 'name' => 'Hanging Out',        'slug' => 'gallery-hanging-out',     'type' => 'gallery' ),
        array( 'name' => 'Life',               'slug' => 'dept-life',               'type' => 'dept',    'page' => 'life',        'label' => 'PRH Life' ),
        array( 'name' => 'Real Estate',        'slug' => 'dept-real-estate',        'type' => 'dept',    'page' => 'real-estate', 'label' => 'PRH Real Estate' ),
        array( 'name' => "Contractor's Guide", 'slug' => 'dept-contractors-guide',  'type' => 'dept',    'page' => 'contractors-guide' ),
        array( 'name' => 'Business',           'slug' => 'dept-business',           'type' => 'dept',    'page' => 'business' ),
        array( 'name' => 'Menu',               'slug' => 'dept-menu',               'type' => 'dept',    'page' => 'menu',        'label' => 'The Menu' ),
        array( 'name' => 'Salute to Service',  'slug' => 'dept-salute-to-service',  'type' => 'dept',    'page' => 'salute-to-service' ),
        array( 'name' => 'On the Corner',      'slug' => 'dept-on-the-corner',      'type' => 'dept',    'page' => 'on-the-corner' ),
        array( 'name' => 'On the Water Front', 'slug' => 'dept-on-the-waterfront',  'type' => 'dept',    'page' => 'on-the-waterfront' ),
        array( 'name' => 'Hot Spots',          'slug' => 'dept-2025-hotspots',      'type' => 'dept',    'page' => 'hotspots' ),
        array( 'name' => 'Tip From the Pro',   'slug' => 'dept-tip-from-the-pro',   'type' => 'dept',    'page' => 'tip-from-the-pro' ),
        array( 'name' => 'Brides Guide',       'slug' => 'dept-brides-guide',       'type' => 'dept',    'page' => 'brides-guide' ),
        array( 'name' => 'Brides Guide',       'slug' => 'gallery-brides-guide',    'type' => 'gallery' ),
        array( 'name' => 'Health',             'slug' => 'dept-health',             'type' => 'dept',    'page' => 'health' ),
        array( 'name' => 'Music & Art',        'slug' => 'dept-music-art',          'type' => 'dept',    'page' => 'music-art',   'label' => 'Music' ),
        array( 'name' => 'Fashion',            'slug' => 'dept-fashion',            'type' => 'dept',    'page' => 'fashion' ),
        array( 'name' => 'Fashion',            'slug' => 'gallery-fashion',         'type' => 'gallery' ),
        array( 'name' => 'Green Spaces',       'slug' => 'dept-green-spaces',       'type' => 'dept',    'page' => 'green-spaces' ),
        array( 'name' => 'Travel',             'slug' => 'dept-travel',             'type' => 'dept',    'page' => 'travel' ),
        array( 'name' => 'Sports',             'slug' => 'dept-sports',             'type' => 'dept',    'page' => 'sports',      'label' => 'Sport' ),
        array( 'name' => 'School Yard',        'slug' => 'dept-school-yard',        'type' => 'dept',    'page' => 'school-yard' ),
        array( 'name' => 'Writers Block',      'slug' => 'dept-writers-block',      'type' => 'dept',    'page' => 'writers-block', 'label' => "Writer's Block" ),
        array( 'name' => 'Business Network',   'slug' => 'dept-business-network',   'type' => 'dept',    'page' => 'business-network' ), // future classifieds CPT
        array( 'name' => 'Pressed',            'slug' => 'dept-pressed',            'type' => 'dept',    'page' => 'pressed' ),
    );
}

/**
 * Create missing section terms and landing pages. Runs once per version on admin_init.
 * Never renames or deletes existing terms.
 */
function rowhome_magazine_seed_sections() {
    if ( (int) get_option( 'rowhome_sections_version', 0 ) >= 1 ) {
        return;
    }
    if ( ! taxonomy_exists( 'department_category' ) ) {
        return; // taxonomies register on init; admin_init runs after, but be safe.
    }

    foreach ( rowhome_sections() as $s ) {
        $tax = $s['type'] === 'gallery' ? 'gallery_category' : 'department_category';
        if ( $tax === 'gallery_category' && ! taxonomy_exists( 'gallery_category' ) ) {
            continue;
        }

        // Term.
        if ( ! term_exists( $s['slug'], $tax ) ) {
            wp_insert_term( $s['name'], $tax, array( 'slug' => $s['slug'] ) );
        }

        // Landing page (dept sections only).
        if ( $s['type'] === 'dept' && ! empty( $s['page'] ) ) {
            $existing = get_posts( array( 'post_type' => 'page', 'name' => $s['page'], 'post_status' => 'any', 'posts_per_page' => 1 ) );
            if ( ! $existing ) {
                $page_id = wp_insert_post( array(
                    'post_title'   => $s['name'],
                    'post_name'    => $s['page'],
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                    'post_content' => '',
                ) );
                if ( $page_id && ! is_wp_error( $page_id ) ) {
                    update_post_meta( $page_id, '_wp_page_template', 'template-section.php' );
                    update_post_meta( $page_id, '_section_category', $s['slug'] );
                }
            } else {
                // Make sure an existing page with this slug resolves to the right term.
                $pid = $existing[0]->ID;
                if ( get_post_meta( $pid, '_wp_page_template', true ) === 'template-section.php' && ! get_post_meta( $pid, '_section_category', true ) ) {
                    update_post_meta( $pid, '_section_category', $s['slug'] );
                }
            }
        }
    }

    update_option( 'rowhome_sections_version', 1 );
}
add_action( 'admin_init', 'rowhome_magazine_seed_sections' );

/**
 * Landing URL for a department: the Section Landing page when one exists
 * (e.g. /life/), otherwise the term archive (taxonomy-department_category.php).
 */
function rowhome_dept_url( $slug ) {
    static $cache = array();
    if ( isset( $cache[ $slug ] ) ) {
        return $cache[ $slug ];
    }

    $url = '';
    foreach ( rowhome_sections() as $s ) {
        if ( $s['slug'] === $slug && ! empty( $s['page'] ) ) {
            $pages = get_posts( array( 'post_type' => 'page', 'name' => $s['page'], 'post_status' => 'publish', 'posts_per_page' => 1 ) );
            if ( $pages ) {
                $url = get_permalink( $pages[0] );
            }
            break;
        }
    }
    if ( ! $url ) {
        // Legacy convention: page slug == term slug without the dept- prefix.
        $bare  = preg_replace( '/^dept-/', '', $slug );
        $pages = get_posts( array( 'post_type' => 'page', 'name' => $bare, 'post_status' => 'publish', 'posts_per_page' => 1 ) );
        if ( $pages && get_post_meta( $pages[0]->ID, '_wp_page_template', true ) === 'template-section.php' ) {
            $url = get_permalink( $pages[0] );
        }
    }
    if ( ! $url ) {
        $term = get_term_by( 'slug', $slug, 'department_category' );
        if ( $term && ! is_wp_error( $term ) ) {
            $link = get_term_link( $term );
            if ( ! is_wp_error( $link ) ) {
                $url = $link;
            }
        }
    }
    if ( ! $url ) {
        $url = home_url( '/department_category/' . $slug . '/' );
    }

    $cache[ $slug ] = $url;
    return $url;
}

/**
 * Departments for the Discover panel: Omar's order first, then any other live terms A–Z.
 *
 * @return array[] { name, slug, url }
 */
function rowhome_departments() {
    static $cache = null;
    if ( $cache !== null ) {
        return $cache;
    }

    $terms = get_terms( array( 'taxonomy' => 'department_category', 'hide_empty' => false ) );
    $by_slug = array();
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $t ) {
            $by_slug[ $t->slug ] = $t;
        }
    }

    $out  = array();
    $seen = array();
    foreach ( rowhome_sections() as $s ) {
        if ( $s['type'] !== 'dept' ) {
            continue;
        }
        $name = isset( $s['label'] ) ? $s['label'] : $s['name'];
        if ( isset( $by_slug[ $s['slug'] ] ) ) {
            $out[] = array( 'name' => $name, 'slug' => $s['slug'], 'url' => rowhome_dept_url( $s['slug'] ) );
            $seen[ $s['slug'] ] = true;
        } elseif ( empty( $by_slug ) ) {
            // No terms at all (fresh install): still show the canonical list.
            $out[] = array( 'name' => $name, 'slug' => $s['slug'], 'url' => rowhome_dept_url( $s['slug'] ) );
        }
    }
    // Any remaining live terms not in Omar's list.
    $rest = array();
    foreach ( $by_slug as $slug => $t ) {
        if ( ! isset( $seen[ $slug ] ) ) {
            $rest[] = array( 'name' => $t->name, 'slug' => $slug, 'url' => rowhome_dept_url( $slug ) );
        }
    }
    usort( $rest, function ( $a, $b ) { return strcasecmp( $a['name'], $b['name'] ); } );

    $cache = array_merge( $out, $rest );
    return $cache;
}
