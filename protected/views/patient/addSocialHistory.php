<script>
   
   
   
   $(document).ready(function(){
	   
	   
   					var employed =   $('#employed').prop('checked');
					$('#employed').on('switchChange.bootstrapSwitch', function () { 

						if($('#employed').bootstrapSwitch('state') == true)
						{
							$('#occupation').removeAttr('readonly');							
						}
						else
						{
							$('#occupation').attr('readonly', 'true');							
						}
					});
					
					
					if(4 == $("input[name=live]:radio").val())
					{
					 	   $('#live_div').show();
					 }
					  else
					  {
						   $('#live_div').hide();
					   }
					  
				  
					
					var children =   $('#children').prop('checked');
					$('#children').on('switchChange.bootstrapSwitch', function () {

						if($('#children').bootstrapSwitch('state') == true)
						{
							$('#how_many').removeAttr('readonly');							
						}
						else
						{
							$('#how_many').attr('readonly', 'true');							
						}
					});
				   
				    
					 var use_alcohol =   $('#use_alcohol').prop('checked');
					$('#use_alcohol').on('switchChange.bootstrapSwitch', function () {
							//alert($('#use_alcohol').bootstrapSwitch('state'));
						if($('#use_alcohol').bootstrapSwitch('state') == true)
						{
							$('#how_often_div').show("slow");
							$('#alcohol').show('slow');							
						}
						else
						{
							$('#how_often_div').hide();	
							$('#alcohol').show('hide');							
						}
					});
					
					
					 var smoker =   $('#smoker').prop('checked');
					$('#smoker').on('switchChange.bootstrapSwitch', function () {

						if($('#smoker').bootstrapSwitch('state') == true)
						{
							$('#no_of_pack').removeAttr('readonly');
							$('#years').removeAttr('readonly');
							$('#when_quit').attr('readonly', 'true');
							
									
						}
						else
						{
							$('#no_of_pack').attr('readonly', 'true');
							$('#years').attr('readonly', 'true');
							$('#when_quit').removeAttr('readonly');							
						}
					});
					
					$("input[name=live]:radio").change(function () {
					   if(this.value == 4)
					   {
						   $('#live_div').show();
					   }
					   else
					   {
						   $('#live_div').hide();
					   }
					  
				  });
				
	});				
</script>
<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Social History
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                         <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                              <?php if(isset($socialData['patient_social_history_id']) && $socialData['patient_social_history_id']!=''){ ?>
                            Update Social History
                              <?php } else { ?>
                            Add Social History
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="MedicalHistoryDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-ticket"></i>
                                <?php if(isset($socialData['patient_social_history_id']) && $socialData['patient_social_history_id']!=''){ ?>
                            Update Social History
                               <?php } else { ?>
                              Add Social History
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							
                            <div class="main">
            <div class="container patientInfo">
                <!-- BEGIN SIDEBAR & CONTENT -->
                
                    <div class="row">&nbsp;</div>
                    <!-- BEGIN CONTENT -->
                    <form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveSocialHistory" id="form_medication" method="post">
                    <div class="col-md-10 col-sm-10 col-md-offset-2 col-sm-offset-2">
                        	<div class="content-form-page">
                            <div class="row">
                            
                            <div class="row">
                                <div class="form-group">
                                  <div class="col-sm-3 topmargin">
                                    <label for="exampleInputName2">Employed? &nbsp; </label>
                                   
                                    <input type="checkbox" data-size="normal" class="make-switch" <?php if(isset($socialData['employed']) && $socialData['employed'] == '1') { ?> checked="checked" <?php  } ?> name="employed" id="employed" value="1">	
                                           
                                  </div>
                                  <label class="col-sm-2" for="exampleInputName2">Most recent Occupation: &nbsp; </label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control"  name="occupation" id="occupation" placeholder="Most recent Occupation:" <?php if(isset($socialData['employed']) && $socialData['employed'] == '0') { ?> readonly="readonly" <?php } ?> value="<?php if(isset($socialData['occupation']) && $socialData['occupation'] != '') { echo $socialData['occupation']; } ?>">				
                                  </div>
                            </div>
                            </div> 
                            <div class="row">&nbsp;</div>   
                            <div class="row">
                                <div class="form-group">
                                  <div class="col-sm-3 topmargin">
                                    <label for="exampleInputName2">Children? &nbsp; </label>
                                       <input type="checkbox" data-size="normal" class="make-switch" name="children"  id="children" <?php if(isset($socialData['children']) && $socialData['children'] == '1') { ?> checked="checked" <?php  } ?> value="1">        
                                  </div>
                                  <label class="col-sm-2" for="exampleInputName2">If yes, how many/ages? &nbsp; </label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" name="how_many" id="how_many" placeholder="If yes, how many/ages?" <?php if(isset($socialData['children']) && $socialData['children'] == '0') { ?> readonly="readonly" <?php } ?> value="<?php if(isset($socialData['how_many']) && $socialData['how_many'] != '') { echo $socialData['how_many'];  } ?>">
                                  </div>
                            </div>
                            </div> 
                            <div class="row">&nbsp;</div>   
                            <div class="row">
                                <div class="form-group">
                                  <div class="col-sm-12 topmargin">
                                    <label for="exampleInputName2">Do you live: &nbsp; </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="live" <?php if(isset($socialData['live']) && $socialData['live'] == '1') { ?> checked="checked" <?php  } ?>  value="1">
                                      Alone</label>
                                    <label class="radio-inline">
                                      <input type="radio" name="live" <?php if(isset($socialData['live']) && $socialData['live'] == '2') { ?> checked="checked" <?php  } ?>  value="2">
                                     Spouse</label>  
                                     <label class="radio-inline">
                                      <input type="radio" name="live" <?php if(isset($socialData['live']) && $socialData['live'] == '3') { ?> checked="checked" <?php  } ?>  value="3">
                                     Nursing Facility</label>
                                     &nbsp;
                                      <label class="radio-inline">
                                     <input type="radio" name="live" <?php if(isset($socialData['live']) && $socialData['live'] == '4') { ?> checked="checked" <?php  } ?>  value="4">
                                     Other</label>            
                                  </div>
                                  
                                  <div id="live_div"><label class="col-sm-1" for="exampleInputName2">Other	 &nbsp; </label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control" name="live_other" id="live_other" placeholder="Other" value="<?php if(isset($socialData['live_other']) && $socialData['live_other'] != '') { echo $socialData['live_other'];  } ?>">
                                  </div></div>
                            </div>
                            </div>
                            <div class="row">&nbsp;</div>  
                            <div class="row">
                                <div class="form-group">
                                  <div class="col-sm-11 topmargin">
                                    <label for="exampleInputName2">Are you at risk for AIDs? &nbsp; </label>
                                        <input type="checkbox" name="aids" id="aids" <?php if(isset($socialData['aids']) && $socialData['aids'] == '1') { ?> checked="checked" <?php  } ?> value="1">               
                                  </div>          
                            </div>
                            </div>
                            <div class="row">&nbsp;</div>
                            <div class="row">
                            
                            <label class="col-md-4" for="exampleInputName2">Do you have a history of: Substance abuse/Type? &nbsp; </label>
                            
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="abuse_type" id="abuse_type" placeholder="Do you have a history of: Substance abuse/Type?" value="<?php if(isset($socialData['abuse_type']) && $socialData['abuse_type'] != '') { echo $socialData['abuse_type'];  } ?>">
                                  </div>
                            </div>
                             <div class="row">&nbsp;</div>   
                            
                            <div class="row">
                                <div class="form-group">
                                  <div class="col-sm-12 topmargin">
                                    <label for="exampleInputName2">Do you currently use alcohol? &nbsp; </label>
                                      <input type="checkbox" data-size="normal" class="make-switch" name="use_alcohol"  id="use_alcohol" <?php if(isset($socialData['use_alcohol']) && $socialData['use_alcohol'] == '1') { ?> checked="checked" <?php  } ?> value="1">                      
                                  </div>          
                            </div>
                            </div>
                            
                            <div class="row">&nbsp;</div>
                            
                            <div class="row" id="how_often_div">
                                <div class="form-group">
                                  <div class="col-sm-12 topmargin" id="alcohol" <?php if(isset($socialData['use_alcohol']) && $socialData['use_alcohol'] == '0') { ?> style="display:none;" <?php } ?>>
                                    <label for="exampleInputName2">If yes, how often: &nbsp; </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="how_often" <?php if(isset($socialData['how_often']) && $socialData['how_often'] == '0') { ?> checked="checked" <?php  } ?>  value="0">
                                      Never</label>
                                    <label class="radio-inline">
                                      <input type="radio" name="how_often" <?php if(isset($socialData['how_often']) && $socialData['how_often'] == '1') { ?> checked="checked" <?php  } ?>  value="1">
                                     Rarely</label>   
                                     <label class="radio-inline">
                                      <input type="radio" name="how_often" <?php if(isset($socialData['how_often']) && $socialData['how_often'] == '2') { ?> checked="checked" <?php  } ?>   value="2">
                                     Weekends</label>                  
                                       <label class="radio-inline">
                                      <input type="radio" name="how_often" <?php if(isset($socialData['how_often']) && $socialData['how_often'] == '3') { ?> checked="checked" <?php  } ?>   value="3">
                                     Heavy</label> 
                                       <label class="radio-inline">
                                      <input type="radio" name="how_often" <?php if(isset($socialData['how_often']) && $socialData['how_often'] == '4') { ?> checked="checked" <?php  } ?>   value="4">
                                     No Comment</label> 
                                  </div>          
                            </div>
                            </div>
                            
                             <div class="row">&nbsp;</div>
                            <div class="row controlled-substance-contract">
                                 <div class="form-group">
                                  <div class="col-sm-12 topmargin">
                                    <label for="exampleInputName2">Are you a smoker? &nbsp; </label>
                                     <input type="checkbox"  data-size="normal" class="make-switch" name="smoker" id="smoker" <?php if(isset($socialData['smoker']) && $socialData['smoker'] == '1') { ?> checked="checked" <?php  } ?>  value="1">     
                                  </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                  
                                  
                                  <div class="col-sm-3 topmargin">
                                    <label for="exampleInputName2">If yes, Packs per day for &nbsp;</label>
                                     <input type="text" class="form-control groupOfTexbox" name="no_of_pack" id="no_of_pack"  placeholder="If yes, Packs per day for" <?php if(isset($socialData['smoker']) && $socialData['smoker'] == '0') { ?> readonly="readonly" <?php } ?> value="<?php if(isset($socialData['no_of_pack']) && $socialData['no_of_pack'] != '') { echo $socialData['no_of_pack'];} ?>">
                                  </div>
                                  <div class="col-sm-3">
                                     <label for="exampleInputName2">Packs per day for  years&nbsp;</label>
                                    <input type="text" class="form-control groupOfTexbox" name="years" id="years" placeholder="years" <?php if(isset($socialData['smoker']) && $socialData['smoker'] == '0') { ?> readonly="readonly" <?php } ?> value="<?php if(isset($socialData['years']) && $socialData['years'] != '') { echo $socialData['years'];} ?>">
                                  </div>
                                  <div class="col-sm-3">
                                   <label for="exampleInputName2">If no, when did you quit? </label>
                                   
                                    <input type="text"  class="form-control form-control-inline input date-picker"  data-date-format="mm/dd/yyyy" data-date-end-date="+0d" readonly="readonly" name="when_quit" id="when_quit" placeholder="If you quit, when did you quit?" <?php if(isset($socialData['when_quit']) && $socialData['smoker'] == '1') { ?> readonly="readonly" <?php } ?> value="<?php 
					if(isset($socialData['when_quit']) && ($socialData['when_quit'])!='') 
					{ echo date("m/d/Y",strtotime($socialData['when_quit'] )) ;
					} else { echo date("m/d/Y"); }
					?>">
                                  </div>
                                </div>
                            </div>
                         </div>
                         
                         
                         
                         
                         
                        
                      <div align="center" class="loading" id="loading"></div>

                       <div class="row"> &nbsp; </div> 
                       <div class="row"> &nbsp; </div>
					   <div style="clear:both;"></div>
					</div>
                      
                    <!-- END CONTENT -->
           </div>     
                <!-- END SIDEBAR & CONTENT -->
            </div>
             <div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-4">
                                    
                                    <input type="hidden" name="patient_social_history_id" value="<?php if(isset($socialData['patient_social_history_id'])) { echo $socialData['patient_social_history_id']; } ?>"  />
                                    
									<button type="submit" name="saveSocialHistory" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Cancel</a>
									</div>
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
	