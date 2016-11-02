<div id="staticPageDiv">
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">Static Pages</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo Yii::app()->params->base_path ; ?>admin/adminHome">Home</a>
					<i class="fa fa-angle-right "></i> Static Pages
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
						<th>Page Title</th>
						<th>Created Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($staticPageList as $row)
					{
				?>
						<tr>
							<td style="text-align: left"><?php echo $row['pagetitle'];?></td>
							<td><?php echo date("m/d/Y",strtotime($row['createddate']));?></td>
							<td>
								<div class="btn-group">
									<ul class="nav pull-right">
										<li id="fat-menu" class="dropdown">
											<span id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>...</b>
										</span>
											<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
												<li role="presentation">
													<a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>admin/editStaticPage/pageid/<?php echo $row['pageid'] ?>">Edit</a>
												</li>
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