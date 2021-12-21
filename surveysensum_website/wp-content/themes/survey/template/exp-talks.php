<?php 
   /*==============================================================
   
   	Template Name: Experience Talk
   
   ==============================================================*/
   
   get_header();?>

   <style>
      .filter-catagory .filter-content ul li a.active {
          color: #0B52CC;
          border-bottom: 2px solid #0B52CC;
      }

      .service-tab-content.tab-content {
          padding: 50px 0 0;
      }

      .cxPostWrp {
          margin-bottom: 40px;
          box-shadow: 0px 1px 20px #b8caff9c;
          height: 94%;
          border-radius: 4px;
      }

      ul.categoryList li {list-style: none;}

      .cxPostHeading {
          padding: 15px 15px;
          text-align: right;
          border-top: 1px solid #02193b;
      }

      .cxPostHeading h3 {
          text-align: left;
          margin-bottom: 0;
      }

      .cxPostHeading h3 a {
          display: block;
          font-size: 22px;
          color: initial;
          font-weight: 500;
      }

      .cxPostHeading a.onDemandBtn {
          background-color: #02193b;
          border: 2px solid #02193b;
          color: #fff;
          padding: 6px 21px 9px;
          border-radius: 4px;
          line-height: normal;
          font-size: 13px;
          font-weight: 500;
      }
      .cxPostImage {
          padding: 15px 15px;
          /* background: #F4F6FC; */
      }
      .cxPostHeading a.upcomingBtn {
          background-color: #0d9f0a;
          border: 2px solid #0d9f0a;
          color: #fff;
          padding: 6px 21px 9px;
          border-radius: 4px;
          line-height: normal;
          font-size: 13px;
          font-weight: 500;
      }
      .bannerRegisterBtn .btn{
        background-color: #fff;
        color: #02193B !important;
        font-weight: 500;
        border-color: #fff;
        transition: 0.5s ease-in-out;
        height: 48px;
        /* width: 164px; */
        min-width: 164px;
        box-shadow: 0px 2px 4px #00000014;
        padding: .3rem;
      }
      #livebtn h5{
        color: #fff;
        margin: 10px 0;
        font-size: 18px;
        font-weight: normal;
      }
    
    @media(max-width: 767px){
      .filter-catagory .filter-content ul li {
          opacity: 1;
          max-height: inherit;
          display: inline-block;
          width: auto;
          margin: 10px 3px 0 3px;
      }

      .filter-catagory .filter-content ul {
          background: transparent;
          border-bottom: 0;
          display: flex;
          justify-content: center;
      }

      .filter-catagory .filter-content ul li a {
          background: #F4F6FC;
      }
      .service-tab-content.tab-content{
        padding: 10px 0 0;
      }
    }

   </style>


<?php
// $think_cx_hero_section = get_field('think_cx_hero_section_top_2');
$think_cx_hero_section = get_field('think_cx_hero_section_top');

$image = $think_cx_hero_section['hero_image']['url'];
$go_live_image = $think_cx_hero_section['go_live_image']['url'];
$live_subtitle = $think_cx_hero_section['go_live_subtitle'];
$episode = $think_cx_hero_section['number_of_episode'];
$watchNow_upcoming_url = $think_cx_hero_section['watch_now_upcoming_event_url'];
$survey_link = $think_cx_hero_section['survey_link'];

// $through_leadership_filter_category_menu = get_field('through_leadership_filter_category_menu');
// echo var_dump($through_leadership_filter_category_menu);
$contents = '';
// $search = $_GET['search'];
// if($search){
//   $contents = $wpdb->get_results( 'select * from contents where title = '.$search);
// }else{
//   $contents = $wpdb->get_results('select * from contents');
// }



if( $think_cx_hero_section ): ?>
    <!-- leadership think cx hero section 1 -->
    
<?php endif; ?>

<section class="think-cx-hero main-cx">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading think-cx-heading">
             <h2>The Experience Talk</h2>
             <p>Inspiring Customer Experience stories from around the world</p>
            <div id="eventData">

            </div>
              <div class="view-session-watch register-upcoming-btn">
                  <div class="all-session-btn" id="allsession">
                        <a class="btn btn-secondary lg viewAllSessionFilter">View All Sessions</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="hero-banner-image">
        <img src="/wp-content/uploads/2020/08/OBJECTS.svg" alt="">
      </div>
    </section>

    <section class="propose-survey">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="propose-btn-main">
              <div class="propose-text">Have an inspiring CX story?<span> Propose a session to share with the world!</span></div>
              <a class="btn btn-outline-secondary sm" href="<?php echo $survey_link ;?>" target="_blank">Propose a Session</a>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="servicesSection section">
      <div class="container">
            <div class="serveHomeWrp filter-catagory ">
                <div class="serviceTabBox viewAllSessionFilterList filter-content">
                    <ul class="nav nav-tabs serviceList" id="serviceTab" role="tablist">
                        <?php
                            $counter    =   1;
                            $activeClass    =   '';
                            $terms = get_terms(array('taxonomy'=>'topic','hide_empty'=>false,'parent'=>0)); 
                            foreach($terms as $term):
                            if ($counter == 1) {
                                $activeClass = "active";
                            } else {
                                $activeClass = "";
                            }              
                            ?>
                            <li>
                                <a class="<?php echo $activeClass ?>" href="#service-<?php echo $term->slug; ?>" data-toggle="tab" role="tab" aria-controls="serviceTab" id="<?php echo $term->slug; ?>-tab">
                                
                                  <!-- <div class="sBg" style="background-color: <?php// echo get_term_meta($term->term_id,'serv_theme_dcolor',true);?>;"></div> -->
                                  <!-- <span style="color: <?php // echo get_term_meta($term->term_id,'serv_theme_dcolor',true);?>;"><i class=" <?php // echo get_term_meta($term->term_id,'serv_icodn',true);?>"></i></span>  -->
                                  <?php echo $term->name?>
                              </a>
                            </li>
                            <?php 
                    $counter ++;
                endforeach;?>
                    </ul>
                </div>
                <div class="service-tab-content tab-content">
                  <?php 
                    $terms_array = array( 
                    'taxonomy' => 'topic', 
                    'parent'   => 0
                    );
                    $services_terms = get_terms($terms_array); 
                    $counter    =   1;
                    $activeClass    =   '';
                    foreach($services_terms as $service):
                    if ($counter == 1) {
                        $activeClass = 'active';
                    } else {
                      $activeClass = '';
                    }
                    ?>
                    <div class="tab-pane fade show <?php echo $activeClass ?> " id="service-<?php echo $service->slug; ?>" role="tabpanel" aria-labelledby="<?php echo $service->slug; ?>-tab">
                        <div class="serviceTabcontent_inner">
                          <div class="serviceText">
                              <div class="service_desc_text">
                                  <?php echo term_description($service); ?>
                              </div>
                              <?php 
                                  $post_args = array(
                                      'posts_per_page' => -1,
                                      'post_type' => 'cx',
                                      'orderby'   => 'meta_value',
                                      'order' => 'DESC',
                                      'tax_query' => array(
                                          array(
                                              'taxonomy' => 'topic', 
                                              'field' => 'term_id', 
                                              'terms' => $service->term_id,
                                          )
                                      )
                                  );
                                  $myposts = get_posts($post_args); ?>
                              <ul class="categoryList row">
                                  
                                  <?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                                  <li class="col-12 col-md-6">
                                    <div class="cxPostWrp">
                                      <div class="cxPostImage">
                                        <a href="<?php the_permalink(); ?>">
                                          <?php echo get_the_post_thumbnail( $page->ID, 'full' ); ?>
                                        </a>
                                      </div>
                                      <div class="cxPostHeading">
                                        <h3>
                                          <a href="<?php the_permalink(); ?>">
                                              <?php the_title(); ?>
                                          </a>
                                        </h3>
                                        <!-- <a href="<?php // the_permalink(); ?>" class="onDemandBtn">On Demand</a> -->
                                          <!-- <?php 
                                              #$buttonText = get_field( "post_types_check", $post->ID );
                                              #if( $buttonText == "On Demand") { ?>
                                                <a href="<?php #the_permalink(); ?>" class="onDemandBtn"><?php #echo $buttonText; ?></a>

                                              <?php #} else { ?>
                                                <a href="<?php #the_permalink(); ?>" class="upcomingBtn"><?php #echo $buttonText; ?></a>

                                              <?php    #}

                                            ?> -->
                                        <!-- </a> -->
                                      </div>
                                    </div>
                                  </li>
                                  <?php endforeach; ?>
                              </ul> 
                          </div>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); 
                        $counter ++;
                    ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Keep learning subscribe -->
    <section class="keep-learning-leader" id="keep-learning-subscribe">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="subscribe">
              <div class="subscribe-heading">
                Keep learning from CX Thought Leaders
              </div>
              <!-- <div class="subscribe-keep-sub-text">Subscribe to our mailing list and stay updated about upcoming sessions</div> -->
              <div class="subscribe-btn">

                <!-- <script>
                  hbspt.forms.create({
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
                            <span class="zoho-form-title-newsletter" style="font-family: Arial;color: rgb(9, 30, 66); text-align: left; padding: 10px 10px 5px; width: 100%; display: block; font-size: 16px; border-style: none; border-width: 1px; border-color: rgb(0, 108, 251)" id="SIGNUP_HEADING">Subscribe to our mailing list and stay updated about upcoming sessions</span>
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



<!-- Register zoom session -->
<!-- zoom register form modal -->
<div class="modal fade" id="zoom-register-modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelVideo" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">

         
            <!-- <iframe src="https://zoom.us/webinar/register/WN_DNirZkUOSgKvKV55Iroojg" frameborder="0" allowfullscreen allow="microphone; camera;"></iframe>
            <button
               type="button"
               class="close"
               data-dismiss="modal"
               aria-label="Close"
               > -->

               <h5 class="modal-title text-center font-weight-bold">Register Now</h5>

               <script>
                  hbspt.forms.create({
                        portalId: "5773317",
                        formId: "f898be68-324f-4621-a098-3bb25498e677"
                  });
                </script>
           
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/close-menu.svg" alt="SurveySensum" />
                </button>
               
            </button>
         </div>
      </div>
   </div>
</div>


<script>
(function($) {
    var pause = 3000;

    function tick() {
        $.get("/event-data.php", function(data, status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(data.trim()){
				$('#eventData').html(data);
				$('#allsession').hide();
			}else{
				$('#eventData').html('');
				$('#allsession').show();
				}
		});
    }
    setInterval(tick, pause);
})(jQuery);

  // Through Leadership JS 13-08-2020
	// jQuery('#searchValue').focus(function(){
	// 	if(!jQuery(this).val()){
	// 		  jQuery('#searchIcon').click(function(){
  //       jQuery('.filter-content').addClass("inputBorder");
  //     });
  //   }
  // });

  // jQuery('#searchValue').on('keypress',function(e){
  //     if(e.which == 13) {
  //       jQuery('.filter-content').addClass("inputBorder");
  //     }
  // });
  


  // Mobile search filter
  // jQuery('#searchMobile').click(function(){
  //   jQuery('.filter-content').addClass("mobileInput");
  //   jQuery('.filter-content.mobileInput #searchValue').focus();
  // });

  // Remove search field
  // jQuery('#mobileSearchBack').click(function(){
  //   jQuery('.filter-content').removeClass("mobileInput inputBorder");
  // });



  // jQuery('.filter-catagory .filter-content ul li:first-child > a').click(function(){
  //   jQuery('.filter-catagory').toggleClass('dropdownFilter');
  // });

  

  // var newImage = jQuery('<img src="<?php// echo get_template_directory_uri()?>/homepage_assets/img/Spotify_Logo_RGB_Green.png" class="img-fluid" alt="">');
  
  // jQuery('#mobileSelectFilter option:selected').append(newImage);

</script>


<?php get_footer(); ?>





