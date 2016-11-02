


			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Blood Pressure
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a> <i class="fa fa-angle-right "></i>
						
							Measurements
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/bloodPressureListing">
							Blood Pressure</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['blood_pressure_id']) && $_REQUEST['blood_pressure_id']!=''){ ?>                         
							Update Blood Pressure
                              <?php } else { ?>
     						Add Blood Pressure
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="BloodPressureDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-heart"></i>
                                <?php if(isset($_REQUEST['blood_pressure_id']) && $_REQUEST['blood_pressure_id']!=''){ ?>
                            Update Blood Pressure
                               <?php } else { ?>
                              Add Blood Pressure
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>doctor/saveBloodPressure" id="form_blood_pressure" class="form-horizontal" method="post">
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
                                                    <input type="text" name="pulse" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 7.1" value="<?php 
					if(isset($bloodPressureData['pulse']) && ($bloodPressureData['pulse'])!='') 
					{ echo $bloodPressureData['pulse'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['pulseErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" autocomplete="off" data-date-format="mm/dd/yyyy" data-date-end-date="+0d"  data-date-start-date="-110y" placeholder="Ex. <?php echo date("m/d/Y") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($bloodPressureData['report_date']) && ($bloodPressureData['report_date'])!='') 
					{ echo date("m/d/Y",strtotime($bloodPressureData['report_date'])) ;
					} 
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Systolic/Diastolic<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="systolic" data-required="1" class="form-control groupOfTexbox" placeholder="Ex. 80" value="<?php 
					if(isset($bloodPressureData['systolic']) && ($bloodPressureData['systolic'])!='') 
					{ echo $bloodPressureData['systolic'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['systolicErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <input type="text" name="diastolic" data-required="1" class="form-control groupOfTexbox" placeholder="Ex. 100" value="<?php 
					if(isset($bloodPressureData['diastolic']) && ($bloodPressureData['diastolic'])!='') 
					{ echo $bloodPressureData['diastolic'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['diastolicErr'] ?></span>
                                                </div>
                                               
                                               
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Irr. heartbeat <span class="required">
                                                * </span>
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="irr_heartbeat" name="irr_heartbeat" >
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
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea class="form-control" name="notes" ><?php 
					if(isset($bloodPressureData['notes']) && ($bloodPressureData['notes'])!='') 
					{ echo $bloodPressureData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="blood_pressure_id" value="<?php echo $_REQUEST['blood_pressure_id']; ?>"  />
                                    
										<button type="submit" name="saveBloodPressure" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>doctor/BloodPressureListing">Cancel</a>
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
	