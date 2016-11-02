<script>
function notifyPatient(documentsubmittedlogid,patientID)
{
	window.location.href = "<?php echo Yii::app()->params->base_path ; ?>doctor/notifyPatient&documentsubmittedlogid="+documentsubmittedlogid+"&patientID="+patientID;
}
</script>
<div id="patientDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Received Documents</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>doctor/doctorHome">Home</a>
					<i class="fa fa-angle-right "></i> Received Documents
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
			<br />
			<table class="table table-striped table-hover" id="sample_cholesterol">
				<thead>
					<tr>
						<th>Document Name</th>
						<th>Patient Name</th>
						<th>Received On</th>
                        <th>Notified</th>
                        <th>Notified On</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>			
				<?php
					foreach ( $ReceivedDocumentData as $keyDocument => $valueDocument )
					{ //print "<pre>";print_r($valueDocument);die;
				?>
						<tr>
							<td class="text-left" style="text-align: left;">
								<?php
									if (isset($valueDocument['Document']) && !empty($valueDocument['Document']))
									{
										echo $valueDocument['Document'];
									}
								?>
							</td>
							<td class="text-left" style="text-align: left;">
								<?php
									if (isset($valueDocument['PatientName']) && !empty($valueDocument['PatientName']))
									{
										echo $valueDocument['PatientName'];
									}
								?>
							</td>
							<td>
								<?php
									if (isset($valueDocument['SubmittedOn']) && !empty($valueDocument['SubmittedOn']))
									{
										echo date("m/d/Y h:i A", strtotime($valueDocument['SubmittedOn']));
									}
								?>
							</td>
                            <td>
								<?php
									if (isset($valueDocument['notifyPatient']) && $valueDocument['notifyPatient'] == 1)
									{
										echo "<i class='fa fa-check'></i>";
									}
									else
									{
										echo "<i class='fa fa-close'></i>";
									}
								?>
							</td>
                            <td>
								<?php
									if (isset($valueDocument['notifyDatetime']) && $valueDocument['notifyDatetime'] != '')
									{
										echo date("m/d/Y h:i A", strtotime($valueDocument['notifyDatetime']));
									}
									else
									{
										echo "-";
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
													<?php if (isset($valueDocument['documentpdffile']) && !empty($valueDocument['documentpdffile']) && file_exists(FILE_PATH."assets/upload/pdf/".$valueDocument['documentpdffile'])):?>
														<a title="View" href="<?php echo Yii::app ()->params->base_url."assets/upload/pdf/".$valueDocument['documentpdffile'];?>" target="_blank">View</a>
													<?php endif;?>
												</li>
                                                <?php if( $valueDocument['notifyPatient'] == 0) { ?>
												<li role="presentation">
													<a title="Notify" href="javascript:void(0);" onclick="notifyPatient('<?php echo $valueDocument['documentsubmittedlogid']; ?>', '<?php echo $valueDocument['patient_id']; ?>')">Notify</a>
												</li>
                                                <?php } ?>
											</ul>
										</li>
									</ul>
								</div>
							</td>
						</tr>
				<?php 
					} 
				?>
				</tbody>
			</table>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>