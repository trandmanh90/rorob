<?php
/**
 * Views counter
 *
 * @since Halva Additional Features 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * The function returns the number of views
 *
 * @since Halva Additional Features 1.0
 */
function halva_additional_features_get_views( $blog_post_id ) {

	// get counter value
	$count_key = '_halva_post_views_count';
	$count = get_post_meta( $blog_post_id, $count_key, true );

	// if there is no counter
	if ( '' === $count ) {
		delete_post_meta( $blog_post_id, $count_key );
		add_post_meta( $blog_post_id, $count_key, '0' );
		return '0';
	}

	// counter number formatting
	$formatted_count = '';
	$precision = 1;
	$count = (int) $count;
	if ( $count >= 1000 && $count < 1000000 ) {
		$formatted_count = number_format( $count/1000, $precision ) . 'K';
	} elseif ( $count >= 1000000 ) {
		$formatted_count = number_format( $count/1000000, $precision ) . 'M';
	} else {
		$formatted_count = $count;
	}

	// remove zero
	$formatted_count = str_replace( '.0', '', $formatted_count );

	// return result
	return $formatted_count;

}


/**
 * The function increases the counter
 *
 * @since Halva Additional Features 1.0
 */
function halva_additional_features_increase_views( $blog_post_id ) {

	$increase_counter = false;

	// increase counter for guests only
	if ( ! current_user_can( 'edit_posts' ) ) {
		$increase_counter = true;
	}

	// exclude bots
	$get_user_agent = $_SERVER['HTTP_USER_AGENT'];
	$not_bot = 'Mozilla|Opera'; // Mozilla = (Chrome, Safari, Firefox, Netscape, etc)
	$bot = 'Bot/|robot|Slurp/|yahoo|yand';
	if ( ! preg_match( "/$not_bot/i", $get_user_agent ) || preg_match( "~$bot~i", $get_user_agent ) ) {
		$increase_counter = false;
	}

	// increase the counter or create a new one
	if ( $increase_counter ) {

		// get counter value
		$count_key = '_halva_post_views_count';
		$count = get_post_meta( $blog_post_id, $count_key, true );

		if ( '' === $count ) {
			// no counter, add zero
			delete_post_meta( $blog_post_id, $count_key );
			add_post_meta( $blog_post_id, $count_key, '0' );
		} else {
			// increase counter by one
			$count = (int) $count;
			$count++;
			update_post_meta( $blog_post_id, $count_key, $count );
		}

	}

}


/**
 * The function outputs HTML markup for the counter
 *
 * @since Halva Additional Features 1.0
 */
function halva_additional_features_show_views_counter( $blog_post_id ) {
	?>

	<!-- number of views -->
	<span class="bwp-counter-number"><?php echo esc_html( halva_additional_features_get_views( $blog_post_id ) ); ?></span>
	<!-- end: number of views -->

	<?php
}
