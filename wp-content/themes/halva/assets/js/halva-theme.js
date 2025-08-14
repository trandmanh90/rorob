/*
Theme name: Halva
halva-theme.js v1.1

Table of Contents:

1 - Superfish menu (jQuery menu plugin by Joel Birch)
2 - Homepage carousel (Tiny-slider)
3 - Masonry layout
4 - Switching between two types of layout (One column or three columns)
5 - Gallery format: Slider (Tiny-slider)
6 - Hidden navigation
7 - Sidebar (Hidden right sidebar)
8 - Color switch (Switching between two color modes: light and dark)
9 - Font types (Switching between two types of fonts: sans-serif or serif fonts)
10 - Dropdown search form
11 - Dropdown menu for mobile devices (Mobile menu)
12 - Popup windows (magnificPopup)
13 - Scroll to top
14 - Cookie: set cookie, get cookie, delete cookie
15 - Other functions
*/

( function( $ ) {
	'use strict';
	$( document ).ready( function() {

		var $html = $( 'html' ),
			$body = $( 'body' ),
			$masonryContainer = $( '#bwp-masonry' ),
			$stickyButtons = $( '#bwp-sticky-buttons' ),
			$scrollTopButton = $( '#bwp-scroll-top .bwp-scroll-top-button' ),
			scrollbarWidth = getScrollbarWidth(),
			hiddenCssClass = 'bwp-hidden',
			visibleCssClass = 'bwp-visible',
			activeCssClass = 'bwp-active',
			cookieBlogLayout = 'halva_blog_layout', // cookie name; this cookie is used to store the current layout for the recent posts section: one column (col-1) or three columns (col-3)
			cookieColorScheme = 'halva_color_scheme', // cookie name; this cookie is used to store the selected color mode: dark mode or light mode
			cookieFontType = 'halva_font_type', // cookie name; this cookie is used to store the type of fonts: sans-serif fonts or serif fonts
			currentOpenContainer = ''; // variable to store the name of the currently open dropdown container (mobile menu, font types or search)

		// theme data: string -> boolean
		halvaData.isSingular = 'true' === halvaData.isSingular;
		halvaData.postsHorizontalOrder = 'enable' === halvaData.postsHorizontalOrder;


		/*
		1 - Superfish menu (jQuery menu plugin by Joel Birch)
		---------------------------------------
		*/

		$( 'ul.sf-menu' ).superfish( {
			delay: 600,
			animation: {
				opacity: 'show',
				marginTop: '8',
			},
			animationOut: {
				opacity: 'hide',
				marginTop: '18',
			},
			speed: 300,
			speedOut: 150,
		} );


		/*
		2 - Homepage carousel (Tiny-slider)
		---------------------------------------
		*/

		function initHomepageCarousel() {

			// if there is no carousel on the current page, then stop the function
			var $homepageCarousel = $( '#bwp-homepage-carousel' );
			if ( 0 === $homepageCarousel.length ) {
				return;
			}

			// carousel elements
			var $homepageCarouselWrapper = $( '#bwp-homepage-carousel-wrapper' ), // carousel wrapper
				$homepageCarouselBg = $( '#bwp-homepage-carousel .bwp-homepage-carousel-item-bg' ), // background image
				$homepageCarouselLoadingIcon = $( '#bwp-homepage-carousel-loading-icon' ); // loading icon

			// function: show carousel content
			var showHomepageCarouselContent = function() {
				// show content only after each image has been loaded
				$homepageCarouselBg.imagesLoaded( { background: true }, function() {
					// hide loading icon
					$homepageCarouselLoadingIcon.addClass( hiddenCssClass );
					// check carousel navigation (dots)
					var $homepageCarouselNav = $( '#bwp-homepage-carousel-wrapper .tns-nav' );
					if ( 0 !== $homepageCarouselNav.length ) {
						var $homepageCarouselNavDisplay = $homepageCarouselNav.css( 'display' );
						if ( 'none' === $homepageCarouselNavDisplay ) {
							$homepageCarouselWrapper.addClass( 'bwp-carousel-nav-hidden' );
						}
					} else {
						$homepageCarouselWrapper.addClass( 'bwp-carousel-nav-hidden' );
					}
					// show content after a short period of time (150 milliseconds)
					setTimeout( function() {
						$homepageCarouselLoadingIcon.css( 'display', 'none' );
						$homepageCarouselWrapper.addClass( 'bwp-carousel-loaded' );
					}, 150 );
				} );
			};

			// carousel options
			// 1: rewind
			var rewindValue = 'enable' === halvaData.homepageCarouselRewind;
			// 2: animation speed
			var speedValue = Number( halvaData.homepageCarouselSpeed );
			// 3: controls (next/previous)
			var controlsValue = 'show' === halvaData.homepageCarouselControls;
			// 4: navigation (dots)
			var navValue = 'show' === halvaData.homepageCarouselNav;

			// initialize carousel (tiny-slider)
			tns( {
				container: '#bwp-homepage-carousel',
				mode: 'carousel',
				axis: 'horizontal',
				items: 1,
				gutter: 0,
				edgePadding: 0,
				slideBy: 1,
				center: false,
				controls: controlsValue,
				controlsPosition: 'bottom',
				controlsText: [ '<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>' ],
				nav: navValue,
				navPosition: 'bottom',
				speed: speedValue,
				autoplay: false,
				autoplayButtonOutput: false,
				loop: false,
				rewind: rewindValue,
				touch: true,
				mouseDrag: false,
				autoHeight: false,
				onInit: showHomepageCarouselContent,
				responsive: {
					768: {
						items: 2,
						mouseDrag: true,
					},
					992: {
						items: 3,
					},
				},
			} );

		}

		initHomepageCarousel();


		/*
		3 - Masonry layout
		---------------------------------------
		*/

		function initMasonryBlogLayout() {

			var $grid = $masonryContainer.imagesLoaded( function() {

				// init Masonry after all images have loaded
				$grid.masonry( {
					// set itemSelector so .bwp-col-size is not used in layout
					itemSelector: '.bwp-masonry-item',
					// set columnWidth (default column size)
					columnWidth: '.bwp-col-size',
					// enable percentPosition
					percentPosition: true,
					// horizontal order
					horizontalOrder: halvaData.postsHorizontalOrder,
				} );

				// update masonry after a short period of time (800 milliseconds)
				setTimeout( function() {
					$grid.masonry( 'layout' );
				}, 800 );

			} );

		}


		/*
		4 - Switching between two types of layout (One column or three columns)
		---------------------------------------
		*/

		function toggleLayout() {

			var $toggleLayoutButton = $( '#bwp-options-for-latest-posts .bwp-toggle-layout' ),
				$masonryItems = $( '#bwp-masonry .bwp-masonry-item' );

			// initialize masonry layout
			initMasonryBlogLayout();

			// click on layout button
			$toggleLayoutButton.on( 'click', function() {

				var $currentButton = $( this ),
					layout = $currentButton.data( 'blogLayout' ); // 'col-1' or 'col-3'

				// stop the function if the pressed button is already active
				if ( $currentButton.hasClass( activeCssClass ) ) {
					return false;
				}

				// if the pressed button is inactive, then change the layout:

				$toggleLayoutButton.toggleClass( activeCssClass );

				if ( 'col-1' === layout ) {
					// change layout: 3 columns -> 1 column

					$masonryContainer.removeClass( 'bwp-col-3-layout' ).addClass( 'bwp-col-1-layout' );
					$masonryItems.removeClass( 'bwp-col-3' ).addClass( 'bwp-col-1' );
					$masonryContainer.masonry( 'layout' );

					// set cookie
					if ( 'enable' === halvaData.blogLayoutCookie ) {
						setCookie( cookieBlogLayout, 'col-1' );
					}

				} else {
					// change layout: 1 column -> 3 columns

					$masonryContainer.removeClass( 'bwp-col-1-layout' ).addClass( 'bwp-col-3-layout' );
					$masonryItems.removeClass( 'bwp-col-1' ).addClass( 'bwp-col-3' );
					$masonryContainer.masonry( 'layout' );

					// set cookie
					if ( 'enable' === halvaData.blogLayoutCookie ) {
						setCookie( cookieBlogLayout, 'col-3' );
					}

				}

			} );

		}

		// if the current page is not a single page:
		if ( ! halvaData.isSingular ) {
			// if switching between layouts is enabled in the theme settings:
			if ( 'enable' === halvaData.switchBlogLayout ) {
				// enable switching between layouts
				toggleLayout();
			} else {
				// default blog layout = three columns
				if ( 'col-3' === halvaData.defaultBlogLayout ) {
					// initialize masonry layout
					initMasonryBlogLayout();
				}
			}
		}

		// if switching between layouts is disabled or if cookies are disabled:
		if ( ( 'disable' === halvaData.switchBlogLayout || 'disable' === halvaData.blogLayoutCookie ) && getCookie( cookieBlogLayout ) ) {
			// delete cookie
			deleteCookie( cookieBlogLayout );
		}


		/*
		5 - Gallery format: Slider (Tiny-slider)
		---------------------------------------
		*/

		function initGalleryFormatSlider() {

			// if there is no slider on the current page, stop the function
			var $galleryFormatSlider = $( '.bwp-post-slider' );
			if ( 0 === $galleryFormatSlider.length ) {
				return;
			}

			// after successful initialization of each slider, we need to update the masonry grid
			var updateMasonryLayout = function() {
				if ( ! halvaData.isSingular && ( 'enable' === halvaData.switchBlogLayout || 'col-3' === halvaData.defaultBlogLayout ) ) {
					$masonryContainer.masonry();
				}
			};

			// slider options:
			// 1: rewind
			var rewindValue = 'enable' === halvaData.gallerySliderRewind;
			// 2: transition type for slides
			var modeValue = 'gallery'; // fade animation
			if ( 'slide_horizontal' === halvaData.gallerySliderTransition ) {
				modeValue = 'carousel'; // slide horizontal
			}
			// 3: animation speed
			var speedValue = Number( halvaData.gallerySliderSpeed );

			// initialize each slider on the page (tiny-slider)
			$galleryFormatSlider.each( function() {
				tns( {
					container: '#' + $( this ).attr( 'id' ),
					mode: modeValue,
					axis: 'horizontal',
					items: 1,
					controls: true,
					controlsPosition: 'bottom',
					controlsText: [ '<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>' ],
					nav: false,
					speed: speedValue,
					autoplay: false,
					autoplayButtonOutput: false,
					loop: false,
					rewind: rewindValue,
					touch: false,
					mouseDrag: false,
					autoHeight: false,
					onInit: updateMasonryLayout,
				} );
			} );

		}

		initGalleryFormatSlider();


		/*
		6 - Hidden navigation
		---------------------------------------
		*/

		function showHideNavigation() {

			var $showMainNav = $( '#bwp-show-main-nav' ),
				$hideMainNav = $( '.bwp-hide-main-nav' ),
				$mainNav = $( '#bwp-main-nav' ),
				$mainNavContainer = $( '#bwp-main-nav .bwp-main-nav-container' ),
				mainNavVisibleCssClass = 'bwp-hidden-main-nav-shown';

			// show/hide button when scrolling
			$( window ).on( 'scroll', function() {
				if ( $( window ).scrollTop() > 800 ) {
					$showMainNav.addClass( visibleCssClass );
				} else {
					$showMainNav.removeClass( visibleCssClass );
				}
			} );

			// show main navigation
			$showMainNav.on( 'click', function() {
				if ( ! $body.hasClass( mainNavVisibleCssClass ) ) {
					$body.addClass( mainNavVisibleCssClass );
					setTimeout( function() {
						$mainNav.focus();
					}, 300 );
					if ( viewportHasVerticalScrollbar() ) {
						$body.css( {
							'overflow-y': 'hidden', // remove scrollbar
							'margin-right': scrollbarWidth,
						} );
						$mainNavContainer.css( {
							'padding-right': scrollbarWidth,
						} );
						$stickyButtons.css( {
							'margin-right': scrollbarWidth,
						} );
						$scrollTopButton.css( {
							'margin-right': scrollbarWidth,
						} );
					}
				}
			} );

			// function: hide main navigation
			var hideVisibleMainNav = function() {
				$body.removeClass( mainNavVisibleCssClass );
				if ( viewportHasVerticalScrollbar() ) {
					// remove additional styles after animation is complete (300 milliseconds)
					setTimeout( function() {
						$body.css( {
							'overflow-y': 'auto', // show scrollbar
							'margin-right': 0,
						} );
						$mainNavContainer.css( {
							'padding-right': 0,
						} );
						$stickyButtons.css( {
							'margin-right': 0,
						} );
						$scrollTopButton.css( {
							'margin-right': 0,
						} );
					}, 300 );
				}
			};

			// hide main navigation (clicking the Close button)
			$hideMainNav.on( 'click', function() {
				if ( $body.hasClass( mainNavVisibleCssClass ) ) {
					hideVisibleMainNav();
				}
			} );

			// hide main navigation (pressing the Escape key)
			$( document ).on( 'keyup', function( e ) {
				if ( 'Escape' === e.key && $body.hasClass( mainNavVisibleCssClass ) ) {
					hideVisibleMainNav();
				}
			} );

		}

		if ( 'enable' === halvaData.hiddenNav ) {
			showHideNavigation();
		}


		/*
		7 - Sidebar (Hidden right sidebar)
		---------------------------------------
		*/

		function showHideSidebar() {

			var $showSidebar = $( '#bwp-show-sidebar' ),
				$hideSidebar = $( '.bwp-hide-sidebar' ),
				$sidebar = $( '#bwp-sidebar' ),
				sidebarVisibleCssClass = 'bwp-hidden-sidebar-shown',
				viewportWidth;

			// show sidebar
			$showSidebar.on( 'click', function() {
				if ( ! $body.hasClass( sidebarVisibleCssClass ) ) {
					$body.addClass( sidebarVisibleCssClass );
					setTimeout( function() {
						$sidebar.focus();
					}, 300 );
					if ( viewportHasVerticalScrollbar() ) {
						// add additional css styles:
						// 1. body
						$body.css( {
							'overflow-y': 'hidden', // remove scrollbar
							'margin-right': scrollbarWidth,
						} );
						// 2. sticky buttons (search, fonts, color switcher, etc.)
						viewportWidth = $( window ).width();
						if ( viewportWidth > 991 ) {
							$stickyButtons.css( {
								'margin-right': scrollbarWidth,
							} );
						} else {
							$stickyButtons.css( {
								'padding-right': scrollbarWidth,
							} );
						}
						// 3. back to top button
						$scrollTopButton.css( {
							'margin-right': scrollbarWidth,
						} );
					}
				}
			} );

			// function: hide sidebar
			var hideVisibleSidebar = function() {
				$body.removeClass( sidebarVisibleCssClass );
				if ( viewportHasVerticalScrollbar() ) {
					// get viewport width
					viewportWidth = $( window ).width();
					// remove additional styles after animation is complete (300 milliseconds)
					setTimeout( function() {
						// 1. body
						$body.css( {
							'overflow-y': 'auto', // show scrollbar
							'margin-right': 0,
						} );
						// 2. sticky buttons (search, fonts, color switcher, etc.)
						if ( viewportWidth > 991 ) {
							$stickyButtons.css( {
								'margin-right': 0,
							} );
						} else {
							$stickyButtons.css( {
								'padding-right': 0,
							} );
						}
						// 3. back to top button
						$scrollTopButton.css( {
							'margin-right': 0,
						} );
					}, 300 );
				}
			};

			// hide sidebar (clicking the Close button)
			$hideSidebar.on( 'click', function() {
				if ( $body.hasClass( sidebarVisibleCssClass ) ) {
					hideVisibleSidebar();
				}
			} );

			// hide sidebar (pressing the Escape key)
			$( document ).on( 'keyup', function( e ) {
				if ( 'Escape' === e.key && $body.hasClass( sidebarVisibleCssClass ) ) {
					hideVisibleSidebar();
				}
			} );

		}

		showHideSidebar();


		/*
		8 - Color switch (Switching between two color modes: light and dark)
		---------------------------------------
		*/

		function changeThemeColor() {

			var $colorSwitch = $( '#bwp-toggle-color' ),
				$colorSwitchIcon = $( '#bwp-toggle-color i' ),
				darkModeCssClass = 'bwp-dark-mode';

			if ( 'image' === halvaData.logoType ) {
				// main logo
				var	$logo = $( '#bwp-custom-logo' ),
					$logoLink = $( '#bwp-custom-logo .custom-logo-link' ),
					logoUrl = $logo.data( 'logoUrl' ), // logo for light mode
					darkModeLogoUrl = $logo.data( 'darkModeLogoUrl' ), // logo for dark mode
					logoAlt = $logo.data( 'logoAlt' ); // alt text
			}

			if ( 'enable' === halvaData.hiddenNav && 'image' === halvaData.navLogoType ) {
				// hidden navigation: logo
				var $navLogo = $( '#bwp-nav-logo' ),
					$navLogoLink = $( '#bwp-nav-logo > a' ),
					navLogoUrl = $navLogo.data( 'logoUrl' ), // logo for light mode
					darkModeNavLogoUrl = $navLogo.data( 'darkModeLogoUrl' ), // logo for dark mode
					navLogoAlt = $navLogo.data( 'logoAlt' ); // alt text
			}

			$colorSwitch.on( 'click', function() {

				// switching between light and dark modes
				if ( ! $body.hasClass( darkModeCssClass ) ) {
					// switch to dark mode:

					// change icon (moon -> sun)
					$colorSwitchIcon.hide().attr( 'class', 'fa-solid fa-sun' ).fadeIn( 300 );

					// add a class for the dark version to the body element
					$body.addClass( darkModeCssClass );

					// change main logo (image for light mode -> image for dark mode)
					if ( 'image' === halvaData.logoType && 'none' !== darkModeLogoUrl ) {
						$logoLink.html( '<img src="' + darkModeLogoUrl + '" class="custom-logo" alt="' + logoAlt + '">' );
					}

					// change nav logo (image for light mode -> image for dark mode)
					if ( 'enable' === halvaData.hiddenNav && 'image' === halvaData.navLogoType && 'none' !== darkModeNavLogoUrl ) {
						$navLogoLink.html( '<img src="' + darkModeNavLogoUrl + '" alt="' + navLogoAlt + '">' );
					}

					// set cookie
					if ( 'enable' === halvaData.colorModeCookie ) {
						setCookie( cookieColorScheme, 'dark' ); // dark color scheme
					}

				} else {
					// switch to light mode:

					// change icon (sun -> moon)
					$colorSwitchIcon.hide().attr( 'class', 'fa-regular fa-moon' ).fadeIn( 300 );

					// remove the dark version CSS class
					$body.removeClass( darkModeCssClass );

					// change main logo (image for dark mode -> image for light mode)
					if ( 'image' === halvaData.logoType && 'none' !== darkModeLogoUrl ) {
						$logoLink.html( '<img src="' + logoUrl + '" class="custom-logo" alt="' + logoAlt + '">' );
					}

					// change nav logo (image for dark mode -> image for light mode)
					if ( 'enable' === halvaData.hiddenNav && 'image' === halvaData.navLogoType && 'none' !== darkModeNavLogoUrl ) {
						$navLogoLink.html( '<img src="' + navLogoUrl + '" alt="' + navLogoAlt + '">' );
					}

					// set cookie
					if ( 'enable' === halvaData.colorModeCookie ) {
						setCookie( cookieColorScheme, 'light' ); // light color scheme
					}

				}

			} );

		}

		// if switching between color modes is enabled in the theme settings:
		if ( 'enable' === halvaData.switchColorMode ) {
			changeThemeColor();
		} else {
			// delete cookie
			if ( getCookie( cookieColorScheme ) ) {
				deleteCookie( cookieColorScheme );
			}
		}

		// if cookies are disabled in the theme settings:
		if ( 'disable' === halvaData.colorModeCookie && getCookie( cookieColorScheme ) ) {
			// delete cookie
			deleteCookie( cookieColorScheme );
		}


		/*
		9 - Font types (Switching between two types of fonts: sans-serif or serif fonts)
		---------------------------------------
		*/

		// variables
		var $fontButton = $( '#bwp-show-font-types' ),
			$fontButtonIcon = $( '#bwp-show-font-types i' ),
			$fontContainer = $( '#bwp-dropdown-fonts' );

		// function: show dropdown container with font types
		function showDropdownFontTypes() {

			// change button style and show font types
			$fontButton.addClass( activeCssClass );
			$fontButtonIcon.hide().attr( 'class', 'fa-solid fa-xmark' ).fadeIn( 300 );
			$fontContainer.removeClass( hiddenCssClass ).addClass( visibleCssClass );

			// current open container is font-types
			currentOpenContainer = 'font-types';

		}

		// function: hide dropdown container with font types
		function hideDropdownFontTypes() {

			// change button style and hide font types
			$fontButton.removeClass( activeCssClass );
			$fontButtonIcon.hide().attr( 'class', 'fa-solid fa-font' ).fadeIn( 300 );
			$fontContainer.removeClass( visibleCssClass ).addClass( hiddenCssClass );

			// clear the "currentOpenContainer" variable
			currentOpenContainer = '';

		}

		// function: show/hide dropdown container with font types
		function showHideDropdownFontTypes() {

			// font button: click
			$fontButton.on( 'click', function() {

				// if the container with font types is hidden
				if ( $fontContainer.hasClass( hiddenCssClass ) ) {

					// hide other dropdown containers
					hideOtherDropdownContainers();

					// show available font types
					showDropdownFontTypes();

				} else {

					// hide font types
					hideDropdownFontTypes();

				}

			} );

		}

		showHideDropdownFontTypes();

		// function: change font type
		function changeFontType() {

			var $fontType = $( '#bwp-dropdown-fonts .bwp-font-type' ),
				$thisFontType,
				fontTypeValue,
				serifFontsCssClass = 'bwp-serif-fonts';

			// function: update masonry layout
			var updateMasonryLayout = function() {
				if ( ! halvaData.isSingular && ( 'enable' === halvaData.switchBlogLayout || 'col-3' === halvaData.defaultBlogLayout ) ) {
					setTimeout( function() {
						$masonryContainer.masonry();
					}, 800 );
				}
			};

			// font type: click
			$fontType.on( 'click', function() {

				// change the font type only if the selected type is different from the current one
				$thisFontType = $( this );
				if ( ! $thisFontType.hasClass( activeCssClass ) ) {

					// change the button style of the selected font type
					$fontType.removeClass( activeCssClass );
					$thisFontType.addClass( activeCssClass );

					// get the font type value: serif or sans-serif
					fontTypeValue = $thisFontType.data( 'fontType' );

					// switch to a new font type
					if ( 'serif' === fontTypeValue ) {
						// switch to serif fonts:

						// add a class for serif fonts to the body element
						if ( ! $body.hasClass( serifFontsCssClass ) ) {
							$body.addClass( serifFontsCssClass );
						}

						// set cookie
						if ( 'enable' === halvaData.fontsCookie ) {
							setCookie( cookieFontType, 'serif' );
						}

						// update masonry layout
						updateMasonryLayout();

					} else if ( 'sans-serif' === fontTypeValue ) {
						// switch to sans-serif fonts:

						// sans-serif fonts are used by default, so we just need to remove the class for serif fonts from the body element
						if ( $body.hasClass( serifFontsCssClass ) ) {
							$body.removeClass( serifFontsCssClass );
						}

						// set cookie
						if ( 'enable' === halvaData.fontsCookie ) {
							setCookie( cookieFontType, 'sans-serif' );
						}

						// update masonry layout
						updateMasonryLayout();

					}

				}

			} );

		}

		// if switching between fonts is enabled in the theme settings:
		if ( 'enable' === halvaData.switchFonts ) {
			changeFontType();
		} else {
			// delete cookie
			if ( getCookie( cookieFontType ) ) {
				deleteCookie( cookieFontType );
			}
		}

		// if cookies are disabled in the theme settings:
		if ( 'disable' === halvaData.fontsCookie && getCookie( cookieFontType ) ) {
			// delete cookie
			deleteCookie( cookieFontType );
		}


		/*
		10 - Dropdown search form
		---------------------------------------
		*/

		// variables
		var $searchButton = $( '#bwp-toggle-search' ),
			$searchButtonIcon = $( '#bwp-toggle-search i' ),
			$searchContainer = $( '#bwp-dropdown-searchform' ),
			$searchField = $( '#bwp-dropdown-searchform .bwp-search-field' );

		// function: show dropdown search form
		function showDropdownSearchForm() {

			// change button style and show search
			$searchButton.addClass( activeCssClass );
			$searchButtonIcon.hide().attr( 'class', 'fa-solid fa-xmark' ).fadeIn( 300 );
			$searchContainer.removeClass( hiddenCssClass ).addClass( visibleCssClass );

			// search field: add focus after animation is complete (300 milliseconds)
			if ( $( window ).width() > 991 ) {
				setTimeout( function() {
					$searchField.focus();
				}, 300 );
			}

			// current open container is search
			currentOpenContainer = 'search';

		}

		// function: hide dropdown search form
		function hideDropdownSearchForm() {

			// change button style and hide search
			$searchButton.removeClass( activeCssClass );
			$searchButtonIcon.hide().attr( 'class', 'fa-solid fa-magnifying-glass' ).fadeIn( 300 );
			$searchContainer.removeClass( visibleCssClass ).addClass( hiddenCssClass );

			// clear the "currentOpenContainer" variable
			currentOpenContainer = '';

		}

		// function: show/hide dropdown search form
		function showHideDropdownSearchForm() {

			// search button: click
			$searchButton.on( 'click', function() {

				// if the container with the search form is hidden
				if ( $searchContainer.hasClass( hiddenCssClass ) ) {

					// hide other dropdown containers
					hideOtherDropdownContainers();

					// show search
					showDropdownSearchForm();

				} else {

					// hide search
					hideDropdownSearchForm();

				}

			} );

		}

		if ( 'enable' === halvaData.dropdownSearch ) {
			showHideDropdownSearchForm();
		}


		/*
		11 - Dropdown menu for mobile devices (Mobile menu)
		---------------------------------------
		*/

		// variables
		var $mobileMenuButton = $( '#bwp-toggle-mobile-menu' ),
			$mobileMenuButtonIcon = $( '#bwp-toggle-mobile-menu i' ),
			$mobileMenuContainer = $( '#bwp-dropdown-mobile-menu' );

		// function: show dropdown menu for mobile devices
		function showDropdownMobileMenu() {

			// change button style and show mobile menu
			$mobileMenuButton.addClass( activeCssClass );
			$mobileMenuButtonIcon.hide().attr( 'class', 'fa-solid fa-xmark' ).fadeIn( 300 );
			$mobileMenuContainer.removeClass( hiddenCssClass ).addClass( visibleCssClass );

			// current open container is mobile menu
			currentOpenContainer = 'mobile-menu';

		}

		// function: hide dropdown menu for mobile devices
		function hideDropdownMobileMenu() {

			// change button style and hide mobile menu
			$mobileMenuButton.removeClass( activeCssClass );
			$mobileMenuButtonIcon.hide().attr( 'class', 'fa-solid fa-bars' ).fadeIn( 300 );
			$mobileMenuContainer.removeClass( visibleCssClass ).addClass( hiddenCssClass );

			// clear the "currentOpenContainer" variable
			currentOpenContainer = '';

		}

		// function: show/hide dropdown menu for mobile devices
		function showHideDropdownMobileMenu() {

			// menu button: click
			$mobileMenuButton.on( 'click', function() {

				// if the container with the mobile menu is hidden
				if ( $mobileMenuContainer.hasClass( hiddenCssClass ) ) {

					// hide other dropdown containers
					hideOtherDropdownContainers();

					// show mobile menu
					showDropdownMobileMenu();

				} else {

					// hide mobile menu
					hideDropdownMobileMenu();

				}

			} );

		}

		showHideDropdownMobileMenu();

		// function: show/hide dropdown submenus in the mobile menu
		function showHideMobileSubmenus() {

			// mobile menu link
			var $mobileMenuLink = $( '#bwp-dropdown-mobile-menu .bwp-mobile-menu a' );

			// add an arrow icon to every link that has a submenu
			$mobileMenuLink.each( function( i, elem ) {
				if ( $( elem ).next().is( 'ul' ) ) {
					$( elem ).append( '<span class="bwp-toggle-mobile-submenu"><i class="fa-solid fa-angle-down"></i></span>' );
				}
			} );

			// submenu variables
			var $toggleMobileSubmenu = $( '#bwp-dropdown-mobile-menu .bwp-toggle-mobile-submenu' ),
				submenuVisibleCssClass = 'bwp-submenu-visible';

			// show or hide submenu
			$toggleMobileSubmenu.on( 'click', function() {

				var $thisButton = $( this ),
					$currentMenuItem = $thisButton.closest( 'li' ),
					$currentSubmenu = $thisButton.parent().next();

				// show submenu
				if ( $currentSubmenu.is( 'ul' ) && ! $currentMenuItem.hasClass( submenuVisibleCssClass ) ) {
					$currentMenuItem.addClass( submenuVisibleCssClass );
					$currentSubmenu.slideDown( 300 );
					$thisButton.html( '<i class="fa-solid fa-angle-up"></i>' );
					return false;
				}

				// hide submenu
				if ( $currentSubmenu.is( 'ul' ) && $currentMenuItem.hasClass( submenuVisibleCssClass ) ) {
					$currentMenuItem.removeClass( submenuVisibleCssClass );
					$currentSubmenu.slideUp( 300 );
					$thisButton.html( '<i class="fa-solid fa-angle-down"></i>' );
					return false;
				}

				return false;

			} );

		}

		showHideMobileSubmenus();


		/*
		12 - Popup windows (magnificPopup)
		---------------------------------------
		*/

		function initPopupMedia() {

			var viewportWidth;

			// callbacks: beforeOpen and afterClose
			var beforeOpenPopup = function() {
				// save scroll value
				this.container.data( 'scrollTop', parseInt( $( window ).scrollTop() ) );
				// add offset to sticky elements
				viewportWidth = $( window ).width() + scrollbarWidth;
				if ( viewportWidth > 991 ) {
					$stickyButtons.css( {
						'margin-right': scrollbarWidth,
					} );
				} else {
					$stickyButtons.css( {
						'padding-right': scrollbarWidth,
					} );
				}
				$scrollTopButton.css( {
					'margin-right': scrollbarWidth,
				} );
			};
			var afterClosePopup = function() {
				// scroll page to saved scroll value
				$( 'html, body' ).scrollTop( this.container.data( 'scrollTop' ) );
				// remove offset from sticky elements
				viewportWidth = $( window ).width() + scrollbarWidth;
				if ( viewportWidth > 991 ) {
					$stickyButtons.css( {
						'margin-right': 0,
					} );
				} else {
					$stickyButtons.css( {
						'padding-right': 0,
					} );
				}
				$scrollTopButton.css( {
					'margin-right': 0,
				} );
			};

			// important note: popups only work when the sidebar is closed
			// popup type: image
			$( 'body:not(.bwp-hidden-sidebar-shown) a.bwp-popup-image' ).magnificPopup( {
				type: 'image',
				closeOnContentClick: true,
				closeMarkup: '<button title="%title%" type="button" class="mfp-close bwp-mfp-close-button"></button>',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'auto',
				removalDelay: 300,
				mainClass: 'bwp-popup-zoom-in',
				callbacks: {
					beforeOpen: beforeOpenPopup,
					afterClose: afterClosePopup,
				},
			} );

			// popup type: gallery
			$( 'body:not(.bwp-hidden-sidebar-shown) .bwp-popup-gallery' ).each( function() {
				$( this ).magnificPopup( {
					delegate: 'a.bwp-popup-gallery-item',
					type: 'image',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						arrowMarkup: '<button title="%title%" type="button" class="bwp-mfp-arrow bwp-mfp-arrow-%dir%"></button>',
						tPrev: 'Previous',
						tNext: 'Next',
						tCounter: '%curr% of %total%',
					},
					closeMarkup: '<button title="%title%" type="button" class="mfp-close bwp-mfp-close-button"></button>',
					fixedContentPos: true,
					fixedBgPos: true,
					overflowY: 'auto',
					removalDelay: 300,
					mainClass: 'bwp-popup-zoom-in',
					callbacks: {
						beforeOpen: beforeOpenPopup,
						afterClose: afterClosePopup,
					},
				} );
			} );

			// popup type: gallery (block editor)
			$( 'body:not(.bwp-hidden-sidebar-shown) .wp-block-gallery.bwp-block-editor-popup-gallery' ).each( function() {
				$( this ).magnificPopup( {
					delegate: 'figure > a',
					type: 'image',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						arrowMarkup: '<button title="%title%" type="button" class="bwp-mfp-arrow bwp-mfp-arrow-%dir%"></button>',
						tPrev: 'Previous',
						tNext: 'Next',
						tCounter: '%curr% of %total%',
					},
					closeMarkup: '<button title="%title%" type="button" class="mfp-close bwp-mfp-close-button"></button>',
					fixedContentPos: true,
					fixedBgPos: true,
					overflowY: 'auto',
					removalDelay: 300,
					mainClass: 'bwp-popup-zoom-in',
					callbacks: {
						beforeOpen: beforeOpenPopup,
						afterClose: afterClosePopup,
					},
				} );
			} );

		}

		initPopupMedia();


		/*
		13 - Scroll to top
		---------------------------------------
		*/

		function backToTop() {

			var $scrollTopContainer = $( '#bwp-scroll-top' );

			// hide container with button
			if ( $scrollTopContainer.hasClass( visibleCssClass ) ) {
				$scrollTopContainer.removeClass( visibleCssClass );
			}

			// show/hide container when scrolling
			$( window ).on( 'scroll', function() {
				if ( $( window ).scrollTop() > 800 ) {
					$scrollTopContainer.addClass( visibleCssClass );
				} else {
					$scrollTopContainer.removeClass( visibleCssClass );
				}
			} );

			// smoothly go to the top of the page
			$scrollTopButton.on( 'click', function() {
				$( 'html:not(:animated), body:not(:animated)' ).animate( { scrollTop: 0 }, 400 );
			} );

		}

		if ( 'enable' === halvaData.backToTop ) {
			backToTop();
		}


		/*
		14 - Cookie: set cookie, get cookie, delete cookie
		---------------------------------------
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


		/*
		15 - Other functions
		---------------------------------------
		*/

		// function: get scrollbar width
		function getScrollbarWidth() {

			var block1 = $( '<div>' ).css( { 'width': '50px', 'height': '50px' } ),
				block2 = $( '<div>' ).css( { 'height': '200px' } ),
				width1,
				width2,
				result;

			// scrollbar width calculation
			$body.append( block1.append( block2 ) );
			width1 = $( 'div', block1 ).innerWidth();
			block1.css( 'overflow-y', 'scroll' );
			width2 = $( 'div', block1 ).innerWidth();
			$( block1 ).remove();
			result = width1 - width2; // scrollbar width

			// return result
			return result;

		}

		// function: scrollbar check
		function viewportHasVerticalScrollbar() {

			// return true if there is a vertical scrollbar, otherwise return false
			return $html[0].scrollHeight > $html[0].clientHeight;

		}

		// function: check and hide already open dropdown container
		function hideOtherDropdownContainers() {

			switch ( currentOpenContainer ) {
				case 'search':
					// hide search
					hideDropdownSearchForm();
					break;
				case 'font-types':
					// hide font types
					hideDropdownFontTypes();
					break;
				case 'mobile-menu':
					// hide mobile menu
					hideDropdownMobileMenu();
					break;
			}

		}

	} );
} )( jQuery );
