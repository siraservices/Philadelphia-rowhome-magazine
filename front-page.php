<?php
/**
 * Homepage — 15 sections in the order of Omar's wireframe (website_Home).
 *
 * Content comes from department_category (dept-*) queries; every block
 * falls back to gray wireframe placeholders when a department is empty.
 * Card markup lives in inc/homepage-helpers.php.
 *
 * @package RowHome_Magazine
 * @since 2.1.0
 */

get_header();

$img_dir   = get_template_directory_uri() . '/assets/images/';
$cover     = rowhome_cover_post();
$cover_id  = $cover ? $cover->ID : 0;
$exclude   = $cover_id ? array( $cover_id ) : array();
?>

<main id="main" class="rh-home">

    <!-- 1. Leaderboard ad -->
    <div class="rh-container">
        <?php rowhome_ad( 'leader' ); ?>
    </div>

    <!-- 2. Tagline divider -->
    <div class="rh-container">
        <?php rowhome_tagline_divider(); ?>
    </div>

    <!-- 3. Hero — featured / sticky post -->
    <?php
    $hero_img   = $cover ? get_the_post_thumbnail_url( $cover, 'rowhome-hero' ) : '';
    if ( ! $hero_img ) {
        $hero_img = $img_dir . 'hero-1.jpg';
    }
    $hero_title = $cover ? get_the_title( $cover ) : 'Skinny Joey&rsquo;s Cheesesteaks';
    $hero_kick  = $cover ? wp_trim_words( get_the_excerpt( $cover ), 8, '' ) : 'A tribute to family traditions';
    $hero_url   = $cover ? get_permalink( $cover ) : home_url( '/subscribe/' );
    $hero_photo = $cover ? get_post_meta( $cover_id, '_rowhome_photographer', true ) : '';
    if ( ! $hero_photo && $cover ) {
        $hero_photo = get_post_meta( $cover_id, '_pictorial_photographer', true );
    }
    ?>
    <section class="rh-hero<?php echo $cover ? '' : ' rh-hero--placeholder'; ?>" aria-label="Featured story">
        <div class="rh-container">
            <a class="rh-hero__link" href="<?php echo esc_url( $hero_url ); ?>">
                <div class="rh-hero__media" style="background-image:url('<?php echo esc_url( $hero_img ); ?>')">
                    <img class="rh-hero__img" src="<?php echo esc_url( $hero_img ); ?>" alt="" loading="eager" fetchpriority="high">
                </div>
                <div class="rh-hero__overlay">
                    <h1 class="rh-hero__title"><?php echo wp_kses_post( $hero_title ); ?></h1>
                    <?php if ( $hero_kick ) : ?>
                        <p class="rh-hero__kicker"><?php echo esc_html( $hero_kick ); ?></p>
                    <?php endif; ?>
                    <p class="rh-hero__byline">
                        <span><?php echo $cover ? rowhome_byline_text( $cover ) : 'by RowHome Staff'; ?></span>
                        <?php if ( $hero_photo ) : ?><span>photos by <?php echo esc_html( $hero_photo ); ?></span><?php endif; ?>
                    </p>
                </div>
            </a>
            <div class="rh-hero__bar"><?php rowhome_philly_badge( 'rh-philly--hero' ); ?></div>
        </div>
    </section>

    <div class="rh-container">

        <!-- 4 + 5. LIFE and HOT SPOTS share a skyscraper ad -->
        <div class="rh-with-sky">
            <div class="rh-with-sky__main">

                <!-- 4. PRH LIFE -->
                <section class="rh-section rh-life" aria-labelledby="sec-life">
                    <?php rowhome_section_header( 'LIFE', array( 'link' => rowhome_dept_url( 'dept-life' ) ) ); ?>
                    <div class="rh-grid rh-grid--3 rh-grid--dotted">
                        <?php
                        // Flashback first (its ribbon reflects the real category), then Life.
                        $life_posts = rowhome_dept_posts( 'dept-flashback', 1, $exclude );
                        $life_more  = rowhome_dept_posts( 'dept-life', 3, array_merge( $exclude, wp_list_pluck( $life_posts, 'ID' ) ) );
                        $life_posts = array_slice( array_merge( $life_posts, $life_more ), 0, 3 );
                        for ( $i = 0; $i < 3; $i++ ) {
                            $p = isset( $life_posts[ $i ] ) ? $life_posts[ $i ] : null;
                            rowhome_card( array(
                                'post'   => $p,
                                'ribbon' => ( $p ? '' : ( $i === 0 ? 'FLASHBACK' : 'LIFE' ) ),
                                'prefer' => array( 'dept-flashback', 'dept-life' ),
                                'words'  => 16,
                            ) );
                        }
                        ?>
                    </div>
                </section>

                <!-- 5. PRH HOT SPOTS (current year) -->
                <section class="rh-section rh-hotspots" aria-labelledby="sec-hotspots">
                    <?php
                    rowhome_section_header( 'HOT SPOTS ' . date( 'Y' ), array(
                        'link'  => rowhome_dept_url( 'dept-2025-hotspots' ),
                        'extra' => '<span class="rh-script rh-script--red">Hot Spots</span>',
                    ) );
                    $hs = rowhome_dept_posts( 'dept-2025-hotspots', 1, $exclude );
                    $hs = $hs ? $hs[0] : null;
                    ?>
                    <div class="rh-hotspots__layout">
                        <div class="rh-hotspots__text">
                            <?php if ( $hs ) : ?>
                                <h3 class="rh-feature-title"><a href="<?php echo esc_url( get_permalink( $hs ) ); ?>"><?php echo esc_html( get_the_title( $hs ) ); ?></a></h3>
                                <p class="rh-card__byline"><?php echo rowhome_byline_text( $hs ); ?></p>
                                <div class="rh-prose"><?php echo wpautop( esc_html( wp_trim_words( get_the_excerpt( $hs ), 90, '&hellip;' ) ) ); ?></div>
                            <?php else : ?>
                                <?php echo rowhome_text_bars_html( 3, 'rh-bars--title rh-bars--lg' ); ?>
                                <?php echo rowhome_text_bars_html( 12, 'rh-bars--excerpt' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="rh-hotspots__image">
                            <?php echo rowhome_post_image_html( $hs, 'rowhome-article-card', 'Hot Spots', '7/8' ); ?>
                        </div>
                    </div>
                </section>

            </div>
            <aside class="rh-with-sky__ad" aria-label="Advertisement">
                <?php rowhome_ad( 'sky' ); ?>
            </aside>
        </div>

        <!-- 6. PRH BUSINESS — profile feature -->
        <section class="rh-section rh-business" aria-labelledby="sec-business">
            <?php
            rowhome_section_header( 'BUSINESS', array( 'link' => rowhome_dept_url( 'dept-business' ) ) );
            $biz = rowhome_dept_posts( 'dept-business', 1, $exclude );
            $biz = $biz ? $biz[0] : null;
            if ( $biz ) {
                $biz_name  = get_the_title( $biz );
                $biz_sub   = get_post_meta( $biz->ID, '_rowhome_subtitle', true );
                if ( ! $biz_sub ) {
                    $biz_sub = wp_trim_words( get_the_excerpt( $biz ), 7, '' );
                }
                $biz_url   = get_permalink( $biz );
                $biz_body  = wp_trim_words( get_the_excerpt( $biz ), 80, '&hellip;' );
                $biz_by    = rowhome_byline_text( $biz );
            } else {
                $biz_name  = 'Victor Della Barba';
                $biz_sub   = 'Local artist turns <strong>ideas</strong> into <strong>visions</strong>';
                $biz_url   = home_url( '/subscribe/' );
                $biz_body  = '';
                $biz_by    = 'by RowHome Staff';
            }
            // Stack the name one word per line (max 3 lines).
            $name_words = preg_split( '/\s+/', trim( wp_strip_all_tags( $biz_name ) ) );
            if ( count( $name_words ) > 3 ) {
                $name_words = array( $name_words[0], $name_words[1], implode( ' ', array_slice( $name_words, 2 ) ) );
            }
            ?>
            <div class="rh-business__layout">
                <div class="rh-business__profile">
                    <h3 class="rh-business__name">
                        <a href="<?php echo esc_url( $biz_url ); ?>">
                            <?php foreach ( $name_words as $w ) : ?><span><?php echo esc_html( $w ); ?></span><?php endforeach; ?>
                        </a>
                    </h3>
                    <p class="rh-business__sub"><?php echo wp_kses( $biz_sub, array( 'strong' => array(), 'b' => array() ) ); ?></p>
                    <p class="rh-business__by"><span><?php echo $biz_by; ?></span></p>
                    <div class="rh-business__logo">
                        <?php echo rowhome_avatar_html( $biz, 96 ); ?>
                    </div>
                </div>
                <div class="rh-business__content">
                    <div class="rh-business__images">
                        <?php
                        if ( $biz && has_post_thumbnail( $biz ) ) {
                            echo rowhome_post_image_html( $biz, 'rowhome-article-card', $biz_name, '3/2' );
                        } else {
                            echo '<div class="rh-img-wrap" style="--rh-ph-ratio:3/2"><img class="rh-img" src="' . esc_url( $img_dir . 'hero-3.jpg' ) . '" alt="" loading="lazy"></div>';
                        }
                        echo '<div class="rh-img-wrap" style="--rh-ph-ratio:3/2"><img class="rh-img" src="' . esc_url( $img_dir . 'hero-2.jpg' ) . '" alt="" loading="lazy"></div>';
                        ?>
                    </div>
                    <?php if ( $biz_body ) : ?>
                        <div class="rh-prose"><p><?php echo esc_html( $biz_body ); ?></p></div>
                    <?php else : ?>
                        <?php echo rowhome_text_bars_html( 8, 'rh-bars--excerpt' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- 7. PRH HEALTH — 2 wide cards -->
        <section class="rh-section rh-health" aria-labelledby="sec-health">
            <?php rowhome_section_header( 'HEALTH', array( 'link' => rowhome_dept_url( 'dept-health' ) ) ); ?>
            <div class="rh-grid rh-grid--2 rh-grid--dotted">
                <?php rowhome_cards_for( 'dept-health', 2, array( 'ribbon' => 'HEALTH', 'ratio' => '16/9', 'words' => 26 ), $exclude ); ?>
            </div>
        </section>

        <!-- 8. PRH REAL ESTATE — 4 cards -->
        <section class="rh-section rh-realestate" aria-labelledby="sec-realestate">
            <?php rowhome_section_header( 'REAL ESTATE', array( 'link' => rowhome_dept_url( 'dept-real-estate' ) ) ); ?>
            <div class="rh-grid rh-grid--4 rh-grid--dotted">
                <?php rowhome_cards_for( 'dept-real-estate', 4, array( 'ribbon' => 'REAL ESTATE', 'ribbon_class' => 'rh-ribbon--sage', 'class' => 'rh-card--centered', 'words' => 14 ), $exclude ); ?>
            </div>
        </section>

        <!-- 9. Tagline + leaderboard -->
        <?php rowhome_tagline_divider(); ?>
        <?php rowhome_ad( 'leader' ); ?>

        <!-- 10. PRH MENU -->
        <section class="rh-section rh-menu" aria-labelledby="sec-menu">
            <?php
            rowhome_section_header( 'MENU', array(
                'link'  => rowhome_dept_url( 'dept-menu' ),
                'rule'  => 'green',
                'extra' => rowhome_hotspots_sticker( 'rh-sticker--rule' ),
            ) );
            $menu_posts = rowhome_dept_posts( 'dept-menu', 5, $exclude );
            $menu_lead  = isset( $menu_posts[0] ) ? $menu_posts[0] : null;
            ?>
            <div class="rh-menu__lead">
                <a class="rh-menu__lead-link" href="<?php echo esc_url( $menu_lead ? get_permalink( $menu_lead ) : home_url( '/subscribe/' ) ); ?>">
                    <div class="rh-menu__lead-text">
                        <?php if ( $menu_lead ) : ?>
                            <h3 class="rh-feature-title"><?php echo esc_html( get_the_title( $menu_lead ) ); ?></h3>
                            <p class="rh-card__byline"><?php echo rowhome_byline_text( $menu_lead ); ?></p>
                            <p class="rh-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $menu_lead ), 40, '&hellip;' ) ); ?></p>
                        <?php else : ?>
                            <?php echo rowhome_text_bars_html( 3, 'rh-bars--title rh-bars--lg rh-bars--center' ); ?>
                            <?php echo rowhome_text_bars_html( 4, 'rh-bars--excerpt rh-bars--center' ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="rh-menu__lead-icon" aria-hidden="true">
                        <?php echo rowhome_post_image_html( $menu_lead, 'rowhome-small-card', 'Menu', '1/1' ); ?>
                    </div>
                </a>
            </div>
            <div class="rh-grid rh-grid--4 rh-grid--dotted rh-menu__grid">
                <?php
                for ( $i = 1; $i <= 4; $i++ ) {
                    $p = isset( $menu_posts[ $i ] ) ? $menu_posts[ $i ] : null;
                    rowhome_card( array(
                        'post'         => $p,
                        'ribbon'       => 'MENU',
                        'ribbon_class' => 'rh-ribbon--green',
                        'sticker'      => rowhome_hotspots_sticker( 'rh-sticker--card' ),
                        'class'        => 'rh-card--centered',
                        'words'        => 14,
                    ) );
                }
                ?>
            </div>
        </section>

        <!-- 11. PRH BRIDES GUIDE -->
        <section class="rh-section rh-brides" aria-labelledby="sec-brides">
            <?php
            rowhome_section_header( 'BRIDES GUIDE', array( 'link' => rowhome_dept_url( 'dept-brides-guide' ) ) );
            $brides = rowhome_dept_posts( 'dept-brides-guide', 9, $exclude );
            $b_lead = isset( $brides[0] ) ? $brides[0] : null;
            ?>
            <div class="rh-brides__lead">
                <a class="rh-brides__lead-link" href="<?php echo esc_url( $b_lead ? get_permalink( $b_lead ) : home_url( '/subscribe/' ) ); ?>">
                    <div class="rh-brides__lead-img">
                        <?php echo rowhome_post_image_html( $b_lead, 'rowhome-article-card', 'Brides Guide', '1/1' ); ?>
                    </div>
                    <div class="rh-brides__lead-text">
                        <?php if ( $b_lead ) : ?>
                            <h3 class="rh-feature-title"><?php echo esc_html( get_the_title( $b_lead ) ); ?></h3>
                            <p class="rh-card__byline"><?php echo rowhome_byline_text( $b_lead ); ?></p>
                            <p class="rh-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $b_lead ), 50, '&hellip;' ) ); ?></p>
                        <?php else : ?>
                            <?php echo rowhome_text_bars_html( 3, 'rh-bars--title rh-bars--lg rh-bars--right' ); ?>
                            <?php echo rowhome_text_bars_html( 4, 'rh-bars--excerpt' ); ?>
                        <?php endif; ?>
                    </div>
                </a>
                <div class="rh-brides__badge"><?php rowhome_philly_badge(); ?></div>
            </div>
            <div class="rh-brides__row">
                <div class="rh-brides__thumbs">
                    <?php
                    for ( $i = 1; $i <= 8; $i++ ) {
                        $p = isset( $brides[ $i ] ) ? $brides[ $i ] : null;
                        rowhome_card( array( 'post' => $p, 'variant' => 'thumb', 'ribbon' => false, 'ratio' => '1/1' ) );
                    }
                    ?>
                </div>
                <aside class="rh-brides__ad" aria-label="Advertisement"><?php rowhome_ad( 'rect' ); ?></aside>
            </div>
        </section>

        <!-- 12. PRH MUSIC & ART -->
        <section class="rh-section rh-musicart" aria-labelledby="sec-musicart">
            <?php rowhome_section_header( 'MUSIC & ART', array( 'link' => rowhome_dept_url( 'dept-music-art' ) ) ); ?>
            <div class="rh-musicart__layout">
                <aside class="rh-musicart__ad" aria-label="Advertisement"><?php rowhome_ad( 'rect' ); ?></aside>
                <div class="rh-grid rh-grid--3 rh-grid--dotted">
                    <?php
                    $ma_posts = rowhome_dept_posts( array( 'dept-music-art', 'dept-film' ), 3, $exclude );
                    $ma_ph    = array( 'MUSIC', 'FILM', 'MUSIC' );
                    for ( $i = 0; $i < 3; $i++ ) {
                        $p = isset( $ma_posts[ $i ] ) ? $ma_posts[ $i ] : null;
                        rowhome_card( array(
                            'post'   => $p,
                            'ribbon' => $p ? '' : $ma_ph[ $i ],
                            'prefer' => array( 'dept-film', 'dept-music-art' ),
                            'words'  => 16,
                        ) );
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- 13. Tagline + leaderboard -->
        <?php rowhome_tagline_divider(); ?>
        <?php rowhome_ad( 'leader' ); ?>

        <!-- 14. PRH WRITERS BLOCK — 2 horizontal cards -->
        <section class="rh-section rh-writers" aria-labelledby="sec-writers">
            <?php rowhome_section_header( 'WRITERS BLOCK', array( 'link' => rowhome_dept_url( 'dept-writers-block' ) ) ); ?>
            <div class="rh-grid rh-grid--2 rh-grid--dotted">
                <?php rowhome_cards_for( 'dept-writers-block', 2, array( 'variant' => 'wide', 'ribbon' => false, 'avatar' => false, 'ratio' => '1/1', 'words' => 30 ), $exclude ); ?>
            </div>
        </section>

        <!-- 15. PRH MAGAZINE AD'S DIRECTORY -->
        <section class="rh-section rh-directory" aria-labelledby="sec-directory">
            <?php
            rowhome_section_header( "MAGAZINE AD'S DIRECTORY", array( 'link' => home_url( '/advertise/' ) ) );
            $advertisers = rowhome_advertiser_tiles( 8 );
            ?>
            <div class="rh-directory__strip">
                <?php foreach ( $advertisers as $ad ) : ?>
                    <a class="rh-directory__tile" href="<?php echo esc_url( $ad['url'] ); ?>" <?php echo $ad['external'] ? 'target="_blank" rel="noopener sponsored"' : ''; ?> aria-label="<?php echo esc_attr( $ad['name'] ); ?>">
                        <?php if ( $ad['img'] ) : ?>
                            <img src="<?php echo esc_url( $ad['img'] ); ?>" alt="<?php echo esc_attr( $ad['name'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo rowhome_placeholder_html( $ad['name'], '3/4' ); ?>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

    </div><!-- .rh-container -->

</main>

<?php get_footer(); ?>
