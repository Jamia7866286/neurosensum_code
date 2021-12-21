<?php
get_header();
add_action('wp_footer', 'scripts', 25);
function scripts() {
    ?>

    <?php } ?>  

    <div class="main-container " id="post_<?php the_ID(); ?>">
        <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post clearfix" id="post-<?php the_ID(); ?>">
                 <div data-aos="fade-right" data-aos-offset="300">
                    <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
                </div>
            </div>
            <?php
            endwhile;
            endif; ?> 
        </div>
        </div>
        <?php get_footer(); ?>