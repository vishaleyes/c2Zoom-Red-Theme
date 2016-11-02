<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Procedure</h3>
		<ul class="page-breadcrumb breadcrumb">

			<li><a
				href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i> Health History <i
				class="fa fa-angle-right "></i> <a
				href="<?php echo Yii::app()->params->base_path ; ?>patient/procedureListing">
					Procedure</a> <i class="fa fa-angle-right "></i>
                              <?php if(isset($_REQUEST['procedure_id']) && $_REQUEST['procedure_id']!=''){ ?>
                            Update Procedure
                              <?php } else { ?>
                            Add Procedure
                            <?php } ?>
						</li>

		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row" id="ProcedureDiv">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gears"></i>
                                <?php if(isset($_REQUEST['procedure_id']) && $_REQUEST['procedure_id']!=''){ ?>
                            Update Procedure
                               <?php } else { ?>
                              Add Procedure
                                <?php } ?>
							</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>

				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form
					action="<?php echo Yii::app()->params->base_path ; ?>patient/saveProcedure"
					id="form_procedure" class="form-horizontal" method="post">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>

						<div class="row">
							<div class="col-md-6">



								<div class="form-group">
									<label class="control-label col-md-4">Name<span
										class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" name="name" data-required="1"
											class="form-control" placeholder="Ex. Name"
											value="<?php
											if (isset ( $procedureData ['name'] ) && ($procedureData ['name']) != '') {
												echo $procedureData ['name'];
											}
											?>"/ ><span class="col-md-6" style="color: red"><?php echo $validationError['nameErr'] ?></span>
									</div>

								</div>

								<div class="form-group">
									<label class="control-label col-md-4">When Performed<span
										class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input
											class="form-control form-control-inline input date-picker"
											data-required="1" size="16" data-date-format="mm/dd/yyyy"
											data-date-start-date="-105y" data-date-end-date="+0d"
											readonly="readonly" autocomplete="off"
											placeholder="Ex. <?php echo date("Y-m-d") ?>"
											id="when_performed" name="when_performed" type="text"
											value="<?php
											if (isset ( $procedureData ['when_performed'] ) && ($procedureData ['when_performed']) != '') {
												echo date ( "m/d/Y", strtotime ( $procedureData ['when_performed'] ) );
											} else {
												echo date ( "m/d/Y" );
											}
											?>"/ > <span class="col-md-12" style="color: red"><?php echo $validationError['when_performedErr'] ?></span>

									</div>

								</div>



							</div>

							<div class="col-md-6">

								<div class="form-group">
									<label class="control-label col-md-4">Body Location<span
										class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" name="body_location" data-required="1"
											class="form-control" placeholder="Ex. Head"
											value="<?php
											if (isset ( $procedureData ['body_location'] ) && ($procedureData ['body_location']) != '') {
												echo $procedureData ['body_location'];
											}
											?>"/ ><span class="col-md-6" style="color: red"><?php echo $validationError['body_locationErr'] ?></span>
									</div>

								</div>

								<div class="form-group">
									<label class="control-label col-md-4">Provider <span
										class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" name="provider" data-required="1"
											class="form-control" placeholder="Ex. Doctor's name"
											value="<?php
											if (isset ( $procedureData ['provider'] ) && ($procedureData ['provider']) != '') {
												echo $procedureData ['provider'];
											}
											?>"/ ><span class="col-md-6" style="color: red"><?php echo $validationError['providerErr'] ?></span>
									</div>

								</div>

								<div class="form-group">
									<label class="control-label col-md-4">Notes</label>
									<div class="col-md-8">
										<textarea rows="3" class="form-control" name="notes"><?php
										if (isset ( $procedureData ['notes'] ) && ($procedureData ['notes']) != '') {
											echo $procedureData ['notes'];
										}
										?></textarea>
									</div>
								</div>

							</div>

						</div>

					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-2 col-md-10">

							<input type="hidden" name="procedure_id"
								value="<?php echo $_REQUEST['procedure_id']; ?>" />

							<button type="submit" name="saveProcedure" class="btn green">Submit</button>
							<a class="btn red"
								href="<?php echo Yii::app()->params->base_path ; ?>patient/procedureListing">Cancel</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->
