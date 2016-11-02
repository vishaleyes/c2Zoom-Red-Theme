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
					Doctor
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>admin/doctorListing">Doctor List</a>
                            <?php /*?><i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/addDoctor">
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
                                 <?php if( (isset($doctor_id) && $doctor_id!='' ) || 
								( ( isset( $_REQUEST['doctor_id'] ) ) && ( $_REQUEST['doctor_id'] ) ) ) { ?>
                                Edit Doctor
                                <?php } else  { ?>
                                Add Doctor
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>admin/saveDoctor" id="form_patient_profile" class="form-horizontal" method="post" enctype="multipart/form-data">
                            
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
												 <?php if( ( isset($doctorData['doctor_image']) ) && ( $doctorData['doctor_image']!='' ) )						{
													$url = Yii::app()->params->base_url."assets/upload/avatar/doctor/".$doctorData['doctor_image']; 
												}
												  else { $url = Yii::app()->params->base_url."assets/upload/avatar/doctor/doctor_".$doctor_id.".png"; } 
												 ?>
                                                <img src="<?php echo $url ?>" />
												</div>
												<div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Select image </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="doctor_image">
													</span>
                                                    <!--data-dismiss="fileinput"-->
													<a href="#" class="btn red fileinput-exists" onclick="removeImage('<?php echo $url; ?>')">
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
					if(isset($doctorData['name']) && ($doctorData['name'])!='') 
					{ echo $doctorData['name'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Email 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="email" data-required="1" class="form-control" value="<?php 
					if(isset($doctorData['email']) && ($doctorData['email'])!='') 
					{ echo $doctorData['email'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
												<label class="control-label col-md-4">Birth date
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" autocomplete="off" size="16" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" data-date-start-date="-105y"  id="dob" name="dob" type="text" value="<?php 
					if(isset($doctorData['dob']) && ($doctorData['dob'])!='') 
					{ echo date("m/d/Y",strtotime($doctorData['dob'])) ;
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
                                                     <option <?php  if(isset($doctorData['gender']) && ($doctorData['gender'])==0) { ?> selected="selected" <?php }  ?> value="0">Female</option>
                                                    <option  <?php  if(isset($doctorData['gender']) && ($doctorData['gender'])==1) { ?> selected="selected" <?php }  ?> value="1">Male</option>
                                                    <option  <?php  if(isset($doctorData['gender']) && ($doctorData['gender'])==2) { ?> selected="selected" <?php }  ?> value="2">Not Specified</option>
                                                </select>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Address</label>
                                            <div class="col-md-8">
                                                 <textarea class="form-control" name="address" ><?php 
					if(isset($doctorData['address']) && ($doctorData['address'])!='') 
					{ echo $doctorData['address'] ;
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
					if(isset($doctorData['surname']) && ($doctorData['surname'])!='') 
					{ echo $doctorData['surname'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Mobile number 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" id="doctor_mobile" name="doctor_mobile" data-required="1" class="form-control groupOfTexbox" value="<?php 
					if(isset($doctorData['doctor_mobile']) && ($doctorData['doctor_mobile'])!='') 
					{ echo $doctorData['doctor_mobile'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Specialization 
                                                </label>
                                                
                                                 <div class="col-md-8">
                                                    <select class="form-control" id="doctor_spec_id" name="doctor_spec_id" >
                                                    <option value="">Select</option>
                                                    <?php
													$DoctorSpecialization = new DoctorSpecialization();
													$specialization_list = $DoctorSpecialization->getSpecializationList();
													
													foreach($specialization_list as $specialization)
													{
													?>
                                                    <option <?php if(isset($doctorData['doctor_spec_id']) && ($doctorData['doctor_spec_id'])==$specialization['doctor_spec_id']) { ?> selected="selected" <?php } ?> value="<?php echo $specialization['doctor_spec_id'] ?>">
													<?php echo $specialization['specialization'] ?>
                                                    </option>
                                                    <?php } ?>
                                                   
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Qualification
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="qualification" data-required="1" class="form-control" value="<?php 
					if(isset($doctorData['qualification']) && ($doctorData['qualification'])!='') 
					{ echo $doctorData['qualification'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                          <?php
										  if(!isset($doctorData['doctor_id']) && ($doctorData['doctor_id'])=='') {
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
                                    
                                    <input type="hidden" name="doctor_id" value="<?php echo $_REQUEST['doctor_id']; ?>"  />
                                    
										<button type="submit" name="saveDoctorProfile" class="btn green">Submit</button>
										<a href="<?php echo Yii::app()->params->base_path ; ?>admin/doctorListing"><button type="button" class="btn default">Cancel</button></a>
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
	