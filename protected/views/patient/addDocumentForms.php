<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">Documents</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
				<i class="fa fa-angle-right "></i>
						Add Document 			
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row" id="DocumentDiv">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-user"></i>
							Add Document					
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?php echo Yii::app()->params->base_path ; ?>patient/addDocumentForms" id="form_patient_profile" class="form-horizontal" method="post">
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
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group">
									<label class="control-label col-lg-2 col-sm-2 col-md-2 col-xs-3">Doctor</label>
									<div class="col-lg-4 col-sm-6 col-md-6 col-xs-9">
										<select name="doctor" id="doctor" class="form-control bs-select selectpicker" aria-required="true" aria-invalid="false" >										
											<option value=""> - Select Doctor -</option>
										<?php foreach ($PatientAppointmentData as $AppointmentData) { ?>
											<option value="<?php echo $AppointmentData['doctor_id']?>"><?php echo $AppointmentData['name']." ".$AppointmentData['surname']. " (".date("m/d/Y h:i A", strtotime($AppointmentData['appointment_date']." ".$AppointmentData['appointment_time'])).")";?></option>
										<?php } ?>
										</select>																		
									</div>
								</div>
							</div>
						</div>
						<?php if(isset($_REQUEST['documentid']) && !empty($_REQUEST['documentid']) && $_REQUEST['documentid']==1) :?>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group">
									<label class="control-label col-lg-2 col-sm-2 col-md-2 col-xs-12">How did you learn about our practice?</label>
									<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
										<div class="text-center pull-left padd-rght10px">
											<input type="radio" name="howyoulearnaboutourpractice" class="form-control placeholder-no-fix" value="Website" />
										</div>
										<div class="text-center pull-left" style="margin-top: 7px;">Website</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
										<div class="text-center pull-left padd-rght10px">
											<input type="radio" name="howyoulearnaboutourpractice" class="form-control placeholder-no-fix" value="Referring Physician" />
										</div>
										<div class="text-center pull-left" style="margin-top: 7px;">Referring Physician</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
										<div class="text-center pull-left padd-rght10px">
											<input type="radio" name="howyoulearnaboutourpractice" id="Magazine" class="form-control placeholder-no-fix" value="Magazine" />
										</div>
										<div class="text-center pull-left" style="margin-top: 7px;">Magazine (please name which magazine)</div>
									</div>
									<div id="MagazineDivText" class="col-lg-3 col-sm-6 col-md-6 col-xs-12 display-hide">
										<div class="text-center padd-rght10px">
											<input type="text" id="Magazinetext" name="Magazinetext" class="form-control placeholder-no-fix" placeholder="please name which magazine" value="" />
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
										<div class="text-center pull-left padd-rght10px">
											<input type="radio" name="howyoulearnaboutourpractice" class="form-control placeholder-no-fix" value="Friend" />
										</div>
										<div class="text-center pull-left" style="margin-top: 7px;">Friend</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
										<div class="text-center pull-left padd-rght10px">
											<input type="radio" name="howyoulearnaboutourpractice" class="form-control placeholder-no-fix" value="Other (please name)" />
										</div>
										<div class="text-center pull-left" style="margin-top: 7px;">Other (please name)</div>
									</div>
									<div id="OtherDivText" class="col-lg-3 col-sm-6 col-md-6 col-xs-12 display-hide">
										<div class="text-center padd-rght10px">
											<input type="text" id="Othertext" name="Othertext" class="form-control placeholder-no-fix" placeholder="Other (please name)" value="" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"><h4>Physician Referring You To Our Practice:</h4></div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
								<div class="form-group">
									<label class="control-label col-lg-4 col-sm-4 col-md-4 col-xs-4">Dr.</label>
									<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
										<input type="text" class="form-control placeholder-no-fix"  name="dr" id="dr" value="" placeholder="Dr." />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4 col-sm-4 col-md-4 col-xs-4">Address</label>
									<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
										<textarea rows="3" class="form-control" id="address" name="address"></textarea>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
								<div class="form-group">
									<label class="control-label col-lg-4 col-sm-4 col-md-4 col-xs-4">Phone #</label>
									<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
										<input type="text" class="form-control placeholder-no-fix"  name="phone" id="phone" value="" placeholder="Phone #" />
									</div>
								</div>
							</div>
						</div>
						<?php elseif(isset($_REQUEST['documentid']) && !empty($_REQUEST['documentid']) && $_REQUEST['documentid']==2) :?>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"><h4>Chief Complaint:</h4></div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
								<div class="form-group">
									<label class="control-label col-lg-4 col-sm-4 col-md-4 col-xs-4">What is the problem you are being seen for today?</label>
									<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
										<textarea rows="3" class="form-control" id="whatistheproblemseentoday" name="whatistheproblemseentoday"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4 col-sm-4 col-md-4 col-xs-4">When did this begin? (Mo/day/year)?</label>
									<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
										<input class="form-control form-control-inline input date-picker" data-required="1" size="16" readonly="readonly" data-date-format="mm/dd/yyyy" data-date-end-date="+0d" autocomplete="off" id="whendidthisbegin" name="whendidthisbegin" type="text" value="<?php echo date("m/d/Y");?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-4 col-sm-4 col-md-4 col-xs-4">How did this begin?</label>
									<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
										<textarea rows="3" class="form-control" id="howdidthisbegin" name="howdidthisbegin"></textarea>
									</div>
								</div>
							</div>
						</div>
						<?php endif;?>
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<input type="hidden" id="documentid" name="documentid" value="<?php echo $_REQUEST['documentid']; ?>" />
							<button type="submit" name="saveDocuments" value="Save" class="btn green">Submit</button>
							<a class="btn grey" href="javascript:void(0);" data-toggle="modal" data-target=".bs-preview-modal-lg">Preview</a>
							<a class="btn default" href="<?php echo Yii::app()->params->base_path ; ?>patient/getAllFormsForUser">Cancel</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- Add dialog box start -->
<div class="modal fade bs-preview-modal-lg" id="bs-preview-modal-lg" tabindex="<?php echo $i; ?>" role="basic" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-login" id="PreviewDiv">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" data-dismiss="modal" class="close" type="button"></button>
			</div>
			<div class="modal-body login_container padding0">
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
						<div id="previewBodyContent"></div>
					<!-- END FORM-->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Add dialog box End -->
<script type="text/javascript">
$("document").ready(function(){
	$("#bs-preview-modal-lg").on("show.bs.modal", function(e) {
		$('.modal-body').css('overflow-y', 'auto'); 
		$('.modal-body').css('height',$( window ).height()*0.8);
		if ($("#documentid").val()==1)
		{
			$.ajax({
				  type: "POST",
				  url: "<?php echo Yii::app()->params->base_path ; ?>patient/addDocumentForms",
				  data: { 
					  		doctor: $("#doctor").val(), 
					  		howyoulearnaboutourpractice: $('input:radio[name="howyoulearnaboutourpractice"]:checked').val(), 
					  		Magazinetext: $("#Magazinetext").val(), 
					  		Othertext: $("#Othertext").val(),
					  		dr: $("#dr").val(),
					  		address: $("#address").val(),
					  		phone: $("#phone").val(),
					  		documentid: $("#documentid").val(),
					  		previewDocuments: "Preview"
					  	},
				  success: function(strData){
					  $("#bs-preview-modal-lg").find(".modal-body").html(strData);
					  $('.modal-body div.container').removeClass("container");
				 	}
				});	
		}
		else if ($("#documentid").val()==2)
		{
			$.ajax({
				  type: "POST",
				  url: "<?php echo Yii::app()->params->base_path ; ?>patient/addDocumentForms",
				  data: { 
					  		doctor: $("#doctor").val(), 
					  		whatistheproblemseentoday: $("#whatistheproblemseentoday").val(), 
					  		whendidthisbegin: $("#whendidthisbegin").val(),
					  		howdidthisbegin: $("#howdidthisbegin").val(),
					  		documentid: $("#documentid").val(),
					  		previewDocuments: "Preview"
					  	},
				  success: function(strData){
					  $("#bs-preview-modal-lg").find(".modal-body").html(strData);
					  $('.modal-body div.container').removeClass("container");
				 	}
				});
		}
	});
// 	$("#previewDocuments").click(function(){
// 		$.ajax({
// 			  type: "POST",
//			  url: "<?php echo Yii::app()->params->base_path ; ?>patient/addDocumentForms",
// 			  data: { 
// 				  		doctor: $("#doctor").val(), 
// 				  		howyoulearnaboutourpractice: $('input:radio[name="howyoulearnaboutourpractice"]').val(), 
// 				  		Magazinetext: $("#Magazinetext").val(), 
// 				  		Othertext: $("#Othertext").val(),
// 				  		dr: $("#dr").val(),
// 				  		address: $("#address").val(),
// 				  		phone: $("#phone").val(),
// 				  		documentid: $("#documentid").val(),
// 				  		previewDocuments: $("#previewDocuments").val()
// 				  	},
// 			  success: function(strData){
// 				  		$("previewBodyContent").html(strData);
// 				  		//$("#bs-preview-modal-lg").on("show.bs.modal");
// 				 	}
// 			});
// 	});
	
	$('input:radio[name="howyoulearnaboutourpractice"]').change(function(){
		if ($(this).is(':checked') && $(this).val() == 'Magazine')
		{
			// display additional text box.
			$("#OtherDivText").hide();
			$("#MagazineDivText").show();
		}
		else if ($(this).is(':checked') && $(this).val() == 'Other (please name)')
		{
			$("#MagazineDivText").hide();
			$("#OtherDivText").show();
		}
		else if ($(this).is(':checked') && $(this).val() != 'Magazine')
		{
			$("#MagazineDivText").hide();
			$("#OtherDivText").hide();
		}
	});
	
});
</script>