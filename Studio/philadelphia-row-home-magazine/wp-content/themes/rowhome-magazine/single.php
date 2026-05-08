<?php
/**
 * Direction B — Single Post: Feature Article Layout
 *
 * 3-col body grid: left rail (200px TOC + share) | center prose | right rail (280px ads + related)
 * Hero: 21:9 full-bleed with headline overlay.
 *
 * @package RowHome_Magazine
 * @since 2.0.0
 * @see SIR-776
 */

get_header('article');
?>

<?php while (have_posts()) : the_post(); ?>

<?php
// Blog / short-form layout delegates to blog content template with Direction B chrome
$post_layout = get_post_meta(get_the_ID(), '_post_layout', true);
if ($post_layout === 'blog') {
    get_template_part('template-blog-content');
    get_footer('article');
    return;
}
?>

<?php
// Shared data used across hero, meta strip, and sidebar
$hero_image     = get_the_post_thumbnail_url(get_the_ID(), 'rowhome-hero');
$eyebrow_terms  = get_the_terms(get_the_ID(), 'department_category');
$eyebrow        = ($eyebrow_terms && !is_wp_error($eyebrow_terms)) ? $eyebrow_terms[0]->name : '';
$word_count     = str_word_count(wp_strip_all_tags(get_the_content()));
$read_time      = max(1, (int) round($word_count / 225));
$author_id      = get_the_author_meta('ID');
$share_url      = rawurlencode(get_permalink());
$share_title    = rawurlencode(get_the_title());
?>

<!-- =====================================================
     Hero — 21:9 full-bleed, headline overlaid
     ===================================================== -->
<div class="rh-article-hero<?php echo $hero_image ? '' : ' rh-article-hero--no-image'; ?>">
    <?php if ($hero_image) : ?>
        <div class="rh-article-hero__media">
            <img
                src="<?php echo esc_url($hero_image); ?>"
                alt="<?php echo esc_attr(get_the_title()); ?>"
                class="rh-article-hero__img rh-photo"
                loading="eager"
                decoding="async"
            >
            <div class="rh-article-hero__overlay" aria-hidden="true"></div>
        </div>
    <?php endif; ?>

    <div class="rh-article-hero__caption<?php echo $hero_image ? '' : ' rh-container'; ?>">
        <div class="rh-container">
            <?php if ($eyebrow) : ?>
                <span class="rh-eyebrow rh-article-hero__eyebrow"><?php echo esc_html($eyebrow); ?></span>
            <?php endif; ?>
            <h1 class="rh-article-hero__headline"><?php the_title(); ?></h1>
            <?php
            $excerpt = has_excerpt() ? get_the_excerpt() : '';
            if ($excerpt) :
            ?>
                <p class="rh-article-hero__dek"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- =====================================================
     Meta strip — 3-col: byline | date | read time + words
     ===================================================== -->
<div class="rh-article-meta-strip">
    <div class="rh-container">
        <div class="rh-article-meta-strip__inner">

            <div class="rh-article-meta-strip__col">
                <span class="rh-article-meta-strip__label"><?php esc_html_e('By', 'rowhome-magazine'); ?></span>
                <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="rh-article-meta-strip__author rh-byline">
                    <?php the_author(); ?>
                </a>
            </div>

            <div class="rh-article-meta-strip__col rh-article-meta-strip__col--center">
                <time class="rh-byline" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date('F j, Y')); ?>
                </time>
            </div>

            <div class="rh-article-meta-strip__col rh-article-meta-strip__col--right">
                <span class="rh-byline">
                    <?php
                    /* translators: %d = minutes */
                    printf(_n('%d min read', '%d min read', $read_time, 'rowhome-magazine'), $read_time);
                    ?>
                </span>
                <span class="rh-article-meta-strip__dot" aria-hidden="true">&middot;</span>
                <span class="rh-byline">
                    <?php
                    /* translators: %s = word count */
                    printf(esc_html__('%s words', 'rowhome-magazine'), number_format($word_count));
                    ?>
                </span>
            </div>

        </div>
    </div>
</div>

<!-- =====================================================
     Body grid: left rail (200px) | prose | right rail (280px)
     ===================================================== -->
<div class="rh-container">
    <div class="rh-article-body">

        <!-- ---- Left rail: TOC + social share (sticky) ---- -->
        <aside class="rh-article-rail rh-article-rail--left" aria-label="<?php esc_attr_e('Table of contents and share', 'rowhome-magazine'); ?>">
            <div class="rh-article-rail__inner">

                <!-- Table of contents (JS-populated from h2 headings) -->
                <div class="rh-article-toc" id="rh-toc">
                    <div class="rh-sidebar-block__label"><?php esc_html_e('Contents', 'rowhome-magazine'); ?></div>
                    <nav class="rh-article-toc__nav" aria-label="<?php esc_attr_e('Article sections', 'rowhome-magazine'); ?>"></nav>
                </div>

                <!-- Social share -->
                <div class="rh-article-share">
                    <div class="rh-sidebar-block__label"><?php esc_html_e('Share', 'rowhome-magazine'); ?></div>
                    <div class="rh-article-share__buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="rh-article-share__btn"
                           aria-label="<?php esc_attr_e('Share on Facebook', 'rowhome-magazine'); ?>">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $share_title; ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="rh-article-share__btn"
                           aria-label="<?php esc_attr_e('Share on X', 'rowhome-magazine'); ?>">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>&title=<?php echo $share_title; ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="rh-article-share__btn"
                           aria-label="<?php esc_attr_e('Share on LinkedIn', 'rowhome-magazine'); ?>">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <button class="rh-article-share__btn rh-article-share__btn--copy"
                                data-url="<?php echo esc_attr(get_permalink()); ?>"
                                aria-label="<?php esc_attr_e('Copy link', 'rowhome-magazine'); ?>">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                        </button>
                    </div>
                </div>

            </div>
        </aside>

        <!-- ---- Center: article prose ---- -->
        <div class="rh-article-center">

            <div class="rh-prose entry-content" id="rh-article-content">
                <?php
                the_content();
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'rowhome-magazine'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <!-- Tags -->
            <?php $tags_list = get_the_tag_list('', ' '); ?>
            <?php if ($tags_list) : ?>
                <div class="rh-article-tags"><?php echo $tags_list; ?></div>
            <?php endif; ?>

            <!-- Post navigation -->
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            if ($prev_post || $next_post) :
            ?>
                <nav class="rh-article-nav" aria-label="<?php esc_attr_e('Post navigation', 'rowhome-magazine'); ?>">
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="rh-article-nav__link rh-article-nav__link--prev">
                            <span class="rh-article-nav__label rh-byline">&larr; <?php esc_html_e('Previous Article', 'rowhome-magazine'); ?></span>
                            <span class="rh-article-nav__title"><?php echo esc_html($prev_post->post_title); ?></span>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>
                    <?php if ($next_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="rh-article-nav__link rh-article-nav__link--next">
                            <span class="rh-article-nav__label rh-byline"><?php esc_html_e('Next Article', 'rowhome-magazine'); ?> &rarr;</span>
                            <span class="rh-article-nav__title"><?php echo esc_html($next_post->post_title); ?></span>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>

            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="rh-article-comments">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        </div><!-- .rh-article-center -->

        <!-- ---- Right rail: ads + stat cards + related ---- -->
        <aside class="rh-article-rail rh-article-rail--right rh-sidebar"
               aria-label="<?php esc_attr_e('Sidebar', 'rowhome-magazine'); ?>">

            <!-- Sidebar ad (300×250) -->
            <div class="rh-sidebar-block">
                <div class="rh-ad rh-ad--half">Advertisement</div>
            </div>

            <!-- Stat cards -->
            <div class="rh-sidebar-block">
                <div class="rh-sidebar-block__label"><?php esc_html_e('Article Stats', 'rowhome-magazine'); ?></div>
                <div class="rh-article-stat-card">
                    <span class="rh-article-stat-card__value"><?php echo number_format($word_count); ?></span>
                    <span class="rh-article-stat-card__label rh-byline"><?php esc_html_e('Words', 'rowhome-magazine'); ?></span>
                </div>
                <div class="rh-article-stat-card">
                    <span class="rh-article-stat-card__value"><?php echo $read_time; ?> min</span>
                    <span class="rh-article-stat-card__label rh-byline"><?php esc_html_e('Read time', 'rowhome-magazine'); ?></span>
                </div>
            </div>

            <!-- Related articles (TickerItems) -->
            <?php
            $related_args = array(
                'posts_per_page'      => 4,
                'post__not_in'        => array(get_the_ID()),
                'ignore_sticky_posts' => 1,
            );
            if ($eyebrow_terms && !is_wp_error($eyebrow_terms)) {
                $related_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'department_category',
                        'field'    => 'term_id',
                        'terms'    => wp_list_pluck($eyebrow_terms, 'term_id'),
                    ),
                );
            }
            $related_query = new WP_Query($related_args);
            if ($related_query->have_posts()) :
            ?>
                <div class="rh-sidebar-block">
                    <div class="rh-sidebar-block__label"><?php esc_html_e('Related', 'rowhome-magazine'); ?></div>
                    <?php
                    $ticker_index = 1;
                    while ($related_query->have_posts()) : $related_query->the_post();
                    ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="rh-ticker-item" style="text-decoration:none;">
                            <span class="rh-ticker-item__index"><?php echo sprintf('%02d', $ticker_index); ?></span>
                            <div>
                                <div class="rh-ticker-item__headline"><?php the_title(); ?></div>
                                <div class="rh-ticker-item__byline"><?php the_author(); ?></div>
                            </div>
                        </a>
                    <?php
                        $ticker_index++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>

            <!-- Second sidebar ad -->
            <div class="rh-sidebar-block">
                <div class="rh-ad rh-ad--half">Advertisement</div>
            </div>

        </aside><!-- .rh-article-rail--right -->

    </div><!-- .rh-article-body -->
</div><!-- .rh-container -->

<!-- Footer banner ad (728×90) above RHFooter -->
<div class="rh-article-footer-ad">
    <div class="rh-container">
        <div class="rh-ad rh-ad--banner">Advertisement</div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer('article'); ?>
