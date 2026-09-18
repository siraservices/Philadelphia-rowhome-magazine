<?php
/**
 * Site header — black bar, ROWHOME nameplate, Discover mega-menu,
 * Subscribe / search / Log In, red rule, secondary nav. Sticky.
 * Matches Omar's wireframe (website_Home, top).
 *
 * @package RowHome_Magazine
 * @since 2.1.0
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
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'rowhome-magazine' ); ?></a>

<?php
$rh_logged_in = is_user_logged_in();
if ( $rh_logged_in ) {
    $rh_user          = wp_get_current_user();
    $rh_google_avatar = get_user_meta( $rh_user->ID, 'rowhome_google_avatar', true );
    $rh_avatar_url    = $rh_google_avatar ? $rh_google_avatar : get_avatar_url( $rh_user->ID, array( 'size' => 64 ) );
    $rh_display_name  = $rh_user->display_name;
}
$rh_login_url = wp_login_url( is_singular() ? get_permalink() : home_url( '/' ) );
?>

<header class="rh-header" id="site-header">
    <div class="rh-header__bar">
        <div class="rh-container rh-header__row">

            <div class="rh-header__left">
                <a class="rh-nameplate" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="RowHome Magazine — home">
                    <?php echo rowhome_inline_svg( 'brand/rowhome-wordmark.svg' ); ?>
                </a>
                <button id="discover-toggle" class="rh-btn-outline rh-discover-btn" type="button" aria-expanded="false" aria-controls="discover-panel">
                    <span class="rh-discover-btn__label" data-open="Discover" data-close="Close">Discover</span>
                    <span class="rh-discover-btn__icon" aria-hidden="true"><span></span><span></span><span></span></span>
                </button>
            </div>

            <div class="rh-header__right">
                <div class="rh-header__subscribe">
                    <a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="rh-btn-outline rh-btn-subscribe">Subscribe</a>
                    <button id="search-toggle" class="rh-btn-outline rh-btn-search" type="button" aria-label="Open search" aria-controls="search-overlay" aria-expanded="false">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7.5"></circle><path d="m21 21-4.6-4.6"></path></svg>
                    </button>
                </div>
                <?php if ( $rh_logged_in ) : ?>
                <div class="rh-user">
                    <button class="rh-user__btn" type="button" aria-expanded="false" aria-controls="user-dropdown" aria-label="Account menu">
                        <?php if ( ! empty( $rh_avatar_url ) ) : ?>
                            <img src="<?php echo esc_url( $rh_avatar_url ); ?>" alt="" width="24" height="24" referrerpolicy="no-referrer">
                        <?php endif; ?>
                        <span><?php echo esc_html( $rh_display_name ); ?></span>
                    </button>
                    <div id="user-dropdown" class="rh-user__menu" role="menu">
                        <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" role="menuitem">My Account</a>
                        <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" role="menuitem">Log Out</a>
                    </div>
                </div>
                <?php else : ?>
                <a href="<?php echo esc_url( $rh_login_url ); ?>" class="rh-login">Log In</a>
                <?php endif; ?>
            </div>

        </div>

        <nav class="rh-secnav" aria-label="Site sections">
            <ul class="rh-secnav__list">
                <li><a href="<?php echo esc_url( rowhome_dept_url( 'dept-events' ) ); ?>">Events</a></li>
                <li><a href="<?php echo esc_url( home_url( '/issues/' ) ); ?>">In the Magazine</a></li>
                <li><a href="<?php echo esc_url( rowhome_dept_url( 'dept-community' ) ); ?>">Neighborhood</a></li>
            </ul>
        </nav>
    </div>
    <div class="rh-header__redrule" aria-hidden="true"></div>

    <!-- Discover mega-menu -->
    <div id="discover-panel" class="rh-discover" hidden>
        <div class="rh-container">
            <div class="rh-discover__grid">

                <div class="rh-discover__col rh-discover__people">
                    <h2 class="rh-discover__title">People</h2>
                    <div class="rh-people">
                        <?php
                        $rh_people = rowhome_people_list( 12 );
                        foreach ( $rh_people as $p ) :
                        ?>
                        <a class="rh-people__item" href="<?php echo esc_url( $p['url'] ); ?>" title="<?php echo esc_attr( $p['name'] ); ?>">
                            <?php if ( ! empty( $p['img'] ) ) : ?>
                                <img src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?>" loading="lazy" width="56" height="56">
                            <?php else : ?>
                                <span class="rh-people__ph" aria-hidden="true"></span>
                            <?php endif; ?>
                            <span class="screen-reader-text"><?php echo esc_html( $p['name'] ); ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="rh-discover__col rh-discover__topics">
                    <h2 class="rh-discover__title">Topics</h2>
                    <ul class="rh-topics">
                        <?php foreach ( rowhome_departments() as $dept ) : ?>
                        <li><a href="<?php echo esc_url( $dept['url'] ); ?>"><?php echo esc_html( $dept['name'] ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="rh-discover__col rh-discover__articles">
                    <h2 class="rh-discover__title">Articles</h2>
                    <div class="rh-discover__cards">
                        <?php
                        $rh_recent = get_posts( array( 'numberposts' => 2, 'post_type' => array( 'post', 'department' ), 'post_status' => 'publish' ) );
                        for ( $i = 0; $i < 2; $i++ ) :
                            $rp = isset( $rh_recent[ $i ] ) ? $rh_recent[ $i ] : null;
                        ?>
                        <a class="rh-discover__card" href="<?php echo esc_url( $rp ? get_permalink( $rp ) : home_url( '/' ) ); ?>">
                            <?php echo rowhome_post_image_html( $rp, 'rowhome-small-card', $rp ? get_the_title( $rp ) : '', '1/1' ); ?>
                            <?php if ( $rp ) : ?>
                                <span class="rh-discover__card-title"><?php echo esc_html( get_the_title( $rp ) ); ?></span>
                            <?php else : ?>
                                <?php echo rowhome_text_bars_html( 3, 'rh-bars--dark' ); ?>
                            <?php endif; ?>
                        </a>
                        <?php endfor; ?>
                    </div>
                </div>

            </div>

            <div class="rh-discover__hot">
                <h2 class="rh-discover__title rh-discover__title--center">What's HOT!</h2>
                <div class="rh-discover__hotstrip">
                    <?php
                    $rh_hot = get_posts( array( 'numberposts' => 8, 'offset' => 2, 'post_type' => array( 'post', 'department' ), 'post_status' => 'publish' ) );
                    for ( $i = 0; $i < 8; $i++ ) :
                        $hp = isset( $rh_hot[ $i ] ) ? $rh_hot[ $i ] : null;
                    ?>
                    <a class="rh-discover__card rh-discover__card--sm" href="<?php echo esc_url( $hp ? get_permalink( $hp ) : home_url( '/' ) ); ?>">
                        <?php echo rowhome_post_image_html( $hp, 'rowhome-small-card', $hp ? get_the_title( $hp ) : '', '1/1' ); ?>
                        <?php if ( $hp ) : ?>
                            <span class="rh-discover__card-title"><?php echo esc_html( get_the_title( $hp ) ); ?></span>
                        <?php else : ?>
                            <?php echo rowhome_text_bars_html( 2, 'rh-bars--dark' ); ?>
                        <?php endif; ?>
                    </a>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="rh-discover__mobile-actions">
                <a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="rh-btn-outline">Subscribe</a>
                <?php if ( $rh_logged_in ) : ?>
                    <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>">My Account</a>
                    <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>">Log Out</a>
                <?php else : ?>
                    <a href="<?php echo esc_url( $rh_login_url ); ?>">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Search overlay -->
    <div class="search-overlay" id="search-overlay" style="display: none;">
        <div class="search-overlay-content">
            <button class="search-close" id="search-close" aria-label="Close search">&times;</button>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <label>
                    <span class="sr-only">Search for:</span>
                    <input type="search" class="search-field" placeholder="Search articles..." value="<?php echo get_search_query(); ?>" name="s" />
                </label>
                <button type="submit" class="search-submit">
                    <span class="sr-only">Search</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                </button>
            </form>
        </div>
    </div>
</header>

<div id="page" class="site">
    <div id="content" class="site-content">
