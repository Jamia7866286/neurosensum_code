<?php
/*
  Template Name: Blog page
 */

get_header();
// wp_enqueue_script('swiper');

add_action('wp_footer', 'san_scripts', 21);

function san_scripts() {
    ?>
<script>

</script>

<?php }
?>






<?php get_footer(); ?>
