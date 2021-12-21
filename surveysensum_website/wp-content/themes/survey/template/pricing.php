<?php

require_once ABSPATH . 'env/' . CURRENT_ENV . '.php';

abstract class Interval{
  const Day=1;
  const Week=2;
  const Month=3;
  const Year=4;
}
	/*==============================================================

		Template Name: Pricing

	==============================================================*/
get_header();?>

<?php

$curl = curl_init(getenv('ApiBaseUrl') . 'plans');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
  'X-Forwarded-For:'.$_SERVER['HTTP_X_REAL_IP']
]);

$response = curl_exec($curl);
// echo curl_getinfo($curl, CURLINFO_HTTP_CODE);
$plans=[];
$hide_plans_for = 'ID';

if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
  $plans=json_decode($response,true)['result'];
}

curl_close($curl);

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

  // setting countryCode to ID by default
  if ($ip_info['countryCode'] == NULL) {
    $ip_info['countryCode'] = $hide_plans_for;
  }
  // print_r($ip_info);
}

curl_close($curl);

?>



    <section class="price-banner">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="heading text-center">
              <h2>Only pay for the responses you want!</h2>
              <p>And use all the essential features to make your feedback actionable.</p>
            </div>
            <div class="sign-up-free-home">
              <a class="btn btn-secondary-bg lg" target="_blank" href="https://portal.surveysensum.com/register">Get Started for Free</a>
              <div class="no-credit-card">Or</div>
              <a
              href="javascript:void(0)"
              data-toggle="modal" data-target="#pricng-get-in-touch-premium" class="enterprice-ontact-us" id="enterprise-contact">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="price-top-feature">
      <div class="container">
        
        <div class="row">
          <div class="col-12">

            <div class="slide-with-feature">

              <div class="feature-wrapper">

                <div class="feature-list-main">

                  <div class="step-slider-main">
                  
                    <div class="slider-heading">How many responses are you expecting every month?</div>

                    <div class="slider-parent-section">

                      <div class="slider-parent-inner">
                        <div class="__range __range-step __range-step-popup">
                          <input value="2" type="range" max="8" min="1" step="1" list="ticks1">
                          <datalist id="ticks1">
                            <option value="1">50</option>
                            <option value="2">250</option>
                            <option value="3">750</option>
                            <option value="4">1500</option>
                            <option value="5">2500</option>
                            <option value="6">5000</option>
                            <option value="7">7500</option>
                            <option value="8">10000</option>
                          </datalist>
                          <output></output>
                          <span class="active-response"></span>
                          <ul class="response-text-bottom">
                            <li>50</li>
                            <li>250</li>
                            <li>750</li>
                            <li>1.5k</li>
                            <li>2.5k</li>
                            <li>5k</li>
                            <li>7.5k</li>
                            <li>10k</li>
                          </ul>
                        </div>
                        <div class="free-response_100">Free responses</div>
                      </div>

                      <div class="more-than-response">
                        <a href="https://www.surveysensum.com/contact-us" target="_blank">More than 10k?</a>
                      </div>
                    </div>
                    
                    <!-- dont delete this code -->
                    <!-- <div class="demo-output">
                      <input class="single-slider" type="hidden" value="0.0"/>
                    </div> -->

                    <div class="let-us-know">
                      Not able to decide responses? <a href="https://www.surveysensum.com/contact-us/" target="_blank">Let us Know</a>
                    </div>        
                  </div>

                  <div class="price-right-main">

                    <div class="save-money d-flex align-items-center">
                      <div class="togglex-btn d-flex align-items-center">

                        <div class="monthly">Monthly</div>
                        <label class="switch" id="toggle-plans">
                          <input type="checkbox" />
                          <span class="slider round"></span>
                        </label>
                        <div class="yearly">Yearly</div>

                      </div>
                      <!-- <div class="yearly save-twenty">(save 20%)</div> -->
                    </div>

                    <div class="price-boxes">
                      <div class="month-box box-common">
                        <div class="price-text">
                          <span>$</span><span class="get-price monthly"></span><span style="font-weight: normal;font-size: 26px;">/mo</span>
                        </div>
                        <div class="price-text dynamic">
                          Free
                        </div>
                        <div class="billed-as">Billed as <span class="total-price-monthly"></span>/yr</div>
                      </div>
                    </div>

                    <ul class="top-static-feature">
                      <li>
                        <span><img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt=""></span>
                        <div class="top-feature-item">
                          <span class="responses-text">300</span> responses<span class="month-text">/mo</span>
                        </div>
                      </li>
                      <li>
                        <span><img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt=""></span>
                        <div class="top-feature-item">
                          <span class="email-text">5,000</span> emails<span class="month-text">/mo</span>
                        </div>
                      </li>
                      <li>
                        <span><img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt=""></span>
                        <div class="top-feature-item">
                          Unlimited Surveys
                        </div>
                      </li>
                      <li>
                        <span><img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt=""></span>
                        <div class="top-feature-item">
                          Unlimited users
                        </div>
                      </li>
                      <li>
                        <span><img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt=""></span>
                        <div class="top-feature-item">
                          1 Free Expert Consultation on your survey
                        </div>
                      </li>
                    </ul>

                    <div class="sign-up-free-home">
                      <a class="btn btn-secondary-bg lg" target="_blank" href="https://portal.surveysensum.com/register">Get Started for Free</a>
                      <div class="no-credit-card">No credit card required</div>
                      <!-- <a
                      href="javascript:void(0)"
                      data-toggle="modal" data-target="#pricng-get-in-touch-premium" class="enterprice-ontact-us" id="enterprise-contact">Contact Us</a> -->
                    </div>
                  </div>

                </div>

                <div class="feature-list-main feature-content-list active">

                  <!-- Feature dynamic list -->
                  <div class="feature-list-repeat-items">

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Features included in this price:</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text"><span class="responses-text"></span> responses/mo</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text"><span class="email-text"></span> emails/mo</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Unlimited users</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">1 Free Expert Consultation on your survey</div>
                        </li>
                      </ul>
                    </div>

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Survey Creation and Design</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Unlimited number of surveys from templates NPS, CES, CSAT etc or you can start one from scratch</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">All types of Questions (Short text, Long text, Opinion Scale, Rating, Grid question, Number, Multiple choice, NPS, Image question etc)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Multilingual surveys( in up-to 55 languages)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Logic (Display/Jump)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Survey Appearance Customisation ( Background, Fonts, Button, CSS)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Upload/ Remove Brand Logo</div>
                        </li>
                      </ul>
                    </div>

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Survey Share</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Via Email, Website Embed, Link, Hubspot, Salesforce, Social Media.</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Via SMS & WhatsApp (additional cost) <a href="https://www.surveysensum.com/contact-us" target="_blank">Contact us</a></div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Offline Data Collection</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Send Reminders</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Custom Email domain</div>
                        </li>
                      </ul>
                    </div>

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Analysis and Reporting</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Export Data (CSV,PDF)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Share reports via url</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Segment data by using filters</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Text and sentiment analysis</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Cross- Tabs (NPS by region, plan etc)</div>
                        </li>
                      </ul>
                    </div>

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Dashboard</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Unlimited custom dashboards</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Create Customer Journey dashboards</div>
                        </li>
                      </ul>
                    </div>

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Integration and Open API</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Hubspot, Intercom, Slack, Zapier</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Email notifications ( Standard, Custom)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Custom Integrations <a href="https://www.surveysensum.com/contact-us/" target="_blank">Contact us</a></div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Open API Support</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Historical data migration</div>
                        </li>
                      </ul>
                    </div>

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Support and Training</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Self help articles and videos</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Onboard Support</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Email, Chat Support</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Dedicated CX Manager</div>
                        </li>
                      </ul>
                    </div>

                    <div class="feature-item-repeat">
                      <div class="feature-heading">Survey Settings</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Survey throttling (Restrict respondents to receive only 1. survey in x. Days)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Survey Access (Password Protected, Open Access, Invitation only)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Survey Submission (Partial, Multiple)</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Survey Expiration time</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Feature of Limiting number of Responses on survey</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Show/ Hide Questions numbers, progress bar</div>
                        </li>
                      </ul>
                    </div>

                  </div>

                  <div class="see-all-feature-btn">
                    <div  class="see-feature-text">
                      <span>View all features</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="7" viewBox="0 0 15.369 9.48">
                        <path  d="M16.622,18.755,11.563,13.7l5.059-5.059A1.3,1.3,0,0,0,14.783,6.8L8.8,12.783a1.3,1.3,0,0,0,0,1.838l5.984,5.984a1.3,1.3,0,0,0,1.838,0A1.326,1.326,0,0,0,16.622,18.755Z" transform="translate(-5.968 17.448) rotate(-90)" class="a" style="fill: #0052FF; stroke: #0052FF; stroke-width: 0.7px;"></path>
                      </svg>
                    </div>
                  </div>
                </div>

              </div>

              <div class="ads-ons-main">

                <div class="add-ons-heading">
                  <div class="add-ons-text">Add-ons</div>
                  <div class="sign-up">
                    <a class="btn btn-outline-secondary sm request-btn enterprice-ontact-us" data-toggle="modal" data-target="#pricng-get-in-touch-premium">Contact Us</a>
                  </div>
                </div>

                <div class="ads-ons-feature">
                  <div class="ads-ons-inner">
                    <div class="add-feature-left">
                      <div class="ads-feature-text">Hourly Consultation</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                               <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Understand what to ask, when to launch the survey, and what to do with the feedback.</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Get quarterly and monthly insights on the customer responses</div>
                        </li>
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">From implementation to execution, we’ll do everything for you.</div>
                        </li>
                      </ul>
                    </div>
                    <div class="add-ons-price">$10<span>/month</span></div>
                  </div>

                  <div class="ads-ons-inner">
                    <div class="add-feature-left">
                      <div class="ads-feature-text">Custom Integration</div>
                      <ul class="top-features-list">
                        <li>
                          <span class="price-check-img">
                            <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                          </span>
                          <div class="feature-text">Integrate SurveySensum with the platforms you use every day.</div>
                        </li>
                      </ul>
                    </div>
                    <div class="add-ons-price">$10<span>/month</span></div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Owl Carousal Client -->
    <section class="about-employee pricing-customer-caraousal">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="heading about-common-heading text-center">
                          <h2>Here’s what our customers say about us.</h2>
                        </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-12">
                        <div class="tab-content">
                              <div class="tab-pane fade show active">
                                    <div class="about-employee-inner">
                                          <div class="customer-feedback">
                                                <div class="container text-center">
                                                      <div class="row justify-content-center">
                                                            <div class="col-md-offset-3 col-md-8 col-sm-offset-2 col-sm-8">
                                                            <div class="owl-carousel feedback-slider customres-slider">
                                                                  <!-- slider item -->
                                                                  <div class="feedback-slider-item">
                                                                  <div class="media text-left">
                                                                        <div class="about-caraousal-img">
                                                                        <!-- <img class="center-block img-circle" src="<?php echo get_template_directory_uri()?>/homepage_assets/img/harry-hakim-clints.jpg" alt="Generic placeholder image"> -->
                                                                        <img class="center-block img-circle" src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/harry-hakim-clints.jpg">
                                                                        </div>
                                                                        <div class="media-body">
                                                                        <p>“SurveySensum provided us with a tool that allows us to manage the overall customer experience, include the customer’s voice into every major decision, and ultimately make the lives of our customers better.”</p>
                                                                        <h3 class="customer-name">Harry Hakim <br><span>Customer Experience Manager</span></h3>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                                  <!-- /slider item -->
                                                                  <!-- slider item -->
                                                                  <div class="feedback-slider-item">
                                                                  <div class="media text-left">
                                                                        <div class="about-caraousal-img">
                                                                        <img class="mr-3 center-block img-circle" src="https://www.surveysensum.com/wp-content/uploads/2021/11/1564161607774.jpg" alt="Generic placeholder image">
                                                                        </div>
                                                                        <div class="media-body">
                                                                        <p>“SurveySensum helps us in getting real-time insights into all our sales (before and after) and provides such a great experience to our customers that they are coming back to us. And loved its WhatsApp Integration and personalized auto alert emails especially!”</p>
                                                                        <h3 class="customer-name">Blandina Siregar <br><span>Head of Customer Relations</span></h3>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                                  <!-- /slider item -->
                                                                  <!-- slider item -->
                                                                  <div class="feedback-slider-item">
                                                                  <div class="media text-left">
                                                                        <div class="about-caraousal-img">
                                                                        <!-- <img class="mr-3 center-block img-circle" src="<?php echo get_template_directory_uri()?>/homepage_assets/img/Kym-holmes-clint.jpg" alt="SurveySensum"> -->
                                                                        <img class="mr-3 center-block img-circle" src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/Kym-holmes-clint.jpg">
                                                                        </div>
                                                                        <div class="media-body">
                                                                        <p>“Comprehensive Product and Great Support! Especially loved the contact management as it helps trace the feedback across a multi-location business.”</p>
                                                                        <h3 class="customer-name">Kym Holmes <br><span>Customer Engagement Manager at Evolve Group</span></h3>
                                                                        <div class="clients-logos">
                                                                              <!-- <img src="https://www.surveysensum.com/wp-content/uploads/2021/11/Indomobil.svg" class="img-fluid" alt=""> -->
                                                                        </div>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                                  <!-- /slider item -->
                                                                  <!-- slider item -->
                                                                  <div class="feedback-slider-item">
                                                                  <div class="media text-left">
                                                                        <div class="about-caraousal-img">
                                                                        <!-- <img class="mr-3 center-block img-circle" src="<?php echo get_template_directory_uri()?>/homepage_assets/img/Leo-Sukarto-clients.jpg" alt="SurveySensum"> -->
                                                                        <img class="mr-3 center-block img-circle" src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/Leo-Sukarto-clients.jpg">
                                                                        </div>
                                                                        <div class="media-body">
                                                                        <p>“We have increased our NPS score on 13 touch points since we started using SurveySensum.”</p>
                                                                        <h3 class="customer-name">Leo Sukarto <br><span>CX Manager at Allianz</span></h3>
                                                                        </div>
                                                                  </div>
                                                                  </div>
                                                                  <!-- /slider item -->
                                                            </div>
                                                            <!-- /End feedback-slider -->
                                                            <!-- side thumbnail -->
                                                            <div class="feedback-slider-thumb hidden-xs">
                                                                  <div class="thumb-prev">
                                                                  <span>
                                                                  <img src="https://www.surveysensum.com/wp-content/uploads/2021/11/1564161607774.jpg" alt="Customer Feedback">
                                                                  </span>
                                                                  <!-- <span class="light-bg customer-rating">
                                                                        5
                                                                        <i class="fa fa-star"></i>
                                                                        </span> -->
                                                                  </div>
                                                                  <div class="thumb-next">
                                                                  <span>
                                                                  <img src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/Kym-holmes-clint.jpg">
                                                                  </span>
                                                                  </div>
                                                            </div>
                                                            <!-- /side thumbnail -->
                                                            </div>
                                                            <!-- /End col -->
                                                      </div>
                                                      <!-- /End row -->
                                                </div>
                                                <!-- /End container -->
                                          </div>
                                          <!-- /End customer-feedback -->
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
    </section>

    <section class="feedback-section">
      <div class="container">
          
            <div class="row right-fit-content our-customers">
                  
                  <div class="col-12 col-md-6">
                        <div class="heading about-common-heading">
                              <!-- <h5>Our Customers</h5> -->
                              <h2>1175 CX PROFESSIONALS <br><span>are making feedback actionable with us</span></h2>
                        </div>
                        <ul class="feedback-ul">
                              <li>
                                    <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                                    <div class="help-main-points">
                                          <div class="help-descrition">392 companies signed up last month</div>
                                    </div>
                              </li>
                              <li>
                                    <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                                    <div class="help-main-points">
                                          <div class="help-descrition">Unlimited free access</div>
                                    </div>
                              </li>
                              <li>
                                    <img src="<?php echo get_template_directory_uri()?>/homepage_assets/img/svg/price-checked.svg" alt="">
                                    <div class="help-main-points">
                                          <div class="help-descrition">No credit card required</div>
                                    </div>
                              </li>
                        </ul>
                  </div>
                  <div class="col-12 col-md-6">
                        <div class="feedback-banner-img">
                              <img src="https://www.surveysensum.com/wp-content/themes/survey/homepage_assets/img/about-clients.png" alt="" class="img-fluid">
                        </div>
                  </div>
            </div>

      </div>
    </section>


    <!-- Frequently asked question pricing page section -->
    <section class="asked-question">
      <div class="container">
        <div class="row">
          <div class="col-12 customer-inner">
            <div class="heading text-center d-none d-sm-block d-lg-block">
              <h2>
                Frequently Asked Questions
              </h2>
            </div>
            <div class="heading text-center d-block d-sm-none d-lg-none">
              <h2>
                FAQs
              </h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="question-collapse">
              <div id="accordion">
                <div class="card">
                  <div
                    id="question2"
                    class="collapse"
                    aria-labelledby="headingTwo"
                    data-parent="#accordion"
                  >
                    <div class="card-body">
                      You will be eligible to get a refund only in case of
                      cancellation within 30 days of payment.
                    </div>
                  </div>
                  <div class="card-header" id="headingTwo">
                    <button class="btn btn-link collapsed position-relative">
                      <span>Do I get a refund upon cancellation?</span>
                      <div
                        class="common-plus-minus"
                        data-toggle="collapse"
                        data-target="#question2"
                        aria-expanded="false"
                        aria-controls="question2"
                      >
                        <div class="collapse-minus-plus">
                          <span class="plus">+</span>
                          <span class="minus">-</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>
                <div class="card">
                  <div
                    id="question3"
                    class="collapse"
                    aria-labelledby="headingThree"
                    data-parent="#accordion"
                  >
                    <div class="card-body">
                      Yes, you can import data from other sources and integrate
                      it with SurveySensum.
                    </div>
                  </div>
                  <div class="card-header" id="headingThree">
                    <button class="btn btn-link collapsed position-relative">
                      <span
                        >Can I import data from other feedback sources?</span
                      >
                      <div
                        class="common-plus-minus"
                        data-toggle="collapse"
                        data-target="#question3"
                        aria-expanded="false"
                        aria-controls="question3"
                      >
                        <div class="collapse-minus-plus">
                          <span class="plus">+</span>
                          <span class="minus">-</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>

                <div class="card">
                  <div
                    id="question4"
                    class="collapse"
                    aria-labelledby="headingThree"
                    data-parent="#accordion"
                  >
                    <div class="card-body">
                      We have specific discounts for NGOs and students. To know
                      more, please contact<a href="mailto:sales@surveysensum.com"> sales@surveysensum.com</a>
                    </div>
                  </div>
                  <div class="card-header" id="headingThree">
                    <button class="btn btn-link collapsed position-relative">
                      <span>Does my business qualify for discounts?</span>
                      <div
                        class="common-plus-minus"
                        data-toggle="collapse"
                        data-target="#question4"
                        aria-expanded="false"
                        aria-controls="question4"
                      >
                        <div class="collapse-minus-plus">
                          <span class="plus">+</span>
                          <span class="minus">-</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>

                <div class="card">
                  <div
                    id="question5"
                    class="collapse"
                    aria-labelledby="headingThree"
                    data-parent="#accordion"
                  >
                    <div class="card-body">
                      You can view the rest of the responses once you upgrade
                      your subscription.
                    </div>
                  </div>
                  <div class="card-header" id="headingThree">
                    <button class="btn btn-link collapsed position-relative">
                      <span
                        >What happens when I hit my response collection
                        limit?</span
                      >
                      <div
                        class="common-plus-minus"
                        data-toggle="collapse"
                        data-target="#question5"
                        aria-expanded="false"
                        aria-controls="question5"
                      >
                        <div class="collapse-minus-plus">
                          <span class="plus">+</span>
                          <span class="minus">-</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>

                <div class="card">
                  <div
                    id="question6"
                    class="collapse"
                    aria-labelledby="headingThree"
                    data-parent="#accordion"
                  >
                    <div class="card-body">
                      You can get constant support via email. Please direct your
                      questions to <a href="mailto:support@surveysensum.com">support@surveysensum.com </a>
                    </div>
                  </div>
                  <div class="card-header" id="headingThree">
                    <button class="btn btn-link collapsed position-relative">
                      <span
                        >How can I get in touch if I need help while using the
                        product?</span
                      >
                      <div
                        class="common-plus-minus"
                        data-toggle="collapse"
                        data-target="#question6"
                        aria-expanded="false"
                        aria-controls="question6"
                      >
                        <div class="collapse-minus-plus">
                          <span class="plus">+</span>
                          <span class="minus">-</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>

                <div class="card">
                  <div
                    id="question7"
                    class="collapse"
                    aria-labelledby="headingSeven"
                    data-parent="#accordion"
                  >
                    <div class="card-body">
                      Yes, you can. And we would love to serve you.
                    </div>
                  </div>
                  <div class="card-header" id="headingSeven">
                    <button class="btn btn-link collapsed position-relative">
                      <span
                        >If we start with the monthly billing, can we move on to the annual billing in the future?</span
                      >
                      <div
                        class="common-plus-minus"
                        data-toggle="collapse"
                        data-target="#question7"
                        aria-expanded="false"
                        aria-controls="question7"
                      >
                        <div class="collapse-minus-plus">
                          <span class="plus">+</span>
                          <span class="minus">-</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>

                <div class="card">
                  <div
                    id="question8"
                    class="collapse"
                    aria-labelledby="headingEight"
                    data-parent="#accordion"
                  >
                    <div class="card-body">
                    Yes, we will reimburse the remaining months' account. However, a small amount of the bank's transaction fee will be charged.
                    </div>
                  </div>
                  <div class="card-header" id="headingEight">
                    <button class="btn btn-link collapsed position-relative">
                      <span
                        >Will the amount of the remaining months be reimbursed if we can cancel our annual billing?</span
                      >
                      <div
                        class="common-plus-minus"
                        data-toggle="collapse"
                        data-target="#question8"
                        aria-expanded="false"
                        aria-controls="question8"
                      >
                        <div class="collapse-minus-plus">
                          <span class="plus">+</span>
                          <span class="minus">-</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="d-flex pricing-question-answer">
              <div class="question-mark-img">
                <h6 class="question-query">Didn’t find the answer you were looking for?</h6>
                <p><a id="pricing-query">Tell us your query</a> and we’ll get back to you!</p>

                <!-- <h6 class="question-query-mob">
                  Your query has been submitted. <br /><br />
                  Our CX expert will get back to you in a short while!
                </h6> -->
                <!-- <div class="question-img">
                  <img
                    src="<?php #echo get_template_directory_uri() ?>/homepage_assets/img/svg/form-question-img.svg"
                    alt=""
                    class="img-fluid question-img-single"
                  />
                  <img
                  src="<?php #echo get_template_directory_uri() ?>/homepage_assets/img/svg/form-question-img-Submission.svg"
                  alt=""
                  class="img-fluid submission-img"
                />
                </div> -->
              </div>

              <!-- Pricing Plans page form bottom -->
              <div class="question-form">
              <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-query.svg" alt="" class="img-fluid pricing-query-img"
                />
                <!-- <script>
                  hbspt.forms.create({
                    portalId: "5773317",
                    formId: "f242496d-b8af-4b3e-a29d-a70bdec28e33",
                    
                    onFormSubmit: function($form) {
                      var faqQuestion = document.getElementById('pricing-question-answer');
                      faqQuestion.classList.add('pricingQueryAdded');
                    }
                  });
                </script> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Frequently asked question pricing page section -->

    <!-- NPS Customer experiance expert section  -->
    <section class="customer-experiance-expert nps-personalize">
      <div class="container">
        <div class="row">
          <div class="col-12 customer-experiance-inner">
            <div class="heading text-center">
              <h2 class="position-relative">
                Want personalized Customer Experience programs for your
                Business?
                <img
                  src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/before-top-dot.svg"
                  class="position-absolute"
                  alt=""
                />
              </h2>
              <a
                class="btn btn-secondary lg"
                id="talk-to-expert-pricing"
                href="#"
                data-toggle="modal"
                data-target="#pricing-want-personalize-bottom"
                >Talk to our Expert Now</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End NPS Customer experiance expert section -->
    



<?php get_footer(); ?>

      <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



<script>

// jQuery('.single-slider').jRange({
//     from: -2.0,
//     to: 2.0,
//     step: 1,
//     scale: [100,300,800,1200,10000],
//     format: '%s',
//     width: 500,
//     showLabels: true,
//     snap: true
// });

jQuery(document).ready(function($) {

    // Customres tab owl carousal
    var feedbackSlider = $(".feedback-slider");
    feedbackSlider.owlCarousel({
          items: 1,
          nav: true,
          dots: true,
          // autoplay: true,
          loop: true,
          mouseDrag: true,
          touchDrag: true,
          navText: [
                '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14.828" viewBox="0 0 18 14.828"><g transform="translate(1 1.414)"><path d="M0,0H16" transform="translate(0 6)" fill="none" stroke="#091b42" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"></path><path d="M0,0,6,6,0,12" transform="translate(10)" fill="none" stroke="#091b42" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14.828" viewBox="0 0 18 14.828"><g transform="translate(1 1.414)"><path d="M0,0H16" transform="translate(0 6)" fill="none" stroke="#091b42" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"></path><path d="M0,0,6,6,0,12" transform="translate(10)" fill="none" stroke="#091b42" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg>'
          ],
          responsive: {
                // breakpoint from 767 up
                767: {
                      nav: true,
                      dots: false
                }
          }
    });

        feedbackSlider.on("changed.owl.carousel", function (property) {

              var current = property.item.index;

              var prevThumb = $(property.target)
                    .find(".owl-item")
                    .eq(current)
                    .prev()
                    .find("img")
                    .attr("src");

              var nextThumb = $(property.target)
                    .find(".owl-item")
                    .eq(current)
                    .next()
                    .find("img")
                    .attr("src");

              $(".thumb-prev").find("img").attr("src", prevThumb);
              $(".thumb-next").find("img").attr("src", nextThumb);

        });

        $(".thumb-next").on("click", function () {
              feedbackSlider.trigger("next.owl.carousel", [500]);
              return false;
        });

        $(".thumb-prev").on("click", function () {
              feedbackSlider.trigger("prev.owl.carousel", [500]);
              return false;
        });


        }); //end ready
</script>



<!-- Talk to our CX pricng-get-in-touch-Premium modal or pricing page contact us call multiple places -->
<div
  class="modal fade"
  id="pricng-get-in-touch-premium"
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

        <script src='https://crm.zoho.in/crm/WebFormServeServlet?rid=352c55ec96cbdf7d84d2272bd0e516a30b38dc99621fdbb5730c8fddbd45fe3bgid8c5a44735491abde9b3fadbeb4516583c356534e2bdc4d847ec7ffbccf95c3b6&script=$sYG'></script>

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
<!-- <a href="https://api.whatsapp.com/send?phone=+919999062749&text=Hi%2C%20I%27d%20would%20like%20to%20know%20more%20about%20the%20pricing%20of%20SurveySensum." target="_blank" class="joinchat__button">
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


