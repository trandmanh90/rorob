<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */
?>

<!-- search form -->
<div class="bwp-searchform-label"><?php esc_html_e( 'Search:', 'halva' ); ?></div>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" class="bwp-searchform">
	<div class="input-group">
		<input type="text" name="s" class="bwp-search-field form-control" autocomplete="off" placeholder="<?php esc_attr_e( 'Enter your search query...', 'halva' ); ?>" aria-label="Search">
		<button type="submit" class="bwp-search-submit btn"><i class="fa-solid fa-magnifying-glass"></i></button>
	</div>
</form>
<!-- end: search form -->
