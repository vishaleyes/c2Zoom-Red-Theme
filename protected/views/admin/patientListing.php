<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Patient?", function(confirmed) {
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>admin/deletePatient/patient_id/"+id;
		}else{
			return true;
		}
	});
}
</script>
<div id="patientDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Patient</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>admin/adminHome">Home</a>
					<i class="fa fa-angle-right "></i> Patient
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
				<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>admin/addPatient">
					<i class="fa fa-plus"></i>&nbsp;Add
				</a>
			</div>
			<br />
			<table class="table table-striped table-hover" id="sample_patient_list_for_admin">
				<thead>
					<tr>
						<th>Photo</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Created Date</th>
						<th style="text-align: center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ( $patientList as $row ) 
						{
					?>
                           
							<tr>
                            
                             <?php
						if (trim ( $row ['patient_image'] ) != "") {
							$patient_image = $row ['patient_image'];
							$patient_image_style = "text-align:center";
						} else {
							$patient_image = "default.png";
							$patient_image_style = "text-align:center";
						}
						?>
						<td style=" <?php echo $patient_image_style; ?> ">
							   <?php $url = Yii::app()->params->base_url."assets/upload/avatar/patient/".$patient_image; ?>
                                     
						     <img alt="" class="img-circle" height="35px" width="35px"
									src="<?php echo $url ; ?>" />
								</td>
                                
                                <?php
						if (trim ( $row ['name'] ) != "" || trim ( $row ['surname'] ) != "") {
							$patient_name = $row ['name'] . " " . $row ['surname'];
							$patient_name_style = "text-align:left";
						} else {
							$patient_name = "";
							$patient_name_style = "text-align:center";
						}
						?>
						<td style=" <?php echo $patient_name_style; ?> ">
							 <?php echo $patient_name?>
								</td>
                                 <?php
						if (trim ( $row ['email'] ) != "") {
							$email = $row ['email'];
							$email_style = "text-align:left";
						} else {
							$email = "";
							$email_style = "text-align:center";
						}
						?>
						<td style=" <?php echo $email_style; ?> ">
							 <?php echo $email?>
								</td>
                                 <?php
						if (trim ( $row ['phone_number'] ) != "") {
							$phone_number = $row ['phone_number'];
							$phone_number_style = "text-align:left";
						} else {
							$phone_number = "";
							$phone_number_style = "text-align:center";
						}
						?>
						<td style=" <?php echo $phone_number_style; ?> ">
							 <?php echo $phone_number?>
								</td>
                                
                                
                                <?php
						if (trim ( $row ['created_at'] ) != "") {
							$created_date = date ( "m/d/Y", strtotime ( $row ['created_at'] ) );
							$created_date_style = "text-align:left";
						} else {
							$created_date = "";
							$created_date_style = "text-align:center";
						}
						?>
						<td style=" <?php echo $created_date_style; ?> ">
                                     <?php echo $created_date  ?> 
						</td>

						<td style="text-align: center"><a data-toggle="modal"
							href="#basic<?php echo $row['patient_id'] ?>"><i
								class="fa fa-eye"></i></a>&nbsp;

							<div class="modal fade"
								id="basic<?php echo $row['patient_id'] ?>" tabindex="-1"
								role="basic" aria-hidden="true">

								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true"></button>
											<h4 class="modal-title">Patient Details</h4>
										</div>
										<div class="modal-body">

											<table class="model_table" width="100%">
												<tr>
													<th width="30%">Image</th>
													<td class="text-left" style="text-align:left;">
														<?php
															if ((isset ( $patient_image )) && ($patient_image != ''))
															{
																$url = Yii::app ()->params->base_url . "assets/upload/avatar/patient/" . $patient_image;
															}
															else
															{
																$url = Yii::app ()->params->base_url . "assets/upload/avatar/patient/".$patient_image;
															}
															if (! file_exists ( "assets/upload/avatar/patient/".$patient_image))
															{
																$url = Yii::app ()->params->base_url . "assets/upload/avatar/patient/default.png";
															}
														?>
														<img src="<?php echo $url.'?'.date("Y-m-d H:i:s");?>" class="img-circle" width="150" height="150" />
													</td>
												<tr>
													<th width="30%">Name</th>
													<td width="70%" style="text-align: left">
											 <?php echo $patient_name  ?> 
										 </td>
												</tr>
												<tr>
													<th width="30%">Email</th>
													<td width="70%" style="text-align: left">
														<a href="mailto:<?php echo $email; ?>" border=0><?php echo $email; ?></a>
										  			</td>
												</tr>
												<tr>
													<th width="30%">Phone Number</th>
													<td width="70%" style="text-align: left">
											 <?php echo $phone_number  ?> 
												  </td>

														</tr>

														<tr>
															<th width="30%">Date Of Birth</th>
                                                 <?php
						if (trim ( $row ['dob'] ) != "") {
							$dob = date ( "m/d/Y", strtotime ( $row ['dob'] ) );
						} else {
							$dob = "";
						}
						?>
                                                  <td width="70%"
																style="text-align: left">
											 <?php echo $dob  ?> 
												  </td>

														</tr>
														<tr>
															<th width="30%">Gender</th>
                                                   <?php
						if (trim ( $row ['gender'] ) != "") {
							if ($row ['gender'] == 0) {
								$gender = 'Female';
							}
							if ($row ['gender'] == 1) {
								$gender = 'Male';
							}
							if ($row ['gender'] == 2) {
								$gender = 'Not Specified';
							}
						} else {
							$gender = "";
						}
						?>
                                                  <td width="70%"
																style="text-align: left">
											 <?php echo $gender  ?> 
												  </td>
														</tr>


														<tr>
															<th width="30%">Blood Group</th>
                                                  <?php
						if (trim ( $row ['blood_group'] ) != "") {
							if ($row ['blood_group'] == 0) {
								$blood_group = 'Not Specified';
							}
							if ($row ['blood_group'] == 1) {
								$blood_group = 'A+';
							}
							if ($row ['blood_group'] == 2) {
								$blood_group = 'A-';
							}
							if ($row ['blood_group'] == 3) {
								$blood_group = 'B+';
							}
							if ($row ['blood_group'] == 4) {
								$blood_group = 'B-';
							}
							if ($row ['blood_group'] == 5) {
								$blood_group = 'O+';
							}
							if ($row ['blood_group'] == 6) {
								$blood_group = 'O-';
							}
							if ($row ['blood_group'] == 7) {
								$blood_group = 'AB+';
							}
							if ($row ['blood_group'] == 8) {
								$blood_group = 'AB-';
							}
						} else {
							$blood_group = "";
						}
						?>
                                                  <td width="70%"
																style="text-align: left">
											 <?php echo $blood_group  ?> 
												  </td>
														</tr>
														<tr>
															<th width="30%">Address</th>
                                                 <?php
						if (trim ( $row ['address'] ) != "") {
							$address = $row ['address'];
						} else {
							$address = "";
						}
						?>
                                                  <td width="70%"
																style="text-align: left">
											 <?php echo $address  ?> 
												  </td>
														</tr>
														<tr>
															<th width="30%">Marital Status</th>
                                                 <?php
						if (trim ( $row ['marital_status'] ) != "") {
							if ($row ['marital_status'] == 0) {
								$marital_status = 'Married';
							}
							if ($row ['marital_status'] == 1) {
								$marital_status = 'Widowed';
							}
							if ($row ['marital_status'] == 2) {
								$marital_status = 'Seperated';
							}
							if ($row ['marital_status'] == 3) {
								$marital_status = 'Divorsed';
							}
							if ($row ['marital_status'] == 4) {
								$marital_status = 'Single';
							}
							if ($row ['marital_status'] == 5) {
								$marital_status = 'Not Specified';
							}
						} else {
							$marital_status = "";
						}
						?>
                                                  <td width="70%"
																style="text-align: left">
											 <?php echo $marital_status  ?> 
												  </td>

														</tr>
														<tr>
															<th width="30%">Organ Donor</th>
                                                 <?php
						if (trim ( $row ['organ_donor'] ) != "") {
							if ($row ['organ_donor'] == 0) {
								$organ_donor = 'No';
							}
							if ($row ['organ_donor'] == 1) {
								$organ_donor = 'Yes';
							}
						} else {
							$organ_donor = "";
						}
						?>
                                                  <td width="70%"
																style="text-align: left">
											 <?php echo $organ_donor  ?> 
										  </td>
												</tr>
												<tr>
													<th width="30%">Created Date</th>
													<td width="70%" style="text-align: left">
											 <?php echo date("m/d/Y h:i A",strtotime($row['created_at']));  ?> 
												  </td>

														</tr>
														<tr>
															<th width="30%">Modified Date</th>
                                                  <?php
						if (trim ( $row ['modified_at'] ) != "") {
							$modified_at = date ( "m/d/Y h:i A", strtotime ( $row ['modified_at'] ) );
						} else {
							$modified_at = "";
						}
						?>
                                                  <td width="70%"
																style="text-align: left">
											 <?php echo $modified_at  ?> 
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
							</div> <a title="Edit"
							href="<?php echo Yii::app()->params->base_path ; ?>admin/addPatient/patient_id/<?php echo $row['patient_id'] ?>"><i
								class="fa fa-pencil"></i></a>&nbsp; <a title="Delete" href="#"
							onclick="confirmDelete(<?php echo $row['patient_id'] ?>)"><i
										class="fa fa-times"></i></a></td>
							</tr>
                            
                            <?php } ?>
					
				
					</tbody>
			</table>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>