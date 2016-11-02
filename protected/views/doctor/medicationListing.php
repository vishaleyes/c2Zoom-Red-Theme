<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Medication?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>doctor/deleteMedication/medication_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
<div id="medicationDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Medication</h3>
			<ul class="page-breadcrumb breadcrumb">

				<li><a
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
					<i class="fa fa-angle-right "></i> Health History <i
					class="fa fa-angle-right "></i> Medication</li>

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
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/addMedication"><i
					class="fa fa-plus"></i>&nbsp;Add</a>
					<?php } } ?>
					</div>

			<br />

			<table class="table table-striped table-hover"
				id="sample_cholesterol">
				<thead>
					<tr>
						<th>Patient</th>
						<th>Medication</th>
						<th>Dose</th>
						<th>Dose Unit</th>

						<th>Strength</th>
						<th>Strength Unit</th>
						<th>When Started</th>
						<th>When Stopped</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					foreach ( $medicationList as $row ) {
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
						if (trim ( $row ['medication_name'] ) != "") {
							$medication_name = $row ['medication_name'];
							$medication_name_style = "text-align:left";
						} else {
							$medication_name = "";
							$medication_name_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $medication_name?>
						</td>
						
						 <?php
						if (trim ( $row ['dose'] ) != "") {
							$dose = $row ['dose'];
							$dose_style = "text-align:left";
						} else {
							$dose = "";
							$dose_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $dose?>
						</td>
						
						 <?php
						if (trim ( $row ['dose_unit'] ) != "") {
							if ($row ['dose_unit'] == 0) {
								$dose_unit = 'doses';
							}
							if ($row ['dose_unit'] == 1) {
								$dose_unit = 'bars';
							}
							if ($row ['dose_unit'] == 2) {
								$dose_unit = 'grams';
							}
							if ($row ['dose_unit'] == 3) {
								$dose_unit = 'capsules';
							}
							
							$dose_unit_style = "text-align:left";
						} else {
							$dose_unit = "";
							$dose_unit_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $dose_unit?>
						</td>
						
						 <?php
						if (trim ( $row ['strength'] ) != "") {
							$strength = $row ['strength'];
							$strength_style = "text-align:left";
						} else {
							$strength = "";
							$strength_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $strength?>
						</td>
						
						 <?php
						if (trim ( $row ['strength_unit'] ) != "") {
							if ($row ['strength_unit'] == 0) {
								$strength_unit = 'milligram';
							}
							if ($row ['strength_unit'] == 1) {
								$strength_unit = 'microgram';
							}
							if ($row ['strength_unit'] == 2) {
								$strength_unit = 'milliliter';
							}
							if ($row ['strength_unit'] == 3) {
								$strength_unit = 'unit';
							}
							if ($row ['strength_unit'] == 4) {
								$strength_unit = 'percent';
							}
							
							$strength_unit_style = "text-align:left";
						} else {
							$strength_unit = "";
							$strength_unit_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $strength_unit?>
						</td>
						
						<?php
						if (trim ( $row ['when_started'] ) != "") {
							$when_started = date ( "m/d/Y", strtotime ( $row ['when_started'] ) );
							$when_started_style = "text-align:left";
						} else {
							$when_started = "";
							$when_started_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $when_started  ?> 
						</td>
						
						<?php
						if (trim ( $row ['when_stopped'] ) != "") {
							$when_stopped = date ( "m/d/Y", strtotime ( $row ['when_stopped'] ) );
							$when_stopped_style = "text-align:left";
						} else {
							$when_stopped = "";
							$when_stopped_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $when_stopped  ?> 
						</td>

						<td>
							<div class="btn-group">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown"><span id="drop3"
										role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation"><a data-toggle="modal"
												href="#basic<?php echo $row['medication_id'] ?>">View</a></li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
							<a title="Edit"
												href="<?php echo Yii::app()->params->base_path ; ?>doctor/addMedication/medication_id/<?php echo $row['medication_id'] ?>">Edit</a>
					<?php } ?>
					
					</li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
							<a title="Delete"
												onclick="confirmDelete(<?php echo $row['medication_id'] ?>)"
												href="#">Delete</a>
					<?php } ?></li>

										</ul></li>
								</ul>
							</div>
							<div class="modal fade" id="basic<?php echo $row['medication_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">

								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true"></button>
											<h4 class="modal-title">Medication Details</h4>
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
													<th>Medication</th>
													<td style="text-align: left;">
											  <?php echo $medication_name?>
										</td>
												</tr>
												<tr>
													<th>How Often Taken</th>
										  <?php
						if (trim ( $row ['how_often_taken'] ) != "") {
							$how_often_taken = $row ['how_often_taken'];
						} else {
							$how_often_taken = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $how_often_taken?>
										</td>
												</tr>
												<tr>
													<th>How Taken</th>
										  <?php
						if (trim ( $row ['how_taken'] ) != "") {
							$how_taken = $row ['how_taken'];
						} else {
							$how_taken = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $how_taken?>
										</td>
												</tr>
												<tr>
													<th>Dose</th>
													<td style="text-align: left;">
											  <?php echo $dose?>
										</td>
												</tr>
												<tr>
													<th>Dose Unit</th>
													<td style="text-align: left;">
											  <?php echo $dose_unit?>
										</td>
												</tr>

												<tr>
													<th>Strength</th>
										  <?php
						if (trim ( $row ['strength'] ) != "") {
							$strength = $row ['strength'];
						} else {
							$strength = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $strength?>
										</td>
												</tr>

												<tr>
													<th>Strength Unit</th>
										  <?php
						if (trim ( $row ['strength_unit'] ) != "") {
							if ($row ['strength_unit'] == 0) {
								$strength_unit = 'milligram';
							}
							if ($row ['strength_unit'] == 1) {
								$strength_unit = 'microgram';
							}
							if ($row ['strength_unit'] == 2) {
								$strength_unit = 'milliliter';
							}
							if ($row ['strength_unit'] == 3) {
								$strength_unit = 'unit';
							}
							if ($row ['strength_unit'] == 4) {
								$strength_unit = 'percent';
							}
						} else {
							$strength_unit = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $strength_unit?>
										</td>
												</tr>

												<tr>
													<th width="30%">When Started</th>
													<td width="70%" style="text-align: left;">
											 <?php echo $when_started  ?> 
										</td>
												</tr>
												<tr>
													<th width="30%">When Stopped</th>
													<td width="70%" style="text-align: left;">
											 <?php echo $when_stopped  ?> 
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

