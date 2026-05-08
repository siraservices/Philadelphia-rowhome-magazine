<?php
/**
 * Direction B — Homepage
 *
 * Sections (top to bottom):
 *   1. CoverMasthead  — full-bleed 980px, mix-blend-mode:difference wordmark
 *   2. In This Issue  — left heading, right 2-col 6-item ContentsRow grid
 *   3. Sponsor strip  — 970×90 leaderboard (hidden for rh-density-subtle)
 *   4. The Hot List   — section header w/ rules, 3-col grid + sidebar
 *   5. Dept Spotlights — 3 tinted panels (Food / Real Estate / Arts)
 *   6. All Departments — centered h2 + 21-item 3-col index grid
 *
 * @package RowHome_Magazine
 * @since 2.0.0
 * @see SIR-777, SIR-775 §2.1
 */

get_header('homepage');

/* ================================================================
   DATA QUERIES
   ================================================================ */

// ── Cover story: sticky post first, fall back to latest ──────────
$sticky_ids = get_option('sticky_posts');
if (!empty($sticky_ids)) {
    $cover_q = new WP_Query(array(
        'posts_per_page'      => 1,
        'post_type'           => array('post', 'department'),
        'post__in'            => $sticky_ids,
        'orderby'             => 'date',
        'order'               => 'DESC',
        'ignore_sticky_posts' => 0,
    ));
    if (!$cover_q->have_posts()) {
        $cover_q = new WP_Query(array(
            'posts_per_page' => 1,
            'post_type'      => array('post', 'department'),
        ));
    }
} else {
    $cover_q = new WP_Query(array(
        'posts_per_page' => 1,
        'post_type'      => array('post', 'department'),
    ));
}

$cover_id    = 0;
$cover_title = 'Philadelphia at Its Best';
$cover_url   = home_url('/');
$cover_image = '';
$cover_kicker = '';

if ($cover_q->have_posts()) {
    $cover_q->the_post();
    $cover_id    = get_the_ID();
    $cover_title = get_the_title();
    $cover_url   = get_permalink();
    $cover_image = get_the_post_thumbnail_url(null, 'rowhome-hero');
    $cover_terms = get_the_terms($cover_id, 'department_category');
    if ($cover_terms && !is_wp_error($cover_terms)) {
        $cover_kicker = $cover_terms[0]->name . ' · The Cover Story';
    } else {
        $cover_kicker = 'Feature · The Cover Story';
    }
    wp_reset_postdata();
}

// ── Cover lines: 4 posts after the cover story ───────────────────
$exclude = $cover_id ? array($cover_id) : array();
$lines_q = new WP_Query(array(
    'posts_per_page' => 4,
    'post_type'      => array('post', 'department'),
    'post__not_in'   => $exclude,
    'orderby'        => 'date',
    'order'          => 'DESC',
));

// ── In This Issue: 6 most recent posts ───────────────────────────
$contents_q = new WP_Query(array(
    'posts_per_page' => 6,
    'post_type'      => array('post', 'department'),
    'orderby'        => 'date',
    'order'          => 'DESC',
));

// ── Hot List: 3 posts for hero + stacked cards ───────────────────
$hot_q = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type'      => array('post', 'department'),
    'post__not_in'   => $exclude,
    'orderby'        => 'date',
    'order'          => 'DESC',
));

// ── Ticker: 3 most-read posts by comment count ───────────────────
$ticker_q = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type'      => array('post', 'department'),
    'orderby'        => 'comment_count',
    'order'          => 'DESC',
));

// ── Department Spotlights ─────────────────────────────────────────
function rh_dept_spotlight_query($slugs) {
    return new WP_Query(array(
        'posts_per_page' => 1,
        'post_type'      => array('post', 'department'),
        'tax_query'      => array(array(
            'taxonomy' => 'department_category',
            'field'    => 'slug',
            'terms'    => $slugs,
            'operator' => 'IN',
        )),
    ));
}
$spotlight_food_q = rh_dept_spotlight_query(array('dept-menu', 'menu'));
$spotlight_re_q   = rh_dept_spotlight_query(array('dept-real-estate', 'real-estate'));
$spotlight_arts_q = rh_dept_spotlight_query(array('dept-music-art', 'music-art'));

// ── All 21 Departments ────────────────────────────────────────────
$all_departments = array(
    array('name' => 'Health',        'slug' => 'dept-health'),
    array('name' => 'Fashion',       'slug' => 'dept-fashion'),
    array('name' => 'Brides Guide',  'slug' => 'dept-brides-guide'),
    array('name' => 'Community',     'slug' => 'dept-community'),
    array('name' => 'Writers Block', 'slug' => 'dept-writers-block'),
    array('name' => 'Real Estate',   'slug' => 'dept-real-estate'),
    array('name' => 'Tech',          'slug' => 'dept-tech'),
    array('name' => 'Education',     'slug' => 'dept-education'),
    array('name' => 'Politics',      'slug' => 'dept-politics'),
    array('name' => 'Music & Art',   'slug' => 'dept-music-art'),
    array('name' => 'Film',          'slug' => 'dept-film'),
    array('name' => 'Flashback',     'slug' => 'dept-flashback'),
    array('name' => 'History',       'slug' => 'dept-history'),
    array('name' => 'Menu',          'slug' => 'dept-menu'),
    array('name' => 'Travel',        'slug' => 'dept-travel'),
    array('name' => '2025 Hotspots', 'slug' => 'dept-2025-hotspots'),
    array('name' => 'Events',        'slug' => 'dept-events'),
    array('name' => 'Sports',        'slug' => 'dept-sports'),
    array('name' => 'Environment',   'slug' => 'dept-environment'),
    array('name' => 'Games',         'slug' => 'dept-games'),
    array('name' => 'People',        'slug' => 'dept-people'),
);

// Navigation sections (bottom strip + per-spec 6 umbrella labels)
$nav_sections = array(
    'Life'        => home_url('/life'),
    'Business'    => home_url('/business'),
    'Arts'        => home_url('/arts'),
    'Lifestyle'   => home_url('/lifestyle'),
    'Sports'      => home_url('/sports'),
    'Environment' => home_url('/environment'),
);

/* ================================================================
   PAGE BODY
   ================================================================ */
?>

<!-- ================================================================
     1. COVER MASTHEAD
     Full-bleed 980px. CoverMasthead replaces site header on homepage.
     All foreground text: mix-blend-mode:difference + color:#fff
     Spec: §3.1
     ================================================================ -->
<div class="rh-cover-masthead" role="banner" aria-label="<?php esc_attr_e('Cover', 'rowhome-magazine'); ?>">

    <?php if ($cover_image) : ?>
        <img
            src="<?php echo esc_url($cover_image); ?>"
            alt="<?php echo esc_attr($cover_title); ?>"
            class="rh-cover-masthead__bg rh-photo"
            loading="eager"
            fetchpriority="high"
        >
    <?php else : ?>
        <!-- Solid ink fallback when no cover image available -->
        <div class="rh-cover-masthead__bg rh-cover-masthead__bg--ink"></div>
    <?php endif; ?>

    <!-- 60% black gradient — always on for low-contrast photo fallback -->
    <div class="rh-cover-masthead__gradient" aria-hidden="true"></div>

    <!-- Dateline strip (top) -->
    <div class="rh-cover-masthead__dateline">
        <span>Issue 03 &middot; Feb 2026 &middot; $7.95</span>
        <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="rh-cover-masthead__dateline-link">Subscribe &middot; $1/wk</a>
    </div>

    <!-- Wordmark (centered, top:60) -->
    <div class="rh-cover-masthead__wordmark">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="rh-cover-masthead__wordmark-link">
            <span class="rh-cover-masthead__wordmark-text">Row<em>Home</em></span>
        </a>
        <span class="rh-cover-masthead__tagline-text">River to River. One Neighborhood.</span>
    </div>

    <!-- Cover lines (left, top:380) — 4 teaser rows from recent posts -->
    <div class="rh-cover-masthead__lines" aria-label="<?php esc_attr_e('Inside this issue', 'rowhome-magazine'); ?>">
        <span class="rh-cover-masthead__lines-eyebrow">Inside</span>
        <?php
        if ($lines_q->have_posts()) :
            $line_num = 0;
            while ($lines_q->have_posts()) : $lines_q->the_post();
                $line_num++;
                $line_page = 18 + ($line_num * 12);
        ?>
            <div class="rh-cover-masthead__line-item">
                <a href="<?php the_permalink(); ?>" class="rh-cover-masthead__line-link">
                    <?php the_title(); ?>
                </a>
                <span class="rh-cover-masthead__line-page">p.&nbsp;<?php echo $line_page; ?></span>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Static fallback cover lines
            $fallback_lines = array(
                array('title' => 'The Best Row Homes in Fishtown', 'page' => 30),
                array('title' => "South Philly's Hidden Restaurant Scene", 'page' => 42),
                array('title' => 'How Local Art Is Reshaping the City', 'page' => 56),
                array('title' => 'The 2025 Real Estate Outlook', 'page' => 68),
            );
            foreach ($fallback_lines as $line) :
        ?>
            <div class="rh-cover-masthead__line-item">
                <span class="rh-cover-masthead__line-link"><?php echo esc_html($line['title']); ?></span>
                <span class="rh-cover-masthead__line-page">p.&nbsp;<?php echo $line['page']; ?></span>
            </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>

    <!-- Cover headline (right, bottom:80) — the cover story -->
    <div class="rh-cover-masthead__headline">
        <?php if ($cover_kicker) : ?>
            <span class="rh-cover-masthead__hed-tag"><?php echo esc_html($cover_kicker); ?></span>
        <?php endif; ?>
        <a href="<?php echo esc_url($cover_url); ?>" class="rh-cover-masthead__hed-link">
            <h1 class="rh-cover-masthead__hed-title"><?php echo esc_html($cover_title); ?></h1>
        </a>
    </div>

    <!-- Bottom nav strip with backdrop blur -->
    <nav class="rh-cover-masthead__nav" aria-label="<?php esc_attr_e('Section navigation', 'rowhome-magazine'); ?>">
        <div class="rh-cover-masthead__nav-sections">
            <?php foreach ($nav_sections as $label => $url) : ?>
                <a href="<?php echo esc_url($url); ?>" class="rh-cover-masthead__nav-link">
                    <?php echo esc_html($label); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <span class="rh-cover-masthead__nav-hint">&#8595; Scroll for the issue</span>
    </nav>
</div><!-- .rh-cover-masthead -->

<main id="main" class="rh-homepage-main" tabindex="-1">

<!-- ================================================================
     2. IN THIS ISSUE
     Left col: heading. Right col: 2-col grid of 6 ContentsRow items.
     Spec: §2.1 section 2, §3.3
     ================================================================ -->
<section class="rh-in-this-issue rh-section" aria-labelledby="rh-in-this-issue-heading">
    <div class="rh-container">
        <div class="rh-in-this-issue__inner">

            <!-- Left: heading (sticky) -->
            <div class="rh-in-this-issue__left">
                <h2 id="rh-in-this-issue-heading" class="rh-in-this-issue__issue-label">In This Issue</h2>
                <p class="rh-in-this-issue__issue-meta">Issue 03 &middot; Feb 2026</p>
            </div>

            <!-- Right: 2-col ContentsRow grid -->
            <div class="rh-in-this-issue__grid">
                <?php
                if ($contents_q->have_posts()) :
                    $row_num = 0;
                    while ($contents_q->have_posts()) : $contents_q->the_post();
                        $row_num++;
                        $row_page   = 18 + ($row_num * 12);
                        $row_terms  = get_the_terms(get_the_ID(), 'department_category');
                        $row_kicker = ($row_terms && !is_wp_error($row_terms)) ? $row_terms[0]->name : 'Feature';
                ?>
                    <a href="<?php the_permalink(); ?>" class="rh-contents-row-link">
                        <div class="rh-contents-row">
                            <span class="rh-contents-row__number"><?php echo str_pad($row_num, 2, '0', STR_PAD_LEFT); ?></span>
                            <div class="rh-contents-row__body">
                                <span class="rh-eyebrow"><?php echo esc_html($row_kicker); ?></span>
                                <p class="rh-contents-row__headline"><?php the_title(); ?></p>
                                <span class="rh-byline">By <?php the_author(); ?></span>
                            </div>
                            <span class="rh-contents-row__page">p.&nbsp;<?php echo $row_page; ?></span>
                        </div>
                    </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Static fallback for 6 contents rows
                    $fallback_contents = array(
                        array('kicker' => 'Life',        'title' => 'Skinny Cheesesteaks: A Family Tradition',  'author' => 'Dorette Rota Jackson'),
                        array('kicker' => 'Real Estate', 'title' => 'The Row Home Resurgence of Fishtown',       'author' => 'Maria Gonzalez'),
                        array('kicker' => 'Music & Art', 'title' => "Philadelphia's Mural Arts at 40",           'author' => 'Anthony Panvini'),
                        array('kicker' => 'Menu',        'title' => 'Best New Restaurants of the Year',          'author' => 'Robert Chen'),
                        array('kicker' => 'Sports',      'title' => "Eagles' Road to the Postseason",            'author' => 'James Mitchell'),
                        array('kicker' => 'Community',   'title' => 'Neighbors Building the City They Love',     'author' => 'Lisa Tran'),
                    );
                    foreach ($fallback_contents as $idx => $item) :
                        $row_num  = $idx + 1;
                        $row_page = 18 + ($row_num * 12);
                ?>
                    <div class="rh-contents-row">
                        <span class="rh-contents-row__number"><?php echo str_pad($row_num, 2, '0', STR_PAD_LEFT); ?></span>
                        <div class="rh-contents-row__body">
                            <span class="rh-eyebrow"><?php echo esc_html($item['kicker']); ?></span>
                            <p class="rh-contents-row__headline"><?php echo esc_html($item['title']); ?></p>
                            <span class="rh-byline">By <?php echo esc_html($item['author']); ?></span>
                        </div>
                        <span class="rh-contents-row__page">p.&nbsp;<?php echo $row_page; ?></span>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div><!-- .rh-in-this-issue__grid -->
        </div><!-- .rh-in-this-issue__inner -->
    </div><!-- .rh-container -->
</section><!-- .rh-in-this-issue -->

<!-- ================================================================
     3. SPONSOR STRIP
     970×90 leaderboard. Hidden when .rh-density-subtle on root.
     Spec: §2.1 section 3, §3.7
     ================================================================ -->
<div class="rh-sponsor-strip" aria-label="<?php esc_attr_e('Advertisement', 'rowhome-magazine'); ?>">
    <div class="rh-ad rh-ad--leader" aria-label="Advertisement · 970 × 90">
        Advertisement &middot; 970 &times; 90
    </div>
</div>

<!-- ================================================================
     4. THE HOT LIST
     Section header w/ rule lines.
     3-col grid: hero StoryCard (xl) | 2 stacked StoryCards (m) | sidebar
     Sidebar: 300×300 ad + 3 TickerItems (most read)
     Spec: §2.1 section 4, §3.4, §3.5
     ================================================================ -->
<section class="rh-hot-list rh-section" aria-labelledby="rh-hot-list-heading">
    <div class="rh-container">

        <!-- Section header with rule lines -->
        <div class="rh-section-header rh-section-header--ruled">
            <h2 id="rh-hot-list-heading" class="rh-section-header__title">The Hot List</h2>
        </div>

        <div class="rh-hot-list__grid">

            <!-- Col 1: Hero StoryCard (xl) -->
            <?php
            $hot_posts = array();
            if ($hot_q->have_posts()) :
                while ($hot_q->have_posts()) : $hot_q->the_post();
                    $hot_posts[] = array(
                        'id'      => get_the_ID(),
                        'title'   => get_the_title(),
                        'url'     => get_permalink(),
                        'image'   => get_the_post_thumbnail_url(null, 'rowhome-article-card'),
                        'author'  => get_the_author(),
                        'kicker'  => '',
                    );
                    $ht = get_the_terms(get_the_ID(), 'department_category');
                    if ($ht && !is_wp_error($ht)) {
                        $hot_posts[count($hot_posts) - 1]['kicker'] = $ht[0]->name;
                    }
                endwhile;
                wp_reset_postdata();
            endif;

            // Fallback posts for empty installs
            if (empty($hot_posts)) {
                $hot_posts = array(
                    array('id' => 0, 'title' => "Philadelphia's Best Neighborhoods for Row Home Buyers", 'url' => home_url('/'), 'image' => '', 'author' => 'Maria Gonzalez',    'kicker' => 'Real Estate'),
                    array('id' => 0, 'title' => 'Top Cheesesteak Spots Ranked by Locals',                'url' => home_url('/'), 'image' => '', 'author' => 'Robert Chen',       'kicker' => 'Menu'),
                    array('id' => 0, 'title' => 'Eagles Pre-Season Predictions from the Experts',        'url' => home_url('/'), 'image' => '', 'author' => 'James Mitchell',     'kicker' => 'Sports'),
                );
            }

            $hero = $hot_posts[0];
            $hero_img = $hero['image'] ?: 'https://placehold.co/800x600/0c0c0c/fefdfa?text=Hot+List';
            ?>
            <a href="<?php echo esc_url($hero['url']); ?>" class="rh-story-card-link">
                <article class="rh-story-card rh-story-card--xl">
                    <div class="rh-story-card__image">
                        <?php if ($hero['kicker']) : ?>
                            <span class="rh-tag rh-story-card__tag"><?php echo esc_html($hero['kicker']); ?></span>
                        <?php endif; ?>
                        <img src="<?php echo esc_url($hero_img); ?>"
                             alt="<?php echo esc_attr($hero['title']); ?>"
                             loading="lazy"
                             class="rh-photo">
                    </div>
                    <div class="rh-story-card__body">
                        <?php if ($hero['kicker']) : ?>
                            <span class="rh-eyebrow"><?php echo esc_html($hero['kicker']); ?></span>
                        <?php endif; ?>
                        <h3 class="rh-story-card__headline"><?php echo esc_html($hero['title']); ?></h3>
                        <span class="rh-byline">By <?php echo esc_html($hero['author']); ?></span>
                    </div>
                </article>
            </a>

            <!-- Col 2: 2 stacked StoryCards (m) -->
            <div class="rh-hot-list__stacked">
                <?php
                $stacked = array_slice($hot_posts, 1, 2);
                if (count($stacked) < 2) {
                    // Pad with extra fallback items
                    $stacked_fallbacks = array(
                        array('title' => 'Center City Dining Guide 2026', 'url' => home_url('/'), 'image' => '', 'author' => 'Lisa Tran', 'kicker' => 'Menu'),
                        array('title' => 'Art Galleries Worth the Trip This Month', 'url' => home_url('/'), 'image' => '', 'author' => 'Anthony Panvini', 'kicker' => 'Arts'),
                    );
                    $stacked = array_pad($stacked, 2, null);
                    for ($i = 0; $i < 2; $i++) {
                        if (is_null($stacked[$i])) {
                            $stacked[$i] = $stacked_fallbacks[$i];
                        }
                    }
                }
                foreach ($stacked as $card) :
                    if (!$card) continue;
                    $card_img = !empty($card['image']) ? $card['image'] : 'https://placehold.co/800x600/0c0c0c/fefdfa?text=Story';
                ?>
                    <a href="<?php echo esc_url($card['url']); ?>" class="rh-story-card-link">
                        <article class="rh-story-card rh-story-card--m">
                            <div class="rh-story-card__image">
                                <?php if (!empty($card['kicker'])) : ?>
                                    <span class="rh-tag rh-story-card__tag"><?php echo esc_html($card['kicker']); ?></span>
                                <?php endif; ?>
                                <img src="<?php echo esc_url($card_img); ?>"
                                     alt="<?php echo esc_attr($card['title']); ?>"
                                     loading="lazy"
                                     class="rh-photo">
                            </div>
                            <div class="rh-story-card__body">
                                <?php if (!empty($card['kicker'])) : ?>
                                    <span class="rh-eyebrow"><?php echo esc_html($card['kicker']); ?></span>
                                <?php endif; ?>
                                <h3 class="rh-story-card__headline"><?php echo esc_html($card['title']); ?></h3>
                                <span class="rh-byline">By <?php echo esc_html($card['author']); ?></span>
                            </div>
                        </article>
                    </a>
                <?php endforeach; ?>
            </div><!-- .rh-hot-list__stacked -->

            <!-- Col 3: Sidebar — 300×300 ad + 3 TickerItems (Most Read) -->
            <div class="rh-hot-list__sidebar rh-sidebar">

                <!-- 300×300 ad -->
                <div class="rh-sidebar-block">
                    <div class="rh-ad rh-ad--rect" aria-label="Advertisement · 300 × 300">
                        Advertisement &middot; 300 &times; 300
                    </div>
                </div>

                <!-- Most Read ticker -->
                <div class="rh-sidebar-block">
                    <div class="rh-sidebar-block__label">Most Read</div>
                    <?php
                    if ($ticker_q->have_posts()) :
                        $tick_num = 0;
                        while ($ticker_q->have_posts()) : $ticker_q->the_post();
                            $tick_num++;
                            $tick_terms = get_the_terms(get_the_ID(), 'department_category');
                            $tick_tag   = ($tick_terms && !is_wp_error($tick_terms)) ? $tick_terms[0]->name : '';
                    ?>
                        <a href="<?php the_permalink(); ?>" class="rh-ticker-item-link">
                            <div class="rh-ticker-item">
                                <span class="rh-ticker-item__index"><?php echo str_pad($tick_num, 2, '0', STR_PAD_LEFT); ?></span>
                                <div>
                                    <?php if ($tick_tag) : ?>
                                        <span class="rh-eyebrow"><?php echo esc_html($tick_tag); ?></span>
                                    <?php endif; ?>
                                    <p class="rh-ticker-item__headline"><?php the_title(); ?></p>
                                    <span class="rh-ticker-item__byline">By <?php the_author(); ?></span>
                                </div>
                            </div>
                        </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        $ticker_fallbacks = array(
                            array('kicker' => 'Life',    'title' => 'Skinny Cheesesteaks: A Family Tradition', 'author' => 'Dorette Rota Jackson'),
                            array('kicker' => 'Sports',  'title' => 'Eagles Playoff Preview 2026',              'author' => 'James Mitchell'),
                            array('kicker' => 'Menu',    'title' => 'Where to Brunch in South Philly',          'author' => 'Robert Chen'),
                        );
                        foreach ($ticker_fallbacks as $ti => $t) :
                    ?>
                        <div class="rh-ticker-item">
                            <span class="rh-ticker-item__index"><?php echo str_pad($ti + 1, 2, '0', STR_PAD_LEFT); ?></span>
                            <div>
                                <span class="rh-eyebrow"><?php echo esc_html($t['kicker']); ?></span>
                                <p class="rh-ticker-item__headline"><?php echo esc_html($t['title']); ?></p>
                                <span class="rh-ticker-item__byline">By <?php echo esc_html($t['author']); ?></span>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div><!-- .rh-sidebar-block (ticker) -->
            </div><!-- .rh-hot-list__sidebar -->

        </div><!-- .rh-hot-list__grid -->
    </div><!-- .rh-container -->
</section><!-- .rh-hot-list -->

<!-- ================================================================
     5. DEPARTMENT SPOTLIGHTS
     3 tinted panels: Food (Menu dept) / Real Estate / Arts (Music & Art)
     Each: image + h3 + dek + "Read All →"
     Tints are data-driven via CSS custom properties.
     Spec: §2.1 section 5
     ================================================================ -->
<section class="rh-dept-spotlights-section rh-section" aria-labelledby="rh-spotlights-heading">
    <div class="rh-container">
        <h2 id="rh-spotlights-heading" class="rh-section-header__title" style="text-align:center;margin-bottom:32px;">
            Department Spotlights
        </h2>
        <div class="rh-dept-spotlights">

            <?php
            $spotlights = array(
                array(
                    'query'   => $spotlight_food_q,
                    'class'   => 'rh-dept-spotlight--food',
                    'dept'    => 'Menu',
                    'slug'    => 'dept-menu',
                    'fallback_title' => "Philadelphia's Hottest Restaurants",
                    'fallback_dek'   => "From South Street to Fishtown, discover the dining experiences shaping the city's food scene this season.",
                    'fallback_img'   => 'https://placehold.co/800x600/f8e7e0/0c0c0c?text=Menu',
                ),
                array(
                    'query'   => $spotlight_re_q,
                    'class'   => 'rh-dept-spotlight--real-estate',
                    'dept'    => 'Real Estate',
                    'slug'    => 'dept-real-estate',
                    'fallback_title' => 'The Row Home Market Is Booming',
                    'fallback_dek'   => "Philadelphia's historic housing stock is seeing renewed interest. Here's what buyers and sellers need to know right now.",
                    'fallback_img'   => 'https://placehold.co/800x600/e6e9e3/0c0c0c?text=Real+Estate',
                ),
                array(
                    'query'   => $spotlight_arts_q,
                    'class'   => 'rh-dept-spotlight--arts',
                    'dept'    => 'Music & Art',
                    'slug'    => 'dept-music-art',
                    'fallback_title' => 'Local Artists Transforming the City',
                    'fallback_dek'   => 'Murals, music venues, and gallery openings — the arts are alive across every Philadelphia neighborhood.',
                    'fallback_img'   => 'https://placehold.co/800x600/eee4d8/0c0c0c?text=Music+%26+Art',
                ),
            );

            foreach ($spotlights as $sp) :
                $sp_title  = $sp['fallback_title'];
                $sp_dek    = $sp['fallback_dek'];
                $sp_url    = home_url('/');
                $sp_img    = $sp['fallback_img'];

                if ($sp['query']->have_posts()) {
                    $sp['query']->the_post();
                    $sp_title = get_the_title();
                    $sp_dek   = wp_trim_words(get_the_excerpt(), 20);
                    $sp_url   = get_permalink();
                    $sp_img   = get_the_post_thumbnail_url(null, 'rowhome-article-card') ?: $sp['fallback_img'];
                    wp_reset_postdata();
                }
            ?>
                <div class="rh-dept-spotlight <?php echo esc_attr($sp['class']); ?>">
                    <img src="<?php echo esc_url($sp_img); ?>"
                         alt="<?php echo esc_attr($sp_title); ?>"
                         class="rh-dept-spotlight__image rh-photo"
                         loading="lazy">
                    <h3 class="rh-dept-spotlight__title"><?php echo esc_html($sp_title); ?></h3>
                    <p class="rh-dept-spotlight__dek"><?php echo esc_html($sp_dek); ?></p>
                    <a href="<?php echo esc_url(home_url('/department_category/' . $sp['slug'])); ?>"
                       class="rh-dept-spotlight__cta">
                        Read All &rarr;
                    </a>
                </div>
            <?php endforeach; ?>

        </div><!-- .rh-dept-spotlights -->
    </div><!-- .rh-container -->
</section><!-- .rh-dept-spotlights-section -->

<!-- ================================================================
     6. ALL DEPARTMENTS
     Centered h2 + 21-item 3-col index grid (number / name / arrow)
     Spec: §2.1 section 6
     ================================================================ -->
<section class="rh-all-depts rh-section" aria-labelledby="rh-all-depts-heading">
    <div class="rh-container">
        <h2 id="rh-all-depts-heading" class="rh-all-depts__heading">All Departments</h2>

        <div class="rh-all-depts__grid">
            <?php foreach ($all_departments as $idx => $dept) :
                $dept_num  = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
                $dept_slug = $dept['slug'];
                $dept_url  = home_url('/department_category/' . $dept_slug);
            ?>
                <a href="<?php echo esc_url($dept_url); ?>" class="rh-dept-index-item">
                    <span class="rh-dept-index-item__num"><?php echo esc_html($dept_num); ?></span>
                    <span class="rh-dept-index-item__name"><?php echo esc_html($dept['name']); ?></span>
                    <span class="rh-dept-index-item__arrow" aria-hidden="true">&rarr;</span>
                </a>
            <?php endforeach; ?>
        </div><!-- .rh-all-depts__grid -->
    </div><!-- .rh-container -->
</section><!-- .rh-all-depts -->

<?php get_footer('homepage'); ?>
