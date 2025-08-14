<?php
/**
 * The template for displaying random posts
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// query arguments
$random_posts_args = array(
	'post_type'				=> 'post',
	'posts_per_page'		=> 3,
	'orderby'				=> 'rand',
	'ignore_sticky_posts'	=> true,
);

// start query
$random_posts = new WP_Query( $random_posts_args );
if ( $random_posts->have_posts() ) {
	?>

	<!-- random posts -->
	<div class="bwp-random-posts">
		<div class="bwp-section-separator bwp-gradient"></div>
		<h2 class="bwp-random-posts-title"><?php esc_html_e( 'Posts from our blog', 'halva' ); ?></h2>
		<div class="bwp-random-posts-container clearfix">

			<?php
			while ( $random_posts->have_posts() ) {
				$random_posts->the_post();

				// post ID
				$random_post_id = $post->ID;

				// post format
				$random_post_format = get_post_format();
				if ( false === $random_post_format ) {
					$random_post_format = 'standard';
				}
				?>

				<!-- post -->
				<article id="bwp-post-<?php echo (int) $random_post_id; ?>" <?php post_class(); ?>>
					<div class="bwp-post-wrapper">

						<?php
						// post media (featured image / slider / video / audio)
						if ( 'gallery' === $random_post_format || 'video' === $random_post_format || 'audio' === $random_post_format ) {
							get_template_part( 'templates/blog-post-media/media', $random_post_format );
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
	<!-- end: random posts -->

	<?php
}

// reset post data
wp_reset_postdata();
