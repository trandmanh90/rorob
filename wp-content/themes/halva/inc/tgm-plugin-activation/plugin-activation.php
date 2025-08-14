<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Halva
 * @version    2.6.1 for parent theme Halva for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

add_action( 'tgmpa_register', 'halva_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function halva_register_required_plugins() {

	/*
	 * Array of plugin arrays.
	 */
	$plugins = array(

		// Meta box (required plugin)
		array(
			'name'					=> 'Meta Box', // The plugin name.
			'slug'					=> 'meta-box', // The plugin slug (typically the folder name).
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		// Halva additional features (recommended plugin)
		array(
			'name'               => 'Halva Additional Features', // The plugin name.
			'slug'               => 'halva-additional-features', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/assets/plugins/halva-additional-features.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be checked for availability to determine if a plugin is active.
		),

	);

	/*
	 * Array of configuration settings.
	 */
	$config = array(
		'id'			=> 'halva',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	=> '',                      // Default absolute path to bundled plugins.
		'menu'			=> 'tgmpa-install-plugins', // Menu slug.
		'has_notices'	=> true,                    // Show admin notices or not.
		'dismissable'	=> true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	=> '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	=> true,                    // Automatically activate plugins after installation or not.
		'message'		=> '',                      // Message to output right before the plugins table.

		'strings'		=> array(
			'page_title'						=> __( 'Install Required Plugins', 'halva' ),
			'menu_title'						=> __( 'Install Plugins', 'halva' ),
			/* translators: %s: plugin name. */
			'installing'						=> __( 'Installing Plugin: %s', 'halva' ),
			/* translators: %s: plugin name. */
			'updating'							=> __( 'Updating Plugin: %s', 'halva' ),
			'oops'								=> __( 'Something went wrong with the plugin API.', 'halva' ),
			'notice_can_install_required'		=> _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'halva'
			),
			'notice_can_install_recommended'	=> _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'halva'
			),
			'notice_ask_to_update'				=> _n_noop(
				/* translators: 1: plugin name(s). */
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'halva'
			),
			'notice_ask_to_update_maybe'		=> _n_noop(
				/* translators: 1: plugin name(s). */
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'halva'
			),
			'notice_can_activate_required'		=> _n_noop(
				/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'halva'
			),
			'notice_can_activate_recommended'	=> _n_noop(
				/* translators: 1: plugin name(s). */
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'halva'
			),
			'install_link'						=> _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'halva'
			),
			'update_link'						=> _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'halva'
			),
			'activate_link'						=> _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'halva'
			),
			'return'							=> __( 'Return to Required Plugins Installer', 'halva' ),
			'plugin_activated'					=> __( 'Plugin activated successfully.', 'halva' ),
			'activated_successfully'			=> __( 'The following plugin was activated successfully:', 'halva' ),
			/* translators: 1: plugin name. */
			'plugin_already_active'				=> __( 'No action taken. Plugin %1$s was already active.', 'halva' ),
			/* translators: 1: plugin name. */
			'plugin_needs_higher_version'		=> __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'halva' ),
			/* translators: 1: dashboard link. */
			'complete'							=> __( 'All plugins installed and activated successfully. %1$s', 'halva' ),
			'dismiss'							=> __( 'Dismiss this notice', 'halva' ),
			'notice_cannot_install_activate'	=> __( 'There are one or more required or recommended plugins to install, update or activate.', 'halva' ),
			'contact_admin'						=> __( 'Please contact the administrator of this site for help.', 'halva' ),

			'nag_type'							=> '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa( $plugins, $config );

}
