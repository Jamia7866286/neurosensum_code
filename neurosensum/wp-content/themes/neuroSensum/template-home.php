<?php
/*
  Template Name: Home page
 */

get_header();

wp_enqueue_script('cercle-canvas');
wp_enqueue_script('canvas');
wp_enqueue_script('swiper');
// wp_enqueue_script('paroller');


add_action('wp_footer', 'san_scripts', 21);

function san_scripts() {
    ?>
  <script>

   jQuery(window).load(myfunction);
  jQuery(window).on('resize',myfunction);

  function myfunction() {
      jQuery('.sec4_colm_outer .colm2 .cnt_widget p').css('height', 'auto');
      var arr = jQuery.makeArray()
    jQuery('.sec4_colm_outer .colm2 .cnt_widget p').each(function(){
      arr.push(jQuery(this).outerHeight());
  });
  jQuery('.sec4_colm_outer .colm2 .cnt_widget p').css('height', Math.max.apply( Math, arr ));
  console.log('highest height is '+Math.max.apply( Math, arr ));
  }

  var swiper = new Swiper('.swiper-1', {
      slidesPerView: 5,
      spaceBetween: 30,
      loop: true,
      // navigation: {
      //   nextEl: '.swiper-button-next',
      //   prevEl: '.swiper-button-prev',
      // },
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
       breakpoints: {
        1200: {
          slidesPerView: 5,
        },
        1024: {
          slidesPerView: 3,
        },
        767: {
          slidesPerView: 2,
        },
        640: {
          slidesPerView: 1,
        }
      }
    });


    var awardsTop = new Swiper('.achievement', {
        nextButton: '.swiper-button-next2',
        prevButton: '.swiper-button-prev2',
        spaceBetween: 10,
        speed:1000,
        loop:true,
        autoHeight:true,
        loopedSlides: 3, //looped slides should be the same
    });
    var awardsThumbs = new Swiper('.press-thumbs', {
        spaceBetween: 10,
        slidesPerView: 3,
        touchRatio: 0.2,
        loop:true,
        loopedSlides: 6, //looped slides should be the same
        slideToClickedSlide: true,
        breakpoints: {
            1000: {
                slidesPerView: 3
            },
            800: {
                slidesPerView: 3
            },
            600: {
                slidesPerView: 1
            }
        }
    });
    awardsTop.params.control = awardsThumbs;
    awardsThumbs.params.control = awardsTop;



  </script>

<?php }
?>
<!-- section 2 -->
<div class="home_page_section2 clearfix pointparallax">
	<canvas id="canvas"></canvas>
    <div class="left_image "   data-aos="fade-right"  data-aos-offset="500"   data-aos-duration="2500">
		<img src="<?php echo get_template_directory_uri(); ?>/images/01.png" alt="">
	</div>
	 <div class="right_line "  data-aos="fade-left"   data-aos-offset="300"  data-aos-easing="linear" data-aos-duration="1000">
		<img    src="<?php echo get_template_directory_uri(); ?>/images/line.png" alt="">
	</div>
	<div class="section2_container clearfix">
		<?php if(get_field('section1_heading')){ ?><h2 data-aos="fade-up"  data-aos-offset="400"  data-aos-duration="1000"><?php echo get_field('section1_heading') ?></h2><?php } ?>
		<?php $section1Lists=get_field('section1_list');
		$duration=700;
		if($section1Lists){ ?>
		<div class="colms_outer">
			<?php foreach($section1Lists as $section1List){ ?>
			<div class="col-md-3 commen "  data-aos="fade-up"  data-aos-offset="200"   data-aos-duration="<?php echo $duration;?>">
				<span class="cercle"></span>
				<?php if($section1List['title']){ ?><h3><?php echo $section1List['title'];?></h3><?php } ?>
				<?php if($section1List['content']){ ?><?php echo wpautop($section1List['content']);?><?php } ?>
			</div>
			<?php $duration=$duration+100; } ?>

		</div>
		<?php } ?>

	</div>

</div>

<!-- section 2 end -->
<!-- section 3 -->

<div class="home_page_section3 clearfix">
	<canvas id="canvas1"></canvas>
	<div class="block_row clearfix sec_3 ">
	<?php if(get_field('section_2_title')){ ?><h2 data-aos="fade-up"  data-aos-offset="200"  data-aos-duration="1000"><?php echo get_field('section_2_title') ?></h2><?php } ?>

		 <span class="left_line " data-aos="fade-right"  data-aos-offset="200"  data-aos-easing="linear" data-aos-duration="1000">
			<img src="<?php echo get_template_directory_uri(); ?>/images/redline.png" alt="">
		</span>
		<span class="right_line1 " data-aos="fade-left"  data-aos-offset="200"  data-aos-easing="linear" data-aos-duration="1000">
			<img src="<?php echo get_template_directory_uri(); ?>/images/redline.png" alt="">
		</span>
		<span class="right_line2 " data-aos="fade-left"  data-aos-offset="200"  data-aos-easing="linear" data-aos-duration="1500">
			<img src="<?php echo get_template_directory_uri(); ?>/images/redline.png" alt="">
		</span>

		<div class="block_outer clearfix">
			<div class="left_widget" data-aos="fade-right"  data-aos-offset="200"  data-aos-duration="1500">
				<img  src="<?php echo get_template_directory_uri(); ?>/images/02new.png" alt="">
				<img class="ripple" src="<?php echo get_template_directory_uri(); ?>/images/ripple.gif" alt="">
				<span class="triangle-topleft " data-aos="fade-left"  data-aos-offset="100"   data-aos-duration="1500"></span>
			</div>
			<?php if(get_field('section2_content')){ ?>
			<div class="col-md-6 pull-right who_content">
				<div class="content_widget" data-aos="fade-up"  data-aos-offset="200"  data-aos-duration="1000">
					<?php echo wpautop(get_field('section2_content')) ?>

				</div>
			</div>
			<?php } ?>
			<div class="right_widget" data-aos="fade-left"  data-aos-offset="200"  data-aos-duration="1500">
				<img  src="<?php echo get_template_directory_uri(); ?>/images/03.png" alt="">
			</div>





		</div>

	</div>

	<div class="block_row clearfix ">
		<div class="team_block clearfix ">
		<?php if(get_field('section3_heading')){ ?><h2 data-aos="fade-up"  data-aos-offset="200"   data-aos-duration="1000"><?php echo get_field('section3_heading') ?></h2><?php } ?>
			<span class="left_line " data-aos="fade-right"  data-aos-offset="200"  data-aos-easing="linear" data-aos-duration="1000">
				<img src="<?php echo get_template_directory_uri(); ?>/images/redline.png" alt="">
			</span>
			<span class="right_line1 " data-aos="fade-left"  data-aos-offset="200"  data-aos-easing="linear" data-aos-duration="1000">
				<img src="<?php echo get_template_directory_uri(); ?>/images/redline.png" alt="">
			</span>

			<?php
			    $neuro_pic_up = get_field('neuro_pic_up');
			    $neuro_pic_down = get_field('neuro_pic_down');
			?>

			 <div class="container">
				<div class="col-md-6 vr_image">
					<?php if ('$neuro_pic_down') {?>
					<img data-aos="fade-right"  data-aos-offset="200"   data-aos-duration="5000" src="<?php echo $neuro_pic_down; ?>" alt="">
					<?php  } ?>
					<div class="overlay_widget " data-aos="fade-left"  data-aos-offset="200"  data-aos-duration="1200">
						<!-- <img src="<?php //echo get_template_directory_uri(); ?>/images/vr.jpg" alt=""> -->
						<?php if ('$neuro_pic_up') {?>
					         <img src="<?php echo $neuro_pic_up; ?>" >
					    <?php  } ?>
						<h4>
							Neuro
							<span class="arrow1"></span>
							<span class="arrow2"></span>
						</h4>

					</div>
				</div>
				<?php $section3Lists=get_field('section_3_list');
		$duration=1000;
		$i=1;
		if($section3Lists){ ?>
				<div class="col-md-6 ">
					<?php foreach($section3Lists as $section3List){ ?>
					<div class="team_content_widget <?php if($i==1){ echo 'in_top'; } ?> " data-aos="fade-left"  data-aos-offset="200" data-aos-duration="<?php echo $duration;?>">
						<?php if($section3List['title']){ ?><h3><?php echo $section3List['title'];?></h3><?php } ?>
				<?php if($section3List['content']){ ?><?php echo wpautop($section3List['content']);?><?php } ?>




					</div>
					<?php $i++;} ?>


				</div>
				<?php
				$duration=$duration+200;  ?>
				<?php } ?>
			</div>



		</div>
	</div>

</div>

<!-- section 3 end -->
<!-- section 4 -->
<div class="home_page_section4 clearfix">
	<div class="block_row clearfix">
	<?php if(get_field('section_4_title')){ ?>	<h2 data-aos="fade-up"  data-aos-offset="200"   data-aos-duration="1000"><?php echo get_field('section_4_title') ?></h2><?php } ?>
		<span class="left_line " data-aos="fade-right"  data-aos-offset="200"  data-aos-easing="linear" data-aos-duration="1000">
			<img src="<?php echo get_template_directory_uri(); ?>/images/redline.png" alt="">
		</span>
		<span class="right_line1 " data-aos="fade-left"  data-aos-offset="200"  data-aos-easing="linear" data-aos-duration="1000">
			<img src="<?php echo get_template_directory_uri(); ?>/images/redline.png" alt="">
		</span>
			<?php if(get_field('section_4_content')){ ?>	<h4 data-aos="fade-up"  data-aos-offset="200"   data-aos-duration="1200"><?php echo get_field('section_4_content') ?></h4><?php } ?>
			<?php //$section4Lists=get_field('section_4_list');


			  $labels  = array(
            'post_type'  => 'service',
            'post_status'  => 'publish',
            'posts_per_page'  => '-1',
            'order_by' => 'date',
            'order'=>'ASC'
          );
         $query = new WP_Query( $labels);
		$duration=1000;

		  if ($query->have_posts()) {  ?>
		<div class="sec4_colm_outer">

			<div class="swiper-1 swiper-container">
			    <div class="swiper-wrapper">

			      	<?php //foreach($section4Lists as $section4List){


      while ($query->have_posts()) { $query->the_post();
			$content=get_the_excerpt();
      	if( strlen($content) < 100 ){
	                $content = $content;
	              } else {
	                $content = substr($content, 0,100).'...';
	            }?>
	             <div class="swiper-slide">
			<div class="colm2 " data-aos="fade-up"  data-aos-offset="200"   data-aos-duration="1000">
				<?php if(get_field('icon')){ ?>
				<div class="srv_icon_widget">
					<span class="spring1 shake"></span>
					<span class="spring2 shake1"></span>
					<span class="spring3 shake2"></span>
					<img src="<?php echo get_field('icon'); ?>" alt="">

				</div>
				<?php } ?>
				<div class="cnt_widget">
					<?php if(get_the_title()){ ?>	<a href="<?php the_permalink(); ?>"><h3><?php echo get_the_title();?></h3></a><?php } ?>
					<?php {
						$count=get_field('homepage_content');
				      	if( strlen($count) < 100 ){
					                $count = $count;
					              } else {
					               $count = substr($count, 0,100).'...';
	            		}?>
			<?php }?>
				<?php if($count){ ?><?php echo $count ;?><?php } ?>
				</div>
			</div>
			      </div>
			<?php $duration=$duration+100; } ?>
			    </div>
			    <!-- Add nav -->
			    <div class="swiper-button-prev fa fa-angle-left"></div>
			    <div class="swiper-button-next fa fa-angle-right"></div>
			</div>



		</div>
		<?php }
		  the_posts_navigation();

    wp_reset_query(); ?>

	</div>
</div>





<?php
$tsec = '';
if(get_field('press_sec_title')){
  $tsec = get_field('press_sec_title');
}
?>
<?php
$types = get_terms('media', array('hide_empty' => 1, ));
if($types){

  $tit_str = '';
  $cnt_str = '';
  foreach($types as $typ){
    $slug = $typ->slug;
    $tit_str .= '<div class="swiper-slide"><h4>'.$typ->name.'</h4></div>';

    $cnt_str .= '<div class="swiper-slide">';
    $pargs = array(
    	'post_type' => 'press',
    	'posts_per_page'  => '-1',
    	'tax_query' => array(
    		array(
    			'taxonomy' => 'media',
    			'field'    => 'slug',
    			'terms'    => $slug,
    		),
    	),
    );
    $pquery = new WP_Query( $pargs );
    if ($pquery->have_posts()) {
      while ($pquery->have_posts()) : $pquery->the_post();

      $cnt_str .= '<div class="box">';
      if(get_field('press_link')){
      	$cnt_str .= '<a href="'.get_field('press_link').'" target="_blank">';
      } else {
      	$cnt_str .= '<a href="'.get_the_permalink().'" target="_blank">';
      }	
      if(get_field('press_logo')){
        $cnt_str .= '<img src="'.get_field('press_logo').'" alt="image" />';
      }
      $cnt_str .= '<div class="title"><h4>'.get_the_title().'</h4></div>';
      $cnt_str .= '</a>';
      $cnt_str .= '</div>';

      endwhile;
    }
    $cnt_str .= '</div>';

  }
?>


<div class="Neurosensum-press">
  <div class="container">
    <div class="titlesec">
      <?php if($tsec){ ?>
        <h2><?php echo $tsec; ?></h2>
      <?php } ?>
    </div>
    <div class="thumb-outer">
      <div class="swiper-container press-thumbs">
        <div class="swiper-wrapper">
          <?php echo $tit_str; ?>
        </div>
      </div>
      <div class="swiper-button-prev2 fa fa-angle-left"></div>
      <div class="swiper-button-next2 fa fa-angle-right"></div>
    </div>
    <div class="swiper-container achievement">
    	<div class="swiper-wrapper">
        <?php echo $cnt_str; ?>
    	</div>
    </div>
  </div>
</div>
<?php
}
wp_reset_query();
?>


<?php /* ?>
<div class="Neurosensum-press">
  <div class="container">
    <div class="titlesec">
      <?php if(get_field('press_sec_title')){ ?>
        <h2><?php echo get_field('press_sec_title') ?></h2>
      <?php } ?>
    </div>
    <div class="thumb-outer">
      <div class="swiper-container press-thumbs">
        <div class="swiper-wrapper">

          <div class="swiper-slide"><h4>ONLINE MEDIA</h4></div>
          <div class="swiper-slide"><h4>PRINT MEDIA</h4></div>
          <div class="swiper-slide"><h4>TVC/TV FEATURE</h4></div>

        </div>
      </div>
      <div class="swiper-button-prev2 fa fa-angle-left"></div>
      <div class="swiper-button-next2 fa fa-angle-right"></div>
    </div>

<div class="swiper-container achievement">
	<div class="swiper-wrapper">

		<div class="swiper-slide">

		    <div class="box">
		        <a href="#">
		        <img src="<?php echo get_template_directory_uri(); ?>/images/press/forbes.jpg" alt="image" />
                 <div class="title"><h4>Forbes Indonesia</h4></div>
                </a>
		     </div>

		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/techasia.jpg" alt="image" />
                 <div class="title"><h4>Tech In Asia</h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/DealStreetAsia.jpg" alt="image" />
                 <div class="title"><h4>Deal Street Asia</h4></div>
             </a>
		     </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/Liputan6.jpg" alt="image" />
                 <div class="title"><h4>Liputan6.com</h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/swa.jpg" alt="image" />
                <div class="title"><h4>SWA Media Inc </h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/nvestorDaily.jpg" alt="image" />
                <div class="title"><h4>Investor Daily</h4></div>
              </a>
		    </div>



		    <div class="box">
		        <a href="#">
		        <img src="<?php echo get_template_directory_uri(); ?>/images/press/forbes.jpg" alt="image" />
                 <div class="title"><h4>Forbes Indonesia</h4></div>
                </a>
		     </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/techasia.jpg" alt="image" />
                 <div class="title"><h4>Tech In Asia</h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/DealStreetAsia.jpg" alt="image" />
                 <div class="title"><h4>Deal Street Asia</h4></div>
             </a>
		     </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/Liputan6.jpg" alt="image" />
                 <div class="title"><h4>Liputan6.com</h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/swa.jpg" alt="image" />
                <div class="title"><h4>SWA Media Inc </h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/nvestorDaily.jpg" alt="image" />
                <div class="title"><h4>Investor Daily</h4></div>
              </a>
		    </div>
		</div>


		<div class="swiper-slide">
		    <div class="box">
		        <a href="#">
		        <img src="<?php echo get_template_directory_uri(); ?>/images/press/forbes.jpg" alt="image" />
                 <div class="title"><h4>Forbes Indonesia</h4></div>
                </a>
		     </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/techasia.jpg" alt="image" />
                 <div class="title"><h4>Tech In Asia</h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/DealStreetAsia.jpg" alt="image" />
                 <div class="title"><h4>Deal Street Asia</h4></div>
             </a>
		     </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/Liputan6.jpg" alt="image" />
                 <div class="title"><h4>Liputan6.com</h4></div>
             </a>
		    </div>
		</div>

		<div class="swiper-slide">
		    <div class="box">
		        <a href="#">
		        <img src="<?php echo get_template_directory_uri(); ?>/images/press/forbes.jpg" alt="image" />
                 <div class="title"><h4>Forbes Indonesia</h4></div>
                </a>
		     </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/techasia.jpg" alt="image" />
                 <div class="title"><h4>Tech In Asia</h4></div>
             </a>
		    </div>
		    <div class="box">
		    <a href="#">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/press/DealStreetAsia.jpg" alt="image" />
                 <div class="title"><h4>Deal Street Asia</h4></div>
             </a>
		     </div>
		</div>




	</div>
</div>


</div>
</div>
<?php */ ?>




<?php get_footer(); ?>
