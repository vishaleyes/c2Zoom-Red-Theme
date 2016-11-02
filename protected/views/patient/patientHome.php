<style>
table {
	border-spacing: 3px;
}

td {
	padding: 8px;
	color: #7A6666
}
</style>
<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Home</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li><i class="fa fa-home"></i> Home</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">Measurements</div>
			</div>
			<div class="portlet-body">
				<div class="row marg-btm20px">
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-leaf pull-left"></i>Blood Glucose
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/bloodGlucoseListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addBloodGlucose">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-heart pull-left"></i>Blood Pressure
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/bloodPressureListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addBloodPressure">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-gittip pull-left"></i>Cholesterol
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/cholesterolListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addCholesterol">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-arrows-v pull-left"></i>Height
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/heightListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addHeight">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row marg-btm20px">
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-tachometer pull-left"></i>Weight
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/weightListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addWeight">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-3"></div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>
<div class="row ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">Heath History</div>
			</div>
			<div class="portlet-body">
				<div class="row marg-btm20px">
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-dribbble pull-left"></i>Allergies
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/allergyListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addAllergy">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-plus-square pull-left"></i>Anesthesia
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/anaesthesiaListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addAnethesiaHistory">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-plus-square pull-left"></i>Family History
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="Edit" href="<?php echo Yii::app()->params->base_path;?>patient/addFamilyHistory">Edit</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-filter pull-left"></i>Immunization
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/immunizationListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addImmunization">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row marg-btm20px">
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-ticket pull-left"></i>Medication
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/medicationListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addMedication">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-plus-square pull-left"></i>Medical History
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="Edit" href="<?php echo Yii::app()->params->base_path;?>patient/editMedicalHistoryListing">Edit</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-gears pull-left"></i>Procedure
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/procedureListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addProcedure">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-plus-square pull-left"></i>Social History
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="Edit" href="<?php echo Yii::app()->params->base_path;?>patient/addSocialHistory">Edit</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row marg-btm20px">
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-plus-square pull-left"></i>Surgery History
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/surgoryHistoryListing">List</a>
											</li>
											<li role="presentation">
												<a title="Add" href="<?php echo Yii::app()->params->base_path;?>patient/addSurgoryHistory">Add</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-plus-square pull-left"></i>Symptoms
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="Edit" href="<?php echo Yii::app()->params->base_path;?>patient/addSymptoms">Edit</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>

<div class="row ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">Forms</div>
			</div>
			<div class="portlet-body">
				<div class="row marg-btm20px">
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-check-circle-o pull-left"></i>HIPAA - Authorization For Release
							</div>
							<div class="btn-group pull-right">
								<!-- Single button -->
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="HIPAA - Authorization For Release" href="<?php echo Yii::app()->params->base_path;?>patient/getAllFormsForUser">List</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>

<div class="row ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">Contact & Insurance</div>
			</div>
			<div class="portlet-body">
				<div class="row marg-btm20px">
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-check-circle-o pull-left"></i>Emergency or Provider
							</div>
							<!-- 
							<div class="btn-group pull-right">
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/cholesterolListing">List</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
							-->
						</div>
					</div>
					<div class="col-md-3">
						<div class="pull-left nav-shortmenu">
							<div class="pull-left nav-shortmenu-head">
								<i class="fa fa-check-circle-o pull-left"></i>Insurance Plan
							</div>
							<!-- 
							<div class="btn-group pull-right">
								<ul class="nav pull-right">
									<li id="fat-menu" class="dropdown">
										<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
										<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
											<li role="presentation">
												<a title="List" href="<?php echo Yii::app()->params->base_path;?>patient/cholesterolListing">List</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
							-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->
