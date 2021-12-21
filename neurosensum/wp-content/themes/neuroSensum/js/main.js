// mobile menu
// jQuery('.navicon').on('click', function(e) {
//      jQuery('body').toggleClass('open-menu');
//     e.preventDefault();

// });



jQuery(document).ready(function() {
    jQuery('header nav ul > li.menu-item-has-children').prepend('<span class="sub-menu-icon fa fa-chevron-down trans"></span>');
    jQuery(function() {

        var pull = jQuery('#pull, .close-icon');
        menu = jQuery('nav > ul');
        menuHeight = menu.height();

        jQuery(pull).on('click', function(e) {
            e.preventDefault();
            menu.toggleClass('slide_menu');
            jQuery(".nav-icon").toggleClass('close');
        });

        jQuery(window).resize(function() {
            var w = jQuery(window).width();
            if (w > 300 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
    });
});


function bindMenuHover() {
    var w = jQuery(window).width();
    if (w > 1110) {
        jQuery("nav li").hover(function() {

            jQuery(this).children(".sub-menu").stop(true, true).slideDown("slide");

        }, function() {

            jQuery(this).children(".sub-menu").slideUp("slide");

        }
        );

    } else {
        jQuery("nav li").unbind('mouseenter mouseleave')
    }
}

jQuery(document).ready(function() {
    bindMenuHover();
    jQuery("nav li .sub-menu-icon").click(function(e) {
        jQuery(this).toggleClass("open");
        jQuery(this).parents('li').children(".sub-menu").stop().slideToggle();
        e.preventDefault();

    });


    jQuery(".sub-menu").hover(function() {
        jQuery(this).parents("li").find("a").addClass("navActive2");
        jQuery(this).children("li").find("a").removeClass("navActive2");
    },
            function() {
                jQuery(this).parents("li").find("a").removeClass("navActive2");
                jQuery(this).children("li").find("a").removeClass("navActive2");
            });

});

jQuery(window).resize(function() {
    bindMenuHover();
});










//===============================================
//bPopup

;(function($) {

 // DOM Ready
 jQuery(function() {

// Binding a click event
// From jQuery v.1.7.0 use .on() instead of .bind()
 jQuery('.video_popup').bind('click', function(e) {

// Prevents the default action to be triggered.
e.preventDefault();

// Triggering bPopup when click event is fired
 jQuery('#popup').bPopup();

});

});

})(jQuery);

jQuery(document).ready(function() {
    jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

  


});


jQuery(window).load(function() {
 var vid = jQuery("#block-video-bg video").get(0);
    //vid.pause();
    jQuery("#play").bind("click", function () {
        if (vid.paused) {
          vid.play();
          //jQuery("#play").removeClass('fa-play-circle-o');
        } else {
          vid.pause();
          //jQuery("#play").addClass('fa-play-circle-o');
        }
  });

});

//===================================
//Fixed header
//===================================

function fxHeader(){

var wnWdth = jQuery(window).width();
  if (wnWdth > 1000){
    jQuery(window).scroll(function() {
            var wnht = jQuery(window).height();
            var scroll = jQuery(window).scrollTop();

            if (scroll >= 100) {
                jQuery(".header_block").addClass("fixedHeader");
            } else {
                jQuery(".header_block").removeClass("fixedHeader");
            }

            if (scroll >= wnht) {
                jQuery(".header_block").addClass("scrollTop");
            } else {
                jQuery(".header_block").removeClass("scrollTop");
            }

        });

  }
}


fxHeader();
