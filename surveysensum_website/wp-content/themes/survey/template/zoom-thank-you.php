<?php 

	/*==============================================================

		Template Name: Zoom Thank You

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
          <span>Thank you for registering!</span>
          <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/before-top-dot.svg" class="img-fluid" alt="thank you image">
        </div>
        <div class="box-main">
          <div class="box"></div>
        </div>
        <div class="cx-experts-text">
          You’ll be receiving an email with the joining details soon. See you there!
        </div>

        <div class="social-main">
          <div class="social-text">Know someone in your network who’d be interested in attending? Let them know!</div>

          <div class="social-icons d-flex">
            <div class="sosial-inner-items">

              <a id="fb_share" href="" class="icon-img">
                <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/Facebook.svg" class="img-fluid" alt="">
              </a>

              <a id="twitter_share" href="" class="icon-img">
                <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/Twitter.svg" class="img-fluid" alt="">
              </a>

              <a id="linkedin_share" href="" class="icon-img">
                <!-- href="https://www.linkedin.com/shareArticle?mini=true&url=https://site-staging.cl3sxcka-liquidwebsites.com/ltd/ltd.html" -->
                <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/LinkedIN.svg" class="img-fluid" alt="">
              </a>

            </div>
          </div>

        </div>
        
      </div>
      <div class="thank-you-page-footer"></div>
    </div>

<?php get_footer(); ?>

<script>
  jQuery(document).ready(function( $ ) {
    var fb_link = localStorage.getItem("facebook_Link");
    var twitter_link = localStorage.getItem("twitter_Link");
    var linkdin_link = localStorage.getItem("linkdin_Link");
    $('#fb_share').attr("href","https://www.facebook.com/sharer.php?u="+fb_link);
    $('#twitter_share').attr("href","https://twitter.com/intent/tweet?url="+twitter_link);
    $('#linkedin_share').attr("href","https://www.linkedin.com/shareArticle?mini=true&url="+linkdin_link);
  });
</script>