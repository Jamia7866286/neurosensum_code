<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acodez_Themes
 */

get_header(); ?>

<!-- Blog -->
   <div class="main-container  template_blog ">
    <div class="container clearfix">
        <div class="left-sec">
                <?php
                $delay = 0.8;
               
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post(); ?>
                <div class="post-list col-md-6 " data-aos="fade-up" data-aos-duration="<?php echo $delay?>s">
                	 <?php if ( has_post_thumbnail() ) { 
                        echo '<figure class="thumbnail">';
                        the_post_thumbnail(); 
                        echo '</figure>';
                    }?>  
                     <div class="post-date">
                        <span><?php echo get_the_date('l', $post->ID); ?></span>
                        <?php echo get_the_date('j, F, Y', $post->ID); ?>
                    </div> 
                        <?php
                           $tit_str = get_the_title(); ?>
                    <h5 class="post-title">
                        <a href="<?php echo get_permalink();?>" title="<?php echo $tit_str;?>">
                          <?php
			                  if( strlen($tit_str) <= 70 ){
			                    echo $tit_str;
			                  } else {
			                    echo substr($tit_str, 0,70).'...';
			                  }
			                  ?>
                        		
                    	</a>
                    </h5>
                     
                       
                    <a class="rd_more" href="<?php the_permalink(); ?>">Read more</a>
                </div>
            <?php endwhile;
                $delay++;
				?>
				<div class="pagination" style="clear:both;" >
				<?php
					the_posts_navigation();
				?>
				</div>
				<?php
            else : ?>
            <p>
                <?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'smpl' ); ?>          
            </p>
            <?php get_search_form(); 
            endif; ?>
       </div>
       <div class="side-bar">
           <?php if (is_active_sidebar('blog-sidebar')) { ?>
                <?php dynamic_sidebar('blog-sidebar'); ?>
            <?php } ?> 
       </div>
   </div>
</div>
<!-- end Blog -->



<?php 
get_footer();