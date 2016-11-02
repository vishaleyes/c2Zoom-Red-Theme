<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Height?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>doctor/deleteHeight/height_id/"+id;
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
			<h3 class="page-title">Height</h3>
			<ul class="page-breadcrumb breadcrumb">

				<li><a
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
					<i class="fa fa-angle-right "></i> Measurements <i
					class="fa fa-angle-right "></i> Height</li>

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
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/addHeight"><i
					class="fa fa-plus"></i>&nbsp;Add</a>
					<?php } } ?>
					</div>

			<br />

			<table class="table table-striped table-hover"
				id="sample_cholesterol">
				<thead>
					<tr>
						<th>Patient</th>
						<th>Height</th>
						<th>Unit</th>
						<th>When</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					foreach ( $heightList as $row ) {
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
						if (trim ( $row ['height_value'] ) != "") {
							$height_value = $row ['height_value'];
							$height_value_style = "text-align:left";
						} else {
							$height_value = "";
							$height_value_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $height_value?>
						</td>
						 <?php
						if (trim ( $row ['unit'] ) != "") {
							if ($row ['unit'] == 0) {
								$unit = 'ft';
							}
							if ($row ['unit'] == 1) {
								$unit = 'inch';
							}
							if ($row ['unit'] == 2) {
								$unit = 'cm';
							}
							
							$unit_style = "text-align:left";
						} else {
							$unit = "";
							$unit_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $unit?>
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
												href="#basic<?php echo $row['height_id'] ?>">View</a></li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
							<a title="Edit"
												href="<?php echo Yii::app()->params->base_path ; ?>doctor/addHeight/height_id/<?php echo $row['height_id'] ?>">Edit</a>
					<?php } ?>
					
					</li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?>
							<a title="Delete"
												onclick="confirmDelete(<?php echo $row['height_id'] ?>)"
												href="#">Delete</a>
					<?php } ?></li>

										</ul></li>
								</ul>
							</div>
							<div class="modal fade" id="basic<?php echo $row['height_id'] ?>"
								tabindex="-1" role="basic" aria-hidden="true">

								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true"></button>
											<h4 class="modal-title">Height Details</h4>
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
													<th>Height Value</th>
													<td style="text-align: left;">
											 <?php echo $height_value?>
										</td>
												</tr>
												<tr>
													<th>Unit</th>
													<td style="text-align: left;">
											 <?php echo $unit?>
										</td>
												</tr>
												<tr>
													<th>Sub Height</th>
										 <?php
						if (trim ( $row ['sub_height'] ) != "") {
							$sub_height = $row ['sub_height'];
						} else {
							$sub_height = "";
						}
						?>
										<td style="text-align: left;">
											 <?php echo $sub_height?>
										</td>
												</tr>
												<tr>
													<th>Sub Height Unit</th>
										  <?php
						if (trim ( $row ['sub_height_unit'] ) != "") {
							if ($row ['sub_height_unit'] == 0) {
								$sub_height_unit = 'ft';
							}
							if ($row ['sub_height_unit'] == 1) {
								$sub_height_unit = 'inch';
							}
							if ($row ['sub_height_unit'] == 2) {
								$sub_height_unit = 'cm';
							}
						} else {
							$sub_height_unit = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $sub_height_unit?>
										</td>
												</tr>
												<tr>
													<th width="30%">When</th>
													<td width="70%" style="text-align: left;">
											 <?php echo $report_date  ?> 
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

