<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Cholesterol?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>doctor/deleteCholesterol/cholesterol_id/"+id;
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
			<h3 class="page-title">Cholesterol</h3>
			<ul class="page-breadcrumb breadcrumb">

				<li><a
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
					<i class="fa fa-angle-right "></i> Measurements <i
					class="fa fa-angle-right "></i> Cholesterol</li>

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
					<?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
					<?php
						
						$DoctorPatientRelationObj = new DoctorPatientRelation ();
						$docPatData = $DoctorPatientRelationObj->getdetails ( Yii::app ()->session ['pingmydoctor_doctor'], Yii::app ()->session ['selected_patient_id'] );
						if ($docPatData ['is_share'] == 1) {
							?>
							<a class="btn grey"
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/addCholesterol"><i
					class="fa fa-plus"></i>&nbsp;Add</a>
					<?php } } ?>
					</div>

			<br />

			<table class="table table-striped table-hover"
				id="sample_cholesterol">
				<thead>
					<tr>
						<th>Patient</th>
						<th>When</th>
						<th>LDL</th>
						<th>HDL</th>
						<th>Triglycerides</th>

						<th>Total</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
					foreach ( $cholesterolList as $row ) {
						?>
					
					<tr>
					<?php
						if (trim ( $row ['patient_id'] ) != "") {
							$PatientMaster = new PatientMaster ();
							$patient = $PatientMaster->getNameByPatientId ( $row ['patient_id'] );
							$patient_style = "text-align:center";
						} else {
							$patient = "";
							$patient_style = "text-align:center";
						}
						?>
						<td style=" <?php echo $patient_style; ?> ">
							 <?php echo $patient?>
						</td>
							<?php
						if (trim ( $row ['report_date'] ) != "") {
							$report_date = date ( "m/d/Y", strtotime ( $row ['report_date'] ) );
							$report_date_style = "text-align:left";
						} else {
							$report_date = "";
							$report_date_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $report_date  ?> 
						</td>
						<?php
						if (trim ( $row ['ldl'] ) != "") {
							$ldl = $row ['ldl'];
							$ldl_style = "text-align:left";
						} else {
							$ldl = "";
							$ldl_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $ldl ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?>
						</td>
						 <?php
						if (trim ( $row ['hdl'] ) != "") {
							$hdl = $row ['hdl'];
							$hdl_style = "text-align:left";
						} else {
							$hdl = "";
							$hdl_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $hdl ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?>
						</td>
						 <?php
						if (trim ( $row ['triglycerides'] ) != "") {
							$triglycerides = $row ['triglycerides'];
							$triglycerides_style = "text-align:left";
						} else {
							$triglycerides = "";
							$triglycerides_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $triglycerides ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?>
						</td>
						 <?php
						if (trim ( $row ['total'] ) != "") {
							$total = $row ['total'];
							$total_style = "text-align:left";
						} else {
							$total = "";
							$total_style = "text-align:center";
						}
						?>
						<td>
							  <?php echo $total?>
						</td>

						<td>
							<div class="btn-group">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown"><span id="drop3"
										role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation"><a data-toggle="modal"
												href="#basic<?php echo $row['cholesterol_id'] ?>">View</a></li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
							<a title="Edit"
												href="<?php echo Yii::app()->params->base_path ; ?>doctor/addCholesterol/cholesterol_id/<?php echo $row['cholesterol_id'] ?>">Edit</a>
					<?php } ?>
					
					</li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
							<a title="Delete"
												onclick="confirmDelete(<?php echo $row['cholesterol_id'] ?>)"
												href="#">Delete</a>
					<?php } ?></li>

										</ul></li>
								</ul>
							</div>
							<div class="modal fade"
								id="basic<?php echo $row['cholesterol_id'] ?>" tabindex="-1"
								role="basic" aria-hidden="true">

								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true"></button>
											<h4 class="modal-title">Cholesterol Details</h4>
										</div>
										<div class="modal-body">

											<table class="model_table" width="100%">
												<tr>
													<th>Patient</th>
										  <?php
						if (trim ( $row ['patient_id'] ) != "") {
							$PatientMaster = new PatientMaster ();
							$patient = $PatientMaster->getNameByPatientId ( $row ['patient_id'] );
							$patient_style = "text-align:left";
						} else {
							$patient = "";
							$patient_style = "text-align:left";
						}
						?>
										<td style=" <?php echo $patient_style; ?> ">
											  <?php echo $patient?>
										</td>
												</tr>

												<tr>
													<th width="30%">When</th>

													<td width="70%" style="text-align: left;">
											 <?php echo $report_date  ?> 
										</td>
												</tr>
												<tr>
													<th>LDL</th>

													<td style="text-align: left;">
											 <?php echo $ldl ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?>
										</td>
												</tr>
												<tr>
													<th>TDL</th>

													<td style="text-align: left;">
											 <?php echo $hdl ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?>
										</td>
												</tr>
												<tr>
													<th>Triglycerides</th>

													<td style="text-align: left;">
											 <?php echo $triglycerides ?>&nbsp;<?php if($row['unit'] == 0) { echo "mmol/L"; } else { echo "mg/dL"; } ?>
										</td>
												</tr>
												<tr>
													<th>Total</th>

													<td style="text-align: left;">
											  <?php echo $total?>
										</td>
												</tr>
												<tr>
													<th>Unit</th>
										  <?php
						if (trim ( $row ['unit'] ) != "") {
							if ($row ['unit'] == 0) {
								$unit = 'mmol/L';
							}
							if ($row ['unit'] == 1) {
								$unit = 'mg/dL';
							}
						} else {
							$unit = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $unit?>
										</td>
												</tr>
												<tr>
													<th>Notes</th>
										  <?php
						if (trim ( $row ['notes'] ) != "") {
							$notes = $row ['notes'];
							$notes_style = "text-align:left";
						} else {
							$notes = "";
							$notes_style = "text-align:left";
						}
						?>
										<td style=" <?php echo $notes_style; ?> ">
											  <?php echo $notes?>
										</td>
												</tr>
									 <?php
						if (trim ( $row ['created_at'] ) != "") {
							$created_at = date ( "m/d/Y h:i A", strtotime ( $row ['created_at'] ) );
						} else {
							$created_at = "";
						}
						?>
									 <tr>
													<th>Created Date</th>
													<td style="text-align: left;">
											  <?php echo $created_at?>
										 </td>
												</tr>
									 
									 <?php
						if (trim ( $row ['modified_at'] ) != "") {
							$modified_at = date ( "m/d/Y h:i A", strtotime ( $row ['modified_at'] ) );
						} else {
							$modified_at = "";
						}
						?>
									 <tr>
													<th>Modified Date</th>
													<td style="text-align: left;">
											  <?php echo $modified_at?>
										 </td>
												</tr>

											</table>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn default"
												data-dismiss="modal">Close</button>

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

