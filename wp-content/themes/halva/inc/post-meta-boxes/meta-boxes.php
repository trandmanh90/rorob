<?php
/**
 * Registering meta boxes
 *
 * @since Halva 1.0
 */

add_filter( 'rwmb_meta_boxes', 'halva_register_meta_boxes' );

// function: register meta boxes
function halva_register_meta_boxes( $meta_boxes ) {

	$prefix = 'halva_mb_';

	/**
	 * Meta boxes for posts
	 * ---------------------------------
	 *
	 * Additional settings
	 * ---------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}additional_settings",
		'title'		=> esc_html__( 'Additional Settings', 'halva' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Homepage carousel
			 * ---------------------------------
			 */

			// Heading
			array(
				'type'	=> 'heading',
				'name'	=> esc_html__( 'Homepage carousel', 'halva' ),
			),

			// Add this post to the carousel on the homepage
			array(
				'name'	=> esc_html__( 'Add this post to the carousel on your homepage', 'halva' ),
				'id'	=> "{$prefix}featured_post",
				'type'	=> 'checkbox',
				'std'	=> 0,
			),

			// Alternative image for the carousel
			array(
				'name'				=> esc_html__( 'Add an image for the carousel', 'halva' ),
				'desc'				=> esc_html__( 'This image will be displayed in the carousel. If there is no alternative image, the carousel will display the Featured Image for that post.', 'halva' ),
				'id'				=> "{$prefix}featured_post_image",
				'type'				=> 'image_advanced',
				'max_file_uploads'	=> 1,
			),

			/**
			 * Single post page: Featured media
			 * ---------------------------------
			 */

			// Heading
			array(
				'type'	=> 'heading',
				'name'	=> esc_html__( 'Single post page: Featured media', 'halva' ),
			),

			// Show or hide your featured media on the post page?
			array(
				'name'			=> esc_html__( 'Show or hide your featured media on the post page?', 'halva' ),
				'desc'			=> esc_html__( 'Default value: Show. Featured media appears at the top of the post page under the post title. Featured media includes: featured image, slider, video, and audio.', 'halva' ),
				'id'			=> "{$prefix}single_show_featured_media",
				'type'			=> 'select_advanced',
				'options'		=> array(
					'show'			=> esc_html__( 'Show', 'halva' ),
					'hide'			=> esc_html__( 'Hide', 'halva' ),
				),
				'std'			=> 'show',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Show / Hide', 'halva' ),
			),

		),
	);


	/**
	 * Post format: Gallery
	 * ---------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}gallery_format",
		'title'		=> esc_html__( 'Gallery Format Settings', 'halva' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Thumbnail type (or media type)
			 * ---------------------------------
			 */
			array(
				'name'			=> esc_html__( 'Media type', 'halva' ),
				'desc'			=> esc_html__( 'This option applies to pages with posts. Default value: Slider.', 'halva' ),
				'id'			=> "{$prefix}gallery_thumb_type",
				'type'			=> 'select_advanced',
				'options'		=> array(
					'featured_image'	=> esc_html__( 'Featured image', 'halva' ),
					'slider'			=> esc_html__( 'Slider', 'halva' ),
				),
				'std'			=> 'slider',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Featured image / Slider', 'halva' ),
			),

			/**
			 * Images for the gallery
			 * ---------------------------------
			 */
			array(
				'name'				=> esc_html__( 'Add images', 'halva' ),
				'id'				=> "{$prefix}gallery",
				'type'				=> 'image_advanced',
				'max_file_uploads'	=> 10,
			),

		),
	);


	/**
	 * Post format: Video
	 * ---------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}video_format",
		'title'		=> esc_html__( 'Video Format Settings', 'halva' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Thumbnail type (or media type)
			 * ---------------------------------
			 */
			array(
				'name'			=> esc_html__( 'Media type', 'halva' ),
				'desc'			=> esc_html__( 'This option applies to pages with posts. Default value: Video player (iframe).', 'halva' ),
				'id'			=> "{$prefix}video_thumb_type",
				'type'			=> 'select_advanced',
				'options'		=> array(
					'iframe'			=> esc_html__( 'Video player (iframe)', 'halva' ),
					'featured_image'	=> esc_html__( 'Featured image', 'halva' ),
				),
				'std'			=> 'iframe',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Video player / Featured image', 'halva' ),
			),

			/**
			 * Video URL
			 * ---------------------------------
			 */
			array(
				'name'	=> esc_html__( 'Video URL', 'halva' ),
				'id'	=> "{$prefix}video_url",
				'desc'	=> esc_html__( 'Insert a link (URL) on a video from one of the video hosting sites: YouTube, Vimeo, etc.', 'halva' ),
				'type'	=> 'oembed',
			),

		),
	);


	/**
	 * Post format: Audio
	 * ---------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}audio_format",
		'title'		=>  esc_html__( 'Audio Format Settings', 'halva' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Thumbnail type (or media type)
			 * ---------------------------------
			 */
			array(
				'name'			=> esc_html__( 'Media type', 'halva' ),
				'desc'			=> esc_html__( 'This option applies to pages with posts. Default value: Audio player (iframe).', 'halva' ),
				'id'			=> "{$prefix}audio_thumb_type",
				'type'			=> 'select_advanced',
				'options'		=> array(
					'iframe'			=> esc_html__( 'Audio player (iframe)', 'halva' ),
					'featured_image'	=> esc_html__( 'Featured image', 'halva' ),
				),
				'std'			=> 'iframe',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Audio player / Featured image', 'halva' ),
			),

			/**
			 * Audio URL
			 * ---------------------------------
			 */
			array(
				'name'	=> esc_html__( 'SoundCloud URL', 'halva' ),
				'id'	=> "{$prefix}audio_url",
				'desc'	=> esc_html__( 'Insert a link (URL) on a song from the SoundCloud service.', 'halva' ),
				'type'	=> 'oembed',
			),

		),
	);


	/**
	 * Post format: Link
	 * ---------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}link_format",
		'title'		=>  esc_html__( 'Link Format Settings', 'halva' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Target attribute
			 * ---------------------------------
			 */
			array(
				'name'			=> esc_html__( 'Open link in... (target attribute)', 'halva' ),
				'desc'			=> esc_html__( 'Default value: New tab (_blank).', 'halva' ),
				'id'			=> "{$prefix}link_target",
				'type'			=> 'select_advanced',
				'options'		=> array(
					'self'			=> esc_html__( 'Current tab (_self)', 'halva' ),
					'blank'			=> esc_html__( 'New tab (_blank)', 'halva' ),
				),
				'std'			=> 'blank',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Current tab / New tab', 'halva' ),
			),

		),
	);

	return $meta_boxes;

}
