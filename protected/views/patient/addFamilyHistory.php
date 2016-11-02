<script>
$(document).ready(function() {	
	var relative_had_history =   $('#relative_had_history').prop('checked');
	$('#relative_had_history').on('switchChange.bootstrapSwitch', function () 
	{
		if($('#relative_had_history').bootstrapSwitch('state') == true)
		{
			$('#relative_name_div').show();	
			$('#disease_row1_div').show();
			$('#disease_row2_div').show();
			$('#disease_row3_div').show();
		}
		else
		{
			$('#relative_name_div').hide();
			$('#disease_row1_div').hide();
			$('#disease_row2_div').hide();
			$('#disease_row3_div').hide();							
		}
	});	
});
</script>
<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Family History</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i> Health History 
				<i class="fa fa-angle-right "></i> Family History
				<i class="fa fa-angle-right "></i>
				<?php if(isset($familyData['patient_family_history_id']) && $familyData['patient_family_history_id']!=''): ?>
					Update Family History 
				<?php else:?>
					Add Family History 
				<?php endif; ?>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row" id="SurgoryHistoryDiv">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gittip"></i>
					<?php if(isset($familyData['patient_family_history_id']) && $familyData['patient_family_history_id']!=''): ?>
						Update Family History 
					<?php else:?>
						Add Family History 
					<?php endif; ?>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveFamilyHistory" id="form_surgory" class="form-horizontal" method="post">
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
							<div class="form-group">							
								<label class="control-label col-lg-3 col-sm-7 col-md-6 col-xs-7 marg-lft10px"  for="relativehadhistory">Have any of your relatives ever had any of the following?&nbsp;</label>
								<div class="col-lg-3 col-sm-4 col-md-6 col-xs-4">	
									<input class="make-switch" name="relative_had_history" id="relative_had_history" type="checkbox" data-off-text="No" data-on-text="Yes" data-size="normal" <?php if(isset($familyData['relative_had_history']) && $familyData['relative_had_history'] == '1') { ?> checked="checked" <?php  } ?>  value="1" />
								</div>	
							</div>							
						</div>						
						<div class="row" id="relative_name_div" <?php if(isset($familyData['relative_had_history']) && $familyData['relative_had_history'] == '0'){ ?> style="display: none;" <?php } ?>>							
							<div class="form-group">
								<label class="control-label col-lg-3 col-sm-7 col-md-6 col-xs-7 marg-lft10px"  for="exampleInputName1">Relationship&nbsp;<span class="required">* </span></label>
								<div class="col-lg-1 col-sm-4 col-md-2 col-xs-4">	
									<select class="form-control" id="surgeon" name="surgeon" >
										<option value="">Select</option>
										<option value="0" <?php echo (isset($familyData['relative_name']) && ($familyData['relative_name'])==0) ?  "selected = 'selected'" : ""; ?> >Mother</option>
										<option value="1" <?php echo (isset($familyData['relative_name']) && ($familyData['relative_name'])==1) ?  "selected = 'selected'" : ""; ?> >Father</option>
										<option value="2" <?php echo (isset($familyData['relative_name']) && ($familyData['relative_name'])==2) ?  "selected = 'selected'" : ""; ?> >Sister</option>
										<option value="3" <?php echo (isset($familyData['relative_name']) && ($familyData['relative_name'])==3) ?  "selected = 'selected'" : ""; ?> >Brother</option>
                                     </select>
								</div>	
							</div>
						</div>
						<div class="row" id="disease_row1_div" <?php if(isset($familyData['relative_had_history']) && $familyData['relative_had_history'] == '0'){ ?> style="display: none;" <?php } ?>>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="hypertension" id="hypertension" class="form-control" <?php if(isset($familyData['hypertension']) && ($familyData['hypertension'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Hypertension
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="tuberculosis" id="tuberculosis" class="form-control" <?php if(isset($familyData['tuberculosis']) && ($familyData['tuberculosis'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Tuberculosis
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="diabetes" id="diabetes" class="form-control" <?php if(isset($familyData['diabetes']) && ($familyData['diabetes'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Diabetes
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="kidney_disease" id="kidney_disease" class="form-control" <?php if(isset($familyData['kidney_disease']) && ($familyData['kidney_disease'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Kidney Disease
							</div>
						</div>
						<div class="row" id="disease_row2_div" <?php if(isset($familyData['relative_had_history']) && $familyData['relative_had_history'] == '0'){ ?> style="display: none;" <?php } ?>>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="heart_disease" id="heart_disease" class="form-control" <?php if(isset($familyData['heart_disease']) && ($familyData['heart_disease'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Heart Disease
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="arthritis" id="arthritis" class="form-control" <?php if(isset($familyData['arthritis']) && ($familyData['arthritis'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Arthritis
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="epilepsy" id="epilepsy" class="form-control" <?php if(isset($familyData['epilepsy']) && ($familyData['epilepsy'])== '1'){ ?> checked="checked" <?php } ?> value="1" />
								Epilepsy
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="convulsions" id="convulsions" class="form-control" <?php if(isset($familyData['convulsions']) && ($familyData['convulsions'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Convulsions
							</div>
						</div>
						<div class="row" id="disease_row3_div" <?php if(isset($familyData['relative_had_history']) && $familyData['relative_had_history'] == '0'){ ?> style="display: none;" <?php } ?>>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="cancer" id="cancer" class="form-control" <?php if(isset($familyData['cancer']) && ($familyData['cancer'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Cancer
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="psychological" id="psychological" class="form-control" <?php if(isset($familyData['psychological']) && ($familyData['psychological'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Psychological
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-9">
								<input type="checkbox" name="drug" id="drug" class="form-control" <?php if(isset($familyData['drug']) && ($familyData['drug'])=='1'){ ?> checked="checked" <?php } ?> value="1" />
								Drug or Alcohol Problems
							</div>
						</div>
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-2 col-md-10">
							<input type="hidden" name="patient_family_history_id" value="<?php echo $familyData['patient_family_history_id']; ?>" />
							<button type="submit" name="saveFamilyHistory" class="btn green">Submit</button>
							<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Cancel</a>
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