(function($){"use strict";$(window).on("load",function(){$(".preloader").delay(200).fadeOut("slow");});$(".navbar-toggler").click(function(){$(".navbar-toggler ~ .mobile-collapse").addClass('toggle');});$(".mobile-collapse .custom-collapse").click(function(){$(".custom-collapse").parent().removeClass('toggle');});$(".mobile-collapse .custom-collapse").click(function(){$(".custom-collapse").parent().removeClass('toggle');});$(".carousel-control-prev").click(function(){$("#customer_carousal").carousel("prev");});$(".carousel-control-next").click(function(){$("#customer_carousal").carousel('next');});$(window).scroll(function(){if($(this).scrollTop()>1){$('header').addClass("sticky-header");}else{$('header').removeClass("sticky-header");}});$('.dropdown-menu').each(function(){$(this).find('li').wrapAll("<div class='dropdown-item-container'></div>");})
$('.navbar-toggler').click(function(){$(this).toggleClass('active');})
$('.navbar-nav').prepend('<div class="title">Menu</div>')
$('.navbar-nav>li.menu-item-has-children>a').attr('href','javascript:void(0);');$('.navbar-nav li>a').removeAttr('title');$('#country_header,#country_footer').niceSelect();function setEqualHeight(){$('.platform-section .item-container').each(function(){var heightArray=[];var allbox=$(this).find(".content");$(allbox).each(function(){$(this).height("");heightArray.push($(this).height());});var maxBoxHeight=Math.max.apply(Math,heightArray);$(this).find('.content').css('height',maxBoxHeight);});}
$(function(){$(window).on('resize',setEqualHeight);$(window).on('orientationchange',setEqualHeight);setEqualHeight();});$('.sub-menu').wrap('<div class="sub-menu-container">');$('.testimonial-slider').slick({infinite:true,slidesToShow:1,slidesToScroll:1,arrows:true,focusOnSelect:false,responsive:[{breakpoint:1024,settings:{arrows:false,}},]});$('.blog-header-inner .search-bar input[type=text]').attr('placeholder','Search...');$(".search-bar input[type=text]").on('focus blur',function(){$(this).closest('.search-bar').toggleClass('active');})
$('.blog-header-inner .search-bar input[type=submit]').val('');$('.blog-header-inner .search-bar input[type=submit]').val('');$('.post-single .post-content, .platform-section .item-single').matchHeight({});$('.latest-post .subscribe').matchHeight({target:$('.post .subscribe-post')});jQuery('.tabs .tab-links a').on('click',function(e){var currentAttrValue=jQuery(this).attr('href');jQuery('.tabs '+currentAttrValue).show().siblings().hide();jQuery(this).parent('li').addClass('active').siblings().removeClass('active');e.preventDefault();});$('a[href*=#]').click(function(e){if(location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'')||location.hostname==this.hostname){const windowSize=$(window).width();var target=$(this.hash);target=target.length?target:$('[name='+this.hash.slice(1)+']');if($(window).width()<991){if(target.length){e.preventDefault();$('html,body').animate({scrollTop:target.offset().top-75},500);}}else{if(target.length){e.preventDefault();$('html,body').animate({scrollTop:target.offset().top-100},500);return false;}}}});$(document).on('blur','.popup-container #input_9_1',function(e){var userinput=$(this).val();var pattern=/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;if(!pattern.test(userinput)){e.preventDefault;$(this).parents('.popup-container').addClass('invalid');$(this).parents('.popup-container').find('.status').html('<i class="fa fa-exclamation" aria-hidden="true"></i>');}else{}});$(document).on('submit','#gform_9',function(e){var userinput=$('#input_9_1').val();var pattern=/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;if(!pattern.test(userinput)){e.preventDefault;$(this).parents('.popup-container').addClass('invalid');$(this).parents('.popup-container').find('.status').html('<i class="fa fa-exclamation" aria-hidden="true"></i>');}else{$(this).parents('.popup-container').find('.status').html('1');$(this).parents('.popup-container').find('.title').text('Thanks for Subscribing');$(this).parents('.popup-container').find('.sub-title').text('Open your email to unlock the achievements you have received.');}});$(document).on('click','#close-popup',function(){$(this).parents('.popup-container').hide();$(this).parents('.popup-container').addClass('hide-popup');});$(function(){if($('.download-report').length){$('body').addClass('download-report-active');}else{$('body').removeClass('download-report-active');}});$(function(){if($('#ct-ultimate-gdpr-cookie-popup').is(":visible")){$('body').addClass('cookie-popup-active');}else{$('body').removeClass('cookie-popup-active');}})
$(document).on('click','#ct-ultimate-gdpr-cookie-accept',function(){$('body').removeClass('cookie-popup-active');});})(jQuery);