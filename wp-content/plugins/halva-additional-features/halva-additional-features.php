<?php
/*
Plugin Name: Halva Additional Features
Plugin URI: http://birdwp.com/wp-halva/
Description: This plugin provides a set of additional features for the Halva theme. This set includes the following features: 5 additional widgets, views counter, and a notification with information about cookies on the site.
Version: 1.1
Requires at least: 6.0
Requires PHP: 7.0
Author: Alexey Trofimov
Author URI: https://themeforest.net/user/birdwpthemes
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: halva-additional-features
Domain Path: /languages

Copyright (C) 2024 Alexey Trofimov
Halva Additional Features is distributed under the terms of the GNU GPL
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Define some constants
 *
 * @since Halva Additional Features 1.0
 */
define( 'HALVA_ADDITIONAL_FEATURES_DIR', plugin_dir_path( __FILE__ ) );
define( 'HALVA_ADDITIONAL_FEATURES_URL', plugin_dir_url( __FILE__ ) );


/**
 * Make plugin available for translation
 *
 * @since Halva Additional Features 1.0
 */
function halva_additional_features_load_language_file() {

	// load language file; text domain = "halva-additional-features"
	load_plugin_textdomain( 'halva-additional-features', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}
add_action( 'plugins_loaded', 'halva_additional_features_load_language_file' );


/**
 * Enqueue scripts
 *
 * @since Halva Additional Features 1.0
 */
function halva_additional_features_scripts() {

	// main script file
	wp_enqueue_script( 'halva-additional-features-plugin', HALVA_ADDITIONAL_FEATURES_URL . 'js/halva-additional-features-plugin.js', array( 'jquery' ), '1.0.0', true );

	/**
	 * Data for the main script file:
	 */

	// cookies notice: show or hide
	$show_cookies_notice = get_theme_mod( 'halva_show_cookies_notice', 0 ); // 1 or 0
	$cookies_notice_data = ( $show_cookies_notice ) ? 'show' : 'hide';

	// cookies notice: type of notification on mobile devices
	$cookies_notice_on_mobile_data = get_theme_mod( 'halva_cookies_notice_on_mobile', 'hidden' ); // 'hidden' or 'visible'

	// array with data
	$halva_additional_features_data_array = array(
		'cookiesNotice'			=> $cookies_notice_data,
		'cookiesNoticeOnMobile'	=> $cookies_notice_on_mobile_data,
	);

	// add data
	wp_localize_script( 'halva-additional-features-plugin', 'halvaAdditionalFeatures', $halva_additional_features_data_array );

}
add_action( 'wp_enqueue_scripts', 'halva_additional_features_scripts' );


/**
 * Views counter
 *
 * @since Halva Additional Features 1.0
 */
require_once HALVA_ADDITIONAL_FEATURES_DIR . 'counters/views-counter.php';


/**
 * Add new widgets
 *
 * @since Halva Additional Features 1.0
 */
require_once HALVA_ADDITIONAL_FEATURES_DIR . 'widgets/widget-list-of-posts.php';
require_once HALVA_ADDITIONAL_FEATURES_DIR . 'widgets/widget-popular-posts.php';
require_once HALVA_ADDITIONAL_FEATURES_DIR . 'widgets/widget-random-posts.php';
require_once HALVA_ADDITIONAL_FEATURES_DIR . 'widgets/widget-recent-posts.php';
require_once HALVA_ADDITIONAL_FEATURES_DIR . 'widgets/widget-social-links.php';


/**
 * Cookies notice
 *
 * @since Halva Additional Features 1.0
 */
require_once HALVA_ADDITIONAL_FEATURES_DIR . 'cookies-notice/cookies-notice.php';
