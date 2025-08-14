<?php
/**
 * This is a template for displaying posts on the main page and all archive pages
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// post ID
$blog_post_id = $post->ID;
// post format
$blog_post_format = get_post_format();
// post type
$blog_post_type = 'post';

// if the post format is standard
if ( false === $blog_post_format ) {
	$blog_post_format = 'standard';
	$blog_post_type = get_post_type();
}

// is the post password protected?
$is_password_protected = post_password_required();
?>

<!-- post -->
<article id="bwp-post-<?php echo (int) $blog_post_id; ?>" <?php post_class(); ?>>
	<div class="bwp-post-wrapper">

		<?php
		// post media (featured image / slider / video / audio)
		if ( 'gallery' === $blog_post_format || 'video' === $blog_post_format || 'audio' === $blog_post_format ) {
			get_template_part( 'templates/blog-post-media/media', $blog_post_format );
		} else {
			get_template_part( 'templates/blog-post-media/media-image' );
		}
		?>

		<!-- content -->
		<div class="bwp-post-content">

			<?php
			// sticky post: icon
			if ( is_sticky() ) {
				?>

				<!-- sticky post icon -->
				<div class="bwp-post-sticky-mark">
					<i class="fa-solid fa-thumbtack"></i>
				</div>
				<!-- end: sticky post icon -->

				<?php
			}
			?>

			<!-- post header -->
			<header class="bwp-post-header">

				<?php
				// metadata: display options
				$show_date = get_theme_mod( 'halva_posts_show_date', 1 ); // 1 or 0
				$show_author = get_theme_mod( 'halva_posts_show_author', 0 ); // 1 or 0
				$show_categories = ( 'post' === $blog_post_type ) ? get_theme_mod( 'halva_posts_show_categories', 0 ) : 0; // 1 or 0
				$show_metadata = $show_date || $show_author || $show_categories; // true or false
				?>

				<!-- metadata (dates, author, and categories) -->
				<ul class="bwp-post-metadata list-unstyled<?php if ( ! $show_metadata ) { echo ' bwp-hidden'; } ?>">

					<?php
					// 1. Publication date:
					// date format
					$date_format_opt = get_option( 'date_format' );
					// post type: post
					if ( 'post' === $blog_post_type ) {
						// year, month, day
						$time_year = get_the_time( 'Y' );
						$time_month = get_the_time( 'm' );
						$time_day = get_the_time( 'd' );
						?>

						<!-- publication date (link to archive) -->
						<li class="bwp-date<?php if ( ! $show_date ) { echo ' bwp-hidden'; } ?>">
							<a href="<?php echo esc_url( get_day_link( $time_year, $time_month, $time_day ) ); ?>">
								<time datetime="<?php the_time( 'c' ); ?>" class="date published"><?php the_time( $date_format_opt ); ?></time>
							</a>
						</li>
						<!-- end: publication date -->

						<?php
					} else {
						// post type: page
						?>

						<!-- publication date (permalink) -->
						<li class="bwp-date<?php if ( ! $show_date ) { echo ' bwp-hidden'; } ?>">
							<a href="<?php the_permalink(); ?>">
								<time datetime="<?php the_time( 'c' ); ?>" class="date published"><?php the_time( $date_format_opt ); ?></time>
							</a>
						</li>
						<!-- end: publication date -->

						<?php
					}

					// 2. Post update date:
					?>

					<!-- post update date (or modification date) -->
					<li class="bwp-date-updated bwp-hidden">
						<time datetime="<?php the_modified_time( 'c' ); ?>" class="date updated"><?php the_modified_time( $date_format_opt ); ?></time>
					</li>
					<!-- end: post update date -->

					<?php
					// 3. Author:
					// author data: id, name, and author posts url
					$author_id = get_the_author_meta( 'ID' );
					$author_display_name = get_the_author_meta( 'display_name' );
					$author_posts_url = get_author_posts_url( $author_id );
					?>

					<!-- author -->
					<li class="bwp-author<?php if ( ! $show_author ) { echo ' bwp-hidden'; } ?>">
						<a href="<?php echo esc_url( $author_posts_url ); ?>" rel="author">
							<span class="vcard author"><span class="fn"><?php echo esc_html( $author_display_name ); ?></span></span>
						</a>
					</li>
					<!-- end: author -->

					<?php
					// 4. Categories:
					if ( 'post' === $blog_post_type ) {
						?>

						<!-- categories -->
						<li class="bwp-categories<?php if ( ! $show_categories ) { echo ' bwp-hidden'; } ?>">
							<?php the_category( ', ' ); ?>
						</li>
						<!-- end: categories -->

						<?php
					}
					?>

				</ul>
				<!-- end: metadata -->

				<?php
				// post title
				if ( get_the_title() ) {
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

					<!-- title -->
					<h3 class="bwp-post-title entry-title">
						<?php if ( 'link' === $blog_post_format ) { ?>
							<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ( '_blank' === $link_target ) { echo ' rel="noopener noreferrer"'; } ?>><?php the_title(); ?></a>
						<?php } else {  ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php } ?>
					</h3>
					<!-- end: title -->

					<?php
				}
				?>

			</header>
			<!-- end: post header -->

			<?php
			// Excerpt:
			// depending on the format, display an excerpt or full content
			$formats_with_excerpt = array(
				'standard',
				'image',
				'gallery',
				'audio',
				'video',
			);
			$blog_post_with_excerpt = ( in_array( $blog_post_format, $formats_with_excerpt ) ) ? true : false;

			// show excerpt or content
			if ( $blog_post_with_excerpt ) {
				// excerpt (the_excerpt; formats: standard, image, gallery, audio, and video)
				?>

				<!-- excerpt -->
				<div class="bwp-post-excerpt entry-content">
					<?php the_excerpt(); ?>
				</div>
				<!-- end: excerpt -->

				<?php
			} else {
				// post content (the_content; formats: aside, link, quote, status, and chat)
				?>

				<!-- excerpt (content) -->
				<div class="bwp-post-excerpt bwp-content entry-content clearfix">
					<?php the_content( '[...]', false ); ?>
					<div class="clearfix"></div>
				</div>
				<!-- end: excerpt -->

				<?php
			}

			// Read more and Counters (views and comments):
			// read more (show or hide)
			$show_read_more_opt = get_theme_mod( 'halva_posts_show_read_more', 1 ); // 1 or 0
			$read_more_text = get_theme_mod( 'halva_posts_read_more_text', 'Read More' );
			$show_read_more = $show_read_more_opt && '' !== $read_more_text; // true or false
			// views counter (show or hide)
			$show_views_counter_opt = get_theme_mod( 'halva_posts_show_views_counter', 1 ); // 1 or 0
			$show_views_counter = function_exists( 'halva_additional_features_show_views_counter' ) && $show_views_counter_opt; // true or false
			// comments counter (show or hide)
			$show_comments_counter_opt = get_theme_mod( 'halva_posts_show_comments_counter', 1 ); // 1 or 0
			$show_comments_counter = $show_comments_counter_opt && ( comments_open() || get_comments_number() ); // true or false

			if ( $show_read_more || $show_views_counter || $show_comments_counter ) {
				?>

				<!-- read more and counters (views and comments) -->
				<ul class="bwp-post-links list-unstyled">

					<?php
					// 1. Read more
					if ( $show_read_more ) {
						?>

						<!-- read more -->
						<li class="bwp-read-more">
							<a href="<?php the_permalink(); ?>" class="bwp-read-more-link"><?php echo esc_html( $read_more_text ); ?></a>
							<span class="bwp-separator"></span>
						</li>
						<!-- end: read more -->

						<?php
					}

					// 2. Counters: Views and Comments
					if ( ! $is_password_protected ) {

						// number of views
						if ( $show_views_counter ) {
							?>

							<!-- views -->
							<li class="bwp-views-counter">
								<a href="<?php the_permalink(); ?>">
									<?php halva_additional_features_show_views_counter( $blog_post_id ); ?>
								</a>
								<span class="bwp-separator"></span>
							</li>
							<!-- end: views -->

							<?php
						}

						// number of comments
						if ( $show_comments_counter ) {
							?>

							<!-- comments counter -->
							<li class="bwp-comments-counter">
								<a href="<?php the_permalink(); ?>#comments">
									<span class="bwp-counter-number"><?php comments_number( '0', '1', '%' ); ?></span>
								</a>
								<span class="bwp-separator"></span>
							</li>
							<!-- end: comments counter -->

							<?php
						}

					}
					?>

				</ul>
				<!-- end: read more and counters -->

				<?php
			}
			?>

		</div>
		<!-- end: content -->

	</div>
</article>
<!-- end: post -->
