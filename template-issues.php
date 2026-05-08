<?php
/**
 * Template Name: Magazine Issues Archive
 *
 * Archive of all Philadelphia RowHome Magazine print issues.
 * Displays issue covers, dates, and descriptions in a grid layout.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();

// Static issue data — replace or augment with a custom post type as issues are added
$magazine_issues = array(
    array(
        'number'      => 'Vol. 14, No. 6',
        'date'        => 'Winter 2024',
        'title'       => 'The Great Indoors',
        'description' => 'Cozy up with our guide to the best indoor destinations, warm-weather recipes, and row home renovation ideas for the coldest months.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-winter-2024.jpg',
        'cover_alt'   => 'RowHome Magazine Winter 2024 Cover',
        'color'       => '#5f8a8b',
    ),
    array(
        'number'      => 'Vol. 14, No. 5',
        'date'        => 'Fall 2024',
        'title'       => 'Neighbors & Neighborhoods',
        'description' => 'A deep dive into Philadelphia\'s most vibrant neighborhoods — from Fishtown to Fairmount, we explore what makes each block unique.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-fall-2024.jpg',
        'cover_alt'   => 'RowHome Magazine Fall 2024 Cover',
        'color'       => '#8B4513',
    ),
    array(
        'number'      => 'Vol. 14, No. 4',
        'date'        => 'Summer 2024',
        'title'       => 'Philly Eats: The Summer Edition',
        'description' => 'BYOB gems, rooftop dining, and the cheesesteak debates that never get old. Our definitive summer food guide.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-summer-2024.jpg',
        'cover_alt'   => 'RowHome Magazine Summer 2024 Cover',
        'color'       => '#FF6B35',
    ),
    array(
        'number'      => 'Vol. 14, No. 3',
        'date'        => 'Spring 2024',
        'title'       => 'Green Streets: Gardens &amp; Outdoors',
        'description' => 'Row home gardens, Wissahickon trails, and the urban farmers turning Philly\'s alleys into oases of green.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-spring-2024.jpg',
        'cover_alt'   => 'RowHome Magazine Spring 2024 Cover',
        'color'       => '#2E7D32',
    ),
    array(
        'number'      => 'Vol. 14, No. 2',
        'date'        => 'March/April 2024',
        'title'       => 'The Class of Philadelphia',
        'description' => 'Celebrating Philadelphia\'s institutions — from Drexel to the Academy of Music — and the people who keep them world-class.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-marapr-2024.jpg',
        'cover_alt'   => 'RowHome Magazine March/April 2024 Cover',
        'color'       => '#1A237E',
    ),
    array(
        'number'      => 'Vol. 14, No. 1',
        'date'        => 'January/February 2024',
        'title'       => 'Fresh Starts',
        'description' => 'New year, new Philly. Meet the entrepreneurs, artists, and community leaders driving Philadelphia forward in 2024.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-janfeb-2024.jpg',
        'cover_alt'   => 'RowHome Magazine January/February 2024 Cover',
        'color'       => '#37474F',
    ),
    array(
        'number'      => 'Vol. 13, No. 6',
        'date'        => 'Winter 2023',
        'title'       => 'Best of Philly 2023',
        'description' => 'Our annual Best of Philly awards — the restaurants, shops, people, and places that defined a year in the city.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-winter-2023.jpg',
        'cover_alt'   => 'RowHome Magazine Winter 2023 Cover',
        'color'       => '#FF0000',
        'featured'    => true,
    ),
    array(
        'number'      => 'Vol. 13, No. 5',
        'date'        => 'Fall 2023',
        'title'       => 'Real Estate Rising',
        'description' => 'Philly\'s housing market, row home investment strategies, and the communities shaping where people want to live.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-fall-2023.jpg',
        'cover_alt'   => 'RowHome Magazine Fall 2023 Cover',
        'color'       => '#4A148C',
    ),
    array(
        'number'      => 'Vol. 13, No. 4',
        'date'        => 'Summer 2023',
        'title'       => 'The Art of Living Here',
        'description' => 'Philadelphia\'s art scene, from murals to museums, and the creatives making the city their canvas.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-summer-2023.jpg',
        'cover_alt'   => 'RowHome Magazine Summer 2023 Cover',
        'color'       => '#E65100',
    ),
    array(
        'number'      => 'Vol. 13, No. 3',
        'date'        => 'Spring 2023',
        'title'       => 'Brides of Philadelphia',
        'description' => 'Philly weddings done right — venues, vendors, and real Philadelphia love stories to inspire your big day.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-spring-2023.jpg',
        'cover_alt'   => 'RowHome Magazine Spring 2023 Cover',
        'color'       => '#AD1457',
    ),
    array(
        'number'      => 'Vol. 13, No. 2',
        'date'        => 'March/April 2023',
        'title'       => 'Sports City',
        'description' => 'Eagles, Phillies, Sixers, Flyers — we go deep on Philadelphia\'s sports culture and the fans who bleed green.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-marapr-2023.jpg',
        'cover_alt'   => 'RowHome Magazine March/April 2023 Cover',
        'color'       => '#004C97',
    ),
    array(
        'number'      => 'Vol. 13, No. 1',
        'date'        => 'January/February 2023',
        'title'       => 'The Decade Ahead',
        'description' => 'Visionaries weigh in on where Philadelphia is headed — in tech, arts, development, and community.',
        'cover'       => get_template_directory_uri() . '/assets/images/issue-janfeb-2023.jpg',
        'cover_alt'   => 'RowHome Magazine January/February 2023 Cover',
        'color'       => '#263238',
    ),
);
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero -->
        <div class="issues-hero">
            <div class="container">
                <p class="issues-hero__eyebrow">Philadelphia RowHome Magazine</p>
                <h1 class="issues-hero__title">Past Issues</h1>
                <p class="issues-hero__subtitle">Browse every issue of RowHome Magazine — 16 years of Philadelphia living, neighborhoods, culture, and community.</p>
                <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="subscribe-btn">Subscribe to Never Miss an Issue</a>
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
                        <img
                            src="<?php echo esc_url($latest['cover']); ?>"
                            alt="<?php echo esc_attr($latest['cover_alt']); ?>"
                            onerror="this.src='https://placehold.co/400x520/<?php echo ltrim($latest['color'], '#'); ?>/ffffff?text=<?php echo rawurlencode($latest['date']); ?>'"
                        >
                        <span class="issues-latest__badge">Latest Issue</span>
                    </div>
                    <div class="issues-latest__content">
                        <p class="issues-latest__number"><?php echo esc_html($latest['number']); ?> &mdash; <?php echo esc_html($latest['date']); ?></p>
                        <h2 class="issues-latest__title"><?php echo esc_html($latest['title']); ?></h2>
                        <p class="issues-latest__desc"><?php echo wp_kses_post($latest['description']); ?></p>
                        <div class="issues-latest__actions">
                            <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="subscribe-btn-primary">Read This Issue</a>
                            <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="subscribe-btn-secondary">Subscribe for Access</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- All Issues Grid -->
            <section class="issues-archive">
                <div class="section-header">
                    <h2 class="section-title">All Issues</h2>
                </div>

                <div class="issues-grid">
                    <?php foreach ($magazine_issues as $index => $issue) :
                        if ($index === 0) continue; // Skip latest — shown above
                        $hex_color = ltrim(isset($issue['color']) ? $issue['color'] : '#5f8a8b', '#');
                    ?>
                    <div class="issue-card<?php echo !empty($issue['featured']) ? ' issue-card--featured' : ''; ?>">
                        <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="issue-card__link">
                            <div class="issue-card__cover">
                                <img
                                    src="<?php echo esc_url($issue['cover']); ?>"
                                    alt="<?php echo esc_attr($issue['cover_alt']); ?>"
                                    loading="lazy"
                                    onerror="this.src='https://placehold.co/300x390/<?php echo esc_attr($hex_color); ?>/ffffff?text=<?php echo rawurlencode($issue['date']); ?>'"
                                >
                                <?php if (!empty($issue['featured'])) : ?>
                                    <span class="issue-card__badge">Award Issue</span>
                                <?php endif; ?>
                                <div class="issue-card__overlay">
                                    <span class="issue-card__read-btn">Read Issue</span>
                                </div>
                            </div>
                            <div class="issue-card__meta">
                                <p class="issue-card__number"><?php echo esc_html($issue['number']); ?></p>
                                <h3 class="issue-card__title"><?php echo esc_html($issue['title']); ?></h3>
                                <p class="issue-card__date"><?php echo esc_html($issue['date']); ?></p>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>

            </section>

            <!-- Subscribe CTA Banner -->
            <div class="issues-subscribe-cta">
                <div class="issues-subscribe-cta__content">
                    <h2>Never Miss an Issue</h2>
                    <p>Subscribe to Philadelphia RowHome Magazine and get every issue delivered — print, digital, or both.</p>
                </div>
                <div class="issues-subscribe-cta__actions">
                    <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="subscribe-btn-primary">See Subscription Plans</a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="subscribe-btn-secondary">Contact Us</a>
                </div>
            </div>

        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
