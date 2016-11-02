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
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/medicationListing">
							Medication</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['medication_id']) && $_REQUEST['medication_id']!=''){ ?>
                            Update Medication
                              <?php } else { ?>
                            Add Medication
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="MedicationDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-ticket"></i>
                                <?php if(isset($_REQUEST['medication_id']) && $_REQUEST['medication_id']!=''){ ?>
                            Update Medication
                               <?php } else { ?>
                              Add Medication
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['medication_nameErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Dose<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="dose" data-required="1" class="form-control groupOfTexboxSpecial" placeholder="Ex. dose" value="<?php 
					if(isset($medicationData['dose']) && ($medicationData['dose'])!='') 
					{ echo $medicationData['dose'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['doseErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="dose_unit" name="dose_unit" >
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
												<label class="control-label col-md-4">When Started<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" data-date-start-date="-105y" readonly="readonly" autocomplete="off" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="when_started" name="when_started" type="text" value="<?php 
					if(isset($medicationData['when_started']) && ($medicationData['when_started'])!='') 
					{ echo date("m/d/Y",strtotime($medicationData['when_started'])) ;
					}else { echo date("m/d/Y"); } 
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['when_startedErr'] ?></span>
										
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['how_takenErr'] ?></span>
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['is_prescribedErr'] ?></span>
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['how_often_takenErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Strength<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="strength" data-required="1" class="form-control groupOfTexboxSpecial" placeholder="Ex. Strength" value="<?php 
					if(isset($medicationData['strength']) && ($medicationData['strength'])!='') 
					{ echo $medicationData['strength'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['strengthErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="strength_unit" name="strength_unit" >
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['reasonErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">When Stopped<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" readonly="readonly" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="when_stopped" name="when_stopped" type="text" value="<?php 
					if(isset($medicationData['when_stopped']) && ($medicationData['when_stopped'])!='') 
					{ echo date("m/d/Y",strtotime($medicationData['when_stopped'])) ;
					} else { echo date("m/d/Y"); }
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['when_stoppedErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" ><?php 
					if(isset($medicationData['notes']) && ($medicationData['notes'])!='') 
					{ echo $medicationData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="medication_id" value="<?php echo $_REQUEST['medication_id']; ?>"  />
                                    
										<button type="submit" name="saveMedication" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/MedicationListing">Cancel</a>
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
	