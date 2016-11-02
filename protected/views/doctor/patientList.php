<script>
function getPatientDetails(patient_id)
{
	window.location.href = "<?php echo Yii::app()->params->base_path;?>doctor/getDetailsByPatient/patient_id/"+patient_id;
}
</script>
<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Patients</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i> Patients
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<table class="table table-striped table-bordered table-hover"
			id="sample_patient_list">
			<thead>
				<tr style="text-align: center;">
					<th style="text-align: center;">Patient Name</th>
					<th style="text-align: center;">Patient Email</th>
					<th style="text-align: center;">Documents</th>
					<th style="text-align: center;">Appointment</th>
					<th style="text-align: center;">Notification</th>
					<th style="text-align: center;">Co-Pay</th>
					<th style="text-align: center;">Select</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					foreach ( $patientData as $row )
					{
				?>
						<tr style="text-align: center;">
							<td align="center">
								 <?php 
									 if (trim ( $row ['name'] ) != "")
									 {
									 	$name = $row ['name'];
									 	$name_style = "text-align:left";
									 }
									 else
									 {
									 	$name = "---";
									 	$name_style = "text-align:center";
									 }
									 
									 if (trim ( $row ['surname'] ) != "")
									 {
									 	$surname = $row ['surname'];
									 }
									 else
									 {
									 	$surname = "---";
									 }
								 	echo $name." ".$surname; 
								 ?>
							</td>
							<td style="text-align: center">
								<?php echo $row['email']; ?>
							</td>
							<td align="center">
								<a title="Forms" href="<?php echo Yii::app()->params->base_path ; ?>doctor/patientFormList/patient_id/<?php echo $row['patient_id']; ?>">
									<i class="fa fa-files-o icon-color"></i>
								</a>
							</td>
							<td align="center">
								<a href="javascript:void(0);" title="Set Appointment" data-toggle="modal" data-target=".bs-appointment-modal-lg" id="<?php echo $row['patient_id']; ?>" data-patient-id="<?php echo $row['patient_id']; ?>">
									<i class="fa fa-calendar icon-color"></i>
								</a>
							</td>
							<td align="center">
								<a title="Send Appointment Notification" href="<?php echo Yii::app()->params->base_path ; ?>doctor/sendPushNotificationForAppointment/patient_id/<?php echo $row['patient_id'];?>">
									<i class="fa fa-bell icon-color"></i>
								</a>
							</td>
							<td align="center">
								<a title="Send Co Pay Notification" href="<?php echo Yii::app()->params->base_path ; ?>doctor/sendPushNotificationForCopay/patient_id/<?php echo $row['patient_id']; ?>">
									<i class="fa fa-money icon-color"></i>
								</a>
							</td>
							<td align="center">
								<?php 
									if($row['patient_id'] == Yii::app()->session['selected_patient_id'])
									{ 
										if(isset(Yii::app()->session['selected_patient_id']))
										{
								?>
											<a title="Select patient" href="<?php echo Yii::app()->params->base_path ; ?>doctor/unselectPatient/patient_id/<?php echo $row['patient_id']; ?>">
												<i class="fa fa-close icon-color"></i>
											</a>
								<?php 
										} 
										else 
										{ 
								?>
											<a title="Select patient" href="<?php echo Yii::app()->params->base_path ; ?>doctor/selectPatient/patient_id/<?php echo $row['patient_id']; ?>">
												<i class="fa fa-check icon-color"></i>
											</a>
								<?php 
										} 
									} 
									else 
									{  
								?>
										<a title="Select patient" href="<?php echo Yii::app()->params->base_path ; ?>doctor/selectPatient/patient_id/<?php echo $row['patient_id']; ?>">
											<i class="fa fa-check icon-color"></i>
										</a>
								<?php 
									} 
								?>
							</td>
						</tr>
				<?php 
						$i++;
					} 
				?>
			</tbody>
		</table>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>
<div class="modal fade bs-appointment-modal-lg" id="bs-appointment-modal-lg" tabindex="<?php echo $i; ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-login" id="AppointmentDiv">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" data-dismiss="modal" class="close" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
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
								<button type="submit" name="saveAppointment" class="btn green">Submit</button>
								<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>doctor/patientList">Cancel</a>
							</div>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("a[data-toggle=modal]").click(function() {   
		var patient_id = $(this).attr('id');
		$("#patient_id").val(patient_id);
	});
	jQuery("#appointment_date").datepicker({
			dateFormat: "mm/dd/yy",
			minDate:'0d',
			yearRange: "1905:"+new Date().getFullYear(),
			
			changeMonth: true,
		    changeYear: true
	});  
</script>