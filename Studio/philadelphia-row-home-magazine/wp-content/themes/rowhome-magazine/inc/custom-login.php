<?php
/**
 * Custom Login Page for RowHome Magazine
 *
 * Replaces the default WordPress login with branded styling,
 * Google OAuth button scaffold, and custom messaging.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue custom login styles and fonts.
 */
function rowhome_magazine_login_enqueue_scripts() {
    // Enqueue Google Fonts used by the theme
    wp_enqueue_style(
        'rowhome-login-fonts',
        'https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Montserrat:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'rowhome-custom-login',
        get_template_directory_uri() . '/assets/css/custom-login.css',
        array( 'rowhome-login-fonts' ),
        filemtime( get_template_directory() . '/assets/css/custom-login.css' )
    );
}
add_action( 'login_enqueue_scripts', 'rowhome_magazine_login_enqueue_scripts' );

/**
 * Change the login logo URL to the site home.
 */
function rowhome_magazine_login_headerurl() {
    return home_url( '/' );
}
add_filter( 'login_headerurl', 'rowhome_magazine_login_headerurl' );

/**
 * Change the login logo title to the site name.
 */
function rowhome_magazine_login_headertext() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'rowhome_magazine_login_headertext' );

/**
 * Add custom message below the login logo with Google OAuth button.
 */
function rowhome_magazine_login_message( $message ) {
    $google_client_id = defined( 'GOOGLE_OAUTH_CLIENT_ID' ) ? GOOGLE_OAUTH_CLIENT_ID : '';

    $custom = '<div class="rowhome-login-branding">';
    $custom .= '<p class="rowhome-login-tagline">Philadelphia\'s Premier Home &amp; Lifestyle Magazine</p>';
    $custom .= '</div>';

    // Google OAuth button (only show if credentials are configured)
    if ( ! empty( $google_client_id ) ) {
        $google_login_url = wp_nonce_url(
            add_query_arg( 'rowhome_google_login', '1', wp_login_url() ),
            'rowhome_google_login'
        );
        $custom .= '<div class="rowhome-social-login">';
        $custom .= '<a href="' . esc_url( $google_login_url ) . '" class="rowhome-google-btn">';
        $custom .= '<svg class="rowhome-google-icon" viewBox="0 0 24 24" width="18" height="18">';
        $custom .= '<path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>';
        $custom .= '<path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>';
        $custom .= '<path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>';
        $custom .= '<path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>';
        $custom .= '</svg>';
        $custom .= '<span>Sign in with Google</span>';
        $custom .= '</a>';
        $custom .= '<div class="rowhome-login-divider"><span>Or use email</span></div>';
        $custom .= '</div>';
    }

    return $custom . $message;
}
add_filter( 'login_message', 'rowhome_magazine_login_message' );

/**
 * Add "New here? Subscribe" link and footer branding below the login form.
 */
function rowhome_magazine_login_footer() {
    $subscribe_url = home_url( '/subscribe/' );
    ?>
    <div class="rowhome-login-footer">
        <p class="rowhome-subscribe-cta">
            New here? <a href="<?php echo esc_url( $subscribe_url ); ?>">Subscribe to RowHome Magazine</a>
        </p>
        <p class="rowhome-login-copyright">
            &copy; <?php echo esc_html( date( 'Y' ) ); ?> RowHome Magazine. All rights reserved.
        </p>
    </div>
    <?php
}
add_action( 'login_footer', 'rowhome_magazine_login_footer' );

/**
 * Add custom body class to login page for styling hooks.
 */
function rowhome_magazine_login_body_class( $classes ) {
    $classes[] = 'rowhome-login';
    return $classes;
}
add_filter( 'login_body_class', 'rowhome_magazine_login_body_class' );

/**
 * Redirect subscribers to the homepage after login (not wp-admin).
 */
function rowhome_magazine_subscriber_login_redirect( $redirect_to, $requested_redirect_to, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) && in_array( 'subscriber', $user->roles, true ) ) {
        return home_url( '/' );
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'rowhome_magazine_subscriber_login_redirect', 10, 3 );
