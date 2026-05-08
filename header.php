<?php
/**
 * The header for our theme
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antic+Didone&family=Crimson+Pro:ital,wght@0,300..800;1,300..800&family=Archivo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'rowhome-magazine' ); ?></a>

<header class="site-header">
    <!-- Main Header -->
    <div class="main-header">
        <div class="container">
            <!-- Search Bar (Left) -->
            <div class="header-search">
                <form role="search" method="get" class="header-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <button type="submit" class="header-search-btn" aria-label="Search">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                    <input type="search" class="header-search-input" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
                </form>
            </div>
            <div class="site-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rowhome-logo.png" alt="RowHome Magazine - River to River. One Neighborhood." class="logo-image" loading="eager" fetchpriority="high">
                </a>
            </div>
            <div class="header-actions">
                <button id="menu-toggle" class="btn-menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-nav" type="button">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>
                <button id="search-toggle" class="btn-search-toggle" aria-label="Open search" type="button">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
                <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="btn-subscribe">SUBSCRIBE FOR $1/WEEK</a>
                <?php if ( is_user_logged_in() ) :
                    $current_user   = wp_get_current_user();
                    $google_avatar  = get_user_meta( $current_user->ID, 'rowhome_google_avatar', true );
                    $avatar_url     = $google_avatar ? $google_avatar : get_avatar_url( $current_user->ID, array( 'size' => 64 ) );
                    $display_name   = $current_user->display_name;
                    $first_initial  = mb_strtoupper( mb_substr( $display_name, 0, 1 ) );
                ?>
                <div class="user-menu-wrapper">
                    <button class="user-avatar-btn" aria-label="Account menu" aria-expanded="false" aria-controls="user-dropdown" type="button">
                        <?php if ( $avatar_url ) : ?>
                            <img src="<?php echo esc_url( $avatar_url ); ?>" alt="" class="user-avatar-img" width="32" height="32" referrerpolicy="no-referrer">
                        <?php else : ?>
                            <span class="user-avatar-initial"><?php echo esc_html( $first_initial ); ?></span>
                        <?php endif; ?>
                    </button>
                    <div id="user-dropdown" class="user-dropdown" role="menu">
                        <div class="user-dropdown-header">
                            <span class="user-dropdown-name"><?php echo esc_html( $display_name ); ?></span>
                            <span class="user-dropdown-email"><?php echo esc_html( $current_user->user_email ); ?></span>
                        </div>
                        <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" class="user-dropdown-item" role="menuitem">My Account</a>
                        <a href="<?php echo esc_url( home_url( '/my-account/?tab=notifications' ) ); ?>" class="user-dropdown-item" role="menuitem">Notifications</a>
                        <div class="user-dropdown-divider"></div>
                        <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="user-dropdown-item user-dropdown-logout" role="menuitem">Log Out</a>
                    </div>
                </div>
                <?php else : ?>
                <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="btn-login">LOG IN</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Department Navigation -->
    <nav id="mobile-nav" class="department-nav" role="navigation" aria-label="Department Navigation">
        <!-- Mobile-only action links (subscribe + login) — visible inside hamburger menu -->
        <div class="mobile-nav-actions">
            <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="mobile-subscribe-link">Subscribe for $1/Week</a>
            <?php if ( is_user_logged_in() ) :
                // Reuse vars set above in desktop header; if not set, resolve again.
                if ( ! isset( $avatar_url ) ) {
                    $current_user  = wp_get_current_user();
                    $google_avatar = get_user_meta( $current_user->ID, 'rowhome_google_avatar', true );
                    $avatar_url    = $google_avatar ? $google_avatar : get_avatar_url( $current_user->ID, array( 'size' => 64 ) );
                    $display_name  = $current_user->display_name;
                }
            ?>
            <div class="mobile-user-info">
                <?php if ( $avatar_url ) : ?>
                    <img src="<?php echo esc_url( $avatar_url ); ?>" alt="" class="mobile-user-avatar" width="24" height="24" referrerpolicy="no-referrer">
                <?php endif; ?>
                <span class="mobile-user-name"><?php echo esc_html( $display_name ); ?></span>
            </div>
            <a href="<?php echo esc_url(home_url('/my-account/')); ?>" class="mobile-login-link">My Account</a>
            <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="mobile-login-link">Log Out</a>
            <?php else : ?>
            <a href="<?php echo esc_url(wp_login_url()); ?>" class="mobile-login-link">Log In</a>
            <?php endif; ?>
        </div>
        <ul class="department-menu">
            <?php
            // Organized department structure with dropdowns
            $department_structure = array(
                'People' => 'people', // Special flag for people dropdown
                'Life' => array(
                    'Health',
                    'Fashion',
                    'Brides Guide',
                    'Community',
                    'Writers Block'
                ),
                'Business' => array(
                    'Real Estate',
                    'Tech',
                    'Education',
                    'Politics'
                ),
                'Arts' => array(
                    'Music & Art',
                    'Film',
                    'Flashback',
                    'History'
                ),
                'Lifestyle' => array(
                    'Menu',
                    'Travel',
                    '2025 Hotspots',
                    'Events'
                ),
                'Sports' => array(),
                'Environment' => array(),
                'Games' => array()
            );

            // Check if custom menu exists
            if (has_nav_menu('department')) {
                wp_nav_menu(array(
                    'theme_location' => 'department',
                    'container' => false,
                    'items_wrap' => '%3$s',
                ));
            } else {
                // Generate menu with dropdowns
                foreach ($department_structure as $parent => $children) {
                    $parent_slug = sanitize_title($parent);

                    // Use bare slug for URL; fallback to dept- prefixed term if needed
                    $dept_slug = $parent_slug;
                    $dept_term = get_term_by('slug', $dept_slug, 'department_category');
                    if (!$dept_term) {
                        $dept_term = get_term_by('slug', 'dept-' . $dept_slug, 'department_category');
                        if ($dept_term) {
                            $dept_slug = $dept_term->slug;
                        }
                    }

                    // Special handling for People dropdown
                    if ($children === 'people') {
                        $dropdown_class = ' has-dropdown people-dropdown';
                        $current_class = is_tax('department_category', $dept_slug) ? ' active' : '';

                        echo '<li class="menu-item' . $dropdown_class . $current_class . '">';
                        echo '<a href="' . esc_url(home_url('/' . $parent_slug)) . '">';
                        echo esc_html($parent);
                        echo '<svg class="dropdown-icon" width="10" height="6" viewBox="0 0 10 6" fill="currentColor"><path d="M5 6L0 0h10L5 6z"/></svg>';
                        echo '</a>';

                        echo '<div class="dropdown-menu people-dropdown-menu">';
                        echo '<div class="dropdown-content people-dropdown-content">';
                        
                        // People grid section
                        echo '<div class="people-grid-section">';
                        echo '<div class="people-section-title">PEOPLE</div>';
                        echo '<div class="people-grid">';
                        
                        // People data - matching the image
                        $people_list = array(
                            array('name' => 'Lindsey Vonn', 'slug' => 'lindsey-vonn'),
                            array('name' => 'Julie Sweet', 'slug' => 'julie-sweet'),
                            array('name' => 'Bertha Zúniga Cáceres', 'slug' => 'bertha-zuniga-caceres'),
                            array('name' => 'Tate McRae', 'slug' => 'tate-mcrae'),
                            array('name' => 'Sanaz Toossi', 'slug' => 'sanaz-toossi'),
                            array('name' => 'Bruce Springsteen', 'slug' => 'bruce-springsteen'),
                            array('name' => 'Lee Jae-Myung', 'slug' => 'lee-jae-myung'),
                            array('name' => 'Tejasvi Manoj', 'slug' => 'tejasvi-manoj')
                        );
                        
                        foreach ($people_list as $person) {
                            echo '<a href="' . esc_url(home_url('/people/' . $person['slug'])) . '" class="people-item">';
                            echo '<div class="people-image-wrapper">';
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/people/' . $person['slug'] . '.jpg') . '" alt="' . esc_attr($person['name']) . '" class="people-image" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'block\';" />';
                            echo '<div class="people-image-placeholder" style="display:none;"></div>';
                            echo '</div>';
                            echo '<div class="people-name">' . esc_html($person['name']) . '</div>';
                            echo '</a>';
                        }
                        
                        echo '</div>';
                        echo '</div>';
                        
                        // Topics section
                        echo '<div class="topics-section">';
                        echo '<div class="topics-section-title">TOPICS</div>';
                        echo '<div class="topics-grid">';
                        
                        $topics_list = array(
                            'POLITICS',
                            'HEALTH',
                            'AI',
                            'WORLD',
                            'CLIMATE',
                            'IDEAS',
                            'ENTERTAINMENT',
                            'SCIENCE'
                        );
                        
                        foreach ($topics_list as $topic) {
                            $topic_slug = sanitize_title($topic);
                            echo '<a href="' . esc_url(home_url('/topic/' . $topic_slug)) . '" class="topic-button">' . esc_html($topic) . '</a>';
                        }
                        
                        echo '</div>';
                        echo '</div>';
                        
                        // Featured section
                        echo '<div class="featured-section">';
                        echo '<div class="featured-section-title">FEATURED</div>';
                        echo '<div class="featured-carousel-wrapper">';
                        echo '<div class="featured-carousel">';
                        
                        // Query for featured posts
                        $featured_query = new WP_Query(array(
                            'posts_per_page' => 6,
                            'post_type' => array('post', 'department'),
                            'meta_query' => array(
                                array(
                                    'key' => '_featured',
                                    'value' => '1',
                                    'compare' => '='
                                )
                            ),
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        
                        // If no featured posts with meta, get recent posts
                        if (!$featured_query->have_posts()) {
                            $featured_query = new WP_Query(array(
                                'posts_per_page' => 6,
                                'post_type' => array('post', 'department'),
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));
                        }
                        
                        if ($featured_query->have_posts()) {
                            while ($featured_query->have_posts()) {
                                $featured_query->the_post();
                                $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                if (!$featured_image) {
                                    $featured_image = get_template_directory_uri() . '/assets/images/placeholder.jpg';
                                }
                                
                                echo '<a href="' . esc_url(get_permalink()) . '" class="featured-card">';
                                echo '<div class="featured-card-image-wrapper">';
                                echo '<img src="' . esc_url($featured_image) . '" alt="' . esc_attr(get_the_title()) . '" class="featured-card-image" />';
                                echo '</div>';
                                echo '<div class="featured-card-title">' . esc_html(get_the_title()) . '</div>';
                                echo '</a>';
                            }
                            wp_reset_postdata();
                        } else {
                            // Placeholder featured cards
                            $placeholder_features = array(
                                array('title' => 'How the 2025 TIME100 Climate Cover Was...', 'image' => ''),
                                array('title' => 'The Tragedy of Eric Adams', 'image' => ''),
                                array('title' => 'TIME Best In of Fame', 'image' => '')
                            );
                            
                            foreach ($placeholder_features as $feature) {
                                echo '<a href="#" class="featured-card">';
                                echo '<div class="featured-card-image-wrapper">';
                                echo '<div class="featured-card-image-placeholder"></div>';
                                echo '</div>';
                                echo '<div class="featured-card-title">' . esc_html($feature['title']) . '</div>';
                                echo '</a>';
                            }
                        }
                        
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</div>';
                        
                        echo '</li>';
                        continue;
                    }
                    
                    $has_dropdown = !empty($children);
                    $dropdown_class = $has_dropdown ? ' has-dropdown' : '';
                    $current_class = is_tax('department_category', $dept_slug) ? ' active' : '';

                    echo '<li class="menu-item' . $dropdown_class . $current_class . '">';
                    echo '<a href="' . esc_url(home_url('/' . $parent_slug)) . '">';
                    echo esc_html($parent);
                    if ($has_dropdown) {
                        echo '<svg class="dropdown-icon" width="10" height="6" viewBox="0 0 10 6" fill="currentColor"><path d="M5 6L0 0h10L5 6z"/></svg>';
                    }
                    echo '</a>';
                    
                    if ($has_dropdown) {
                        echo '<div class="dropdown-menu">';
                        echo '<div class="dropdown-content">';

                        // First section - Subcategories
                        echo '<div class="dropdown-section">';
                        echo '<div class="dropdown-section-title">Sections</div>';
                        foreach ($children as $child) {
                            $child_slug = sanitize_title($child);
                            // Resolve actual term slug (bare or dept- prefixed)
                            $child_term = get_term_by('slug', $child_slug, 'department_category');
                            if (!$child_term) {
                                $child_term = get_term_by('slug', 'dept-' . $child_slug, 'department_category');
                                if ($child_term) {
                                    $child_slug = $child_term->slug;
                                }
                            }
                            echo '<a href="' . esc_url(home_url('/department_category/' . $child_slug)) . '" class="dropdown-item">' . esc_html($child) . '</a>';
                        }
                        echo '</div>';
                        
                        // Second section - Top Stories placeholder
                        echo '<div class="dropdown-section">';
                        echo '<div class="dropdown-section-title">Top Stories</div>';
                        echo '<a href="#" class="dropdown-item">Latest in ' . esc_html($parent) . '</a>';
                        echo '<a href="#" class="dropdown-item">Featured Articles</a>';
                        echo '<a href="#" class="dropdown-item">Editor\'s Picks</a>';
                        echo '</div>';
                        
                        // Third section - More
                        echo '<div class="dropdown-section">';
                        echo '<div class="dropdown-section-title">More</div>';
                        echo '<a href="' . esc_url(home_url('/' . $parent_slug)) . '" class="dropdown-item">All ' . esc_html($parent) . '</a>';
                        echo '<a href="' . esc_url(home_url('/newsletter')) . '" class="dropdown-item">Newsletter</a>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</div>';
                    }
                    
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </nav>

    <!-- Search Overlay -->
    <div class="search-overlay" id="search-overlay" style="display: none;">
        <div class="search-overlay-content">
            <button class="search-close" id="search-close" aria-label="Close search">&times;</button>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <label>
                    <span class="sr-only">Search for:</span>
                    <input type="search" class="search-field" placeholder="Search articles..." value="<?php echo get_search_query(); ?>" name="s" />
                </label>
                <button type="submit" class="search-submit">
                    <span class="sr-only">Search</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>

<style>
/* Search Toggle Button */
.btn-search-toggle {
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px 8px;
    color: inherit;
    align-items: center;
    justify-content: center;
    line-height: 1;
}

.btn-search-toggle:hover {
    opacity: 0.7;
}

/* Search Overlay Styles */
.search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.95);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-overlay-content {
    position: relative;
    width: 90%;
    max-width: 600px;
}

.search-close {
    position: absolute;
    top: -50px;
    right: 0;
    background: none;
    border: none;
    color: #ffffff;
    font-size: 3rem;
    cursor: pointer;
    line-height: 1;
}

.search-form {
    display: flex;
    gap: 10px;
}

.search-field {
    flex: 1;
    padding: 20px;
    font-size: 1.5rem;
    border: none;
    border-radius: 4px;
}

.search-submit {
    padding: 20px 30px;
    background-color: #FF0000;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    color: #ffffff;
}

.search-submit:hover {
    background-color: #cc0000;
}
</style>

<div id="page" class="site">
    <div id="content" class="site-content">

