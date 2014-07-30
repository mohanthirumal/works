<?php
/**
 * Template Name: Payment Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();
 ?>
 
 <script src="http://cdn.webrupee.com/js" type="text/javascript"></script>
 <div class="page-content aboutus payment">
 	<img src="<?php bloginfo('template_url');?>/images/payment-banner.jpg" alt="" class="teachers-banner"/>
	<div class="payment-page-inner">
		<div class="title1 trebuchet">COURSES</div>
		<div class="clear"></div>
		The course follows a systematic progress route with 3 levels - Beginner, Intermediate and Advanced. Each level contains 10 units. It has been designed by British Council who is your best starting point for learning English. With over 70 years of English language teaching experience, we can help you achieve your goals!		

		<!-- Payment level maintainer : START -->
		<div class="payment-list-container" style="margin: 20px 0 0 0;">
			<div class="payment-column-outer">
			<div class="payment-column flipInY animate pr-tb-col" onclick="selectPayment(this)">
				<div class="payment-column-header">Level 1 - Beginner</div>
				<div class="payment-column-price"><div class="price">Rs 1000</div><span class="cond">(Access for 3 months)</span></div>
				<div class="payment-column-body">
					<div class="payment-column-body-inner">
						10 Units covering<br/>
						&nbsp;&nbsp;- 10 Conversation Video Activities <br/>
						&nbsp;&nbsp;- 20 Grammar Video Activities 
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						&nbsp;&nbsp;- 10 Player Profiles <br/>
						&nbsp;&nbsp;- 20 Word Maps 
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						&nbsp;&nbsp;- 3 Video Anecdotes <br/>
						&nbsp;&nbsp;- 10 Listen & Speak Activities 
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<!--<input type="button" value="Learn More" class="learn-more-btn"/>-->
					<input type="hidden" value="1000" id="levelid1"/>
					<a onclick="selectPaymentOption(1)" class="learn-more-btn" style="text-decoration:none; font-weight: bold;" target="_blank">Select</a>
                    <a href="<?php bloginfo('home');?>/Course_ Syllabus-Level1.pdf" class="learn-more-btn" style="text-decoration:none; font-weight: bold;" target="_blank">Learn More</a>
				</div>
			</div>
			</div>
			<div class="payment-column-outer">
			<div class="payment-column flipInY animate pr-tb-col" onclick="selectPayment(this)">
				<div class="payment-column-header">Level 2 - Intermediate</div>
				<div class="payment-column-price"><div class="price">Rs 1000</div><span class="cond">(Access for 3 months)</span></div>
				<div class="payment-column-body">
					<div class="payment-column-body-inner">
						10 Units covering<br/>
						&nbsp;&nbsp;- 10 Conversation Video Activities <br/>
						&nbsp;&nbsp;- 10 Grammar Video Activities
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						&nbsp;&nbsp;- 10 Player Profiles <br/>
						&nbsp;&nbsp;- 10 Video Anecdotes 
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						&nbsp;&nbsp;- 10 Listen & Speak Activities<br/>
						&nbsp;&nbsp; 
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<!--<input type="button" value="Learn More" class="learn-more-btn"/>-->
					<input type="hidden" value="1000" id="levelid4"/>
					<a onclick="selectPaymentOption(4)" class="learn-more-btn" style="text-decoration:none; font-weight: bold;" target="_blank">Select</a>
                    <a href="<?php bloginfo('home');?>/Course_Syllabus-Level2.pdf" class="learn-more-btn" style="text-decoration:none; font-weight: bold;" target="_blank">Learn More</a>
				</div>
			</div>
			</div>
			<div class="payment-column-outer">
			<div class="payment-column flipInY animate pr-tb-col" onclick="selectPayment(this)">
				<div class="payment-column-header">Level 3 - Advanced</div>
				<div class="payment-column-price"><div class="price">Rs 1000</div><span class="cond">(Access for 3 months)</span></div>
				<div class="payment-column-body">
					<div class="payment-column-body-inner">
						10 Units covering<br/>
						&nbsp;&nbsp;- 10 Conversation Video Activities<br/>
						&nbsp;&nbsp;- 7 Grammar Video Activities
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						&nbsp;&nbsp;- 10 Player Profiles<br/>
						&nbsp;&nbsp;- 12 Cricketing Tips
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						&nbsp;&nbsp;- 10 Listen & Speak Activities<br/>
						&nbsp;&nbsp;
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<input type="hidden" value="1000" id="levelid5"/>
					<!--<input type="button" value="Learn More" class="learn-more-btn"/>-->
					<a onclick="selectPaymentOption(5)" class="learn-more-btn" style="text-decoration:none; font-weight: bold;" target="_blank">Select</a>
                    <a href="<?php bloginfo('home');?>/Course_Syllabus-Level3.pdf" class="learn-more-btn" style="text-decoration:none; font-weight: bold;" target="_blank">Learn More</a>
				</div>
			</div>
			</div>
			<div class="payment-column-outer">
			<div class="payment-column flipInY animate pr-tb-col" onclick="selectPayment(this)">
				<div class="payment-column-header">*Premium</div>
				<div class="payment-column-price"><div class="payment-offer"></div><div class="price">Rs 2400</div><span class="cond">(Access for 6 months)</span></div>
				<div class="payment-column-body">
					<div class="payment-column-body-inner">
						Level 1 - Beginner
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						Level 2 - Intermediate
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">
						Level 3 - Advanced
					</div>
					<div class="clear"></div>
					<div class="payment-column-body-divider"></div>
					<div class="payment-column-body-inner">*PREMIUM PACKAGE - Special discounted rate of Rs.2400/- to access all 3 levels for 6 months.</div>					
					
					<!--<input type="button" value="Learn More" class="learn-more-btn"/>-->
					<input type="hidden" value="2400" id="levelid6"/>
					<div style="height:80px;"></div>
					<a onclick="selectPaymentOption(6)" class="learn-more-btn" style="text-decoration:none; font-weight: bold; margin-left:80px" target="_blank">Select</a>
				</div>
			</div>
			</div>
		</div>
		<!-- Payment level maintainer : ENDS -->
		
		
		
		
		
	</div>
		<div class="clear"><div style="font-size:16px; color:#35AAD8; font-weight:bold;">*PREMIUM PACKAGE - Special discounted rate of Rs.2400/- to access all 3 levels for 6 months.</div></div><div>
		<div class="transparent-payment-container">
		<div class="billing-container">
			<div class="billing-container-inner">
			<div class="payment-close-btn" onclick="closePaymentPop()"></div>
			<div class="clear"></div>
			<div class="payment-title" id="payment-msg-1">Thanks for choosing EnglishStrokes. You have selected Level 1 - Beginner. <br/>The amount is Rs 1000. Please fill in your details.</div>
			<div class="payment-title" id="payment-msg-4">Thanks for choosing EnglishStrokes. You have selected Level 2 - Intermediate. <br/>The amount is Rs 1000. Please fill in your details.</div>
			<div class="payment-title" id="payment-msg-5">Thanks for choosing EnglishStrokes. You have selected Level 3 - Advanced. <br/>The amount is Rs 1000. Please fill in your details.</div>
			<div class="payment-title" id="payment-msg-6">Thanks for choosing EnglishStrokes. You have selected the Premium Package. <br/>The amount is Rs 2400. Please fill in your details.</div>
			<form action="<?php bloginfo('home');?>/secure-pay.php" name="frmTransaction" id="frmTransaction" method="post" class="payment-form" onsubmit="return eng.payment.validatePayment()">
				<table>
					<tr>
						<td>Name *</td>
						<td width="250"><input type="text" name="name" value=""/></td>
						<td>Email *</td>
						<td><input type="text" name="email" value=""/></td>
					</tr>
					<tr>
						<td>Address *</td>
						<td><input type="text" name="address" value=""/></td>
						<td>City *</td>
						<td><input type="text" name="city" value=""/></td>
					</tr>
					<tr>
						<td>State/Province *</td>
						<td><input type="text" name="state" value=""/></td>
						<td>Country *</td>
						<td>
							<select name="country" style="width:155px; margin-left:2px;">
								<option value="Select Country" selected="">Select Country</option>
								<option value="ABW">Aruba</option>
								<option value="AFG">Afghanistan</option>
								<option value="AGO">Angola</option>
								<option value="AIA">Anguilla</option>
								<option value="ALA">Aland Islands</option>
								<option value="ALB">Albania</option>
								<option value="AND">Andorra</option>
								<option value="ANT">Netherlands Antilles</option>
								<option value="ARE">United Arab Emirates</option>
								<option value="ARG">Argentina</option>
								<option value="ARM">Armenia</option>
								<option value="ASM">American Samoa</option>
								<option value="ATA">Antarctica</option>
								<option value="ATF">French Southern Territories</option>
								<option value="ATG">Antigua and Barbuda</option>
								<option value="AUS">Australia</option>
								<option value="AUT">Austria</option>
								<option value="AZE">Azerbaijan</option>
								<option value="BDI">Burundi</option>
								<option value="BEL">Belgium</option>
								<option value="BEN">Benin</option>
								<option value="BFA">Burkina Faso</option>
								<option value="BGD">Bangladesh</option>
								<option value="BGR">Bulgaria</option>
								<option value="BHR">Bahrain</option>
								<option value="BHS">Bahamas</option>
								<option value="BIH">Bosnia and Herzegovina</option>
								<option value="BLM">Saint Barthelemy</option>
								<option value="BLR">Belarus</option>
								<option value="BLZ">Belize</option>
								<option value="BMU">Bermuda</option>
								<option value="BOL">Bolivia</option>
								<option value="BRA">Brazil</option>
								<option value="BRB">Barbados</option>
								<option value="BRN">Brunei Darussalam</option>
								<option value="BTN">Bhutan</option>
								<option value="BVT">Bouvet Island</option>
								<option value="BWA">Botswana</option>
								<option value="CAF">Central African Republic</option>
								<option value="CAN">Canada</option>
								<option value="CCK">Cocos (Keeling) Islands</option>
								<option value="CHE">Switzerland</option>
								<option value="CHL">Chile</option>
								<option value="CHN">China</option>
								<option value="CIV">Cote d`Ivoire</option>
								<option value="CMR">Cameroon</option>
								<option value="COD">Congo, the Democratic Republic of the</option>
								<option value="COG">Congo</option>
								<option value="COK">Cook Islands</option>
								<option value="COL">Colombia</option>
								<option value="COM">Comoros</option>
								<option value="CPV">Cape Verde</option>
								<option value="CRI">Costa Rica</option>
								<option value="CUB">Cuba</option>
								<option value="CXR">Christmas Island</option>
								<option value="CYM">Cayman Islands</option>
								<option value="CYP">Cyprus</option>
								<option value="CZE">Czech Republic</option>
								<option value="DEU">Germany</option>
								<option value="DJI">Djibouti</option>
								<option value="DMA">Dominica</option>
								<option value="DNK">Denmark</option>
								<option value="DOM">Dominican Republic</option>
								<option value="DZA">Algeria</option>
								<option value="ECU">Ecuador</option>
								<option value="EGY">Egypt</option>
								<option value="ERI">Eritrea</option>
								<option value="ESH">Western Sahara</option>
								<option value="ESP">Spain</option>
								<option value="EST">Estonia</option>
								<option value="ETH">Ethiopia</option>
								<option value="FIN">Finland</option>
								<option value="FJI">Fiji</option>
								<option value="FLK">Falkland Islands (Malvinas)</option>
								<option value="FRA">France</option>
								<option value="FRO">Faroe Islands</option>
								<option value="FSM">Micronesia, Federated States of</option>
								<option value="GAB">Gabon</option>
								<option value="GBR">United Kingdom</option>
								<option value="GEO">Georgia</option>
								<option value="GGY">Guernsey</option>
								<option value="GHA">Ghana</option>
								<option value="GIN">N Guinea</option>
								<option value="GIB">Gibraltar</option>
								<option value="GLP">Guadeloupe</option>
								<option value="GMB">Gambia</option>
								<option value="GNB">Guinea-Bissau</option>
								<option value="GNQ">Equatorial Guinea</option>
								<option value="GRC">Greece</option>
								<option value="GRD">Grenada</option>
								<option value="GRL">Greenland</option>
								<option value="GTM">Guatemala</option>
								<option value="GUF">French Guiana</option>
								<option value="GUM">Guam</option>
								<option value="GUY">Guyana</option>
								<option value="HKG">Hong Kong</option>
								<option value="HMD">Heard Island and McDonald Islands</option>
								<option value="HND">Honduras</option>
								<option value="HRV">Croatia</option>
								<option value="HTI">Haiti</option>
								<option value="HUN">Hungary</option>
								<option value="IDN">Indonesia</option>
								<option value="IMN">Isle of Man</option>
								<option value="IND">India</option>
								<option value="IOT">British Indian Ocean Territory</option>
								<option value="IRL">Ireland</option>
								<option value="IRN">Iran, Islamic Republic of</option>
								<option value="IRQ">Iraq</option>
								<option value="ISL">Iceland</option>
								<option value="ISR">Israel</option>
								<option value="ITA">Italy</option>
								<option value="JAM">Jamaica</option>
								<option value="JEY">Jersey</option>
								<option value="JOR">Jordan</option>
								<option value="JPN">Japan</option>
								<option value="KAZ">Kazakhstan</option>
								<option value="KEN">Kenya</option>
								<option value="KGZ">Kyrgyzstan</option>
								<option value="KHM">Cambodia</option>
								<option value="KIR">Kiribati</option>
								<option value="KNA">Saint Kitts and Nevis</option>
								<option value="KOR">Korea, Republic of</option>
								<option value="KWT">Kuwait</option>
								<option value="LAO">Lao People`s Democratic Republic</option>
								<option value="LBN">Lebanon</option>
								<option value="LBR">Liberia</option>
								<option value="LBY">Libyan Arab Jamahiriya</option>
								<option value="LCA">Saint Lucia</option>
								<option value="LIE">Liechtenstein</option>
								<option value="LKA">Sri Lanka</option>
								<option value="LSO">Lesotho</option>
								<option value="LTU">Lithuania</option>
								<option value="LUX">Luxembourg</option>
								<option value="LVA">Latvia</option>
								<option value="MAC">Macao</option>
								<option value="MAF">Saint Martin (French part)</option>
								<option value="MAR">Morocco</option>
								<option value="MCO">Monaco</option>
								<option value="MDA">Moldova</option>
								<option value="MDG">Madagascar</option>
								<option value="MDV">Maldives</option>
								<option value="MEX">Mexico</option>
								<option value="MHL">Marshall Islands</option>
								<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
								<option value="MLI">Mali</option>
								<option value="MLT">Malta</option>
								<option value="MMR">Myanmar</option>
								<option value="MNE">Montenegro</option>
								<option value="MNG">Mongolia</option>
								<option value="MNP">Northern Mariana Islands</option>
								<option value="MOZ">Mozambique</option>
								<option value="MRT">Mauritania</option>
								<option value="MSR">Montserrat</option>
								<option value="MTQ">Martinique</option>
								<option value="MUS">Mauritius</option>
								<option value="MWI">Malawi</option>
								<option value="MYS">Malaysia</option>
								<option value="MYT">Mayotte</option>
								<option value="NAM">Namibia</option>
								<option value="NCL">New Caledonia</option>
								<option value="NER">Niger</option>
								<option value="NFK">Norfolk Island</option>
								<option value="NGA">Nigeria</option>
								<option value="NIC">Nicaragua</option>
								<option value="NOR">R Norway</option>
								<option value="NIU">Niue</option>
								<option value="NLD">Netherlands</option>
								<option value="NPL">Nepal</option>
								<option value="NRU">Nauru</option>
								<option value="NZL">New Zealand</option>
								<option value="OMN">Oman</option>
								<option value="PAK">Pakistan</option>
								<option value="PAN">Panama</option>
								<option value="PCN">Pitcairn</option>
								<option value="PER">Peru</option>
								<option value="PHL">Philippines</option>
								<option value="PLW">Palau</option>
								<option value="PNG">Papua New Guinea</option>
								<option value="POL">Poland</option>
								<option value="PRI">Puerto Rico</option>
								<option value="PRK">Korea, Democratic People`s Republic of</option>
								<option value="PRT">Portugal</option>
								<option value="PRY">Paraguay</option>
								<option value="PSE">Palestinian Territory, Occupied</option>
								<option value="PYF">French Polynesia</option>
								<option value="QAT">Qatar</option>
								<option value="REU">Reunion</option>
								<option value="ROU">Romania</option>
								<option value="RUS">Russian Federation</option>
								<option value="RWA">Rwanda</option>
								<option value="SAU">Saudi Arabia</option>
								<option value="SDN">Sudan</option>
								<option value="SEN">Senegal</option>
								<option value="SGP">Singapore</option>
								<option value="SGS">South Georgia and the South Sandwich Islands</option>
								<option value="SHN">Saint Helena</option>
								<option value="SJM">Svalbard and Jan Mayen</option>
								<option value="SLB">Solomon Islands</option>
								<option value="SLE">Sierra Leone</option>
								<option value="SLV">El Salvador</option>
								<option value="SMR">San Marino</option>
								<option value="SOM">Somalia</option>
								<option value="SPM">Saint Pierre and Miquelon</option>
								<option value="SRB">Serbia</option>
								<option value="STP">Sao Tome and Principe</option>
								<option value="SUR">Suriname</option>
								<option value="SVK">Slovakia</option>
								<option value="SVN">Slovenia</option>
								<option value="SWE">Sweden</option>
								<option value="SWZ">Swaziland</option>
								<option value="SYC">Seychelles</option>
								<option value="SYR">Syrian Arab Republic</option>
								<option value="TCA">Turks and Caicos Islands</option>
								<option value="TCD">Chad</option>
								<option value="TGO">Togo</option>
								<option value="THA">Thailand</option>
								<option value="TJK">Tajikistan</option>
								<option value="TKL">Tokelau</option>
								<option value="TKM">Turkmenistan</option>
								<option value="TLS">Timor-Leste</option>
								<option value="TON">Tonga</option>
								<option value="TTO">Trinidad and Tobago</option>
								<option value="TUN">Tunisia</option>
								<option value="TUR">Turkey</option>
								<option value="TUV">Tuvalu</option>
								<option value="TWN">Taiwan, Province of China</option>
								<option value="TZA">Tanzania, United Republic of</option>
								<option value="UGA">Uganda</option>
								<option value="UKR">Ukraine</option>
								<option value="UMI">United States Minor Outlying Islands</option>
								<option value="URY">Uruguay</option>
								<option value="USA">United States</option>
								<option value="UZB">Uzbekistan</option>
								<option value="VAT">Holy See (Vatican City State)</option>
								<option value="VCT">Saint Vincent and the Grenadines</option>
								<option value="VEN">Venezuela</option>
								<option value="VGB">Virgin Islands, British</option>
								<option value="VIR">Virgin Islands, U.S.</option>
								<option value="VNM">Viet Nam</option>
								<option value="VUT">Vanuatu</option>
								<option value="WLF">Wallis and Futuna</option>
								<option value="WSM">Samoa</option>
								<option value="YEM">Yemen</option>
								<option value="ZAF">South Africa</option>
								<option value="ZMB">Zambia</option>
								<option value="ZWE">Zimbabwe</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Zip/Postal Code *</td>
						<td><input type="text" name="postal_code" value=""/></td>
						<td>Telephone *</td>
						<td><input type="text" name="phone" value=""/></td>
					</tr>
					<tr>
						<td colspan="4" align="center">
							<input type="submit" class="payment-btn-class btn-login-changes" value="" style="margin:20px 0 0 240px;"/>
							<input type="reset" value="" class="payment-reset-class" style="margin:20px 0 0 10px;"/>
						</td>
					</tr>
				</table>
				<input name="orderid" type="hidden" value="<?php echo rand();?>" />
				<input name="reference_no" id="reference_no" type="hidden" value="" />
				<input name="description" type="hidden" value="" />
			</form>
			</div>
		</div>
		</div>
	</div>
 </div>
 
 <!-- mahendran changes --->
 <div class="alertContainnorClass" style="display:none;">
 </div>
 <script>
//$('.btn-login-changes').click(function(){
//	$('.alertContainnorClass').show();
//	$('.transparent-container').show();
//	closePaymentPop();
//})
 </script>
 <!--End-->
 <?php
 get_footer();