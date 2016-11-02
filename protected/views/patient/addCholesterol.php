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


			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Cholesterol
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
                            Measurements
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/cholesterolListing">
							Cholesterol</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['cholesterol_id']) && $_REQUEST['cholesterol_id']!=''){ ?>
                            Update Cholesterol
                              <?php } else { ?>
                           	Add Cholesterol
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
                                <?php if(isset($_REQUEST['cholesterol_id']) && $_REQUEST['cholesterol_id']!=''){ ?>
                               Update Cholesterol
                               <?php } else { ?>
                                Add Cholesterol
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveCholesterol" id="form_cholesterol" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">LDL <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="ldl" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['ldl']) && ($cholesterolData['ldl'])!='') 
					{ echo $cholesterolData['ldl'] ;
					} 
					?>"/><span class="col-md-6" style="color:red"><?php echo $validationError['ldlErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control groupOfTexbox" id="ldl_unit" name="ldl_unit" onchange="disableCholesterolUnit()" >
                                                   <option value="">Select</option>
                                                    <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                <span class="col-md-6" style="color:red"><?php echo $validationError['ldl_unitErr'] ?></span>
                                                </div>
                                               
                                               
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Triglycerides <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="triglycerides" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['triglycerides']) && ($cholesterolData['triglycerides'])!='') 
					{ echo $cholesterolData['triglycerides'] ;
					} 
					?>"/><span class="col-md-12" style="color:red"><?php echo $validationError['triglyceridesErr'] ?></span>
                                                </div>
                                                
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="triglycerides_unit" name="triglycerides_unit" disabled="disabled">
                                                    <!--<option value="">Select</option>-->
                                                     <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-6">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" readonly="readonly" autocomplete="off" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="when" name="when" type="text" value="<?php 
					if(isset($cholesterolData['report_date']) && ($cholesterolData['report_date'])!='') 
					{ echo date("m/d/Y",strtotime($cholesterolData['report_date'])) ;
					} else { echo date("m/d/Y"); }
					?>"/ >
                     <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">HDL <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="hdl" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['hdl']) && ($cholesterolData['hdl'])!='') 
					{ echo $cholesterolData['hdl'] ;
					} 
					?>"/>  <span class="col-md-6" style="color:red"><?php echo $validationError['hdlErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="hdl_unit" name="hdl_unit" disabled="disabled">
                                                    <!--<option value="">Select</option>-->
                                                     <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Total <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="total" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 0.1" value="<?php 
					if(isset($cholesterolData['total']) && ($cholesterolData['total'])!='') 
					{ echo $cholesterolData['total'] ;
					} 
					?>"/> <span class="col-md-12" style="color:red"><?php echo $validationError['totalErr'] ?></span>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="total_unit" name="total_unit" disabled="disabled">
                                                   <!--<option value="">Select</option>-->
                                                    <option value="0" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==0) 
					{?> selected="selected" <?php } ?> >mmol/L</option>
                                                    <option value="1" <?php 
					if(isset($cholesterolData['unit']) && ($cholesterolData['unit'])==1) 
					{?> selected="selected" <?php } ?> >mg/dL</option>
                                                </select>
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea class="form-control" name="notes" ><?php 
					if(isset($cholesterolData['notes']) && ($cholesterolData['notes'])!='') 
					{ echo $cholesterolData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                        </div>
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="cholesterol_id" value="<?php echo $_REQUEST['cholesterol_id']; ?>"  />
                                    
										<button type="submit" name="saveCholesterol" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/cholesterolListing">Cancel</a>
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
	