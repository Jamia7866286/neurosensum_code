<?php
if (isset($_POST['submit'])) {
    $result = careerform();
  
   if ($result == 1) {
       wp_redirect(home_url('/success/'));exit();
   } else if ($result == 0) {
       wp_redirect(home_url('/failed/'));exit();
   }
}

get_header();
wp_enqueue_script('sumoselect');
wp_enqueue_script('validate');
add_action('wp_footer', 'san_scripts', 21);

function san_scripts() {
    ?>
    <script>
        jQuery('select').SumoSelect();
    </script>

<script>
    jQuery('element_to_pop_up').bPopup();
</script>
    <script >
       jQuery('.btn').click(function(){
        jQuery('.c-load').show();
      });
    jQuery(document).ready(function () {
        (function ($) {
            jQuery.validator.addMethod("defaultInvalid", function (value, element)
            {
                return !(element.value == element.defaultValue);
            });
            jQuery('#careerform').validate({
                rules: {
                    fname: {
                        defaultInvalid: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    fname: "Please enter your name",
                    email: {
                        required: "Please enter your email",
                        email: "Invalid email address"
                    },
                    phone: "Please enter your number",
                    // message: "Please enter your message",
                    fileupload: {
                        required: "Please upload your resume",
                        extension: "Only doc, docx or pdf allowed"
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    jQuery(element).parent('li').addClass('error');
                     jQuery('.c-load').hide();
                },
                unhighlight: function (element, errorClass, validClass) {
                    jQuery(element).parent('li').removeClass('error');
                },
            });
            jQuery("input[type=file]").each(function () {
                jQuery(this).rules("add", {
                    accept: "doc|pdf|docx",
                    messages: {
                        accept: "Only doc, docx or pdf allowed"
                    }
                });
            });

            jQuery("input[type=file]").focusin(function () {
                var crnt_value = jQuery(this).val();
                if (crnt_value != '') {
                     jQuery$(this).parent("li").children("label").fadeOut(800);
                }
            }).focusout(function () {
                var crnt_value = jQuery(this).val();
                if (crnt_value == '') {
                     jQuery(this).parent("li").children("label").fadeIn(800);
                }
            });

        })(jQuery);
    });


	function titleSearch(srh) { 
			//careerSearch(srh+'#key');

 var x = document.getElementById("location").value;
careerSearch(srh,x);
		}

function myFunction(){ 
//document.getElementById("search").value="";
var srch=document.getElementById("search").value;
 var x = document.getElementById("location").value;
careerSearch(srch,x);
}
	function careerSearch(key,slt) {
	
	  

        jQuery.ajax({
          type: "GET",
          data: {keyword: key,slt:slt},
          url: "<?php echo admin_url(); ?>admin-ajax.php?action=find_more_careers",
          beforeSend: function () {
 jQuery("#loading").show();
            jQuery("#video-load").show();
          },
          success: function (data) {
jQuery("#loading").hide();
            jQuery(".single_career").hide();
            jQuery(".btn_apply").hide();
            jQuery("#video-load").hide();
            jQuery("#video-out").html('');
            jQuery("#video-out").html(data);

     
            jQuery('html, body').animate({
                scrollTop: jQuery("#video-out").offset().top - 80
            }, 2000);

          }
        });
         

          }



</script>

<?php }


$result = ''; $success = '';

?>
    <div class="container inner_page_container template_career" id="successMsg"><div class="c-status1"  >
                    <?php echo $success; ?>
                </div>
        <h2 data-aos="fade-right"  data-aos-offset="300">Join our <span>fantastic team</span></h2>
        
        <div class="search_widget ">
            <form action="" method="" >
                <div class="col-md-6 ">
                    <div class="controller">
                      					<input type="text" id="search" name="search" placeholder="Search" onchange="titleSearch(this.value)" />

                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                </div>
            <?php   $argst= [
    'taxonomy'     => 'career-location',
    'parent'        => 0,
    'number'        => 10,
    'hide_empty'    => false           
];
$terms = get_terms( $argst);
if(!empty($terms)){
?>
			<div class="col-md-6">
				<div class=" controller">
					<select name="selected_location" id="location" class="form-control" onchange="myFunction()">
						<option value="">Location</option>
                                                <?php foreach ($terms as $term) { ?>
						<option class="level-0" value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option><?php } ?>
					</select>
					<i class="fa fa-map-marker" aria-hidden="true"></i>
				</div>
			</div><?php } ?>
            </form>
            
        </div>



    <div class="main-container container single_career" data-aos="fade-right"  data-aos-offset="300" id="post_<?php the_ID(); ?>" >
<div id="video-load">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post clearfix "  id="post-<?php the_ID(); ?>" >
               

                 <?php if ( has_post_thumbnail() ) { 
                        echo '<figure class="thumbnail">';
                        the_post_thumbnail(); 
                        echo '</figure>';
                    }?>
                <h6 class="post_date">Posted <?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></h6>
                 <h4>
                    <?php the_title();?>
                </h4>
                <ul class="location">
                    <?php 
                       $terms = get_the_terms( $post->ID , array( 'career-location') );
                        if($terms ){
                           foreach ( $terms as $term ) { ?>
                            <li><?php echo $term->name; ?></li>
                        <?php }
                            }
                        ?>
                </ul>

  

                    <p>Job Description:</p>  
                
               
                <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
               <!--  <div class="comments-section">
                    <?php //comments_template(); ?>
                </div> -->
            </div>
            <?php
            endwhile;
         endif; ?> 
 </div>

    </div>


    <button class="btn_apply video_popup"> Apply </button>

<div class="result_sec">
<div class="container">
<div class="result-outer">
  <div id="loading" style="display:none;">
    <img src="<?php echo get_template_directory_uri()?>/images/loader.gif" alt="" />
  </div>
  <div id="video-out"></div>

</div>    
</div>
  </div>

</div>


<!-- popup section -->
  <div id="popup" class="element_to_pop_up">

  <div class="container">
  <div class="career-popup">
    <h2>Apply Now</h2>

       <form name="careerform" method="post" id="careerform"  enctype="multipart/form-data" class="career-form">
        <ul>
            <li>
                <label for="fname"></label>
                <input id="fname" name="fname" type="text" placeholder="Name" required="">
            </li>
            <li>
                <label for="email"></label>
                <input id="email" name="email" type="email" placeholder="Email" required="">
            </li>
            <li>
                <label for="phone"></label>
                <input id="phone" name="phone" type="tel" placeholder="Phone" required="">
            </li>
            <li>
                <textarea id="textarea" placeholder="Message" name="subject"></textarea>
            </li>
        </ul>
        <div class="fileupload">
        <input type="file" name="fileupload"  id="fileupload"  required> <label for="fileupload"> Select a file to upload</label> <br/>
</div>
        <input name="submit" type="submit" value="submit" class="btn">
               <input type="hidden" name="action" value="careerform">
                <input type="hidden" name="job-title" value="<?php echo get_the_title()?>">
            <div class="c-load" style="display:none; text-align: center">
          <img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="loading">
        </div>
           </form>
<span class="button b-close"><i class="fa fa-times-circle"></i></span>
</div>
</div>

</div>
    <?php get_footer(); ?>	