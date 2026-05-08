<?php
/**
 * Template part for displaying hero sections
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

$hero_style = isset($args['style']) ? $args['style'] : 'full'; // 'full' or 'standard'
$show_meta = isset($args['show_meta']) ? $args['show_meta'] : true;
$show_category = isset($args['show_category']) ? $args['show_category'] : true;

$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$featured_image) {
    $philly_imgs = array('/assets/images/hero-1.jpg','/assets/images/hero-2.jpg','/assets/images/hero-3.jpg','/assets/images/about-hero.jpg','/assets/images/subscribe-hero.jpg');
    $featured_image = get_template_directory_uri() . $philly_imgs[get_the_ID() % count($philly_imgs)];
}
?>

<?php if ($hero_style === 'full') : ?>
    <div class="hero-full" style="background-image: url('<?php echo esc_url($featured_image); ?>');">
        <div class="hero-full__overlay">
            <div class="hero-full__content">
                <?php if ($show_category) :
                    $departments = get_the_terms(get_the_ID(), 'department_category');
                    if ($departments && !is_wp_error($departments)) :
                        $dept = array_shift($departments);
                ?>
                    <a href="<?php echo esc_url(get_term_link($dept)); ?>" class="hero-full__category"><?php echo esc_html($dept->name); ?></a>
                <?php
                    endif;
                endif;
                ?>

                <h1 class="hero-full__title"><?php the_title(); ?></h1>

                <?php if (has_excerpt()) : ?>
                    <p class="hero-full__subtitle"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>

                <?php if ($show_meta) : ?>
                    <div class="hero-full__meta">
                        <span class="hero-full__author">By <?php echo esc_html(get_the_author() ?: 'RowHome Staff'); ?></span>
                        <span class="hero-full__separator">&middot;</span>
                        <time class="hero-full__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('F j, Y')); ?></time>
                        <span class="hero-full__separator">&middot;</span>
                        <?php rowhome_magazine_reading_time(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php else : ?>
    <div class="hero-standard">
        <?php if ($show_category) :
            $departments = get_the_terms(get_the_ID(), 'department_category');
            if ($departments && !is_wp_error($departments)) :
                $dept = array_shift($departments);
        ?>
            <a href="<?php echo esc_url(get_term_link($dept)); ?>" class="hero-standard__category"><?php echo esc_html($dept->name); ?></a>
        <?php
            endif;
        endif;
        ?>

        <h1 class="hero-standard__title"><?php the_title(); ?></h1>

        <?php if ($show_meta) : ?>
            <div class="hero-standard__meta">
                <span class="hero-standard__author">By <?php echo esc_html(get_the_author() ?: 'RowHome Staff'); ?></span>
                <span class="hero-standard__separator">&middot;</span>
                <time class="hero-standard__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('F j, Y')); ?></time>
                <span class="hero-standard__separator">&middot;</span>
                <?php rowhome_magazine_reading_time(); ?>
            </div>
        <?php endif; ?>

        <?php if (has_post_thumbnail()) : ?>
            <div class="hero-standard__image">
                <?php the_post_thumbnail('rowhome-hero', array('loading' => 'eager')); ?>
                <?php
                $caption = get_the_post_thumbnail_caption();
                if ($caption) :
                ?>
                    <figcaption class="hero-standard__caption"><?php echo esc_html($caption); ?></figcaption>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
