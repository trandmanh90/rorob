/**
 * Meta boxes with additional options (Admin side)
 * halva-meta-boxes.js v1.0
 */

( function( $ ) {
	'use strict';
	$( document ).ready( function() {

		// meta boxes for different formats
		var	$galleryBox = $( '#halva_mb_gallery_format' ), // gallery format
			$videoBox = $( '#halva_mb_video_format' ), // video format
			$audioBox = $( '#halva_mb_audio_format' ), // audio format
			$linkBox = $( '#halva_mb_link_format' ); // link format


		/**
		 * Hide all meta boxes
		 */
		function hideAllMetaBoxes() {

			// gallery format: hide meta box
			$galleryBox.hide();
			// video format: hide meta box
			$videoBox.hide();
			// audio format: hide meta box
			$audioBox.hide();
			// link format: hide meta box
			$linkBox.hide();

		}

		hideAllMetaBoxes();


		/**
		 * Show/hide meta boxes for classic editor
		 */
		function showHideMetaBoxesClassic() {

			// meta box for gallery format
			if ( $( 'input#post-format-gallery' ).is( ':checked' ) ) {
				$galleryBox.show();
			} else {
				$galleryBox.hide();
			}

			// meta box for video format
			if ( $( 'input#post-format-video' ).is( ':checked' ) ) {
				$videoBox.show();
			} else {
				$videoBox.hide();
			}

			// meta box for audio format
			if ( $( 'input#post-format-audio' ).is( ':checked' ) ) {
				$audioBox.show();
			} else {
				$audioBox.hide();
			}

			// meta box for link format
			if ( $( 'input#post-format-link' ).is( ':checked' ) ) {
				$linkBox.show();
			} else {
				$linkBox.hide();
			}

		}

		showHideMetaBoxesClassic();

		// classic editor: format selection
		$( '#post-formats-select input' ).on( 'click', showHideMetaBoxesClassic );

	} );
} )( jQuery );
