<?php
/**
 * Template Name: About & FAQs
 *
 * About page for Philadelphia RowHome Magazine.
 * Copy source: claude/rowhomemag-adsense-pages.md (project doc) — no invented facts.
 *
 * @package RowHome_Magazine
 * @since 2.1.0
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero -->
        <div class="about-hero">
            <div class="about-hero__overlay">
                <div class="container">
                    <p class="about-hero__eyebrow">Philadelphia, PA &bull; Since 2004</p>
                    <h1 class="about-hero__title">Our Neighborhood&rsquo;s Magazine</h1>
                    <p class="about-hero__subtitle">For more than 20 years, <em>Philadelphia RowHome Magazine</em> has told the story of life in Philadelphia, one block at a time.</p>
                </div>
            </div>
        </div>

        <div class="container">

            <!-- Our Story -->
            <section class="about-story">
                <div class="about-story__layout">
                    <div class="about-story__content">
                        <div class="section-header">
                            <h2 class="section-title">Our Story</h2>
                        </div>
                        <p class="about-story__lead">Sisters Dawn and Dorette founded RowHome in 2004 to celebrate the memories, lifestyles, and traditions of South Philadelphia and its surrounding communities.</p>
                        <p>What started as a neighborhood publication has grown into a quarterly print magazine reaching more than 20,000 readers, from row homes in South Philly to subscribers as far away as Anchorage, Alaska.</p>
                        <p>RowHome is about the people we see every day. It&rsquo;s about the coffee shops that pour our first cup, and the bakers, chefs, locksmiths, florists, and butchers who keep our neighborhoods running. It&rsquo;s about the families, the corner stores, the parish festivals, and the stories that get passed down from stoop to stoop.</p>
                    </div>
                    <div class="about-story__image">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-hero.jpg' ); ?>" alt="Philadelphia row homes" loading="lazy">
                    </div>
                </div>
            </section>

            <!-- What We Cover -->
            <section class="about-mission">
                <div class="section-header">
                    <h2 class="section-title">What We Cover</h2>
                </div>
                <p class="about-story__lead">Our coverage stretches &ldquo;River to River, from South Philadelphia to the Jersey Shore,&rdquo; across departments including:</p>
                <div class="about-mission__layout about-depts">
                    <?php
                    $rh_about_depts = array(
                        array( 'PRH Life', 'community features and local personalities', 'dept-life' ),
                        array( 'Business', 'local business profiles and the people behind them', 'dept-business' ),
                        array( 'PRH Real Estate', 'neighborhood guides and market trends', 'dept-real-estate' ),
                        array( 'The Menu', 'restaurants, recipes, and Philly food culture', 'dept-menu' ),
                        array( 'Health', 'wellness and healthcare in our community', 'dept-health' ),
                        array( 'Music &amp; Art', 'artists, musicians, and the local scene', 'dept-music-art' ),
                        array( 'Salute to Service', 'honoring those who serve', 'dept-salute-to-service' ),
                        array( 'Brides Guide', 'weddings and local vendors', 'dept-brides-guide' ),
                        array( 'Flashback', 'photos and stories from Philadelphia&rsquo;s past', 'dept-flashback' ),
                        array( 'Writer&rsquo;s Block', 'local authors and literary work', 'dept-writers-block' ),
                    );
                    foreach ( $rh_about_depts as $d ) :
                    ?>
                    <div class="about-mission__block">
                        <h3><a href="<?php echo esc_url( rowhome_dept_url( $d[2] ) ); ?>"><?php echo $d[0]; ?></a></h3>
                        <p><?php echo $d[1]; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- RowHome Online -->
            <section class="about-story about-online">
                <div class="section-header">
                    <h2 class="section-title">RowHome Online</h2>
                </div>
                <p>rowhomemag.com brings the magazine&rsquo;s stories to readers wherever they are, and is building toward a digital home for two decades of RowHome archives. New and longtime readers can find the latest features, browse photo galleries, and discover the neighborhoods we love.</p>
            </section>

            <!-- Our Team -->
            <section class="about-team">
                <div class="section-header teal">
                    <h2 class="section-title">Our Team</h2>
                </div>
                <p><em>Philadelphia RowHome Magazine</em> is published by Philadelphia RowHome, Inc.</p>
                <div class="about-team__grid">
                    <div class="team-card">
                        <div class="team-card__avatar"><span class="rh-avatar rh-avatar--empty" aria-hidden="true"></span></div>
                        <h3 class="team-card__name">Dawn</h3>
                        <p class="team-card__role">Publisher</p>
                    </div>
                    <div class="team-card">
                        <div class="team-card__avatar"><span class="rh-avatar rh-avatar--empty" aria-hidden="true"></span></div>
                        <h3 class="team-card__name">Dorette</h3>
                        <p class="team-card__role">Publisher</p>
                    </div>
                </div>
            </section>

            <!-- Get in Touch -->
            <section class="about-faq" id="get-in-touch">
                <div class="section-header">
                    <h2 class="section-title">Get in Touch</h2>
                </div>
                <p>Have a story idea, want to advertise, or want to see your business in our pages? Visit our <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a> page. We&rsquo;d love to hear from you.</p>
                <p>Follow along on <a href="https://www.facebook.com/PhiladelphiaRowhomeMagazine/" target="_blank" rel="noopener">Facebook</a>, <a href="https://www.instagram.com/rowhomemag/" target="_blank" rel="noopener">Instagram</a>, and <a href="https://www.youtube.com/@RowhomeMagazine" target="_blank" rel="noopener">YouTube</a>, and read past issues on <a href="https://issuu.com/philadelphiarowhomemagazine" target="_blank" rel="noopener">Issuu</a>.</p>
            </section>

        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
