<div id="patientDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Documents</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
					<i class="fa fa-angle-right "></i> Documents
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
						<th>Created Date</th>
						<th>Last Submitted Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>			
				<?php
					if (isset($DocumentData) && is_array($DocumentData) && count($DocumentData)>0)
					{
						
						
						foreach ( $DocumentData as $keyDocument => $valueDocument )
						{
				?>
							<tr>
								<td class="text-left" style="text-align: left;">
									<?php
										if (isset($valueDocument['documentname']) && !empty($valueDocument['documentname']))
										{
											echo $valueDocument['documentname'];
										}
									?>
								</td>
								<td>
									<?php
										if (isset($valueDocument['createddate']) && !empty($valueDocument['createddate']))
										{
											echo date("m/d/Y", strtotime($valueDocument['createddate']));
										}
									?>
								</td>
								<td>
									<?php
										if (isset($valueDocument['modifieddate']) && !empty($valueDocument['modifieddate']))
										{
											echo date("m/d/Y", strtotime($valueDocument['modifieddate']));
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
														<a title="View" href="<?php echo Yii::app()->params->base_path;?>patient/<?php echo $valueDocument['viewaction'];?>">View</a>
													</li>
													<li role="presentation">
														<a title="Submit" href="<?php echo Yii::app()->params->base_path;?>patient/addDocumentForms/documentid/<?php echo $valueDocument['documentid'] ?>">Submit</a>
													</li>
												</ul>
											</li>
										</ul>
									</div>
								</td>
							</tr>
				<?php 
						}
					} 
				?>
				</tbody>
			</table>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>