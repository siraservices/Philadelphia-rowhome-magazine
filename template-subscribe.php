<?php
/**
 * Template Name: Subscribe & Advertise
 *
 * How to get Philadelphia RowHome Magazine: print subscriptions (by email),
 * free digital editions on Issuu, and the e-newsletter. Advertising has its
 * own page (template-advertise.php); this page only points to it.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();

$rh_general_email = 'rowhomejordan@gmail.com';
$rh_issuu_profile = 'https://issuu.com/philadelphiarowhomemagazine';
$rh_sub_subject   = rawurlencode( 'Print Subscription - Philadelphia RowHome Magazine' );
$rh_gift_subject  = rawurlencode( 'Gift Subscription - Philadelphia RowHome Magazine' );
$rh_sub_body      = rawurlencode( "Hi RowHome,\n\nI'd like to subscribe to the print edition.\n\nName:\nMailing address:\nPhone:\n\nThank you!" );
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero Banner -->
        <div class="subscribe-hero">
            <div class="subscribe-hero__overlay">
                <div class="container">
                    <p class="subscribe-hero__eyebrow">Philadelphia RowHome Magazine</p>
                    <h1 class="subscribe-hero__title">Read It. Live It. Love Philly.</h1>
                    <p class="subscribe-hero__subtitle">Join more than 20,000 readers who turn to RowHome for the best of Philadelphia living &mdash; neighborhoods, food, real estate, and the people who make this city home.</p>
                </div>
            </div>
        </div>

        <div class="container">

            <!-- ===================== -->
            <!-- SUBSCRIBE SECTION     -->
            <!-- ===================== -->
            <section class="subscribe-section" id="subscribe">
                <div class="section-header">
                    <h2 class="section-title">Three Ways to Read RowHome</h2>
                </div>
                <p class="subscribe-intro">Philadelphia RowHome Magazine is published four times a year &mdash; Winter, Spring, Summer, and Fall. Get it delivered to your door, read it online, or keep up with us between issues.</p>

                <div class="subscribe-plans">

                    <div class="subscribe-plan subscribe-plan--digital">
                        <div class="subscribe-plan__badge">Print Edition</div>
                        <div class="subscribe-plan__icon">&#9646;</div>
                        <h3 class="subscribe-plan__name">Subscribe by Mail</h3>
                        <ul class="subscribe-plan__benefits">
                            <li>&#10003; Four print issues a year, delivered to your home</li>
                            <li>&#10003; Every department, River to River</li>
                            <li>&#10003; Perfect for readers near and far</li>
                            <li>&#10003; Email us your name and mailing address; we&rsquo;ll reply with current rates and payment options</li>
                        </ul>
                        <a href="mailto:<?php echo esc_attr( $rh_general_email ); ?>?subject=<?php echo $rh_sub_subject; ?>&amp;body=<?php echo $rh_sub_body; ?>" class="subscribe-plan__cta subscribe-btn-primary">Email to Subscribe</a>
                    </div>

                    <div class="subscribe-plan subscribe-plan--print">
                        <div class="subscribe-plan__icon">&#9654;</div>
                        <h3 class="subscribe-plan__name">Read Online</h3>
                        <ul class="subscribe-plan__benefits">
                            <li>&#10003; Recent issues, cover to cover, free</li>
                            <li>&#10003; Read on your phone, tablet, or desktop</li>
                            <li>&#10003; Browse our library of back issues on Issuu</li>
                            <li>&#10003; No account required</li>
                        </ul>
                        <a href="<?php echo esc_url( home_url( '/issues/' ) ); ?>" class="subscribe-plan__cta subscribe-btn-secondary">Browse Issues</a>
                    </div>

                    <div class="subscribe-plan subscribe-plan--bundle">
                        <div class="subscribe-plan__icon">&#9993;</div>
                        <h3 class="subscribe-plan__name">E-Newsletter</h3>
                        <ul class="subscribe-plan__benefits">
                            <li>&#10003; New stories from rowhomemag.com</li>
                            <li>&#10003; Event news and announcements</li>
                            <li>&#10003; A heads-up when the next issue drops</li>
                            <li>&#10003; Unsubscribe anytime</li>
                        </ul>
                        <form class="subscribe-plan__form js-newsletter-form" action="#" method="post">
                            <label class="screen-reader-text" for="subscribe-page-email">Email address</label>
                            <input type="email" id="subscribe-page-email" name="email" class="subscribe-plan__input" placeholder="Your email address" required>
                            <button type="submit" class="subscribe-plan__cta subscribe-btn-primary js-newsletter-submit">Sign Me Up</button>
                            <div class="subscribe-plan__msg js-newsletter-msg" role="status" aria-live="polite" style="display:none;"></div>
                        </form>
                    </div>

                </div>

                <!-- Gift Subscription Callout -->
                <div class="subscribe-gift-box">
                    <div class="subscribe-gift-box__icon">&#127873;</div>
                    <div class="subscribe-gift-box__content">
                        <h3>Give the Gift of Philadelphia</h3>
                        <p>RowHome makes a great gift for anyone who loves the City of Brotherly Love, whether they live around the corner or moved away years ago. Email us with the recipient&rsquo;s name and mailing address and we&rsquo;ll take it from there.</p>
                    </div>
                    <a href="mailto:<?php echo esc_attr( $rh_general_email ); ?>?subject=<?php echo $rh_gift_subject; ?>" class="subscribe-btn-secondary">Gift a Subscription</a>
                </div>

            </section>

            <!-- ======================== -->
            <!-- ADVERTISE POINTER        -->
            <!-- ======================== -->
            <section class="advertise-section" id="advertise">
                <div class="section-header teal">
                    <h2 class="section-title">Advertise With Us</h2>
                </div>
                <p class="subscribe-intro">Put your business in front of 20,000+ engaged readers across South Philadelphia, the surrounding neighborhoods, and the Jersey Shore &mdash; in print and online.</p>
                <div class="advertise-guidelines__cta">
                    <a href="<?php echo esc_url( home_url( '/advertise/' ) ); ?>" class="subscribe-btn-primary">Advertising Options</a>
                    <a href="mailto:<?php echo esc_attr( $rh_general_email ); ?>?subject=<?php echo rawurlencode( 'Media Kit Request' ); ?>" class="subscribe-btn-secondary">Request a Media Kit</a>
                </div>
            </section>

        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
