<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <h4 class="card-header"><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            <div class="card-body">
                <?php echo form_open_multipart('dashboard/setting/create_new', 'class="form-inner"'); ?>
                <?php echo form_hidden('id', $setting->id) ?>

                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label"><?php echo display('application_title') ?> <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-6">
                        <input name="title" type="text" class="form-control" id="title"
                            placeholder="<?php echo display('application_title') ?>"
                            value="<?php echo html_escape($setting->title) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stname" class="col-sm-3 col-form-label"><?php echo display("store_name"); ?></label>
                    <div class="col-sm-6">
                        <input name="stname" type="text" class="form-control" id="stname"
                            placeholder="<?php echo display("store_name"); ?>"
                            value="<?php echo html_escape($setting->storename) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label"><?php echo display('address') ?></label>
                    <div class="col-sm-6">
                        <input name="address" type="text" class="form-control" id="address"
                            placeholder="<?php echo display('address') ?>"
                            value="<?php echo html_escape($setting->address) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?></label>
                    <div class="col-sm-6">
                        <input name="email" type="text" class="form-control" id="email"
                            placeholder="<?php echo display('email') ?>"
                            value="<?php echo html_escape($setting->email) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label"><?php echo display('phone') ?></label>
                    <div class="col-sm-6">
                        <input name="phone" type="number" class="form-control" id="phone"
                            placeholder="<?php echo display('phone') ?>"
                            value="<?php echo html_escape($setting->phone) ?>">
                    </div>
                </div>
                <?php if (!empty($setting->favicon)) {  ?>
                    <div class="form-group row">
                        <label for="faviconPreview" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <img src="<?php echo html_escape(base_url($setting->favicon)) ?>" alt="Favicon"
                                class="img-thumbnail" />
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="favicon" class="col-sm-3 col-form-label"><?php echo display('favicon') ?> </label>
                    <div class="col-sm-6">
                        <input type="file" name="favicon" id="favicon">
                        <input type="hidden" name="old_favicon" value="<?php echo html_escape($setting->favicon) ?>">
                    </div>
                </div>
                <!-- if setting logo is already uploaded -->
                <?php if (!empty($setting->logo)) {  ?>
                    <div class="form-group row">
                        <label for="logoPreview" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <img src="<?php echo html_escape(base_url($setting->logo)) ?>" alt="Picture"
                                class="img-thumbnail" />
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="logo" class="col-sm-3 col-form-label"><?php echo display('logo') ?></label>
                    <div class="col-sm-6">
                        <input type="file" name="logo" id="logo">
                        <input type="hidden" name="old_logo" value="<?php echo html_escape($setting->logo) ?>">
                    </div>
                </div>
                <!-- if setting Splash Image is already uploaded -->
                <?php if (!empty($setting->splash_logo)) {  ?>
                    <div class="form-group row">
                        <label for="logoPreview" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <img src="<?php echo html_escape(base_url($setting->splash_logo)) ?>" alt="Picture"
                                class="img-thumbnail width_80px" />
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="logo" class="col-sm-3 col-form-label"><?php echo display('splash') ?></label>
                    <div class="col-sm-6">
                        <input type="file" name="splash_logo" id="splash_logo">
                        <input type="hidden" name="splash_logo"
                            value="<?php echo html_escape($setting->splash_logo) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storevat" class="col-sm-3 col-form-label"><?php echo display("vat_tax") . " " . display("setting") . "(%)"; ?></label>
                    <div class="col-sm-6">
                        <input name="storevat" type="text" class="form-control" id="storevat"
                            placeholder="<?php echo display("vat_tax"); ?>" value="<?php echo html_escape($setting->vat) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storevat" class="col-sm-3 col-form-label"><?php echo display("service_charge") . "(%)"; ?></label>
                    <div class="col-sm-6">
                        <input name="scharge" type="text" class="form-control" id="scharge"
                            placeholder="<?php echo display("service_charge"); ?>"
                            value="<?php echo html_escape($setting->servicecharge) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storevat" class="col-sm-3 col-form-label"><?php echo display("country"); ?></label>
                    <div class="col-sm-6">
                        <select name="country" class="form-control basic-single" id="country">
                            <option value="">Select Country</option>
                            <option value="AF">Afghanistan</option>
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
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
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
                            <option value="CG">Congo</option>
                            <option value="CD">Congo (Democratic Republic of the)</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote d'Ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
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
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea (North)</option>
                            <option value="KR">Korea (South)</option>
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
                            <option value="MK">Macedonia</option>
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
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
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
                            <option value="BL">Saint Barthelemy</option>
                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="MF">Saint Martin (French part)</option>
                            <option value="PM">Saint Pierre and Miquelon</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SX">Sint Maarten</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="SS">South Sudan</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
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
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands (British)</option>
                            <option value="VI">Virgin Islands (U.S.)</option>
                            <option value="WF">Wallis and Futuna</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                        <input type="hidden" class="form-control" id="country_selected" placeholder="<?php echo display("country"); ?>" value="<?php echo html_escape($setting->country) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storekey" class="col-sm-3 col-form-label"><?php echo display("map_key"); ?></label>
                    <div class="col-sm-6">
                        <input name="map_key" type="text" class="form-control" id="map_key"
                            placeholder="<?php echo display("map_key"); ?>" value="<?php echo html_escape($setting->map_key) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storelatitude" class="col-sm-3 col-form-label"><?php echo display("latitude"); ?></label>
                    <div class="col-sm-6">
                        <input name="latitude" type="text" class="form-control" id="latitude"
                            placeholder="<?php echo display("latitude"); ?>"
                            value="<?php echo html_escape($setting->latitude) ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storelongitude" class="col-sm-3 col-form-label"><?php echo display("longitude"); ?></label>
                    <div class="col-sm-6">
                        <input name="longitude" type="text" class="form-control" id="longitude"
                            placeholder="<?php echo display("longitude"); ?>"
                            value="<?php echo html_escape($setting->longitude) ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="footer_text" class="col-sm-3 col-form-label"><?php echo display('currency') ?></label>
                    <div class="col-sm-6">
                        <?php echo form_dropdown('currency', $currencyList, $setting->currency, 'class="form-control basic-single"') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="footer_text" class="col-sm-3 col-form-label"><?php echo display('language') ?></label>
                    <div class="col-sm-6">
                        <?php echo form_dropdown('language', $languageList, $setting->language, 'class="form-control"') ?>
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <label for="footer_text"
                        class="col-sm-3 col-form-label"><?php echo display('date_format'); ?></label>
                    <div class="col-sm-6">
                        <select class="form-control basic-single" name="timeformat">
                            <option value=""><?php echo display('select_date_format') ?></option>
                            <option value="d/m/Y" <?php if ($setting->dateformat == "d/m/Y") {
                                                        echo display('selected');
                                                    } ?>>
                                <?php echo display('ddmmyyyy'); ?></option>
                            <option value="Y/m/d" <?php if ($setting->dateformat == "Y/m/d") {
                                                        echo display('selected');
                                                    } ?>>
                                <?php echo display('yyyymmdd'); ?></option>
                            <option value="d-m-Y" <?php if ($setting->dateformat == "d-m-Y") {
                                                        echo display('selected');
                                                    } ?>>
                                <?php echo display('dmy'); ?></option>
                            <option value="Y-m-d" <?php if ($setting->dateformat == "Y-m-d") {
                                                        echo display('selected');
                                                    } ?>>
                                <?php echo display('ymd'); ?></option>
                            <option value="m/d/Y" <?php if ($setting->dateformat == "m/d/Y") {
                                                        echo display('selected');
                                                    } ?>>
                                <?php echo display('mdy'); ?></option>
                            <option value="d M,Y" <?php if ($setting->dateformat == "d M,Y") {
                                                        echo display('selected');
                                                    } ?>>
                                <?php echo display('ddmyyyy'); ?></option>
                            <option value="d F,Y" <?php if ($setting->dateformat == "d F,Y") {
                                                        echo display('selected');
                                                    } ?>>
                                <?php echo display('mmddyyyy'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="footer_text"
                        class="col-sm-3 col-form-label"><?php echo display('timezone'); ?></label>
                    <div class="col-sm-6">
                        <select class="form-control basic-single" name="timezone">
                            <option value=""><?php echo display('select') . " " . display("timezone") ?></option>
                            <?php foreach ($timezone as $tzone) { ?>
                                <option value="<?php echo html_escape($tzone->zone) ?>" <?php if (strtolower($setting->timezone) == strtolower($tzone->zone)) {
                                                                                            echo display('selected');
                                                                                        } ?>>
                                    <?php echo html_escape($tzone->zone) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="checkin" class="col-sm-3 col-form-label"><?php echo display('checkin_time'); ?></label>
                    <div class="col-sm-6">
                        <input name="checkintime" type="text" class="form-control" id="checkintime"
                            placeholder="<?php echo display('checkin_time'); ?>"
                            value="<?php echo html_escape($setting->checkintime) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storevat"
                        class="col-sm-3 col-form-label"><?php echo display('checkout_time'); ?></label>
                    <div class="col-sm-6">
                        <input name="checkouttime" type="text" class="form-control" id="checkouttime"
                            placeholder="<?php echo display('checkout_time'); ?>"
                            value="<?php echo html_escape($setting->checkouttime) ?>">
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <label for="footer_text" class="col-sm-3 col-form-label"><?php echo display('site_align') ?></label>
                    <div class="col-sm-6">
                        <?php echo form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')), $setting->site_align, 'class="basic-single form-control" id="site_align"') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pricetxt" class="col-sm-3 col-form-label"><?php echo display("price_text"); ?></label>
                    <div class="col-sm-6">
                        <textarea name="pricetxt" class="form-control" placeholder="<?php echo display("price_text"); ?>" maxlength="140"
                            rows="7"><?php echo html_escape($setting->pricetxt) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="power_text" class="col-sm-3 col-form-label"><?php echo display("powered_by_text"); ?></label>
                    <div class="col-sm-6">
                        <textarea name="power_text" class="form-control" placeholder="<?php echo display("powered_by_text"); ?>" maxlength="140"
                            rows="7"><?php echo html_escape($setting->powerbytxt) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="footer_text"
                        class="col-sm-3 col-form-label"><?php echo display('footer_text') ?></label>
                    <div class="col-sm-6">
                        <textarea name="footer_text" class="form-control" placeholder="<?php echo display('footer_text') ?>" maxlength="140"
                            rows="7"><?php echo html_escape($setting->footer_text) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="footer_text"
                        class="col-sm-3 col-form-label"><?php echo display('is_use_website') ?></label>
                    <div class="col-sm-6">
                        <select name="use_web_status" id="use_web_status" class="form-control">
                            <option value="">--Selected--</option>
                            <option value="1" <?php echo $setting->use_web_status ==1 ? 'selected': ''; ?>>Yes/ Use website</option>
                            <option value="0" <?php echo $setting->use_web_status ==0 ? 'selected': ''; ?>>No/ Not use website</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row text-right">
                    <label for="footer_text" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-6">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>application/modules/dashboard/assets/js/application_setting.js?v=<?php echo date('d');?>"></script>