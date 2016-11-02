


			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Allergy
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/allergyListing">
							Allergy</a>
                            <i class="fa fa-angle-right "></i>
                            <?php if(isset($_REQUEST['allergy_id']) && $_REQUEST['allergy_id']!=''){ ?>
                            Update Allergy
                              <?php } else { ?>
                            Add Allergy
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="AllergyDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-dribbble"></i>
                                <?php if(isset($_REQUEST['allergy_id']) && $_REQUEST['allergy_id']!=''){ ?>
                            Update Allergy
                               <?php } else { ?>
                              Add Allergy
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['allergy_nameErr'] ?></span>
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['treatmentErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">First Observed<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" data-date-start-date="-105y" readonly="readonly" autocomplete="off" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="first_observed" name="first_observed" type="text" value="<?php 
					if(isset($allergyData['first_observed']) && ($allergyData['first_observed'])!='') 
					{ echo date("m/d/Y",strtotime($allergyData['first_observed'])) ;
					} else { echo date("m/d/Y"); }
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['first_observedErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Allergen Type<span class="required">
                                                * </span>
                                                </label>
                                                
                                                <div class="col-md-8">
                                                    <select class="form-control" id="allergy_master_id" name="allergy_master_id" >
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
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['allergy_master_idErr'] ?></span>
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
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['reactionErr'] ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" ><?php 
					if(isset($allergyData['notes']) && ($allergyData['notes'])!='') 
					{ echo $allergyData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="allergy_id" value="<?php echo $_REQUEST['allergy_id']; ?>"  />
                                    
										<button type="submit" name="saveAllergy" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/AllergyListing">Cancel</a>
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
	