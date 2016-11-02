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
    
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo" style="padding: 0px !important;">
	
</div>
<!-- END LOGO -->

<div class="col-md-12">
<?php //echo "<pre>"; print_r($_COOKIE); exit; ?>

<!-- BEGIN LOGIN -->
<div class="content">
<a href="<?php echo Yii::app()->params->base_path ; ?>site">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo.png" height="90%" width="90%"/>
	</a>
    
    <!-- BEGIN LOGIN FORM -->
	
	<!-- END LOGIN FORM -->
    
    <!-- BEGIN REGISTRATION FORM -->
	<form role="form"  action="<?php echo Yii::app()->params->base_path;?>admin/SavePatientResetPassword" method="post" class="reset-form" >
    
    
    <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label">Enter Verification Code:</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input type="text" name="token" placeholder="verification code"  id="token" class="form-control" value="<?php if(isset($_REQUEST['fpassword']) && $_REQUEST['fpassword'] != "") { echo $_REQUEST['fpassword'] ; } ?>">
			</div>
		</div>
    
    <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label">New Password:</label>
			<div class="input-icon">
				<i class="fa fa-key"></i>
				 <input type="password" class="form-control" name="new_password" id="reset_password" placeholder="New password">
			</div>
		</div>
    
    
    <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label">Confirm Password:</label>
			<div class="input-icon">
				<i class="fa fa-key"></i>
				  <input type="password" class="form-control" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm password">
			</div>
		</div>
        
        
        
    
    <div class="form-actions"><div class="login-btn"><input type="submit" name="submit_reset_password_btn" value="Submit" class="btn btn-block btn-success" /></div></div>
   
  </form>
	<!-- END REGISTRATION FORM -->

</div>
<!-- END LOGIN -->
</div>
</body>
<!-- END BODY -->
</html>