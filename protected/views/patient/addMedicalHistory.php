<script>
$(document).ready(function(){
if($('#other_disease').attr('checked')) {
    $("#other_diseases").prop("readonly", false);
} else {
    $("#other_diseases").prop("readonly", true);
}

if($('#lung_disease').attr('checked')) {
    $("#lung_diseases").prop("readonly", false);
} else {
    $("#lung_diseases").prop("readonly", true);
}

if($('#heart_problem').attr('checked')) { 
			$("#heart_problems").prop("readonly", false);
		} else {
			$("#heart_problems").prop("readonly", true);
		}
if($('#blood_clots').attr('checked')) { 
	$("#part_of_body").prop("readonly", false);
} else {
	$("#part_of_body").prop("readonly", true);
}
if($('#diabetes').attr('checked')) { 
			$("#diabetesSection").show('slow');
			$("#diabetesHeadSection").show('slow');
		} else {
			$("#diabetesSection").hide('slow');
			$("#diabetesHeadSection").hide('slow');
		}

  $('#other_disease').click(function() {
		if($('#other_disease').attr('checked')) { 
			$("#other_diseases").prop("readonly", false);
		} else {
			$("#other_diseases").prop("readonly", true);
		}

	});
	
	$('#lung_disease').click(function() {
		if($('#lung_disease').attr('checked')) { 
			$("#lung_diseases").prop("readonly", false);
		} else {
			$("#lung_diseases").prop("readonly", true);
		}

	});
	
	$('#heart_problem').click(function() {
		if($('#heart_problem').attr('checked')) { 
			$("#heart_problems").prop("readonly", false);
		} else {
			$("#heart_problems").prop("readonly", true);
		}

	});
	
	$('#blood_clots').click(function() {
		if($('#blood_clots').attr('checked')) { 
			$("#part_of_body").prop("readonly", false);
		} else {
			$("#part_of_body").prop("readonly", true);
		}

	});
	
	$('#diabetes').click(function() {
		if($('#diabetes').attr('checked')) { 
			$("#diabetesSection").show('slow');
			$("#diabetesHeadSection").show('slow');
		} else {
			$("#diabetesSection").hide('slow');
			$("#diabetesHeadSection").hide('slow');
		}

	});





});
 
</script>
<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Medication
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                         <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                              <?php if(isset($medicalData['medical_history_id']) && $medicalData['medical_history_id']!=''){ ?>
                              
							Update Medical History
                              <?php } else { ?>
                             
							Add Medical History
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="MedicalHistoryDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-ticket"></i>
                                <?php if(isset($medicalData['medical_history_id']) && $medicalData['medical_history_id']!=''){ ?>
                            Update Medical History
                               <?php } else { ?>
                              Add Medical History
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveMedicalHistory" id="form_medication" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-5">Height (In FT)<span class="required">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="text" name="height" readonly="readonly" data-required="1" id="height" class="form-control groupOfTexbox" placeholder="Height" value="<?php 
					if(isset($heightData['height_value']) && ($heightData['height_value'])!='') 
					{ echo $heightData['height_value'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['medication_nameErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                        
                                        	<div class="form-group">
                                                <label class="control-label col-md-5">Average Weight (In Pound)	<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" readonly="readonly" name="avg_height"  id="avg_height" data-required="1" class="form-control groupOfTexbox" placeholder="Average Weight" value="<?php 
					if(isset($weightData['weight_value']) && ($weightData['weight_value'])!='') 
					{ echo $weightData['weight_value'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['doseErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                    </div>
                                    
                                    <div class="row">
                                   
                                        <div class="col-md-11 col-md-offset-1">
                                        
                                        <div>&nbsp;&nbsp;If you are a woman of childbearing years, is there a possibility you may be pregnant?<input type="checkbox" id="is_pregnant" name="is_pregnant" <?php if(isset($medicalData['is_pregnant']) && $medicalData['is_pregnant'] != 0) {  ?> checked="checked" <?php } ?> value="1"></div>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                   
                                        <div class="col-md-11 col-md-offset-1">
                                        <br/>
                                        <div>&nbsp;&nbsp;Mark any medical condition you have been diagnosed with:</div>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                   
                                        <div class="col-md-3 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="aids" id="aids" <?php if(isset($medicalData['aids']) && $medicalData['aids'] != 0) {  ?> checked="checked" <?php } ?> value="1"> AIDS</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                         
                                        <div><input type="checkbox" name="hepatitis" <?php if(isset($medicalData['hepatitis']) && $medicalData['hepatitis'] == 1) { ?> checked="checked" <?php } ?>	 id="hepatitis" value="1"> Hepatitis</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                        
                                        <div><input type="checkbox" name="other_disease" id="other_disease" value="1" <?php if(isset($medicalData['other_disease']) && $medicalData['other_disease'] != '') { ?> checked="checked" <?php } ?>> Any Other Blood Disease</div>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="row">&nbsp;</div>
                                    <div class="row">
                                   		<div class=" col-md-2 col-md-offset-1">
                                        <label class="control-label">Other Disease Name</label>
                                        </div>
                                        <div class="col-md-7"><input type="text" class="form-control" name="other_diseases" id="other_diseases" value="<?php if(isset($medicalData['other_disease'])){ echo $medicalData['other_disease']; } ?>" placeholder="Other Disease Name"></div>
                                        
                                        </div>
                                    <div class="row">&nbsp;</div>    
                                    <div class="row">
                                   
                                        <div class="col-md-10 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="blood_clots" id="blood_clots" <?php if(isset($medicalData['blood_clots']) && $medicalData['blood_clots'] != '') { ?> checked="checked" <?php } ?> value="1"> Blood clots </div>
                                        
                                        </div>
                                        
                                         
                                    </div>
                                    <div class="row"></div>    
                                    <div class="row">
                                   		<div class="col-md-2 col-md-offset-1">
                                        <label class="control-label">What part of body</label>
                                        </div>
                                        <div class="col-md-7"><input type="text" class="form-control" name="part_of_body" id="part_of_body" placeholder="What part of body" value="<?php if(isset($medicalData['blood_clots'])){ echo $medicalData['blood_clots']; } ?>"></div>
                                        
                                        </div>
                                    <div class="row">&nbsp;</div>     
                                    <div class="row">
                                   
                                        <div class="col-md-3 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="diabetes" <?php if(isset($medicalData['diabetes']) && $medicalData['diabetes'] == 1) { ?> checked="checked" <?php } ?> id="diabetes" value="1"> Diabetes</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="row"  id="diabetesHeadSection">
                                    	<div class="col-md-2 col-md-offset-1"><b>&nbsp;Controlled by</b></div>
                                    </div>
                                    
                                    <div class="row"  id="diabetesSection">
                                   
                                        <div class="col-md-3 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="diet" id="diet" <?php if(isset($medicalData['diet']) && $medicalData['diet'] == 1) { ?> checked="checked" <?php } ?> value="1"> Diet</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                        <input type="checkbox" name="pills" id="pills" <?php if(isset($medicalData['pills']) && $medicalData['pills'] == 1) { ?> checked="checked" <?php } ?> value="1"> Pills
                                        </div>
                                        
                                         <div class="col-md-4">
                                        <input type="checkbox" name="insulin" id="insulin" <?php if(isset($medicalData['insulin']) && $medicalData['insulin'] == 1) { ?> checked="checked" <?php } ?> value="1"> Insulin
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                   
                                        <div class="col-md-3 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="epilepsy" id="epilepsy" value="1" <?php if(isset($medicalData['epilepsy']) && $medicalData['epilepsy'] == 1) { ?> checked="checked" <?php } ?>> Epilepsy</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                        <input type="checkbox" name="heart_problem" id="heart_problem" value="1" <?php if(isset($medicalData['heart_problem']) && $medicalData['heart_problem'] != '') { ?> checked="checked" <?php } ?>> Heart Problems
                                        </div>
                                        
                                         <div class="col-md-4">
                                        
                                        </div>
                                    </div>
                                    <div class="row">&nbsp;</div>     
                                    <div class="row">
                                   		<div class="col-md-2 col-md-offset-1">
                                        <label class="control-label">Type of Heart Problem</label></div>
                                        <div class="col-md-8"><input type="text" name="heart_problems" id="heart_problems" class="form-control" value="<?php if(isset($medicalData['heart_problem'])) { echo $medicalData['heart_problem']; } ?>"> </div>
                                        
                                        </div>
                                    <div class="row">&nbsp;</div> 
                                    <div class="row">
                                   
                                        <div class="col-md-3 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="high_blood_pressure" id="high_blood_pressure" class="form-control" value="1" <?php if(isset($medicalData['high_blood_pressure']) && $medicalData['high_blood_pressure'] == 1) { ?> checked="checked" <?php } ?>> High Blood Pressure</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                        <input type="checkbox" name="low_thyroid" id="low_thyroid" value="1" <?php if(isset($medicalData['low_thyroid']) && $medicalData['low_thyroid'] == 1) { ?> checked="checked" <?php } ?>> Low Thyroid
                                        </div>
                                        
                                         <div class="col-md-4">
                                        <input type="checkbox" name="bowel" id="bowel" value="1" <?php if(isset($medicalData['bowel']) && $medicalData['bowel'] == 1) { ?> checked="checked" <?php } ?>> Irritable Bowel Syndrome
                                        </div>
                                    </div>
                                    <div class="row">
                                   
                                        <div class="col-md-3 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="ulcers" id="ulcers" class="form-control" value="1" <?php if(isset($medicalData['ulcers']) && $medicalData['ulcers'] == 1) { ?> checked="checked" <?php } ?>> Ulcers</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                        <input type="checkbox" name="prolapse" id="prolapse" value="1" <?php if(isset($medicalData['prolapse']) && $medicalData['prolapse'] == 1) { ?> checked="checked" <?php } ?>> Mitral Valve Prolapse
                                        </div>
                                        
                                         <div class="col-md-4">
                                        <input type="checkbox" name="lung_disease" id="lung_disease" value="1" <?php if(isset($medicalData['lung_disease']) && $medicalData['lung_disease'] != '') { ?> checked="checked" <?php } ?>> Lung Disease
                                        </div>
                                    </div> 
                                    <div class="row">&nbsp;</div>    
                                    <div class="row">
                                   		<div class="col-md-2 col-md-offset-1">
                                        <label class="control-label">Lung disease type </label>
                                        </div>
                                        <div class="col-md-8"><input type="text" name="lung_diseases" id="lung_diseases" class="form-control" value="<?php if(isset($medicalData['lung_disease'])) { echo $medicalData['lung_disease']; } ?>"> </div>
                                        
                                        </div> 
                                    <div class="row">&nbsp;</div>        
                                    <div class="row">
                                   
                                        <div class="col-md-2 col-md-offset-1">
                                        
                                        <div><input type="checkbox" name="polio" id="polio" class="form-control" value="1" <?php if(isset($medicalData['polio']) && $medicalData['polio'] == 1) { ?>checked="checked" <?php } ?>> Polio</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-3">
                                        <input type="checkbox" name="arthritis" id="arthritis" value="1" <?php if(isset($medicalData['arthritis']) && $medicalData['arthritis'] == 1) { ?> checked="checked" <?php } ?>> Rheumatoid Arthritis
                                        </div>
                                        
                                         <div class="col-md-2">
                                        <input type="checkbox" name="tuberculosis" id="tuberculosis" value="1" <?php if(isset($medicalData['tuberculosis']) && $medicalData['tuberculosis'] == 1) { ?> checked="checked" <?php } ?>> Tuberculosis
                                        </div>
                                        
                                        
                                      <div class="col-md-3">
                                        <input type="checkbox" name="psychiatric_chk" id="psychiatric_chk" value="1" <?php if(isset($medicalData['psychiatric'])  && $medicalData['psychiatric'] != '') { ?> checked="checked" <?php } ?>> Psychiatric Disorder
                                        </div>  
                                    </div>   
                                    <div class="row">&nbsp;</div>
                                    <div class="row">
                                   		<div class="col-md-2 col-md-offset-1">
                                        <label class="control-label">Type</label>
                                        </div>
                                        <div class="col-md-8"><input type="text" name="psychiatrics" id="psychiatrics" class="form-control" value="<?php if(isset($medicalData['psychiatric'])) { echo $medicalData['psychiatric']; } ?>"> </div>
                                        
                                        </div>
                                    <div class="row">&nbsp;</div>
                                    <div class="row">
                                   		<label class="col-md-10 col-md-offset-1">Please list any other known medical conditions or symptoms not listed above</label>
                                        <div class="col-md-10 col-md-offset-1"><input type="text" name="other_unknown" id="other_unknown" placeholder="Please list any other known medical conditions or symptoms not listed above" class="form-control" value="<?php if(isset($medicalData['psychiatric'])) { echo $medicalData['other_unknown']; } ?>"> </div>
                                        
                                        </div>
                                    <div class="row">&nbsp;</div>    
                                    <div class="row">
                                    <label class="col-md-10 col-md-offset-1">Please list any injuries including car accident, fall, lifting, etc:</label>
                                   		<div class="col-md-10 col-md-offset-1"><input type="text" name="injuries" id="injuries" placeholder="Please list any injuries including car accident, fall, lifting, etc:" class="form-control" value="<?php if(isset($medicalData['injuries'])) { echo $medicalData['psychiatric']; } ?>"> </div>
                                        
                                        </div>  
                                      <div class="row">&nbsp;</div>       
                                        <div class="row">
                                        <label class="col-md-10 col-md-offset-1">Please list any hospitalizations (other than surgeries):</label>
                                   		<div class="col-md-10 col-md-offset-1"><input type="text" name="hospitalization" id="hospitalization" placeholder="Please list any hospitalizations (other than surgeries):" class="form-control" value="<?php if(isset($medicalData['psychiatric'])) { echo $medicalData['hospitalization']; } ?>"> </div>
                                        
                                        </div>      
									
								</div>
                                <div class="row">&nbsp;</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="medical_history_id" value="<?php if(isset($medicalData['medical_history_id'])) { echo $medicalData['medical_history_id']; } ?>"  />
                                    
									<button type="submit" name="saveMedicalHistory" class="btn green">Submit</button>
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
	