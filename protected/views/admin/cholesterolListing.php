

<style>
.model_table {border-spacing: 5px;}
.model_table td    {padding: 8px; color:#7A6666}
.model_table th    {color:#578EBE}
</style>

	<div id="cholesterolDiv">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Cholesterol
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<a href="#">Measurements</a>
                            <i class="fa fa-angle-right "></i>
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/cholesterolListing">
							Cholesterol</a>
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
					<div class="portlet box blue-madison">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gittip"></i>Cholesterol Details
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body">
                        
                            <div>
                            <a class="btn green" href="<?php echo Yii::app()->params->base_path ; ?>admin/addCholesterol"><i class="fa fa-plus"></i>&nbsp;Add Cholesterol</a>
                            </div>
                            
                          <br />
                            
							<table class="table table-striped table-bordered table-hover" id="sample_cholesterol">
							<thead>
							<tr>
								<th>
									 When
								</th>
								<th>
									 LDL
								</th>
								<th>
									HDL
								</th>
								<th>
									Triglycerides
								</th>
                                <th>
									Total
								</th>
                                <th style="text-align:center">
									 Actions
								</th>
							</tr>
							</thead>
							<tbody>
							
                           
							<tr>
								<td>
									 12/05/2015
								</td>
								<td>
									 50
								</td>
								<td>
									 100
								</td>
								<td>
									3
								</td>
								<td>
									 100
								</td>
                                
                                <td style="text-align:center">
                                <a data-toggle="modal" href="#basic"><i class="fa fa-eye"></i></a>
									<a title="Edit" href="<?php echo Yii::app()->params->base_path ; ?>admin/addCholesterol"><i class="fa fa-pencil"></i></a>
                                    <a title="Delete" href="#"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							
						
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
	</div>
    
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Cholesterol Details</h4>
										</div>
										<div class="modal-body">
											 
                                             <table class="model_table">
                                             <tr>
                                                 <th>When</th>
                                                 <td>12/05/2015</td>
                                             </tr>
                                             <tr>
                                                 <th>LDL</th>
                                                 <td>52</td>
                                             </tr>
                                             <tr>
                                                 <th>TDL</th>
                                                 <td>56</td>
                                             </tr>
                                             <tr>
                                                 <th>Triglycerides</th>
                                                 <td>53</td>
                                             </tr>
                                             <tr>
                                                 <th>Total</th>
                                                 <td>150</td>
                                             </tr>
                                             <tr>
                                                 <th>Notes</th>
                                                 <td>Hello</td>
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