<script>

$( document ).ready(function() {
    var unit_value = $( "#ldl_unit option:selected" ).val();
	
	$("#hdl_unit").val(unit_value);
	$("#triglycerides_unit").val(unit_value);
	$("#total_unit").val(unit_value);
});

function disableCholesterolUnit()
{
	var unit_value = $( "#ldl_unit option:selected" ).val();
	$("#hdl_unit").val(unit_value);
	$("#triglycerides_unit").val(unit_value);
	$("#total_unit").val(unit_value);
}
</script>

<script type="text/javascript" >
function validateForm()
{
	
	var Year = document.getElementById('Year').value;
	
	if(Year=='')
	{
		$('#yearErr').addClass('false');
		$('#yearErr').html("<i class='icon-close' style='margin-top:3px;'></i> &nbsp;&nbsp;<strong style='color:red;'>Please enter year.</strong>");
		return false;
	}
	else
	{
		$('#yearErr').removeClass();
		$('#yearErr').addClass('true');
		$('#yearErr').html('<i class="fa fa-check-circle" style="margin-top:3px; color:green;"></i> &nbsp;&nbsp;<strong style="color:green;">Ok.</strong>');
	}
	
	var surgeon = document.getElementById('surgeon').value;
	
	if(surgeon=='')
	{
		$('#surgeonErr').addClass('false');
		$('#surgeonErr').html("<i class='icon-close' style='margin-top:3px;'></i> &nbsp;&nbsp;<strong style='color:red;'>Please enter surgeon.</strong>");
		return false;
	}
	else
	{
		$('#surgeonErr').removeClass();
		$('#surgeonErr').addClass('true');
		$('#surgeonErr').html('<i class="fa fa-check-circle" style="margin-top:3px; color:green;"></i> &nbsp;&nbsp;<strong style="color:green;">Ok.</strong>');
	}	
	
}
</script>


			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Anesthesia History
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/anethesiaHistoryListing">
							Anesthesia History</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['patient_anethesia_id']) && $_REQUEST['patient_anethesia_id']!=''){ ?>
							Update Anesthesia History
                              <?php } else { ?>
                             
							Add Anesthesia History
                            <?php } ?>
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
								<i class="fa fa-gittip"></i>
                                <?php if(isset($surgoryData['patient_anethesia_id']) && $surgoryData['patient_anethesia_id']!=''){ ?>
                               Update Anesthesia History
                               <?php } else { ?>
                                Add Anesthesia History
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form id="form_anesthesia" action="<?php echo Yii::app()->params->base_path ; ?>patient/saveAnethesia" class="form-horizontal" method="post">
								<div class="form-body">
					
                    
                    <div class="form-group">
                        <label for="anethesia_type" class="col-lg-3 control-label">Anesthesia Type <span class="require">*</span></label>
                        <div class="col-lg-5">
                             <input type="text" class="form-control" name="anethesia_type" id="anethesia_type" placeholder="Anesthesia Type" value="<?php if(isset($anaesthesiaData['anethesia_type'])){ echo $anaesthesiaData['anethesia_type']; } ?>">
                                </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="surname" class="col-lg-3 control-label">When <span class="require">*</span></label>
                        <div class="col-lg-5">
                          <input type="text" class="form-control form-control-inline input date-picker" name="report_date" autocomplete="off" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" readonly="readonly" id="report_date" placeholder="Report Date" required  value="<?php if(isset($anaesthesiaData['anethesia_type'])){ echo date("m/d/Y",strtotime($anaesthesiaData['report_date'])); }else { echo date("m/d/Y"); } ?>"/>
                                </div>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="col-lg-3 control-label">Reaction <span class="require">*</span></label>
                        <div class="col-lg-5">
                             <input type="text" class="form-control" name="reaction" id="reaction" placeholder="Reaction" required  value="<?php if(isset($anaesthesiaData['reaction'])){ echo $anaesthesiaData['reaction']; } ?>"/>
                                </div>
                    </div>

					 <div class="form-group">
                        <label class="control-label col-md-3">Notes</label>
                        <div class="col-md-5">
                             <textarea rows="3" class="form-control" id="notes" name="notes"><?php if(isset($anaesthesiaData['notes'])){ echo $anaesthesiaData['notes']; } ?></textarea>
                        </div>
                        </div>
          </div>

            <div class="form-actions fluid">

                <div class="col-md-offset-2 col-md-10" >
                
               			 
               <div class="row"> &nbsp;</div> 
              
                              <input type="hidden" name="patient_anethesia_id" id="patient_anethesia_id" value="<?php if(isset($anaesthesiaData['patient_anethesia_id'])){ echo $anaesthesiaData['patient_anethesia_id']; } ?>"/>
                              <button type="submit" name="submitAnethesia" class="btn green">Save</button>
							  
                              <button type="button"  id="btncancel" onclick="window.location.href='<?php echo Yii::app()->params->base_path ; ?>patient/anaesthesiaListing'" class="btn red">Cancel</button>
                                                    
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
	