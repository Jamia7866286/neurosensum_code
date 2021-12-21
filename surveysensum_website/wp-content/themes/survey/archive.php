<?php
	get_header();?>
<!-- Header Section Start -->
<?php blogHeader(); ?>
<!-- Header Section End -->
<!-- Posts Section Start -->
<section class="posts">
	<div class="container">
        <?php if (have_posts()) : ?>    
            <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
            <?php /* If this is a category archive */ if (is_category()) { ?>
           <!-- <h2 class="pagetitle">Archive for the &#8216;<?php //single_cat_title(); ?>&#8217; Category</h2>-->
            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            <!-- <h2 class="pagetitle">Posts Tagged &#8216;<?php //single_tag_title(); ?>&#8217;</h2>-->
            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            <!-- <h2 class="pagetitle">Archive for <?php //the_time('F jS, Y'); ?></h2>-->
            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            <!--  <h2 class="pagetitle">Archive for <?php //the_time('F, Y'); ?></h2>-->
            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
           <!-- <h2 class="pagetitle">Archive for <?php //the_time('Y'); ?></h2>-->
            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
           <!--  <h2 class="pagetitle">Author Archive</h2>-->
            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
           <!--  <h2 class="pagetitle">Blog Archives</h2> -->
            <?php } ?>
        
        
        <?php  $i=0;
               $aj=0; 
               $ak=1; ?>
        
        
        
        <?php
             while (have_posts()) : the_post(); ?>
            <?php if($ak==2) { ?>
            <div class="latest-post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="post-row">
                            <div class="row">
              <?php } ?>
                <?php if($ak==1) { ?>   
            <div class="featured-post">
			<div class="row">
				<div class="col">
             <div <?php post_class('post-single') ?> >
                <?php 
                    if (has_post_thumbnail()):?>
                <figure>
                    <a href="<?php the_permalink() ?>">
                    <?php  the_post_thumbnail(); ?>
                    </a>
                </figure>
                <?php endif; ?>
                    <div class="details">
                        <?php
                        $category = get_the_category($post_id);
                        echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="category">' . $category[0]->cat_name . '</a>'; 
                       //echo 'postid=>>'.$post_id;
                        ?>
                        <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
                        <?php /*?><div class="content">
                            <?php the_excerpt(); ?>
                        </div><?php */?>
                        <div class="date-time">
                            <figure class="author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></figure>
                            <div class="author-details">
                            <span><?php echo get_the_date('M j, Y') ?></span> <p class="reading-time mb-0"><?php echo reading_time(); ?></p>
                            <p class="name"><?php echo get_the_author(); ?></p>                           
                            </div>
                        </div>
                        <?php /*?><div class="social-share">
                            <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                        </div><?php */?>
                        <a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" /></a> 
                    </div>
            </div>
            <?php if($ak==1) { ?>
                      </div>
                  </div>
              </div>          
                <?php } ?>
             
            <?php } else { ?>
            <?php if($i<=3){ ?>
                <div <?php  post_class('col-md-4 col3')  ?>>
                    <div class="post-single post-small">
                        <?php 
                            if (has_post_thumbnail()):?>
                        <figure>
                            <a href="<?php the_permalink() ?>">
                            <?php  the_post_thumbnail(); ?>
                            </a>
                        </figure>
                        <?php endif; ?>
                        <div class="post-content">
                            <?php
                                $category = get_the_category($posts_id);
                                echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="category">' . $category[0]->cat_name . '</a>';
                                //echo 'postid=>>'.$posts_id;
                                ?>
                            <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
                            <?php /*?><div class="content">
                                <?php the_excerpt(); ?>
                            </div>
                            <p class="reading-time"><?php echo reading_time(); ?></p>
                            <?php /*?><div class="social-share">
                                <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                            </div><?php */?>
                            <a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
                            </a>    
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <?php if($aj==4) { $i=3; ?>

                <div class="col-md-4 post">
                    <div class="subscribe">
                        <h3>Subscribe to our Newsletter to get updated news about CX</h3>                	
                        <?php echo do_shortcode( '[gravityform id=8 title=false description=false ajax=true tabindex=49]' );  ?>
                    </div>
                </div>
                <div <?php post_class('col-md-8 col8 full-ppost') ?>>
                    <div class="post-single subscribe-post post-large">
                         <?php 
                            if (has_post_thumbnail()):?>
                        <figure>
                            <a href="<?php the_permalink() ?>">
                            <?php  the_post_thumbnail(); ?>
                            </a>
                        </figure>
                        <?php endif; ?>
                        <div class="post-content">
                            <?php
                                $category = get_the_category($posts_id);
                                echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="category">' . $category[0]->cat_name . '</a>';
                                //echo 'postid=>>'.$posts_id;
                                //echo 'exclude_featured=>>'.$exclude_featured;
                                ?>
                            <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
                            <?php /*?><div class="content">
                                <?php the_excerpt(); ?>
                            </div>
                            <p class="reading-time mb-0"><?php echo reading_time(); ?></p>
                            <?php /*?><div class="social-share">
                                <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                            </div><?php */?>
                            <a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
                            </a>    
                        </div>
                    </div>
                </div>

                <?php } else { ?>
                <div <?php post_class('col-md-6 col6') ?>>
                    <div class="post-single post-large">
                        <?php 
                            if (has_post_thumbnail()):?>
                        <figure>
                            <a href="<?php the_permalink() ?>">
                            <?php  the_post_thumbnail(); ?>
                            </a>
                        </figure>
                        <?php endif; ?>
                        <div class="post-content">
                            <?php
                                $category = get_the_category($posts_id);
                                echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="category">' . $category[0]->cat_name . '</a>';
                                //echo 'postid=>>'.$posts_id;
                                //echo 'exclude_featured=>>'.$exclude_featured;
                                ?>
                            <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
                            <?php /*?><div class="content">
                                <?php the_excerpt(); ?>
                            </div>
                            <p class="reading-time mb-0"><?php echo reading_time(); ?></p>
                            <?php /*?><div class="social-share">
                                <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                            </div><?php */?>
                            <a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
                            </a>    
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php } } ?>
                
        <?php $i++; $aj++; $ak++; if($i==6){ $i=0;} endwhile; ?>  
                
              </div>
            </div>
              </div>
              </div>
          </div>
        
        <?php else :  ?>
         <div class="try_diffferentSec">
    <?php    if ( is_category() ) { // If this is a category archive
            printf("<h2 class='center nopost'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
        } else if ( is_date() ) { // If this is a date archive
            echo("<h2 class='nopost'>Sorry, but there aren't any posts with this date.</h2>");
        } else if ( is_author() ) { // If this is a category archive
            $userdata = get_userdatabylogin(get_query_var('author_name'));
            printf("<h2 class='center nopost'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
        } else {
            echo("<h2 class='center nopost'>No posts found.</h2>");
        }
        //get_search_form(); ?>
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_option('home'); ?>" _lpchecked="1">
            <div>
                <!--<label class="screen-reader-text" for="s">Search for:</label> -->
              <div class="inputgroup">
                <input type="text" name="s" value="<?php the_search_query(); ?>" id="s" placeholder="Search..."/>
                <input class="btn btn-orange" type="submit" id="searchsubmit" value="Search">
              </div>
            </div>
            <input type="hidden" name="post_type" value="post">
       </form>
        </div>
       <?php endif;
        ?>
		
	</div> 
</section>
<!-- Posts Section End -->
<!-- Bottom Subscribe Start -->
<?php bottomSubscribe(); ?>
<!-- Bottom Subscribe End -->
<?php get_footer();