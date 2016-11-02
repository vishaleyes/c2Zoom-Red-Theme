<script type="text/javascript">
$( document ).ready(function() {
    var unit_value = $( "#ldl_unit option:selected" ).val();
	
	$("#hdl_unit").val(unit_value);
	$("#triglycerides_unit").val(unit_value);
	$("#total_unit").val(unit_value);
});

function disableCholesterolUnit()
{
	var unit_value = $( "#ldl_unit option:selected" ).val();
	$("#hdl_unit").val(unit_value);
	$("#triglycerides_unit").val(unit_value);
	$("#total_unit").val(unit_value);
}
function validateForm()
{
	
	var Year = document.getElementById('Year').value;
	
	if(Year=='')
	{
		$('#yearErr').addClass('false');
		$('#yearErr').html("<i class='icon-close' style='margin-top:3px;'></i> &nbsp;&nbsp;<strong style='color:red;'>Please enter year.</strong>");
		return false;
	}
	else
	{
		$('#yearErr').removeClass();
		$('#yearErr').addClass('true');
		$('#yearErr').html('<i class="fa fa-check-circle" style="margin-top:3px; color:green;"></i> &nbsp;&nbsp;<strong style="color:green;">Ok.</strong>');
	}
	
	var surgeon = document.getElementById('surgeon').value;
	
	if(surgeon=='')
	{
		$('#surgeonErr').addClass('false');
		$('#surgeonErr').html("<i class='icon-close' style='margin-top:3px;'></i> &nbsp;&nbsp;<strong style='color:red;'>Please enter surgeon.</strong>");
		return false;
	}
	else
	{
		$('#surgeonErr').removeClass();
		$('#surgeonErr').addClass('true');
		$('#surgeonErr').html('<i class="fa fa-check-circle" style="margin-top:3px; color:green;"></i> &nbsp;&nbsp;<strong style="color:green;">Ok.</strong>');
	}	
	
}
</script>
<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Surgery History</h3>
		<ul class="page-breadcrumb breadcrumb">

			<li><a
				href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i> Health History <i
				class="fa fa-angle-right "></i> <a
				href="<?php echo Yii::app()->params->base_path ; ?>patient/surgoryHistoryListing">
					Surgery History</a> <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['patient_surgery_id']) && $_REQUEST['patient_surgery_id']!=''){ ?>
                              
							Update Surgery History
                              <?php } else { ?>
                             
							Add Surgery History
                            <?php } ?>
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
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gittip"></i>
                                <?php if(isset($surgoryData['patient_surgery_id']) && $surgoryData['patient_surgery_id']!=''){ ?>
                               Update Surgery History
                               <?php } else { ?>
                                Add Surgery History
                                <?php } ?>
							</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>

				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form
					action="<?php echo Yii::app()->params->base_path ; ?>patient/saveSurgoryHistory"
					id="form_surgory" class="form-horizontal" method="post">
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
									<label class="control-label col-md-4">Procedure <span
										class="required"> * </span></label>
									<div class="col-md-6">
										<input type="text" name="procedure" id="procedure"
											class="form-control" placeholder="Ex HeartProblem"
											value="<?php
											if (isset ( $surgoryData ['procedure'] ) && ($surgoryData ['procedure']) != '') {
												echo $surgoryData ['procedure'];
											}
											?>" /><span class="col-md-6" style="color: red"><?php echo $validationError['ldlErr'] ?></span>
									</div>



								</div>
								<div class="form-group">
									<label class="control-label col-md-4">Year <span
										class="required"> * </span>
									</label>
									<div class="col-md-4">
										<input type="text" name="Year" id="Year" data-required="1"
											class="form-control groupOfTexbox" placeholder="Ex 2015"
											value="<?php
											if (isset ( $surgoryData ['Year'] ) && ($surgoryData ['Year']) != '') {
												echo $surgoryData ['Year'];
											}
											?>" /><span class="col-md-12" id="yearErr" style="color: red"><?php echo $validationError['yearErr'] ?></span>
									</div>



								</div>



							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label col-md-3">Surgeon<span
										class="required">*</span>
									</label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input"
											data-required="1" placeholder="Name of doctor " id="surgeon"
											name="surgeon" type="text"
											value="<?php
											if (isset ( $surgoryData ['surgeon'] ) && ($surgoryData ['surgeon']) != '') {
												echo $surgoryData ['surgeon'];
											}
											?>"/ > <span id="surgeonErr" class="col-md-12" style="color: red"><?php echo $validationError['surgeonErr'] ?></span>

									</div>

								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Hospital <span
										class="required"> * </span></label>
									<div class="col-md-8">
										<input class="form-control form-control-inline input"
											placeholder="Hospital Name" id="hospital" name="hospital"
											type="text"
											value="<?php
											if (isset ( $surgoryData ['hospital'] ) && ($surgoryData ['hospital']) != '') {
												echo $surgoryData ['hospital'];
											}
											?>"/ > <span class="col-md-12" style="color: red"><?php echo $validationError['hospitalErr'] ?></span>

									</div>

								</div>
							</div>

						</div>

					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-2 col-md-10">

							<input type="hidden" name="patient_surgery_id"
								value="<?php echo $surgoryData['patient_surgery_id']; ?>" />

							<button type="submit" name="saveSurgoryHistory" class="btn green">Submit</button>
							<a class="btn red"
								href="<?php echo Yii::app()->params->base_path ; ?>patient/surgoryHistoryListing">Cancel</a>
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
