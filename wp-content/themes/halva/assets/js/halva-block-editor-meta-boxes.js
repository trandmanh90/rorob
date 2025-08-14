/**
 * Show/hide meta boxes in block editor (Admin side)
 * halva-block-editor-meta-boxes.js v1.0
 */

( function( $ ) {
	'use strict';
	$( document ).ready( function() {

		// stop the function if wp.data.select('core/editor') is null or undefined
		if ( null === wp.data.select( 'core/editor' ) || undefined === wp.data.select( 'core/editor' ) ) {
			return;
		}

		// initial post format
		var	getPostFormat = () => wp.data.select( 'core/editor' ).getEditedPostAttribute( 'format' ),
			postFormat = getPostFormat();

		// meta boxes for different formats
		var	$galleryBox = $( '#halva_mb_gallery_format' ), // gallery format
			$videoBox = $( '#halva_mb_video_format' ), // video format
			$audioBox = $( '#halva_mb_audio_format' ), // audio format
			$linkBox = $( '#halva_mb_link_format' ); // link format

		// start tracking changes on the editor page
		wp.data.subscribe( () => {

			// changes have occurred: get the current post format
			var newPostFormat = getPostFormat();

			// if the post format has been changed
			if ( postFormat !== newPostFormat ) {
				// show the desired meta box:

				// gallery format: show meta box
				if ( 'gallery' === newPostFormat ) {
					$galleryBox.show();
					$videoBox.hide();
					$audioBox.hide();
					$linkBox.hide();
				}

				// video format: show meta box
				if ( 'video' === newPostFormat ) {
					$videoBox.show();
					$galleryBox.hide();
					$audioBox.hide();
					$linkBox.hide();
				}

				// audio format: show meta box
				if ( 'audio' === newPostFormat ) {
					$audioBox.show();
					$galleryBox.hide();
					$videoBox.hide();
					$linkBox.hide();
				}

				// link format: show meta box
				if ( 'link' === newPostFormat ) {
					$linkBox.show();
					$galleryBox.hide();
					$videoBox.hide();
					$audioBox.hide();
				}

				// hide meta boxes for all other formats
				if (
					'image' === newPostFormat ||
					'standard' === newPostFormat ||
					'aside' === newPostFormat ||
					'quote' === newPostFormat ||
					'status' === newPostFormat ||
					'chat' === newPostFormat
				) {
					$galleryBox.hide();
					$videoBox.hide();
					$audioBox.hide();
					$linkBox.hide();
				}

			}

			// update the postFormat variable
			postFormat = newPostFormat;

		} );

	} );
} )( jQuery );
