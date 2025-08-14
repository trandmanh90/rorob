<?php
/**
 * The template for displaying related posts by tags
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// show or hide related posts
$show_related_posts = get_theme_mod( 'halva_single_show_related_posts', 1 ); // 1 or 0
if ( $show_related_posts ) {

	// current post ID
	$current_post_id = $post->ID;

	// get tags for current post
	$current_post_tags = wp_get_post_terms( $current_post_id );
	if ( $current_post_tags ) {

		// get tags IDs
		$current_post_tags_count = count( $current_post_tags );
		for ( $i = 0; $i < $current_post_tags_count; $i++ ) {
			$current_post_tag_IDs[ $i ] = $current_post_tags[ $i ]->term_id;
		}

		// query arguments
		$related_posts_args = array(
			'tag__in'				=> $current_post_tag_IDs,
			'post__not_in'			=> array( $current_post_id ),
			'posts_per_page'		=> 3,
			'orderby'				=> 'rand',
			'ignore_sticky_posts'	=> true,
		);

		// start query
		$related_posts = new WP_Query( $related_posts_args );
		if ( $related_posts->have_posts() ) {
			?>

			<!-- related posts (by tags) -->
			<div class="bwp-related-posts">
				<div class="bwp-section-separator bwp-gradient"></div>
				<h2 class="bwp-related-posts-title"><?php esc_html_e( 'You may also like', 'halva' ); ?></h2>
				<div class="bwp-related-posts-container clearfix">

					<?php
					while ( $related_posts->have_posts() ) {
						$related_posts->the_post();

						// post ID
						$related_post_id = $post->ID;

						// post format
						$related_post_format = get_post_format();
						if ( false === $related_post_format ) {
							$related_post_format = 'standard';
						}
						?>

						<!-- post -->
						<article id="bwp-post-<?php echo (int) $related_post_id; ?>" <?php post_class(); ?>>
							<div class="bwp-post-wrapper">

								<?php
								// post media (featured image / slider / video / audio)
								if ( 'gallery' === $related_post_format || 'video' === $related_post_format || 'audio' === $related_post_format ) {
									get_template_part( 'templates/blog-post-media/media', $related_post_format );
								} else {
									get_template_part( 'templates/blog-post-media/media-image' );
								}
								?>

								<!-- content -->
								<div class="bwp-post-content">

									<!-- title -->
									<h3 class="bwp-post-title entry-title">
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

									<!-- metadata (dates, author, and tags) -->
									<ul class="bwp-post-metadata list-unstyled">

										<?php
										// date format
										$date_format_opt = get_option( 'date_format' );
										?>

										<!-- publication date -->
										<li class="bwp-date bwp-hidden">
											<time datetime="<?php the_time( 'c' ); ?>" class="date published"><?php the_time( $date_format_opt ); ?></time>
										</li>
										<!-- end: publication date -->

										<!-- post update date (or modification date) -->
										<li class="bwp-date-updated bwp-hidden">
											<time datetime="<?php the_modified_time( 'c' ); ?>" class="date updated"><?php the_modified_time( $date_format_opt ); ?></time>
										</li>
										<!-- end: post update date -->

										<!-- author -->
										<li class="bwp-author bwp-hidden">
											<span class="vcard author">
												<span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
											</span>
										</li>
										<!-- end: author -->

										<!-- tags -->
										<li class="bwp-tags">
											<?php the_tags( '', ', ', '' ); ?>
										</li>
										<!-- end: tags -->

									</ul>
									<!-- end: metadata -->

								</div>
								<!-- end: content -->

							</div>
						</article>
						<!-- end: post -->

						<?php
					}
					?>

				</div>
			</div>
			<!-- end: related posts -->

			<?php
		}

		// reset post data
		wp_reset_postdata();

	}

}
