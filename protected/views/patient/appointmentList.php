<script>
function acceptRejectAppointment(id,status)
{
	if(status == 3)
	{
		window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/acceptRejectAppointment/appointment_id/"+id+"/appointment_status/"+status;	
	}
	else if(status == 4)
	{
		bootbox.confirm("Are you sure want to reject appointment?", function(confirmed) {
			if(confirmed == true)
			{
				window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/acceptRejectAppointment/appointment_id/"+id+"/appointment_status/"+status;
			}
			else
			{
				return true;
			}
		});
	}
}

</script>
<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Appointments</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i> Appointments
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<table class="table table-hover" id="sample_patient_list">
			<thead>
				<tr>
					<th style="text-align: center">Doctor Name</th>
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
					<td style="text-align: center"><?php echo $row['name'].' '.$row['surname']; ?></td>
					<td style="text-align: center"><?php echo date("m/d/Y",strtotime($row['appointment_date'])); ?></td>
					<td style="text-align: center"><?php echo date("h:i A",strtotime($row ['appointment_time'])); ?></td>
					<td style="text-align: center">
						<?php
							if ($row ['status'] == '0')
							{
								echo "Pending";
							}
							else if ($row ['status'] == '1')
							{
								echo "Completed";
							}
							else if ($row ['status'] == '2')
							{
								echo "Cancelled";
							}
							else if ($row ['status'] == '3')
							{
								echo "Accepted";
							}
							else if ($row ['status'] == '4')
							{
								echo "Rejected";
							}
						?>
					</td>
					<td align="center">
						<!-- 
						<a title="set appointment" href="<?php echo Yii::app()->params->base_path ; ?>doctor/cancel/appointment_id/<?php echo $row['appointment_id'] ?>">
							<i style="padding-top: 15px;" class="fa fa-close-o"></i> 
						</a>
						 -->
						 <?php if ($row ['status'] == '0'): ?>
							<div class="btn-group">
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="Accept appointment" onclick="acceptRejectAppointment('<?php echo $row['appointment_id'] ?>','3');" href="javascript:void(0);">Accept</a>
											</li>
											<li role="presentation">
												<a title="Reject appointment" onclick="acceptRejectAppointment('<?php echo $row['appointment_id'] ?>','4');" href="javascript:void(0);">Reject</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						<?php endif; ?>
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
