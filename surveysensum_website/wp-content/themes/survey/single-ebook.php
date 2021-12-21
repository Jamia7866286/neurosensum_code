<?php
	get_header();?>



<div class="sections-container">


      <section class="manulife-intro ebook-banner">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-12 col-lg-7">
            <div class="manulife-name">Manulife Aset Manajemen Indonesia (MAMI)</div>
              <div class="how-question">
                <span><?php the_title(); ?></span>
                <img class="green-img" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/green-img.svg">
              </div>
              <div class="sign-up-free-home">
                <a class="btn btn-secondary-bg lg" target="_self" href="#downloadEbook">Download Ebook</a>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-5 for-mobile">
              <div class="interactive-image">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/Ebook-rafiki.svg">
              </div>
            </div>
          </div>
        </div>
      </section>


      <?php $cx_front_article = get_field('about_ebook_repeat_group'); ?>

        <section class="about-company-section section-spacing about-ebook" id="downloadEbook">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-12 col-md-12 col-lg-7">
                <div class="about-company-panel">
                    <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/green-img.svg">
                    <div class="section-heading">About the Ebook</div>
                    <div class="section-description"><?php echo $cx_front_article['about_ebook']; ?></div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-5">
                <div class="section-interactive-image crm-ebook">
                  <?php echo $cx_front_article['ebook_script_form_shortcode']; ?>
                </div>
              </div>
            </div>
          </div>
        </section>

</div>


<!-- Footer -->
<?php get_footer(); ?>




<!-- Ebook download js code -->
<script>
  jQuery(document).ready(function(){

    jQuery('.crm-ebook form #formsubmit').click(async function(){

      const lastName = jQuery('.crm-ebook form #Last_Name');
      const email = jQuery('.crm-ebook form #Email');
      const phone = jQuery('.crm-ebook form #Phone');

      if(lastName.val() && email.val() && phone.val()){
        const a = document.createElement('a');
        const url = document.querySelector('#LEADCF5').value;
        a.href = url;
        a.download = 'Ebook download.' + url.split('.').pop();
        a.click();
      }

    });

  });
</script>
