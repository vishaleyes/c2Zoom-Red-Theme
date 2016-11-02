<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Weight?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteWeight/weight_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
	<div id="weightDiv">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Weight
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
                            <i class="fa fa-angle-right "></i>
							Measurements
                            <i class="fa fa-angle-right "></i>
							Weight</a>
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
						                       <div>
                            <a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addWeight"><i class="fa fa-plus"></i>&nbsp;Add</a>
                            </div>
                            
                          <br />
                        
                        
							<table class="table table-striped table-hover" id="sample_cholesterol">
							<thead>
							<tr>
                             	<th>
									 When
								</th>
								<th>
									 Weight
								</th>
								<th>
									Unit
								</th>
                                <th>
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							
                            <?php
							foreach($weightList as $row)
							{
							?>
                           
							<tr>
                            	<?php
										if(trim($row['report_date']) != "" ) 
											  {
												  $report_date = date("m/d/Y",strtotime($row['report_date'])) ; 
												  $report_date_style = "text-align:left";
											  } 
											 else 
											 { 
												  $report_date = "" ;
												  $report_date_style = "text-align:center";
											 } 
									?>
								<td>
                                     <?php echo $report_date;  ?> 
								</td>
                           
                            		
                                <?php
										if(trim($row['weight_value']) != "" ) 
											  {
												  $weight_value = $row['weight_value'] ;
												   $weight_value_style = "text-align:left"; 
											  } 
											 else 
											 { 
												  $weight_value = "" ;
												   $weight_value_style = "text-align:center";
											 } 
									?>
								<td>
									 <?php echo $weight_value; ?>
								</td>
                                 <?php
										if(trim($row['unit']) != "" ) 
											  {
												  if($row['unit']==0)
												  { $unit = 'lbs' ; }
												  if($row['unit']==1)
												  { $unit = 'kg' ; }
												   
												   $unit_style = "text-align:left";  
											  } 
											 else 
											 { 
												  $unit = "" ;
												   $unit_style = "text-align:center"; 
											 } 
									?>
								<td>
									 <?php echo $unit; ?>
								</td>
                                
                                <td>
                                
                                <div class="btn-group"> 
                    <!-- Single button -->
                    <ul class="nav pull-right">
                      <li id="fat-menu" class="dropdown"><span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                          <li role="presentation"><a data-toggle="modal" href="#basic<?php echo $row['weight_id']; ?>">View</a></li>
                          <li role="presentation"><a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addWeight/weight_id/<?php echo $row['weight_id']; ?>">Edit</a></li>
                          <li role="presentation"><a title="Delete" onclick="confirmDelete(<?php echo $row['weight_id']; ?>)" href="#" >Delete</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="modal fade" id="basic<?php echo $row['weight_id']; ?>" tabindex="-1" role="basic" aria-hidden="true" >
  				
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Weight Details</h4>
										</div>
										<div class="modal-body">
											 
                                             <table class="model_table" width="100%">
                                             
                                             <tr>
                                                 <th>Weight</th>
												<td style="text-align:left">
													  <?php echo $weight_value; ?>
												</td>
                                             </tr>
                                             <tr>
                                                 <th>Unit</th>
												<td style="text-align:left">
													  <?php echo $unit; ?>
												</td>
                                             </tr>
                                             
                                              <tr>
                                                 <th width="30%">When</th>
												<td width="70%" style="text-align:left">
													 <?php echo $report_date;  ?> 
												</td>
                                             </tr>
                                             <tr>
                                                 <th>Notes</th>
                                                  <?php
														if(trim($row['notes']) != "" ) 
															  {
																  $notes = $row['notes'] ;
																  $notes_style = "text-align:left";   
															  } 
															 else 
															 { 
																  $notes = "" ;
																  $notes_style = "text-align:left";  
															 } 
													?>
												<td style=" <?php echo $notes_style; ?> ">
													  <?php echo $notes; ?>
												</td>
                                             </tr>
                                             
                                                <?php
												if(trim($row['created_at']) != "" ) 
												{ $created_at = date("m/d/Y h:i A",strtotime($row['created_at']));} 
												else 
												{ $created_at = "" ; } 
											?>
                                             <tr>
                                                 <th>Created Date</th>
												 <td style="text-align:left">
													  <?php echo $created_at; ?>
												 </td>
                                             </tr>
                                             
                                             <?php
												if(trim($row['modified_at']) != "" ) 
												{ $modified_at = date("m/d/Y h:i A",strtotime($row['modified_at']));} 
												else 
												{ $modified_at = "" ; } 
											?>
                                             <tr>
                                                 <th>Modified Date</th>
												 <td style="text-align:left">
													  <?php echo $modified_at; ?>
												 </td>
                                             </tr>
                                             
                                             </table>
                                             
										</div>
										<div class="modal-footer">
											<button type="button" class="btn default" data-dismiss="modal">Close</button>
											
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
                                
								</td>
							</tr>
                            
                            <?php } ?>
							
						
							</tbody>
							</table>
						
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
	</div>