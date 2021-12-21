<?php 

	/*==============================================================

		Template Name: Contact Us

	==============================================================*/

	get_header();?>

<?php  if(have_posts()) : the_post(); ?>

<!-- Contact Hero Section Start -->

<div class="contact-hero-section full-bg" <?php if ( has_post_thumbnail() ) { ?> style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');" <?php } ?>>

	<div class="container">

		<div class="row align-items-center">

			<div class="col-md-7">			

				<div class="left-content">

					<?php the_content();?>

				</div>				
			</div>

			<div class="col-md-5">

				<div class="custom-form">

					<h3>Contact Us</h3>

					<!-- <?php #gravity_form(1, false, false, false, '', true, 12); ?> -->
					<!--[if lte IE 8]>
					<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
					<![endif]-->


					<div class="contact-capcha-form">
					
						<!-- <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
						<script>
						hbspt.forms.create({
							region: "na1",
							portalId: "5773317",
							formId: "2773bbd6-c858-440b-9e42-fa6ff26a0b1e"
						});
						</script> -->

						<script src='https://crm.zoho.in/crm/WebFormServeServlet?rid=352c55ec96cbdf7d84d2272bd0e516a3609984fb91069e9b38a2b5d864c98cc4gid8c5a44735491abde9b3fadbeb4516583c356534e2bdc4d847ec7ffbccf95c3b6&script=$sYG'></script>
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<!-- Contact Hero Section End -->
<?php endif; ?>

<?php if( have_rows( 'image_section') ): while ( have_rows( 'image_section') ) : the_row();?>

<!-- Global Location Section Start -->

<div class="global-location section-spacer">

	<div class="container">

		<?php if( get_sub_field('section_title') ): ?>

		<div class="row">

			<div class="col">

				<div class="section-title">

					<?php the_sub_field('section_title');?>

				</div>

			</div>

		</div>

		<?php endif; ?>

		<?php if( get_sub_field('image') ): ?>

		<div class="row">

			<div class="col">

				<img src="<?php the_sub_field('image');?>" alt="<?php the_sub_field('image_alt_text');?>">

			</div>

		</div>

		<?php endif; ?>





		<?php if( have_rows( 'address_section') ): ?>

		<div class="address">

			<div class="row">

				<?php while ( have_rows( 'address_section') ) : the_row(); ?>

				<div class="col-md-6">

					<div class="item-single">

						<?php the_sub_field('address');?>

					</div>

				</div>

				<?php endwhile;?>

			</div>

		</div>

		<?php endif; ?>

	</div>

</div>

<!-- Global Location Section End -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>