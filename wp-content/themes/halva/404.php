<?php
/**
 * The template for displaying 404 page
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// header
get_header();
?>

<!-- content for page 404 -->
<section class="bwp-page-404-section" role="main">
	<div class="container">
		<div class="bwp-page-404-container">
			<div class="bwp-page-404-content">
				<h1><?php esc_html_e( 'Oops... Error 404', 'halva' ); ?></h1>
				<h2><?php esc_html_e( 'We are sorry, but the page you are looking for does not exist.', 'halva' ); ?></h2>
				<p><?php printf( __( 'Please check entered address and try again or go to <a href="%1$s" rel="home">Homepage</a>.', 'halva' ), esc_url( home_url( '/' ) ) ); ?></p>
			</div>
		</div>
	</div>
</section>
<!-- end: content for page 404 -->

<?php
// footer
get_footer();
