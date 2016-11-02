<script>
function disableCholesterolUnit()
{
	var unit_value = $("#ldl_unit").val();
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
							<a href="#">Measurements</a>
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/cholesterolListing">
							Cholesterol</a>
                             <i class="fa fa-angle-right "></i>
                             <a href="<?php echo Yii::app()->params->base_path ; ?>admin/addCholesterol">
							Add Cholesterol</a>
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
								<i class="fa fa-gittip"></i>Add Cholesterol
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>admin/saveCholesterol" id="form_cholesterol" class="form-horizontal" method="post">
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
                                            <div class="form-group" >
                                                <label class="control-label col-md-4">LDL <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input style="border-color:red" type="text" name="ldl" data-required="1" class="form-control"/>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="ldl_unit" name="ldl_unit" onchange="disableCholesterolUnit()">
                                                   <option value="">Select</option>
                                                    <option value="0">mmol/L</option>
                                                    <option value="1">mg/dL</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Triglycerides <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="triglycerides" data-required="1" class="form-control"/>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="triglycerides_unit" name="triglycerides_unit" disabled="disabled">
                                                    <option value="">Select</option>
                                                    <option value="0">mmol/L</option>
                                                    <option value="1">mg/dL</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
												<label class="control-label col-md-6">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-6">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" autocomplete="off" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" id="when" name="when" type="text" value=""/ >
										
										</div>
											</div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">HDL <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="hdl" data-required="1" class="form-control"/>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="hdl_unit" name="hdl_unit" disabled="disabled">
                                                    <option value="">Select</option>
                                                    <option value="0">mmol/L</option>
                                                    <option value="1">mg/dL</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Total <span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="total" data-required="1" class="form-control"/>
                                                </div>
                                                 <div class="col-md-4">
                                                    <select class="form-control" id="total_unit" name="total_unit" disabled="disabled">
                                                   <option value="">Select</option>
                                                    <option value="0">mmol/L</option>
                                                    <option value="1">mg/dL</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes"></textarea>
                                            </div>
                                            </div>
                                        </div>
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
										<button type="submit" name="saveCholesterol" class="btn green">Submit</button>
										<button type="button" class="btn default">Cancel</button>
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
	