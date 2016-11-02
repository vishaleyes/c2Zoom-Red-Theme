<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Surgory History?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteSurgoryHistory/patient_surgery_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
<div id="surgoryDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Surgery History</h3>
			<ul class="page-breadcrumb breadcrumb">

				<li><a
					href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
					<i class="fa fa-angle-right "></i> Health History <i
					class="fa fa-angle-right "></i> Surgery History</li>

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
				<a class="btn grey"
					href="<?php echo Yii::app()->params->base_path ; ?>patient/addSurgoryHistory"><i
					class="fa fa-plus"></i>&nbsp;Add</a>
			</div>
			<br />
			<table class="table table-striped table-hover"
				id="sample_cholesterol">
				<thead>
					<tr>
						<th style="text-align: center;">Procedure</th>
						<th style="text-align: center;">Year</th>
						<th style="text-align: center;">Surgeon</th>
						<th style="text-align: center;">Hospital</th>
						<!-- <th style="text-align: center;">Creaeted At</th> -->
						<th style="text-align: center">Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
					foreach ( $surgoryList as $row ) {
						?>
					
					<tr>
							
							<?php
						if (trim ( $row ['procedure'] ) != "") {
							$procedure = $row ['procedure'];
							$procedure_style = "text-align:left";
						} else {
							$procedure = "";
							$procedure_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $procedure  ?> 
						</td>
						<?php
						if (trim ( $row ['Year'] ) != "") {
							$Year = $row ['Year'];
							$Year_style = "text-align:left";
						} else {
							$Year = "";
							$Year_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $Year; ?>
						</td>
						 <?php
						if (trim ( $row ['surgeon'] ) != "") {
							$surgeon = $row ['surgeon'];
							$surgeon_style = "text-align:left";
						} else {
							$surgeon = "";
							$surgeon_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $surgeon?>
						</td>
						 <?php
						if (trim ( $row ['hospital'] ) != "") {
							$hospital = $row ['hospital'];
							$hospital_style = "text-align:left";
						} else {
							$triglycerideshospital = "";
							$hospital_style = "text-align:center";
						}
						?>
						<td>
							 <?php echo $hospital?>
						</td>
						<!-- <td><?php echo date("m/d/Y h:i A",strtotime($row['createdAt'])); ?></td> -->
						<td>
							<div class="btn-group">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown"><span id="drop3"
										role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation"><a data-toggle="modal"
												href="#basic<?php echo $row['patient_surgery_id'] ?>">View</i></a></li>
											<li role="presentation"><a title="Edit"
												href="<?php echo Yii::app()->params->base_path ; ?>patient/addSurgoryHistory/patient_surgery_id/<?php echo $row['patient_surgery_id'] ?>">Edit</a></li>
											<li role="presentation"><a title="Delete"
												onclick="confirmDelete(<?php echo $row['patient_surgery_id'] ?>)"
												href="#">Delete</a></li>
										</ul></li>
								</ul>
							</div>

							<div class="modal fade"
								id="basic<?php echo $row['patient_surgery_id'] ?>" tabindex="-1"
								role="basic" aria-hidden="true">

								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true"></button>
											<h4 class="modal-title">Surgery Details</h4>
										</div>
										<div class="modal-body">

											<table class="model_table" width="100%">


												<tr>
													<th width="30%">Procedure</th>

													<td width="70%" style="text-align: left;">
											 <?php echo $procedure  ?> 
										</td>
												</tr>
												<tr>
													<th>Year</th>

													<td style="text-align: left;">
											 <?php echo $Year?>
										</td>
												</tr>
												<tr>
													<th>Surgeon</th>

													<td style="text-align: left;">
											 <?php echo $surgeon?>
										</td>
												</tr>
												<tr>
													<th>Hospital</th>

													<td style="text-align: left;">
											 <?php echo $hospital?>
										</td>
												</tr>
									 <?php
						if (trim ( $row ['created_at'] ) != "") {
							$created_at = date ( "m/d/Y h:i A", strtotime ( $row ['createdAt'] ) );
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
						if (trim ( $row ['modifiedAt'] ) != "") {
							$modified_at = date ( "m/d/Y h:i A", strtotime ( $row ['modifiedAt'] ) );
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
