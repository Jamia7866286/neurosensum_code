jQuery(document).ready(function(a){var t=a(".ct-ultimate-gdpr-cookie-popup-oreo.ct-ultimate-gdpr-cookie-topPanel"),e=a(".ct-ultimate-gdpr-cookie-popup-oreo.ct-ultimate-gdpr-cookie-bottomPanel");if(t.add(e).length){function o(){if(1024<=a(window).width()){var t=jQuery("#ct-ultimate-gdpr-cookie-popup").outerHeight(),e=t;if(a("#ct-ultimate-gdpr-cookie-change-settings").length)e=t/2;a("#ct-ultimate-gdpr-cookie-accept, #ct-ultimate-gdpr-cookie-change-settings").css({height:e+"px","line-height":e+"px"})}else a("#ct-ultimate-gdpr-cookie-accept, #ct-ultimate-gdpr-cookie-change-settings").css({height:"52px","line-height":"normal"})}o(),a(window).resize(function(){o()})}function l(){jQuery("#ct-ultimate-gdpr-cookie-popup").hide(),jQuery(".ct-ultimate-gdpr-cookie-fullPanel-overlay").hide(),jQuery("#ct-ultimate-gdpr-cookie-open").show()}function i(t){var e=document.cookie;if(!e)return"";var o=e.match(new RegExp("(^| )"+t+"=([^;]+)"));return o?o[2]:void 0}function d(t){try{var e=ct_ultimate_gdpr_cookie.consent_expire_time,o={consent_level:t,consent_expire_time:e,consent_time:ct_ultimate_gdpr_cookie.consent_time,consent_declined:!1};o=btoa(JSON.stringify(o));var i=new Date(1e3*e).toUTCString();document.cookie="ct-ultimate-gdpr-cookie="+o+"; expires="+i+"; path=/"}catch(t){}}a(".ct-ultimate-gdpr-cookie-modal-btn.save").on("click",function(){a(this).parents("#ct-ultimate-gdpr-cookie-modal").hide()}),a(".ct-ultimate-gdpr-cookie-modal-compact #ct-ultimate-gdpr-cookie-modal-slider-item-block").on("click",function(){var t=jQuery(this).parents("form").next(),e=jQuery(".hide-btn-wrapper");t.is(":visible")&&t.slideUp(),e.is(":visible")&&e.slideUp()}),a(".ct-ultimate-gdpr-cookie-modal-compact .ct-ultimate-gdpr-cookie-modal-slider-item").not("#ct-ultimate-gdpr-cookie-modal-slider-item-block").on("click",function(){var t=jQuery(this).parents("form").next(),e=jQuery(".hide-btn-wrapper");t.is(":hidden")&&t.slideDown(),e.is(":hidden")&&e.slideDown()}),!function(){if(ct_ultimate_gdpr_cookie.consent)return!0;var t=i("ct-ultimate-gdpr-cookie");if(t&&-1!==t.indexOf("consent"))return!(document.cookie="ct-ultimate-gdpr-cookie=; expires=Thu, 01 Jan 1970 00:00:01 GMT;");var e=t?JSON.parse(atob(decodeURIComponent(t))):{};return e.consent_expire_time?e.consent_expire_time>+new Date/1e3:!!e.expire_time&&e.expire_time>+new Date/1e3}()?(jQuery("#ct-ultimate-gdpr-cookie-popup").show(),a("body").removeClass("ct-ultimate-gdpr-cookie-bottomPanel-padding"),a("body").removeClass("ct-ultimate-gdpr-cookie-topPanel-padding")):l(),a("#ct-ultimate-gdpr-cookie-accept").bind("click",function(){var t=ct_ultimate_gdpr_cookie.consent_accept_level,e=a(".ct-ultimate-gdpr-shortcode-protection").attr("data-level"),o=a(this);if(d(t),jQuery(".ct-ultimate-gdpr-cookie-modal-content input[data-count="+t+"]").trigger("click"),jQuery.post(ct_ultimate_gdpr_cookie.ajaxurl,{action:"ct_ultimate_gdpr_cookie_consent_give",level:t},function(){"ct-ultimate-cookie-close-modal"!=o.attr("id")&&ct_ultimate_gdpr_cookie.reload&&window.location.reload(!0)}).fail(function(){jQuery.post(ct_ultimate_gdpr_cookie.ajaxurl,{skip_cookies:!0,action:"ct_ultimate_gdpr_cookie_consent_give",level:t},function(){"ct-ultimate-cookie-close-modal"!=o.attr("id")&&ct_ultimate_gdpr_cookie.reload&&window.location.reload(!0)})}),!ct_ultimate_gdpr_cookie.reload&&(l(),e<=t)){a(".ct-ultimate-gdpr-shortcode-protection").removeClass("blur"),a("span.ct-ultimate-gdpr-shortcode-protection-label").remove();var i=a("div.ct-ultimate-gdpr-shortcode-protection").text(),c=a.base64.decode(i);a(".ct-ultimate-gdpr-shortcode-protection").html(c)}if(a("body").removeClass("ct-ultimate-gdpr-cookie-bottomPanel-padding"),a("body").removeClass("ct-ultimate-gdpr-cookie-topPanel-padding"),e<=t){a(".ct-ultimate-gdpr-shortcode-protection").removeClass("blur"),a("span.ct-ultimate-gdpr-shortcode-protection-label").remove();i=a("div.ct-ultimate-gdpr-shortcode-protection").text(),c=a.base64.decode(i);a(".ct-ultimate-gdpr-shortcode-protection").html(c)}}),a("#ct-ultimate-cookie-close-modal").bind("click",function(t){t.preventDefault();var e=ct_ultimate_gdpr_cookie.consent_default_level;jQuery.post(ct_ultimate_gdpr_cookie.ajaxurl,{action:"ct_gdpr_consent_popup_close",level:e,ct_ultimate_gdpr_button_close:"1"},function(){ct_ultimate_gdpr_cookie.reload&&window.location.reload(!0)}),jQuery("#ct-ultimate-gdpr-cookie-popup").hide(),jQuery(".ct-ultimate-gdpr-cookie-fullPanel-overlay").hide()}),a("#ct-ultimate-gdpr-cookie-read-more").bind("click",function(){ct_ultimate_gdpr_cookie&&ct_ultimate_gdpr_cookie.readurl&&("off"==ct_ultimate_gdpr_cookie.readurl_new_tab?window.location.href=ct_ultimate_gdpr_cookie.readurl:window.open(ct_ultimate_gdpr_cookie.readurl,"_blank"))}),a(".ct-ultimate-gdpr-cookie-modal-btn.save").bind("click",function(t){t.preventDefault();var e=a(".ct-ultimate-gdpr-cookie-modal-slider-item--active input").val(),o=a(".ct-ultimate-gdpr-shortcode-protection").attr("data-level");if(document.cookie="ct-ultimate-gdpr-cookie=;expires=Thu, 01 Jan 1970 00:00:01 GMT;",jQuery.post(ct_ultimate_gdpr_cookie.ajaxurl,{action:"ct_ultimate_gdpr_cookie_consent_give",level:e},function(){ct_ultimate_gdpr_cookie.reload&&window.location.reload(!0)}).fail(function(){jQuery.post(ct_ultimate_gdpr_cookie.ajaxurl,{skip_cookies:!0,action:"ct_ultimate_gdpr_cookie_consent_give",level:e},function(){d(e),ct_ultimate_gdpr_cookie.reload&&window.location.reload(!0)})}),!ct_ultimate_gdpr_cookie.reload&&(jQuery("#ct-ultimate-gdpr-cookie-modal").hide(),jQuery("#ct-ultimate-gdpr-cookie-open").show(),l(),o<=e)){a(".ct-ultimate-gdpr-shortcode-protection").removeClass("blur"),a("span.ct-ultimate-gdpr-shortcode-protection-label").remove();var i=a("div.ct-ultimate-gdpr-shortcode-protection").text(),c=a.base64.decode(i);a(".ct-ultimate-gdpr-shortcode-protection").html(c)}if(a("body").removeClass("ct-ultimate-gdpr-cookie-bottomPanel-padding"),a("body").removeClass("ct-ultimate-gdpr-cookie-topPanel-padding"),a("html").removeClass("cookie-modal-open"),a("body").removeClass("cookie-modal-open"),o<=e){a(".ct-ultimate-gdpr-shortcode-protection").removeClass("blur"),a("span.ct-ultimate-gdpr-shortcode-protection-label").remove();i=a("div.ct-ultimate-gdpr-shortcode-protection").text(),c=a.base64.decode(i);a(".ct-ultimate-gdpr-shortcode-protection").html(c)}}),a("#ct-ultimate-gdpr-cookie-open,#ct-ultimate-gdpr-cookie-change-settings,.ct-ultimate-triggler-modal-sc").on("click",function(t){var e=a("body");a("#ct-ultimate-gdpr-cookie-modal").show(),a(".ct-ultimate-gdpr-cookie-modal-slider-item.ct-ultimate-gdpr-cookie-modal-slider-item--active").trigger("click"),e.addClass("cookie-modal-open"),a("html").addClass("cookie-modal-open"),t.stopPropagation();var o=a("#ct-ultimate-gdpr-cookie-modal-slider-form").attr("class"),i=o.substr(o.length-1);a(".ct-ultimate-gdpr-cookie-modal-slider li:nth-child("+i+")").addClass("ct-ultimate-gdpr-cookie-modal-slider-item--active")}),a("#ct-ultimate-gdpr-cookie-modal-close,#ct-ultimate-gdpr-cookie-modal-compact-close").on("click",function(){var t=a("body");a("#ct-ultimate-gdpr-cookie-modal").hide(),t.removeClass("cookie-modal-open"),a("html").removeClass("cookie-modal-open")}),a("#ct-ultimate-gdpr-cookie-modal").on("click",function(t){if(!a(t.target).closest("#ct-ultimate-gdpr-cookie-change-settings, .ct-ultimate-gdpr-cookie-modal-content").length){var e=a("body");a("#ct-ultimate-gdpr-cookie-modal").hide(),e.removeClass("cookie-modal-open"),a("html").removeClass("cookie-modal-open")}t.stopPropagation()}),jQuery("img.ct-svg").each(function(){var o=jQuery(this),i=o.attr("id"),c=o.attr("class"),t=o.attr("src");jQuery.get(t,function(t){var e=jQuery(t).find("svg");void 0!==i&&(e=e.attr("id",i)),void 0!==c&&(e=e.attr("class",c+" replaced-svg")),!(e=e.removeAttr("xmlns:a")).attr("viewBox")&&e.attr("height")&&e.attr("width")&&e.attr("viewBox","0 0 "+e.attr("height")+" "+e.attr("width")),o.replaceWith(e)},"xml")}),a(window).on("load",function(){var t=a(".ct-ultimate-gdpr-cookie-modal-slider-item--active"),e=t.find("input"),o=(e.attr("id"),e.attr("data-count"));t.find("path").css("fill","#82aa3b"),t.prevUntil("#ct-ultimate-gdpr-cookie-modal-slider-item-block").addClass("ct-ultimate-gdpr-cookie-modal-slider-item--selected"),e.parent().prevUntil("#ct-ultimate-gdpr-cookie-modal-slider-item-block").find("path").css("fill","#82aa3b"),a("#ct-ultimate-gdpr-cookie-modal-slider-form").attr("class","ct-slider-cookie"+o),a(".ct-ultimate-gdpr-cookie-modal-slider-info.cookie_"+o).css("display","block"),1==i("ct-ultimate-gdpr-cookie-popup")&&(jQuery("#ct-ultimate-gdpr-cookie-popup").hide(),jQuery(".ct-ultimate-gdpr-cookie-fullPanel-overlay").hide())}),a(".ct-ultimate-gdpr-cookie-modal-slider").each(function(){var c=a(".ct-ultimate-gdpr-cookie-modal-slider-item").click(function(){var t=a(this).find("input").attr("id");a(".tab").removeClass("ct-ultimate-gdpr-cookie-modal-active-tab"),a(".tab."+t).addClass("ct-ultimate-gdpr-cookie-modal-active-tab");var e=a("."+t);e.show();a("#ct-ultimate-gdpr-cookie-modal-slider-form");var o=a("div#ct-ultimate-gdpr-cookie-modal-body"),i=a(this).find("input").attr("data-count");a("#ct-ultimate-gdpr-cookie-modal-slider-form").attr("class","ct-slider-cookie"+i),a(".ct-ultimate-gdpr-cookie-modal-slider-wrap .ct-ultimate-gdpr-cookie-modal-slider-info").not(e).hide(),c.removeClass("ct-ultimate-gdpr-cookie-modal-slider-item--active"),a(this).addClass("ct-ultimate-gdpr-cookie-modal-slider-item--active"),a(this).prevUntil("#ct-ultimate-gdpr-cookie-modal-slider-item-block").find("path").css("fill","#82aa3b"),a(this).prevUntil("#ct-ultimate-gdpr-cookie-modal-slider-item-block").addClass("ct-ultimate-gdpr-cookie-modal-slider-item--selected"),a(this).find("path").css("fill","#82aa3b"),a(this).nextAll().find("path").css("fill","#595959"),a(this).removeClass("ct-ultimate-gdpr-cookie-modal-slider-item--selected"),a(this).nextAll().removeClass("ct-ultimate-gdpr-cookie-modal-slider-item--selected"),"ct-ultimate-gdpr-cookie-modal-slider-item-block"===a(this).attr("id")?(o.addClass("ct-ultimate-gdpr-slider-block"),o.removeClass("ct-ultimate-gdpr-slider-not-block")):(o.removeClass("ct-ultimate-gdpr-slider-block"),o.addClass("ct-ultimate-gdpr-slider-not-block"))})}),a(".hide-btn").on("click",function(){var t=a(".ct-ultimate-gdpr-cookie-modal-slider-wrap"),e=jQuery(this).find("span");t.is(":hidden")?(e.removeClass("fa-chevron-down"),e.addClass("fa-chevron-up")):(e.removeClass("fa-chevron-up"),e.addClass("fa-chevron-down")),t.slideToggle()}),a(".cookie-modal-tab-wrapper li").on("click",function(){var t=jQuery(this),e="";t.hasClass("cookie0")?e="cookie0":t.hasClass("cookie1")?e="cookie1":t.hasClass("cookie2")?e="cookie2":t.hasClass("cookie3")?e="cookie3":t.hasClass("cookie4")&&(e="cookie4"),jQuery("#ct-ultimate-gdpr-cookie-modal-slider-form").find("#"+e).parent().click()}),a("#ct-ultimate-gdpr-cookie-popup").hasClass("ct-ultimate-gdpr-cookie-topPanel")&&(ct_ultimate_gdpr_cookie.consent||a("body").addClass("ct-ultimate-gdpr-cookie-topPanel-padding")),a("#ct-ultimate-gdpr-cookie-popup").hasClass("ct-ultimate-gdpr-cookie-bottomPanel")&&(ct_ultimate_gdpr_cookie.consent||a("body").addClass("ct-ultimate-gdpr-cookie-bottomPanel-padding")),a("#ct-ultimate-gdpr-cookie-popup").hasClass("ct-ultimate-gdpr-cookie-topPanel ct-ultimate-gdpr-cookie-popup-modern")&&a("body").addClass("popup-modern-style"),a("#ct-ultimate-gdpr-cookie-popup").hasClass("ct-ultimate-gdpr-cookie-bottomPanel ct-ultimate-gdpr-cookie-popup-modern")&&a("body").addClass("popup-modern-style")});