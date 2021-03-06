<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Immunization?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteImmunization/immunization_id/"+id;
		}else{
			return true;
		}
	});
}
</script>
<div id="immunizationDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Immunization</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
					<i class="fa fa-angle-right "></i> Health History 
					<i class="fa fa-angle-right "></i> Immunization
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
				<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addImmunization">
					<i class="fa fa-plus"></i>&nbsp;Add
                    
				</a>
			</div>
			<br />
			<table class="table table-striped table-hover" id="sample_cholesterol">
				<thead>
					<tr>
						<th>Type</th>
						<th>Reason</th>
						<th>Facility</th>
						<th>When</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ( $immunizationList as $row ) 
						{
					?>
							<tr>
								<td>
							 		<?php
								 		if (trim ( $row ['type'] ) != "")
								 		{
								 			$type = $row ['type'];
								 			$type_style = "text-align:left";
								 		}
								 		else
								 		{
								 			$type = "";
								 			$type_style = "text-align:center";
								 		} 
							 			echo $type;
							 		?>
								</td>
								<td>
									 <?php
										 if (trim ( $row ['reason'] ) != "") 
										 {
										 	$reason = $row ['reason'];
										 	$reason_style = "text-align:left";
										 } 
										 else 
										 {
										 	$reason = "";
										 	$reason_style = "text-align:center";
										 } 
									 	echo $reason;
									 ?>
								</td>
								<td>
									 <?php
										 if (trim ( $row ['facility'] ) != "") 
										 {
										 	$facility = $row ['facility'];
										 	$facility_style = "text-align:left";
										 } 
										 else 
										 {
										 	$facility = "";
										 	$facility_style = "text-align:center";
										 } 
									 	echo $facility;
									 ?>
								</td>
								<td>
									 <?php
										 if (trim ( $row ['report_date'] ) != "") 
										 {
										 	$report_date = date ( "m/d/Y", strtotime ( $row ['report_date'] ) );
										 	$report_date_style = "text-align:left";
										 } 
										 else 
										 {
										 	$report_date = "";
										 	$report_date_style = "text-align:center";
										 } 
									 	echo $report_date;
									 ?> 
								</td>
								<td>
									<div class="btn-group">
										<!-- Single button -->
										<ul class="nav pull-right">
											<li id="fat-menu" class="dropdown">
												<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
												<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
													<li role="presentation">
														<a data-toggle="modal" href="#basic<?php echo $row['immunization_id'] ?>">View</a>
													</li>
													<li role="presentation">
														<a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addImmunization/immunization_id/<?php echo $row['immunization_id'] ?>">Edit</a>
													</li>
													<li role="presentation">
														<a title="Delete" onclick="confirmDelete(<?php echo $row['immunization_id'] ?>)" href="#">Delete</a>
													</li>
												</ul>
											</li>
										</ul>
									</div>
									<div class="modal fade" id="basic<?php echo $row['immunization_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h4 class="modal-title">Immunization Details</h4>
												</div>
												<div class="modal-body">
													<table class="model_table" width="100%">
														<tr>
															<th>Immunization Type</th>
															<td style="text-align: left;">
															  <?php echo $type;?>
															</td>
														</tr>
														<tr>
															<th>Reason</th>
															<td style="text-align: left;">
													  			<?php echo $reason;?>
															</td>
														</tr>
														<tr>
															<th>Facility</th>
															<td style="text-align: left;">
											  					<?php echo $facility;?>
															</td>
														</tr>
														<tr>
															<th width="30%">When</th>
															<td width="70%" style="text-align: left;">
																<?php echo $report_date;?> 
															</td>
														</tr>
														<tr>
															<th>Notes</th>
															<td style="text-align: left;">
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
															<td style="text-align: left;">
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
															<td style="text-align: left;">
																<?php
																	if (trim ( $row ['modified_at'] ) != "") 
																	{
																		$modified_at = date ( "m/d/Y h:i A", strtotime ( $row ['modified_at'] ) );
																	} 
																	else 
																	{
																		$modified_at = "";
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