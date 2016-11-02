<?php 
$arrLive[1] = 'Alone';
$arrLive[2] = 'Spouse';
$arrLive[3] = 'Nursing facility';
$arrLive[4] = 'Other';

$arrDrink[0] = 'Never';
$arrDrink[1] = 'Rarely';
$arrDrink[3] = 'Weekends';
$arrDrink[4] = 'Heavy';
$arrDrink[4] = 'No comment';

$arrFamilyRelation[0] = "Mother";
$arrFamilyRelation[1] = "Father";
$arrFamilyRelation[2] = "Sister";
$arrFamilyRelation[3] = "Brother";
?>

<!-- Bootstrap -->
<link href="css/style_content.css" rel="stylesheet">
<?php
function daysDifference($endDate, $beginDate)
{
  	$birthDate = $beginDate;
  		//explode the date to get month, day and year
 		 $birthDate = explode("-", $birthDate);
  		//get age from date or birthdate
  		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
 		return  $age;
}
?>
<div class="container">
	<div class="row">
    	<div class="col-sm-12">
        	<h3 class="ContentHeading text-center">Neurospine Institute<br>
Robert Masson, M.D., Mitchell L. Supler, M.D.<br>
2706 Rew Circle<br>
Ocoee, Florida, 34761<br>
(407) 649-8585-phone<br>
(407) 649-0151- fax</h3>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
    	<div class="col-sm-12">
        	<p class="ContentPara">Welcome to Neurospine Institute. Your appointment is scheduled for xxxxxxxxxx at xx am/pm. Please arrive 30 minutes prior to appointment.</p>
            <p class="ContentPara"><strong>Please notify our office within 48 hours, if you are unable to keep this appointment.</strong></p>
            <p class="ContentPara"><strong>Please bring with you the following information and items to your appointment.</strong> If the items are not available at the time of your visit, it may result in the rescheduling of your appointment.</p>
        </div>
    </div>
    <div class="row ContentNumberBullet">
     	<div class="col-sm-12">
        	<ul>
            	<li>MRI, CT scan report and films. Films must be no older than six months old.</li>
                <li>Insurance Card</li>
                <li>Authorization number or referral-if required from health insurance company</li>
                <li>Auto claim information</li>
                <li>The enclosed Medical History and Patient Registration Forms</li>                
            </ul>
        </div>
     </div>
    <div class="row">
   	  <div class="col-sm-12">
       	<h3 class="ContentHeading ContentUnderline">Directions to our office:</h3>
        <img class="img-responsive" src="img/map.jpg"  alt="Map">
      </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h1 class="ContentHeading text-center ContentUnderline" >Neurospine Institute<br>
Robert L. Masson, M.D., Mitchell L. Supler, M.D.<br>
Patient Health History Questionnaire</h1>			
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-6">
        	<p class="ContentPara"><strong>Date:</strong> <?php echo date("m/d/Y");?></p>
            <p class="ContentPara"><strong>Name:</strong> <?php echo $patientData['name'].' '.$patientData['surname']; ?></p>
            <p class="ContentPara"><strong>Age:</strong> <?php echo daysDifference(date("m-d-Y"),date("m-d-Y",strtotime($patientData['dob']))); ?></p>
            <p class="ContentPara"><strong>Birthday:</strong> <?php echo date("m/d/Y",strtotime($patientData['dob'])); ?></p>
        </div>
        <div class="col-sm-6">
        	<div class="row">
            	<div class="col-sm-12"><p class="ContentPara">For Nurses Only</p></div>
            </div>
            <div class="row">
            	<div class="col-sm-6">WT: xxxx</div>
                <div class="col-sm-6 text-right">BP: xxxx</div>
            </div>
            <div class="row">&nbsp;</div>
             <div class="row">
            	<div class="col-sm-6">P: xxxx</div>
                <div class="col-sm-6 text-right">R: xxxx</div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<?php if (isset($isPDF) && $isPDF):?>
    			<p class="ContentPara"><h4 class="ContentHeading compalint">Chief Complaint: </h4> What is the problem you are being seen for today?
    				<?php echo (isset($_POST['whatistheproblemseentoday']) && !empty($_POST['whatistheproblemseentoday'])) ? $_POST['whatistheproblemseentoday'] : "";?>
    			</p>
    			<p class="ContentPara">When did this begin? (Mo/day/year)? <?php echo (isset($_POST['whendidthisbegin']) && !empty($_POST['whendidthisbegin'])) ? $_POST['whendidthisbegin'] : ""; ?></p>
    			<p class="ContentPara">How did this begin? <?php echo (isset($_POST['howdidthisbegin']) && !empty($_POST['howdidthisbegin'])) ? $_POST['howdidthisbegin'] : ""; ?></p>
    		<?php else:?>
	        	<p class="ContentPara"><h4 class="ContentHeading compalint">Chief Complaint: </h4> What is the problem you are being seen for today? xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx xxxxxx</p>
	            <p class="ContentPara">When did this begin? (Mo/day/year)? xx/xx/xxxx</p>
	            <p class="ContentPara">How did this begin? xx xx xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx</p>
            <?php endif;?>
            
        	
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<p class="ContentPara"><h4 class="ContentHeading compalint">Medical History: </h4> Height: <?php echo $medicalData['height']; ?> &nbsp; Average Weight: <?php echo $medicalData['avg_height']; ?></p>
            <p class="ContentPara">If you are a woman of childbearing years, is there a possibility you may be pregnant? <i class="fa <?php echo ((isset($medicalData['is_pregnant']) && $medicalData['is_pregnant'] == 1) ? 'fa-check-square-o' : 'fa-square-o');?>"></i> Yes <i class="fa <?php echo (($medicalData['is_pregnant'] != 1) ? 'fa-check-square-o' : 'fa-square-o');?>"></i> No</p>
            <p class="ContentPara">Mark any medical condition you have been diagnosed with:</p>
            <p>
            <i class="fa <?php echo ((isset($medicalData['aids']) && $medicalData['aids'] == 1) ? 'fa-check-square-o' : 'fa-square-o');?>"></i> Aids 
            <i class="fa <?php echo ((isset($medicalData['hepatitis']) && $medicalData['hepatitis'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Hepatitis 
            <i class="fa <?php echo ((isset($medicalData['other_disease']) && $medicalData['other_disease'] != '') ? "fa-check-square-o" : "fa-square-o");?>"></i> Other Disease  : <?php echo $medicalData['other_disease']; ?></p>
		</p>
        <p> 			
            <p class="ContentPara">
            	<i class="fa <?php echo ((isset($medicalData['blood_clots']) && $medicalData['blood_clots'] != '') ? 'fa-check-square-o' : 'fa-square-o');?>"></i> Blood clots/What part of body : <?php if(isset($medicalData['blood_clots'])) { echo $medicalData['blood_clots']; } ?> &nbsp; 
            	<i class="fa <?php echo ((isset($medicalData['diabetes']) && $medicalData['diabetes'] != '') ? "fa-check-square-o" : "fa-square-o");?>"></i> Diabetes/controlled by :  
	            <i class="fa <?php echo ((isset($medicalData['diet']) && $medicalData['diet'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Diet 
	            <i class="fa <?php echo ((isset($medicalData['pills']) && $medicalData['pills'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Pills 
	            <i class="fa <?php echo ((isset($medicalData['insulin']) && $medicalData['insulin'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Insulin
            </p>
            
            <p class="ContentPara">
            	<i class="fa <?php echo ((isset($medicalData['epilepsy']) && $medicalData['epilepsy'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Epilepsy 
            	<i class="fa <?php echo ((isset($medicalData['heart_problem']) && $medicalData['heart_problem'] != '') ? "fa-check-square-o" : "fa-square-o");?>"></i> Heart Problems/Type : <?php if(isset($medicalData['heart_problem']) && $medicalData['heart_problem'] != '') {  echo $medicalData['heart_problem'];  } ?>
            </p>
            <p class="ContentPara">
	            <i class="fa <?php echo ((isset($medicalData['high_blood_pressure']) && $medicalData['high_blood_pressure'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> High Blood Pressure
	            &nbsp;
	            <i class="fa <?php echo ((isset($medicalData['low_thyroid']) && $medicalData['low_thyroid'] == 1) ? "fa-check-square-o" : "");?>"></i> Low Thyroid
	            &nbsp;
	            <i class="fa <?php echo ((isset($medicalData['bowel']) && $medicalData['bowel'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Irritable Bowel Syndrome
			</p>
			<p> 
	            <i class="fa <?php echo ((isset($medicalData['ulcers']) && $medicalData['ulcers'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Ulcers
	            &nbsp;
	            <i class="fa <?php echo ((isset($medicalData['prolapse']) && $medicalData['prolapse'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Mitral Valve Prolapse
            </p>
            <p class="ContentPara">
            	<i class="fa <?php echo ((isset($medicalData['lung_disease']) && $medicalData['lung_disease'] != '') ? "fa-check-square-o" : "fa-square-o");?>"></i> Lung Disease/Type : <?php if(isset($medicalData['lung_disease'])) { echo $medicalData['lung_disease']; } ?>
            </p>
            
            <p class="ContentPara">
	            <i class="fa <?php echo ((isset($medicalData['polio']) && $medicalData['polio'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Polio
	            &nbsp;
	            <i class="fa <?php echo ((isset($medicalData['arthritis']) && $medicalData['arthritis'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Rheumatoid Arthritis
	            &nbsp;
	            <i class="fa <?php echo ((isset($medicalData['tuberculosis']) && $medicalData['tuberculosis'] == 1) ? "fa-check-square-o" : "fa-square-o");?>"></i> Tuberculosis
	            &nbsp;
            </p>
            
            <p class="ContentPara"><i class="fa <?php echo ((isset($medicalData['psychiatric']) && $medicalData['psychiatric'] != '') ? "fa-check-square-o" : "fa-square-o");?>"></i> Psychiatric Disorder/Type :</b> <?php if(isset($medicalData['psychiatric'])) { echo $medicalData['psychiatric']; } ?></p>
            <p class="ContentPara">Please list any <strong>other known</strong> medical conditions or symptoms not listed above: <?php if(isset($medicalData['other_unknown'])) { echo $medicalData['other_unknown']; } ?></p>
            <p class="ContentPara">Please list any <strong>injuries</strong> including car accident, fall, lifting, etc: <?php if(isset($medicalData['injuries'])) { echo $medicalData['injuries']; } ?></p>
            <p class="ContentPara">Please list any <strong>hospitalizations</strong> (other than surgeries): <?php if(isset($medicalData['hospitalization'])) { echo $medicalData['hospitalization']; } ?></p>
        </div>
    </div>
    <div class="row ContentTable">
    	<div class="table-responsive col-sm-12">
             <table class="table table-striped table-bordered table-hover">
               <caption>Please list any <strong>surgeries: (Use the back of the form, if more than six)</strong></caption>
               <thead>
                  <tr>
                     <th>Procedure</th>
                     <th>Year</th>
                     <th>Surgeon</th>
                     <th>Hospital/City</th>
                  </tr>
               </thead>
               <tbody>
                 
                 <?php foreach($surgoryData as $surgoryRow){  ?>
                  <tr>
                     <td><?php echo $surgoryRow['procedure']; ?></td>
                     <td><?php echo $surgoryRow['Year']; ?></td>
                     <td><?php echo $surgoryRow['surgeon']; ?></td>
                     <td><?php echo $surgoryRow['hospital']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Family History: </h4>
            <p class="ContentPara">Have any of your relatives ever had any of the following:&nbsp;<?php echo (isset($familyData['relative_had_history']) && $familyData['relative_had_history']>=1) ? "Yes" : "No";?></p>
            <p class="ContentPara">Relationship <?php if (isset($familyData['relative_name']) && is_numeric($familyData['relative_name'])) : ?>(<?php echo (isset($arrFamilyRelation[$familyData['relative_name']]) && !empty($arrFamilyRelation[$familyData['relative_name']])) ? $arrFamilyRelation[$familyData['relative_name']] : "";?>)<?php endif;?></p>
            <p class="ContentPara">
            	<?php if (isset($familyData['relative_name']) && is_numeric($familyData['relative_name'])) : ?><?php echo (isset($arrFamilyRelation[$familyData['relative_name']]) && !empty($arrFamilyRelation[$familyData['relative_name']])) ? $arrFamilyRelation[$familyData['relative_name']] : "";?><?php endif;?>&nbsp;
            	-&nbsp;
				<?php if (isset($familyData["hypertension"]) && !empty($familyData["hypertension"])) { $arrFamilyDisease[] = "Hypertension"; } ?>
				<?php if (isset($familyData["tuberculosis"]) && !empty($familyData["tuberculosis"])) { $arrFamilyDisease[] = "Tuberculosis"; } ?>
				<?php if (isset($familyData["diabetes"]) && !empty($familyData["diabetes"])) { $arrFamilyDisease[] = "Diabetes"; } ?>
				<?php if (isset($familyData["kidney_disease"]) && !empty($familyData["kidney_disease"])) { $arrFamilyDisease[] = "Kidney Disease"; } ?>
				<?php if (isset($familyData["heart_disease"]) && !empty($familyData["heart_disease"])) { $arrFamilyDisease[] = "Heart Disease"; } ?>
				<?php if (isset($familyData["arthritis"]) && !empty($familyData["arthritis"])) { $arrFamilyDisease[] = "Arthritis"; } ?>
				<?php if (isset($familyData["epilepsy"]) && !empty($familyData["epilepsy"])) { $arrFamilyDisease[] = "Epilepsy"; } ?>
				<?php if (isset($familyData["convulsions"]) && !empty($familyData["convulsions"])) { $arrFamilyDisease[] = "Convulsions"; } ?>
				<?php if (isset($familyData["cancer"]) && !empty($familyData["cancer"])) { $arrFamilyDisease[] = "Cancer"; } ?>
				<?php if (isset($familyData["psychological"]) && !empty($familyData["psychological"])) { $arrFamilyDisease[] = "Psychological"; } ?>
				<?php if (isset($familyData["drug"]) && !empty($familyData["drug"])) { $arrFamilyDisease[] = "Drug or Alcohol Problems"; } ?>
				<?php if (isset($arrFamilyDisease) && is_array($arrFamilyDisease) && count($arrFamilyDisease)>0) { echo implode(", ", $arrFamilyDisease); }?>
            </p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Social History: </h4>
            <p class="ContentPara">Employed? :  <i class="fa <?php echo (($socialInfo['employed'] == '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> Yes <i class="fa <?php echo (($socialInfo['employed'] != '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> No  Most recent Occupation: <?php echo ($socialInfo['occupation']);?></p>
            <p class="ContentPara">Children? : <i class="fa <?php echo (($socialInfo['children'] == '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> Yes <i class="fa <?php echo (($socialInfo['children'] != '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> No If yes, how many/ages? : <?php echo $socialInfo['how_many'];?></p>
            <p class="ContentPara">Do you live: <i class="fa <?php echo (($socialInfo['live'] == '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> Alone <i class="fa <?php echo (($socialInfo['live'] == '2') ? "fa-check-square-o" : "fa-square-o");?>"></i> Spouse <i class="fa <?php echo (($socialInfo['live'] == '3') ? "fa-check-square-o" : "fa-square-o");?>"></i> Nursing Facility  <i class="fa <?php echo (($socialInfo['live'] == '4') ? "fa-check-square-o" : "fa-square-o");?>"></i> Other : <?php echo ($socialInfo['live'] == '4' ? $socialInfo['live_other'] : '');?></p>
            <p class="ContentPara">Are you at risk for AIDs? : <i class="fa <?php echo (($socialInfo['aids'] == '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> Yes <i class="fa <?php echo (($socialInfo['aids'] != '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> No </p>
            <p class="ContentPara">Do you have a history of: Substance abuse/Type? <?php echo $socialInfo['abuse_type'];?></p>
            <p class="ContentPara">Do you currently use alcohol? : <i class="fa <?php echo (($socialInfo['use_alcohol'] == '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> Yes <i class="fa <?php echo (($socialInfo['use_alcohol'] != '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> No 
            	<?php if($socialInfo['use_alcohol'] == '1') { ?>If yes, how often: <i class="fa <?php echo (($socialInfo['how_often'] == '0') ? "fa-check-square-o" : "fa-square-o");?>"></i> Never <i class="fa <?php echo (($socialInfo['how_often'] == '1') ? "fa-check-square-o" : "fa-square-o");?>"></i> Rarely <i class="fa <?php echo (($socialInfo['how_often'] == '2') ? "fa-check-square-o" : "fa-square-o");?>"></i> Weekends <i class="fa <?php echo (($socialInfo['how_often'] == '3') ? "fa-check-square-o" : "fa-square-o");?>"></i> Heavy <i class="fa <?php echo (($socialInfo['how_often'] == '4') ? "fa-check-square-o" : "fa-square-o");?>"></i> No Comment </p><?php } ?>
            <p class="ContentPara">Are you a smoker? : <?php echo ($socialInfo['smoker'] == '1' ? 'Yes' : 'No');?> - <?php echo ($socialInfo['no_of_pack']);?> Packs per day for <?php echo ($socialInfo['years']);?> years</p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Review of Systems: </h4>
            <p class="ContentPara"><b>Constitutional symptoms</b> - <?php echo $symptomsHistoryInfo['const_symptoms']?></p>
            <p class="ContentPara"><b>Skin</b> - <?php echo $symptomsHistoryInfo['skin']?></p>
            <p class="ContentPara"><b>Head, Ears, Eyes, Nose, Throat (HEENT)</b> - <?php echo $symptomsHistoryInfo['heent']?></p>
            <p class="ContentPara"><b>Respiratory</b> - <?php echo $symptomsHistoryInfo['respiratory'];?></p>
            <p class="ContentPara"><b>Cardiovascular</b> - <?php echo $symptomsHistoryInfo['cardiovascular'];?></p>
            <p class="ContentPara"><b>Gastrointestinal</b> - <?php echo $symptomsHistoryInfo['gastrointestinal'];?></p>
            <p class="ContentPara"><b>Genitourinary</b> - <?php echo $symptomsHistoryInfo['genitourinary'];?></p>
            <p class="ContentPara"><b>Musculoskeletal</b> - <?php echo $symptomsHistoryInfo['musculoskeletal'];?></p>
            <p class="ContentPara"><b>Neurological</b> - <?php echo $symptomsHistoryInfo['neurological'];?></p>
            <p class="ContentPara"><b>Psychiatric</b> - <?php echo $symptomsHistoryInfo['psychiatric'];?></p>
            <p class="ContentPara"><b>Endocrine</b> - <?php echo $symptomsHistoryInfo['endocrine'];?></p>
            <p class="ContentPara"><b>Hematologic/lymphatic</b> - <?php echo $symptomsHistoryInfo['hematologic'];?></p>            
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<p class="ContentPara">To My Knowledge, I attest that the above information is true and accurate</p>
        </div>
    </div>
    <!-- <div class="row">
    	<div class="col-sm-6">Patient’s Signature - xxxx xxx xxx xxx</div>
        <div class="col-sm-6">Date - xx xx xxxx</div>
    </div> -->
    <div class="row">
    	<div class="col-sm-12">
        	<h1 class="ContentHeading text-center">Medications and Allergies</h1>
            <h4 class="ContentHeading ContentUnderline">Medications:</h4>
            <div class="table-responsive">
	            <table class="table table-bordered">
	               <caption>List of all medications that your are currently taking</caption>
	               <thead>
	                  <tr>
	                     <th>Drug</th>
	                     <th>Dose</th>
	                     <th>How Often</th>
	                     <th>Prescribed by</th>
	                     <th>When</th>
	                  </tr>
	               </thead>
	               <tbody>
	               	<?php foreach ($medicationHistoryData as $medicationHistory) {?>
	                  <tr>
	                     <td><?php echo $medicationHistory['medication_name'];?></td>
	                     <td><?php echo $medicationHistory['dose'];?></td>
	                     <td><?php echo $medicationHistory['how_often_taken'];?></td>
	                     <td><?php echo $medicationHistory['is_prescribed'];?></td>
	                     <td><?php echo $medicationHistory['when_started'];?></td>
	                  </tr>
	                  <?php } ?>
	               </tbody>
	            </table>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Allergies</h4>
           <div class="table-responsive">
	            <table class="table table-bordered">
	               <caption>List any ALLERGY to MEDICATIONS and reaction:</caption>
	               <thead>
	                  <tr>
	                     <th>Name of medication</th>
	                     <th>Reaction</th>
	                  </tr>
	               </thead>
	               <tbody>
	                  <?php foreach ($allergiesData as $allergies){ ?>
		                  <tr>
		                     <td><?php echo $allergies['allergy_name'];?></td>
		                     <td><?php echo $allergies['reaction'];?></td>
		                  </tr>
	                  <?php } ?>
	               </tbody>
	            </table>
            </div>
             <div class="table-responsive">
	            <table class="table table-bordered">
	               <caption>List any previous problems with <strong>Anesthesia</strong>:</caption>
	               <thead>
	                  <tr>
	                     <th>Type of Anesthesia</th>
	                     <th>Date</th>
	                     <th>Reaction</th>
	                  </tr>
	               </thead>
	               <tbody>
						<?php foreach ($anesthesiaData as $anesthesia) { ?>
		                  <tr>
		                     <td><?php echo $anesthesia['anethesia_type'];?></td>
		                     <td><?php echo date("m/d/Y", strtotime($anesthesia['report_date']));?></td>
		                     <td><?php echo $anesthesia['reaction'];?></td>
		                  </tr>
						<?php } ?>
	               </tbody>
	            </table>
            </div>
        </div>
    </div>
</div>