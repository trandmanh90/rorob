<?php
/**
 * Carousel with posts for the homepage
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// show/hide carousel
$show_homepage_carousel = get_theme_mod( 'halva_show_homepage_carousel', 0 ); // 1 or 0
if ( $show_homepage_carousel ) {

	// carousel options:
	// 1: maximum carousel items
	$homepage_carousel_items_max_number = get_theme_mod( 'halva_carousel_items_max_number', 7 );
	if ( '' === $homepage_carousel_items_max_number ) {
		$homepage_carousel_items_max_number = 7;
	}

	// 2: show posts from categories or featured posts?
	$homepage_carousel_shows_posts_from = get_theme_mod( 'halva_carousel_shows_posts_from', 'posts-by-category' ); // 'posts-by-category' or 'featured-posts'

	// 3: category id
	$homepage_carousel_category_id = get_theme_mod( 'halva_carousel_category_id', 0 );
	if ( 0 === $homepage_carousel_category_id ) {
		$homepage_carousel_category_id = ''; // All categories
	}

	// 4: order by
	$homepage_carousel_orderby = get_theme_mod( 'halva_carousel_orderby', 'date' ); // 'rand', 'date' or 'comment_count'

	// query arguments
	if ( 'posts-by-category' === $homepage_carousel_shows_posts_from ) {
		// posts by category
		$homepage_carousel_query_args = array(
			'post_type'				=> 'post',
			'posts_per_page'		=> intval( $homepage_carousel_items_max_number ),
			'cat'					=> $homepage_carousel_category_id,
			'orderby'				=> $homepage_carousel_orderby,
			'ignore_sticky_posts'	=> true,
		);
	} else {
		// featured posts (manually selected posts)
		$homepage_carousel_query_args = array(
			'post_type'				=> 'post',
			'posts_per_page'		=> intval( $homepage_carousel_items_max_number ),
			'meta_key'				=> 'halva_mb_featured_post',
			'meta_value'			=> '1',
			'orderby'				=> $homepage_carousel_orderby,
			'ignore_sticky_posts'	=> true,
		);
	}

	// start query
	$homepage_carousel_query = new WP_Query( $homepage_carousel_query_args );
	if ( $homepage_carousel_query->have_posts() ) {
		// carousel content: display options
		$homepage_carousel_show_categories = get_theme_mod( 'halva_carousel_show_categories', 0 ); // 1 or 0
		$homepage_carousel_show_date = get_theme_mod( 'halva_carousel_show_date', 1 ); // 1 or 0
		$homepage_carousel_show_author = get_theme_mod( 'halva_carousel_show_author', 1 ); // 1 or 0
		// rewind option (enable or disable)
		$homepage_carousel_enable_rewind = get_theme_mod( 'halva_carousel_enable_rewind', 1 ); // 1 or 0
		?>

		<!-- carousel with posts (homepage) -->
		<section class="bwp-carousel-section">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Carousel with posts', 'halva' ); ?></h2>
			<div class="container-fluid">
				<div class="bwp-carousel-container<?php if ( ! $homepage_carousel_enable_rewind ) { echo ' bwp-tns-rewind-disabled'; } ?>">

					<!-- start homepage carousel (tiny-slider) -->
					<div id="bwp-homepage-carousel-wrapper">
						<div id="bwp-homepage-carousel">

							<?php
							while ( $homepage_carousel_query->have_posts() ) {
								$homepage_carousel_query->the_post();

								// post ID
								$homepage_carousel_post_id = $post->ID;

								// background image
								$homepage_carousel_image_id = get_post_meta( $homepage_carousel_post_id, 'halva_mb_featured_post_image', true );
								if ( $homepage_carousel_image_id ) {
									// image for carousel item
									$homepage_carousel_image_url = wp_get_attachment_image_url( $homepage_carousel_image_id, 'full' );
								} else {
									// featured image
									$homepage_carousel_image_url = get_the_post_thumbnail_url( $homepage_carousel_post_id, 'full' );
								}
								?>

								<!-- post -->
								<div class="bwp-homepage-carousel-item bwp-homepage-carousel-post-<?php echo (int) $homepage_carousel_post_id; if ( ! $homepage_carousel_image_url ) { echo ' bwp-homepage-carousel-item-no-bg'; } ?>">

									<?php
									if ( $homepage_carousel_image_url ) {
										?>

										<!-- background image and dark overlay -->
										<div class="bwp-homepage-carousel-item-bg" style="background-image: url(<?php echo esc_url( $homepage_carousel_image_url ); ?>);"></div>
										<div class="bwp-homepage-carousel-item-overlay"></div>
										<!-- end: background image and dark overlay -->

										<?php
									} else {
										?>

										<!-- background color (post without image) -->
										<div class="bwp-homepage-carousel-item-bg bwp-homepage-carousel-item-bg-color"></div>
										<!-- end: background color -->

										<?php
									}
									?>

									<!-- content -->
									<div class="bwp-homepage-carousel-item-content">
										<div class="bwp-homepage-carousel-item-text">

											<?php
											// show metadata
											if ( $homepage_carousel_show_categories || $homepage_carousel_show_date || $homepage_carousel_show_author ) {
												?>

												<!-- metadata (categories, date, and author) -->
												<ul class="bwp-homepage-carousel-post-metadata list-unstyled">

													<?php
													// 1: categories
													if ( $homepage_carousel_show_categories ) {
														?>

														<!-- categories -->
														<li class="bwp-categories">
															<?php the_category( ', ' ); ?>
														</li>
														<!-- end: categories -->

														<?php
													}

													// 2: date
													if ( $homepage_carousel_show_date ) {
														// year, month, day
														$time_year = get_the_time( 'Y' );
														$time_month = get_the_time( 'm' );
														$time_day = get_the_time( 'd' );
														?>

														<!-- publication date -->
														<li class="bwp-date">
															<a href="<?php echo esc_url( get_day_link( $time_year, $time_month, $time_day ) ); ?>">
																<time datetime="<?php the_time( 'c' ); ?>" class="date published"><?php the_time( get_option( 'date_format' ) ); ?></time>
															</a>
														</li>
														<!-- end: publication date -->

														<?php
													}

													// 3: author
													if ( $homepage_carousel_show_author ) {
														// author data: id, name, and author posts url
														$author_id = get_the_author_meta( 'ID' );
														$author_display_name = get_the_author_meta( 'display_name' );
														$author_posts_url = get_author_posts_url( $author_id );
														?>

														<!-- author -->
														<li class="bwp-author">
															<a href="<?php echo esc_url( $author_posts_url ); ?>" rel="author">
																<span class="vcard author">
																	<span class="fn"><?php echo esc_html( $author_display_name ); ?></span>
																</span>
															</a>
														</li>
														<!-- end: author -->

														<?php
													}
													?>

												</ul>
												<!-- end: metadata -->

												<?php
											}
											?>

											<!-- title -->
											<h3 class="bwp-homepage-carousel-post-title">
												<a href="<?php the_permalink(); ?>">
													<?php
													if ( get_the_title() ) {
														the_title();
													} else {
														esc_html_e( 'Read Post', 'halva' );
													}
													?>
												</a>
											</h3>
											<!-- end: title -->

										</div>
									</div>
									<!-- end: content -->

								</div>
								<!-- end: post -->

								<?php
							}
							?>

						</div>
						<div id="bwp-homepage-carousel-loading-icon">
							<i class="fa-regular fa-images fa-flip"></i>
						</div>
					</div>
					<!-- end: homepage carousel (tiny-slider) -->

				</div>
			</div>
		</section>
		<!-- end: carousel with posts -->

		<?php
	}

	// reset post data
	wp_reset_postdata();

}
