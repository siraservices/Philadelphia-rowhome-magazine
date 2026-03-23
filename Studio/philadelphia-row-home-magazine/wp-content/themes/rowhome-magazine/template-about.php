<?php
/**
 * Template Name: About & FAQs
 *
 * Company story, mission, team, and frequently asked questions for
 * Philadelphia RowHome Magazine.
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Page Hero -->
        <div class="about-hero">
            <div class="about-hero__overlay">
                <div class="container">
                    <p class="about-hero__eyebrow">Est. 2010 &bull; Philadelphia, PA</p>
                    <h1 class="about-hero__title">About RowHome Magazine</h1>
                    <p class="about-hero__subtitle">Philadelphia's magazine for the people who live here, love it here, and wouldn't be anywhere else.</p>
                </div>
            </div>
        </div>

        <div class="container">

            <!-- ======================== -->
            <!-- OUR STORY SECTION        -->
            <!-- ======================== -->
            <section class="about-story">
                <div class="about-story__layout">
                    <div class="about-story__content">
                        <div class="section-header">
                            <h2 class="section-title">Our Story</h2>
                        </div>
                        <p class="about-story__lead">Philadelphia RowHome Magazine was born on a block in South Philly over fourteen years ago, out of a simple idea: <em>this city deserves a magazine as interesting as its people.</em></p>
                        <p>Founded by Dorette Rota Jackson and Dawn, RowHome started as a neighborhood publication celebrating the character of Philadelphia's iconic row homes — the architecture, the block parties, the stoops, and the stories that make each street its own community.</p>
                        <p>What began as a hyperlocal print pamphlet grew, issue by issue, into a full-fledged lifestyle magazine covering every corner of the city — from the art galleries of Old City to the garden clubs of Germantown, the BYOB restaurants of South Philly to the real estate boom reshaping Fishtown and Kensington.</p>
                        <p>Today, RowHome Magazine reaches over 40,000 readers across the Greater Philadelphia region. We publish six times a year in print, with fresh content online daily. We are fiercely independent, unapologetically local, and proud to call Philadelphia home.</p>
                        <div class="about-story__milestone-bar">
                            <div class="about-milestone">
                                <span class="about-milestone__year">2010</span>
                                <span class="about-milestone__event">Founded in South Philadelphia</span>
                            </div>
                            <div class="about-milestone">
                                <span class="about-milestone__year">2013</span>
                                <span class="about-milestone__event">First print newsstand distribution</span>
                            </div>
                            <div class="about-milestone">
                                <span class="about-milestone__year">2016</span>
                                <span class="about-milestone__event">Launched rowhomemagazine.com</span>
                            </div>
                            <div class="about-milestone">
                                <span class="about-milestone__year">2019</span>
                                <span class="about-milestone__event">Best Philadelphia Magazine — Philly Press Club</span>
                            </div>
                            <div class="about-milestone">
                                <span class="about-milestone__year">2024</span>
                                <span class="about-milestone__event">14+ years &amp; 40K+ readers strong</span>
                            </div>
                        </div>
                    </div>
                    <div class="about-story__sidebar">
                        <div class="about-story__image-block">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/about-founders.jpg"
                                alt="Dorette and Dawn, founders of Philadelphia RowHome Magazine"
                                onerror="this.src='https://placehold.co/480x360/5f8a8b/ffffff?text=Dorette+%26+Dawn'"
                            >
                            <p class="about-story__image-caption">Dorette &amp; Dawn, Founders</p>
                        </div>
                        <div class="about-stat-box">
                            <div class="about-stat">
                                <span class="about-stat__number">14+</span>
                                <span class="about-stat__label">Years of Publishing</span>
                            </div>
                            <div class="about-stat">
                                <span class="about-stat__number">40K+</span>
                                <span class="about-stat__label">Monthly Readers</span>
                            </div>
                            <div class="about-stat">
                                <span class="about-stat__number">6</span>
                                <span class="about-stat__label">Print Issues per Year</span>
                            </div>
                            <div class="about-stat">
                                <span class="about-stat__number">22</span>
                                <span class="about-stat__label">Editorial Departments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ======================== -->
            <!-- MISSION & VISION         -->
            <!-- ======================== -->
            <section class="about-mission">
                <div class="about-mission__layout">
                    <div class="about-mission__block about-mission__block--mission">
                        <div class="about-mission__icon">&#9670;</div>
                        <h3>Our Mission</h3>
                        <p>To celebrate the richness of Philadelphia life — its neighborhoods, its people, its food, its culture — through honest, beautiful, and deeply local journalism and storytelling.</p>
                    </div>
                    <div class="about-mission__block about-mission__block--vision">
                        <div class="about-mission__icon">&#9670;</div>
                        <h3>Our Vision</h3>
                        <p>A Philadelphia where every neighborhood has a voice, where community stories are told with dignity and craft, and where independent local media thrives for generations to come.</p>
                    </div>
                    <div class="about-mission__block about-mission__block--values">
                        <div class="about-mission__icon">&#9670;</div>
                        <h3>Our Values</h3>
                        <p>Community first. Independent editorial. Authentic Philadelphia voices. Accurate, fair, and locally grounded coverage — always.</p>
                    </div>
                </div>
            </section>

            <!-- ======================== -->
            <!-- TEAM SECTION             -->
            <!-- ======================== -->
            <section class="about-team">
                <div class="section-header teal">
                    <h2 class="section-title">Meet the Team</h2>
                </div>
                <div class="about-team__grid">

                    <div class="team-card">
                        <div class="team-card__avatar">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/team-dorette.jpg"
                                alt="Dorette Rota Jackson"
                                onerror="this.src='https://placehold.co/200x200/000000/ffffff?text=DR'"
                            >
                        </div>
                        <h3 class="team-card__name">Dorette Rota Jackson</h3>
                        <p class="team-card__title">Co-Founder &amp; Editor-in-Chief</p>
                        <p class="team-card__bio">A South Philly native, Dorette has been telling Philadelphia stories her entire career. Her writing spans food, culture, real estate, and community — always with a warm, deeply personal voice.</p>
                    </div>

                    <div class="team-card">
                        <div class="team-card__avatar">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/team-dawn.jpg"
                                alt="Dawn"
                                onerror="this.src='https://placehold.co/200x200/5f8a8b/ffffff?text=D'"
                            >
                        </div>
                        <h3 class="team-card__name">Dawn</h3>
                        <p class="team-card__title">Co-Founder &amp; Creative Director</p>
                        <p class="team-card__bio">Dawn brings the visual soul of RowHome Magazine to life. Her eye for design and deep love of Philadelphia architecture and aesthetics defines the look and feel of every issue.</p>
                    </div>

                    <div class="team-card">
                        <div class="team-card__avatar">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/team-anthony.jpg"
                                alt="Anthony Panvini"
                                onerror="this.src='https://placehold.co/200x200/333333/ffffff?text=AP'"
                            >
                        </div>
                        <h3 class="team-card__name">Anthony Panvini</h3>
                        <p class="team-card__title">Senior Staff Writer</p>
                        <p class="team-card__bio">Anthony covers Philadelphia neighborhoods, politics, and community affairs. He has been writing for RowHome since 2014 and is known for his deep-sourced neighborhood profiles.</p>
                    </div>

                    <div class="team-card">
                        <div class="team-card__avatar">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/team-staff.jpg"
                                alt="RowHome Magazine Staff"
                                onerror="this.src='https://placehold.co/200x200/FF0000/ffffff?text=Staff'"
                            >
                        </div>
                        <h3 class="team-card__name">Our Contributors</h3>
                        <p class="team-card__title">Writers, Photographers &amp; Editors</p>
                        <p class="team-card__bio">RowHome is powered by a talented team of Philadelphia-based writers, photographers, and editors who cover everything from cheesesteaks to architecture to city council meetings.</p>
                    </div>

                </div>
                <p class="about-team__join-note">Interested in contributing to RowHome Magazine? <a href="<?php echo esc_url(home_url('/contact')); ?>">Reach out to our editorial team.</a></p>
            </section>

            <!-- ======================== -->
            <!-- FAQ SECTION              -->
            <!-- ======================== -->
            <section class="about-faq" id="faq">
                <div class="section-header">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                </div>

                <div class="faq-list">

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>How often is RowHome Magazine published?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>Philadelphia RowHome Magazine publishes six print issues per year — roughly every two months. Our website at rowhomemagazine.com is updated daily with new articles, photo galleries, and neighborhood features.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>Where can I pick up a print copy?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>Print copies are available at select newsstands, coffee shops, bookstores, and community centers throughout Philadelphia and the surrounding suburbs. Subscribers receive issues delivered directly to their homes. <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact us</a> for the full list of distribution locations.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>How do I subscribe or gift a subscription?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>Visit our <a href="<?php echo esc_url(home_url('/subscribe')); ?>">Subscribe page</a> to see all plans including Digital, Print, and Bundle options. Gift subscriptions are also available — we'll send a personalized card to your recipient. Email <a href="mailto:subscribe@rowhomemagazine.com">subscribe@rowhomemagazine.com</a> with any questions.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>How do I submit a story idea or pitch an article?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>We welcome pitches from Philadelphia-based writers and photographers. Please send a brief (3–5 sentence) pitch describing your story idea, its relevance to Philadelphia readers, and links to two or three previous clips to <a href="mailto:editorial@rowhomemagazine.com">editorial@rowhomemagazine.com</a>. We read every pitch and respond within 2–3 weeks.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>How do I advertise in RowHome Magazine?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>We offer print, digital, and integrated advertising packages. Visit our <a href="<?php echo esc_url(home_url('/subscribe')); ?>#advertise">Advertise page</a> to see package details, or email <a href="mailto:advertising@rowhomemagazine.com">advertising@rowhomemagazine.com</a> to request a media kit and current rate card.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>Is RowHome Magazine editorially independent?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>Absolutely. RowHome Magazine is independently owned and operated by RowHome Magazine LLC. Advertising does not influence editorial decisions. Our editorial team operates under a strict separation of church and state — the newsroom sets its own agenda based on what's important to Philadelphia readers.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>How do I report an error in a published article?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>We take accuracy seriously. If you spot an error in any of our content, please email <a href="mailto:editorial@rowhomemagazine.com">editorial@rowhomemagazine.com</a> with the article title, the error, and the correct information. We investigate all correction requests and issue corrections promptly when warranted.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false">
                            <span>Can I use RowHome Magazine content on my website or social media?</span>
                            <span class="faq-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-answer" hidden>
                            <p>All content published by RowHome Magazine is protected by copyright. Brief excerpts with clear attribution and a link back to the original article are generally acceptable. Republishing full articles, photos, or graphics requires written permission. Please contact <a href="mailto:editorial@rowhomemagazine.com">editorial@rowhomemagazine.com</a> for licensing inquiries.</p>
                        </div>
                    </div>

                </div><!-- .faq-list -->
            </section>

        </div><!-- .container -->

    </main><!-- #main -->
</div><!-- #primary -->

<script>
// FAQ Accordion — matches theme's progressive enhancement pattern
(function() {
    var questions = document.querySelectorAll('.faq-question');
    questions.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var expanded = this.getAttribute('aria-expanded') === 'true';
            var answer = this.nextElementSibling;
            var icon = this.querySelector('.faq-icon');

            // Close all others
            questions.forEach(function(other) {
                if (other !== btn) {
                    other.setAttribute('aria-expanded', 'false');
                    other.nextElementSibling.hidden = true;
                    other.querySelector('.faq-icon').textContent = '+';
                    other.closest('.faq-item').classList.remove('faq-item--open');
                }
            });

            // Toggle this one
            this.setAttribute('aria-expanded', String(!expanded));
            answer.hidden = expanded;
            icon.textContent = expanded ? '+' : '−';
            this.closest('.faq-item').classList.toggle('faq-item--open', !expanded);
        });
    });
}());
</script>

<?php get_footer(); ?>
