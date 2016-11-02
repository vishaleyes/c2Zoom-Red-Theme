<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Cholesterol?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteCholesterol/cholesterol_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
<div id="cholesterolDiv"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row">
    <div class="col-md-12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> Cholesterol </h3>
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i> Measurements <i class="fa fa-angle-right "></i> Cholesterol </li>
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
			<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addCholesterol"><i class="fa fa-plus"></i>&nbsp;Add</a>
		</div>
		<br />
		<table class="table table-striped table-hover" id="sample_cholesterol">
			<thead>
				<tr>
					<th style="text-align: center;">When</th>
					<th style="text-align: center;">LDL</th>
					<th style="text-align: center;">HDL</th>
					<th style="text-align: center;">Triglycerides</th>
					<th style="text-align: center;">Total</th>
					<th style="text-align: center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ( $cholesterolList as $row )
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
									echo date("m/d/Y",strtotime($report_date));
								?>
							</td>
							<td>
								<?php
									if (trim ( $row ['ldl'] ) != "")
									{
										$ldl = $row ['ldl'];
										$ldl_style = "text-align:left";
									}
									else
									{
										$ldl = "";
										$ldl_style = "text-align:center";
									}
									echo $ldl."&nbsp;";
									
									if($row['unit'] == 0)
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
								<?php
									if (trim ( $row ['hdl'] ) != "")
									{
										$hdl = $row ['hdl'];
										$hdl_style = "text-align:left";
									}
									else
									{
										$hdl = "";
										$hdl_style = "text-align:center";
									} 
									echo $hdl."&nbsp;";
									if($row['unit'] == 0)
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
								<?php
									if (trim ( $row ['triglycerides'] ) != "")
									{
										$triglycerides = $row ['triglycerides'];
										$triglycerides_style = "text-align:left";
									}
									else
									{
										$triglycerides = "";
										$triglycerides_style = "text-align:center";
									} 
									echo $triglycerides."&nbsp;";
									if($row['unit'] == 0)
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
								<?php
									if (trim ( $row ['total'] ) != "")
									{
										$total = $row ['total'];
										$total_style = "text-align:left";
									}
									else
									{
										$total = "";
										$total_style = "text-align:center";
									} 
									echo $total."&nbsp;";
									if($row['unit'] == 0)
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
								<div class="btn-group">
									<ul class="nav pull-right">
										<li id="fat-menu" class="dropdown">
											<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
											<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
												<li role="presentation"><a data-toggle="modal" href="#basic<?php echo $row['cholesterol_id'] ?>">View</a></li>
												<li role="presentation"><a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addCholesterol/cholesterol_id/<?php echo $row['cholesterol_id'] ?>">Edit</a></li>
												<li role="presentation"><a title="Delete" onclick="confirmDelete(<?php echo $row['cholesterol_id'] ?>)" href="#">Delete</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class="modal fade" id="basic<?php echo $row['cholesterol_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
												<h4 class="modal-title">Cholesterol Details</h4>
											</div>
											<div class="modal-body">
												<table class="model_table" width="100%">
													<tr>
														<th width="30%">When</th>
														<td width="70%" style="text-align: left;"><?php echo $report_date;  ?></td>
													</tr>
													<tr>
														<th>LDL</th>
														<td style="text-align: left;"><?php echo $ldl; ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?></td>
													</tr>
													<tr>
														<th>TDL</th>
														<td style="text-align: left;"><?php echo $hdl; ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?></td>
													</tr>
													<tr>
														<th>Triglycerides</th>
														<td style="text-align: left;"><?php echo $triglycerides; ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?></td>
													</tr>
													<tr>
														<th>Total</th>
														<td style="text-align: left;"><?php echo $total; ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?></td>
													</tr>
													<tr>
														<th>Unit</th>
														<td style="text-align: left;">
															<?php
																if (trim ( $row ['unit'] ) != "")
																{
																	if ($row ['unit'] == 0)
																	{
																		$unit = 'mmol/L';
																	}
																	if ($row ['unit'] == 1)
																	{
																		$unit = 'mg/dL';
																	}
																}
																else
																{
																	$unit = "";
																} 
																echo $unit;
															?>
														</td>
													</tr>
													<tr>
														<th>Notes</th>
														<td style="text-align:left;">
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
																if(trim($row['modified_at']) != "" )
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

