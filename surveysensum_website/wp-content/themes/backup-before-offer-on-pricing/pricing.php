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

<?php

$defaultInterval=Interval::Year;

$currentSymbol= NULL;

foreach ($GLOBALS['plans'] as $plan) {
  if (!empty($plan['currencySymbol'])) {
    $currentSymbol=$plan['currencySymbol'];
    break;
  }
}

function getFreePlan(){
  $freePlan= array_filter($GLOBALS['plans'],function($plan) {
    return $plan['amount'] == 0 && !$plan['isHidden'];
  });

  if (count($freePlan) > 0) {
    return array_pop(array_reverse($freePlan));
  } else{
    return [];
  }
}

function getEnterprisePlan(){
  $enterprisePlan= array_filter($GLOBALS['plans'],function($plan) {
    return $plan['amount'] == -1000;
  });

  if (count($enterprisePlan) > 0) {
    return array_pop(array_reverse($enterprisePlan));
  } else{
    return [];
  }
}

function priceSort($planA, $planB)
{
  if ($planA['amount']==$planB['amount']) return 0;
  return ($planA['amount'] < $planB['amount'])? -1 : 1;
}

function getPaidPlans(){
  $paidPlans= array_filter($GLOBALS['plans'],function($plan) {
    return $plan['amount'] > 0 && $plan['interval'] === $GLOBALS['defaultInterval'];
  });

  usort($paidPlans, "priceSort");

  return $paidPlans;
}


?>

<script>
/* Interval enum */
const Interval = {
  Day: 1,
  Week: 2,
  Month : 3,
  Year : 4
};

  var switchStatus = true;
  var currencySymbol="<?php echo $currentSymbol; ?>";
  var selectedInterval=<?php echo $defaultInterval; ?>;
  var highPrices={
    '5e1f5fe20c84813c580efbb8':{ // starter plan
          3:89,
          4:79
      },
      '5ee864e0e95d16d265969e16':{ // professional plan
          3:224,
          4:199
      }

  };

  var plansTopFeaturesMap={
    "5e1f5fe20c84813c580efbb8":["Unlimited Surveys", "2000 responses per month", "3 Team members", "Advanced Email workflows", "Unlimited Questions", "SurveySensum Branding Removed"],
    "5ee864e0e95d16d265969e16":["10000 responses per month", "10 Team members", "Open API", "Integrations (Slack +Intercom/Hubspot)", "Text Analysis"]
 };

  (function ($) {
  "use strict";

    //*************** Monthly and yearly plans and country wise change Price ******************
  function getPlanPrice(plan){
    // let price=currencySymbol;
    let price='';
    if (plan['interval'] === Interval.Month) {
      price += plan['amount']/100;
    } else if(plan['interval'] === Interval.Year){
      price += plan['amount']/1200;
    }
    return price;
  }

  function renderPlanPrices(){
    $('[data-planid]').each(function(){
      const planId=$(this).attr('data-planid');
      const plan=plans.find((plan)=>plan.ssPlanId === planId && selectedInterval === plan.interval);

      $(this).find('.strikethrough-text>span').html(currencySymbol+highPrices[plan.ssPlanId][selectedInterval]);

      $(this).find('.price-change-monthly').html(getPlanPrice(plan));

      $(this).find('.creditCardRequired>span').html(selectedInterval === Interval.Year ? ', billed annually':'');

    });
  }

  function renderPaidPlanFeatures(){
    $('[data-planid]').each(function(){
      const planId=$(this).attr('data-planid');
      for(const featureText of plansTopFeaturesMap[planId]){
        $(this).find('table[top-features]>tbody').append(`
      <tr>
        <td class="feature-name">
          <div>${featureText}</div>
        </td>
      </tr>
      `);
      }
    });
  }

  function changeInterval(newInterval){
    selectedInterval=newInterval;
    renderPlanPrices();
  }
  
  const plans=<?php echo json_encode($GLOBALS['plans']); ?>;
  
  $(document).ready(function() {
    renderPlanPrices();
    renderPaidPlanFeatures();
    $('#toggle-plans input[type="checkbox"]').on('change',function(){
		if (switchStatus) {
      switchStatus = false;
      changeInterval(Interval.Month);
      $('#basic-signup-free').addClass("basic-signup-monthly");
      $('#Starter').addClass("Starter-signup-monthly");
      $('#Professional').addClass("Professional-signup-monthly");
      $('#enterprise-contact').addClass("enterprise-contact-signup-monthly");
		}
		else {
      switchStatus = true;
      changeInterval(Interval.Year);
      $('#basic-signup-free').removeClass("basic-signup-monthly");
      $('#Starter').removeClass("Starter-signup-monthly");
      $('#Professional').removeClass("Professional-signup-monthly");
      $('#enterprise-contact').removeClass("enterprise-contact-signup-monthly");
    }
    renderPlanPrices();
  });


  });
	//*************** End Monthly and yearly plans and country wise change Price ******************

})(jQuery);


</script>

   <!-- Simple plan pricing section1 -->
   <section class="simple-plan">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading text-center">
              <h2>
                Start with a free plan now and upgrade later!
              </h2>
              <p>
                We help small and medium enterprises in making feedback actionable
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="plan-tab">
        <nav>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="nav nav-tabs pricing-tab" role="tablist">
                  <a
                    class="nav-item nav-link active"
                    id="nav-home-tab"
                    data-toggle="tab"
                    href="#nav-home"
                    role="tab"
                    aria-controls="nav-home"
                    >CX PLATFORM</a
                  >
                  <a
                    class="nav-item nav-link"
                    id="nav-profile-tab"
                    data-toggle="tab"
                    href="#nav-profile"
                    role="tab"
                    aria-controls="nav-profile"
                    >ANALYTICS</a
                  >
                </div>
              </div>
            </div>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="container-fluid-custom-tab">
            <div class="row-custom-tab">
              <div class="col-md-12-custom-tab">
                <div class="tab-content">
                  <div
                    class="tab-pane fade show active"
                    id="nav-home"
                    role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    
                    <div class="cx-platform">

                      <div class="top-cards-large">
                        <div class="save-money d-flex align-items-center">
                          <div class="togglex-btn d-flex align-items-center">

                            <div class="yearly">View annual</div>
                            <label class="switch mx-3" id="toggle-plans">
                              <input type="checkbox" />
                              <span class="slider round"></span>
                            </label>
                            <div class="monthly">View monthly</div>

                          </div>
                          <!-- <div class="yearly save-twenty">(save 20%)</div> -->
                        </div>
                        <div class="plans-pricing position-relative">
                          <div class="plans-section">

                            <!-- Desktop & Mobile Pricing Cards, Manage for mobile view -->
                            <div class="plans-card-main new-cards-plans">
                              <div class="plans-card">

                                <!-- For lange main cards -->
                                <!-- Basic Card -->
                                <div class="card large-card-top <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>">
                                  <div class="card-body">

                                      <h3 class="card-title"><?php echo getFreePlan()['name'];?></h3>
                                      <p class="card-text"><?php echo getFreePlan()['description'];?></p>

                                      <div class="strikethrough-main strike-d-block-none">
                                          <h4 class="amount-free year-months-text">
                                            <div class="priceChange">
                                                <span class="dollorSign"><?php echo $currentSymbol; ?></span>
                                                <span class="price-change-monthly">0</span>
                                            </div>
                                            <div class="creditCardRequired">No credit card required</div>
                                          </h4>
                                      </div>
                                      <a href="https://portal.surveysensum.com/register" class="btn btn-outline-primary lg" id="basic-signup-free">Sign up for Free</a>

                                      <div class="new-cards-feature">
                                        <div class="includes-heading">Includes:</div>
                                        <div class="plans-card-main">
                                          <div class="plans-card repeat-card pb-0">
                                            <table class="table default-feature">
                                              <tbody>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    3 Surveys
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    100 responses per month
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Slack Integration
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Manual Tagging
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Collect Feedback from Website
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Open API
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                     Survey logic (Display/Jump)
                                                    </div>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>

                                <!-- Pro Card -->
                                <?php $previousPlan=null; ?>
                                <?php foreach(getPaidPlans() as $plan): ?>
                                <div class="card large-card-top <?php if($plan['isBestValue'] == True){echo 'active';} ?> <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>" <?php echo 'data-planid="'.$plan['ssPlanId'].'"';?>>
                                  <div class="card-body">

                                    <h3 class="card-title"><?php echo $plan['name']; ?></h3>
                                    <p class="card-text"><?php echo $plan['description']; ?></p>

                                    <div class="strikethrough-main strike-d-block-none">
                                        <h4 class="amount-free year-months-text">
                                            <div class="priceChange">
                                                  <span class="dollorSign"><?php echo $currentSymbol; ?></span>
                                                  <span class="price-change-monthly"></span>
                                            </div>
                                            <div class="creditCardRequired">per month<span></span></div>
                                        </h4>
                                    </div>

                                    <a href="https://portal.surveysensum.com/register" class="btn btn-outline-primary lg other-country-content" id="<?php echo $plan['name']; ?>">Buy Now</a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#request-demo-modal" class="btn btn-outline-primary lg indonesia-content" id="<?php echo $plan['name']; ?>">Request Demo</a>

                                    <div class="new-cards-feature">
                                      <div class="includes-heading">Everything in 
                                      <?php
                                          if ($previousPlan === null) {
                                            echo getFreePlan()["name"];
                                          } else {
                                            echo $previousPlan["name"];
                                          }
                                          $previousPlan=$plan
                                      ?>, plus:</div>


                                      <div class="plans-card-main">
                                        <div class="plans-card repeat-card pb-0">
                                          <table top-features class="table default-feature">
                                            <tbody>
                                              <!-- top features will be added automatically from JS -->
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="popular-text">MOST POPULAR</div>
                                </div>
                                <?php endforeach; ?>

                                <!-- Premium Card -->
                                <div class="card premium large-card-top <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>">
                                  <div class="card-body">
                                    <h3 class="card-title">Enterprise</h3>
                                    <p class="card-text">
                                    Personalised CX soultions
                                    </p>
                                    <div class="strikethrough-main">
                                      <h4 class="amount-free">
                                        <div class="enterprice-icon-in">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="46.838" height="44.361" viewBox="0 0 46.838 44.361">
                                            <g transform="translate(0 -0.173)">
                                              <g transform="translate(0 0.173)">
                                                  <path style="fill:#091e42;" d="M3.123,34.929V24H2.342A2.342,2.342,0,0,0,0,26.342v6.245a2.342,2.342,0,0,0,2.342,2.342Z" transform="translate(0 -5.4)"/>
                                                  <rect style="fill:#091e42;" width="6.245" height="15.613" rx="2" transform="translate(35.909 16.258)"/>
                                                  <path style="fill:#091e42;" d="M56.781,24H56V34.929h.781a2.342,2.342,0,0,0,2.342-2.342V26.342A2.342,2.342,0,0,0,56.781,24Z" transform="translate(-12.285 -5.4)"/>
                                                  <path style="fill:#091e42;" d="M11.364,14.87a14.051,14.051,0,0,1,27.712,0H42.2a17.174,17.174,0,0,0-33.989,0h3.123Z" transform="translate(-1.801 -0.173)"/>
                                                  <path style="fill:#091e42;" d="M7.561,36.613h.781v3.9a7.026,7.026,0,0,0,7.026,7.026h3.263a2.342,2.342,0,0,0,2.2,1.561h7.806a2.342,2.342,0,0,0,0-4.684H20.832a2.342,2.342,0,0,0-2.2,1.561H15.368A5.464,5.464,0,0,1,9.9,40.516v-3.9h.781a1.561,1.561,0,0,0,1.561-1.561V22.561A1.561,1.561,0,0,0,10.684,21H7.561A1.561,1.561,0,0,0,6,22.561v12.49A1.561,1.561,0,0,0,7.561,36.613Z" transform="translate(-1.316 -4.742)"/>
                                              </g>
                                            </g>
                                          </svg>
                                        </div>
                                        <div class="creditCardRequired">Tailor-made for your needs</div>
                                      </h4>
                                    </div>

                                    <a
                                      href="javascript:void(0)"
                                      data-toggle="modal"
                                      data-target="#request-demo-modal"
                                      class="btn btn-outline-primary lg indonesia-content" id="enterprise-contact">Request Demo</a>

                                      <a
                                      href="javascript:void(0)"
                                      data-toggle="modal"
                                      data-target="#pricng-get-in-touch-premium"
                                      class="btn btn-outline-primary lg other-country-content" id="enterprise-contact">Contact Us</a>

                                    <div class="new-cards-feature">
                                        <div class="includes-heading">Everything in Pro, plus:</div>
                                        <div class="plans-card-main">
                                          <div class="plans-card repeat-card pb-0">
                                            <table class="table default-feature">
                                              <tbody>

                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Quarterly Research Insights
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Close loop alert system
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Implementation services
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Unlimited Responses
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Custom DashBoards
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                      Collect via in-app, website, SMS & WhatsApp
                                                      <span class="new-badge">New</span>
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="feature-name">
                                                    <div>
                                                    Custom CRM Integrations
                                                    </div>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                    </div>

                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>


                        
                        <div class="allPlans-Collapse-main-mob">

                          <a class="allPlans-Collapse-main" href="<?php echo get_template_directory_uri() ?>/homepage_assets/SS-pricing-Features.pdf" target="_blank">
                            <span>Compare all plans</span>
                            <div class="dropdown-icon-mob">
                              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 18 18">
                                <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                <path style="fill:#0052cc;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                              </svg>
                            </div>
                          </a>
                        </div>

                      </div>

                      <div class="small-cards-bottom">
                        <div class="plans-pricing scroll-fixedPrice position-relative smallCardsNew">

                          <!-- Scoll fixed plan -->
                          <div class="scroll-pricing-cards pricing-plans-row__sticky_wrapper">
                            <div class="container-fixed-cards">
                                  <div class="plans-section">
                                    <div class="plans-card-main">
                                      
                                      <div class="plans-card d-flex cards-mob-desktop">

                                        <div class="plans-text-left-main">
                                          <div class="plans-text">
                                            Compare plans, side by side
                                          </div>
                                          <div class="collapse-all">Collapse all</div>
                                        </div>

                                        <!-- Basic Card -->
                                        <div class="card <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>">
                                          <div class="card-body">

                                              <h3 class="card-title"><?php echo getFreePlan()['name'];?></h3>
                                              <div class="strikethrough-main strike-d-block-none">
                                                  <h4 class="amount-free year-months-text">
                                                    <div class="priceChange">
                                                        <span class="dollorSign"><?php echo $currentSymbol; ?></span>
                                                        <span class="price-change-monthly">0</span>
                                                    </div>
                                                  </h4>
                                              </div>
                                              <a href="https://portal.surveysensum.com/register" class="btn btn-outline-primary lg request-pricing-small" id="basic-signup-free-3">Sign up for Free</a>
                                          </div>
                                        </div>

                                        <!-- Pro Card -->
                                        <?php foreach(getPaidPlans() as $plan): ?>
                                          <div class="card <?php if($plan['isBestValue'] == True){echo 'active';} ?> <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>" <?php echo 'data-planid="'.$plan['ssPlanId'].'"';?>>
                                            <div class="card-body">
                                              <h3 class="card-title"><?php echo $plan['name']; ?></h3>
                                              <!-- <p class="card-text"><?php #echo $plan['description']; ?></p> -->

                                            

                                              <div class="strikethrough-main strike-d-block-none">
                                                  <h4 class="amount-free year-months-text">
                                                    <div class="priceChange">
                                                        <span class="dollorSign"><?php echo $currentSymbol; ?></span>
                                                        <span class="price-change-monthly"></span>
                                                    </div>
                                                  </h4>
                                              </div>

                                              
                                              <a href="https://portal.surveysensum.com/register" class="btn btn-outline-primary lg other-country-content" id="professional-buy">Buy Now</a>
                                              <a href="javascript:void(0)" data-toggle="modal" data-target="#request-demo-modal" class="btn btn-outline-primary lg indonesia-content request-pricing-small" id="professional-buy">Request Demo</a>

                                            </div>
                                            <div class="popular-text">MOST POPULAR</div>
                                          </div>
                                        <?php endforeach; ?>

                                        <!-- Premium Card -->
                                        <div class="card premium <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>">
                                          <div class="card-body">
                                            <h3 class="card-title">Enterprise</h3>
                                            <!-- <p class="card-text">
                                            Personalised CX soultions
                                            </p> -->
                                            <div class="strikethrough-main">
                                              <h4 class="amount-free">
                                                <div class="enterprice-icon-in">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="34" height="32.202" viewBox="0 0 34 32.202">
                                                    <g style="opacity:0.87;" transform="translate(0 -0.173)">
                                                      <g transform="translate(0 0.173)">
                                                        <path style="fill:#091e42;" d="M2.267,31.933V24H1.7A1.7,1.7,0,0,0,0,25.7v4.533a1.7,1.7,0,0,0,1.7,1.7Z" transform="translate(0 -10.498)"/>
                                                        <rect style="fill:#091e42;" width="4.533" height="11.333" rx="2" transform="translate(26.067 11.802)"/>
                                                        <path style="fill:#091e42;" d="M56.567,24H56v7.933h.567a1.7,1.7,0,0,0,1.7-1.7V25.7A1.7,1.7,0,0,0,56.567,24Z" transform="translate(-24.267 -10.498)"/>
                                                        <path style="fill:#091e42;" d="M10.5,10.842a10.2,10.2,0,0,1,20.117,0h2.267a12.467,12.467,0,0,0-24.673,0h2.267Z" transform="translate(-3.558 -0.173)"/>
                                                        <path style="fill:#091e42;" d="M7.133,32.333H7.7v2.833a5.1,5.1,0,0,0,5.1,5.1h2.369a1.7,1.7,0,0,0,1.6,1.133h5.667a1.7,1.7,0,1,0,0-3.4H16.767a1.7,1.7,0,0,0-1.6,1.133H12.8a3.967,3.967,0,0,1-3.967-3.967V32.333H9.4A1.133,1.133,0,0,0,10.533,31.2V22.133A1.133,1.133,0,0,0,9.4,21H7.133A1.133,1.133,0,0,0,6,22.133V31.2A1.133,1.133,0,0,0,7.133,32.333Z" transform="translate(-2.6 -9.198)"/>
                                                      </g>
                                                    </g>
                                                  </svg>
                                                </div>
                                              </h4>
                                            </div>

                                            <a
                                              href="javascript:void(0)"
                                              data-toggle="modal"
                                              data-target="#request-demo-modal"
                                              class="btn btn-outline-primary lg indonesia-content request-pricing-small" id="enterprise-contact-2"
                                              >Request Demo</a>

                                               <a
                                              href="javascript:void(0)"
                                              data-toggle="modal"
                                              data-target="#pricng-get-in-touch-premium"
                                              class="btn btn-outline-primary lg other-country-content" id="enterprise-contact-2"
                                              >Contact Us</a>
                                          </div>
                                        </div>

                                      </div>

                                    </div>
                                  </div>
                            </div>
                          </div>
                          <!-- End Scoll fixed plan -->


                          <div class="plans-section small-cards-bottomNew pdf-mob" id="cards-pdf-mob">
                            <!-- Desktop & Mobile Pricing Cards, Manage for mobile view -->

                            <div class="plans-card-main">

                              <div class="plans-card d-flex cards-mob-desktop">

                                  <div class="plans-text-left-main">
                                    <div class="plans-text">
                                      Compare plans, side by side
                                    </div>
                                    <div class="collapse-all">Collapse all</div>
                                  </div>

                                  <!-- Basic Card -->
                                  <div class="card pdf-card <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>">
                                    <div class="card-body">

                                        <h3 class="card-title"><?php echo getFreePlan()['name'];?></h3>
                                        <div class="strikethrough-main strike-d-block-none">
                                            <h4 class="amount-free year-months-text">
                                              <div class="priceChange">
                                                  <span class="dollorSign">$</span>
                                                  <span class="price-change-monthly">0</span>
                                              </div>
                                            </h4>
                                        </div>
                                        <a
                                          href="https://portal.surveysensum.com/register"
                                          class="btn btn-outline-primary lg request-pricing-small" id="basic-signup-free-3">Sign up for Free</a>

                                    </div>
                                  </div>

                                  <!-- Pro Card -->
                                  <?php foreach(getPaidPlans() as $plan): ?>
                                    <div class="card pdf-card <?php if($plan['isBestValue'] == True){echo 'active';} ?> <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>" <?php echo 'data-planid="'.$plan['ssPlanId'].'"';?>>
                                      <div class="card-body">
                                        <h3 class="card-title"><?php echo $plan['name']; ?></h3>
                                        <!-- <p class="card-text"><?php #echo $plan['description']; ?></p> -->

                                        <div class="strikethrough-main strike-d-block-none">
                                            <h4 class="amount-free year-months-text">
                                              <div class="priceChange">
                                                  <span class="dollorSign"><?php echo $currentSymbol; ?></span>
                                                  <span class="price-change-monthly"></span>
                                              </div>
                                            </h4>
                                        </div>
                                        
                                        <a href="https://portal.surveysensum.com/register" class="btn btn-outline-primary lg other-country-content" id="buy-now-3">Buy Now</a>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#request-demo-modal" class="btn btn-outline-primary lg indonesia-content request-pricing-small" id="buy-now-3">Request Demo</a>

                                      </div>
                                      <div class="popular-text">MOST POPULAR</div>
                                    </div>
                                  <?php endforeach; ?>

                                  <!-- Premium Card -->
                                  <div class="card premium pdf-card <?php if($ip_info['countryCode'] == $hide_plans_for){echo 'hide-price';} ?>">
                                    <div class="card-body">
                                      <h3 class="card-title">Enterprise</h3>
                                      <!-- <p class="card-text">
                                      Personalised CX soultions
                                      </p> -->
                                      <div class="strikethrough-main">
                                        <h4 class="amount-free">
                                          <div class="enterprice-icon-in">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="32.202" viewBox="0 0 34 32.202">
                                              <g style="opacity:0.87;" transform="translate(0 -0.173)">
                                                <g transform="translate(0 0.173)">
                                                  <path style="fill:#091e42;" d="M2.267,31.933V24H1.7A1.7,1.7,0,0,0,0,25.7v4.533a1.7,1.7,0,0,0,1.7,1.7Z" transform="translate(0 -10.498)"/>
                                                  <rect style="fill:#091e42;" width="4.533" height="11.333" rx="2" transform="translate(26.067 11.802)"/>
                                                  <path style="fill:#091e42;" d="M56.567,24H56v7.933h.567a1.7,1.7,0,0,0,1.7-1.7V25.7A1.7,1.7,0,0,0,56.567,24Z" transform="translate(-24.267 -10.498)"/>
                                                  <path style="fill:#091e42;" d="M10.5,10.842a10.2,10.2,0,0,1,20.117,0h2.267a12.467,12.467,0,0,0-24.673,0h2.267Z" transform="translate(-3.558 -0.173)"/>
                                                  <path style="fill:#091e42;" d="M7.133,32.333H7.7v2.833a5.1,5.1,0,0,0,5.1,5.1h2.369a1.7,1.7,0,0,0,1.6,1.133h5.667a1.7,1.7,0,1,0,0-3.4H16.767a1.7,1.7,0,0,0-1.6,1.133H12.8a3.967,3.967,0,0,1-3.967-3.967V32.333H9.4A1.133,1.133,0,0,0,10.533,31.2V22.133A1.133,1.133,0,0,0,9.4,21H7.133A1.133,1.133,0,0,0,6,22.133V31.2A1.133,1.133,0,0,0,7.133,32.333Z" transform="translate(-2.6 -9.198)"/>
                                                </g>
                                              </g>
                                            </svg>
                                          </div>
                                        </h4>
                                      </div>

                                      <!-- pricng-get-in-touch-premium -->
                                      <a
                                        href="javascript:void(0)"
                                        data-toggle="modal"
                                        data-target="#request-demo-modal"
                                        class="btn btn-outline-primary lg indonesia-content request-pricing-small" id="enterprise-contact-3">Request Demo</a>

                                        <a
                                        href="javascript:void(0)"
                                        data-toggle="modal"
                                        data-target="#pricng-get-in-touch-premium"
                                        class="btn btn-outline-primary lg other-country-content" id="enterprise-contact-3">Contact Us</a>

                                    </div>
                                  </div>

                              </div>

                            </div>

                            <!-- All Features Data Section is here -->
                            <div class="feature-overview-table">

                              <div class="all-table-collapse">

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Survey Creation</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Number of Surveys</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                              Ready to use, customisable templates with automatic dashboards for response analysis
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>3</td>
                                                          <td>Unlimited</td>
                                                          <td>Unlimited</td>
                                                          <td>Unlimited</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Number of Responses</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Number of responses that are accessible to the user. The limit is inclusive of responses from all surveys across all distribution channels.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>100 responses per month</td>
                                                          <td>2000 responses per month</td>
                                                          <td>10000 responses per month</td>
                                                          <td>Unlimited Responses</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Survey length</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                              We offer variety of question and survey types to conduct polls, surveys, product feedback etc
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>Upto 10 questions</td>
                                                          <td>Unlimited</td>
                                                          <td>Unlimited</td>
                                                          <td>Unlimited</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Multilingual Surveys</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                              Create surveys in multiple languages. Share in different geographies and see how each group responds to multilingual surveys
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line">
                                                              <span></span>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Survey logic (Display/Jump)</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Make your surveys intuitive by adding logic to the survey structure
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Email notifcations</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Automate email notifications with event triggers
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>&nbsp;</td>
                                                          <td>Templated</td>
                                                          <td>Custom</td>
                                                          <td>Custom</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Contact Management</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can add and manage contacts through CSV files
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>No. of email workflows</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Active email workflows for your account
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>1</td>
                                                          <td>5</td>
                                                          <td>20</td>
                                                          <td>Unlimited</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>

                                  <!-- New add data -->
                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Different Question Types</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>

                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Short Text</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Can record the thoughts or opinions of respondents via text. To know the names of the respondents in your survey, add a short text question.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Long Text</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Can record the thoughts or opinions of respondents via text.If your company needs suggestions on a feature then add a long text question
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Opinion Scale</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allow respondents to share their opinions on a numbered scale using this question. By default, allows up to two labels for the questions scale —not at all likely and extremely likely
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Rating (*)</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allow respondents to evaluate a statment on a visual scale of stars
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Email Information</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Add an email question to your survey to know the email address of all your respondents for feedback. 
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Grid Question</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allows combination of different question types. Grid Question can be used to know opinions on different statements in one question. 
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Number</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Accept only numeric values as input. Used for know the number of employees in a department or employee Id number or age of respondents
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Information</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            For sharing important information like instructions, tips, or notes in the survey. Such information does not need a response from the respondent
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Phone Number</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Phone number questions are utilized by trained interviewers to contact and gather information from possible respondents.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Multiple Choice</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allow respondents to select more than one answer.They're versatile, intuitive, and yield clean data that's easy for you to analyze
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Net Promoter Score</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Collect responses on a 0-10 scale and segment into promoters, passives and detractors. These are used to measure customer loyalty with your brand.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Image Choice - One</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allow respondents to select one image from a list of images
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Image Choice - Many</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allow respondents to select multiple images from a list of images
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                      </tbody>
                                  </table>

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Survey Design</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>

                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>10+ Survey Theme</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Provides multiple pre-defined professional theme for making surveys attractive
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>Default Theme</td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Modifiable Survey Themes</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Customize survey themes to stay consisent with your brand identity
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Create New Themes</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Create new themes for complete branding of your survey. Add image, change font style & color of buttons
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>CSS Customization</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Customize the survey using your CSS
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Images</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Add images in questions and answers.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <!-- <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Video</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Upload your log and insert custom text into survey header
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr> -->
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Upload your Logo</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Upload your log and insert custom text into survey header
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Custom Backgrounds</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Use custom background images and logos to make your surveys easily recognizable for your customers
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Font Customizations </span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Customize the font as per your brand for maintaining consitency across different platforms
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Button Customizations </span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Customize the buttons as per your brand for maintaining consitency across different platforms
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Customizable End Screen</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Customize the message that the respondent will see after finishing the survey
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Whitelabelling</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Remove SurveySensum logo and branding from the surveys you share
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Custom URL Domain</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Create a simple and easy custom URL to ensure a seamless survey experience for your respondents.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                      </tbody>
                                  </table>

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Survey Settings</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>

                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Survey Progress Bar</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Display progress bar on the survey to let respondents know the percentage of surveys
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Password Protected Surveys</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Give your surveys a password for more security
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Open Access Surveys</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Anyone with the link can access the survey and provide feedback
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Invitation Only Surveys</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Only invited contacts can access the Surveys
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Limit Responses</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Restrict the number of responses corresponding to a survey
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Survey Expiration</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Specify the timelimit for accessing the survey
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Partial Submission</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allow users to submit incomplete surveys
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Multiple Submission</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Allow users to submit a survey multiple times
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Hide Question Number</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Enable this to hide the question number from a survey
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Survey Throttling</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Set the frequency at which users will receive the surveys
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                        
                                      </tbody>
                                  </table>
                                  <!-- End New add data -->

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Feedback/Response Collection</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Email</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can share your surveys via emails easily
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Facebook</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can share your surveys via Facebook too
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Twitter</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can share your surveys via Twitter too
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>QR Code</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can share the surveys via QR code and users can scan the QR code from their phones and respond to surveys.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>SMS & Whatsapp Surveys</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can share your surveys via SMS & Whatsapp too for faster responses
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>In-app and Website Integrations</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Seamlessly embed a survey in your app and website using our generated code
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Offline Data Collection</span>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Send Reminders</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Schedule reminders to follow-up on shared surveys
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                      </tbody>
                                  </table>

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Analysis & Reporting</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Export Data (CSV)</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                              Export collected responses in CSV format for advanced data analytics.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Live Analysis of Responses</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can get a detailed overview of your collected responses in real time.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Wordcloud</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            A word cloud is a visual representation for text data, typically used to depict keywords present in responses.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Multi Level Filters</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Play with your data inside the Surveysensum portal. Fitler by email, date, channels, custom attributes & much more
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Survey Metrics</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Get a gimpse of your responses in graphical form and analyze responses by different channels.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Role Based Dashboards</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Personalised dashboards for different profiles across the organisation
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Custom Dashboards</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Get custom dasboards based on the insights needed
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Feedback Tagging</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Easily create tags and analyze your feedback
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Text Analysis</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Analytics on social media content, call-centre conversations, emails & survey responses
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Sentiment Analysis</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Automatically categorize open ended responses into positive, neutral and negative groups by using machine learning algorithms
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>No of Predictions</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Get automatic predictions to get rid of manual tagging of text for faster classification and real time analysis of customer pain points.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td>Custom</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                      </tbody>
                                  </table>

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Email Notifications</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Standard Templates</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            A set of pre-designed workflows for internal and external email notifications
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Custom Emails</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Create your own workflow for emails and automate important communications
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>No of Email Workflows</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Active email workflows for your account
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>1</td>
                                                          <td>5</td>
                                                          <td>20</td>
                                                          <td>Unlimited</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Integrations & Open API</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Slack Integration</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Get notified of new survey responses directly in your Slack workspace
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Hubspot Integration</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Get notified of new survey responses directly in Hubspot
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Zapier Integration</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can push data you collected on SurveySensum to any software via Zapier
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Intercom Integration</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            You can share your surveys inside Intercom chat.
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Custom CRM Integration</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Integrate with CRM systems like Salesforce, Freshdesk, Zendesk for uploading contacts and syncing feedback responses
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td>On demand</td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Open API</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Connect with the CRM of your choice using open API
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Professional API support</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Get help from SurveySensum team in building your connections with Open APIs
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Historical Data migrations</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Import data from previous surveys built on other platforms
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>

                                  <table class="table table-hover table-scroll table-noborder table-filter">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <span>Support and Training</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path style="fill:none;opacity:0.87;" d="M24,24H0V0H24Z"/>
                                                    <path style="fill:#091e42;" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z"/>
                                                  </svg>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Self Help Articles and Videos</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            We have lots of easy to read help articles and videos to make your expert in creating surveys and detailed guide to answer your questions
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <!-- <td class="space-line"><span></span></td> -->
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                          <td class="blue-checked">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                              <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                              <path style="fill:#0052cc;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                            </svg>
                                                          </td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Onboarding Support</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            One-on-one guidance from our technical experts and product training
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td>4 hours</td>
                                                          <td>6 hours</td>
                                                          <td>Custom</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Email Support</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            If you wanna support via email, rather than talking with us, feel free to reach out to us
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>Business Hours</td>
                                                          <td>Business Hours</td>
                                                          <td>Business Hours</td>
                                                          <td>24x7</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Chat Support</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Stay connected with our support team via Whatsapp and Chat
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td>Business Hours</td>
                                                          <td>Business Hours</td>
                                                          <td>Business Hours</td>
                                                          <td>24x7</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div class="plan-item-info">
                                                      <span>Dedicated CX Manager</span>
                                                      <div class="tooltip-description-right">
                                                        <div class="tooltip-description">
                                                            <img src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/svg/pricing-description-info.svg" alt="">
                                                            <div class="description-tooltip-text">
                                                            Constant guidance from our CX Expert to implement a tailor-made CX programme throughout your organisation
                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="nested-child">
                                                  <table>
                                                      <tr>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="space-line"><span></span></td>
                                                          <td class="black-checked">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                <path style="fill:none;" d="M0,0H32V32H0Z"/>
                                                                <path style="fill:#2e384d;" d="M10.731,19.6,6.064,14.931A1.32,1.32,0,0,0,4.2,16.8l5.587,5.587a1.328,1.328,0,0,0,1.88,0L25.8,8.264A1.32,1.32,0,0,0,23.931,6.4Z" transform="translate(1.269 2.002)"/>
                                                              </svg>
                                                          </td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>

                              </div>

                            </div>
                            <!-- End All Features Data Section is here -->

                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="cx-platform analytics-tab">
                      <div class="cx-tabs-main">
                        <div class="subtext-pricing text-center">
                          Get valuable strategic business insights from every
                          customer conversation
                        </div>
                      </div>
                      <div class="cx-tab-inner-content">
                        <div class="plans-pricing position-relative">
                          <div class="plans-section analytics-tab-inner">
                            <div class="analytics-content">
                              <div class="row">
                                <div class="col-12">
                                  <p class="left-analytics-feature">
                                    Most companies today are overwhelmed with
                                    customer conversation data and face a
                                    problem turning all their data into
                                    actionable insights. With our AI-powered
                                    text analytics, you can unleash the
                                    insights locked in your data to drive
                                    better customer experiences.
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12">
                                  <div class="get-in-touch text-center">
                                    <a
                                      href="#"
                                      data-toggle="modal"
                                      data-target="#pricng-get-in-touch-premium"
                                      class="btn btn-primary lg font-weight-bold"
                                      >Get in Touch</a
                                    >
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- End Simple plan pricing section1 -->

    <!-- Discont and services pricing page -->
    <!-- <section class="discount-pricing">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-6">
            <div class="card">
              <div class="discount-inner d-flex align-items-center">
                <div class="discount-content">
                  <h5 class="font-weight-bold">Discounts</h5>
                  <p>
                    We offer special pricing for students and NGOs. To avail our
                    services at discounted rates, make sure you sign up using
                    your official e-mail address.
                  </p>
                </div>
                <div class="discount-img">
                  <img
                    src="<?php #echo get_template_directory_uri() ?>/homepage_assets/img/svg/discount-Icon.svg"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-6">
            <div class="card">
              <div class="discount-inner d-flex align-items-center">
                <div class="discount-content">
                  <h5 class="font-weight-bold">Multilingual Services</h5>
                  <p>
                    Reach out to your customers in the language they understand.
                    Create surveys in English, Bahasa and other supported
                    languages.
                  </p>
                </div>
                <div class="discount-img">
                  <img
                    src="<?php #echo get_template_directory_uri() ?>/homepage_assets/img/svg/multilingual-services.svg"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- End Discont and services pricing page -->

    <!-- Pricing who love us section -->
    <section class="products pricing-who-love">
      <div class="container">
        <div class="row">
          <div class="col-12 product-inner">
            <div class="heading text-center">
              <h2>
                Customers who love us
              </h2>
              <p>
                Hear from some of our loyal customers on how they improved their
                CX with SurveySensum
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body pricing-who-love-text">
                <div class="heading d-flex align-items-center">
                  <img
                    src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/connext-pricing-icon.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h2>Connext</h2>
                </div>
                <p class="card-text">
                  SurveySensum CX software is very useful to track and monitor
                  the reactions of the audience about our recent event. We got
                  access to a real-time dashboard where we can see the customer
                  satisfaction score. It’s a great software to know the
                  loopholes in your customer experience process.
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="card mb-0">
              <div class="card-body pricing-who-love-text">
                <div class="heading d-flex align-items-center">
                  <img
                    src="<?php echo get_template_directory_uri() ?>/homepage_assets/img/smartFren-pricing-icon.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h2 class="who-love-smartfren">Smartfren</h2>
                </div>
                <p class="card-text">
                  We like how this SurveySensum CX software worked smoothly for
                  us and not just collected Customer Effort Score (CES) from our
                  existing customer but also helped us with actionable insights.
                  Our internal team got really impressed with the ease of use of
                  this software and its features.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Pricing who love us section -->

    <!-- pricing Our clients companies -->
    <div class="our-clients pricing-clients">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="clients">
              <h4 class="text-center font-weight-bold">
                More companies who use the SurveySensum platform
              </h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="clients-brand">
                <div
                    class="software-used"
                    >
                    <div class="brand-logo">
                      <img
                          src="<?php echo get_template_directory_uri()
                            ?>/homepage_assets/img/client-icons.png"
                          class="img-fluid"
                          alt="SurveySensum"
                          />
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End pricing Our clients companies -->

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



<!-- Talk to our CX pricng-get-in-touch-expert modal -->
<!-- <div
  class="modal fade"
  id="pricng-get-in-touch-expert"
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
            src="<?php #echo get_template_directory_uri() ?>/homepage_assets/img/svg/close-menu.svg"
            alt="SurveySensum"
          />
        </button>
      </div>
    </div>
  </div>
</div> -->

<!-- Talk to our CX pricng-get-in-touch-Premium modal -->
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

        <!-- <script>
          hbspt.forms.create({
            portalId: "5773317",
            formId: "248773d5-71e6-4dfb-a7d8-2270f1ff6f9a"
          });
        </script> -->

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

<!-- Talk to our CX pricng-get-in-touch-Premium on scroll modal -->
<div
  class="modal fade"
  id="pricng-get-in-touch-scroll"
  tabindex="-1"
  role="dialog"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title text-center font-weight-bold">
          Get in Touch with our Expert
        </h5>

        <script>
          hbspt.forms.create({
            portalId: "5773317",
            formId: "248773d5-71e6-4dfb-a7d8-2270f1ff6f9a"
          });
        </script>
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



<script type="text/javascript">
	  // let getUserEmailAddress = localStorage.getItem('pricingPageEmailNotification');
    // console.log("Pricing page... ",getUserEmailAddress);

    // <?php #$fromAddr = "<script>document.write(getUserEmailAddress)</script>" ?>

</script>

<!-- <h1>Hi Naseem <?php #echo $fromAddr ?> </h1> -->

<?php


    // Slug "or" url only load on pricing page, then shoot an email
   # if(is_page('pricing'))
   # {

    #    echo $fromAddr . "Naseem find";

#        $fromName = 'Pricing page auto email notification system';

 #       $subject = 'User visit our website pricing page, Auto email notification system';



        /* Mail Address */
     #   $toAddr = 'naseem@neurosensum.com'; 
        // $bccAddr = 'naseem@neurosensum.com'; 
        // $fromAddr = "naseem@neurosensum.com";
        /* End Mail Address */


        /* Mail Body */
      #  $msg = '
          // <html>
          //   <head>
          //       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          //       <title></title>
          //   </head>
          //   <body>
          //       User visit our website pricing page email notification system
          //   </body>
          // </html>
       # ';

        #$msg = wordwrap($msg, 70);
        /* End Mail Body */


        /* Mail Headers Setup */
       #$headers = array();
       #$headers[] = "MIME-Version: 1.0";
       #$headers[] = "Content-type: text/html; charset=utf-8";
       #$headers[] = "From: ".$fromName." <".$fromAddr.">";
       #// $headers[] = "Bcc: <".$bccAddr.">";
       #/* End Mail Headers Setup */


       #mail($toAddr, $subject, $msg, implode("\r\n", $headers));

   # }
    
?>