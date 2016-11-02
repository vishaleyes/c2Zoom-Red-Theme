<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Allergy?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>doctor/deleteAllergy/allergy_id/"+id;
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
			<h3 class="page-title">Allergy</h3>
			<ul class="page-breadcrumb breadcrumb">

				<li><a
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
					<i class="fa fa-angle-right "></i> Health History <i
					class="fa fa-angle-right "></i> Allergy</li>

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
					href="<?php echo Yii::app()->params->base_path ; ?>doctor/addAllergy"><i
					class="fa fa-plus"></i>&nbsp;Add</a>
					<?php } } ?>
					
					</div>

			<br />

			<table class="table table-striped table-hover"
				id="sample_cholesterol">
				<thead>
					<tr>
						<th>Patient</th>
						<th>Allergy</th>
						<th>Allergy Type</th>
						<th>First Observed</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					foreach ( $allergyList as $row ) {
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
						if (trim ( $row ['allergy_name'] ) != "") {
							$allergy_name = $row ['allergy_name'];
							$allergy_name_style = "text-align:left";
						} else {
							$allergy_value = "";
							$allergy_name_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $allergy_name?>
						</td>
						
						<?php
						if (trim ( $row ['allergy_master_id'] ) != "") {
							$AllergyMaster = new AllergyMaster ();
							$allergy_type = $AllergyMaster->getNameByAllergyMasterId ( $row ['allergy_master_id'] );
							$allergy_type_style = "text-align:left";
						} else {
							$allergy_type = "";
							$allergy_type_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $allergy_type?>
						</td>
						
						<?php
						if (trim ( $row ['first_observed'] ) != "") {
							$first_observed = date ( "m/d/Y", strtotime ( $row ['first_observed'] ) );
							$first_observed_style = "text-align:left";
						} else {
							$first_observed = "";
							$first_observed_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $first_observed  ?> 
						</td>

						<td>
							<div class="btn-group">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown"><span id="drop3"
										role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation"><a data-toggle="modal"
												href="#basic<?php echo $row['allergy_id'] ?>">View</a></li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?> 
							<a title="Edit"
												href="<?php echo Yii::app()->params->base_path ; ?>doctor/addAllergy/allergy_id/<?php echo $row['allergy_id'] ?>">Edit</a><?php } ?></li>
											<li role="presentation"><?php if(isset(Yii::app()->session['selected_patient_id'])) { ?> 
							<a title="Delete"
												onclick="confirmDelete(<?php echo $row['allergy_id'] ?>)"
												href="#">Delete</a><?php } ?></li>
										</ul></li>
								</ul>
							</div>
							<div class="modal fade" id="basic<?php echo $row['allergy_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">

								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true"></button>
											<h4 class="modal-title">Allergy Details</h4>
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
													<th>Allergy</th>
													<td style="text-align: left;">
											  <?php echo $allergy_name?>
										</td>
												</tr>
												<tr>
													<th>Allergy Type</th>
													<td style="text-align: left;">
											  <?php echo $allergy_type?>
										</td>
												</tr>
												<tr>
													<th>Reaction</th>
										  <?php
						if (trim ( $row ['reaction'] ) != "") {
							$reaction = $row ['reaction'];
						} else {
							$reaction = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $reaction?>
										</td>
												</tr>

												<tr>
													<th>Treatment</th>
										  <?php
						if (trim ( $row ['treatment'] ) != "") {
							$treatment = $row ['treatment'];
						} else {
							$treatment = "";
						}
						?>
										<td style="text-align: left;">
											  <?php echo $treatment?>
										</td>
												</tr>

												<tr>
													<th width="30%">First Observed</th>
													<td width="70%" style="text-align: left;">
											 <?php echo $first_observed  ?> 
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

