/**
 * Plugin name: Halva Additional Features
 * halva-additional-features-plugin.js v1.0
 */

( function( $ ) {
	'use strict';
	$( document ).ready( function() {

		var $cookiesInfoContainer = $( '#bwp-cookies-info' ),
			$acceptCookiesButton = $( '#bwp-accept-cookies' ),
			$showCookiesInfo = $( '#bwp-show-cookies-info' ),
			$hideCookiesInfo = $( '#bwp-hide-cookies-info' ),
			cookiesAccepted = 'halva_cookies_accepted', // cookie name; this cookie is used to store the status of the "Cookies information" window: "Yes", if the "Accept" button was pressed, otherwise "No"
			cookiesAcceptedCssClass = 'bwp-cookies-accepted',
			hiddenCssClass = 'bwp-hidden',
			visibleCssClass = 'bwp-visible';


		/**
		 * Information about cookies: Hide the notification after accepting the cookie agreement
		 */
		function acceptCookies() {

			// click on the button
			$acceptCookiesButton.on( 'click', function() {

				// hide information about cookies
				$cookiesInfoContainer.addClass( cookiesAcceptedCssClass );
				setTimeout( function() {
					$cookiesInfoContainer.css( 'display', 'none' );
				}, 300 );

				// if the notification is hidden on mobile devices
				if ( 'hidden' === halvaAdditionalFeatures.cookiesNoticeOnMobile ) {
					// hide the "Show cookies info" button
					$showCookiesInfo.css( 'display', 'none' );
				}

				// set cookie (we must remember that the user agrees to accept cookies)
				setCookie( cookiesAccepted, 'yes' );

			} );

		}

		acceptCookies();

		// remove the "halva_cookies_accepted" cookie if the notification is hidden in the theme settings
		if ( 'hide' === halvaAdditionalFeatures.cookiesNotice && getCookie( cookiesAccepted ) ) {
			deleteCookie( cookiesAccepted );
		}


		/**
		 * Information about cookies for mobile devices (notification type: hidden on mobile)
		 */
		function showHideCookiesInfoMobile() {

			// show information about cookies
			$showCookiesInfo.on( 'click', function() {
				if ( ! $cookiesInfoContainer.hasClass( visibleCssClass ) ) {
					$showCookiesInfo.addClass( hiddenCssClass );
					$cookiesInfoContainer.addClass( visibleCssClass );
				}
			} );

			// hide information about cookies
			$hideCookiesInfo.on( 'click', function() {
				if ( $cookiesInfoContainer.hasClass( visibleCssClass ) ) {
					$cookiesInfoContainer.removeClass( visibleCssClass );
					setTimeout( function() {
						$showCookiesInfo.removeClass( hiddenCssClass );
					}, 50 );
				}
			} );

		}

		if ( 'hidden' === halvaAdditionalFeatures.cookiesNoticeOnMobile ) {
			showHideCookiesInfoMobile();
		}


		/**
		 * Cookie: set cookie, get cookie, delete cookie
		 */

		// function: set cookie
		function setCookie( name, value ) {

			// cookie value
			value = encodeURIComponent( value );

			// expiration date (+90 days)
			var date = new Date;
			date.setDate( date.getDate() + 90 );

			// set cookie
			document.cookie = name + '=' + value + '; path=/; expires=' + date.toUTCString();

		}

		// function: get cookie
		function getCookie( name ) {

			var matches = document.cookie.match( new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			) );

			return matches ? decodeURIComponent( matches[1] ) : undefined;

		}

		// function: delete cookie
		function deleteCookie( name ) {

			// set the date in the past
			var date = new Date;
			date.setDate( date.getDate() - 1 );

			// delete cookie
			document.cookie = name + '=; path=/; expires=' + date.toUTCString();

		}

	} );
} )( jQuery );
