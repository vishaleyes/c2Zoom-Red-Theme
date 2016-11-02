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
<a href="<?php echo Yii::app()->params->base_path ; ?>admin">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo.png" height="90%" width="90%"/>
	</a>
    
    <!-- BEGIN LOGIN FORM -->
	
	<!-- END LOGIN FORM -->
    
    <!-- BEGIN REGISTRATION FORM -->
	<form class="register-form" action="<?php echo Yii::app()->params->base_path;?>admin/patientforgotPassword" method="post" style="display:block;">
		<h3>Forgot Password</h3>
		
		
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Email *" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>"/>
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
			<button type="button" class="btn default" onClick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/index'">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" id="register-submit-btn" name="forgotPassword" class="btn green pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END REGISTRATION FORM -->

</div>
<!-- END LOGIN -->
</div>
</body>
<!-- END BODY -->
</html>