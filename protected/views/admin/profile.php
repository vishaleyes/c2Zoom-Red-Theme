<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>

<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-form-tools.js"></script>


<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


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
					Admin Profile
					</h3>
					
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
								<i class="fa fa-user"></i>Admin Profile
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>admin/saveProfile" id="form_patient_profile" class="form-horizontal" method="post" enctype="multipart/form-data">
                            
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
                                                <label class="control-label col-md-4">Name 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" data-required="1" class="form-control" value="<?php 
					if(isset($adminData['name']) && ($adminData['name'])!='') 
					{ echo $adminData['name'] ;
					} 
					?>"/>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Email 
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="email" data-required="1" class="form-control" value="<?php 
					if(isset($adminData['email']) && ($adminData['email'])!='') 
					{ echo $adminData['email'] ;
					} 
					?>" disabled="disabled"/>				      
                    							</div>
                                                 
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                     
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Password
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="password" name="password" data-required="1" class="form-control" value="<?php 
					if(isset($adminData['password']) && ($adminData['password'])!='') 
					{ echo $adminData['password'] ;
					} 
					?>" />
                                                </div>
                                                 
                                            </div>
                                          
                                        </div>
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-9">
                                    
                                    <input type="hidden" name="admin_id" value="<?php echo $_REQUEST['admin_id']; ?>"  />
                                    
										<button type="submit" name="saveAdminProfile" class="btn green">Submit</button>
										<a href="<?php echo Yii::app()->params->base_path ; ?>admin/adminHome"><button type="button" class="btn default">Cancel</button></a>
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
	