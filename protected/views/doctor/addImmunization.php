			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Immunization
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/immunizationListing">
							Immunization</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['immunization_id']) && $_REQUEST['immunization_id']!=''){ ?>
                             
							Update Immunization
                              <?php } else { ?>
                            
							Add Immunization
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
                                <?php if(isset($_REQUEST['immunization_id']) && $_REQUEST['immunization_id']!=''){ ?>
                            Update Immunization
                               <?php } else { ?>
                              Add Immunization
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>doctor/saveImmunization" id="form_immunization" class="form-horizontal" method="post">
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
                                        
                                        <!--	<div class="form-group">
                                                    <label class="control-label col-md-4">Patient <span class="required">
                                                    * </span>
                                                    </label>
                                                     <div class="col-md-8">
                                                       <select class="form-control" id="patient_id" name="patient_id" >
                                                    <option value="">Select</option>
                                                    <?php
													$PatientMaster = new PatientMaster();
													$patient_list = $PatientMaster->getPatientListByDoctor(Yii::app()->session['pingmydoctor_doctor']);
													
													foreach($patient_list as $patient)
													{
													?>
                                                    <option <?php if(isset($immunizationData['patient_id']) && ($immunizationData['patient_id'])==$patient['patient_id']) { ?> selected="selected" <?php } ?> value="<?php echo $patient['patient_id'] ?>">
													<?php echo $patient['name']." ".$patient['surname'] ?>
                                                    </option>
                                                    <?php } ?>
                                                   
                                                </select>
                                                    <span class="col-md-6" style="color:red"><?php echo $validationError['patientErr'] ?></span>
                                                    </div>
                                                   
                                                   
                                                </div>-->
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Type<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="type" data-required="1" class="form-control" placeholder="Ex. Checkup" value="<?php 
					if(isset($immunizationData['type']) && ($immunizationData['type'])!='') 
					{ echo $immunizationData['type'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['typeErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" autocomplete="off" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" data-date-start-date="-105y"  placeholder="Ex. <?php echo date("m/d/Y") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($immunizationData['report_date']) && ($immunizationData['report_date'])!='') 
					{ echo date("m/d/Y",strtotime($immunizationData['report_date'])) ;
					} 
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['facilityErr'] ?></span>
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['reasonErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" ><?php 
					if(isset($immunizationData['notes']) && ($immunizationData['notes'])!='') 
					{ echo $immunizationData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="immunization_id" value="<?php echo $_REQUEST['immunization_id']; ?>"  />
                                    
										<button type="submit" name="saveImmunization" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>doctor/immunizationListing">Cancel</a>
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
	