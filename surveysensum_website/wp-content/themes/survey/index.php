<?php
	get_header();?>
<!-- Header Section Start -->
<?php blogHeader(); ?>
<!-- Header Section End -->
<!-- Posts Section Start -->
<section class="posts">
	<div class="container">
		<div class="featured-post">
			<div class="row">
				<div class="col">
					<?php getFeaturePost(); ?>                    
				</div>
			</div>
		</div>
		<div class="latest-post">
			<div class="row">
				<div class="col-md-12">
				<!--<h2 class="latest-title">Latest</h2>-->
				<?php //getLatestPost(); ?>
                 <?php if (have_posts()) : ?>
                    <div class="post-row">
                        <div class="row" id="ajax-posts">
                            <?php  
                                $i=0;
                                $aj=0;
                                $postsPerPage = 9;
                                $wp_query = new WP_Query(array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 1,
                                    'post__in'  => get_option( 'sticky_posts' ),
                                    'ignore_sticky_posts' => 1
                                ));
                                while ($wp_query->have_posts()) : $wp_query->the_post();
                                    $exclude_featured = get_the_ID();
                                   // echo 'toploopsticky post id=>>'.$exclude_featured;
                                endwhile;
                                //echo 'exclude_featured=>>'.$exclude_featured;
                                $args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' =>$postsPerPage,'paged' => 1,'ignore_sticky_posts' => 1, 'post__not_in' => array($exclude_featured));
                                 $loop = new WP_Query( $args );
                               if($loop->have_posts()) {
                               while ( $loop->have_posts() ) : $loop->the_post();

                               $posts_id = get_the_ID(); ?>
                            <?php if($i<=2){ ?>
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
                            <?php } else { ?>
                            <?php if($aj==3) { $i=2; ?>

                            <div class="col-md-4 post">
                                <div class="subscribe post-list-subscribe">
                                    <h3>Subscribe to our Newsletter to get updated news about CX</h3>                	
                                    <?php #echo do_shortcode( '[gravityform id=8 title=false description=false ajax=true tabindex=49]' );  ?>

                                     <!--Zoho Campaigns Web-Optin Form's Header Code Starts Here-->
                                    <script type="text/javascript" src="https://tgqv.maillist-manage.in/js/optin.min.js" onload="setupSF('sf3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67','ZCFORMVIEW',false,'light',false,'0')"></script>
                                    <script type="text/javascript">
                                    function runOnFormSubmit_sf3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67(th){
                                        /*Before submit, if you want to trigger your event, "include your code here"*/
                                    };
                                    </script>

                                    <style>
                                    #customForm.quick_form_8_css * {
                                        -webkit-box-sizing: border-box !important;
                                        -moz-box-sizing: border-box !important;
                                        box-sizing: border-box !important;
                                        overflow-wrap: break-word
                                    }
                                    @media only screen and (max-width: 200px) {.quick_form_8_css[name="SIGNUP_BODY"] { width: 100% !important; min-width: 100% !important; margin: 0px auto !important; padding: 0px !important } }
                                    @media screen and (min-width: 320px) and (max-width: 580px) and (orientation: portrait) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 300px !important; margin: 0px auto !important; padding: 0px !important } }
                                    @media only screen and (max-device-width: 1024px) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 500px !important; margin: 0px auto !important } }
                                    @media only screen and (max-device-width: 1024px) and (orientation: landscape) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 700px !important; margin: 0px auto !important } }
                                    @media screen and (min-width: 475px) and (max-width: 980px) and (orientation: landscape) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 400px !important; margin: 0px auto !important; padding: 0px !important } }
                                    </style>

                                    <!--Zoho Campaigns Web-Optin Form's Header Code Ends Here--><!--Zoho Campaigns Web-Optin Form Starts Here-->

                                    <div id="sf3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67" data-type="signupform" style="opacity: 1;">
                                    <div id="customForm">
                                        <div class="quick_form_8_css blog-newsletter" name="SIGNUP_BODY">
                                        <div>
                                            <!-- <span class="zoho-form-title-newsletter" style="font-family: Arial; font-weight: bold; color: rgb(9, 30, 66); text-align: left; padding: 10px 10px 5px; width: 100%; display: block; font-size: 16px; border-style: none; border-width: 1px; border-color: rgb(0, 108, 251)" id="SIGNUP_HEADING">Subscribe to SurveySensum Experience Newsletter</span> -->
                                            <div style="position:relative;">
                                            <div id="Zc_SignupSuccess" style="display:none;position:absolute;margin-left:4%;width:90%;background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154);  margin-top: 10px;margin-bottom:10px;word-break:break-all">
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                    <td width="10%">
                                                        <img class="successicon" src="https://tgqv.maillist-manage.in/images/challangeiconenable.jpg" align="absmiddle">
                                                    </td>
                                                    <td>
                                                        <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px;word-break:break-word">&nbsp;&nbsp;Thank you for Signing Up</span>
                                                    </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                            </div>
                                            <form method="POST" id="zcampaignOptinForm" style="margin: 0px; width: 100%" action="https://maillist-manage.in/weboptin.zc" target="_zcSignup">
                                            <div class="zoho-newsletter-form" style="position: relative; margin: 0; display: inline-block; height: 46px; width: 100%;">
                                                <div id="Zc_SignupSuccess" style="position: absolute; width: 87%; background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154); margin-bottom: 10px; word-break: break-all; opacity: 1; display: none">
                                                <div style="width: 20px; padding: 5px; display: table-cell">
                                                    <img class="successicon" src="https://campaigns.zoho.com/images/challangeiconenable.jpg" style="width: 20px">
                                                </div>
                                                <div style="display: table-cell">
                                                    <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px; line-height: 30px; display: block"></span>
                                                </div>
                                                </div>
                                                <input type="text" style="border: 1px solid rgb(11, 95, 255);border-radius: 5px; width: 100%; height: 100%; z-index: 4; outline: none; padding: 5px 10px; color: rgb(0, 0, 0); text-align: left; font-family: Arial; background-color: rgb(255, 255, 255); box-sizing: border-box; font-size: 15px" placeholder="Enter email address*" changeitem="SIGNUP_FORM_FIELD" name="CONTACT_EMAIL" id="EMBED_FORM_EMAIL_LABEL">
                                            </div>
                                            <div class="zoho-newsletter-btn" style="position: relative; margin: 10px 0; text-align: left; display: inline-block; height: 46px; width: 100%;">
                                                <input type="button" style="text-align: center; border-radius: 5px; width: 100%; height: 100%; z-index: 5; border: 1px solid #ffa40c; color: rgb(255, 255, 255); cursor: pointer; outline: none; font-weight:700;font-size: 20px; background-color: #ffa40c; font-family: Arial" name="SIGNUP_SUBMIT_BUTTON" id="zcWebOptin" value="Subscribe">
                                            </div>
                                            <input type="hidden" id="fieldBorder" value="">
                                            <input type="hidden" id="submitType" name="submitType" value="optinCustomView">
                                            <input type="hidden" id="emailReportId" name="emailReportId" value="">
                                            <input type="hidden" id="formType" name="formType" value="QuickForm">
                                            <input type="hidden" name="zx" id="cmpZuid" value="1df85729cf">
                                            <input type="hidden" name="zcvers" value="2.0">
                                            <input type="hidden" name="oldListIds" id="allCheckedListIds" value="">
                                            <input type="hidden" id="mode" name="mode" value="OptinCreateView">
                                            <input type="hidden" id="zcld" name="zcld" value="171153763437531">
                                            <input type="hidden" id="zctd" name="zctd" value="">
                                            <input type="hidden" id="document_domain" value="">
                                            <input type="hidden" id="zc_Url" value="tgqv.maillist-manage.in">
                                            <input type="hidden" id="new_optin_response_in" value="0">
                                            <input type="hidden" id="duplicate_optin_response_in" value="0">
                                            <input type="hidden" name="zc_trackCode" id="zc_trackCode" value="ZCFORMVIEW">
                                            <input type="hidden" id="zc_formIx" name="zc_formIx" value="3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67">
                                            <input type="hidden" id="viewFrom" value="URL_ACTION">
                                            <span style="display: none" id="dt_CONTACT_EMAIL">1,true,6,Contact Email,2</span>
                                            <div style="color: #fff; margin: 0; border: 1px none rgb(255, 217, 211); opacity: 1; font-size: 12px; font-family: Arial; width: 202px; height: auto; display: none;font-weight:500;" id="errorMsgDiv">Email must be formatted correctly.
                                                <br>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                        <div style="display: none" id="unauthPageTitle">60001036812 - Form</div>
                                    </div>
                                    <img src="https://tgqv.maillist-manage.in/images/spacer.gif" id="refImage" onload="referenceSetter(this)" style="display:none;">
                                    </div>
                                    <input type="hidden" id="signupFormType" value="QuickForm_Horizontal">
                                    <div id="zcOptinOverLay" oncontextmenu="return false" style="display:none;text-align: center; background-color: rgb(0, 0, 0); opacity: 0.5; z-index: 100; position: fixed; width: 100%; top: 0px; left: 0px; height: 988px;"></div>
                                    <div id="zcOptinSuccessPopup" style="display:none;z-index: 9999;width: 800px; height: 40%;top: 84px;position: fixed; left: 26%;background-color: #FFFFFF;border-color: #E6E6E6; border-style: solid; border-width: 1px;  box-shadow: 0 1px 10px #424242;padding: 35px;">
                                    <span style="position: absolute;top: -16px;right:-14px;z-index:99999;cursor: pointer;" id="closeSuccess">
                                        <img src="https://tgqv.maillist-manage.in/images/videoclose.png">
                                    </span>
                                    <div id="zcOptinSuccessPanel"></div>
                                    </div>
                                    <!--Zoho Campaigns Web-Optin Form Ends Here-->
                                    
                                </div>
                            </div>
                            <div <?php post_class('col-md-8 col8 full-ppost') ?>>
                                <div class="post-single subscribe-post post-large">
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
                                            //echo 'exclude_featured=>>'.$exclude_featured;
                                            ?>
                                        <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
                                        <?php /*?><div class="content">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <p class="reading-time mb-0"><?php echo reading_time(); ?></p>
                                        <?php /*?><div class="social-share">
                                            <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                                        </div><?php */?>
                                        <a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
                                        </a>    
                                    </div>
                                </div>
                            </div>

                            <?php } else { ?>
                            <div <?php post_class('col-md-6 col6') ?>>
                                <div class="post-single post-large">
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
                                            //echo 'exclude_featured=>>'.$exclude_featured;
                                            ?>
                                        <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
                                        <?php /*?><div class="content">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <p class="reading-time mb-0"><?php echo reading_time(); ?></p>
                                        <?php /*?><div class="social-share">
                                            <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                                        </div><?php */?>
                                        <a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
                                        </a>    
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                            <?php $i++; $aj++; if($i==5){ $i=0;} endwhile;} ?>
                        </div>
                    </div>
                    <?php endif; ?>
				</div>
			</div>
			<div class="row text-center">
				<div class="col">					
                    <div id="load_more" class="loadmore">Load More</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Posts Section End -->
<!-- Bottom Subscribe Start -->
<?php bottomSubscribe(); ?>
<!-- Bottom Subscribe End -->

<script>
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
jQuery(function($) {
    jQuery('body').on('click', '#load_more.loadmore', function() {
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
        };
 
        $.post(ajaxurl, data, function(response) {
            if(response != '') {
                jQuery('#ajax-posts').append(response);
                page++;
            } else {
                jQuery('#load_more.loadmore').hide();
            }
        });
    });
});
</script>

<?php get_footer(); ?>