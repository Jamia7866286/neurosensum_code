
   <?php 
   /*==============================================================
   
   	Template Name: Ebooks Post Type page
   
   ==============================================================*/
   
   get_header();?>
 

 <!-- <div>   
    <h3>Search Products</h3>
    <form role="search" action="<?php #echo site_url('/'); ?>" method="get" id="searchform">
    <input type="text" name="ebook_post" placeholder="Search Ebook"/>
    <input type="hidden" name="post_type" value="ebook" /> 
    <input type="submit" alt="Search" value="Search" />
  </form>
 </div> -->


    <div class="custom-post-main">

        <section class="custom-post-banner">
          <div class="container">
            <div class="row why-act align-items-center">
              <div class="col-12 col-sm-12 col-md-7">
                  <div class="heading">
                    <h3>Success Stories</h3>
                    <p>“SurveySensum provides us with a tool that allows us to manage the overall customer experience better, include the customer’s voice in every major decision, and ultimately make the lives of our customers better.”</p>
                  </div>
              </div>
              <div class="col-12 col-sm-12 col-md-5">
                  <div class="close-loop-nps-bg">
                    <img
                        src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/first-section.svg"
                        class="img-fluid" alt="SurveySensum"/>
                  </div>
              </div>
            </div>
          </div>
        </section>

        <section class="custom-post-section">
            <div class="container">

            <?php 
          $post_args = array(
              'posts_per_page' => -1,
              'post_type' => 'ebook',
              'orderby'   => 'meta_value',
              'order' => 'DESC',
          );
          $myposts = get_posts($post_args); ?>

              <div class="row categoryList">

                  <?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

                    <div class="col-12 col-md-4">
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
                          <div class="read-story">

                            <a href="<?php the_permalink(); ?>" class="cPost-arrow">

                              <span>Read More</span>

                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 33.2 21.7" style="enable-background:new 0 0 33.2 21.7;" xml:space="preserve">
                                <style type="text/css">
                                  .st0{fill:#004fd4;}
                                </style>
                                <polygon class="st0" points="33,10.8 22.2,0.1 19.4,2.9 25.3,8.8 0.1,8.8 0.1,12.8 25.3,12.8 19.4,18.7 22.2,21.6 33,10.9 
                                  32.9,10.8 "/>
                              </svg>

                            </a>

                          </div>
                        </div>
                      </div>
                    </div>

                  <?php endforeach; ?>

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




<?php get_footer(); ?>





