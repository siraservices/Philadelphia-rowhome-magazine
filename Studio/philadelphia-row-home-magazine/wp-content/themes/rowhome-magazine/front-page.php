<?php
/**
 * The template for displaying the homepage
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<!-- Advertisement Banner -->
<?php rowhome_magazine_display_adsense_ad('', 'auto', 'responsive', '', true); ?>

<!-- Hero Carousel Section -->
<section class="hero-carousel" id="heroCarousel">
    <div class="carousel-slide active">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-1.jpg" alt="Skinny Cheesesteaks Feature" loading="eager" fetchpriority="high" onerror="this.src='https://placehold.co/1200x500/5f8a8b/ffffff?text=SKINNY+CHEESESTEAKS'">
        <div class="carousel-content">
            <h2 class="carousel-title">SKINNY CHEESESTEAKS</h2>
            <p class="carousel-subtitle">A TRIBUTE TO FAMILY TRADITIONS</p>
            <div class="carousel-meta">
                by DORETTE ROTA JACKSON | photos by ANDREW ANDREOZZI
            </div>
        </div>
    </div>
    <div class="carousel-slide">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-2.jpg" alt="Local Artist Feature" loading="lazy" onerror="this.src='https://placehold.co/1200x500/5f8a8b/ffffff?text=PHILADELPHIA+STORIES'">
        <div class="carousel-content">
            <h2 class="carousel-title">PHILADELPHIA STORIES</h2>
            <p class="carousel-subtitle">CELEBRATING LOCAL CULTURE</p>
            <div class="carousel-meta">
                by ANTHONY PANVINI | photos by JAMES MITCHELL
            </div>
        </div>
    </div>
    <div class="carousel-slide">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-3.jpg" alt="Neighborhood Guide" loading="lazy" onerror="this.src='https://placehold.co/1200x500/5f8a8b/ffffff?text=NEIGHBORHOOD+GUIDE'">
        <div class="carousel-content">
            <h2 class="carousel-title">NEIGHBORHOOD GUIDE</h2>
            <p class="carousel-subtitle">DISCOVER HIDDEN GEMS</p>
            <div class="carousel-meta">
                by MARIA GONZALEZ | photos by ROBERT CHEN
            </div>
        </div>
    </div>
    <div class="carousel-dots">
        <span class="carousel-dot active" data-slide="0"></span>
        <span class="carousel-dot" data-slide="1"></span>
        <span class="carousel-dot" data-slide="2"></span>
    </div>
</section>

<!-- Subscribe & Advertise CTA Banner -->
<div class="homepage-cta-banner">
    <div class="homepage-cta-banner__content">
        <h2>Philadelphia's Magazine, Your Way</h2>
        <p>Get RowHome delivered to your door or inbox — or reach 40,000+ Philly readers by advertising with us.</p>
    </div>
    <div class="homepage-cta-banner__actions">
        <a href="<?php echo esc_url(home_url('/subscribe')); ?>" class="subscribe-btn-primary">Subscribe Now</a>
        <a href="<?php echo esc_url(home_url('/advertise')); ?>" class="subscribe-btn-secondary">Advertise With Us</a>
    </div>
</div>

<div class="container">

    <!-- Combined LIFE & HOTSPOTS Section with Shared Banner -->
    <div class="section-with-shared-banner">
        <div class="main-content-sections">
            
            <!-- LIFE Section -->
            <section class="life-section">
                <div class="section-header">
                    <h2 class="section-title">PRH LIFE</h2>
                </div>
                
                <div class="article-grid grid-3">
                    <?php
                    // Get recent LIFE articles
                    $life_query = new WP_Query(array(
                        'posts_per_page' => 3,
                        'post_type' => array('post', 'department'),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'department_category',
                                'field' => 'slug',
                                'terms' => 'dept-life',
                            ),
                        ),
                    ));
                    
                    if ($life_query->have_posts()) :
                        while ($life_query->have_posts()) : $life_query->the_post();
                    ?>
                        <article class="article-card with-vertical-label">
                            <?php
                            $life_terms = get_the_terms(get_the_ID(), 'department_category');
                            $life_label = 'LIFE';
                            if (!empty($life_terms) && !is_wp_error($life_terms)) {
                                $life_dept_slugs = array('dept-life', 'dept-health', 'dept-fashion', 'dept-brides-guide', 'dept-community', 'dept-writers-block');
                                foreach ($life_terms as $term) {
                                    if (in_array($term->slug, $life_dept_slugs, true)) {
                                        $life_label = strtoupper($term->name);
                                        break;
                                    }
                                }
                            }
                            ?>
                            <span class="vertical-label"><?php echo esc_html($life_label); ?></span>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="article-image">
                                    <?php the_post_thumbnail('rowhome-article-card'); ?>
                                </div>
                            <?php else : ?>
                                <div class="article-image">
                                    <img src="https://placehold.co/400x300/cccccc/333333?text=LIFE" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                            <div class="article-content">
                                <div class="article-author-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
                                </div>
                                <div class="article-text">
                                    <h4 class="article-title"><?php the_title(); ?></h4>
                                    <div class="article-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
                                </div>
                            </div>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback placeholder articles
                        for ($i = 1; $i <= 3; $i++) :
                            $labels = array('LIFE', 'LIFE', 'LIFE');
                    ?>
                        <article class="article-card with-vertical-label">
                            <span class="vertical-label"><?php echo $labels[$i-1]; ?></span>
                            <div class="article-image">
                                <img src="https://placehold.co/400x300/cccccc/ffffff?text=LIFE+<?php echo $i; ?>" alt="Life Article <?php echo $i; ?>" loading="lazy">
                            </div>
                            <div class="article-content">
                                <div class="article-author-avatar">
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #ccc;"></div>
                                </div>
                                <div class="article-text">
                                    <h4 class="article-title">Philadelphia Life Story <?php echo $i; ?></h4>
                                    <div class="article-excerpt">Discover the vibrant stories that make Philadelphia unique and special...</div>
                                </div>
                            </div>
                        </article>
                    <?php
                        endfor;
                    endif;
                    ?>
                </div>
            </section>

            <!-- 2025 HOTSPOTS Section -->
            <section class="hotspots-section">
                <div class="section-header">
                    <h2 class="section-title">PRH 2025 HOTSPOTS</h2>
                </div>
                
                <h3 class="hotspots-decorative-title">Hot Spots</h3>
                
                <div class="hotspots-content">
                    <div class="hotspots-text">
                        <?php
                        $hotspots_query = new WP_Query(array(
                            'posts_per_page' => 1,
                            'post_type' => array('post', 'department'),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'department_category',
                                    'field' => 'slug',
                                    'terms' => 'dept-2025-hotspots',
                                ),
                            ),
                        ));
                        
                        <?php $hotspots_thumb = ''; ?>
                        <?php if ($hotspots_query->have_posts()) :
                            while ($hotspots_query->have_posts()) : $hotspots_query->the_post();
                                $hotspots_thumb = get_the_post_thumbnail(null, 'rowhome-article-card', array('alt' => 'Philadelphia Hotspots', 'loading' => 'lazy'));
                        ?>
                            <h3><?php the_title(); ?></h3>
                            <?php the_excerpt(); ?>
                            <?php rowhome_magazine_article_meta(); ?>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                        ?>
                            <h3>Discover Philadelphia's Newest Hotspots</h3>
                            <p>From trendy restaurants to hidden speakeasies, explore the latest openings and events taking the city by storm. Our curated guide brings you the best new venues, pop-ups, and cultural experiences happening right now.</p>
                            <p>Whether you're looking for the perfect date night spot, a new weekend brunch destination, or the hottest entertainment venue, we've got you covered with insider tips and exclusive previews.</p>
                            <p>Check back regularly as we update our list with the freshest additions to Philadelphia's vibrant scene.</p>
                        <?php endif; ?>
                    </div>

                    <div class="hotspots-image">
                        <?php if ($hotspots_thumb) : ?>
                            <?php echo $hotspots_thumb; ?>
                        <?php else : ?>
                            <img src="https://placehold.co/400x400/cccccc/333333?text=HOTSPOT" alt="Philadelphia Hotspots" loading="lazy">
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            
        </div>
        
        <!-- Shared Sidebar Ad Banner -->
        <div class="shared-sidebar-ad">
            <?php rowhome_magazine_display_adsense_ad('', 'auto', 'responsive', 'vertical-ad', true); ?>
        </div>
    </div>

    <!-- BUSINESS Section -->
    <section class="business-section">
        <div class="section-header">
            <h2 class="section-title">PRH BUSINESS</h2>
        </div>
        
        <div class="business-featured-layout">
            <div class="business-title-section">
                <h2 class="business-large-title">VICTOR<br>DELLA<br>BARBA</h2>
                <p class="business-subtitle">LOCAL ARTIST TURNS <span class="highlight-text">IDEAS</span> INTO <span class="highlight-text">VISIONS</span></p>
                <div class="business-logo">
                    <img src="https://placehold.co/200x100/ffffff/000000?text=Victor+Co" alt="Business Logo" loading="lazy">
                </div>
            </div>
            
            <div class="business-images">
                <div class="business-image-grid">
                    <img src="https://placehold.co/350x250/4a90e2/ffffff?text=Business+Image+1" alt="Business Feature 1" loading="lazy">
                    <img src="https://placehold.co/350x250/e74c3c/ffffff?text=Business+Image+2" alt="Business Feature 2" loading="lazy">
                </div>
            </div>
        </div>
        
        <div class="business-text-content">
            <?php
            $business_query = new WP_Query(array(
                'posts_per_page' => 1,
                'post_type' => array('post', 'department'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'department_category',
                        'field' => 'slug',
                        'terms' => 'dept-business',
                    ),
                ),
            ));
            
            if ($business_query->have_posts()) :
                while ($business_query->have_posts()) : $business_query->the_post();
                    the_excerpt();
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <p>Philadelphia's business community continues to thrive with innovative entrepreneurs and established companies working together to build a stronger economic future. From tech startups in University City to manufacturing in the Northeast, our city's diverse business landscape offers opportunities for growth and collaboration.</p>
                <p>Local business leaders are investing in their communities, creating jobs, and fostering innovation that puts Philadelphia on the map as a destination for business excellence.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- HEALTH Section -->
    <section class="health-section">
        <div class="section-header">
            <h2 class="section-title">PRH HEALTH</h2>
        </div>
        
        <div class="article-grid grid-2">
            <?php
            $health_query = new WP_Query(array(
                'posts_per_page' => 2,
                'post_type' => array('post', 'department'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'department_category',
                        'field' => 'slug',
                        'terms' => 'dept-health',
                    ),
                ),
            ));
            
            if ($health_query->have_posts()) :
                while ($health_query->have_posts()) : $health_query->the_post();
            ?>
                <article class="article-card with-vertical-label">
                    <span class="vertical-label">HEALTH</span>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="article-image">
                            <?php the_post_thumbnail('rowhome-article-card'); ?>
                        </div>
                    <?php else : ?>
                        <div class="article-image">
                            <img src="https://placehold.co/400x300/cccccc/333333?text=HEALTH" alt="<?php the_title_attribute(); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="article-content">
                        <div class="article-author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                        </div>
                        <div class="article-text">
                            <h4 class="article-title"><?php the_title(); ?></h4>
                            <div class="article-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                for ($i = 1; $i <= 2; $i++) :
            ?>
                <article class="article-card with-vertical-label">
                    <span class="vertical-label">HEALTH</span>
                    <div class="article-image">
                        <img src="https://placehold.co/400x300/cccccc/ffffff?text=HEALTH+<?php echo $i; ?>" alt="Health Article <?php echo $i; ?>" loading="lazy">
                    </div>
                    <div class="article-content">
                        <div class="article-author-avatar">
                            <div style="width: 60px; height: 60px; border-radius: 50%; background: #ccc;"></div>
                        </div>
                        <div class="article-text">
                            <h4 class="article-title">Philadelphia Health & Wellness Story <?php echo $i; ?></h4>
                            <div class="article-excerpt">Discover the latest health trends and wellness advice from local experts helping our community stay healthy and active...</div>
                        </div>
                    </div>
                </article>
            <?php
                endfor;
            endif;
            ?>
        </div>
    </section>

    <!-- REAL ESTATE Section -->
    <section class="real-estate-section">
        <div class="section-header">
            <h2 class="section-title">PRH REAL ESTATE</h2>
        </div>
        
        <p class="section-tagline">River to River. One Neighborhood.</p>
        
        <div class="article-grid grid-4">
            <?php
            $realestate_query = new WP_Query(array(
                'posts_per_page' => 4,
                'post_type' => array('post', 'department'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'department_category',
                        'field' => 'slug',
                        'terms' => 'dept-real-estate',
                    ),
                ),
            ));
            
            if ($realestate_query->have_posts()) :
                while ($realestate_query->have_posts()) : $realestate_query->the_post();
            ?>
                <article class="article-card with-vertical-label real-estate-card">
                    <span class="vertical-label">REAL ESTATE</span>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="article-image">
                            <?php the_post_thumbnail('rowhome-article-card'); ?>
                        </div>
                    <?php else : ?>
                        <div class="article-image">
                            <img src="https://placehold.co/400x300/cccccc/333333?text=REAL+ESTATE" alt="<?php the_title_attribute(); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="article-content">
                        <div class="article-author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                        </div>
                        <div class="article-text">
                            <h5 class="article-title"><?php the_title(); ?></h5>
                            <p class="article-subtitle">by <?php $re_author = trim(get_the_author() ?? ''); echo esc_html($re_author !== '' ? $re_author : 'RowHome Staff'); ?></p>
                            <div class="article-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                for ($i = 1; $i <= 4; $i++) :
            ?>
                <article class="article-card with-vertical-label real-estate-card">
                    <span class="vertical-label">REAL ESTATE</span>
                    <div class="article-image">
                        <img src="https://placehold.co/400x300/cccccc/ffffff?text=REAL+ESTATE+<?php echo $i; ?>" alt="Real Estate <?php echo $i; ?>" loading="lazy">
                    </div>
                    <div class="article-content">
                        <div class="article-author-avatar">
                            <div style="width: 60px; height: 60px; border-radius: 50%; background: #ccc;"></div>
                        </div>
                        <div class="article-text">
                            <h5 class="article-title">Philadelphia Property Listing <?php echo $i; ?></h5>
                            <p class="article-subtitle">by Real Estate Agent</p>
                            <div class="article-excerpt">Discover amazing properties in Philadelphia's most sought-after neighborhoods. From historic row homes to modern condos...</div>
                        </div>
                    </div>
                </article>
            <?php
                endfor;
            endif;
            ?>
        </div>
    </section>

</div>

<!-- Web Banner Below Real Estate -->
<?php rowhome_magazine_display_adsense_ad('', 'auto', 'responsive', '', true); ?>

<div class="container">
    
    <!-- MENU Section -->
    <section class="menu-section">
        <div class="section-header">
            <h2 class="section-title">PRH MENU</h2>
        </div>
        
        <h3 class="menu-decorative-title">Hot Spots</h3>
        
        <div class="article-grid grid-4">
            <?php
            $menu_query = new WP_Query(array(
                'posts_per_page' => 4,
                'post_type' => array('post', 'department'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'department_category',
                        'field' => 'slug',
                        'terms' => 'dept-menu',
                    ),
                ),
            ));
            
            if ($menu_query->have_posts()) :
                while ($menu_query->have_posts()) : $menu_query->the_post();
            ?>
                <article class="article-card with-vertical-label menu-card">
                    <span class="vertical-label vertical-label-green">MENU</span>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="article-image">
                            <?php the_post_thumbnail('rowhome-article-card'); ?>
                        </div>
                    <?php else : ?>
                        <div class="article-image">
                            <img src="https://placehold.co/400x300/cccccc/333333?text=MENU" alt="<?php the_title_attribute(); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="article-content">
                        <h5 class="article-title"><?php the_title(); ?></h5>
                        <div class="article-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                for ($i = 1; $i <= 4; $i++) :
                    $menu_titles = array(
                        'Best New Restaurants in South Philly',
                        'Hidden Gem Cafes You Need to Try',
                        'Top Brunch Spots for Weekends',
                        'Late Night Eats in Center City'
                    );
            ?>
                <article class="article-card with-vertical-label menu-card">
                    <span class="vertical-label vertical-label-green">MENU</span>
                    <div class="article-image">
                        <img src="https://placehold.co/400x300/cccccc/ffffff?text=MENU+<?php echo $i; ?>" alt="Menu <?php echo $i; ?>" loading="lazy">
                    </div>
                    <div class="article-content">
                        <h5 class="article-title"><?php echo esc_html($menu_titles[$i-1]); ?></h5>
                        <div class="article-excerpt">Explore Philadelphia's vibrant culinary scene with our curated guide to the best dining experiences. From classic cheesesteaks to innovative fusion cuisine, discover the flavors that make our city unique. Each recommendation comes from local food lovers who know where to find the best meals in town.</div>
                    </div>
                </article>
            <?php
                endfor;
            endif;
            ?>
        </div>
    </section>
    
    <!-- BRIDES GUIDE Section -->
    <section class="brides-guide-section">
        <div class="section-header">
            <h2 class="section-title">PRH BRIDES GUIDE</h2>
        </div>
        
        <!-- Featured Content -->
        <?php
        $brides_featured_query = new WP_Query(array(
            'posts_per_page' => 1,
            'post_type' => array('post', 'department'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'department_category',
                    'field' => 'slug',
                    'terms' => 'dept-brides-guide',
                ),
            ),
        ));
        $brides_featured_thumb = '';
        if ($brides_featured_query->have_posts()) :
            while ($brides_featured_query->have_posts()) : $brides_featured_query->the_post();
                $brides_featured_thumb = get_the_post_thumbnail(null, 'rowhome-article-card', array('alt' => 'Brides Guide Featured', 'loading' => 'lazy'));
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
        <div class="brides-featured-content">
            <div class="brides-featured-image">
                <?php if ($brides_featured_thumb) : ?>
                    <?php echo $brides_featured_thumb; ?>
                <?php else : ?>
                    <img src="https://placehold.co/400x350/cccccc/ffffff?text=Bride+Feature" alt="Brides Guide Featured" loading="lazy">
                <?php endif; ?>
            </div>
            <div class="brides-featured-text">
                <h3>Your Perfect Philadelphia Wedding</h3>
                <h4>Everything You Need to Plan Your Special Day</h4>
                <p>From stunning venues along the Schuylkill River to historic mansions in Fairmount Park, discover the perfect setting for your wedding celebration.</p>
                <p>Our comprehensive guide features the city's top wedding vendors, including photographers, florists, caterers, and planners who specialize in creating unforgettable moments.</p>
                <p>Whether you're planning an intimate ceremony or a grand celebration, find inspiration and resources to make your Philadelphia wedding dreams come true.</p>
            </div>
        </div>
        
        <!-- Grid with Sidebar -->
        <div class="brides-grid-with-banner">
            <div class="brides-image-grid">
                <?php
                $brides_query = new WP_Query(array(
                    'posts_per_page' => 8,
                    'post_type' => array('post', 'department'),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'department_category',
                            'field' => 'slug',
                            'terms' => 'dept-brides-guide',
                        ),
                    ),
                ));
                
                if ($brides_query->have_posts()) :
                    $count = 0;
                    while ($brides_query->have_posts()) : $brides_query->the_post();
                        $count++;
                        if ($count == 5) : ?>
                            <div class="philly-logo-overlay">
                                <div class="philly-logo">Philly</div>
                            </div>
                        <?php endif;
                ?>
                    <div class="brides-grid-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('rowhome-small-card'); ?>
                        <?php else : ?>
                            <img src="https://placehold.co/300x300/cccccc/ffffff?text=Bride+<?php echo $count; ?>" alt="Bride <?php echo $count; ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    for ($i = 1; $i <= 8; $i++) :
                        if ($i == 5) : ?>
                            <div class="philly-logo-overlay">
                                <div class="philly-logo">Philly</div>
                            </div>
                        <?php endif; ?>
                        <div class="brides-grid-image">
                            <img src="https://placehold.co/300x300/cccccc/ffffff?text=Bride+<?php echo $i; ?>" alt="Bride <?php echo $i; ?>" loading="lazy">
                        </div>
                    <?php endfor;
                endif;
                ?>
            </div>
            
            <!-- Web Banner -->
            <div class="brides-sidebar-banner">
                <?php rowhome_magazine_display_adsense_ad('', 'auto', 'responsive', 'vertical-ad', true); ?>
            </div>
        </div>
    </section>

    <!-- MUSIC & ART Section -->
    <section class="music-art-section">
        <div class="section-header">
            <h2 class="section-title">PRH <span style="color: #5f8a8b;">MUSIC &amp; ART</span></h2>
        </div>
        
        <div class="music-art-layout">
            <!-- Left Web Banner -->
            <div class="music-art-banner-left">
                <?php rowhome_magazine_display_adsense_ad('', 'auto', 'responsive', 'vertical-ad', true); ?>
            </div>
            
            <!-- Right Cards Grid -->
            <div class="music-art-cards">
                <?php
                $music_query = new WP_Query(array(
                    'posts_per_page' => 3,
                    'post_type' => array('post', 'department'),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'department_category',
                            'field' => 'slug',
                            'terms' => 'dept-music-art',
                        ),
                    ),
                ));
                
                if ($music_query->have_posts()) :
                    $count = 0;
                    while ($music_query->have_posts()) : $music_query->the_post();
                        $count++;
                        $label = ($count % 2 == 0) ? 'ART' : 'MUSIC';
                ?>
                    <article class="article-card with-vertical-label">
                        <span class="vertical-label vertical-label-teal"><?php echo $label; ?></span>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="article-image">
                                <?php the_post_thumbnail('rowhome-article-card'); ?>
                            </div>
                        <?php else : ?>
                            <div class="article-image">
                                <img src="https://placehold.co/400x300/cccccc/ffffff?text=<?php echo $label; ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                        <div class="article-content">
                            <div class="article-author-avatar">
                                <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                            </div>
                            <div class="article-text">
                                <h4 class="article-title"><?php the_title(); ?></h4>
                                <div class="article-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                            </div>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    $labels = array('MUSIC', 'ART', 'MUSIC');
                    for ($i = 1; $i <= 3; $i++) :
                ?>
                    <article class="article-card with-vertical-label">
                        <span class="vertical-label vertical-label-teal"><?php echo $labels[$i-1]; ?></span>
                        <div class="article-image">
                            <img src="https://placehold.co/400x300/cccccc/ffffff?text=<?php echo $labels[$i-1]; ?>+<?php echo $i; ?>" alt="<?php echo $labels[$i-1]; ?> Article <?php echo $i; ?>">
                        </div>
                        <div class="article-content">
                            <div class="article-author-avatar">
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: #ccc;"></div>
                            </div>
                            <div class="article-text">
                                <h4 class="article-title">Philadelphia <?php echo $labels[$i-1]; ?> Story <?php echo $i; ?></h4>
                                <div class="article-excerpt">Discover the vibrant <?php echo strtolower($labels[$i-1]); ?> scene in Philadelphia with local artists and performers...</div>
                            </div>
                        </div>
                    </article>
                <?php
                    endfor;
                endif;
                ?>
            </div>
        </div>
        
        <!-- Section Tagline -->
        <p class="section-tagline">River to River: One Neighborhood.</p>
    </section>

</div>

<!-- Web Banner Below Music & Art -->
<?php rowhome_magazine_display_adsense_ad('', 'auto', 'responsive', '', true); ?>

<div class="container">
    
    <!-- WRITERS BLOCK Section -->
    <section class="writers-block-section">
        <div class="section-header">
            <h2 class="section-title">PRH <span style="color: #999999;">WRITERS BLOCK</span></h2>
        </div>
        
        <div class="writers-block-grid">
            <?php
            $writers_query = new WP_Query(array(
                'posts_per_page' => 2,
                'post_type' => array('post', 'department'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'department_category',
                        'field' => 'slug',
                        'terms' => 'dept-writers-block',
                    ),
                ),
            ));
            
            if ($writers_query->have_posts()) :
                while ($writers_query->have_posts()) : $writers_query->the_post();
            ?>
                <article class="writers-block-card">
                    <div class="writers-block-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('rowhome-small-card'); ?>
                        <?php else : ?>
                            <img src="https://placehold.co/300x250/cccccc/ffffff?text=Writers+Block" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="writers-block-content">
                        <h4 class="writers-block-title"><?php the_title(); ?></h4>
                        <div class="writers-block-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></div>
                        <div class="writers-block-meta"><?php rowhome_magazine_article_meta(); ?></div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $writer_articles = array(
                    'The Hidden History of Philadelphia Row Homes',
                    'A Love Letter to South Philly'
                );
                foreach ($writer_articles as $index => $title) :
            ?>
                <article class="writers-block-card">
                    <div class="writers-block-image">
                        <img src="https://placehold.co/300x250/cccccc/ffffff?text=Writers+Block" alt="<?php echo esc_attr($title); ?>">
                    </div>
                    <div class="writers-block-content">
                        <h4 class="writers-block-title"><?php echo esc_html($title); ?></h4>
                        <div class="writers-block-excerpt">Philadelphia's row homes tell stories that span generations — from immigrant neighborhoods to artist enclaves. Each block holds a different chapter of the city's living history, waiting to be explored and celebrated.</div>
                        <div class="writers-block-meta">by <span class="article-author">Contributing Writer</span> | November 26, 2025</div>
                    </div>
                </article>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </section>

    <!-- MAGAZINE AD'S DIRECTORY Section -->
    <section class="magazine-ads-section">
        <div class="section-header">
            <h2 class="section-title">PRH<span style="color: #c9302c;">MAGAZINE AD'S DIRECTORY</span></h2>
        </div>
        
        <div class="magazine-ads-grid">
            <?php
            // Query for ad directory items
            $ads_query = new WP_Query(array(
                'posts_per_page' => 8,
                'post_type' => array('post', 'department'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'department_category',
                        'field' => 'slug',
                        'terms' => 'magazine-ads',
                    ),
                ),
            ));
            
            if ($ads_query->have_posts()) :
                while ($ads_query->have_posts()) : $ads_query->the_post();
            ?>
                <div class="magazine-ad-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('rowhome-article-card'); ?>
                    <?php else : ?>
                        <img src="https://placehold.co/300x380/ffffff/000000?text=<?php echo urlencode(get_the_title()); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $ad_names = array(
                    "D'Olivieri Jewelers",
                    "Dimitri's",
                    "Sciapode",
                    "The Birthplace of Freedom",
                    "Cescaphe",
                    "Rivers Casino",
                    "The Cutting Point",
                    "Event Venue"
                );
                foreach ($ad_names as $ad_name) :
            ?>
                <div class="magazine-ad-item">
                    <img src="https://placehold.co/300x380/ffffff/000000?text=<?php echo urlencode($ad_name); ?>" alt="<?php echo esc_attr($ad_name); ?>" loading="lazy">
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </section>

</div>

<?php
get_footer();
?>

