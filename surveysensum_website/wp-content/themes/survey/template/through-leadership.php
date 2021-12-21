<?php 
   /*==============================================================
   
   	Template Name: Through Leadership
   
   ==============================================================*/
   
   get_header();?>


<?php
// $think_cx_hero_section = get_field('think_cx_hero_section_top_2');
$think_cx_hero_section = get_field('think_cx_hero_section_top');

$image = $think_cx_hero_section['hero_image']['url'];
$go_live_image = $think_cx_hero_section['go_live_image']['url'];
$live_subtitle = $think_cx_hero_section['go_live_subtitle'];
$episode = $think_cx_hero_section['number_of_episode'];
$watchNow_upcoming_url = $think_cx_hero_section['watch_now_upcoming_event_url'];
$survey_link = $think_cx_hero_section['survey_link'];

// $through_leadership_filter_category_menu = get_field('through_leadership_filter_category_menu');
// echo var_dump($through_leadership_filter_category_menu);
$contents = '';
// $search = $_GET['search'];
// if($search){
//   $contents = $wpdb->get_results( 'select * from contents where title = '.$search);
// }else{
//   $contents = $wpdb->get_results('select * from contents');
// }



if( $think_cx_hero_section ): ?>
    <!-- leadership think cx hero section 1 -->
    <section class="think-cx-hero main-cx">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading think-cx-heading">
             <h2>The Experience Talk</h2>
             <p>Inspiring Customer Experience stories from around the world</p>

              <div class="view-session-watch register-upcoming-btn">
                  <div class="all-session-btn">
                        <a class="btn btn-secondary lg viewAllSessionFilter">View All Sessions</a>
                  </div>
              </div>

              <div class="live-session register-upcoming-btn">
                <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/Live-badge.svg" alt="surveySensum">  
              </div>
               
            </div>
          </div>
        </div>
      </div>
      <div class="hero-banner-image">
        <img src="<?php echo $image?>" alt="">
      </div>
    </section>
<?php endif; ?>


    <section class="propose-survey">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="propose-btn-main">
              <div class="propose-text">Have an inspiring CX story?<span> Propose a session to share with the world!</span></div>
              <a class="btn btn-outline-secondary sm" href="<?php echo $survey_link ;?>" target="_blank">Propose a Session</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="our-clients platform-app">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="clients">
              <h4 class="text-center font-weight-bold">
                Now streaming on your favourite platforms
              </h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="clients-brand">
              <div class="software-used d-flex justify-content-center flex-wrap">
                <div class="brand-logo d-flex align-items-center">
                  <img src="<?php echo get_template_directory_uri()
                           ?>/homepage_assets/img/Spotify_Logo_RGB_Green.png" class="img-fluid" alt="">
                </div>
                <div class="brand-logo d-flex align-items-center">
                  <img src="<?php echo get_template_directory_uri()
                           ?>/homepage_assets/img/yt_logo_rgb_light.png" class="img-fluid" alt="">
                </div>
                <div class="brand-logo d-flex align-items-center">
                  <img src="<?php echo get_template_directory_uri()
                           ?>/homepage_assets/img/svg/apple-podcast.svg" class="img-fluid" alt="">
                </div>
                <div class="brand-logo d-flex align-items-center">
                  <img src="<?php echo get_template_directory_uri()
                           ?>/homepage_assets/img/SoundCloud_logo.png" class="img-fluid" alt="">
                </div>
                <div class="brand-logo d-flex align-items-center">
                  <img src="<?php echo get_template_directory_uri()
                           ?>/homepage_assets/img/svg/EN_Google_Podcasts_Badge.svg" class="img-fluid" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->


    <section class="upcoming-demand-card">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="filter-catagory viewAllSessionFilterList">
                <?php #if(is_active_sidebar( 'session_search')){ dynamic_sidebar( 'session_search'); } ?>
                <div class="filter-content">

                  <?php 
                    $categories = get_the_category();
                    $index = 0;
                  ?>
                  <ul>
                    
                    <?php foreach ( $categories as $cat ) { ?>
                      
                      <li id="cat-<?php echo $cat->term_id; ?>" class="<?php if($cat->name=='Featured'): echo 'active' ?><?php endif; ?>">
                        <a class="filter-data <?php echo $index==0?'active':$cat->slug; ?>" data-cat="<?php echo $cat->name; ?>" href="javascript:void(0)"><?php echo $cat->name; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="11.844" height="5.922" viewBox="0 0 11.844 5.922">
                              <path style="fill:#02193b;stroke:#02193b;opacity:0.87;" d="M16625,14727l4.715,4.715,4.715-4.715Z" transform="translate(-16623.793 -14726.5)"/>
                            </svg>
                        </a>
                      </li>
                    <?php $index = $index+1;} ?>
                  </ul>

                  <div class="search-bar">

                    <div class="search-bar-inner">
                    <form method="post" name="searchForm" id="searchForm">
                      <input type="text" placeholder="Enter keyword to search " id="searchValue" name="search" class="input">
                      <svg id="searchIcon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28" height="28" viewBox="0 0 28 28">
                        <defs><style>.a{fill:#fff;stroke:#707070;}.b{opacity:0.997;clip-path:url(#a);}.c{opacity:0.87;}.d{fill:none;}.e{fill:#02193b;}</style>
                        <clipPath id="a"><circle class="a" cx="14" cy="14" r="14" transform="translate(1088 155)"/></clipPath></defs><g class="b" transform="translate(-1088 -155)"><g class="c" transform="translate(1088 155)"><path class="d" d="M0,0H28V28H0Z"/><path class="e" d="M19.083,17.333h-.922l-.327-.315a7.6,7.6,0,1,0-.817.817l.315.327v.922l4.958,4.958A1.229,1.229,0,0,0,24.03,22.3Zm-7,0a5.25,5.25,0,1,1,5.25-5.25A5.243,5.243,0,0,1,12.083,17.333Z" transform="translate(-1 -1)"/></g></g>
                      </svg>

                      <svg id="searchMobile" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28" height="28" viewBox="0 0 28 28">
                        <defs><style>.a{fill:#fff;stroke:#707070;}.b{opacity:0.997;clip-path:url(#a);}.c{opacity:0.87;}.d{fill:none;}.e{fill:#02193b;}</style>
                        <clipPath id="a"><circle class="a" cx="14" cy="14" r="14" transform="translate(1088 155)"/></clipPath></defs><g class="b" transform="translate(-1088 -155)"><g class="c" transform="translate(1088 155)"><path class="d" d="M0,0H28V28H0Z"/><path class="e" d="M19.083,17.333h-.922l-.327-.315a7.6,7.6,0,1,0-.817.817l.315.327v.922l4.958,4.958A1.229,1.229,0,0,0,24.03,22.3Zm-7,0a5.25,5.25,0,1,1,5.25-5.25A5.243,5.243,0,0,1,12.083,17.333Z" transform="translate(-1 -1)"/></g></g>
                      </svg>
                      
                      <svg id="closeText" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path style="fill:none;" d="M0,0H24V24H0Z"/>
                        <path style="fill:#0b52cc;" id="closeIcon" class="closeIcon" d="M18.3,5.71a1,1,0,0,0-1.41,0L12,10.59,7.11,5.7A1,1,0,0,0,5.7,7.11L10.59,12,5.7,16.89A1,1,0,0,0,7.11,18.3L12,13.41l4.89,4.89a1,1,0,0,0,1.41-1.41L13.41,12,18.3,7.11A1,1,0,0,0,18.3,5.71Z"/>
                      </svg>

                      <svg id="mobileSearchBack" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g style="opacity:0.87;">
                          <path style="fill:none;" d="M0,0H24V24H0Z"/>
                          <path style="fill:#fff;" d="M19,11H7.83l4.88-4.88a1.008,1.008,0,0,0,0-1.42,1,1,0,0,0-1.41,0L4.71,11.29a1,1,0,0,0,0,1.41l6.59,6.59a1,1,0,0,0,1.41-1.41L7.83,13H19a1,1,0,0,0,0-2Z"/>
                        </g>
                      </svg>
                      
                      
                    </form>
                    </div>

                  </div>

                  <div class="mobileSearchSelect">
                    <select id="mobileSelectFilter">
                      <option value="Featured" selected>Featured</option>
                      <option value="Best Practices">Best Practices</option>
                      <option value="COVID-19 Impact">COVID-19 Impact</option>
                      <option value="Customer Support">Customer Support</option>
                      <option value="CX Stories">CX Stories</option>
                      <option value="CX Strategy">CX Strategy</option>
                      <option value="VOC">VOC</option>
                    </select>
                  </div>

                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="cards-collapse" id="all-session-list">
              <div class="cards-inner">
                
                  <script>
                    if ( window.history.replaceState ) {
                      window.history.replaceState( null, null, window.location.href );
                    }

                    var month_name = function(dt){
                        mlist = [ "Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
                        return mlist[dt];
                    };

                    function DisplayCurrentTime(timestr) {
                        var hours = Number(timestr.split(':')[0]) > 12 ?  Number(timestr.split(':')[0]) - 12 :  Number(timestr.split(':')[0]);
                        var am_pm =  Number(timestr.split(':')[0]) >= 12 ? "PM" : "AM";
                        hours = hours < 10 ? "0" + hours : hours;
                        var minutes =  Number(timestr.split(':')[1]) < 10 ? "0" +  Number(timestr.split(':')[1]) :  Number(timestr.split(':')[1]);
                        
                        time = hours + ":" + minutes + " "+ am_pm;
                        return time
                    };

                    function getCountry(country){
                      return country != "" ? country:"India";
                    }

                    jQuery(document).ready(function( $ ) {
                      $('.no-data-found').hide();
                      $('.no-data-found-for-filter').hide();
                      $('#image-processor').show();
                      $('.back-to-top-leadership').hide();
                      var offset = 0;
                      var searchValue = '';
                      $('.view-session-watch').show();
                      $('.live-session').hide();
                      var wabinar_list = new Array();
                      var filter_found = false;

                      $.ajax({
                              url: '/wp-admin/admin-ajax.php',
                              type: 'post',
                              data: {"action": "get_live_webinar"},
                              success: function(response){
                                var data = JSON.parse(response);
                                if(data['message'] != 'not found'){
                                  var liveCount = 0;
                                  var showLive = false;
                                  $.each(data['message'], function( index, value ) {
                                    if(value['category_content']=='live'){
                                      if(liveCount==0){
                                        $('.view-session-watch').hide();
                                        $('.live-session').show();
                                        var innerhtml = '<h5>'+value['title']+'</h5>'+
                                                        '<div class="all-session-btn through-leadership-live">'+
                                                          '<a class="btn btn-secondary sm" data-toggle="modal" data-target="#zoom-register-modalForm">Watch Now</a>'+
                                                        '</div>';
                                                        
                                        $('.live-session').append(innerhtml); 
                                        if(value['webinar_id']){
                                          // $('#zoom-register-modalForm iframe').attr("src",value['registartion_webinar_url']);
                                          $('input[name="webinar_id"]').val(value['webinar_id']).change();
                                        }
                                        
                                      }
                                      liveCount++;
                                      
                                    }
                                  });
                                  
                                }else{
                                  
                                } 
                              },
                              error: function (response) {
                                console.log(response);
                              }
                        });

                      function timeDUrationFormat(duration){
                        if(duration.split('.')[0]==0){
                          return duration.split('.')[1]+ ' mins';
                        }else{
                          return duration.split('.')[0]+' hr '+duration.split('.')[1]+' mins';
                        }
                      }

                      function addOnDemandHtml(value, index_url, index){
                        return '<div class="col-md-6 col-12">'+
                                  '<div class="card demand-cards">'+
                                    '<div class="card-body mb-md-3 mb-lg-5 mb-3">'+
                                      '<a href="'+index_url+'">'+
                                        '<div class="card-icon-feature">'+
                                          '<img src="<?php echo content_url() ?>'+value['image_path'].split('/home/s1/html/wp-content')[1]+'" alt="Card image cap">'+
                                        '</div>'+
                                        '<div class="card-content">'+
                                          '<p class="card-text">'+
                                              value['title']+
                                          '</p>'+
                                          '<ul>'+
                                            '<li>'+timeDUrationFormat(value['duration'])+'</li>'+
                                            // '<li>'+value['time']+' (Jakarta time)</li>'+
                                            '<li>'+value['no_of_people_view']+' people viewed</li>'+
                                          '</ul>'+
                                          '<div class="on-demand-box">'+
                                            '<a class="btn btn-secondary sm" href="'+index_url+'"> On-Demand</a>'+
                                          '</div>'+
                                        '</div>'+
                                      '</a>'+
                                    '</div>'+ 
                                  '</div>'+ 
                                '</div>';
                      }
                      function addUpcomingHtml(value, index_url, index){
                        return '<div class="col-md-6 col-12">'+
                                  '<div class="card upcoming-cards">'+
                                    '<div class="card-body mb-md-3 mb-lg-5 mb-3">'+
                                      '<a href="'+index_url+'">'+
                                        '<div class="card-icon-feature">'+
                                          '<img src="<?php echo content_url() ?>'+value['image_path'].split('/home/s1/html/wp-content')[1]+'" alt="Card image cap">'+
                                        '</div>'+
                                        '<div class="card-content">'+
                                          '<p class="card-text">'+
                                              value['title']+
                                          '</p>'+
                                          '<ul>'+
                                            '<li>'+month_name(Number(value['date'].split('-')[1])-1)+' '+Number(value['date'].split('-')[2])+', '+Number(value['date'].split('-')[0])+'</li>'+
                                            '<li>'+DisplayCurrentTime(value['time'])+' ('+getCountry(value['country'])+')</li>'+
                                            '<li>'+value['no_of_people_view']+' people attending</li>'+
                                          '</ul>'+
                                          '<div class="on-demand-box">'+
                                            '<a class="btn btn-secondary sm" href="'+index_url+'"> Upcoming</a>'+
                                          '</div>'+
                                        '</div>'+
                                      '</a>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>';
                      }

                      // ajax call
                      var filterValue = '';
                      var see_more_var = 0;
                      var currentRequest = null;
                      function ajax_call(param){
                        $('#see_more_session').hide();
                        $('.no-data-found').hide();
                        
                        wabinar_list = new Array();
                        currentRequest = $.ajax({
                              url: '/wp-admin/admin-ajax.php',
                              type: 'post',
                              data: param,
                              beforeSend : function()    {           
                                  if(currentRequest != null) {
                                    currentRequest.abort();
                                    $('.no-data-found').hide();
                                    $('#image-processor').show();
                                  }
                              },
                              success: function(response){
                                var data = JSON.parse(response);
                                if(data['message'] != 'no quote found'){
                                  $('.no-data-found').hide();
                                  $('.no-data-found-for-filter').hide();
                                  $('#image-processor').hide();
                                  if(data["see_more_session"][0]["count(*)"]>8){
                                    $('#see_more_session').show();
                                  }
                                  if(data['message'].length>=2){
                                    $('.back-to-top-leadership').show();
                                  }
                                  $.each(data['message'], function( index, value ) {
                                      wabinar_list.push(value);
                                  });
                                  $.each(wabinar_list, function( index, value ) {
                                    if(value['category_content']=='on demand event'){
                                      var index_url = '/cx/?title='+value['title'].replace(/\s/g, '-')+'&index='+value['id'];
                                      var htmlElement = addOnDemandHtml(value, index_url, value['id']);
                                      $('#contentDiv').append(htmlElement);
                                    }else if(value['category_content']=='upcoming event' || value['category_content']=='live'){
                                      var index_url = '/cx/?title='+value['title'].replace(/\s/g, '-')+'&index='+value['id'];
                                      var htmlElement = addUpcomingHtml(value, index_url, value['id'])
                                      $('#contentDiv').append(htmlElement);
                                    }
                                    see_more_var = value['id'];
                                    $('#contentDiv').show();
                                  });
                                }else{
                                  $('#image-processor').hide();
                                  if(filter_found){
                                    $('.no-data-found').hide();
                                    $('.no-data-found-for-filter').show();
                                  }else{
                                    // $('.back-to-top-leadership').show();
                                    // $('.no-data-found').show();
                                    $('.no-data-found-for-filter').hide();
                                  }
                                  
                                } 
                              },
                              error: function (response) {
                                console.log(response);
                                $('#image-processor').hide();
                                $('.no-data-found').show();
                              }
                        });
                      }
                      var param = { 
                          "action": "get_quote",
                          "search": "",
                          "query": "Featured",
                          "filter":"filter",
                          "offset":offset
                        }
                      
                      ajax_call(param);

                      function setSession(index){
                        alert(index);
                      }

                      // search input functionalty
                      var enterClicked = false;
                      $('#searchValue').keyup(function(e) {
                          if (!this.value && e.which != 13 && enterClicked) {
                            $('#image-processor').show();
                            $('#contentDiv').hide();
                            $('#contentDiv').empty();
                            $('.back-to-top-leadership').hide();
                            offset = 0;
                            filter_found = false;
                            enterClicked = false;
                            var param = { 
                                "action": "get_quote",
                                "search": "",
                                "query": "Featured",
                                "filter":"filter",
                                "offset":offset
                              }
                            wabinar_list = new Array();
                            ajax_call(param);
                            $('.filter-data').parent().removeClass('active');
                            $('.filter-content ul li:first').addClass('active');
                            $('#searchValue').blur();
                            $('.filter-content').removeClass("inputBorder");
                            $('#closeText').hide();
                            $('#searchIcon').show();
                          } else if(!this.value && e.which == 13){
                            $('#closeText').hide();
                            $('#searchIcon').show();
                          }else if(this.value && e.which == 13){
                            $('#closeText').show();
                            $('#searchIcon').hide();
                          }
                      });

                      // featured session functionalty
                      $('#featured_sessions').click(function(){
                        $('.back-to-top-leadership').hide();
                        $('.filter-content').removeClass("inputBorder");
                        $('.filter-data').parent().removeClass('active');
                        $('#image-processor').show();
                        $('#contentDiv').hide();
                        $('#contentDiv').empty();
                        $('#searchValue').val("");
                        offset = 0;
                        searchValue = '';
                        $('#mobileSelectFilter').val("Featured").change();
                        
                        $('.filter-content ul li:first').addClass('active');
                        $('.no-data-found').hide();
                        $('.no-data-found-for-filter').hide();
                        filter_found = true;
                        var param = { 
                          "action": "get_quote",
                          "search": "",
                          "query": "Featured",
                          "filter":"filter",
                          "offset":offset
                        }
                        wabinar_list = new Array();
                        // ajax_call(param);
                        $('#searchIcon').show();
                      });

                      // featuured session filter functionality
                      $('#featured_sessions_filter').click(function(){
                        $('.filter-content').removeClass("inputBorder");
                        $('.filter-data').parent().removeClass('active');
                        $('.back-to-top-leadership').hide();
                        $('#image-processor').show();
                        $('#contentDiv').hide();
                        $('#contentDiv').empty();
                        $('#searchValue').val("");
                        offset = 0;
                        searchValue = '';
                        $('#mobileSelectFilter').val("Featured").change();
                        
                        $('.filter-content ul li:first').addClass('active');
                        $('.no-data-found').hide();
                        $('.no-data-found-for-filter').hide();
                        filter_found = true;
                        var param = { 
                          "action": "get_quote",
                          "search": "",
                          "query": "Featured",
                          "filter":"filter",
                          "offset":offset
                        }
                        wabinar_list = new Array();
                        // ajax_call(param);
                        $('#searchIcon').show();
                      });

                      // click function on close in search functionality
                      $('#closeText').click(function(){
                        if($('#searchValue').val()){
                          $('#searchValue:text').val('');
                          $('.filter-content').removeClass("inputBorder");
                          $('#image-processor').show();
                          $('#contentDiv').hide();
                          $('#contentDiv').empty();
                          $('#searchValue').val("");
                          param.offset = 0;
                          param.query = "Featured";
                          param.search = "";
                          filter_found = true;
                          $('.filter-content ul li:first').addClass('active');
                          $('.no-data-found').hide();
                          wabinar_list = new Array();
                          ajax_call(param);
                          searchValue = '';
                          $('#searchValue').blur();
                          $('#closeText').hide();
                          $('#searchIcon').show();
                        }
                      });

                      // See more session functions
                      $('#see_more_session').click(function(){
                        if(see_more_var>0){
                          offset = see_more_var;
                        }
                        if(searchValue){
                          param = { 
                            "action": "get_quote",
                            "search": "search",
                            "query": searchValue,
                            "filter":"",
                            "offset":offset
                          }
                        }else if(filterValue){
                          filter_found = false;
                          param = { 
                            "action": "get_quote",
                            "search": "",
                            "query": filterValue,
                            "filter":"filter",
                            "offset":offset
                          }
                        }else{
                          param = { 
                            "action": "get_quote",
                            "search": "",
                            "query": "Featured",
                            "filter":"",
                            "offset":offset
                          }
                        }
                        
                        $('.no-data-found').hide();
                        $('.no-data-found-for-filter').hide();
                        $('#image-processor').show();
                        wabinar_list = new Array();
                        ajax_call(param);
                      });

                    // search functionality
                    function searchContents(searchValue){
                      $('.filter-data').parent().removeClass('active');
                      $('#contentDiv').hide();
                      $('#contentDiv').empty();
                      $('#image-processor').show();
                      $('.no-data-found').hide();
                      offset = 0;
                      filter_found = false;
                      var param = { 
                          "action": "get_quote",
                          "search": "search",
                          "query": searchValue,
                          "filter":"",
                          "offset":offset
                        } 
                      wabinar_list = new Array();
                      ajax_call(param);
                      filterValue = '';
                    }
                    
                    // search on form submit function
                    $('form#searchForm').submit(function(event) {
                      event.preventDefault();
                      searchValue = $('#searchValue').val();
                      if(searchValue){
                        enterClicked = true;
                        searchContents(searchValue);
                      } 
                    });

                    // search on click search icon
                    $('#searchIcon').click(function(event){
                      event.preventDefault();
                      searchValue = $('#searchValue').val();
                      if(searchValue!=''){
                        searchContents(searchValue);
                      }
                    });
                    
                    // Desktop View Filter function
                    $('.filter-data').click(function(){
                      filterValue = $(this).attr("data-cat");
                      $('.filter-data').parent().removeClass('active');
                      $('#image-processor').show();
                      $(this).parent().addClass('active');
                      $('#contentDiv').hide();
                      $('#contentDiv').empty();
                      $('.no-data-found').hide();
                      $('.no-data-found-for-filter').hide();
                      $('#searchValue').val("");
                      $('#searchValue').blur();
                      $('#closeText').hide();
                      $('#searchIcon').show();
                      $('.filter-content').removeClass("mobileInput inputBorder");
                      offset = 0;
                      filter_found = true;
                      var param = { 
                          "action": "get_quote",
                          "search": "",
                          "query": filterValue,
                          "filter":"filter",
                          "offset":offset
                        } 
                        wabinar_list = new Array();
                        ajax_call(param);
                        searchValue = '';
                    });

                    // for mobile view filter
                    $('#mobileSelectFilter').attr("class", "Featured");
                    $('#mobileSelectFilter').on('change', function() {
                      offset = 0;
                      filter_found = true;
                      $('.back-to-top-leadership').hide();
                      $(this).attr("class", this.value);
                      filterValue = this.value;
                      $('.filter-data').parent().removeClass('active');
                      $('#image-processor').show();
                      
                      $('#contentDiv').hide();
                      $('#contentDiv').empty();
                      
                      $('#searchValue').val("");
                      var param = { 
                          "action": "get_quote",
                          "search": "",
                          "query": filterValue,
                          "filter":"filter",
                          "offset":offset
                        } 
                        ajax_call(param);
                    });
                    
                  });
                </script>
                  <div class="cards-main row" id="contentDiv"></div>
                
                  <div class="cards-main row">
                    <?php if($contents): ?>
                      <?php foreach ( $contents as $content ) { ?>

                        <?php if($content->{'category_content'}=='on demand event'): ?>
                                  
                          <div class="col-md-6 col-12">
                            <div class="card demand-cards">
                              <?php
                                $image = $content->{'image'};
                                $title = $content->{'title'};
                                $date = $content->{'date'};
                                $time = $content->{'time'};
                                $number_of_people_view = $content->{'no_of_people_view'};
                              ?>
                              <div class="card-body mb-md-3 mb-lg-5 mb-3">
                                <a href="<?php echo site_url(); ?><?php echo $index_url; ?>">
                                  <div class="card-icon-feature">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($image) ;?>" alt="Card image cap">
                                  </div>
                                  <div class="card-content">
                                    <p class="card-text">
                                      <?php echo $title ;?>
                                    </p>
                                    <ul>
                                      <li><?php echo $date ;?></li>
                                      <li><?php echo $time ;?> (Jakarta time)</li>
                                      <li><?php echo $number_of_people_view ;?> people viewed</li>
                                    </ul>
                                    <div class="on-demand-box">
                                    <a class="btn btn-secondary sm" href="<?php echo site_url(); ?><?php echo $index_url; ?>"> On-Demand</a>
                                    </div>
                                  </div>
                                </a>
                              </div> 
                            </div> 
                          </div>
        
                        <?php endif; ?>

                        <?php if($content->{'category_content'}=='upcoming event'): ?>
                          <div class="card upcoming-cards col-md-6 col-12">
                            <?php
                              $image = $content->{'image'};
                              $title = $content->{'title'};
                              $date = $content->{'date'};
                              $time = $content->{'time'};
                              $number_of_people_view = $content->{'no_of_people_view'};
                            ?>
                            <div class="card-body mb-md-3 mb-lg-5 mb-3">
                              <a href="<?php echo site_url(); ?><?php echo '$index_url'; ?>">
                                <div class="card-icon-feature">
                                  <img src="data:image/jpeg;base64,<?php echo base64_encode($image) ;?>" alt="Card image cap">
                                </div>
                                <div class="card-content">
                                  <p class="card-text">
                                    <?php echo $title ;?>
                                  </p>
                                  <ul>
                                    <li><?php echo $date ;?></li>
                                    <li><?php echo $time ;?> (Jakarta time)</li>
                                    <li><?php echo $number_of_people_view ;?> people viewed</li>
                                  </ul>
                                  <div class="on-demand-box">
                                    <a class="btn btn-secondary sm" href="<?php echo site_url(); ?><?php echo $index_url; ?>"> Upcoming</a>
                                  </div>
                                </div>
                              </a>
                            </div>
                          </div>
                        <?php endif; ?>

                      <?php } ?>
                    <?php endif; ?>
                  </div>
            
                
                  <div class="cards-main row shimmer-cards" id="image-processor">
                    <div class="col-md-6 col-12">
                        <div class="card">
                          <div class="card-body mb-md-3 mb-lg-5 mb-3">
                            <div class="card-icon-feature shimmer" style="height:280px;margin-bottom:14px;"></div>
                            <div class="card-content">
                                <div class="shimmer" style="height:20px;width:100%;margin-bottom:20px;"></div>
                                <div class="shimmer" style="height:14px;width:80%;"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                          <div class="card-body mb-md-3 mb-lg-5 mb-3">
                            <div class="card-icon-feature shimmer" style="height:280px;margin-bottom:14px;"></div>
                            <div class="card-content">
                                <div class="shimmer" style="height:20px;width:100%;margin-bottom:20px;"></div>
                                <div class="shimmer" style="height:14px;width:80%;"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                          <div class="card-body mb-md-3 mb-lg-5 mb-3">
                            <div class="card-icon-feature shimmer" style="height:280px;margin-bottom:14px;"></div>
                            <div class="card-content">
                                <div class="shimmer" style="height:20px;width:100%;margin-bottom:20px;"></div>
                                <div class="shimmer" style="height:14px;width:80%;"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                          <div class="card-body mb-md-3 mb-lg-5 mb-3">
                            <div class="card-icon-feature shimmer" style="height:280px;margin-bottom:14px;"></div>
                            <div class="card-content">
                                <div class="shimmer" style="height:20px;width:100%;margin-bottom:20px;"></div>
                                <div class="shimmer" style="height:14px;width:80%;"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                          <div class="card-body mb-md-3 mb-lg-5 mb-3">
                            <div class="card-icon-feature shimmer" style="height:280px;margin-bottom:14px;"></div>
                            <div class="card-content">
                                <div class="shimmer" style="height:20px;width:100%;margin-bottom:20px;"></div>
                                <div class="shimmer" style="height:14px;width:80%;"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                          <div class="card-body mb-md-3 mb-lg-5 mb-3">
                            <div class="card-icon-feature shimmer" style="height:280px;margin-bottom:14px;"></div>
                            <div class="card-content">
                                <div class="shimmer" style="height:20px;width:100%;margin-bottom:20px;"></div>
                                <div class="shimmer" style="height:14px;width:80%;"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  


                <div class="no-data-found">
                  <div class="no-data-text">Looks like there are no matching sessions. Try another search term or view our <a id="featured_sessions" style="cursor:pointer">featured sessions</a>.</div>
                </div>
                <div class="no-data-found-for-filter">
                  <div class="no-data-text">We’ll be adding new sessions here soon. In the meanwhile, check out some of our <a id="featured_sessions_filter" style="cursor:pointer">featured sessions</a>.</div>
                </div>


              </div>
              <div class="see-more-sessions">
                <span class="see-sessions-list" id="see_more_session">See more sessions</span>
              </div>
              <div class="back-to-top-leadership">
                <span class="back-top-text" id="top-sessions">Back to top</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>

    <!-- Keep learning subscribe -->
    <section class="keep-learning-leader" id="keep-learning-subscribe">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="subscribe">
              <div class="subscribe-heading">
                Keep learning from CX Thought Leaders
              </div>
              <!-- <div class="subscribe-keep-sub-text">Subscribe to our mailing list and stay updated about upcoming sessions</div> -->
              <div class="subscribe-btn">

                <script>
                  hbspt.forms.create({
                  portalId: "5773317",
                  formId: "2fea32c0-427d-418b-a1b1-89c82622d6a0",

                  onFormSubmit: function($form) {
                      var faqQuestion = document.getElementById('keep-learning-subscribe');
                      faqQuestion.classList.add('subscribe-message-thanku');
                    }
                });

                </script>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



<!-- Register zoom session -->
<!-- zoom register form modal -->
<div class="modal fade" id="zoom-register-modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelVideo" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">

         
            <!-- <iframe src="https://zoom.us/webinar/register/WN_DNirZkUOSgKvKV55Iroojg" frameborder="0" allowfullscreen allow="microphone; camera;"></iframe>
            <button
               type="button"
               class="close"
               data-dismiss="modal"
               aria-label="Close"
               > -->

               <h5 class="modal-title text-center font-weight-bold">Register Now</h5>

               <script>
                  hbspt.forms.create({
                        portalId: "5773317",
                        formId: "f898be68-324f-4621-a098-3bb25498e677"
                  });
                </script>
           
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/close-menu.svg" alt="SurveySensum" />
                </button>
               
            </button>
         </div>
      </div>
   </div>
</div>


<script>

  // Through Leadership JS 13-08-2020
	jQuery('#searchValue').focus(function(){
		if(!jQuery(this).val()){
			  jQuery('#searchIcon').click(function(){
        jQuery('.filter-content').addClass("inputBorder");
      });
    }
  });

  jQuery('#searchValue').on('keypress',function(e){
      if(e.which == 13) {
        jQuery('.filter-content').addClass("inputBorder");
      }
  });
  


  // Mobile search filter
  jQuery('#searchMobile').click(function(){
    jQuery('.filter-content').addClass("mobileInput");
    jQuery('.filter-content.mobileInput #searchValue').focus();
  });

  // Remove search field
  jQuery('#mobileSearchBack').click(function(){
    jQuery('.filter-content').removeClass("mobileInput inputBorder");
  });



  jQuery('.filter-catagory .filter-content ul li:first-child > a').click(function(){
    jQuery('.filter-catagory').toggleClass('dropdownFilter');
  });

  

  // var newImage = jQuery('<img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/Spotify_Logo_RGB_Green.png" class="img-fluid" alt="">');
  
  // jQuery('#mobileSelectFilter option:selected').append(newImage);

</script>


<?php get_footer(); ?>





