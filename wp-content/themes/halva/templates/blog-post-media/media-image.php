<?php
/**
 * Featured image (For posts on archive pages)
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// if the post has a featured image
if ( has_post_thumbnail() ) {

	// post ID
	$blog_post_id = $post->ID;

	// post format
	$blog_post_format = get_post_format();
	if ( false === $blog_post_format ) {
		$blog_post_format = 'standard';
	}

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

	// post format: link
	if ( 'link' === $blog_post_format ) {
		// get url
		$link_url = halva_get_link_url();
		// target attribute
		$link_target_opt = get_post_meta( $blog_post_id, 'halva_mb_link_target', true ); // 'self' or 'blank'
		if ( ! $link_target_opt ) {
			$link_target_opt = 'blank'; // default
		}
		$link_target = ( 'blank' === $link_target_opt ) ? '_blank' : '_self';
	}
	?>

	<!-- featured image -->
	<figure class="bwp-post-media">

		<?php
		// post format: link
		if ( 'link' === $blog_post_format ) {
			?>

			<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="bwp-post-media-link"<?php if ( '_blank' === $link_target ) { echo ' rel="noopener noreferrer"'; } ?>>
				<?php the_post_thumbnail( $image_size, $image_attr ); ?>
				<div class="bwp-post-media-overlay"></div>
				<span class="bwp-post-hover-icon">
					<i class="fa-solid fa-up-right-from-square"></i>
				</span>
			</a>

			<?php
		} else {
			// other formats

			// image link type: link to post
			if ( 'link_to_post' === $image_link_type ) {
				?>

				<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
					<?php the_post_thumbnail( $image_size, $image_attr ); ?>
					<div class="bwp-post-media-overlay"></div>
					<span class="bwp-post-hover-icon">
						<i class="fa-solid fa-share"></i>
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
				</a>

				<?php
			}

		}
		?>

	</figure>
	<!-- end: featured image -->

	<?php
}
