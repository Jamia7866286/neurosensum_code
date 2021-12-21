<?php 
    	/*==============================================================

		Template Name: Customer Experiance

    ==============================================================*/
get_header();?>

    <?php $cx_front_article = get_field('cx_front_article'); ?>
    <!-- cx-guide-top section1 -->
    <section class="cx-guide-top">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-8 mx-auto">
            <div class="heading">
                <h1>CX Guide</h1>
                <p>Everything you need to know <br>about Customer Experience</p>
              </div>
              <div class="cx-bg-parent position-relative">
    
                <a href="<?php echo $cx_front_article['article_url']; ?>">

                  <div class="cx-top-bg">
                    <div class="cx-title-top bgColor">
                        <div class="parent-img-bg">
                            <img src="<?php echo $cx_front_article['image']; ?>" alt="<?php echo $cx_front_article['image_alt']; ?>">
                        </div>
                    </div>
                    <div class="front-content-bg artitle-content">
                        <h1><?php echo $cx_front_article['title']; ?></h1>
                        <!-- <p><?php #echo $cx_front_article['cx_front_subtitle']; ?></p> -->
                    </div>
                  </div>
                </a>

              </div>
            </div>
        </div>
      </div>
    </section>

    <?php $cx_small_article_card = get_field('small_article_card_left'); ?>



    <!-- cx-guide-post-dynamic dynamic page -->
    <section class="cx-guide-post-dynamic">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 pr-lg-5">
            <div class="main-cx-scroll">
              <?php if( have_rows('small_article_card_left') ): ?>
              
                <div class="cx-scroll-inner">
                  <?php while( have_rows('small_article_card_left') ): the_row();

                  $title = get_sub_field('title');
                  $time = get_sub_field('read_time');
                  $subTitle = get_sub_field('excerpt');
                  $imageUrl = get_sub_field('article_url');
                  $image = get_sub_field('image');
                  $imageAlt = get_sub_field('image_alt');

                  ?>
                      <div class="cx-item-repeat">
                        <a href="<?php echo $imageUrl ?>">
                          <div class="cx-single-item d-block d-lg-flex">
                            <div class="cx-left-img">
                              <img src="<?php echo $image ?>" alt="<?php echo $imageAlt ?>" />
                            </div>
                            <div class="artitle-content ml-lg-3 mt-4 mt-lg-0">
                
                              <h1><?php echo $title ?></h1>
                              <small><?php echo $time ?></small>
                              <p><?php echo $subTitle ?></p>

                            </div>
                          </div>
                        </a>
                      </div>
                  <?php endwhile; ?>
                </div>

              <?php endif; ?>
              <?php if( have_rows('large_article_card_left') ): ?>
              
              <div class="large-article-card">

              <?php while (have_rows('large_article_card_left')): the_row();
                
                $title = get_sub_field('title');
                $imageUrl = get_sub_field('article_url');
                $image = get_sub_field('image');
                $imageAlt = get_sub_field('image_alt');
              
              ?>

                <div class="cx-item-repeat large-item">
                  <a href="<?php echo $imageUrl; ?>">
                    <div class="cx-single-item">
                      <div class="cx-left-img">
                        <img src="<?php echo $image; ?>" alt="<?php echo $imageAlt; ?>">
                      </div>
                      <div class="artitle-content">
                        <h1><?php echo $title; ?></h1>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endwhile; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-12 col-md-6 pl-lg-5">
            <div class="main-cx-scroll">

              <?php if( have_rows('large_article_card_right_video') ): ?>
                <div class="video-image">

                  <?php while (have_rows('large_article_card_right_video') ): the_row();
                  
                  $title = get_sub_field('title');
                  $subTitle = get_sub_field('excerpt');
                  $videoUrl = get_sub_field('article_url');
                  $video = get_sub_field('video');
                  $videoAlt = get_sub_field('video_alt');
                  
                  ?>
                    <div class="cx-item-repeat large-item video">
                      <a href="<?php echo $videoUrl ?>">
                        <div class="cx-single-item">
                          <div class="cx-left-img">
                            <img src="<?php echo $video ?>" alt="<?php echo $videoAlt ?>">
                            <div class="video-icon">
                              <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/play_circle_video.svg" alt="">
                            </div>
                          </div>
                          <div class="artitle-content">
                            <h1><?php echo $title ?></h1>
                            <p><?php echo $subTitle ?></p>
                          </div>
                        </div>
                      </a>
                    </div>
                  <?php endwhile; ?>
                </div>
              <?php endif; ?>


              <?php if( have_rows('large_article_card_right') ): ?>
                <div class="video-image large-right-card">

                  <?php while (have_rows('large_article_card_right') ): the_row();
                  
                  $title = get_sub_field('title');
                  $time = get_sub_field('read_time');
                  $subTitle = get_sub_field('excerpt');
                  $image = get_sub_field('image');
                  $imageUrl = get_sub_field('article_url');
                  $imageAlt = get_sub_field('image_alt');
                  
                  ?>
                    <div class="cx-item-repeat large-item video">
                      <a href="<?php echo $imageUrl ?>">
                        <div class="cx-single-item">
                          <div class="cx-left-img">
                            <img src="<?php echo $image ?>" alt="<?php echo $imageAlt ?>">
                          </div>
                          <div class="artitle-content">
                            <h1><?php echo $title ?></h1>
                            <small><?php echo $time ?></small>
                            <p><?php echo $subTitle ?></p>
                          </div>
                        </div>
                      </a>
                    </div>
                  <?php endwhile; ?>
                </div>
              <?php endif; ?>



              <?php if( have_rows('small_article_card_right') ): ?>
                
                <div class="cx-scroll-inner">
                  <?php while( have_rows('small_article_card_right') ): the_row();

                  $title = get_sub_field('title');
                  $time = get_sub_field('read_time');
                  $subTitle = get_sub_field('excerpt');
                  $imageUrl = get_sub_field('article_url');
                  $image = get_sub_field('image');
                  $imageAlt = get_sub_field('image_alt');

                  ?>
                      <div class="cx-item-repeat">
                        <a href="<?php echo $imageUrl ?>">
                          <div class="cx-single-item d-block d-lg-flex">
                            <div class="cx-left-img">
                              <img src="<?php echo $image ?>" alt="<?php echo $imageAlt ?>" />
                            </div>
                            <div class="artitle-content ml-lg-3 mt-4 mt-lg-0">
                
                              <h1><?php echo $title ?></h1>
                              <small><?php echo $time ?></small>
                              <p><?php echo $subTitle ?></p>

                            </div>
                          </div>
                        </a>
                      </div>
                  <?php endwhile; ?>
                </div>
              <?php endif; ?>
              
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Want to personalize expert footer section  -->
    <section class="customer-experiance-expert nps-personalize cx-guide-footer">
      <div class="container">
        <div class="row">
          <div class="col-12 customer-experiance-inner">
            <div class="heading text-center">
              <h1 class="position-relative">
                Want personalized Customer Experience programs for your Business?
                <img
                  src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/before-top-dot.svg"
                  class="position-absolute"
                  alt=""
                />
              </h1>
              <a
                class="btn btn-secondary lg"
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
    <!-- End Want to personalize expert footer section -->



<?php get_footer(); ?>



<!-- CX Guide Want personalized Customer Experience Talk to our Expert Now -->
<!-- <div
   class="modal fade"
   id="cx-guide-our-expert"
   tabindex="-1"
   role="dialog"
   aria-labelledby="exampleModalLabel2"
   aria-hidden="true"
   >
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h5 class="modal-title text-center font-weight-bold">
               Talk To our Expert
            </h5>
       

            <script>
              hbspt.forms.create({
              portalId: "5773317",
              formId: "c5ab3690-db7d-46a0-9824-a50e57fa5349"
            });
            </script>

            <button
               type="button"
               class="close"
               data-dismiss="modal"
               aria-label="Close"
               >
            <img
               src="<?php #echo get_template_directory_uri()?>/homepage_assets/img/svg/close-menu.svg"
               alt="SurveySensum"
               />
            </button>
         </div>
      </div>
   </div>
</div> -->