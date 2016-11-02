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
		  
		  
		});
		
		function setUrl(url){
			$("#url").val(url);
			return true;
		}
	</script>
    
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
	<form class="login-form" method="post" action="<?php echo Yii::app()->params->base_path; ?>site/login">
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" value="<?php if(isset($_COOKIE['username']) && $_COOKIE['username'] != "0") { echo $_COOKIE['username']; } ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password']) && $_COOKIE['password'] != "0") { echo $_COOKIE['password']; }?>"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1" <?php if(isset($_COOKIE['username']) && $_COOKIE['username'] != "" && $_COOKIE['username'] != "0") { ?> checked="checked" <?php } ?>/> Remember me </label>
			<button type="submit" name="loginBtn" class="btn green pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="login-options">
			<h4>Or login with</h4>
			<ul class="social-icons">
				<li>
					<a style="background-position: 0 -38px !important;" class="facebook" data-original-title="facebook" href="<?php if(isset($loginUrl)) { echo $loginUrl; } else { "#"; } ?>">
					</a>
				</li>
				<li>
					<a style="background-position: 0 -38px !important;" class="twitter" data-original-title="Twitter" href="<?php if(isset($twitterUrl)) { echo $twitterUrl; } else { "#"; } ?>">
					</a>
				</li>
				<li>
					<a style="background-position: 0 -38px !important;" class="googleplus" data-original-title="Goole Plus" href="<?php if(isset($gplusLoginUrl)) { echo $gplusLoginUrl; } else { "#"; } ?>">
					</a>
				</li>
				
			</ul>
		</div>
		<div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
				 no worries, click <a href="<?php echo Yii::app()->params->base_path;?>site/forgotPassword" >
				here </a>
				to reset your password.
			</p>
		</div>
		<div class="create-account">
			<p>
				 Don't have an account yet ?&nbsp; <a href="<?php echo Yii::app()->params->base_path;?>site/register">
				Create an account </a>
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->

</div>
<!-- END LOGIN -->
</div>
</body>
<!-- END BODY -->
</html>