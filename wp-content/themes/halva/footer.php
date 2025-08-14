<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// show section with widgets
if ( is_active_sidebar( 'halva_footer_sidebar_left' ) || is_active_sidebar( 'halva_footer_sidebar_center' ) || is_active_sidebar( 'halva_footer_sidebar_right' ) ) {
	?>

	<!-- footer widgets -->
	<section class="bwp-footer-widgets-section" role="complementary">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Widgets', 'halva' ); ?></h2>
		<div class="container">
			<div class="bwp-footer-widgets-container">
				<div class="row">

					<!-- column 1 (left column) -->
					<div class="col-lg-4">
						<div class="bwp-footer-widgets-col-1 bwp-footer-widgets bwp-sidebar-content bwp-content">
							<?php
							if ( is_active_sidebar( 'halva_footer_sidebar_left' ) ) {
								dynamic_sidebar( 'halva_footer_sidebar_left' );
							}
							?>
						</div>
					</div>
					<!-- end: column 1 -->

					<!-- column 2 (center column) -->
					<div class="col-lg-4">
						<div class="bwp-footer-widgets-col-2 bwp-footer-widgets bwp-sidebar-content bwp-content">
							<?php
							if ( is_active_sidebar( 'halva_footer_sidebar_center' ) ) {
								dynamic_sidebar( 'halva_footer_sidebar_center' );
							}
							?>
						</div>
					</div>
					<!-- end: column 2 -->

					<!-- column 3 (right column) -->
					<div class="col-lg-4">
						<div class="bwp-footer-widgets-col-3 bwp-footer-widgets bwp-sidebar-content bwp-content">
							<?php
							if ( is_active_sidebar( 'halva_footer_sidebar_right' ) ) {
								dynamic_sidebar( 'halva_footer_sidebar_right' );
							}
							?>
						</div>
					</div>
					<!-- end: column 3 -->

				</div>
			</div>
		</div>
		<!-- section separator: -->
		<div class="bwp-section-separator bwp-gradient"></div>
	</section>
	<!-- end: footer widgets -->

	<?php
}
// end: widgets

// footer text
$footer_text = get_theme_mod( 'halva_footer_text', 'Halva Theme - Powered by WordPress' );
// footer menu: exists or not
$has_footer_menu = has_nav_menu( 'halva_footer_menu' ); // true or false

// show footer
if ( '' !== $footer_text || $has_footer_menu ) {
	?>

	<!-- footer -->
	<footer class="bwp-site-footer">
		<div class="container">
			<div class="bwp-site-footer-container">

				<?php
				// footer text
				if ( '' !== $footer_text ) {
					?>

					<!-- footer text -->
					<div class="bwp-footer-text">
						<?php
						echo wp_kses( $footer_text, array(
							'p'			=> array(
								'class'		=> array(),
							),
							'a'			=> array(
								'href'		=> array(),
								'title'		=> array(),
								'target'	=> array(),
								'class'		=> array(),
								'rel'		=> array(),
							),
							'span'		=> array(
								'class'		=> array(),
							),
							'strong'	=> array(),
							'b'			=> array(),
							'em'		=> array(),
							'i'			=> array(
								'class'		=> array(),
							),
							'br'		=> array(),
						) );
						?>
					</div>
					<!-- end: footer text -->

					<?php
				}

				// footer menu
				if ( $has_footer_menu ) {
					?>

					<!-- footer menu -->
					<div class="bwp-footer-menu">
						<?php
						// show footer menu (no dropdown menu support)
						wp_nav_menu( array(
							'theme_location'	=> 'halva_footer_menu',
							'container'			=> 'nav',
							'menu_class'		=> 'bwp-footer-menu-list list-unstyled',
							'depth'				=> 1,
						) );
						?>
					</div>
					<!-- end: footer menu -->

					<?php
				}
				?>

			</div>
		</div>
	</footer>
	<!-- end: footer -->

	<?php
}
// end: footer
?>

</div><!-- /.bwp-site-content -->
<!-- end: container with site content -->

<!-- sticky bar with buttons -->
<div id="bwp-sticky-buttons" class="bwp-sticky-buttons-container clearfix">

	<?php
	// mobile menu (menu button and dropdown container with mobile menu)
	if ( has_nav_menu( 'halva_main_menu' ) ) {
		?>

		<!-- mobile menu -->
		<nav class="bwp-mobile-menu-container">
			<button type="button" id="bwp-toggle-mobile-menu" class="bwp-button bwp-toggle-mobile-menu-button">
				<i class="fa-solid fa-bars"></i><span class="bwp-button-text"><?php esc_html_e( 'Menu', 'halva' ); ?></span>
			</button>
			<div id="bwp-dropdown-mobile-menu" class="bwp-dropdown-mobile-menu-container bwp-hidden">
				<?php
				// show mobile menu
				wp_nav_menu( array(
					'theme_location'	=> 'halva_main_menu',
					'container'			=> '',
					'menu_class'		=> 'bwp-mobile-menu list-unstyled',
				) );
				// show subscribe link
				halva_nav_subscribe_link();
				// show search form
				get_search_form();
				// show social links
				halva_nav_social_links();
				?>
			</div>
		</nav>
		<!-- end: mobile menu -->

		<?php
	}
	?>

	<!-- buttons -->
	<div class="bwp-mobile-buttons clearfix">

		<?php
		// button: show hidden navigation
		$show_hidden_navigation = get_theme_mod( 'halva_enable_hidden_nav', 0 ); // 1 or 0
		if ( $show_hidden_navigation ) {
			?>

			<!-- button: show hidden navigation -->
			<button type="button" id="bwp-show-main-nav" class="bwp-button bwp-show-main-nav-button bwp-sticky-button bwp-separator-bottom">
				<span class="bwp-bars-icon"></span>
			</button>
			<!-- end: button -->

			<?php
		}

		// button: show hidden sidebar
		$show_hidden_sidebar = is_active_sidebar( 'halva_sidebar' ) && get_theme_mod( 'halva_button_show_hidden_sidebar', 1 ); // true or false
		if ( $show_hidden_sidebar ) {
			?>

			<!-- button: show sidebar -->
			<button type="button" id="bwp-show-sidebar" class="bwp-button bwp-show-sidebar-button bwp-sticky-button bwp-separator-bottom bwp-separator-left">
				<i class="fa-solid fa-arrow-left"></i>
			</button>
			<!-- end: button -->

			<?php
		}

		// button: color switch
		$show_color_switch = get_theme_mod( 'halva_button_color_mode', 0 ); // 1 or 0
		if ( $show_color_switch ) {
			// get current color scheme
			$current_color_scheme = halva_get_current_color_scheme(); // light or dark
			?>

			<!-- button: color switch (light or dark mode) -->
			<button type="button" id="bwp-toggle-color" class="bwp-button bwp-toggle-color-button bwp-sticky-button bwp-separator-bottom bwp-separator-left">
				<?php if ( 'light' === $current_color_scheme ) { ?>
					<i class="fa-regular fa-moon"></i>
				<?php } else { ?>
					<i class="fa-solid fa-sun"></i>
				<?php } ?>
			</button>
			<!-- end: button -->

			<?php
		}

		// font types (font button and dropdown container with available fonts)
		$show_font_types = get_theme_mod( 'halva_button_font_types', 0 ); // 1 or 0
		if ( $show_font_types ) {
			// get current font type
			$current_font_type = halva_get_current_font_type(); // sans-serif or serif
			?>

			<!-- font types (sans-serif or serif) -->
			<div class="bwp-font-types bwp-separator-bottom bwp-separator-left">
				<button type="button" id="bwp-show-font-types" class="bwp-button bwp-show-font-types-button bwp-sticky-button">
					<i class="fa-solid fa-font"></i>
				</button>
				<div id="bwp-dropdown-fonts" class="bwp-dropdown-fonts-container bwp-hidden">
					<button type="button" class="bwp-button bwp-font-type<?php if ( 'sans-serif' === $current_font_type ) { echo ' bwp-active'; } ?>" data-font-type="sans-serif"><?php esc_html_e( 'Sans-serif fonts', 'halva' ); ?></button>
					<button type="button" class="bwp-button bwp-font-type<?php if ( 'serif' === $current_font_type ) { echo ' bwp-active'; } ?>" data-font-type="serif"><?php esc_html_e( 'Serif fonts', 'halva' ); ?></button>
				</div>
			</div>
			<!-- end: font types -->

			<?php
		}

		// search (search button and dropdown search form)
		$show_search = get_theme_mod( 'halva_button_show_search', 1 ); // 1 or 0
		if ( $show_search ) {
			?>

			<!-- search -->
			<div class="bwp-dropdown-search bwp-separator-bottom bwp-separator-left">
				<button type="button" id="bwp-toggle-search" class="bwp-button bwp-toggle-search-button bwp-sticky-button">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
				<div id="bwp-dropdown-searchform" class="bwp-dropdown-search-container bwp-hidden">
					<?php
					// search form
					get_search_form();
					?>
				</div>
			</div>
			<!-- end: search -->

			<?php
		}
		?>

	</div>
	<!-- end: buttons -->

</div>
<!-- end: sticky bar with buttons -->

<?php
// button: back to top
$show_back_to_top = get_theme_mod( 'halva_button_back_to_top', 1 ); // 1 or 0
if ( $show_back_to_top ) {
	?>

	<!-- back to top -->
	<div id="bwp-scroll-top" class="bwp-scroll-top-wrapper">
		<button type="button" class="bwp-button bwp-scroll-top-button" tabindex="-1">
			<i class="fa-solid fa-arrow-up"></i>
		</button>
	</div>
	<!-- end: back to top -->

	<?php
}

// hidden sidebar (sidebar id: halva_sidebar)
if ( is_active_sidebar( 'halva_sidebar' ) && get_theme_mod( 'halva_button_show_hidden_sidebar', 1 ) ) {
	?>

	<!-- hidden sidebar -->
	<aside id="bwp-sidebar" class="bwp-hidden-sidebar" tabindex="0">

		<!-- close sidebar -->
		<button type="button" class="bwp-button bwp-hide-sidebar bwp-hide-sidebar-button">
			<i class="fa-solid fa-arrow-right"></i>
		</button>
		<!-- end: close sidebar -->

		<!-- sidebar content -->
		<div class="bwp-hidden-sidebar-content bwp-sidebar-content bwp-content">
			<?php dynamic_sidebar( 'halva_sidebar' ); ?>
		</div>
		<!-- end: sidebar content -->

	</aside>
	<!-- end: hidden sidebar -->

	<!-- sidebar overlay -->
	<div class="bwp-hidden-sidebar-overlay bwp-hide-sidebar"></div>

	<?php
}
// end: hidden sidebar

// cookies notice (show only if the "Halva Additional Features" plugin is activated)
if ( function_exists( 'halva_additional_features_show_cookies_notice' ) ) {
	halva_additional_features_show_cookies_notice();
}

wp_footer();
?>
</body>
</html>
