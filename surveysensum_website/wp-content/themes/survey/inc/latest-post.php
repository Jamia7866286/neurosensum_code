<?php function getLatestPost(){ ?> 
<?php if (have_posts()) : ?>
<div class="post-row">
	<div class="row" id="ajax-posts">
		<?php  
            $i=0;
            $aj=0;
            $postsPerPage = 20;
            $wp_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'post__in'  => get_option( 'sticky_posts' ),
                'ignore_sticky_posts' => 1
            ));
            while ($wp_query->have_posts()) : $wp_query->the_post();
                $exclude_featured = get_the_ID();
               // echo 'toploopsticky post id=>>'.$exclude_featured;
            endwhile;
            //echo 'exclude_featured=>>'.$exclude_featured;
            $args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' =>$postsPerPage,'ignore_sticky_posts' => 1, 'post__not_in' => array($exclude_featured));
             $loop = new WP_Query( $args );
           if($loop->have_posts()) {
           while ( $loop->have_posts() ) : $loop->the_post();
                               
           $posts_id = get_the_ID(); ?>
		<?php if($i<=2){ ?>
		<div <?php post_class('col-md-4 col3') ?>>
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
        <?php if($aj==3) { $i=2; ?>
        
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
					<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), 11, '...' ); ?></a>  </h2>
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
					<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), 11, '...' ); ?></a>  </h2>
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
		<?php } ?>
		<?php $i++; $aj++; if($i==5){ $i=0;} endwhile;} ?>
	</div>
</div>
<?php endif; ?>
<?php } ?>