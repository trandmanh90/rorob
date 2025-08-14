<?php
function halva_child_enqueue_styles() {
    $parent_style = 'halva-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('halva-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
    wp_enqueue_style('halva-child-extra-style', get_stylesheet_directory_uri() . '/assets/css/styles-child.css');
}
add_action('wp_enqueue_scripts', 'halva_child_enqueue_styles');

function enqueue_custom_script() {
    wp_enqueue_script('halva-child-extra-js', get_stylesheet_directory_uri() . '/assets/js/halva-theme-child.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');

//field category
function add_category_custom_field($term) {
    $show_on_homepage = get_term_meta($term->term_id, 'show_on_homepage', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="show_on_homepage"><?= __("Display home page") ?>?</label></th>
        <td>
            <input type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1" <?php checked($show_on_homepage, '1'); ?>>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'add_category_custom_field');
add_action('category_add_form_fields', 'add_category_custom_field');

function save_category_custom_field($term_id) {
    if (isset($_POST['show_on_homepage'])) {
        update_term_meta($term_id, 'show_on_homepage', '1');
    } else {
        delete_term_meta($term_id, 'show_on_homepage');
    }
}
add_action('edited_category', 'save_category_custom_field');
add_action('created_category', 'save_category_custom_field');


/**
 * The function displays the logo in the hidden navigation (image or text)
 *
 * @since Halva 1.0
 */
if ( ! function_exists( 'halva_show_hidden_nav_logo' ) ) {
	function halva_show_hidden_nav_logo() {
		// logo type: text or image
		$hidden_nav_logo_type = get_theme_mod( 'halva_hidden_nav_logo_type', 'text' );
		if ( 'text' === $hidden_nav_logo_type ) {
			// logo type: text

			// text for logo
			$hidden_nav_logo_text = get_theme_mod( 'halva_hidden_nav_logo_text', 'Halva.' );
			if ( '' !== $hidden_nav_logo_text ) {
				// show text logo
				?>

				<!-- logo (text) -->
				<h1 class="bwp-main-nav-logo bwp-hover-link-animation">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-main-nav-logo-text">
						<?php if ( is_front_page() ) : ?>
							<span><?php echo esc_html( $hidden_nav_logo_text ); ?></span>
						<?php else : ?>
							<span><?php echo esc_html( $hidden_nav_logo_text ); ?></span>
							<span class="hidden-max-991px"> - </span>
							<span><?php echo esc_html( get_the_title() ); ?></span>
						<?php endif; ?>
					</a>
				</h1>
				<!-- end: logo -->

				<?php
			}

		} else {
			// logo type: image

			// logo url
			$hidden_nav_logo_url = get_theme_mod( 'halva_hidden_nav_logo_image' );
			if ( $hidden_nav_logo_url ) {
				// logo for dark mode
				$hidden_nav_dark_mode_logo_url = get_theme_mod( 'halva_hidden_nav_dark_mode_logo_image' );
				// logo: alt text
				$hidden_nav_logo_alt = get_bloginfo( 'name' );
				// get current color scheme
				$current_color_scheme = halva_get_current_color_scheme(); // light or dark
				?>

				<!-- logo (image) -->
				<div id="bwp-nav-logo" class="bwp-main-nav-logo"
					 data-logo-url="<?php echo esc_url( $hidden_nav_logo_url ); ?>"
					 data-dark-mode-logo-url="<?php if ( $hidden_nav_dark_mode_logo_url ) { echo esc_url( $hidden_nav_dark_mode_logo_url ); } else { echo 'none'; } ?>"
					 data-logo-alt="<?php echo esc_attr( $hidden_nav_logo_alt ); ?>">

					<?php
					if ( 'dark' === $current_color_scheme && $hidden_nav_dark_mode_logo_url ) {
						// show logo for dark mode
						?>

						<!-- image (dark mode) -->
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-main-nav-logo-image">
							<img src="<?php echo esc_url( $hidden_nav_dark_mode_logo_url ); ?>" alt="<?php echo esc_attr( $hidden_nav_logo_alt ); ?>">
						</a>
						<!-- end: image -->

						<?php
					} else {
						// show logo
						?>

						<!-- image -->
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-main-nav-logo-image">
							<img src="<?php echo esc_url( $hidden_nav_logo_url ); ?>" alt="<?php echo esc_attr( $hidden_nav_logo_alt ); ?>">
						</a>
						<!-- end: image -->

						<?php
					}
					?>

				</div>
				<!-- end: logo -->

				<?php
			} else {
				// if there is no logo, then output an empty block (only for JavaScript needs)
				?>

				<!-- logo (empty block) -->
				<div id="bwp-nav-logo" class="bwp-main-nav-logo" data-logo-url="none" data-dark-mode-logo-url="none" data-logo-alt="none"></div>
				<!-- end: logo (empty block) -->

				<?php
			}

		} // end: logo type
	}
}