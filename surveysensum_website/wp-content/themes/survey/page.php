<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Vesalius Care
 * @since 1.0.0
 */

get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<section class="page section-spacer default-page">
    <div class="container">
    	<div class="row">
            <div class="col-12">
        	   <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
