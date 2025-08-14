<?php
/**
 * Cookies notice
 *
 * @since Halva Additional Features 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * The function displays a window with information about cookies
 *
 * @since Halva Additional Features 1.0
 */
function halva_additional_features_show_cookies_notice() {

	// show or hide notification
	$show_cookies_notice = get_theme_mod( 'halva_show_cookies_notice', 0 ); // 1 or 0
	// was the accept button pressed or not? ("yes", if the "Accept" button was pressed, otherwise "no")
	$cookies_accepted = ( ! empty( $_COOKIE['halva_cookies_accepted'] ) ) ? $_COOKIE['halva_cookies_accepted'] : 'no'; // 'yes' or 'no'

	if ( $show_cookies_notice && 'yes' !== $cookies_accepted ) {

		// content: title, text, and button text (all fields are required)
		$cookies_notice_title = get_theme_mod( 'halva_cookies_notice_title', 'Cookies Notice' );
		$cookies_notice_text = get_theme_mod( 'halva_cookies_notice_text', 'Our website use cookies. If you continue to use this site we will assume that you are happy with this.' );
		$cookies_notice_button_text = get_theme_mod( 'halva_cookies_notice_button_text', 'I Agree' );

		if ( '' !== $cookies_notice_title && '' !== $cookies_notice_text && '' !== $cookies_notice_button_text ) {

			// type of notification on mobile devices
			$cookies_notice_on_mobile = get_theme_mod( 'halva_cookies_notice_on_mobile', 'hidden' ); // 'hidden' or 'visible'

			// if the notification is hidden on mobile devices, then we display a button to call the notification
			if ( 'hidden' === $cookies_notice_on_mobile ) {
				?>

				<!-- button: show information about cookies -->
				<button type="button" id="bwp-show-cookies-info" class="bwp-button-show-cookies-info bwp-button bwp-with-text">
					<i class="fa-solid fa-sort"></i><span class="bwp-button-text"><?php echo esc_html( $cookies_notice_title ); ?></span>
				</button>
				<!-- end: button -->

				<?php
			}
			?>

			<!-- information about cookies -->
			<div id="bwp-cookies-info" class="bwp-cookies-info-container clearfix<?php if ( 'hidden' === $cookies_notice_on_mobile ) { echo ' bwp-hidden-on-mobile'; } ?>">

				<?php
				// if the notification is hidden on mobile devices, then display a button to close the notification
				if ( 'hidden' === $cookies_notice_on_mobile ) {
					?>

					<!-- close button -->
					<button type="button" id="bwp-hide-cookies-info" class="bwp-button-hide-cookies-info bwp-button">
						<i class="fa-solid fa-xmark"></i>
					</button>
					<!-- end: close button -->

					<?php
				}
				?>

				<!-- cookies notice: title -->
				<h3 class="bwp-cookies-info-title"><?php echo esc_html( $cookies_notice_title ); ?></h3>
				<!-- end: title -->

				<!-- cookies notice: content -->
				<div class="bwp-cookies-info-content">
					<?php
					echo wp_kses( $cookies_notice_text, array(
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
				<!-- end: content -->

				<!-- "accept cookies" button -->
				<button type="button" id="bwp-accept-cookies" class="bwp-accept-cookies-button bwp-button bwp-with-text"><?php echo esc_html( $cookies_notice_button_text ); ?></button>
				<!-- end: "accept cookies" button -->

			</div>
			<!-- end: information about cookies -->

			<?php
		}

	}

}
