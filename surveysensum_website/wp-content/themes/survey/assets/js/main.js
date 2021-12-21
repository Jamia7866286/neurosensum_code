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
		//  scroll = $(window).scrollTop();
		//  const pricingCardsFixed = $('.scroll-fixedPrice');
		// var bottomCardPosition = $('.products.pricing-who-love');

		//  if (bottomCardPosition.length) {
		// 	var featureCardPosition = bottomCardPosition.offset().top - $(window).scrollTop() - 100;
		//  }

		//  if (scroll >= 1300 && featureCardPosition >= 300){ 
		//    pricingCardsFixed.addClass('desktop-sticky--active');
		//  }
		//  else {
		//    pricingCardsFixed.removeClass('desktop-sticky--active');
		//  }   

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
	//   $('.pricing-tab a').on('click', function (e) {
	// 	e.preventDefault();
	// 	e.stopPropagation();
	// 	$(this).tab('show');
	//   });


	//   collapse all & Single collapse pricing features data table
	
	// var coll = $('.feature-overview-table .all-table-collapse > table thead');
	//   $('.collapse-all').click(function(){
	// 	coll.addClass('active');
	//   });
	// var i;

	// for (i = 0; i < coll.length; i++) {
	// 	coll[i].addEventListener("click", function() {
	// 		this.classList.toggle("active");
	// 		var content = this.nextElementSibling;
	// 		if (content.style.maxHeight){
	// 			content.style.maxHeight = null;
	// 		} else {
	// 			content.style.maxHeight = content.scrollHeight + "px";
	// 		} 
	// 	});
	// }

	// Toggle pricing monthly & yearly plans
	// $('.save-money .togglex-btn input.slider').click(function(){
	// 	$(this).parents().eq(2).toggleClass('active');
	// });

	// $(".save-money .togglex-btn input:checkbox").on('click', function(){
	// 	$(this).parents().eq(1).toggleClass("active");
	//  });
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
	// $(document).ready(function(){
	// 	var data = {};

	// 	$('form #formsubmit').click((event)=>{
	// 		const submitButton = event.target;
	// 		const formElement = submitButton.parentNode.parentNode.parentNode;
	// 		// console.log(formElement);
	// 		const emailInput = formElement.querySelector('#Email');
	// 		const phonelInput = formElement.querySelector('#Phone');

	// 		data.email = emailInput?.value ?? '';
	// 		data.phone = phonelInput?.value ?? '';
			
	// 		if(data.email !== ''){
	// 			console.log(data);
	// 			var json = JSON.stringify(data);
	// 			console.log(json);
	// 		}
	// 		else{
	// 			console.log("Email input field is required, please try again!");
	// 		}
	// 	});

		
	// });



	// Pricing page js code
	jQuery(document).ready(function ($) {

		// All features toggle global variable for pricing page
		let bool = false;
		let expectingResponse = '250';
		let yearly = false;

		$('.see-feature-text').click(function () {

			if (bool) {
				$(".see-feature-text").removeClass("lessfeature");
				$(".see-feature-text span").html("View all features");
				$('.feature-content-list').addClass('active');
				bool = false;
			}
			else {
				$(".see-feature-text").addClass("lessfeature");
				$(".see-feature-text span").html("View less");
				$('.feature-content-list').removeClass('active');
				bool = true;
			}

		});


		// Static price and response
		function getResponseMapping() {
			return {
				50: {
					price: {
						monthly: 0,
						yearly: 0
					},
					response: 50,
					email: 1000
				},
				250: {
					price: {
						monthly: 61,
						yearly: 49
					},
					response: 250,
					email: 5000
				},
				750: {
					price: {
						monthly: 123.75,
						yearly: 99
					},
					response: 750,
					email: 15000
				},
				1500: {
					price: {
						monthly: 186.25,
						yearly: 149
					},
					response: 1500,
					email: 30000
				},
				2500: {
					price: {
						monthly: 248.75,
						yearly: 199
					},
					response: 2500,
					email: 50000
				},
				5000: {
					price: {
						monthly: 373.75,
						yearly: 299
					},
					response: 5000,
					email: 100000
				},
				7500: {
					price: {
						monthly: 498.75,
						yearly: 399
					},
					response: 7500,
					email: 150000
				},
				10000: {
					price: {
						monthly: 623.75,
						yearly: 499
					},
					response: 10000,
					email: 200000
				},
			}
		}

		// agex expression for comma like 10,000
		function numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}

		function createActiveResponseCircle(leftPosition){
			const activeResponeUl = document.querySelector('.active-response');
			activeResponeUl.style.left = leftPosition + 'px';
		}
		
		// Steps range slider
		document.querySelectorAll(".__range-step").forEach(function (ctrl) {
			var el = ctrl.querySelector('input');
			var output = ctrl.querySelector('output');
			const responseMapping = getResponseMapping();

			el.oninput = function () {
				// colorize step options
				ctrl.querySelectorAll("option").forEach(function (opt) {
					if ((opt.value == el.valueAsNumber)) {
						expectingResponse = opt.innerText;
						// opt.style.height = '34px';
						// opt.style.width = '34px';
						// opt.style.bottom = '18px';
						// opt.style.boxShadow = '0px 2px 6px #71717163';
						// opt.style.border = '1px solid #c1d7ff';
						// opt.style.transform = "translateX(-5px)";
						// opt.style.left = "5px";
						// opt.style.backgroundColor = '#fff';
						// opt.style.height = '6px';
						// opt.style.width = '6px';
						// opt.style.bottom = '3px';
						const responeMap = responseMapping[opt.innerText]
						$('.responses-text').html(numberWithCommas(responeMap.response));
						$('.email-text').html(numberWithCommas(responeMap.email));
						getPrice(responeMap);
						
						if(responeMap.response == 50){
							$('.price-right-main').addClass('free_plan');
						}
						else{
							$('.price-right-main').removeClass('free_plan');
						}

					}
					// else {
					// 	// opt.style.backgroundColor = '#fff';
					// 	// opt.style.height = '6px';
					// 	// opt.style.width = '6px';
					// 	// opt.style.bottom = '3px';
					// 	// opt.style.left = "-5px";
					// }

				});
				// colorize before and after
				var valPercent = (el.valueAsNumber - parseInt(el.min)) / (parseInt(el.max) - parseInt(el.min));
				var style = 'background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, color-stop(' +
					valPercent + ', #0B64FF), color-stop(' +
					valPercent + ', #DFE1E6));';
				el.style = style;

				// Popup
				if ((' ' + ctrl.className + ' ').indexOf(' ' + '__range-step-popup' + ' ') > -1) {
					var selectedOpt = ctrl.querySelector('option[value="' + el.value + '"]');
					output.innerText = numberWithCommas(selectedOpt.text) + " responses";
					output.style.left = "50%";
					const left = ((selectedOpt.offsetLeft + selectedOpt.offsetWidth / 2) - output.offsetWidth / 2);
					output.style.left = left + 'px';
					createActiveResponseCircle(left + 30);
				}
			};
			el.oninput();
		});

		window.onresize = function () {
			document.querySelectorAll(".__range").forEach(function (ctrl) {
				var el = ctrl.querySelector('input');
				el.oninput();
			});
		};



		// Switch toggle pricing page plans
		$('#toggle-plans input[type="checkbox"]').on('change', function () {
			const responseMappings = getResponseMapping();
			yearly = this.checked;
			const expectedResponseMapped = responseMappings[expectingResponse];

			if (this.checked) {
				$('.togglex-btn').addClass("active");
				getPrice(expectedResponseMapped, this.checked);

			} else {
				$('.togglex-btn').removeClass("active");
				getPrice(expectedResponseMapped, false);
			}
		});

		// on load price show method
		function getPrice(getPrice){
			if(yearly){
				$('.get-price.monthly').html(getPrice.price.yearly);
				$('.total-price-monthly').html("$" + numberWithCommas(getPrice.price.yearly * 12));
			}
			else{
				$('.get-price.monthly').html(getPrice.price.monthly);
				$('.total-price-monthly').html("$" + numberWithCommas(getPrice.price.monthly * 12));
			}
		}

	});


	// // New slider code steps pricing page js
	// (function ($, window, document, undefined) {
	// 	'use strict';

	// 	var jRange = function () {
	// 		return this.init.apply(this, arguments);
	// 	};
	// 	jRange.prototype = {
	// 		defaults: {
	// 			onstatechange: function () { },
	// 			ondragend: function () { },
	// 			onbarclicked: function () { },
	// 			isRange: false,
	// 			showLabels: true,
	// 			showScale: true,
	// 			step: 1,
	// 			format: '%s',
	// 			theme: 'theme-green',
	// 			disable: false,
	// 			snap: false
	// 		},
	// 		template: '<div class="slider-container">\
	// 			<div class="back-bar">\
	// 		<div class="selected-bar"></div>\
	// 		<div class="pointer low"></div><div class="pointer-label low">123456</div>\
	// 		<div class="pointer high"></div><div class="pointer-label high">456789</div>\
	// 		<div class="clickable-dummy"></div>\
	// 		</div>\
	// 		<div class="scale"></div>\
	// 		</div>',
	// 		init: function (node, options) {
	// 			this.options = $.extend({}, this.defaults, options);
	// 			this.inputNode = $(node);
	// 			this.options.value = this.inputNode.val() || (this.options.isRange ? this.options.from + ',' + this.options.from : '' + this.options.from);
	// 			this.domNode = $(this.template);
	// 			this.domNode.addClass(this.options.theme);
	// 			this.inputNode.after(this.domNode);
	// 			this.domNode.on('change', this.onChange);
	// 			this.pointers = $('.pointer', this.domNode);
	// 			this.lowPointer = this.pointers.first();
	// 			this.highPointer = this.pointers.last();
	// 			this.labels = $('.pointer-label', this.domNode);
	// 			this.lowLabel = this.labels.first();
	// 			this.highLabel = this.labels.last();
	// 			this.scale = $('.scale', this.domNode);
	// 			this.bar = $('.selected-bar', this.domNode);
	// 			this.clickableBar = this.domNode.find('.clickable-dummy');
	// 			this.interval = this.options.to - this.options.from;
	// 			this.render();
	// 		},
	// 		render: function () {
	// 			// Check if inputNode is visible, and have some width, so that we can set slider width accordingly.
	// 			if (this.inputNode.width() === 0 && !this.options.width) {
	// 				console.log('jRange : no width found, returning');
	// 				return;
	// 			} else {
	// 				this.options.width = this.options.width || this.inputNode.width();
	// 				this.domNode.width(this.options.width);
	// 				this.inputNode.hide();
	// 			}

	// 			if (this.isSingle()) {
	// 				this.lowPointer.hide();
	// 				this.lowLabel.hide();
	// 			}
	// 			if (!this.options.showLabels) {
	// 				this.labels.hide();
	// 			}
	// 			this.attachEvents();
	// 			if (this.options.showScale) {
	// 				this.renderScale();
	// 			}
	// 			this.setValue(this.options.value);
	// 		},
	// 		isSingle: function () {
	// 			if (typeof (this.options.value) === 'number') {
	// 				return true;
	// 			}
	// 			return (this.options.value.indexOf(',') !== -1 || this.options.isRange) ?
	// 				false : true;
	// 		},
	// 		attachEvents: function () {
	// 			this.clickableBar.click($.proxy(this.barClicked, this));
	// 			this.pointers.on('mousedown touchstart', $.proxy(this.onDragStart, this));
	// 			this.pointers.bind('dragstart', function (event) {
	// 				event.preventDefault();
	// 			});
	// 		},
	// 		onDragStart: function (e) {
	// 			if (this.options.disable || (e.type === 'mousedown' && e.which !== 1)) {
	// 				return;
	// 			}
	// 			e.stopPropagation();
	// 			e.preventDefault();
	// 			var pointer = $(e.target);
	// 			this.pointers.removeClass('last-active');
	// 			pointer.addClass('focused last-active');
	// 			this[(pointer.hasClass('low') ? 'low' : 'high') + 'Label'].addClass('focused');
	// 			$(document).on('mousemove.slider touchmove.slider', $.proxy(this.onDrag, this, pointer));
	// 			$(document).on('mouseup.slider touchend.slider touchcancel.slider', $.proxy(this.onDragEnd, this));
	// 		},
	// 		onDrag: function (pointer, e) {
	// 			e.stopPropagation();
	// 			e.preventDefault();

	// 			if (e.originalEvent.touches && e.originalEvent.touches.length) {
	// 				e = e.originalEvent.touches[0];
	// 			} else if (e.originalEvent.changedTouches && e.originalEvent.changedTouches.length) {
	// 				e = e.originalEvent.changedTouches[0];
	// 			}

	// 			var position = e.clientX - this.domNode.offset().left;
	// 			this.domNode.trigger('change', [this, pointer, position]);
	// 		},
	// 		onDragEnd: function (e) {
	// 			console.log(e);
	// 			this.pointers.removeClass('focused')
	// 				.trigger('rangeslideend');
	// 			this.labels.removeClass('focused');
	// 			$(document).off('.slider');
	// 			this.options.ondragend.call(this, this.options.value);
	// 		},
	// 		barClicked: function (e) {
	// 			if (this.options.disable) return;
	// 			var x = e.pageX - this.clickableBar.offset().left;
	// 			if (this.isSingle())
	// 				this.setPosition(this.pointers.last(), x, true, true);
	// 			else {
	// 				var firstLeft = Math.abs(parseFloat(this.pointers.first().css('left'), 10)),
	// 					firstHalfWidth = this.pointers.first().width() / 2,
	// 					lastLeft = Math.abs(parseFloat(this.pointers.last().css('left'), 10)),
	// 					lastHalfWidth = this.pointers.first().width() / 2,
	// 					leftSide = Math.abs(firstLeft - x + firstHalfWidth),
	// 					rightSide = Math.abs(lastLeft - x + lastHalfWidth),
	// 					pointer;

	// 				if (leftSide == rightSide) {
	// 					pointer = x < firstLeft ? this.pointers.first() : this.pointers.last();
	// 				} else {
	// 					pointer = leftSide < rightSide ? this.pointers.first() : this.pointers.last();
	// 				}
	// 				this.setPosition(pointer, x, true, true);
	// 			}
	// 			this.options.onbarclicked.call(this, this.options.value);
	// 		},
	// 		onChange: function (e, self, pointer, position) {
	// 			var min, max;
	// 			min = 0;
	// 			max = self.domNode.width();

	// 			if (!self.isSingle()) {
	// 				min = pointer.hasClass('high') ? parseFloat(self.lowPointer.css("left")) + (self.lowPointer.width() / 2) : 0;
	// 				max = pointer.hasClass('low') ? parseFloat(self.highPointer.css("left")) + (self.highPointer.width() / 2) : self.domNode.width();
	// 			}

	// 			var value = Math.min(Math.max(position, min), max);
	// 			self.setPosition(pointer, value, true);
	// 		},
	// 		setPosition: function (pointer, position, isPx, animate) {
	// 			var leftPos, rightPos,
	// 				lowPos = parseFloat(this.lowPointer.css("left")),
	// 				highPos = parseFloat(this.highPointer.css("left")) || 0,
	// 				circleWidth = this.highPointer.width() / 2;
	// 			if (!isPx) {
	// 				position = this.prcToPx(position);
	// 			}
	// 			if (this.options.snap) {
	// 				var expPos = this.correctPositionForSnap(position);
	// 				if (expPos === -1) {
	// 					return;
	// 				} else {
	// 					position = expPos;
	// 				}
	// 			}
	// 			if (pointer[0] === this.highPointer[0]) {
	// 				highPos = Math.round(position - circleWidth);
	// 			} else {
	// 				lowPos = Math.round(position - circleWidth);
	// 			}
	// 			pointer[animate ? 'animate' : 'css']({
	// 				'left': Math.round(position - circleWidth)
	// 			});
	// 			if (this.isSingle()) {
	// 				leftPos = 0;
	// 			} else {
	// 				leftPos = lowPos + circleWidth;
	// 				rightPos = highPos + circleWidth;
	// 			}
	// 			var w = Math.round(highPos + circleWidth - leftPos);
	// 			this.bar[animate ? 'animate' : 'css']({
	// 				'width': Math.abs(w),
	// 				'left': (w > 0) ? leftPos : leftPos + w
	// 			});
	// 			this.showPointerValue(pointer, position, animate);
	// 			this.isReadonly();
	// 		},
	// 		correctPositionForSnap: function (position) {
	// 			var currentValue = this.positionToValue(position) - this.options.from;
	// 			var diff = this.options.width / (this.interval / this.options.step),
	// 				expectedPosition = (currentValue / this.options.step) * diff;
	// 			if (position <= expectedPosition + diff / 2 && position >= expectedPosition - diff / 2) {
	// 				return expectedPosition;
	// 			} else {
	// 				return -1;
	// 			}
	// 		},
	// 		// will be called from outside
	// 		setValue: function (value) {
	// 			var values = value.toString().split(',');
	// 			values[0] = Math.min(Math.max(values[0], this.options.from), this.options.to) + '';
	// 			if (values.length > 1) {
	// 				values[1] = Math.min(Math.max(values[1], this.options.from), this.options.to) + '';
	// 			}
	// 			this.options.value = value;
	// 			var prc = this.valuesToPrc(values.length === 2 ? values : [0, values[0]]);
	// 			if (this.isSingle()) {
	// 				this.setPosition(this.highPointer, prc[1]);
	// 			} else {
	// 				this.setPosition(this.lowPointer, prc[0]);
	// 				this.setPosition(this.highPointer, prc[1]);
	// 			}
	// 		},
	// 		renderScale: function () {
	// 			var s = this.options.scale || [this.options.from, this.options.to];
	// 			var prc = Math.round((100 / (s.length - 1)) * 10) / 10;
	// 			var str = '';
	// 			for (var i = 0; i < s.length; i++) {
	// 				str += '<span style="left: ' + i * prc + '%">' + (s[i] != '|' ? '<ins>' + s[i] + '</ins>' : '') + '</span>';
	// 			}
	// 			this.scale.html(str);

	// 			$('ins', this.scale).each(function () {
	// 				$(this).css({
	// 					marginLeft: -$(this).outerWidth() / 2
	// 				});
	// 			});
	// 		},
	// 		getBarWidth: function () {
	// 			var values = this.options.value.split(',');
	// 			if (values.length > 1) {
	// 				return parseFloat(values[1]) - parseFloat(values[0]);
	// 			} else {
	// 				return parseFloat(values[0]);
	// 			}
	// 		},
	// 		showPointerValue: function (pointer, position, animate) {
	// 			var label = $('.pointer-label', this.domNode)[pointer.hasClass('low') ? 'first' : 'last']();
	// 			var text;
	// 			var value = this.positionToValue(position);
	// 			// Is it higer or lower than it should be?

	// 			if ($.isFunction(this.options.format)) {
	// 				var type = this.isSingle() ? undefined : (pointer.hasClass('low') ? 'low' : 'high');
	// 				text = this.options.format(value, type);
	// 			} else {
	// 				text = this.options.format.replace('%s', value);
	// 			}

	// 			var width = label.html(text).width(),
	// 				left = position - width / 2;
	// 			left = Math.min(Math.max(left, 0), this.options.width - width);
	// 			label[animate ? 'animate' : 'css']({
	// 				left: left
	// 			});
	// 			this.setInputValue(pointer, value);
	// 		},
	// 		valuesToPrc: function (values) {
	// 			var lowPrc = ((parseFloat(values[0]) - parseFloat(this.options.from)) * 100 / this.interval),
	// 				highPrc = ((parseFloat(values[1]) - parseFloat(this.options.from)) * 100 / this.interval);
	// 			return [lowPrc, highPrc];
	// 		},
	// 		prcToPx: function (prc) {
	// 			return (this.domNode.width() * prc) / 100;
	// 		},
	// 		isDecimal: function () {
	// 			return ((this.options.value + this.options.from + this.options.to).indexOf(".") === -1) ? false : true;
	// 		},
	// 		positionToValue: function (pos) {
	// 			var value = (pos / this.domNode.width()) * this.interval;
	// 			value = parseFloat(value, 10) + parseFloat(this.options.from, 10);
	// 			if (this.isDecimal()) {
	// 				var final = Math.round(Math.round(value / this.options.step) * this.options.step * 100) / 100;
	// 				if (final !== 0.0) {
	// 					final = '' + final;
	// 					if (final.indexOf(".") === -1) {
	// 						final = final + ".";
	// 					}
	// 					while (final.length - final.indexOf('.') < 3) {
	// 						final = final + "0";
	// 					}
	// 				} else {
	// 					final = "0.00";
	// 				}
	// 				return final;
	// 			} else {
	// 				return Math.round(value / this.options.step) * this.options.step;
	// 			}
	// 		},
	// 		setInputValue: function (pointer, v) {
	// 			// if(!isChanged) return;
	// 			if (this.isSingle()) {
	// 				this.options.value = v.toString();
	// 			} else {
	// 				var values = this.options.value.split(',');
	// 				if (pointer.hasClass('low')) {
	// 					this.options.value = v + ',' + values[1];
	// 				} else {
	// 					this.options.value = values[0] + ',' + v;
	// 				}
	// 			}
	// 			if (this.inputNode.val() !== this.options.value) {
	// 				this.inputNode.val(this.options.value)
	// 					.trigger('change');
	// 				this.options.onstatechange.call(this, this.options.value);
	// 			}
	// 		},
	// 		getValue: function () {
	// 			return this.options.value;
	// 		},
	// 		getOptions: function () {
	// 			return this.options;
	// 		},
	// 		getRange: function () {
	// 			return this.options.from + "," + this.options.to;
	// 		},
	// 		isReadonly: function () {
	// 			this.domNode.toggleClass('slider-readonly', this.options.disable);
	// 		},
	// 		disable: function () {
	// 			this.options.disable = true;
	// 			this.isReadonly();
	// 		},
	// 		enable: function () {
	// 			this.options.disable = false;
	// 			this.isReadonly();
	// 		},
	// 		toggleDisable: function () {
	// 			this.options.disable = !this.options.disable;
	// 			this.isReadonly();
	// 		},
	// 		updateRange: function (range, value) {
	// 			var values = range.toString().split(',');
	// 			this.interval = parseInt(values[1]) - parseInt(values[0]);
	// 			if (value) {
	// 				this.setValue(value);
	// 			} else {
	// 				this.setValue(this.getValue());
	// 			}
	// 		}
	// 	};

	// 	var pluginName = 'jRange';
	// 	// A really lightweight plugin wrapper around the constructor,
	// 	// preventing against multiple instantiations
	// 	$.fn[pluginName] = function (option) {
	// 		var args = arguments,
	// 			result;

	// 		this.each(function () {
	// 			var $this = $(this),
	// 				data = $.data(this, 'plugin_' + pluginName),
	// 				options = typeof option === 'object' && option;
	// 			if (!data) {
	// 				$this.data('plugin_' + pluginName, (data = new jRange(this, options)));
	// 				$(window).resize(function () {
	// 					data.setValue(data.getValue());
	// 				}); // Update slider position when window is resized to keep it in sync with scale
	// 			}
	// 			// if first argument is a string, call silimarly named function
	// 			// this gives flexibility to call functions of the plugin e.g.
	// 			//   - $('.dial').plugin('destroy');
	// 			//   - $('.dial').plugin('render', $('.new-child'));
	// 			if (typeof option === 'string') {
	// 				result = data[option].apply(data, Array.prototype.slice.call(args, 1));
	// 			}
	// 		});

	// 		// To enable plugin returns values
	// 		return result || this;
	// 	};

	// })(jQuery, window, document);
	// // End New slider code steps pricing page js


})(jQuery);




