<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Procedure?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteProcedure/procedure_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
<div id="procedureDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Procedure</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
					<i class="fa fa-angle-right "></i> Health History 
					<i class="fa fa-angle-right "></i> Procedure
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
				<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addProcedure">
					<i class="fa fa-plus"></i>&nbsp;Add
				</a>
			</div>
			<br />
			<table class="table table-striped table-hover"
				id="sample_cholesterol">
				<thead>
					<tr>
						<th>Procedure</th>
						<th>Body Location</th>
						<th>Provider</th>
						<th>When Performed</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ( $procedureList as $row ) 
						{
					?>
							<tr>
								<td>
									<?php
										if (trim ( $row ['name'] ) != "") 
										{
											$name = $row ['name'];
											$name_style = "text-align:left";
										} 
										else 
										{
											$name = "";
											$name_style = "text-align:center";
										}
										echo $name;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['body_location'] ) != "") 
										{
											$body_location = $row ['body_location'];
											$body_location_style = "text-align:left";
										} 
										else 
										{
											$body_location = "";
											$body_location_style = "text-align:center";
										}
										echo $body_location;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['provider'] ) != "") 
										{
											$provider = $row ['provider'];
											$provider_style = "text-align:left";
										} 
										else 
										{
											$provider = "";
											$provider_style = "text-align:center";
										}
										echo $provider;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['when_performed'] ) != "") 
										{
											$when_performed = date ( "m/d/Y", strtotime ( $row ['when_performed'] ) );
											$when_performed_style = "text-align:left";
										} 
										else 
										{
											$when_performed = "";
											$when_performed_style = "text-align:center";
										}
										echo $when_performed;
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
														<a data-toggle="modal" href="#basic<?php echo $row['procedure_id']; ?>">View</a>
													</li>
													<li role="presentation">
														<a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addProcedure/procedure_id/<?php echo $row['procedure_id']; ?>">Edit</a>
													</li>
													<li role="presentation">
														<a title="Delete" onclick="confirmDelete(<?php echo $row['procedure_id']; ?>)" href="#">Delete</a>
													</li>
												</ul>
											</li>
										</ul>
									</div>
									<div class="modal fade" id="basic<?php echo $row['procedure_id']; ?>" tabindex="-1" role="basic" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h4 class="modal-title">Procedure Details</h4>
												</div>
												<div class="modal-body">
													<table class="model_table" width="100%">
													<tr>
														<th>Procedure Name</th>
														<td style="text-align: left;">
															<?php echo $name;?>
														</td>
													</tr>
													<tr>
														<th>Body Location</th>
														<td style="text-align: left;">
											  				<?php echo $body_location;?>
														</td>
													</tr>
													<tr>
														<th>Provider</th>
														<td style="text-align: left;">
											  				<?php echo $provider;?>
														</td>
													</tr>
													<tr>
														<th width="30%">When Performed</th>
														<td width="70%" style="text-align: left;">
															<?php echo $when_performed;?> 
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