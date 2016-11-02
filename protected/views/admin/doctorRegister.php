<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/login.js" type="text/javascript"></script>

<script>
		jQuery(document).ready(function() {   
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
<div class="content">
<a href="<?php echo Yii::app()->params->base_path ; ?>admin">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo.png" height="90%" width="90%"/>
	</a>
    
    <!-- BEGIN LOGIN FORM -->
	
	<!-- END LOGIN FORM -->
    
    <!-- BEGIN REGISTRATION FORM -->
	<form class="register-form" action="<?php echo Yii::app()->params->base_path;?>admin/doctorRegister" method="post" style="display:block;">
		<h3>Create Account</h3>
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Full Name</label>
			<div class="row">
				<div class="col-md-6">
					<div class="input-icon">
						<i class="fa fa-font"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="First Name *" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];} ?>"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-icon">
						<i class="fa fa-font"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="Last Name *" name="surname" value="<?php if(isset($_POST['surname'])){ echo $_POST['surname'];} ?>"/>
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Email *" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-key"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password *" name="password" id="register_password" value="<?php if(isset($_COOKIE['password']) && $_COOKIE['password'] != "0") { echo $_COOKIE['password']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
			<div class="input-icon">
				<i class="fa fa-key"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password *" name="cpassword" value="<?php if(isset($_COOKIE['cpassword']) && $_COOKIE['cpassword'] != "0") { echo $_COOKIE['email']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Mobile number</label>
			<div class="input-icon">
				<i class="fa fa-mobile"></i>
				<input class="form-control" type="text"  placeholder="Mobile number" name="mobile_number" value="<?php if(isset($_COOKIE['mobile_number']) && $_COOKIE['mobile_number'] != "0") { echo $_COOKIE['mobile_number']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Birthday</label>
			<div class="input-icon">
				<i class="fa fa-calendar"></i>
				<input class="form-control form-control-inline input date-picker" type="text" data-date-format="dd-mm-yyyy" data-date-start-date="-110y"  data-date-end-date="+0d" readonly placeholder="Birth date" name="birth_date" value="<?php if(isset($_COOKIE['birth_date']) && $_COOKIE['birth_date'] != "0") { echo $_COOKIE['birth_date']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Address</label>
			<div class="input-icon">
				<i class="fa fa-home"></i>
				<input class="form-control placeholder-no-fix" type="text"  placeholder="Address" name="address" value="<?php if(isset($_COOKIE['address']) && $_COOKIE['address'] != "0") { echo $_COOKIE['address']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Qualitification</label>
			<div class="input-icon">
				<i class="fa fa-book"></i>
				<input class="form-control placeholder-no-fix" type="text"  placeholder="Qualitification" name="qualitification" value="<?php if(isset($_COOKIE['qualitification']) && $_COOKIE['qualitification'] != "0") { echo $_COOKIE['qualitification']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Country / Region</label>
			<div class="input-icon">
				<i class="fa fa-book"></i>
                <select name="country" class="form-control" id="country">
                <option value="">- Select Country -</option>
				<?php 
					$countyObj = new Country();
					$countryData = $countyObj->getAllCountry();
					foreach($countryData as $row) {
				?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php } ?>
                </select>
               
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