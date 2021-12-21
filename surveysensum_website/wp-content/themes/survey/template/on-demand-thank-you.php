<?php 

	/*==============================================================

		Template Name: On Demand Thank You

	   ==============================================================*/
get_header(); 

?>

<div class="thank-you-page-main zoom-thank-you on-demand-thank-you">
      <div class="surveysensum-logo">
        <a href="<?php echo site_url() ?>">
            <img src="<?php echo get_template_directory_uri()
 ?>/homepage_assets/img/svg/Surveysensum-logo.svg" class="img-fluid" alt="" />
        </a>
      </div>
      <div class="thank-you-page-inner">
      
        <div class="on-demand-video">
        <iframe id="zoom-us-iframe" frameborder="0" allowfullscreen allow="microphone; camera;"></iframe>
        </div>  

        <div class="social-main">
          <div class="social-text">We've emailed you the recording link, so you can watch this again anytime!</div>

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
    var video_url = localStorage.getItem("video_url");
    $('#fb_share').attr("href","https://www.facebook.com/sharer.php?u="+fb_link);
    $('#twitter_share').attr("href","https://twitter.com/intent/tweet?url="+twitter_link);
    $('#linkedin_share').attr("href","https://www.linkedin.com/shareArticle?mini=true&url="+linkdin_link);
    $('#zoom-us-iframe').attr("src", video_url);
  });
</script>