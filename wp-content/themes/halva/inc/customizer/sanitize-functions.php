<?php
/**
 * Data sanitization functions
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

/**
 * The function checks all numeric values
 *
 * @since Halva 1.0
 */
function halva_sanitize_number_intval( $input ) {
	if ( is_numeric( $input ) && $input >= 1 ) {
		return intval( $input );
	} else {
		return '';
	}
}


/**
 * The function checks all checkboxes
 *
 * @since Halva 1.0
 */
function halva_sanitize_checkbox( $input ) {
	if ( 1 === (int) $input ) {
		return 1;
	} else {
		return 0;
	}
}


/**
 * The function checks the type of logo
 *
 * @since Halva 1.0
 */
function halva_sanitize_logo_type( $input ) {
	$valid = array(
		'text'	=> 'Text',
		'image'	=> 'Image',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'text'; // default
	}
}


/**
 * The function checks the type of posts for the homepage carousel
 *
 * @since Halva 1.0
 */
function halva_sanitize_carousel_posts_type( $input ) {
	$valid = array(
		'posts-by-category'	=> 'Posts by category',
		'featured-posts'	=> 'Featured posts',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'posts-by-category'; // default
	}
}


/**
 * The function checks post categories
 *
 * @since Halva 1.0
 */
function halva_sanitize_categories( $input ) {
	$categories = array();
	$categories_obj = get_categories( 'hide_empty=0&depth=1&type=post' );
	foreach ( $categories_obj as $category ) {
		$category_id = $category->term_id;
		$category_name = $category->cat_name;
		$categories[ intval( $category_id ) ] = esc_html( $category_name );
	}
	$categories = array( 0 => 'All categories' ) + $categories;

	if ( array_key_exists( $input, $categories ) ) {
		return $input;
	} else {
		return 0; // All categories
	}
}


/**
 * The function checks the order values for the carousel
 *
 * @since Halva 1.0
 */
function halva_sanitize_carousel_orderby( $input ) {
	$valid = array(
		'rand'			=> 'Random order',
		'date'			=> 'Publication date',
		'comment_count'	=> 'Number of comments',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'date'; // default
	}
}


/**
 * The function checks the blog layout
 *
 * @since Halva 1.0
 */
function halva_sanitize_blog_layout( $input ) {
	$valid = array(
		'col-1'	=> 'One column',
		'col-3'	=> 'Three columns',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'col-3'; // default
	}
}


/**
 * The function checks the link type for featured images
 *
 * @since Halva 1.0
 */
function halva_sanitize_featured_image_link_type( $input ) {
	$valid = array(
		'link_to_post'	=> 'Link to post',
		'link_to_image'	=> 'Link to image',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'link_to_post'; // default
	}
}


/**
 * The function checks the transition type for the slider (post format: gallery)
 *
 * @since Halva 1.0
 */
function halva_sanitize_slider_transition_type( $input ) {
	$valid = array(
		'fade'				=> 'Fade animation',
		'slide_horizontal'	=> 'Slide horizontal',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'slide_horizontal'; // default
	}
}


/**
 * The function checks the color mode
 *
 * @since Halva 1.0
 */
function halva_sanitize_color_mode( $input ) {
	$valid = array(
		'light'	=> 'Light mode',
		'dark'	=> 'Dark mode',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'light'; // default
	}
}


/**
 * The function checks the type of fonts
 *
 * @since Halva 1.0
 */
function halva_sanitize_font_type( $input ) {
	$valid = array(
		'sans-serif'	=> 'Sans-serif fonts',
		'serif'			=> 'Serif fonts',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'sans-serif'; // default
	}
}


/**
 * The function checks the type of cookies notification on mobile devices
 *
 * @since Halva 1.0
 */
function halva_sanitize_cookies_notice_on_mobile( $input ) {
	$valid = array(
		'hidden'	=> 'Hidden notification',
		'visible'	=> 'Visible notification',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'hidden'; // default
	}
}


/**
 * Filtering HTML tags for social links (allowed tags: a - href, title, target, class, rel; span - class; i - class)
 *
 * @since Halva 1.0
 */
function halva_sanitize_wp_kses_social_links( $input ) {
	return wp_kses( $input, array(
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
}


/**
 * Filtering HTML tags for text (allowed tags: p - class; a - href, title, target, class, rel; span - class; strong; b; em; i - class; br)
 *
 * @since Halva 1.0
 */
function halva_sanitize_wp_kses_text( $input ) {
	return wp_kses( $input, array(
		'p'			=> array(
			'class'		=> array(),
		),
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
		'strong'	=> array(),
		'b'			=> array(),
		'em'		=> array(),
		'i'			=> array(
			'class'		=> array(),
		),
		'br'		=> array(),
	) );
}
