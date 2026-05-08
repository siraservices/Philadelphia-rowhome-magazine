<?php
/**
 * Custom Post Types and Taxonomies
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Post Type - Pictorial/Gallery
 */
function rowhome_magazine_register_pictorial_cpt() {
    $labels = array(
        'name'                  => _x('Pictorials', 'Post Type General Name', 'rowhome-magazine'),
        'singular_name'         => _x('Pictorial', 'Post Type Singular Name', 'rowhome-magazine'),
        'menu_name'             => __('Pictorials', 'rowhome-magazine'),
        'name_admin_bar'        => __('Pictorial', 'rowhome-magazine'),
        'archives'              => __('Pictorial Archives', 'rowhome-magazine'),
        'attributes'            => __('Pictorial Attributes', 'rowhome-magazine'),
        'all_items'             => __('All Pictorials', 'rowhome-magazine'),
        'add_new_item'          => __('Add New Pictorial', 'rowhome-magazine'),
        'add_new'               => __('Add New', 'rowhome-magazine'),
        'new_item'              => __('New Pictorial', 'rowhome-magazine'),
        'edit_item'             => __('Edit Pictorial', 'rowhome-magazine'),
        'update_item'           => __('Update Pictorial', 'rowhome-magazine'),
        'view_item'             => __('View Pictorial', 'rowhome-magazine'),
        'view_items'            => __('View Pictorials', 'rowhome-magazine'),
        'search_items'          => __('Search Pictorial', 'rowhome-magazine'),
        'not_found'             => __('Not found', 'rowhome-magazine'),
        'not_found_in_trash'    => __('Not found in Trash', 'rowhome-magazine'),
        'featured_image'        => __('Cover Image', 'rowhome-magazine'),
        'set_featured_image'    => __('Set cover image', 'rowhome-magazine'),
        'remove_featured_image' => __('Remove cover image', 'rowhome-magazine'),
        'use_featured_image'    => __('Use as cover image', 'rowhome-magazine'),
    );

    $args = array(
        'label'                 => __('Pictorial', 'rowhome-magazine'),
        'description'           => __('Photo galleries and pictorial essays', 'rowhome-magazine'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'custom-fields'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-format-gallery',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'pictorial'),
    );

    register_post_type('pictorial', $args);
}
add_action('init', 'rowhome_magazine_register_pictorial_cpt', 0);

/**
 * Register Custom Taxonomy - Gallery Categories
 */
function rowhome_magazine_register_gallery_taxonomy() {
    $labels = array(
        'name'                       => _x('Gallery Categories', 'Taxonomy General Name', 'rowhome-magazine'),
        'singular_name'              => _x('Gallery Category', 'Taxonomy Singular Name', 'rowhome-magazine'),
        'menu_name'                  => __('Gallery Categories', 'rowhome-magazine'),
        'all_items'                  => __('All Gallery Categories', 'rowhome-magazine'),
        'parent_item'                => __('Parent Category', 'rowhome-magazine'),
        'parent_item_colon'          => __('Parent Category:', 'rowhome-magazine'),
        'new_item_name'              => __('New Gallery Category', 'rowhome-magazine'),
        'add_new_item'               => __('Add New Gallery Category', 'rowhome-magazine'),
        'edit_item'                  => __('Edit Gallery Category', 'rowhome-magazine'),
        'update_item'                => __('Update Gallery Category', 'rowhome-magazine'),
        'view_item'                  => __('View Gallery Category', 'rowhome-magazine'),
        'search_items'               => __('Search Gallery Categories', 'rowhome-magazine'),
        'not_found'                  => __('Not Found', 'rowhome-magazine'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'gallery-category'),
    );

    register_taxonomy('gallery_category', array('pictorial'), $args);
}
add_action('init', 'rowhome_magazine_register_gallery_taxonomy', 0);

/**
 * Add meta boxes for Pictorial custom fields
 */
function rowhome_magazine_pictorial_meta_boxes() {
    add_meta_box(
        'pictorial_details',
        __('Pictorial Details', 'rowhome-magazine'),
        'rowhome_magazine_pictorial_details_callback',
        'pictorial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rowhome_magazine_pictorial_meta_boxes');

/**
 * Pictorial details meta box callback
 */
function rowhome_magazine_pictorial_details_callback($post) {
    wp_nonce_field('rowhome_pictorial_details', 'rowhome_pictorial_nonce');

    $photographer = get_post_meta($post->ID, '_pictorial_photographer', true);
    $location = get_post_meta($post->ID, '_pictorial_location', true);
    $pullquote = get_post_meta($post->ID, '_pictorial_pullquote', true);
    ?>
    <p>
        <label for="pictorial_photographer"><strong><?php _e('Photographer:', 'rowhome-magazine'); ?></strong></label><br>
        <input type="text" id="pictorial_photographer" name="pictorial_photographer" value="<?php echo esc_attr($photographer); ?>" class="widefat" placeholder="Photographer name">
    </p>
    <p>
        <label for="pictorial_location"><strong><?php _e('Location:', 'rowhome-magazine'); ?></strong></label><br>
        <input type="text" id="pictorial_location" name="pictorial_location" value="<?php echo esc_attr($location); ?>" class="widefat" placeholder="Photo location">
    </p>
    <p>
        <label for="pictorial_pullquote"><strong><?php _e('Pull Quote:', 'rowhome-magazine'); ?></strong></label><br>
        <textarea id="pictorial_pullquote" name="pictorial_pullquote" class="widefat" rows="3" placeholder="A memorable line displayed between the frames…"><?php echo esc_textarea($pullquote); ?></textarea>
        <em style="font-size:12px;color:#666;"><?php _e('Displayed as a centered pull quote between the first and second set of full-bleed frames.', 'rowhome-magazine'); ?></em>
    </p>
    <p>
        <strong><?php _e('Frame Images (Direction B layout):', 'rowhome-magazine'); ?></strong><br>
        <em><?php _e('Attach images via the Media Library. Frames 1–3 → full-bleed alternating L/R/L. Frames 4–7 → 2×2 tile spread. Frames 8–9 → full-bleed R/L. For each image, set: Title (frame title), Caption (place), Description (time/year).', 'rowhome-magazine'); ?></em>
    </p>
    <?php
}

/**
 * Save pictorial meta box data
 */
function rowhome_magazine_save_pictorial_meta($post_id) {
    if (!isset($_POST['rowhome_pictorial_nonce']) || !wp_verify_nonce($_POST['rowhome_pictorial_nonce'], 'rowhome_pictorial_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['pictorial_photographer'])) {
        update_post_meta($post_id, '_pictorial_photographer', sanitize_text_field($_POST['pictorial_photographer']));
    }

    if (isset($_POST['pictorial_location'])) {
        update_post_meta($post_id, '_pictorial_location', sanitize_text_field($_POST['pictorial_location']));
    }

    if (isset($_POST['pictorial_pullquote'])) {
        update_post_meta($post_id, '_pictorial_pullquote', sanitize_textarea_field($_POST['pictorial_pullquote']));
    }
}
add_action('save_post_pictorial', 'rowhome_magazine_save_pictorial_meta');
