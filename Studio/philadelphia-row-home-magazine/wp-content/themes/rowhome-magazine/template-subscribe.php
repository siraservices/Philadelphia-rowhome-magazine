<?php
/**
 * Template Name: Subscribe & Advertise
 *
 * Subscription plans, benefits, and advertising options for
 * Philadelphia RowHome Magazine readers and business partners.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero Banner -->
        <div class="subscribe-hero">
            <div class="subscribe-hero__overlay">
                <div class="container">
                    <p class="subscribe-hero__eyebrow">Philadelphia RowHome Magazine</p>
                    <h1 class="subscribe-hero__title">Read It. Live It. Love Philly.</h1>
                    <p class="subscribe-hero__subtitle">Join over 40,000 readers who rely on RowHome Magazine for the best of Philadelphia living — neighborhoods, culture, food, real estate, and more.</p>
                </div>
            </div>
        </div>

        <div class="container">

            <!-- ===================== -->
            <!-- SUBSCRIBE SECTION     -->
            <!-- ===================== -->
            <section class="subscribe-section" id="subscribe">
                <div class="section-header">
                    <h2 class="section-title">Subscribe to RowHome Magazine</h2>
                </div>
                <p class="subscribe-intro">Get Philadelphia's premier row home lifestyle magazine delivered to your door or your inbox. Choose the plan that works for you.</p>

                <!-- Pricing Cards -->
                <div class="subscribe-plans">

                    <div class="subscribe-plan subscribe-plan--digital">
                        <div class="subscribe-plan__badge">Most Popular</div>
                        <div class="subscribe-plan__icon">&#9654;</div>
                        <h3 class="subscribe-plan__name">Digital Access</h3>
                        <div class="subscribe-plan__price">
                            <span class="subscribe-plan__amount">$29</span>
                            <span class="subscribe-plan__period">/ year</span>
                        </div>
                        <ul class="subscribe-plan__benefits">
                            <li>&#10003; Full digital archive — all issues</li>
                            <li>&#10003; Exclusive online-only articles</li>
                            <li>&#10003; Weekly e-newsletter</li>
                            <li>&#10003; Early access to events &amp; contests</li>
                            <li>&#10003; Cancel anytime</li>
                        </ul>
                        <a href="https://buy.stripe.com/7sY3cu77YdD4cF3fIr8IU00" class="subscribe-plan__cta subscribe-btn-primary">Subscribe Now</a>
                    </div>

                    <div class="subscribe-plan subscribe-plan--print">
                        <div class="subscribe-plan__icon">&#9646;</div>
                        <h3 class="subscribe-plan__name">Print Edition</h3>
                        <div class="subscribe-plan__price">
                            <span class="subscribe-plan__amount">$49</span>
                            <span class="subscribe-plan__period">/ year</span>
                        </div>
                        <ul class="subscribe-plan__benefits">
                            <li>&#10003; 6 print issues delivered to your home</li>
                            <li>&#10003; Collector's quality printing</li>
                            <li>&#10003; Philadelphia neighborhood spotlights</li>
                            <li>&#10003; Annual Best of Philly issue</li>
                            <li>&#10003; Free gift wrap for gift subscriptions</li>
                        </ul>
                        <a href="https://buy.stripe.com/8x228q9g6cz048xgMv8IU01" class="subscribe-plan__cta subscribe-btn-secondary">Get Print</a>
                    </div>

                    <div class="subscribe-plan subscribe-plan--bundle">
                        <div class="subscribe-plan__icon">&#9733;</div>
                        <h3 class="subscribe-plan__name">Print + Digital Bundle</h3>
                        <div class="subscribe-plan__price">
                            <span class="subscribe-plan__amount">$69</span>
                            <span class="subscribe-plan__period">/ year</span>
                        </div>
                        <ul class="subscribe-plan__benefits">
                            <li>&#10003; Everything in Print &amp; Digital plans</li>
                            <li>&#10003; Exclusive subscriber-only events</li>
                            <li>&#10003; Behind-the-scenes content</li>
                            <li>&#10003; Discounts at Philly partner businesses</li>
                            <li>&#10003; Priority access to cover story voting</li>
                        </ul>
                        <a href="https://buy.stripe.com/7sY28q4ZQeH848xeEn8IU02" class="subscribe-plan__cta subscribe-btn-primary">Best Value</a>
                    </div>

                </div>

                <!-- Gift Subscription Callout -->
                <div class="subscribe-gift-box">
                    <div class="subscribe-gift-box__icon">&#127873;</div>
                    <div class="subscribe-gift-box__content">
                        <h3>Give the Gift of Philadelphia</h3>
                        <p>RowHome Magazine makes the perfect gift for anyone who loves the City of Brotherly Love. Gift subscriptions available in any plan — we'll send a personalized card.</p>
                    </div>
                    <a href="mailto:subscribe@rowhomemag.com?subject=Gift%20Subscription" class="subscribe-btn-secondary">Gift a Subscription</a>
                </div>

            </section>

            <!-- ======================== -->
            <!-- ADVERTISE SECTION        -->
            <!-- ======================== -->
            <section class="advertise-section" id="advertise">
                <div class="section-header teal">
                    <h2 class="section-title">Advertise With Us</h2>
                </div>
                <p class="subscribe-intro">Reach Philadelphia's most engaged audience of homeowners, renters, foodies, culture seekers, and neighborhood loyalists. RowHome Magazine connects your brand to the people who live and love Philly.</p>

                <!-- Audience Stats -->
                <div class="advertise-stats">
                    <div class="advertise-stat">
                        <span class="advertise-stat__number">40K+</span>
                        <span class="advertise-stat__label">Monthly Readers</span>
                    </div>
                    <div class="advertise-stat">
                        <span class="advertise-stat__number">16+</span>
                        <span class="advertise-stat__label">Years Publishing</span>
                    </div>
                    <div class="advertise-stat">
                        <span class="advertise-stat__number">22</span>
                        <span class="advertise-stat__label">Editorial Departments</span>
                    </div>
                    <div class="advertise-stat">
                        <span class="advertise-stat__number">6</span>
                        <span class="advertise-stat__label">Print Issues / Year</span>
                    </div>
                </div>

                <!-- Ad Placement Options -->
                <h3 class="advertise-tiers-heading">Advertising Packages</h3>
                <div class="advertise-tiers">

                    <div class="advertise-tier">
                        <div class="advertise-tier__type">Digital</div>
                        <h4 class="advertise-tier__name">Online Display</h4>
                        <p class="advertise-tier__desc">Banner ads, sidebar placements, and sponsored content across rowhomemag.com. Geo-targeted to the Philadelphia metro area.</p>
                        <ul class="advertise-tier__specs">
                            <li>Leaderboard (728×90)</li>
                            <li>Rectangle (300×250)</li>
                            <li>Sponsored Article Placements</li>
                            <li>Newsletter Sponsorships</li>
                        </ul>
                        <a href="mailto:advertising@rowhomemag.com?subject=Digital%20Advertising%20Inquiry" class="subscribe-btn-secondary advertise-tier__cta">Inquire</a>
                    </div>

                    <div class="advertise-tier advertise-tier--featured">
                        <div class="advertise-tier__type">Print</div>
                        <h4 class="advertise-tier__name">Magazine Placements</h4>
                        <p class="advertise-tier__desc">Premium print ad placement in our bi-monthly magazine. Full-bleed color printing, distributed throughout Philadelphia and its suburbs.</p>
                        <ul class="advertise-tier__specs">
                            <li>Full Page (8.5″ × 11″)</li>
                            <li>Half Page (8.5″ × 5.5″)</li>
                            <li>Quarter Page (4.25″ × 5.5″)</li>
                            <li>Back Cover (Premium)</li>
                        </ul>
                        <a href="mailto:advertising@rowhomemag.com?subject=Print%20Advertising%20Inquiry" class="subscribe-btn-primary advertise-tier__cta">Inquire</a>
                    </div>

                    <div class="advertise-tier">
                        <div class="advertise-tier__type">Social &amp; Events</div>
                        <h4 class="advertise-tier__name">Integrated Campaigns</h4>
                        <p class="advertise-tier__desc">Sponsored social media posts, event partnerships, and branded content series. Perfect for brand awareness across the full RowHome audience.</p>
                        <ul class="advertise-tier__specs">
                            <li>Instagram &amp; Facebook Posts</li>
                            <li>Event Sponsorships</li>
                            <li>Branded Editorial Series</li>
                            <li>Podcast Mentions</li>
                        </ul>
                        <a href="mailto:advertising@rowhomemag.com?subject=Integrated%20Campaign%20Inquiry" class="subscribe-btn-secondary advertise-tier__cta">Inquire</a>
                    </div>

                </div>

                <!-- Submission Guidelines -->
                <div class="advertise-guidelines">
                    <h3>Ad Submission Guidelines</h3>
                    <div class="advertise-guidelines__grid">
                        <div class="advertise-guideline">
                            <h4>File Formats</h4>
                            <p>Print ads: PDF (press-quality, 300 DPI minimum). Digital ads: PNG, JPG, or GIF. Animated GIF max 15 seconds.</p>
                        </div>
                        <div class="advertise-guideline">
                            <h4>Deadlines</h4>
                            <p>Print ads must be submitted 3 weeks before publication. Digital ads go live within 48 hours of approval.</p>
                        </div>
                        <div class="advertise-guideline">
                            <h4>Content Standards</h4>
                            <p>All ads must comply with our editorial standards and reflect the quality and character of Philadelphia RowHome Magazine.</p>
                        </div>
                        <div class="advertise-guideline">
                            <h4>Contact</h4>
                            <p>Email <a href="mailto:advertising@rowhomemag.com">advertising@rowhomemag.com</a> for a current media kit, rate card, and availability.</p>
                        </div>
                    </div>
                    <div class="advertise-guidelines__cta">
                        <a href="mailto:advertising@rowhomemag.com?subject=Media%20Kit%20Request" class="subscribe-btn-primary">Request Media Kit</a>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="subscribe-btn-secondary">Contact Us</a>
                    </div>
                </div>

            </section>

        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
