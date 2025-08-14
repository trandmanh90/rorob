<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// hidden navigation: enable/disable
$enable_hidden_nav = get_theme_mod( 'halva_enable_hidden_nav', 0 ); // 1 or 0
if ( $enable_hidden_nav ) {
	?>

	<!-- main navigation (hidden) -->
	<nav id="bwp-main-nav" class="bwp-hidden-main-nav" tabindex="0">
		<div class="container-fluid">
			<div class="bwp-main-nav-container">

				<?php
				// logo (image or text)
				halva_show_hidden_nav_logo();
				?>

				<!-- central block -->
				<div class="bwp-central-block clearfix">

					<?php
					// main menu
					halva_show_main_menu();

					// social links
					halva_nav_social_links();

					// subscribe
					halva_nav_subscribe_link();
					?>

				</div>
				<!-- end: central block -->

			</div>
		</div>
		<button type="button" class="bwp-button bwp-hide-main-nav bwp-hide-main-nav-button">
			<i class="fa-solid fa-arrow-up"></i>
		</button>
	</nav>
	<div class="bwp-hidden-main-nav-overlay bwp-hide-main-nav"></div>
	<!-- end: main navigation (hidden) -->

	<?php
}
// end: hidden navigation
?>

<!-- container with site content -->
<div class="bwp-site-content">

	<!-- header -->
	<header class="bwp-site-header">
		<div class="container">
			<div class="bwp-site-header-container">

				<?php
				// main logo (image or text)
				halva_show_main_logo();

				// site title (h1)
				if ( ! is_singular() && ! is_404() ) {
					$site_title = get_bloginfo( 'name' );
					?>

					<!-- site title -->
					<h1 class="bwp-site-title screen-reader-text"><?php echo esc_html( $site_title ); ?></h1>
					<!-- end: site title -->

					<?php
				}
				?>

			</div>
		</div>
	</header>
	<!-- end: header -->

	<!-- secondary navigation -->
	<nav class="bwp-secondary-nav">
		<div class="container">
			<div class="bwp-secondary-nav-container">
				<div class="bwp-central-block clearfix">

					<?php
					// main menu
					halva_show_main_menu();

					// social links
					halva_nav_social_links();

					// subscribe
					halva_nav_subscribe_link();
					?>

				</div>
			</div>
		</div>
	</nav>
	<!-- end: secondary navigation -->
