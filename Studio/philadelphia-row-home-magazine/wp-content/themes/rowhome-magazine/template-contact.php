<?php
/**
 * Template Name: Contact
 *
 * Contact form, business information, social links, map placeholder,
 * and awards/recognition section for Philadelphia RowHome Magazine.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

// Handle contact form submission before headers are sent
$contact_status = '';
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['rowhome_contact_nonce']) &&
    wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['rowhome_contact_nonce'])), 'rowhome_contact_form')
) {
    $sender_name    = sanitize_text_field(wp_unslash($_POST['contact_name'] ?? ''));
    $sender_email   = sanitize_email(wp_unslash($_POST['contact_email'] ?? ''));
    $subject_choice = sanitize_text_field(wp_unslash($_POST['contact_subject'] ?? ''));
    $message_body   = sanitize_textarea_field(wp_unslash($_POST['contact_message'] ?? ''));

    if ($sender_name && is_email($sender_email) && $subject_choice && $message_body) {
        $to         = get_option('admin_email');
        $subject    = 'RowHome Contact: ' . $subject_choice . ' — from ' . $sender_name;
        $body       = "Name: {$sender_name}\nEmail: {$sender_email}\nSubject: {$subject_choice}\n\nMessage:\n{$message_body}";
        $headers    = array(
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $sender_name . ' <' . $sender_email . '>',
        );
        $contact_status = wp_mail($to, $subject, $body, $headers) ? 'success' : 'error';
    } else {
        $contact_status = 'invalid';
    }
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero -->
        <div class="contact-hero">
            <div class="container">
                <p class="contact-hero__eyebrow">Philadelphia RowHome Magazine</p>
                <h1 class="contact-hero__title">Get in Touch</h1>
                <p class="contact-hero__subtitle">Questions, pitches, corrections, advertising inquiries — we want to hear from you.</p>
            </div>
        </div>

        <div class="container">
            <div class="contact-layout">

                <!-- ======================== -->
                <!-- CONTACT FORM             -->
                <!-- ======================== -->
                <div class="contact-form-column">
                    <div class="section-header">
                        <h2 class="section-title">Send Us a Message</h2>
                    </div>

                    <?php if ($contact_status === 'success') : ?>
                        <div class="contact-alert contact-alert--success" role="alert">
                            <strong>Message sent!</strong> Thank you for reaching out. We'll get back to you within 2&ndash;3 business days.
                        </div>
                    <?php elseif ($contact_status === 'error') : ?>
                        <div class="contact-alert contact-alert--error" role="alert">
                            <strong>Something went wrong.</strong> Your message could not be sent. Please try emailing us directly at <a href="mailto:hello@rowhomemagazine.com">hello@rowhomemagazine.com</a>.
                        </div>
                    <?php elseif ($contact_status === 'invalid') : ?>
                        <div class="contact-alert contact-alert--error" role="alert">
                            <strong>Please fill in all required fields</strong> with valid information and try again.
                        </div>
                    <?php endif; ?>

                    <form
                        class="contact-form"
                        method="post"
                        action="<?php echo esc_url(get_permalink()); ?>#contact-form"
                        id="contact-form"
                        novalidate
                    >
                        <?php wp_nonce_field('rowhome_contact_form', 'rowhome_contact_nonce'); ?>

                        <div class="contact-form__row contact-form__row--two">
                            <div class="contact-form__group">
                                <label for="contact_name" class="contact-form__label">
                                    Your Name <span class="contact-form__required" aria-hidden="true">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="contact_name"
                                    name="contact_name"
                                    class="contact-form__input"
                                    value="<?php echo esc_attr($_POST['contact_name'] ?? ''); ?>"
                                    placeholder="Jane Smith"
                                    required
                                    autocomplete="name"
                                >
                            </div>
                            <div class="contact-form__group">
                                <label for="contact_email" class="contact-form__label">
                                    Email Address <span class="contact-form__required" aria-hidden="true">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="contact_email"
                                    name="contact_email"
                                    class="contact-form__input"
                                    value="<?php echo esc_attr($_POST['contact_email'] ?? ''); ?>"
                                    placeholder="jane@example.com"
                                    required
                                    autocomplete="email"
                                >
                            </div>
                        </div>

                        <div class="contact-form__group">
                            <label for="contact_subject" class="contact-form__label">
                                Subject <span class="contact-form__required" aria-hidden="true">*</span>
                            </label>
                            <select id="contact_subject" name="contact_subject" class="contact-form__select" required>
                                <option value="">— Select a topic —</option>
                                <option value="General Inquiry"<?php selected($_POST['contact_subject'] ?? '', 'General Inquiry'); ?>>General Inquiry</option>
                                <option value="Subscription Help"<?php selected($_POST['contact_subject'] ?? '', 'Subscription Help'); ?>>Subscription Help</option>
                                <option value="Advertising"<?php selected($_POST['contact_subject'] ?? '', 'Advertising'); ?>>Advertising</option>
                                <option value="Story Pitch"<?php selected($_POST['contact_subject'] ?? '', 'Story Pitch'); ?>>Story Pitch / Submission</option>
                                <option value="Correction Request"<?php selected($_POST['contact_subject'] ?? '', 'Correction Request'); ?>>Correction Request</option>
                                <option value="Event Partnership"<?php selected($_POST['contact_subject'] ?? '', 'Event Partnership'); ?>>Event Partnership</option>
                                <option value="Photography"<?php selected($_POST['contact_subject'] ?? '', 'Photography'); ?>>Photography Inquiry</option>
                                <option value="Other"<?php selected($_POST['contact_subject'] ?? '', 'Other'); ?>>Other</option>
                            </select>
                        </div>

                        <div class="contact-form__group">
                            <label for="contact_message" class="contact-form__label">
                                Your Message <span class="contact-form__required" aria-hidden="true">*</span>
                            </label>
                            <textarea
                                id="contact_message"
                                name="contact_message"
                                class="contact-form__textarea"
                                rows="7"
                                placeholder="Tell us what's on your mind..."
                                required
                            ><?php echo esc_textarea($_POST['contact_message'] ?? ''); ?></textarea>
                        </div>

                        <button type="submit" class="contact-form__submit subscribe-btn-primary">
                            Send Message &#8594;
                        </button>
                        <p class="contact-form__note">* Required fields. We typically respond within 2&ndash;3 business days.</p>
                    </form>
                </div><!-- .contact-form-column -->

                <!-- ======================== -->
                <!-- CONTACT INFO SIDEBAR     -->
                <!-- ======================== -->
                <aside class="contact-info-column">

                    <!-- Business Info -->
                    <div class="contact-info-block">
                        <h3 class="contact-info-block__heading">Contact Information</h3>
                        <ul class="contact-info-list">
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9993;</span>
                                <div>
                                    <strong>General</strong><br>
                                    <a href="mailto:hello@rowhomemagazine.com">hello@rowhomemagazine.com</a>
                                </div>
                            </li>
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9993;</span>
                                <div>
                                    <strong>Editorial</strong><br>
                                    <a href="mailto:editorial@rowhomemagazine.com">editorial@rowhomemagazine.com</a>
                                </div>
                            </li>
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9993;</span>
                                <div>
                                    <strong>Advertising</strong><br>
                                    <a href="mailto:advertising@rowhomemagazine.com">advertising@rowhomemagazine.com</a>
                                </div>
                            </li>
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9742;</span>
                                <div>
                                    <strong>Phone</strong><br>
                                    <a href="tel:+12155550150">(215) 555-0150</a>
                                </div>
                            </li>
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9679;</span>
                                <div>
                                    <strong>Mailing Address</strong><br>
                                    Philadelphia RowHome Magazine<br>
                                    1234 South Street, Suite 200<br>
                                    Philadelphia, PA 19147
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div class="contact-info-block">
                        <h3 class="contact-info-block__heading">Follow Us</h3>
                        <div class="contact-social-links">
                            <a href="#" class="contact-social-link contact-social-link--facebook" aria-label="Facebook">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="contact-social-link contact-social-link--twitter" aria-label="Twitter / X">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                <span>Twitter / X</span>
                            </a>
                            <a href="#" class="contact-social-link contact-social-link--instagram" aria-label="Instagram">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="contact-social-link contact-social-link--linkedin" aria-label="LinkedIn">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                <span>LinkedIn</span>
                            </a>
                        </div>
                    </div>

                    <!-- Map Placeholder -->
                    <div class="contact-map">
                        <div class="contact-map__placeholder" role="img" aria-label="Map of Philadelphia RowHome Magazine office location at 1234 South Street, Philadelphia PA">
                            <div class="contact-map__inner">
                                <span class="contact-map__pin" aria-hidden="true">&#9679;</span>
                                <p class="contact-map__label">1234 South Street<br>Philadelphia, PA 19147</p>
                                <a href="https://maps.google.com/?q=South+Street+Philadelphia+PA" target="_blank" rel="noopener noreferrer" class="contact-map__link">Open in Google Maps &#8599;</a>
                            </div>
                        </div>
                    </div>

                </aside><!-- .contact-info-column -->

            </div><!-- .contact-layout -->

            <!-- ======================== -->
            <!-- AWARDS & RECOGNITION     -->
            <!-- ======================== -->
            <section class="contact-awards">
                <div class="section-header teal">
                    <h2 class="section-title">Awards &amp; Recognition</h2>
                </div>
                <div class="awards-grid">

                    <div class="award-card">
                        <div class="award-card__year">2023</div>
                        <div class="award-card__icon" aria-hidden="true">&#9733;</div>
                        <h3 class="award-card__title">Best Local Publication</h3>
                        <p class="award-card__org">Philadelphia Press Club</p>
                        <p class="award-card__desc">Recognized for outstanding coverage of Philadelphia neighborhoods and community affairs.</p>
                    </div>

                    <div class="award-card">
                        <div class="award-card__year">2022</div>
                        <div class="award-card__icon" aria-hidden="true">&#9733;</div>
                        <h3 class="award-card__title">Excellence in Community Journalism</h3>
                        <p class="award-card__org">Pennsylvania NewsMedia Association</p>
                        <p class="award-card__desc">Honored for investigative reporting on Philadelphia housing and real estate accessibility.</p>
                    </div>

                    <div class="award-card">
                        <div class="award-card__year">2021</div>
                        <div class="award-card__icon" aria-hidden="true">&#9733;</div>
                        <h3 class="award-card__title">Best Magazine Design</h3>
                        <p class="award-card__org">Philadelphia Design Awards</p>
                        <p class="award-card__desc">Awarded for the Winter 2021 "Resilience" issue redesign and visual identity overhaul.</p>
                    </div>

                    <div class="award-card">
                        <div class="award-card__year">2019</div>
                        <div class="award-card__icon" aria-hidden="true">&#9733;</div>
                        <h3 class="award-card__title">Philly's Best Independent Media</h3>
                        <p class="award-card__org">Philadelphia City Paper Readers' Poll</p>
                        <p class="award-card__desc">Voted best independent magazine by Philadelphia City Paper readers for the second consecutive year.</p>
                    </div>

                </div>
            </section>

        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
