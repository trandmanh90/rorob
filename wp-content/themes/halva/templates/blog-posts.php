<?php
/**
 * The template for displaying blog posts with pagination
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

if ( is_home() ) {

	// carousel with posts
	$show_carousel_on_first_page = get_theme_mod( 'halva_show_carousel_on_first_page', 0 ); // 1 or 0
	if ( $show_carousel_on_first_page ) {
		// show carousel with posts only on the first page of pagination
		$show_carousel = ( ! is_paged() ) ? 'show' : 'hide';
	} else {
		// show carousel with posts on all pagination pages
		$show_carousel = 'show';
	}

	// show carousel
	if ( 'show' === $show_carousel ) {
		get_template_part( 'templates/homepage-carousel' );
	}

}
?>

<!-- latest posts section -->
<section class="bwp-latest-posts-section">
	<div class="bwp-section-separator bwp-gradient"></div>
	<div class="container">
		<div class="bwp-latest-posts-container">

			<?php
			// archive page: title and subtitle
			halva_show_archive_header();

			// top bar with page numbers and layout switches (* show the top bar only if there are posts to display)
			if ( have_posts() ) {
				halva_show_blog_top_bar();
			}

			// get current blog layout (one column or three columns)
			$current_blog_layout = halva_get_current_blog_layout(); // col-1 or col-3
			$blog_layout_class = ( 'col-3' === $current_blog_layout ) ? 'bwp-col-3-layout' : 'bwp-col-1-layout';
			?>

			<!-- main section with posts -->
			<div class="bwp-posts" role="main">
				<div class="bwp-posts-wrapper">

					<!-- masonry -->
					<div id="bwp-masonry" class="<?php echo sanitize_html_class( $blog_layout_class ); ?> clearfix">
						<div class="bwp-col-size"></div><!-- width of .bwp-col-size used for columnWidth; this block must be empty -->

						<?php
						// start the loop
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'templates/post' );
							}
						}
						// end the loop
						?>

					</div>
					<!-- end: masonry -->

					<?php
					// if no content, include the "No post found" template
					if ( ! have_posts() ) {
						get_template_part( 'templates/no-posts' );
					}
					?>

				</div>
			</div>
			<!-- end: main section with posts -->

			<?php
			// pagination
			the_posts_pagination( array(
				'prev_text'	=> '<i class="fa-solid fa-left-long"></i><span class="screen-reader-text">' . esc_html__( 'Newer Posts', 'halva' ) . '</span>',
				'next_text'	=> '<span class="screen-reader-text">' . esc_html__( 'Older Posts', 'halva' ) . '</span><i class="fa-solid fa-right-long"></i>',
			) );
			?>

		</div>
	</div>
	<!-- section separator: -->
	<div class="bwp-section-separator bwp-gradient"></div>
</section>
<!-- end: latest posts section -->
