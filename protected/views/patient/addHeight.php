	<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Height
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
                            Measurements
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>patient/heightListing">
							Height</a>
                             <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['height_id']) && $_REQUEST['height_id']!=''){ ?>
                            Update Height
                              <?php } else { ?>
                            Add Height
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="HeightDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-arrows-v"></i>
                                <?php if(isset($_REQUEST['height_id']) && $_REQUEST['height_id']!=''){ ?>
                            Update Height
                               <?php } else { ?>
                              Add Height
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveHeight" id="form_height" class="form-horizontal" method="post">
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
                                                <label class="control-label col-md-4">Height<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="height_value" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 5.2" value="<?php 
					if(isset($heightData['height_value']) && ($heightData['height_value'])!='') 
					{ echo $heightData['height_value'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['height_valueErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="unit" name="unit" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($heightData['unit']) && ($heightData['unit'])==0) 
					{?> selected="selected" <?php } ?> >ft</option>
                                                    <option value="1" <?php 
					if(isset($heightData['unit']) && ($heightData['unit'])==1) 
					{?> selected="selected" <?php } ?> >inch</option>
                   									<option value="2" <?php 
					if(isset($heightData['unit']) && ($heightData['unit'])==2) 
					{?> selected="selected" <?php } ?> >cm</option>
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Sub Height<span class="required">
                                                * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="sub_height" data-required="1" class="form-control groupOfTexbox" placeholder="Ex 5.2" value="<?php 
					if(isset($heightData['sub_height']) && ($heightData['sub_height'])!='') 
					{ echo $heightData['sub_height'] ;
					} 
					?>"/ ><span class="col-md-6" style="color:red"><?php echo $validationError['sub_heightErr'] ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="sub_height_unit" name="sub_height_unit" >
                                                     <option value="">Select</option>
                                                     <option value="0" <?php 
					if(isset($heightData['sub_height_unit']) && ($heightData['sub_height_unit'])==0) 
					{?> selected="selected" <?php } ?> >ft</option>
                                                    <option value="1" <?php 
					if(isset($heightData['sub_height_unit']) && ($heightData['sub_height_unit'])==1) 
					{?> selected="selected" <?php } ?> >inch</option>
                   									<option value="2" <?php 
					if(isset($heightData['sub_height_unit']) && ($heightData['sub_height_unit'])==2) 
					{?> selected="selected" <?php } ?> >cm</option>
                                                </select>
                                                 <span class="col-md-6" style="color:red"><?php echo $validationError['sub_height_unitErr'] ?></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
												<label class="control-label col-md-4">When<span class="required">
                                                * </span>
           </label>
												<div class="col-md-8">
											<input class="form-control form-control-inline input date-picker" data-required="1" size="16" autocomplete="off" data-date-start-date="-105y"  data-date-format="mm/dd/yyyy" data-date-end-date="+0d" readonly="readonly" placeholder="Ex. <?php echo date("Y-m-d") ?>" id="report_date" name="report_date" type="text" value="<?php 
					if(isset($heightData['report_date']) && ($heightData['report_date'])!='') 
					{ echo date("m/d/Y",strtotime($heightData['report_date'] )) ;
					} else { echo date("m/d/Y"); }
					?>"/ > <span class="col-md-12" style="color:red"><?php echo $validationError['report_dateErr'] ?></span>
										
										</div>
                                        
											</div>
                                            
                                            <div class="form-group">
                                            <label class="control-label col-md-4">Notes</label>
                                            <div class="col-md-8">
                                                 <textarea class="form-control" name="notes" ><?php 
					if(isset($heightData['notes']) && ($heightData['notes'])!='') 
					{ echo $heightData['notes'] ;
					} 
					?></textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        
                                   
                                    </div>
									
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="height_id" value="<?php echo $_REQUEST['height_id']; ?>"  />
                                    
										<button type="submit" name="saveHeight" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/heightListing">Cancel</a>
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
	