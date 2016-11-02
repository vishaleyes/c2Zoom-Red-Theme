
<!--components-form-tools-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>

<!--components-form-tools-->

<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-form-tools.js"></script>
<script>
jQuery(document).ready(function() {    
   
	ComponentsFormTools.init();
});
</script>


			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Patients 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-user"></i>
						<a href="#">Patient Details</a>
							
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row ">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption" >
								<i class="fa fa-user"></i> Profile of <?php echo $patientData['name'] ?>
							</div>
							
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/savePatientProfile" id="form_patient_profile" class="form-horizontal" method="post">
                            
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
										<label class="control-label col-md-2">Image</label>
										<div class="col-md-10">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                <?php $url = Yii::app()->params->base_url."assets/upload/avatar/patient/".$patientData['patient_image']; ?>
                                                <img src="<?php echo $url ?>" />
												</div>
												
											</div>
											
										</div>
									</div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Name 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" data-required="1" class="form-control" value="<?php 
					if(isset($patientData['name']) && ($patientData['name'])!='') 
					{ echo $patientData['name'] ;
					} 
					?>" disabled="disabled"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Email 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="email" data-required="1" class="form-control" value="<?php 
					if(isset($patientData['email']) && ($patientData['email'])!='') 
					{ echo $patientData['email'] ;
					} 
					?>" disabled="disabled"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">Birth Date
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" id="dob" name="dob" type="text" value="<?php 
					if(isset($patientData['dob']) && ($patientData['dob'])!='') 
					{ echo date("m/d/Y H:i:s",strtotime($patientData['dob'])) ;
					} 
					?>" disabled="disabled" / >
										
										</div>
											</div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Gender 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="gender" name="gender" disabled="disabled" >
                                                    <option value="">Select</option>
                                                    
                                                     <option  value="0" <?php if(isset($patientData['gender']) && ($patientData['gender'])==0) { ?> selected="selected" <?php } ?> >Female</option>
                                                    <option value="1" <?php if(isset($patientData['gender']) && ($patientData['gender'])==1) { ?> selected="selected" <?php } ?> >Male</option>
                                                    <option value="2" <?php if(isset($patientData['gender']) && ($patientData['gender'])==2) { ?> selected="selected" <?php } ?> >Not Specified</option>
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Marital Status 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="marital_status" name="marital_status" disabled="disabled" >
                                                    <option value="">Select</option>
                                                     <option  value="0" <?php if(isset($patientData['marital_status']) && ($patientData['marital_status'])==0) { ?> selected="selected" <?php } ?> >Married</option>
                                                    <option  value="1" <?php if(isset($patientData['marital_status']) && ($patientData['marital_status'])==1) { ?> selected="selected" <?php } ?> >Widowed</option>
                                                    <option  value="2" <?php if(isset($patientData['marital_status']) && ($patientData['marital_status'])==2) { ?> selected="selected" <?php } ?> >Seperated</option>
                                                    <option  value="3" <?php if(isset($patientData['marital_status']) && ($patientData['marital_status'])==3) { ?> selected="selected" <?php } ?> >Divorsed</option>
                                                    <option  value="4" <?php if(isset($patientData['marital_status']) && ($patientData['marital_status'])==4) { ?> selected="selected" <?php } ?> >Single</option>
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Address</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="address" disabled="disabled" ><?php 
					if(isset($patientData['address']) && ($patientData['address'])!='') 
					{ echo $patientData['address'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                        
                                        <div class="form-group">
                                                <label class="control-label col-md-4">Surname
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="surname" data-required="1" class="form-control" value="<?php 
					if(isset($patientData['surname']) && ($patientData['surname'])!='') 
					{ echo $patientData['surname'] ;
					} 
					?>" disabled="disabled" />
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Phone Number 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="phone_number" data-required="1" class="form-control" value="<?php 
					if(isset($patientData['phone_number']) && ($patientData['phone_number'])!='') 
					{ echo $patientData['phone_number'] ;
					} 
					?>" disabled="disabled" />
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Relationship 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="relation_id" name="relation_id" disabled="disabled" >
                                                    <option value="">Select</option>
                                                    <?php
													$RelationMaster = new RelationMaster();
													$relation_list = $RelationMaster->getRelationList();
													
													foreach($relation_list as $relation)
													{
													?>
                                                    <option <?php if(isset($patientData['relation_id']) && ($patientData['relation_id'])!='') { ?> selected="selected" <?php } ?>  value="<?php echo $relation['relation_id'] ?>">
													<?php echo $relation['relation_name'] ?>
                                                    </option>
                                                    <?php } ?>
                                                   
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Blood Group 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="blood_group" name="blood_group" disabled="disabled" >
                                                    <option value="">Select</option>
                                                     <option  value="0" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=0) { ?> selected="selected" <?php } ?>  >Not Specified</option>
                                                    <option  value="1" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=1) { ?> selected="selected" <?php } ?> >A+</option>
                                                    <option  value="2" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=2) { ?> selected="selected" <?php } ?> >A-</option>
                                                    <option  value="3" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=3) { ?> selected="selected" <?php } ?> >B+</option>
                                                    <option  value="4" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=4) { ?> selected="selected" <?php } ?> >B-</option>
                                                    <option  value="5" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=5) { ?> selected="selected" <?php } ?> >O+</option>
                                                    <option  value="6" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=6) { ?> selected="selected" <?php } ?> >O-</option>
                                                    <option  value="7" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=7) { ?> selected="selected" <?php } ?> >AB+</option>
                                                    <option  value="8" <?php if(isset($patientData['blood_group']) && ($patientData['blood_group'])!=8) { ?> selected="selected" <?php } ?> >AB-</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Organ Donor</label>
                                          <div class="col-md-8">
                                       
                                                <div class="bootstrap-switch-container">
                                                
                                                    <span class="bootstrap-switch-handle-on bootstrap-switch-primary"></span>
                                                    <span class="bootstrap-switch-handle-off bootstrap-switch-info">
                                                    </span>
                                                <input type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info" name="organ_donor" disabled="disabled" <?php if(isset($patientData['organ_donor']) && ($patientData['organ_donor'])==1) { ?> checked="checked" <?php } ?> >
                                                </div>
                                            </div>
                                            </div>
                                            
                                        </div>
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>
            
            <div class="row" id="cholesterolDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gittip"></i>
                               Cholesterol Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveCholesterol" id="form_cholesterol" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">LDL <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="ldl" data-required="1" class="form-control" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['ldl']) && ($cholesterolData['ldl'])!='') 
					{ echo $cholesterolData['ldl'] ;
					} 
					?>" disabled="disabled" /><span class="col-md-6" style="color:red"><?php echo $validationError['ldlErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="ldl_unit" name="ldl_unit" onchange="disableCholesterolUnit()" disabled="disabled" >
                                                   <!--<option value="">Select</option>-->
                                                    <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                <span class="col-md-6" style="color:red"><?php echo $validationError['ldl_unitErr'] ?></span>
                                                </div>
                                               
                                               
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Triglycerides <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="triglycerides" data-required="1" class="form-control" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['triglycerides']) && ($cholesterolData['triglycerides'])!='') 
					{ echo $cholesterolData['triglycerides'] ;
					} 
					?>" disabled="disabled"/><span class="col-md-12" style="color:red"><?php echo $validationError['triglyceridesErr'] ?></span>
                                                </div>
                                                
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="triglycerides_unit" name="triglycerides_unit" disabled="disabled">
                                                    <!--<option value="">Select</option>-->
                                                     <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("m/d/Y") ?>" id="when" name="when" type="text" value="<?php 
					if(isset($cholesterolData['report_date']) && ($cholesterolData['report_date'])!='') 
					{ echo date("m/d/Y H:i:s",strtotime($cholesterolData['report_date'])) ;
					} 
					?>"/ disabled="disabled" > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">HDL <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="hdl" data-required="1" class="form-control" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['hdl']) && ($cholesterolData['hdl'])!='') 
					{ echo $cholesterolData['hdl'] ;
					} 
					?>" disabled="disabled"/>  <span class="col-md-6" style="color:red"><?php echo $validationError['hdlErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="hdl_unit" name="hdl_unit" disabled="disabled">
                                                    <!--<option value="">Select</option>-->
                                                     <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Total <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="total" data-required="1" class="form-control" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['total']) && ($cholesterolData['total'])!='') 
					{ echo $cholesterolData['total'] ;
					} 
					?>" disabled="disabled"/> <span class="col-md-12" style="color:red"><?php echo $validationError['totalErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="total_unit" name="total_unit" disabled="disabled">
                                                   <!--<option value="">Select</option>-->
                                                    <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea disabled="disabled" rows="3" class="form-control" name="notes" ><?php 
					if(isset($cholesterolData['notes']) && ($cholesterolData['notes'])!='') 
					{ echo $cholesterolData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                        </div>
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
            <div class="row" id="BloodGlucoseDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-leaf"></i>
                               Blood Glucose Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveBloodGlucose" id="form_blood_glucose" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Blood Glucose<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="blood_glucose_level" data-required="1" class="form-control" placeholder="Ex 7.1" value="<?php 
					if(isset($bloodGlucoseData['blood_glucose_level']) && ($bloodGlucoseData['blood_glucose_level'])!='') 
					{ echo $bloodGlucoseData['blood_glucose_level'] ;
					} 
					?>" disabled="disabled" /><span class="col-md-6" style="color:red"><?php echo $validationError['blood_glucose_levelErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="unit" name="unit" disabled="disabled">
                                                    <option value="">Select</option>
                                                    <option value="0" <?php 
					if(isset($bloodGlucoseData['unit']) && ($bloodGlucoseData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($bloodGlucoseData['unit']) && ($bloodGlucoseData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                <span class="col-md-6" style="color:red"><?php echo $validationError['unitErr'] ?></span>
                                                </div>
                                               
                                               
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("m/d/Y") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($bloodGlucoseData['report_date']) && ($bloodGlucoseData['report_date'])!='') 
					{ echo date("m/d/Y H:i:s",strtotime($bloodGlucoseData['report_date'])) ;
					} 
					?>" disabled="disabled" / > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" disabled="disabled"><?php 
					if(isset($bloodGlucoseData['notes']) && ($bloodGlucoseData['notes'])!='') 
					{ echo $bloodGlucoseData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Measurement Type <span class="required">
                                                * </span>
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="measurement_type" name="measurement_type" disabled="disabled" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($bloodGlucoseData['measurement_type']) && ($bloodGlucoseData['measurement_type'])==0) 
					{?> selected="selected" <?php } ?> >Plasma</option>
                                                    <option value="1" <?php 
					if(isset($bloodGlucoseData['measurement_type']) && ($bloodGlucoseData['measurement_type'])==1) 
					{?> selected="selected" <?php } ?> >Whole Blood</option>
                                                </select>
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Measurement Context<span class="required">
                                                * </span>
                                                </label>
                                                
                                                 <div class="col-md-8">
                                             
                                                    <select class="form-control" id="measurement_context_id" name="measurement_context_id" disabled="disabled" >
                                                    <option value="">Select</option>
                                                    <?php $MeasurementContextObj = new MeasurementContext();
													$blood_glucose_list = $MeasurementContextObj->measurementContextList();
													
													 foreach($blood_glucose_list as $glucose)
													 {
													 ?>
                                                     <option value="<?php echo $glucose['measurement_context_id'] ?>" <?php 
					if(isset($bloodGlucoseData['measurement_context_id']) && ($bloodGlucoseData['measurement_context_id'])!='' && $bloodGlucoseData['measurement_context_id']==$glucose['measurement_context_id']) 
					{?> selected="selected" <?php } ?> ><?php echo $glucose['context_name'] ?></option>
                    								<?php } ?>
                                                    
                                                </select>
                                                </div>
                                              
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
               <div class="row" id="BloodPressureDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-heart"></i>
                               Blood Pressure Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveBloodPressure" id="form_blood_pressure" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Pulse<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="pulse" data-required="1" class="form-control" placeholder="Ex 7.1" value="<?php 
					if(isset($bloodPressureData['pulse']) && ($bloodPressureData['pulse'])!='') 
					{ echo $bloodPressureData['pulse'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['pulseErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($bloodPressureData['report_date']) && ($bloodPressureData['report_date'])!='') 
					{ echo $bloodPressureData['report_date'] ;
					} 
					?>" disabled="disabled" / > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" disabled="disabled" ><?php 
					if(isset($bloodPressureData['notes']) && ($bloodPressureData['notes'])!='') 
					{ echo $bloodPressureData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Systolic/Diastolic<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="systolic" data-required="1" class="form-control" placeholder="Ex. 80" value="<?php 
					if(isset($bloodPressureData['systolic']) && ($bloodPressureData['systolic'])!='') 
					{ echo $bloodPressureData['systolic'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['systolicErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <input type="text" name="diastolic" data-required="1" class="form-control" placeholder="Ex. 100" value="<?php 
					if(isset($bloodPressureData['diastolic']) && ($bloodPressureData['diastolic'])!='') 
					{ echo $bloodPressureData['diastolic'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['diastolicErr'] ?></span>
                                                </div>
                                               
                                               
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Irr. heartbeat <span class="required">
                                                * </span>
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="irr_heartbeat" name="irr_heartbeat" disabled="disabled" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($bloodPressureData['irr_heartbeat']) && ($bloodPressureData['irr_heartbeat'])==0) 
					{?> selected="selected" <?php } ?> >Don't Know</option>
                                                    <option value="1" <?php 
					if(isset($bloodPressureData['irr_heartbeat']) && ($bloodPressureData['irr_heartbeat'])==1) 
					{?> selected="selected" <?php } ?> >Yes</option>
                   									<option value="2" <?php 
					if(isset($bloodPressureData['irr_heartbeat']) && ($bloodPressureData['irr_heartbeat'])==2) 
					{?> selected="selected" <?php } ?> >No</option>
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['irr_heartbeatErr'] ?></span>
                                                </div>
                                              
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
            
            <div class="row" id="HeightDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-arrows-v"></i>
                               Height Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveHeight" id="form_height" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Height<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="height_value" data-required="1" class="form-control" placeholder="Ex 5.2" value="<?php 
					if(isset($heightData['height_value']) && ($heightData['height_value'])!='') 
					{ echo $heightData['height_value'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['height_valueErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="unit" name="unit" disabled="disabled" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($heightData['unit']) && ($heightData['unit'])==0) 
					{?> selected="selected" <?php } ?> >ft</option>
                                                    <option value="1" <?php 
					if(isset($heightData['unit']) && ($heightData['unit'])==1) 
					{?> selected="selected" <?php } ?> >inch</option>
                   									<option value="2" <?php 
					if(isset($heightData['unit']) && ($heightData['unit'])==2) 
					{?> selected="selected" <?php } ?> >cm</option>
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Sub Height<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="sub_height" data-required="1" class="form-control" placeholder="Ex 5.2" value="<?php 
					if(isset($heightData['sub_height']) && ($heightData['sub_height'])!='') 
					{ echo $heightData['sub_height'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['sub_heightErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="unit" name="unit" disabled="disabled">
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($heightData['sub_height_unit']) && ($heightData['sub_height_unit'])==0) 
					{?> selected="selected" <?php } ?> >ft</option>
                                                    <option value="1" <?php 
					if(isset($heightData['sub_height_unit']) && ($heightData['sub_height_unit'])==1) 
					{?> selected="selected" <?php } ?> >inch</option>
                   									<option value="2" <?php 
					if(isset($heightData['sub_height_unit']) && ($heightData['sub_height_unit'])==2) 
					{?> selected="selected" <?php } ?> >cm</option>
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['sub_height_unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($heightData['report_date']) && ($heightData['report_date'])!='') 
					{ echo $heightData['report_date'] ;
					} 
					?>"/ disabled="disabled" > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" disabled="disabled"><?php 
					if(isset($heightData['notes']) && ($heightData['notes'])!='') 
					{ echo $heightData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
             <div class="row" id="WeightDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-tachometer"></i>
                               Weight Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveWeight" id="form_weight" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Weight<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="weight_value" data-required="1" class="form-control" placeholder="Ex 52" value="<?php 
					if(isset($weightData['weight_value']) && ($weightData['weight_value'])!='') 
					{ echo $weightData['weight_value'] ;
					} 
					?>"/ disabled="disabled" ><span class="col-md-6" style="color:red"><?php echo $validationError['weight_valueErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="unit" name="unit" disabled="disabled">
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($weightData['unit']) && ($weightData['unit'])==0) 
					{?> selected="selected" <?php } ?> >lbs</option>
                                                    <option value="1" <?php 
					if(isset($weightData['unit']) && ($weightData['unit'])==1) 
					{?> selected="selected" <?php } ?> >kg</option>
                   									
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($weightData['report_date']) && ($weightData['report_date'])!='') 
					{ echo $weightData['report_date'] ;
					} 
					?>" disabled="disabled" / > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" disabled="disabled" ><?php 
					if(isset($weightData['notes']) && ($weightData['notes'])!='') 
					{ echo $weightData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
             <div class="row" id="AllergyDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-dribbble"></i>
                               Allergy Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveAllergy" id="form_allergy" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Allergy Name<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="allergy_name" data-required="1" class="form-control" placeholder="Ex. milk" value="<?php 
					if(isset($allergyData['allergy_name']) && ($allergyData['allergy_name'])!='') 
					{ echo $allergyData['allergy_name'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['allergy_nameErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Treatment
                                                <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="treatment" data-required="1" class="form-control" placeholder="Ex. medication" value="<?php 
					if(isset($allergyData['treatment']) && ($allergyData['treatment'])!='') 
					{ echo $allergyData['treatment'] ;
					} 
					?>"/ disabled="disabled"  ><span class="col-md-6" style="color:red"><?php echo $validationError['treatmentErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">First Observed<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="first_observed" name="first_observed" type="text" value="<?php 
					if(isset($allergyData['first_observed']) && ($allergyData['first_observed'])!='') 
					{ echo $allergyData['first_observed'] ;
					} 
					?>"/ disabled="disabled"  > <span class="col-md-12" style="color:red"><?php echo $validationError['first_observedErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Allergen Type<span class="required">
                                                * </span>
                                                </label>
                                                
                                                <div class="col-md-8">
                                                    <select class="form-control" id="allergy_master_id" name="allergy_master_id"  disabled="disabled" >
                                                     <option value="">Select</option>
                                                   <?php
												   $AllergyMaster = new AllergyMaster();
												   $allergyList = $AllergyMaster->getAllergyList();
												 
												   foreach($allergyList as $allergy)
												   {
												   ?>
                                                     <option value="<?php echo $allergy['allergy_master_id'] ?>" <?php 
					if(isset($allergyData['allergy_master_id']) && ($allergyData['allergy_master_id'])==$allergy['allergy_master_id']) 
					{?> selected="selected" <?php } ?> ><?php echo $allergy['name'] ?></option>
                                                   
                   									<?php } ?>
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Reaction<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="reaction" data-required="1" class="form-control" placeholder="Ex. skin problem" value="<?php 
					if(isset($allergyData['reaction']) && ($allergyData['reaction'])!='') 
					{ echo $allergyData['reaction'] ;
					} 
					?>"/  disabled="disabled" ><span class="col-md-6" style="color:red"><?php echo $validationError['reactionErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
             <div class="row" id="MedicationDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-ticket"></i>
                               Medication Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveMedication" id="form_medication" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Medication Name<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="medication_name" data-required="1" class="form-control" placeholder="Ex. Name" value="<?php 
					if(isset($medicationData['medication_name']) && ($medicationData['medication_name'])!='') 
					{ echo $medicationData['medication_name'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['medication_nameErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Dose<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="dose" data-required="1" class="form-control" placeholder="Ex. dose" value="<?php 
					if(isset($medicationData['dose']) && ($medicationData['dose'])!='') 
					{ echo $medicationData['dose'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['doseErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="dose_unit" name="dose_unit"  disabled="disabled" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($medicationData['dose_unit']) && ($medicationData['dose_unit'])==0) 
					{?> selected="selected" <?php } ?> >doses</option>
                                                    <option value="1" <?php 
					if(isset($medicationData['dose_unit']) && ($medicationData['dose_unit'])==1) 
					{?> selected="selected" <?php } ?> >bars</option>
                   									<option value="2" <?php 
					if(isset($medicationData['dose_unit']) && ($medicationData['dose_unit'])==2) 
					{?> selected="selected" <?php } ?> >grams</option>
                    								<option value="3" <?php 
					if(isset($medicationData['dose_unit']) && ($medicationData['dose_unit'])==3) 
					{?> selected="selected" <?php } ?> >capsules</option>
                    								
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['dose_unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">How Taken<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="how_taken" data-required="1" class="form-control" placeholder="Ex. By mouth" value="<?php 
					if(isset($medicationData['how_taken']) && ($medicationData['how_taken'])!='') 
					{ echo $medicationData['how_taken'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['how_takenErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When Started<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="when_started" name="when_started" type="text" value="<?php 
					if(isset($medicationData['when_started']) && ($medicationData['when_started'])!='') 
					{ echo $medicationData['when_started'] ;
					} 
					?>" disabled="disabled" / > <span class="col-md-12" style="color:red"><?php echo $validationError['when_startedErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Is Prescribed?<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="is_prescribed" data-required="1" class="form-control" placeholder="Ex. OTC" value="<?php 
					if(isset($medicationData['is_prescribed']) && ($medicationData['is_prescribed'])!='') 
					{ echo $medicationData['is_prescribed'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['is_prescribedErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                        
                                        	<div class="form-group">
                                                <label class="control-label col-md-4">How Often Taken
                                                <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="how_often_taken" data-required="1" class="form-control" placeholder="Ex: 2 times dialy" value="<?php 
					if(isset($medicationData['how_often_taken']) && ($medicationData['how_often_taken'])!='') 
					{ echo $medicationData['how_often_taken'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['how_often_takenErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Strength<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="strength" data-required="1" class="form-control" placeholder="Ex. Strength" value="<?php 
					if(isset($medicationData['strength']) && ($medicationData['strength'])!='') 
					{ echo $medicationData['strength'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['strengthErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="strength_unit" name="strength_unit"  disabled="disabled" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($medicationData['strength_unit']) && ($medicationData['strength_unit'])==0) 
					{?> selected="selected" <?php } ?> >milligram</option>
                                                    <option value="1" <?php 
					if(isset($medicationData['strength_unit']) && ($medicationData['strength_unit'])==1) 
					{?> selected="selected" <?php } ?> >microgram</option>
                   									<option value="2" <?php 
					if(isset($medicationData['strength_unit']) && ($medicationData['strength_unit'])==2) 
					{?> selected="selected" <?php } ?> >milliliter</option>
                    								<option value="3" <?php 
					if(isset($medicationData['strength_unit']) && ($medicationData['strength_unit'])==3) 
					{?> selected="selected" <?php } ?> >unit</option>
                    								<option value="4" <?php 
					if(isset($medicationData['strength_unit']) && ($medicationData['strength_unit'])==4) 
					{?> selected="selected" <?php } ?> >percent</option>
                    
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['strength_unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Reason<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="reason" data-required="1" class="form-control" placeholder="Ex. reason" value="<?php 
					if(isset($medicationData['reason']) && ($medicationData['reason'])!='') 
					{ echo $medicationData['reason'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['reasonErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When Stopped<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="when_stopped" name="when_stopped" type="text" value="<?php 
					if(isset($medicationData['when_stopped']) && ($medicationData['when_stopped'])!='') 
					{ echo $medicationData['when_stopped'] ;
					} 
					?>" disabled="disabled" / > <span class="col-md-12" style="color:red"><?php echo $validationError['when_stoppedErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes"  disabled="disabled" ><?php 
					if(isset($medicationData['notes']) && ($medicationData['notes'])!='') 
					{ echo $medicationData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
                <div class="row" id="ImmunizationDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>
                               Immunization Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveImmunization" id="form_immunization" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Type<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="type" data-required="1" class="form-control" placeholder="Ex. Checkup" value="<?php 
					if(isset($immunizationData['type']) && ($immunizationData['type'])!='') 
					{ echo $immunizationData['type'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['typeErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($immunizationData['report_date']) && ($immunizationData['report_date'])!='') 
					{ echo $immunizationData['report_date'] ;
					} 
					?>" disabled="disabled" / > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" disabled="disabled"  ><?php 
					if(isset($immunizationData['notes']) && ($immunizationData['notes'])!='') 
					{ echo $immunizationData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                        
                                       		<div class="form-group">
                                                <label class="control-label col-md-4">Facility<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="facility" data-required="1" class="form-control" placeholder="Ex. Contoso Clinic" value="<?php 
					if(isset($immunizationData['facility']) && ($immunizationData['facility'])!='') 
					{ echo $immunizationData['facility'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['facilityErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Reason
                                                <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="reason" data-required="1" class="form-control" placeholder="Ex. Sprained food" value="<?php 
					if(isset($immunizationData['reason']) && ($immunizationData['reason'])!='') 
					{ echo $immunizationData['reason'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['reasonErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
            
            
             <div class="row" id="ProcedureDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gears"></i>
                               Procedure Details of <?php echo $patientData['name'] ?>
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveProcedure" id="form_procedure" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Name<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" data-required="1" class="form-control" placeholder="Ex. Name" value="<?php 
					if(isset($procedureData['name']) && ($procedureData['name'])!='') 
					{ echo $procedureData['name'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['nameErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When Performed<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="when_performed" name="when_performed" type="text" value="<?php 
					if(isset($procedureData['when_performed']) && ($procedureData['when_performed'])!='') 
					{ echo $procedureData['when_performed'] ;
					} 
					?>" disabled="disabled" / > <span class="col-md-12" style="color:red"><?php echo $validationError['when_performedErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" disabled="disabled"  ><?php 
					if(isset($procedureData['notes']) && ($procedureData['notes'])!='') 
					{ echo $procedureData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                        
                                       		<div class="form-group">
                                                <label class="control-label col-md-4">Body Location<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="body_location" data-required="1" class="form-control" placeholder="Ex. Head" value="<?php 
					if(isset($procedureData['body_location']) && ($procedureData['body_location'])!='') 
					{ echo $procedureData['body_location'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['body_locationErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Provider
                                                <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="provider" data-required="1" class="form-control" placeholder="Ex. Doctor's name" value="<?php 
					if(isset($procedureData['provider']) && ($procedureData['provider'])!='') 
					{ echo $procedureData['provider'] ;
					} 
					?>" disabled="disabled" / ><span class="col-md-6" style="color:red"><?php echo $validationError['providerErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                   
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
	