<?php
/**
 * Article header — delegates to the shared site header, then opens the
 * Direction B article <main>. Loaded by single.php via get_header('article').
 *
 * @package RowHome_Magazine
 * @since 2.1.0
 */
get_header();

// Preload hero image for performance (LCP optimization)
?>
<main id="main" class="rh-article-main">
