<?php 

	/*==============================================================

		Template Name: Upcoming Demand

	   ==============================================================*/
get_header(); ?>

<?php
      // $upcoming_hero_section_top = get_field('upcoming_hero_section_top');
      $index = $_GET['index'];

      $frequently_asked_questions = $wpdb->get_results( 'select * from asked_question where content_id = '.$index);
      $attender_hero_from_leadership = $wpdb->get_results( 'select * from attender_hero where content_id = '.$index);
      $about_the_webinar_points = $wpdb->get_results( 'select * from content_webinar_points where content_id = '.$index);
      $about_the_speakers = $wpdb->get_results( 'select * from speakers where content_id = '.$index);

      $arraydata = $wpdb->get_results( 'select * from contents where id = '.$index);

      $islivenow = false;

      $image = $arraydata[0]->{'image_path'};
                  
      $date = $arraydata[0]->{'date'};
      $displaydate = date('M d, Y',strtotime($date));
      $event_description = $arraydata[0]->{'title'};
      $time = $arraydata[0]->{'time'};
      $displaytime = date("g:i A", strtotime(date($date.' '.$time)));
      $participants_number = $arraydata[0]->{'no_of_people_view'};
      $hero_video = $arraydata[0]->{'hero_video_url'};
      $webinar_id = $arraydata[0]->{'webinar_id'};
      // $attender_hero_from_leadership = $arraydata[$index]['attender_hero'];
      $who_should_attend = $arraydata[0]->{'who_should_attend'};
      $about_the_webinar_description = stripslashes($arraydata[0]->{'webinar_description'});
      // $about_the_webinar_points = $arraydata[$index]['about_the_webinar_points'];
      // $about_the_speakers = $arraydata[$index]['about_the_speakers'];
      $on_demand_video_url = $arraydata[0]->{'demand_video_url'};
      $zoom_registration_webinar_url = $arraydata[0]->{'rigtration_webinar_url'};
      $registration_id = $arraydata[0]->{'registration_id'};
      $country = $arraydata[0]->{'country'};
      $duration = $arraydata[0]->{'duration'};
      $category_content = $arraydata[0]->{'category_content'};
      $local_time_url = $arraydata[0]->{'local_time'};
      $islivenow = false;
      $facebook_Link = get_site_url().'/cx/?index='.$index.'&quote='.'Check out this virtual talk by SurveySensum!';
      $twitter_Link = get_site_url().'/cx/?index='.$index.'&text='.'Check out this virtual talk by SurveySensum!';
      $linkdin_Link = get_site_url().'/cx/?source%3D'.$index.'&title%3D'.preg_replace('/\s+/', '-', $event_description);

      if($arraydata[0]->{'category_content'}=='live'){
            $islivenow = true;
      }

?>

<!-- leadership think cx hero section 1 -->
<section class="think-cx-hero upcoming-event-main">
  <div class="container-fluid main-section-upcoming">
        <div class="row">
              <div class="col-12 col-md-12 col-lg-6 register-upcoming-btn">
                    <div class="heading">
                          <h2><?php echo stripslashes($event_description); ?></h2>
                          <?php if($category_content=="upcoming event" or $category_content=="live" ): ?>
                          <div class="date-time-event">
                                <span class="date"><?php echo $displaydate; ?></span>
                                <span class="time-country"><span class="time"><?php echo $displaytime; ?></span><?php if( $country ): ?> (<?php echo $country; ?>)<?php endif; ?></span>
                          </div>
                          <?php endif; ?>

                          <div class="local-time">
                          <?php if($category_content=="upcoming event" ): ?>
                                <?php if( $local_time_url ): ?>
                                      <?php
                                            echo '<a href="'.$local_time_url.'" target="_blank">Check in your local time</a>';
                                      ?>
                                <?php endif; ?>
                          <?php endif; ?>
                          </div>
                          <div class="session-for-mobile">
                                <div class="who-attending-boxes-main">
                                      <div class="speaker-mob-title">Speakers</div>
                                      <?php if( $attender_hero_from_leadership ): ?>
                                            <div class="who-attending-boxes">
                                            
                                            <?php
                                                  foreach ($attender_hero_from_leadership as &$item) {
                                                        echo '<div class="box-content">';
                                                        echo      '<img src="data:image/jpeg;base64,'.base64_encode($item->{'image'}).'" alt="">';
                                                        echo       '<div class="attending-name">'.$item->{'name'}.'</div>';
                                                        echo '</div>';
                                                  }
                                            ?>

                                      </div>
                                      <?php endif; ?>
                                      
                                </div>
                          </div>
                    </div>

                    <!-- Upcoming session watch or register button -->
                    <?php if($category_content=="upcoming event" or $category_content=="live" ): ?>
                          <div class="session-watch-main">

                          <?php if(!$islivenow): ?>
                                <div class="view-session-watch zoomRegisterButton">
                                      <div class="all-session-btn">

                                            <!-- <a class="btn btn-secondary lg" data-toggle="modal" data-target="#zoom-register-form">Register Now</a> -->
                                            <a class="btn btn-secondary lg" id="register_now_form_button">Register Now</a>

                                      </div>
                                      <div class="participate-count"><?php echo $participants_number; ?> participants have already registered!</div>
                                </div>

                                <?php elseif($islivenow): ?>
                                <div class="live-session">
                                      <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/Live-badge.svg" alt="surveySensum">
                                      <div class="all-session-btn">
                                      <!-- <a class="btn btn-secondary sm" data-toggle="modal" data-target="#zoom-register-form" style="min-width:130px;">Watch Now</a> -->
                                      <a class="btn btn-secondary sm" id="watch_now_form_button" style="min-width:130px;">Watch Now</a>
                                      </div>
                                      <div class="live-session-happining">This session is currently happening. Watch LIVE!</div>
                                </div>

                          <?php endif; ?>

                        </div>
                    <?php endif; ?>
                  
                    <?php if($category_content=="on demand event" ): ?>
                          <!-- Demand session watch or register button -->
                          <div class="session-watch-main watch_now_demand">
                                <div class="live-session">
                                      <div class="all-session-btn">
                                            <a class="btn btn-secondary sm" id="watchNowForm">Watch Now</a>
                                      </div>
                                </div>
                          </div>
                    <?php endif; ?>



              </div>

              <div class="col-12 col-md-12 col-lg-6 social-icons-position">

                  <div class="main-social-banner">
                        <div class="upcoming-demand-video">
                              <div class="image-video-back">
                                    <?php if($image and $hero_video == ''): ?>
                                          
                                          <!-- <div class="video-img" style="background: url() no-repeat 100%/cover;">
                                          </div> -->
                                          <div class="video-img" >
                                                <?php      
                                                      echo '<div class="video-img">';
                                                      echo      '<img src="'.content_url().explode("/home/s1/html/wp-content",$image)[1].'" alt="">';
                                                      echo '</div>';           
                                                ?>
                                          </div>
                                          
                                    <?php elseif($hero_video): ?>
                                          <div class="video-play">
                                                <iframe height="100%" width="100%" src="<?php echo $hero_video;?>?rel=0&showinfo=0;" frameborder="0" scrolling="no" allowfullscreen></iframe>
                                          </div>
                                    <?php endif; ?>
                              </div>

                              <div class="social-icons d-flex">
                                    <div class="sosial-inner-items">
                                          <a
                                          href="https://www.facebook.com/sharer.php?u=<?php echo $facebook_Link; ?>"
                                          class="icon-img">
                                                <img
                                                src="<?php echo get_template_directory_uri()
                                                ?>/homepage_assets/img/svg/Facebook.svg"
                                                class="img-fluid"
                                                alt=""/>
                                          </a>

                                          <a href="https://twitter.com/intent/tweet?url=<?php echo $twitter_Link; ?>" data-text="custom share text" class="icon-img">
                                          <img
                                                src="<?php echo get_template_directory_uri()
                                                ?>/homepage_assets/img/svg/Twitter.svg"
                                                class="img-fluid"
                                                alt=""
                                          />
                                          </a>
                                          <a
                                          href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $linkdin_Link; ?>"
                                          class="icon-img"
                                          >
                                          <img
                                                src="<?php echo get_template_directory_uri()
                                                ?>/homepage_assets/img/svg/LinkedIN.svg"
                                                class="img-fluid"
                                                alt=""
                                          />
                                          </a>
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
                                    <?php if($who_should_attend): ?>
                                          <div class="attending-heading common-heading">
                                                Who should attend?
                                          </div>
                                    <?php endif; ?>

                                    <?php $shouldAttend = explode (",", $who_should_attend); ?>
                                    <div class="attending-content-box">
                                    
                                          <?php foreach($shouldAttend as $i){ ;?>
                                                <div class="box-content">

                                                      <?php if($i == 'Customer Experience Manager'): ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/homepage_assets/img/svg/Customer-Experience-attend1.svg" alt="">

                                                      <?php elseif($i == 'Customer Support Professional'): ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/homepage_assets/img/svg/Consult-Talk.svg" alt="">

                                                      <?php elseif($i == 'Customer Success Manager'): ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/homepage_assets/img/svg/Customer-Success-01.svg" alt="">

                                                      <?php elseif($i == 'Marketing Manager'): ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/homepage_assets/img/svg/Marketing-Manager-01.svg" alt="">
                                                      
                                                      <?php elseif($i == 'Product Manager'): ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/homepage_assets/img/svg/Product-Manager-01-01.svg" alt="">

                                                      <?php endif; ?>

                                                      <div class="attending-title"><?php echo $i ;?></div>
                                                </div>
                                          <?php } ;?>

                                    </div>

                              </div>

                              <?php $webinar_points = $about_the_webinar_points; ?>
                              <?php if($webinar_points): ?>
                                    <div class="about-webinar">
                                          <div class="about-inner-heading">
                                                <div class="about-heading common-heading">About the Webinar</div>
                                                <div class="about-sub-title"><?php echo $about_the_webinar_description; ?></div>
                                          </div>
                                          
                                          <?php
                                                echo '<ol>';
                                                      foreach ($about_the_webinar_points as &$item) {
                                                            echo '<li>'.stripslashes($item->{"point"}).'</li>';
                                                      }
                                                echo '</ol>';
                                          ?>
                                    </div>
                              <?php endif; ?>

                              <?php if ($about_the_speakers): ?>
                                    <div class="about-the-speeker">
                                          <div class="common-heading">
                                                About the Speakers
                                          </div>
                                          <?php if($about_the_speakers) :?>
                                                <div class="speeker-info-main">
                                                      
                                                      <?php
                                                            foreach ($about_the_speakers as $item) {
                                                                  $speaker_image = $item ->{'image'};
                                                                  $speaker_title = $item->{'name'};
                                                                  $speaker_ownership = $item->{'designation'};
                                                                  $speaker_description = $item->{'description'};
                                                                  echo '<div class="info-content">';
                                                                  echo      '<div class="organiser-img">';
                                                                  echo            '<img src="data:image/jpeg;base64,'.base64_encode($speaker_image).'" alt="">';
                                                                  echo      '</div>';
                                                                  echo      '<div class="speeker-info-inner">';
                                                                  echo            '<div class="title">'.stripslashes($speaker_title).'</div>';
                                                                  echo             '<div class="organisation-owner">'.stripslashes($speaker_ownership).'</div>';
                                                                  echo            '<div class="organisation-info">'.stripslashes($speaker_description).'</div>';
                                                                  echo      '</div>';
                                                                  echo '</div>';
                                                            }
                                                      ?>
                                                </div>
                                          <?php endif; ?>
                                    </div>
                              <?php endif; ?>
                        </div>
                  </div>


                  <!-- Upcoming "watch Now" & "Register Now" buttons section  -->
                  <?php if($category_content=="upcoming event" or $category_content=="live" ): ?>
                        <div class="col-12 col-md-12 col-lg-6">

                              
                              <?php #if(!$islivenow): ?>

                                    <!-- <div class="register-form fixed-watch-register" id="register-now-button">
                                          <div class="register-modal-button">
                                                <a class="btn btn-secondary lg" data-toggle="modal" data-target="#zoom-register-form">Register Now</a>
                                          </div>
                                    </div> -->

                                    <!-- Upcoming "Register now" form section  -->
                                    <div class="col-12 col-md-12 col-lg-6">
                                          <div id="registerNowScroll">
                                                <div class="register-form" id="register-live-session-watch">
                                                      <div class="form-heading">
                                                            Register Now
                                                      </div>
                                                      <div class="form-content">
                                                            
                                                            <script>
                                                                  hbspt.forms.create({
                                                                        portalId: "5773317",
                                                                        formId: "<?php echo $registration_id ?>"
                                                                  });
                                                            </script>   

                                                      </div>
                                                </div>
                                          </div>
                                    </div>

                                    <!-- <?php #elseif($islivenow): ?>
                                          <div class="register-form fixed-watch-register" id="register-now-button">
                                                <div class="register-modal-button">
                                                      <a class="btn btn-secondary lg" data-toggle="modal" data-target="#zoom-register-form">Watch Now</a>
                                                </div>
                                          </div>

                                    <?php #endif; ?> -->

                        </div>
                  <?php endif?>


                  <!-- Demand "watch Now" form section  -->
                  <?php if($category_content=="on demand event" ): ?>
                        <div class="col-12 col-md-12 col-lg-6">
                              <div id="registerNowScroll">
                                    <div class="register-form" id="register-live-session-watch">
                                          <div class="form-heading">
                                                Watch Now
                                          </div>
                                          <div class="form-content">
                                                
                                                <script>
                                                      hbspt.forms.create({
                                                            portalId: "5773317",
                                                            formId: "eae278be-8e47-44d0-8368-9a5089138bd2",

                                                            // onFormSubmit: function($form) {
                                                            //       var goLive = document.getElementById('register-live-session-watch');
                                                            //       goLive.classList.add('live-watch');
                                                            // }
                                                      });
                                                </script>   

                                                <!-- <a href="" class="btn btn-primary lg" data-toggle="modal" data-target="#session-watch-here">click here</a> -->
                                          </div>
                                    </div>
                              </div>
                        </div>
                  <?php endif;?>

            </div>

            <?php if ($frequently_asked_questions): ?>
                  <div class="row">
                        <div class="col-12 col-md-12 col-lg-6">
                              <div class="attending-left">
                                    <div class="frequently-asked-qa">
                                          <div class="common-heading">
                                          Frequently Asked Questions
                                          </div>

                                          <?php if ($frequently_asked_questions): ?>
                                                

                                                <div class="questions-answer-list">

                                                      <?php
                                                            foreach ($frequently_asked_questions as $item) {
                                                                  echo '<div class="question-answer">';
                                                                  echo       '<div class="question-title">'.stripslashes($item->{'question'}).'</div>';
                                                                  echo       '<div class="answer-title">'.stripslashes($item->{'answer'}).'</div>';
                                                                  echo '</div>'; 
                                                            }
                                                      ?>

                                                </div>

                                    
                                          <?php endif; ?>
                                          
                                    </div>
                              </div>
                        </div>
                  </div>
            <?php endif; ?>
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

                        <script>
                              hbspt.forms.create({
                              portalId: "5773317",
                              formId: "2fea32c0-427d-418b-a1b1-89c82622d6a0",

                              onFormSubmit: function($form) {
                                    var faqQuestion = document.getElementById('keep-learning-subscribe');
                                    faqQuestion.classList.add('subscribe-message-thanku');
                              }
                        });

                        </script>

                        </div>
                        </div>
                  </div>
            </div>
      </div>
</section>


<?php get_footer(); ?>

<!-- zoom register form modal -->
<div class="modal fade" id="zoom-register-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelVideo" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
         
            <!-- <iframe id="zoom-us-iframe" src="<?php #echo $zoom_registration_webinar_url;?>" frameborder="0" allowfullscreen allow="microphone; camera;"></iframe>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32">
                  <path style="fill:#fff;" d="M27,7.216,24.784,5,16,13.784,7.216,5,5,7.216,13.784,16,5,24.784,7.216,27,16,18.216,24.784,27,27,24.784,18.216,16Z" transform="translate(0 0)"/>
                  <path style="fill:none;" d="M0,0H32V32H0Z"/>
               </svg>
            </button> -->

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
            
         </div>
      </div>
   </div>
</div>


<!-- Session video is here watch now click here -->
<!-- <div class="modal fade upcoming-event-modal" id="session-watch-here" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelVideo" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <iframe width="800" height="450" src="<?php #echo $on_demand_video_url;?>" allowfullscreen></iframe>
            <button
               type="button"
               class="close"
               data-dismiss="modal"
               aria-label="Close"
               >
           
               <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32"><defs><style>.a{fill:#fff;}.b{fill:none;}</style></defs><path class="a" d="M27,7.216,24.784,5,16,13.784,7.216,5,5,7.216,13.784,16,5,24.784,7.216,27,16,18.216,24.784,27,27,24.784,18.216,16Z" transform="translate(0 0)"/><path class="b" d="M0,0H32V32H0Z"/></svg>
            </button>
         </div>
      </div>
   </div>
</div> -->


<script>
      var videourl = "";
      var webinar_id = "";
      var webinar_title = "";
      jQuery(document).ready(function( $ ) {
            jQuery(document).prop('title', "<?php echo $event_description ?>");
            var url   = window.location.href;
            var origin   = window.location.origin;
            var title = "<?php echo $event_description; ?>" ;
            var index = "<?php echo $index; ?>" ;
            title = title.replace(/\s/g, '-');
            origin = origin+'/cx/?title='+title+"&index="+index;
            if(url!=origin){
                  window.location.replace(origin);
            }
            localStorage.setItem("facebook_Link", "<?php echo $facebook_Link; ?>");
            localStorage.setItem("twitter_Link", "<?php echo $twitter_Link; ?>");
            localStorage.setItem("linkdin_Link", "<?php echo $linkdin_Link; ?>");
            localStorage.setItem("video_url", "<?php echo $on_demand_video_url ?>");
      });
      videourl = "<?php echo $on_demand_video_url ?>";
      webinar_id = "<?php echo $webinar_id ?>";
      webinar_title = "<?php echo stripslashes($event_description); ?>";
      jQuery(window).load(function() {
            jQuery('input[name="webinarvideo"]').val(videourl).change();
            jQuery('input[name="webinartitle"]').val(webinar_title).change();
            jQuery('input[name="webinar_id"]').val(webinar_id).change();
      });
</script>