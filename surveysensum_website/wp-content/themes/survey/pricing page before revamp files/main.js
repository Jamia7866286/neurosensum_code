(function ($) {
	"use strict";
	/*==============================================================
	    Table of Contents
	================================================================
	01. Global Style
	    ├── Preloader
	    ├── Navigation
	    ├── Layout
	    ├── Colors
	    ├── Links
	    ├── Image
	    ├── Buttons
	    ├── Header
	    ├── Footer
	03. Home Page
	==============================================================*/


	/*==============================================================
    	01. Load Function
	==============================================================*/


	/*========================= Start with top =========================*/


	/*========================= Preloader =========================*/

	$(window).on("load", function () {

		$(".preloader").delay(200).fadeOut("slow");

	});


	/*========================= Customer Experience Left Section =========================*/

	/*

			if ($(window).width() > 767) {

				$(window).bind('scroll', function () {

					var currentTop = $(window).scrollTop();

					var elems = $('.scrollspy');

					elems.each(function (index) {

						var elemTop = $(this).offset().top - $('header').innerHeight() - 500;

						var elemBottom = elemTop + $(this).outerHeight();

						if (currentTop >= elemTop && currentTop <= elemBottom) {

							var id = $(this).attr('id');

							var navElem = $('a[href="#' + id + '"]');

							navElem.addClass('active').siblings().removeClass('active');

							$(this).addClass('active').siblings().removeClass('active');

						}

					})

				});

			

			

				var topofAffixSection = $("#customer-experience-section").offset().top - $('header').innerHeight() + 50;

				var endofAffixSection = $("#customer-experience-section").offset().top + $("#customer-experience-section .right-content").innerHeight() - $("#customer-experience-section .left-content-nav").innerHeight() - 50;

				$(window).scroll(function () {

			

					if ($(window).scrollTop() > topofAffixSection && $(window).scrollTop() < endofAffixSection) {

						$("#customer-experience-section").addClass("affix");

						$("#customer-experience-section").removeClass("bottom-affix");

					} else if ($(window).scrollTop() > endofAffixSection) {

						$("#customer-experience-section").removeClass("affix");

						$("#customer-experience-section").addClass("bottom-affix");

					} else if ($(window).scrollTop() < topofAffixSection) {

						$("#customer-experience-section").removeClass("affix");

						$("#customer-experience-section").removeClass("bottom-affix");

					}

				});

			

				$(document).ready(function () {

					$(".left-content-nav-container a").on('click', function (event) {

						handleScroll(this);

					});

			

					function handleScroll(e) {

						event.preventDefault();

						if (e.hash !== "") {

							var hash = e.hash;

							$('html, body').animate({

								scrollTop: $(hash).offset().top - 400

							}, 800);

						}

					}

				});





		}

	*/
	//});

	// 11-02-2020 Naseem js home page website
	// Mobile menu right side open
	$("#mySidenavmobile").click(function(){
	  $("#mySidenavmobile ~ .mobile-collapse").addClass('toggle');
	  $("body").addClass('mobile-nav-scroll');
	});
	
	$(".mobile-collapse .custom-collapse").click(function(){
	  $(".custom-collapse").parent().removeClass('toggle');
	  $("body").removeClass('mobile-nav-scroll');
	});
	// End Mobile menu right side open
	
	$(".mobile-collapse .custom-collapse").click(function(){
	  $(".custom-collapse").parent().removeClass('toggle');
	});

	// Carousal Customer who love
	$(".carousel-control-prev").click(function(){
		$("#customer_carousal").carousel("prev");
	});
	$(".carousel-control-next").click(function(){
		$("#customer_carousal").carousel('next');
	});
	// End Carousal Customer who love


	$(window).scroll(function(){
		// var sticky = $('header'),
	  
		// if (scroll >= 65) sticky.addClass('sticky-header');
		// else sticky.removeClass('sticky-header');
		if ($(this).scrollTop() > 1) {
			        $('header').addClass("sticky-header");
		} else {
			$('header').removeClass("sticky-header");
		}


		var nav = $('.content-nav');
		if (nav.length) {
		  var contentNav = nav.offset().top;
		}

		 // Pricnig cards fixed on scroll and fixed cards
		 scroll = $(window).scrollTop();
		 const pricingCardsFixed = $('.scroll-fixedPrice');
		var bottomCardPosition = $('.products.pricing-who-love');

		 if (bottomCardPosition.length) {
			var featureCardPosition = bottomCardPosition.offset().top - $(window).scrollTop() - 100;
		 }

		 if (scroll >= 1300 && featureCardPosition >= 300){ 
		   pricingCardsFixed.addClass('desktop-sticky--active');
		 }
		 else {
		   pricingCardsFixed.removeClass('desktop-sticky--active');
		 }   

		// if ($(this).scrollTop() > 1400 && $(this).scrollTop() < 2200) {
		// 	$('#carouselExampleIndicators').carousel({
		// 		// interval: 100,
		// 		// pause: "hover"
		// 		pause: true,
		// 		interval: 4000,
		// 	});
		// }
		// else{
		// 	$('#carouselExampleIndicators').carousel({
		// 		pause: false,
		// 		interval: false,
		// 	});
		// }
	});
	// End sticky header fixed on scroll

	// Pricing page tab
	  $('.pricing-tab a').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).tab('show');
	  });


	//   collapse all & Single collapse pricing features data table
	
	var coll = $('.feature-overview-table .all-table-collapse > table thead');
	  $('.collapse-all').click(function(){
		coll.addClass('active');
	  });
	var i;

	for (i = 0; i < coll.length; i++) {
		coll[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var content = this.nextElementSibling;
			if (content.style.maxHeight){
				content.style.maxHeight = null;
			} else {
				content.style.maxHeight = content.scrollHeight + "px";
			} 
		});
	}

	// Toggle pricing monthly & yearly plans
	// $('.save-money .togglex-btn input.slider').click(function(){
	// 	$(this).parents().eq(2).toggleClass('active');
	// });

	$(".save-money .togglex-btn input:checkbox").on('click', function(){
		$(this).parents().eq(1).toggleClass("active");
	 });
	// show All feature and less feature show for desktop and mobile
	// $('.see-all-feature.lg').click(function(){
	// 	$('.simple-plan').addClass('see-feature');
	// });
  
	// $('.see-less-feature.lg').click(function(){
	// 	$('.simple-plan').removeClass('see-feature');
	// });
  
	// Mobile feature cards show 
	// $(".pro-all").click(function() {
	// 	$('.simple-plan').addClass('mob-all-less-feature-pro');
	// 	$('.simple-plan').removeClass('mob-all-less-feature-prem');
	// 	$('.simple-plan').removeClass('mob-all-less-feature-star');
	// });
	// $('.pro-less').click(function(){
	// 	$('.simple-plan').removeClass('mob-all-less-feature-pro');
	// });
	
	// $(".prem-all").click(function() {
	// 	$('.simple-plan').addClass('mob-all-less-feature-prem');
	// 	$('.simple-plan').removeClass('mob-all-less-feature-pro');
	// 	$('.simple-plan').removeClass('mob-all-less-feature-star');
	// });
	// $('.prem-less').click(function(){
	// 	$('.simple-plan').removeClass('mob-all-less-feature-prem');
	// });
	
	
	// $(".star-all").click(function() {
	// 	$('.simple-plan').addClass('mob-all-less-feature-star');
	// 	$('.simple-plan').removeClass('mob-all-less-feature-prem');
	// 	$('.simple-plan').removeClass('mob-all-less-feature-pro');
	// });
	// $('.star-less').click(function(){
	// 	$('.simple-plan').removeClass('mob-all-less-feature-star');
	// });


	// Through leadership page 10-07-2020
	var iScrollHeight = $("#all-session-list");
	
	$('#top-sessions').on("click", function () {
		$('html,body').animate({ scrollTop: iScrollHeight.offset().top - 300 });
	});
  
  
	// 11-02-2020 End Naseem js home page website

    /* Header Fix */
    // $(window).scroll(function () {
    //     if ($(this).scrollTop() > 1) {
    //         $('header').addClass("sticky");
    //     } else {
    //         $('header').removeClass("sticky");
    //     }
    // });

	/*==============================================================

    	02. Ready Function

	==============================================================*/


	/*========================= Wrap Sub Menu in Div =========================*/

	$('.dropdown-menu').each(function () {

		$(this).find('li').wrapAll("<div class='dropdown-item-container'></div>");

	})

	/*========================= Navbar toggler style =========================*/

	$('.navbar-toggler').click(function () {

		$(this).toggleClass('active');

	})


	/*========================= Add Menu text on mobile =========================*/

	$('.navbar-nav').prepend('<div class="title">Menu</div>')


	/*========================= Remove Hash from Nav =========================*/

	$('.navbar-nav>li.menu-item-has-children>a').attr('href', 'javascript:void(0);');


	/*========================= Remove Title from Nav =========================*/

	$('.navbar-nav li>a').removeAttr('title');


	/*========================= Nice Select =========================*/


	$('#country_header,#country_footer').niceSelect();


	/*==============================================================

    	03. Scroll Function

	==============================================================*/


	/*========================= Platform Section =========================*/


	function setEqualHeight() {
		$('.platform-section .item-container').each(function () {
			var heightArray = [];
			var allbox = $(this).find(".content");
			$(allbox).each(function () {
				$(this).height(""); // remove previously set heights
				heightArray.push($(this).height());
			});
			var maxBoxHeight = Math.max.apply(Math, heightArray);
			$(this).find('.content').css('height', maxBoxHeight);
		});

	}


	$(function () {
		$(window).on('resize', setEqualHeight);
		$(window).on('orientationchange', setEqualHeight);
		setEqualHeight();
	});


	$('.sub-menu').wrap('<div class="sub-menu-container">');


	/*========================= Testimonial Section =========================*/


	$('.testimonial-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		focusOnSelect: false,
		responsive: [{
			breakpoint: 1024,
			settings: {
				arrows: false,
			}
		}, ]
	});


	/*========================= Search Bar Placeholder =========================*/

	$('.blog-header-inner .search-bar input[type=text]').attr('placeholder', 'Search...');


	$(".search-bar input[type=text]").on('focus blur', function () {
		$(this).closest('.search-bar').toggleClass('active');
	})


	$('.blog-header-inner .search-bar input[type=submit]').val('');


	/*$(".search-bar input[type=text]").on('focus blur', function(){

		$(this).closest('.search-bar').toggleClass('active');

   })*/


	$('.blog-header-inner .search-bar input[type=submit]').val('');

	/* $("body").niceScroll({
	autohidemode: "hidden",
	scrollspeed: 70,
    cursorborder: "0",

   }); */

	/*========================= Match Height =========================*/

	$('.post-single .post-content, .platform-section .item-single').matchHeight({});
	$('.latest-post .subscribe').matchHeight({
		target: $('.post .subscribe-post')
	});

	/*========================= NPS page =========================*/
	jQuery('.tabs .tab-links a').on('click', function (e) {
		var currentAttrValue = jQuery(this).attr('href');

		// Show/Hide Tabs
		jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

		// Change/remove current tab to active
		jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

		e.preventDefault();
	});

    
    /*========================= Subscribe Popup =========================*/

    $(document).on('blur', '.popup-container #input_9_1', function(e) {
        var userinput = $(this).val();
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
        if (!pattern.test(userinput)) {
            e.preventDefault;
            $(this).parents('.popup-container').addClass('invalid');
            $(this).parents('.popup-container').find('.status').html('<i class="fa fa-exclamation" aria-hidden="true"></i>');
        } else {
            //$(this).parents('.popup-container').addClass('valid');
            //$(this).parents('.popup-container').find('.status').html('1');
            //$(this).parents('.popup-container').find('.title').text('Thanks for Subscribing');
            //$(this).parents('.popup-container').find('.sub-title').text('Open your email to unlock the achievements you have received.');
        }

    });


    $(document).on('submit', '#gform_9', function(e) {
        var userinput = $('#input_9_1').val();
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
        if (!pattern.test(userinput)) {
            e.preventDefault;
            $(this).parents('.popup-container').addClass('invalid');
            $(this).parents('.popup-container').find('.status').html('<i class="fa fa-exclamation" aria-hidden="true"></i>');
        } else {
            //$(this).parents('.popup-container').addClass('valid');
            $(this).parents('.popup-container').find('.status').html('1');
            $(this).parents('.popup-container').find('.title').text('Thanks for Subscribing');
            $(this).parents('.popup-container').find('.sub-title').text('Open your email to unlock the achievements you have received.');
        }

    });


    

//****************** Blog single page post close bottom fixed  ***************

    $(document).on('click', '#close-popup', function() {
        $(this).parents('.popup-container').hide();
        $(this).parents('.popup-container').addClass('hide-popup');
    });
    



//**************** Add a class on body for scrolling header fixed top  ****************

	$(function(){
		if ($('.download-report').length) {
			$('body').addClass('download-report-active');
		} else {
			$('body').removeClass('download-report-active');
		}
	});
    
  
    
	$(function(){
		if ($('#ct-ultimate-gdpr-cookie-popup').is(":visible")) {
		$('body').addClass('cookie-popup-active');
		} else {
			$('body').removeClass('cookie-popup-active');
		}
	});
    
	$(document).on('click', '#ct-ultimate-gdpr-cookie-accept', function() {
		$('body').removeClass('cookie-popup-active');
	});

	// Shifted to Filter catagory to click view all sessions list
	$(".viewAllSessionFilter, #watchNowForm, #register_now_form_button, #watch_now_form_button").click(function (){
		$('html, body').animate(
			{ scrollTop: $(".viewAllSessionFilterList, #registerNowScroll").offset().top - 80 },
				100);
	});

	  //*********** through leadership upcoming & On-demnad event page fixed register button *************
            jQuery(window).scroll(function(){

			// scroll = jQuery(window).scrollTop();
			// var bannerHeight = $('.think-cx-hero.upcoming-event-main').height();
                  // const registerForm = jQuery('.register-form.fixed-watch-register');
                  // var keepLearningSubscribe = jQuery('#keep-learning-subscribe');

                  // if (keepLearningSubscribe.length) {
                  //       var featureCardPosition = keepLearningSubscribe.offset().top - jQuery(window).scrollTop();
                  // }

                  // if (scroll >= bannerHeight && featureCardPosition >= 300){ 
			// 	registerForm.addClass('RegisterFormFixed bottomscroll');
                  // }
                  // else {
                  //       registerForm.removeClass('RegisterFormFixed');
			// }   
			
			// if(scroll > keepLearningSubscribe.height()){
			// 	registerForm.css('position','absolute').removeClass('RegisterFormFixed');
			// }

            });
	   // End Through Leadership JS 13-08-2020
    




	//*********************  Problem in this code Naseem find out  *************************

	/*========================= Anchor Links =========================*/
	// $('a[href*=#]').click(function(e) {
	// 	if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') ||
	// 		location.hostname == this.hostname) {
	// 		const windowSize = $(window).width();
	// 		var target = $(this.hash);
	// 		target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	// 		if ($(window).width() < 991) {
	// 			if (target.length) {
	// 				e.preventDefault();
	// 				$('html,body').animate({
	// 					scrollTop: target.offset().top - 75
	// 				}, 500);
	// 			}
	// 		} else {
	// 			if (target.length) {
	// 				e.preventDefault();
	// 				$('html,body').animate({
	// 					scrollTop: target.offset().top - 100
	// 				}, 500);
	// 				return false;
	// 			}
	// 		}
	// 	}
	// });
	//*********************  End Problem in this code Naseem find out  ***********






	// get Email on pricing page email notification to the Admin

	$(document).ready(function(){


		var data = {};

		$('form #formsubmit').click((event)=>{
			const submitButton = event.target;
			const formElement = submitButton.parentNode.parentNode.parentNode;
			// console.log(formElement);
			const emailInput = formElement.querySelector('#Email');
			const phonelInput = formElement.querySelector('#Phone');

			data.email = emailInput?.value ?? '';
			data.phone = phonelInput?.value ?? '';
			
			if(data.email !== ''){
				console.log(data);
				var json = JSON.stringify(data);
				console.log(json);
			}
			else{
				console.log("Email input field is required, please try again!");
			}
		});

		
	});


})(jQuery);




