<?php
get_header();
add_action('wp_footer', 'scripts', 25);
function scripts() {
    ?>
 
    <?php } ?>  

    <div class="main-container  template_blog" id="post_<?php the_ID(); ?>">
        <div class="container clearfix">
             <div class="left-sec">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post clearfix" id="post-<?php the_ID(); ?>">
                <h5 class="post-title " data-aos="fade-up">
                    <?php the_title();?>
                </h5>

                 <?php if ( has_post_thumbnail() ) { 
                        echo '<figure class="thumbnail" data-aos="fade-up">';
                        the_post_thumbnail(); 
                        echo '</figure>';
                    }?>  
                
               <div data-aos="fade-right" data-aos-offset="300">
                <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
               </div>
               <!--  <div class="comments-section">
                    <?php //comments_template(); ?>
                </div> -->
            </div>
            <?php
            endwhile;
         endif; ?> 
         </div>
       <div class="side-bar">
           <?php if (is_active_sidebar('blog-sidebar')) { ?>
                <?php dynamic_sidebar('blog-sidebar'); ?>
            <?php } ?> 
       </div>
     </div>
    </div>
    <?php get_footer(); ?>