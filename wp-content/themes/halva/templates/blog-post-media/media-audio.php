<?php
/**
 * Featured image / Audio player (For audio posts on archive pages)
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// post ID
$blog_post_id = $post->ID;

// thumbnail type
$audio_thumb_type = get_post_meta( $blog_post_id, 'halva_mb_audio_thumb_type', true ); // 'iframe' or 'featured_image'
if ( ! $audio_thumb_type ) {
	$audio_thumb_type = 'iframe'; // default value
}

// thumbnail type = featured image
if ( 'featured_image' === $audio_thumb_type ) {

	// if the post has a featured image
	if ( has_post_thumbnail() ) {

		// image data: sizes and attributes
		$image_size = 'full';
		$image_attr = '';
		if ( ! is_singular() ) {
			// archive page; add new attributes:
			$image_attr = array( 'loading' => 'eager' );
		} else {
			// single post; new size:
			$image_size = 'halva-939-626-crop';
		}

		// image link type
		$image_link_type = get_theme_mod( 'halva_featured_image_link_type', 'link_to_post' ); // 'link_to_post' or 'link_to_image'
		?>

		<!-- featured image -->
		<figure class="bwp-post-media">

			<?php
			// image link type: link to post
			if ( 'link_to_post' === $image_link_type ) {
				?>

				<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
					<?php the_post_thumbnail( $image_size, $image_attr ); ?>
					<div class="bwp-post-media-overlay"></div>
					<span class="bwp-post-hover-icon">
						<i class="fa-solid fa-share"></i>
					</span>
					<span class="bwp-post-format-icon">
						<i class="fa-solid fa-music"></i>
					</span>
				</a>

				<?php
			} else {
				// image link type: link to image
				$image_id = get_post_thumbnail_id();
				$popup_image_size = 'full';
				$popup_image_url = wp_get_attachment_image_url( $image_id, $popup_image_size );
				$popup_image_caption = get_post( $image_id )->post_excerpt;
				?>

				<a href="<?php echo esc_url( $popup_image_url ); ?>" class="bwp-post-media-link bwp-popup-image" title="<?php if ( $popup_image_caption ) { echo esc_attr( $popup_image_caption ); } else { the_title_attribute(); } ?>">
					<?php the_post_thumbnail( $image_size, $image_attr ); ?>
					<div class="bwp-post-media-overlay"></div>
					<span class="bwp-post-hover-icon bwp-zoom-image">
						<i class="fa-solid fa-images"></i>
					</span>
					<span class="bwp-post-format-icon">
						<i class="fa-solid fa-music"></i>
					</span>
				</a>

				<?php
			}
			?>

		</figure>
		<!-- end: featured image -->

		<?php
	}

} else {
	// thumbnail type = iframe

	// audio URL
	$audio_url = get_post_meta( $blog_post_id, 'halva_mb_audio_url', true );

	// if $audio_url is not empty
	if ( '' !== $audio_url ) {

		// get embed code
		$audio_embed_code_escaped = wp_oembed_get( esc_url( $audio_url ) ); // this variable has been safely escaped

		if ( $audio_embed_code_escaped ) {
			?>

			<!-- audio player (iframe) -->
			<figure class="bwp-post-media bwp-audio-player">
				<div class="bwp-iframe-audio-wrapper">
					<?php echo ! empty( $audio_embed_code_escaped ) ? $audio_embed_code_escaped : ''; ?>
				</div>
			</figure>
			<!-- end: audio player -->

			<?php
		}

	}

}
