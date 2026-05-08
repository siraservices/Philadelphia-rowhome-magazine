<?php
/**
 * Direction B Footer — RHFooter
 * Masthead, 7-col department grid, copyright row.
 *
 * @package RowHome_Magazine
 * @since 2.0.0
 * @see SIR-775
 */

// All 21 departments for the footer grid
$departments = array(
    'Health', 'Fashion', 'Brides Guide', 'Community', 'Writers Block',
    'Real Estate', 'Tech', 'Education', 'Politics',
    'Music & Art', 'Film', 'Flashback', 'History',
    'Menu', 'Travel', '2025 Hotspots', 'Events',
    'Sports', 'Environment', 'Games', 'People'
);

$utility_links = array(
    'About'     => home_url('/about'),
    'Contact'   => home_url('/contact'),
    'Advertise' => home_url('/advertise'),
    'Privacy'   => home_url('/privacy'),
    'Terms'     => home_url('/terms'),
    'Subscribe' => home_url('/subscribe'),
);
?>

<footer class="rh-footer" role="contentinfo">
    <!-- Masthead + Tagline -->
    <div class="rh-footer__masthead">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="rh-footer__wordmark" rel="home">
            Row<em>Home</em>
        </a>
        <p class="rh-footer__tagline">River to River. One Neighborhood.</p>
    </div>

    <!-- Department Grid (7 columns) -->
    <div class="rh-footer__departments">
        <div class="rh-container">
            <div class="rh-footer__dept-grid">
                <?php foreach ($departments as $dept) :
                    $dept_slug = sanitize_title($dept);
                    $dept_term = get_term_by('slug', $dept_slug, 'department_category');
                    if (!$dept_term) {
                        $dept_term = get_term_by('slug', 'dept-' . $dept_slug, 'department_category');
                        $dept_slug = $dept_term ? $dept_term->slug : $dept_slug;
                    }
                ?>
                    <a href="<?php echo esc_url(home_url('/department_category/' . $dept_slug)); ?>" class="rh-footer__dept-link">
                        <?php echo esc_html($dept); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Copyright Row -->
    <div class="rh-footer__bottom">
        <div class="rh-container">
            <div class="rh-footer__bottom-inner">
                <p class="rh-footer__copyright">
                    &copy; <?php echo date_i18n('Y'); ?> Philadelphia RowHome Magazine. All Rights Reserved.
                </p>
                <div class="rh-footer__utility-links">
                    <?php foreach ($utility_links as $label => $url) : ?>
                        <a href="<?php echo esc_url($url); ?>" class="rh-footer__utility-link"><?php echo esc_html($label); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
