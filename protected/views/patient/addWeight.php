	<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Weight
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Measurements
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/weightListing">
							Weight</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['weight_id']) && $_REQUEST['weight_id']!=''){ ?>
                            Update Weight
                              <?php } else { ?>
                            Add Weight
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="WeightDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-tachometer"></i>
                                <?php if(isset($_REQUEST['weight_id']) && $_REQUEST['weight_id']!=''){ ?>
                            Update Weight
                               <?php } else { ?>
                              Add Weight
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveWeight" id="form_weight" class="form-horizontal" method="post">
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
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" autocomplete="off" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" data-date-start-date="-105y" readonly="readonly" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($weightData['report_date']) && ($weightData['report_date'])!='') 
					{ echo date("m/d/Y",strtotime($weightData['report_date']));
					} else { echo date("m/d/Y"); }
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                         
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Weight<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-3">                                                	
                                                		<span class="col-md-6 nopadding">
	                                                    <input type="text" name="weight_value" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 52" value="<?php 
						if(isset($weightData['weight_value']) && ($weightData['weight_value'])!='') 
						{ echo $weightData['weight_value'] ;
						} 
						?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['weight_valueErr'] ?></span>
														</span>													
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" id="unit" name="unit" >                                                     
                                                     <option value="0" <?php 
					if((isset($weightData['unit']) && ($weightData['unit'])==0) || $weightData['unit'] == '') 
					{?> selected="selected" <?php } ?> >lbs</option>
                                                    <option value="1" <?php 
					if(isset($weightData['unit']) && ($weightData['unit'])==1) 
					{?> selected="selected" <?php } ?> >kg</option>
                   									
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                                
                                                <label class="control-label col-md-4"></label>
                                                <div class="col-md-3 <?php echo ($weightData['unit'] == 0 || $weightData['unit'] == '' ? '' : 'hide')?>" id="oz_div">
                                                    <span class="col-md-6 nopadding"><input type="text" name="oz_value" class="form-control groupOfTexbox" placeholder="oz " value="<?php echo $weightData['oz_value'];?>"></span>
                                                    <span class="col-md-6 padding7px">(oz)</span>
                                                </div>
                                                <div class="col-md-3 <?php echo ($weightData['unit'] == 1 ? '' : 'hide')?>" id="gm_div">
                                                    <span class="col-md-6 nopadding"><input type="text" name="gm_value" class="form-control groupOfTexbox" placeholder="gm" value="<?php echo $weightData['gm_value'];?>"></span>
                                                    <span class="col-md-6 padding7px">(gm)</span> 				                                 	
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea rows="3" class="form-control" name="notes" ><?php 
					if(isset($weightData['notes']) && ($weightData['notes'])!='') 
					{ echo $weightData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="weight_id" value="<?php echo $_REQUEST['weight_id']; ?>"  />
                                    
										<button type="submit" name="saveWeight" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/WeightListing">Cancel</a>
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
$('#unit').click(function(){
	if($(this).val() == 0) {
		$('#gm_div').addClass('hide');
		$('#oz_div').removeClass('hide');
	}

	if($(this).val() == 1) {
		$('#oz_div').addClass('hide');
		$('#gm_div').removeClass('hide');		
	}
});

</script>