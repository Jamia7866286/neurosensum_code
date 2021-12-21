<?php 

	/*==============================================================

		Template Name: Ebook Thank You Page

	   ==============================================================*/
get_header(); 

?>

<div class="thank-you-page-main zoom-thank-you">
      <div class="surveysensum-logo">
        <a href="<?php echo site_url() ?>">
            <img src="<?php echo get_template_directory_uri()
 ?>/homepage_assets/img/svg/Surveysensum-logo.svg" class="img-fluid" alt="" />
        </a>
      </div>
      <div class="thank-you-page-inner">
        <div class="thank-you-image">
          <img src="<?php echo get_template_directory_uri()
 ?>/homepage_assets/img/svg/contact-us-thank-you.svg" class="img-fluid" alt="thank you image" />
        </div>
        <div class="thank-you-text">
          <span>Thank you for sharing your details!</span>
          <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/before-top-dot.svg" class="img-fluid" alt="thank you image">
        </div>
        <div class="box-main">
          <div class="box"></div>
        </div>
        <div class="cx-experts-text">
          Please check your mail for the ebook. See you there!
        </div>

        <div class="social-main">
          <div class="social-text">Know someone in your network who’d be interested in attending? Let them know!</div>
        </div>

        <div class="sign-up-free-home">
          <a class="btn btn-secondary-bg lg" target="_self" href="/">Visit Homepage</a>
        </div>
        
      </div>
      <div class="thank-you-page-footer"></div>
    </div>

<?php get_footer(); ?>
