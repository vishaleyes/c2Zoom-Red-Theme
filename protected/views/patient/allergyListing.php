<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Allergy?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteAllergy/allergy_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
	<div id="allergyDiv">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Allergy
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                            Allergy
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
						<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addAllergy"><i class="fa fa-plus"></i>&nbsp;Add</a>
					</div>
					<br />
					<table class="table table-striped table-hover" id="sample_cholesterol">
						<thead>
							<tr>
								<th>
									Allergy
								</th>
								<th>
									Allergy Type
								</th>
								<th>
									First Observed
								</th>
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($allergyList as $row)
								{
							?>
									<tr>
										<td>
											<?php
												if(trim($row['allergy_name']) != "" ) 
												{
													$allergy_name = $row['allergy_name'] ;
													$allergy_name_style = "text-align:left"; 
												} 
												else 
												{ 
													$allergy_value = "" ;
													$allergy_name_style = "text-align:center";
												} 
											?>
											<?php echo $allergy_name; ?>
										</td>
										<td>
											<?php
												if(trim($row['allergy_master_id']) != "" ) 
												{
													$AllergyMaster = new AllergyMaster();
													$allergy_type = $AllergyMaster->getNameByAllergyMasterId($row['allergy_master_id']);
													$allergy_type_style = "text-align:left"; 
												} 
												else 
												{ 
													$allergy_type = "" ;
													$allergy_type_style = "text-align:center";
												} 
											?>
											<?php echo $allergy_type; ?>
										</td>
										<td>
											<?php
												if(trim($row['first_observed']) != "" ) 
												{
													$first_observed = date("m/d/Y",strtotime($row['first_observed'])) ; 
													$first_observed_style = "text-align:left";
												} 
												else 
												{ 
													$first_observed = "" ;
													$first_observed_style = "text-align:center";
												} 
											?>
											<?php echo date("m/d/Y",strtotime($first_observed));  ?> 
										</td>
										<td>
											<div class="btn-group"> 
												<!-- Single button -->
												<ul class="nav pull-right">
													<li id="fat-menu" class="dropdown"><span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
														<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
															<li role="presentation"><a data-toggle="modal" href="#basic<?php echo $row['allergy_id'] ?>">View</a></li>
															<li role="presentation"><a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addAllergy/allergy_id/<?php echo $row['allergy_id'] ?>">Edit</a></li>
															<li role="presentation"><a title="Delete" onclick="confirmDelete(<?php echo $row['allergy_id'] ?>)" href="#" >Delete</a></li>
														</ul>
													</li>
												</ul>
											</div>  
											<div class="modal fade" id="basic<?php echo $row['allergy_id'] ?>" tabindex="-1" role="basic" aria-hidden="true" >
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
															<h4 class="modal-title">Allergy Details</h4>
														</div>
														<div class="modal-body">
															<table class="model_table" width="100%">
																<tr>
																	<th>Allergy</th>
																	<td style="text-align:left">
																		<?php echo $allergy_name; ?>
																	</td>
																</tr>
																<tr>
																	<th>Allergy Type</th>
																	<td style="text-align:left;">
																		<?php echo $allergy_type; ?>
																	</td>
																</tr>
																<tr>
																	<th>Reaction</th>
																	<td style="text-align:left">
																		<?php
																			if(trim($row['reaction']) != "" )
																			{
																				$reaction = $row['reaction'] ; 
																			} 
																			else 
																			{  
																				$reaction = "" ; 
																			} 
																		?>
																		<?php echo $reaction; ?>
																	</td>
																</tr>
																<tr>
																	<th>Treatment</th>
																	<td style="text-align:left">
																		<?php
																			if(trim($row['treatment']) != "" ) 
																			{ 
																				$treatment = $row['treatment'] ; 
																			} 
																			else 
																			{
																				$treatment = "" ; 
																			} 
																		?>
																		<?php echo $treatment; ?>
																	</td>
																</tr>
																<tr>
																	<th width="30%">First Observed</th>
																	<td width="70%" style="text-align:left">
																		<?php echo $first_observed;  ?> 
																	</td>
																</tr>
																<tr>
																	<th>Notes</th>
																	<td style="text-align:left">
																		<?php
																			if(trim($row['notes']) != "" ) 
																			{ 
																				$notes = $row['notes'] ; 
																			} 
																			else 
																			{  
																				$notes = "" ; 
																			} 
																		?>
																		<?php echo $notes; ?>
																	</td>
																</tr>
																<tr>
																	<th>Created Date</th>
																	<td style="text-align:left">
																		<?php
																			if(trim($row['created_at']) != "" ) 
																			{ 
																				$created_at = date("m/d/Y h:i A",strtotime($row['created_at']));
																			} 
																			else 
																			{ 
																				$created_at = "" ; 
																			} 
																		?>
																		<?php echo $created_at; ?>
																	</td>
																</tr>
																<tr>
																	<th>Modified Date</th>
																	<td style="text-align:left">
																		<?php
																			if(trim($row['modified_at']) != "" ) 
																			{ 
																				$modified_at = date("m/d/Y h:i A",strtotime($row['modified_at']));
																			} 
																			else 
																			{ 
																				$modified_at = "" ; 
																			} 
																		?>
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
							<?php 
								} 
							?>
						</tbody>
					</table>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
	</div>
    
      