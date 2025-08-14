<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// header
get_header();

// start the loop
while ( have_posts() ) {
	the_post();

	// post ID
	$blog_post_id = $post->ID;

	// post format
	$blog_post_format = get_post_format();
	if ( false === $blog_post_format ) {
		$blog_post_format = 'standard';
	}

	// views: increase the number of views
	if ( function_exists( 'halva_additional_features_increase_views' ) ) {
		halva_additional_features_increase_views( $blog_post_id );
	}

	// featured media (featured image / slider / video / audio): show or hide
	$show_featured_media = get_post_meta( $blog_post_id, 'halva_mb_single_show_featured_media', true ); // show or hide
	if ( ! $show_featured_media ) {
		$show_featured_media = 'show'; // show by default
	}

	// is the post password protected?
	$is_password_protected = post_password_required();

	// is this an attachment page?
	$is_attachment_page = is_attachment();
	?>

	<!-- main container with post -->
	<main class="bwp-single-post-section">

		<!-- single post -->
		<article id="bwp-post-<?php echo (int) $blog_post_id; ?>" <?php post_class(); ?>>

			<?php
			// post header (title and metadata)
			if ( get_the_title() ) {
				?>

				<!-- post header -->
				<header class="bwp-single-post-header">

					<?php
					// metadata
					if ( ! $is_attachment_page ) {
						halva_show_single_post_metadata( 'post', $is_password_protected );
					}
					?>

					<!-- title -->
					<h1 class="bwp-single-post-title entry-title"><?php the_title(); ?></h1>
					<!-- end: title -->

				</header>
				<!-- end: post header -->

				<?php
			}

			// post media (featured image / slider / video / audio)
			if ( 'show' === $show_featured_media && ! $is_password_protected && ! $is_attachment_page ) {
				if ( 'gallery' === $blog_post_format || 'video' === $blog_post_format || 'audio' === $blog_post_format ) {
					get_template_part( 'templates/single-post-media/media', $blog_post_format );
				} else {
					get_template_part( 'templates/single-post-media/media-image' );
				}
			}
			?>

			<!-- content container -->
			<div class="bwp-single-post-content">

				<?php
				// metadata
				if ( ! get_the_title() && ! $is_attachment_page ) {
					halva_show_single_post_metadata( 'post', $is_password_protected );
				}
				?>

				<!-- full content -->
				<div class="bwp-content entry-content clearfix">

					<?php
					// content
					the_content();
					?>

					<!-- clearfix -->
					<div class="clearfix"></div>

					<?php
					// pagination
					wp_link_pages( array(
						'before'			=> '<nav class="bwp-single-post-pagination bwp-hover-link-animation clearfix"><span>' . esc_html__( 'Pages:', 'halva' ) . '</span>',
						'after'				=> '</nav>',
						'next_or_number'	=> 'number',
					) );
					?>

				</div>
				<!-- end: full content -->

				<?php
				// categories: show or hide
				$show_categories = get_theme_mod( 'halva_single_show_categories', 1 ); // 1 or 0

				// tags: show or hide
				$show_tags_opt = get_theme_mod( 'halva_single_show_tags', 1 ); // 1 or 0
				$show_tags = $show_tags_opt && get_the_tags(); // true or false

				// show taxonomies (categories and tags)
				if ( ! $is_password_protected && ! $is_attachment_page && ( $show_categories || $show_tags ) ) {
					?>

					<!-- taxonomies (categories and tags) -->
					<div class="bwp-single-post-taxonomies">

						<?php
						// 1. Categories:
						if ( $show_categories ) {
							?>

							<!-- categories -->
							<div class="bwp-single-post-categories">
								<span class="bwp-taxonomy-label"><?php esc_html_e( 'Categories:', 'halva' ); ?></span>
								<?php the_category( ', ' ); ?>
							</div>
							<!-- end: categories -->

							<?php
						}

						// 2. Tags:
						if ( $show_tags ) {
							?>

							<!-- tags -->
							<div class="bwp-single-post-tags">
								<span class="bwp-taxonomy-label"><?php esc_html_e( 'Tags:', 'halva' ); ?></span>
								<?php the_tags( '', ', ', '' ); ?>
							</div>
							<!-- end: tags -->

							<?php
						}
						?>

					</div>
					<!-- end: taxonomies -->

					<?php
				}
				?>

			</div>
			<!-- end: content container -->

		</article>
		<!-- end: single post -->

		<?php
		// about the author
		$show_about_author = get_theme_mod( 'halva_single_show_about_author', 1 ); // 1 or 0
		if ( ! $is_password_protected && ! $is_attachment_page && $show_about_author ) {
			halva_show_about_author();
		}

		// post navigation
		$show_post_navigation = get_theme_mod( 'halva_single_show_post_navigation', 1 ); // 1 or 0
		if ( ! $is_attachment_page && $show_post_navigation ) {
			?>

			<!-- post navigation -->
			<div class="bwp-single-post-navigation">
				<div class="bwp-section-separator bwp-gradient"></div>
				<div class="bwp-single-post-navigation-container">
					<?php
					// navigation links
					the_post_navigation( array(
						'prev_text'	=> '<span class="meta-nav"><i class="fa-solid fa-angle-left"></i>' . esc_html__( 'Previous post', 'halva' ) . '</span><span class="post-title-nav">%title</span>',
						'next_text'	=> '<span class="meta-nav">' . esc_html__( 'Next post', 'halva' ) . '<i class="fa-solid fa-angle-right"></i></span><span class="post-title-nav">%title</span>',
					) );
					?>
				</div>
			</div>
			<!-- end: post navigation -->

			<?php
		}

		// comments
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		// related posts (by tags)
		if ( ! $is_password_protected && ! $is_attachment_page ) {
			get_template_part( 'templates/related-posts' );
		}
		?>

		<!-- section separator: -->
		<div class="bwp-section-separator bwp-gradient"></div>
	</main>
	<!-- end: main container with post -->

	<?php
}
// end of the loop

// footer
get_footer();
