<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" />
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-form-tools.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/admin/pages/scripts/profile_validation.js"></script>
<script>
$(document).ready(function() { 

	//ComponentsFormTools.init();
	//jQuery(".collapse").trigger('click');
	// expand and collapse header item code added on 1st September 2015.
	
	jQuery(".portlet-title").click(function(e){
		e.preventDefault();
        var el = jQuery(this).closest(".portlet").children(".portlet-body");
        if (jQuery(this).parent().parent().find(".tools a").hasClass("collapse1")) {
            jQuery(this).parent().parent().find(".tools a").removeClass("collapse1").addClass("expand1");
            el.slideUp(200);
        } else {
            jQuery(this).parent().parent().find(".tools a").removeClass("expand1").addClass("collapse1");
            el.slideDown(200);
        }
	});
	/*jQuery(".arrow").click(function(e){		
		e.preventDefault();
		$(this).parent().parent().find('.collapselink').trigger('click');
	});*/
	//display tab open.
	<?php if (isset($_GET['tab']) && !empty($_GET['tab'])): ?>
		if (typeof(jQuery("#<?php echo $_GET['tab'];?>")) != "undefined")
		{
			jQuery("#<?php echo $_GET['tab'];?> .portlet .portlet-title .tools a.arrow").removeClass("expand1").addClass("collapse1");
			jQuery("#<?php echo $_GET['tab'];?> .portlet .portlet-body").show().slideDown(200);
		}
	<?php endif;?>
	$("input.make-switch").bootstrapSwitch({
		onText: 'Yes',
		offText: 'No'
	});
	
	$('#patient_security_no').keypress(function (e) {
		var regex = new RegExp("^[a-zA-Z0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		
		if (regex.test(str) || e.charCode == 0) {
			return true;
		}
		if(str.length < 7 )
		{
			return true;
		}
		
		e.preventDefault();
		return false;
	});
	
	$('#zipcode').keypress(function (e) {
		var regex = new RegExp("^[a-zA-Z0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str) || e.charCode == 0) {
			return true;
		}
	
		e.preventDefault();
		return false;
	});
	
	});

function checkStatus(val)
{
	
	if(val == 5)
	{
		$("#employement_other").removeClass('hide');
	}
	else
	{
		$("#employement_other").addClass('hide');
	}
}


function getStates(id){
	 $.ajax({
			  type: 'POST',
			  url: '<?php echo Yii::app()->params->base_path;?>patient/getStates',
			  data:  'country_id='+id,
			  async:true,
			  beforeSend: function(){
			  },
			  success: function(result)
			  {
				  $("#state").html(result);
			  },
			  error: function (request, status, error) {
				 console.log(request);
			  }
		});
}

function removeImage(url)
{
	$("#imgDiv").html('<img src="'+url+'" class="img-circle" width="150" height="150">');
	$("#patient_image").val('');
}

/*function removeImage()
{
	alert("hi");
	var src = 'http://localhost/pingmydoctor/assets/upload/avatar/patient/patient_4.png';
	$("#patient_img").attr("src",src);	
}*/
</script>

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Profile</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i> Profile</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
<div class="row" id="patientProfile">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink">
						<i class="fa fa-user"></i><?php echo Yii::app()->session['patient_fullName'] ; ?>'s Profile </a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"></a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientProfile" name="form_primary_insured" id="form_primary_insured" class="form-horizontal" method="post" enctype="multipart/form-data">
					<input type="hidden" name="tab" value="patientProfile">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="">
							<div class="form-group">
								<label class="control-label col-md-2">Image</label>
								<div class="col-md-10">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-preview marg-btm20px" data-trigger="fileinput" id="imgDiv">
												<?php
													if ((isset ( $patientData ['patient_image'] )) && ($patientData ['patient_image'] != ''))
													{
														$url = Yii::app ()->params->base_url . "assets/upload/avatar/patient/" . $patientData ['patient_image'];
													}
													else
													{
														$url = Yii::app ()->params->base_url . "assets/upload/avatar/patient/patient_" . Yii::app ()->session ['pingmydoctor_patient'] . ".png";
													}
													if (! file_exists ( "assets/upload/avatar/patient/patient_" . Yii::app ()->session ['pingmydoctor_patient'] . ".png" ))
													{
														$url = Yii::app ()->params->base_url . "assets/upload/avatar/patient/default.png";
													}
												?>
												<img src="<?php echo $url.'?'.date("Y-m-d H:i:s");?>" id="patient_img" class="img-circle" width="150" height="150" />
										</div>
										<div class="text-center">
											<span class="btn default btn-file"> 
											<span class="fileinput-new"> Select image</span> 
											<span class="fileinput-exists"> Change </span> 
											<input type="file" id="patient_image" name="patient_image" value="<?php echo $url.'?'.date("Y-m-d H:i:s"); ?>">
											</span>
											<!-- data-dismiss="fileinput" -->
											<a class="btn red fileinput-exists" href="#" onclick="removeImage('<?php echo $url.'?'.date("Y-m-d H:i:s"); ?>');"> Remove </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">First name * </label>
									<div class="col-md-8">
										<input type="text" name="name" data-required="1"
											class="form-control"
											value="<?php
											if (isset ( $patientData ['name'] ) && ($patientData ['name']) != '') {
												echo $patientData ['name'];
											}
											?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Middle name </label>
									<div class="col-md-8">
										<input type="text" name="middle_name" id="middle_name"
											class="form-control"
											value="<?php
											if (isset ( $patientData ['middle_name'] ) && ($patientData ['middle_name']) != '') {
												echo $patientData ['middle_name'];
											}
											?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Last name * </label>
									<div class="col-md-8">
										<input type="text" name="surname" data-required="1"
											class="form-control"
											value="<?php
											if (isset ( $patientData ['surname'] ) && ($patientData ['surname']) != '') {
												echo $patientData ['surname'];
											}
											?>" />
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-4">Gender * </label>
									<div class="col-md-8">
										<select class="form-control" id="gender" name="gender">
											<option value="">- Select -</option>
											<option
												<?php  if(isset($patientData['gender']) && ($patientData['gender'])==0) { ?>
												selected="selected" <?php }  ?> value="0">Female</option>
											<option
												<?php  if(isset($patientData['gender']) && ($patientData['gender'])==1) { ?>
												selected="selected" <?php }  ?> value="1">Male</option>
											<option
												<?php  if(isset($patientData['gender']) && ($patientData['gender'])==2) { ?>
												selected="selected" <?php }  ?> value="2">Not Specified</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Marital status </label>
									<div class="col-md-8">
										<select class="form-control" id="marital_status"
											name="marital_status">
											<option value="">- Select -</option>
											<option
												<?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==0) { ?>
												selected="selected" <?php }  ?> value="0">Married</option>
											<option
												<?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==1) { ?>
												selected="selected" <?php }  ?> value="1">Widowed</option>
											<option
												<?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==2) { ?>
												selected="selected" <?php }  ?> value="2">Seperated</option>
											<option
												<?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==3) { ?>
												selected="selected" <?php }  ?> value="3">Divorced</option>
											<option
												<?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==4) { ?>
												selected="selected" <?php }  ?> value="4">Single</option>
											<option
												<?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==5) { ?>
												selected="selected" <?php }  ?> value="5">Not Specified</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Address line 1</label>
									<div class="col-md-8">
										<textarea class="form-control" name="address"><?php
										if (isset ( $patientData ['address'] ) && ($patientData ['address']) != '') {
											echo $patientData ['address'];
										}
										?>
</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Address line 2</label>
									<div class="col-md-8">
										<textarea class="form-control" name="appt_no" id="appt_no"><?php if(isset($patientInfoData['appt_no']) && ($patientInfoData['appt_no'])!='') { echo $patientInfoData['appt_no'] ;} ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Country / Region</label>
									<div class="col-md-8">
										<select name="country" onchange="getStates(this.value);" class="form-control" id="country">
											<?php
												$countyObj = new Country ();
												$countryData = $countyObj->getAllCountry ();
												foreach ( $countryData as $row )
												{
											?>
													<option value="<?php echo $row['id'] ?>" <?php if(isset($patientData['country_id']) && $patientData['country_id'] == $row['id']) { ?> selected="selected" <?php } ?>><?php echo $row['name'] ?></option>
											<?php 
												} 
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">State / Province</label>
									<div class="col-md-8">
										<select name="state" id="state" class="form-control">
											<option value="">- Select state -</option>
											<?php
												$stateObj = new State ();
												$stateData = $stateObj->getStatesByCountyId ( $patientInfoData ['country_id'] );
												$str = '';
												foreach ( $stateData as $row )
												{
											?>
													<option <?php if($row['state_id'] == $patientInfoData['state']) { ?> selected="selected" <?php } ?> value="<?php echo $row['state_id'];?>"><?php echo $row['state'];?></option>
											<?php 
												} 
											?>
                    					</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">City</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="city" id="city" value="<?php if(isset($patientInfoData['city']) && ($patientInfoData['city'])!='') { echo $patientInfoData['city'] ;} ?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Birthdate * </label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input date-picker" data-required="1" size="16" readonly="readonly" data-date-start-date="-110y" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" autocomplete="off" id="dob" name="dob" type="text" value="<?php if (isset ( $patientData ['dob'] ) && ($patientData ['dob']) != '') { echo date ( "m/d/Y", strtotime ( $patientData ['dob'] ) ); } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Email * </label>
									<div class="col-md-8">
										<input type="text" name="email" data-required="1"
											class="form-control"
											value="<?php
											if (isset ( $patientData ['email'] ) && ($patientData ['email']) != '') {
												echo $patientData ['email'];
											}
											?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Phone number </label>
									<div class="col-md-8">
										<input type="text" name="phone_number" data-required="1" class="form-control" 
											value="<?php
											if (isset ( $patientData ['phone_number'] ) && ($patientData ['phone_number']) != '') {
												echo $patientData ['phone_number'];
											}
											?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Blood group </label>
									<div class="col-md-8">
										<select class="form-control" id="blood_group"
											name="blood_group">
											<option value="">- Select -</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==0) { ?>
												selected="selected" <?php }  ?> value="0">Not Specified</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==1) { ?>
												selected="selected" <?php }  ?> value="1">A+</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==2) { ?>
												selected="selected" <?php }  ?> value="2">A-</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==3) { ?>
												selected="selected" <?php }  ?> value="3">B+</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==4) { ?>
												selected="selected" <?php }  ?> value="4">B-</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==5) { ?>
												selected="selected" <?php }  ?> value="5">O+</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==6) { ?>
												selected="selected" <?php }  ?> value="6">O-</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==7) { ?>
												selected="selected" <?php }  ?> value="7">AB+</option>
											<option
												<?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==8) { ?>
												selected="selected" <?php }  ?> value="8">AB-</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="bootstrap-switch-container">
										<label class="control-label bootstrap-switch-label col-md-4">Organ
											donor</label>
										<div class="col-md-8">
											<span
												class="bootstrap-switch-handle-on bootstrap-switch-primary">
											</span> <span
												class="bootstrap-switch-handle-off bootstrap-switch-info"> </span>
											<input type="checkbox" data-on-text="Yes" data-off-text="No"
												class="make-switch"
												<?php  if(isset($patientData['organ_donor']) && ($patientData['organ_donor'])==1) { ?>
												checked="checked" <?php } ?> data-on-color="primary"
												data-off-color="info" name="organ_donor">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Social security number</label>
									<div class="col-md-8">
										<input type="text" class="form-control"
											name="patient_security_no" id="patient_security_no"
											value="<?php if(isset($patientInfoData['patient_security_no']) && ($patientInfoData['patient_security_no'])!='') { echo $patientInfoData['patient_security_no'] ;} ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Home phone</label>
									<div class="col-md-8">
										<input type="text" class="form-control groupOfTexbox"
											name="home_phone" id="home_phone"
											value="<?php if(isset($patientInfoData['home_phone']) && ($patientInfoData['home_phone'])!='') { echo $patientInfoData['home_phone'] ;} ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Mobile phone</label>
									<div class="col-md-8">
										<input type="text" class="form-control groupOfTexbox"
											name="mobile_phone" id="mobile_phone"
											value="<?php if(isset($patientInfoData['mobile_phone']) && ($patientInfoData['mobile_phone'])!='') { echo $patientInfoData['mobile_phone'] ;} ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Alternate address</label>
									<div class="col-md-8">


										<textarea class="form-control" name="alternate_address"
											id="alternate_address"><?php
											if (isset ( $patientInfoData ['alternate_address'] ) && ($patientInfoData ['alternate_address']) != '') {
												echo $patientInfoData ['alternate_address'];
											}
											?>
</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Zip / Postal code</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="zipcode"
											id="zipcode"
											value="<?php if(isset($patientInfoData['zipcode']) && ($patientInfoData['zipcode'])!='') { echo $patientInfoData['zipcode'] ;} ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-11 col-md-offset-1">
						<label>Would you like to receive a monthly email newsletter?<span>&nbsp;</span></label>
						<span>&nbsp;</span> <input type="checkbox" name="get_newsletter"
							id="get_newsletter" style="padding-left: 20px;"
							<?php if(isset($patientInfoData['get_newsletter']) && ($patientInfoData['get_newsletter'])=='1') { ?>
							checked="checked" <?php } ?> value="1" />
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id"
								value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="savePatientProfile" class="btn green">Submit</button>
							<a
								href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->

<!-- BEGIN EMPLOYER INFO CONTENT-->
<div class="row" id="employerInfo">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink"><i
						class="fa fa-user"></i>Employment Information</a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"> </a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form
					action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientEmploymentData"
					id="form_patient_profile" class="form-horizontal" method="post"
					enctype="multipart/form-data">
					<input type="hidden" name="tab" value="employerInfo">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Employment status </label>
									<div class="col-md-8">
										<select class="form-control"
											onchange="checkStatus(this.value);" id="employment_status"
											name="employment_status">
											<option
												<?php if(isset($patientInfoData['employment_status']) && $patientInfoData['employment_status'] == '1') { ?>
												selected <?php } ?> value="1">Full Time</option>
											<option
												<?php if(isset($patientInfoData['employment_status']) && $patientInfoData['employment_status'] == '2') { ?>
												selected <?php } ?> value="2">Part Time</option>
											<option
												<?php if(isset($patientInfoData['employment_status']) && $patientInfoData['employment_status'] == '3') { ?>
												selected <?php } ?> value="3">Retired</option>
											<option
												<?php if(isset($patientInfoData['employment_status']) && $patientInfoData['employment_status'] == '4') { ?>
												selected <?php } ?> value="4">Disabled</option>
											<option
												<?php if(isset($patientInfoData['employment_status']) && $patientInfoData['employment_status'] == '5') { ?>
												selected <?php } ?> value="5">Other</option>
										</select>
									</div>
								</div>
                <?php if(isset($patientInfoData['employment_status']) && $patientInfoData['employment_status'] == '5') {  ?>
                <div class="form-group" id="employement_other">
									<label class="control-label col-md-4">Employment Other </label>
									<div class="col-md-8">
										<input type="text" name="employment_other"
											id="employment_other" data-required="1" class="form-control"
											value="<?php
																	if (isset ( $patientInfoData ['employment_other'] ) && ($patientInfoData ['employment_other']) != '') {
																		echo $patientInfoData ['employment_other'];
																	}
																	?>" />
									</div>
								</div>
                
                <?php }else { ?>
                <div class="form-group hide" id="employement_other">
									<label class="control-label col-md-4">Employment Other </label>
									<div class="col-md-8">
										<input type="text" name="employment_other"
											id="employment_other" data-required="1" class="form-control"
											value="<?php
																	if (isset ( $patientInfoData ['employment_other'] ) && ($patientInfoData ['employment_other']) != '') {
																		echo $patientInfoData ['employment_other'];
																	}
																	?>" />
									</div>
								</div>
                <?php } ?>
                <div class="form-group">
									<label class="control-label col-md-4">Employer </label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input "
											id="employer" name="employer" type="text"
											value="<?php
											if (isset ( $patientInfoData ['employer'] ) && ($patientInfoData ['employer']) != '') {
												echo $patientInfoData ['employer'];
											}
											?>"/ >
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Employer address </label>
									<div class="col-md-8">
										<textarea name="employer_address" class="form-control"
											id="employer_address"><?php
											if (isset ( $patientInfoData ['employer_address'] ) && ($patientInfoData ['employer_address']) != '') {
												echo $patientInfoData ['employer_address'];
											}
											?>
</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Occupation </label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input "
											id="occupation" name="occupation" type="text"
											value="<?php
											if (isset ( $patientInfoData ['occupation'] ) && ($patientInfoData ['occupation']) != '') {
												echo $patientInfoData ['occupation'];
											}
											?>"/ >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id"
								value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="savePatientEmploymentProfile"
								class="btn green">Submit</button>
							<a
								href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END EMPLOYER INFO CONTENT-->

<!-- BEGIN Primary Insured INFO CONTENT-->
<div class="row" id="primaryInsuredInfo">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink"><i
						class="fa fa-user"></i>Primary Insured Person On Your Insurance
						(Guarantor): </a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"> </a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form
					action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientPrimaryInsuredInfo"
					id="form_patient_profile" class="form-horizontal" method="post"
					enctype="multipart/form-data">
					<input type="hidden" name="tab" value="primaryInsuredInfo">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Last name </label>
									<div class="col-md-8">
										<input type="text" name="insured_lastname"
											id="insured_lastname" class="form-control"
											value="<?php
											if (isset ( $patientInfoData ['insured_lastname'] ) && ($patientInfoData ['insured_lastname']) != '') {
												echo $patientInfoData ['insured_lastname'];
											}
											?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">First name </label>
									<div class="col-md-8">
										<input type="text" name="insured_firstname"
											id="insured_firstname" class="form-control"
											value="<?php
											if (isset ( $patientInfoData ['insured_firstname'] ) && ($patientInfoData ['insured_firstname']) != '') {
												echo $patientInfoData ['insured_firstname'];
											}
											?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Middle name </label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input " id="mi"
											name="mi" type="text"
											value="<?php
											if (isset ( $patientInfoData ['mi'] ) && ($patientInfoData ['mi']) != '') {
												echo $patientInfoData ['mi'];
											}
											?>"/ >
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Birthdate </label>
									<div class="col-md-8">
										<input
											class="form-control form-control-inline input date-picker"
											data-date-format="mm/dd/yyyy" readonly="readonly"
											data-date-end-date="+0d" data-date-start-date="-110y"
											id="insured_birthdate" name="insured_birthdate" type="text"
											value="<?php
											if (isset ( $patientInfoData ['insured_birthdate'] ) && ($patientInfoData ['insured_birthdate']) != '') {
												echo date ( "m/d/Y", strtotime ( $patientInfoData ['insured_birthdate'] ) );
											}
											?>"/ >
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Social Security </label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input "
											id="insured_socialno" name="insured_socialno" type="text"
											value="<?php
											if (isset ( $patientInfoData ['insured_socialno'] ) && ($patientInfoData ['insured_socialno']) != '') {
												echo $patientInfoData ['insured_socialno'];
											}
											?>"/ >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id"
								value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="savePatientPrimaryInsuredInfo"
								class="btn green">Submit</button>
							<a
								href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END Primary Insured INFO CONTENT-->

<!-- BEGIN Emergency Information CONTENT-->
<div class="row" id="emergencyInfo">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink"><i
						class="fa fa-user"></i>Emergency Information: (Not living in the
						same household)</a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"> </a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form
					action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientEmergencyInfo"
					id="form_patient_profile" class="form-horizontal" method="post"
					enctype="multipart/form-data">
					<input type="hidden" name="tab" value="emergencyInfo">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Please Notify (Name): </label>
									<div class="col-md-8">
										<input type="text" name="emergency_name" id="emergency_name"
											class="form-control"
											value="<?php
											if (isset ( $patientInfoData ['emergency_name'] ) && ($patientInfoData ['emergency_name']) != '') {
												echo $patientInfoData ['emergency_name'];
											}
											?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Please Notify (Phone): </label>
									<div class="col-md-8">
										<input type="text" name="emergency_phone" id="emergency_phone"
											class="form-control groupOfTexbox"
											value="<?php
											if (isset ( $patientInfoData ['emergency_phone'] ) && ($patientInfoData ['emergency_phone']) != '') {
												echo $patientInfoData ['emergency_phone'];
											}
											?>" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Please Notify (Address):</label>
									<div class="col-md-8">
										<textarea class="form-control form-control-inline input"
											id="emergency_address" name="emergency_address"><?php
											if (isset ( $patientInfoData ['emergency_address'] ) && ($patientInfoData ['emergency_address']) != '') {
												echo $patientInfoData ['emergency_address'];
											}
											?></textarea>

									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Please Notify (Relationship to patient): </label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input "
											id="relationship_to_patient" name="relationship_to_patient"
											type="text"
											value="<?php
											if (isset ( $patientInfoData ['relationship_to_patient'] ) && ($patientInfoData ['relationship_to_patient']) != '') {
												echo $patientInfoData ['relationship_to_patient'];
											}
											?>"/ >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id"
								value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="savePatientEmergencyInfo"
								class="btn green">Submit</button>
							<a
								href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END Emergency Information CONTENT-->

<!-- BEGIN Insurance Information CONTENT-->
<div class="row" id="insuranceInfo">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink"><i
						class="fa fa-user"></i>Insurance Information</a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"> </a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form
					action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientInsuranceInfo"
					id="form_patient_profile" class="form-horizontal" method="post"
					enctype="multipart/form-data">
					<input type="hidden" name="tab" value="insuranceInfo">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group col-md-6">
									<label class="control-label col-md-8">Is your visit today related to an auto accident? </label>
									<div class="col-md-4 padding7px">
										<input type="checkbox" name="is_auto_accident"
											id="is_auto_accident" class="form-control"
											<?php
											if (isset ( $patientInfoData ['is_auto_accident'] ) && ($patientInfoData ['is_auto_accident']) == '1') {
												?>
											checked="checked" <?php	} ?> value="1" />
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label col-md-8">Is your visit today related to a work injury? </label>
									<div class="col-md-4 padding7px">
										<input type="checkbox" name="is_work_injury"
											id="is_work_injury" class="form-control"
											<?php
											if (isset ( $patientInfoData ['is_work_injury'] ) && ($patientInfoData ['is_work_injury']) == '1') {
												?>
											checked="checked" <?php	} ?> value="1" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id"
								value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="savePatientInsuranceInfo"
								class="btn green">Submit</button>
							<a
								href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END Insurance Information CONTENT-->

<!-- BEGIN  Health Insurance Information CONTENT-->
<div class="row" id="healthInsuranceInfo">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink">
						<i class="fa fa-user"></i>Insurance plan: (Please
						provide card at time of visit)
					</a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"> </a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientHealthInsurance" id="form_insurance_plan" class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="tab" value="healthInsuranceInfo">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="row">
							<div align="center">
								<h4 class="underline">Primary Insurance</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Plan name * </label>
									<div class="col-md-8">
										<input type="text" data-required="1" name="pri_insurance_company" id="pri_insurance_company" class="form-control" value="<?php if (isset ( $patientInfoData ['pri_insurance_company'] ) && ($patientInfoData ['pri_insurance_company']) != '') { echo $patientInfoData ['pri_insurance_company']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Coverage type </label>
									<div class="col-md-8">										
										<select class="bs-select form-control selectpicker" name="pri_coverage_type" id="pri_coverage_type" data-live-search="true">
												<option value="">- Select Coverage type -</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Group # </label>
									<div class="col-md-8">
										<input type="text" name="pri_insurance_grp" id="pri_insurance_grp" class="form-control" value="<?php if (isset ( $patientInfoData ['pri_insurance_grp'] ) && ($patientInfoData ['pri_insurance_grp']) != '') { echo $patientInfoData ['pri_insurance_grp']; } ?>" />
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-md-4">Plan code </label>
									<div class="col-md-8">
										<input type="text" name="pri_insurance_plan_code" id="pri_insurance_plan_code" class="form-control" value="<?php if (isset ( $patientInfoData ['pri_insurance_plan_code'] ) && ($patientInfoData ['pri_insurance_plan_code']) != '') { echo $patientInfoData ['pri_insurance_plan_code']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Subscriber ID </label>
									<div class="col-md-8">
										<input type="text" name="pri_insurance_id" id="pri_insurance_id" class="form-control" value="<?php if (isset ( $patientInfoData ['pri_insurance_id'] ) && ($patientInfoData ['pri_insurance_id']) != '') { echo $patientInfoData ['pri_insurance_id']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Person code </label>
									<div class="col-md-8">
										<input type="text" name="pri_person_code" id="pri_person_code" class="form-control" value="<?php if (isset ( $patientInfoData ['pri_person_code'] ) && ($patientInfoData ['pri_person_code']) != '') { echo $patientInfoData ['pri_person_code']; } ?>" />
									</div>
								</div>
							</div>
							<div class="col-md-6">																
								<div class="form-group">
									<label class="control-label col-md-4">Address </label>
									<div class="col-md-8">
										<textarea name="pri_insurance_address" id="pri_insurance_address" rows="5" class="form-control"><?php if (isset ( $patientInfoData ['pri_insurance_address'] ) && ($patientInfoData ['pri_insurance_address']) != '') { echo $patientInfoData ['pri_insurance_address']; } ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Phone </label>
									<div class="col-md-8">
										<input type="text" name="pri_insurance_phonenumber" id="pri_insurance_phonenumber" class="form-control groupOfTexbox" value="<?php if (isset ( $patientInfoData ['pri_insurance_phonenumber'] ) && ($patientInfoData ['pri_insurance_phonenumber']) != '') { echo $patientInfoData ['pri_insurance_phonenumber']; } ?>" />
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-4">Primary care provider </label>
									<div class="col-md-8">
										<?php
											$DoctorMasterObj = new DoctorMaster ();
											$doctorList = $DoctorMasterObj->getAllDoctorList ();
										?>
											<select class="bs-select form-control selectpicker" name="pcp" id="pcp" data-live-search="true">
												<option value="">- Select PCP -</option>
												<?php 
													foreach($doctorList as $key=>$row) 
													{ 
												?>
														<option <?php if($patientData['doctor_id'] == $row['doctor_id']){ ?> selected="selected" <?php } ?> value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'].' '.$row['surname'].' ('.$row['qualification'].')'; ?></option>
												<?php 
													} 
												?>
											</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Alternate care provider:</label>
									<div class="col-md-8">
										<select class="bs-select form-control" name="acp[]" id="acp" multiple data-live-search="true" data-selected-text-format="count>3">
											<?php
												$DoctorMasterObj = new DoctorMaster ();
												$doctorList = $DoctorMasterObj->getAllDoctorList ();
												
												$DoctorPatientRelationObj = new DoctorPatientRelation ();
												$docPatData = $DoctorPatientRelationObj->getACPdetails_by_patientidArray( Yii::app ()->session ['pingmydoctor_patient'] );
												$doct_array = array ();
												foreach ( $docPatData as $row )
												{
													$doct_array [] = $row ['doctor_id'];
												}
											?>
											<option value="">- Select ACP -</option>
											<?php 
												foreach($doctorList as $row) 
												{
													//skip loading of PCP data in ACP drop-dwon
													if ($patientData['doctor_id'] == $row['doctor_id'])
													{
														continue;
													}
											?>
													<option <?php if(in_array($row['doctor_id'],$doct_array)) {  ?>selected="selected" <?php } ?> value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'].' '.$row['surname'].' ('.$row['qualification'].')'; ?></option>
											<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
						</div>						
						<div class="row">
							<div align="center">
								<h4 class="underline">Secondary Insurance</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Secondary plan name: </label>
									<div class="col-md-8">
										<input type="text" name="sec_insurance_company" id="sec_insurance_company" class="form-control" value="<?php if (isset ( $patientInfoData ['sec_insurance_company'] ) && ($patientInfoData ['sec_insurance_company']) != '') { echo $patientInfoData ['sec_insurance_company']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Coverage type </label>
									<div class="col-md-8">										
										<select class="bs-select form-control selectpicker" name="sec_coverage_type" id="sec_coverage_type" data-live-search="true">
												<option value="">- Select Coverage type -</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Group </label>
									<div class="col-md-8">
										<input type="text" name="sec_insurance_grp" id="sec_insurance_grp" class="form-control" value="<?php if (isset ( $patientInfoData ['sec_insurance_grp'] ) && ($patientInfoData ['sec_insurance_grp']) != '') { echo $patientInfoData ['sec_insurance_grp']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Plan code </label>
									<div class="col-md-8">
										<input type="text" name="sec_insurance_plan_code" id="sec_insurance_plan_code" class="form-control" value="<?php if (isset ( $patientInfoData ['sec_insurance_plan_code'] ) && ($patientInfoData ['sec_insurance_plan_code']) != '') { echo $patientInfoData ['sec_insurance_plan_code']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Subscriber ID </label>
									<div class="col-md-8">
										<input type="text" name="sec_insurance_id" id="sec_insurance_id" class="form-control" value="<?php if (isset ( $patientInfoData ['sec_insurance_id'] ) && ($patientInfoData ['sec_insurance_id']) != '') { echo $patientInfoData ['sec_insurance_id']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Person code </label>
									<div class="col-md-8">
										<input type="text" name="sec_person_code" id="sec_person_code" class="form-control" value="<?php if (isset ( $patientInfoData ['sec_person_code'] ) && ($patientInfoData ['sec_person_code']) != '') { echo $patientInfoData ['sec_person_code']; } ?>" />
									</div>
								</div>														
							</div>
							<div class="col-md-6">
								
								<div class="form-group">
									<label class="control-label col-md-4">Address </label>
									<div class="col-md-8">
										<textarea name="sec_insurance_address" id="sec_insurance_address" rows="5" class="form-control"><?php if (isset ( $patientInfoData ['sec_insurance_address'] ) && ($patientInfoData ['sec_insurance_address']) != '') { echo $patientInfoData ['sec_insurance_address']; } ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Phone </label>
									<div class="col-md-8">
										<input type="text" name="sec_insurance_phonenumber" id="sec_insurance_phonenumber" class="form-control groupOfTexbox" value="<?php if (isset ( $patientInfoData ['sec_insurance_phonenumber'] ) && ($patientInfoData ['sec_insurance_phonenumber']) != '') { echo $patientInfoData ['sec_insurance_phonenumber']; } ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id" value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="savePatientHealthInsurance" class="btn green">Submit</button>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END Health Insurance Information CONTENT-->
<!-- BEGIN  Worker's Compensation Information CONTENT-->
<div class="row" id="workerCompensationInfo">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink">
						<i class="fa fa-user"></i>Worker's Compensation Information</a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"> </a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientCompensationInfo" id="form_patient_profile" class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="tab" value="workerCompensationInfo">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Insurance </label>
									<div class="col-md-8">
										<input type="text" name="comp_insurance" id="comp_insurance" class="form-control" value="<?php if (isset ( $patientInfoData ['comp_insurance'] ) && ($patientInfoData ['comp_insurance']) != '') { echo $patientInfoData ['comp_insurance']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Claim </label>
									<div class="col-md-8">
										<input type="text" name="comp_claim" id="comp_claim" class="form-control" value="<?php if (isset ( $patientInfoData ['comp_claim'] ) && ($patientInfoData ['comp_claim']) != '') { echo $patientInfoData ['comp_claim']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Claims Address </label>
									<div class="col-md-8">
										<textarea name="comp_address" id="comp_address" class="form-control"><?php if (isset ( $patientInfoData ['comp_address'] ) && ($patientInfoData ['comp_address']) != '') { echo $patientInfoData ['comp_address']; } ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Date of Injury </label>
									<div class="col-md-8">
										<input type="text" class="form-control form-control-inline input date-picker" id="comp_injury_date" data-date-format="mm/dd/yyyy" data-date-start-date="-110y" readonly="readonly" data-date-end-date="+0d" name="comp_injury_date" value="<?php if (isset ( $patientInfoData ['comp_injury_date'] ) && ($patientInfoData ['comp_injury_date']) != '') { echo date ( "m/d/Y", strtotime ( $patientInfoData ['comp_injury_date'] ) ); } ?>" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Adjuster Name </label>
									<div class="col-md-8">
										<input type="text" name="adjuster_name" id="adjuster_name" class="form-control" value="<?php if (isset ( $patientInfoData ['adjuster_name'] ) && ($patientInfoData ['adjuster_name']) != '') { echo $patientInfoData ['adjuster_name']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Adjuster Phone </label>
									<div class="col-md-8">
										<input type="text" name="adjuster_phone" id="adjuster_phone" class="form-control groupOfTexbox" value="<?php if (isset ( $patientInfoData ['adjuster_phone'] ) && ($patientInfoData ['adjuster_phone']) != '') { echo $patientInfoData ['adjuster_phone']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Attorney Name </label>
									<div class="col-md-8">
										<input type="text" name="attorney_name" id="attorney_name" class="form-control" value="<?php if (isset ( $patientInfoData ['attorney_name'] ) && ($patientInfoData ['attorney_name']) != '') { echo $patientInfoData ['attorney_name']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Attorney Phone </label>
									<div class="col-md-8">
										<input type="text" name="attorney_phone" id="attorney_phone" class="form-control groupOfTexbox" value="<?php if (isset ( $patientInfoData ['attorney_phone'] ) && ($patientInfoData ['attorney_phone']) != '') { echo $patientInfoData ['attorney_phone']; } ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id" value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="savePatientCompensationInfo" class="btn green">Submit</button>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END Health Insurance Information CONTENT-->
<!-- BEGIN  Auto Carrier Information CONTENT-->
<div class="row" id="autoCarrierInfo">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<a href="javascript:void(0);" class="collapselink">
						<i class="fa fa-user"></i>Auto Carrier Information
					</a>
				</div>
				<div class="tools">
					<a href="javascript:;" class="arrow"> </a>
				</div>
			</div>
			<div class="portlet-body form display-hide">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientAutoCarrierInfo" id="form_patient_profile" class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="tab" value="autoCarrierInfo">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Insurance </label>
									<div class="col-md-8">
										<input type="text" name="info_insurance" id="info_insurance" class="form-control" value="<?php if (isset ( $patientInfoData ['info_insurance'] ) && ($patientInfoData ['info_insurance']) != '') { echo $patientInfoData ['info_insurance']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Claim </label>
									<div class="col-md-8">
										<input type="text" name="info_claim" id="info_claim" class="form-control" value="<?php if (isset ( $patientInfoData ['info_claim'] ) && ($patientInfoData ['info_claim']) != '') { echo $patientInfoData ['info_claim']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Claims Address </label>
									<div class="col-md-8">
										<textarea name="claim_address" id="claim_address" class="form-control"><?php if (isset ( $patientInfoData ['claim_address'] ) && ($patientInfoData ['claim_address']) != '') { echo $patientInfoData ['claim_address']; } ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Date of Injury </label>
									<div class="col-md-8">
										<input type="text" name="info_date_injury" id="info_date_injury" class="form-control form-control-inline input date-picker" data-date-start-date="-110y" readonly="readonly" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" value="<?php if (isset ( $patientInfoData ['info_date_injury'] ) && ($patientInfoData ['info_date_injury']) != '') { echo date ( "m/d/Y", strtotime ( $patientInfoData ['info_date_injury'] ) ); } ?>" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Adjuster Name </label>
									<div class="col-md-8">
										<input type="text" name="info_adjuster_name" id="info_adjuster_name" class="form-control" value="<?php if (isset ( $patientInfoData ['info_adjuster_name'] ) && ($patientInfoData ['info_adjuster_name']) != '') { echo $patientInfoData ['info_adjuster_name']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Adjuster Phone </label>
									<div class="col-md-8">
										<input type="text" name="info_adjuster_phone" id="info_adjuster_phone" class="form-control groupOfTexbox" value="<?php if (isset ( $patientInfoData ['info_adjuster_phone'] ) && ($patientInfoData ['info_adjuster_phone']) != '') { echo $patientInfoData ['info_adjuster_phone']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Attorney Name </label>
									<div class="col-md-8">
										<input type="text" name="info_attorney_name" id="info_attorney_name" class="form-control" value="<?php if (isset ( $patientInfoData ['info_attorney_name'] ) && ($patientInfoData ['info_attorney_name']) != '') { echo $patientInfoData ['info_attorney_name']; } ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Attorney Phone </label>
									<div class="col-md-8">
										<input type="text" name="info_attorney_phone" id="info_attorney_phone" class="form-control groupOfTexbox" value="<?php if (isset ( $patientInfoData ['info_attorney_phone'] ) && ($patientInfoData ['info_attorney_phone']) != '') { echo $patientInfoData ['info_attorney_phone']; } ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>&nbsp;</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" name="patient_id" value="<?php echo $patientData['patient_id']; ?>" />
							<button type="submit" name="savePatientAutoCarrierInfo" class="btn green">Submit</button>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">
								<button type="button" class="btn default">Cancel</button>
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END Auto Carrier Information CONTENT-->
<script>
jQuery(document).ready(function() {
//jQuery('.selectpicker').selectpicker().change(function(){toggleSelectAll($(this));}).trigger('change');
<?php if (isset($patientData['doctor_id']) ): ?>
	jQuery('.selectpicker').selectpicker('val', <?php echo "'". (trim($patientData['doctor_id']))."'";?>);
<?php endif;?>
});
/*
function toggleSelectAll(control)
{
    var allOptionIsSelected = (control.val() || []).indexOf("-1") > -1;
    function valuesOf(elements) {
        return $.map(elements, function(element) {
            return element.value;
        });
    }

    if (control.data('allOptionIsSelected') != allOptionIsSelected) {
        // User clicked 'All' option
        if (allOptionIsSelected) {
            // Can't use .selectpicker('selectAll') because multiple "change" events will be triggered
            control.selectpicker('val', valuesOf(control.find('option')));
        } else {
            control.selectpicker('val', []);
        }
    } else {
        // User clicked other option
        if (allOptionIsSelected && control.val().length != control.find('option').length) {
            // All options were selected, user deselected one option
            // => unselect 'All' option
            control.selectpicker('val', valuesOf(control.find('option:selected[value!=-1]')));
            allOptionIsSelected = false;
        } else if (control.val()!= null && !allOptionIsSelected && control.val().length == control.find('option').length - 1) {
            // Not all options were selected, user selected all options except 'All' option
            // => select 'All' option too
            control.selectpicker('val', valuesOf(control.find('option')));
            allOptionIsSelected = true;
        }
    }
    control.data('allOptionIsSelected', allOptionIsSelected);
}
*/
</script>