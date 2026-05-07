<?php
/**
 * Template Name: My Account
 *
 * Subscriber profile and settings page: subscription status,
 * account settings (name/email/password), and notification preferences.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Redirect guests to login page, returning to this page after auth.
if ( ! is_user_logged_in() ) {
    wp_safe_redirect( wp_login_url( get_permalink() ) );
    exit;
}

// ── Handle form submissions ───────────────────────────────────────────────────

$success_message = '';
$error_message   = '';

// Profile form submission.
if ( isset( $_POST['rowhome_update_profile'] ) ) {
    if ( ! wp_verify_nonce( $_POST['_wpnonce_profile'] ?? '', 'rowhome_update_profile' ) ) {
        $error_message = 'Security check failed. Please try again.';
    } else {
        $user_id = get_current_user_id();
        $data    = array( 'ID' => $user_id );

        $first_name = sanitize_text_field( $_POST['first_name'] ?? '' );
        $last_name  = sanitize_text_field( $_POST['last_name'] ?? '' );
        $new_email  = sanitize_email( $_POST['user_email'] ?? '' );

        if ( $first_name ) {
            update_user_meta( $user_id, 'first_name', $first_name );
        }
        if ( $last_name ) {
            update_user_meta( $user_id, 'last_name', $last_name );
        }
        if ( $new_email && is_email( $new_email ) && $new_email !== wp_get_current_user()->user_email ) {
            if ( email_exists( $new_email ) && email_exists( $new_email ) !== $user_id ) {
                $error_message = 'That email address is already in use.';
            } else {
                $data['user_email'] = $new_email;
            }
        }

        // Password change — only if both fields are filled and match.
        $new_pass1 = $_POST['new_password'] ?? '';
        $new_pass2 = $_POST['new_password_confirm'] ?? '';
        if ( $new_pass1 || $new_pass2 ) {
            if ( $new_pass1 !== $new_pass2 ) {
                $error_message = 'Passwords do not match.';
            } elseif ( strlen( $new_pass1 ) < 8 ) {
                $error_message = 'Password must be at least 8 characters.';
            } else {
                $data['user_pass'] = $new_pass1;
            }
        }

        if ( ! $error_message ) {
            $result = wp_update_user( $data );
            if ( is_wp_error( $result ) ) {
                $error_message = $result->get_error_message();
            } else {
                $success_message = 'Profile updated successfully.';
            }
        }
    }
}

// Notification preferences form submission.
if ( isset( $_POST['rowhome_update_notifications'] ) ) {
    if ( ! wp_verify_nonce( $_POST['_wpnonce_notifications'] ?? '', 'rowhome_update_notifications' ) ) {
        $error_message = 'Security check failed. Please try again.';
    } else {
        $user_id     = get_current_user_id();
        $newsletter  = isset( $_POST['newsletter_optin'] ) ? '1' : '0';
        update_user_meta( $user_id, 'rowhome_newsletter_optin', $newsletter );
        $success_message = 'Notification preferences saved.';
    }
}

// ── Current user data ─────────────────────────────────────────────────────────
$current_user    = wp_get_current_user();
$user_id         = $current_user->ID;
$first_name      = get_user_meta( $user_id, 'first_name', true );
$last_name       = get_user_meta( $user_id, 'last_name', true );
$newsletter_optin = get_user_meta( $user_id, 'rowhome_newsletter_optin', true );
// Default new users to opted-in.
if ( $newsletter_optin === '' ) {
    $newsletter_optin = '1';
}

// Subscription plan from user meta (set via Stripe webhook or admin).
$subscription_plan   = get_user_meta( $user_id, 'rowhome_subscription_plan', true );
$subscription_status = get_user_meta( $user_id, 'rowhome_subscription_status', true );
$subscription_until  = get_user_meta( $user_id, 'rowhome_subscription_until', true );

// Stripe Billing Portal URL (configurable via Settings → RowHome).
$stripe_portal_url = get_option( 'rowhome_stripe_portal_url', '' );

// Determine active tab from query string (default to 'subscription').
$active_tab = in_array( $_GET['tab'] ?? '', array( 'profile', 'notifications' ), true )
    ? sanitize_key( $_GET['tab'] )
    : 'subscription';

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main my-account-page">

        <div class="my-account-hero">
            <div class="container">
                <h1 class="my-account-title">My Account</h1>
                <p class="my-account-greeting">Welcome back, <?php echo esc_html( $first_name ?: $current_user->display_name ); ?>.</p>
            </div>
        </div>

        <div class="container my-account-container">

            <?php if ( $success_message ) : ?>
                <div class="my-account-notice my-account-notice--success"><?php echo esc_html( $success_message ); ?></div>
            <?php endif; ?>
            <?php if ( $error_message ) : ?>
                <div class="my-account-notice my-account-notice--error"><?php echo esc_html( $error_message ); ?></div>
            <?php endif; ?>

            <!-- Tab navigation -->
            <nav class="my-account-tabs" aria-label="Account sections">
                <a href="?tab=subscription" class="my-account-tab <?php echo $active_tab === 'subscription' ? 'is-active' : ''; ?>">Subscription</a>
                <a href="?tab=profile" class="my-account-tab <?php echo $active_tab === 'profile' ? 'is-active' : ''; ?>">Profile</a>
                <a href="?tab=notifications" class="my-account-tab <?php echo $active_tab === 'notifications' ? 'is-active' : ''; ?>">Notifications</a>
            </nav>

            <!-- ── SUBSCRIPTION TAB ─────────────────────────────── -->
            <?php if ( $active_tab === 'subscription' ) : ?>
            <section class="my-account-section" id="tab-subscription">
                <h2 class="my-account-section-title">Your Subscription</h2>

                <?php if ( $subscription_plan ) : ?>
                <div class="subscription-status-card subscription-status-card--active">
                    <div class="subscription-status-badge">Active</div>
                    <h3 class="subscription-plan-name"><?php echo esc_html( $subscription_plan ); ?></h3>
                    <?php if ( $subscription_until ) : ?>
                    <p class="subscription-renewal">
                        <?php echo $subscription_status === 'cancelled' ? 'Access until' : 'Renews on'; ?>:
                        <strong><?php echo esc_html( date( 'F j, Y', strtotime( $subscription_until ) ) ); ?></strong>
                    </p>
                    <?php endif; ?>

                    <?php if ( $stripe_portal_url ) : ?>
                    <div class="subscription-actions">
                        <a href="<?php echo esc_url( $stripe_portal_url ); ?>" class="btn-my-account-primary" target="_blank" rel="noopener">
                            Manage Payment &amp; Billing
                        </a>
                    </div>
                    <?php else : ?>
                    <div class="subscription-actions">
                        <a href="mailto:subscribe@rowhomemag.com?subject=Billing%20Help" class="btn-my-account-secondary">
                            Contact Us for Billing Help
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <?php else : ?>
                <!-- No active subscription found -->
                <div class="subscription-status-card subscription-status-card--inactive">
                    <h3>No Active Subscription</h3>
                    <p>You don't have an active RowHome Magazine subscription yet. Subscribe to unlock full digital access, the weekly newsletter, and exclusive Philly content.</p>
                    <div class="subscription-actions">
                        <a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="btn-my-account-primary">View Subscription Plans</a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Available plans summary -->
                <div class="subscription-plans-overview">
                    <h3 class="subscription-plans-heading">Available Plans</h3>
                    <div class="subscription-plans-grid">
                        <div class="subscription-plan-item">
                            <strong>Digital Access</strong>
                            <span>$29 / year</span>
                            <small>Full digital archive + weekly e-newsletter</small>
                        </div>
                        <div class="subscription-plan-item">
                            <strong>Print Edition</strong>
                            <span>$49 / year</span>
                            <small>6 print issues delivered to your door</small>
                        </div>
                        <div class="subscription-plan-item subscription-plan-item--featured">
                            <strong>Print + Digital Bundle</strong>
                            <span>$69 / year</span>
                            <small>Everything + exclusive subscriber events</small>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="btn-my-account-link">See full plan details →</a>
                </div>
            </section>

            <!-- ── PROFILE TAB ──────────────────────────────────── -->
            <?php elseif ( $active_tab === 'profile' ) : ?>
            <section class="my-account-section" id="tab-profile">
                <h2 class="my-account-section-title">Profile Settings</h2>
                <form method="post" class="my-account-form">
                    <?php wp_nonce_field( 'rowhome_update_profile', '_wpnonce_profile' ); ?>
                    <input type="hidden" name="rowhome_update_profile" value="1">

                    <div class="form-row form-row--split">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name"
                                value="<?php echo esc_attr( $first_name ); ?>" class="my-account-input">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name"
                                value="<?php echo esc_attr( $last_name ); ?>" class="my-account-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email Address</label>
                        <input type="email" id="user_email" name="user_email"
                            value="<?php echo esc_attr( $current_user->user_email ); ?>" class="my-account-input">
                    </div>

                    <hr class="form-divider">
                    <h3 class="form-section-heading">Change Password</h3>
                    <p class="form-hint">Leave blank to keep your current password.</p>

                    <div class="form-row form-row--split">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password"
                                autocomplete="new-password" class="my-account-input">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirm">Confirm New Password</label>
                            <input type="password" id="new_password_confirm" name="new_password_confirm"
                                autocomplete="new-password" class="my-account-input">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-my-account-primary">Save Profile</button>
                    </div>
                </form>
            </section>

            <!-- ── NOTIFICATIONS TAB ────────────────────────────── -->
            <?php elseif ( $active_tab === 'notifications' ) : ?>
            <section class="my-account-section" id="tab-notifications">
                <h2 class="my-account-section-title">Notification Preferences</h2>
                <form method="post" class="my-account-form">
                    <?php wp_nonce_field( 'rowhome_update_notifications', '_wpnonce_notifications' ); ?>
                    <input type="hidden" name="rowhome_update_notifications" value="1">

                    <div class="notification-option">
                        <label class="notification-label">
                            <input type="checkbox" name="newsletter_optin" value="1"
                                <?php checked( $newsletter_optin, '1' ); ?>>
                            <span class="notification-text">
                                <strong>Weekly Newsletter</strong>
                                <small>Get the best of Philadelphia delivered to your inbox every week — neighborhood news, food, culture, and more.</small>
                            </span>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-my-account-primary">Save Preferences</button>
                    </div>
                </form>
            </section>
            <?php endif; ?>

            <!-- Log out link -->
            <div class="my-account-logout">
                <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="my-account-logout-link">
                    Log Out
                </a>
            </div>

        </div><!-- .my-account-container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
