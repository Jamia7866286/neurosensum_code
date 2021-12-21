<?php
/*
  Template Name: Career page
 */

get_header();
wp_enqueue_script('sumoselect');

add_action('wp_footer', 'san_scripts', 21);

function san_scripts() {
    ?>
    <script>
    	jQuery('select').SumoSelect();


    	jQuery('#department, #location').change(function(){

        var dep = jQuery('#department').val();
        var loc = jQuery('#location').val();

        //alert(dep +' '+ loc );

        jQuery.ajax({
            type: "GET",
            data: {dep: dep, loc:loc },
            url: "<?php echo admin_url(); ?>admin-ajax.php?action=list_career_cat",
            beforeSend: function () {
              jQuery(".result-outer #loading").show();
              jQuery(".pagination").hide();
            },
            success: function (data) {
              jQuery("#career-load").html('');
              jQuery("#career-load").html(data);
              jQuery(".result-outer #loading").hide();

            }
        });



      });


    </script>


<?php }
?>


<div class="container inner_page_container template_career" >
	<h2 data-aos="fade-right"  data-aos-offset="300">Join our <span>fantastic team</span></h2>
	<div class="search_widget "  >
		<form action="" method="" >

      <?php
      $argsD = [
          'taxonomy'     => 'department',
          'number'        => 0,
          'hide_empty'    => false
      ];
      $termsD = get_terms( $argsD);
      if(!empty($termsD)){
        ?>
  			<div class="col-md-6">
  				<div class=" controller">
  					<select id="department" class="form-control" >
  						<option value="">Department </option>
              <?php foreach ($termsD as $terD) { ?>
                <option class="level-0" value="<?php echo $terD->slug; ?>"><?php echo $terD->name; ?></option>
              <?php } ?>
  					</select>
  					<i class="fa fa-building fa-icon" aria-hidden="true"></i>
  				</div>
  			</div>
      <?php } ?>
			<!-- End department  -->
<?php
$argst = [
    'taxonomy'     => 'career-location',
    'number'        => 0,
    'hide_empty'    => false
];
$terms = get_terms( $argst);
if(!empty($terms)){
  ?>
			<div class="col-md-6">
				<div class=" controller">
					<select name="selected_location" id="location" class="form-control" >
						<option value="">Location</option>
            <?php foreach ($terms as $term) { ?>
  						<option class="level-0" value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
					</select>
					<i class="fa fa-map-marker" aria-hidden="true"></i>
				</div>
			</div>
    <?php } ?>
		</form>

	</div>

	<div class="listing_widget" id="video-load">

    <div class="result-outer">
      <div id="loading" style="display:none;">
        <img src="<?php echo get_template_directory_uri()?>/images/loader.gif" alt="" />
      </div>
    </div>

		<ul id="career-load">

			 <?php
       $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                  $labels2  = array(
                    'post_type'  => 'career',
                    'post_status'  => 'publish',
                    //'posts_per_page'  => '1',
                    'paged' => $paged
                  );
                 $query = new WP_Query( $labels2);
                 $count = $query->post_count;
				    if ($query->have_posts()) {
				      while ($query->have_posts()) { $query->the_post();
				        $fim = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
						$output= "<script>console.log( 'Debug Objects: " . $fim . "' );</script>";
						echo $output;
				        $thumb_pr = array( 'width' => 88, 'height' => 81 );
				        $logoimg = bfi_thumb( $fim, $thumb_pr );
						$output= "<script>console.log( 'Debug Objects: " . $logoimg . "' );</script>";
						echo $output;
				        $delay = 0.8;

				          ?>

			<li data-aos="fade-right"  data-aos-offset="<?php echo $delay; ?>s">
				<span class="com_logo">
					<img src="<?php echo $logoimg;?>" alt="logo">
				</span>
				<div class="content_widget">

					<h4><a href="<?php the_permalink(); ?>"> <?php the_title()?></a></h4>

					<ul class="location">
						<?php
                       $terms1 = get_the_terms( $post->ID , array( 'career-location') );
                        if($terms1 ){
                           foreach ( $terms1 as $term1 ) { ?>
                            <li><?php echo $term1->name; ?></li>
                        <?php }
                            }
                        ?>
					</ul>

					<p>
						<?php
							$content = get_the_content();
							if( strlen($content) <= 120 ){
			                    echo $content;
			                  } else {
			                    echo substr($content, 0,120).'...';
			                  }
						?>
					</p>


				</div>
				<h6 class="post_date">Posted <?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></h6>



			</li>
			  <?php
				}
        $delay++;
        ?>

        <?php
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

		</ul>



	</div>

<!-- <div class="result_sec">
<div class="container">
<div class="result-outer">
  <div id="loading" style="display:none;">
    <img src="<?php echo get_template_directory_uri()?>/images/loader.gif" alt="" />
  </div>
  <div id="video-out"></div>

</div>
</div>
  </div> -->


</div>










<?php get_footer(); ?>
