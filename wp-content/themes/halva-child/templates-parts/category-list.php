<section class="category-section mt-5">
    <div class="container">
        <div class="row">
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC',
                'meta_key'   => 'show_on_homepage',
                'meta_value' => '1',
            ));

            foreach ($categories as $category) {
                ?>
                <div class="col-md-6 col-lg-4 category-column mb-4">
                    <div class="category-box mb-4 border pt-3 px-3 pb-0 h-100">
                        <h2 class="category-title mb-3 text-center text-uppercase">
                            <a href="<?php echo get_category_link($category->term_id); ?>" class="text-decoration-none">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </h2>
                        <div class="category-posts">
                            <?php
                            $args = array(
                                'cat' => $category->term_id,
                                'posts_per_page' => 5,
                            );
                            $category_posts = new WP_Query($args);

                            if ($category_posts->have_posts()) {
                                while ($category_posts->have_posts()) {
                                    $category_posts->the_post();
                                    $post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                                    if (!$post_thumbnail) {
                                        $post_thumbnail = get_stylesheet_directory_uri() . '/assets/images/froe1_1-150x150.png';
                                    }
                                    ?>
                                    <div class="category-post d-flex align-items-center mb-3">
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url($post_thumbnail); ?>" alt="<?php the_title(); ?>" class="img-fluid" width="60">
                                            </a>
                                        </div>
                                        <div class="post-title ms-3">
                                            <a class="text-decoration-none" href="<?php the_permalink(); ?>">
                                                <h3 class="h6"><?php the_title(); ?></h3>
                                            </a>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                            wp_reset_postdata();
                            ?>
                        </div>

                        <?php
                            $total_posts = get_category($category->term_id)->count;
                            if ($total_posts > 5) {
                                ?>
                                <div class="text-center mt-3">
                                    <a href="<?php echo get_category_link($category->term_id); ?>" class="btn btn-dark btn-sm">
                                        <?= __("Read More", "halva") ?>
                                    </a>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
