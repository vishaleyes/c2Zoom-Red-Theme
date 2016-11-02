<style>
.model_table {border-spacing: 7px; border-collapse:collapse ; border-collapse:separate;}
.model_table td    {padding: 11px; color:#22313F; background-color:#D6E9F8}
.model_table th    {color:white; background-color:#578EBE; text-align:center; }

</style>
<script>
function popitup(url) {
	newwindow=window.open(url,'name','height=400,width=780,scrollbars=yes,screenX=250,screenY=200,top=150');
	if (window.focus) {newwindow.focus()}
	return false;
}
</script>
 <?php  //print_r($_REQUEST); print_r($hipaaData); die; ?> 
	<div id="procedureDiv">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Documents
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a> <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>doctor/patientList">Patient</a>
                            <i class="fa fa-angle-right "></i>
                            Documents
                            <i class="fa fa-angle-right "></i> Health Care Provider Forms
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-tachometer"></i>Forms
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body">
                         <?php if($is_share == 1) { ?>
                      
							 <div class="row">
                             	<div class="col-md-6">                           
                           		 <div class="well well-lg">
								<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/updateHipaaForm/patient_id/<?php echo $_REQUEST['patient_id'] ?>"><img src="themefiles/assets/global/img/form_ok.png"/></a>
								<label style="margin-left: 10px;padding-top:20px;">Hipaa Authorization for Release</label>
                              <?php 
							  $pdf_name = '';
							  
							  if(isset($formsList['hippa_form']) && $formsList['hippa_form'] != 0)
							  {
								 
								 $exist_path = 'assets/upload/pdf/'.$formsList['hippa_form'];  
								 $pdf_name = $formsList['hippa_form']; 
							  }
							 
							  
							  
							   if(isset($formsList['hippa_form']) && !empty($formsList['hippa_form']) && file_exists($exist_path))
							   { 
							   ?> 
                                <a data-toggle="modal" data-target=".modal-patient-hippa"  style="margin-left:25px; margin-top:10px;"  title="Edit" href="#"><i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp;           
                                
                                <!--Open pdf in modal window-->
   						 		<div class="modal fade modal-patient-hippa" id="basic" tabindex="-1" role="basic" aria-hidden="true" >
  				
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Patient Hippa Form PDF</h4>
										</div>
										<div class="modal-body">
											 
                                   <iframe id="popupload" src="<?php echo Yii::app()->params->base_url;?>assets/upload/pdf/<?php echo $pdf_name ?>" frameborder="0" allowtransparency="true" scrolling="no" width="100%" height="480"></iframe>
                                             
										</div>
										<div class="modal-footer">
											<button type="button" class="btn default" data-dismiss="modal">Close</button>
											
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
   								 <!--END Open pdf in modal window-->
                                <?php  } ?>
							
                        </div>
                        		</div>
                                <div class="col-md-6">                           
                           		 <div class="well well-lg">
								<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/loadFormPatientReg/patient_id/<?php echo $_GET['patient_id'] ?>"><img src="themefiles/assets/global/img/form_ok.png"/></a>
								<label style="margin-left: 10px;padding-top:20px;">New-Patient-Registration-Forms</label>
                              <?php 
							  $pdf_name = '';
							  if(isset($formsList['patient_register']) && $formsList['patient_register'] != 0)
							  {
								 $exist_path = 'assets/upload/pdf/'.$formsList['patient_register'];  
								 $pdf_name = $formsList['patient_register']; 
							  }
							  if(isset($formsList['patient_register']) && !empty($formsList['patient_register']) && file_exists($exist_path))
							  {
							  ?> 
                              
                                <a data-toggle="modal" data-target=".modal-patient-reg" title="Edit" style="margin-left:20px;" href="#"><i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp;           
                         <!--Open pdf in modal window-->
   						 <div class="modal fade modal-patient-reg" id="basic" tabindex="-1" role="basic" aria-hidden="true" >
  				
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Patient Registration PDF</h4>
										</div>
										<div class="modal-body">
											 
                                   <iframe id="popupload" src="<?php echo Yii::app()->params->base_url;?>assets/upload/pdf/<?php echo $pdf_name ?>" frameborder="0" allowtransparency="true" scrolling="no" width="100%" height="480"></iframe>
                                             
										</div>
										<div class="modal-footer">
											<button type="button" class="btn default" data-dismiss="modal">Close</button>
											
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
   						 <!--END Open pdf in modal window-->
                                
                                <?php  } ?>
							
                        </div>
                        		</div>
                             </div> 
                             
                             <div class="row">
                             	<div class="col-md-6">                           
                           		 <div class="well well-lg">
								<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/loadPatinetInfoQuestionnaire/patient_id/<?php echo $_GET['patient_id'] ?>"><img src="themefiles/assets/global/img/form_ok.png"/></a>
								<label style="margin-left: 10px;padding-top:20px;">Patient Information Questionnaire</label>
                              <?php 
							  $pdf_name = '';
							  if(isset($formsList['patient_questionnaire']) && $formsList['patient_questionnaire'] != 0)
							  {
								 $exist_path = 'assets/upload/pdf/'.$formsList['patient_questionnaire'];  
								 $pdf_name = $formsList['patient_questionnaire']; 
							  }
							  if(isset($formsList['patient_questionnaire']) && !empty($formsList['patient_questionnaire']) && file_exists($exist_path))
							  {
							  ?> 
                              
                                <a data-toggle="modal" data-target=".modal-patient-que" title="Edit" style="margin-left:20px;" href="#"><i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp;           
                         <!--Open pdf in modal window-->
   						 <div class="modal fade modal-patient-que" id="basic" tabindex="-1" role="basic" aria-hidden="true" >
  				
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Patient Registration PDF</h4>
										</div>
										<div class="modal-body">
											 
                                   <iframe id="popupload" src="<?php echo Yii::app()->params->base_url;?>assets/upload/pdf/<?php echo $pdf_name ?>" frameborder="0" allowtransparency="true" scrolling="no" width="100%" height="480"></iframe>
                                             
										</div>
										<div class="modal-footer">
											<button type="button" class="btn default" data-dismiss="modal">Close</button>
											
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
   						 <!--END Open pdf in modal window-->
                                
                                <?php  } ?>
							
                        </div>
                        		</div>
                                
                             </div>  
                         <?php } else {  ?>
                         	
                             <div>You have not permission to view documents.</div>
                         <?php } ?>    
							<input type="hidden" id="patient_id" value="<?php $_REQUEST['patient_id'] ?>" >	
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
	</div>
    
    
    
    
      