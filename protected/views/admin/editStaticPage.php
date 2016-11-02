<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>protected/extensions/cleditor/assets/jquery.cleditor.css"/>
<script src="<?php echo Yii::app()->params->base_url ; ?>protected/extensions/cleditor/assets/jquery.cleditor.min.js"></script>


<script>
jQuery(document).ready(function() {
	 
       var editor = $("#pagedescription").cleditor({
   	        width: "98%",
            height: "auto"
       });
});
</script>
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Static Pages
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?php echo Yii::app()->params->base_path ; ?>admin/adminHome">Home</a>
							<i class="fa fa-angle-right "></i>
							<?php if(isset($_REQUEST['pageid']) && $_REQUEST['pageid']!=''){ ?>
								Update Static Page
                              <?php } ?>
						</li>						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="StaticPageDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gittip"></i>
                                <?php if(isset($_REQUEST['pageid']) && $_REQUEST['pageid']!=''){ ?>
                               Update Static Page
                               <?php } ?>
                                
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo Yii::app()->params->base_path ; ?>admin/saveStaticPage" id="form_staticPage" name="form_staticPage" class="form-horizontal" method="post">
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
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Page Title <span class="required">* </span></label>
                                                <div class="col-md-8">
                                                    <input type="text" id="pagetitle" name="pagetitle" data-required="1" class="form-control" value="<?php echo (isset($staticPageData['pagetitle']) && !empty($staticPageData['pagetitle'])) ? $staticPageData['pagetitle']: ""; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Page Description <span class="required">* </span></label>
                                                <div class="col-md-8">
                                                    <textarea id="pagedescription" name="pagedescription" data-required="1" class="form-control" ><?php echo (isset($staticPageData['pagedescription']) && !empty($staticPageData['pagedescription'])) ? $staticPageData['pagedescription']: "";?></textarea>
                                                </div>
                                            </div>  
                                        </div>                                   
                                    </div>
								</div>
								
								<div class="form-actions fluid">
									<div class="col-md-offset-2 col-md-10">
                                    
                                    <input type="hidden" name="pageid" value="<?php echo $_REQUEST['pageid']; ?>"  />
                                    
										<button type="submit" name="saveStaticPage" class="btn green" >Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>admin/staticPageListing">Cancel</a>
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