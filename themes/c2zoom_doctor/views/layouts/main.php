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
<link rel="icon" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo_dashboard_whole.png" type="image/x-icon"/>
<!--data-table style-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<!-- end data-table style-->
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
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<!--data-table script-->
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/table-advanced.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/form-validation.js"></script>
<!-- jquery-ui.css added by Hi-Tech on 24th August 2015 -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-ui/jquery-ui.css"/>
<!-- jquery-ui.js added by Hi-Tech on 24th August 2015 -->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/jquery-ui.js"></script>
<!--data-table script end-->
<script>
jQuery(document).ready(function() { 
	$('.groupOfTexbox').keypress(function (event) {
		return isNumber(event, this)
	});
	$('.groupOfTexboxSpecial').keypress(function (event) {
		return isNumber(event, this)
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
	ComponentsPickers.init();
	FormValidation.init();
});
</script>
</head>
<?php if(isset(Yii::app()->session['pingmydoctor_doctor']) && Yii::app()->session['pingmydoctor_doctor']!='') { ?>
    <body class="page-header-fixed page-sidebar-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo" align="center" style="padding-left:0px !important;">
                    <a href="<?php echo Yii::app()->params->base_path ; ?>doctor">
						<img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/c2zoom150x46.png" alt="logo" class="logo-default" />
                    </a>
					<div class="menu-toggler sidebar-toggler fa fa-bars">
						<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
					</div>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<div class="menu-toggler responsive-toggler fa fa-bars" data-toggle="collapse" data-target=".navbar-collapse"></div>
				<!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <?php
					$DoctorNotificationObj = new DoctorNotification();
					$notData = $DoctorNotificationObj->getAllNotificationForDoctor(Yii::app()->session['pingmydoctor_doctor']);
					$genralObj = new General();
				?>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<i class="fa fa-bell"></i>
								<span class="badge badge-default"><?php echo count($notData); ?></span>
							</a>
							<ul class="dropdown-menu">
								<li>
									<p>
										 You have <?php echo  count($notData); ?> new notifications
									</p>
								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 250px;">
										<?php 
											foreach($notData as $row) 
											{ 
										?>
												<li>
													<a href="<?php echo Yii::app()->params->base_path;?>doctor/patientFormList/patient_id/<?php echo $row['patient_id'];?>/doctor_notification_id/<?php echo $row['doctor_notification_id']; ?>">
														<span class="label label-sm label-icon label-info">
															<i class="fa fa-bullhorn"></i>
														</span>
														<b><?php echo $row['name'].' '.$row['surname'] ?></b> have submitted <?php echo $row['form']; ?> form for approval. <span class="time"><br/>
														<?php echo $genralObj->ago($row['created_at']); ?></span>
													</a>
												</li>
										<?php 
											} 
										?>
									</ul>
								</li>
								<li class="external">
									<a href="#">
										See all notifications <i class="m-icon-swapright"></i>
									</a>
								</li>
							</ul>
						</li>
						<li class="dropdown dropdown-user">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<?php 
									if(isset(Yii::app()->session['doctor_image']) && Yii::app()->session['doctor_image'] != '')
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/doctor/".Yii::app()->session['doctor_image'];
									}
									else
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/doctor/default.png";
									}
									if(!file_exists(FILE_UPLOAD."avatar/doctor/".Yii::app()->session['doctor_image']))
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/doctor/default.png"; 
									}
								?>
								<img alt="" class="img-circle" height="28px" width="28px" src="<?php echo $url.'?'.date("Y-m-d H:i:s") ; ?>"/>
								<span class="username"><?php echo Yii::app()->session['fullName'] ; ?> </span>
								<i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorProfile">
										<i class="fa fa-user"></i> My Profile 
									</a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/changePassword">
										<i class="fa fa-gears"></i> Change Password
									</a>
                                </li>
                                <li>
								   <?php 
										if(isset(Yii::app()->session['logoutUrl']) && Yii::app()->session['logoutUrl'] != "")
										{
											$logoutUrl = Yii::app()->session['logoutUrl'];	
										}else{
											$logoutUrl = Yii::app()->params->base_path."doctor/doctorLogout";
										}
									?>
                                    <a href="<?php echo $logoutUrl; ?>">
										<i class="fa fa-key"></i> Log Out 
									</a>
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
                            <?php 
								if(!isset(Yii::app()->session['selected_patient_id'])) 
								{ 
							?>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorprofile">
										<div class="title clearboth parenttitle" style="min-height:65px;">
											<img alt="" class="img-circle pull-left" height="62px" width="62px" src="<?php echo $url.'?'.date("Y-m-d H:i:s") ; ?>"/>
											<span class="patientfullname">
												<?php echo Yii::app()->session['fullName']; ?>
											</span>
											<div class="clearboth"></div>
										</div>
										<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "home") { ?> class="selected" <?php } ?>></span>
									</a>
							<?php 
								} 
								else 
								{ 
							?>
							<?php 
									$patientMasterObj = new PatientMaster();
									$selectedPatientData = $patientMasterObj->getUserById(Yii::app()->session['selected_patient_id']);
									if(isset($selectedPatientData['patient_image']) && $selectedPatientData['patient_image'] != '')
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/patient/".$selectedPatientData['patient_image'];
									}
									else
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/patient/default.png";
									}
									if(!file_exists(FILE_UPLOAD. "avatar/patient/".$selectedPatientData['patient_image']))
									{
										$url = Yii::app()->params->base_url."assets/upload/avatar/patient/default.png"; 
									}
							?>
									<a href="javascript:void(0);">
										<div class="title clearboth parenttitle">
											<div class="pull-left">
												<img alt="" class="img-circle" height="62" width="62" src="<?php echo $url.'?'.date("Y-m-d H:i:s") ; ?>"/>
											</div>
											<div class="patientfullname">
												<?php echo $selectedPatientData['name']. ' '.$selectedPatientData['surname']; ?>
											</div>
											<div class="clearboth"></div>
										</div>
										<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "home") { ?> class="selected" <?php } ?>></span>
										<div class="row">&nbsp;</div>
									</a>
							<?php 
								} 
							?>   
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "home") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">
								<i class="fa fa-home"></i>
								<span class="title">Home</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "home") { ?> class="selected" <?php } ?>></span>
                            </a>
                        </li>
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "patient") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/patientList">
								<i class="fa fa-user"></i>
								<span class="title">Patient</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "patient") { ?> class="selected" <?php } ?>></span>
                            </a>
                        </li>
						<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "measurements") { ?> class="start active" <?php } ?> >
							<a href="javascript:;">
								<i class="fa fa-bar-chart-o "></i>
								<span class="title">Measurements</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "measurements") { ?> class="start active arrow" <?php } ?> class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "bloodGlucose") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/bloodGlucoseListing">
										<i class="fa fa-leaf"></i>
										Blood Glucose
									</a>
								</li>
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "bloodPressure") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/bloodPressureListing">
										<i class="fa fa-heartbeat"></i>
										Blood Pressure
									</a>
								</li>
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "cholesterol") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/cholesterolListing">
										<i class="fa fa-gittip"></i>
										Cholesterol
									</a>
								</li>
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "height") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/heightListing">
										<i class="fa fa-arrows-v"></i>
										Height
									</a>
								</li>
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "weight") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/weightListing">
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
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "healthHistory") { ?> class="start active arrow" <?php } ?> class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "allergy") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/allergyListing">
										<i class="fa fa-dribbble"></i>
										Allergy
									</a>
								</li>
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "immunization") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/immunizationListing">
										<i class="fa fa-filter"></i>
										Immunization
									</a>
								</li>
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "medication") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/medicationListing">
										<i class="fa fa-ticket"></i>
										Medication
									</a>
								</li>
								<li <?php if(isset(Yii::app()->session['active_sub_tab']) && Yii::app()->session['active_sub_tab'] == "procedure") { ?> class="active" <?php } ?>>
									<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/procedureListing">
										<i class="fa fa-gears"></i>
										Procedure
									</a>
								</li>
							</ul>
						</li>
						<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "receivedform") { ?> class="start active" <?php } ?> >
							<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/getReceivedAllForms">
								<i class="fa fa-files-o"></i>
								<span class="title">Received Documents</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "receivedform") { ?> class="selected" <?php } ?>></span>
							</a>
						</li>
						<li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "appointment") { ?> class="start active" <?php } ?> >
							<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/appointmentList">
								<i class="fa fa-calendar"></i>
								<span class="title">Appointments</span>
								<span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "appointment") { ?> class="selected" <?php } ?>></span>
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
		<div> 
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
<?php if(isset(Yii::app()->session['pingmydoctor_doctor']) && Yii::app()->session['pingmydoctor_doctor'] != "") { ?>
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