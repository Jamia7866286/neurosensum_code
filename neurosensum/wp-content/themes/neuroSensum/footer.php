<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acodez_Themes
 */

?>

<footer id="colophon" class="site-footer" >
	<div class="container">
        <div class="col-md-4 ftr_colm_outer">
            <span class="icons chat"></span>
            <?php if(get_field('section1_contact_heading','option')){ ?><h3><?php echo get_field('section1_contact_heading','option'); ?></h3><?php } ?>
            <?php if(get_field('section1_contact_subheading','option')){ ?><p><?php echo get_field('section1_contact_subheading','option'); ?></p><?php } ?>

						<?php /*if(get_field('contact_mail','option')){ ?>
            <a href="mailto:<?php echo get_field('contact_mail','option'); ?>" class="e-mail"><span class="fa fa-envelope-o"></span>
                <span><?php echo get_field('contact_mail','option'); ?></span>
            </a>
					<?php }*/ ?>

                        <?php if(get_field('contact_phone','option')){ ?>
            <a href="tell:<?php echo preg_replace("/[\s-]+/","",get_field('contact_phone', 'option')); ?>" class="phone"><span class="fa fa-phone"></span>
                <span><?php echo get_field('contact_phone','option'); ?></span>
            </a>
                        <?php } ?>
                    
						<?php if(get_field('footer_display_email','option')){
							$fdes = get_field('footer_display_email','option');
							foreach($fdes as $fde){
							?>
            <a href="mailto:<?php echo $fde['fd_email_id']; ?>" class="e-mail"><span class="fa fa-envelope-o"></span>
                <span><?php echo $fde['fd_email_id']; ?></span>
            </a>
						<?php } } ?>



        </div>
        <div class="col-md-4 ftr_colm_outer">
            <span class="icons mail"></span>
           <?php if(get_field('section_2_newsletter_title','option')){ ?> <h3><?php echo get_field('section_2_newsletter_title','option'); ?></h3><?php } ?>
           <?php if(get_field('section2_newsletter_subtitle','option')){ ?> <p><?php echo get_field('section2_newsletter_subtitle','option'); ?></p><?php } ?>
            <div class="news_letter">

                <!-- Begin MailChimp Signup Form -->
                 <!-- <div id="mc_embed_signup"> -->
                        <!-- <form action="<?php #echo get_field('mailchimp_action_url','option'); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="YOUR EMAIL" required>
                            <button type="submit"  name="subscribe" id="mc-embedded-subscribe" class="sb_btn">
                                    <span class="aro"></span>
                            </button>
                        </form> -->
                 <!-- </div> -->
                <!--End mc_embed_signup-->





               <!--Zoho Campaigns Web-Optin Form's Header Code Starts Here-->

                <script type="text/javascript" src="https://tgqv.maillist-manage.in/js/optin.min.js" onload="setupSF('sf3z3606eee669c22cc10646808e738f442cf7bcd78f0d082198a353d0a83f4590d2','ZCFORMVIEW',false,'light',false,'0')"></script>
                <script type="text/javascript">
                    function runOnFormSubmit_sf3z3606eee669c22cc10646808e738f442cf7bcd78f0d082198a353d0a83f4590d2(th){
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

                <div id="sf3z3606eee669c22cc10646808e738f442cf7bcd78f0d082198a353d0a83f4590d2" data-type="signupform" style="opacity: 1;">
                    <div id="customForm">
                        <div class="quick_form_8_css" style="background-color: rgb(248, 248, 248); z-index: 2; font-family: Arial; overflow: hidden; border-style: none; border-width: 1px; border-color: rgb(204, 62, 23); height: 88px; width: 305px" name="SIGNUP_BODY">
                            <div style="width: 288px">
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
                                    <div style="position: relative; margin-top: 10px; display: inline-block; width: 180px; height: 46px">
                                        <div id="Zc_SignupSuccess" style="position: absolute; width: 87%; background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154); margin-bottom: 10px; word-break: break-all; opacity: 1; display: none">
                                            <div style="width: 20px; padding: 5px; display: table-cell">
                                                <img class="successicon" src="https://campaigns.zoho.com/images/challangeiconenable.jpg" style="width: 20px">
                                            </div>
                                            <div style="display: table-cell">
                                                <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px; line-height: 30px; display: block"></span>
                                            </div>
                                        </div>
                                        <input type="text" style="border: 1px solid rgb(204, 62, 23); border-radius: 0px; width: 100%; height: 100%; z-index: 4; outline: none; padding: 5px 10px; color: rgb(204, 62, 23); text-align: left; background-color: rgb(255, 255, 255); box-sizing: border-box; font-family: &quot;Open Sans&quot;; font-size: 14px" placeholder="YOUR EMAIL" changeitem="SIGNUP_FORM_FIELD" name="CONTACT_EMAIL" id="EMBED_FORM_EMAIL_LABEL">
                                    </div>
                                    <div style="position: relative; text-align: left; display: inline-block; height: 46px; width: 95px">
                                        <input type="button" style="text-align: center; width: 100%; height: 100%;text-shadow:none; z-index: 5; border: 1px solid rgb(204, 62, 23); color: rgb(255, 255, 255); cursor: pointer; outline: none; font-size: 14px; background-color: rgb(204, 62, 23); margin: 0px 0px 0px -5px; font-family: &quot;Open Sans&quot;" name="SIGNUP_SUBMIT_BUTTON" id="zcWebOptin" value="Subscribe">
                                    </div>
                                    <div style="background-color: rgb(248, 248, 248); color: rgb(222, 53, 11); border: 1px none rgb(255, 217, 211); opacity: 1; font-size: 12px; font-family: &quot;Open Sans&quot;; width: 199px; height: 20px; display: none" id="errorMsgDiv">Email must be formatted correctly.</div>
                                    <input type="hidden" id="fieldBorder" value="">
                                    <input type="hidden" id="submitType" name="submitType" value="optinCustomView">
                                    <input type="hidden" id="emailReportId" name="emailReportId" value="">
                                    <input type="hidden" id="formType" name="formType" value="QuickForm">
                                    <input type="hidden" name="zx" id="cmpZuid" value="1df85729cf">
                                    <input type="hidden" name="zcvers" value="2.0">
                                    <input type="hidden" name="oldListIds" id="allCheckedListIds" value="">
                                    <input type="hidden" id="mode" name="mode" value="OptinCreateView">
                                    <input type="hidden" id="zcld" name="zcld" value="1711537634e6227">
                                    <input type="hidden" id="zctd" name="zctd" value="">
                                    <input type="hidden" id="document_domain" value="">
                                    <input type="hidden" id="zc_Url" value="tgqv.maillist-manage.in">
                                    <input type="hidden" id="new_optin_response_in" value="0">
                                    <input type="hidden" id="duplicate_optin_response_in" value="0">
                                    <input type="hidden" name="zc_trackCode" id="zc_trackCode" value="ZCFORMVIEW">
                                    <input type="hidden" id="zc_formIx" name="zc_formIx" value="3z3606eee669c22cc10646808e738f442cf7bcd78f0d082198a353d0a83f4590d2">
                                    <input type="hidden" id="viewFrom" value="URL_ACTION">
                                    <span style="display: none" id="dt_CONTACT_EMAIL">1,true,6,Contact Email,2</span>
                                </form>
                            </div>
                        </div>
                        <div style="display: none" id="unauthPageTitle">neurosensum</div>
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
        <div class="col-md-4 ftr_colm_outer">
            <span class="icons social"></span>
            <?php if(get_field('section_3_social_title','option')){ ?><h3><?php echo get_field('section_3_social_title','option'); ?></h3><?php } ?>
            <?php if(get_field('section3_social_subtitle','option')){ ?><p><?php echo get_field('section3_social_subtitle','option'); ?></p><?php } ?>
            <ul class="social_icons">
              <?php if(get_field('facebook_link','option')){ ?>  <li class="hvr-float"><a href="<?php echo get_field('facebook_link','option'); ?>" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
               <?php if(get_field('twitter_link','option')){ ?> <li class="hvr-float"><a href="<?php echo get_field('twitter_link','option'); ?>" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
              <?php if(get_field('googleplus_link','option')){ ?>  <li class="hvr-float"><a href="<?php echo get_field('googleplus_link','option'); ?>" title="G plus" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
               <?php if(get_field('pinterest_link','option')){ ?> <li class="hvr-float"><a href="<?php echo get_field('pinterest_link','option'); ?>" title="Pintrest" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php } ?>
               <?php if(get_field('lnkedin_link','option')){ ?> <li class="hvr-float"><a href="<?php echo get_field('lnkedin_link','option'); ?>" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
               <?php if(get_field('instagram_link','option')){ ?> <li class="hvr-float"><a href="<?php echo get_field('instagram_link','option'); ?>" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
               <?php if(get_field('youtube_link','option')){ ?> <li class="hvr-float"><a href="<?php echo get_field('youtube_link','option'); ?>" title="YouTube" target="_blank"><i class="fa fa-youtube"></i></a></li><?php } ?>
            </ul>
        </div>

	</div>

    <!-- <div class="site-info">
        <p><?php #echo get_field('copyright','option'); ?><a href="http://acodez.in" >Acodez</a></p>
    </div> -->

    <div class="site-info">
        <a href="https://neurosensum.com/privacy-policy"> Privacy Policy</a>
        <p><?php echo get_field('copyright','option'); ?></p>
    </div>

</footer> <!-- #colophon-->




<?php wp_footer(); ?>

    <script>

        AOS.init({
            easing: 'ease-out-back',
            duration: 2000,
            disable: 'mobile',
        });


    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();

        if (scroll >= 50) {
            jQuery(".center_block").addClass("ani_block");
        } else {
            jQuery(".center_block").removeClass("ani_block");
        }
    });

    </script>


</body>
</html>
