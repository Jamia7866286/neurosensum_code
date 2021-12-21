<!-- get Ip country wise for surveysensum.com/cx-platform/nps-ces-csat-survey-software-id/ -->
<?php require_once ABSPATH . 'env/' . CURRENT_ENV . '.php'; ?>

<?php
      // ip info
      $curl = curl_init(getenv('ApiBaseUrl') . 'ipdetails');

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
         'Content-Type: application/json',
         'X-Forwarded-For:'.$_SERVER['HTTP_X_REAL_IP']
      ]);

      $response = curl_exec($curl);
      $ip_info=[];
      if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
            $ip_info=json_decode($response,true)['result'];
            //   print_r($ip_info["countryCode"]);
            $getUrl = null;
            $getUrlTitle = null;
            if($ip_info["countryCode"] == 'ID' or $ip_info["countryCode"] == 'RU' ){
               $getUrl = 'nps-ces-csat-survey-software-id';
               $getUrlTitle = 'NPS, CES, CSAT Survey Software Indonesia';
            }
            else{
                  $getUrl = 'nps-ces-csat-survey-software';
                  $getUrlTitle = 'NPS, CES, CSAT Survey Software';
            }
      }

?>
<!-- End get Ip country wise for surveysensum.com/cx-platform/nps-ces-csat-survey-software-id/ -->






<!DOCTYPE html>

<html <?php language_attributes(); ?>>

   <head>
      
      <!-- Google Tag Manager Live -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
         new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
         j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
         'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-NH6929D');</script>
      <!-- End Google Tag Manager Live -->


      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title><?php bloginfo('name'). ' | ' .wp_title(); ?></title>

      <link rel="prefetch" as="font" crossorigin="crossorigin" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" />
      <link rel="profile" href="http://gmpg.org/xfn/11" />
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


      <?php
         #if($_GET['index']!=NULL){
         #   $index = $_GET['index'];
         #}elseif($_GET['source']!=NULL){
         #   $index = $_GET['source'];
         #}
         
        # $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        # if($index){
        #    $arraydata = $wpdb->get_results( 'select * from contents where id = '.$index);
        #    $image = content_url().explode("/home/s1/html/wp-content",$arraydata[0]->{'image_path'})[1];
        #    $event_description = $arraydata[0]->{'title'};
            // facebook 
        #    echo '<meta property="og:title" content="'.stripslashes($event_description).'">';
        #    echo '<meta property="og:description" content="'.stripslashes($event_description).'">';
        #    echo '<meta property="og:url" content="'.$actual_link.'">';
        #    echo '<meta property="og:image" content="'.$image.'">';
        #    echo '<meta property="og:image:secure_url" content="'.$image.'">';
        #    echo '<meta property="og:image:width" content="500">';
        #    echo '<meta property="og:image:height" content="500">';
        #    echo '<meta property="og:image:alt" content="'.stripslashes($event_description).'">';
        #    echo '<meta property="og:image:type" content="image/jpeg">';
            // twitter
        #    echo '<meta content="text/html; charset=UTF-8" name="Content-Type" />';
        #    echo '<meta name="twitter:card" content="summary_large_image">';
        #    echo '<meta name="twitter:site" content="'.$actual_link.'">';
        #    echo '<meta name="twitter:image" content="'.$image.'">';
        #    echo '<meta property="twitter:image:src" content="'.$image.'">';
        # }
      ?>
      

      <?php wp_head(); ?>

      <!-- <script>
         var index = "<?php #echo $index ?>";
         jQuery(document).ready(function(){
            if(index){
               document.querySelector('head').append( '<meta name="twitter:image" content="<?php #echo $image ?>">' );
               document.querySelector('meta[property="og:image"]').remove();
               document.querySelector('meta[property="og:image:secure_url"]').remove();
               
               document.querySelector('meta[property="og:image"]').setAttribute("content", "<?php #echo $image ?>");
               document.querySelector('meta[property="og:image:secure_url"]').setAttribute("content", "<?php #echo $image ?>");
              
            }
         });
      </script> -->



      <!-- Hubspot script not deleted -->
      <!--[if lte IE 8]>
         <script
         charset="utf-8"
         type="text/javascript"
         src="//js.hsforms.net/forms/v2-legacy.js"
         ></script>
      <![endif]-->
      <!-- <script
         charset="utf-8"
         type="text/javascript"
         src="//js.hsforms.net/forms/v2.js"
      ></script> -->

      <!-- In-app script for only staging -->
      <!-- <script async data-survey-token="26%2bKmJK4%2bobc2BS82M7qNKHAjoyB0Dj3p1aeu3vQpgEaWQRRaAPwTRtpDKfA1m90Jpxexcha0Twbfk7IpnfH%2fQ%3d%3d" src="https://assets.surveysensum.com/in-app/ss-widget.min.js"></script> -->

   </head>
      
   <!-- Body Start-->
   <body <?php body_class(); ?>>


      <!-- Google Tag Manager Live (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NH6929D"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager Live (noscript) -->
      


      <!-- Preloader Start -->
      <div class="preloader">
         <div class="spinner">
            <img rel="prefetch" src="https://www.surveysensum.com/wp-content/uploads/2019/09/favicon.png" alt="SurveySensum">
         </div>
      </div>
      <!-- Preloader End -->


      <!-- Main Start -->
      <main>
      <!-- Header Start -->
      <header>

         <?php if ( of_get_option('availability') == 1 ) { ?>

            <!-- Download Report Start -->
            <?php if ( of_get_option('report_content') ) { ?>
               <div class="download-report pricing-page-offers-with-black-friday">
                  <div class="container container-sm">
                     <div class="sticky-header-menu">
                        <?php echo of_get_option('report_content'); ?>
                     </div>
                  </div>
               </div>
            <?php } ?>
            <!-- Download Report End -->

         <?php } ?>

         
         <div class="header-menu">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="<?php echo site_url() ?>">
                        <img rel="prefetch"
                           src="<?php echo get_template_directory_uri()
                              ?>/homepage_assets/img/svg/Surveysensum-logo.svg"
                           class="img-fluid"
                           alt="SurveySensum"
                           />
                        </a>
                        <button class="navbar-toggler" id="mySidenavmobile" type="button">
                           <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- <div class="mobile-collapse"> -->
                        <!-- <div class="position-absolute custom-collapse">
                           <img src="homepage_assets/svg/close-menu.svg" alt="SurveySensum" />
                           </div> -->
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo1">
                           <ul
                              class="navbar-nav mr-auto ml-5 mt-2 mt-lg-0 align-items-lg-center align-items-start"
                              >
                              <li class="nav-item dropdown">
                                 <a
                                    href=""
                                    class="nav-link dropdown-toggle"
                                    id="productMenu"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    >
                                    <div class="submenu-item d-flex align-items-center">
                                       <span>Products</span>
                                       <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          height="18"
                                          viewBox="0 0 24 24"
                                          width="18"
                                          >
                                          <path
                                             d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"
                                             />
                                          <path d="M0 0h24v24H0V0z" fill="none" />
                                       </svg>
                                    </div>
                                 </a>
                                 <ul class="dropdown-menu">
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                rel="prefetch"
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/cx-platform-menu.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/cx-platform/nps-ces-csat-survey-software/" style="cursor:pointer;" class="report-menu font-weight-bold p-0"
                                                >CX Platform</a>
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/cx-platform/<?php echo $getUrl?>/"
                                       ><?php echo $getUrlTitle ?></a>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                rel="prefetch"
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/cx-platform-menu.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/mx-platform/quick-online-surveys/" style="cursor:pointer" class="report-menu font-weight-bold p-0"
                                                >Quick Online Surveys</a>
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/mx-platform/quick-online-surveys/"
                                       >For Marketing & Insights team</a>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc pb-1"
                                          >
                                          <div class="icon-box">
                                             <img
                                                rel="prefetch"
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/conversational-analytics-menu.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/conversational-analytics/text-analytics-software/" style="cursor:pointer;" class="report-menu font-weight-bold p-0"
                                                >Conversational Analytics</a
                                                >
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/conversational-analytics/text-analytics-software/"
                                          >Text Analytics Software</a
                                          >
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc pb-1"
                                          >
                                          <div class="icon-box">
                                             <img
                                                rel="prefetch"
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/whatsapp-icon.svg"
                                                alt="whataApp Surveys"/>
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/whatsapp-surveys-english/" style="cursor:pointer;" class="report-menu font-weight-bold p-0"
                                                >WhatsApp Surveys</a
                                                >
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/whatsapp-surveys-english/"
                                          >For people who currently use CATI</a
                                          >
                                    </li>
                                 </ul>
                              </li>
                              <li class="nav-item dropdown">
                                 <a
                                    href=""
                                    class="nav-link dropdown-toggle"
                                    id="navbarDropdownMenuLink1"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    >
                                    <div class="submenu-item d-flex align-items-center">
                                       <span>Resources</span>
                                       <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          height="18"
                                          viewBox="0 0 24 24"
                                          width="18"
                                          >
                                          <path
                                             d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"
                                             />
                                          <path d="M0 0h24v24H0V0z" fill="none" />
                                       </svg>
                                    </div>
                                 </a>
                                 <ul
                                    class="dropdown-menu"
                                    >
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-center"
                                          >
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/customer-experience-icon.svg" alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content blog-redirect">
                                             <a
                                                href="<?php echo site_url() ?>/customer-experience/"
                                                class="report-menu font-weight-bold p-0"
                                                style="cursor: pointer;"
                                                >Customer Experience</a
                                                >
                                          </div>
                                       </div>
                                    </li>
                                    <li class="nested-dropdown">
                                       <div class="main-menu-items d-flex align-items-center">
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/report-icon.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content">
                                             <a class="report-menu font-weight-bold p-0">
                                                <span>Reports</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 0 24 24" width="18">
                                                   <path style="stroke: #091e42;" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"></path>
                                                   <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                </svg>
                                             </a>
                                          </div>
                                       </div>
                                       <div class="child-dropdown-item">
                                          <a class="dropdown-item" href="<?php echo site_url() ?>/lp/digital-cx-trends-report-2021.html"
                                             >Digital CX Trends Report 2021</a>
                                          <a class="dropdown-item" href="<?php echo site_url() ?>/lp/customer-experience-trends-2020-indonesia.html"
                                             >Customer Experience Trends Report 2020</a>
                                          <a class="dropdown-item" href="<?php echo site_url() ?>/lp/financial-sector-customer-experience-trends-2020-indonesia.html"
                                             >Financial Sector Customer Experience Trends Report 2020</a>
                                          <a class="dropdown-item" href="<?php echo site_url() ?>/lp/insurance-sector-customer-experience-trends-2020-Indonesia.html"
                                             >Insurance Sector Customer Experience Trends Report 2020</a>
                                          <a class="dropdown-item" href="<?php echo site_url() ?>/lp/2020-holiday-shopping-trends.html"
                                             >2020 Indonesia Holiday Shopping Trends Report</a>
                                       </div>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/blog-icon.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content blog-redirect">
                                             <a
                                                href="<?php echo site_url() ?>/blog"
                                                class="report-menu font-weight-bold p-0"
                                                style="cursor: pointer;"
                                                >Blogs</a
                                                >
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/through-leadership-menu-icon.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content blog-redirect">
                                             <a
                                                href="<?php echo site_url() ?>/the-experience-talk"
                                                class="report-menu font-weight-bold p-0"
                                                style="cursor: pointer;"
                                                >The Experience Talk (Webinars and Podcasts)</a
                                                >
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/help-centre.svg"
                                                   alt="SurveySensum"
                                                   />
                                          </div>
                                          <div class="menu-content blog-redirect">
                                             <a
                                                href="https://help.surveysensum.com/en/"
                                                target="_blank" class="report-menu font-weight-bold p-0" style="cursor:pointer;"
                                                >Help Center</a>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </li>
                             
                              <li class="nav-item dropdown">
                                 <a
                                    href=""
                                    class="nav-link dropdown-toggle"
                                    id="navbarDropdownMenuLink1"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    >
                                    <div class="submenu-item d-flex align-items-center">
                                       <span>Customers</span>
                                       <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          height="18"
                                          viewBox="0 0 24 24"
                                          width="18"
                                          >
                                          <path
                                             d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"
                                             />
                                          <path d="M0 0h24v24H0V0z" fill="none" />
                                       </svg>
                                    </div>
                                 </a>
                                 <ul
                                    class="dropdown-menu">
                                    <li>
                                       <div class="main-menu-items d-flex align-items-centerc">
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/case-study.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content blog-redirect">
                                             <a
                                                href="<?php echo site_url() ?>/customers/manulife-aset-manajemen-indonesia/"
                                                class="report-menu font-weight-bold p-0"
                                                style="cursor: pointer;">Manulife Aset Manajemen Indonesia (Finance)</a>
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/case-study.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content blog-redirect">
                                             <a
                                                href="<?php echo site_url() ?>/customers/indomobil"
                                                class="report-menu font-weight-bold p-0"
                                                style="cursor: pointer;">Indomobil (Automotive)</a>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </li>

                              <li class="nav-item">
                                 <a
                                    class="nav-link"
                                    href="<?php echo site_url() ?>/pricing"
                                    >Pricing</a
                                    >
                              </li>

                              <li class="nav-item">
                                 <a
                                    class="nav-link"
                                    href="<?php echo site_url() ?>/about-us/"
                                    >About Us</a
                                    >
                              </li>

                              <li class="nav-item">
                                 <a
                                    class="nav-link"
                                    href="https://portal.surveysensum.com/login" target="_blank">Login</a>
                              </li>
                           </ul>
                           <div class="form-inline my-2 my-lg-0">
                              <div class="btn-redirect form-inline">
                                 <div class="sign-up mr-3">
                                    <a
                                       class="btn btn-outline-secondary sm request-btn" data-toggle="modal" data-target="#request-demo-modal">Request Demo
                                    </a>
                                 </div>
                                 
                                 <div class="sign-up mr-0">
                                    <a
                                       class="btn btn-secondary sm" id="header-register"
                                       href="https://portal.surveysensum.com/register"
                                       >Sign up for Free
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <!-- Mobile Dropdown menu header -->
                        <div class="mobile-collapse">
                           <div class="position-absolute custom-collapse">
                              <img src="<?php echo get_template_directory_uri()
                                 ?>/homepage_assets/img/svg/close-menu.svg" alt="SurveySensum" />
                           </div>
                           <div class="navbar-collapse" id="navbarTogglerDemo2">
                              <ul
                                 class="navbar-nav mr-auto ml-5 mt-2 mt-lg-0 align-items-lg-center align-items-start"
                                 >
                                 <li class="nav-item dropdown">
                                 <a
                                    href=""
                                    class="nav-link dropdown-toggle"
                                    id="productMenuMobile"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    >
                                    <div class="submenu-item d-flex align-items-center">
                                       <span>Products</span>
                                       <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          height="18"
                                          viewBox="0 0 24 24"
                                          width="18"
                                          >
                                          <path
                                             d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"
                                             />
                                          <path d="M0 0h24v24H0V0z" fill="none" />
                                       </svg>
                                    </div>
                                 </a>
                                 <ul class="dropdown-menu">
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/cx-platform-menu.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/cx-platform/nps-ces-csat-survey-software/" class="report-menu font-weight-bold p-0"
                                                >CX Platform</a
                                                >
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/cx-platform/<?php echo $getUrl?>/"
                                       ><?php echo $getUrlTitle ?></a>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc"
                                          >
                                          <div class="icon-box">
                                             <img
                                                rel="prefetch"
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/cx-platform-menu.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/mx-platform/quick-online-surveys/" style="cursor:pointer" class="report-menu font-weight-bold p-0"
                                                >Quick Online Surveys</a>
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/mx-platform/quick-online-surveys/"
                                       >For Marketing & Insights team</a>
                                    </li>
                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc pb-1"
                                          >
                                          <div class="icon-box">
                                             <img
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/conversational-analytics-menu.svg"
                                                alt="SurveySensum"
                                                />
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/conversational-analytics/text-analytics-software/" class="report-menu font-weight-bold p-0"
                                                >Conversational Analytics</a
                                                >
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/conversational-analytics/text-analytics-software/"
                                          >Text Analytics Software</a
                                          >
                                    </li>

                                    <li>
                                       <div
                                          class="main-menu-items d-flex align-items-centerc pb-1"
                                          >
                                          <div class="icon-box">
                                             <img
                                                rel="prefetch"
                                                src="<?php echo get_template_directory_uri()
                                                   ?>/homepage_assets/img/svg/whatsapp-icon.svg"
                                                alt="whataApp Surveys"/>
                                          </div>
                                          <div class="menu-content">
                                             <a href="<?php echo site_url() ?>/whatsapp-surveys-english/" style="cursor:pointer;" class="report-menu font-weight-bold p-0"
                                                >WhatsApp Surveys</a
                                                >
                                          </div>
                                       </div>
                                       <a
                                          class="dropdown-item"
                                          href="<?php echo site_url() ?>/whatsapp-surveys-english/"
                                          >For people who currently use CATI</a
                                          >
                                    </li>
                                 </ul>
                              </li>
                                 <li class="nav-item dropdown">
                                    <a
                                       href=""
                                       class="nav-link dropdown-toggle"
                                       id="navbarDropdownMenuLink2"
                                       data-toggle="dropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       >
                                       <div class="submenu-item d-flex align-items-center">
                                          <span>Resources</span>
                                          <svg
                                             xmlns="http://www.w3.org/2000/svg"
                                             height="18"
                                             viewBox="0 0 24 24"
                                             width="18"
                                             >
                                             <path
                                                d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"
                                                />
                                             <path d="M0 0h24v24H0V0z" fill="none" />
                                          </svg>
                                       </div>
                                    </a>
                                    <ul
                                       class="dropdown-menu"
                                       >
                                       <li>
                                          <div
                                             class="main-menu-items d-flex align-items-center"
                                             >
                                             <div class="icon-box">
                                                <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/customer-experience-icon.svg"
                                                   alt="SurveySensum"
                                                   />
                                             </div>
                                             <div class="menu-content">
                                                <a
                                                   href="<?php echo site_url() ?>/customer-experience/"
                                                   class="report-menu font-weight-bold"
                                                   style="cursor: pointer;"
                                                   >Customer Experience</a
                                                   >
                                             </div>
                                          </div>
                                       </li>
                                       <li>
                                          <div
                                             class="main-menu-items d-flex align-items-centerc"
                                             >
                                             <div class="icon-box">
                                                <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/report-icon.svg"
                                                   alt="SurveySensum"
                                                   />
                                             </div>
                                             <div class="menu-content">
                                                <a class="report-menu font-weight-bold"
                                                   >Reports</a
                                                   >
                                             </div>
                                          </div>
                                          <a
                                             class="dropdown-item"
                                             href="https://www.surveysensum.com/lp/digital-cx-trends-report-2021.html"
                                             >Digital CX Trends Report 2021</a>
                                          <a
                                             class="dropdown-item"
                                             href="<?php echo site_url() ?>/lp/customer-experience-trends-2020-indonesia.html"
                                             >Customer Experience Trends Report 2020</a
                                             >
                                          <a
                                             class="dropdown-item"
                                             href="<?php echo site_url() ?>/lp/financial-sector-customer-experience-trends-2020-indonesia.html"
                                             >Financial Sector Customer Experience Trends Report
                                          2020</a
                                             >
                                          <a
                                             class="dropdown-item"
                                             href="https://www.surveysensum.com/lp/insurance-sector-customer-experience-trends-2020-Indonesia.html"
                                             >Insurance Sector Customer Experience Trends Report 2020</a
                                             >
                                          <a
                                             class="dropdown-item"
                                             href="https://www.surveysensum.com/lp/2020-holiday-shopping-trends.html"
                                             >2020 Indonesia Holiday Shopping Trends Report</a>

                                       </li>
                                       <li>
                                          <div
                                             class="main-menu-items d-flex align-items-centerc"
                                             >
                                             <div class="icon-box">
                                                <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/blog-icon.svg"
                                                   alt="SurveySensum"
                                                   />
                                             </div>
                                             <div class="menu-content">
                                                <a
                                                   href="<?php echo site_url() ?>/blog"
                                                   class="report-menu font-weight-bold"
                                                   style="cursor: pointer;"
                                                   >Blogs</a
                                                   >
                                             </div>
                                          </div>
                                       </li>
                                       <li>
                                          <div
                                             class="main-menu-items d-flex align-items-centerc"
                                             >
                                             <div class="icon-box">
                                                <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/through-leadership-menu-icon.svg"
                                                   alt="SurveySensum"
                                                   />
                                             </div>
                                             <div class="menu-content">
                                                <a
                                                   href="<?php echo site_url() ?>/the-experience-talk"
                                                   class="report-menu font-weight-bold"
                                                   style="cursor: pointer;">The Experience Talk (Webinars and Podcasts)</a>
                                             </div>
                                          </div>
                                       </li>

                                       <li>
                                          <div
                                             class="main-menu-items d-flex align-items-centerc"
                                             >
                                             <div class="icon-box">
                                                <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/help-centre.svg"
                                                   alt="SurveySensum"
                                                   />
                                             </div>
                                             <div class="menu-content">
                                             <a
                                                href="https://help.surveysensum.com/en/"
                                                target="_blank" class="report-menu font-weight-bold" style="cursor:pointer;"
                                                >Help Center</a>
                                             </div>
                                          </div>
                                       </li>
                                    </ul>
                                 </li>

                                 <li class="nav-item dropdown">
                                    <a
                                       href=""
                                       class="nav-link dropdown-toggle"
                                       id="navbarDropdownMenuLink2"
                                       data-toggle="dropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       >
                                       <div class="submenu-item d-flex align-items-center">
                                          <span>Customers</span>
                                          <svg
                                             xmlns="http://www.w3.org/2000/svg"
                                             height="18"
                                             viewBox="0 0 24 24"
                                             width="18"
                                             >
                                             <path
                                                d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"
                                                />
                                             <path d="M0 0h24v24H0V0z" fill="none" />
                                          </svg>
                                       </div>
                                    </a>
                                    <ul
                                       class="dropdown-menu"
                                       >
                                       <li>
                                          <div
                                             class="main-menu-items d-flex align-items-center"
                                             >
                                             <div class="icon-box">
                                                <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/case-study.svg"
                                                   alt="SurveySensum"
                                                   />
                                             </div>
                                             <div class="menu-content">
                                                <a
                                                   href="<?php echo site_url() ?>/customers/manulife-aset-manajemen-indonesia/"
                                                   class="report-menu font-weight-bold"
                                                   style="cursor: pointer;"
                                                   >Manulife Aset Manajemen Indonesia (Finance)</a
                                                   >
                                             </div>
                                          </div>
                                       </li>
                                       <li>
                                          <div
                                             class="main-menu-items d-flex align-items-center"
                                             >
                                             <div class="icon-box">
                                                <img
                                                   src="<?php echo get_template_directory_uri()
                                                      ?>/homepage_assets/img/svg/case-study.svg"
                                                   alt="SurveySensum"
                                                   />
                                             </div>
                                             <div class="menu-content">
                                                <a
                                                   href="<?php echo site_url() ?>/customers/indomobil"
                                                   class="report-menu font-weight-bold"
                                                   style="cursor: pointer;"
                                                   >Indomobil (Automotive)</a>
                                             </div>
                                          </div>
                                       </li>
                                    </ul>
                                 </li>

                                 <li class="nav-item">
                                    <a
                                       class="nav-link"
                                       href="<?php echo site_url() ?>/pricing"
                                       >Pricing</a
                                       >
                                 </li>
                                 <li class="nav-item">
                                    <a
                                       class="nav-link"
                                       href="<?php echo site_url() ?>/customers/manulife-aset-manajemen-indonesia/"
                                       >Customers</a
                                       >
                                 </li>

                                 <li class="nav-item">
                                    <a
                                       class="nav-link"
                                       href="<?php echo site_url() ?>/about-us/"
                                       >About Us</a
                                       >
                                 </li>

                                 <li class="nav-item">
                                    <a
                                       class="nav-link"
                                       href="https://portal.surveysensum.com/login"
                                       target="_blank"
                                       >Login</a>
                                 </li>
                                 <li class="nav-item">
                                    <a
                                       class="nav-link" id="header-register-mob"
                                       href="https://portal.surveysensum.com/register"
                                       >Sign up for Free</a
                                       >
                                 </li>
                                 <!-- <li class="nav-item">
                                    <a class="nav-link" href="tel:+6281215555707"
                                       >+62 812 15555 707</a
                                       >
                                 </li> -->
                                 <!-- <li class="nav-item">
                                    <a
                                       class="nav-link"
                                       href="https://api.whatsapp.com/send?phone=6282112450566&text=Hi%2C%20I%27d%20like%20to%20know%20more%20about%20SurveySensum"
                                       target="_blank"
                                       >Whatsapp</a
                                       >
                                 </li> -->
                              </ul>
                           </div>
                        </div>
                        <div id="mobilenav--underlay">
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- Header End -->



      <?php if(is_singular( 'post' ) || is_page_template( 'template/new-default.php' )) { ?>

            <!-- Popup Start -->

            <!-- Old pop-up design -->
            <!-- <div class="popup-container blogFormsPopup" id="blogNewsLetterSubscribe">
               <a id="close-popup" href="javascript:void(0);"></a>
               <div class="top-section">
                  <span class="status">1</span>
                  <span class="envelope"></span>
                  <span class="lines"></span>
               </div>
               <div class="bottom-section">
                  <h3 class="title">Subscribe To our Newsletter</h3>
                  <p class="sub-title">Subscribe to get the latest news and updates No spam promise.</p>
                  <?php #gravity_form(9, false, false, false, '', true, 200); ?>
               </div>
            </div> -->
            <!-- End Old pop-up design -->

            <!-- New pop up design -->
            <div class="popup-container blogFormsPopup" id="blogNewsLetterSubscribe">
               <a id="close-popup" href="javascript:void(0);">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12.314 12.314"><path d="M17.314,6.24,16.074,5,11.157,9.917,6.24,5,5,6.24l4.917,4.917L5,16.074l1.24,1.24L11.157,12.4l4.917,4.917,1.24-1.24L12.4,11.157Z" transform="translate(-5 -5)" fill="#02193b"/></svg>
               </a>
               <div class="our-expert-image">
                  <img src="<?php echo get_template_directory_uri()?>/assets/img/cx-image.png" alt="">
               </div>               
               <div class="bottom-section">
                  <h3 class="title">Get awesome <span>CX News</span> like this directly in your inbox!</h3>
                  <p class="sub-title">Subscribe to get the latest news and updates No spam promise.</p>
                  <?php #gravity_form(9, false, false, false, '', true, 200); ?>


                    <!--Zoho Campaigns Web-Optin Form's Header Code Starts Here-->
                    <script type="text/javascript" src="https://tgqv.maillist-manage.in/js/optin.min.js" onload="setupSF('sf3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67','ZCFORMVIEW',false,'light',false,'0')"></script>
                        <script type="text/javascript">
                        function runOnFormSubmit_sf3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67(th){
                              /*Before submit, if you want to trigger your event, "include your code here"*/
                        };
                        </script>

                        <style>
                        #customForm.quick_form_8_css * {
                              -webkit-box-sizing: border-box !important;
                              -moz-box-sizing: border-box !important;
                              box-sizing: border-box !important;
                              overflow-wrap: break-word
                        }
                        @media only screen and (max-width: 200px) {.quick_form_8_css[name="SIGNUP_BODY"] { width: 100% !important; min-width: 100% !important; margin: 0px auto !important; padding: 0px !important } }
                        @media screen and (min-width: 320px) and (max-width: 580px) and (orientation: portrait) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 300px !important; margin: 0px auto !important; padding: 0px !important } }
                        @media only screen and (max-device-width: 1024px) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 500px !important; margin: 0px auto !important } }
                        @media only screen and (max-device-width: 1024px) and (orientation: landscape) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 700px !important; margin: 0px auto !important } }
                        @media screen and (min-width: 475px) and (max-width: 980px) and (orientation: landscape) {.quick_form_8_css[name="SIGNUP_BODY"] { max-width: 400px !important; margin: 0px auto !important; padding: 0px !important } }
                        </style>

                        <!--Zoho Campaigns Web-Optin Form's Header Code Ends Here--><!--Zoho Campaigns Web-Optin Form Starts Here-->

                        <div id="sf3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67" data-type="signupform" style="opacity: 1;">
                        <div id="customForm">
                              <div class="quick_form_8_css blog-newsletter" name="SIGNUP_BODY">
                              <div>
                                 <!-- <span class="zoho-form-title-newsletter" style="font-family: Arial; font-weight: bold; color: rgb(9, 30, 66); text-align: left; padding: 10px 10px 5px; width: 100%; display: block; font-size: 16px; border-style: none; border-width: 1px; border-color: rgb(0, 108, 251)" id="SIGNUP_HEADING">Subscribe to SurveySensum Experience Newsletter</span> -->
                                 <div style="position:relative;">
                                 <div id="Zc_SignupSuccess" style="display:none;position:absolute;margin-left:4%;width:90%;background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154);  margin-top: 10px;margin-bottom:10px;word-break:break-all">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                          <tr>
                                          <td width="10%">
                                             <img class="successicon" src="https://tgqv.maillist-manage.in/images/challangeiconenable.jpg" align="absmiddle">
                                          </td>
                                          <td>
                                             <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px;word-break:break-word">&nbsp;&nbsp;Thank you for Signing Up</span>
                                          </td>
                                          </tr>
                                    </tbody>
                                    </table>
                                 </div>
                                 </div>
                                 <form method="POST" id="zcampaignOptinForm" style="margin: 0px; width: 100%;" action="https://maillist-manage.in/weboptin.zc" target="_zcSignup">
                                 <div class="zoho-newsletter-form" style="position: relative; margin: 0; display: inline-block; height: 44px; width: 314px;">
                                    <div id="Zc_SignupSuccess" style="position: absolute; width: 87%; background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154); margin-bottom: 10px; word-break: break-all; opacity: 1; display: none">
                                    <div style="width: 20px; padding: 5px; display: table-cell">
                                          <img class="successicon" src="https://campaigns.zoho.com/images/challangeiconenable.jpg" style="width: 20px">
                                    </div>
                                    <div style="display: table-cell">
                                          <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px; line-height: 30px; display: block"></span>
                                    </div>
                                    </div>
                                    <input type="text" style="border: 1px solid rgb(11, 95, 255);border-radius: 5px; width: 100%; height: 100%; z-index: 4; outline: none; padding: 5px 10px; color: rgb(0, 0, 0); text-align: left; font-family: Arial; background-color: rgb(255, 255, 255); box-sizing: border-box; font-size: 15px" placeholder="Enter email address*" changeitem="SIGNUP_FORM_FIELD" name="CONTACT_EMAIL" id="EMBED_FORM_EMAIL_LABEL">
                                 </div>
                                 <div class="zoho-newsletter-btn" style="position: relative; margin: 0 0 0 10px; text-align: left; display: inline-block; height: 44px; width: 112px;">
                                    <input type="button" style="text-align: center; border-radius: 5px; width: 100%; height: 100%; z-index: 5; border: 1px solid #0052cc; color: rgb(255, 255, 255); cursor: pointer; outline: none; font-weight:700;font-size: 14px; background-color: #0052cc; font-family: Arial" name="SIGNUP_SUBMIT_BUTTON" id="zcWebOptin" value="Subscribe">
                                 </div>
                                 <input type="hidden" id="fieldBorder" value="">
                                 <input type="hidden" id="submitType" name="submitType" value="optinCustomView">
                                 <input type="hidden" id="emailReportId" name="emailReportId" value="">
                                 <input type="hidden" id="formType" name="formType" value="QuickForm">
                                 <input type="hidden" name="zx" id="cmpZuid" value="1df85729cf">
                                 <input type="hidden" name="zcvers" value="2.0">
                                 <input type="hidden" name="oldListIds" id="allCheckedListIds" value="">
                                 <input type="hidden" id="mode" name="mode" value="OptinCreateView">
                                 <input type="hidden" id="zcld" name="zcld" value="171153763437531">
                                 <input type="hidden" id="zctd" name="zctd" value="">
                                 <input type="hidden" id="document_domain" value="">
                                 <input type="hidden" id="zc_Url" value="tgqv.maillist-manage.in">
                                 <input type="hidden" id="new_optin_response_in" value="0">
                                 <input type="hidden" id="duplicate_optin_response_in" value="0">
                                 <input type="hidden" name="zc_trackCode" id="zc_trackCode" value="ZCFORMVIEW">
                                 <input type="hidden" id="zc_formIx" name="zc_formIx" value="3z18938d901850824a5a5fe149e48f83e86c32d44363dfe2254860a48417c4ed67">
                                 <input type="hidden" id="viewFrom" value="URL_ACTION">
                                 <span style="display: none" id="dt_CONTACT_EMAIL">1,true,6,Contact Email,2</span>
                                 <!-- <div style="color: rgb(242, 100, 77); margin: 4px 0 0; border: 1px none rgb(255, 217, 211); opacity: 1; font-size: 12px; font-family: Arial; width: 202px; height: auto; display: none;font-weight:500;" id="errorMsgDiv">Email must be formatted correctly.
                                    <br>
                                 </div> -->
                                 </form>
                              </div>
                              </div>
                              <div style="display: none" id="unauthPageTitle">60001036812 - Form</div>
                        </div>
                        <img src="https://tgqv.maillist-manage.in/images/spacer.gif" id="refImage" onload="referenceSetter(this)" style="display:none;">
                        </div>
                        <input type="hidden" id="signupFormType" value="QuickForm_Horizontal">
                        <div id="zcOptinOverLay" oncontextmenu="return false" style="display:none;text-align: center; background-color: rgb(0, 0, 0); opacity: 0.5; z-index: 100; position: fixed; width: 100%; top: 0px; left: 0px; height: 988px;"></div>
                        <div id="zcOptinSuccessPopup" style="display:none;z-index: 9999;width: 800px; height: 40%;top: 84px;position: fixed; left: 26%;background-color: #FFFFFF;border-color: #E6E6E6; border-style: solid; border-width: 1px;  box-shadow: 0 1px 10px #424242;padding: 35px;">
                        <span style="position: absolute;top: -16px;right:-14px;z-index:99999;cursor: pointer;" id="closeSuccess">
                              <img src="https://tgqv.maillist-manage.in/images/videoclose.png">
                        </span>
                        <div id="zcOptinSuccessPanel"></div>
                        </div>
                        <!--Zoho Campaigns Web-Optin Form Ends Here-->
               </div>
            </div>
            <!-- End New pop up design -->

      <!-- Popup End -->
      <?php } ?>


<!-- Wrapper Start-->
<div class="wrapper" id="fullpage">







<!-- request-demo-modal modal -->
<div
   class="modal fade"
   id="request-demo-modal"
   tabindex="-1"
   role="dialog"
   aria-hidden="true"
   >
   <div class="modal-dialog zoho-crm" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h5 class="modal-title">Request Demo</h5>
            <!-- <script>
               hbspt.forms.create({
               portalId: "5773317",
               formId: "6fd95dec-2898-4d58-a4e2-9321bd9d5deb"
               });
            </script> -->

            
               <!-- Request demo lead zoho CRM forms -->
               <script src='https://crm.zoho.in/crm/WebFormServeServlet?rid=352c55ec96cbdf7d84d2272bd0e516a3081288b498205e2593d6d1f1cace32e7gid8c5a44735491abde9b3fadbeb4516583c356534e2bdc4d847ec7ffbccf95c3b6&script=$sYG'></script>

            <button
               type="button"
               class="close"
               data-dismiss="modal"
               aria-label="Close"
               >
            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/close-menu.svg" alt="SurveySensum" />
            </button>
         </div>
      </div>
   </div>
</div>



<!-- Talk to our CX Expert want-personalize-bottom section modal -->
<div
  class="modal fade"
  id="pricing-want-personalize-bottom"
  tabindex="-1"
  role="dialog"
  aria-hidden="true"
>
  <div class="modal-dialog zoho-crm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title">
          Get in Touch with our Expert
        </h5>

        <!-- <script>
          hbspt.forms.create({
            portalId: "5773317",
            formId: "75772099-1c5f-4fc9-996b-cc3dd3804909"
          });
        </script> -->

        <script src='https://crm.zoho.in/crm/WebFormServeServlet?rid=352c55ec96cbdf7d84d2272bd0e516a388627941f637f46cf2164276bc3fc4ddgid8c5a44735491abde9b3fadbeb4516583c356534e2bdc4d847ec7ffbccf95c3b6&script=$sYG'></script>

        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <img
            src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/close-menu.svg"
            alt="SurveySensum"
          />
        </button>
      </div>
    </div>
  </div>
</div>




<!-- WhatsApp Chat fab icon -->
<!-- <a href="https://api.whatsapp.com/send?phone=+919999062749&text=Hi%2C%20I%27d%20would%20like%20to%20connect%20with%20SurveySensum%20team." target="_blank" class="joinchat__button all-page-chat">
   <div class="fab-icon">
         <div class="joinchat__button__open">
               <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                     <path fill="#fff" d="M3.516 3.516c4.686-4.686 12.284-4.686 16.97 0 4.686 4.686 4.686 12.283 0 16.97a12.004 12.004 0 01-13.754 2.299l-5.814.735a.392.392 0 01-.438-.44l.748-5.788A12.002 12.002 0 013.517 3.517zm3.61 17.043l.3.158a9.846 9.846 0 0011.534-1.758c3.843-3.843 3.843-10.074 0-13.918-3.843-3.843-10.075-3.843-13.918 0a9.846 9.846 0 00-1.747 11.554l.16.303-.51 3.942a.196.196 0 00.219.22l3.961-.501zm6.534-7.003l-.933 1.164a9.843 9.843 0 01-3.497-3.495l1.166-.933a.792.792 0 00.23-.94L9.561 6.96a.793.793 0 00-.924-.445 1291.6 1291.6 0 00-2.023.524.797.797 0 00-.588.88 11.754 11.754 0 0010.005 10.005.797.797 0 00.88-.587l.525-2.023a.793.793 0 00-.445-.923L14.6 13.327a.792.792 0 00-.94.23z"></path>
               </svg>
         </div>
         <div class="joinchat__tooltip">
               <div>Chat with us</div>
         </div>
   </div>
</a> -->