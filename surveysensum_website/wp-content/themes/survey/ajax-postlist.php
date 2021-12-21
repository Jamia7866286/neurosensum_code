 <?php
	require_once('../../../wp-config.php');
	global $wpdb;

if( isset( $_POST['p'] ) )
{
	$page                   =   intval( $_POST['p'] );
    $current_page           =   $page - 1;
    $records_per_page       =   5; // records to show per page
    $start                  =   $current_page * $records_per_page;
	// echo $start;  exit;
	 
	$args = array('post_type' => 'post','post_status' => 'publish', 'offset' => $start, 'posts_per_page'=> $records_per_page); 
	
	$the_query = new WP_Query( $args );
	 
	
	if($the_query->have_posts()) {
 ?>
        <?php $i=0;
            $aj=0;
           while ($the_query->have_posts()) : $the_query->the_post();
           $posts_id = get_the_ID(); ?>
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
		
		<?php  endwhile; ?>
<?php } else {

	echo '0';
	
}
} 
?>