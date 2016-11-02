			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Blood Glucose
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a> <i class="fa fa-angle-right "></i>
						
							Measurements
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/bloodGlucoseListing">
							Blood Glucose</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['blood_glucose_id']) && $_REQUEST['blood_glucose_id']!=''){ ?>                            
							Update Blood Glucose
                              <?php } else { ?>
                            Add Blood Glucose
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="BloodGlucoseDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-leaf"></i>
                                <?php if(isset($_REQUEST['blood_glucose_id']) && $_REQUEST['blood_glucose_id']!=''){ ?>
                            Update Blood Glucose
                               <?php } else { ?>
                              Add Blood Glucose
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>doctor/saveBloodGlucose" id="form_blood_glucose" class="form-horizontal" method="post">
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
                                                    <input type="text" name="blood_glucose_level" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 7.1" value="<?php 
					if(isset($bloodGlucoseData['blood_glucose_level']) && ($bloodGlucoseData['blood_glucose_level'])!='') 
					{ echo $bloodGlucoseData['blood_glucose_level'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['blood_glucose_levelErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="unit" name="unit" >
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
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" autocomplete="off" data-date-format="mm/dd/yyyy" data-date-end-date="+0d"  data-date-start-date="-110y"  placeholder="Ex. <?php echo date("m/d/Y") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($bloodGlucoseData['report_date']) && ($bloodGlucoseData['report_date'])!='') 
					{ echo date("m/d/Y",strtotime($bloodGlucoseData['report_date'])) ;
					} 
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Measurement Type <span class="required">
                                                * </span>
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="measurement_type" name="measurement_type" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($bloodGlucoseData['measurement_type']) && ($bloodGlucoseData['measurement_type'])==0) 
					{?> selected="selected" <?php } ?> >Plasma</option>
                                                    <option value="1" <?php 
					if(isset($bloodGlucoseData['measurement_type']) && ($bloodGlucoseData['measurement_type'])==1) 
					{?> selected="selected" <?php } ?> >Whole Blood</option>
                                                </select>
                                                <span class="col-md-6" style="color:red"><?php echo $validationError['measurement_typeErr'] ?></span>
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Measurement Context<span class="required">
                                                * </span>
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="measurement_context_id" name="measurement_context_id" >
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
                                                <span class="col-md-6" style="color:red"><?php echo $validationError['measurement_context_idErr'] ?></span>
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" ><?php 
					if(isset($bloodGlucoseData['notes']) && ($bloodGlucoseData['notes'])!='') 
					{ echo $bloodGlucoseData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="blood_glucose_id" value="<?php echo $_REQUEST['blood_glucose_id']; ?>"  />
                                    
										<button type="submit" name="saveBloodGlucose" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>doctor/BloodGlucoseListing">Cancel</a>
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
	