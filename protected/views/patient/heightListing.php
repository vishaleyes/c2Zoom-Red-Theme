<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Height?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteHeight/height_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>	
<div id="heightDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				Height
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
					<i class="fa fa-angle-right "></i>
					Measurements
	                <i class="fa fa-angle-right "></i>
					Height
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
				<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addHeight"><i class="fa fa-plus"></i>&nbsp;Add</a>
			</div>
			<br />
			<table class="table table-striped table-hover" id="sample_cholesterol">
				<thead>
					<tr>
						<th>When</th>
						<th>Height</th>
						<th>Unit</th>
						<th>Sub Height</th>
						<th>Sub Height Unit</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ( $heightList as $row )
						{
					?>
							<tr>
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
										echo date ( "m/d/Y", strtotime ( $report_date ) );
									?> 
								</td>
								<td>
									<?php
										if (trim ( $row ['height_value'] ) != "")
										{
											$height_value = $row ['height_value'];
											$height_value_style = "text-align:left";
										}
										else
										{
											$height_value = "";
											$height_value_style = "text-align:center";
										} 
										echo $height_value;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['unit'] ) != "")
										{
											if ($row ['unit'] == 0)
											{
												$unit = 'ft';
											}
											if ($row ['unit'] == 1)
											{
												$unit = 'inch';
											}
											if ($row ['unit'] == 2)
											{
												$unit = 'cm';
											}
											$unit_style = "text-align:left";
										}
										else
										{
											$unit = "";
											$unit_style = "text-align:center";
										} 
										echo $unit;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['sub_height'] ) != "") 
										{
											$sub_height = $row ['sub_height'];
											$sub_height_style = "text-align:left";
										} 
										else 
										{
											$sub_height = "";
											$sub_height_style = "text-align:center";
										} 
										echo $sub_height;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['sub_height_unit'] ) != "")
										{
											if ($row ['sub_height_unit'] == 0)
											{
												$sub_height_unit = 'ft';
											}
											if ($row ['sub_height_unit'] == 1)
											{
												$sub_height_unit = 'inch';
											}
											if ($row ['sub_height_unit'] == 2)
											{
												$sub_height_unit = 'cm';
											}
											$sub_height_unit_style = "text-align:left";
										}
										else
										{
											$sub_height_unit = "";
											$sub_height_unit_style = "text-align:center";
										} 
										echo $sub_height_unit;
									?>
								</td>
								<td>
									<div class="btn-group">
										<!-- Single button -->
										<ul class="nav pull-right">
											<li id="fat-menu" class="dropdown"><span id="drop3" role="button"
												class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
												<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
													<li role="presentation"><a data-toggle="modal"
														href="#basic<?php echo $row['height_id'] ?>">View</a></li>
													<li role="presentation"><a title="Edit"
														href="<?php echo Yii::app()->params->base_path ; ?>patient/addHeight/height_id/<?php echo $row['height_id'] ?>">Edit</a></li>
													<li role="presentation"><a title="Delete"
														onclick="confirmDelete(<?php echo $row['height_id'] ?>)"
														href="#">Delete</a></li>
												</ul></li>
										</ul>
									</div>
									<div class="modal fade" id="basic<?php echo $row['height_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h4 class="modal-title">Height Details</h4>
												</div>
												<div class="modal-body">
													<table class="model_table" width="100%">
														<tr>
															<th>Height Value</th>
															<td style="text-align: left;">
																<?php echo $height_value;?>
															</td>
														</tr>
														<tr>
															<th>Unit</th>
															<td style="text-align: left;">
																<?php echo $unit;?>
															</td>
														</tr>
														<tr>
															<th>Sub Height</th>
															<td style="text-align: left;">
																<?php echo $sub_height;?>
															</td>
														</tr>
														<tr>
															<th>Sub Height Unit</th>
															<td style="text-align: left;">
																<?php echo $sub_height_unit;?>
															</td>
														</tr>
														<tr>
															<th width="30%">When</th>
															<td width="70%" style="text-align: left;">
																<?php echo $report_date; ?>
															</td>
														</tr>
														<tr>
															<th>Notes</th>
															<td style="text-align: left;">
																<?php
																	if (trim ( $row ['notes'] ) != "")
																	{
																		$notes = $row ['notes'];
																	} else {
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
																		$modified_at = date ( "m/d/Y h:i A",strtotime($row['modified_at']));
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