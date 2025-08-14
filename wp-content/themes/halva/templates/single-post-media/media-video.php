<?php
/**
 * Video player / Featured image (For a single post page)
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// post ID
$blog_post_id = $post->ID;

// video URL
$video_url = get_post_meta( $blog_post_id, 'halva_mb_video_url', true );

// if $video_url is not empty
if ( '' !== $video_url ) {

	// get embed code
	$video_embed_code_escaped = wp_oembed_get( esc_url( $video_url ) ); // this variable has been safely escaped

	if ( $video_embed_code_escaped ) {
		?>

		<!-- post media (video player) -->
		<div class="bwp-single-post-media-container">

			<!-- video player (iframe) -->
			<figure class="bwp-post-media bwp-video-player">
				<div class="bwp-iframe-video-wrapper">
					<?php echo ! empty( $video_embed_code_escaped ) ? $video_embed_code_escaped : ''; ?>
				</div>
			</figure>
			<!-- end: video player -->

		</div>
		<!-- end: post media -->

		<?php
	}

} else {

	// if the post has a featured image
	if ( has_post_thumbnail() ) {

		// image size
		$image_size = 'full';
		// cropped image instead of full
		$single_post_cropped_image = get_theme_mod( 'halva_pages_cropped_image', 0 ); // 1 or 0
		if ( $single_post_cropped_image ) {
			$image_size = 'post-thumbnail'; // 1920 x 1280 px
		}

		// image data: id and caption
		$image_id = get_post_thumbnail_id();
		$image_caption = get_post( $image_id )->post_excerpt;

		// popup image: on or off
		$popup_image = get_theme_mod( 'halva_pages_enable_popup_image', 1 ); // 1 or 0
		?>

		<!-- post media (featured image) -->
		<div class="bwp-single-post-media-container">

			<!-- featured image -->
			<figure class="bwp-post-media">

				<?php
				if ( $popup_image ) {
					// data for popup image
					$popup_image_size = 'full';
					$popup_image_url = wp_get_attachment_image_url( $image_id, $popup_image_size );
					?>

					<a href="<?php echo esc_url( $popup_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $image_caption ) { echo esc_attr( $image_caption ); } else { the_title_attribute(); } ?>">
						<?php the_post_thumbnail( $image_size ); ?>
					</a>

					<?php
				} else {
					the_post_thumbnail( $image_size );
				}
				?>

				<?php
				if ( $image_caption ) {
					?>

					<figcaption class="bwp-post-image-caption"><?php echo esc_html( $image_caption ); ?></figcaption>

					<?php
				}
				?>

			</figure>
			<!-- end: featured image -->

		</div>
		<!-- end: post media -->

		<?php
	}

}
