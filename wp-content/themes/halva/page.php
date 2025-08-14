<?php
/**
 * The template for displaying all single pages
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

	// page ID
	$page_id = $post->ID;

	// views: increase the number of views
	if ( function_exists( 'halva_additional_features_increase_views' ) ) {
		halva_additional_features_increase_views( $page_id );
	}

	// is the page password protected?
	$is_password_protected = post_password_required();

	// is this an attachment page?
	$is_attachment_page = is_attachment();
	?>

	<!-- main container with post -->
	<main class="bwp-single-post-section">

		<!-- single post (post type: page) -->
		<article id="bwp-page-<?php echo (int) $page_id; ?>" <?php post_class(); ?>>

			<?php
			// post header (title and metadata)
			if ( get_the_title() ) {
				?>

				<!-- post header -->
				<header class="bwp-single-post-header">

					<?php
					// metadata
					if ( ! $is_attachment_page ) {
						halva_show_single_post_metadata( 'page', $is_password_protected );
					}
					?>

					<!-- title -->
					<h1 class="bwp-single-post-title entry-title"><?php the_title(); ?></h1>
					<!-- end: title -->

				</header>
				<!-- end: post header -->

				<?php
			}

			// featured image
			if ( ! $is_password_protected && ! $is_attachment_page ) {
				get_template_part( 'templates/single-post-media/media-image' );
			}
			?>

			<!-- content container -->
			<div class="bwp-single-post-content">

				<?php
				// metadata
				if ( ! get_the_title() && ! $is_attachment_page ) {
					halva_show_single_post_metadata( 'page', $is_password_protected );
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

			</div>
			<!-- end: content container -->

		</article>
		<!-- end: single post -->

		<?php
		// comments
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		// random posts
		$show_random_posts = get_theme_mod( 'halva_page_show_random_posts', 1 ); // 1 or 0
		if ( $show_random_posts && ! $is_password_protected && ! $is_attachment_page ) {
			get_template_part( 'templates/random-posts' );
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
