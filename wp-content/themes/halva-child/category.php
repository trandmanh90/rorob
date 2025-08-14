<?php
    get_header();
?>

<section class="category-section mt-5">
    <div class="container">
        <!-- Row -->
        <div class="row mb-5">
            <!-- Column for Category Title and Description -->
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
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    ?>
                    <!-- Post Item Column -->
                    <div class="col-md-4 mb-5">
                        <div class="post-item">
                            <h2 class="post-title">
                                <!-- Link to the Post -->
                                <a class="text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-excerpt"><?php the_excerpt(); ?></div>
                            <!-- Optionally, add a "Read More" link -->
                            <a href="<?php the_permalink(); ?>" class="read-more text-dark">Read More</a>
                        </div>
                    </div>
                    <?php
                endwhile;
            else :
                echo '<p>No posts found in this category.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
