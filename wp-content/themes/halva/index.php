<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

// header
get_header();

// posts with pagination
get_template_part( 'templates/blog-posts' );

// footer
get_footer();
