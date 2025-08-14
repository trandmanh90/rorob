<?php
/**
 * This is a template for displaying messages that posts were not found
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */
?>

<!-- no results (content none) -->
<div class="bwp-no-results">
	<div class="bwp-no-results-content">

		<h3><?php esc_html_e( 'Nothing found', 'halva' ); ?></h3>

		<?php
		// homepage: a message for the site administrator with a suggestion to add a new post
		if ( is_home() && current_user_can( 'publish_posts' ) ) {
			?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'halva' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php
		} elseif ( is_search() ) {
			// search page: no search results
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'halva' ); ?></p>

			<?php
		} else {
			// otherwise, a message about the lack of posts on the site
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'halva' ); ?></p>

			<?php
		}
		?>

	</div>
</div>
<!-- end: no results (content none) -->
