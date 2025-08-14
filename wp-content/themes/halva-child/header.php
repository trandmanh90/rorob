<?php

/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!-- container with site content -->
	<div class="bwp-site-content">

		<!-- secondary navigation -->
		<nav class="bwp-nav">
			<div class="container">
				<div class="bwp-nav-container d-flex flex-column flex-md-row <?php echo is_front_page() ? 'flex-wrap' : 'flex-nowrap'; ?>">
					<div class="toggle-main-navigation">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/menu.webp" alt="Toggle open main navigation">
						<?php halva_show_hidden_nav_logo();	?>
					</div>
					
					
					<?php if (is_front_page() && is_home()) : ?>

						<?php
						$ecentura_banner_header = get_option('ecentura_banner_header');				
						if ($ecentura_banner_header) :
						?>
							<div class="banner">
								<?php echo wp_get_attachment_image($ecentura_banner_header, 'full'); ?>
							</div>
						<?php endif; ?>

						<div class="content">
							<h2 class="title">
								<?php
									$ecentura_title_header = get_option('ecentura_title_header');
									echo !empty($ecentura_title_header) ? $ecentura_title_header : '';							
								?> 
							</h2>
							<h4 class="subtitle">
								<?php
									$ecentura_subtitle_header = get_option('ecentura_subtitle_header');
									echo !empty($ecentura_subtitle_header) ? $ecentura_subtitle_header : '';							
								?> 
							</h4>
							<div class="description">
								<?php
									$ecentura_text_header = get_option('ecentura_text_header');
									echo !empty($ecentura_text_header) ? $ecentura_text_header : get_bloginfo('description');							
								?> 
							</div>
						</div>

					<?php endif; ?>
					
					
					
					<?php $ecentura_thumbnail_header = get_option('ecentura_thumbnail_header'); ?>		
					<?php if ( !is_front_page() && !is_home() && $ecentura_thumbnail_header ) : ?>
						<div class="bwp-thumbnail-header">
							<?php echo wp_get_attachment_image($ecentura_thumbnail_header, 'full'); ?>
						</div>
					<?php endif; ?>
					
					<div class="box-nav">
						<div class="btn-close"></div>
						<?php wp_nav_menu(
							array(
								'theme_location' => 'halva_main_menu',
								'container' => 'false',
								'menu_id' => 'main-menu',
								'menu_class' => 'sm sm-clean',
								'link_before' => ' ',
								'link_after' => ' ',
								'depth' => 1,
							)
						); ?>
					</div>
				</div>
			</div>
		</nav>
		<!-- end: secondary navigation -->