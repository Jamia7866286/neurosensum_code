<?php function getFeaturePost(){ ?>              
<?php
    $wp_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'post__in'  => get_option( 'sticky_posts' ),
                'ignore_sticky_posts' => 1
            ));
            while ($wp_query->have_posts()) : $wp_query->the_post();
                $exclude_featured = get_the_ID();
    
    
    
    $post_id = get_the_ID(); ?>
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
<?php endwhile; ?>
<?php wp_reset_query(); ?>
<?php } ?>