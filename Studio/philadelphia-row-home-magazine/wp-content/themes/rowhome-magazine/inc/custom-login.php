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

// =============================================================================
// GOOGLE OAUTH 2.0 AUTHENTICATION
// =============================================================================
//
// Setup (add to wp-config.php before the "That's all" line):
//
//   define( 'GOOGLE_OAUTH_CLIENT_ID',     'YOUR_CLIENT_ID.apps.googleusercontent.com' );
//   define( 'GOOGLE_OAUTH_CLIENT_SECRET', 'YOUR_CLIENT_SECRET' );
//
// Authorized redirect URI to register in Google Cloud Console:
//   https://rowhomemag.com/wp-login.php?rowhome_google_callback=1
//
// The login button is gated on GOOGLE_OAUTH_CLIENT_ID — it auto-appears once set.
// =============================================================================

/**
 * Build the OAuth callback redirect URI.
 * Must exactly match the URI registered in Google Cloud Console.
 */
function rowhome_magazine_oauth_redirect_uri() {
    return add_query_arg( 'rowhome_google_callback', '1', site_url( 'wp-login.php' ) );
}

/**
 * Step 1 — Initiation handler.
 *
 * Catches wp-login.php?rowhome_google_login=1, verifies the WP nonce,
 * generates a random CSRF state token, stores it in a short-lived transient,
 * then redirects the browser to Google's OAuth authorization endpoint.
 *
 * Hooked on `init` so it runs before any output (headers still open).
 */
function rowhome_magazine_google_login_init() {
    // Only act when our query param is present on the login page.
    if ( ! isset( $_GET['rowhome_google_login'] ) ) {
        return;
    }

    // Credentials must be configured.
    if ( ! defined( 'GOOGLE_OAUTH_CLIENT_ID' ) || ! GOOGLE_OAUTH_CLIENT_ID ) {
        wp_die(
            esc_html__( 'Google OAuth is not configured. Please add GOOGLE_OAUTH_CLIENT_ID to wp-config.php.', 'rowhome-magazine' ),
            esc_html__( 'Configuration Error', 'rowhome-magazine' ),
            array( 'response' => 500 )
        );
    }

    // Verify the WP nonce generated by the login button.
    $nonce = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'rowhome_google_login' ) ) {
        wp_die(
            esc_html__( 'Security check failed. Please try again.', 'rowhome-magazine' ),
            esc_html__( 'Security Error', 'rowhome-magazine' ),
            array( 'response' => 403 )
        );
    }

    // Generate a cryptographically random CSRF state token (32 hex chars).
    $state = wp_generate_password( 32, false );

    // Store state in a transient that expires in 10 minutes.
    set_transient( 'rowhome_oauth_state_' . $state, 1, 10 * MINUTE_IN_SECONDS );

    // Build the Google authorization URL.
    $params = array(
        'client_id'     => GOOGLE_OAUTH_CLIENT_ID,
        'redirect_uri'  => rowhome_magazine_oauth_redirect_uri(),
        'response_type' => 'code',
        'scope'         => 'openid email profile',
        'state'         => $state,
        'access_type'   => 'online',
        'prompt'        => 'select_account',
    );

    $auth_url = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query( $params );

    wp_redirect( $auth_url );
    exit;
}
add_action( 'init', 'rowhome_magazine_google_login_init' );

/**
 * Step 2 — Callback handler.
 *
 * Catches wp-login.php?rowhome_google_callback=1 after Google redirects back.
 * Verifies the CSRF state, exchanges the authorization code for an access token,
 * fetches the Google user profile, then creates or maps a WordPress user account
 * with the subscriber role and logs them in.
 *
 * Hooked on `init` so headers are still open for redirects.
 */
function rowhome_magazine_google_callback_init() {
    // Only act when our callback query param is present.
    if ( ! isset( $_GET['rowhome_google_callback'] ) ) {
        return;
    }

    // Credentials must be configured.
    if ( ! defined( 'GOOGLE_OAUTH_CLIENT_ID' )     || ! GOOGLE_OAUTH_CLIENT_ID ||
         ! defined( 'GOOGLE_OAUTH_CLIENT_SECRET' ) || ! GOOGLE_OAUTH_CLIENT_SECRET ) {
        wp_die(
            esc_html__( 'Google OAuth is not fully configured. Please add GOOGLE_OAUTH_CLIENT_ID and GOOGLE_OAUTH_CLIENT_SECRET to wp-config.php.', 'rowhome-magazine' ),
            esc_html__( 'Configuration Error', 'rowhome-magazine' ),
            array( 'response' => 500 )
        );
    }

    // Google may return an error param (e.g. user denied access).
    if ( isset( $_GET['error'] ) ) {
        $error = sanitize_text_field( wp_unslash( $_GET['error'] ) );
        wp_safe_redirect(
            add_query_arg(
                array(
                    'rowhome_oauth_error' => rawurlencode( $error ),
                ),
                wp_login_url()
            )
        );
        exit;
    }

    // Both state and code are required.
    if ( empty( $_GET['state'] ) || empty( $_GET['code'] ) ) {
        wp_die(
            esc_html__( 'Invalid OAuth callback — missing required parameters.', 'rowhome-magazine' ),
            esc_html__( 'OAuth Error', 'rowhome-magazine' ),
            array( 'response' => 400 )
        );
    }

    $state = sanitize_text_field( wp_unslash( $_GET['state'] ) );
    $code  = sanitize_text_field( wp_unslash( $_GET['code'] ) );

    // --- CSRF verification: the state must match a stored transient. ---
    $transient_key = 'rowhome_oauth_state_' . $state;
    if ( ! get_transient( $transient_key ) ) {
        wp_die(
            esc_html__( 'OAuth state mismatch — possible CSRF attack. Please try signing in again.', 'rowhome-magazine' ),
            esc_html__( 'Security Error', 'rowhome-magazine' ),
            array( 'response' => 403 )
        );
    }
    // Consume the transient so it cannot be reused.
    delete_transient( $transient_key );

    // --- Exchange authorization code for access token. ---
    $token_response = wp_remote_post(
        'https://oauth2.googleapis.com/token',
        array(
            'timeout' => 15,
            'body'    => array(
                'code'          => $code,
                'client_id'     => GOOGLE_OAUTH_CLIENT_ID,
                'client_secret' => GOOGLE_OAUTH_CLIENT_SECRET,
                'redirect_uri'  => rowhome_magazine_oauth_redirect_uri(),
                'grant_type'    => 'authorization_code',
            ),
        )
    );

    if ( is_wp_error( $token_response ) ) {
        error_log( 'RowHome OAuth token error: ' . $token_response->get_error_message() );
        wp_die(
            esc_html__( 'Could not connect to Google. Please try again later.', 'rowhome-magazine' ),
            esc_html__( 'OAuth Error', 'rowhome-magazine' ),
            array( 'response' => 502 )
        );
    }

    $token_body = json_decode( wp_remote_retrieve_body( $token_response ), true );

    if ( empty( $token_body['access_token'] ) ) {
        $token_error = isset( $token_body['error_description'] ) ? $token_body['error_description'] : 'Unknown error';
        error_log( 'RowHome OAuth token body error: ' . $token_error );
        wp_die(
            esc_html__( 'Google did not return a valid access token. Please try again.', 'rowhome-magazine' ),
            esc_html__( 'OAuth Error', 'rowhome-magazine' ),
            array( 'response' => 502 )
        );
    }

    $access_token = sanitize_text_field( $token_body['access_token'] );

    // --- Fetch Google user profile. ---
    $profile_response = wp_remote_get(
        'https://www.googleapis.com/oauth2/v2/userinfo',
        array(
            'timeout' => 15,
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
            ),
        )
    );

    if ( is_wp_error( $profile_response ) ) {
        error_log( 'RowHome OAuth profile error: ' . $profile_response->get_error_message() );
        wp_die(
            esc_html__( 'Could not retrieve your Google profile. Please try again.', 'rowhome-magazine' ),
            esc_html__( 'OAuth Error', 'rowhome-magazine' ),
            array( 'response' => 502 )
        );
    }

    $profile = json_decode( wp_remote_retrieve_body( $profile_response ), true );

    // Email is mandatory — Google accounts always have one.
    if ( empty( $profile['email'] ) || ! is_email( $profile['email'] ) ) {
        wp_die(
            esc_html__( 'Your Google account did not provide a valid email address.', 'rowhome-magazine' ),
            esc_html__( 'OAuth Error', 'rowhome-magazine' ),
            array( 'response' => 400 )
        );
    }

    $google_email   = sanitize_email( $profile['email'] );
    $google_name    = isset( $profile['name'] )       ? sanitize_text_field( $profile['name'] )       : '';
    $google_id      = isset( $profile['id'] )         ? sanitize_text_field( $profile['id'] )         : '';
    $first_name     = isset( $profile['given_name'] ) ? sanitize_text_field( $profile['given_name'] ) : '';
    $last_name      = isset( $profile['family_name'] )? sanitize_text_field( $profile['family_name'] ): '';
    $google_picture = isset( $profile['picture'] )    ? esc_url_raw( $profile['picture'] )            : '';

    // --- Find or create the WordPress user. ---

    $is_new_user = false; // True when we create a fresh account in this request.

    // 1. Try to find by stored Google ID meta (most reliable across email changes).
    $user = false;
    if ( $google_id ) {
        $users_by_google_id = get_users( array(
            'meta_key'   => 'rowhome_google_id',
            'meta_value' => $google_id,
            'number'     => 1,
        ) );
        if ( ! empty( $users_by_google_id ) ) {
            $user = $users_by_google_id[0];
        }
    }

    // 2. Fall back to matching by email address.
    if ( ! $user ) {
        $user = get_user_by( 'email', $google_email );
    }

    // 3. Create a new subscriber account if no match found.
    if ( ! $user ) {
        // Build a unique username from the email local-part.
        $username_base = sanitize_user( strstr( $google_email, '@', true ), true );
        $username      = $username_base;
        $suffix        = 1;
        while ( username_exists( $username ) ) {
            $username = $username_base . $suffix;
            $suffix++;
        }

        $new_user_id = wp_insert_user( array(
            'user_login'   => $username,
            'user_email'   => $google_email,
            'user_pass'    => wp_generate_password( 24 ),
            'display_name' => $google_name ?: $username,
            'first_name'   => $first_name,
            'last_name'    => $last_name,
            'role'         => 'subscriber',
        ) );

        if ( is_wp_error( $new_user_id ) ) {
            error_log( 'RowHome OAuth user create error: ' . $new_user_id->get_error_message() );
            wp_die(
                esc_html__( 'Could not create your account. Please contact the site administrator.', 'rowhome-magazine' ),
                esc_html__( 'Account Error', 'rowhome-magazine' ),
                array( 'response' => 500 )
            );
        }

        $user        = get_user_by( 'id', $new_user_id );
        $is_new_user = true;
    }

    // Store / refresh Google ID and avatar URL so future lookups are fast.
    if ( $google_id ) {
        update_user_meta( $user->ID, 'rowhome_google_id', $google_id );
    }
    if ( $google_picture ) {
        update_user_meta( $user->ID, 'rowhome_google_avatar', $google_picture );
    }

    // Update display name and names if the account was just linked
    // (skip if the user has manually edited their profile).
    if ( $google_name && empty( get_user_meta( $user->ID, 'rowhome_google_profile_set', true ) ) ) {
        wp_update_user( array(
            'ID'           => $user->ID,
            'display_name' => $google_name,
            'first_name'   => $first_name,
            'last_name'    => $last_name,
        ) );
        update_user_meta( $user->ID, 'rowhome_google_profile_set', '1' );
    }

    // --- Log the user in. ---
    wp_set_current_user( $user->ID );
    wp_set_auth_cookie( $user->ID, true ); // "remember me" so cookie lasts 2 weeks.

    do_action( 'wp_login', $user->user_login, $user );

    // Subscribers: new accounts see the welcome page once, then the homepage.
    // Admins/editors go to wp-admin.
    if ( in_array( 'subscriber', (array) $user->roles, true ) ) {
        if ( $is_new_user || get_user_meta( $user->ID, 'rowhome_show_welcome', true ) ) {
            update_user_meta( $user->ID, 'rowhome_show_welcome', '1' );
            $redirect = home_url( '/welcome/' );
        } else {
            $redirect = home_url( '/' );
        }
    } else {
        $redirect = admin_url();
    }

    wp_safe_redirect( $redirect );
    exit;
}
add_action( 'init', 'rowhome_magazine_google_callback_init' );

/**
 * Show a friendly error message on the login form when Google OAuth fails.
 */
function rowhome_magazine_oauth_error_message( $message ) {
    if ( ! isset( $_GET['rowhome_oauth_error'] ) ) {
        return $message;
    }
    $error = sanitize_text_field( wp_unslash( $_GET['rowhome_oauth_error'] ) );
    $labels = array(
        'access_denied' => __( 'You cancelled the Google sign-in. Please try again.', 'rowhome-magazine' ),
    );
    $text = isset( $labels[ $error ] )
        ? $labels[ $error ]
        : sprintf( __( 'Google sign-in failed (%s). Please try again.', 'rowhome-magazine' ), esc_html( $error ) );

    $message .= '<div id="login_error" class="notice notice-error"><strong>' . esc_html( $text ) . '</strong></div>';
    return $message;
}
add_filter( 'login_message', 'rowhome_magazine_oauth_error_message' );
