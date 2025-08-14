<?php
/**
 * Plugin removal file
 *
 * @since Halva Additional Features 1.0
 */

// if uninstall not called from WordPress, then exit
if ( ! defined( 'ABSPATH' ) && ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// if not allowed deleting plugins go to plugins page
if ( ! current_user_can( 'delete_plugins' ) ) {
	wp_die( esc_html__( 'Sorry, you are not allowed to delete plugins for this site.', 'halva-additional-features' ) );
}


/**
 * Delete additional metadata for all posts
 *
 * @since Halva Additional Features 1.0
 */

// get all posts
$all_posts = get_posts( 'numberposts=-1&post_type=post&post_status=any' );

// remove additional metadata from each post
foreach ( $all_posts as $post_info ) {
	// views counter
	delete_post_meta( $post_info->ID, '_halva_post_views_count' );
}

// reset postdata
wp_reset_postdata();


/**
 * Delete additional metadata for all pages
 *
 * @since Halva Additional Features 1.0
 */

// get all pages
$all_pages = get_posts( 'numberposts=-1&post_type=page&post_status=any' );

// remove additional metadata from each page
foreach( $all_pages as $page_info ) {
	// views counter
	delete_post_meta( $page_info->ID, '_halva_post_views_count' );
}

// reset postdata
wp_reset_postdata();
