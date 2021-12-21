<?php 

	/*==============================================================

		Template Name: Coming soon Page

	==============================================================*/

	get_header();
?>



<section class="section-spacer under-construction">
    <div class="container">
    	<div class="row">
            <div class="col-12">                
                <figure><img src="<?php echo get_option('home'); ?>/wp-content/uploads/2019/10/construction-image.png" alt="Error" /></figure>
                <h1>This webpage is under construction</h1>
                <ul style="list-style: none;text-align: center;padding: 12px 0 0;">
                  <li><a href="<?php echo get_option('home'); ?>/" class="btn btn-orange">Go to Home</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>