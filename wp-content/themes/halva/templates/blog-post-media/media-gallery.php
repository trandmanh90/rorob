<?php
/**
 * Featured image / Slider (For gallery posts on archive pages)
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// post ID
$blog_post_id = $post->ID;

// thumbnail type
$gallery_thumb_type = get_post_meta( $blog_post_id, 'halva_mb_gallery_thumb_type', true ); // 'featured_image' or 'slider'
if ( ! $gallery_thumb_type ) {
	$gallery_thumb_type = 'slider'; // default value
}

// image size
$image_size = 'full';
$popup_image_size = 'full';

// image attributes
$image_attr = '';

// image size and image attributes depending on the page
if ( ! is_singular() ) {
	// archive page; add new attributes:
	$image_attr = array( 'loading' => 'eager' );
} else {
	// single post; new size:
	$image_size = 'halva-939-626-crop';
}

// image link type
$image_link_type = get_theme_mod( 'halva_featured_image_link_type', 'link_to_post' ); // 'link_to_post' or 'link_to_image'

// thumbnail type = featured image
if ( 'featured_image' === $gallery_thumb_type ) {

	// if the post has a featured image
	if ( has_post_thumbnail() ) {
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
				</a>

				<?php
			} else {
				// image link type: link to image
				$image_id = get_post_thumbnail_id();
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
			?>

		</figure>
		<!-- end: featured image -->

		<?php
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

		// number of images
		$gallery_images_num = count( $gallery_images_id );
		if ( $gallery_images_num > 1 ) {
			// several images in the gallery; show slider.
			// rewind option (enable or disable)
			$gallery_slider_enable_rewind = get_theme_mod( 'halva_gallery_slider_enable_rewind', 1 ); // 1 or 0
			?>

			<!-- slider with images (tiny-slider) -->
			<div class="bwp-post-media-slider<?php if ( ! $gallery_slider_enable_rewind ) { echo ' bwp-tns-rewind-disabled'; } ?>">
				<div id="bwp-post-slider-<?php echo (int) $blog_post_id; ?>" class="bwp-post-slider<?php if ( 'link_to_image' === $image_link_type ) { echo ' bwp-popup-gallery'; } ?>">

					<?php
					foreach ( $gallery_images_id as $gallery_image_id ) {
						// image url and image alt
						$gallery_image_url = wp_get_attachment_image_url( $gallery_image_id, $image_size );
						$gallery_image_alt = get_post_meta( $gallery_image_id, '_wp_attachment_image_alt', true );
						?>

						<!-- slider item -->
						<figure class="bwp-post-slider-item">

							<?php
							// image link type: link to post
							if ( 'link_to_post' === $image_link_type ) {
								?>

								<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
									<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>" loading="eager">
									<div class="bwp-post-media-overlay"></div>
									<span class="bwp-post-hover-icon">
										<i class="fa-solid fa-share"></i>
									</span>
								</a>

								<?php
							} else {
								// image link type: link to image
								$gallery_popup_image_url = wp_get_attachment_image_url( $gallery_image_id, $popup_image_size );
								$gallery_popup_image_caption = get_post( $gallery_image_id )->post_excerpt;
								?>

								<a href="<?php echo esc_url( $gallery_popup_image_url ); ?>" class="bwp-post-media-link bwp-popup-gallery-item" title="<?php if ( $gallery_popup_image_caption ) { echo esc_attr( $gallery_popup_image_caption ); } else { the_title_attribute(); } ?>">
									<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>" loading="eager">
									<div class="bwp-post-media-overlay"></div>
									<span class="bwp-post-hover-icon bwp-zoom-image">
										<i class="fa-solid fa-images"></i>
									</span>
								</a>

								<?php
							}
							?>

						</figure>
						<!-- end: slider item -->

						<?php
					}
					?>

				</div>
			</div>
			<!-- end: slider with images -->

			<?php
		} else {
			// one image in the gallery; show only this image:
			// image url and image alt
			$gallery_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $image_size );
			$gallery_image_alt = get_post_meta( $gallery_images_id[0], '_wp_attachment_image_alt', true );
			?>

			<!-- single gallery image -->
			<figure class="bwp-post-media">

				<?php
				// image link type: link to post
				if ( 'link_to_post' === $image_link_type ) {
					?>

					<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
						<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>" loading="eager">
						<div class="bwp-post-media-overlay"></div>
						<span class="bwp-post-hover-icon">
							<i class="fa-solid fa-share"></i>
						</span>
					</a>

					<?php
				} else {
					// image link type: link to image
					$gallery_popup_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $popup_image_size );
					$gallery_popup_image_caption = get_post( $gallery_images_id[0] )->post_excerpt;
					?>

					<a href="<?php echo esc_url( $gallery_popup_image_url ); ?>" class="bwp-post-media-link bwp-popup-image" title="<?php if ( $gallery_popup_image_caption ) { echo esc_attr( $gallery_popup_image_caption ); } else { the_title_attribute(); } ?>">
						<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>" loading="eager">
						<div class="bwp-post-media-overlay"></div>
						<span class="bwp-post-hover-icon bwp-zoom-image">
							<i class="fa-solid fa-images"></i>
						</span>
					</a>

					<?php
				}
				?>

			</figure>
			<!-- end: single gallery image -->

			<?php
		}

	}

}
