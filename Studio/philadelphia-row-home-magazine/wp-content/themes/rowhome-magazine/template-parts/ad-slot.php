<?php
/**
 * Template part for displaying ad placement slots
 *
 * Usage: get_template_part('template-parts/ad-slot');
 * Set $args['position'] for data attribute (e.g., 'sidebar', 'inline', 'between-content')
 * Set $args['label'] for custom label text (defaults to 'Advertisement')
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

$position = isset($args['position']) ? $args['position'] : 'inline';
$label = isset($args['label']) ? $args['label'] : 'Advertisement';
$class = isset($args['class']) ? ' ' . $args['class'] : '';
?>

<div class="ad-slot<?php echo esc_attr($class); ?>" data-ad-position="<?php echo esc_attr($position); ?>" role="complementary" aria-label="<?php echo esc_attr($label); ?>">
    <span class="ad-slot__label"><?php echo esc_html($label); ?></span>
</div>
