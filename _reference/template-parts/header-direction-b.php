<?php
/**
 * Direction B Header — Three-row RHHeader (light variant)
 * Used on all pages except homepage (which uses CoverMasthead).
 *
 * @package RowHome_Magazine
 * @since 2.0.0
 * @see SIR-775
 */

// Current user for auth state
$is_logged_in  = is_user_logged_in();
$current_user  = $is_logged_in ? wp_get_current_user() : null;

// Umbrella sections for nav row
$umbrella_sections = array(
    'Life'        => home_url('/life'),
    'Business'    => home_url('/business'),
    'Arts'        => home_url('/arts'),
    'Lifestyle'   => home_url('/lifestyle'),
    'Sports'      => home_url('/sports'),
    'Environment' => home_url('/environment'),
);

// Detect active section from current page/taxonomy
$active_section = '';
if (is_tax('department_category')) {
    $term = get_queried_object();
    if ($term) {
        $active_section = sanitize_title($term->name);
    }
}
?>

<header class="rh-header rh-header--light" role="banner">
    <!-- Row 1: Dateline -->
    <div class="rh-header__dateline">
        <div class="rh-container">
            <div class="rh-header__dateline-inner">
                <span class="rh-header__dateline-left">
                    Philadelphia, PA &middot; <?php echo date_i18n('l, F j, Y'); ?>
                </span>
                <span class="rh-header__dateline-right">
                    Issue 03 &middot;
                    <span class="rh-header__weather">72&deg;F Sunny</span>
                    &middot;
                    <span class="rh-header__score">Sixers <strong>112</strong>&ndash;98</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Row 2: Masthead -->
    <div class="rh-header__masthead">
        <div class="rh-container">
            <div class="rh-header__masthead-inner">
                <!-- Left: Section toggle + Search -->
                <div class="rh-header__masthead-left">
                    <button class="rh-header__ghost-btn" id="rh-sections-toggle" aria-label="Toggle sections" aria-expanded="false" type="button">
                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <line x1="1" y1="1" x2="17" y2="1"/>
                            <line x1="1" y1="7" x2="17" y2="7"/>
                            <line x1="1" y1="13" x2="17" y2="13"/>
                        </svg>
                        <span>Sections</span>
                    </button>
                    <button class="rh-header__ghost-btn" id="rh-search-toggle" aria-label="Search" type="button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <span>Search</span>
                    </button>
                </div>

                <!-- Center: Wordmark -->
                <div class="rh-header__wordmark">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="rh-header__wordmark-link" rel="home">
                        <span class="rh-header__wordmark-text">Row<em>Home</em></span>
                    </a>
                    <span class="rh-header__tagline">River to River. One Neighborhood.</span>
                </div>

                <!-- Right: Subscribe + Auth -->
                <div class="rh-header__masthead-right">
                    <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="rh-header__subscribe-link">Subscribe &middot; $1/wk</a>
                    <?php if ($is_logged_in) : ?>
                        <div class="rh-header__user-menu">
                            <button class="rh-header__user-btn" aria-label="Account menu" aria-expanded="false" type="button">
                                <?php
                                $google_avatar = get_user_meta($current_user->ID, 'rowhome_google_avatar', true);
                                $avatar_url    = $google_avatar ? $google_avatar : get_avatar_url($current_user->ID, array('size' => 64));
                                if ($avatar_url) :
                                ?>
                                    <img src="<?php echo esc_url($avatar_url); ?>" alt="" class="rh-header__avatar" width="28" height="28" referrerpolicy="no-referrer">
                                <?php else : ?>
                                    <span class="rh-header__avatar-initial"><?php echo esc_html(mb_strtoupper(mb_substr($current_user->display_name, 0, 1))); ?></span>
                                <?php endif; ?>
                            </button>
                            <div class="rh-header__dropdown" role="menu">
                                <div class="rh-header__dropdown-header">
                                    <span class="rh-header__dropdown-name"><?php echo esc_html($current_user->display_name); ?></span>
                                    <span class="rh-header__dropdown-email"><?php echo esc_html($current_user->user_email); ?></span>
                                </div>
                                <a href="<?php echo esc_url(home_url('/my-account/')); ?>" class="rh-header__dropdown-item" role="menuitem">My Account</a>
                                <a href="<?php echo esc_url(home_url('/my-account/?tab=notifications')); ?>" class="rh-header__dropdown-item" role="menuitem">Notifications</a>
                                <div class="rh-header__dropdown-divider"></div>
                                <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="rh-header__dropdown-item rh-header__dropdown-logout" role="menuitem">Log Out</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="rh-header__login-btn">Log In</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Navigation -->
    <nav class="rh-header__nav" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'rowhome-magazine'); ?>">
        <div class="rh-container">
            <div class="rh-header__nav-inner">
                <?php foreach ($umbrella_sections as $label => $url) :
                    $slug = sanitize_title($label);
                    $is_active = ($active_section === $slug);
                ?>
                    <a href="<?php echo esc_url($url); ?>" class="rh-header__nav-link<?php echo $is_active ? ' rh-header__nav-link--active' : ''; ?>">
                        <?php echo esc_html($label); ?>
                    </a>
                <?php endforeach; ?>
                <a href="<?php echo esc_url(home_url('/departments')); ?>" class="rh-header__nav-link">A&ndash;Z Index</a>
            </div>
        </div>
    </nav>
</header>
