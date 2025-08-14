<?php
get_header();
?>

<section class="category-section mt-5">
    <div class="container">

        <?php
        $current_cat_id = get_queried_object_id();
        $featured_post = new WP_Query(array(
            'cat' => $current_cat_id,
            'posts_per_page' => 1,
        ));

        $exclude_ids = array();

        if ($featured_post->have_posts()) :
            while ($featured_post->have_posts()) : $featured_post->the_post();
                $exclude_ids[] = get_the_ID();
                ?>
                <div class="featured-post mb-5 p-4 border rounded bg-light">
                    <h2 class="post-title">
                        <a class="text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="post-excerpt"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="read-more text-dark">Mehr lesen</a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

        <!-- Row -->
        <div class="row mb-5">
            <div class="col-12">
                <h1 class="category-title"><?php single_cat_title(); ?></h1>
                <div class="category-description">
                    <?php echo category_description(); ?>
                </div>
            </div>
        </div>

        <!-- Row for Posts -->
        <div class="row">
            <?php
            $other_posts = new WP_Query(array(
                'cat' => $current_cat_id,
                'posts_per_page' => -1,
                'post__not_in' => $exclude_ids
            ));

            if ($other_posts->have_posts()) :
                while ($other_posts->have_posts()) : $other_posts->the_post();
                    ?>
                    <div class="col-md-4 mb-5">
                        <div class="post-item">
                            <h2 class="post-title">
                                <a class="text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="read-more text-dark">Mehr lesen</a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Keine anderen Beiträge in dieser Kategorie gefunden.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>
