<?php
/**
 * Template Name: Contact
 *
 * Contact page for Philadelphia RowHome Magazine — form + inboxes.
 * Copy source: claude/rowhomemag-adsense-pages.md (project doc) — no invented facts.
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
$rh_general_email = 'rowhomejordan@gmail.com';
$rh_ad_email      = 'rowhomejordan@gmail.com';
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero -->
        <div class="contact-hero">
            <div class="container">
                <p class="contact-hero__eyebrow">Philadelphia RowHome Magazine</p>
                <h1 class="contact-hero__title">Contact</h1>
                <p class="contact-hero__subtitle">We&rsquo;d love to hear from you, whether you have a story to tell, a business to promote, or a memory of the old neighborhood.</p>
            </div>
        </div>

        <div class="container">
            <div class="contact-layout">

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
                            <strong>Something went wrong.</strong> Your message could not be sent. Please try emailing us directly at <a href="mailto:rowhomejordan@gmail.com">rowhomejordan@gmail.com</a>.
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
                        <p class="contact-form__note">* Required fields. </p>
                    </form>
                </div><!-- .contact-form-column -->

                <aside class="contact-info-column">

                    <div class="contact-info-block" id="general">
                        <h3 class="contact-info-block__heading">General Inquiries</h3>
                        <ul class="contact-info-list">
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9993;</span>
                                <div><a href="mailto:<?php echo esc_attr( $rh_general_email ); ?>"><?php echo esc_html( $rh_general_email ); ?></a></div>
                            </li>
                        </ul>
                    </div>

                    <div class="contact-info-block" id="advertising">
                        <h3 class="contact-info-block__heading">Advertising</h3>
                        <p>Reach 20,000+ engaged readers across South Philadelphia, surrounding neighborhoods, and the Jersey Shore. Email us to request the RowHome media kit and current advertising rates.</p>
                        <ul class="contact-info-list">
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9993;</span>
                                <div><a href="mailto:<?php echo esc_attr( $rh_ad_email ); ?>"><?php echo esc_html( $rh_ad_email ); ?></a></div>
                            </li>
                        </ul>
                    </div>

                    <div class="contact-info-block" id="submissions">
                        <h3 class="contact-info-block__heading">Story Ideas &amp; Submissions</h3>
                        <p>Know a neighbor, local business, or community event we should feature? Have old neighborhood photos for <strong>Flashback</strong>, or writing for <strong>Writer&rsquo;s Block</strong>? Send it our way. Include your name, phone number, and a short description.</p>
                        <ul class="contact-info-list">
                            <li class="contact-info-item">
                                <span class="contact-info-item__icon" aria-hidden="true">&#9993;</span>
                                <div><a href="mailto:<?php echo esc_attr( $rh_general_email ); ?>"><?php echo esc_html( $rh_general_email ); ?></a></div>
                            </li>
                        </ul>
                        <p class="contact-form__note">By sending us a submission, you confirm that you have the right to share it and agree to our <a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>">Terms of Use</a>.</p>
                    </div>

                    <div class="contact-info-block" id="subscriptions">
                        <h3 class="contact-info-block__heading">Subscriptions</h3>
                        <p>To subscribe to the print edition or update a mailing address, email <a href="mailto:<?php echo esc_attr( $rh_general_email ); ?>"><?php echo esc_html( $rh_general_email ); ?></a>.</p>
                    </div>

                    <div class="contact-info-block" id="corrections">
                        <h3 class="contact-info-block__heading">Corrections</h3>
                        <p>We work hard to get things right. If you spot an error, email <a href="mailto:<?php echo esc_attr( $rh_general_email ); ?>"><?php echo esc_html( $rh_general_email ); ?></a> with the article title and the correction.</p>
                    </div>

                    <div class="contact-info-block" id="mailing-address">
                        <h3 class="contact-info-block__heading">Mailing Address</h3>
                        <address class="legal-contact-address">
                            <strong>Philadelphia RowHome, Inc.</strong> &middot; Philadelphia, PA
                        </address>
                    </div>

                    <div class="contact-info-block" id="follow">
                        <h3 class="contact-info-block__heading">Follow Us</h3>
                        <ul class="contact-info-list">
                            <li class="contact-info-item"><a href="https://www.facebook.com/PhiladelphiaRowhomeMagazine/" target="_blank" rel="noopener">Facebook</a></li>
                            <li class="contact-info-item"><a href="https://www.instagram.com/rowhomemag/" target="_blank" rel="noopener">Instagram</a></li>
                            <li class="contact-info-item"><a href="https://www.youtube.com/@RowhomeMagazine" target="_blank" rel="noopener">YouTube</a></li>
                            <li class="contact-info-item"><a href="https://issuu.com/philadelphiarowhomemagazine" target="_blank" rel="noopener">Past issues on Issuu</a></li>
                        </ul>
                    </div>

                </aside><!-- .contact-info-column -->

            </div><!-- .contact-layout -->
        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
