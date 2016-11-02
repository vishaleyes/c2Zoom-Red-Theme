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
            <p class="ContentPara"><strong>Marital Status:</strong> - <?php echo $patientData['marital_status']; ?></p>
            <p class="ContentPara"><strong>Sex:</strong> - <?php echo $patientData['gender']; ?></p>
            <p class="ContentPara"><strong>Last Name:</strong> - <?php echo $patientData['surname']; ?></p>
            <p class="ContentPara"><strong>First Name:</strong> - <?php echo $patientData['name']; ?></p>
            <p class="ContentPara"><strong>Patient’s Social Security #:</strong> - <?php echo $patientInfo['patient_security_no']; ?></p>
            <p class="ContentPara"><strong>Date of Birth:</strong> - <?php echo $patientData['dob']; ?></p>
            <p class="ContentPara"><strong>Home Phone #:</strong> - <?php echo $patientInfo['home_phone']; ?></p>
            <p class="ContentPara"><strong>Mobile Phone #</strong> - <?php echo $patientInfo['mobile_phone']; ?></p>
            <p class="ContentPara"><strong>Home Address:</strong> - <?php echo $patientInfo['mobile_phone']; ?></p>
            <p class="ContentPara"><strong>Apt #:</strong> - <?php echo $patientInfo['appt_no']; ?></p>
            <p class="ContentPara"><strong>City:</strong> - <?php echo $patientInfo['city']; ?></p>
            <p class="ContentPara"><strong>State:</strong> - <?php echo $patientInfo['state']; ?></p>
            <p class="ContentPara"><strong>Zip:</strong> - <?php echo $patientInfo['zipcode']; ?></p>
            <p class="ContentPara"><strong>Alternate Address:</strong> - <?php echo $patientInfo['alternate_address']; ?></p>
            <p class="ContentPara"><strong>Email Address:</strong> - <?php echo $patientData['email']; ?></p>
            <p class="ContentPara"><strong>Would you like to receive a monthly email newsletter</strong> - <?php if($patientData['get_newsletter'] == 1){ echo "Yes"; } else { echo "No"; } ?></p>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentParaTitle ContentUnderline">Employment Information</h4>
            <p class="ContentPara"><strong>Employment Status:</strong> - <?php echo $patientInfo['employment_status']; ?></p>
            <p class="ContentPara"><strong>Employer:</strong> - <?php echo $patientInfo['employer']; ?></p>
            <p class="ContentPara"><strong>Occupation:</strong> - <?php echo $patientInfo['occupation']; ?></p>
            <p class="ContentPara"><strong>Employer Address:</strong> - <?php echo $patientInfo['employer_address']; ?></p>  
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Primary Insured Person On Your Insurance (Guarantor):</h4>
            <p class="ContentPara"><strong>Last Name:</strong> - <?php echo $patientInfo['insured_lastname']; ?></p>
            <p class="ContentPara"><strong>First Name:</strong> - <?php echo $patientInfo['insured_firstname']; ?></p>
            <p class="ContentPara"><strong>M.I.</strong> - <?php echo $patientInfo['mi']; ?></p>
            <p class="ContentPara"><strong>Birthdate:</strong> - <?php echo $patientInfo['insured_birthdate']; ?></p>      
            <p class="ContentPara"><strong>Social Security #:</strong> - <?php echo $patientInfo['insured_socialno']; ?></p>     
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Emergency Information: (Not living in the same household):</h4>
            <p class="ContentPara"><strong>Please Notify (Name)</strong> - <?php echo $patientInfo['emergency_name']; ?></p>
            <p class="ContentPara"><strong>Phone #</strong> - <?php echo $patientInfo['emergency_phone']; ?></p>
            <p class="ContentPara"><strong>Address</strong> - <?php echo $patientInfo['emergency_address']; ?></p>
            <p class="ContentPara"><strong>Relationship to patient</strong> - <?php echo $patientInfo['relationship_to_patient']; ?></p>  
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Insurance Information</h4>
            <p class="ContentPara"><strong>Is your visit today related to an auto accident?</strong> - <?php if($patientInfo['is_auto_accident'] == 1) { echo "Yes"; } else { echo "No"; } ?></p>
            <p class="ContentPara"><strong>Is your visit today related to a work injury?</strong> - <?php if($patientInfo['is_work_injury'] == 1) { echo "Yes"; } else { echo "No"; } ?></p>
            <p class="ContentPara"><strong>Health Insurance Information: (Please provide card at time of visit)</strong></p>
            <p class="ContentPara"><strong>Primary Insurance Co:</strong> - <?php echo $patientInfo['pri_insurance_company']; ?></p>
            <p class="ContentPara"><strong>I.D.#</strong> - <?php echo $patientInfo['pri_insurance_id']; ?></p>
            <p class="ContentPara"><strong>Grp #</strong> - <?php echo $patientInfo['pri_insurance_grp']; ?></p>
            <p class="ContentPara"><strong>Address:</strong> -  <?php echo $patientInfo['pri_insurance_address']; ?></p>
            <p class="ContentPara"><strong>Phone #:</strong> - <?php echo $patientInfo['pri_insurance_phonenumber']; ?></p>
            <p class="ContentPara"><strong>Secondary Insurance Co:</strong> - <?php echo $patientInfo['sec_insurance_company']; ?></p>
            <p class="ContentPara"><strong>I.D.#</strong> - <?php echo $patientInfo['sec_insurance_id']; ?></p>
            <p class="ContentPara"><strong>Grp #</strong> - <?php echo $patientInfo['sec_insurance_grp']; ?></p>
            <p class="ContentPara"><strong>Address:</strong> - <?php echo $patientInfo['sec_insurance_address']; ?></p>
            <p class="ContentPara"><strong>Phone #:</strong> - <?php echo $patientInfo['sec_insurance_phonenumber']; ?></p>   
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Worker’s Compensation Information</h4>
            <p class="ContentPara"><strong>Insurance:</strong> - <?php echo $patientInfo['comp_insurance']; ?></p>
            <p class="ContentPara"><strong>Claim #:</strong> - <?php echo $patientInfo['sec_insurance_phonenumber']; ?></p>                        
            <p class="ContentPara"><strong>Claims Address:</strong> -  <?php echo $patientInfo['comp_address']; ?></p>
            <p class="ContentPara"><strong>Date of Injury:</strong> - <?php echo $patientInfo['comp_injury_date']; ?></p>
            <p class="ContentPara"><strong>Adjuster Name:</strong> - <?php echo $patientInfo['adjuster_name']; ?></p>
            <p class="ContentPara"><strong>Phone #:</strong> - <?php echo $patientInfo['adjuster_phone']; ?></p>
            <p class="ContentPara"><strong>Attorney Name:</strong> - <?php echo $patientInfo['attorney_name']; ?></p>
            <p class="ContentPara"><strong>Phone #:</strong> - <?php echo $patientInfo['attorney_phone']; ?></p> 
            <p>&nbsp;</p>
            <h4 class="ContentParaTitle ContentUnderline">Auto Carrier Information</h4>
            <p class="ContentPara"><strong>Insurance:</strong> - <?php echo $patientInfo['info_insurance']; ?></p>
            <p class="ContentPara"><strong>Claim #:</strong> - <?php echo $patientInfo['info_claim']; ?></p>                        
            <p class="ContentPara"><strong>Claims Address:</strong> -  <?php echo $patientInfo['claim_address']; ?></p>
            <p class="ContentPara"><strong>Date of Injury:</strong> - <?php echo $patientInfo['info_date_injury']; ?></p>
            <p class="ContentPara"><strong>Adjuster Name:</strong> - <?php echo $patientInfo['info_adjuster_name']; ?></p>
            <p class="ContentPara"><strong>Phone #:</strong> - <?php echo $patientInfo['info_adjuster_phone']; ?></p>
            <p class="ContentPara"><strong>Attorney Name:</strong> - <?php echo $patientInfo['info_attorney_name']; ?></p>
            <p class="ContentPara"><strong>Phone #:</strong> - <?php echo $patientInfo['info_attorney_phone']; ?></p>                          
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentParaTitle ContentUnderline">Conditions of Treatment</h4>
            <p class="ContentPara"><span class="ContentUnderline compalint"><strong>Assignment of Insurance Benefits :</strong></span> In the event I am entitled to benefits or other recovery of any type whatsoever arising out of any policy of insurance insuring the patient or any other party liable to the patient, including but not limited to private and group health and hospitalization benefits, automobile liability, general liability, personal injury protection, medical payments and uninsured and underinsured medical benefits, such benefits or recovery are hereby assigned directly to the Neurospine Institute for application to the patient’s bill, and I authorize direct payment to the Neurospine Institute of such benefits or recovery. I acknowledge that Section 817.234, Florida Statutes, provides that “any person who knowingly and with intent to injury, defraud, or deceive any insurer files a statement of claim or an application containing any false, incomplete or misleading information is guilty of a felony in the third degree.</p>
            <p class="ContentPara"><span class="ContentUnderline compalint"><strong>Authorization to Release Confidential Information:</strong></span> In the event I am entitled to benefits or other recovery of any type whatsoever arising out of any policy of insurance insuring the patient or any other party liable to the patient, including but not limited to private and group health and hospitalization benefits, automobile liability, general liability, personal injury protection, medical payments and uninsured and underinsured medical benefits, such benefits or recovery are hereby assigned directly to the Neurospine Institute for application to the patient’s bill, and I authorize direct payment to the Neurospine Institute of such benefits or recovery. I acknowledge that Section 817.234, Florida Statutes, provides that “any person who knowingly and with intent to injury, defraud, or deceive any insurer files a statement of claim or an application containing any false, incomplete or misleading information is guilty of a felony in the third degree.</p>
            <p class="ContentPara">I request that the Neurospine Institute withhold the following information from release:  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;          </p>
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