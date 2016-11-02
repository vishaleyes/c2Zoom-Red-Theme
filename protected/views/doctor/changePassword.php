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
					Change Password
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
                            <i class="fa fa-angle-right "></i>
                            Change Password
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
								<i class="fa fa-gears"></i>Change Password
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>doctor/changePassword" id="form_change_password" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            
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
                                                <label class="control-label col-md-4">Old Password
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="password" name="oldpassword" placeholder="Enter Old password" data-required="1" class="form-control" onblur="return validateOldPassword()"/>
                                                    <span id="spanold" style="color:#a94442;"></span>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">New Password
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="password" name="newpassword"  placeholder="Enter New password"  data-required="1" class="form-control" onblur="return validateNewPassword()"/>
                                                    <span id="spannew" style="color:#a94442"></span>
                                                </div>
                                                 
                                            </div>
                                            
                                            
                                          <div class="form-group">
                                                <label class="control-label col-md-4">Confirm Password
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="password" placeholder="Enter Confirm password"  name="confirmpassword" data-required="1" class="form-control" onblur="return validateConfirmPassword()"/>
                                                    <span id="spanconfirm" style="color:#a94442"></span>
                                                </div>
                                                 
                                            </div>
                                            
                                        </div>
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-9">
                                    <input type="hidden" name="doctor_id" value="<?php echo $_REQUEST['doctor_id']; ?>"  />
                                    
										<button type="submit" name="FormSubmit" class="btn green">Submit</button>
										<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome"><button type="button" class="btn default">Cancel</button></a>
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

<script>

function validateOldPassword()
		{
			var y = document.forms["form_change_password"]["oldpassword"].value;
			             
			if (y==null || y=="")
			{
			   document.getElementById("spanold").innerHTML="Old Password is required";
			   return false;
			}
			else
			{
				var k = document.forms["form_change_password"]["oldpassword"].value.length;
			              if(k<6)
                                {
							        document.getElementById("spanold").innerHTML="Please enter at least 6 characters";
							      return false;
                                }
				document.getElementById("spanold").innerHTML=" ";
							   
			}
		}
		
		
function validateNewPassword()
		{
			var y = document.forms["form_change_password"]["newpassword"].value;
			             
			if (y==null || y=="")
			{
			   document.getElementById("spannew").innerHTML="New Password is required";
			   return false;
			}
			else
			{
				var k = document.forms["form_change_password"]["newpassword"].value.length;
			              if(k<6)
                                {
							        document.getElementById("spannew").innerHTML="Please enter at least 6 characters";
							        return false;
                                }
				document.getElementById("spannew").innerHTML=" ";
							   
			}
		}
		

function validateConfirmPassword()
		{
			
			var z = document.forms["form_change_password"]["confirmpassword"].value;
			
			if (z==null || z=="")
			{
			   document.getElementById("spanconfirm").innerHTML="Confirm password is required.";
				return false;
			}
			else
			{
				var k = document.forms["form_change_password"]["confirmpassword"].value.length;
			              if(k<6)
                                {
							        document.getElementById("spanconfirm").innerHTML="Please enter at least 6 characters.";
							        return false;
                                }
								
	     		var x=document.forms["form_change_password"]["newpassword"].value;
				var y=document.forms["form_change_password"]["confirmpassword"].value;
				
				
				if(x!==y)
				{
					document.getElementById("spanconfirm").innerHTML=" New Password And Confirm Password do not match";
					return false;
				}
				else
				{
					document.getElementById("spanconfirm").innerHTML=" ";
				}
			}
		}
		
				
function validateForm()
{
	var bool=true;
	
	var y = document.forms["form_change_password"]["oldpassword"].value;
			             
			if (y==null || y=="")
			{
			   document.getElementById("spanold").innerHTML="Old Password is required";
			   bool=false;
			}
			else
			{
				var k = document.forms["form_change_password"]["oldpassword"].value.length;
			              if(k<6)
                                {
							        document.getElementById("spanold").innerHTML="Please enter at least 6 characters";
							       bool=false;
                                }
				document.getElementById("spanold").innerHTML=" ";
							   
			}
	
	var y = document.forms["form_change_password"]["newpassword"].value;
			             
			if (y==null || y=="")
			{
			   document.getElementById("spannew").innerHTML="New Password is required";
			   bool=false;
			}
			else
			{
				var k = document.forms["form_change_password"]["newpassword"].value.length;
			              if(k<6)
                                {
							        document.getElementById("spannew").innerHTML="Please enter at least 6 characters";
							        bool=false;
                                }
				document.getElementById("spannew").innerHTML=" ";
							   
			}
			
			
		var z = document.forms["form_change_password"]["confirmpassword"].value;
			
			if (z==null || z=="")
			{
			   document.getElementById("spanconfirm").innerHTML="Confirm password is required";
				bool=false;
			}
			else
			{
				var k = document.forms["form_change_password"]["confirmpassword"].value.length;
			              if(k<6)
                                {
							        document.getElementById("spanconfirm").innerHTML="Please enter at least 6 characters";
							        bool=false;
                                }
								
	     		var x=document.forms["form_change_password"]["newpassword"].value;
				var y=document.forms["form_change_password"]["confirmpassword"].value;
				
				
				if(x!==y)
				{
					document.getElementById("spanconfirm").innerHTML=" New Password And Confirm Password do not match";
					bool=false;
				}
				else
				{
					document.getElementById("spanconfirm").innerHTML=" ";
				}
			}
			
			
					if(bool == true)
							{
									return true;
							}
					else
							{
									return false;
							}

	
}
</script>