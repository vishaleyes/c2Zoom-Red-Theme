<style>
.model_table {border-spacing: 5px;}
.model_table td    {padding: 8px; color:#7A6666}
.model_table th    {color:#fff}
</style>

<script>
function confirmDelete(id)
{
	bootbox.confirm("Are you sure want to delete Image?", function(confirmed) {
		
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/deleteImage/image_id/"+id;
		}
		else
		{
			return true;
		}
	});
	
}
</script>

<div id="patientDiv">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
				Image Manager
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					
					<li>
						<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
						<i class="fa fa-angle-right "></i> Image Manager
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
							<a class="btn grey" href="<?php echo Yii::app()->params->base_path ; ?>patient/addImage"><i class="fa fa-plus"></i>&nbsp;Add</a>
							</div>
							<br/>   
							
							<table class="table table-striped table-hover" id="sample_cholesterol">
							<thead>
							<tr>
                            	<th>Photo</th>
								<th>Image Name</th>								
								<th>Notes</th>
                                <th>Created Date</th>
                                <th>Actions</th>
							</tr>
							</thead>
							<tbody>							
                         
							<?php													
						foreach($imageData as $row)
						{
						?>
                           
							<tr>                            
							<td>
							 <?php
							 	if(file_exists(FILE_PATH."assets/upload/avatar/filemanager/patient/".Yii::app()->session['pingmydoctor_patient']."/".$row['image_name'])):
							 		$url = Yii::app()->params->base_url."assets/upload/avatar/filemanager/patient/".Yii::app()->session['pingmydoctor_patient']."/".$row['image_name'];
							 	 else:
							 	 	$url = Yii::app()->params->base_url."assets/default.png";
							 	 endif;
							 ?>
					     			<img alt="" class="img-circle" height="35px" width="35px" src="<?php echo $url ; ?>"/>
					     	</td>                               
							<td>
								 <?php echo $row['image_name']; ?>
							</td>                                                               
							<td>
								 <?php echo $row['notes']; ?>
							</td>
							<td>
								<?php echo date("m/d/Y",strtotime($row['created_at']));  ?> 
							</td>
                             <td>
                                <div class="btn-group">
										<ul class="nav pull-right">
											<li id="fat-menu" class="dropdown"><span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
												<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
													<li role="presentation">
														<a data-toggle="modal" href="#basic<?php echo $row['image_id'] ?>">View</a>
													</li>
													<li role="presentation">
														<a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>patient/addImage/image_id/<?php echo $row['image_id'] ?>">Edit</a>
													</li>
													<li role="presentation">
														<a title="Delete" onclick="confirmDelete(<?php echo $row['image_id'] ?>)" href="#" >Delete</a>														
														</li>													
													</ul>
												</li>
											</ul>
										</div> 
										<div class="modal fade" id="basic<?php echo $row['image_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
															<h4 class="modal-title">Image Details</h4>
														</div>
														<div class="modal-body">
															<table class="model_table" width="100%">
																<tr>																	
																	<td width="70%" style="text-align: left">
																		<img alt="<?php echo $row['image_name'];?>" class="img-responsive" src="<?php echo $url ; ?>"/> 
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
											</div> <!-- /.modal window-->  
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