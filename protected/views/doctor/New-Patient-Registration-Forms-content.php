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
        	<p class="ContentPara"><strong>Date:</strong> <?php echo date("Y-m-d");?></p>
            <p class="ContentPara"><strong>Name:</strong> <?php echo $patientData['name'].' '.$patientData['surname']; ?></p>
            <p class="ContentPara"><strong>Age:</strong> <?php echo daysDifference(date("Y-m-d"),$patientData['dob']); ?></p>
            <p class="ContentPara"><strong>Birthday:</strong> <?php echo $patientData['dob']; ?></p>
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
        	<p class="ContentPara"><h4 class="ContentHeading compalint">Chief Complaint: </h4> What is the problem you are being seen for today? xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx xxxxxx</p>
            <p class="ContentPara">When did this begin? (Mo/day/year)? xx/xx/xxxx</p>
            <p class="ContentPara">How did this begin? xx xx xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx</p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<p class="ContentPara"><h4 class="ContentHeading compalint">Medical History: </h4> <b>Height:</b> <?php echo $medicalData['height']; ?> &nbsp; <b>Average Weight:</b> <?php echo $medicalData['avg_height']; ?></p>
            <p class="ContentPara"><b>If you are a woman of childbearing years, is there a possibility you may be pregnant?</b> <?php if(isset($medicalData['is_pregnant']) && $medicalData['is_pregnant'] == 1) {  echo "Yes"; } else { echo "No"; } ?></p>
            <p class="ContentPara">Mark any medical condition you have been diagnosed with:</p>
            <p> <?php if(isset($medicalData['aids']) && $medicalData['aids'] == 1) { ?><i class="fa fa-check-square-o">Aids</i><?php } ?> , <?php if(isset($medicalData['hepatitis']) && $medicalData['hepatitis'] == 1) { ?><i class="fa fa-check-square-o">Hepatitis</i><?php } ?>
		</p>
        <p>
 <?php if(isset($medicalData['other_disease']) && $medicalData['other_disease'] != '') { ?><i class="fa fa-check-square-o">Other Disease</i><?php } ?> : <?php echo $medicalData['other_disease']; ?>				</p>
 
            <p class="ContentPara"><b>Blood clots :</b> <?php if(isset($medicalData['blood_clots'])) { echo $medicalData['blood_clots']; } ?> &nbsp; <b>Diabetes/controlled by :  </b> <?php if(isset($medicalData['diet']) && $medicalData['diet'] == 1) { ?><i class="fa fa-check-square-o">Diet</i><?php } ?>, <?php if(isset($medicalData['pills']) && $medicalData['pills'] == 1) { ?><i class="fa fa-check-square-o">Pills</i><?php } ?>, <?php if(isset($medicalData['insulin']) && $medicalData['insulin'] == 1) { ?><i class="fa fa-check-square-o">Insulin</i><?php } ?></p>
            <p class="ContentPara"><b>Heart Problems/Type : </b> <?php if(isset($medicalData['epilepsy']) && $medicalData['epilepsy'] == 1) { ?><i class="fa fa-check-square-o">epilepsy</i><?php } ?></p><p><b>Heart Problems/Type </b><?php if(isset($medicalData['heart_problem']) && $medicalData['heart_problem'] != '') {  echo $medicalData['heart_problem'];  } ?></p>
            <p class="ContentPara">
            
            <?php if(isset($medicalData['high_blood_pressure']) && $medicalData['high_blood_pressure'] == 1) { ?><i class="fa fa-check-square-o">High Blood Pressure</i><?php } ?>
            &nbsp;
            <?php if(isset($medicalData['low_thyroid']) && $medicalData['low_thyroid'] == 1) { ?><i class="fa fa-check-square-o">Low Thyroid</i><?php } ?>
            &nbsp;
            <?php if(isset($medicalData['bowel']) && $medicalData['bowel'] == 1) { ?><i class="fa fa-check-square-o">Bowel</i><?php } ?>
            &nbsp;
            <?php if(isset($medicalData['ulcers']) && $medicalData['ulcers'] == 1) { ?><i class="fa fa-check-square-o">Ulcers</i><?php } ?>
            &nbsp;
            <?php if(isset($medicalData['prolapse']) && $medicalData['prolapse'] == 1) { ?><i class="fa fa-check-square-o">Prolapse</i><?php } ?>
            </p>
            <p class="ContentPara"><b>Lung Disease/Type : </b> <?php if(isset($medicalData['lung_disease'])) { echo $medicalData['lung_disease']; } ?></p>
            
            <p class="ContentPara">
            
            <?php if(isset($medicalData['polio']) && $medicalData['polio'] == 1) { ?><i class="fa fa-check-square-o">Polio</i><?php } ?>
            &nbsp;
            <?php if(isset($medicalData['arthritis']) && $medicalData['arthritis'] == 1) { ?><i class="fa fa-check-square-o">Arthritis</i><?php } ?>
            &nbsp;
            <?php if(isset($medicalData['tuberculosis']) && $medicalData['tuberculosis'] == 1) { ?><i class="fa fa-check-square-o">Tuberculosis</i><?php } ?>
            &nbsp;
            </p>
            
            <p class="ContentPara"><b>Psychiatric Disorder/Type :</b> <?php if(isset($medicalData['tuberculosis'])) { echo $medicalData['tuberculosis']; } ?></p>
            <p class="ContentPara"><b>Please list any other known medical conditions or symptoms not listed above:</b> <?php if(isset($medicalData['other_unknown'])) { echo $medicalData['other_unknown']; } ?></p>
            <p class="ContentPara"><b>Please list any <strong>injuries</strong> including car accident, fall, lifting, etc:</b> <?php if(isset($medicalData['injuries'])) { echo $medicalData['injuries']; } ?></p>
            <p class="ContentPara"><b>Please list any <strong>hospitalizations</strong> (other than surgeries):</b> <?php if(isset($medicalData['hospitalization'])) { echo $medicalData['hospitalization']; } ?></p>
        </div>
    </div>
    <div class="row ContentTable">
    	<div class="col-sm-12">
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
            <p class="ContentPara">Have any of your relatives ever had any of the following:</p>
            <p class="ContentPara">Yes Relationship (Mother, Father, Sister or Brother)</p>
            <p class="ContentPara">Father - Diabetes</p>
            <p class="ContentPara">Mother - Diabetes</p>
            <p class="ContentPara">Sister - Diabetes</p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Social History: </h4>
            <p class="ContentPara">Employed? : Yes</p>
            <p class="ContentPara">Most recent Occupation: xxxx</p>
            <p class="ContentPara">Children? : Yes</p>
            <p class="ContentPara">If yes, how many/ages? : <strong>No</strong> : 2 / <strong>Age</strong> : 5 Yesrs, 2 Years</p>
            <p class="ContentPara">Do you live: Alone</p>
            <p class="ContentPara">Are you at risk for AIDs? : No</p>
            <p class="ContentPara">Do you have a history of: Substance abuse/Type? xxxxxxxxx</p>
            <p class="ContentPara">Do you currently use alcohol? : Yes - Weekends</p>
            <p class="ContentPara">Are you a smoker? : Yes - x Packs per day for x years</p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Review of Systems: </h4>
            <p class="ContentPara">Constitutional symptoms - Easy fatigue</p>
            <p class="ContentPara">Skin - Bruising</p>
            <p class="ContentPara">Head, Ears, Eyes, Nose, Throat (HEENT) - Dizziness</p>
            <p class="ContentPara">Respiratory - Hemoptysis (spitting of blood)</p>
            <p class="ContentPara">Cardiovascular - High blood pressure</p>
            <p class="ContentPara">Gastrointestinal - Nausea and/or vomiting</p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<p class="ContentPara">To My Knowledge, I attest that the above information is true and accurate</p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-6">Patient’s Signature - xxxx xxx xxx xxx</div>
        <div class="col-sm-6">Date - xx xx xxxx</div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h1 class="ContentHeading text-center">Medications and Allergies</h1>
            <h4 class="ContentHeading ContentUnderline">Medications:</h4>
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
                  <tr>
                     <td>Drugxxxx</td>
                     <td>Dosexxxx</td>
                     <td>How Oftenxxxx</td>
                     <td>Prescribed by xxxx</td>
                     <td>When xxxx</td>
                  </tr>
                  <tr>
                     <td>Drugxxxx</td>
                     <td>Dosexxxx</td>
                     <td>How Oftenxxxx</td>
                     <td>Prescribed by xxxx</td>
                     <td>When xxxx</td>
                  </tr>
                   <tr>
                     <td>Drugxxxx</td>
                     <td>Dosexxxx</td>
                     <td>How Oftenxxxx</td>
                     <td>Prescribed by xxxx</td>
                     <td>When xxxx</td>
                  </tr>                    
               </tbody>
            </table>
            <table class="table table-bordered">
               <caption>List any diet pills, herbs, or vitamins over-the-counter you may be taking:</caption>
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Dosage/How Often</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Drugxxxx</td>
                     <td>Dosage xx/ 5</td>
                     
                  </tr>
                  <tr>
                      <td>Drugxxxx</td>
                     <td>Dosage xx/ 5</td>
                     
                  </tr>
                   <tr>
                     <td>Drugxxxx</td>
                     <td>Dosage xx/ 5</td>
                     
                  </tr>                    
               </tbody>
            </table>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Allergies</h4>
            <table class="table table-bordered">
               <caption>List any ALLERGY to MEDICATIONS and reaction:</caption>
               <thead>
                  <tr>
                     <th>Name of medication</th>
                     <th>Reaction</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Drugxxxx</td>
                     <td>Reaction xx</td>
                     
                  </tr>
                  <tr>
                  <td>Drugxxxx</td>
                     <td>Reaction xx</td>
                     
                  </tr>
                   <tr>
                    <td>Drugxxxx</td>
                     <td>Reaction xx</td>
                     
                  </tr>
                   <tr>
                    <td>Xray Dye - Yes</td>
                     <td>Reaction xx</td>                     
                  </tr>
                  <tr>
                    <td>Latex - Yes</td>
                     <td>Reaction xx</td>                     
                  </tr> 
                  <tr>
                    <td>Tape/type - Yes</td>
                     <td>Reaction xx</td>                     
                  </tr>                      
               </tbody>
            </table>
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
                  <tr>
                     <td>Anesthesia xxxx</td>
                     <td>Date xx/xx/xxxx</td>
                     <td>Reaction xx</td>
                  </tr>
                  <tr>
                  	 <td>Anesthesia xxxx</td>
                     <td>Date xx/xx/xxxx</td>
                     <td>Reaction xx</td>
                  </tr>                                       
               </tbody>
            </table>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h3 class="ContentHeading text-center">Neurospine Institute<br>
Robert L. Masson, M.D., Mitchell L. Supler, M.D.<br>
<span class="ContentUnderline">Patient Information Questionnaire</span></h3>
        </div>
    </div>
    
    <div class="row">
    	<div class="col-sm-12">
        	<p class="ContentPara">How did you learn about our practice? - Website</p>
            <p class="ContentPara">other - xxxxxx</p>
            <h4 class="ContentParaTitle ContentUnderline">Physician Referring You To Our Practice:</h4>
            <p class="ContentPara"><strong>Doctor Name</strong> - Dr. xxxxxxx xxxx xxx</p>
            <p class="ContentPara"><strong>Phone #</strong> - 98524-xx-xxx</p>            
            <p class="ContentPara"><strong>Address</strong> - xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx xxxx xxx</p>
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Primary Care Physician:</h4>
            <p class="ContentPara"><strong>Doctor Name</strong> - Dr. xxxxxxx xxxx xxx</p>
            <p class="ContentPara"><strong>Phone #</strong> - 98524-xx-xxx</p>            
            <p class="ContentPara"><strong>Address</strong> - xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx xxxx xxx</p>
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Patient Information:</h4>
            <p class="ContentPara"><strong>Marital Status:</strong> - Married</p>
            <p class="ContentPara"><strong>Sex:</strong> - Male</p>
            <p class="ContentPara"><strong>Last Name:</strong> - xxxxxxx</p>
            <p class="ContentPara"><strong>First Name:</strong> - xxxx</p>
            <p class="ContentPara"><strong>Patient’s Social Security #:</strong> - xxxx</p>
            <p class="ContentPara"><strong>Date of Birth:</strong> - xxxx</p>
            <p class="ContentPara"><strong>Home Phone #:</strong> - xxxx-xxx-xxxxxx</p>
            <p class="ContentPara"><strong>Mobile Phone #</strong> - xxxx-xxx-xx</p>
            <p class="ContentPara"><strong>Home Address:</strong> - xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx xxxx xxx</p>
            <p class="ContentPara"><strong>Apt #:</strong> - xxxx-xxx-xxxxxx</p>
            <p class="ContentPara"><strong>City:</strong> - xxxx</p>
            <p class="ContentPara"><strong>State:</strong> - xxxx</p>
            <p class="ContentPara"><strong>Zip:</strong> - xxxx</p>
            <p class="ContentPara"><strong>Alternate Address:</strong> - xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx</p>
            <p class="ContentPara"><strong>Email Address:</strong> - xxxx@xx.com</p>
            <p class="ContentPara"><strong>Would you like to receive a monthly email newsletter</strong> - Yes</p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentParaTitle ContentUnderline">Employment Information</h4>
            <p class="ContentPara"><strong>Employment Status:</strong> - Full Time</p>
            <p class="ContentPara"><strong>Employer:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Occupation:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Employer Address:</strong> - xxxxx</p>  
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Primary Insured Person On Your Insurance (Guarantor):</h4>
            <p class="ContentPara"><strong>Last Name:</strong> - Full Time</p>
            <p class="ContentPara"><strong>First Name:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>M.I.</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Birthdate:</strong> - xxxxx</p>      
            <p class="ContentPara"><strong>Social Security #:</strong> - xxxxx</p>     
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Emergency Information: (Not living in the same household):</h4>
            <p class="ContentPara"><strong>Please Notify (Name)</strong> - xxxx xxxx</p>
            <p class="ContentPara"><strong>Phone #</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Address</strong> - xxxxx xxxxxxx xxxx xxx</p>
            <p class="ContentPara"><strong>Relationship to patient</strong> - xxxxx</p>  
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Insurance Information</h4>
            <p class="ContentPara"><strong>Is your visit today related to an auto accident?</strong> - Yes</p>
            <p class="ContentPara"><strong>Is your visit today related to a work injury?</strong> - No</p>
            <p class="ContentPara"><strong>Health Insurance Information: (Please provide card at time of visit)</strong></p>
            <p class="ContentPara"><strong>Primary Insurance Co:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>I.D.#</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Grp #</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Address:</strong> -  xxxxx xxxxx xxxxx xxxxx</p>
            <p class="ContentPara"><strong>Phone #:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Secondary Insurance Co:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>I.D.#</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Grp #</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Address:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Secondary Insurance Co:</strong> -  xxxxx xxxxx xxxxx xxxxx</p>
            <p class="ContentPara"><strong>Phone #:</strong> - xxxxx</p>   
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Worker’s Compensation Information</h4>
            <p class="ContentPara"><strong>Insurance:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Claim #:</strong> - xxxxx</p>                        
            <p class="ContentPara"><strong>Claims Address:</strong> -  xxxxx xxxxx xxxxx xxxxx</p>
            <p class="ContentPara"><strong>Date of Injury:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Adjuster Name:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Phone #:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Attorney Name:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Phone #:</strong> - xxxxx</p> 
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Auto Carrier Information</h4>
            <p class="ContentPara"><strong>Insurance:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Claim #:</strong> - xxxxx</p>                        
            <p class="ContentPara"><strong>Claims Address:</strong> -  xxxxx xxxxx xxxxx xxxxx</p>
            <p class="ContentPara"><strong>Date of Injury:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Adjuster Name:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Phone #:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Attorney Name:</strong> - xxxxx</p>
            <p class="ContentPara"><strong>Phone #:</strong> - xxxxx</p>                          
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentParaTitle ContentUnderline">Conditions of Treatment</h4>
            <p class="ContentPara"><span class="ContentUnderline compalint"><strong>Assignment of Insurance Benefits :</strong></span> In the event I am entitled to benefits or other recovery of any type whatsoever arising out of any policy of insurance insuring the patient or any other party liable to the patient, including but not limited to private and group health and hospitalization benefits, automobile liability, general liability, personal injury protection, medical payments and uninsured and underinsured medical benefits, such benefits or recovery are hereby assigned directly to the Neurospine Institute for application to the patient’s bill, and I authorize direct payment to the Neurospine Institute of such benefits or recovery. I acknowledge that Section 817.234, Florida Statutes, provides that “any person who knowingly and with intent to injury, defraud, or deceive any insurer files a statement of claim or an application containing any false, incomplete or misleading information is guilty of a felony in the third degree.</p>
            <p class="ContentPara"><span class="ContentUnderline compalint"><strong>Authorization to Release Confidential Information:</strong></span> In the event I am entitled to benefits or other recovery of any type whatsoever arising out of any policy of insurance insuring the patient or any other party liable to the patient, including but not limited to private and group health and hospitalization benefits, automobile liability, general liability, personal injury protection, medical payments and uninsured and underinsured medical benefits, such benefits or recovery are hereby assigned directly to the Neurospine Institute for application to the patient’s bill, and I authorize direct payment to the Neurospine Institute of such benefits or recovery. I acknowledge that Section 817.234, Florida Statutes, provides that “any person who knowingly and with intent to injury, defraud, or deceive any insurer files a statement of claim or an application containing any false, incomplete or misleading information is guilty of a felony in the third degree.</p>
            <p class="ContentPara">I request that the Neurospine Institute withhold the following information from release: xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx xxxxxxx xxxx xxx xxxxxxx xxxx xxx xxxxxxx</p>
            <p class="ContentPara">I understand that if I do not authorize release of this information for the purpose of securing payment, I will be billed directly for the Neurospine Institute’s charges. The authorization will remain in effect until the Neurospine Institute has been paid or settled, and may be revoked prior to that time, except to the extent that action has already been taken in reliance on it. Patients with implantable devices authorize the release of their Social Security number to the device manufacturer to comply with the Safe Medical Devices Act.</p>
            <p class="ContentPara"><span class="ContentUnderline compalint"><strong>Patient/Guarantor Agreement:</strong></span> Whether I sign as agent/representative or patient, in consideration of the services to be rendered to patient, I hereby individually obligate myself to pay and unconditionally guarantee payment to the Neurospine Institute of patient’s co-payments, deductibles and non-covered charges, in accordance with the regulate rates of the physicians of the Neurospine Institute or any of it’s allied health staff, or such other rates and terms as are applicable to patient’s account (s) by contract or regulation. Should any portions of the patient’s account be referred to an attorney for collection, I agree to pay all expenses of collection, including reasonable attorney’s fees, whether suit is filed or not. For purposes of this agreement, non-covered charges are those charges not covered by a third party payer for any reason.</p>
            <p class="ContentPara"><span class="ContentUnderline compalint"><strong>Consent for Evaluation and Treatment:</strong></span> The patient hereby consents to any evaluation and treatment the assigned physician of the Institute may deem necessary to the patient named above.</p>
            <p class="ContentPara"><span class="ContentUnderline compalint"><strong>Assignment of Medicare Benefits:</strong></span> Patient Certification, Authorization to Release Information. I certify that the information given by me in applying for payment under Title XVII of the Social Security Act is correct. I authorize any holder of medical or other information about me to release to the Social Security Administration or is intermediaries or carriers any information needed for this or related Medicare claim. I permit a copy of this authorization to be used in place of the original. I request that payment of the authorized benefits be made on my behalf. I assign the benefits payable for physician services to the physician or the Neurospine Institute or authorize the physician or the Neurospine Institute to submit a claim to Medicare for payment to me. I understand that I am responsible for any applicable deductible and co-insurance, and non-covered services, including personal charges.</p>
            <p class="ContentPara">Execution of my signature below authorizes and agrees with all conditions above:</p>
            
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-6">Signature of Patient - xxxx xxx xxx xxx</div>
        <div class="col-sm-6">Date - xx xx xxxx</div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
    	<div class="col-sm-6">Signature of Parent, Guardian, and/or Responsible Party - xxxx xxx xxx xxx</div>
        <div class="col-sm-6">Date - xx xx xxxx</div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h3 class="ContentHeading text-center">Neurospine Institute<br>
Robert L. Masson, M.D., Mitchell L. Supler, M.D.<br>
<span class="ContentUnderline">Patient Information-Privacy Notice</span></h3>
			<h3 class="ContentHeading">WRITTEN ACKNOWLEDGEMENT OF PATIENT OR PERSONAL REPRESENTATIVE OF PATIENT THAT THEY HAVE READ NEUROSPINE INSTITUTE’S PRIVACY PRACTICE PROVIDED VIA WEBSITE OR PHYSICAL ADDRESS LISTED BELOW:</h3>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-6">Signature of Patient/Personal Representative</div>
        <div class="col-sm-6">Social Security Number - xx xx xxxx</div>
    </div>
    <div class="row">
    	<div class="col-sm-6">Date - xx xx xxxx</div>        
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading text-center">REQUESTS FOR COPIES OF THE NEUROSPINE INSTITUTE PRIVACY PRACTICE CAN BE MADE IN WRITING TO THE FOLLOWING ADDRESS:</h4>
            <h4 class="ContentHeading text-center">Neurospine Institute<br>
2706 Rew Circle, Ste 200,<br>
Ocoee, Florida 34761</h4>
        </div>
    </div>
     
</div>           