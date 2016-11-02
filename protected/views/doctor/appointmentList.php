<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Appointments</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
				<i class="fa fa-angle-right "></i> Appointments
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row ">
	<div class="col-md-12">
		<div>
		<?php if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != ''): ?>
			<a class="btn grey" href="javascript:void(0);" data-toggle="modal" data-target=".bs-appointment-modal-lg-Add" id="<?php echo Yii::app()->session['selected_patient_id']; ?>" data-patient-id="<?php echo Yii::app()->session['selected_patient_id']; ?>">
				<i class="fa fa-plus"></i>&nbsp;Add
			</a>
		<?php endif;?>	
		</div>
		<br />
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<table class="table table-striped table-hover" id="sample_patient_list">
			<thead>
				<tr>
					<th style="text-align: center">Patient Name</th>
					<th style="text-align: center">Appointment Date</th>
					<th style="text-align: center">Appointment Time</th>
					<th style="text-align: center">Status</th>
					<th style="text-align: center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ( $appointmentData as $row )
					{
				?>
						<tr style="cursor: pointer">
							<td style="text-align: center">
								<?php echo $row['name'].' '.$row['surname']; ?>
							</td>
							<td style="text-align: center">
								<?php echo date('m/d/Y',strtotime($row['appointment_date'])); ?>
							</td>
							<td style="text-align: center">
								<?php echo date("h:i A",strtotime($row ['appointment_time'])); ?>
							</td>
							<td style="text-align: center">
								<?php
									switch ($row ['status'])
									{
										case 0 :
											echo "Pending";
											break;
										case 1 :
											echo "Completed";
											break;
										case 2 :
											echo "Cancelled";
											break;
										case 3 :
											echo "Accepted";
											break;
										case 4 :
											echo "Rejected";
											break;
									}
								?>
							</td>
							<td>
								<div class="btn-group">
									<ul class="nav pull-right">
										<li id="fat-menu" class="dropdown">
											<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
											<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
												<li role="presentation">
													<a data-toggle="modal" href="#bs-appointment-modal-lg-view<?php echo $row['appointment_id']; ?>">View</a>
												</li>
												<?php if ($row['status'] == 0): ?>
												<li role="presentation">
													<a data-toggle="modal" href="#bs-appointment-modal-lg-cancel<?php echo $row['appointment_id']; ?>">Cancel</a>
												</li>
												<?php endif;?>
											</ul>
										</li>
									</ul>
								</div>
								<!-- View dialog box start -->
								<div class="modal fade bs-appointment-modal-lg" id="bs-appointment-modal-lg-view<?php echo $row['appointment_id']; ?>" tabindex="-1" role="basic" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
												<h4 class="modal-title">Appointment Details</h4>
											</div>
											<div class="modal-body">
												<table class="model_table" width="100%">
													<tr>
														<th>Date</th>
														<td style="text-align:left">
															<?php echo date ( "m/d/Y", strtotime($row['appointment_date'])); ?>
														</td>
													</tr>
													<tr>
														<th>Time</th>
														<td style="text-align:left;">
															<?php echo date("h:i A",strtotime($row['appointment_time'])); ?>
														</td>
													</tr>
													<tr>
														<th>Notes</th>
														<td style="text-align:left;">
															<?php echo $row['notes']; ?>
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
								<!-- View dialog box End -->
								
								<!-- Cancel dialog box start -->
								<div class="modal fade bs-appointment-modal-lg" id="bs-appointment-modal-lg-cancel<?php echo $row['appointment_id']; ?>" tabindex="<?php echo $i; ?>" role="basic" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-login" id="StaticPageDiv">
										<div class="modal-content">
											<div class="modal-header">
												<button aria-label="Close" data-dismiss="modal" class="close" type="button">												
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 class="modal-title">Cancel Appointment</h4>
											</div>
											<div class="modal-body login_container padding0">
												<div class="portlet-body form">
													<!-- BEGIN FORM-->
													<form action="<?php echo Yii::app()->params->base_path ; ?>doctor/cancelAppointment" name="form_staticPage" id="form_staticPage" class="form-horizontal" method="post">
														<div class="form-body">
															<div class="alert alert-danger display-hide">
																<button class="close" data-close="alert"></button>
																You have some form errors. Please check below.
															</div>
															<div class="alert alert-success display-hide">
																<button class="close" data-close="alert"></button>
																Your form validation is successful!
															</div>
															<div class="row marg-btm10px">
																<div class="col-md-2">
																	<label>Date</label>
																</div>
																<div class="col-md-4">
																	<?php echo date ( "m/d/Y", strtotime($row['appointment_date'])); ?>
																</div>
																<div class="col-md-2">
																	<label>Time</label>
																</div>
																<div class="col-md-4">
																	<?php echo date("h:i A",strtotime($row['appointment_time'])); ?>
																</div>
															</div>
															<div class="row marg-btm10px">
																<label class="col-md-2">Notes<span class="required"> * </span></label>
																<div class="col-md-10">
																	<textarea rows="3" class="form-control" name="pagedcscription" data-required="1"><?php echo $row['notes'];?></textarea>
																</div>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="form-actions fluid">
															<div class="col-md-offset-2 col-md-10">
																<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $row['patient_id'] ?>" />
																<input type="hidden" name="appointment_id" id="appointment_id" value="<?php echo $row['appointment_id'] ?>" />
																<button type="submit" name="saveAppointment" class="btn green">Submit</button>
																<a class="btn red" onclick="$('#bs-appointment-modal-lg-cancel<?php echo $row['appointment_id']; ?>').modal('hide');" href="javascript:void(0);">Cancel</a>
															</div>
														</div>
													</form>
													<!-- END FORM-->
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Cancel dialog box End -->
							</td>
						</tr>
				<?php 
					} 
				?>
				</tbody>
			</table>
			<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>
<!-- Add dialog box start -->
<div class="modal fade bs-appointment-modal-lg-Add" id="bs-appointment-modal-lg-Add" tabindex="<?php echo $i; ?>" role="basic" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-login" id="AppointmentDiv">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" data-dismiss="modal" class="close" type="button"></button>
			</div>
			<div class="modal-body login_container padding0">
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="<?php echo Yii::app()->params->base_path ; ?>doctor/saveAppointment" id="form_appointment" class="form-horizontal" method="post">
						<div class="form-body">
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success display-hide">
								<button class="close" data-close="alert"></button>
								Your form validation is successful!
							</div>
							<div class="row marg-btm10px">
								<div class="col-md-2">
									<label>
										Date<span class="required"> * </span>
									</label>
								</div>
								<div class="col-md-4">
									<input class="form-control form-control-inline input date-picker" style="width: 100%;" data-required="1" placeholder="Ex. <?php echo date("m/d/Y") ?>" id="appointment_date" name="appointment_date" type="text"
										value="<?php if (isset ( $appointmentData ['appointment_date'] ) && ($appointmentData ['appointment_date']) != '') { echo $appointmentData ['appointment_date']; } ?>"/ > 
									<span class="col-md-12" style="color: red"><?php echo $validationError['appointment_dateErr'] ?></span>
								</div>
								<div class="col-md-2">
									<label>
										Time<span class="required"> * </span>
									</label>
								</div>
								<div class="col-md-4">
									<input class="form-control timepicker timepicker-no-seconds" data-required="1" size="16" placeholder="Ex. <?php echo date("H:i") ?>" id="appointment_time" name="appointment_time" type="text"
										value="<?php if (isset ( $appointmentData ['appointment_time'] ) && ($appointmentData ['appointment_time']) != '') { echo $appointmentData ['appointment_time']; } ?>"/ > 
									<span class="col-md-12" style="color: red"><?php echo $validationError['appointment_timeErr'] ?></span>
								</div>
							</div>
							<div class="row marg-btm10px">
								<label class="col-md-2">Notes</label>
								<div class="col-md-10">
									<textarea rows="3" class="form-control" name="notes"><?php if (isset ( $appointmentData ['notes'] ) && ($appointmentData ['notes']) != '') { echo $appointmentData ['notes']; } ?></textarea>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-actions fluid">
							<div class="col-md-offset-2 col-md-10">
								<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $row['patient_id']; ?>" />
								<input type="hidden" name="parent_page" id="parent_page" value="appointmentPage" />
								<button type="submit" name="saveAppointment" class="btn green">Submit</button>
								<a class="btn red" onclick="$('#bs-appointment-modal-lg-Add').modal('hide');" href="javascript:void(0);">Cancel</a>
							</div>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Add dialog box End -->
<script>
	jQuery("#appointment_date").datepicker({
			dateFormat: "mm/dd/yy",
			minDate:'0d',
			yearRange: "1905:"+new Date().getFullYear(),			
			changeMonth: true,
		    changeYear: true
	}); 
</script>