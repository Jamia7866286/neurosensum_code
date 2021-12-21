<?php
	get_header();?>



<div class="sections-container">
      <section class="manulife-intro">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-12 col-lg-8">

                <?php
                    if(have_posts()) : while(have_posts()) : the_post(); 
                    $entries = get_post_meta( get_the_ID(), 'resolve_urgent_section1_repeat_group', true );    
                    foreach ( (array) $entries as $key => $entry ) { ?>
                        <div class="manulife-name"><?php echo $entry['small_company_title'] ?></div>
                        <div class="how-question">
                            <span><?php echo $entry['resolving_heading_section1'] ?></span>
                            <img class="green-img" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/green-img.svg">
                        </div>
                <?php } endwhile; endif; ?>

            </div>
            <div class="col-12 col-md-12 col-lg-4 for-mobile">
              <div class="interactive-image">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/first-section.svg">
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="manulife-achievement">
          <div class="container achievement-custom-container">
           <div class="row">

                <?php
                    if(have_posts()) : while(have_posts()) : the_post(); 
                    $entries = get_post_meta( get_the_ID(), 'achieve_section2_repeat_group', true );    
                    foreach ( (array) $entries as $key => $entry ) { ?>

                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="achievement-question">
                                <div><?php echo $entry['company_text'] ?></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="achievements-wrapper">
                                <div class="achievements-points">

                                  <?php if($entry['achieve_point_1_number'] != '') : ?>
                                      <span class="archieve-number"> <?php echo $entry['achieve_point_1_number']; ?></span>
                                    <?php else : ?>
                                      <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/project-improvement.svg">
                                  <?php endif; ?>
                                  <div class="achievement-text"><?php echo $entry['achieve_point_1'] ?></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="achievements-wrapper">
                                <div class="achievements-points">

                                  <?php if($entry['achieve_point_2_number'] != '') : ?>
                                      <span class="archieve-number"> <?php echo $entry['achieve_point_2_number']; ?></span>
                                    <?php else : ?>
                                      <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/customers-feedback.svg">
                                  <?php endif; ?>
                                  <div class="achievement-text"><?php echo $entry['achieve_point_2'] ?></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="achievements-wrapper">
                                <div class="achievements-points">

                                  <?php if($entry['achieve_point_3_number'] != '') : ?>
                                      <span class="archieve-number"> <?php echo $entry['achieve_point_3_number']; ?></span>
                                    <?php else : ?>
                                      <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/achievement.svg">
                                  <?php endif; ?>
                                  <div class="achievement-text"><?php echo $entry['achieve_point_3'] ?></div>

                                </div>
                            </div>
                        </div>
                <?php } endwhile; endif; ?>
                    
           </div>
          </div>
      </section>
      <section class="client-information section-spacing">
        <div class="container">
          <div class="row">
                <?php
                    if(have_posts()) : while(have_posts()) : the_post(); 
                    $entries = get_post_meta( get_the_ID(), 'profile_section3_repeat_group', true );    
                    foreach ( (array) $entries as $key => $entry ) { ?>
                    <div class="col-12 col-md-12 col-lg-4 for-web">
                        <div class="client-personal-info">
                            <div class="inner-body">
                                <div class="client-pic-wrapper">
                                    <div class="client-pic">
                                        <img class="img-fluid" src="<?php echo $entry['profile_image'] ?>">
                                    </div>
                                </div>
                                <div class="client-name"><?php echo $entry['profile_name'] ?></div>
                                <div class="client-designation"><?php echo $entry['profile_designation'] ?></div>
                                <div class="client-company"><?php echo $entry['profile_company'] ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="quotation-part">
                            <div class="quotation-mark">
                            <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/comment-quotation-mark.svg">
                            </div>
                            <div class="quotation-text"><?php echo $entry['profile_describe'] ?></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 for-mobile">
                        <div class="client-personal-info">
                            <div class="inner-body">
                                <div class="client-pic-wrapper">
                                    <div class="client-pic">
                                        <img class="img-fluid" src="<?php echo $entry['profile_image'] ?>">
                                    </div>
                                </div>
                                <div class="client-name"><?php echo $entry['profile_name'] ?></div>
                                <div class="client-designation"><?php echo $entry['profile_designation'] ?></div>
                                <div class="client-company"><?php echo $entry['profile_company'] ?></div>
                            </div>
                        </div>
                    </div>
                <?php } endwhile; endif; ?>
          </div>
        </div>
      </section>
      <section class="objective-section section-spacing">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-12 col-lg-5">
              <div class="section-interactive-image">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/third-section.svg">
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
              <div class="objective-panel">
                <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/objective.svg">
                <div class="section-heading">The Objective</div>

                    <?php
                        if(have_posts()) : while(have_posts()) : the_post(); 
                        $objectiveText = get_post_meta( get_the_ID(), 'objective_text', true );?>
                        
                        <div class="section-description"><?php echo $objectiveText ?></div>

                    <?php endwhile; endif; ?>

              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="challenge-section section-spacing">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-12 col-lg-5">
              <div class="section-interactive-image">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/fourth-section.svg">
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
             <div class="challenge-panel">
               <div class="circles-wrapper">
                 <img class="green-img" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/green-img.svg">
                 <img class="blue-img" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/blue-img.svg">
               </div>
               <div class="section-heading">The Challenge</div>

                    <?php
                        if(have_posts()) : while(have_posts()) : the_post(); 
                        $challengeText = get_post_meta( get_the_ID(), 'challenge_text', true );?>
                        
                        <div class="section-description"><?php echo $challengeText ?></div>

                    <?php endwhile; endif; ?>
             </div>
           </div>
          </div>
        </div>
      </section>
      <section class="solution-section section-spacing">
        <div class="container">
          <div class="row align-items-center">
             <div class="col-12 col-md-12 col-lg-5">
               <div class="section-interactive-image">
                 <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/fifth-section.svg">
               </div>
             </div>
             <div class="col-12 col-md-12 col-lg-7">
               <div class="solution-panel">
                 <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/green-img.svg">
                 <div class="section-heading">The Solution</div>

                 <?php
                    if(have_posts()) : while(have_posts()) : the_post(); 
                    $entries = get_post_meta( get_the_ID(), 'solution_section6_repeat_group', true );    
                    foreach ( (array) $entries as $key => $entry ) { ?>

                    <div class="section-description"><?php echo $entry['solution_point'] ?></div>
                    <!-- <div class="section-description second-part"><?php #echo $entry['solution_point_2'] ?></div> -->
                 
                <?php } endwhile; endif; ?>

               </div>
             </div>
          </div>
        </div>
      </section>
      <section class="solve-problem-section section-spacing">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-12 col-lg-5">
              <div class="section-interactive-image">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/sixth-section.svg">
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
              <div class="solve-problem-panel">
                <img class="green-img" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/green-img.svg">
                <div class="section-heading">How did it solve the problem?</div>
                <div class="section-description">

                    <?php
                        if(have_posts()) : while(have_posts()) : the_post(); 
                        $entries = get_post_meta( get_the_ID(), 'solve_problem_section7_repeat_group', true );    
                        foreach ( (array) $entries as $key => $entry ) { ?>

                        <div class="description-point">
                            <div class="tick-img">
                                <svg id="check_circle-24px" xmlns="http://www.w3.org/2000/svg" width="28.059" height="28.059" viewBox="0 0 28.059 28.059">
                                    <path id="Path_6637" data-name="Path 6637" d="M0,0H28.059V28.059H0Z" fill="none"></path>
                                    <path id="Path_6638" data-name="Path 6638" d="M13.691,2A11.691,11.691,0,1,0,25.383,13.691,11.7,11.7,0,0,0,13.691,2ZM11.353,19.537,5.507,13.691l1.648-1.648,4.2,4.185,8.874-8.874,1.648,1.66Z" transform="translate(0.338 0.338)" fill="#36b37e"></path>
                                </svg>
                            </div>
                            <div class="description-text"><span><?php echo $entry['subTitle_heading'] ?>:</span> <?php echo $entry['heading_description'] ?></div>
                        </div>
                    
                    <?php } endwhile; endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="about-company-section section-spacing">
        <div class="container">
          <div class="row align-items-center">

             
                

                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="about-company-panel">
                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/green-img.svg">
                            <div class="section-heading">About the Company</div>

                            <?php
                                if(have_posts()) : while(have_posts()) : the_post();
                                $entries = get_post_meta( get_the_ID(), 'about_company_section8_repeat_group', true );    
                                foreach ( (array) $entries as $key => $entry ) { ?>

                                <div class="section-description"><?php echo $entry['company_point'] ?></div>

                            <?php } endwhile; endif; ?>

                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="section-interactive-image">

                            <?php
                                if(have_posts()) : while(have_posts()) : the_post();
                                $logo = get_post_meta( get_the_ID(), 'company_logo', true ); ?>
                                
                                <img class="img-fluid" src="<?php echo $logo ?>">

                            <?php endwhile; endif; ?>

                        </div>
                    </div>

            
          </div>
        </div>
      </section>
      <section class="surveysensum-feedback-section section-spacing">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-7">
              <div class="surveysensum-feedback-panel">
                <div class="section-heading feedback">SurveySensum’s Feedback Platform</div>
                <div class="section-description">SurveySensum’s AI-enabled Feedback management platform enables businesses to gather customer feedback with CES, CSAT, and NPS surveys (in Bahasa as well). And, once gathered, you can analyze all the open-ended feedback with the text analysis. It categorizes feedback into topics, subtopics, and sentiments, and helps you identify the top customer issues so that you can make informed business decisions.</div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-5">
              <div class="section-interactive-image">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/seventh-section.svg">
              </div>
            </div>
          </div>
        </div>
      </section>


        <!-- Our clients companies -->
      <div class="our-clients">
        <div class="container">
            <div class="row">
              <div class="col-12">
                  <div class="clients">
                    <h4 class="text-center font-weight-bold">
                    These awesome customers have trusted us as their feedback partners
                    </h4>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                  <div class="clients-brand">
                    <div
                        class="software-used"
                        >
                        <div class="brand-logo">
                          <img
                              src="<?php echo get_template_directory_uri()
                                ?>/homepage_assets/img/client-icons.png"
                              class="img-fluid"
                              alt="SurveySensum"
                              />
                        </div>
                    </div>
                    <div class="many-more"><span>And many more...</span></div>
                  </div>
              </div>
            </div>
        </div>
      </div>
      <!-- End Our clients companies -->

      <!-- NPS Customer experiance expert section  -->
      <section class="customer-experiance-expert nps-personalize">
        <div class="container">
          <div class="row">
            <div class="col-12 customer-experiance-inner">
              <div class="heading text-center">
                <h2 class="position-relative">
                  Want personalized Customer Experience programs for your
                  Business?
                  <img
                    src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/before-top-dot.svg"
                    class="position-absolute"
                    alt=""
                  />
                </h2>
                <a
                  class="btn btn-secondary lg"
                  id="talk-to-expert-pricing"
                  href="#"
                  data-toggle="modal"
                  data-target="#pricing-want-personalize-bottom"
                  >Talk to our Expert Now</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End NPS Customer experiance expert section -->


</div>



<!-- Footer -->
<?php get_footer(); ?>





<!-- Talk to our CX Expert pricing-want-personalize-bottom modal -->
<div
  class="modal fade"
  id="pricing-want-personalize-bottom"
  tabindex="-1"
  role="dialog"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title text-center font-weight-bold">
          Get in Touch with our Expert
        </h5>

        <script>
          hbspt.forms.create({
            portalId: "5773317",
            formId: "75772099-1c5f-4fc9-996b-cc3dd3804909"
          });
        </script>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <img
            src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/close-menu.svg"
            alt="SurveySensum"
          />
        </button>
      </div>
    </div>
  </div>
</div>