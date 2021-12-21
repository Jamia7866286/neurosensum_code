<?php
get_header();
add_action('wp_footer', 'scripts', 25);
function scripts() {
    ?>
    <script type="text/javascript">
        $(document).ready(function(e) {
        });
    </script>
    <?php } ?>  

    <div class="inner_page_container container default_page " id="post_<?php the_ID(); ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post clearfix" id="post-<?php the_ID(); ?>">
                <div data-aos="fade-right" data-aos-offset="300" >
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
            endwhile;
         endif; ?> 

         <?php 
    $application_title = get_field('application_title');
    ?>
         <div class="application">
            <?php if ($application_title) {
                    ?>
                        <h3><?php echo $application_title; ?></h3>
                    <?php 
                }
             ?>

             <?php $cts_sec = get_field( "application_list" ); ?>
            <?php if($cts_sec){ ?>
       <ul>
         <?php foreach ($cts_sec as $service_list) { 
                            ?>
           <li>
                <div class="icon">
                    <img src="<?php echo  $service_list['application_icon']; ?>" alt="">
                </div>
                 
                            <?php if($service_list['application_item']) { echo '<span>' .$service_list['application_item']. '</span>' ; }?>
                            
                       
           </li>
            <?php }?>
       </ul>
            <?php }?>

        </div>
    </div>
    <?php get_footer(); ?>