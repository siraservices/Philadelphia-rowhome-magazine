<?php
/**
 * Template Name: Welcome
 *
 * First-login welcome page for new Google OAuth subscribers.
 * Greets by first name, collects department preferences (stored as
 * rowhome_preferred_departments user meta), and shows a Subscribe CTA
 * when the user has no active subscription.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require login — bounce guests back to wp-login.php.
if ( ! is_user_logged_in() ) {
	wp_safe_redirect( wp_login_url( get_permalink() ) );
	exit;
}

$current_user = wp_get_current_user();
$user_id      = $current_user->ID;

// If the user already completed the welcome flow, send them home.
if ( get_user_meta( $user_id, 'rowhome_welcome_shown', true ) === '1' ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}

// ── Handle form submission ─────────────────────────────────────────────────────

$error_message = '';

if ( isset( $_POST['rowhome_welcome_submit'] ) || isset( $_POST['rowhome_welcome_skip'] ) ) {
	if ( ! isset( $_POST['_wpnonce_welcome'] ) ||
		 ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_welcome'] ) ), 'rowhome_welcome_prefs' ) ) {
		$error_message = 'Security check failed. Please try again.';
	} else {
		if ( isset( $_POST['rowhome_welcome_submit'] ) ) {
			// Validate selections against the allowed department list.
			$valid_departments = array( 'life', 'business', 'arts', 'lifestyle', 'sports', 'environment' );
			$posted_depts      = isset( $_POST['departments'] ) && is_array( $_POST['departments'] )
				? $_POST['departments']
				: array();

			$selected = array_values( array_intersect( array_map( 'sanitize_key', $posted_depts ), $valid_departments ) );

			// Persist preferences.
			update_user_meta( $user_id, 'rowhome_preferred_departments', $selected );
		}

		// Mark welcome complete and clear the pending redirect flag.
		update_user_meta( $user_id, 'rowhome_welcome_shown', '1' );
		delete_user_meta( $user_id, 'rowhome_show_welcome' );

		wp_safe_redirect( home_url( '/' ) );
		exit;
	}
}

// ── Page data ──────────────────────────────────────────────────────────────────

$first_name        = get_user_meta( $user_id, 'first_name', true ) ?: $current_user->display_name;
$subscription_plan = get_user_meta( $user_id, 'rowhome_subscription_plan', true );
$is_paid_subscriber = ! empty( $subscription_plan );

$departments = array(
	'life'        => array(
		'label' => 'Life',
		'desc'  => 'Health, Fashion, Community',
		'color' => '#FF69B4',
	),
	'business'    => array(
		'label' => 'Business',
		'desc'  => 'Real Estate, Tech, Politics',
		'color' => '#5f8a8b',
	),
	'arts'        => array(
		'label' => 'Arts',
		'desc'  => 'Music & Art, Film, History',
		'color' => '#FF0000',
	),
	'lifestyle'   => array(
		'label' => 'Lifestyle',
		'desc'  => 'Food, Travel, Events',
		'color' => '#FFD700',
	),
	'sports'      => array(
		'label' => 'Sports',
		'desc'  => 'Philly teams &amp; local sports',
		'color' => '#4a7c59',
	),
	'environment' => array(
		'label' => 'Environment',
		'desc'  => 'Green spaces, sustainability',
		'color' => '#5c8a3c',
	),
);

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main welcome-page">

		<div class="welcome-hero">
			<div class="container">
				<p class="welcome-eyebrow">Philadelphia RowHome Magazine</p>
				<h1 class="welcome-title">Welcome<?php echo $first_name ? ', ' . esc_html( $first_name ) : ''; ?>!</h1>
				<p class="welcome-subtitle">You're in. Let's personalize your RowHome experience.</p>
			</div>
		</div>

		<div class="container welcome-container">

			<?php if ( $error_message ) : ?>
				<div class="welcome-notice welcome-notice--error"><?php echo esc_html( $error_message ); ?></div>
			<?php endif; ?>

			<form method="post" class="welcome-form">
				<?php wp_nonce_field( 'rowhome_welcome_prefs', '_wpnonce_welcome' ); ?>
				<input type="hidden" name="rowhome_welcome_submit" value="1">

				<!-- Department preferences -->
				<section class="welcome-section">
					<h2 class="welcome-section-title">What do you love about Philly?</h2>
					<p class="welcome-section-desc">Pick 2–3 topics and we'll surface the content that matters most to you.</p>

					<div class="welcome-departments">
						<?php foreach ( $departments as $slug => $dept ) : ?>
						<label class="welcome-dept-card" for="dept-<?php echo esc_attr( $slug ); ?>">
							<input
								type="checkbox"
								id="dept-<?php echo esc_attr( $slug ); ?>"
								name="departments[]"
								value="<?php echo esc_attr( $slug ); ?>"
								class="welcome-dept-checkbox"
							>
							<span class="welcome-dept-icon" style="background-color: <?php echo esc_attr( $dept['color'] ); ?>;"></span>
							<span class="welcome-dept-label"><?php echo esc_html( $dept['label'] ); ?></span>
							<span class="welcome-dept-desc"><?php echo wp_kses_post( $dept['desc'] ); ?></span>
							<span class="welcome-dept-check" aria-hidden="true">&#10003;</span>
						</label>
						<?php endforeach; ?>
					</div>
				</section>

				<!-- Subscribe CTA (only for non-subscribers) -->
				<?php if ( ! $is_paid_subscriber ) : ?>
				<section class="welcome-subscribe-cta">
					<div class="welcome-subscribe-inner">
						<h3 class="welcome-subscribe-title">Unlock All of RowHome</h3>
						<p class="welcome-subscribe-desc">Subscribe for full digital access, the weekly newsletter, and exclusive Philly content — starting at $29 / year.</p>
						<a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="welcome-btn-subscribe">
							See Subscription Plans
						</a>
					</div>
				</section>
				<?php endif; ?>

				<!-- Action buttons -->
				<div class="welcome-actions">
					<button type="submit" name="rowhome_welcome_submit" value="1" class="welcome-btn-primary">
						Save &amp; Start Reading
					</button>
					<button type="submit" name="rowhome_welcome_skip" value="1" class="welcome-btn-skip">
						Skip for now
					</button>
				</div>

			</form>

		</div><!-- .welcome-container -->

	</main><!-- #main -->
</div><!-- #primary -->

<style>
/* ── Welcome page styles ───────────────────────────────────── */
.welcome-page {
	background: #f5f5f5;
	min-height: 80vh;
}

.welcome-hero {
	background: #000;
	color: #fff;
	padding: 60px 0 48px;
	text-align: center;
}

.welcome-eyebrow {
	font-family: 'Montserrat', sans-serif;
	font-size: 12px;
	font-weight: 600;
	letter-spacing: 0.15em;
	text-transform: uppercase;
	color: #5f8a8b;
	margin: 0 0 12px;
}

.welcome-title {
	font-family: 'Instrument Serif', serif;
	font-size: clamp(2rem, 5vw, 3.5rem);
	font-weight: 400;
	margin: 0 0 16px;
	color: #fff;
}

.welcome-subtitle {
	font-family: 'Montserrat', sans-serif;
	font-size: 1.1rem;
	color: rgba(255,255,255,0.75);
	margin: 0;
}

.welcome-container {
	max-width: 800px;
	padding: 48px 20px 80px;
}

.welcome-notice--error {
	background: #fde8e8;
	border: 1px solid #FF0000;
	color: #c00;
	padding: 12px 16px;
	border-radius: 4px;
	font-family: 'Montserrat', sans-serif;
	font-size: 0.9rem;
	margin-bottom: 24px;
}

/* Section headings */
.welcome-section {
	background: #fff;
	border-radius: 8px;
	padding: 32px;
	margin-bottom: 24px;
	box-shadow: 0 1px 4px rgba(0,0,0,0.08);
}

.welcome-section-title {
	font-family: 'Instrument Serif', serif;
	font-size: 1.6rem;
	font-weight: 400;
	color: #000;
	margin: 0 0 8px;
}

.welcome-section-desc {
	font-family: 'Montserrat', sans-serif;
	font-size: 0.9rem;
	color: #666;
	margin: 0 0 28px;
}

/* Department card grid */
.welcome-departments {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
	gap: 16px;
}

.welcome-dept-card {
	position: relative;
	display: flex;
	flex-direction: column;
	align-items: flex-start;
	gap: 6px;
	padding: 20px 20px 20px 20px;
	border: 2px solid #e5e5e5;
	border-radius: 8px;
	cursor: pointer;
	transition: border-color 0.15s, box-shadow 0.15s;
	background: #fff;
	min-height: 100px;
}

.welcome-dept-card:hover {
	border-color: #5f8a8b;
	box-shadow: 0 2px 8px rgba(95,138,139,0.15);
}

.welcome-dept-checkbox {
	position: absolute;
	opacity: 0;
	width: 0;
	height: 0;
}

.welcome-dept-checkbox:checked ~ .welcome-dept-check {
	opacity: 1;
}

.welcome-dept-checkbox:checked + .welcome-dept-icon + .welcome-dept-label {
	color: #000;
}

/* Card checked state */
.welcome-dept-card:has(.welcome-dept-checkbox:checked) {
	border-color: #5f8a8b;
	background: #f0f7f7;
	box-shadow: 0 2px 8px rgba(95,138,139,0.2);
}

.welcome-dept-icon {
	width: 10px;
	height: 10px;
	border-radius: 50%;
	display: inline-block;
	margin-bottom: 2px;
	flex-shrink: 0;
}

.welcome-dept-label {
	font-family: 'Montserrat', sans-serif;
	font-size: 0.95rem;
	font-weight: 600;
	color: #333;
	line-height: 1.2;
}

.welcome-dept-desc {
	font-family: 'Montserrat', sans-serif;
	font-size: 0.78rem;
	color: #888;
	line-height: 1.4;
}

.welcome-dept-check {
	position: absolute;
	top: 12px;
	right: 14px;
	width: 22px;
	height: 22px;
	background: #5f8a8b;
	color: #fff;
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 13px;
	opacity: 0;
	transition: opacity 0.15s;
}

/* Subscribe CTA block */
.welcome-subscribe-cta {
	background: #000;
	border-radius: 8px;
	margin-bottom: 24px;
	overflow: hidden;
}

.welcome-subscribe-inner {
	padding: 32px;
	display: flex;
	flex-direction: column;
	align-items: flex-start;
	gap: 12px;
}

.welcome-subscribe-title {
	font-family: 'Instrument Serif', serif;
	font-size: 1.5rem;
	font-weight: 400;
	color: #fff;
	margin: 0;
}

.welcome-subscribe-desc {
	font-family: 'Montserrat', sans-serif;
	font-size: 0.9rem;
	color: rgba(255,255,255,0.75);
	margin: 0;
	max-width: 480px;
}

.welcome-btn-subscribe {
	display: inline-block;
	background: #5f8a8b;
	color: #fff;
	font-family: 'Montserrat', sans-serif;
	font-size: 0.85rem;
	font-weight: 600;
	letter-spacing: 0.05em;
	text-transform: uppercase;
	padding: 12px 24px;
	border-radius: 4px;
	text-decoration: none;
	transition: background 0.15s;
}

.welcome-btn-subscribe:hover {
	background: #4a6f70;
	color: #fff;
}

/* Action buttons */
.welcome-actions {
	display: flex;
	align-items: center;
	gap: 20px;
	flex-wrap: wrap;
}

.welcome-btn-primary {
	background: #000;
	color: #fff;
	font-family: 'Montserrat', sans-serif;
	font-size: 0.9rem;
	font-weight: 600;
	letter-spacing: 0.08em;
	text-transform: uppercase;
	padding: 16px 36px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	transition: background 0.15s;
}

.welcome-btn-primary:hover {
	background: #222;
}

.welcome-btn-skip {
	background: none;
	border: none;
	padding: 0;
	cursor: pointer;
	font-family: 'Montserrat', sans-serif;
	font-size: 0.85rem;
	color: #888;
	text-decoration: underline;
	text-underline-offset: 3px;
}

.welcome-btn-skip:hover {
	color: #333;
}

/* Responsive */
@media (max-width: 600px) {
	.welcome-hero {
		padding: 40px 0 32px;
	}
	.welcome-section {
		padding: 24px 16px;
	}
	.welcome-departments {
		grid-template-columns: 1fr 1fr;
	}
	.welcome-subscribe-inner {
		padding: 24px 16px;
	}
}
</style>

<?php get_footer(); ?>
