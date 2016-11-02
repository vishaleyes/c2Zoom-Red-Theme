<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Anesthesia History?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteAnethesiaHistory/patient_anethesia_id/"+id;
		}else{
			return true;
		}
	});
	
}
</script>
	<div id="anethesiaDiv">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Anesthesia History
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                            
							Anesthesia History
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
					<div>
                            <a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addAnethesiaHistory"><i class="fa fa-plus"></i>&nbsp;Add</a>
                            </div>
                             <br />
							<table class="table table-striped table-hover" id="sample_cholesterol">
							<thead>
							<tr>
								<th style="text-align:center;">
									 Anesthesia Type
								</th>
								<th style="text-align:center;">
									 Report Date
								</th>
								<th style="text-align:center;">
									Reaction
								</th>
								<th style="text-align:center;">
									Notes
								</th>
                                <th style="text-align:center;">
									Created Date
								</th>
                                <th style="text-align:center">
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							
                            <?php
													
							foreach($anaesthesiaList as $row)
							{
							?>
                           
							<tr>
                            	<td>
                                     <?php echo $row['anethesia_type'];  ?> 
								</td>
                               
								<td>
									 <?php echo date("m/d/Y",strtotime($row['report_date'])); ?>
								</td>
                                 
								<td >
									 <?php echo $row['reaction']; ?>
								</td>
                                
                                <td >
									 <?php echo $row['notes']; ?>
								</td>
                                 
                                <td><?php echo date("m/d/Y h:i A",strtotime($row['createdAt'])) ; ?></td>
                                <td>
                                 <div class="btn-group"> 
                    <!-- Single button -->
                    <ul class="nav pull-right">
                      <li id="fat-menu" class="dropdown"><span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                          <li role="presentation"><a data-toggle="modal" href="#basic<?php echo $row['patient_surgery_id'] ?>">View</a></li>
                          <li role="presentation"><a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addAnethesiaHistory/patient_anethesia_id/<?php echo $row['patient_anethesia_id'] ?>">Edit</a></li>
                          <li role="presentation"><a title="Delete" onclick="confirmDelete(<?php echo $row['patient_anethesia_id'] ?>)" href="#" >Delete</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="modal fade" id="basic<?php echo $row['patient_surgery_id'] ?>" tabindex="-1" role="basic" aria-hidden="true" >
  				
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Anesthesia Details</h4>
										</div>
										<div class="modal-body">
											 
                                             <table class="model_table" width="100%">
                                             

                                             <tr>
                                                 <th width="30%">Anesthesia Type</th>
                                                
												<td width="70%" style="text-align:left" >
													 <?php echo $row['anethesia_type'];  ?> 
												</td>
                                             </tr>
                                             <tr>
                                                 <th>Report Date</th>
                                                 
												<td style="text-align:left">
													 <?php echo date("m/d/Y",strtotime($row['report_date'])); ?>
												</td>
                                             </tr>
                                             <tr>
                                                 <th>Reaction</th>
                                                  
												<td style="text-align:left">
													 <?php echo $row['reaction']; ?>
												</td>
                                             </tr>
                                             <tr>
                                                 <th>Notes</th>
                                                 
												<td style="text-align:left">
													 <?php echo $row['notes']; ?>
												</td>
                                             </tr>
                                             <?php
												if(trim($row['created_at']) != "" ) 
												{ $created_at = date("m/d/Y h:i A",strtotime($row['createdAt']));} 
												else 
												{ $created_at = "" ; } 
											?>
                                             <tr>
                                                 <th>Created Date</th>
												 <td style="text-align:left">
													  <?php echo $created_at ?>
												 </td>
                                             </tr>
                                             
                                             <?php
												if(trim($row['modifiedAt']) != "" ) 
												{ $modified_at = date("m/d/Y h:i A",strtotime($row['modifiedAt']));} 
												else 
												{ $modified_at = "" ; } 
											?>
                                             <tr>
                                                 <th>Modified Date</th>
												 <td style="text-align:left">
													  <?php echo $modified_at ?>
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
     