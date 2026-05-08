<?php
/**
 * Article header — Direction B
 * Loaded by single.php via get_header('article').
 * Outputs the full HTML preamble + RHHeader (3-row light variant).
 *
 * @package RowHome_Magazine
 * @since 2.0.0
 * @see SIR-776
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antic+Didone&family=Crimson+Pro:ital,wght@0,300..800;1,300..800&family=Archivo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class('rh-direction-b rh-article-page'); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e('Skip to content', 'rowhome-magazine'); ?></a>

<?php get_template_part('template-parts/header-direction-b'); ?>

<main id="main" class="rh-article-main">
