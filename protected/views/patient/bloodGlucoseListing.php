<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete BloodGlucose?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteBloodGlucose/blood_glucose_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
	<div id="bloodGlucoseDiv">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Blood Glucose
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
                            <i class="fa fa-angle-right "></i>
							Measurements
                            <i class="fa fa-angle-right "></i>
							Blood Glucose</a>
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
						<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addBloodGlucose"><i class="fa fa-plus"></i>&nbsp;Add</a>
					</div>
					<br/>
					<table class="table table-striped table-hover" id="sample_cholesterol">
						<thead>
							<tr>
								<th>When</th>
								<th>Blood Glucose Level</th>
								<th>Unit</th>
								<th>Measurement Type</th>
								<th>Measurement Context</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ( $bloodGlucoseList as $row )
								{
							?>
									<tr>
										<td>
											<?php echo date("m/d/Y",strtotime($row['report_date']));  ?>
										</td>
										<td>
											<?php echo $row['blood_glucose_level']; ?>
										</td>
										<td>
											<?php 
												if($row['unit']==0)
												{
													echo "mmol/L";
												}
												else
												{
													echo "mg/dL";
												}
											?>
										</td>
										<td>
											<?php  echo $row['measure']; ?>
										</td>
										<td>
											<?php echo $row['context_name']; ?>
										</td>
										<td style="text-align: center">
											<div class="btn-group">
												<ul class="nav pull-right">
													<li id="fat-menu" class="dropdown">
														<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
														<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
															<li role="presentation"><a data-toggle="modal" href="#basic<?php echo $row['blood_glucose_id'] ?>">View</a></li>
															<li role="presentation"><a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addBloodGlucose/blood_glucose_id/<?php echo $row['blood_glucose_id'] ?>">Edit</a></li>
															<li role="presentation"><a title="Delete" onclick="confirmDelete(<?php echo $row['blood_glucose_id'] ?>)" href="#">Delete</a></li>
														</ul>
													</li>
												</ul>
											</div>
											<div class="modal fade" id="basic<?php echo $row['blood_glucose_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
															<h4 class="modal-title">Blood Glucose Details</h4>
														</div>
														<div class="modal-body">
															<table class="model_table" width="100%">
																<tr>
																	<th width="30%">When</th>
																	<td width="70%" style="text-align: left">
																		<?php echo date("m/d/Y",strtotime($row['report_date']));  ?> 
																	</td>
																</tr>
																<tr>
																	<th>Blood Glucose Level</th>
																	<td style="text-align: left">
																		<?php echo $row['blood_glucose_level'];?>
																	</td>
																</tr>
																<tr>
																	<th>Unit</th>
																	<td style="text-align: left">
																		<?php 
																			if($row['unit']==0)
																			{
																				echo "mmol/L";
																			}
																			else
																			{
																				echo "mg/dL";
																			}
																		?>
																	</td>
																</tr>
																<tr>
																	<th>Measurement Type</th>
																	<td style="text-align: left">
																		<?php echo $row['measure']; ?>
																	</td>
																</tr>
																<tr>
																	<th>Measurement Context</th>
																	<td style="text-align: left">
																		<?php echo $row['context_name']; ?>
																	</td>
																</tr>
																<tr>
																	<th>Notes</th>
																	<td style="text-align: left">
																		<?php
																			if (trim ( $row ['notes'] ) != "")
																			{
																				$notes = $row ['notes'];
																			}
																			else
																			{
																				$notes = "";
																			}
																			echo $notes;
																		?>
																	</td>
																</tr>
																<tr>
																	<th>Created Date</th>
																	<td style="text-align: left">
																		<?php
																			if (trim ( $row ['created_at'] ) != "")
																			{
																				$created_at = date ( "m/d/Y h:i A", strtotime ( $row ['created_at'] ) );
																			}
																			else
																			{
																				$created_at = "";
																			}
																			echo $created_at;
																		?>
																	</td>
																</tr>
																<tr>
																	<th>Modified Date</th>
																	<td style="text-align: left">
																		<?php
																			if (trim ( $row ['modified_at'] ) != "")
																			{
																				$modified_at = date("m/d/Y h:i A",strtotime($row['modified_at']));
																			} 
																			else 
																			{
																				$modified_at = "" ;
																			}
																			echo $modified_at;
																		?>
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
  
      