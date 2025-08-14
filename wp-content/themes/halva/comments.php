<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Halva
 * @since Halva 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// show or hide avatars (WordPress Settings > Discussion > Avatars > Avatar Display: Show Avatars)
$show_avatars = get_option( 'show_avatars' );

// does the post have comments?
$post_has_comments = have_comments(); // true or false
?>

<!-- comments area (comment list and comment form) -->
<div id="comments" class="bwp-comments-area<?php if ( $post_has_comments ) { echo ' bwp-post-has-comments'; } ?>">
	<div class="bwp-section-separator bwp-gradient"></div>

	<?php
	// if the post has comments
	if ( $post_has_comments ) {
		?>

		<!-- comments title -->
		<h2 class="bwp-comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				printf(
					_x(
						'One thought on &ldquo;%s&rdquo;',
						'comments title',
						'halva'
					),
					get_the_title()
				);
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'halva'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>
		<!-- end: comments title -->

		<!-- comment list and navigation -->
		<div class="bwp-comment-list-wrap<?php echo ( ! comments_open() ) ? ' bwp-comments-closed' : ''; ?>">

			<ol class="bwp-comment-list<?php echo ( ! $show_avatars ) ? ' bwp-no-avatars' : ''; ?>">
				<?php
				wp_list_comments( array(
					'style'			=> 'ol',
					'short_ping'	=> true,
					'avatar_size'	=> 92,
				) );
				?>
			</ol>

			<?php
			// comments navigation
			the_comments_navigation( array(
				'prev_text'	=> '<i class="fa-solid fa-angle-left"></i>' . esc_html__( 'Older comments', 'halva' ),
				'next_text'	=> esc_html__( 'Newer comments', 'halva' ) . '<i class="fa-solid fa-angle-right"></i>',
			) );
			?>

		</div>
		<!-- end: comment list and navigation -->

		<?php
	}

	// message that comments are closed
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		?>

		<!-- comments are closed -->
		<div class="bwp-no-comments-wrap">
			<p class="bwp-no-comments"><?php esc_html_e( 'Comments are closed.', 'halva' ); ?></p>
		</div>
		<!-- end: comments are closed -->

		<?php
	}

	// comment form
	comment_form( array(
		'title_reply_before'	=> '<h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after'		=> '</h2>',
		'comment_notes_before'	=> '<p class="comment-notes">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'halva' ) . '</p>',
		'title_reply'			=> '<span>' . esc_html__( 'Leave a reply', 'halva' ) . '</span>',
		'title_reply_to'		=> '<span>' . esc_html__( 'Leave a reply to %s', 'halva' ) . '</span>',
		'cancel_reply_link'		=> esc_html__( 'Cancel reply', 'halva' ),
		'label_submit'			=> esc_html__( 'Post comment', 'halva' ),
	) );
	?>

</div>
<!-- end: comments area (comment list and comment form) -->
