<?php
/**
 * Template Name: Magazine Issues Archive
 *
 * Archive of Philadelphia RowHome Magazine print issues.
 * Covers and issue data come from the magazine's Issuu library
 * (https://issuu.com/philadelphiarowhomemagazine). Add a new issue to
 * the top of $magazine_issues and drop its cover in assets/images/issues/.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();

$rh_issuu_profile = 'https://issuu.com/philadelphiarowhomemagazine';
$rh_cover_base    = get_template_directory_uri() . '/assets/images/issues/';

// Newest first. 'issuu' is the document slug on the Issuu profile.
$magazine_issues = array(
    array(
        'season'   => 'Summer 2026',
        'months'   => 'July / August / September 2026',
        'number'   => 'Vol. 72, Issue 82',
        'title'    => 'Hot Spots 2026',
        'blurb'    => 'Our annual Hot Spots guide, plus "Teach Our Children to Dream&hellip; One Wish at a Time."',
        'cover'    => 'summer-2026.jpg',
        'issuu'    => 'prh_summer2026v3',
    ),
    array(
        'season'   => 'Spring 2026',
        'months'   => 'April / May / June 2026',
        'number'   => 'Vol. 71, Issue 81',
        'title'    => 'America 250: All Eyes On Us',
        'blurb'    => 'Philadelphia takes center stage for the nation&rsquo;s 250th birthday.',
        'cover'    => 'spring-2026.jpg',
        'issuu'    => 'prh_spring2026',
    ),
    array(
        'season'   => 'Winter 2026',
        'months'   => 'January / February / March 2026',
        'number'   => 'Vol. 70, Issue 80',
        'title'    => 'Foods from the Family Archives',
        'blurb'    => 'Gran Caffe L&rsquo;Aquila and the recipes handed down through generations.',
        'cover'    => 'winter-2026.jpg',
        'issuu'    => 'prh_winter2025',
    ),
    array(
        'season'   => 'Fall 2025',
        'months'   => 'October / November / December 2025',
        'number'   => 'Vol. 69, Issue 79',
        'title'    => 'Salute to Service 2025',
        'blurb'    => 'Meet the 2025 Blue Sapphire Award winners.',
        'cover'    => 'fall-2025.jpg',
        'issuu'    => 'prh_fall2025_54591a74bfb9c1',
        'featured' => true,
    ),
    array(
        'season'   => 'Summer 2025',
        'months'   => 'July / August / September 2025',
        'number'   => 'Vol. 68, Issue 78',
        'title'    => 'Skinny Joey&rsquo;s Cheesesteaks',
        'blurb'    => 'Hot Spots 2025, and a save-the-date for the Blue Sapphire Awards at Vie by Cescaphe.',
        'cover'    => 'summer-2025.jpg',
        'issuu'    => 'prh_summer2025',
    ),
    array(
        'season'   => 'Spring 2025',
        'months'   => 'April / May / June 2025',
        'number'   => 'Vol. 67, Issue 77',
        'title'    => 'Philadelphia Eagles Win Super Bowl LIX',
        'blurb'    => 'Back to Broad Street with the Birds: more than a million fans love a parade.',
        'cover'    => 'spring-2025.jpg',
        'issuu'    => 'prh_spring2025',
    ),
    array(
        'season'   => 'Winter 2025',
        'months'   => 'January / February / March 2025',
        'number'   => 'Vol. 66, Issue 76',
        'title'    => 'The New King of Philly Combat Sports',
        'blurb'    => 'Bare Knuckle Fighting Championship founder and president David Feldman.',
        'cover'    => 'winter-2025.jpg',
        'issuu'    => 'winter_2025',
    ),
    array(
        'season'   => 'Fall 2024',
        'months'   => 'October / November / December 2024',
        'number'   => 'Vol. 65, Issue 75',
        'title'    => 'Salute to Service 2024',
        'blurb'    => 'The 2024 Blue Sapphire Award winners, in our 20th anniversary year.',
        'cover'    => 'fall-2024.jpg',
        'issuu'    => 'link_2_',
        'featured' => true,
    ),
    array(
        'season'   => 'Summer 2024',
        'months'   => 'July / August / September 2024',
        'number'   => 'Vol. 64, Issue 74',
        'title'    => 'An Affair to Remember XVII',
        'blurb'    => 'Save the date for the red carpet at Vie by Cescaphe, and the 2024 Blue Sapphire Award announcement.',
        'cover'    => 'summer-2024.jpg',
        'issuu'    => '1.-prh_summer2024_6',
    ),
    array(
        'season'   => 'Spring 2024',
        'months'   => 'April / May / June 2024',
        'number'   => 'Vol. 63, Issue 73',
        'title'    => 'The Building of a Magazine',
        'blurb'    => 'Our 20th Anniversary Issue: two decades in the heart of South Philly.',
        'cover'    => 'spring-2024.jpg',
        'issuu'    => 'prh_spring2024',
    ),
);

$rh_issue_url = function ( $issue ) use ( $rh_issuu_profile ) {
    return $rh_issuu_profile . '/docs/' . $issue['issuu'];
};
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero -->
        <div class="issues-hero">
            <div class="container">
                <p class="issues-hero__eyebrow">Philadelphia RowHome Magazine</p>
                <h1 class="issues-hero__title">In the Magazine</h1>
                <p class="issues-hero__subtitle">Every issue since 2004 tells the story of Philadelphia one block at a time. Read recent issues online, or subscribe to get the print edition at home.</p>
                <a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="subscribe-btn">Subscribe to the Print Edition</a>
            </div>
        </div>

        <div class="container">

            <!-- Latest Issue Feature -->
            <?php $latest = $magazine_issues[0]; ?>
            <section class="issues-latest">
                <div class="section-header">
                    <h2 class="section-title">Current Issue</h2>
                </div>
                <div class="issues-latest__card">
                    <div class="issues-latest__cover">
                        <a href="<?php echo esc_url( $rh_issue_url( $latest ) ); ?>" target="_blank" rel="noopener">
                            <img
                                src="<?php echo esc_url( $rh_cover_base . $latest['cover'] ); ?>"
                                alt="<?php echo esc_attr( 'Philadelphia RowHome Magazine ' . $latest['season'] . ' cover' ); ?>"
                                width="640" height="831"
                            >
                        </a>
                        <span class="issues-latest__badge">Latest Issue</span>
                    </div>
                    <div class="issues-latest__content">
                        <p class="issues-latest__number"><?php echo esc_html( $latest['number'] ); ?> &mdash; <?php echo esc_html( $latest['months'] ); ?></p>
                        <h2 class="issues-latest__title"><?php echo wp_kses_post( $latest['title'] ); ?></h2>
                        <p class="issues-latest__desc"><?php echo wp_kses_post( $latest['blurb'] ); ?></p>
                        <div class="issues-latest__actions">
                            <a href="<?php echo esc_url( $rh_issue_url( $latest ) ); ?>" class="subscribe-btn-primary" target="_blank" rel="noopener">Read This Issue Online</a>
                            <a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="subscribe-btn-secondary">Get It in Print</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Past Issues Grid -->
            <section class="issues-archive">
                <div class="section-header">
                    <h2 class="section-title">Past Issues</h2>
                </div>

                <div class="issues-grid">
                    <?php foreach ( $magazine_issues as $index => $issue ) :
                        if ( $index === 0 ) {
                            continue; // Latest issue is shown above.
                        }
                    ?>
                    <div class="issue-card<?php echo ! empty( $issue['featured'] ) ? ' issue-card--featured' : ''; ?>">
                        <a href="<?php echo esc_url( $rh_issue_url( $issue ) ); ?>" class="issue-card__link" target="_blank" rel="noopener">
                            <div class="issue-card__cover">
                                <img
                                    src="<?php echo esc_url( $rh_cover_base . $issue['cover'] ); ?>"
                                    alt="<?php echo esc_attr( 'Philadelphia RowHome Magazine ' . $issue['season'] . ' cover' ); ?>"
                                    width="640" height="831"
                                    loading="lazy"
                                >
                                <?php if ( ! empty( $issue['featured'] ) ) : ?>
                                    <span class="issue-card__badge">Awards Issue</span>
                                <?php endif; ?>
                                <div class="issue-card__overlay">
                                    <span class="issue-card__read-btn">Read Online</span>
                                </div>
                            </div>
                            <div class="issue-card__meta">
                                <p class="issue-card__number"><?php echo esc_html( $issue['number'] ); ?></p>
                                <h3 class="issue-card__title"><?php echo wp_kses_post( $issue['title'] ); ?></h3>
                                <p class="issue-card__date"><?php echo esc_html( $issue['season'] ); ?></p>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>

                <p class="issues-archive__more">Looking for something older? The full library of back issues is on <a href="<?php echo esc_url( $rh_issuu_profile ); ?>" target="_blank" rel="noopener">our Issuu page</a>.</p>
            </section>

            <!-- Subscribe CTA Banner -->
            <div class="issues-subscribe-cta">
                <div class="issues-subscribe-cta__content">
                    <h2>Never Miss an Issue</h2>
                    <p>Philadelphia RowHome Magazine is published four times a year. Subscribe to have the print edition delivered to your door.</p>
                </div>
                <div class="issues-subscribe-cta__actions">
                    <a href="<?php echo esc_url( home_url( '/subscribe/' ) ); ?>" class="subscribe-btn-primary">Subscribe</a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="subscribe-btn-secondary">Contact Us</a>
                </div>
            </div>

        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
