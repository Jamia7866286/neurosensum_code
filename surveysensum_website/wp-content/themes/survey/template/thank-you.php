<?php 

	/*==============================================================

		Template Name: Thank You

	   ==============================================================*/
get_header(); ?>
<?php #if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- <section class="thank-you-section full-bg" <?php #if ( has_post_thumbnail() ) { ?> style="background-image: url('<?php #echo get_the_post_thumbnail_url(); ?>');" <?php #} ?>>
    <div class="container">
        <?php #if( get_field('logo') ): ?>
        <div class="row">
            <div class="col">
                <div class="logo">
                    <a href="<?php #echo get_home_url(); ?>"><img src="<?php #the_field('logo');?>" alt="<?php #the_field('logo_alt_text');?>"></a>               
                </div>
            </div>
        </div>
        <?php #endif; ?>
        <div class="content-center">
            <div class="text-center">
               <?php #the_content();?>
            </div>
        </div>
    </div>
</section> -->


<?php #endwhile; endif; ?>

<div class="thank-you-page-main">
      <div class="surveysensum-logo">
        <a href="<?php echo site_url() ?>">
            <img src="<?php echo get_template_directory_uri()
 ?>/homepage_assets/img/svg/Surveysensum-logo.svg" class="img-fluid" alt="" />
        </a>
      </div>
      <div class="thank-you-page-inner">
        <div class="thank-you-image">
          <img src="<?php echo get_template_directory_uri()
 ?>/homepage_assets/img/svg/contact-us-thank-you.svg" class="img-fluid" alt="thank you image" />
        </div>
        <div class="thank-you-text">
          Thanks for Contacting Us
        </div>
        <div class="box-main">
          <div class="box"></div>
        </div>
        <div class="cx-experts-text">
          Our CX Experts will reach you as soon as Possible
        </div>
        <div class="homepage-btn-box">
          <a href="<?php echo site_url() ?>"
            class="homepage-btn btn-focus btn-btn"
            (click)="landONRegistraionPage()"
          >
            Visit Homepage
          </button>
        </div>
      </div>
      <div class="thank-you-page-footer"></div>
    </div>

<?php get_footer(); ?>