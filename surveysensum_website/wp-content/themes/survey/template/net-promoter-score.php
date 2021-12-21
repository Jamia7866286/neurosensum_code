<?php 

	/*==============================================================

		Template Name: Net Promoter Score (Old Page With Custom field)

	==============================================================*/

	get_header();?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Promoter Hero Section Start -->
<section class="promoter-hero-section full-bg">
	<div class="container">
		<div class="row flex-column flex-md-row align-items-center justify-content-between">
        	<div class="left">
            	<?php the_content(); ?>
            </div>
			<div class="right">
            	<?php the_post_thumbnail() ?>
            </div>
		</div>
	</div>
</section>
<!-- Promoter Hero Section End -->

<!-- Multichannel Section Start -->
<section class="multichannel section-spacer">
	<div class="section-title">
        <div class="container">
        	<div class="row">
                <div class="col sec-head">
                     <?php the_field('multichannel_title') ?>
                </div>
            </div>
        </div>
    </div>    
    <?php if( have_rows( 'multichannel') ):?>    
        <div class="multichannel_outer">
        	<div class="container">
            	<div class="row item-container">
                    <ul>
					<?php $i=1; while ( have_rows( 'multichannel') ) : the_row(); ?>                    
                        <li class="item_<?php echo $i; ?>">
                            <div class="item_inner">
                                <figure><img src="<?php the_sub_field('icon');?>" alt="<?php the_sub_field('image_alt_text');?>"></figure>
                                <h2><?php the_sub_field('tilte');?></h2>                            
                            </div>
                        </li>                    
                    <?php $i++; endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>        
    <?php endif; ?>    
</section>
<!-- Multichannel Section End -->

<!-- Customer Act Section Start -->
<section class="customer-act section-spacer">
	<div class="section-title">
        <div class="container">
        	<div class="row">
                <div class="col sec-head">
                     <?php the_field('customer_title') ?>
                </div>
            </div>
        </div>
    </div>
    <?php if( have_rows( 'multichannel') ):?> 
    <div class="customer-tab d-none d-md-block">
    	<div class="container">
        	<div class="row">
            	<div class="tabs d-flex align-items-center justify-content-between">
                    <ul class="tab-links text-left">
                    <?php $tab=1; while ( have_rows( 'customer_tab') ) : the_row(); ?>
                        <li class="<?php if ($tab==1) {echo "active"; }?>"><a href="#tab<?php echo $tab; ?>"><?php the_sub_field('title');?></a></li>
                    <?php $tab++; endwhile; ?>
                    </ul>
                    <div class="tab-content">
                    <?php $tabimage=1; while ( have_rows( 'customer_tab') ) : the_row(); ?>
                    <div id="tab<?php echo $tabimage; ?>" class="tab <?php if ($tabimage==1) {echo "active"; }?>">
                            <img src="<?php the_sub_field('image');?>" alt="<?php the_sub_field('alt_text');?>" class="w-100"/>
                        </div>
                    <?php $tabimage++; endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php endif; ?>
    <?php if( have_rows( 'multichannel') ):?> 
    <div class="d-md-none customer">
        <?php while ( have_rows( 'customer_tab') ) : the_row(); ?>
        <div class="item-single">
            <div class="title-container d-flex align-items-center justify-content-center">
                <?php the_sub_field('title');?>
            </div>
            <div class="image-container">
                <img src="<?php the_sub_field('image');?>" alt="<?php the_sub_field('alt_text');?>" />
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</section>
<!-- Customer Act Section End -->

<!-- Automate the process Section Start -->
<section class="automate-process section-spacer">
	<div class="container">
    	<div class="row">
        	<div class="col">
            	<?php if(is_active_sidebar( 'automate_process')){ dynamic_sidebar( 'automate_process'); } ?>					
            </div>
        </div>
    </div>
</section>
<!-- Automate the process Section End -->

<!-- Get Insightable Section Start -->
<section class="get-insightable section-spacer">
	<div class="section-title">
        <div class="container">
        	<div class="row">
                <div class="col sec-head">
                     <?php the_field('get_insightable_title') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="image">
    	<div class="container">
        	<div class="row">
                <div class="col">
                     <img src="<?php the_field('get_insightable_image');?>" alt="<?php the_field('get_insightable_image_alt_text');?>" class="w-100">
                </div>
            </div>
        </div>
    </div>	
</section>
<!-- Get Insightable Section End -->



<!-- Net Promoter Score Section Start -->
<section class="net-promoter">
    <!-- Integrate software Section Start -->
    <section class="integrate-software">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="item-container">
                        <div class="shape-01"></div>
                        <div class="shape-02"></div>
                        <div class="shape-03"></div>
                        <div class="shape-04 d-md-none"></div>
                        <div class="section-title text-left">
                            <?php the_field('integrate_software_title') ?>
                        </div>
                        <?php if( have_rows( 'integrate_software') ):?> 
                        <ul class="list-inline mb-0">
                            <?php while ( have_rows( 'integrate_software') ) : the_row(); ?>
                            <li class="list-inline-item">
                                <a href="#"><img src="<?php the_sub_field('logos');?>" alt="<?php the_sub_field('image_alt_text');?>" class="w-100"></a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>   
                        <div class="bottom-content d-flex flex-column flex-column-reverse flex-md-row align-items-start align-items-md-center justify-content-between">
                            <?php the_field('integrate_software_bottom_content') ?>
                        </div>
                        <?php the_field('integrate_software_button') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Integrate software Section End -->
    <!-- Net Promoter Score Container Start -->
    <div class="net-promoter-container">
        <div class="container">
            <div class="row">
                <div class="col sec-head">
                    <?php the_field('net_promoter_score_title') ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="net-promoter-score-content">
                        <?php the_field('net_promotor_score_content') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Net Promoter Score Container End -->
</section>
<!-- Net Promoter Score Section End -->

<!-- Products Everyone Section Start -->
<section class="platform-section section-spacer">
    <div class="section-title">
        <div class="container">
            <div class="row">
                <div class="col sec-head">
                     <?php the_field('products_title') ?>
                </div>
            </div>
        </div>
    </div>
    <?php if( have_rows( 'products_item') ): ?>
    <div class="platform-outer">
        <div class="container">
            <div class="row item-container">
                <?php while ( have_rows( 'products_item') ) : the_row();?>
                <div class="col-md-4">
                    <div class="item-single">
                        <div class="icon">
                            <img src="<?php the_sub_field('icon') ?>" alt="<?php the_sub_field('icon_alt_text') ?>"/>
                        </div>
                        <h2><?php the_sub_field('title') ?></h2>
                        <div class="content">
                            <p><?php the_sub_field('content') ?></p>
                        </div>
                        <a href="<?php the_sub_field('button_link') ?>" class="btn btn-blue"><?php the_sub_field('button_text') ?></a>
                    </div>
                </div>            
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
<!-- Products Everyone Section End -->


<?php endwhile; endif; ?>

<?php get_footer(); ?>
