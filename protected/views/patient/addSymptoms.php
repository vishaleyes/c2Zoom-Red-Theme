<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Symptoms History
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
                         <a href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Home</a> <i class="fa fa-angle-right "></i>
							Health History
                            <i class="fa fa-angle-right "></i>
                              <?php if(isset($symptomData['patient_symptoms_id']) && $symptomData['patient_symptoms_id']!=''){ ?>
                              
							Update Symptoms
                              <?php } else { ?>
                            Add Symptoms
                            <?php } ?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row" id="MedicalHistoryDiv">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-ticket"></i>
                                <?php if(isset($symptomData['patient_symptoms_id']) && $symptomData['patient_symptoms_id']!=''){ ?>
                            Update Symptoms
                               <?php } else { ?>
                              Add Symptoms
                                <?php } ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							
                            <div class="main">
            <div class="container patientInfo">
                <!-- BEGIN SIDEBAR & CONTENT -->
                
                    <div class="row">&nbsp;</div>
                    <!-- BEGIN CONTENT -->
                    <form action="<?php echo Yii::app()->params->base_path ; ?>patient/saveSymptoms" id="form_symptoms" method="post">
                     <!-- BEGIN CONTENT -->
                    <div class="row">
    	<div class="col-sm-12">
        	<h3>Review of Systems</h3>
      <p>Mark any of the following symptoms that you are having</p>
        </div>
      
      
        <div class="form-group" id="const_symptomss">
          <div class="col-sm-12">            
            	<h4>Constitutional symptoms</h4>
            </label>
          </div>
          <div class="col-sm-3">
            <label class="checkbox-inline" title="Unusual Weight Change" data-toggle="tooltip">
              <input type="checkbox" id="const_symptoms" name="const_symptoms[]" <?php if(isset($symptomData['const_symptoms']) && in_array(1,  explode(',',$symptomData['const_symptoms']))) {?>  checked="checked" <?php } ?> value="1">
              	Unusual Weight Change
              </label>
          </div>
          <div class="col-sm-3">
            <label class="checkbox-inline" title="Easy fatigue" data-toggle="tooltip">
              <input type="checkbox" id="const_symptoms" name="const_symptoms[]" <?php if(isset($symptomData['const_symptoms']) && in_array(2,  explode(',',$symptomData['const_symptoms']))) {?>  checked="checked" <?php } ?> value="2">
              Easy fatigue </label>
          </div>
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="skins">
          <div class="col-sm-12">            
            	<h4>Skin</h4>
            </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Rashes, Hives or Exzema with itching" data-toggle="tooltip">
              <input type="checkbox" id="skin" name="skin[]" <?php if(isset($symptomData['skin']) && in_array(1,  explode(',',$symptomData['skin']))) {?>  checked="checked" <?php } ?> value="1">
              	Rashes, Hives or Exzema with itching
              </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Bruising" data-toggle="tooltip">
              <input type="checkbox" id="skin" name="skin[]" <?php if(isset($symptomData['skin']) && in_array(2,  explode(',',$symptomData['skin']))) {?>  checked="checked" <?php } ?> value="2">
             Bruising </label>
          </div>
          
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Jaundice" data-toggle="tooltip">
              <input type="checkbox" id="skin" name="skin[]" <?php if(isset($symptomData['skin']) && in_array(3,  explode(',',$symptomData['skin']))) {?>  checked="checked" <?php } ?> value="3">
             Jaundice </label>
          </div>
          <div class="col-sm-12"></div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Cyanosis" data-toggle="tooltip">
              <input type="checkbox" id="skin" name="skin[]" <?php if(isset($symptomData['skin']) && in_array(4,  explode(',',$symptomData['skin']))) {?>  checked="checked" <?php } ?> value="4">
             Cyanosis </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Change in color" data-toggle="tooltip">
              <input type="checkbox" id="skin" name="skin[]" <?php if(isset($symptomData['skin']) && in_array(5,  explode(',',$symptomData['skin']))) {?>  checked="checked" <?php } ?> value="5">
             Change in color </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Dryness" data-toggle="tooltip">
              <input type="checkbox" id="skin" name="skin[]" <?php if(isset($symptomData['skin']) && in_array(6,  explode(',',$symptomData['skin']))) {?>  checked="checked" <?php } ?> value="6">
             Dryness </label>
          </div>
          <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Head, Ears, Eyes, Nose, Throat (HEENT)" data-toggle="tooltip">
              <input type="checkbox" id="skin" name="skin[]" <?php if(isset($symptomData['skin']) && in_array(7,  explode(',',$symptomData['skin']))) {?>  checked="checked" <?php } ?> value="7">
             Lumps or growths </label>
          </div>
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="heents">
          <div class="col-sm-12">            
            	<h4>Head, Ears, Eyes, Nose, Throat (HEENT)</h4>
            </label>
          </div>        
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Difficulty hearing" data-toggle="tooltip">
              <input type="checkbox" id="heent" name="heent[]" <?php if(isset($symptomData['heent']) && in_array(1,  explode(',',$symptomData['heent']))) {?>  checked="checked" <?php } ?> value="1">
             Difficulty hearing </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Ringing in ears" data-toggle="tooltip">
              <input type="checkbox" id="heent" name="heent[]" <?php if(isset($symptomData['heent']) && in_array(2,  explode(',',$symptomData['heent']))) {?>  checked="checked" <?php } ?> value="2">
             Ringing in ears </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Dizziness" data-toggle="tooltip">
              <input type="checkbox" id="heent" name="heent[]" <?php if(isset($symptomData['heent']) && in_array(3,  explode(',',$symptomData['heent']))) {?>  checked="checked" <?php } ?> value="3">
             Dizziness </label>
          </div>
          <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Sinus Trouble" data-toggle="tooltip">
              <input type="checkbox" id="heent" name="heent[]" <?php if(isset($symptomData['heent']) && in_array(4,  explode(',',$symptomData['heent']))) {?>  checked="checked" <?php } ?> value="4">
            Sinus Trouble </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Frequent Sore Throats" data-toggle="tooltip">
              <input type="checkbox" id="heent" name="heent[]" <?php if(isset($symptomData['heent']) && in_array(5,  explode(',',$symptomData['heent']))) {?>  checked="checked" <?php } ?> value="5">
             Frequent Sore Throats </label>
          </div>
          
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="respiratorys">
          <div class="col-sm-12">            
            	<h4>Respiratory</h4>
            </label>
          </div>        
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Cough with sputum (color, consistency, odor, amount)" data-toggle="tooltip">
              <input type="checkbox" id="respiratory" name="respiratory[]" <?php if(isset($symptomData['respiratory']) && in_array(1,  explode(',',$symptomData['respiratory']))) {?>  checked="checked" <?php } ?> value="1">
             Cough</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title=" Asthma with wheezing" data-toggle="tooltip">
              <input type="checkbox" id="respiratory" name="respiratory[]" <?php if(isset($symptomData['respiratory']) && in_array(2,  explode(',',$symptomData['respiratory']))) {?> checked="checked" <?php } ?> value="2">
             Asthma</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Hemoptysis (spitting of blood)" data-toggle="tooltip">
              <input type="checkbox" id="respiratory" name="respiratory[]" <?php if(isset($symptomData['respiratory']) && in_array(4,  explode(',',$symptomData['respiratory']))) {?> checked="checked" <?php } ?> value="4">
           Hemoptysis</label>
          </div>
          
          <div class="row">&nbsp;</div>
           <div class="col-sm-4">
            <label class="checkbox-inline" title="Chronic obstructive pulmonary disease" data-toggle="tooltip">
              <input type="checkbox" id="respiratory" name="respiratory[]" <?php if(isset($symptomData['respiratory']) && in_array(3,  explode(',',$symptomData['respiratory']))) {?> checked="checked" <?php } ?> value="3">
             Chronic obstructive </label>
          </div>                   
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="cardiovasculars">
          <div class="col-sm-12">            
            	<h4>Cardiovascular</h4>
            </label>
          </div>        
          <div class="col-sm-4">
            <label class="checkbox-inline"  title="Chest pain or discomfort" data-toggle="tooltip">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(1,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="1">
             Chest pain</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Palpitations, heart trouble" data-toggle="tooltip">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(2,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?>  value="2">
             Palpitations</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Orthopnea (discomfort in breathing)" data-toggle="tooltip">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(5,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="5">
           Orthopnea</label>
          </div>
          
         <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Heart murmurs" data-toggle="tooltip">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(4,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="4">
           Heart murmurs </label>
          </div> 
          <div class="col-sm-4">
            <label class="checkbox-inline" title="High blood pressure" data-toggle="tooltip">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(3,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="3">
             High blood pressure </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Dyspnea (shortness of breath)" data-toggle="tooltip">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(6,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="6">
           Dyspnea</label>
          </div>
          <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" data-toggle="tooltip" title="Pedal edema">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(7,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="7">
           Pedal edema </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" data-toggle="tooltip" title="Coldness of extremities">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(9,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="9">
           Coldness of extremities </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" data-toggle="tooltip" title="Claudication (limping) or pain in legs when walking">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(8,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="8">
          Claudication</label>
          </div>
          
          <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" data-toggle="tooltip" title="Past myocardial infarction">
              <input type="checkbox" id="cardiovascular" name="cardiovascular[]" <?php if(isset($symptomData['cardiovascular']) && in_array(10,  explode(',',$symptomData['cardiovascular']))) {?> checked="checked" <?php } ?> value="10">
           Past myocardial infarction </label>
          </div>                   
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="gastrointestinals">
          <div class="col-sm-12">            
            	<h4>Gastrointestinal</h4>
            </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Nausea and/or vomiting" data-toggle="tooltip">
              <input type="checkbox" id="gastrointestinal" name="gastrointestinal[]" <?php if(isset($symptomData['gastrointestinal']) && in_array(1,  explode(',',$symptomData['gastrointestinal']))) {?> checked="checked" <?php } ?> value="1">
              	Nausea and/or vomiting
              </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Hematemesis (vomiting blood)" data-toggle="tooltip">
              <input type="checkbox" id="gastrointestinal" name="gastrointestinal[]" <?php if(isset($symptomData['gastrointestinal']) && in_array(2,  explode(',',$symptomData['gastrointestinal']))) {?> checked="checked" <?php } ?> value="2">
             Hematemesis</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Indigestion or heart burn" data-toggle="tooltip">
              <input type="checkbox" id="gastrointestinal" name="gastrointestinal[]" <?php if(isset($symptomData['gastrointestinal']) && in_array(3,  explode(',',$symptomData['gastrointestinal']))) {?> checked="checked" <?php } ?> value="3">
             Indigestion </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" data-toggle="tooltip" title="Dysphagia (difficulty swallowing)">
              <input type="checkbox" id="gastrointestinal" name="gastrointestinal[]" <?php if(isset($symptomData['gastrointestinal']) && in_array(4,  explode(',',$symptomData['gastrointestinal']))) {?> checked="checked" <?php } ?> value="4">
             Dysphagia</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" data-toggle="tooltip" title="Abdominal pain">
              <input type="checkbox" id="gastrointestinal" name="gastrointestinal[]" <?php if(isset($symptomData['gastrointestinal']) && in_array(5,  explode(',',$symptomData['gastrointestinal']))) {?> checked="checked" <?php } ?> value="5">
             Abdominal pain </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline"  data-toggle="tooltip" title="Change in bowel movementsDiarrhea, Constipation or Melena (black stool due to blood)">
              <input type="checkbox" id="gastrointestinal" name="gastrointestinal[]" <?php if(isset($symptomData['gastrointestinal']) && in_array(6,  explode(',',$symptomData['gastrointestinal']))) {?> checked="checked" <?php } ?> value="6">
             Change in bowel movementsDiarrhea </label>
          </div>          
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="genitourinarys">
          <div class="col-sm-12">            
            	<h4>Genitourinary</h4>
            </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Frequency or urgency of urination" data-toggle="tooltip">
              <input type="checkbox" id="genitourinary" name="genitourinary[]" <?php if(isset($symptomData['genitourinary']) && in_array(1,  explode(',',$symptomData['genitourinary']))) {?> checked="checked" <?php } ?> value="1">
              	Frequency
              </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Polyuria (excess urine output)" data-toggle="tooltip">
              <input type="checkbox" id="genitourinary" name="genitourinary[]" <?php if(isset($symptomData['genitourinary']) && in_array(2,  explode(',',$symptomData['genitourinary']))) {?> checked="checked" <?php } ?>  value="2">
             Polyuria</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Dysuria (painful urination)" data-toggle="tooltip">
              <input type="checkbox" id="genitourinary" name="genitourinary[]" <?php if(isset($symptomData['genitourinary']) && in_array(3,  explode(',',$symptomData['genitourinary']))) {?> checked="checked" <?php } ?> value="3">Dysuria
              </label>
          </div>
          <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Incontinence" data-toggle="tooltip"> 
              <input type="checkbox" id="genitourinary" name="genitourinary[]" <?php if(isset($symptomData['genitourinary']) && in_array(4,  explode(',',$symptomData['genitourinary']))) {?> checked="checked" <?php } ?> value="4">
             Incontinence </label>
          </div>
          
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Hematuria (blood in urine)" data-toggle="tooltip">
              <input type="checkbox" id="genitourinary" name="genitourinary[]" <?php if(isset($symptomData['genitourinary']) && in_array(5,  explode(',',$symptomData['genitourinary']))) {?> checked="checked" <?php } ?> value="5">
             Hematuria</label>
          </div>                    
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="musculoskeletals">
          <div class="col-sm-12">            
            	<h4>Musculoskeletal</h4>
            </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Muscle or joint pain or stiffness" data-toggle="tooltip">
              <input type="checkbox" id="musculoskeletal" name="musculoskeletal[]" <?php if(isset($symptomData['musculoskeletal']) && in_array(1,  explode(',',$symptomData['musculoskeletal']))) {?> checked="checked" <?php } ?> value="1">
              	Muscle or joint pain or stiffness
              </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Muscle wasting, swelling or redness" data-toggle="tooltip">
              <input type="checkbox" id="musculoskeletal" name="musculoskeletal[]" <?php if(isset($symptomData['musculoskeletal']) && in_array(2,  explode(',',$symptomData['musculoskeletal']))) {?> checked="checked" <?php } ?> value="2">
             muscle wasting</label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Limitation of motion" data-toggle="tooltip">
              <input type="checkbox" id="musculoskeletal" name="musculoskeletal[]" <?php if(isset($symptomData['musculoskeletal']) && in_array(3,  explode(',',$symptomData['musculoskeletal']))) {?> checked="checked" <?php } ?>  value="3">
             Limitation of motion </label>
          </div>
          <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Arthritis" data-toggle="tooltip">
              <input type="checkbox" id="musculoskeletal" name="musculoskeletal[]" <?php if(isset($symptomData['musculoskeletal']) && in_array(4,  explode(',',$symptomData['musculoskeletal']))) {?> checked="checked" <?php } ?> value="4">
             Arthritis</label>
          </div>
          
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Gout" data-toggle="tooltip">
              <input type="checkbox" id="musculoskeletal" name="musculoskeletal[]" <?php if(isset($symptomData['musculoskeletal']) && in_array(5,  explode(',',$symptomData['musculoskeletal']))) {?> checked="checked" <?php } ?> value="5">
             Gout </label>
          </div> 
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Backache or Neck pain (location and symptoms)" data-toggle="tooltip">
              <input type="checkbox" id="musculoskeletal" name="musculoskeletal[]" <?php if(isset($symptomData['musculoskeletal']) && in_array(6,  explode(',',$symptomData['musculoskeletal']))) {?> checked="checked" <?php } ?> value="6">
             Backache</label>
          </div>                    
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="neurologicals">
          <div class="col-sm-12">            
            	<h4>Neurological</h4>
            </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Syncope" data-toggle="tooltip">
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(1,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="1">
              	Syncope
              </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Weakness" data-toggle="tooltip">
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(2,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="2">
            Weakness </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Unsteadiness of gait" data-toggle="tooltip">
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(3,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="3">
            Unsteadiness of gait </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Paralysis" data-toggle="tooltip"> 
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(4,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="4">
             Paralysis</label>
          </div>
         
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Paresthesias (numbing or tingling)" data-toggle="tooltip">
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(5,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="5">
             Paresthesias</label>
          </div> 
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Loss of sensation" data-toggle="tooltip">
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(6,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="6">
             Loss of sensation </label>
          </div>
          <div class="col-sm-12"></div>  
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Loss of memory" data-toggle="tooltip">
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(7,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="7">
            Loss of memory </label>
          </div>
           
          <div class="col-sm-3">
            <label class="checkbox-inline" title="Disorientation" data-toggle="tooltip">
              <input type="checkbox" id="neurological" name="neurological[]" <?php if(isset($symptomData['neurological']) && in_array(8,  explode(',',$symptomData['neurological']))) {?> checked="checked" <?php } ?> value="8">
             Disorientation </label>
          </div>                    
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="psychiatrics">
          <div class="col-sm-12">            
            	<h4>Psychiatric</h4>
            </label>
          </div>
          <div class="col-sm-3">
            <label class="checkbox-inline" title="Depression, Anxiety" data-toggle="tooltip">
              <input type="checkbox" id="psychiatric" name="psychiatric" <?php if(isset($symptomData['psychiatric']) && $symptomData['psychiatric'] == 1) {?> checked="checked" <?php } ?>  value="1">
              	Depression, Anxiety
              </label>
          </div>                              
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="endocrines">
          <div class="col-sm-12">            
            	<h4>Endocrine</h4>
            </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="History of Thyroid Trouble or Diabetes" data-toggle="tooltip">
              <input type="checkbox" id="endocrine" name="endocrine[]" <?php if(isset($symptomData['endocrine']) && in_array(1,  explode(',',$symptomData['endocrine']))) {?> checked="checked" <?php } ?> value="1">
              	History
              </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Heat or cold intolerance" data-toggle="tooltip">
              <input type="checkbox" id="endocrine" name="endocrine[]" <?php if(isset($symptomData['endocrine']) && in_array(2,  explode(',',$symptomData['endocrine']))) {?> checked="checked" <?php } ?> value="2">
              	Heat or cold intolerance
              </label>
          </div>                              
          <div>&nbsp;</div>
          <div>&nbsp;</div>
        </div>
        
        <div class="form-group" id="hematologics">
          <div class="col-sm-12">            
            	<h4>Hematologic/lymphatic</h4>
            </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Anemia" data-toggle="tooltip">
              <input type="checkbox" id="hematologic" name="hematologic[]" <?php if(isset($symptomData['hematologic']) && in_array(1,  explode(',',$symptomData['hematologic']))) {?> checked="checked" <?php } ?> value="1">
              	Anemia
              </label>
          </div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Enlarged lymph nodes" data-toggle="tooltip">
              <input type="checkbox" id="hematologic" name="hematologic[]" <?php if(isset($symptomData['hematologic']) && in_array(2,  explode(',',$symptomData['hematologic']))) {?> checked="checked" <?php } ?> value="2">
              	Enlarged lymph nodes
              </label>
          </div> 

          <div class="col-sm-4">
            <label class="checkbox-inline" title="Enlarged Spleen" data-toggle="tooltip">
              <input type="checkbox" id="hematologic" name="hematologic[]" <?php if(isset($symptomData['hematologic']) && in_array(3,  explode(',',$symptomData['hematologic']))) {?> checked="checked" <?php } ?> value="3">
              	Enlarged Spleen
              </label>
          </div> 
          <div class="row">&nbsp;</div>
          <div class="col-sm-4">
            <label class="checkbox-inline" title="Excess bruising or bleeding" data-toggle="tooltip">
              <input type="checkbox" id="hematologic" name="hematologic[]" <?php if(isset($symptomData['hematologic']) && in_array(4,  explode(',',$symptomData['hematologic']))) {?> checked="checked" <?php } ?> value="4">
              	Excess bruising
              </label>
          </div>                              
          <div>&nbsp;</div>
          <div>&nbsp;</div>
          
          
                      <div align="center" class="loading" id="loading"></div>

                       <div class="row"> &nbsp; </div> 
                       <div class="row"> &nbsp; </div>
						
                        <div class="form-actions fluid">
									<div class="col-md-offset-1 col-md-8">
                                    
                                    <input type="hidden" name="patient_symptoms_id" value="<?php if(isset($symptomData['patient_symptoms_id'])) { echo $symptomData['patient_symptoms_id']; } ?>"  />
                                    
									<button type="submit" name="saveSymptoms" class="btn green">Submit</button>
										<a class="btn red" href="<?php echo Yii::app()->params->base_path ; ?>patient/patientHome">Cancel</a>
									</div>
								</div>
                                
          
        </div>
    </div>
                    <!-- END CONTENT -->
                    </form>    
                    <!-- END CONTENT -->
           </div>     
                <!-- END SIDEBAR & CONTENT -->
            </div>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
	