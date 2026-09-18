<?php
/**
 * Site footer — black; nameplate + inbox form | staff + socials | links; red © bar.
 * Matches Omar's wireframe (website_Home, bottom).
 *
 * @package RowHome_Magazine
 * @since 2.1.0
 */
?>

    </div><!-- #content -->
</div><!-- #page -->

<footer class="rh-footer" id="site-footer">
    <div class="rh-footer__badge"><?php rowhome_philly_badge( 'rh-philly--footer' ); ?></div>

    <div class="rh-container rh-footer__grid">

        <div class="rh-footer__col rh-footer__brand">
            <a class="rh-footer__nameplate" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="RowHome Magazine — home">
                <?php echo rowhome_inline_svg( 'brand/rowhome-wordmark.svg' ); ?>
            </a>
            <h3 class="rh-footer__inbox">Get us in your inbox</h3>
            <form class="rh-inbox" id="newsletterForm" action="#" method="post">
                <button type="submit" class="rh-inbox__btn footer-newsletter-submit">Subscribe</button>
                <label class="screen-reader-text" for="rh-inbox-email">Email address</label>
                <input type="email" id="rh-inbox-email" name="email" class="rh-inbox__input" placeholder="email address" required>
            </form>
            <div id="newsletterMessage" class="rh-inbox__msg" style="display:none;"></div>
            <p class="rh-footer__fine">
                By entering your email address you agree to our <a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>">Terms of Use</a> and
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a> and consent to receive emails from Philadelphia RowHome Magazine about news, events, offers and partner promotions.
            </p>
        </div>

        <div class="rh-footer__col rh-footer__staff">
            <p class="rh-footer__names">Dorette <span>&amp;</span> Dawn</p>
            <p class="rh-footer__staffline">and the staff of<br><strong>Philadelphia RowHome Magazine</strong></p>
            <div class="rh-social">
                <a class="rh-social__icon" href="https://www.facebook.com/PhiladelphiaRowhomeMagazine/" target="_blank" rel="noopener" aria-label="Facebook" title="Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 22v-8.2h2.8l.4-3.3h-3.2V8.4c0-.9.3-1.6 1.6-1.6h1.7V3.9c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2.4H7.3v3.3h2.8V22h3.4z"/></svg>
                </a>
                <a class="rh-social__icon" href="https://www.instagram.com/rowhomemag/" target="_blank" rel="noopener" aria-label="Instagram" title="Instagram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="4.5"/><circle cx="12" cy="12" r="3.6"/><circle cx="17" cy="7" r="1" fill="currentColor" stroke="none"/></svg>
                </a>
                <a class="rh-social__icon" href="https://www.youtube.com/@RowhomeMagazine" target="_blank" rel="noopener" aria-label="YouTube" title="YouTube">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.6 7.2c-.2-.9-.9-1.6-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4c-.9.2-1.6.9-1.8 1.8C2 8.8 2 12 2 12s0 3.2.4 4.8c.2.9.9 1.6 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4c.9-.2 1.6-.9 1.8-1.8.4-1.6.4-4.8.4-4.8s0-3.2-.4-4.8zM10 15V9l5.2 3L10 15z"/></svg>
                </a>
                <a class="rh-social__icon" href="https://issuu.com/philadelphiarowhomemagazine" target="_blank" rel="noopener" aria-label="Issuu — past issues" title="Issuu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="5" y="3.5" width="14" height="17" rx="1.5"/><path d="M8.5 8h7M8.5 11.5h7M8.5 15h4.5"/></svg>
                </a>
            </div>
        </div>

        <div class="rh-footer__col rh-footer__links">
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a></li>
                <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a></li>
                <li><a href="<?php echo esc_url( home_url( '/contact/#submissions' ) ); ?>">Editorial guidelines</a></li>
                <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy notice</a></li>
                <li><a href="<?php echo esc_url( home_url( '/privacy-policy/#cookies' ) ); ?>">Cookie policy</a></li>
                <li><a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>">Terms of use</a></li>
                <li><a href="<?php echo esc_url( home_url( '/advertise/' ) ); ?>">Advertising</a></li>
            </ul>
        </div>

    </div>

    <div class="rh-footer__bottom">
        <p class="rh-footer__copy">
            &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Philadelphia RowHome Magazine. All Rights Reserved. Use of this site constitutes acceptance of our
            <a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>">Terms of Use</a> and
            <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>.
        </p>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
