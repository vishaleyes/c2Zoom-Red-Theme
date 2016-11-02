<!DOCTYPE html>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>C2zoom</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/table-advanced.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-markdown/lib/markdown.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/form-validation.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-dropdowns.js"></script>
<!-- jquery-ui.css added by Hi-Tech on 24th August 2015 -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-ui/jquery-ui.css"/>
<!-- jquery-ui.js added by Hi-Tech on 24th August 2015 -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/jquery-ui.js"></script>
<script>
jQuery(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	var msgBox	=	$('#msgBox');
	setTimeout(function() { msgBox.fadeOut(); }, 3000 ); 

	$('.groupOfTexbox').keypress(function (event) {
            return isNumber(event, this)
	});

	$('.groupOfTexboxSpecial').keypress(function (event) {
            return isNumber(event, this)
	});	 

	jQuery(".date-picker").datepicker({
			dateFormat: "mm/dd/yy",
			yearRange: "1905:"+new Date().getFullYear(),
			maxDate:  ((new Date().getMonth()<10) ? "0" + (new Date().getMonth() + 1) : (new Date().getMonth() + 1)) + "/" + ((new Date().getDate()<10) ? "0" + new Date().getDate() : new Date().getDate()) + "/" + new Date().getFullYear(),
			changeMonth: true,
		    changeYear: true
		});

    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    Index.init(); 
    TableAdvanced.init();
    FormValidation.init();
    ComponentsPickers.init();
    ComponentsDropdowns.init();
});

// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
   function isNumber(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (
           // (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57) && charCode != 8)
            return false;

        return true;
    }
	
	function isNumberKey(evt)
	{
		if(evt.keyCode == 9)
		{
		
		}
		else
		{
			var charCode = (evt.which) ? evt.which : event.keyCode 
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		}
		return true;
	}
	
	function isDecimalKey(evt,val)
	{
		if(evt.keyCode == 9)
		{
		
		}
		else
		{
			var charCode = (evt.which) ? evt.which : event.keyCode
			if(charCode == 46) 
			{
				var finalvalue = val+".";	
				var checkNumber = isNaN(finalvalue) ;
				if(checkNumber == true)
				{
					return false;
				}
			}
			if (charCode > 31 && charCode != 46 && (charCode < 48 || charCode > 57))
				return false;
		}
		return true;
	}
</script>
</head>
<?php if(isset(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='') { ?>
    <body class="page-header-fixed page-sidebar-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo" align="center" style="padding-left:0px !important;">
                    <a href="<?php echo Yii::app()->params->base_path ; ?>patient">
						<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/c2zoom150x46.png" alt="logo" class="logo-default"/>
                    </a>
					<div class="menu-toggler sidebar-toggler fa fa-bars">
						<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
					</div>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<div class="menu-toggler responsive-toggler fa fa-bars" data-toggle="collapse" data-target=".navbar-collapse">
				</div>
				<!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<?php 
									$PatientNotificationObj = new PatientNotification();	
									$PatientNotificationData = $PatientNotificationObj->getAllPatientNotifications(Yii::app()->session['pingmydoctor_patient']);
									$genralObj = new General();
								?>
								<i class="fa fa-bell"></i>
								<span class="badge badge-default">
									<?php echo count($PatientNotificationData); ?>
								</span>
							</a>
							<ul class="dropdown-menu">
								<li>
									<p>
										You have <?php echo count($PatientNotificationData); ?> new notifications
									</p>
								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 250px;">
										<?php 
											foreach($PatientNotificationData as $not) 
											{ 
										?>
                                        		<?php if($not['notification_type'] == 1) { ?>
												<li>
													<a href="<?php echo Yii::app()->params->base_path ; ?>patient/appointmentListFromHeader/appointment_id/<?php echo $not['appointment_id']; ?>">
														<span class="label label-sm label-icon label-success">
															<i class="fa fa-bell-o"></i>
														</span>
														<?php echo $not['message']; ?> 
														<span class="time">
															<?php echo $genralObj->ago($not['createdAt']); ?> 
														</span>
													</a>
												</li>
                                                <?php } ?>
                                                <?php if($not['notification_type'] == 2) { ?>
												<li>
													<a href="<?php echo Yii::app()->params->base_path ; ?>patient/getSubmittedAllFormsForUser/">
														<span class="label label-sm label-icon label-success">
															<i class="fa fa-bell-o"></i>
														</span>
														<?php echo $not['message']; ?> 
														<span class="time">
															<?php echo $genralObj->ago($not['createdAt']); ?> 
														</span>
													</a>
												</li>
                                                <?php } ?>
										<?php 
											} 
											
											
										?>
									</ul>
								</li>
								<li class="external">
									<a href="<?php echo Yii::app()->params->base_path ; ?>patient/appointmentListFromHeader">
									See all notifications <i class="m-icon-swapright"></i>
									</a>
								</li>
							</ul>
						</li>
                        <li class="dropdown dropdown-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<?php 
									if(isset(Yii::app()->session['patient_image']) && Yii::app()->session['patient_image'] != '')
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/patient/".Yii::app()->session['patient_image'];
									}
									else
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/patient/default.png";
									}
									if(!file_exists("assets/upload/avatar/patient/".Yii::app()->session['patient_image']))
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/patient/default.png"; 
									}
								?>
								<img alt="" class="img-circle" height="28px" width="28px" src="<?php echo $url."?".strtotime(date("Y-m-d H:i:s")); ?>"/>
								<span class="username">
									<?php echo Yii::app()->session['patient_fullName'] ; ?>
								</span>
								<i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientProfile">
                                    <i class="fa fa-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>patient/changePassword">
                                    <i class="fa fa-gears"></i> Change Password </a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>patient/accountSetting">
                                    <i class="fa fa-gears"></i> Account Settings </a>
                                </li>
                                <li>
								   <?php 
										if(isset(Yii::app()->session['logoutUrl']) && Yii::app()->session['logoutUrl'] != "")
										{
											$logoutUrl = Yii::app()->session['logoutUrl'];	
										}else{
											$logoutUrl = Yii::app()->params->base_path."patient/patientLogout";
										}
									?>
                                    <a href="<?php echo $logoutUrl; ?>">
                                    <i class="fa fa-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix"></div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                         <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientprofile">
								<div class="title clearboth parenttitle">
									<div class="pull-left">
										<img alt="" class="img-circle" height="62" width="62" src="<?php echo $url.'?'.date("Y-m-d H:i:s");?>"/>
									</div>
									<div class="patientfullname">
										<?php echo Yii::app()->session['patient_fullName']; ?>
									</div>
									<div class="clearboth"></div>
								</div>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "home") { echo 'class="selected"'; } ?>></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "home") { ?> class="start active" <?php } ?> >
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<i class="fa fa-home"></i>
								<span class="title">Home</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "home") { ?> class="selected" <?php } ?>></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "profile") { ?> class="start active" <?php } ?> >
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientProfile">
								<i class="fa fa-user"></i>
								<span class="title">Profile</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "profile") { ?> class="selected"<?php } ?>></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "doctors") { ?> class="start active" <?php } ?> >
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/doctorListing">
								<i class="fa fa-user-md"></i>
								<span class="title">Doctors</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "doctors") { ?> class="selected" <?php } ?>></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "measurements") { ?> class="start active" <?php } ?> >
							<a href="javascript:;">
								<i class="fa fa-bar-chart-o "></i>
								<span class="title">Measurements</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "measurements") { ?> class="start active arrow" <?php } ?> class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "bloodGlucose") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>patient/bloodGlucoseListing">
										<i class="fa fa-leaf"></i>
										Blood Glucose
									</a>
								</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "bloodPressure") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/bloodPressureListing">
								<i class="fa fa-heartbeat"></i>
								Blood Pressure
							</a>
						</li>
                        
                        <li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "cholesterol") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/cholesterolListing">
								<i class="fa fa-gittip"></i>
								Cholesterol
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "height") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/heightListing">
								<i class="fa fa-arrows-v"></i>
								Height
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "weight") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/weightListing">
								<i class="fa fa-tachometer"></i>
								Weight
							</a>
						</li>
					</ul>
				</li>
				<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "healthHistory") { ?> class="start active" <?php } ?> >
					<a href="javascript:;">
                        <i class="fa fa-medkit"></i>
                        <span class="title">Health History</span>
                    	<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "healthHistory") { ?> class="start active arrow" <?php } else { ?> class="arrow" <?php } ?>></span>
                    </a>
                    <ul class="sub-menu">
                        <li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "allergy") { ?> class="active" <?php } ?>>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/allergyListing">
                                <i class="fa fa-dribbble"></i>
                                Allergy
							</a>
                        </li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "anaesthesia") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/anaesthesiaListing">
								<i class="fa fa-plus-square"></i>
								Anesthesia
							</a>
						</li>
						 <li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "familyhistory") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/addFamilyHistory">
								<i class="fa fa-plus-square"></i>
								Family History
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "immunization") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/immunizationListing">
								<i class="fa fa-filter"></i>
								Immunization
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "medication") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/medicationListing">
								<i class="fa fa-ticket"></i>
								Medication
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "medicalhistory") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/editMedicalHistoryListing">
								<i class="fa fa-plus-square"></i>
								Medical History
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "procedure") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/procedureListing">
								<i class="fa fa-gears"></i>
								Procedure
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "socialhistory") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/addSocialHistory">
								<i class="fa fa-plus-square"></i>
								Social History
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "surgoryhistory") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/surgoryHistoryListing">
								<i class="fa fa-plus-square"></i>
								Surgery History
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "symptoms") { ?> class="active" <?php } ?>>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/addSymptoms">
								<i class="fa fa-plus-square"></i>
								Symptoms
							</a>
						</li>
                    </ul>
                </li>
				<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "form") { ?> class="start active" <?php } ?> >
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/getAllFormsForUser">
						<i class="fa fa-files-o"></i>
						<span class="title">Documents</span>
						<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "form") { ?> class="selected" <?php } ?>></span>
					</a>
				</li>
				<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "submittedform") { ?> class="start active" <?php } ?> >
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/getSubmittedAllFormsForUser">
						<i class="fa fa-files-o"></i>
						<span class="title">Submitted Documents</span>
						<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "submittedform") { ?> class="selected" <?php } ?>></span>
					</a>
				</li>
				<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "appointments") { ?> class="start active" <?php } ?> >
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/appointmentList">
						<i class="fa fa-calendar"></i>
						<span class="title">Appointments</span>
						<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "appointments") { ?> class="selected" <?php } ?>></span>
					</a>
				</li>
				<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "imagemanager") { ?> class="start active" <?php } ?> >
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/imageListing">
						<i class="fa fa-file-image-o"></i>
						<span class="title">Image Manager</span>
						<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "imagemanager") { ?> class="selected" <?php } ?>></span>
					</a>
				</li>
				<!-- BEGIN FRONTEND THEME LINKS -->
                <!-- END FRONTEND THEME LINKS -->
			</ul>
            <!-- END SIDEBAR MENU -->
        </div>
	</div>
	<!-- END SIDEBAR -->
    <div class="page-content-wrapper">
		<div class="page-content">
 <?php } ?>   
		<div id="msgBox"> 
            <?php if(Yii::app()->user->hasFlash('success')): ?>	
				<div class="alert alert-success">
					<button class="close" data-close="alert"></button>
					<span><?php echo Yii::app()->user->getFlash('success'); ?> </span>
				</div>
				<div class="clear"></div>
            <?php endif; ?>
            <?php if(Yii::app()->user->hasFlash('error')): ?>
				<div class="alert alert-danger">
					<button class="close" data-close="alert"></button>
					<span><?php echo Yii::app()->user->getFlash('error'); ?> </span>
				</div>
            <?php endif; ?>
         </div>
<?php echo $content; ?>
<div class="clearfix"></div>
<?php if(isset(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient'] != "") { ?>
		</div>
    </div>
 	<!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
             <?php echo date("Y"); ?> &copy; C2zoom.
        </div>
        <div class="page-footer-tools">
            <span class="go-top">
				<i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->
 <?php }else{ ?>
 	<!-- BEGIN COPYRIGHT -->
    <div class="copyright">
        <?php echo date("Y"); ?> &copy; C2zoom.
    </div>
    <!-- END JAVASCRIPTS -->    
 <?php } ?>
</div>
</body>
</html>