<?php
/**
 * Theme options (Appearance > Customize)
 *
 * Additional sanitize functions are located in the "sanitize-functions.php" file (/halva/inc/customizer/sanitize-functions.php)
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

function halva_customize_register( $wp_customize ) {

	/**
	 * Customize control: Heading (title and subtitle)
	 * ----------------------------------------------
	 */
	class halva_customize_control_heading extends WP_Customize_Control {
		public $type = 'halva_heading';
		public function render_content() {
			?>

			<div class="bwp-customize-control-heading">
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<?php if ( $this->value() ) { ?>
					<span class="bwp-customize-control-subtitle">
						<?php echo esc_html( $this->value() ); ?>
					</span>
				<?php } ?>
			</div>

			<?php
		}
	}


	/**
	 * Customize control: Number field (input type = number; min=1, max=10000)
	 * ----------------------------------------------
	 */
	class halva_customize_control_number extends WP_Customize_Control {
		public $type = 'halva_number_field';
		public function render_content() {
			?>

			<label>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<input type="number" min="1" max="10000" value="<?php echo (int) $this->value(); ?>" <?php $this->link(); ?>>
			</label>

			<?php
		}
	}


	/**
	 * Customize control: Short description
	 * ----------------------------------------------
	 */
	class halva_customize_control_description extends WP_Customize_Control {
		public $type = 'halva_description';
		public function render_content() {
			?>

			<div class="bwp-customize-control-description">
				<?php
				echo esc_html( $this->value() );
				?>
			</div>

			<?php
		}
	}


	/**
	 * Array with categories
	 * ----------------------------------------------
	 */
	$categories = array();
	$categories_obj = get_categories( 'hide_empty=0&depth=1&type=post' );
	foreach ( $categories_obj as $category ) {
		$category_id = $category->term_id;
		$category_name = $category->cat_name;
		$categories[ intval( $category_id ) ] = esc_html( $category_name );
	}
	$categories = array( 0 => esc_html__( 'All categories', 'halva' ) ) + $categories;


	/**
	 * Theme options
	 * ----------------------------------------------
	 *
	 * 1.0 - Site identity
	 * ----------------------------------------------
	 */

	// Dark mode: Main logo (image)
	$wp_customize->add_setting(
		'halva_dark_mode_logo_image',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'halva_dark_mode_logo_image',
			array(
				'label'		=> __( 'Dark Mode: Logo (optional)', 'halva' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'halva_dark_mode_logo_image',
			)
		)
	);


	// Setting description (setting id: halva_dark_mode_logo_image)
	$wp_customize->add_setting(
		'halva_dark_mode_logo_image_desc',
		array(
			'default'			=> __( 'Recommendation: This logo should be the same size as the light mode logo (Site Identity > Logo).', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_dark_mode_logo_image_desc',
			array(
				'label'		=> __( 'Dark Mode: Logo (setting description)', 'halva' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'halva_dark_mode_logo_image_desc',
			)
		)
	);


	// Logo width (number)
	$wp_customize->add_setting(
		'halva_main_logo_width',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'halva_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_number(
			$wp_customize,
			'halva_main_logo_width',
			array(
				'label'		=> __( 'Logo Width, px', 'halva' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'halva_main_logo_width',
			)
		)
	);


	// Hidden navigation: Logo (image)
	$wp_customize->add_setting(
		'halva_hidden_nav_logo_image',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'halva_hidden_nav_logo_image',
			array(
				'label'		=> __( 'Hidden Navigation: Logo', 'halva' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'halva_hidden_nav_logo_image',
			)
		)
	);


	// Hidden navigation: Dark mode logo (image)
	$wp_customize->add_setting(
		'halva_hidden_nav_dark_mode_logo_image',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'halva_hidden_nav_dark_mode_logo_image',
			array(
				'label'		=> __( 'Hidden Navigation: Dark Mode Logo (optional)', 'halva' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'halva_hidden_nav_dark_mode_logo_image',
			)
		)
	);


	// Setting description (setting id: halva_hidden_nav_dark_mode_logo_image)
	$wp_customize->add_setting(
		'halva_hidden_nav_dark_mode_logo_image_desc',
		array(
			'default'			=> __( 'Recommendation: This logo should be the same size as the light mode logo (Site Identity > Hidden Navigation: Logo).', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_hidden_nav_dark_mode_logo_image_desc',
			array(
				'label'		=> __( 'Hidden Navigation: Dark Mode Logo (setting description)', 'halva' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'halva_hidden_nav_dark_mode_logo_image_desc',
			)
		)
	);


	// Hidden navigation: Logo width (number)
	$wp_customize->add_setting(
		'halva_hidden_nav_logo_width',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'halva_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_number(
			$wp_customize,
			'halva_hidden_nav_logo_width',
			array(
				'label'		=> __( 'Hidden Navigation: Logo Width, px', 'halva' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'halva_hidden_nav_logo_width',
			)
		)
	);


	/**
	 * 2.0 - Logo settings
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_logo_settings_section',
		array(
			'title'		=> __( 'Logo Settings', 'halva' ),
			'priority'	=> 21,
		)
	);


	// Description of settings for this section (halva_logo_settings_section)
	$wp_customize->add_setting(
		'halva_logo_settings_section_desc',
		array(
			'default'			=> __( 'The Halva theme displays text logos by default. Here you can write your text for logos and also change the type of logos from text to image.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_logo_settings_section_desc',
			array(
				'label'		=> __( 'Logo Settings: Description of the Settings Section', 'halva' ),
				'section'	=> 'halva_logo_settings_section',
				'settings'	=> 'halva_logo_settings_section_desc',
			)
		)
	);


	/**
	 * 2.1 - Logo settings > Main logo
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_main_logo',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_main_logo',
			array(
				'label'		=> __( 'Main Logo', 'halva' ),
				'section'	=> 'halva_logo_settings_section',
				'settings'	=> 'halva_heading_main_logo',
			)
		)
	);


	// Logo type (select)
	$wp_customize->add_setting(
		'halva_logo_type',
		array(
			'default'			=> 'text',
			'sanitize_callback'	=> 'halva_sanitize_logo_type',
		)
	);

	$wp_customize->add_control(
		'halva_logo_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Logo Type', 'halva' ),
			'section'	=> 'halva_logo_settings_section',
			'choices'	=> array(
				'text'		=> esc_html__( 'Text', 'halva' ),
				'image'		=> esc_html__( 'Image', 'halva' ),
			),
		)
	);


	// Setting description (setting id: halva_logo_type)
	$wp_customize->add_setting(
		'halva_logo_type_desc',
		array(
			'default'			=> __( 'You can add an image for your main logo in the "Site Identity" section: "Site Identity > Logo".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_logo_type_desc',
			array(
				'label'		=> __( 'Logo Type (setting description)', 'halva' ),
				'section'	=> 'halva_logo_settings_section',
				'settings'	=> 'halva_logo_type_desc',
			)
		)
	);


	// Logo text (text field)
	$wp_customize->add_setting(
		'halva_logo_text',
		array(
			'default'			=> 'Halva',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'halva_logo_text',
		array(
			'label'		=> __( 'Logo Text (Logo Type: Text)', 'halva' ),
			'section'	=> 'halva_logo_settings_section',
			'type'		=> 'text',
		)
	);


	/**
	 * 2.2 - Logo settings > Hidden navigation: Logo
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_hidden_nav_logo',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_hidden_nav_logo',
			array(
				'label'		=> __( 'Hidden Navigation: Logo', 'halva' ),
				'section'	=> 'halva_logo_settings_section',
				'settings'	=> 'halva_heading_hidden_nav_logo',
			)
		)
	);


	// Hidden navigation: Logo type (select)
	$wp_customize->add_setting(
		'halva_hidden_nav_logo_type',
		array(
			'default'			=> 'text',
			'sanitize_callback'	=> 'halva_sanitize_logo_type',
		)
	);

	$wp_customize->add_control(
		'halva_hidden_nav_logo_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Hidden Navigation: Logo Type', 'halva' ),
			'section'	=> 'halva_logo_settings_section',
			'choices'	=> array(
				'text'		=> esc_html__( 'Text', 'halva' ),
				'image'		=> esc_html__( 'Image', 'halva' ),
			),
		)
	);


	// Setting description (setting id: halva_hidden_nav_logo_type)
	$wp_customize->add_setting(
		'halva_hidden_nav_logo_type_desc',
		array(
			'default'			=> __( 'You can add an image for your navigation logo in the "Site Identity" section: "Site Identity > Hidden Navigation: Logo".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_hidden_nav_logo_type_desc',
			array(
				'label'		=> __( 'Hidden Navigation: Logo Type (setting description)', 'halva' ),
				'section'	=> 'halva_logo_settings_section',
				'settings'	=> 'halva_hidden_nav_logo_type_desc',
			)
		)
	);


	// Hidden navigation: Logo text (text field)
	$wp_customize->add_setting(
		'halva_hidden_nav_logo_text',
		array(
			'default'			=> 'Halva.',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'halva_hidden_nav_logo_text',
		array(
			'label'		=> __( 'Hidden Navigation: Logo Text (Logo Type: Text)', 'halva' ),
			'section'	=> 'halva_logo_settings_section',
			'type'		=> 'text',
		)
	);


	/**
	 * 3.0 - Site navigation
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_site_navigation_section',
		array(
			'title'		=> __( 'Site Navigation', 'halva' ),
			'priority'	=> 22,
		)
	);


	/**
	 * 3.1 - Site navigation > Hidden navigation
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_hidden_nav',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_hidden_nav',
			array(
				'label'		=> __( 'Hidden Navigation', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_heading_hidden_nav',
			)
		)
	);


	// Enable hidden navigation (checkbox)
	$wp_customize->add_setting(
		'halva_enable_hidden_nav',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_enable_hidden_nav',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable hidden navigation', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
		)
	);


	/**
	 * 3.2 - Site navigation > Main menu
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_nav_menu',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_nav_menu',
			array(
				'label'		=> __( 'Main Menu', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_heading_nav_menu',
			)
		)
	);


	// Main menu: Instructions for adding (description)
	$wp_customize->add_setting(
		'halva_adding_main_menu_desc',
		array(
			'default'			=> __( 'The site navigation displays your Main Menu. You can add this menu in the menu editor: "WordPress Dashboard > Appearance > Menus". Display location: "Main menu (Header)".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_adding_main_menu_desc',
			array(
				'label'		=> __( 'Main Menu: Instructions for Adding', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_adding_main_menu_desc',
			)
		)
	);


	/**
	 * 3.3 - Site navigation > Social links
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_nav_social_links',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_nav_social_links',
			array(
				'label'		=> __( 'Social Links', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_heading_nav_social_links',
			)
		)
	);


	// Description of social settings
	$wp_customize->add_setting(
		'halva_nav_social_links_desc',
		array(
			'default'			=> __( 'Add URLs of your social profiles. If you have a large number of social profiles, then it is recommended to add links to them to the dropdown submenu of your main menu.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_nav_social_links_desc',
			array(
				'label'		=> __( 'Description of Social Settings', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_nav_social_links_desc',
			)
		)
	);


	// Twitter X (text field)
	$wp_customize->add_setting(
		'halva_nav_social_x-twitter',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_x-twitter',
		array(
			'label'		=> __( 'Twitter X URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Facebook (text field)
	$wp_customize->add_setting(
		'halva_nav_social_facebook-f',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_facebook-f',
		array(
			'label'		=> __( 'Facebook URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Pinterest (text field)
	$wp_customize->add_setting(
		'halva_nav_social_pinterest-p',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_pinterest-p',
		array(
			'label'		=> __( 'Pinterest URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Telegram (text field)
	$wp_customize->add_setting(
		'halva_nav_social_telegram-plane',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_telegram-plane',
		array(
			'label'		=> __( 'Telegram URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Reddit (text field)
	$wp_customize->add_setting(
		'halva_nav_social_reddit-alien',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_reddit-alien',
		array(
			'label'		=> __( 'Reddit URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// TikTok (text field)
	$wp_customize->add_setting(
		'halva_nav_social_tiktok',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_tiktok',
		array(
			'label'		=> __( 'TikTok URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// VK (text field)
	$wp_customize->add_setting(
		'halva_nav_social_vk',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_vk',
		array(
			'label'		=> __( 'VK URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Linkedin (text field)
	$wp_customize->add_setting(
		'halva_nav_social_linkedin-in',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_linkedin-in',
		array(
			'label'		=> __( 'Linkedin URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// PayPal (text field)
	$wp_customize->add_setting(
		'halva_nav_social_paypal',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_paypal',
		array(
			'label'		=> __( 'PayPal URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Patreon (text field)
	$wp_customize->add_setting(
		'halva_nav_social_patreon',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_patreon',
		array(
			'label'		=> __( 'Patreon URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Flickr (text field)
	$wp_customize->add_setting(
		'halva_nav_social_flickr',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_flickr',
		array(
			'label'		=> __( 'Flickr URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Instagram (text field)
	$wp_customize->add_setting(
		'halva_nav_social_instagram',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_instagram',
		array(
			'label'		=> __( 'Instagram URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// YouTube (text field)
	$wp_customize->add_setting(
		'halva_nav_social_youtube',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_youtube',
		array(
			'label'		=> __( 'YouTube URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Vimeo (text field)
	$wp_customize->add_setting(
		'halva_nav_social_vimeo-v',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_vimeo-v',
		array(
			'label'		=> __( 'Vimeo URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// SoundCloud (text field)
	$wp_customize->add_setting(
		'halva_nav_social_soundcloud',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_soundcloud',
		array(
			'label'		=> __( 'SoundCloud URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Dribbble (text field)
	$wp_customize->add_setting(
		'halva_nav_social_dribbble',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_dribbble',
		array(
			'label'		=> __( 'Dribbble URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Behance (text field)
	$wp_customize->add_setting(
		'halva_nav_social_behance',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_behance',
		array(
			'label'		=> __( 'Behance URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// GitHub (text field)
	$wp_customize->add_setting(
		'halva_nav_social_github',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_github',
		array(
			'label'		=> __( 'GitHub URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// RSS (text field)
	$wp_customize->add_setting(
		'halva_nav_social_rss',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_rss',
		array(
			'label'		=> __( 'RSS URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Settings for social links in HTML code format (description)
	$wp_customize->add_setting(
		'halva_nav_social_links_html_settings',
		array(
			'default'			=> __( 'Settings for Social Links in HTML Code Format', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_nav_social_links_html_settings',
			array(
				'label'		=> __( 'Settings for Social Links in HTML Code Format', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_nav_social_links_html_settings',
			)
		)
	);


	// Display social links in HTML code format instead of preset links (checkbox)
	$wp_customize->add_setting(
		'halva_display_nav_social_links_html',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_display_nav_social_links_html',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Display social links in HTML code format instead of preset links', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
		)
	);


	// Social links: HTML code (textarea)
	$wp_customize->add_setting(
		'halva_nav_social_links_html',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'halva_sanitize_wp_kses_social_links',
		)
	);

	$wp_customize->add_control(
		'halva_nav_social_links_html',
		array(
			'label'		=> __( 'Social Links (HTML Code)', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'textarea',
		)
	);


	// Social links: Allowed HTML tags (description)
	$wp_customize->add_setting(
		'halva_nav_social_links_html_desc',
		array(
			'default'			=> __( 'Add HTML code for your social links. You can use the following HTML tags: a, span, i. The following attributes are allowed for these tags: "a - href, title, target, class, rel", "span - class", "i - class". You can find examples of adding social links to this field in the documentation for this theme (Documentation > Theme Customization > Site Navigation > Social Links).', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_nav_social_links_html_desc',
			array(
				'label'		=> __( 'Social Links: Allowed HTML Tags', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_nav_social_links_html_desc',
			)
		)
	);


	/**
	 * 3.4 - Site navigation > Subscribe link
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_nav_subscribe_link',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_nav_subscribe_link',
			array(
				'label'		=> __( 'Subscribe Link', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_heading_nav_subscribe_link',
			)
		)
	);


	// Subscribe URL (text field)
	$wp_customize->add_setting(
		'halva_nav_subscribe_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		'halva_nav_subscribe_url',
		array(
			'label'		=> __( 'Subscribe URL', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	// Setting description (setting id: halva_nav_subscribe_url)
	$wp_customize->add_setting(
		'halva_nav_subscribe_url_desc',
		array(
			'default'			=> __( 'You can use a MailChimp Form or any mailing system that generate a public URL. Check the documentation for this theme for more details.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_nav_subscribe_url_desc',
			array(
				'label'		=> __( 'Subscribe URL (setting description)', 'halva' ),
				'section'	=> 'halva_site_navigation_section',
				'settings'	=> 'halva_nav_subscribe_url_desc',
			)
		)
	);


	// Subscribe: Link text (text field)
	$wp_customize->add_setting(
		'halva_nav_subscribe_text',
		array(
			'default'			=> 'Subscribe',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'halva_nav_subscribe_text',
		array(
			'label'		=> __( 'Subscribe: Link Text', 'halva' ),
			'section'	=> 'halva_site_navigation_section',
			'type'		=> 'text',
		)
	);


	/**
	 * 4.0 - Homepage carousel
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_homepage_carousel_section',
		array(
			'title'		=> __( 'Homepage Carousel', 'halva' ),
			'priority'	=> 23,
		)
	);


	/**
	 * 4.1 - Homepage carousel > Display settings
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_carousel_display_settings',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_carousel_display_settings',
			array(
				'label'		=> __( 'Display Settings', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_heading_carousel_display_settings',
			)
		)
	);


	// Show/hide carousel (checkbox)
	$wp_customize->add_setting(
		'halva_show_homepage_carousel',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_show_homepage_carousel',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show homepage carousel', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	// Show the carousel only on the first pagination page (checkbox)
	$wp_customize->add_setting(
		'halva_show_carousel_on_first_page',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_show_carousel_on_first_page',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show the carousel only on the first pagination page', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	/**
	 * 4.2 - Homepage carousel > Carousel options
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_carousel_options',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_carousel_options',
			array(
				'label'		=> __( 'Carousel Options', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_heading_carousel_options',
			)
		)
	);


	// Maximum number of carousel items (number)
	$wp_customize->add_setting(
		'halva_carousel_items_max_number',
		array(
			'default'			=> 7,
			'sanitize_callback'	=> 'halva_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_number(
			$wp_customize,
			'halva_carousel_items_max_number',
			array(
				'label'		=> __( 'Maximum Number Of Carousel Items (Default Value: 7)', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_carousel_items_max_number',
			)
		)
	);


	// Type of posts for the carousel (select)
	$wp_customize->add_setting(
		'halva_carousel_shows_posts_from',
		array(
			'default'			=> 'posts-by-category',
			'sanitize_callback'	=> 'halva_sanitize_carousel_posts_type',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_shows_posts_from',
		array(
			'type'		=> 'select',
			'label'		=> __( 'What Type Of Posts Should Be Shown In The Carousel?', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
			'choices'	=> array(
				'posts-by-category'	=> esc_html__( 'Posts by category', 'halva' ),
				'featured-posts'	=> esc_html__( 'Featured posts', 'halva' ),
			),
		)
	);


	// Setting description (setting id: halva_carousel_shows_posts_from)
	$wp_customize->add_setting(
		'halva_carousel_shows_posts_from_desc',
		array(
			'default'			=> __( '"Posts by category" - The carousel will display posts from all categories or from one selected category. "Featured posts" - The carousel will display only featured posts. You can select these posts manually in the settings for each post: "WordPress Dashboard > Posts > Add new or Edit existing post > Additional Settings > Homepage Carousel > Add this post to the carousel on your homepage (check the box)".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_carousel_shows_posts_from_desc',
			array(
				'label'		=> __( 'Type of Posts for the Carousel (setting description)', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_carousel_shows_posts_from_desc',
			)
		)
	);


	// Category for posts in the carousel (select)
	$wp_customize->add_setting(
		'halva_carousel_category_id',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_categories',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_category_id',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Category For Carousel Items', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
			'choices'	=> $categories,
		)
	);


	// Setting description (setting id: halva_carousel_category_id)
	$wp_customize->add_setting(
		'halva_carousel_category_id_desc',
		array(
			'default'			=> __( 'The category selection setting only works if the carousel displays posts by category (Homepage Carousel > What type of posts should be shown in the carousel? > Posts by category).', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_carousel_category_id_desc',
			array(
				'label'		=> __( 'Category for Carousel Items (setting description)', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_carousel_category_id_desc',
			)
		)
	);


	// Carousel: Order by... (select)
	$wp_customize->add_setting(
		'halva_carousel_orderby',
		array(
			'default'			=> 'date',
			'sanitize_callback'	=> 'halva_sanitize_carousel_orderby',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_orderby',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Order By', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
			'choices'	=> array(
				'rand'			=> esc_html__( 'Random order', 'halva' ),
				'date'			=> esc_html__( 'Publication date', 'halva' ),
				'comment_count'	=> esc_html__( 'Number of comments', 'halva' ),
			),
		)
	);


	// Enable rewind (checkbox)
	$wp_customize->add_setting(
		'halva_carousel_enable_rewind',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_enable_rewind',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable rewind (Move to the opposite edge when reaching the first or last carousel item)', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	// Animation speed (number)
	$wp_customize->add_setting(
		'halva_carousel_animation_speed',
		array(
			'default'			=> 500,
			'sanitize_callback'	=> 'halva_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_number(
			$wp_customize,
			'halva_carousel_animation_speed',
			array(
				'label'		=> __( 'Carousel Animation Speed (in "ms")', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_carousel_animation_speed',
			)
		)
	);


	// Setting description (setting id: halva_carousel_animation_speed)
	$wp_customize->add_setting(
		'halva_carousel_animation_speed_desc',
		array(
			'default'			=> __( 'Default value: 500. Recommended range of values: 300...800.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_carousel_animation_speed_desc',
			array(
				'label'		=> __( 'Carousel Animation Speed (setting description)', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_carousel_animation_speed_desc',
			)
		)
	);


	// Show navigation buttons (next/previous; checkbox)
	$wp_customize->add_setting(
		'halva_carousel_show_controls',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_show_controls',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show navigation buttons (Next/Previous)', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	// Show pagination (dots; checkbox)
	$wp_customize->add_setting(
		'halva_carousel_show_nav',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_show_nav',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show pagination (Dots)', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	// Enable hover effects when hovering over a carousel item (checkbox)
	$wp_customize->add_setting(
		'halva_carousel_item_hover_effects',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_item_hover_effects',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable hover effects when hovering over a carousel item', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	/**
	 * 4.3 - Homepage carousel > Carousel content
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_carousel_content',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_carousel_content',
			array(
				'label'		=> __( 'Carousel Content', 'halva' ),
				'section'	=> 'halva_homepage_carousel_section',
				'settings'	=> 'halva_heading_carousel_content',
			)
		)
	);


	// Show categories (checkbox)
	$wp_customize->add_setting(
		'halva_carousel_show_categories',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_show_categories',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show categories', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	// Show date (checkbox)
	$wp_customize->add_setting(
		'halva_carousel_show_date',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_show_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show date', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	// Show author (checkbox)
	$wp_customize->add_setting(
		'halva_carousel_show_author',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_carousel_show_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show author', 'halva' ),
			'section'	=> 'halva_homepage_carousel_section',
		)
	);


	/**
	 * 5.0 - Blog posts
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_blog_posts_section',
		array(
			'title'		=> __( 'Blog Posts', 'halva' ),
			'priority'	=> 24,
		)
	);


	// Section description (section id: halva_blog_posts_section)
	$wp_customize->add_setting(
		'halva_blog_posts_section_desc',
		array(
			'default'			=> __( 'In this section you can find settings for the section with your latest posts. Your latest posts appear on your homepage and archive pages (category and tag pages, date page, and so on).', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_blog_posts_section_desc',
			array(
				'label'		=> __( 'Blog Posts: Description of the Settings Section', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_blog_posts_section_desc',
			)
		)
	);


	// Show page numbers (checkbox)
	$wp_customize->add_setting(
		'halva_posts_show_page_numbers',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_posts_show_page_numbers',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show page numbers (Current page number and total number of blog pages: "Page 1 of 14")', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Enable switching between layouts (checkbox)
	$wp_customize->add_setting(
		'halva_enable_blog_layout_switching',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_enable_blog_layout_switching',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable switching between layouts (Three columns or One column)', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Default layout (select)
	$wp_customize->add_setting(
		'halva_default_blog_layout',
		array(
			'default'			=> 'col-3',
			'sanitize_callback'	=> 'halva_sanitize_blog_layout',
		)
	);

	$wp_customize->add_control(
		'halva_default_blog_layout',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Default Layout', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
			'choices'	=> array(
				'col-1'		=> esc_html__( 'One column', 'halva' ),
				'col-3'		=> esc_html__( 'Three columns', 'halva' ),
			),
		)
	);


	// Setting description (setting id: halva_default_blog_layout)
	$wp_customize->add_setting(
		'halva_default_blog_layout_desc',
		array(
			'default'			=> __( 'This setting changes the default layout (One column or Three columns). Important! If your current browser has the "halva_blog_layout" cookie, then the layout will not change in that browser. The layout will change for visitors who do not have this cookie. If the layout switching feature is disabled, the "halva_blog_layout" cookie is not used (Blog Posts > Enable switching between layouts > Disable).', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_default_blog_layout_desc',
			array(
				'label'		=> __( 'Default Layout (setting description)', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_default_blog_layout_desc',
			)
		)
	);


	// Three columns: Enable horizontal order for blog posts (checkbox)
	$wp_customize->add_setting(
		'halva_enable_posts_horizontal_order',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_enable_posts_horizontal_order',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable horizontal (left-to-right) order for blog posts (Layout: Three columns)', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	/**
	 * 5.1 - Blog posts > Posts
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_posts_settings',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_posts_settings',
			array(
				'label'		=> __( 'Posts', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_heading_posts_settings',
			)
		)
	);


	// Featured image: Link type (select)
	$wp_customize->add_setting(
		'halva_featured_image_link_type',
		array(
			'default'			=> 'link_to_post',
			'sanitize_callback'	=> 'halva_sanitize_featured_image_link_type',
		)
	);

	$wp_customize->add_control(
		'halva_featured_image_link_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Featured Image: Link Type', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
			'choices'	=> array(
				'link_to_post'	=> esc_html__( 'Link to post', 'halva' ),
				'link_to_image'	=> esc_html__( 'Link to image', 'halva' ),
			),
		)
	);


	// Enable hover effects when you hover on featured images (checkbox)
	$wp_customize->add_setting(
		'halva_featured_image_hover_effects',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_featured_image_hover_effects',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable hover effects when you hover on featured images', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Featured images: Increase the size of small featured images (checkbox)
	$wp_customize->add_setting(
		'halva_enlarge_featured_image',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_enlarge_featured_image',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Increase the size of small featured images', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Excerpt length (Number of words; number)
	$wp_customize->add_setting(
		'halva_post_excerpt_length',
		array(
			'default'			=> 30,
			'sanitize_callback'	=> 'halva_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_number(
			$wp_customize,
			'halva_post_excerpt_length',
			array(
				'label'		=> __( 'Post Excerpt Length (Number Of Words)', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_post_excerpt_length',
			)
		)
	);


	// Information about creating excerpts for posts (description)
	$wp_customize->add_setting(
		'halva_post_excerpt_desc',
		array(
			'default'			=> __( 'Basic post formats display an automatic excerpt generated from the full content (basic formats: standard, image, gallery, audio, and video). Other post formats display full content instead of automatic excerpt (formats: aside, link, quote, status, and chat). Use the "Read More" block (or tag) to create an excerpt for these special formats.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_post_excerpt_desc',
			array(
				'label'		=> __( 'Post Excerpt (setting description)', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_post_excerpt_desc',
			)
		)
	);


	// Show date (checkbox)
	$wp_customize->add_setting(
		'halva_posts_show_date',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_posts_show_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show date', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Show author (checkbox)
	$wp_customize->add_setting(
		'halva_posts_show_author',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_posts_show_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show author', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Show categories (checkbox)
	$wp_customize->add_setting(
		'halva_posts_show_categories',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_posts_show_categories',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show categories', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Show the "Read more" link (checkbox)
	$wp_customize->add_setting(
		'halva_posts_show_read_more',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_posts_show_read_more',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show the "Read more" link', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Text for the "Read more" link (text field)
	$wp_customize->add_setting(
		'halva_posts_read_more_text',
		array(
			'default'			=> 'Read More',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'halva_posts_read_more_text',
		array(
			'label'		=> __( 'Text For The "Read More" Link', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
			'type'		=> 'text',
		)
	);


	// if "Halva Additional Features" plugin is activated
	if ( function_exists( 'halva_additional_features_show_views_counter' ) ) {

		// Show views counter (checkbox)
		$wp_customize->add_setting(
			'halva_posts_show_views_counter',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'halva_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'halva_posts_show_views_counter',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show views counter', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
			)
		);

	}


	// Show comments counter (checkbox)
	$wp_customize->add_setting(
		'halva_posts_show_comments_counter',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_posts_show_comments_counter',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show comments counter', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	/**
	 * 5.2 - Blog posts > Gallery format: Slider options
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_gallery_slider_options',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_gallery_slider_options',
			array(
				'label'		=> __( 'Gallery Format: Slider Options', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_heading_gallery_slider_options',
			)
		)
	);


	// Enable rewind (checkbox)
	$wp_customize->add_setting(
		'halva_gallery_slider_enable_rewind',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_gallery_slider_enable_rewind',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable rewind (Move to the opposite edge when reaching the first or last slide)', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
		)
	);


	// Transition type for slides (select)
	$wp_customize->add_setting(
		'halva_gallery_slider_transition_type',
		array(
			'default'			=> 'slide_horizontal',
			'sanitize_callback'	=> 'halva_sanitize_slider_transition_type',
		)
	);

	$wp_customize->add_control(
		'halva_gallery_slider_transition_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Transition Type For Slides', 'halva' ),
			'section'	=> 'halva_blog_posts_section',
			'choices'	=> array(
				'fade'				=> esc_html__( 'Fade animation', 'halva' ),
				'slide_horizontal'	=> esc_html__( 'Slide horizontal', 'halva' ),
			),
		)
	);


	// Speed of the slide animation (number)
	$wp_customize->add_setting(
		'halva_gallery_slider_animation_speed',
		array(
			'default'			=> 500,
			'sanitize_callback'	=> 'halva_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_number(
			$wp_customize,
			'halva_gallery_slider_animation_speed',
			array(
				'label'		=> __( 'Speed Of The Slide Animation (in "ms")', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_gallery_slider_animation_speed',
			)
		)
	);


	// Setting description (setting id: halva_gallery_slider_animation_speed)
	$wp_customize->add_setting(
		'halva_gallery_slider_animation_speed_desc',
		array(
			'default'			=> __( 'Default value: 500. Recommended range of values: 300...800.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_gallery_slider_animation_speed_desc',
			array(
				'label'		=> __( 'Speed of the Slide Animation (setting description)', 'halva' ),
				'section'	=> 'halva_blog_posts_section',
				'settings'	=> 'halva_gallery_slider_animation_speed_desc',
			)
		)
	);


	/**
	 * 6.0 - Single pages
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_single_pages_section',
		array(
			'title'		=> __( 'Single Pages', 'halva' ),
			'priority'	=> 25,
		)
	);


	/**
	 * 6.1 - Single pages > Featured image settings
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_pages_featured_image',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_pages_featured_image',
			array(
				'label'		=> __( 'Featured Image', 'halva' ),
				'section'	=> 'halva_single_pages_section',
				'settings'	=> 'halva_heading_pages_featured_image',
			)
		)
	);


	// Featured image (or Slider images): Show cropped image instead of full image (checkbox)
	$wp_customize->add_setting(
		'halva_pages_cropped_image',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_pages_cropped_image',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Featured image (or Slider images): Show cropped image instead of full image', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Featured image (or Slider images): Enable lightbox functionality (checkbox)
	$wp_customize->add_setting(
		'halva_pages_enable_popup_image',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_pages_enable_popup_image',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable lightbox functionality for your featured image and slider images', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	/**
	 * 6.2 - Single pages > Single post page
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_single_post_settings',
		array(
			'default'			=> __( 'Settings for displaying elements located on a single post page. You can create or edit posts here: "WordPress Dashboard > Posts".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_single_post_settings',
			array(
				'label'		=> __( 'Single Post Page', 'halva' ),
				'section'	=> 'halva_single_pages_section',
				'settings'	=> 'halva_heading_single_post_settings',
			)
		)
	);


	// Single post page: Show publication date (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_publication_date',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_publication_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show publication date (The date when the post was published)', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Single post page: Show update date (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_update_date',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_update_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show update date (The date when the post was last updated). Important note: If the update date and the publication date are the same, the update date will be hidden', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Single post page: Show author (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_author',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show author', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// if "Halva Additional Features" plugin is activated
	if ( function_exists( 'halva_additional_features_show_views_counter' ) ) {

		// Single post page: Show views counter (checkbox)
		$wp_customize->add_setting(
			'halva_single_show_views_counter',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'halva_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'halva_single_show_views_counter',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show views counter', 'halva' ),
				'section'	=> 'halva_single_pages_section',
			)
		);

	}


	// Single post page: Show comments counter (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_comments_counter',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_comments_counter',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show comments counter', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Single post page: Show categories (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_categories',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_categories',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show categories', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Single post page: Show tags (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_tags',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_tags',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show tags', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Single post page: Show "About the author" section (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_about_author',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_about_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show "About the author" section', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Setting description (setting id: halva_single_show_about_author)
	$wp_customize->add_setting(
		'halva_single_show_about_author_desc',
		array(
			'default'			=> __( 'You can add information about yourself in your profile settings: "WordPress Dashboard > Users > Profile > About Yourself > Biographical Info".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_single_show_about_author_desc',
			array(
				'label'		=> __( 'Show "About the author" section (setting description)', 'halva' ),
				'section'	=> 'halva_single_pages_section',
				'settings'	=> 'halva_single_show_about_author_desc',
			)
		)
	);


	// Single post page: Show post navigation (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_post_navigation',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_post_navigation',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show navigation between next and previous posts', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Single post page: Show related posts (checkbox)
	$wp_customize->add_setting(
		'halva_single_show_related_posts',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_single_show_related_posts',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show related posts', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Setting description (setting id: halva_single_show_related_posts)
	$wp_customize->add_setting(
		'halva_single_show_related_posts_desc',
		array(
			'default'			=> __( 'This section displays posts that have at least one tag, which the current post also has. If the current post has no tags, then it has no related posts. If other posts do not have tags that the current post has, then the current post also has no related posts.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_single_show_related_posts_desc',
			array(
				'label'		=> __( 'Show related posts (setting description)', 'halva' ),
				'section'	=> 'halva_single_pages_section',
				'settings'	=> 'halva_single_show_related_posts_desc',
			)
		)
	);


	/**
	 * 6.3 - Single pages > Single page
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_single_page_settings',
		array(
			'default'			=> __( 'Settings for displaying elements located on a single page. You can create or edit pages here: "WordPress Dashboard > Pages".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_single_page_settings',
			array(
				'label'		=> __( 'Single Page', 'halva' ),
				'section'	=> 'halva_single_pages_section',
				'settings'	=> 'halva_heading_single_page_settings',
			)
		)
	);


	// Page: Show publication date (checkbox)
	$wp_customize->add_setting(
		'halva_page_show_publication_date',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_page_show_publication_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show publication date (The date when the page was published)', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Page: Show update date (checkbox)
	$wp_customize->add_setting(
		'halva_page_show_update_date',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_page_show_update_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show update date (The date when the page was last updated). Important note: If the update date and the publication date are the same, the update date will be hidden', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Page: Show author (checkbox)
	$wp_customize->add_setting(
		'halva_page_show_author',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_page_show_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show author', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// if "Halva Additional Features" plugin is activated
	if ( function_exists( 'halva_additional_features_show_views_counter' ) ) {

		// Page: Show views counter (checkbox)
		$wp_customize->add_setting(
			'halva_page_show_views_counter',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'halva_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'halva_page_show_views_counter',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show views counter', 'halva' ),
				'section'	=> 'halva_single_pages_section',
			)
		);

	}


	// Page: Show comments counter (checkbox)
	$wp_customize->add_setting(
		'halva_page_show_comments_counter',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_page_show_comments_counter',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show comments counter', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	// Page: Show random posts at the bottom of the page (checkbox)
	$wp_customize->add_setting(
		'halva_page_show_random_posts',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_page_show_random_posts',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show random posts at the bottom of the page', 'halva' ),
			'section'	=> 'halva_single_pages_section',
		)
	);


	/**
	 * 7.0 - Footer
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_footer_section',
		array(
			'title'		=> __( 'Footer', 'halva' ),
			'priority'	=> 26,
		)
	);


	// Section description (section id: halva_footer_section)
	$wp_customize->add_setting(
		'halva_footer_section_desc',
		array(
			'default'			=> __( 'You can display the following elements in the footer area of your site: Widgets, Custom text, and Footer menu. 1. Widgets. Widgets can be added on the Widgets page: "WordPress Dashboard > Appearance > Widgets". 2. Custom text. The text for the site footer usually contains copyright information. You can add this information to the text field below. It is also allowed to add links and icons to this text (The "a" tag is used for links, the "i" tag is used for icons. All available icons you can find on the Font Awesome site - the link is available in the documentation, section "Credits"). 3. Menu. You can add and customize your menu on the Menus page: "WordPress Dashboard > Appearance > Menus".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_footer_section_desc',
			array(
				'label'		=> __( 'Footer: Description of the Settings Section', 'halva' ),
				'section'	=> 'halva_footer_section',
				'settings'	=> 'halva_footer_section_desc',
			)
		)
	);


	// Copyright text (textarea)
	$wp_customize->add_setting(
		'halva_footer_text',
		array(
			'default'			=> 'Halva Theme - Powered by WordPress',
			'sanitize_callback'	=> 'halva_sanitize_wp_kses_text',
		)
	);

	$wp_customize->add_control(
		'halva_footer_text',
		array(
			'label'		=> __( 'Copyright Text', 'halva' ),
			'section'	=> 'halva_footer_section',
			'type'		=> 'textarea',
		)
	);


	// Copyright text: Allowed HTML tags (description)
	$wp_customize->add_setting(
		'halva_footer_text_desc',
		array(
			'default'			=> __( 'Add your text for the site footer. You can use the following HTML tags: p, a, span, strong, b, em, i, br. The following attributes are allowed for these tags: "p - class", "a - href, title, target, class, rel", "span - class", "i - class".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_footer_text_desc',
			array(
				'label'		=> __( 'Copyright Text: Allowed HTML Tags', 'halva' ),
				'section'	=> 'halva_footer_section',
				'settings'	=> 'halva_footer_text_desc',
			)
		)
	);


	/**
	 * 8.0 - Sticky buttons (Color mode, fonts, search and so on)
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_sticky_buttons_section',
		array(
			'title'		=> __( 'Sticky Buttons', 'halva' ),
			'priority'	=> 27,
		)
	);


	// Section description (section id: halva_sticky_buttons_section)
	$wp_customize->add_setting(
		'halva_sticky_buttons_section_desc',
		array(
			'default'			=> __( 'Sticky buttons is a bar on the right side of the page that includes the following buttons: 1 - Sidebar button, 2 - Button to toggle between light and dark modes, 3 - Button to toggle between font types, 4 - Search button and dropdown search form, 5 - Back To Top button.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_sticky_buttons_section_desc',
			array(
				'label'		=> __( 'Sticky Buttons: Description of the Settings Section', 'halva' ),
				'section'	=> 'halva_sticky_buttons_section',
				'settings'	=> 'halva_sticky_buttons_section_desc',
			)
		)
	);


	// Button: Show hidden sidebar (checkbox)
	$wp_customize->add_setting(
		'halva_button_show_hidden_sidebar',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_button_show_hidden_sidebar',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Button: Show hidden sidebar (arrow icon)', 'halva' ),
			'section'	=> 'halva_sticky_buttons_section',
		)
	);


	// Setting description (setting id: halva_button_show_hidden_sidebar)
	$wp_customize->add_setting(
		'halva_button_show_hidden_sidebar_desc',
		array(
			'default'			=> __( 'If there are no widgets in the sidebar, then the sidebar button along with the sidebar will not be displayed.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_button_show_hidden_sidebar_desc',
			array(
				'label'		=> __( 'Button: Show hidden sidebar (setting description)', 'halva' ),
				'section'	=> 'halva_sticky_buttons_section',
				'settings'	=> 'halva_button_show_hidden_sidebar_desc',
			)
		)
	);


	// Button: Toggle color mode (checkbox)
	$wp_customize->add_setting(
		'halva_button_color_mode',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_button_color_mode',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Button: Toggle color mode (moon/sun icon)', 'halva' ),
			'section'	=> 'halva_sticky_buttons_section',
		)
	);


	// Default color mode: Light or Dark (select)
	$wp_customize->add_setting(
		'halva_default_color_mode',
		array(
			'default'			=> 'light',
			'sanitize_callback'	=> 'halva_sanitize_color_mode',
		)
	);

	$wp_customize->add_control(
		'halva_default_color_mode',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Default Color Mode: Light or Dark', 'halva' ),
			'section'	=> 'halva_sticky_buttons_section',
			'choices'	=> array(
				'light'		=> esc_html__( 'Light mode', 'halva' ),
				'dark'		=> esc_html__( 'Dark mode', 'halva' ),
			),
		)
	);


	// Setting description (setting id: halva_default_color_mode)
	$wp_customize->add_setting(
		'halva_default_color_mode_desc',
		array(
			'default'			=> __( 'This setting changes the default color mode for your site (Light or Dark). Important! If your current browser has the "halva_color_scheme" cookie, then your site\'s color mode will not change in that browser. The color mode will change for visitors who do not have this cookie.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_default_color_mode_desc',
			array(
				'label'		=> __( 'Default Color Mode (setting description)', 'halva' ),
				'section'	=> 'halva_sticky_buttons_section',
				'settings'	=> 'halva_default_color_mode_desc',
			)
		)
	);


	// Button: Toggle between font types (checkbox)
	$wp_customize->add_setting(
		'halva_button_font_types',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_button_font_types',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Button: Toggle between font types (font icon)', 'halva' ),
			'section'	=> 'halva_sticky_buttons_section',
		)
	);


	// Default fonts: Sans-serif or Serif (select)
	$wp_customize->add_setting(
		'halva_default_font_type',
		array(
			'default'			=> 'sans-serif',
			'sanitize_callback'	=> 'halva_sanitize_font_type',
		)
	);

	$wp_customize->add_control(
		'halva_default_font_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Default Fonts: Sans-serif or Serif', 'halva' ),
			'section'	=> 'halva_sticky_buttons_section',
			'choices'	=> array(
				'sans-serif'	=> esc_html__( 'Sans-serif fonts', 'halva' ),
				'serif'			=> esc_html__( 'Serif fonts', 'halva' ),
			),
		)
	);


	// Setting description (setting id: halva_default_font_type)
	$wp_customize->add_setting(
		'halva_default_font_type_desc',
		array(
			'default'			=> __( 'This setting changes the default fonts (Sans-serif or Serif fonts). Important! If your current browser has the "halva_font_type" cookie, then the fonts will not change in that browser. The fonts will change for visitors who do not have this cookie.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_default_font_type_desc',
			array(
				'label'		=> __( 'Default Fonts (setting description)', 'halva' ),
				'section'	=> 'halva_sticky_buttons_section',
				'settings'	=> 'halva_default_font_type_desc',
			)
		)
	);


	// Button: Show/hide search form (checkbox)
	$wp_customize->add_setting(
		'halva_button_show_search',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_button_show_search',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Button: Show/hide search form (search icon)', 'halva' ),
			'section'	=> 'halva_sticky_buttons_section',
		)
	);


	// Button: Back to top (checkbox)
	$wp_customize->add_setting(
		'halva_button_back_to_top',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_button_back_to_top',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Button: Back to top. Note: This button is not available on mobile devices', 'halva' ),
			'section'	=> 'halva_sticky_buttons_section',
		)
	);


	/**
	 * 9.0 - Colors and styles
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_colors_styles_section',
		array(
			'title'		=> __( 'Colors And Styles', 'halva' ),
			'priority'	=> 28,
		)
	);


	/**
	 * 9.1 - Colors and styles > Colors
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_color_settings',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_color_settings',
			array(
				'label'		=> __( 'Colors', 'halva' ),
				'section'	=> 'halva_colors_styles_section',
				'settings'	=> 'halva_heading_color_settings',
			)
		)
	);


	// Light mode: Hover/active color
	$wp_customize->add_setting(
		'halva_light_mode_hover_color',
		array(
			'default'			=> '#786fff',
			'sanitize_callback'	=> 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'halva_light_mode_hover_color',
			array(
				'label'		=> esc_html__( 'Light Mode: Hover/Active Color (Default Color: #786fff)', 'halva' ),
				'section'	=> 'halva_colors_styles_section',
				'settings'	=> 'halva_light_mode_hover_color',
			)
		)
	);


	// Dark mode: Hover/active color
	$wp_customize->add_setting(
		'halva_dark_mode_hover_color',
		array(
			'default'			=> '#877fff',
			'sanitize_callback'	=> 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'halva_dark_mode_hover_color',
			array(
				'label'		=> esc_html__( 'Dark Mode: Hover/Active Color (Default Color: #877fff)', 'halva' ),
				'section'	=> 'halva_colors_styles_section',
				'settings'	=> 'halva_dark_mode_hover_color',
			)
		)
	);


	/**
	 * 9.2 - Colors and styles > Styles
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_styles_settings',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_styles_settings',
			array(
				'label'		=> __( 'Styles', 'halva' ),
				'section'	=> 'halva_colors_styles_section',
				'settings'	=> 'halva_heading_styles_settings',
			)
		)
	);


	// Add text transformation for some text elements (checkbox)
	$wp_customize->add_setting(
		'halva_styles_text_transform',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_styles_text_transform',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Add text transformation for some text elements (text-transform: capitalize)', 'halva' ),
			'section'	=> 'halva_colors_styles_section',
		)
	);


	// Setting description (setting id: halva_styles_text_transform)
	$wp_customize->add_setting(
		'halva_styles_text_transform_desc',
		array(
			'default'			=> __( 'This option adds the "text-transform: capitalize" property to some text elements. Example: "You may also like" > "You May Also Like".', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_styles_text_transform_desc',
			array(
				'label'		=> __( 'Add text transformation for some text elements (setting description)', 'halva' ),
				'section'	=> 'halva_colors_styles_section',
				'settings'	=> 'halva_styles_text_transform_desc',
			)
		)
	);


	// Enable hover effects when hovering over a widget image (checkbox)
	$wp_customize->add_setting(
		'halva_styles_widget_hover_effects',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_styles_widget_hover_effects',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable hover effects when hovering over a widget image. Note: These styles only apply to additional widgets in the Halva theme', 'halva' ),
			'section'	=> 'halva_colors_styles_section',
		)
	);


	/**
	 * 10.0 - Cookies
	 * ----------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'halva_cookies_section',
		array(
			'title'		=> __( 'Cookies', 'halva' ),
			'priority'	=> 29,
		)
	);


	// Section description (section id: halva_cookies_section)
	$wp_customize->add_setting(
		'halva_cookies_section_desc',
		array(
			'default'			=> __( 'HTTP cookies (also called web cookies, Internet cookies, browser cookies, or simply cookies) are small blocks of data created by a web server while a user is browsing a website and placed on the user\'s computer or other device by the user\'s web browser. This theme uses cookies to store the selected blog layout (One column or Three columns), color mode (Light or Dark), and selected fonts (Serif fonts or Sans-serif fonts). In the settings below you can allow or disallow the use of cookies.', 'halva' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_description(
			$wp_customize,
			'halva_cookies_section_desc',
			array(
				'label'		=> __( 'Cookies: Description of the Settings Section', 'halva' ),
				'section'	=> 'halva_cookies_section',
				'settings'	=> 'halva_cookies_section_desc',
			)
		)
	);


	/**
	 * 10.1 - Cookies > Cookies: Enable/Disable
	 * ----------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'halva_heading_cookies_enable_disable',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new halva_customize_control_heading(
			$wp_customize,
			'halva_heading_cookies_enable_disable',
			array(
				'label'		=> __( 'Cookies: Enable/Disable', 'halva' ),
				'section'	=> 'halva_cookies_section',
				'settings'	=> 'halva_heading_cookies_enable_disable',
			)
		)
	);


	// Use a cookie to save the selected layout (checkbox)
	$wp_customize->add_setting(
		'halva_cookie_for_blog_layout',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_cookie_for_blog_layout',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Use a cookie to save the selected layout (one column or three columns)?', 'halva' ),
			'section'	=> 'halva_cookies_section',
		)
	);


	// Use a cookie to save the selected color mode (checkbox)
	$wp_customize->add_setting(
		'halva_cookie_for_color_scheme',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_cookie_for_color_scheme',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Use a cookie to save the selected color mode (light or dark)?', 'halva' ),
			'section'	=> 'halva_cookies_section',
		)
	);


	// Use a cookie to save the selected type of fonts (checkbox)
	$wp_customize->add_setting(
		'halva_cookie_for_font_type',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'halva_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'halva_cookie_for_font_type',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Use a cookie to save the selected type of fonts (sans-serif fonts or serif fonts)?', 'halva' ),
			'section'	=> 'halva_cookies_section',
		)
	);


	/**
	 * 10.2 - Cookies > Cookies notice
	 * ----------------------------------------------
	 */

	// if "Halva Additional Features" plugin is activated
	if ( function_exists( 'halva_additional_features_show_cookies_notice' ) ) {

		// Heading
		$wp_customize->add_setting(
			'halva_heading_cookies_notice',
			array(
				'default'			=> '',
				'sanitize_callback'	=> 'esc_html',
			)
		);

		$wp_customize->add_control(
			new halva_customize_control_heading(
				$wp_customize,
				'halva_heading_cookies_notice',
				array(
					'label'		=> __( 'Cookies Notice', 'halva' ),
					'section'	=> 'halva_cookies_section',
					'settings'	=> 'halva_heading_cookies_notice',
				)
			)
		);


		// Show cookies notice (checkbox)
		$wp_customize->add_setting(
			'halva_show_cookies_notice',
			array(
				'default'			=> 0,
				'sanitize_callback'	=> 'halva_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'halva_show_cookies_notice',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show cookies notice', 'halva' ),
				'section'	=> 'halva_cookies_section',
			)
		);


		// Cookies notice on mobile devices (select)
		$wp_customize->add_setting(
			'halva_cookies_notice_on_mobile',
			array(
				'default'			=> 'hidden',
				'sanitize_callback'	=> 'halva_sanitize_cookies_notice_on_mobile',
			)
		);

		$wp_customize->add_control(
			'halva_cookies_notice_on_mobile',
			array(
				'type'		=> 'select',
				'label'		=> __( 'Cookies Notice On Mobile Devices', 'halva' ),
				'section'	=> 'halva_cookies_section',
				'choices'	=> array(
					'hidden'	=> esc_html__( 'Hidden notification', 'halva' ),
					'visible'	=> esc_html__( 'Visible notification', 'halva' ),
				),
			)
		);


		// Cookies notice: Title (text field)
		$wp_customize->add_setting(
			'halva_cookies_notice_title',
			array(
				'default'			=> 'Cookies Notice',
				'sanitize_callback'	=> 'esc_html',
			)
		);

		$wp_customize->add_control(
			'halva_cookies_notice_title',
			array(
				'label'		=> __( 'Cookies Notice: Title (Required Field)', 'halva' ),
				'section'	=> 'halva_cookies_section',
				'type'		=> 'text',
			)
		);


		// Cookies notice: Text (textarea)
		$wp_customize->add_setting(
			'halva_cookies_notice_text',
			array(
				'default'			=> 'Our website use cookies. If you continue to use this site we will assume that you are happy with this.',
				'sanitize_callback'	=> 'halva_sanitize_wp_kses_text',
			)
		);

		$wp_customize->add_control(
			'halva_cookies_notice_text',
			array(
				'label'		=> __( 'Cookies Notice: Text (Required Field)', 'halva' ),
				'section'	=> 'halva_cookies_section',
				'type'		=> 'textarea',
			)
		);


		// Text for notification about cookies: Allowed HTML tags (description)
		$wp_customize->add_setting(
			'halva_cookies_notice_text_desc',
			array(
				'default'			=> __( 'Add your text with information about the use of cookies on your site. You can use the following HTML tags: p, a, span, strong, b, em, i, br. The following attributes are allowed for these tags: "p - class", "a - href, title, target, class, rel", "span - class", "i - class".', 'halva' ),
				'sanitize_callback'	=> 'esc_html',
			)
		);

		$wp_customize->add_control(
			new halva_customize_control_description(
				$wp_customize,
				'halva_cookies_notice_text_desc',
				array(
					'label'		=> __( 'Cookies Notice Text: Allowed HTML Tags', 'halva' ),
					'section'	=> 'halva_cookies_section',
					'settings'	=> 'halva_cookies_notice_text_desc',
				)
			)
		);


		// Cookies notice: Button text (text field)
		$wp_customize->add_setting(
			'halva_cookies_notice_button_text',
			array(
				'default'			=> 'I Agree',
				'sanitize_callback'	=> 'esc_html',
			)
		);

		$wp_customize->add_control(
			'halva_cookies_notice_button_text',
			array(
				'label'		=> __( 'Cookies Notice: Button Text (Required Field)', 'halva' ),
				'section'	=> 'halva_cookies_section',
				'type'		=> 'text',
			)
		);

	}

}
add_action( 'customize_register', 'halva_customize_register' );
