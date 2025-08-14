<?php
/**
 * Inline styles
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

function halva_inline_styles() {

	$styles_after_main_styles = '';
	$styles_after_dark_mode = '';

	/**
	 * Customizer section > Site identity
	 * ----------------------------------------------
	 */

	// Main logo: Logo width (id: halva_main_logo_width)
	$main_logo_width = get_theme_mod( 'halva_main_logo_width' );
	if ( $main_logo_width ) {
		$styles_after_main_styles .= '
		.bwp-logo-container .custom-logo-link img {
			width: ' . $main_logo_width . 'px;
		}';
	}

	// Hidden navigation: Logo width (id: halva_hidden_nav_logo_width)
	$hidden_nav_logo_width = get_theme_mod( 'halva_hidden_nav_logo_width' );
	if ( $hidden_nav_logo_width ) {
		$styles_after_main_styles .= '
		.bwp-main-nav-logo-image img {
			width: ' . $hidden_nav_logo_width . 'px;
		}';
	}


	/**
	 * Customizer section > Homepage carousel
	 * ----------------------------------------------
	 */

	// Disable hover effects when hovering over a carousel item (id: halva_carousel_item_hover_effects)
	$carousel_item_hover_effects = get_theme_mod( 'halva_carousel_item_hover_effects', 1 ); // 1 or 0
	if ( ! $carousel_item_hover_effects ) {
		$styles_after_main_styles .= '
		.bwp-homepage-carousel-item:hover .bwp-homepage-carousel-item-bg,
		.bwp-homepage-carousel-item:hover .bwp-homepage-carousel-item-text {
			-webkit-transform: none;
			transform: none;
		}
		.bwp-homepage-carousel-item:hover .bwp-homepage-carousel-item-overlay {
			opacity: 0.25;
		}';
	}


	/**
	 * Customizer section > Blog posts
	 * ----------------------------------------------
	 */

	// Featured images: Disable hover effects when hovering over images (id: halva_featured_image_hover_effects)
	$featured_image_hover_effects = get_theme_mod( 'halva_featured_image_hover_effects', 1 ); // 1 or 0
	if ( ! $featured_image_hover_effects ) {
		$styles_after_main_styles .= '
		.bwp-post-media-overlay,
		.bwp-post-hover-icon {
			display: none;
		}
		.bwp-post-media:hover img,
		.bwp-post-slider-item:hover img,
		.bwp-col-1-layout .bwp-post-media:hover img,
		.bwp-col-1-layout .bwp-post-slider-item:hover img {
			-webkit-transform: none;
			transform: none;
		}';
	}

	// Featured images: Increase the size of small featured images (id: halva_enlarge_featured_image)
	$enlarge_featured_image = get_theme_mod( 'halva_enlarge_featured_image', 0 ); // 1 or 0
	if ( $enlarge_featured_image ) {
		$styles_after_main_styles .= '
		.bwp-post-media img,
		.bwp-post-slider-item img {
			width: 100%;
			margin: 0;
		}';
	}


	/**
	 * Customizer section > Colors and styles
	 * ----------------------------------------------
	 */

	// Light mode: Hover/active color (id: halva_light_mode_hover_color)
	$light_mode_hover_color = get_theme_mod( 'halva_light_mode_hover_color', '#786fff' );
	if ( '#786fff' !== $light_mode_hover_color ) {
		$styles_after_main_styles .= '
		a:hover,
		a:focus,
		h1 a:hover,
		h2 a:hover,
		h3 a:hover,
		h4 a:hover,
		h5 a:hover,
		h6 a:hover,
		h1 a:focus,
		h2 a:focus,
		h3 a:focus,
		h4 a:focus,
		h5 a:focus,
		h6 a:focus,
		.bwp-logo-text:hover,
		.bwp-logo-text:focus,
		.bwp-main-nav-logo-text:hover,
		.bwp-main-nav-logo-text:focus,
		.sf-menu a:hover,
		.sf-menu a:focus,
		.sf-menu > li:hover > a,
		.sf-menu > .current-menu-item > a,
		.sf-menu > .current-menu-ancestor > a,
		.sf-menu > .current-menu-ancestor > .sf-with-ul::after,
		.sf-menu ul li a:hover,
		.sf-menu ul li a:focus,
		.sf-menu ul > li:hover > a,
		.sf-menu ul > .current-menu-item > a,
		.sf-menu ul > .current-menu-ancestor > a,
		.sf-menu ul > .current-menu-ancestor > .sf-with-ul::after,
		.bwp-social-links a:hover,
		.bwp-social-links a:focus,
		.bwp-subscribe-link:hover,
		.bwp-subscribe-link:focus,
		.bwp-hide-main-nav-button:hover,
		.bwp-hide-main-nav-button:focus,
		.bwp-toggle-mobile-menu-button:hover,
		.bwp-toggle-mobile-menu-button.bwp-active,
		.bwp-mobile-menu li a:hover,
		.bwp-mobile-menu .current-menu-item > a,
		.bwp-toggle-mobile-submenu:hover,
		.bwp-mobile-menu li.bwp-submenu-visible > a .bwp-toggle-mobile-submenu,
		.bwp-mobile-menu-container .bwp-searchform .bwp-search-submit:hover,
		.bwp-mobile-menu-container .bwp-searchform .bwp-search-submit:focus,
		.bwp-toggle-layout:not(.bwp-active):hover,
		.bwp-toggle-layout:not(.bwp-active):focus,
		.bwp-toggle-layout.bwp-active:focus,
		.bwp-post-metadata li a:hover,
		.bwp-post-metadata li a:focus,
		.bwp-post-links li a:hover,
		.bwp-post-links li a:focus,
		.bwp-no-results-content a:hover,
		.bwp-no-results-content a:focus,
		.pagination .nav-links a.page-numbers:hover,
		.pagination .nav-links a.page-numbers:focus,
		.bwp-single-post-metadata li a:hover,
		.bwp-single-post-metadata li a:focus,
		.wp-playlist .wp-playlist-item a:hover,
		.comment-content a:hover,
		.comment-content a:focus,
		.bwp-content .bwp-single-post-pagination a:hover,
		.bwp-content .bwp-single-post-pagination a:focus,
		.bwp-content .wp-block-calendar .wp-calendar-nav a:hover,
		.bwp-content .wp-block-calendar .wp-calendar-nav a:focus,
		.bwp-content .wp-block-tag-cloud a:hover .tag-link-count,
		.bwp-content .wp-block-tag-cloud a:focus .tag-link-count,
		.bwp-content .wp-block-post-template .wp-block-post-excerpt__more-link:hover,
		.bwp-content .wp-block-post-template .wp-block-post-excerpt__more-link:focus,
		.bwp-content .wp-block-post-template .wp-block-post-date a:hover,
		.bwp-content .wp-block-post-template .wp-block-post-date a:focus,
		.bwp-content .wp-block-comment-template .wp-block-comment-date a:hover,
		.bwp-content .wp-block-comment-template .wp-block-comment-edit-link a:hover,
		.bwp-content .wp-block-comment-template .wp-block-comment-date a:focus,
		.bwp-content .wp-block-comment-template .wp-block-comment-edit-link a:focus,
		.bwp-content .wp-block-comment-template .wp-block-comment-reply-link a:hover,
		.bwp-content .wp-block-comment-template .wp-block-comment-reply-link a:focus,
		.bwp-content .wp-block-comments-pagination .wp-block-comments-pagination-numbers .current,
		.bwp-about-author .bwp-author-posts-link:hover,
		.bwp-about-author .bwp-author-posts-link:focus,
		.comment-form-cookies-consent label:hover,
		.comment-respond .must-log-in a:hover,
		.comment-respond .must-log-in a:focus,
		.comment-form .logged-in-as a:hover,
		.comment-form .logged-in-as a:focus,
		.comment-reply-title #cancel-comment-reply-link:hover,
		.bwp-comment-list .comment-meta .comment-metadata a:hover,
		.bwp-comment-list .comment-meta .comment-metadata a:focus,
		.bwp-comment-list .pingback .comment-body > a:hover,
		.bwp-comment-list .pingback .comment-body > a:focus,
		.bwp-comment-list .trackback .comment-body > a:hover,
		.bwp-comment-list .trackback .comment-body > a:focus,
		.comment-navigation .nav-links a:hover,
		.comment-navigation .nav-links a:focus,
		.post-navigation .nav-links a:hover,
		.post-navigation .nav-links a:focus,
		.bwp-page-404-content a:hover,
		.bwp-page-404-content a:focus,
		.bwp-site-footer a:hover,
		.bwp-site-footer a:focus,
		.bwp-font-type.bwp-active,
		.bwp-font-type:not(.bwp-active):hover,
		.bwp-dropdown-search-container .bwp-searchform .bwp-search-submit:hover,
		.bwp-dropdown-search-container .bwp-searchform .bwp-search-submit:focus,
		.bwp-hide-sidebar-button:hover,
		.bwp-hide-sidebar-button:focus,
		.bwp-widget a:hover,
		.bwp-widget a:focus,
		.widget a:hover,
		.widget a:focus,
		.bwp-widget .bwp-widget-title a:hover,
		.bwp-widget .bwp-widget-title a:focus,
		.widget .widgettitle a:hover,
		.widget .widgettitle a:focus,
		.bwp-sidebar-content ul.wp-block-latest-posts > li > a:hover,
		.bwp-sidebar-content ul.wp-block-latest-posts > li > a:focus,
		.widget_tag_cloud .tagcloud a:hover .tag-link-count,
		.widget_tag_cloud .tagcloud a:focus .tag-link-count,
		.widget_search .bwp-searchform .bwp-search-submit:hover,
		.widget_search .bwp-searchform .bwp-search-submit:focus,
		.widget_bwp_popular_posts > ul > li:hover .widget_bwp_popular_post_num,
		.bwp-button-show-cookies-info:hover {
			color: ' . $light_mode_hover_color . ';
		}
		input[type="text"]:not(.bwp-search-field):hover,
		input[type="email"]:hover,
		input[type="url"]:hover,
		input[type="password"]:hover,
		input[type="search"]:hover,
		input[type="tel"]:hover,
		input[type="number"]:hover,
		input[type="date"]:hover,
		textarea:hover,
		select:hover,
		input[type="text"]:not(.bwp-search-field):focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus,
		input[type="date"]:focus,
		textarea:focus,
		select:focus,
		input[type="file"]:hover,
		input[type="file"]:focus,
		input[type="checkbox"]:hover,
		input[type="radio"]:hover,
		input[type="checkbox"]:focus,
		input[type="radio"]:focus,
		.bwp-mobile-menu-container .bwp-searchform:hover,
		.bwp-mobile-menu-container .bwp-searchform:focus,
		.bwp-content .wp-block-search .wp-block-search__input:hover,
		.bwp-content .wp-block-search .wp-block-search__input:focus,
		.bwp-content .wp-block-post-comments-form .comment-form-comment textarea:hover,
		.bwp-content .wp-block-post-comments-form .comment-form-author input:hover,
		.bwp-content .wp-block-post-comments-form .comment-form-email input:hover,
		.bwp-content .wp-block-post-comments-form .comment-form-url input:hover,
		.bwp-content .wp-block-post-comments-form .comment-form-comment textarea:focus,
		.bwp-content .wp-block-post-comments-form .comment-form-author input:focus,
		.bwp-content .wp-block-post-comments-form .comment-form-email input:focus,
		.bwp-content .wp-block-post-comments-form .comment-form-url input:focus,
		.bwp-content .wp-block-post-comments-form .comment-form-cookies-consent input:hover,
		.bwp-content .wp-block-post-comments-form .comment-form-cookies-consent input:focus,
		.widget_search .bwp-searchform:hover,
		.widget_search .bwp-searchform:focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="text"]:not(.bwp-search-field):hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="email"]:hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="url"]:hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="password"]:hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="search"]:hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="tel"]:hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="number"]:hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="date"]:hover,
		.bwp-page-with-posts .bwp-footer-widgets textarea:hover,
		.bwp-page-with-posts .bwp-footer-widgets select:hover,
		.bwp-page-with-posts .bwp-footer-widgets input[type="text"]:not(.bwp-search-field):focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="email"]:focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="url"]:focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="password"]:focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="search"]:focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="tel"]:focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="number"]:focus,
		.bwp-page-with-posts .bwp-footer-widgets input[type="date"]:focus,
		.bwp-page-with-posts .bwp-footer-widgets textarea:focus,
		.bwp-page-with-posts .bwp-footer-widgets select:focus,
		.bwp-page-with-posts .bwp-footer-widgets .widget_search .bwp-searchform:hover,
		.bwp-page-with-posts .bwp-footer-widgets .widget_search .bwp-searchform:focus,
		.bwp-page-with-posts .bwp-footer-widgets .wp-block-search .wp-block-search__input:hover,
		.bwp-page-with-posts .bwp-footer-widgets .wp-block-search .wp-block-search__input:focus {
			border-color: ' . $light_mode_hover_color . ';
		}
		input[type="checkbox"]:checked,
		input[type="radio"]:checked {
			background: ' . $light_mode_hover_color . ';
			border-color: ' . $light_mode_hover_color . ';
		}
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		.bwp-carousel-container .tns-controls button:hover,
		.bwp-post-media-slider .tns-controls button:hover,
		.bwp-content .wp-block-file a.wp-block-file__button:active,
		.bwp-content .wp-block-file a.wp-block-file__button:focus,
		.bwp-content .wp-block-file a.wp-block-file__button:hover,
		.bwp-content .wp-block-search .wp-block-search__button:hover,
		.bwp-content .wp-block-search .wp-block-search__button:focus,
		.bwp-sticky-buttons-container .bwp-sticky-button:hover,
		.bwp-sticky-buttons-container .bwp-sticky-button:focus,
		.bwp-sticky-buttons-container .bwp-sticky-button.bwp-active,
		.bwp-scroll-top-button:hover,
		.bwp-accept-cookies-button:hover,
		.bwp-button-hide-cookies-info:hover {
			background: ' . $light_mode_hover_color . ';
		}
		.bwp-mobile-menu-container .bwp-social-links a:hover,
		.bwp-mobile-menu-container .bwp-social-links a:focus,
		.bwp-carousel-container .tns-controls button[data-controls="next"]:hover::before,
		.bwp-post-media-slider .tns-controls button[data-controls="next"]:hover::before,
		.pagination .nav-links .page-numbers.current,
		.bwp-content .bwp-single-post-pagination .post-page-numbers.current,
		.bwp-content .wp-block-query-pagination .page-numbers.current,
		.bwp-content .wp-block-comments-pagination .page-numbers.current,
		.bwp-comment-list .comment-body .reply a:hover,
		.bwp-comment-list .comment-body .reply a:focus,
		.bwp-comment-list .pingback .comment-body .edit-link a:hover,
		.bwp-comment-list .trackback .comment-body .edit-link a:hover,
		.bwp-footer-text a:hover::after,
		.bwp-footer-text a:focus::after,
		.bwp-footer-menu-list li a:hover::after,
		.bwp-footer-menu-list li a:focus::after,
		.wp-calendar-table tbody #today,
		.widget_bwp_social ul li a:hover,
		.widget_bwp_social ul li a:focus,
		.bwp-page-with-posts .bwp-footer-widgets .widget_bwp_social ul li a:hover,
		.bwp-page-with-posts .bwp-footer-widgets .widget_bwp_social ul li a:focus {
			background-color: ' . $light_mode_hover_color . ';
		}
		.bwp-post-metadata li.bwp-date a:hover .date,
		.bwp-post-metadata li.bwp-date a:focus .date,
		.bwp-post-metadata li.bwp-author a:hover .author,
		.bwp-post-metadata li.bwp-author a:focus .author,
		.bwp-post-metadata li.bwp-categories a:hover,
		.bwp-post-metadata li.bwp-categories a:focus,
		.bwp-post-links li a:hover .bwp-counter-number,
		.bwp-post-links li a:focus .bwp-counter-number,
		.bwp-single-post-metadata li:not(.bwp-comments-counter) a:hover,
		.bwp-single-post-metadata li:not(.bwp-comments-counter) a:focus,
		.bwp-single-post-metadata li.bwp-comments-counter a:hover .bwp-counter-number,
		.bwp-single-post-metadata li.bwp-comments-counter a:focus .bwp-counter-number,
		.bwp-content .wp-block-rss li .wp-block-rss__item-title a:hover,
		.bwp-content .wp-block-rss li .wp-block-rss__item-title a:focus,
		.bwp-content .wp-block-tag-cloud a:hover,
		.bwp-content .wp-block-tag-cloud a:focus,
		.bwp-content .wp-block-page-list li a:hover,
		.bwp-content .wp-block-page-list li a:focus,
		.bwp-about-author .bwp-author-posts-link:hover .bwp-link-text,
		.bwp-about-author .bwp-author-posts-link:focus .bwp-link-text,
		.bwp-related-posts .post .bwp-post-metadata li.bwp-tags a:hover,
		.bwp-related-posts .post .bwp-post-metadata li.bwp-tags a:focus,
		.bwp-random-posts .post .bwp-post-metadata li.bwp-tags a:hover,
		.bwp-random-posts .post .bwp-post-metadata li.bwp-tags a:focus,
		.widget_tag_cloud .tagcloud a:hover,
		.widget_tag_cloud .tagcloud a:focus,
		.widget_rss ul li .rsswidget:hover,
		.widget_rss ul li .rsswidget:focus {
			box-shadow: inset 0 -1px 0 0 ' . $light_mode_hover_color . ';
		}
		.bwp-post-title a:hover,
		.bwp-post-title a:focus,
		.bwp-post-links li.bwp-read-more a:hover,
		.bwp-post-links li.bwp-read-more a:focus,
		.bwp-single-post-taxonomies a:hover,
		.bwp-single-post-taxonomies a:focus,
		.bwp-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:hover,
		.bwp-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:focus,
		.bwp-content ul.wp-block-latest-posts > li > a:hover,
		.bwp-content ul.wp-block-latest-posts > li > a:focus,
		.bwp-content .wp-block-post-template .wp-block-post-title a:hover,
		.bwp-content .wp-block-post-template .wp-block-post-title a:focus,
		.bwp-comment-list .comment-meta .comment-author .fn .url:hover,
		.bwp-comment-list .comment-meta .comment-author .fn .url:focus,
		.widget_calendar .wp-calendar-nav a:hover,
		.widget_calendar .wp-calendar-nav a:focus,
		.bwp-sidebar-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:hover,
		.bwp-sidebar-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:focus,
		.widget_bwp_content h4 a:hover,
		.widget_bwp_content h4 a:focus,
		.widget_bwp_post_list_item figcaption h4 a:hover,
		.widget_bwp_post_list_item figcaption h4 a:focus,
		.widget_bwp_meta li a:hover,
		.widget_bwp_meta li a:focus {
			color: ' . $light_mode_hover_color . ';
			box-shadow: inset 0 -1px 0 0 ' . $light_mode_hover_color . ';
		}
		@media (max-width: 991px) {
			.bwp-sticky-buttons-container .bwp-sticky-button:hover,
			.bwp-sticky-buttons-container .bwp-sticky-button:focus,
			.bwp-sticky-buttons-container .bwp-sticky-button.bwp-active {
				color: ' . $light_mode_hover_color . ';
				background: transparent;
			}
		}
		@media (max-width: 499px) {
			.bwp-comment-list .comment-body .reply a:hover,
			.bwp-comment-list .comment-body .reply a:focus,
			.bwp-comment-list .pingback .comment-body .edit-link a:hover,
			.bwp-comment-list .trackback .comment-body .edit-link a:hover {
				color: ' . $light_mode_hover_color . ';
				background-color: transparent;
			}
		}';
	}

	// Dark mode: Add additional styles only if dark mode is enabled
	$default_color_scheme = get_theme_mod( 'halva_default_color_mode', 'light' ); // light or dark
	$show_color_switch = get_theme_mod( 'halva_button_color_mode', 0 ); // 1 or 0
	$dark_mode_enabled = 'dark' === $default_color_scheme || $show_color_switch; // true or false

	// Dark mode: Hover/active color (id: halva_dark_mode_hover_color)
	if ( $dark_mode_enabled ) {
		$dark_mode_hover_color = get_theme_mod( 'halva_dark_mode_hover_color', '#877fff' );
		if ( '#877fff' !== $dark_mode_hover_color ) {
			$styles_after_dark_mode .= '
			.bwp-dark-mode a:hover,
			.bwp-dark-mode a:focus,
			.bwp-dark-mode h1 a:hover,
			.bwp-dark-mode h2 a:hover,
			.bwp-dark-mode h3 a:hover,
			.bwp-dark-mode h4 a:hover,
			.bwp-dark-mode h5 a:hover,
			.bwp-dark-mode h6 a:hover,
			.bwp-dark-mode h1 a:focus,
			.bwp-dark-mode h2 a:focus,
			.bwp-dark-mode h3 a:focus,
			.bwp-dark-mode h4 a:focus,
			.bwp-dark-mode h5 a:focus,
			.bwp-dark-mode h6 a:focus,
			.bwp-dark-mode .bwp-logo-text:hover,
			.bwp-dark-mode .bwp-logo-text:focus,
			.bwp-dark-mode .bwp-main-nav-logo-text:hover,
			.bwp-dark-mode .bwp-main-nav-logo-text:focus,
			.bwp-dark-mode .sf-menu a:hover,
			.bwp-dark-mode .sf-menu a:focus,
			.bwp-dark-mode .sf-menu > li:hover > a,
			.bwp-dark-mode .sf-menu > .current-menu-item > a,
			.bwp-dark-mode .sf-menu > .current-menu-ancestor > a,
			.bwp-dark-mode .sf-menu > .current-menu-ancestor > .sf-with-ul::after,
			.bwp-dark-mode .sf-menu ul li a:hover,
			.bwp-dark-mode .sf-menu ul li a:focus,
			.bwp-dark-mode .sf-menu ul > li:hover > a,
			.bwp-dark-mode .sf-menu ul > .current-menu-item > a,
			.bwp-dark-mode .sf-menu ul > .current-menu-ancestor > a,
			.bwp-dark-mode .sf-menu ul > .current-menu-ancestor > .sf-with-ul::after,
			.bwp-dark-mode .bwp-social-links a:hover,
			.bwp-dark-mode .bwp-social-links a:focus,
			.bwp-dark-mode .bwp-subscribe-link:hover,
			.bwp-dark-mode .bwp-subscribe-link:focus,
			.bwp-dark-mode .bwp-hide-main-nav-button:hover,
			.bwp-dark-mode .bwp-hide-main-nav-button:focus,
			.bwp-dark-mode .bwp-toggle-mobile-menu-button:hover,
			.bwp-dark-mode .bwp-toggle-mobile-menu-button.bwp-active,
			.bwp-dark-mode .bwp-mobile-menu li a:hover,
			.bwp-dark-mode .bwp-mobile-menu .current-menu-item > a,
			.bwp-dark-mode .bwp-toggle-mobile-submenu:hover,
			.bwp-dark-mode .bwp-mobile-menu li.bwp-submenu-visible > a .bwp-toggle-mobile-submenu,
			.bwp-dark-mode .bwp-mobile-menu-container .bwp-searchform .bwp-search-submit:hover,
			.bwp-dark-mode .bwp-mobile-menu-container .bwp-searchform .bwp-search-submit:focus,
			.bwp-dark-mode .bwp-toggle-layout:not(.bwp-active):hover,
			.bwp-dark-mode .bwp-toggle-layout:not(.bwp-active):focus,
			.bwp-dark-mode .bwp-toggle-layout.bwp-active:focus,
			.bwp-dark-mode .bwp-post-metadata li a:hover,
			.bwp-dark-mode .bwp-post-metadata li a:focus,
			.bwp-dark-mode .bwp-post-links li a:hover,
			.bwp-dark-mode .bwp-post-links li a:focus,
			.bwp-dark-mode .bwp-no-results-content a:hover,
			.bwp-dark-mode .bwp-no-results-content a:focus,
			.bwp-dark-mode .pagination .nav-links a.page-numbers:hover,
			.bwp-dark-mode .pagination .nav-links a.page-numbers:focus,
			.bwp-dark-mode .bwp-single-post-metadata li a:hover,
			.bwp-dark-mode .bwp-single-post-metadata li a:focus,
			.bwp-dark-mode .wp-playlist .wp-playlist-item a:hover,
			.bwp-dark-mode .comment-content a:hover,
			.bwp-dark-mode .comment-content a:focus,
			.bwp-dark-mode .bwp-content .bwp-single-post-pagination a:hover,
			.bwp-dark-mode .bwp-content .bwp-single-post-pagination a:focus,
			.bwp-dark-mode .bwp-content .wp-block-calendar .wp-calendar-nav a:hover,
			.bwp-dark-mode .bwp-content .wp-block-calendar .wp-calendar-nav a:focus,
			.bwp-dark-mode .bwp-content .wp-block-tag-cloud a:hover .tag-link-count,
			.bwp-dark-mode .bwp-content .wp-block-tag-cloud a:focus .tag-link-count,
			.bwp-dark-mode .bwp-content .wp-block-post-template .wp-block-post-excerpt__more-link:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-template .wp-block-post-excerpt__more-link:focus,
			.bwp-dark-mode .bwp-content .wp-block-post-template .wp-block-post-date a:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-template .wp-block-post-date a:focus,
			.bwp-dark-mode .bwp-content .wp-block-comment-template .wp-block-comment-date a:hover,
			.bwp-dark-mode .bwp-content .wp-block-comment-template .wp-block-comment-edit-link a:hover,
			.bwp-dark-mode .bwp-content .wp-block-comment-template .wp-block-comment-date a:focus,
			.bwp-dark-mode .bwp-content .wp-block-comment-template .wp-block-comment-edit-link a:focus,
			.bwp-dark-mode .bwp-content .wp-block-comment-template .wp-block-comment-reply-link a:hover,
			.bwp-dark-mode .bwp-content .wp-block-comment-template .wp-block-comment-reply-link a:focus,
			.bwp-dark-mode .bwp-content .wp-block-comments-pagination .wp-block-comments-pagination-numbers .current,
			.bwp-dark-mode .bwp-about-author .bwp-author-posts-link:hover,
			.bwp-dark-mode .bwp-about-author .bwp-author-posts-link:focus,
			.bwp-dark-mode .comment-form-cookies-consent label:hover,
			.bwp-dark-mode .comment-respond .must-log-in a:hover,
			.bwp-dark-mode .comment-respond .must-log-in a:focus,
			.bwp-dark-mode .comment-form .logged-in-as a:hover,
			.bwp-dark-mode .comment-form .logged-in-as a:focus,
			.bwp-dark-mode .comment-reply-title #cancel-comment-reply-link:hover,
			.bwp-dark-mode .bwp-comment-list .comment-meta .comment-metadata a:hover,
			.bwp-dark-mode .bwp-comment-list .comment-meta .comment-metadata a:focus,
			.bwp-dark-mode .bwp-comment-list .pingback .comment-body > a:hover,
			.bwp-dark-mode .bwp-comment-list .pingback .comment-body > a:focus,
			.bwp-dark-mode .bwp-comment-list .trackback .comment-body > a:hover,
			.bwp-dark-mode .bwp-comment-list .trackback .comment-body > a:focus,
			.bwp-dark-mode .comment-navigation .nav-links a:hover,
			.bwp-dark-mode .comment-navigation .nav-links a:focus,
			.bwp-dark-mode .post-navigation .nav-links a:hover,
			.bwp-dark-mode .post-navigation .nav-links a:focus,
			.bwp-dark-mode .bwp-page-404-content a:hover,
			.bwp-dark-mode .bwp-page-404-content a:focus,
			.bwp-dark-mode .bwp-site-footer a:hover,
			.bwp-dark-mode .bwp-site-footer a:focus,
			.bwp-dark-mode .bwp-font-type.bwp-active,
			.bwp-dark-mode .bwp-font-type:not(.bwp-active):hover,
			.bwp-dark-mode .bwp-dropdown-search-container .bwp-searchform .bwp-search-submit:hover,
			.bwp-dark-mode .bwp-dropdown-search-container .bwp-searchform .bwp-search-submit:focus,
			.bwp-dark-mode .bwp-hide-sidebar-button:hover,
			.bwp-dark-mode .bwp-hide-sidebar-button:focus,
			.bwp-dark-mode .bwp-widget a:hover,
			.bwp-dark-mode .bwp-widget a:focus,
			.bwp-dark-mode .widget a:hover,
			.bwp-dark-mode .widget a:focus,
			.bwp-dark-mode .bwp-widget .bwp-widget-title a:hover,
			.bwp-dark-mode .bwp-widget .bwp-widget-title a:focus,
			.bwp-dark-mode .widget .widgettitle a:hover,
			.bwp-dark-mode .widget .widgettitle a:focus,
			.bwp-dark-mode .bwp-sidebar-content ul.wp-block-latest-posts > li > a:hover,
			.bwp-dark-mode .bwp-sidebar-content ul.wp-block-latest-posts > li > a:focus,
			.bwp-dark-mode .widget_tag_cloud .tagcloud a:hover .tag-link-count,
			.bwp-dark-mode .widget_tag_cloud .tagcloud a:focus .tag-link-count,
			.bwp-dark-mode .widget_search .bwp-searchform .bwp-search-submit:hover,
			.bwp-dark-mode .widget_search .bwp-searchform .bwp-search-submit:focus,
			.bwp-dark-mode .widget_bwp_popular_posts > ul > li:hover .widget_bwp_popular_post_num,
			.bwp-dark-mode .bwp-button-show-cookies-info:hover {
				color: ' . $dark_mode_hover_color . ';
			}
			.bwp-dark-mode input[type="text"]:not(.bwp-search-field):hover,
			.bwp-dark-mode input[type="email"]:hover,
			.bwp-dark-mode input[type="url"]:hover,
			.bwp-dark-mode input[type="password"]:hover,
			.bwp-dark-mode input[type="search"]:hover,
			.bwp-dark-mode input[type="tel"]:hover,
			.bwp-dark-mode input[type="number"]:hover,
			.bwp-dark-mode input[type="date"]:hover,
			.bwp-dark-mode textarea:hover,
			.bwp-dark-mode select:hover,
			.bwp-dark-mode input[type="text"]:not(.bwp-search-field):focus,
			.bwp-dark-mode input[type="email"]:focus,
			.bwp-dark-mode input[type="url"]:focus,
			.bwp-dark-mode input[type="password"]:focus,
			.bwp-dark-mode input[type="search"]:focus,
			.bwp-dark-mode input[type="tel"]:focus,
			.bwp-dark-mode input[type="number"]:focus,
			.bwp-dark-mode input[type="date"]:focus,
			.bwp-dark-mode textarea:focus,
			.bwp-dark-mode select:focus,
			.bwp-dark-mode input[type="file"]:hover,
			.bwp-dark-mode input[type="file"]:focus,
			.bwp-dark-mode input[type="checkbox"]:hover,
			.bwp-dark-mode input[type="radio"]:hover,
			.bwp-dark-mode input[type="checkbox"]:focus,
			.bwp-dark-mode input[type="radio"]:focus,
			.bwp-dark-mode .bwp-mobile-menu-container .bwp-searchform:hover,
			.bwp-dark-mode .bwp-mobile-menu-container .bwp-searchform:focus,
			.bwp-dark-mode .bwp-content .post-password-form input[type="password"]:hover,
			.bwp-dark-mode .bwp-content .post-password-form input[type="password"]:focus,
			.bwp-dark-mode .bwp-content .wp-block-search .wp-block-search__input:hover,
			.bwp-dark-mode .bwp-content .wp-block-search .wp-block-search__input:focus,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-comment textarea:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-author input:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-email input:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-url input:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-comment textarea:focus,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-author input:focus,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-email input:focus,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-url input:focus,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-cookies-consent input:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-comments-form .comment-form-cookies-consent input:focus,
			.bwp-dark-mode .widget_search .bwp-searchform:hover,
			.bwp-dark-mode .widget_search .bwp-searchform:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="text"]:not(.bwp-search-field):hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="email"]:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="url"]:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="password"]:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="search"]:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="tel"]:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="number"]:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="date"]:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets textarea:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets select:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="text"]:not(.bwp-search-field):focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="email"]:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="url"]:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="password"]:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="search"]:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="tel"]:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="number"]:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets input[type="date"]:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets textarea:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets select:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets .widget_search .bwp-searchform:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets .widget_search .bwp-searchform:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets .wp-block-search .wp-block-search__input:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets .wp-block-search .wp-block-search__input:focus {
				border-color: ' . $dark_mode_hover_color . ';
			}
			.bwp-dark-mode input[type="checkbox"]:checked,
			.bwp-dark-mode input[type="radio"]:checked {
				background: ' . $dark_mode_hover_color . ';
				border-color: ' . $dark_mode_hover_color . ';
			}
			.bwp-dark-mode input[type="button"]:hover,
			.bwp-dark-mode input[type="reset"]:hover,
			.bwp-dark-mode input[type="submit"]:hover,
			.bwp-dark-mode input[type="button"]:focus,
			.bwp-dark-mode input[type="reset"]:focus,
			.bwp-dark-mode input[type="submit"]:focus,
			.bwp-dark-mode .bwp-carousel-container .tns-controls button:hover,
			.bwp-dark-mode .bwp-post-media-slider .tns-controls button:hover,
			.bwp-dark-mode .bwp-content .post-password-form input[type="submit"]:hover,
			.bwp-dark-mode .bwp-content .wp-block-file a.wp-block-file__button:active,
			.bwp-dark-mode .bwp-content .wp-block-file a.wp-block-file__button:focus,
			.bwp-dark-mode .bwp-content .wp-block-file a.wp-block-file__button:hover,
			.bwp-dark-mode .bwp-content .wp-block-search .wp-block-search__button:hover,
			.bwp-dark-mode .bwp-content .wp-block-search .wp-block-search__button:focus,
			.bwp-dark-mode .bwp-content .wp-block-search.wp-block-search__button-inside .wp-block-search__button:hover,
			.bwp-dark-mode .bwp-content .wp-block-search.wp-block-search__button-inside .wp-block-search__button:focus,
			.bwp-dark-mode .bwp-sticky-buttons-container .bwp-sticky-button:hover,
			.bwp-dark-mode .bwp-sticky-buttons-container .bwp-sticky-button:focus,
			.bwp-dark-mode .bwp-sticky-buttons-container .bwp-sticky-button.bwp-active,
			.bwp-dark-mode .bwp-scroll-top-button:hover,
			.bwp-dark-mode .bwp-accept-cookies-button:hover,
			.bwp-dark-mode .bwp-button-hide-cookies-info:hover {
				background: ' . $dark_mode_hover_color . ';
			}
			.bwp-dark-mode .bwp-mobile-menu-container .bwp-social-links a:hover,
			.bwp-dark-mode .bwp-mobile-menu-container .bwp-social-links a:focus,
			.bwp-dark-mode .bwp-carousel-container .tns-controls button[data-controls="next"]:hover::before,
			.bwp-dark-mode .bwp-post-media-slider .tns-controls button[data-controls="next"]:hover::before,
			.bwp-dark-mode .pagination .nav-links .page-numbers.current,
			.bwp-dark-mode .bwp-content .bwp-single-post-pagination .post-page-numbers.current,
			.bwp-dark-mode .bwp-content .wp-block-query-pagination .page-numbers.current,
			.bwp-dark-mode .bwp-content .wp-block-comments-pagination .page-numbers.current,
			.bwp-dark-mode .bwp-comment-list .comment-body .reply a:hover,
			.bwp-dark-mode .bwp-comment-list .comment-body .reply a:focus,
			.bwp-dark-mode .bwp-comment-list .pingback .comment-body .edit-link a:hover,
			.bwp-dark-mode .bwp-comment-list .trackback .comment-body .edit-link a:hover,
			.bwp-dark-mode .bwp-footer-text a:hover::after,
			.bwp-dark-mode .bwp-footer-text a:focus::after,
			.bwp-dark-mode .bwp-footer-menu-list li a:hover::after,
			.bwp-dark-mode .bwp-footer-menu-list li a:focus::after,
			.bwp-dark-mode .wp-calendar-table tbody #today,
			.bwp-dark-mode .widget_bwp_social ul li a:hover,
			.bwp-dark-mode .widget_bwp_social ul li a:focus,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets .widget_bwp_social ul li a:hover,
			.bwp-dark-mode.bwp-page-with-posts .bwp-footer-widgets .widget_bwp_social ul li a:focus {
				background-color: ' . $dark_mode_hover_color . ';
			}
			.bwp-dark-mode .bwp-post-metadata li.bwp-date a:hover .date,
			.bwp-dark-mode .bwp-post-metadata li.bwp-date a:focus .date,
			.bwp-dark-mode .bwp-post-metadata li.bwp-author a:hover .author,
			.bwp-dark-mode .bwp-post-metadata li.bwp-author a:focus .author,
			.bwp-dark-mode .bwp-post-metadata li.bwp-categories a:hover,
			.bwp-dark-mode .bwp-post-metadata li.bwp-categories a:focus,
			.bwp-dark-mode .bwp-post-links li a:hover .bwp-counter-number,
			.bwp-dark-mode .bwp-post-links li a:focus .bwp-counter-number,
			.bwp-dark-mode .bwp-single-post-metadata li:not(.bwp-comments-counter) a:hover,
			.bwp-dark-mode .bwp-single-post-metadata li:not(.bwp-comments-counter) a:focus,
			.bwp-dark-mode .bwp-single-post-metadata li.bwp-comments-counter a:hover .bwp-counter-number,
			.bwp-dark-mode .bwp-single-post-metadata li.bwp-comments-counter a:focus .bwp-counter-number,
			.bwp-dark-mode .bwp-content .wp-block-rss li .wp-block-rss__item-title a:hover,
			.bwp-dark-mode .bwp-content .wp-block-rss li .wp-block-rss__item-title a:focus,
			.bwp-dark-mode .bwp-content .wp-block-tag-cloud a:hover,
			.bwp-dark-mode .bwp-content .wp-block-tag-cloud a:focus,
			.bwp-dark-mode .bwp-content .wp-block-page-list li a:hover,
			.bwp-dark-mode .bwp-content .wp-block-page-list li a:focus,
			.bwp-dark-mode .bwp-about-author .bwp-author-posts-link:hover .bwp-link-text,
			.bwp-dark-mode .bwp-about-author .bwp-author-posts-link:focus .bwp-link-text,
			.bwp-dark-mode .bwp-related-posts .post .bwp-post-metadata li.bwp-tags a:hover,
			.bwp-dark-mode .bwp-related-posts .post .bwp-post-metadata li.bwp-tags a:focus,
			.bwp-dark-mode .bwp-random-posts .post .bwp-post-metadata li.bwp-tags a:hover,
			.bwp-dark-mode .bwp-random-posts .post .bwp-post-metadata li.bwp-tags a:focus,
			.bwp-dark-mode .widget_tag_cloud .tagcloud a:hover,
			.bwp-dark-mode .widget_tag_cloud .tagcloud a:focus,
			.bwp-dark-mode .widget_rss ul li .rsswidget:hover,
			.bwp-dark-mode .widget_rss ul li .rsswidget:focus {
				box-shadow: inset 0 -1px 0 0 ' . $dark_mode_hover_color . ';
			}
			.bwp-dark-mode .bwp-post-title a:hover,
			.bwp-dark-mode .bwp-post-title a:focus,
			.bwp-dark-mode .bwp-post-links li.bwp-read-more a:hover,
			.bwp-dark-mode .bwp-post-links li.bwp-read-more a:focus,
			.bwp-dark-mode .bwp-single-post-taxonomies a:hover,
			.bwp-dark-mode .bwp-single-post-taxonomies a:focus,
			.bwp-dark-mode .bwp-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:hover,
			.bwp-dark-mode .bwp-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:focus,
			.bwp-dark-mode .bwp-content ul.wp-block-latest-posts > li > a:hover,
			.bwp-dark-mode .bwp-content ul.wp-block-latest-posts > li > a:focus,
			.bwp-dark-mode .bwp-content .wp-block-post-template .wp-block-post-title a:hover,
			.bwp-dark-mode .bwp-content .wp-block-post-template .wp-block-post-title a:focus,
			.bwp-dark-mode .bwp-comment-list .comment-meta .comment-author .fn .url:hover,
			.bwp-dark-mode .bwp-comment-list .comment-meta .comment-author .fn .url:focus,
			.bwp-dark-mode .widget_calendar .wp-calendar-nav a:hover,
			.bwp-dark-mode .widget_calendar .wp-calendar-nav a:focus,
			.bwp-dark-mode .bwp-sidebar-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:hover,
			.bwp-dark-mode .bwp-sidebar-content .wp-block-latest-comments .wp-block-latest-comments__comment-meta a:focus,
			.bwp-dark-mode .widget_bwp_content h4 a:hover,
			.bwp-dark-mode .widget_bwp_content h4 a:focus,
			.bwp-dark-mode .widget_bwp_post_list_item figcaption h4 a:hover,
			.bwp-dark-mode .widget_bwp_post_list_item figcaption h4 a:focus,
			.bwp-dark-mode .widget_bwp_meta li a:hover,
			.bwp-dark-mode .widget_bwp_meta li a:focus {
				color: ' . $dark_mode_hover_color . ';
				box-shadow: inset 0 -1px 0 0 ' . $dark_mode_hover_color . ';
			}
			@media (max-width: 991px) {
				.bwp-dark-mode .bwp-sticky-buttons-container .bwp-sticky-button:hover,
				.bwp-dark-mode .bwp-sticky-buttons-container .bwp-sticky-button:focus,
				.bwp-dark-mode .bwp-sticky-buttons-container .bwp-sticky-button.bwp-active {
					color: ' . $dark_mode_hover_color . ';
					background: transparent;
				}
			}
			@media (max-width: 499px) {
				.bwp-dark-mode .bwp-comment-list .comment-body .reply a:hover,
				.bwp-dark-mode .bwp-comment-list .comment-body .reply a:focus,
				.bwp-dark-mode .bwp-comment-list .pingback .comment-body .edit-link a:hover,
				.bwp-dark-mode .bwp-comment-list .trackback .comment-body .edit-link a:hover {
					color: ' . $dark_mode_hover_color . ';
					background-color: transparent;
				}
			}';
		}
	}

	// Add text transformation for some text elements (id: halva_styles_text_transform)
	$add_text_transform = get_theme_mod( 'halva_styles_text_transform', 1 ); // 1 or 0
	if ( $add_text_transform ) {
		$styles_after_main_styles .= '
		.post-navigation .nav-links a .meta-nav,
		.comment-reply-title,
		.bwp-comments-title,
		.comment-navigation .nav-links a,
		.comment-form #submit,
		.bwp-related-posts-title,
		.bwp-random-posts-title,
		.bwp-font-type {
			text-transform: capitalize;
		}';
	}

	// Disable hover effects when hovering over a widget image (id: halva_styles_widget_hover_effects)
	$widget_hover_effects = get_theme_mod( 'halva_styles_widget_hover_effects', 1 ); // 1 or 0
	if ( ! $widget_hover_effects ) {
		$styles_after_main_styles .= '
		.widget_bwp_bg_overlay {
			display: none;
		}
		.widget_bwp_post_list_item:hover .widget_bwp_dark_bg_overlay {
			opacity: 0.13;
		}
		.bwp-dark-mode .widget_bwp_post_list_item:hover .widget_bwp_dark_bg_overlay {
			opacity: 0.15 !important;
		}
		.widget_bwp_thumbnail:hover,
		.widget_bwp_popular_posts > ul > li:hover .widget_bwp_popular_post_num,
		.widget_bwp_post_list_item:hover figcaption {
			-webkit-transform: none;
			transform: none;
		}
		.widget_bwp_popular_posts > ul > li:hover .widget_bwp_popular_post_num {
			color: #4e4d58;
		}
		.bwp-dark-mode .widget_bwp_popular_posts > ul > li:hover .widget_bwp_popular_post_num {
			color: #d9d9df !important;
		}';
	}


	/**
	 * Add inline styles
	 * ----------------------------------------------
	 */

	// For the main theme style (style.css; id: halva-style)
	wp_add_inline_style( 'halva-style', $styles_after_main_styles );

	// For the dark mode style (dark-mode.css; id: halva-dark-mode)
	if ( $dark_mode_enabled ) {
		wp_add_inline_style( 'halva-dark-mode', $styles_after_dark_mode );
	}

}
add_action( 'wp_enqueue_scripts', 'halva_inline_styles' );
