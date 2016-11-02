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
		  Login.init();
		});
	</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
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
<div class="content2">
<a href="<?php echo Yii::app()->params->base_path ; ?>admin/">
	<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/c2zoom.jpg" height="90%" width="90%"/>
	</a>
    
    <div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
										C2Zoom privacy and cookies statement </a>
										</h4>
									</div>
									<div id="accordion1_1" class="panel-collapse collapse in">
										<div class="panel-body">
											 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>

</div>
<!-- END LOGIN -->
</div>
</body>
<!-- END BODY -->
</html>