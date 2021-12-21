<?php 
	/*==============================================================
		Template Name: Request Demo
	   ==============================================================*/
	get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="request-demo-section full-bg" <?php if ( has_post_thumbnail() ) { ?> style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');" <?php } ?> >
    <div class="container">
        <?php if( get_field('logo') ): ?>
        <div class="row">
            <div class="col">
                <div class="logo">
                    <a href="<?php echo get_home_url(); ?>"><img src="<?php the_field('logo');?>" alt="<?php the_field('logo_alt_text');?>"></a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="content-center text-center">
            <?php the_content(); ?>
            <div class="custom-form">
                <p>30 Days Free Trial, No Credit Card Required.</p>
                <?php gravity_form(3, false, false, false, '', true, 25); ?>                
            </div>
            <div class="pptulink">
                <p><a href="https://www.surveysensum.com/privacy-policy/">Privacy policy</a> . <a href="https://www.surveysensum.com/terms-of-use/">Terms of use</a></p>
            </div>
        </div>
    </div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?>