<?php
/**
 * Brute Force Protection Model
 * Called from Brute Force Class
 *
 * @file  The Brute Force Comments file
 * @package HMWP/BruteForce/Comments
 * @since 8.1
 */

defined( 'ABSPATH' ) || die( 'Cheatin\' uh?' );

class HMWP_Models_Bruteforce_Comments {

	public function __construct() {

		add_filter( 'preprocess_comment', array( $this, 'call' ) );
		add_filter( 'comment_form_default_fields', array( $this, 'form' ) );

	}

	/**
	 *
	 * Validate comments before being submitted in the frontend by not logged-in users
	 *
	 * @param  array  $commentdata  The data of the comment being submitted.
	 *
	 * @return array The validated/filtered comment data.
	 * @throws Exception
	 */
	public function call( $commentdata ) {

		/** @var HMWP_Models_Brute $bruteForceModel */
		$bruteForceModel = HMWP_Classes_ObjController::getClass( 'HMWP_Models_Brute' );

		// Check bruteforce only in frontend for not logged users
		$response = $bruteForceModel->bruteForceCheck();

		// Get the active Brute Force class
		$error = $bruteForceModel->getInstance()->authenticate( false, $response );

		// Show the brute force error in the comment form
		if ( is_wp_error( $error ) ) {
			$have_gettext = function_exists( '__' );
			$back_text    = $have_gettext ? __( '&laquo; Back' ) : '&laquo; Back';
			wp_die( $error->get_error_message() . "\n<p><a href='javascript:history.back()'>$back_text</a></p>" );
		}

		return $commentdata;
	}


	/**
	 * Modify the comment form fields to include anti-spam mechanisms based on the plugin settings.
	 *
	 * @param  array  $fields  Existing comment form fields.
	 *
	 * @return array Modified comment form fields.
	 * @throws Exception
	 */
	public function form( $fields ) {

		/** @var HMWP_Models_Brute $bruteForceModel */
		$bruteForceModel = HMWP_Classes_ObjController::getClass( 'HMWP_Models_Brute' );

		// Get the active Brute Force class
		$bruteforce = $bruteForceModel->getInstance();

		ob_start();
		$bruteforce->head() . $bruteforce->form();
		$output = '<div class="comment-recaptcha" >' . ob_get_clean() . '</div>';

		if ( $output ) {
			$fields['hmwp_recapcha'] = $output;
		}

		return $fields;
	}

}
