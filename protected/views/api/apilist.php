<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PING MY DOCTOR</title>
<link href="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/admin/layout/css/apipage.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>

<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>


</head>
<body>
<div class="maincontainer">
    <div class="hdr">
                <div class="container">
                    <div class="logo">
                        <img src="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/admin/layout/img/logo_dashboard.png" style="height: 80px;margin-top: 80px;width: 250px;" />
                    </div>
                    
                    <div class="links">
                    
                        <h1>PING MY DOCTOR REST API!</h1>	
                        
                        <ul>
                        
                        
                        <li> <a  href="<?php echo Yii::app()->params->base_path; ?>admin">ADMIN PANEL</a></li>
                       <br />
                        <li> <a href="<?php echo Yii::app()->params->base_path; ?>api">Refresh Page</a> </li>
                        <br />
                         <li> <a href="<?php echo Yii::app()->params->base_path; ?>api/possibleErrors">Possible Errors List</a> </li>
                    </ul>
                </div>
            
        </div>
    </div>
    <div class="container">
      <div class="txt">
    <p>If you are exploring PINGMYDOCTOR REST API for the very first time, you should start by reading the Guide. 	</p>
    </div>
    
      <div style="float:right">
        <ul style="list-style:none">
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/showLogs"><li class="btn">ShowLog</li></a><br /><li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/clearLogs"><li class="btn">ClearLogs</li></a>
        
        </ul>
      </div>
      
    </div>
    <div class="container">
    
      <div class="apidetail">
    <h3> Patient API List  :-</h3>
    </div> <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/patientLogin&email=dharmesh.goswami@bypeopletechnologies.com&password=111111">patientLogin</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email , password</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>email=dharmesh.goswami@bypeopletechnologies.com&password=111111</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/patientLogout&patient_id=1&session_id=SdscSEs">patientLogout</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>&patient_id=1&session_id=SdscSEs</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          	<br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getProfileByPatientId&patient_id=1&session_id=SdscSEs">getProfileByPatientId</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>other_patient_id</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>&patient_id=1&session_id=SdscSEs</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>If you want to other patient id details then set parameter <strong>"other_patient_id"</strong> value.</td>
                  </tr>
                </table>
          </div>
          
          	<br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/addCholestrol&patient_id=4&session_id=9FCp3d9T1m2lwcv&ldl=1.2&hdl=2.4&triglycerides=3.6&unit=0&total=5.2&report_date=2015-05-06&notes=test">addCholestrol</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id, ldl, hdl, triglycerides, unit, total, report_date</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>notes</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>patient_id=4&session_id=9FCp3d9T1m2lwcv&ldl=1.2&hdl=2.4&triglycerides=3.6&unit=0&total=5.2&report_date=2015-05-06&notes=test </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          	<br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/deleteCholestrol&patient_id=4&session_id=9FCp3d9T1m2lwcv&cholesterol_id=35">deleteCholestrol</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id, cholesterol_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>patient_id=4&session_id=9FCp3d9T1m2lwcv&cholesterol_id=35 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><font style="color:red">Please send multiple cholesterol_id in CSV format. Ex.22,34,45 </font>
                 	</td>
                  </tr>
                </table>
          </div>
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/editCholestrol&patient_id=4&session_id=9FCp3d9T1m2lwcv&cholesterol_id=55&ldl=1.1&hdl=1.2&triglycerides=1.3&unit=1&total=1.5&report_date=2015-05-07&notes=normal">editCholestrol</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id, cholesterol_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>ldl, hdl, triglycerides, unit, total, report_date, notes </td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>patient_id=4&session_id=9FCp3d9T1m2lwcv&cholesterol_id=35 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/cholesterolList&patient_id=4&session_id=RQukNKNE3lwAdn0">cholesterolList</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><font style="color:red">gender : 0-female, 1-male, 2-Not Specified</font>
                    <br /><font style="color:red">blood_group : 0-Not specified, 1-A+, 2-A-, 3-B+, 4-B-, 5-O+, 6-O-,7-AB+, 8-AB-</font>
                     <br /><font style="color:red">marital_status : 0-Married, 1-Widowed, 2-Seperated, 3-Divorsed, 4-Single </font>
                     <br /><font style="color:red">organ_donor : 0-No, 1-Yes </font>
                    </td>
                  </tr>
                </table>
          </div>
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getCholesterolById&patient_id=1&session_id=qDuhYYhQ0TIIJfN&cholesterol_id=2">getCholesterolById</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id, cholesterol_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=1&session_id=qDuhYYhQ0TIIJfN&cholesterol_id=2 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/addBloodGlucose&patient_id=4&session_id=9FCp3d9T1m2lwcv&blood_glucose_level=1.2&unit=3&&triglycerides=1&measurement_type=1&report_date=2015-05-06&notes=test&total=343&measurement_context_id=2">addBloodGlucose</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id, blood_glucose_level,measurement_type,triglycerides,unit,total,report_date,measurement_context_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>notes</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>patient_id=4&session_id=9FCp3d9T1m2lwcv&blood_glucose_level=1.2&unit=3&&triglycerides=1&measurement_type=1  <br />   &report_date=2015-05-06&notes=test </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
           
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/blood_glucose_List&patient_id=4&session_id=RQukNKNE3lwAdn0">blood_glucose_List</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                     <td><font style="color:red">irr_heartbeat : 0-Dont know, 1-yes, 2-no</font>
                    </td>
                  </tr>
                </table>
          </div>
          
          
           <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/blood_pressure_List&patient_id=4&session_id=RQukNKNE3lwAdn0">blood_pressure_List</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><font style="color:red">measurement_type : 0-plasma, 1-whole blood</font>
                     </td>
                  </tr>
                </table>
          </div>
          
             <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/height_List&patient_id=4&session_id=RQukNKNE3lwAdn0">height_List</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                     </td>
                  </tr>
                </table>
          </div>
          
          
             <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/weight_List&patient_id=4&session_id=RQukNKNE3lwAdn0">weight_List</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                     </td>
                  </tr>
                </table>
          </div>
          
          
          
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/isValidSession&user_id=1&session_id=w6RrctFo06e1wJS&login_type=1">isValidSession</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id , session_id,login_type</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=1&session_id=w6RrctFo06e1wJS&login_type=1 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getListOfBloodGlucose&patient_id=4&session_id=RQukNKNE3lwAdn0">getListOfBloodGlucose</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><font style="color:red">0-plasma, 1-whole blood</font>
                    <br /><font style="color:red">0-mmol/L, 1-mg/dL</font>
                    </td>
                  </tr>
                </table>
          </div>
          <br />
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getsignature&signature=hgjhghghgjh">getsignature</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>signature</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> signature=sfdsfssdfsff </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          <br />
          
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/set_patient_profile&patient_id=1&session_id=fgfgsdgdgdg&name=neha">set_patient_profile</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id,session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td> name,surname,phone_number,dob,gender,blood_group,marital_status,organ_donor</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=1&session_id=fgfgsdgdgdg</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
          </div>
          <br />
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/savehippaform&patient_id=4&session_id=RQukNKNE3lwAdn0&voice_mail=0&give_info_to_spouse=0&give_info_to=1&to_name=vishal panchal">savehippaform</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>voice_mail,give_info_to_spouse,give_info_to,to_name</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/gethippaform&patient_id=4&session_id=RQukNKNE3lwAdn0">gethippaform</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
          <br />
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/savepatient_info_questionnaire&patient_id=4&session_id=RQukNKNE3lwAdn0&voice_mail=0&give_info_to_spouse=0&give_info_to=1&to_name=vishal panchal">savepatient_info_questionnaire</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>
schedule_for,at_time ,about_practice <br />
,magazie_name,other_name,ph_ref_doctorname,ph_ref_phone,ph_address <br />
,pr_ref_doctorname,pr_ref_phone,pr_ref_address,patient_security_no <br />
,home_phone,mobile_phone,appt_no,city ,state,zipcode,alternate_address <br />
,get_newsletter,employment_status,employment_other,employer,occupation <br />
,employer_address,insured_firstname,insured_lastname,mi,insured_birthdate <br />
,insured_socialno,emergency_name,emergency_phone,emergency_address <br />
,relationship_to_patient,is_auto_accident,is_work_injury,pri_insurance_company <br />
,pri_insurance_id,pri_insurance_grp,pri_insurance_address,pri_insurance_phonenumber <br />
,sec_insurance_company,sec_insurance_id,sec_insurance_grp,sec_insurance_address <br />
,sec_insurance_phonenumber,comp_insurance,comp_claim,comp_address <br />
,comp_injury_date,adjuster_name,adjuster_phone,attorney_name,attorney_phone <br />
,info_insurance,info_claim,claim_address,info_date_injury,info_adjuster_name <br />
,info_adjuster_phone,info_attorney_name,info_attorney_phone</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
         <br /> 
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/save_medical_history&patient_id=4&session_id=RQukNKNE3lwAdn0&height=5.5&avg_height=4.52">save_medical_history</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
          
           <br /> 
          <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/get_medical_history&patient_id=4&session_id=RQukNKNE3lwAdn0">get_medical_history</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
          
          
           <div class="apidetail">
    <h3> Doctor API List  :-</h3>
    </div> <br />
           <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/doctorLogin&email=krishnachhatbar18@gmail.com&password=111111">doctorLogin</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email , password</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>email=krishnachhatbar18@gmail.com&password=111111</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/savehippaform&patient_id=4&session_id=RQukNKNE3lwAdn0&voice_mail=0&give_info_to_spouse=0&give_info_to=1&to_name=vishal panchal">savehippaform</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>voice_mail,give_info_to_spouse,give_info_to,to_name</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/gethippaform&patient_id=4&session_id=RQukNKNE3lwAdn0">gethippaform</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
          <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getAppointmentListByPatient&patient_id=4&session_id=RQukNKNE3lwAdn0">gethippaform</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>patient_id , session_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td> patient_id=4&session_id=RQukNKNE3lwAdn0 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-
                    </td>
                  </tr>
                </table>
          </div>
          <br />
          
    </div>
</div>
<div style="height:50px;"></div>
<p id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</p>
</body>    
</html>