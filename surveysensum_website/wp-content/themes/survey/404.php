<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header();
?>

<section class="section-spacer default-page error-404">
    <div class="container">
    	<div class="row">
            <div class="col-12">
        	   <?php if ( of_get_option('tile_error') && of_get_option('errot_content') ) { ?>
                    <h1><?php echo of_get_option('tile_error'); ?></h1>
                    <?php echo  of_get_option('errot_content'); ?>
               <?php } ?>
                <figure><img src="<?php echo get_option('home'); ?>/wp-content/uploads/2019/10/no-data-found.svg" alt="Error" /></figure>   
                <ul style="list-style: none;text-align: center;padding: 12px 0 0;">
                  <li><a href="<?php echo get_option('home'); ?>/" class="btn btn-orange">Take me home</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>