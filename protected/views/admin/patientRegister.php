<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/login.js" type="text/javascript"></script>

<script>
		jQuery(document).ready(function() {   
		 $('[data-toggle="tooltip"]').tooltip();
		  Login.init();
		});
	</script>

<!-- END PAGE LEVEL SCRIPTS -->
   
<!-- BEGIN LOGO -->
<div class="logo" style="padding: 0px !important;">
	
</div>
<!-- END LOGO -->

<div class="col-md-12">
<?php //echo "<pre>"; print_r($_COOKIE); exit; ?>

<!-- BEGIN LOGIN -->
<div class="content2">
<a href="<?php echo Yii::app()->params->base_path ; ?>admin/">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/c2zoom.png" height="90%" width="90%"/>
	</a>
    
    <!-- BEGIN LOGIN FORM -->
	
	<!-- END LOGIN FORM -->
    
    <!-- BEGIN REGISTRATION FORM -->
	<form class="register-form" action="<?php echo Yii::app()->params->base_path;?>admin/patientRegister" method="post" style="display:block;">
		<h3>Create Account</h3>
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Full Name*</label>
			<div class="row">
				<div class="col-md-6">
					<div class="input-icon">
						<i class="fa fa-font"></i>
						<input class="form-control placeholder-no-fix" type="text" title="Your name will appear to your friends, co-workers, family, and others in the C2zoom services you use." data-toggle="tooltip" data-placement="bottom"  placeholder="First Name *" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];} ?>"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-icon">
						<i class="fa fa-font"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="Last Name *" name="surname" title="Your name will appear to your friends, co-workers, family, and others in the C2zoom services you use." data-toggle="tooltip" data-placement="bottom" value="<?php if(isset($_POST['surname'])){ echo $_POST['surname'];} ?>"/>
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" id="email" placeholder="Email *" title="Use your favorite email address to sign in to all C2zoom services."  data-toggle="tooltip" data-placement="bottom" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>"/>
			</div>
		</div>
        
        <div class="form-group">
			 <label class="control-label visible-ie8 visible-ie9">Password*</label>
                    <div class="input-icon">
                        <i class="fa fa-key"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password *" name="password" id="register_password" title="Passwords must have at least 8 characters and contain at least two of the following: uppercase letters, lowercase letters, numbers, and symbols."  data-toggle="tooltip" data-placement="bottom" value="<?php if(isset($_COOKIE['password']) && $_COOKIE['password'] != "0") { echo $_COOKIE['password']; }?>"/><span>8-character minimum;</span>
                    </div>
		</div>
		<div class="form-group">
		        <label class="control-label visible-ie8 visible-ie9">Confirm Password*</label>
                <div class="input-icon">
                    <i class="fa fa-key"></i>
                    <input class="form-control placeholder-no-fix" type="password"  autocomplete="off" placeholder="Confirm Password *" name="cpassword" value="<?php if(isset($_COOKIE['cpassword']) && $_COOKIE['cpassword'] != "0") { echo $_COOKIE['cpassword']; }?>"/>
                </div>    
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Phone number*</label>
			<div class="input-icon">
				<i class="fa fa-mobile"></i>
				<input class="form-control" type="text"  placeholder="Phone number *" id="phone_number"  name="phone_number" title="Your phone number helps us keep your account secure. We'll send a verification code as a text message or an automated call if we need to verify your identity." data-toggle="tooltip" data-placement="bottom" value="<?php if(isset($_POST['phone_number']) && $_POST['phone_number'] != "0") { echo $_POST['phone_number']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Birthday</label>
			<div class="input-icon">
				<i class="fa fa-calendar"></i>
				<input class="form-control form-control-inline input date-picker" type="text"  data-date-format="dd-mm-yyyy" data-date-start-date="-110y" data-date-end-date="+0d" readonly placeholder="Birth date" name="birth_date" title="Your date of birth helps us provide you with things like age-appropriate settings."  data-toggle="tooltip" data-placement="bottom" value="<?php if(isset($_POST['birth_date']) && $_POST['birth_date'] != "0") { echo $_POST['birth_date']; }?>"/>
			</div>
		</div>
        
        <!--<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Address</label>
			<div class="input-icon">
				<i class="fa fa-home"></i>
				<input class="form-control placeholder-no-fix" type="text"  placeholder="Address" name="address" value="<?php //if(isset($_POST['address']) && $_POST['address'] != "0") { echo $_POST['address']; }?>"/>
			</div>
		</div>-->
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Gender</label>
			<div class="input-icon">
				 <i class="fa fa-user"></i>
				      
                         <select name="gender" class="form-control" id="gender">
                         	 <option  value="">- Select Gender -</option>
                             <option <?php if(isset($_POST['gender']) && $_POST['gender'] == "0") { ?> selected <?php } ?>  value="0">Female</option>
                             <option <?php if(isset($_POST['gender']) && $_POST['gender'] == "1") { ?> selected <?php } ?> value="1">Male</option>
                             <option <?php if(isset($_POST['gender']) && $_POST['gender'] == "2") { ?> selected <?php } ?> value="2">Not specified</option>
                         </select>
                        
                        
                       
				
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Country code</label>
			<div class="input-icon">
				 <i class="fa fa-home"></i>
                        <select data-bind="options: phoneCountries, optionsValue: 'iso', optionsText: 'displayValue', value: phoneCountry" name="countrycode" class="form-control" id="countrycode">
                        <option value="">- Select Country Code -</option><option value="AF">Afghanistan &rlm;(&lrm;+93)</option><option value="AL">Albania &rlm;(&lrm;+355)</option><option value="DZ">Algeria &rlm;(&lrm;+213)</option><option value="AD">Andorra &rlm;(&lrm;+376)</option><option value="AO">Angola &rlm;(&lrm;+244)</option><option value="AQ">Antarctica &rlm;(&lrm;+672)</option><option value="AG">Antigua and Barbuda &rlm;(&lrm;+1)</option><option value="AR">Argentina &rlm;(&lrm;+54)</option><option value="AM">Armenia &rlm;(&lrm;+374)</option><option value="AW">Aruba &rlm;(&lrm;+297)</option><option value="AC">Ascension Island &rlm;(&lrm;+247)</option><option value="AU">Australia &rlm;(&lrm;+61)</option><option value="AT">Austria &rlm;(&lrm;+43)</option><option value="AZ">Azerbaijan &rlm;(&lrm;+994)</option><option value="BS">Bahamas &rlm;(&lrm;+1)</option><option value="BH">Bahrain &rlm;(&lrm;+973)</option><option value="BD">Bangladesh &rlm;(&lrm;+880)</option><option value="BB">Barbados &rlm;(&lrm;+1)</option><option value="BY">Belarus &rlm;(&lrm;+375)</option><option value="BE">Belgium &rlm;(&lrm;+32)</option><option value="BZ">Belize &rlm;(&lrm;+501)</option><option value="BJ">Benin &rlm;(&lrm;+229)</option><option value="BM">Bermuda &rlm;(&lrm;+1)</option><option value="BT">Bhutan &rlm;(&lrm;+975)</option><option value="BO">Bolivia &rlm;(&lrm;+591)</option><option value="BA">Bosnia and Herzegovina &rlm;(&lrm;+387)</option><option value="BW">Botswana &rlm;(&lrm;+267)</option><option value="BV">Bouvet Island &rlm;(&lrm;+47)</option><option value="BR">Brazil &rlm;(&lrm;+55)</option><option value="IO">British Indian Ocean Territory &rlm;(&lrm;+44)</option><option value="BN">Brunei &rlm;(&lrm;+673)</option><option value="BG">Bulgaria &rlm;(&lrm;+359)</option><option value="BF">Burkina Faso &rlm;(&lrm;+226)</option><option value="BI">Burundi &rlm;(&lrm;+257)</option><option value="CV">Cabo Verde &rlm;(&lrm;+238)</option><option value="KH">Cambodia &rlm;(&lrm;+855)</option><option value="CM">Cameroon &rlm;(&lrm;+237)</option><option value="CA">Canada &rlm;(&lrm;+1)</option><option value="KY">Cayman Islands &rlm;(&lrm;+1)</option><option value="CF">Central African Republic &rlm;(&lrm;+236)</option><option value="TD">Chad &rlm;(&lrm;+235)</option><option value="CL">Chile &rlm;(&lrm;+56)</option><option value="CN">China &rlm;(&lrm;+86)</option><option value="CX">Christmas Island &rlm;(&lrm;+61)</option><option value="CC">Cocos (Keeling) Islands &rlm;(&lrm;+61)</option><option value="CO">Colombia &rlm;(&lrm;+57)</option><option value="KM">Comoros &rlm;(&lrm;+269)</option><option value="CG">Congo &rlm;(&lrm;+242)</option><option value="CD">Congo (DRC) &rlm;(&lrm;+243)</option><option value="CK">Cook Islands &rlm;(&lrm;+682)</option><option value="CR">Costa Rica &rlm;(&lrm;+506)</option><option value="HR">Croatia &rlm;(&lrm;+385)</option><option value="CU">Cuba &rlm;(&lrm;+53)</option><option value="CY">Cyprus &rlm;(&lrm;+357)</option><option value="CZ">Czech Republic &rlm;(&lrm;+420)</option><option value="DK">Denmark &rlm;(&lrm;+45)</option><option value="DJ">Djibouti &rlm;(&lrm;+253)</option><option value="DM">Dominica &rlm;(&lrm;+1)</option><option value="DO">Dominican Republic &rlm;(&lrm;+1)</option><option value="EC">Ecuador &rlm;(&lrm;+593)</option><option value="EG">Egypt &rlm;(&lrm;+20)</option><option value="SV">El Salvador &rlm;(&lrm;+503)</option><option value="GQ">Equatorial Guinea &rlm;(&lrm;+240)</option><option value="ER">Eritrea &rlm;(&lrm;+291)</option><option value="EE">Estonia &rlm;(&lrm;+372)</option><option value="ET">Ethiopia &rlm;(&lrm;+251)</option><option value="FK">Falkland Islands &rlm;(&lrm;+500)</option><option value="FO">Faroe Islands &rlm;(&lrm;+298)</option><option value="FJ">Fiji Islands &rlm;(&lrm;+679)</option><option value="FI">Finland &rlm;(&lrm;+358)</option><option value="FR">France &rlm;(&lrm;+33)</option><option value="GF">French Guiana &rlm;(&lrm;+594)</option><option value="PF">French Polynesia &rlm;(&lrm;+689)</option><option value="GA">Gabon &rlm;(&lrm;+241)</option><option value="GM">Gambia, The &rlm;(&lrm;+220)</option><option value="GE">Georgia &rlm;(&lrm;+995)</option><option value="DE">Germany &rlm;(&lrm;+49)</option><option value="GH">Ghana &rlm;(&lrm;+233)</option><option value="GI">Gibraltar &rlm;(&lrm;+350)</option><option value="GR">Greece &rlm;(&lrm;+30)</option><option value="GL">Greenland &rlm;(&lrm;+299)</option><option value="GD">Grenada &rlm;(&lrm;+1)</option><option value="GP">Guadeloupe &rlm;(&lrm;+590)</option><option value="GU">Guam &rlm;(&lrm;+1)</option><option value="GT">Guatemala &rlm;(&lrm;+502)</option><option value="GG">Guernsey &rlm;(&lrm;+44)</option><option value="GN">Guinea &rlm;(&lrm;+224)</option><option value="GW">Guinea-Bissau &rlm;(&lrm;+245)</option><option value="GY">Guyana &rlm;(&lrm;+592)</option><option value="HT">Haiti &rlm;(&lrm;+509)</option><option value="VA">Holy See (Vatican City) &rlm;(&lrm;+379)</option><option value="HN">Honduras &rlm;(&lrm;+504)</option><option value="HK">Hong Kong SAR &rlm;(&lrm;+852)</option><option value="HU">Hungary &rlm;(&lrm;+36)</option><option value="IS">Iceland &rlm;(&lrm;+354)</option><option value="IN">India &rlm;(&lrm;+91)</option><option value="ID">Indonesia &rlm;(&lrm;+62)</option><option value="IR">Iran &rlm;(&lrm;+98)</option><option value="IQ">Iraq &rlm;(&lrm;+964)</option><option value="IE">Ireland &rlm;(&lrm;+353)</option><option value="IM">Isle of Man &rlm;(&lrm;+44)</option><option value="IL">Israel &rlm;(&lrm;+972)</option><option value="IT">Italy &rlm;(&lrm;+39)</option><option value="JM">Jamaica &rlm;(&lrm;+1)</option><option value="SJ">Jan Mayen &rlm;(&lrm;+47)</option><option value="JP">Japan &rlm;(&lrm;+81)</option><option value="JE">Jersey &rlm;(&lrm;+44)</option><option value="JO">Jordan &rlm;(&lrm;+962)</option><option value="KZ">Kazakhstan &rlm;(&lrm;+7)</option><option value="KE">Kenya &rlm;(&lrm;+254)</option><option value="KI">Kiribati &rlm;(&lrm;+686)</option><option value="KR">Korea &rlm;(&lrm;+82)</option><option value="KW">Kuwait &rlm;(&lrm;+965)</option><option value="KG">Kyrgyzstan &rlm;(&lrm;+996)</option><option value="LA">Laos &rlm;(&lrm;+856)</option><option value="LV">Latvia &rlm;(&lrm;+371)</option><option value="LB">Lebanon &rlm;(&lrm;+961)</option><option value="LS">Lesotho &rlm;(&lrm;+266)</option><option value="LR">Liberia &rlm;(&lrm;+231)</option><option value="LY">Libya &rlm;(&lrm;+218)</option><option value="LI">Liechtenstein &rlm;(&lrm;+423)</option><option value="LT">Lithuania &rlm;(&lrm;+370)</option><option value="LU">Luxembourg &rlm;(&lrm;+352)</option><option value="MO">Macao SAR &rlm;(&lrm;+853)</option><option value="MK">Macedonia, Former Yugoslav Republic of &rlm;(&lrm;+389)</option><option value="MG">Madagascar &rlm;(&lrm;+261)</option><option value="MW">Malawi &rlm;(&lrm;+265)</option><option value="MY">Malaysia &rlm;(&lrm;+60)</option><option value="MV">Maldives &rlm;(&lrm;+960)</option><option value="ML">Mali &rlm;(&lrm;+223)</option><option value="MT">Malta &rlm;(&lrm;+356)</option><option value="MH">Marshall Islands &rlm;(&lrm;+692)</option><option value="MQ">Martinique &rlm;(&lrm;+596)</option><option value="MR">Mauritania &rlm;(&lrm;+222)</option><option value="MU">Mauritius &rlm;(&lrm;+230)</option><option value="YT">Mayotte &rlm;(&lrm;+262)</option><option value="MX">Mexico &rlm;(&lrm;+52)</option><option value="FM">Micronesia &rlm;(&lrm;+691)</option><option value="MD">Moldova &rlm;(&lrm;+373)</option><option value="MC">Monaco &rlm;(&lrm;+377)</option><option value="MN">Mongolia &rlm;(&lrm;+976)</option><option value="ME">Montenegro &rlm;(&lrm;+382)</option><option value="MS">Montserrat &rlm;(&lrm;+1)</option><option value="MA">Morocco &rlm;(&lrm;+212)</option><option value="MZ">Mozambique &rlm;(&lrm;+258)</option><option value="MM">Myanmar &rlm;(&lrm;+95)</option><option value="NA">Namibia &rlm;(&lrm;+264)</option><option value="NR">Nauru &rlm;(&lrm;+674)</option><option value="NP">Nepal &rlm;(&lrm;+977)</option><option value="NL">Netherlands &rlm;(&lrm;+31)</option><option value="AN">Netherlands Antilles (Former) &rlm;(&lrm;+599)</option><option value="NC">New Caledonia &rlm;(&lrm;+687)</option><option value="NZ">New Zealand &rlm;(&lrm;+64)</option><option value="NI">Nicaragua &rlm;(&lrm;+505)</option><option value="NE">Niger &rlm;(&lrm;+227)</option><option value="NG">Nigeria &rlm;(&lrm;+234)</option><option value="NU">Niue &rlm;(&lrm;+683)</option><option value="KP">North Korea &rlm;(&lrm;+850)</option><option value="MP">Northern Mariana Islands &rlm;(&lrm;+1)</option><option value="NO">Norway &rlm;(&lrm;+47)</option><option value="OM">Oman &rlm;(&lrm;+968)</option><option value="PK">Pakistan &rlm;(&lrm;+92)</option><option value="PW">Palau &rlm;(&lrm;+680)</option><option value="PS_0">Palestinian Authority &rlm;(&lrm;+970)</option><option value="PS">Palestinian Authority &rlm;(&lrm;+972)</option><option value="PA">Panama &rlm;(&lrm;+507)</option><option value="PG">Papua New Guinea &rlm;(&lrm;+675)</option><option value="PY">Paraguay &rlm;(&lrm;+595)</option><option value="PE">Peru &rlm;(&lrm;+51)</option><option value="PH">Philippines &rlm;(&lrm;+63)</option><option value="PL">Poland &rlm;(&lrm;+48)</option><option value="PT">Portugal &rlm;(&lrm;+351)</option><option value="QA">Qatar &rlm;(&lrm;+974)</option><option value="CI">Republic of Côte d'Ivoire &rlm;(&lrm;+225)</option><option value="RE">Reunion &rlm;(&lrm;+262)</option><option value="RO">Romania &rlm;(&lrm;+40)</option><option value="RU">Russia &rlm;(&lrm;+7)</option><option value="RW">Rwanda &rlm;(&lrm;+250)</option><option value="SH">Saint Helena, Ascension and Tristan da Cunha &rlm;(&lrm;+290)</option><option value="WS">Samoa &rlm;(&lrm;+685)</option><option value="SM">San Marino &rlm;(&lrm;+378)</option><option value="ST">São Tomé and Príncipe &rlm;(&lrm;+239)</option><option value="SA">Saudi Arabia &rlm;(&lrm;+966)</option><option value="SN">Senegal &rlm;(&lrm;+221)</option><option value="RS">Serbia &rlm;(&lrm;+381)</option><option value="SC">Seychelles &rlm;(&lrm;+248)</option><option value="SL">Sierra Leone &rlm;(&lrm;+232)</option><option value="SG">Singapore &rlm;(&lrm;+65)</option><option value="SK">Slovakia &rlm;(&lrm;+421)</option><option value="SI">Slovenia &rlm;(&lrm;+386)</option><option value="SB">Solomon Islands &rlm;(&lrm;+677)</option><option value="SO">Somalia &rlm;(&lrm;+252)</option><option value="ZA">South Africa &rlm;(&lrm;+27)</option><option value="ES">Spain &rlm;(&lrm;+34)</option><option value="LK">Sri Lanka &rlm;(&lrm;+94)</option><option value="KN">St. Kitts and Nevis &rlm;(&lrm;+1)</option><option value="LC">St. Lucia &rlm;(&lrm;+1)</option><option value="PM">St. Pierre and Miquelon &rlm;(&lrm;+508)</option><option value="VC">St. Vincent and the Grenadines &rlm;(&lrm;+1)</option><option value="SD">Sudan &rlm;(&lrm;+249)</option><option value="SR">Suriname &rlm;(&lrm;+597)</option><option value="SZ">Swaziland &rlm;(&lrm;+268)</option><option value="SE">Sweden &rlm;(&lrm;+46)</option><option value="CH">Switzerland &rlm;(&lrm;+41)</option><option value="SY">Syria &rlm;(&lrm;+963)</option><option value="TW">Taiwan &rlm;(&lrm;+886)</option><option value="TJ">Tajikistan &rlm;(&lrm;+992)</option><option value="TZ">Tanzania &rlm;(&lrm;+255)</option><option value="TH">Thailand &rlm;(&lrm;+66)</option><option value="TL">Timor-Leste &rlm;(&lrm;+670)</option><option value="TG">Togo &rlm;(&lrm;+228)</option><option value="TK">Tokelau &rlm;(&lrm;+690)</option><option value="TO">Tonga &rlm;(&lrm;+676)</option><option value="TT">Trinidad and Tobago &rlm;(&lrm;+1)</option><option value="TA">Tristan da Cunha &rlm;(&lrm;+290)</option><option value="TN">Tunisia &rlm;(&lrm;+216)</option><option value="TR">Turkey &rlm;(&lrm;+90)</option><option value="TM">Turkmenistan &rlm;(&lrm;+993)</option><option value="TC">Turks and Caicos Islands &rlm;(&lrm;+1)</option><option value="TV">Tuvalu &rlm;(&lrm;+688)</option><option value="UG">Uganda &rlm;(&lrm;+256)</option><option value="UA">Ukraine &rlm;(&lrm;+380)</option><option value="AE">United Arab Emirates &rlm;(&lrm;+971)</option><option value="UK">United Kingdom &rlm;(&lrm;+44)</option><option value="US">United States &rlm;(&lrm;+1)</option><option value="UM">United States Minor Outlying Islands &rlm;(&lrm;+1)</option><option value="UY">Uruguay &rlm;(&lrm;+598)</option><option value="UZ">Uzbekistan &rlm;(&lrm;+998)</option><option value="VU">Vanuatu &rlm;(&lrm;+678)</option><option value="VE">Venezuela &rlm;(&lrm;+58)</option><option value="VN">Vietnam &rlm;(&lrm;+84)</option><option value="VG">Virgin Islands, British &rlm;(&lrm;+1)</option><option value="VI">Virgin Islands, U.S. &rlm;(&lrm;+1)</option><option value="WF">Wallis and Futuna &rlm;(&lrm;+681)</option><option value="YE">Yemen &rlm;(&lrm;+967)</option><option value="ZM">Zambia &rlm;(&lrm;+260)</option><option value="ZW">Zimbabwe &rlm;(&lrm;+263)</option></select>
                
			</div>
		</div>
        
        
        
        
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Country / Region</label>
			<div class="input-icon">
				<i class="fa fa-home"></i>
                <select name="country" class="form-control" id="country">
                <option value="">- Select Country -</option>
				<?php 
					$countyObj = new Country();
					$countryData = $countyObj->getAllCountry();
					foreach($countryData as $row) {
				?>
                <option <?php if(isset($_POST['country']) && $_POST['country'] == $row['id']) { ?> selected <?php } ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php } ?>
                </select>
               
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Promotional Offers</label>
			<div class="input-icon">
				<input type="checkbox" <?php if(isset($_POST['promotional_offer']) && $_POST['promotional_offer'] == '1') { ?> checked <?php } ?>  name="promotional_offer" id="promotional_offer" value="1"/><span class="text-base">Send me promotional offers from C2Zoom. You can unsubscribe at any time.</span>
                
               
			</div>
		</div>
        
         <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Agreement</label>
			<div class="input-icon">
				 <div class="col-sm-18">
                        Click <strong>Create account</strong> to agree to the <a href="<?php echo Yii::app()->params->base_path;?>admin/serviceAgreement" target="_blank">C2Zoom Services Agreement</a> and <a href="<?php echo Yii::app()->params->base_path;?>admin/privacy" target="_blank">privacy and cookies statement.</a>
                    </div>
                
               
			</div>
		</div>
        
       
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Make sure this is real person?</label>
			<div class="input-icon">
				<div class="g-recaptcha" data-sitekey="<?php echo (defined("GOOGLE_RECAPTCHA_SITE_KEY") ? GOOGLE_RECAPTCHA_SITE_KEY: "");?>"></div>
               
			</div>
		</div>
        
        
        
		<div class="form-group">
			<label>
			<input type="hidden" name="tnc"/> 
			</label>
			<div id="register_tnc_error">
			</div>
		</div>
		<div class="form-actions">
			<button type="button" class="btn" onClick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/index'">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" id="register-submit-btn" name="register-btn" class="btn green pull-right">
			Create Account <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END REGISTRATION FORM -->

</div>
<!-- END LOGIN -->
</div>
<!-- END BODY -->