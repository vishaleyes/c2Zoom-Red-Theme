<script>
function confirmSelect(id)
{
	bootbox.confirm("Are you sure want to share info with this doctor?", function(confirmed) {
		if(confirmed == true)
		{
			window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/selectDoctor/doct_pat_relation_id/"+id;
		}
		else{
			return true;
		}
	});
}
function confirmRemove(id,type)
{
	bootbox.confirm("Are you sure want to stop sharing info with this doctor?", function(confirmed) {
		if(confirmed == true)
			{
				window.location.href = "<?php echo Yii::app()->params->base_path;?>patient/removeDoctor/doct_pat_relation_id/"+id+"&doctor_type="+type;
			}else{
				return true;
			}
		});
}
</script>
<div id="medicationDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Doctor Selection</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a>
					<i class="fa fa-angle-right "></i> Doctors</li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<table class="table table-striped table-hover" id="sample_cholesterol">
				<thead>
					<tr>
						<th>No</th>
						<th>Photo</th>
						<th>
							<a href="javascript:void(0);" class="sort" lang='<?php echo Yii::app()->params->base_path;?>patient/doctorListing/sortType/<?php echo $ext['sortType'];?>/sortBy/name/keyword/<?php echo $ext['keyword'];?>'>
								Firstname
								<?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'name'){ ?>
									<i class="ico-chevron-down pull-right"></i>
								<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'name'){?>
									<i class="ico-chevron-up pull-right"></i>
								<?php }?>
							</a>
						</th>
						<th>
							<a href="javascript:void(0);" class="sort" lang='<?php echo Yii::app()->params->base_path;?>patient/doctorListing/sortType/<?php echo $ext['sortType'];?>/sortBy/surname/keyword/<?php echo $ext['keyword'];?>'>
								Lastname
								<?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'surname'){ ?>
									<i class="ico-chevron-down pull-right"></i>
								<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'surname'){?>
									<i class="ico-chevron-up pull-right"></i>
								<?php }?>
							</a>
						</th>
						<th>Shared</th>
						<th>
							<a href="javascript:void(0);" class="sort" lang='<?php echo Yii::app()->params->base_path;?>patient/doctorListing/sortType/<?php echo $ext['sortType'];?>/sortBy/qualification/keyword/<?php echo $ext['keyword'];?>'>
								Qualification
								<?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'qualification'){ ?>
									<i class="ico-chevron-down pull-right"></i>
								<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'qualification'){?>
									<i class="ico-chevron-up pull-right"></i>
								<?php }?>
							</a>
						</th>
						<th>
							<a href="javascript:void(0);" class="sort" lang='<?php echo Yii::app()->params->base_path;?>patient/doctorListing/sortType/<?php echo $ext['sortType'];?>/sortBy/doctor_mobile/keyword/<?php echo $ext['keyword'];?>'>
								Phone
								<?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'doctor_mobile'){ ?>
									<i class="ico-chevron-down pull-right"></i>
								<?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] == 'doctor_mobile'){?>
									<i class="ico-chevron-up pull-right"></i>
								<?php }?>
							</a>
						</th>
						<th>Type</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						foreach ( $doctorList as $row )
						{
					?>
							<tr>
								<td style="text-align: center">
									<?php echo $i; ?>
								</td>
								<td style="text-align: center">
									<?php
										if (isset ( $row ['doctor_image'] ) && !empty($row ['doctor_image']))
										{
											if (file_exists ( FILE_UPLOAD."avatar/doctor/" . $row ['doctor_image'] ))
											{
									?>
												<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/<?php echo $row['doctor_image']; ?>" width="24" height="24" />
									<?php 
											}
											else
											{
									?>
												<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/default.png" width="24" height="24" />
									<?php
											}
										}
										else
										{
									?>
											<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/default.png" width="24" height="24" />
									<?php
										}
									?>
								</td>
								<td>
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
										echo $name;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['surname'] ) != "")
										{
											$surname = $row ['surname'];
											$surname_style = "text-align:left";
										}
										else
										{
											$surname = "---";
											$surname_style = "text-align:center";
										} 
										echo $surname;
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['is_share'] ) != "")
										{
											$is_share = $row ['is_share'];
											$is_share_style = "text-align:left";
										}
										else
										{
											$is_share = "---";
											$is_share_style = "text-align:center";
										} 
										if(isset($is_share) && $is_share == 1)
										{
											echo '<i class="fa fa-check-square"></i>';
										}
										else
										{
											echo '<i class="fa fa-close "></i>';
										} 
									?>
								</td>
								<td>
									<?php
										if (trim ( $row ['qualification'] ) != "")
										{
											$qualification = $row ['qualification'];
											$qualification_style = "text-align:left";
										}
										else
										{
											$qualification = "---";
											$qualification_style = "text-align:center";
										} 
										echo $qualification;
									?> 
								</td>
								<td>
									<?php 
										if (trim ( $row ['doctor_mobile'] ) != "")
										{
											$doctor_mobile = $row ['doctor_mobile'];
											$doctor_mobile_style = "text-align:left";
										}
										else
										{
											$doctor_mobile = "---";
											$doctor_mobile_style = "text-align:center";
										}
										echo $doctor_mobile;
									?> 
								</td>
								<td>
									<?php
										if (isset ( $row ['doctor_type'] ))
										{
											if ($row ['doctor_type'] == 'PCP')
											{
												echo "<span class='label label-success'>PCP</span>";
											}
											if ($row ['doctor_type'] == 'ACP')
											{
												echo "<span class='label label-warning'>ACP</span>";
											}
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
											<li id="fat-menu" class="dropdown"><span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b></span>
												<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
													<li role="presentation"><a data-toggle="modal" href="#basic<?php echo $row['doctor_id'] ?>">View</a></li>
													<li role="presentation">
														<?php  if($row['is_share'] != 1) { ?>                                 
															<a title="Select" onclick="confirmSelect(<?php echo $row['doct_pat_relation_id'] ?>)" href="#">Select</a>
														<?php } ?>
													</li>
													<li role="presentation">                                 
														<?php  if($row['is_share'] == 1) { ?>
															<a title="Remove" onclick="confirmRemove(<?php echo $row['doct_pat_relation_id'] ?>,'<?php echo $row['doctor_type']; ?>')" href="#">Remove</a>
														<?php } ?>
													</li>
												</ul>
											</li>
										</ul>
									</div>
									<div class="modal fade" id="basic<?php echo $row['doctor_id'] ?>" tabindex="-1" role="basic" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h4 class="modal-title">Doctor Details</h4>
												</div>
												<div class="modal-body">
													<table class="model_table" width="100%">
														<tr>
															<th>Photo</th>
															<td style="text-align: left">
																<?php
																	if (isset ( $row ['doctor_image'] ) && !empty($row ['doctor_image']))
																	{
																		if (file_exists ( FILE_UPLOAD."avatar/doctor/" . $row ['doctor_image'] ))
																		{
																?>
																			<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/<?php echo $row['doctor_image']; ?>" width="100" height="100" />
																<?php 
																		}
																		else
																		{
																?>
																			<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/default.png" width="100" height="100" />
																<?php
																		}
																	}
																	else
																	{
																?>
																		<img class="img-circle" src="<?php echo Yii::app()->params->base_url;?>assets/upload/avatar/doctor/default.png" width="100" height="100" />
																<?php
																	}
																?>
															</td>
														</tr>
														<tr>
															<th>Fullname</th>
															<td style="text-align: left;"><?php echo $name." ".$surname; ?></td>
														</tr>
														<tr>
															<th>Gender</th>
															<td style="text-align: left;">
																<?php
																	if (trim($row['gender']) == "0")
																	{
																		$gender = "Female";
																	}
																	else
																	{
																		$gender = "Male";
																	}
																	echo $gender;
																?>
															</td>
														</tr>
														<tr>
															<th>Birthday</th>
															<td style="text-align: left;">
																<?php 
																	if (trim($row['dob']) != "")
																	{
																		$dob = date ("m/d/Y", strtotime($row['dob']));
																	}
																	else
																	{
																		$dob = "";
																	}
																	echo $dob;
																?>
															</td>
														</tr>
														<tr>
															<th>Address</th>
															<td style="text-align: left"><?php echo $row['address']; ?></td>
														</tr>
														<tr>
															<th>Qualification</th>
															<td style="text-align: left"><?php echo $row['qualification'];?></td>
														</tr>
														<tr>
															<th>Phone</th>
															<td style="text-align: left">
																<?php 
																	if (trim ( $row ['doctor_mobile'] ) != "")
																	{
																		$doctor_mobile = $row ['doctor_mobile'];
																	}
																	else
																	{
																		$doctor_mobile = "";
																	}
																	echo $doctor_mobile;
																?>
															</td>
														</tr>
														<tr>
															<th>Email</th>
															<td style="text-align: left">
																<?php echo (isset($row['email']) && !empty($row['email'])) ? "<a href='mailto:".$row['email']."' border=0>".$row['email']."</a>" : "";?>
															</td>
														</tr>
														<tr>
															<th>Created Date</th>
															<td style="text-align: left">
																<?php 
																	if (trim ( $row ['created_at'] ) != "")
																	{
																		$created_at = date ( "m/d/Y h:i A", strtotime ( $row ['created_at'] ) );
																	}
																	else
																	{
																		$created_at = "";
																	}
																	echo $created_at;
																?>
															</td>
														</tr>
														<tr>
															<th>Modified Date</th>
															<td style="text-align: left">
																<?php 
																	if (trim ( $row ['modified_at'] ) != "")
																	{
																		$modified_at = date ( "m/d/Y h:i A", strtotime ( $row ['modified_at'] ) );
																	}
																	else
																	{
																		$modified_at = "";
																	}
																	echo $modified_at;
																?>
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
						<?php 
							$i++;
						}
						?>
					</tbody>
				</table>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>