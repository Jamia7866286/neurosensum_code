<?php function getRelatedContent(){ ?> 
<section class="related-content-section">
	<div class="container">
		<div class="related-content-inner">
			<div class="row">
				<div class="col">
					<h2 class="title">Blog to read</h2>
				</div>
			</div>
			<div class="row">
				<?php 
				
				$post_id = get_the_ID();
    $cat_ids = array();
	$categories = get_the_category( $post_id );
	$excluded_ids = get_option( 'sticky_posts' );
	$excluded_ids[] = $post_id;
	$query_args = array( 

        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post_not_in'    => array($post_id),
		'posts_per_page'  => 3,
		'post__not_in' => $excluded_ids


     );
				
				$the_query = new WP_Query( $query_args );
                   
                ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<div class="col-md-4">
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
								$category = get_the_category();
								
								echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="category">' . $category[0]->cat_name . '</a>';
								
								?>
							<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
							<?php /*?><div class="content">
								<?php the_excerpt(); ?>
							</div>
							<p class="reading-time mb-0"><?php echo reading_time(); ?></p>
							<div class="social-share">
                        		<?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                    		</div><?php */?>
							<a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
							</a>    
						</div>
					</div>
				</div>
				<?php 
					endwhile;
					
					wp_reset_postdata();
					
					?>
			</div>
		</div>
	</div>
</section>
<?php } ?>