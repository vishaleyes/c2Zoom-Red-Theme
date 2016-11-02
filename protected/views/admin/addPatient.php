<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-form-tools.js"></script>


<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<script>
jQuery(document).ready(function() {    
   
	ComponentsFormTools.init();
});

function removeImage(url)
{
	$("#imgDiv").html("<img src="+url+">");
}
</script>


			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Patient
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>admin/patientListing">Patient List</a>
                            <?php /*?><i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/addPatient">
							Profile</a><?php */?>
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
								<i class="fa fa-user"></i>
                                <?php if( (isset($patient_id) && $patient_id!='' ) || 
								( ( isset( $_REQUEST['patient_id'] ) ) && ( $_REQUEST['patient_id'] ) ) ) { ?>
                                Edit Patient
                                <?php } else  { ?>
                                Add Patient
                                <?php } ?>
                                
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>admin/savePatient" id="form_patient_profile" class="form-horizontal" method="post" enctype="multipart/form-data">
                            
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
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;" id="imgDiv">
												 <?php if( ( isset($patientData['patient_image']) ) && ( $patientData['patient_image']!='' ) )						{
													$url = Yii::app()->params->base_url."assets/upload/avatar/patient/".$patientData['patient_image']; 
													
												}
												 else { $url = Yii::app()->params->base_url."assets/upload/avatar/patient/patient_".$patient_id.".png"; } 
												 ?>
                                                <img src="<?php echo $url ?>" />
												</div>
												<div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Select image </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="patient_image">
													</span>
                                                  <!--  data-dismiss="fileinput"-->
													<a href="#" class="btn red fileinput-exists" onclick="removeImage('<?php echo $url; ?>')" >
													Remove </a>
												</div>
											</div>
											
										</div>
									</div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Firstname 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" data-required="1" class="form-control" value="<?php 
					if(isset($patientData['name']) && ($patientData['name'])!='') 
					{ echo $patientData['name'] ;
					} 
					?>"/>
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
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">Birth date
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" id="dob" autocomplete="off" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" data-date-start-date="-105y"  name="dob" type="text" value="<?php 
					if(isset($patientData['dob']) && ($patientData['dob'])!='') 
					{ echo date("m/d/Y",strtotime($patientData['dob'])) ;
					} 
					?>"/ >
										
										</div>
											</div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Gender 
                                                </label>
                                               <div class="col-md-8">
                                                    <select class="form-control" id="gender" name="gender" >
                                                    <option value="">Select</option>
                                                     <option <?php  if(isset($patientData['gender']) && ($patientData['gender'])==0) { ?> selected="selected" <?php }  ?> value="0">Female</option>
                                                    <option  <?php  if(isset($patientData['gender']) && ($patientData['gender'])==1) { ?> selected="selected" <?php }  ?> value="1">Male</option>
                                                    <option  <?php  if(isset($patientData['gender']) && ($patientData['gender'])==2) { ?> selected="selected" <?php }  ?> value="2">Not Specified</option>
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Marital Status 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="marital_status" name="marital_status" >
                                                    <option value="">Select</option>
                                                     <option  <?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==0) { ?> selected="selected" <?php }  ?> value="0">Married</option>
                                                    <option  <?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==1) { ?> selected="selected" <?php }  ?> value="1">Widowed</option>
                                                    <option  <?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==2) { ?> selected="selected" <?php }  ?> value="2">Seperated</option>
                                                    <option  <?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==3) { ?> selected="selected" <?php }  ?> value="3">Divorsed</option>
                                                    <option  <?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==4) { ?> selected="selected" <?php }  ?> value="4">Single</option>
                                                    <option  <?php  if(isset($patientData['marital_status']) && ($patientData['marital_status'])==5) { ?> selected="selected" <?php }  ?> value="5">Not Specified</option>
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Address</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="address" ><?php 
					if(isset($patientData['address']) && ($patientData['address'])!='') 
					{ echo $patientData['address'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                        
                                        <div class="form-group">
                                                <label class="control-label col-md-4">Lastname
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="surname" data-required="1" class="form-control" value="<?php 
					if(isset($patientData['surname']) && ($patientData['surname'])!='') 
					{ echo $patientData['surname'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Phone Number 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="number" name="phone_number" data-required="1" class="form-control groupOfTexbox" value="<?php 
					if(isset($patientData['phone_number']) && ($patientData['phone_number'])!='') 
					{ echo $patientData['phone_number'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            <?php /*?><div class="form-group">
                                                <label class="control-label col-md-4">Relationship 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="relation_id" name="relation_id" >
                                                    <option value="">Select</option>
                                                    <?php
													$RelationMaster = new RelationMaster();
													$relation_list = $RelationMaster->getRelationList();
													
													foreach($relation_list as $relation)
													{
													?>
                                                    <option  value="<?php echo $relation['relation_id'] ?>">
													<?php echo $relation['relation_name'] ?>
                                                    </option>
                                                    <?php } ?>
                                                   
                                                </select>
                                                </div>
                                            </div><?php */?>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Blood Group 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="blood_group" name="blood_group" >
                                                    <option value="">Select</option>
                                                     <option  <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==0) { ?> selected="selected" <?php }  ?> value="0">Not Specified</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==1) { ?> selected="selected" <?php }  ?> value="1">A+</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==2) { ?> selected="selected" <?php }  ?> value="2">A-</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==3) { ?> selected="selected" <?php }  ?> value="3">B+</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==4) { ?> selected="selected" <?php }  ?> value="4">B-</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==5) { ?> selected="selected" <?php }  ?> value="5">O+</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==6) { ?> selected="selected" <?php }  ?> value="6">O-</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==7) { ?> selected="selected" <?php }  ?> value="7">AB+</option>
                                                    <option <?php  if(isset($patientData['blood_group']) && ($patientData['blood_group'])==8) { ?> selected="selected" <?php }  ?> value="8">AB-</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            
                                                <div class="bootstrap-switch-container">
                                                 <label class="control-label bootstrap-switch-label col-md-4">Organ Donor</label>
                                                 &nbsp; &nbsp;
                                                
                                                <span class="bootstrap-switch-handle-on bootstrap-switch-primary">
                                                </span>
                                                
                                                <span class="bootstrap-switch-handle-off bootstrap-switch-info">
                                                </span>
                                                <input type="checkbox" class="make-switch"  <?php  if(isset($patientData['organ_donor']) && ($patientData['organ_donor'])==1) { ?> checked="checked" <?php } ?> data-on-color="primary" data-off-color="info" name="organ_donor">
                                                </div>
                                            
                                            </div>
                                            
                                             <?php
										  if(!isset($patientData['patient_id']) && ($patientData['patient_id'])=='') {
										  ?>  
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Password
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="password" name="password" data-required="1" class="form-control" />
                                                </div>
                                                 
                                            </div>
                                            <?php } ?>
                                            
                                        </div>
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-9">
                                    
                                    <input type="hidden" name="patient_id" value="<?php echo $_REQUEST['patient_id']; ?>"  />
                                    
										<button type="submit" name="savePatientProfile" class="btn green">Submit</button>
										<a href="<?php echo Yii::app()->params->base_path ; ?>admin/patientListing"><button type="button" class="btn default">Cancel</button></a>
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
	