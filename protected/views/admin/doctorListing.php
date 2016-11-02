<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Doctor?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>admin/deleteDoctor/doctor_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>

<div id="doctorDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Doctor</h3>
			<ul class="page-breadcrumb breadcrumb">

				<li>
							<?php 
/*
			       * ?><a href="#">Measurements</a>
			       * <i class="fa fa-angle-right "></i><?php
			       */
							?>
                            <a
					href="<?php echo Yii::app()->params->base_path ; ?>admin/doctorListing">
						Doctor List</a>
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
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-user"></i>Doctor List
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>

					</div>
				</div>
				<div class="portlet-body">

					<div>
						<a class="btn green"
							href="<?php echo Yii::app()->params->base_path ; ?>admin/addDoctor"><i
							class="fa fa-plus"></i>&nbsp;Add Doctor</a>
					</div>

					<br />

					<table class="table table-striped table-bordered table-hover"
						id="sample_patient_list_for_admin">
						<thead>
							<tr>
								<th>Photo</th>
								<th>Name</th>
								<th>Email</th>
								<th>Mobile Number</th>

								<th>Created Date</th>
								<th style="text-align: center">Actions</th>
							</tr>
						</thead>
						<tbody>
							
                         
							<?php
							foreach ( $doctorList as $row ) {
								?>
                           
							<tr>
                            
                             <?php
								if (trim ( $row ['doctor_image'] ) != "") {
									$doctor_image = $row ['doctor_image'];
									$doctor_image_style = "text-align:center";
								} else {
									$doctor_image = "default.png";
									$doctor_image_style = "text-align:center";
								}
								?>
								<td style=" <?php echo $doctor_image_style; ?> ">
									   <?php $url = Yii::app()->params->base_url."assets/upload/avatar/doctor/".$doctor_image; ?>
                                   
						     <img alt="" class="img-circle" height="35px" width="35px"
									src="<?php echo $url ; ?>" />
								</td>
                                
                                <?php
								if (trim ( $row ['name'] ) != "" || trim ( $row ['surname'] ) != "") {
									$doctor_name = $row ['name'] . " " . $row ['surname'];
									$doctor_name_style = "text-align:center";
								} else {
									$doctor_name = "";
									$doctor_name_style = "text-align:center";
								}
								?>
								<td style=" <?php echo $doctor_name_style; ?> ">
									 <?php echo $doctor_name?>
								</td>
                                 <?php
								if (trim ( $row ['email'] ) != "") {
									$email = $row ['email'];
									$email_style = "text-align:center";
								} else {
									$email = "";
									$email_style = "text-align:center";
								}
								?>
								<td style=" <?php echo $email_style; ?> ">
									 <?php echo $email?>
								</td>
                                 <?php
								if (trim ( $row ['doctor_mobile'] ) != "") {
									$doctor_mobile = $row ['doctor_mobile'];
									$doctor_mobile_style = "text-align:center";
								} else {
									$doctor_mobile = "";
									$doctor_mobile_style = "text-align:center";
								}
								?>
								<td style=" <?php echo $doctor_mobile_style; ?> ">
									 <?php echo $doctor_mobile?>
								</td>
                                
                                
                                <?php
								if (trim ( $row ['created_at'] ) != "") {
									$created_date = date ( "m/d/Y", strtotime ( $row ['created_at'] ) );
									$created_date_style = "text-align:center";
								} else {
									$created_date = "";
									$created_date_style = "text-align:center";
								}
								?>
								<td style=" <?php echo $created_date_style; ?> ">
                                     <?php echo $created_date  ?> 
								</td>

								<td style="text-align: center"><a data-toggle="modal"
									href="#basic<?php echo $row['doctor_id'] ?>"><i
										class="fa fa-eye"></i></a>&nbsp;

									<div class="modal fade"
										id="basic<?php echo $row['doctor_id'] ?>" tabindex="-1"
										role="basic" aria-hidden="true">

										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal"
														aria-hidden="true"></button>
													<h4 class="modal-title">Doctor Details</h4>
												</div>
												<div class="modal-body">

													<table class="model_table" width="100%">
														<tr>
															<th width="30%">Photo</th>
															<td width="70%" style="text-align: left;" class="text-left">
																<?php
																	if (isset ( $doctor_image ) && !empty($doctor_image))
																	{
																		if (file_exists ( FILE_UPLOAD."avatar/doctor/" . $doctor_image ))
																		{
																?>
																			<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/<?php echo $doctor_image; ?>" width="100" height="100" />
																<?php 
																		}
																		else
																		{
																?>
																			<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/default.png" width="100" height="100" />
																<?php
																		}
																	}
																	else
																	{
																?>
																		<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/default.png" width="100" height="100" />
																<?php
																	}
																?>
															</td>
														</tr>
														<tr>
															<th width="30%">Name</th>
															<td width="70%" style="text-align: left">
													 <?php echo $doctor_name  ?> 
												 </td>
														</tr>
														<tr>
															<th width="30%">Email</th>
															<td width="70%" style="text-align: left">
																<a href="mailto:<?php echo $email; ?>" border=0><?php echo $email; ?></a> 
												  </td>
														</tr>
														<tr>
															<th width="30%">Mobile Number</th>
															<td width="70%" style="text-align: left">
													 <?php echo $doctor_mobile  ?> 
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
															<th width="30%">Specialization</th>
                                                   <?php
								if (trim ( $row ['doctor_spec_id'] ) != "") {
									$DoctorSpecialization = new DoctorSpecialization ();
									$doctor_spec = $DoctorSpecialization->getSpecializationNameById ( $row ['doctor_spec_id'] );
								} else {
									$doctor_spec = "";
								}
								?>
                                                  <td width="70%"
																style="text-align: left">
													 <?php echo $doctor_spec  ?> 
												  </td>
														</tr>

														<tr>

															<th width="30%">Qualification</th>
                                                 <?php
								if (trim ( $row ['qualification'] ) != "") {
									$qualification = $row ['qualification'];
								} else {
									$qualification = "";
								}
								?>
                                                  <td width="70%"
																style="text-align: left">
													 <?php echo $qualification  ?> 
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
									href="<?php echo Yii::app()->params->base_path ; ?>admin/addDoctor/doctor_id/<?php echo $row['doctor_id'] ?>"><i
										class="fa fa-pencil"></i></a>&nbsp; <a title="Delete"
									onclick="confirmDelete(<?php echo $row['doctor_id'] ?>)"
									href="#"><i class="fa fa-times"></i></a></td>
							</tr>
                            
                            <?php } ?>
							
						
							</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>

<div class="modal fade" id="basic" tabindex="-1" role="basic"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true"></button>
				<h4 class="modal-title">Doctor Details</h4>
			</div>
			<div class="modal-body">

				<table class="model_table">
					<tr>
						<th>When</th>
						<td>12/05/2015</td>
					</tr>
					<tr>
						<th>LDL</th>
						<td>52</td>
					</tr>
					<tr>
						<th>TDL</th>
						<td>56</td>
					</tr>
					<tr>
						<th>Triglycerides</th>
						<td>53</td>
					</tr>
					<tr>
						<th>Total</th>
						<td>150</td>
					</tr>
					<tr>
						<th>Notes</th>
						<td>Hello</td>
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