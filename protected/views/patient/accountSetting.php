<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-form-tools.js"></script>


<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<script>


jQuery(document).ready(function() { 

	//ComponentsFormTools.init();
	jQuery(".collapse").trigger('click');
	
	
	});

function closeaccount()
{
		bootbox.confirm("Are you sure want to close your account?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/closeaccount/";
		}else{
			return true;
		}
	});
}

function removeImage(url)
{
	$("#imgDiv").html("<img src="+url+">");
}

</script>


			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Account Setting
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
                            <i class="fa fa-angle-right "></i>
                            
							Account Setting
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="cholesterolDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet-body form">
							<div class="row profile-account">
									<div class="col-md-3">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
											<li class="active">
												<a data-toggle="tab" href="#tab_1-1">
												<i class="fa fa-cog"></i> Basic info </a>
												<span class="after">
												</span>
											</li>
											<li class="">
												<a data-toggle="tab" href="#tab_3-3">
												<i class="fa fa-lock"></i> Change Password </a>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_4-4">
												<i class="fa fa-eye"></i> Close your account </a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
											<div id="tab_1-1" class="tab-pane active">
												<div><h2>Basic Info</h2></div>
												<div><?php echo Yii::app()->session['patient_fullName']; ?></div>
                                                <div><?php echo Yii::app()->session['patient_email']; ?></div>
                                                <br/>
                                                <div><a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientProfile">Change name or other info</a></div>
											</div>
											<div id="tab_3-3" class="tab-pane">
												<div><h2>Change Password</h2></div>
												<br/>
                                                <div><a href="<?php echo Yii::app()->params->base_path ; ?>patient/changePassword">Change Pasword</a></div>
											</div>
											<div id="tab_4-4" class="tab-pane">
												
						
												<div><h1>Close your account</h1></div>
                                                <div><h2>You are about to close your C2Zoom account.</h2></div>
                                                <div>
Closing your account will delete all your account information and the records as shown below.
                                                </div>
                                                <br/>
                                                <div>
                                                Before your account is closed, you'll have a chance to see which records will be deleted and confirm that you want to close the account.<br/>
                                                </div>
                                                
                                                <div><h2>Records that will be deleted</h2></div>
                                                <div>
                                               <?php  $url = Yii::app()->params->base_url."assets/upload/avatar/patient/".Yii::app()->session['patient_image']; 
											   if(!file_exists("assets/upload/avatar/patient/".Yii::app()->session['patient_image']))
													{
														$url = Yii::app()->params->base_url."assets/upload/avatar/patient/default.png"; 
													}
											   ?>
                                                <img src="<?php echo $url; ?>" width="62" height="62"/></div>
                                                
                                                <div>&nbsp;</div>
												<div class="alert alert-warning">
                                                Warning:  If you close your account, the account and all the information in it will be permanently deleted.
                                                </div>
                                                
                                                <div><button onclick="closeaccount();" class="btn blue">Close Account</button> &nbsp;
                                                <button class="btn white" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>patient/patientHome'">Cancel</button></div>

											</div>
										</div>
									</div>
									<!--end col-md-9-->
								</div>
						</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->

	            
            
	