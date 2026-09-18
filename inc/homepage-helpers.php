<?php
/**
 * Homepage helpers — department queries, cards, ribbons, ads, section chrome.
 *
 * Everything on front-page.php renders through these so the wireframe
 * rules (ribbon = real category, byline fallback, gray placeholders)
 * are enforced in one place.
 *
 * @package RowHome_Magazine
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ------------------------------------------------------------------
 * Queries
 * ---------------------------------------------------------------- */

/**
 * Get posts for one or more department_category slugs.
 *
 * @param string|array $slugs   e.g. 'dept-life' or array('dept-life','dept-flashback')
 * @param int          $limit
 * @param array        $exclude Post IDs to exclude (avoid repeating the hero).
 * @return WP_Post[]
 */
function rowhome_dept_posts( $slugs, $limit = 3, $exclude = array() ) {
    $args = array(
        'posts_per_page'      => (int) $limit,
        'post_type'           => array( 'post', 'department' ),
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'tax_query'           => array(
            array(
                'taxonomy' => 'department_category',
                'field'    => 'slug',
                'terms'    => (array) $slugs,
            ),
        ),
    );
    if ( ! empty( $exclude ) ) {
        $args['post__not_in'] = array_map( 'intval', (array) $exclude );
    }
    $q = new WP_Query( $args );
    return $q->posts;
}

/**
 * Cover story: sticky post first, otherwise the latest post.
 *
 * @return WP_Post|null
 */
function rowhome_cover_post() {
    $sticky = get_option( 'sticky_posts' );
    if ( ! empty( $sticky ) ) {
        $q = new WP_Query( array(
            'posts_per_page'      => 1,
            'post__in'            => $sticky,
            'post_type'           => array( 'post', 'department' ),
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => true,
        ) );
        if ( $q->have_posts() ) {
            return $q->posts[0];
        }
    }
    $q = new WP_Query( array(
        'posts_per_page'      => 1,
        'post_type'           => array( 'post', 'department' ),
        'ignore_sticky_posts' => 1,
        'no_found_rows'       => true,
    ) );
    return $q->have_posts() ? $q->posts[0] : null;
}

/* ------------------------------------------------------------------
 * Ribbons, bylines, placeholders
 * ---------------------------------------------------------------- */

/**
 * Human label for a department slug ("dept-2025-hotspots" -> "HOT SPOTS").
 */
function rowhome_dept_label_from_slug( $slug ) {
    $map = array(
        'dept-2025-hotspots' => 'HOT SPOTS',
        'dept-hotspots'      => 'HOT SPOTS',
        'dept-music-art'     => 'MUSIC',
        'dept-writers-block' => 'WRITERS BLOCK',
        'dept-brides-guide'  => 'BRIDES GUIDE',
        'dept-real-estate'   => 'REAL ESTATE',
    );
    if ( isset( $map[ $slug ] ) ) {
        return $map[ $slug ];
    }
    $term = get_term_by( 'slug', $slug, 'department_category' );
    if ( $term ) {
        return strtoupper( $term->name );
    }
    return strtoupper( str_replace( array( 'dept-', '-' ), array( '', ' ' ), $slug ) );
}

/**
 * Ribbon label for a post — reflects the post's REAL department term.
 *
 * @param int|WP_Post $post
 * @param string      $default  Label when the post has no department term.
 * @param array       $prefer   Slugs to prefer if the post has several terms.
 * @return array { label: string, slug: string }
 */
function rowhome_ribbon_for_post( $post, $default = '', $prefer = array() ) {
    $post_id = $post instanceof WP_Post ? $post->ID : (int) $post;
    $terms   = $post_id ? get_the_terms( $post_id, 'department_category' ) : array();
    $slug    = '';
    $label   = $default;

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        $chosen = null;
        if ( ! empty( $prefer ) ) {
            foreach ( $terms as $t ) {
                if ( in_array( $t->slug, (array) $prefer, true ) ) {
                    $chosen = $t;
                    break;
                }
            }
        }
        if ( ! $chosen ) {
            // Skip parent "umbrella" terms when a child is present.
            foreach ( $terms as $t ) {
                if ( $t->parent ) { $chosen = $t; break; }
            }
        }
        if ( ! $chosen ) {
            $chosen = $terms[0];
        }
        $slug  = $chosen->slug;
        $label = rowhome_dept_label_from_slug( $slug );
    }

    return array( 'label' => $label, 'slug' => $slug );
}

/**
 * Ribbon color modifier class from a department slug.
 */
function rowhome_ribbon_class( $slug ) {
    if ( strpos( $slug, 'menu' ) !== false ) {
        return 'rh-ribbon--green';
    }
    if ( strpos( $slug, 'real-estate' ) !== false ) {
        return 'rh-ribbon--sage';
    }
    return '';
}

/**
 * "by AUTHOR" with fallback. Returns plain text (already escaped).
 */
function rowhome_byline_text( $post = null, $prefix = 'by ' ) {
    $name = '';
    if ( $post ) {
        $post_id = $post instanceof WP_Post ? $post->ID : (int) $post;
        $custom  = get_post_meta( $post_id, '_rowhome_byline', true );
        if ( $custom ) {
            $name = $custom;
        } else {
            $author_id = (int) get_post_field( 'post_author', $post_id );
            $name      = $author_id ? get_the_author_meta( 'display_name', $author_id ) : '';
        }
    }
    $name = trim( (string) $name );
    if ( $name === '' || strtolower( $name ) === 'admin' ) {
        $name = 'RowHome Staff';
    }
    return esc_html( $prefix . $name );
}

/**
 * Avatar markup (circular). Falls back to a gray disc.
 */
function rowhome_avatar_html( $post = null, $size = 56 ) {
    if ( $post ) {
        $post_id   = $post instanceof WP_Post ? $post->ID : (int) $post;
        $author_id = (int) get_post_field( 'post_author', $post_id );
        if ( $author_id ) {
            $av = get_avatar( $author_id, $size, '', '', array( 'class' => 'rh-avatar__img', 'loading' => 'lazy' ) );
            if ( $av ) {
                return '<span class="rh-avatar">' . $av . '</span>';
            }
        }
    }
    return '<span class="rh-avatar rh-avatar--empty" aria-hidden="true"></span>';
}

/**
 * Gray image placeholder (wireframe style) — no external requests.
 */
function rowhome_placeholder_html( $label = '', $ratio = '4/3' ) {
    return '<div class="rh-ph" style="--rh-ph-ratio:' . esc_attr( $ratio ) . '" role="img" aria-label="' . esc_attr( $label ? $label . ' image' : 'Image' ) . '">'
        . '<svg viewBox="0 0 120 120" class="rh-ph__icon" aria-hidden="true"><rect x="10" y="26" width="76" height="76" rx="12" ry="12"/><circle cx="92" cy="30" r="20"/><path d="M14 92 L44 64 L62 80 L86 56"/></svg>'
        . '</div>';
}

/**
 * Post image or placeholder.
 */
function rowhome_post_image_html( $post = null, $size = 'rowhome-article-card', $label = '', $ratio = '4/3' ) {
    if ( $post && has_post_thumbnail( $post ) ) {
        $img = get_the_post_thumbnail( $post, $size, array( 'class' => 'rh-img', 'loading' => 'lazy' ) );
        return '<div class="rh-img-wrap" style="--rh-ph-ratio:' . esc_attr( $ratio ) . '">' . $img . '</div>';
    }
    return rowhome_placeholder_html( $label, $ratio );
}

/**
 * Text placeholder bars (wireframe gray lines).
 */
function rowhome_text_bars_html( $lines = 3, $class = '' ) {
    $out = '<div class="rh-bars ' . esc_attr( $class ) . '" aria-hidden="true">';
    for ( $i = 0; $i < $lines; $i++ ) {
        $out .= '<span class="rh-bar"></span>';
    }
    return $out . '</div>';
}

/* ------------------------------------------------------------------
 * Cards
 * ---------------------------------------------------------------- */

/**
 * Render one article card.
 *
 * @param array $a {
 *   @type WP_Post|null $post       Null renders a placeholder card.
 *   @type string       $variant    'stack' (default) | 'wide' | 'thumb' | 'menu'
 *   @type string       $ribbon     Label override. '' = derive from post; false = no ribbon.
 *   @type array        $prefer     Preferred department slugs for the ribbon.
 *   @type string       $ribbon_class
 *   @type string       $ratio      Image aspect ratio, e.g. '4/3'.
 *   @type int          $words      Excerpt length.
 *   @type bool         $avatar
 *   @type bool         $byline
 *   @type string       $sticker    Extra HTML placed on the image (e.g. Hot Spots sticker).
 *   @type string       $ph_title   Placeholder title text.
 *   @type string       $class      Extra classes on <article>.
 * }
 */
function rowhome_card( $a = array() ) {
    $d = array(
        'post'         => null,
        'variant'      => 'stack',
        'ribbon'       => '',
        'prefer'       => array(),
        'ribbon_class' => '',
        'ratio'        => '4/3',
        'words'        => 18,
        'avatar'       => true,
        'byline'       => true,
        'sticker'      => '',
        'ph_title'     => '',
        'class'        => '',
    );
    $a    = array_merge( $d, $a );
    $post = $a['post'] instanceof WP_Post ? $a['post'] : null;

    // Ribbon.
    $ribbon_html = '';
    if ( $a['ribbon'] !== false ) {
        $label = $a['ribbon'];
        $slug  = '';
        if ( $post ) {
            $r     = rowhome_ribbon_for_post( $post, $a['ribbon'], $a['prefer'] );
            $label = $r['label'];
            $slug  = $r['slug'];
        }
        if ( $label !== '' ) {
            $cls = $a['ribbon_class'] ? $a['ribbon_class'] : rowhome_ribbon_class( $slug );
            $ribbon_html = '<span class="rh-ribbon ' . esc_attr( $cls ) . '">' . esc_html( $label ) . '</span>';
        }
    }

    $url   = $post ? get_permalink( $post ) : home_url( '/subscribe/' );
    $title = $post ? get_the_title( $post ) : ( $a['ph_title'] ? $a['ph_title'] : '' );
    $img   = rowhome_post_image_html( $post, 'rowhome-article-card', $post ? $title : $a['ribbon'], $a['ratio'] );
    $exc   = $post ? wp_trim_words( get_the_excerpt( $post ), (int) $a['words'], '&hellip;' ) : '';

    $classes = 'rh-card rh-card--' . $a['variant'] . ( $post ? '' : ' rh-card--placeholder' ) . ' ' . $a['class'];

    echo '<article class="' . esc_attr( trim( $classes ) ) . '">';
    echo '<a class="rh-card__link" href="' . esc_url( $url ) . '"' . ( $post ? '' : ' aria-label="Subscribe"' ) . '>';

    // Media.
    echo '<div class="rh-card__media">' . $ribbon_html . $a['sticker'] . $img . '</div>';

    // Body.
    echo '<div class="rh-card__body">';
    if ( $a['variant'] !== 'thumb' ) {
        if ( $a['avatar'] ) {
            echo rowhome_avatar_html( $post );
        }
        echo '<div class="rh-card__text">';
        if ( $title !== '' ) {
            echo '<h3 class="rh-card__title">' . esc_html( $title ) . '</h3>';
        } else {
            echo rowhome_text_bars_html( 2, 'rh-bars--title' );
        }
        if ( $a['byline'] ) {
            if ( $post ) {
                echo '<p class="rh-card__byline">' . rowhome_byline_text( $post ) . '</p>';
            } else {
                echo rowhome_text_bars_html( 1, 'rh-bars--byline' );
            }
        }
        if ( $exc !== '' ) {
            echo '<p class="rh-card__excerpt">' . esc_html( $exc ) . '</p>';
        } elseif ( ! $post ) {
            echo rowhome_text_bars_html( 3, 'rh-bars--excerpt' );
        }
        echo '</div>';
    }
    echo '</div>';

    echo '</a></article>';
}

/**
 * Render N cards for a department, padding with placeholders.
 */
function rowhome_cards_for( $slugs, $n, $card_args = array(), $exclude = array() ) {
    $posts = rowhome_dept_posts( $slugs, $n, $exclude );
    for ( $i = 0; $i < $n; $i++ ) {
        $post = isset( $posts[ $i ] ) ? $posts[ $i ] : null;
        rowhome_card( array_merge( $card_args, array( 'post' => $post ) ) );
    }
    return $posts;
}

/* ------------------------------------------------------------------
 * Section chrome
 * ---------------------------------------------------------------- */

/**
 * "PRH" (red) + department name (black) over a rule.
 *
 * @param string $name  e.g. 'LIFE'
 * @param array  $o     { link, class, rule: 'black'|'green', extra: html placed on the rule }
 */
function rowhome_section_header( $name, $o = array() ) {
    $o    = array_merge( array( 'link' => '', 'class' => '', 'rule' => 'black', 'extra' => '' ), $o );
    $cls  = 'rh-sec-head rh-sec-head--' . $o['rule'] . ' ' . $o['class'];
    $open = $o['link'] ? '<a class="rh-sec-head__link" href="' . esc_url( $o['link'] ) . '">' : '';
    $close = $o['link'] ? '</a>' : '';
    echo '<header class="' . esc_attr( trim( $cls ) ) . '">';
    echo '<h2 class="rh-sec-head__title">' . $open . '<span class="rh-sec-head__prh">PRH</span><span class="rh-sec-head__name">' . esc_html( $name ) . '</span>' . $close . '</h2>';
    echo '<div class="rh-sec-head__rule">' . $o['extra'] . '</div>';
    echo '</header>';
}


/**
 * Dotted rule with centered italic tagline.
 */
function rowhome_tagline_divider( $text = 'River to River. One Neighborhood.' ) {
    echo '<div class="rh-tagline" aria-hidden="true"><span class="rh-tagline__text">' . esc_html( $text ) . '</span></div>';
}

/**
 * Round red "Philly" badge.
 */
function rowhome_philly_badge( $class = '' ) {
    echo '<span class="rh-philly ' . esc_attr( $class ) . '" aria-hidden="true"><span class="rh-philly__text">Philly</span></span>';
}

/**
 * Yellow "Hot Spots" sticker.
 */
function rowhome_hotspots_sticker( $class = '' ) {
    return '<span class="rh-sticker ' . esc_attr( $class ) . '" aria-hidden="true"><span class="rh-sticker__text">Hot Spots</span></span>';
}

/**
 * Ad slot. Variants: leader (full-width banner), sky (tall sidebar), rect (square-ish).
 * Uses the existing AdSense helper so real ads render once a publisher ID exists.
 */
function rowhome_ad( $variant = 'leader', $slot = '' ) {
    $formats = array(
        'leader' => array( 'horizontal', 'responsive' ),
        'sky'    => array( 'vertical', 'responsive' ),
        'rect'   => array( 'rectangle', 'responsive' ),
    );
    $f = isset( $formats[ $variant ] ) ? $formats[ $variant ] : $formats['leader'];
    echo '<div class="rh-ad rh-ad--' . esc_attr( $variant ) . '">';
    rowhome_magazine_display_adsense_ad( $slot, $f[0], $f[1], 'rh-ad__inner', true );
    echo '</div>';
}

/* ------------------------------------------------------------------
 * Shared: inline SVG, departments, people
 * ---------------------------------------------------------------- */

/**
 * Inline an SVG from assets/images so it inherits currentColor.
 */
function rowhome_inline_svg( $rel_path ) {
    $file = get_template_directory() . '/assets/images/' . ltrim( $rel_path, '/' );
    if ( ! file_exists( $file ) ) {
        return '';
    }
    $svg = file_get_contents( $file );
    // Strip XML prolog if present.
    return preg_replace( '/^<\?xml[^>]*>\s*/', '', $svg );
}


/**
 * People for the Discover panel: authors with published posts, padded with placeholders.
 *
 * @return array[] { name, url, img }
 */
function rowhome_people_list( $n = 12 ) {
    $out   = array();
    $users = get_users( array( 'has_published_posts' => array( 'post', 'department' ), 'number' => $n, 'orderby' => 'post_count', 'order' => 'DESC' ) );
    foreach ( $users as $u ) {
        $img = get_user_meta( $u->ID, 'rowhome_google_avatar', true );
        if ( ! $img ) {
            $img = get_avatar_url( $u->ID, array( 'size' => 112 ) );
        }
        $out[] = array( 'name' => $u->display_name, 'url' => get_author_posts_url( $u->ID ), 'img' => $img );
    }
    while ( count( $out ) < $n ) {
        $out[] = array( 'name' => 'RowHome contributor', 'url' => home_url( '/about/' ), 'img' => '' );
    }
    return array_slice( $out, 0, $n );
}

/**
 * Advertiser tiles for the "Magazine Ad's Directory" strip.
 * Uses an `advertiser` post type if one exists; otherwise images dropped into
 * assets/images/advertisers/; otherwise gray placeholders.
 *
 * @return array[] { name, url, img, external }
 */
function rowhome_advertiser_tiles( $n = 8 ) {
    $out = array();

    if ( post_type_exists( 'advertiser' ) ) {
        $ads = get_posts( array( 'post_type' => 'advertiser', 'numberposts' => $n, 'post_status' => 'publish' ) );
        foreach ( $ads as $ad ) {
            $link = get_post_meta( $ad->ID, 'advertiser_url', true );
            if ( ! $link && function_exists( 'get_field' ) ) {
                $link = get_field( 'website', $ad->ID );
            }
            $out[] = array(
                'name'     => get_the_title( $ad ),
                'url'      => $link ? $link : get_permalink( $ad ),
                'img'      => get_the_post_thumbnail_url( $ad, 'rowhome-small-card' ),
                'external' => (bool) $link,
            );
        }
    }

    if ( empty( $out ) ) {
        $dir   = get_template_directory() . '/assets/images/advertisers/';
        $uri   = get_template_directory_uri() . '/assets/images/advertisers/';
        $links = array(); // 'filename.jpg' => 'https://advertiser.example'
        $files = glob( $dir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE );
        if ( $files ) {
            sort( $files );
            foreach ( array_slice( $files, 0, $n ) as $f ) {
                $base = basename( $f );
                $name = ucwords( str_replace( array( '-', '_' ), ' ', preg_replace( '/^\d+[-_]?|\.\w+$/', '', $base ) ) );
                $out[] = array(
                    'name'     => $name ? $name : 'Advertiser',
                    'url'      => isset( $links[ $base ] ) ? $links[ $base ] : home_url( '/advertise/' ),
                    'img'      => $uri . $base,
                    'external' => isset( $links[ $base ] ),
                );
            }
        }
    }

    while ( count( $out ) < $n ) {
        $out[] = array( 'name' => 'Advertise with RowHome', 'url' => home_url( '/advertise/' ), 'img' => '', 'external' => false );
    }
    return array_slice( $out, 0, $n );
}
