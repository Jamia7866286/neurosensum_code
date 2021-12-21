<?php
/*
  Template Name: Case Studies page
 */

get_header();


add_action('wp_footer', 'san_scripts', 21);

function san_scripts() {
    ?>

 <script>
      jQuery(window).load(myfunction);
          jQuery(window).on('resize',myfunction);

          function myfunction() {
              jQuery('.col-md-4.cs-col').css('height', 'auto');
              var arr = jQuery.makeArray()
            jQuery('.col-md-4.cs-col').each(function(){
              arr.push(jQuery(this).outerHeight());
          });
          jQuery('.col-md-4.cs-col').css('height', Math.max.apply( Math, arr ));
          console.log('highest height is '+Math.max.apply( Math, arr ));
          }
   </script>

<?php }
?>


<div class="container inner_page_container case-studies-page" >
	<div class="case-study-content">
		<div class="row">
       <?php
       $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
          $labels1  = array(
            'post_type'  => 'case studies',
            'post_status'  => 'publish',
            'posts_per_page'  => '3',
            'paged' => $paged
          );
         $query = new WP_Query( $labels1);

    if ($query->have_posts()) {
      while ($query->have_posts()) { $query->the_post();
        $fim = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
        $thumb_pr = array( 'width' => 662, 'height' => 312 );
        $mediaimg = bfi_thumb( $fim, $thumb_pr );
        $delay = 0.8;

          ?>

			<div class="col-md-4 cs-col"  data-aos="fade-up"   data-aos-offset="<?php echo $delay; ?>s">
        <div class="cs-image">
            <img src="<?php echo $mediaimg; ?>" alt="">
          </div>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">


					 <?php if(get_the_title()) {
	              $exrpt = get_the_title();
	              if( strlen($exrpt) <= 62 ){
	                $reS = $exrpt;
	              } else {
	                $reS = substr($exrpt, 0,62).'...';
	            }
	              ?><p><?php echo $reS ?></p><?php }?>

          </a>
					<a href="<?php the_permalink(); ?>" class="btn">Read More</a>

			</div>



	<?php
  $delay++;

      }

      ?>
      <div class="pagination" style="clear:both;overflow: hidden;" >
          <div class="nav-previous">
            <?php
              next_posts_link( 'Older Entries', $query->max_num_pages );
            ?>
          </div>
            <div class="nav-next">
            <?php
              previous_posts_link( 'Newer Entries' );
              ?>
            </div>
      </div>
      <?php
    }

    wp_reset_query();

    ?>
		</div>
	</div>




</div>










<?php get_footer(); ?>
