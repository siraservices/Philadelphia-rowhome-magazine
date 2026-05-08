<?php
/**
 * Direction B — Single Pictorial: Magazine Photo Essay Layout
 *
 * Layout sequence (9-frame model):
 *   1. Title slate — eyebrow + 120px italic headline + 22px dek
 *   2. FullbleedFrame ×3 — alternating caption left / right / left
 *   3. Two-up tile spread — 2×2 grid, black bg, 1:1 crops
 *   4. Pull quote — centered 60px italic Antic Didone
 *   5. FullbleedFrame ×2 — right / left captions
 *   6. End slate — eyebrow, heading, outline CTA
 *
 * Frame data comes from WP attachment fields:
 *   post_title   → frame title
 *   post_excerpt → place (Caption field in Media Library)
 *   post_content → time/year (Description field in Media Library)
 *
 * @package RowHome_Magazine
 * @since 2.0.0
 * @see SIR-778, SIR-775
 */

get_header('pictorial');

while (have_posts()) : the_post();

/* ── Post-level data ────────────────────────────────────────────── */

$post_id      = get_the_ID();
$photographer = get_post_meta($post_id, '_pictorial_photographer', true);
$pullquote    = get_post_meta($post_id, '_pictorial_pullquote', true);
$dek          = get_the_excerpt();

// Eyebrow: gallery category name or "Pictorial" fallback
$eyebrow_cats = get_the_terms($post_id, 'gallery_category');
if (!$eyebrow_cats || is_wp_error($eyebrow_cats)) {
    $eyebrow_cats = get_the_terms($post_id, 'category');
}
$eyebrow = ($eyebrow_cats && !is_wp_error($eyebrow_cats)) ? $eyebrow_cats[0]->name : __('Pictorial', 'rowhome-magazine');

/* ── Gallery frames ─────────────────────────────────────────────── */

// Get attached images in menu_order (drag-and-drop order in media modal)
$raw_images = get_children(array(
    'post_parent'    => $post_id,
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
    'posts_per_page' => -1,
));
$images = array_values($raw_images);
$total  = count($images);

/**
 * Return a normalised frame array from a WP attachment object.
 *
 * @param WP_Post|null $img  Attachment post or null.
 * @param string       $size Image size slug for src.
 * @param int          $idx  1-based seed for picsum placeholder.
 * @return array
 */
function rh_pictorial_frame($img, $size, $idx) {
    if ($img) {
        $url   = wp_get_attachment_image_url($img->ID, $size);
        $alt   = get_post_meta($img->ID, '_wp_attachment_image_alt', true);
        if (!$alt) $alt = $img->post_title ?: __('Gallery photo', 'rowhome-magazine');
        return array(
            'url'   => $url ?: '',
            'alt'   => $alt,
            'title' => $img->post_title ?: '',
            'place' => $img->post_excerpt ?: '',   // Caption field
            'time'  => trim(wp_strip_all_tags($img->post_content ?: '')), // Description field
        );
    }
    // Placeholder for empty slots
    return array(
        'url'   => 'https://picsum.photos/seed/rhframe' . $idx . '/1600/900',
        'alt'   => 'Philadelphia scene',
        'title' => 'Philadelphia',
        'place' => 'Philadelphia, PA',
        'time'  => '',
    );
}

// Slice groups (0-based)
$g_full1  = array($images[0] ?? null, $images[1] ?? null, $images[2] ?? null);
$g_tiles  = array($images[3] ?? null, $images[4] ?? null, $images[5] ?? null, $images[6] ?? null);
$g_full2  = array($images[7] ?? null, $images[8] ?? null);

// Caption sides for the five FullbleedFrames (left/right pattern)
// Group 1: left, right, left — Group 2: right, left
$caption_sides = array('left', 'right', 'left', 'right', 'left');
?>

<!-- ======================================================
     1. Title Slate
     ====================================================== -->
<section class="rh-pictorial-title-slate">
    <p class="rh-eyebrow rh-pictorial-title-slate__eyebrow"><?php echo esc_html($eyebrow); ?></p>
    <h1 class="rh-pictorial-title-slate__headline"><?php the_title(); ?></h1>
    <?php if ($dek) : ?>
        <p class="rh-pictorial-title-slate__dek"><?php echo esc_html($dek); ?></p>
    <?php endif; ?>
</section>

<?php if ($photographer) : ?>
<!-- Photographer credit strip -->
<div class="rh-pictorial-credit">
    <?php printf(esc_html__('Photography by %s', 'rowhome-magazine'), '<strong>' . esc_html($photographer) . '</strong>'); ?>
</div>
<?php endif; ?>

<!-- ======================================================
     2. FullbleedFrame ×3 — left / right / left
     ====================================================== -->
<?php foreach ($g_full1 as $i => $img) :
    $f    = rh_pictorial_frame($img, 'full', $i + 1);
    $side = $caption_sides[$i];
?>
<div class="rh-fullbleed-frame rh-fullbleed-frame--<?php echo esc_attr($side); ?>">
    <?php if ($f['url']) : ?>
        <img
            src="<?php echo esc_url($f['url']); ?>"
            alt="<?php echo esc_attr($f['alt']); ?>"
            class="rh-fullbleed-frame__image rh-photo"
            loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
            decoding="async"
        >
    <?php endif; ?>
    <div class="rh-fullbleed-frame__caption">
        <?php if ($f['title']) : ?>
            <p class="rh-fullbleed-frame__title"><?php echo esc_html($f['title']); ?></p>
        <?php endif; ?>
        <?php
        $meta_parts = array_filter(array($f['place'], $f['time']));
        if ($meta_parts) :
        ?>
            <p class="rh-fullbleed-frame__meta"><?php echo esc_html(implode(' · ', $meta_parts)); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>

<!-- ======================================================
     3. Two-up tile spread — 2×2 grid, black bg, 1:1 crops
     ====================================================== -->
<section class="rh-pictorial-tile-spread">
    <div class="rh-pictorial-tile-spread__grid">
        <?php foreach ($g_tiles as $j => $img) :
            $f = rh_pictorial_frame($img, 'rowhome-gallery', $j + 4);
        ?>
        <div class="rh-pictorial-tile-spread__item">
            <?php if ($f['url']) : ?>
                <img
                    src="<?php echo esc_url($f['url']); ?>"
                    alt="<?php echo esc_attr($f['alt']); ?>"
                    class="rh-pictorial-tile-spread__img"
                    loading="lazy"
                    decoding="async"
                >
            <?php endif; ?>
            <div class="rh-pictorial-tile-spread__caption">
                <?php if ($f['title']) : ?>
                    <p class="rh-pictorial-tile-spread__title"><?php echo esc_html($f['title']); ?></p>
                <?php endif; ?>
                <?php
                $tile_meta = array_filter(array($f['place'], $f['time']));
                if ($tile_meta) :
                ?>
                    <p class="rh-pictorial-tile-spread__meta"><?php echo esc_html(implode(' · ', $tile_meta)); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ======================================================
     4. Pull quote — centered, 60px italic Antic Didone
     ====================================================== -->
<?php if ($pullquote) : ?>
<div class="rh-pictorial-pullquote">
    <p class="rh-pictorial-pullquote__text"><?php echo esc_html($pullquote); ?></p>
</div>
<?php endif; ?>

<!-- ======================================================
     5. FullbleedFrame ×2 — right / left
     ====================================================== -->
<?php foreach ($g_full2 as $k => $img) :
    $frame_idx = 3 + $k; // continues at index 3 in caption_sides array
    $f    = rh_pictorial_frame($img, 'full', $k + 8);
    $side = $caption_sides[$frame_idx];
?>
<div class="rh-fullbleed-frame rh-fullbleed-frame--<?php echo esc_attr($side); ?>">
    <?php if ($f['url']) : ?>
        <img
            src="<?php echo esc_url($f['url']); ?>"
            alt="<?php echo esc_attr($f['alt']); ?>"
            class="rh-fullbleed-frame__image rh-photo"
            loading="lazy"
            decoding="async"
        >
    <?php endif; ?>
    <div class="rh-fullbleed-frame__caption">
        <?php if ($f['title']) : ?>
            <p class="rh-fullbleed-frame__title"><?php echo esc_html($f['title']); ?></p>
        <?php endif; ?>
        <?php
        $meta_parts = array_filter(array($f['place'], $f['time']));
        if ($meta_parts) :
        ?>
            <p class="rh-fullbleed-frame__meta"><?php echo esc_html(implode(' · ', $meta_parts)); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>

<!-- ======================================================
     6. End slate — '— End —' eyebrow, heading, outline CTA
     ====================================================== -->
<section class="rh-pictorial-end-slate">
    <p class="rh-eyebrow rh-pictorial-end-slate__eyebrow">&mdash; <?php esc_html_e('End', 'rowhome-magazine'); ?> &mdash;</p>
    <h2 class="rh-pictorial-end-slate__heading"><?php esc_html_e('Buy a print of any frame.', 'rowhome-magazine'); ?></h2>
    <a href="<?php echo esc_url(home_url('/contact/?subject=' . rawurlencode('Print inquiry: ' . get_the_title()))); ?>" class="rh-btn--outline">
        <?php esc_html_e('Inquire About Prints', 'rowhome-magazine'); ?>
    </a>
</section>

<?php endwhile; ?>

<?php get_footer('pictorial'); ?>
