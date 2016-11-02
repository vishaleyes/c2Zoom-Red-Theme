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

<!-- END PAGE LEVEL SCRIPTS -->
<script>
		jQuery(document).ready(function() {   
		
		  Metronic.init(); // init metronic core components
		  Layout.init(); // init current layout
		  Login.init();
		  
		  if($('#admin').is(':checked'))
			{
				$("#create_account").hide();
			}
			else
			{
				$("#create_account").show();
			}
		  
		  
		});
		
		
		function doctorClick()
		{
			$("#create_account").show('slow');
		}
		
		function adminClick()
		{
			$("#create_account").hide('slow');
		}
		
		function patientClick()
		{
			$("#create_account").show('slow');
		}
		
		
		function setUrl(url){
			$("#url").val(url);
			return true;
		}
		
		function register()
		{
			if($('#doctor').is(':checked'))
			{
				window.location.href = '<?php echo Yii::app()->params->base_path; ?>admin/doctorRegister';
			}
			
			if($('#patient').is(':checked'))
			{
				window.location.href = '<?php echo Yii::app()->params->base_path; ?>admin/patientRegister';
			}
			
			
			
		}
		
		function forgotPassword()
		{
			if($('#doctor').is(':checked'))
			{
				window.location.href = '<?php echo Yii::app()->params->base_path; ?>admin/doctorforgotPassword';
			}
			
			if($('#patient').is(':checked'))
			{
				window.location.href = '<?php echo Yii::app()->params->base_path; ?>admin/patientforgotPassword';
			}
			
			
			
		}
		
	</script>
        <style>
	.radio input[type=radio], .radio-inline input[type=radio], .checkbox input[type=checkbox], .checkbox-inline input[type=checkbox]
	{
		margin-left:0px;
		cursor:pointer;
	}
	</style>
    
<!-- BEGIN LOGO -->
<div class="logo" style="padding: 0px !important;">
	
</div>
<!-- END LOGO -->

<div class="col-md-12">

<!-- BEGIN LOGIN -->
<div class="content">
<a href="<?php echo Yii::app()->params->base_path ; ?>admin">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo.png" height="90%" width="90%"/>
	</a>
    
    <!-- BEGIN LOGIN FORM -->
	<form class="login-form" method="post" action="<?php echo Yii::app()->params->base_path; ?>admin/adminLogin">
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any Email and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="<?php if(isset($_COOKIE['email']) && $_COOKIE['email'] != "0") { echo $_COOKIE['email']; } ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password']) && $_COOKIE['password'] != "0") { echo $_COOKIE['password']; }?>"/>
			</div>
		</div>
        
        <div class="form-group">
        	<div class="input-icon">
        		<div class="pull-left marg-lft10px">
        			<div class="text-center pull-left padd-rght10px"><input class="form-control placeholder-no-fix" type="radio" onClick="adminClick();"  autocomplete="off" placeholder="Admin" name="login[]" id="admin" checked  value="admin"/></div>
        			<div class="text-center pull-left">Admin</div>
        		</div>
        		<div class="pull-left marg-lft10px">
        			<div class="text-center pull-left padd-rght10px"><input class="form-control placeholder-no-fix" onClick="doctorClick();" type="radio" autocomplete="off" placeholder="Doctor" name="login[]" id="doctor" value="doctor"/></div>
        			<div class="text-center pull-left">Doctor</div>
        		</div>
        		<div class="pull-left marg-lft10px">
        			<div class="text-center pull-left padd-rght10px"><input class="form-control placeholder-no-fix" type="radio" onClick="patientClick();"  autocomplete="off" placeholder="Patient" name="login[]" id="patient" value="patient"/></div>
        			<div class="text-center pull-left">Patient</div>
        		</div>
        		<div style="clear:both;"></div>
        	</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1" <?php if(isset($_COOKIE['email']) && $_COOKIE['email'] != "" && $_COOKIE['email'] != "0") { ?> checked="checked" <?php } ?>/> Remember me </label>
			<button type="submit" name="loginBtn" class="btn green pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		
		<div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
				 no worries, click <a href="javascript:void(0);" onClick="forgotPassword();">
				here </a>
				to reset your password.
			</p>
		</div>
        
        <div class="create-account" id="create_account">
			<p>
				 Don't have an account yet ?&nbsp; <a href="javascript:void(0);" onClick="register();">
				Create an account </a>
			</p>
		</div>
		
	</form>
	<!-- END LOGIN FORM -->

</div>
<!-- END LOGIN -->
</div>
