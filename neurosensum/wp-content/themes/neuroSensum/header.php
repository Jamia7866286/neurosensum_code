<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acodez_Themes
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maxium-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,600,700,700i,900" rel="stylesheet">
	<?php wp_head(); ?>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PV9D9JR');</script>
	<!-- End Google Tag Manager -->

</head>

<body <?php body_class(); ?>>


	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PV9D9JR"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	


	<header class="header_block" id="head_<?php echo get_the_ID();?>">

      	<!-- hello bar header -->
		<div class="download-report">
			<div class="container container-sm">
			<div class="sticky-header-menu">
			<h3>
				[FREE] Indonesian Consumer Trends 2021 Report
			</h3>
			<?php #echo get_template_directory_uri()?>
            <a
              href="https://neurosensum.com/indonesian-consumer-trends-2021/"
              class="btn report-btn"
              >Download Now</a
            >
			</div>
			</div>
		</div>

		<div class="header_container">
			<div class="row">
				<div class="col-md-2 col-xs-5">
					<?php if ( get_theme_mod( 'acodez-themes_logo' ) ) : ?>
						<div class='site-logo'>
							<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
								<img src='<?php echo esc_url( get_theme_mod( 'acodez-themes_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
							</a>
						</div>
					<?php else : ?>
						<div class='site-logo'>
							<h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
							<h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
						</div>
					<?php endif; 
					?>
				</div>
				<div class="col-md-8 col-xs-7 pull-right navigation_widget">
					<nav id="site-navigation" class="main-navigation">
						<a href="#" id="pull" class="nav-icon"><i class="fa fa-bars"></i></a> 
						<?php wp_nav_menu( array('container' => 'false', 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						
					</nav><!-- #site-navigation -->
					
				</div>
				
			</div>
		</div>

	</header>
	<?php 	if((is_front_page())){ ?>
	<?php 
	  	$banner_image = get_field('banner_image');
	  	$headerVideo=get_field('header_video');

	?>
	<?php if($headerVideo ||$banner_image ){ 
		$headerVideo=$headerVideo;
		$banner_image =$banner_image ;
	}else{
		$headerVideo=get_field('header_video','option');
		$banner_image=get_field('banner_image','option');
	}
		$banner_video=get_field('banner_video','option');

		?>
		

	<div id="block-video-bg"  data-vide-bg="mp4: <?php echo $headerVideo; ?>" data-vide-options="position: 0% 0%">
			<?php if (!$headerVideo) {?>
<div class="banner-image" style="background: url('<?php echo $banner_image; ?>'); "></div>
       
    <?php  } ?>


			<div class="overlay">
				<div class="container">
					<div class="center_block">
						<span class="triangle-bottomright"></span>
						<span class="triangle-bottomleft"></span>
					<?php if(get_field('header_video_subtitle','option')){ ?>	<h3><?php echo get_field('header_video_subtitle','option'); ?></h3> <?php } ?>
						<?php if(get_field('header_video_title','option')){ ?><h2><?php echo get_field('header_video_title','option'); ?></h2><?php } ?>
					<?php if ($headerVideo) { ?>
					<!-- <a class="video_popup" href="#">WATCH VIDEO <i class="fa fa-long-arrow-up"></i></a> -->
					<a class="popup-youtube" href="<?php echo get_field('banner_video','option'); ?>">WATCH Full VIDEO <svg id="play"  viewBox="0 0 163 163" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"="0px">
    
    <g fill="none">
        <g  transform="translate(2.000000, 2.000000)" stroke-width="4">
            <path d="M10,80 C10,118.107648 40.8923523,149 79,149 L79,149 C117.107648,149 148,118.107648 148,80 C148,41.8923523 117.107648,11 79,11" id="lineOne" stroke="#A5CB43"></path>
            <path d="M105.9,74.4158594 L67.2,44.2158594 C63.5,41.3158594 58,43.9158594 58,48.7158594 L58,109.015859 C58,113.715859 63.4,116.415859 67.2,113.515859 L105.9,83.3158594 C108.8,81.1158594 108.8,76.6158594 105.9,74.4158594 L105.9,74.4158594 Z" id="triangle" stroke="#A3CD3A"></path>
            <path d="M159,79.5 C159,35.5933624 123.406638,0 79.5,0 C35.5933624,0 0,35.5933624 0,79.5 C0,123.406638 35.5933624,159 79.5,159 L79.5,159" id="lineTwo" stroke="#A5CB43"></path>
        </g>
    </g>
</svg></a>
				<div class="contact-us-btn">
					<a href="javascript:void(0);" class="btn orange-btn download-popup">Contact Us</a>
				</div>
					<?php } ?>

					<!-- <span id="play" class="fa fa-play-circle-o"></span> -->
					
					</div>
				</div>
			</div>
		
		</div>

	<!-- <div id="popup" >
		<span class="button b-close"><i class="fa fa-times-circle"></i></span>
		<iframe src="<?php echo get_field('banner_video','option'); ?>"  allowfullscreen=""></iframe>
	</div> -->
	
	<?php } else if(is_page_template('template-contact.php')){
		?>
		<div  class="inner_page_banner"  >
			<div id="map"></div>
		</div>
	<?php } else{
		?>
		<!-- <div id="block-video-bg" class="inner_page_banner"  data-vide-bg="<?php //echo get_template_directory_uri(); ?>/video/vr-video" data-vide-options="position: 0% 0%"> -->
<?php if (is_home())   { 
	  	$banner_image = get_field('banner_image', 12);
		}
	  else if (is_singular( 'post' ))   { 
		  if(!empty(get_field('banner_image'))){
			$banner_image = get_field('banner_image');
		  }else{
			$banner_image=get_field('default_blog_banner_image','option');
		  }

	  }else{
		$banner_image = get_field('banner_image');
	  }
	  	$headerVideo=get_field('header_video');

	?>
	<?php if($headerVideo ||$banner_image ){ 
		$headerVideo=$headerVideo;
		$banner_image =$banner_image ;
	}else{
		$headerVideo=get_field('header_video','option');
		$banner_image=get_field('banner_image','option');
	}

		?>
		
	<div id="block-video-bg" class="inner_page_banner"  data-vide-bg="mp4: <?php echo $headerVideo; ?>" data-vide-options="position: 0% 0%">
			<?php if (!$headerVideo) {?>
<div class="banner-image" style="background: url('<?php echo $banner_image; ?>'); "></div>
       
    <?php  } ?>

			<div class="overlay">
				<div class="container">
					<div class="center_block ">
						
						<h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
							<span class="triangle-bottomright wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.6s"></span>
							<span class="triangle-bottomleft wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.8s"></span>
							<?php 
							if (is_home())   { 
									echo 'Blog';
								} else if(is_archive() ){
									// echo $title=get_the_archive_title();
									echo $title='Archive';
								}else if (is_search() ){
									echo $title='Search Results';
								} else if(is_404() ){
									echo $title='Page Not Found';
								} else if ( is_singular('casestudies'))   { 
									echo 'Case Studies';  
								} else if ( is_singular('career'))   { 
									echo 'Career';  
								} else {
								the_title();
							}


							 ?>
							 
						
						</h2>
						
					</div>
				</div>
			</div>
		</div>
	<?php

	} 

	 ?>
	
	
	

    <!-- Get Report Popup Start Ramadan Insights Download Reports Top Form -->
    <div class="get-report-popup">
      <!-- Inner Popup Box Start -->
      <div class="popup-box contact-us">
        <span class="cross"></span>
        <h2>Contact Us</h2>
        <div class="form-group">
			<!--[if lte IE 8]>
			<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
			<![endif]-->
			<!-- <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
				<script>
				hbspt.forms.create({
					portalId: "5773317",
					formId: "ed43514b-c8a3-40c9-9f24-56a801591b94"
				});
			</script> -->

			<script src='https://crm.zoho.in/crm/WebFormServeServlet?rid=352c55ec96cbdf7d84d2272bd0e516a34842b47deb3939f165d6e2ee7e05c666gid8c5a44735491abde9b3fadbeb4516583c356534e2bdc4d847ec7ffbccf95c3b6&script=$sYG'></script>
			
        </div>
      </div>
      <!-- Inner Popup Box End -->
    </div>
	<!-- Get Report Popup End -->
	
	<!-- <script src="./assets/bootstrap/js/jquery.js"></script> -->
    <!-- <script src="./assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="./assets/bootstrap/js/custom.js"></script> -->

    <script>
      jQuery(".popup-box .cross").click(function() {
        jQuery("body").addClass("hide-popup");
      });

      jQuery(".download-popup").click(function() {
        jQuery("body").removeClass("hide-popup");
        jQuery(".get-report-popup")
          .delay(100)
          .fadeIn(100);
      });
    </script>
