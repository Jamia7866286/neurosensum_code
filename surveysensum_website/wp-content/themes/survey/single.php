<?php
	get_header();?>
<!-- Header Section Start -->
<?php blogHeader(); ?>
<!-- Header Section End -->
<div class="default-page">
<!-- Post Detail Section Start -->
<section class="post-detail-section">
	<div class="post-top-detail">
        <div class="container">
            <div class="row">
                <div class="col">
                	<div class="post-tp">
                    	<h3 class="category">
                            <?php
                                $category = get_the_category();
                                echo '<a href="'.get_category_link($category[0]->cat_ID).'">' . $category[0]->cat_name . '</a>';
                                ?>
                        </h3>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <div class="date-time">
                            <figure class="author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></figure>
                            <div class="author-details">
                            <span><?php echo get_the_date('M j, Y') ?></span> <p class="reading-time mb-0"><?php echo reading_time(); ?></p>
                            <p class="name"><?php echo get_the_author(); ?></p>                           
                            </div>
                        </div>
                    </div>

                    <?php 
                        if (has_post_thumbnail()):?>
                            <figure class="featured-image">

                                <div class="soicalShareS">
                                    <div class="mid">
                                        <div class="social-share" id="social-share">
                                            <?php #echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_3hue"]') ?>
                                        </div>
                                    </div>
                                </div>

                                <?php  the_post_thumbnail(); ?>

                            </figure>
                    <?php endif; ?>

                     <!-- <?php 
                        #if (has_post_thumbnail()):?>
                    <figure class="featured-image">
                        <div class="soicalShareS">
                            <div class="mid">
                        <div class="social-share" id="social-share">
                        <?php #echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_3hue"]') ?>
                                </div></div>
                        </div>
                        <?php  #the_post_thumbnail(); ?>
                    </figure>
                    <?php #endif; ?> -->
                </div>
            </div>
        </div>
    </div>
    <div class="post-detail-container">
        <div class="container">
            <div class="row">
                <?php if(have_posts()) : the_post(); ?>
                <div class="col-md-12 d-flex  justify-content-between right-details">
                    <div class="content">                        
                        <?php the_content();?>
                    </div>
                    <div class="sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- Post Detail Section End -->

<!-- Was this page helpful section Start -->
<Section class="pageHelpfulSec">
  <div class="container">
     <div class="row">
        <div class="col-12">
        	<div class="col">
           		<h2>How much did you enjoy this article?</h2> 
           		<?php gravity_form(7, false, false, false, '', true, 12); ?>
           </div>
        </div>
     </div>
  </div>
</Section>
<!-- Was this page helpful section End-->
</div>

<!-- Bottom Subscribe Start -->
<?php bottomSubscribe(); ?>
<!-- Bottom Subscribe End -->
<!-- Related Contect Section Start -->
<?php  getRelatedContent(); ?>
<!-- Related Contect Section End -->
<style>
    .soicalShareS.ajfixed{
        z-index: 1;
    }
    .soicalShareS.ajfixed .mid{
        max-width: 1012px;
        margin: 0 auto;
    }
    .post-detail-section .soicalShareS.ajfixed .social-share{
        position: static;
    }
    .post-detail-container .container .row {
        position: relative;
        z-index: 2;
    }
</style>
<?php get_footer(); ?>
<script>
jQuery(function(){
    var window_astop = jQuery(window).scrollTop();
    var stickyHeaderTop = jQuery('.soicalShareS').offset().top + 70;
    var pageHelpfulSec_top = jQuery(".pageHelpfulSec").offset().top;
    var div_soicalShareSheight = jQuery(".soicalShareS").height();
    jQuery(window).scroll(function(){
            if( jQuery(window).scrollTop() > stickyHeaderTop ) {
                    jQuery('.soicalShareS').css({position: 'fixed', top: '62px', width:'100%', left:'0px'});
                    jQuery('.soicalShareS').addClass('ajfixed');
            } else {
                    jQuery('.soicalShareS').css({position: 'static'});
                    jQuery('.soicalShareS').removeClass('ajfixed'); 
            } 
        //
        /*if (window_astop + div_soicalShareSheight > pageHelpfulSec_top){
                    jQuery('.soicalShareS').css({position: 'static'});
                    jQuery('.soicalShareS').removeClass('ajfixed');   
        } else if (window_astop > stickyHeaderTop) {
            jQuery('.soicalShareS').css({position: 'fixed', top: '62px', width:'100%', left:'0px'});
                    jQuery('.soicalShareS').addClass('ajfixed');
        } else {
            jQuery('.soicalShareS').css({position: 'static'});
                    jQuery('.soicalShareS').removeClass('ajfixed');   
        } */
        });
        var pageHelpfulSecTop = jQuery('.pageHelpfulSec').offset().top - 10;
        jQuery(window).scroll(function(){
                if( jQuery(window).scrollTop() > pageHelpfulSecTop ) {
                        jQuery('.soicalShareS').css({position: 'static', top: '62px', width:'100%', left:'0px'});
                        jQuery('.soicalShareS').removeClass('ajfixed');
                } 
        });
    
  });
/*function sticky_relocate() {
    var window_astop = jQuery(window).scrollTop();
    var stickyHeaderTop = jQuery('.soicalShareS').offset().top + 70;
    var pageHelpfulSec_top = jQuery(".pageHelpfulSec").offset().top;
    var div_soicalShareSheight = jQuery(".soicalShareS").height();  
    if (window_astop + div_soicalShareSheight > pageHelpfulSec_top){
                    jQuery('.soicalShareS').css({position: 'static'});
                    jQuery('.soicalShareS').removeClass('ajfixed');   
        } else if (window_astop > stickyHeaderTop) {
            jQuery('.soicalShareS').css({position: 'fixed', top: '62px', width:'100%', left:'0px'});
                    jQuery('.soicalShareS').addClass('ajfixed');
        } else {
            jQuery('.soicalShareS').css({position: 'static'});
                jQuery('.soicalShareS').removeClass('ajfixed');   
        }
}
jQuery(function () {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});*/
</script>
