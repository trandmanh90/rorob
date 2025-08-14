<?php
/**
 * Widget: Popular Posts
 *
 * @since Halva Additional Features 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Register widget
 */
add_action( 'widgets_init', 'halva_additional_features_register_popular_widget' );

function halva_additional_features_register_popular_widget() {
	register_widget( 'halva_additional_features_popular_widget' );
}


/**
 * Class halva_additional_features_popular_widget
 */
class halva_additional_features_popular_widget extends WP_Widget {

	/**
	 * Sets up the widget name, description, class, etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'		=> 'widget_bwp_popular_posts',
			'description'	=> esc_html__( 'Displays a list of popular posts.', 'halva-additional-features' ),
		);
		parent::__construct( 'halva_popular_widget', esc_html__( 'Halva: Popular Posts', 'halva-additional-features' ), $widget_ops );
	}

	/**
	 * Outputs the options form on admin
	 */
	public function form( $instance ) {
		// defaults
		$title_instance = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		$num_posts_instance = isset( $instance['num_posts'] ) ? $instance['num_posts'] : 4;
		$show_author_instance = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : false;
		$show_date_instance = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_views_counter_instance = isset( $instance['show_views_counter'] ) ? (bool) $instance['show_views_counter'] : false;
		$show_comments_counter_instance = isset( $instance['show_comments_counter'] ) ? (bool) $instance['show_comments_counter'] : false;
		$categories_instance = isset( $instance['categories'] ) ? $instance['categories'] : '';
		$popularity_filter_instance = isset( $instance['popularity_filter'] ) ? $instance['popularity_filter'] : 'comments';
		?>

		<!-- title -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title_instance ); ?>">
		</p>
		<!-- end: title -->

		<!-- number of posts -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_posts' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'halva-additional-features' ); ?></label>
			<input type="number" min="1" max="40" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'num_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_posts' ) ); ?>" value="<?php echo (int) $num_posts_instance; ?>">
		</p>
		<!-- end: number of posts -->

		<!-- show author -->
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_author' ) ); ?>"<?php checked( $show_author_instance ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>"><?php esc_html_e( 'Show author', 'halva-additional-features' ); ?></label>
		</p>
		<!-- end: show author -->

		<!-- show date -->
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>"<?php checked( $show_date_instance ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Show date', 'halva-additional-features' ); ?></label>
		</p>
		<!-- end: show date -->

		<!-- show views counter -->
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_views_counter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_views_counter' ) ); ?>"<?php checked( $show_views_counter_instance ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_views_counter' ) ); ?>"><?php esc_html_e( 'Show views counter', 'halva-additional-features' ); ?></label>
		</p>
		<!-- end: show views counter -->

		<!-- show comments counter -->
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_comments_counter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments_counter' ) ); ?>"<?php checked( $show_comments_counter_instance ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_comments_counter' ) ); ?>"><?php esc_html_e( 'Show comments counter', 'halva-additional-features' ); ?></label>
		</p>
		<!-- end: show comments counter -->

		<!-- categories -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php esc_html_e( 'Filter by category:', 'halva-additional-features' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>" class="widefat">
				<option value="" <?php if ( '' === $categories_instance ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'All categories', 'halva-additional-features' ); ?></option>
				<?php
				$posts_categories = get_categories( 'hide_empty=0&depth=1&type=post' );
				foreach ( $posts_categories as $category ) {
					$category_id = $category->term_id;
					$category_name = $category->cat_name;
					?>
					<option value="<?php echo (int) $category_id; ?>" <?php if ( $category_id === (int) $categories_instance ) { echo 'selected="selected"'; } ?>><?php echo esc_html( $category_name ); ?></option>
					<?php
				}
				?>
			</select>
		</p>
		<!-- end: categories -->

		<!-- popularity filter -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'popularity_filter' ) ); ?>"><?php esc_html_e( 'Popularity filter:', 'halva-additional-features' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'popularity_filter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'popularity_filter' ) ); ?>" class="widefat">
				<option value="views" <?php if ( 'views' === $popularity_filter_instance ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Views', 'halva-additional-features' ); ?></option>
				<option value="comments" <?php if ( 'comments' === $popularity_filter_instance ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Comments', 'halva-additional-features' ); ?></option>
			</select>
		</p>
		<!-- end: popularity filter -->

		<?php
	}

	/**
	 * Processing widget options on save
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['num_posts'] = (int) $new_instance['num_posts'];
		$instance['show_author'] = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_views_counter'] = isset( $new_instance['show_views_counter'] ) ? (bool) $new_instance['show_views_counter'] : false;
		$instance['show_comments_counter'] = isset( $new_instance['show_comments_counter'] ) ? (bool) $new_instance['show_comments_counter'] : false;
		$instance['categories'] = $new_instance['categories'];
		$instance['popularity_filter'] = $new_instance['popularity_filter'];

		return $instance;
	}

	/**
	 * Outputs the content of the widget
	 */
	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular posts', 'halva-additional-features' );
		$num_posts = ! empty( $instance['num_posts'] ) ? (int) $instance['num_posts'] : 4;
		if ( ! $num_posts ) {
			$num_posts = 4;
		}
		$show_author = isset( $instance['show_author'] ) ? $instance['show_author'] : false;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_views_counter = isset( $instance['show_views_counter'] ) ? $instance['show_views_counter'] : false;
		$show_comments_counter = isset( $instance['show_comments_counter'] ) ? $instance['show_comments_counter'] : false;
		$categories = ! empty( $instance['categories'] ) ? $instance['categories'] : '';
		$popularity_filter = ! empty( $instance['popularity_filter'] ) ? $instance['popularity_filter'] : 'comments';

		// display "div" tag (before widget)
		echo wp_kses( $args['before_widget'], array(
			'div'	=> array(
				'id'	=> array(),
				'class'	=> array(),
			),
		) );

		// display widget title
		if ( $title ) {
			echo wp_kses( $args['before_title'], array(
				'h2'	=> array(
					'class'	=> array(),
				),
				'h3'	=> array(
					'class'	=> array(),
				),
			) );
			echo esc_html( $title );
			echo wp_kses( $args['after_title'], array(
				'h2'	=> array(),
				'h3'	=> array(),
			) );
		}

		// query args
		if ( 'views' === $popularity_filter ) {
			// sorting posts by views
			$popular_args = array(
				'posts_per_page'		=> $num_posts,
				'post_type'				=> 'post',
				'cat'					=> $categories,
				'meta_key'				=> '_halva_post_views_count',
				'orderby'				=> 'meta_value_num',
				'ignore_sticky_posts'	=> true,
			);
		} else {
			// sorting posts by comments
			$popular_args = array(
				'posts_per_page'		=> $num_posts,
				'post_type'				=> 'post',
				'cat'					=> $categories,
				'orderby'				=> 'comment_count',
				'ignore_sticky_posts'	=> true,
			);
		}
		$popular_query = new WP_Query( $popular_args );

		// start widget
		if ( $popular_query->have_posts() ) {

			// post number (initial value)
			$popular_post_number = 1;
			// image size = 200x200 px
			$image_size = 'halva-200-200-crop';

			echo '<ul class="list-unstyled">';

			while ( $popular_query->have_posts() ) {
				$popular_query->the_post();

				// post id
				$popular_post_id = get_the_ID();

				echo '<li>';

				// variable: post with thumbnail or not (css class)
				$no_thumbnail_class = 'widget_bwp_no_thumbnail';

				// featured image
				if ( has_post_thumbnail() ) {
					// remove additional class
					$no_thumbnail_class = '';
					?>

					<!-- featured image -->
					<figure class="widget_bwp_thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( $image_size ); ?>
							<div class="widget_bwp_bg_overlay"></div>
						</a>
					</figure>
					<!-- end: featured image -->

					<?php
				}
				?>

				<!-- post number -->
				<span class="widget_bwp_popular_post_num<?php echo ( '' !== $no_thumbnail_class ) ? ' ' . sanitize_html_class( $no_thumbnail_class ) : ''; ?>">
					<?php
					// show post number (position number) and then increase it by 1
					echo (int) $popular_post_number;
					$popular_post_number += 1;
					?>
				</span>
				<!-- end: post number -->

				<!-- post content (title and metadata) -->
				<div class="widget_bwp_content<?php echo ( '' !== $no_thumbnail_class ) ? ' ' . sanitize_html_class( $no_thumbnail_class ) : ''; ?>">

					<?php
					// post title
					if ( get_the_title() ) {
						?>

						<h4 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>

						<?php
					} else {
						?>

						<h4 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read Post', 'halva-additional-features' ); ?></a>
						</h4>

						<?php
					}

					// post metadata
					if ( $show_author || $show_date || $show_views_counter || $show_comments_counter ) {
						?>

						<ul class="widget_bwp_meta list-unstyled clearfix">

							<?php
							// author
							if ( $show_author ) {
								$author_id = get_the_author_meta( 'ID' );
								$author_display_name = get_the_author_meta( 'display_name' );
								$author_posts_url = get_author_posts_url( $author_id );
								?>

								<li>
									<a href="<?php echo esc_url( $author_posts_url ); ?>" rel="author">
										<span class="vcard author">
											<span class="fn"><?php echo esc_html( $author_display_name ); ?></span>
										</span>
									</a>
								</li>

								<?php
							}

							// date
							if ( $show_date ) {
								$archive_year = get_the_time( 'Y' );
								$archive_month = get_the_time( 'm' );
								$archive_day = get_the_time( 'd' );
								?>

								<li>
									<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
										<time datetime="<?php the_time( 'c' ); ?>" class="date published"><?php the_time( get_option( 'date_format' ) ); ?></time>
									</a>
								</li>

								<?php
							}

							// views counter
							if ( $show_views_counter ) {
								?>

								<li class="widget_bwp_views_count">
									<a href="<?php the_permalink(); ?>">
										<?php echo esc_html__( 'Views:', 'halva-additional-features' ) . ' ' . esc_html( halva_additional_features_get_views( $popular_post_id ) ); ?>
									</a>
								</li>

								<?php
							}

							// comments counter
							if ( $show_comments_counter ) {
								if ( comments_open() ) {
									?>

									<li class="widget_bwp_comments_count">
										<a href="<?php the_permalink(); ?>#comments">
											<?php comments_number( esc_html__( 'No comments', 'halva-additional-features' ), esc_html__( '1 Comment', 'halva-additional-features' ), esc_html__( '% Comments', 'halva-additional-features' ) ); ?>
										</a>
									</li>

									<?php
								} elseif ( get_comments_number() ) {
									?>

									<li class="widget_bwp_comments_count">
										<a href="<?php the_permalink(); ?>#comments">
											<?php comments_number( '', esc_html__( '1 Comment', 'halva-additional-features' ), esc_html__( '% Comments', 'halva-additional-features' ) ); ?>
										</a>
									</li>

									<?php
								}
							}
							?>

						</ul>

						<?php
					}
					?>

				</div>
				<!-- end: post content (title and metadata) -->

				<?php
				echo '</li>';

			} // end while

			echo '</ul>';

		} // end if

		// if no posts
		if ( ! $popular_query->have_posts() ) {
			?>

			<p class="widget_bwp_no_posts">
				<?php esc_html_e( 'No posts found.', 'halva-additional-features' ); ?>
			</p>

			<?php
		}

		// reset post data
		wp_reset_postdata();

		// display "div" tag (after widget)
		echo wp_kses( $args['after_widget'], array( 'div' => array() ) );
	}

}
