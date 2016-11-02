<script src="themefiles/assets/admin/pages/scripts/modernizr.custom.34982.js"></script>
<script src="themefiles/assets/admin/pages/scripts/application.js"></script>
<script src="themefiles/assets/admin/pages/scripts/signatureCapture.js"></script>
<script src="themefiles/assets/admin/pages/csscanvas2image.js"></script>
<link rel="stylesheet" href="themefiles/assets/admin/pages/css/styles.css" />
<script>
function validate()
{
	if($("#give_to_chk").attr('checked'))
	{
		$("#to_name").removeAttr('readonly');
	}else {
		$("#to_name").attr('readonly','readonly');
	}
	
}
</script>
<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Documents</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
				<i class="fa fa-angle-right "></i> 
				<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/patientList"> 
					Patient
				</a> 
				<i class="fa fa-angle-right "></i> 
				<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/patientFormList/patient_id/<?php echo $_REQUEST['patient_id']?>"> 
					Forms
				</a> 
				<i class="fa fa-angle-right "></i>
				<?php if(isset($hipaaData['form_id']) && $hipaaData['form_id']!=''){ ?>
						Update Hipaa Form
				<?php } else { ?>
						Add Hipaa Form
				<?php } ?>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row" id="ImmunizationDiv">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-filter"></i>
					<?php if(isset($hipaaData['form_id']) && $hipaaData['form_id']!=''){ ?>
						Update Hipaa Form
					<?php } else { ?>
						Update  Hipaa Form
					<?php } ?>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>doctor/saveHipaaForm" id="form_hipaa" class="form-horizontal" method="post">
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
									<label class="control-label col-md-4">Name<span
										class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" name="type" data-required="1" class="form-control" placeholder="Name" readonly="readonly" value="<?php if (isset ( $hipaaData ['name'] ) && ($hipaaData ['name']) != '') { echo $hipaaData ['name']; } ?>"/ >
										<span class="col-md-6" style="color: red"><?php echo $validationError['typeErr'] ?></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4">Birthdate<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control form-control-inline input date-picker" size="16" name="dob" data-required="1" readonly="readonly" placeholder="DOB" value="<?php if (isset ( $hipaaData ['dob'] ) && ($hipaaData ['dob']) != '') { echo date ( "m/d/Y", strtotime ( $hipaaData ['dob'] ) ); } ?>"/ >
										<span class="col-md-6" style="color: red"><?php echo $validationError['facilityErr'] ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 col-md-offset-2">
								<strong>Neurospine Institute</strong> is authorized to release
								protected health information about the above named patient in
								the following manner:
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4"> </label>
									<div class="col-md-8">
										Voicemail<span class="required"> * </span> 
										<input type="checkbox" name="voicemail" data-required="1" class="form-control" placeholder="Voicemail" <?php if (isset ( $hipaaData ['voice_mail'] ) && ($hipaaData ['voice_mail']) != '') { ?> checked="checked" <?php } ?> value="<?php if (isset ( $hipaaData ['voice_mail'] ) && ($hipaaData ['voice_mail']) != '') { echo 1; } ?>"/ >
										<span class="col-md-6" style="color: red"><?php echo $validationError['typeErr'] ?></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3"><span class="required"></span>
									</label>
									<div class="col-md-9">
										<div class="radio-list">
											<label class="radio-inline">
												<div class="" id="uniform-optionsRadios25">
													<span class="">
														<input type="radio" name="form_for[]" <?php if (isset ( $hipaaData ['form_for'] ) && ($hipaaData ['form_for']) == '0') { ?> checked="checked" <?php } ?> id="form_for_home" value="0">
													</span>
												</div> Home
											</label>
											<label class="radio-inline">
												<div class="" id="uniform-optionsRadios26">
													<span class="checked">
														<input type="radio" <?php if (isset ( $hipaaData ['form_for'] ) && ($hipaaData ['form_for']) == '1') { ?> checked="checked" <?php } ?> name="form_for[]" id="form_for_work" value="1">
													</span>
												</div> Work
											</label> 
											<label class="radio-inline">
												<div class="" id="uniform-optionsRadios27">
													<span>
														<input type="radio" name="form_for[]" <?php if (isset ( $hipaaData ['form_for'] ) && ($hipaaData ['form_for']) == '2') { ?> checked="checked" <?php } ?> id="form_for_phone" value="2">
													</span>
												</div> Cell Phone
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4"> </label>
									<div class="col-md-8">
										Give information to spouse<span class="required">*</span> 
										<input type="checkbox" <?php if (isset ( $hipaaData ['give_info_to_spouse'] ) && ($hipaaData ['give_info_to_spouse']) == 1) { ?> checked="checked" <?php } ?> name="give_info_to_spouse" id="give_info_to_spouse" data-required="1" class="form-control" placeholder="Voicemail" value="<?php if (isset ( $hipaaData ['give_info_to_spouse'] ) && ($hipaaData ['give_info_to_spouse']) != '') { echo 1; } ?>"/ >
										<span class="col-md-6" style="color: red"><?php echo $validationError['typeErr'] ?></span>
									</div>
								</div>
							</div>
							<div class="col-md-6"></div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-4"> </label>
									<div class="col-md-8">
										Give information to:
										<span class="required">
											<input type="checkbox" name="give_to_chk" onclick="validate();" id="give_to_chk" <?php if (isset ( $hipaaData ['give_info_to'] ) && ($hipaaData ['voice_mail']) != '') { ?> checked="checked" <?php } ?> value="<?php if (isset ( $hipaaData ['give_info_to'] ) && ($hipaaData ['give_info_to']) != '') { echo 1; } ?>" />
										</span>
										<input type="text" name="to_name" readonly="readonly" id="to_name" class="form-control" placeholder="Give Info To" value="<?php if (isset ( $hipaaData ['to_name'] ) && ($hipaaData ['to_name']) != '') { echo $hipaaData ['to_name']; } ?>"/ >
										<span class="col-md-6" style="color: red"><?php echo $validationError['typeErr'] ?></span>
									</div>
								</div>
							</div>
							<div class="col-md-6"></div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-2">
								<div class="form-group">
									<h2>SIGNATURE</h2>
									<!--
									<div id="canvasContainer" >
										<canvas id="signature" height="200px" />
									</div>
									-->
									<?php
										$imageURL = 'assets/upload/signatures/patient_sign_' . $hipaaData ['patient_id'] . '.png';
									?>
									<div style="float: left;" align="right">
										<img src="<?php echo $imageURL;?>" />
									</div>
									<!--  
									<div id="lowerControls">
								    	<div id="feedback"></div>
								        <div id="buttonsContainer">
								            <img id="submit" src="themefiles/assets/admin/pages/img/right.png" />
								            <img id="cancel" src="themefiles/assets/admin/pages/img/wrong.png" />
								        </div>
									</div>
									-->
									<div id="imgdisplay"></div>
								</div>
							</div>
							<div class="col-md-4"></div>
						</div>
						<div class="row">&nbsp;</div>
						<div class="row">&nbsp;</div>
						<div class="row">
							<div class="col-md-10 col-md-offset-2">
								<strong>Rights of the Patient :</strong> I understand that I
								have the right to revoke this authorization at any time and that
								I have the right to inspect or copy the protected health
								information to be disclosed as described in this document by
								sending a written notification to Neurospine Institute. I
								understand that a revocation is not effective in cases where the
								information has already been disclosed, but will be effective
								going forward. I understand that information used or disclosed
								as a result of this authorization may be subject to redisclosure
								by the recipient and may no longer be protected by federal or
								state law. I understand that I have the right to refuse to sign
								this authorization and that my treatment will not be conditioned
								on signing this authorization. This authorization shall be in
								force and effect until revoked by the patient or representative
								signing the authorization.
							</div>
						</div>
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-2 col-md-10">
							<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $_REQUEST['patient_id']; ?>" />
							<button type="submit" name="saveImmunization" class="btn green">Submit</button>
							<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/immunizationListing">Cancel</a>
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