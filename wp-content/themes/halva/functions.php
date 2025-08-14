<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

/**
 * TGM Plugin Activation
 *
 * @since Halva 1.0
 */
require_once get_theme_file_path( '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once get_theme_file_path( '/inc/tgm-plugin-activation/plugin-activation.php' );


/**
 * Set up the content width value
 *
 * @since Halva 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}


/**
 * Sets up theme defaults and registers support for various WordPress features
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_setup' ) ) {
	function halva_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'halva', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Register menus
		register_nav_menus( array(
			'halva_main_menu'	=> esc_html__( 'Main menu (Header)', 'halva' ),
			'halva_footer_menu'	=> esc_html__( 'Footer menu', 'halva' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'image',
			'gallery',
			'video',
			'audio',
			'aside',
			'link',
			'quote',
			'status',
			'chat',
		) );

		// Enable support for Custom logo
		add_theme_support( 'custom-logo', array(
			'height'		=> 38,
			'width'			=> 128,
			'flex-height'	=> true,
			'flex-width'	=> true,
		) );

		// Add styles for TinyMCE editor (editor-style.css and fonts)
		$editor_fonts_url = halva_google_fonts_url_for_editors();
		$editor_style_args = array(
			esc_url_raw( $editor_fonts_url ),
			'assets/css/editor-style.css',
		);
		add_theme_support( 'editor-styles' );
		add_editor_style( $editor_style_args );

		// Block editor: Add support for wide and full alignment
		add_theme_support( 'align-wide' );

		// Block editor: Add support for responsive embeds
		add_theme_support( 'responsive-embeds' );

		// Block editor: Add support for custom line height
		add_theme_support( 'custom-line-height' );

		// Block editor: New color palette (9 colors)
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'	=> esc_attr__( 'Black', 'halva' ),
				'slug'	=> 'black',
				'color'	=> '#000000',
			),
			array(
				'name'	=> esc_attr__( 'Light Gray', 'halva' ),
				'slug'	=> 'light-gray',
				'color'	=> '#8f8f9c',
			),
			array(
				'name'	=> esc_attr__( 'White', 'halva' ),
				'slug'	=> 'white',
				'color'	=> '#ffffff',
			),
			array(
				'name'	=> esc_attr__( 'Green', 'halva' ),
				'slug'	=> 'green',
				'color'	=> '#6fff80',
			),
			array(
				'name'	=> esc_attr__( 'Blue', 'halva' ),
				'slug'	=> 'blue',
				'color'	=> '#6f6fff',
			),
			array(
				'name'	=> esc_attr__( 'Purple', 'halva' ),
				'slug'	=> 'purple',
				'color'	=> '#ff6ff6',
			),
			array(
				'name'	=> esc_attr__( 'Red', 'halva' ),
				'slug'	=> 'red',
				'color'	=> '#ff6f89',
			),
			array(
				'name'	=> esc_attr__( 'Orange', 'halva' ),
				'slug'	=> 'orange',
				'color'	=> '#ffb06f',
			),
			array(
				'name'	=> esc_attr__( 'Yellow', 'halva' ),
				'slug'	=> 'yellow',
				'color'	=> '#fffb6f',
			),
		) );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1920, 1280, true ); // 1920x1280px, cropped (image size identifier = 'post-thumbnail')

		// New image sizes
		add_image_size( 'halva-200-200-crop', 200, 200, true ); // thumbnail for widgets (200x200px, cropped)
		add_image_size( 'halva-939-626-crop', 939, 626, true ); // thumbnail for related posts (939x626px, cropped)

	}
}
add_action( 'after_setup_theme', 'halva_setup' );


/**
 * The function returns the URL of all Google fonts that are used in this theme
 *
 * This theme uses Google fonts version 2
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_google_fonts_url' ) ) {
	function halva_google_fonts_url() {

		/*
		 * This theme uses sans-serif fonts by default.
		 *
		 * If switching between font types is enabled in the theme settings, then the theme loads sans-serif and serif fonts.
		 */
		$switch_between_font_types = get_theme_mod( 'halva_button_font_types', 0 ); // 1 or 0

		// Get fonts url:
		if ( $switch_between_font_types ) {

			/*
			 * Switching between font types is enabled in the theme settings, so we load sans-serif and serif fonts.
			 * We also load only those weights that are used in the theme.
			 *
			 * Sans-serif fonts:
			 * - Main font 1 (main content and metadata): Open Sans (styles: 400, 400 italic, 500, 700, 700 italic);
			 * - Main font 2 (headings h1...h6, main menu links, search form, etc.): Poppins (styles: 400, 500, 500 italic, 600, 600 italic);
			 * - Text logo: Alef (style: 700).
			 * Serif fonts:
			 * - Main font 1 (main content): Noto Serif (styles: 400, 400 italic, 500, 700, 700 italic);
			 * - Main font 2 (headings h1...h6, main menu links, search form, etc.): Lora (styles: 400, 400 italic, 600, 600 italic, 700, 700 italic);
			 * - Metadata: PT Serif (styles: 400, 700).
			 */
			$fonts_url = '//fonts.googleapis.com/css2?family=Alef:wght@700&family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Noto+Serif:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,500;0,700;1,400;1,700&family=PT+Serif:wght@400;700&family=Poppins:ital,wght@0,400;0,500;0,600;1,500;1,600&display=swap';

		} else {

			/*
			 * Switching between font types is disabled, so we load sans-serif or serif fonts depending on the selected fonts.
			 * We also load only those weights that are used in the theme.
			 */

			$default_font_type = get_theme_mod( 'halva_default_font_type', 'sans-serif' ); // sans-serif or serif
			if ( 'sans-serif' === $default_font_type ) {

				/*
				 * Sans-serif fonts:
				 * - Main font 1 (main content and metadata): Open Sans (styles: 400, 400 italic, 500, 700, 700 italic);
				 * - Main font 2 (headings h1...h6, main menu links, search form, etc.): Poppins (styles: 400, 500, 500 italic, 600, 600 italic);
				 * - Text logo: Alef (style: 700).
				 * Serif font for quotes:
				 * - Text for quotes: Lora (styles: 400, 400 italic, 700, 700 italic).
				 */
				$fonts_url = '//fonts.googleapis.com/css2?family=Alef:wght@700&family=Lora:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Poppins:ital,wght@0,400;0,500;0,600;1,500;1,600&display=swap';

			} else {

				/*
				 * Serif fonts:
				 * - Main font 1 (main content): Noto Serif (styles: 400, 400 italic, 500, 700, 700 italic);
				 * - Main font 2 (headings h1...h6, main menu links, search form, etc.): Lora (styles: 400, 400 italic, 600, 600 italic, 700, 700 italic);
				 * - Metadata: PT Serif (styles: 400, 700).
				 */
				$fonts_url = '//fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Noto+Serif:ital,wght@0,400;0,500;0,700;1,400;1,700&family=PT+Serif:wght@400;700&display=swap';

			}

		}

		// Return URL of fonts. This URL will be escaped right before use.
		return $fonts_url;

	}
}


/**
 * Enqueue styles for the block editor
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_block_assets' ) ) {
	function halva_block_assets() {
		// We need these styles only on the admin side:
		if ( is_admin() ) {

			// Google fonts
			$fonts_url = halva_google_fonts_url_for_editors();
			wp_enqueue_style( 'halva-block-editor-fonts', esc_url_raw( $fonts_url ), array(), null );

			// Styles for the editor
			wp_enqueue_style( 'halva-block-editor-style', get_template_directory_uri() . '/assets/css/block-editor-style.css', array(), '1.1.1' );

		}
	}
}
add_action( 'enqueue_block_assets', 'halva_block_assets' );


/**
 * Enqueue all styles and scripts for the theme
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_styles_scripts' ) ) {
	function halva_styles_scripts() {

		/**
		 * CSS Styles
		 */

		// Google fonts
		$fonts_url = halva_google_fonts_url();
		wp_enqueue_style( 'halva-fonts', esc_url_raw( $fonts_url ), array(), null );

		// bootstrap
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/lib/bootstrap/css/bootstrap.min.css', array(), '5.1.3' );

		// font awesome (note: the unique identifier is used to avoid compatibility issues with previous versions of icons in plugins)
		wp_enqueue_style( 'halva-font-awesome', get_template_directory_uri() . '/assets/lib/fontawesome/css/all.min.css', array(), '6.7.1' );

		// tiny-slider
		wp_enqueue_style( 'tiny-slider', get_template_directory_uri() . '/assets/lib/tiny-slider/tiny-slider.css', array(), '2.9.3' );

		// magnific popup
		wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/magnific-popup.css', array(), '1.1.0' );

		// main stylesheet
		wp_enqueue_style( 'halva-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.1.1' );

		/**
		 * CSS Styles: Dark mode and Serif fonts
		 */

		// dark mode
		$default_color_scheme = get_theme_mod( 'halva_default_color_mode', 'light' ); // light or dark
		$show_color_switch = get_theme_mod( 'halva_button_color_mode', 0 ); // 1 or 0
		if ( 'dark' === $default_color_scheme || $show_color_switch ) {
			wp_enqueue_style( 'halva-dark-mode', get_template_directory_uri() . '/assets/css/dark-mode.css', array(), '1.0.0' );
		}

		// serif fonts
		$default_font_type = get_theme_mod( 'halva_default_font_type', 'sans-serif' ); // sans-serif or serif
		$show_font_types = get_theme_mod( 'halva_button_font_types', 0 ); // 1 or 0
		if ( 'serif' === $default_font_type || $show_font_types ) {
			wp_enqueue_style( 'halva-serif-fonts', get_template_directory_uri() . '/assets/css/serif-fonts.css', array(), '1.0.0' );
		}

		/**
		 * Scripts
		 */

		// bootstrap
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/lib/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.1.3', true );

		// superfish (dropdown menu)
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/assets/lib/superfish/superfish.min.js', array( 'jquery' ), '1.7.10', true );

		// tiny-slider
		wp_enqueue_script( 'tiny-slider', get_template_directory_uri() . '/assets/lib/tiny-slider/min/tiny-slider.js', array(), '2.9.3', true );

		// masonry
		$enable_blog_layout_switching = get_theme_mod( 'halva_enable_blog_layout_switching', 1 ); // switching between layouts: enable (1) or disable (0)
		$default_blog_layout = get_theme_mod( 'halva_default_blog_layout', 'col-3' ); // default layout: one column (col-1) or three columns (col-3)
		if ( ! is_singular() && ( $enable_blog_layout_switching || 'col-3' === $default_blog_layout ) ) {
			wp_enqueue_script( 'jquery-masonry' );
		}

		// imagesLoaded
		if ( is_home() && ! $enable_blog_layout_switching && 'col-1' === $default_blog_layout ) {
			wp_enqueue_script( 'imagesloaded' );
		}

		// magnific popup
		wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );

		// halva theme js
		wp_enqueue_script( 'halva-theme', get_template_directory_uri() . '/assets/js/halva-theme.js', array( 'jquery' ), '1.1.0', true );

		// comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/**
		 * Data for the main script file (halva-theme.js; id: halva-theme)
		 */

		// page type: single page or not
		$is_singular_data = ( is_singular() ) ? 'true' : 'false';

		// logo type
		$logo_type_data = get_theme_mod( 'halva_logo_type', 'text' ); // text or image

		// hidden navigation: enable/disable
		$enable_hidden_nav = get_theme_mod( 'halva_enable_hidden_nav', 0 ); // 1 or 0
		$hidden_nav_data = ( $enable_hidden_nav ) ? 'enable' : 'disable';

		// hidden navigation: logo type
		$hidden_nav_logo_type_data = get_theme_mod( 'halva_hidden_nav_logo_type', 'text' ); // text or image

		// homepage carousel: carousel options
		// 1: rewind
		$homepage_carousel_enable_rewind = get_theme_mod( 'halva_carousel_enable_rewind', 1 ); // 1 or 0
		$homepage_carousel_rewind_data = ( $homepage_carousel_enable_rewind ) ? 'enable' : 'disable';
		// 2: carousel animation speed
		$homepage_carousel_speed_data = get_theme_mod( 'halva_carousel_animation_speed', 500 );
		if ( '' === $homepage_carousel_speed_data ) {
			$homepage_carousel_speed_data = 500;
		}
		// 3: navigation buttons (next/previous)
		$homepage_carousel_show_controls = get_theme_mod( 'halva_carousel_show_controls', 1 ); // 1 or 0
		$homepage_carousel_controls_data = ( $homepage_carousel_show_controls ) ? 'show' : 'hide';
		// 4: pagination (dots)
		$homepage_carousel_show_nav = get_theme_mod( 'halva_carousel_show_nav', 1 ); // 1 or 0
		$homepage_carousel_nav_data = ( $homepage_carousel_show_nav ) ? 'show' : 'hide';

		// switching between layouts: enable/disable
		$switch_blog_layout_data = ( $enable_blog_layout_switching ) ? 'enable' : 'disable';

		// horizontal order for blog posts: enable/disable
		$enable_posts_horizontal_order = get_theme_mod( 'halva_enable_posts_horizontal_order', 0 ); // 1 or 0
		$posts_horizontal_order_data = ( $enable_posts_horizontal_order ) ? 'enable' : 'disable';

		// gallery format: slider options
		// 1: rewind
		$gallery_slider_enable_rewind = get_theme_mod( 'halva_gallery_slider_enable_rewind', 1 ); // 1 or 0
		$gallery_slider_rewind_data = ( $gallery_slider_enable_rewind ) ? 'enable' : 'disable';
		// 2: transition type for slides
		$gallery_slider_transition_data = get_theme_mod( 'halva_gallery_slider_transition_type', 'slide_horizontal' ); // fade or slide_horizontal
		// 3: speed of the slide animation
		$gallery_slider_speed_data = get_theme_mod( 'halva_gallery_slider_animation_speed', 500 );
		if ( '' === $gallery_slider_speed_data ) {
			$gallery_slider_speed_data = 500;
		}

		// color mode switching functionality: enable/disable
		$switch_color_mode_data = ( $show_color_switch ) ? 'enable' : 'disable';

		// functionality for changing fonts: enable/disable
		$switch_fonts_data = ( $show_font_types ) ? 'enable' : 'disable';

		// dropdown search form: enable/disable
		$show_search = get_theme_mod( 'halva_button_show_search', 1 ); // 1 or 0
		$dropdown_search_data = ( $show_search ) ? 'enable' : 'disable';

		// button: back to top: enable/disable
		$show_back_to_top = get_theme_mod( 'halva_button_back_to_top', 1 ); // 1 or 0
		$back_to_top_data = ( $show_back_to_top ) ? 'enable' : 'disable';

		// cookies: enable/disable
		$blog_layout_cookie_data = ( get_theme_mod( 'halva_cookie_for_blog_layout', 1 ) ) ? 'enable' : 'disable';
		$color_mode_cookie_data = ( get_theme_mod( 'halva_cookie_for_color_scheme', 1 ) ) ? 'enable' : 'disable';
		$fonts_cookie_data = ( get_theme_mod( 'halva_cookie_for_font_type', 1 ) ) ? 'enable' : 'disable';

		// data array
		$halva_data_array = array(
			'isSingular'				=> $is_singular_data,
			'logoType'					=> $logo_type_data,
			'hiddenNav'					=> $hidden_nav_data,
			'navLogoType'				=> $hidden_nav_logo_type_data,
			'homepageCarouselRewind'	=> $homepage_carousel_rewind_data,
			'homepageCarouselSpeed'		=> $homepage_carousel_speed_data,
			'homepageCarouselControls'	=> $homepage_carousel_controls_data,
			'homepageCarouselNav'		=> $homepage_carousel_nav_data,
			'switchBlogLayout'			=> $switch_blog_layout_data,
			'postsHorizontalOrder'		=> $posts_horizontal_order_data,
			'defaultBlogLayout'			=> $default_blog_layout,
			'gallerySliderRewind'		=> $gallery_slider_rewind_data,
			'gallerySliderTransition'	=> $gallery_slider_transition_data,
			'gallerySliderSpeed'		=> $gallery_slider_speed_data,
			'switchColorMode'			=> $switch_color_mode_data,
			'switchFonts'				=> $switch_fonts_data,
			'dropdownSearch'			=> $dropdown_search_data,
			'backToTop'					=> $back_to_top_data,
			'blogLayoutCookie'			=> $blog_layout_cookie_data,
			'colorModeCookie'			=> $color_mode_cookie_data,
			'fontsCookie'				=> $fonts_cookie_data,
		);
		// add this data to the main script file (halva-theme.js; id: halva-theme)
		wp_localize_script( 'halva-theme', 'halvaData', $halva_data_array );

	}
}
add_action( 'wp_enqueue_scripts', 'halva_styles_scripts' );


/**
 * Enqueue styles for the WordPress customizer (Admin side)
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_customizer_styles' ) ) {
	function halva_customizer_styles() {
		// customizer style
		wp_enqueue_style( 'halva-customizer-style', get_template_directory_uri() . '/assets/css/customizer-style.css', array(), '1.0.0' );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'halva_customizer_styles' );


/**
 * Enqueue scripts for the block editor (Admin side)
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_block_editor_assets' ) ) {
	function halva_block_editor_assets() {
		// show/hide meta boxes
		wp_enqueue_script( 'halva-block-editor-meta-boxes', get_template_directory_uri() . '/assets/js/halva-block-editor-meta-boxes.js', array( 'jquery' ), '1.0.0', true );
	}
}
add_action( 'enqueue_block_editor_assets', 'halva_block_editor_assets' );


/**
 * Enqueue scripts for post editors (Classic editor and Block editor; Admin side)
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_admin_scripts' ) ) {
	function halva_admin_scripts( $hook ) {
		// add scripts only to the post creation/editing page
		if ( 'post-new.php' !== $hook && 'post.php' !== $hook ) {
			return; // stop the function
		}
		// meta boxes
		wp_enqueue_script( 'halva-meta-boxes', get_template_directory_uri() . '/assets/js/halva-meta-boxes.js', array( 'jquery' ), '1.0.0', true );
	}
}
add_action( 'admin_enqueue_scripts', 'halva_admin_scripts' );


/**
 * Google fonts for WordPress editors (Classic editor and Block editor)
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_google_fonts_url_for_editors' ) ) {
	function halva_google_fonts_url_for_editors() {

		/*
		 * The Classic Editor and the Block Editor use sans-serif fonts.
		 * We also load only those weights that are used in the editors.
		 * The following fonts are used:
		 * - Open Sans (styles: 400, 400 italic, 500, 700, 700 italic)
		 * - Poppins (styles: 400, 500, 500 italic, 600, 600 italic)
		 * - Lora (styles: 400, 400 italic, 700, 700 italic)
		 */
		return 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Poppins:ital,wght@0,400;0,500;0,600;1,500;1,600&display=swap';

	}
}


/**
 * Add preconnect for Google Fonts
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_resource_hints' ) ) {
	function halva_resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'halva-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
				$urls[] = '//fonts.googleapis.com';
				$urls[] = array(
					'href' => '//fonts.gstatic.com',
					'crossorigin',
				);
			} else {
				$urls[] = '//fonts.googleapis.com';
				$urls[] = '//fonts.gstatic.com';
			}
		}

		return $urls;
	}
}
add_filter( 'wp_resource_hints', 'halva_resource_hints', 10, 2 );


/**
 * The function adds the wp_body_open action for backward compatibility to support WordPress versions prior to 5.2
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		// Triggered after the opening "body" tag
		do_action( 'wp_body_open' );
	}
}


/**
 * The function registers areas for widgets
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_widgets_init' ) ) {
	function halva_widgets_init() {

		// Hidden sidebar (this sidebar is located in a hidden container on the right side)
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar', 'halva' ),
			'id'			=> 'halva_sidebar',
			'description'	=> esc_html__( 'Add widgets here to appear in your hidden sidebar. This area for widgets is located in a hidden container on the right.', 'halva' ),
			'before_widget'	=> '<div id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

		// Footer column 1 (left column)
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer: Left Column', 'halva' ),
			'id'			=> 'halva_footer_sidebar_left',
			'description'	=> esc_html__( 'Add widgets here to appear in your footer (column 1: left column).', 'halva' ),
			'before_widget'	=> '<div id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

		// Footer column 2 (center column)
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer: Center Column', 'halva' ),
			'id'			=> 'halva_footer_sidebar_center',
			'description'	=> esc_html__( 'Add widgets here to appear in your footer (column 2: center column).', 'halva' ),
			'before_widget'	=> '<div id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

		// Footer column 3 (right column)
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer: Right Column', 'halva' ),
			'id'			=> 'halva_footer_sidebar_right',
			'description'	=> esc_html__( 'Add widgets here to appear in your footer (column 3: right column).', 'halva' ),
			'before_widget'	=> '<div id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

	}
}
add_action( 'widgets_init', 'halva_widgets_init' );


/**
 * The function returns the current color scheme: dark or light
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_get_current_color_scheme' ) ) {
	function halva_get_current_color_scheme() {
		// default color scheme
		$default_color_scheme = get_theme_mod( 'halva_default_color_mode', 'light' ); // light or dark

		// get color scheme from cookie (* if cookies and color switch are enabled)
		$cookie_for_color_scheme = get_theme_mod( 'halva_cookie_for_color_scheme', 1 ); // 1 or 0
		$show_color_switch = get_theme_mod( 'halva_button_color_mode', 0 ); // 1 or 0
		if ( $cookie_for_color_scheme && $show_color_switch ) {
			$current_color_scheme = ( ! empty( $_COOKIE['halva_color_scheme'] ) ) ? $_COOKIE['halva_color_scheme'] : $default_color_scheme;
			return $current_color_scheme; // light or dark
		}

		// if there is no result, then return the default color scheme
		return $default_color_scheme;
	}
}


/**
 * The function returns the current font type: sans-serif or serif
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_get_current_font_type' ) ) {
	function halva_get_current_font_type() {
		// default font type
		$default_font_type = get_theme_mod( 'halva_default_font_type', 'sans-serif' ); // sans-serif or serif

		// get font type from cookie (* if cookies and font switching are enabled)
		$cookie_for_font_type = get_theme_mod( 'halva_cookie_for_font_type', 1 ); // 1 or 0
		$show_font_types = get_theme_mod( 'halva_button_font_types', 0 ); // 1 or 0
		if ( $cookie_for_font_type && $show_font_types ) {
			$current_font_type = ( ! empty( $_COOKIE['halva_font_type'] ) ) ? $_COOKIE['halva_font_type'] : $default_font_type;
			return $current_font_type; // sans-serif or serif
		}

		// if there is no result, then return the default font type
		return $default_font_type;
	}
}


/**
 * The function returns the current blog layout: one column or three columns
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_get_current_blog_layout' ) ) {
	function halva_get_current_blog_layout() {
		// default blog layout
		$default_blog_layout = get_theme_mod( 'halva_default_blog_layout', 'col-3' );

		// get blog layout from cookie (* if cookies and layout switches are enabled)
		$cookie_for_blog_layout = get_theme_mod( 'halva_cookie_for_blog_layout', 1 ); // 1 or 0
		$show_layout_switches = get_theme_mod( 'halva_enable_blog_layout_switching', 1 ); // 1 or 0
		if ( $cookie_for_blog_layout && $show_layout_switches ) {
			$current_blog_layout = ( ! empty( $_COOKIE['halva_blog_layout'] ) ) ? $_COOKIE['halva_blog_layout'] : $default_blog_layout;
			return $current_blog_layout; // col-1 or col-3
		}

		// if there is no result, then return the default layout
		return $default_blog_layout; // col-1 or col-3
	}
}


/**
 * The function adds additional classes to the "body" element
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_custom_body_classes' ) ) {
	function halva_custom_body_classes( $classes ) {
		// add additional classes:
		$classes[] = 'bwp-body';
		if ( 'dark' === halva_get_current_color_scheme() ) {
			// dark mode
			$classes[] = 'bwp-dark-mode';
		}
		if ( 'serif' === halva_get_current_font_type() ) {
			// serif fonts
			$classes[] = 'bwp-serif-fonts';
		}
		if ( is_singular() ) {
			// for single pages
			$classes[] = 'bwp-singular';
		} else {
			// for pages with posts (homepage and archives)
			$classes[] = 'bwp-page-with-posts';
		}
		if ( ! has_nav_menu( 'halva_main_menu' ) && ! halva_nav_social_links( 'return' ) && ! halva_nav_subscribe_link( 'return' ) ) {
			// the class hides the secondary navigation
			$classes[] = 'bwp-hide-secondary-nav';
		}

		// return classes
		return $classes;
	}
}
add_filter( 'body_class', 'halva_custom_body_classes' );


/**
 * The function adds additional classes to posts
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_custom_post_classes' ) ) {
	function halva_custom_post_classes( $classes, $class, $post_id ) {
		// get post format
		$blog_post_format = get_post_format( $post_id );
		if ( false === $blog_post_format ) {
			$blog_post_format = 'standard';
		}
		// add additional classes
		if ( ! is_singular() ) {
			// add additional CSS classes for posts on archive pages
			$classes[] = 'bwp-blog-post';
			$classes[] = 'bwp-masonry-item';
			$classes[] = ( 'col-3' === halva_get_current_blog_layout() ) ? 'bwp-col-3' : 'bwp-col-1';
			// featured media (featured image, gallery, video, etc)
			if ( ! halva_post_has_featured_media( $post_id, $blog_post_format ) ) {
				$classes[] = 'bwp-no-featured-media';
			}
			// post title
			$classes[] = ( get_the_title( $post_id ) ) ? 'bwp-post-has-title' : 'bwp-post-has-no-title';
		} else {
			// add additional CSS classes for single posts and pages
			if ( is_single( $post_id ) ) {
				// single post page
				$classes[] = 'bwp-single-post-article';
				// featured media (featured image, gallery, video, etc)
				if ( ! halva_post_has_featured_media( $post_id, $blog_post_format ) ) {
					$classes[] = 'bwp-no-featured-media';
				}
				// post title
				$classes[] = ( get_the_title( $post_id ) ) ? 'bwp-post-has-title' : 'bwp-post-has-no-title';
			} elseif ( is_page( $post_id ) ) {
				// single page
				$classes[] = 'bwp-single-post-article';
				$classes[] = 'bwp-page-article';
				// featured image
				if ( ! halva_post_has_featured_media( $post_id, 'standard' ) ) {
					$classes[] = 'bwp-no-featured-media';
				}
				// page title
				$classes[] = ( get_the_title( $post_id ) ) ? 'bwp-post-has-title' : 'bwp-post-has-no-title';
			}
		}

		// return classes
		return $classes;
	}
}
add_filter( 'post_class', 'halva_custom_post_classes', 10, 3 );


/**
 * Change excerpt length
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_new_excerpt_length' ) ) {
	function halva_new_excerpt_length( $length ) {
		$new_excerpt_length = get_theme_mod( 'halva_post_excerpt_length', 30 );

		if ( $new_excerpt_length ) {
			$new_excerpt_length = intval( $new_excerpt_length );
		} else {
			$new_excerpt_length = 30; // default value
		}

		return $new_excerpt_length;
	}
}
add_filter( 'excerpt_length', 'halva_new_excerpt_length' );


/**
 * The function returns the URL from the post content
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_get_link_url' ) ) {
	function halva_get_link_url() {
		$has_url = get_url_in_content( get_the_content() );
		return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}
}


/**
 * The function returns true if the post has one of the following attachments: featured image, gallery, video, or audio. Otherwise, the function returns false.
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_post_has_featured_media' ) ) {
	function halva_post_has_featured_media( $blog_post_id, $blog_post_format ) {

		// gallery format
		if ( 'gallery' === $blog_post_format ) {

			// thumbnail type
			$gallery_thumb_type = get_post_meta( $blog_post_id, 'halva_mb_gallery_thumb_type', true ); // 'featured_image' or 'slider'
			if ( ! $gallery_thumb_type ) {
				$gallery_thumb_type = 'slider'; // default value
			}

			// thumbnail type = featured image
			if ( 'featured_image' === $gallery_thumb_type ) {

				// if the post has a featured image
				if ( has_post_thumbnail( $blog_post_id ) ) {
					return true;
				} else {
					return false;
				}

			} else {
				// thumbnail type = slider

				// slider: image IDs
				$gallery_images_id = get_post_meta( $blog_post_id, 'halva_mb_gallery', false );
				if ( ! is_array( $gallery_images_id ) ) {
					$gallery_images_id = (array) $gallery_images_id;
				}

				// if $gallery_images_id is not empty
				if ( ! empty( $gallery_images_id ) && $gallery_images_id[0] ) {
					return true;
				} else {
					return false;
				}

			}

		} elseif ( 'video' === $blog_post_format ) {
			// video format

			// thumbnail type
			$video_thumb_type = get_post_meta( $blog_post_id, 'halva_mb_video_thumb_type', true ); // 'iframe' or 'featured_image'
			if ( ! $video_thumb_type ) {
				$video_thumb_type = 'iframe'; // default value
			}

			// thumbnail type = featured image
			if ( 'featured_image' === $video_thumb_type ) {

				// if the post has a featured image
				if ( has_post_thumbnail( $blog_post_id ) ) {
					return true;
				} else {
					return false;
				}

			} else {
				// thumbnail type = iframe

				// video URL
				$video_url = get_post_meta( $blog_post_id, 'halva_mb_video_url', true );

				// if $video_url is not empty
				if ( '' !== $video_url ) {
					return true;
				} else {
					return false;
				}

			}

		} elseif ( 'audio' === $blog_post_format ) {
			// audio format

			// thumbnail type
			$audio_thumb_type = get_post_meta( $blog_post_id, 'halva_mb_audio_thumb_type', true ); // 'iframe' or 'featured_image'
			if ( ! $audio_thumb_type ) {
				$audio_thumb_type = 'iframe'; // default value
			}

			// thumbnail type = featured image
			if ( 'featured_image' === $audio_thumb_type ) {

				// if the post has a featured image
				if ( has_post_thumbnail( $blog_post_id ) ) {
					return true;
				} else {
					return false;
				}

			} else {
				// thumbnail type = iframe

				// audio URL
				$audio_url = get_post_meta( $blog_post_id, 'halva_mb_audio_url', true );

				// if $audio_url is not empty
				if ( '' !== $audio_url ) {
					return true;
				} else {
					return false;
				}

			}

		} else {
			// other formats

			if ( has_post_thumbnail( $blog_post_id ) ) {
				return true;
			} else {
				return false;
			}

		}

	}
}


/**
 * The function displays the main logo (image or text)
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_main_logo' ) ) {
	function halva_show_main_logo() {
		// logo type: text or image
		$logo_type = get_theme_mod( 'halva_logo_type', 'text' );
		if ( 'text' === $logo_type ) {
			// logo type: text

			// text for logo
			$logo_text = get_theme_mod( 'halva_logo_text', 'Halva' );
			if ( '' !== $logo_text ) {
				// show text logo
				?>

				<!-- main logo (text) -->
				<div class="bwp-logo-container bwp-logo-text-container bwp-hover-link-animation">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-logo-text"><?php echo esc_html( $logo_text ); ?></a>
				</div>
				<!-- end: main logo -->

				<?php
			}

		} else {
			// logo type: image

			if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
				// logo for light mode (default logo)
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
				// logo for dark mode
				$dark_mode_logo_url = get_theme_mod( 'halva_dark_mode_logo_image' );
				// logo: alt text
				$custom_logo_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
				// get current color scheme
				$current_color_scheme = halva_get_current_color_scheme(); // light or dark
				?>

				<!-- main logo (image) -->
				<div id="bwp-custom-logo" class="bwp-logo-container bwp-logo-image-container"
					 data-logo-url="<?php echo esc_url( $custom_logo_url ); ?>"
					 data-dark-mode-logo-url="<?php if ( $dark_mode_logo_url ) { echo esc_url( $dark_mode_logo_url ); } else { echo 'none'; } ?>"
					 data-logo-alt="<?php if ( $custom_logo_alt ) { echo esc_attr( $custom_logo_alt ); } else { echo esc_attr( get_bloginfo( 'name' ) ); } ?>">

					<?php
					if ( 'dark' === $current_color_scheme && $dark_mode_logo_url ) {
						// show logo for dark mode
						?>

						<!-- image (dark mode) -->
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" aria-current="page">
							<img src="<?php echo esc_url( $dark_mode_logo_url ); ?>" class="custom-logo" alt="<?php if ( $custom_logo_alt ) { echo esc_attr( $custom_logo_alt ); } else { echo esc_attr( get_bloginfo( 'name' ) ); } ?>">
						</a>
						<!-- end: image -->

						<?php
					} else {
						// show logo
						the_custom_logo();
					}
					?>

				</div>
				<!-- end: main logo -->

				<?php
			} else {
				// if there is no logo, then output an empty block (only for JavaScript needs)
				?>

				<!-- logo (empty block) -->
				<div id="bwp-custom-logo" class="bwp-logo-container bwp-no-logo-image" data-logo-url="none" data-dark-mode-logo-url="none" data-logo-alt="none"></div>
				<!-- end: logo (empty block) -->

				<?php
			}

		} // end: logo type
	}
}


/**
 * The function displays the logo in the hidden navigation (image or text)
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_hidden_nav_logo' ) ) {
	function halva_show_hidden_nav_logo() {
		// logo type: text or image
		$hidden_nav_logo_type = get_theme_mod( 'halva_hidden_nav_logo_type', 'text' );
		if ( 'text' === $hidden_nav_logo_type ) {
			// logo type: text

			// text for logo
			$hidden_nav_logo_text = get_theme_mod( 'halva_hidden_nav_logo_text', 'Halva.' );
			if ( '' !== $hidden_nav_logo_text ) {
				// show text logo
				?>

				<!-- logo (text) -->
				<div class="bwp-main-nav-logo bwp-hover-link-animation">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-main-nav-logo-text"><?php echo esc_html( $hidden_nav_logo_text ); ?></a>
				</div>
				<!-- end: logo -->

				<?php
			}

		} else {
			// logo type: image

			// logo url
			$hidden_nav_logo_url = get_theme_mod( 'halva_hidden_nav_logo_image' );
			if ( $hidden_nav_logo_url ) {
				// logo for dark mode
				$hidden_nav_dark_mode_logo_url = get_theme_mod( 'halva_hidden_nav_dark_mode_logo_image' );
				// logo: alt text
				$hidden_nav_logo_alt = get_bloginfo( 'name' );
				// get current color scheme
				$current_color_scheme = halva_get_current_color_scheme(); // light or dark
				?>

				<!-- logo (image) -->
				<div id="bwp-nav-logo" class="bwp-main-nav-logo"
					 data-logo-url="<?php echo esc_url( $hidden_nav_logo_url ); ?>"
					 data-dark-mode-logo-url="<?php if ( $hidden_nav_dark_mode_logo_url ) { echo esc_url( $hidden_nav_dark_mode_logo_url ); } else { echo 'none'; } ?>"
					 data-logo-alt="<?php echo esc_attr( $hidden_nav_logo_alt ); ?>">

					<?php
					if ( 'dark' === $current_color_scheme && $hidden_nav_dark_mode_logo_url ) {
						// show logo for dark mode
						?>

						<!-- image (dark mode) -->
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-main-nav-logo-image">
							<img src="<?php echo esc_url( $hidden_nav_dark_mode_logo_url ); ?>" alt="<?php echo esc_attr( $hidden_nav_logo_alt ); ?>">
						</a>
						<!-- end: image -->

						<?php
					} else {
						// show logo
						?>

						<!-- image -->
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-main-nav-logo-image">
							<img src="<?php echo esc_url( $hidden_nav_logo_url ); ?>" alt="<?php echo esc_attr( $hidden_nav_logo_alt ); ?>">
						</a>
						<!-- end: image -->

						<?php
					}
					?>

				</div>
				<!-- end: logo -->

				<?php
			} else {
				// if there is no logo, then output an empty block (only for JavaScript needs)
				?>

				<!-- logo (empty block) -->
				<div id="bwp-nav-logo" class="bwp-main-nav-logo" data-logo-url="none" data-dark-mode-logo-url="none" data-logo-alt="none"></div>
				<!-- end: logo (empty block) -->

				<?php
			}

		} // end: logo type
	}
}


/**
 * The function displays the main menu
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_main_menu' ) ) {
	function halva_show_main_menu() {
		if ( has_nav_menu( 'halva_main_menu' ) ) {
			// show main menu
			wp_nav_menu( array(
				'theme_location'	=> 'halva_main_menu',
				'container'			=> '',
				'menu_class'		=> 'bwp-main-menu sf-menu',
			) );
		}
	}
}


/**
 * The function displays social links in the main navigation
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_nav_social_links' ) ) {
	function halva_nav_social_links( $action = 'show' ) {
		// type of social links: preset links or html code
		$display_social_links_html = get_theme_mod( 'halva_display_nav_social_links_html', 0 ); // 1 or 0
		if ( $display_social_links_html ) {
			// display social links in HTML code format:

			// social links (html code)
			$social_links_html = get_theme_mod( 'halva_nav_social_links_html', '' );

			// action: return (true or false)
			if ( 'return' === $action ) {
				return '' !== $social_links_html; // true - social links available; false - no social links
			}

			// action: show
			if ( 'show' === $action && '' !== $social_links_html ) {
				?>

				<!-- social links (html) -->
				<div class="bwp-social-links bwp-hover-link-animation clearfix">
					<span class="bwp-social-links-label"><?php esc_html_e( 'Follow:', 'halva' ); ?></span>

					<?php
					// show social links (html code)
					echo wp_kses( $social_links_html, array(
						'a'			=> array(
							'href'		=> array(),
							'title'		=> array(),
							'target'	=> array(),
							'class'		=> array(),
							'rel'		=> array(),
						),
						'span'		=> array(
							'class'		=> array(),
						),
						'i'			=> array(
							'class'		=> array(),
						),
					) );
					?>

				</div>
				<!-- end: social links -->

				<?php
			}

		} else {
			// display preset social links:

			// social URLs
			$social_urls = array();
			$social_list = array(
				'x-twitter',
				'facebook-f',
				'pinterest-p',
				'telegram-plane',
				'reddit-alien',
				'tiktok',
				'vk',
				'linkedin-in',
				'paypal',
				'patreon',
				'flickr',
				'instagram',
				'youtube',
				'vimeo-v',
				'soundcloud',
				'dribbble',
				'behance',
				'github',
				'rss',
			);
			foreach ( $social_list as $social_list_value ) {
				$social_urls[ $social_list_value ] = get_theme_mod( 'halva_nav_social_' . $social_list_value );
			}

			// check $social_urls
			$social_urls_empty = true;
			foreach ( $social_urls as $social_url_key => $social_url_value ) {
				if ( $social_url_value ) {
					$social_urls_empty = false;
					break;
				}
			}

			// action: return (true or false)
			if ( 'return' === $action ) {
				return ! $social_urls_empty; // true - social links available; false - no social links
			}

			// action: show
			if ( 'show' === $action && ! $social_urls_empty ) {
				?>

				<!-- social links (preset) -->
				<div class="bwp-social-links bwp-hover-link-animation clearfix">
					<span class="bwp-social-links-label"><?php esc_html_e( 'Follow:', 'halva' ); ?></span>

					<?php
					foreach ( $social_urls as $social_url_key => $social_url_value ) {
						if ( $social_url_value ) {
							if ( 'rss' !== $social_url_key ) {
								// show social link
								echo '<a href="' . esc_url( $social_url_value ) . '" target="_blank" class="bwp-social-link-' . esc_attr( $social_url_key ) . '" rel="noopener noreferrer"><i class="fa-brands fa-' . esc_attr( $social_url_key ) . '"></i></a>';
							} else {
								// show rss link
								echo '<a href="' . esc_url( $social_url_value ) . '" target="_blank" class="bwp-social-link-rss" rel="noopener noreferrer"><i class="fa-solid fa-rss"></i></a>';
							}
						}
					}
					?>

				</div>
				<!-- end: social links -->

				<?php
			}

		}
	}
}


/**
 * The function displays the subscription link
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_nav_subscribe_link' ) ) {
	function halva_nav_subscribe_link( $action = 'show' ) {
		// link url
		$subscribe_url = get_theme_mod( 'halva_nav_subscribe_url', '' );
		// link text
		$subscribe_text = get_theme_mod( 'halva_nav_subscribe_text', 'Subscribe' );

		// action: return (true or false)
		if ( 'return' === $action ) {
			return '' !== $subscribe_url && '' !== $subscribe_text; // true - subscription link available; false - no link
		}

		// action: show
		if ( 'show' === $action && '' !== $subscribe_url && '' !== $subscribe_text ) {
			?>

			<!-- subscribe -->
			<div class="bwp-subscribe">
				<a href="<?php echo esc_url( $subscribe_url ); ?>" target="_blank" rel="noopener noreferrer" class="bwp-subscribe-link">
					<i class="fa-solid fa-at"></i><?php echo esc_html( $subscribe_text ); ?>
				</a>
			</div>
			<!-- end: subscribe -->

			<?php
		}
	}
}


/**
 * The function displays a title with a description for each archive page
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_archive_header' ) ) {
	function halva_show_archive_header() {
		// 1: Author page.
		if ( is_author() ) {
			?>

			<!-- author page: title and subtitle -->
			<header class="bwp-archive-header">
				<h2 class="bwp-archive-title bwp-author-page-title"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h2>
				<?php if ( get_the_author_meta( 'description' ) ) { ?>
					<div class="bwp-archive-description"><?php the_author_meta( 'description' ); ?></div>
				<?php } ?>
			</header>
			<!-- end: title and subtitle -->

			<?php
			// end: author page; start: category or tag page
		} elseif ( is_category() || is_tag() ) {
			// 2: Category/Tag page.
			?>

			<!-- category/tag page: title and subtitle -->
			<header class="bwp-archive-header">
				<h2 class="bwp-archive-title bwp-category-tag-title">
					<?php
					// category or tag name
					if ( is_category() ) {
						// show category title
						single_cat_title( '<span class="bwp-category-title-prefix">' . esc_html__( 'Category:', 'halva' ) . '</span>' );
					} elseif ( is_tag() ) {
						// show tag title
						single_tag_title( '<span class="bwp-tag-title-prefix">' . esc_html__( 'Tag: #', 'halva' ) . '</span>' );
					}
					?>
				</h2>
				<?php if ( get_the_archive_description() ) { ?>
					<div class="bwp-archive-description"><?php the_archive_description(); ?></div>
				<?php } ?>
			</header>
			<!-- end: title and subtitle -->

			<?php
			// end: category/tag page; start: search results page
		} elseif ( is_search() ) {
			// 3: Search results page.
			// the number of found posts
			global $wp_query;
			$search_results_number_escaped = (int) $wp_query->found_posts; // this variable has been safely escaped
			?>

			<!-- search results page: title and subtitle -->
			<header class="bwp-archive-header">
				<h2 class="bwp-archive-title bwp-search-results-page-title">
					<?php echo esc_html__( 'Search results for:', 'halva' ) . ' <span class="bwp-search-query-text">' . esc_html( get_search_query() ) . '</span>'; ?>
				</h2>
				<?php if ( 0 !== $search_results_number_escaped ) { ?>
					<div class="bwp-archive-description">
						<?php echo esc_html__( 'Total posts and pages found:', 'halva' ) . ' <span class="bwp-search-results-number">' . $search_results_number_escaped . '</span>'; ?>
					</div>
				<?php } ?>
			</header>
			<!-- end: title and subtitle -->

			<?php
			// end: search results page; start: archive page
		} elseif ( is_archive() ) {
			// 4: Archive page.
			?>

			<!-- archive page title -->
			<header class="bwp-archive-header">
				<h2 class="bwp-archive-title"><?php the_archive_title(); ?></h2>
			</header>
			<!-- end: archive page title -->

			<?php
			// end: archive page; start: other pages
		} else {
			?>

			<h2 class="screen-reader-text">
				<?php esc_html_e( 'Latest posts', 'halva' ); ?>
			</h2>

			<?php
		}
	}
}


/**
 * The function displays the top bar with page numbers and layout switches
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_blog_top_bar' ) ) {
	function halva_show_blog_top_bar() {
		// page numbers
		$show_page_numbers = false;
		$show_page_numbers_opt = get_theme_mod( 'halva_posts_show_page_numbers', 1 ); // 1 or 0
		if ( $show_page_numbers_opt ) {
			// get the maximum number of pages
			global $wp_query;
			$total_pages = $wp_query->max_num_pages;
			if ( $total_pages > 1 ) {
				// get the current page number
				$current_page_number = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				// show page numbers
				$show_page_numbers = true;
			}
		}

		// layout switches: show/hide
		$show_layout_switches = get_theme_mod( 'halva_enable_blog_layout_switching', 1 ); // 1 or 0

		if ( $show_page_numbers || $show_layout_switches ) {
			?>

			<!-- top bar: layout options and additional information -->
			<div id="bwp-options-for-latest-posts">
				<div class="bwp-central-block clearfix">

					<?php
					// 1. Page numbers:
					if ( $show_page_numbers ) {
						?>

						<!-- page numbers -->
						<div class="bwp-page-numbers">
							<?php echo esc_html__( 'Page №', 'halva' ) . (int) $current_page_number . ' ' . esc_html__( 'of', 'halva' ) . ' ' . (int) $total_pages; ?>
						</div>
						<span class="bwp-separator"></span>
						<!-- end: page numbers -->

						<?php
					}

					// 2. Layout switches (two layout options: one column or three columns):
					if ( $show_layout_switches ) {
						// get current blog layout
						$current_blog_layout = halva_get_current_blog_layout(); // col-1 or col-3
						?>

						<!-- layout options -->
						<div class="bwp-layout-options clearfix">
							<span class="bwp-layout-options-label"><?php esc_html_e( 'View:', 'halva' ); ?></span>
							<button type="button" class="bwp-button bwp-toggle-layout<?php if ( 'col-1' === $current_blog_layout ) { echo ' bwp-active'; } ?>" data-blog-layout="col-1">
								<i class="fa-solid fa-list-ol"></i>
							</button>
							<button type="button" class="bwp-button bwp-toggle-layout<?php if ( 'col-3' === $current_blog_layout ) { echo ' bwp-active'; } ?>" data-blog-layout="col-3">
								<i class="fa-solid fa-table-cells"></i>
							</button>
						</div>
						<span class="bwp-separator"></span>
						<!-- end: layout options -->

						<?php
					}
					?>

				</div>
			</div>
			<!-- end: top bar -->

			<?php
		}
	}
}


/**
 * The function displays post metadata on a single page
 *
 * Single post page: publication date (with link), post update date, author, views, and comments counter
 * Page: publication date (no link), post update date, author, views, and comments counter
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_single_post_metadata' ) ) {
	function halva_show_single_post_metadata( $post_type = 'post', $is_password_protected = false ) {
		if ( 'post' === $post_type ) {
			// Single post page: Metadata display settings
			// publication date
			$show_publication_date = get_theme_mod( 'halva_single_show_publication_date', 1 ); // 1 or 0
			// update date
			$show_post_update_date_opt = get_theme_mod( 'halva_single_show_update_date', 0 ); // 1 or 0
			$show_post_update_date = $show_post_update_date_opt && ( get_the_modified_time( 'F j, Y' ) !== get_the_time( 'F j, Y' ) ); // true or false
			// author
			$show_author = get_theme_mod( 'halva_single_show_author', 1 ); // 1 or 0
			// views counter
			$show_views_opt = get_theme_mod( 'halva_single_show_views_counter', 1 ); // 1 or 0
			$show_views = function_exists( 'halva_additional_features_show_views_counter' ) && $show_views_opt; // true or false
			// comments counter
			$show_comments_counter_opt = get_theme_mod( 'halva_single_show_comments_counter', 1 ); // 1 or 0
			$show_comments_counter = $show_comments_counter_opt && ( comments_open() || get_comments_number() ); // true or false
			// metadata: show or hide
			$show_metadata = $show_publication_date || $show_post_update_date || $show_author || $show_views || $show_comments_counter; // true or false
		} else {
			// Page: Metadata display settings
			// publication date
			$show_publication_date = get_theme_mod( 'halva_page_show_publication_date', 1 ); // 1 or 0
			// update date
			$show_post_update_date_opt = get_theme_mod( 'halva_page_show_update_date', 0 ); // 1 or 0
			$show_post_update_date = $show_post_update_date_opt && ( get_the_modified_time( 'F j, Y' ) !== get_the_time( 'F j, Y' ) ); // true or false
			// author
			$show_author = get_theme_mod( 'halva_page_show_author', 1 ); // 1 or 0
			// views counter
			$show_views_opt = get_theme_mod( 'halva_page_show_views_counter', 1 ); // 1 or 0
			$show_views = function_exists( 'halva_additional_features_show_views_counter' ) && $show_views_opt; // true or false
			// comments counter
			$show_comments_counter_opt = get_theme_mod( 'halva_page_show_comments_counter', 1 ); // 1 or 0
			$show_comments_counter = $show_comments_counter_opt && ( comments_open() || get_comments_number() ); // true or false
			// metadata: show or hide
			$show_metadata = $show_publication_date || $show_post_update_date || $show_author || $show_views || $show_comments_counter; // true or false
		}
		?>

		<!-- metadata -->
		<ul class="bwp-single-post-metadata list-unstyled<?php if ( ! $show_metadata ) { echo ' bwp-hidden'; } ?>">

			<?php
			// 1. Publication date:
			// date format
			$date_format_opt = get_option( 'date_format' );
			// post type: post
			if ( 'post' === $post_type ) {
				// year, month, day
				$time_year = get_the_time( 'Y' );
				$time_month = get_the_time( 'm' );
				$time_day = get_the_time( 'd' );
				?>

				<!-- publication date (with link) -->
				<li class="bwp-date<?php if ( ! $show_publication_date ) { echo ' bwp-hidden'; } ?>">
					<span class="bwp-metadata-label"><span><?php esc_html_e( 'Published:', 'halva' ); ?></span></span>
					<a href="<?php echo esc_url( get_day_link( $time_year, $time_month, $time_day ) ); ?>">
						<time datetime="<?php the_time( 'c' ); ?>" class="date published"><?php the_time( $date_format_opt ); ?></time>
					</a>
				</li>
				<!-- end: publication date -->

				<?php
			} else {
				// post type: page
				?>

				<!-- publication date (no link) -->
				<li class="bwp-date<?php if ( ! $show_publication_date ) { echo ' bwp-hidden'; } ?>">
					<span class="bwp-metadata-label"><span><?php esc_html_e( 'Published:', 'halva' ); ?></span></span>
					<time datetime="<?php the_time( 'c' ); ?>" class="date published"><?php the_time( $date_format_opt ); ?></time>
				</li>
				<!-- end: publication date -->

				<?php
			}

			// 2. Post update date:
			?>

			<!-- post update date (or modification date) -->
			<li class="bwp-date-updated<?php if ( ! $show_post_update_date ) { echo ' bwp-hidden'; } ?>">
				<span class="bwp-metadata-label"><span><?php esc_html_e( 'Updated:', 'halva' ); ?></span></span>
				<time datetime="<?php the_modified_time( 'c' ); ?>" class="date updated"><?php the_modified_time( $date_format_opt ); ?></time>
			</li>
			<!-- end: post update date -->

			<?php
			// 3. Author:
			// author data: id, name, and author posts url
			$author_id = get_the_author_meta( 'ID' );
			$author_display_name = get_the_author_meta( 'display_name' );
			$author_posts_url = get_author_posts_url( $author_id );
			?>

			<!-- author -->
			<li class="bwp-author<?php if ( ! $show_author ) { echo ' bwp-hidden'; } ?>">
				<span class="bwp-metadata-label"><span><?php esc_html_e( 'Written by:', 'halva' ); ?></span></span>
				<a href="<?php echo esc_url( $author_posts_url ); ?>" rel="author">
					<span class="vcard author">
						<span class="fn"><?php echo esc_html( $author_display_name ); ?></span>
					</span>
				</a>
			</li>
			<!-- end: author -->

			<?php
			// 4. Counters: Views and Comments
			if ( ! $is_password_protected ) {

				// 4.1. Views:
				if ( $show_views ) {
					?>

					<!-- views -->
					<li class="bwp-views-counter"><?php halva_additional_features_show_views_counter( get_the_ID() ); ?></li>
					<!-- end: views -->

					<?php
				}

				// 4.2. Comments counter:
				if ( $show_comments_counter ) {
					?>

					<!-- comments counter -->
					<li class="bwp-comments-counter">
						<a href="#comments"><span class="bwp-counter-number"><?php comments_number( '0', '1', '%' ); ?></span></a>
					</li>
					<!-- end: comments counter -->

					<?php
				}

			}
			?>

		</ul>
		<!-- end: metadata -->

		<?php
	}
}


/**
 * The function displays the "About the author" section
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_about_author' ) ) {
	function halva_show_about_author() {
		// author data
		$author_id = get_the_author_meta( 'ID' );
		$author_display_name = get_the_author_meta( 'display_name' );
		$author_posts_url = get_author_posts_url( $author_id );
		// show or hide avatars (WordPress Settings > Discussion > Avatars > Avatar Display: Show Avatars)
		$show_avatars = get_option( 'show_avatars' );
		?>

		<!-- about the author -->
		<div class="bwp-about-author<?php echo ( ! $show_avatars ) ? ' bwp-no-avatars' : ''; ?>">
			<div class="bwp-section-separator bwp-gradient"></div>
			<div class="bwp-about-author-container clearfix">

				<?php
				// show avatar
				if ( $show_avatars ) {
					?>

					<!-- avatar -->
					<figure class="bwp-author-avatar">
						<a href="<?php echo esc_url( $author_posts_url ); ?>" title="<?php echo esc_attr( $author_display_name ); ?>">
							<?php echo get_avatar( $author_id, '144', '', esc_attr( $author_display_name ) ); ?>
							<div class="bwp-author-avatar-overlay"></div>
						</a>
					</figure>
					<!-- end: avatar -->

					<?php
				}
				?>

				<!-- biographical information -->
				<div class="bwp-author-bio-container">

					<!-- author name -->
					<h4 class="bwp-author-name">
						<?php echo '<span>' . esc_html__( 'Written by:', 'halva' ) . '</span><span class="bwp-name">' . esc_html( $author_display_name ) . '</span>'; ?>
						<a href="<?php echo esc_url( $author_posts_url ); ?>" class="bwp-author-posts-link">
							<span class="bwp-link-text"><?php esc_html_e( 'All posts by the author', 'halva' ); ?></span><i class="fa-solid fa-arrow-up-right-from-square"></i>
						</a>
					</h4>
					<!-- end: author name -->

					<?php
					// show biographical information
					if ( get_the_author_meta( 'description' ) ) {
						?>

						<!-- description (author bio) -->
						<div class="bwp-author-bio"><?php the_author_meta( 'description' ); ?></div>
						<!-- end: description -->

						<?php
					}
					?>

				</div>
				<!-- end: biographical information -->

			</div>
		</div>
		<!-- end: about the author -->

		<?php
	}
}


/**
 * Theme meta boxes
 *
 * @since Halva 1.0
 */
require_once get_theme_file_path( '/inc/post-meta-boxes/meta-boxes.php' );


/**
 * Customizer (Theme options)
 *
 * @since Halva 1.0
 */
require_once get_theme_file_path( '/inc/customizer/customizer.php' );
require_once get_theme_file_path( '/inc/customizer/sanitize-functions.php' );
require_once get_theme_file_path( '/inc/customizer/inline-styles.php' );
