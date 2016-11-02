<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete BloodPressure?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>doctor/deleteBloodPressure/blood_pressure_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
<div id="bloodPressureDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Blood Pressure</h3>
			<ul class="page-breadcrumb breadcrumb">

				<li><a
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
					<i class="fa fa-angle-right "></i> Measurements <i
					class="fa fa-angle-right "></i> Blood Pressure</li>

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
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/addBloodPressure"><i
					class="fa fa-plus"></i>&nbsp;Add</a>
					<?php } } ?>
					</div>
			<br />
			<table class="table table-striped table-hover"
				id="sample_cholesterol">
				<thead>
					<tr>
						<th>Patient</th>
						<th>Pulse</th>
						<th>Systolic</th>
						<th>Diastolic</th>
						<th>When</th>

						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					foreach ( $bloodPressureList as $row ) {
						?>
					
					<tr>
					
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
							<td>
								  <?php echo $patient?>
							</td>
							
						 <?php
						if (trim ( $row ['pulse'] ) != "") {
							$pulse = $row ['pulse'];
							$pulse_style = "text-align:left";
						} else {
							$pulse = "";
							$pulse_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $pulse?>
						</td>
						 <?php
						if (trim ( $row ['systolic'] ) != "") {
							$systolic = $row ['systolic'];
							$systolic_style = "text-align:left";
						} else {
							$systolic = "";
							$systolic_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $systolic?>
						</td>
						 <?php
						if (trim ( $row ['diastolic'] ) != "") {
							$diastolic = $row ['diastolic'];
							$diastolic_style = "text-align:left";
						} else {
							$diastolic = "";
							$diastolic_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $diastolic?>
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

						<td>

							<div class="btn-group">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown"><span id="drop3"
										role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation"><a data-toggle="modal"
												href="#basic<?php echo $row['blood_pressure_id'] ?>">View</a></li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
					
							<a title="Edit"
												href="<?php echo Yii::app()->params->base_path ; ?>doctor/addBloodPressure/blood_pressure_id/<?php echo $row['blood_pressure_id'] ?>">Edit</a>
					<?php } ?>
					
					</li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
					<a title="Delete"
												onclick="confirmDelete(<?php echo $row['blood_pressure_id'] ?>)"
												href="#">Delete</a><?php } ?></li>

										</ul></li>
								</ul>
							</div>
							<div class="modal fade"
								id="basic<?php echo $row['blood_pressure_id'] ?>" tabindex="-1"
								role="basic" aria-hidden="true">

								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true"></button>
											<h4 class="modal-title">Blood Pressure Details</h4>
										</div>
										<div class="modal-body">

											<table class="model_table" width="100%">
												<tr>
													<th>Patient</th>

													<td style="text-align: left;">
											  <?php echo $patient?>
										</td>
												</tr>

												<tr>
													<th>Pulse</th>

													<td style="text-align: left;">
											  <?php echo $pulse?>
										</td>
												</tr>
												<tr>
													<th>Systolic</th>

													<td style="text-align: left;">
											  <?php echo $systolic?>
										</td>
												</tr>
												<tr>
													<th>Diastolic</th>

													<td style="text-align: left;">
											  <?php echo $diastolic?>
										</td>
												</tr>

												<tr>
													<th width="30%">When</th>

													<td style="text-align: left;">
											 <?php echo $report_date  ?> 
										</td>
												</tr>
												<tr>
													<th>Irregular Heart Beats</th>
										  <?php
						if (trim ( $row ['irr_heartbeat'] ) != "") {
							if ($row ['irr_heartbeat'] == 0) {
								$irr_heartbeat = 'Don\'t Know';
							}
							if ($row ['irr_heartbeat'] == 1) {
								$irr_heartbeat = 'Yes';
							}
							if ($row ['irr_heartbeat'] == 2) {
								$irr_heartbeat = 'No';
							}
						} else {
							$irr_heartbeat = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $irr_heartbeat?>
										</td>
												</tr>
												<tr>
													<th>Notes</th>
										  <?php
						if (trim ( $row ['notes'] ) != "") {
							$notes = $row ['notes'];
						} else {
							$notes = "";
						}
						?>
										<td style="text-align: left;">
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

