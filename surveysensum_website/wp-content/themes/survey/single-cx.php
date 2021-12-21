<?php
	get_header();?>
<!-- Header Section Start -->

    <style>
        .video-play iframe{
            width: 100% !important;
            height: 100% !important;
        }
        .btn.btn-secondary {
            background-color: #fff;
            color: #02193B !important;
            font-weight: 500;
            border-color: #fff;
            transition: 0.5s ease-in-out;
            height: 48px;
            box-shadow: 0px 2px 4px #00000014;
            padding: 0 24px;
        }

        .watchBtn {
            margin-top: 20px;
            text-align: center;
            display: none;
        }
        .upcoming-event-main .video-play .bannerImageWrp {
            text-align: right;
        }
        .upcoming-event-main .video-play .bannerImageWrp img{
            object-fit: contain;
            max-width: 100%;
        }
        @media(max-width: 991px){
            .upcoming-event-main .video-play .bannerImageWrp {
                text-align: center;
            }
            .watchBtn{
                display: block;
            }
            .watchBtnDestop{
                display: none;
            }
        }


    </style>

    <section class="think-cx-hero upcoming-event-main">
        <div class="container-fluid main-section-upcoming">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6 register-upcoming-btn">
                    <div class="heading">
                        <?php 
                            if(have_posts()) : while(have_posts()) : the_post(); 
                            ?>
                            <h2><?php the_title() ?></h2>
                        <?php endwhile; endif; ?>
                        <div class="local-time"></div>
                        <div class="session-for-mobile">
                            <div class="who-attending-boxes-main">
                                <div class="who-attending-boxes">
                                    <?php
                                        if(have_posts()) : while(have_posts()) : the_post(); 
                                        $entries = get_post_meta( get_the_ID(), 'wiki_test_repeat_group', true );    
                                        foreach ( (array) $entries as $key => $entry ) { ?>
                                         <div class="box-content">
                                            <img src="<?php echo $entry['speaker_image'] ?>" alt="">
                                            <div class="attending-name"><?php echo $entry['speaker_name'] ?></div>
                                        </div>
                                    <?php } endwhile; endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="session-watch-main watch_now_demand watchBtnDestop">
                        <div class="live-session">
                            <div class="all-session-btn">
                                <a class="btn btn-secondary sm" id="watchNowForm">
                                    <?php
                                        if(have_posts()) : while(have_posts()) : the_post(); 
                                        $buttonText = get_post_meta( get_the_ID(), 'button_text', true );  
                                            echo $buttonText;
                                        ?>
                                    <?php endwhile; endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 social-icons-position">
                    <div class="main-social-banner">
                        <div class="upcoming-demand-video">
                            <div class="image-video-back">
                                <div class="video-play">
                                <?php 
                                    if(have_posts()) : while(have_posts()) : the_post(); 
                                        $url = esc_url( get_post_meta( get_the_ID(), 'wiki_test_embed', 1 ) );
                                        $attendance = get_post_meta( get_the_ID(), 'image_if_video_unavailable', true );    
                                        if($url){ ?>
                                            <?php
                                                echo wp_oembed_get( $url );
                                                ?>
                                            <?php  }else{ ?>

                                            <?php
                                                foreach ( (array) $attendance as $key => $attend ) { ?>
                                                    <div class="bannerImageWrp">
                                                        <img src="<?php echo $attend['video_of_image'] ?>" alt="">
                                                    </div>
                                        

                                        <?php }?>
                                <?php } endwhile; endif; ?>
                                    
                                    

                                </div>
                            </div>
                            <div class="watchBtn">
                                <a class="btn btn-secondary sm" id="watchNowForm">
                                    <?php
                                        if(have_posts()) : while(have_posts()) : the_post(); 
                                        $buttonText = get_post_meta( get_the_ID(), 'button_text', true );  
                                            echo $buttonText;
                                        ?>
                                    <?php endwhile; endif; ?>
                                </a>
                            </div>
                            <div class="social-icons d-flex">
                                <div class="sosial-inner-items">
                                    <a href="https://www.facebook.com/sharer.php?u=https://www.surveysensum.com/cx/?index=36&amp;quote=Check out this virtual talk by SurveySensum!" class="icon-img">
                                    <img src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/svg/Facebook.svg" class="img-fluid" alt="">
                                    </a><a href="https://twitter.com/intent/tweet?url=https://www.surveysensum.com/cx/?index=36&amp;text=Check out this virtual talk by SurveySensum!" data-text="custom share text" class="icon-img">
                                    <img src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/svg/Twitter.svg" class="img-fluid" alt="">
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.surveysensum.com/cx/?source%3D36&amp;title%3DDigital-CX:-Being-Future-Ready" class="icon-img">
                                    <img src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/svg/LinkedIN.svg" class="img-fluid" alt=""> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="who-should-attend-main registerZoomFixed" id="registerZoom">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="attending-left">
                    <div class="attending-section-inner">
                        <div class="attending-heading common-heading">
                            Who should attend?</div>
                        <div class="attending-content-box">
                            
                            <?php
                                if(have_posts()) : while(have_posts()) : the_post(); 
                                $attendance = get_post_meta( get_the_ID(), 'who_should_attend', true );    
                                foreach ( (array) $attendance as $key => $attend ) { ?>
                                    <div class="box-content">
                                        <img src="<?php echo $attend['attend_images'] ?>" alt="">
                                        <div class="attending-title"><?php echo $attend['attend_heading'] ?></div>
                                    </div>
                            <?php } endwhile; endif; ?>
                        </div>
                    </div>
                    <div class="about-webinar">
                        <div class="about-inner-heading">
                            <div class="about-heading common-heading">About the Webinar</div>
                            <div class="about-sub-title">
                                <?php
                                    if(have_posts()) : while(have_posts()) : the_post(); 
                                        the_content();
                                    endwhile; endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="about-the-speeker">
                        <div class="common-heading">
                            About the Speakers</div>
                        <div class="speeker-info-main">

                        <?php
                                if(have_posts()) : while(have_posts()) : the_post(); 
                                $aboutSpeakers = get_post_meta( get_the_ID(), 'about_speakers', true );    
                                foreach ( (array) $aboutSpeakers as $key => $speaker ) { ?>
                                    
                                <div class="info-content">
                                    <div class="organiser-img"><img src="<?php echo $speaker['about_speakers_image'] ?>" alt=""></div>
                                    <div class="speeker-info-inner">
                                        <div class="title"><?php echo $speaker['about_speakers_name'] ?></div>
                                        <div class="organisation-owner"><?php echo $speaker['speaker_professions'] ?></div>
                                        <div class="organisation-info"><p><?php echo $speaker['about_speaker_description'] ?></p></div>
                                    </div>
                                </div>
                            <?php } endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div id="registerNowScroll">
                    <div class="register-form" id="register-live-session-watch">
                        <div class="form-heading">
                            Watch Now</div>
                        <div class="form-content">
                            <?php
                                if(have_posts()) : while(have_posts()) : the_post(); 
                                $formShortcode = get_post_meta( get_the_ID(), 'form_shortcode', true );  
                                    echo $formShortcode;
                                ?>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="keep-learning-leader" id="keep-learning-subscribe">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="subscribe">
                    <div class="subscribe-heading">
                    Keep learning from CX Thought Leaders
                    </div>
                    <div class="subscribe-btn"> 

                        <!-- <script data-hubspot-rendered="true">hbspt.forms.create({
                                portalId: "5773317",
                                formId: "2fea32c0-427d-418b-a1b1-89c82622d6a0",

                                onFormSubmit: function($form) {
                                        var faqQuestion = document.getElementById('keep-learning-subscribe');
                                        faqQuestion.classList.add('subscribe-message-thanku');
                                }
                            });
                        </script> -->


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
                                <div class="quick_form_8_css" style="z-index: 2; font-family: Arial; border-color: rgb(235, 235, 235); overflow: hidden; border-style: none; border-width: 1px; width: 100%;text-align:left;" name="SIGNUP_BODY">
                                <div style="width: 100%;">
                                    <span class="zoho-form-title-newsletter" style="font-family: Arial; color: rgb(9, 30, 66); text-align: left; padding: 10px 10px 5px; width: 100%; display: block; font-size: 16px; border-style: none; border-width: 1px; border-color: rgb(0, 108, 251)" id="SIGNUP_HEADING">Subscribe to our mailing list and stay updated about upcoming sessions</span>
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
                                    <div class="zoho-newsletter-form" style="position: relative; margin: 10px 0 10px 10px; display: inline-block; height: 46px; width: 418px;">
                                        <div id="Zc_SignupSuccess" style="position: absolute; width: 87%; background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154); margin-bottom: 10px; word-break: break-all; opacity: 1; display: none">
                                        <div style="width: 20px; padding: 5px; display: table-cell">
                                            <img class="successicon" src="https://campaigns.zoho.com/images/challangeiconenable.jpg" style="width: 20px">
                                        </div>
                                        <div style="display: table-cell">
                                            <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px; line-height: 30px; display: block"></span>
                                        </div>
                                        </div>
                                        <input type="text" style="border: 1px solid rgb(11, 95, 255); border-radius: 5px 0 0 5px; width: 100%; height: 100%; z-index: 4; outline: none; padding: 5px 10px; color: rgb(0, 0, 0); text-align: left; font-family: Arial; background-color: rgb(255, 255, 255); box-sizing: border-box; font-size: 15px;border-right: 0;" placeholder="Enter email address*" changeitem="SIGNUP_FORM_FIELD" name="CONTACT_EMAIL" id="EMBED_FORM_EMAIL_LABEL">
                                    </div>
                                    <div class="zoho-newsletter-btn" style="position: relative; margin: 10px 10px 10px 0; text-align: left; display: inline-block; height: 46px; width: 114px">
                                        <input type="button" style="text-align: center; border-radius: 0 5px 5px 0; width: 100%; height: 100%; z-index: 5; border: 1px solid rgb(2, 25, 59); color: rgb(255, 255, 255); cursor: pointer; outline: none; font-size: 14px; background-color: rgb(2, 25, 59); margin: 0px 0px 0px -5px; font-family: Arial" name="SIGNUP_SUBMIT_BUTTON" id="zcWebOptin" value="Subscribe">
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
                                    <div style="padding: 0 10px; color: rgb(222, 53, 11); margin: 0; border: 1px none rgb(255, 217, 211); opacity: 1; font-size: 12px; font-family: Arial; width: 202px; height: auto; display: none;font-weight:500;" id="errorMsgDiv">Email must be formatted correctly.
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
            </div>
        </div>
    </div>
</section>
    
        <?php
            if(have_posts()) : while(have_posts()) : the_post(); 
            $video_url = get_post_meta( get_the_ID(), 'video_url', true );
                ?>
        <?php endwhile; endif; ?>
    <a class="fullvUrl" style="display:none" href="<?php echo $video_url ?>"></a>

<script>
    
    
    jQuery(document).ready(function($){
        var url   = window.location.href;
        localStorage.setItem("facebook_share", url);
        var getVideoLink = $('.fullvUrl').attr('href');
        localStorage.setItem("video_link", getVideoLink);
    });
</script>



<?php get_footer(); ?>