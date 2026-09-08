<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php
$page_title='Forsk Coding School - Forsk Coding School';
$page_description='Education LMS and Online course template';
$page_canonical='';
$page_schema='{"@context": "https://schema.org", "@type": "WebPage", "name": "Forsk Coding School - Forsk Coding School", "description": "Education LMS and Online course template", "url": "https://forskcodingschool.com/checkout.php"}';
$page_robots='noindex, nofollow'; $header_variant='header-1';
?>
<?php include __DIR__.'/includes/head.php'; ?>
</head>
<body>
<?php include __DIR__.'/includes/header.php'; ?>
<div id="smooth-wrapper">
    <div id="smooth-content">
      <main id="primary" class="site-main">

        <div class="space-for-header"></div>
        <!-- start: Page Header Section -->
        <section class="tj-page-header">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="tj-page-header-content">
                  <h1 class="tj-page-title">Checkout</h1>
                  <div class="tj-page-link">
                    <span><i class="tji-home"></i></span>
                    <span>
                      <a href="index.php">Home</a>
                    </span>
                    <span><i class="tji-arrow-right-4"></i></span>
                    <span>
                      <span>Checkout</span>
                    </span>
                  </div>
                  <div class="shape"><img src="assets/images/shapes/stars.png" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Page Header Section -->

        <!-- start: Checkout Section -->
        <section class="full-width tj-page__area section-gap-bottom woocommerce-checkout">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="tj-page__container">
                  <div class="tj-entry__content">
                    <div class="woocommerce">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="tj-checkout-billing-coupon">
                            <div class="woocommerce-form-coupon-toggle">
                              <div class="woocommerce-info">
                                Have a coupon?
                                <a href="checkout.php#" class="showcoupon">Click here</a> to enter your code
                              </div>
                            </div>

                            <form class="checkout_coupon woocommerce-form-coupon" method="post">
                              <div class="d-flex align-items-center flex-wrap rg-30">
                                <div class="form-row form-row-first">
                                  <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code"
                                    id="coupon_code" value="">
                                </div>
                                <div class="form-row form-row-last">
                                  <button type="submit" class="tj-btn-primary tj-btn-primary-sm flip-text-wrap button"
                                    name="apply_coupon" value="Apply coupon">
                                    <span class="btn-text">Apply coupon</span>
                                    <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                                  </button>
                                </div>
                              </div>
                              <div class="clear"></div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <form name="checkout" method="post" class="checkout" action="checkout.php#">
                        <div class="row rg-70" id="customer_details">
                          <div class="col-sm-12">
                            <div class="tj-checkout-billing-wrapper" id="customer_form_details">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="woocommerce-billing-fields">
                                    <h3>Billing details</h3>
                                    <div class="woocommerce-billing-fields__field-wrapper">
                                      <p class="form-row form-row-first validate-required" id="billing_first_name_field"
                                        data-priority="10">
                                        <label for="billing_first_name" class="required_field">First
                                          name&nbsp;<span class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="text" class="input-text " name="billing_first_name"
                                            id="billing_first_name" placeholder="" value="" aria-required="true"
                                            autocomplete="given-name">
                                        </span>
                                      </p>
                                      <p class="form-row form-row-last validate-required" id="billing_last_name_field"
                                        data-priority="20">
                                        <label for="billing_last_name" class="required_field">Last
                                          name&nbsp;<span class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="text" class="input-text " name="billing_last_name"
                                            id="billing_last_name" placeholder="" value="" aria-required="true"
                                            autocomplete="family-name">
                                        </span>
                                      </p>
                                      <p class="form-row form-row-wide address-field update_totals_on_change validate-required"
                                        id="billing_country_field" data-priority="40">
                                        <label for="billing_country" class="required_field">Country / Region&nbsp;<span
                                            class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <span class="tj-select">
                                            <select name="billing_country" id="billing_country" class="country_to_state"
                                              autocomplete="country" data-placeholder="Select a country / region…">
                                              <option value="">Select a country / region…</option>
                                              <option value="AF">Afghanistan</option>
                                              <option value="AX">Åland Islands</option>
                                              <option value="AL">Albania</option>
                                              <option value="DZ">Algeria</option>
                                              <option value="AS">American Samoa</option>
                                              <option value="AD">Andorra</option>
                                              <option value="AO">Angola</option>
                                              <option value="AI">Anguilla</option>
                                              <option value="AQ">Antarctica</option>
                                              <option value="AG">Antigua and Barbuda</option>
                                              <option value="AR">Argentina</option>
                                              <option value="AM">Armenia</option>
                                              <option value="AW">Aruba</option>
                                              <option value="AU">Australia</option>
                                              <option value="AT">Austria</option>
                                              <option value="AZ">Azerbaijan</option>
                                              <option value="BS">Bahamas</option>
                                              <option value="BH">Bahrain</option>
                                              <option value="BD">Bangladesh</option>
                                              <option value="BB">Barbados</option>
                                              <option value="BY">Belarus</option>
                                              <option value="PW">Belau</option>
                                              <option value="BE">Belgium</option>
                                              <option value="BZ">Belize</option>
                                              <option value="BJ">Benin</option>
                                              <option value="BM">Bermuda</option>
                                              <option value="BT">Bhutan</option>
                                              <option value="BO">Bolivia</option>
                                              <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                              <option value="BA">Bosnia and Herzegovina</option>
                                              <option value="BW">Botswana</option>
                                              <option value="BV">Bouvet Island</option>
                                              <option value="BR">Brazil</option>
                                              <option value="IO">British Indian Ocean Territory</option>
                                              <option value="BN">Brunei</option>
                                              <option value="BG">Bulgaria</option>
                                              <option value="BF">Burkina Faso</option>
                                              <option value="BI">Burundi</option>
                                              <option value="KH">Cambodia</option>
                                              <option value="CM">Cameroon</option>
                                              <option value="CA">Canada</option>
                                              <option value="CV">Cape Verde</option>
                                              <option value="KY">Cayman Islands</option>
                                              <option value="CF">Central African Republic</option>
                                              <option value="TD">Chad</option>
                                              <option value="CL">Chile</option>
                                              <option value="CN">China</option>
                                              <option value="CX">Christmas Island</option>
                                              <option value="CC">Cocos (Keeling) Islands</option>
                                              <option value="CO">Colombia</option>
                                              <option value="KM">Comoros</option>
                                              <option value="CG">Congo (Brazzaville)</option>
                                              <option value="CD">Congo (Kinshasa)</option>
                                              <option value="CK">Cook Islands</option>
                                              <option value="CR">Costa Rica</option>
                                              <option value="HR">Croatia</option>
                                              <option value="CU">Cuba</option>
                                              <option value="CW">Curaçao</option>
                                              <option value="CY">Cyprus</option>
                                              <option value="CZ">Czech Republic</option>
                                              <option value="DK">Denmark</option>
                                              <option value="DJ">Djibouti</option>
                                              <option value="DM">Dominica</option>
                                              <option value="DO">Dominican Republic</option>
                                              <option value="EC">Ecuador</option>
                                              <option value="EG">Egypt</option>
                                              <option value="SV">El Salvador</option>
                                              <option value="GQ">Equatorial Guinea</option>
                                              <option value="ER">Eritrea</option>
                                              <option value="EE">Estonia</option>
                                              <option value="SZ">Eswatini</option>
                                              <option value="ET">Ethiopia</option>
                                              <option value="FK">Falkland Islands</option>
                                              <option value="FO">Faroe Islands</option>
                                              <option value="FJ">Fiji</option>
                                              <option value="FI">Finland</option>
                                              <option value="FR">France</option>
                                              <option value="GF">French Guiana</option>
                                              <option value="PF">French Polynesia</option>
                                              <option value="TF">French Southern Territories</option>
                                              <option value="GA">Gabon</option>
                                              <option value="GM">Gambia</option>
                                              <option value="GE">Georgia</option>
                                              <option value="DE">Germany</option>
                                              <option value="GH">Ghana</option>
                                              <option value="GI">Gibraltar</option>
                                              <option value="GR">Greece</option>
                                              <option value="GL">Greenland</option>
                                              <option value="GD">Grenada</option>
                                              <option value="GP">Guadeloupe</option>
                                              <option value="GU">Guam</option>
                                              <option value="GT">Guatemala</option>
                                              <option value="GG">Guernsey</option>
                                              <option value="GN">Guinea</option>
                                              <option value="GW">Guinea-Bissau</option>
                                              <option value="GY">Guyana</option>
                                              <option value="HT">Haiti</option>
                                              <option value="HM">Heard Island and McDonald Islands</option>
                                              <option value="HN">Honduras</option>
                                              <option value="HK">Hong Kong</option>
                                              <option value="HU">Hungary</option>
                                              <option value="IS">Iceland</option>
                                              <option value="IN">India</option>
                                              <option value="ID">Indonesia</option>
                                              <option value="IR">Iran</option>
                                              <option value="IQ">Iraq</option>
                                              <option value="IE">Ireland</option>
                                              <option value="IM">Isle of Man</option>
                                              <option value="IL">Israel</option>
                                              <option value="IT">Italy</option>
                                              <option value="CI">Ivory Coast</option>
                                              <option value="JM">Jamaica</option>
                                              <option value="JP">Japan</option>
                                              <option value="JE">Jersey</option>
                                              <option value="JO">Jordan</option>
                                              <option value="KZ">Kazakhstan</option>
                                              <option value="KE">Kenya</option>
                                              <option value="KI">Kiribati</option>
                                              <option value="KW">Kuwait</option>
                                              <option value="KG">Kyrgyzstan</option>
                                              <option value="LA">Laos</option>
                                              <option value="LV">Latvia</option>
                                              <option value="LB">Lebanon</option>
                                              <option value="LS">Lesotho</option>
                                              <option value="LR">Liberia</option>
                                              <option value="LY">Libya</option>
                                              <option value="LI">Liechtenstein</option>
                                              <option value="LT">Lithuania</option>
                                              <option value="LU">Luxembourg</option>
                                              <option value="MO">Macao</option>
                                              <option value="MG">Madagascar</option>
                                              <option value="MW">Malawi</option>
                                              <option value="MY">Malaysia</option>
                                              <option value="MV">Maldives</option>
                                              <option value="ML">Mali</option>
                                              <option value="MT">Malta</option>
                                              <option value="MH">Marshall Islands</option>
                                              <option value="MQ">Martinique</option>
                                              <option value="MR">Mauritania</option>
                                              <option value="MU">Mauritius</option>
                                              <option value="YT">Mayotte</option>
                                              <option value="MX">Mexico</option>
                                              <option value="FM">Micronesia</option>
                                              <option value="MD">Moldova</option>
                                              <option value="MC">Monaco</option>
                                              <option value="MN">Mongolia</option>
                                              <option value="ME">Montenegro</option>
                                              <option value="MS">Montserrat</option>
                                              <option value="MA">Morocco</option>
                                              <option value="MZ">Mozambique</option>
                                              <option value="MM">Myanmar</option>
                                              <option value="NA">Namibia</option>
                                              <option value="NR">Nauru</option>
                                              <option value="NP">Nepal</option>
                                              <option value="NL">Netherlands</option>
                                              <option value="NC">New Caledonia</option>
                                              <option value="NZ">New Zealand</option>
                                              <option value="NI">Nicaragua</option>
                                              <option value="NE">Niger</option>
                                              <option value="NG">Nigeria</option>
                                              <option value="NU">Niue</option>
                                              <option value="NF">Norfolk Island</option>
                                              <option value="KP">North Korea</option>
                                              <option value="MK">North Macedonia</option>
                                              <option value="MP">Northern Mariana Islands</option>
                                              <option value="NO">Norway</option>
                                              <option value="OM">Oman</option>
                                              <option value="PK">Pakistan</option>
                                              <option value="PS">Palestinian Territory</option>
                                              <option value="PA">Panama</option>
                                              <option value="PG">Papua New Guinea</option>
                                              <option value="PY">Paraguay</option>
                                              <option value="PE">Peru</option>
                                              <option value="PH">Philippines</option>
                                              <option value="PN">Pitcairn</option>
                                              <option value="PL">Poland</option>
                                              <option value="PT">Portugal</option>
                                              <option value="PR">Puerto Rico</option>
                                              <option value="QA">Qatar</option>
                                              <option value="RE">Reunion</option>
                                              <option value="RO">Romania</option>
                                              <option value="RU">Russia</option>
                                              <option value="RW">Rwanda</option>
                                              <option value="ST">São Tomé and Príncipe</option>
                                              <option value="BL">Saint Barthélemy</option>
                                              <option value="SH">Saint Helena</option>
                                              <option value="KN">Saint Kitts and Nevis</option>
                                              <option value="LC">Saint Lucia</option>
                                              <option value="SX">Saint Martin (Dutch part)</option>
                                              <option value="MF">Saint Martin (French part)</option>
                                              <option value="PM">Saint Pierre and Miquelon</option>
                                              <option value="VC">Saint Vincent and the Grenadines</option>
                                              <option value="WS">Samoa</option>
                                              <option value="SM">San Marino</option>
                                              <option value="SA">Saudi Arabia</option>
                                              <option value="SN">Senegal</option>
                                              <option value="RS">Serbia</option>
                                              <option value="SC">Seychelles</option>
                                              <option value="SL">Sierra Leone</option>
                                              <option value="SG">Singapore</option>
                                              <option value="SK">Slovakia</option>
                                              <option value="SI">Slovenia</option>
                                              <option value="SB">Solomon Islands</option>
                                              <option value="SO">Somalia</option>
                                              <option value="ZA">South Africa</option>
                                              <option value="GS">South Georgia/Sandwich Islands</option>
                                              <option value="KR">South Korea</option>
                                              <option value="SS">South Sudan</option>
                                              <option value="ES">Spain</option>
                                              <option value="LK">Sri Lanka</option>
                                              <option value="SD">Sudan</option>
                                              <option value="SR">Suriname</option>
                                              <option value="SJ">Svalbard and Jan Mayen</option>
                                              <option value="SE">Sweden</option>
                                              <option value="CH">Switzerland</option>
                                              <option value="SY">Syria</option>
                                              <option value="TW">Taiwan</option>
                                              <option value="TJ">Tajikistan</option>
                                              <option value="TZ">Tanzania</option>
                                              <option value="TH">Thailand</option>
                                              <option value="TL">Timor-Leste</option>
                                              <option value="TG">Togo</option>
                                              <option value="TK">Tokelau</option>
                                              <option value="TO">Tonga</option>
                                              <option value="TT">Trinidad and Tobago</option>
                                              <option value="TN">Tunisia</option>
                                              <option value="TR">Turkey</option>
                                              <option value="TM">Turkmenistan</option>
                                              <option value="TC">Turks and Caicos Islands</option>
                                              <option value="TV">Tuvalu</option>
                                              <option value="UG">Uganda</option>
                                              <option value="UA">Ukraine</option>
                                              <option value="AE">United Arab Emirates</option>
                                              <option value="GB">United Kingdom (UK)</option>
                                              <option value="US" selected="selected">United States (US)</option>
                                              <option value="UM">United States (US) Minor Outlying Islands</option>
                                              <option value="UY">Uruguay</option>
                                              <option value="UZ">Uzbekistan</option>
                                              <option value="VU">Vanuatu</option>
                                              <option value="VA">Vatican</option>
                                              <option value="VE">Venezuela</option>
                                              <option value="VN">Vietnam</option>
                                              <option value="VG">Virgin Islands (British)</option>
                                              <option value="VI">Virgin Islands (US)</option>
                                              <option value="WF">Wallis and Futuna</option>
                                              <option value="EH">Western Sahara</option>
                                              <option value="YE">Yemen</option>
                                              <option value="ZM">Zambia</option>
                                              <option value="ZW">Zimbabwe</option>
                                            </select>
                                          </span>
                                        </span>
                                      </p>
                                      <p class="form-row address-field validate-required form-row-wide"
                                        id="billing_address_1_field" data-priority="50">
                                        <label for="billing_address_1" class="required_field">Street address&nbsp;<span
                                            class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="text" class="input-text " name="billing_address_1"
                                            id="billing_address_1" placeholder="House number and street name" value=""
                                            aria-required="true" autocomplete="address-line1"
                                            data-placeholder="House number and street name">
                                        </span>
                                      </p>
                                      <p class="form-row address-field form-row-wide" id="billing_address_2_field"
                                        data-priority="60">
                                        <label for="billing_address_2" class="screen-reader-text">Apartment, suite,
                                          unit,
                                          etc.&nbsp;<span class="optional">(optional)</span>
                                        </label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="text" class="input-text " name="billing_address_2"
                                            id="billing_address_2" placeholder="Apartment, suite, unit, etc. (optional)"
                                            value="" autocomplete="address-line2"
                                            data-placeholder="Apartment, suite, unit, etc. (optional)">
                                        </span>
                                      </p>
                                      <p class="form-row address-field validate-required form-row-wide"
                                        id="billing_city_field" data-priority="70"
                                        data-o_class="form-row form-row-wide address-field validate-required">
                                        <label for="billing_city" class="required_field">Town / City&nbsp;<span
                                            class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="text" class="input-text " name="billing_city" id="billing_city"
                                            placeholder="" value="" aria-required="true" autocomplete="address-level2">
                                        </span>
                                      </p>
                                      <p class="form-row address-field validate-required validate-state form-row-wide"
                                        id="billing_state_field" data-priority="80"
                                        data-o_class="form-row form-row-wide address-field validate-required validate-state">
                                        <label for="billing_state" class="required_field">State&nbsp;<span
                                            class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <span class="tj-select">
                                            <select name="billing_state" id="billing_state" class="state_select"
                                              data-placeholder="Select an option…" data-label="State">
                                              <option value="">Select an option…</option>
                                              <option value="AL">Alabama</option>
                                              <option value="AK">Alaska</option>
                                              <option value="AZ">Arizona</option>
                                              <option value="AR">Arkansas</option>
                                              <option value="CA">California</option>
                                              <option value="CO">Colorado</option>
                                              <option value="CT">Connecticut</option>
                                              <option value="DE">Delaware</option>
                                              <option value="DC">District of Columbia</option>
                                              <option value="FL">Florida</option>
                                              <option value="GA">Georgia</option>
                                              <option value="HI">Hawaii</option>
                                              <option value="ID">Idaho</option>
                                              <option value="IL">Illinois</option>
                                              <option value="IN">Indiana</option>
                                              <option value="IA">Iowa</option>
                                              <option value="KS">Kansas</option>
                                              <option value="KY">Kentucky</option>
                                              <option value="LA">Louisiana</option>
                                              <option value="ME">Maine</option>
                                              <option value="MD">Maryland</option>
                                              <option value="MA">Massachusetts</option>
                                              <option value="MI">Michigan</option>
                                              <option value="MN">Minnesota</option>
                                              <option value="MS">Mississippi</option>
                                              <option value="MO">Missouri</option>
                                              <option value="MT">Montana</option>
                                              <option value="NE">Nebraska</option>
                                              <option value="NV">Nevada</option>
                                              <option value="NH">New Hampshire</option>
                                              <option value="NJ">New Jersey</option>
                                              <option value="NM">New Mexico</option>
                                              <option value="NY">New York</option>
                                              <option value="NC">North Carolina</option>
                                              <option value="ND">North Dakota</option>
                                              <option value="OH">Ohio</option>
                                              <option value="OK">Oklahoma</option>
                                              <option value="OR">Oregon</option>
                                              <option value="PA">Pennsylvania</option>
                                              <option value="RI">Rhode Island</option>
                                              <option value="SC">South Carolina</option>
                                              <option value="SD">South Dakota</option>
                                              <option value="TN">Tennessee</option>
                                              <option value="TX">Texas</option>
                                              <option value="UT">Utah</option>
                                              <option value="VT">Vermont</option>
                                              <option value="VA">Virginia</option>
                                              <option value="WA">Washington</option>
                                              <option value="WV">West Virginia</option>
                                              <option value="WI">Wisconsin</option>
                                              <option value="WY">Wyoming</option>
                                              <option value="AA">Armed Forces (AA)</option>
                                              <option value="AE">Armed Forces (AE)</option>
                                              <option value="AP">Armed Forces (AP)</option>
                                            </select>
                                          </span>
                                        </span>
                                      </p>
                                      <p class="form-row address-field validate-required validate-postcode form-row-wide"
                                        id="billing_postcode_field" data-priority="90"
                                        data-o_class="form-row form-row-wide address-field validate-required validate-postcode">
                                        <label for="billing_postcode" class="required_field">ZIP Code&nbsp;<span
                                            class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="text" class="input-text " name="billing_postcode"
                                            id="billing_postcode" placeholder="" value="" aria-required="true"
                                            autocomplete="postal-code">
                                        </span>
                                      </p>
                                      <p class="form-row form-row-wide validate-phone" id="billing_phone_field"
                                        data-priority="100">
                                        <label for="billing_phone" class="">Phone&nbsp;<span
                                            class="optional">(optional)</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="tel" class="input-text " name="billing_phone" id="billing_phone"
                                            placeholder="" value="" autocomplete="tel">
                                        </span>
                                      </p>
                                      <p class="form-row form-row-wide validate-required validate-email"
                                        id="billing_email_field" data-priority="110">
                                        <label for="billing_email" class="required_field">Email address&nbsp;<span
                                            class="required" aria-hidden="true">*</span></label>
                                        <span class="woocommerce-input-wrapper">
                                          <input type="email" class="input-text " name="billing_email"
                                            id="billing_email" placeholder="" value=""
                                            aria-required="true" autocomplete="email">
                                        </span>
                                      </p>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-md-6">
                                  <div class="woocommerce-shipping-fields">
                                  </div>
                                  <div class="woocommerce-additional-fields">
                                    <h3>Additional information</h3>

                                    <div class="woocommerce-additional-fields__field-wrapper">
                                      <p class="form-row notes" id="order_comments_field" data-priority=""><label
                                          for="order_comments" class="">Order notes&nbsp;<span
                                            class="optional">(optional)</span></label><span
                                          class="woocommerce-input-wrapper"><textarea name="order_comments"
                                            class="input-text " id="order_comments"
                                            placeholder="Notes about your order, e.g. special notes for delivery."
                                            rows="2" cols="5"></textarea></span></p>
                                    </div>


                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="cart-wrapper">
                              <div class="order-review-wrapper">
                                <h3 id="order_review_heading">Your order</h3>
                                <div id="order_review" class="woocommerce-checkout-review-order">
                                  <table class="shop_table woocommerce-checkout-review-order-table ss">
                                    <thead>
                                      <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Subtotal</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="cart_item">
                                        <td class="product-name">
                                          Room fragrance device <strong class="product-quantity">× 2</strong>
                                        </td>
                                        <td class="product-total">
                                          <span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">$</span>400.00</bdi></span>
                                        </td>
                                      </tr>
                                      <tr class="cart_item">
                                        <td class="product-name">
                                          Sleek sound earbuds <strong class="product-quantity">× 2</strong>
                                        </td>
                                        <td class="product-total">
                                          <span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">$</span>400.00</bdi></span>
                                        </td>
                                      </tr>
                                    </tbody>
                                    <tfoot>
                                      <tr class="cart-subtotal dd">
                                        <th>Subtotal</th>
                                        <td><span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">$</span>800.00</bdi></span>
                                        </td>
                                      </tr>

                                      <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="woocommerce-Price-amount amount"><bdi><span
                                                  class="woocommerce-Price-currencySymbol">$</span>800.00</bdi></span></strong>
                                        </td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                  <div id="payment" class="woocommerce-checkout-payment">
                                    <ul class="wc_payment_methods payment_methods methods">
                                      <li class="wc_payment_method payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio"
                                          name="payment_method" value="bacs" checked="checked"
                                          data-order_button_text="">

                                        <label for="payment_method_bacs">
                                          Direct bank transfer </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                          <p>Make your payment directly into our bank account. Please use your Order ID
                                            as the payment reference. Your order will not be shipped until the funds
                                            have successfully cleared in our account and are verified by our finance
                                            team.</p>
                                        </div>
                                      </li>
                                      <li class="wc_payment_method payment_method_cod">
                                        <input id="payment_method_cod" type="radio" class="input-radio"
                                          name="payment_method" value="cod" data-order_button_text="">
                                        <label for="payment_method_cod">
                                          Cash on delivery </label>
                                      </li>
                                    </ul>
                                  </div>

                                </div>

                              </div>
                            </div>
                            <div class="wc-proceed-to-checkout mt-30">
                              <a href="checkout.php"
                                class="tj-btn-primary flip-text-wrap checkout-button button alt wc-forward">
                                <span class="btn-text">Place order</span>
                                <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                              </a>
                            </div>
                          </div>
                        </div>



                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Checkout Section -->
      </main>

      <?php include __DIR__.'/includes/footer.php'; ?>
</div>
</div>
</body>
</html>
