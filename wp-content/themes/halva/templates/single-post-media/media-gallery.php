<?php
/**
 * Slider / Featured image (For a single post page)
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// post ID
$blog_post_id = $post->ID;

// image size
$image_size = 'full';
$popup_image_size = 'full';

// cropped image instead of full
$single_post_cropped_image = get_theme_mod( 'halva_pages_cropped_image', 0 ); // 1 or 0
if ( $single_post_cropped_image ) {
	$image_size = 'post-thumbnail'; // 1920 x 1280 px
}

// popup image: on or off
$popup_image = get_theme_mod( 'halva_pages_enable_popup_image', 1 ); // 1 or 0

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

		<!-- post media (slider) -->
		<div class="bwp-single-post-media-container">

			<!-- slider with images (tiny-slider) -->
			<div class="bwp-post-media-slider<?php if ( ! $gallery_slider_enable_rewind ) { echo ' bwp-tns-rewind-disabled'; } ?>">
				<div id="bwp-post-slider-<?php echo (int) $blog_post_id; ?>" class="bwp-post-slider<?php if ( $popup_image ) { echo ' bwp-popup-gallery'; } ?>">

					<?php
					foreach ( $gallery_images_id as $gallery_image_id ) {
						// image data: url, caption, and alt
						$gallery_image_url = wp_get_attachment_image_url( $gallery_image_id, $image_size );
						$gallery_image_alt = get_post_meta( $gallery_image_id, '_wp_attachment_image_alt', true );
						$gallery_image_caption = get_post( $gallery_image_id )->post_excerpt;
						?>

						<!-- slider item -->
						<figure class="bwp-post-slider-item">

							<?php
							if ( $popup_image ) {
								// popup image url
								$gallery_popup_image_url = wp_get_attachment_image_url( $gallery_image_id, $popup_image_size );
								?>

								<a href="<?php echo esc_url( $gallery_popup_image_url ); ?>" class="bwp-popup-gallery-item" title="<?php if ( $gallery_image_caption ) { echo esc_attr( $gallery_image_caption ); } else { the_title_attribute(); } ?>">
									<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>" loading="eager">
								</a>

								<?php
							} else {
								?>

								<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>" loading="eager">

								<?php
							}
							?>

							<?php
							if ( $gallery_image_caption ) {
								?>

								<figcaption class="bwp-post-image-caption"><?php echo esc_html( $gallery_image_caption ); ?></figcaption>

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

		</div>
		<!-- end: post media -->

		<?php
	} else {
		// one image in the gallery; show only this image:
		// image data: url, caption, and alt
		$gallery_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $image_size );
		$gallery_image_alt = get_post_meta( $gallery_images_id[0], '_wp_attachment_image_alt', true );
		$gallery_image_caption = get_post( $gallery_images_id[0] )->post_excerpt;
		?>

		<!-- post media (single gallery image) -->
		<div class="bwp-single-post-media-container">

			<!-- single gallery image -->
			<figure class="bwp-post-media">

				<?php
				if ( $popup_image ) {
					// popup image url
					$gallery_popup_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $popup_image_size );
					?>

					<a href="<?php echo esc_url( $gallery_popup_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $gallery_image_caption ) { echo esc_attr( $gallery_image_caption ); } else { the_title_attribute(); } ?>">
						<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
					</a>

					<?php
				} else {
					?>

					<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">

					<?php
				}
				?>

				<?php
				if ( $gallery_image_caption ) {
					?>

					<figcaption class="bwp-post-image-caption"><?php echo esc_html( $gallery_image_caption ); ?></figcaption>

					<?php
				}
				?>

			</figure>
			<!-- end: single gallery image -->

		</div>
		<!-- end: post media -->

		<?php
	}

} else {

	// show featured image
	if ( has_post_thumbnail() ) {
		// image data: id and caption
		$image_id = get_post_thumbnail_id();
		$image_caption = get_post( $image_id )->post_excerpt;
		?>

		<!-- post media (featured image) -->
		<div class="bwp-single-post-media-container">

			<!-- featured image -->
			<figure class="bwp-post-media">

				<?php
				if ( $popup_image ) {
					// popup image url
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
