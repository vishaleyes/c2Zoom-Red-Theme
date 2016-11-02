<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" />
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-form-tools.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
	ComponentsFormTools.init();		
});	
function removeImage(url)
{
	$("#imgDiv").html('<img src="'+url+'" class="img-circle" width="150" height="150">');
	$("#image_name").val('');
}
</script>
<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Image Manager</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i>
				<?php 
					if(isset($_REQUEST['image_id']) && $_REQUEST['image_id']!='')
					{ 
				?>
						Update Image
                <?php 
					} 
					else 
					{ 
				?>
						Add Image 			
				<?php 
					} 
				?>											                            
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row" id="ImageDiv">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-user"></i>
					<?php
						if ((isset ( $image_id ) && $image_id != '') || ((isset ( $_REQUEST ['image_id'] )) && ($_REQUEST ['image_id']))) 
						{
					?>
							Edit Image
					<?php 
						} 
						else  
						{ 
					?>
							Add Image
					<?php 
						} 
					?>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveImage" id="form_patient_profile" class="form-horizontal" method="post" enctype="multipart/form-data">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div>
							<div class="form-group">
								<label class="control-label col-md-2">Image</label>
								<div class="col-md-10">
										<div class="fileinput fileinput-new" data-provides="fileinput">
										  <div class="fileinput-preview marg-btm20px defaultimage" data-trigger="fileinput" id="imgDiv" style="min-width:150px;height: 150px;"></div>
										  <div>
										    <span class="btn btn-default btn-file">
										    	<span class="fileinput-new">Select image</span>
										    	<span class="fileinput-exists">Change</span>
										    	<input type="file" id="image_name" name="image_name" value="<?php echo $url.'?'.date("Y-m-d H:i:s"); ?>">
										    </span>
										    <a href="#" class="btn btn-default fileinput-exists hide" data-dismiss="fileinput">Remove</a>
										  </div>
										</div>
										
									</div>
								
										<!-- <span class="btn default btn-file"> 
										<span class="fileinput-new"> Select image</span> 
										<span class="fileinput-exists"> Change </span> 
										<input type="file" id="image_name" name="image_name" value="<?php echo $url.'?'.date("Y-m-d H:i:s"); ?>">
										</span> -->
										<!-- data-dismiss="fileinput"  -->
										<!-- <a class="btn red fileinput-exists" href="#" onclick="removeImage('<?php echo $url.'?'.date("Y-m-d H:i:s"); ?>');"> Remove </a> -->
									
									
									<!-- <input type="file" id="image_name" name="image_name" required="true" value="<//?php echo $url; ?>" /> --><br />
									<span id="lblError" style="color: red;"></span>
									<!-- 
											<script>
												$("#image_name").fileinput({												    
												    //allowedFileExtensions: ["dcm", "dcim"]
												    //msgInvalidFileExtension: 'Invalid extension for file {name}. Only "{extensions} files are supported.'
												});
												</script> -->

									<!-- 
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-preview marg-btm20px" data-trigger="fileinput" id="imgDiv">
												 <?php
													if ((isset ( $imageData ['image_name'] )) && ($imageData ['image_name'] != '')) {
														$url = Yii::app ()->params->base_url . "assets/upload/avatar/filemanager/patient/" . Yii::app ()->session ['pingmydoctor_patient'] . "/" . $imageData ['image_name'];
													} else {
														$url = Yii::app ()->params->base_url . "assets/upload/avatar/filemanager/patient/default.jpg";
													}
													?>
                                                <img src="<?php echo $url ?>" id="patient_img" class="img-circle" width="150" height="150" />
												</div>
												
												<div class="text-center">
													<span class="btn default btn-file"> 
														<span class="fileinput-new"> Select image</span> 
														<span class="fileinput-exists"> Change </span>
														<input type="file" id="image_name" name="image_name" required="true" value="<?php echo $url; ?>">
													</span>													
													<a class="btn red fileinput-exists" href="#" onclick="removeImage('<?php echo $url;?>');"> Remove </a>
												</div>
											</div>	
											 -->

								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Notes</label>
								<div class="col-md-8">
									<textarea class="form-control" name="notes"><?php if (isset ( $imageData ['notes'] ) && ($imageData ['notes']) != '') { echo $imageData ['notes']; }?></textarea>
								</div>
							</div>
						</div>
					
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" id="image_id" name="image_id" value="<?php echo $_REQUEST['image_id']; ?>" />
							<button type="submit" name="saveImage" class="btn green" onclick="return ValidateExtension();">Submit</button>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/imageListing">
								<button type="button" class="btn default">Cancel</button>
							</a>
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
<script type="text/javascript">
    function ValidateExtension() {
        var allowedFiles = [".dcm",".gif",".jpg",".jpeg",".bmp",".png"];
        var fileUpload = document.getElementById("image_name");
        var lblError = document.getElementById("lblError");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase())) {
            lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
            return false;
        }
        lblError.innerHTML = "";
        return true;
    }
    function removeImage(url)
    {
    	$("#imgDiv").html('');
    	$("#image_name").val('');
    	$("#removeButton").hide();
    	/*$(".btn-file .fileinput-exists").hide();    	
    	$(".btn-file .fileinput-new").show();
    	$("#image_name").show();*/
    }

    $('#imgDiv').hide();
    $(".fileinput").on("change.bs.fileinput", function(e) {
        e.stopPropagation();
        $('#imgDiv').show(); 
        return false;
    });    
    /*$('#image_name').click(function(){
    	$('#imgDiv').show();    
    })*/
    
</script>