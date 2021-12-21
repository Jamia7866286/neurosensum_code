<?php
/*
  Template Name: Contact page
 */

get_header();
wp_enqueue_script('validate');
wp_enqueue_script('recaptcha');
wp_enqueue_script('canvas');

add_action('wp_footer', 'san_scripts', 21);
 
function san_scripts() {
    ?>
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_field("map_api_number")?>"></script>
    <script>
 var locations = [
        ['<?php echo get_field( "map_location_1_title" );  ?>', <?php echo get_field( "map_location_1_latitude" )  ?>,<?php echo get_field( "map_location_1_longitude" )  ?>],
    ['<?php echo get_field( "map_location_2_title" )  ?>',<?php echo get_field( "map_location_2_latitude" )  ?>,<?php echo get_field( "map_location_2_longitude" )  ?>],
    ['<?php echo get_field( "map_location_3_title" )  ?>',<?php echo get_field( "map_location_3_latitude" )  ?>,<?php echo get_field( "map_location_3_longitude" )  ?>]
  
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 3,
      zoomControl: false,
      scaleControl: false,
      mapTypeControl: false,
      streetViewControl: false,
      fullscreenControl: false,


      center: new google.maps.LatLng(34.4330979,46.8362323),
      styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}],

      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
       
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);

        }
      })(marker, i));
}


            //Contact Form

            (function (jQuery) {
                jQuery(document).ready(function () {

                    (function (jQuery) {

                        jQuery.validator.addMethod("defaultInvalid", function (value, element)
                        {
                            return !(element.value == element.defaultValue);
                        });
                        jQuery('#contactForm').validate({

                            rules: {
                                name: {
                                    defaultInvalid: true
                                },
                                email: {
                                    required: true,
                                    email: true
                                },

                            },

                            messages: {
                                name: "Please enter your name",
                                subject:"Please enter your subject",
                                message:"Please enter your message",
                                email: {
                                    required: "Please enter your email",
                                    email: "Invalid email address"
                                },
                            },
                            submitHandler: function (form) {

                                jQuery.ajax({
                                    type: "POST",
                                    url: '<?php echo admin_url(); ?>admin-ajax.php',
                                    data: jQuery('#contactForm').serialize(),
                                    beforeSend: function () {
                                        jQuery("input[name=submit]", form).attr('disabled', 'disabled');
                                        jQuery("div.c-load", form).show();
                                        jQuery("div.c-status", form).hide();
                                    },
                                       success: function (result) {

                                        if (result == 1 || result == '1') {
                                            jQuery("div.c-load", form).hide();
                                            jQuery("div.c-status").html('<span class="green">Thank You for your enquiry. We will contact you shortly.</span>');
                                            jQuery("div.c-status").show();

                                            setTimeout(function() {
                                                jQuery("div.c-status").hide();
                                                jQuery('#contactForm').trigger("reset");
                                                jQuery("input[name=submit]", form).removeAttr('disabled');
                                            }, 5000);

                                        }
                                        else if (result == 0 || result == '0') {
                                            jQuery("div.c-load", form).hide();
                                            jQuery("input[name=submit]", form).removeAttr('disabled');
                                            jQuery("div.c-status").html('<span class="red">Mail Sending failed</span>');
                                            jQuery("div.c-status").show();
                                        }
                                        else {
                                            jQuery("div.c-load", form).hide();
                                            jQuery("input[name=submit]", form).removeAttr('disabled');
                                            jQuery("div.c-status").html('<span class="red">' + result + '</span>');
                                            jQuery("div.c-status").show();
                                        }
                                    }
                                });
                            }
                        });
                        jQuery("#contactForm input, .textarea_box textarea").focusin(function () {
                            jQuery(this).parent("li").removeClass("error");
                        }).focusout(function () {
                            var crnt_value = jQuery(this).val();
                            if (crnt_value == '') {
                                // jQuery(this).parent("li").children("label").fadeIn(800);
                            }
                        });
                    })(jQuery);
                });
            })(jQuery);
      </script>

<?php }
?>




<div class="container template_contact inner_page_container" >
 <?php if(get_field('form_title1')){?> <h2 data-aos="fade-right"  data-aos-offset="300"><?php echo get_field('form_title1') ?></h2><?php } ?>

  <div class="form_widget">
    <div class="col-md-5">
      <?php $adderss = get_field('address');?>
      <?php foreach($adderss as $adderss){  ?>
          <?php if(!empty($adderss)) { ?>
                <div class="row location_widget " data-aos="fade-up"  data-aos-offset="300">
                  <h4><?php echo $adderss['country'] ;?></h4>
                  <p> <?php if ($adderss['phone']) { ?>  <a href="tel:<?php echo $adderss['phone'] ;?>">Call us <?php echo $adderss['phone'] ;?></a><br> <?php } ?>
				  <?php if ($adderss['email']) { ?> <a href="mailto:<?php echo $adderss['email'] ;?>"><?php echo $adderss['email'] ;?></a><br> <?php } ?>
                    <?php if ($adderss['address']) { ?><?php echo $adderss['address'] ;?><br> <?php } ?>
                    <?php if ($adderss['working_hrs']) { ?>Work hours:<?php echo $adderss['working_hrs'] ;?>  <?php } ?>
                  </p>
                </div>
          <?php }
      }?>
    </div>
    <div class="col-md-7" data-aos="fade-up"  data-aos-offset="400">
       <form name="contactForm" method="post" id="contactForm"  class="contact-form" enctype="multipart/form-data" >
        <ul>
          <li>
            <input type="text" name="fname" placeholder="Your Name" class="required">
          </li>
          <li>
            <input type="text" name="email" placeholder="Email" class="required">
          </li>
          <li>
            <input type="text" name="subject" placeholder="Write a Subject" class="required">
          </li>
          <li>
            <textarea name="message" placeholder="Message details" class="required"></textarea>
          </li>
          <li class="capcha">
            <div class="g-recaptcha" data-sitekey="<?php echo get_field('recaptcha_sitekey','option') ?>"></div>
          </li>
        </ul>
         <input type="submit" id="contact_submit" name="submit" class="btn_submit" value="SEND MESSAGE" />
         <input type="hidden" name="action" value="contactform">
         <div class="c-load" style="display:none; text-align: center">
         <img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="loading">
        
         </div>
         <div class="c-status" style="display:none;"></div>
      </form>
    </div>
  </div>

</div>










<?php get_footer(); ?>
