<?php
error_reporting(0);
require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");
require_once(FILE_PATH."/protected/extensions/dicom/dicom.php");
class PatientController extends Controller
{
	
	public function isLogin() {
        if (isset(Yii::app()->session['pingmydoctor_patient'])) {
            return true;
        } else {
            Yii::app()->user->setFlash("error", "Email or password required");
            header("Location: " . Yii::app()->params->base_path . "admin/index");
            exit;
        }
    }
	
	public function actionIndex()
	{
		 if (isset(Yii::app()->session['pingmydoctor_patient'])) {
		 $this->redirect(array("patient/patientHome"));
		 }
		 else
		 {
			 $this->redirect(array('admin/index'));
		 }
	}
	
	function actionpatientHome()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'home';
		$this->render("patientHome");
	}
	
	function actionpatientLogin()
	{
		if (isset($_POST['loginBtn'])) 
		{
			$time = time();
			
			if(isset($_POST['remember']) && $_POST['remember'] == 1)
			{
				setcookie("email", $_POST['email'], $time + 3600);
				setcookie("password", $_POST['password'], $time + 3600);
			}else{
				setcookie("email", "", $time + 3600);
				setcookie("password", "", $time + 3600);
			}
			
			if(isset($_POST['email']))
			{
				$email = $_POST['email'];
				$pwd = $_POST['password'];
					
				$PatientMasterObj	=	new PatientMaster();
				$patient_data	=	$PatientMasterObj->getPatientDetailsByEmail($email);
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_POST['password'], $patient_data['password']);
			
			if ( $isValid === true ) {
				Yii::app()->session['pingmydoctor_patient'] = $patient_data['patient_id'];
				Yii::app()->session['patient_email'] = $patient_data['email'];
				Yii::app()->session['patient_name'] = $patient_data['name'];
				Yii::app()->session['doctor_id'] = $patient_data['doctor_id'];
				Yii::app()->session['patient_image'] = $patient_data['patient_image'];
				Yii::app()->session['patient_fullName'] = $patient_data['name'] . ' ' . $patient_data['surname'];
				Yii::app()->session['active_tab'] = 'home';
				$this->redirect(array("patient/patientHome"));
			
				exit;
			} else {
				Yii::app()->user->setFlash("error","Email or Password is not valid");
				$this->redirect(array('admin/index'));
				exit;
			}	
		}
	
	}
	
	function actionpatientLoginFromAdmin()
	{
		if (isset($_GET)) 
		{
			$time = time();
			$_REQUEST = $_REQUEST[0];
			if(isset($_REQUEST['remember']) && $_REQUEST['remember'] == 1)
			{
				setcookie("email", $_REQUEST['email'], $time + 3600);
				setcookie("password", $_REQUEST['password'], $time + 3600);
			}else{
				setcookie("email", "", $time + 3600);
				setcookie("password", "", $time + 3600);
			}
			
			if(isset($_REQUEST['email']))
			{
				$email = $_REQUEST['email'];
				$pwd = $_REQUEST['password'];
					
				$PatientMasterObj	=	new PatientMaster();
				$patient_data	=	$PatientMasterObj->getPatientDetailsByEmail($email);
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_REQUEST['password'], $patient_data['password']);
			
			if ( $isValid === true ) {
				Yii::app()->session['pingmydoctor_patient'] = $patient_data['patient_id'];
				Yii::app()->session['patient_email'] = $patient_data['email'];
				Yii::app()->session['patient_name'] = $patient_data['name'];
				Yii::app()->session['patient_image'] = $patient_data['patient_image'];
				Yii::app()->session['doctor_id'] = $patient_data['doctor_id'];
				Yii::app()->session['patient_fullName'] = $patient_data['name'] . ' ' . $patient_data['surname'];
				
				Yii::app()->session['active_tab'] = 'home';
				$this->redirect(array("patient/patientHome"));
			
				exit;
			} else {
				Yii::app()->user->setFlash("error","Email or Password is not valid");
				$this->redirect(array('admin/index'));
				exit;
			}	
		}
	
	}
		
	function actionpatientProfile()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			$PatientMasterObj = new PatientMaster();	
			$patientData = $PatientMasterObj->getUserById(Yii::app()->session['pingmydoctor_patient']);
			
			$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();	
			$patientInfoData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
			
			Yii::app()->session['patient_fullName'] = $patientData['name']." ".$patientData['surname'];
			
			$this->render("patientProfile",array('patientData'=>$patientData,'patientInfoData'=>$patientInfoData));
		}
		else
		{
			$this->render("patientProfile");
		}
	}
	
	function actionpatientLogout()
	{
		$this->isLogin();
		Yii::app()->session->destroy();
		$this->redirect(array("admin/index"));
	}
	
	function actionsavePatientProfile()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		/*echo "<pre>";
		print_r($_REQUEST);
		die;*/
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientProfile']))
			{
				$data = array();
				$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				
				if(isset($_POST['name']) && $_POST['name']!='')
				{
					$data['name'] = $_POST['name'];	
				}
				if(isset($_POST['email']) && $_POST['email']!='')
				{
					$data['email'] = $_POST['email'];	
				}
				if(isset($_POST['dob']) && $_POST['dob']!='')
				{
					
					
					$data['dob'] = date("Y-m-d",strtotime($_POST['dob']));	
				}
				if(isset($_POST['gender']) && $_POST['gender']!='')
				{
					$data['gender'] = $_POST['gender'];	
				}
				if(isset($_POST['marital_status']) && $_POST['marital_status']!='')
				{
					$data['marital_status'] = $_POST['marital_status'];	
				}
				
				if(isset($_POST['address']) && $_POST['address']!='')
				{
					$data['address'] = $_POST['address'];	
				}
				
				if(isset($_POST['middle_name']) && $_POST['middle_name']!='')
				{
					$data['middle_name'] = $_POST['middle_name'];	
				}
				
				if(isset($_POST['country']) && $_POST['country']!='')
				{
					$data['country_id'] = $_POST['country'];	
				}
				if(isset($_POST['surname']) && $_POST['surname']!='')
				{
					$data['surname'] = $_POST['surname'];	
				}
				if(isset($_POST['phone_number']) && $_POST['phone_number']!='')
				{
					$data['phone_number'] = $_POST['phone_number'];	
				}
				if(isset($_POST['blood_group']) && $_POST['blood_group']!='')
				{
					$data['blood_group'] = $_POST['blood_group'];	
				}
				if(isset($_POST['organ_donor']) && $_POST['organ_donor']=='on')
				{
					$data['organ_donor'] = 1;	
				}
				else
				{
					$data['organ_donor'] = 0;	
				}
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!=''))
				{
					
				if( ( isset($_FILES['patient_image']['name']) ) && ( $_FILES['patient_image']['name'] != "" ) ) 
				 {
					$data['patient_image']= "patient_".Yii::app()->session['pingmydoctor_patient'].".png";
					move_uploaded_file($_FILES['patient_image']["tmp_name"],"assets/upload/avatar/patient/".$data['patient_image']);
				 }
				if(isset($_POST['doctor_id']))
				{
					$data['doctor_id'] = $_POST['doctor_id'];
				}
				
				$data['modified_at'] = date("Y-m-d H:i:s");
				
				$patientInfoData = array();
				if(isset($_POST['patient_security_no']) && $_POST['patient_security_no']!='')
				{
					$patientInfoData['patient_security_no'] = $_POST['patient_security_no'];	
				}
				
				if(isset($_POST['home_phone']) && $_POST['home_phone']!='')
				{
					$patientInfoData['home_phone'] = $_POST['home_phone'];	
				}
				
				if(isset($_POST['mobile_phone']) && $_POST['mobile_phone']!='')
				{
					$patientInfoData['mobile_phone'] = $_POST['mobile_phone'];	
				}
				if(isset($_POST['alternate_address']) && $_POST['alternate_address']!='')
				{
					$patientInfoData['alternate_address'] = $_POST['alternate_address'];	
				}	
				if(isset($_POST['zipcode']) && $_POST['zipcode']!='')
				{
					$patientInfoData['zipcode'] = $_POST['zipcode'];	
				}
				if(isset($_POST['zipcode']) && $_POST['zipcode']!='')
				{
					$patientInfoData['zipcode'] = $_POST['zipcode'];	
				}
				
				if(isset($_POST['appt_no']) && $_POST['appt_no']!='')
				{
					$patientInfoData['appt_no'] = $_POST['appt_no'];	
				}	
				
				if(isset($_POST['city']) && $_POST['city']!='')
				{
					$patientInfoData['city'] = $_POST['city'];	
				}	
				
				//if(isset($_POST['state']) && $_POST['state']!='')
				if(isset($_POST['state']))				{
					$patientInfoData['state'] = $_POST['state'];	
				}
					
				if(isset($_POST['get_newsletter']) && $_POST['get_newsletter']!='')
				{
					$patientInfoData['get_newsletter'] = $_POST['get_newsletter'];	
				}
				else
				{
					$patientInfoData['get_newsletter']  = 2;
				}
				
				
				try 
				{
					
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
					$patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						
						$patientInfoData['patient_id'] = $data['patient_id'] ;
						
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
				
					Yii::app()->user->setFlash("success", "Profile is updated successfully");
					
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of Profile.");
					die('fail');
				}
				
				$PatientMaster = new PatientMaster();
				$emailData = $PatientMaster->checkEmailId($data['email']);
				
					if( ( $emailData=="" || $emailData==NULL ) || ( $emailData['patient_id'] == Yii::app()->session['pingmydoctor_patient'] ) )
					{
						try 
						{
							$PatientMaster = new PatientMaster();
							$PatientMaster->setData($data);
							$PatientMaster->insertData(Yii::app()->session['pingmydoctor_patient']);
							Yii::app()->user->setFlash("success", "Profile is updated successfully");
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Profile.");
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("patientProfile",array('patientData'=>$data,'patient_id'=>Yii::app()->session['pingmydoctor_patient']));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Patient Name and Email are Required.");
					$this->render("patientProfile",array('patientData'=>$data,'patient_id'=>Yii::app()->session['pingmydoctor_patient']));
					die;
				}
					
				if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
				{
					$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
				}
				else
				{
					$this->redirect(array("patient/patientProfile"));
				}
				
			}
		}
		else
		{
			$this->redirect(array("patient/patientHome"));
		}
	}
	
	function actionsavePatientEmploymentData()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		/*echo "<pre>";
		print_r($_REQUEST);
		die;*/
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientEmploymentProfile']))
			{
				$patientInfoData = array();
				if(isset($_POST['employment_status']) && $_POST['employment_status']!='')
				{
					$patientInfoData['employment_status'] = $_POST['employment_status'];	
				}
				
				if(isset($_POST['employment_other']) && $_POST['employment_other']!='')
				{
					$patientInfoData['employment_other'] = $_POST['employment_other'];	
				}
				
				if(isset($_POST['employer']) && $_POST['employer']!='')
				{
					$patientInfoData['employer'] = $_POST['employer'];	
				}
				if(isset($_POST['employer_address']) && $_POST['employer_address']!='')
				{
					$patientInfoData['employer_address'] = $_POST['employer_address'];	
				}	
				if(isset($_POST['occupation']) && $_POST['occupation']!='')
				{
					$patientInfoData['occupation'] = $_POST['occupation'];	
				}
				
				
				try 
				{
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						$patientInfoData['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
					Yii::app()->user->setFlash("success", "Employment details is updated successfully");
					if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
					{
						$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
					}
					else
					{
						$this->redirect(array("patient/patientProfile"));
					}
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of employment details.");
					$this->redirect(array("patient/patientProfile"));
					die('fail');
				}
				
			}
		}
		else
		{
			$this->redirect(array("patient/patientHome"));
		}
	}
	
	function actionsavePatientPrimaryInsuredInfo()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientPrimaryInsuredInfo']))
			{
				$patientInfoData = array();
				if(isset($_POST['insured_lastname']) && $_POST['insured_lastname']!='')
				{
					$patientInfoData['insured_lastname'] = $_POST['insured_lastname'];	
				}
				
				if(isset($_POST['insured_firstname']) && $_POST['insured_firstname']!='')
				{
					$patientInfoData['insured_firstname'] = $_POST['insured_firstname'];	
				}
				
				if(isset($_POST['mi']) && $_POST['mi']!='')
				{
					$patientInfoData['mi'] = $_POST['mi'];	
				}
				if(isset($_POST['insured_birthdate']) && $_POST['insured_birthdate']!='')
				{
					$patientInfoData['insured_birthdate'] = date("Y-m-d",strtotime($_POST['insured_birthdate']));	
				}	
				if(isset($_POST['insured_socialno']) && $_POST['insured_socialno']!='')
				{
					$patientInfoData['insured_socialno'] = $_POST['insured_socialno'];	
				}
				
				
				try 
				{
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						$patientInfoData['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
					Yii::app()->user->setFlash("success", "Primary Insured details is updated successfully");
					if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
					{
						$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
					}
					else
					{
						$this->redirect(array("patient/patientProfile"));
					}
					
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of primary Insured details.");
					$this->redirect(array("patient/patientProfile"));
					die('fail');
				}
				
			}
		}
		else
		{
			$this->redirect(array("patient/patientHome"));
		}
	}
	
	function actionsavePatientEmergencyInfo()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		/*print "<pre>";
		print_r($_REQUEST);
		die;*/
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientEmergencyInfo']))
			{
				$patientInfoData = array();
				if(isset($_POST['emergency_name']) && $_POST['emergency_name']!='')
				{
					$patientInfoData['emergency_name'] = $_POST['emergency_name'];	
				}
				
				if(isset($_POST['emergency_phone']) && $_POST['emergency_phone']!='')
				{
					$patientInfoData['emergency_phone'] = $_POST['emergency_phone'];	
				}
				
				if(isset($_POST['emergency_address']) && $_POST['emergency_address']!='')
				{
					$patientInfoData['emergency_address'] = $_POST['emergency_address'];	
				}
				if(isset($_POST['relationship_to_patient']) && $_POST['relationship_to_patient']!='')
				{
					$patientInfoData['relationship_to_patient'] = $_POST['relationship_to_patient'];	
				}	
				
				try 
				{
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						$patientInfoData['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
					Yii::app()->user->setFlash("success", "Patient's emergency details is updated successfully");
					if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
					{
						$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
					}
					else
					{
						$this->redirect(array("patient/patientProfile"));
					}
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of emergency details.");
					$this->redirect(array("patient/patientProfile"));
					die('fail');
				}
				
			}
		}
		else
		{
			$this->redirect(array("patient/patientHome"));
		}
	}
	
	
	function actionsavePatientInsuranceInfo()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		/*print "<pre>";
		print_r($_REQUEST);
		die;*/
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientInsuranceInfo']))
			{
				$patientInfoData = array();
				if(isset($_POST['is_auto_accident']) && $_POST['is_auto_accident']!='')
				{
					$patientInfoData['is_auto_accident'] = $_POST['is_auto_accident'];	
				}
				else
				{
					$patientInfoData['is_auto_accident'] = 0;
				}
				
				if(isset($_POST['is_work_injury']) && $_POST['is_work_injury']!='')
				{
					$patientInfoData['is_work_injury'] = $_POST['is_work_injury'];	
				}
				else
				{
					$patientInfoData['is_work_injury'] = 0;
				}
				
				
					
				
				try 
				{
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				 $patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						$patientInfoData['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
					Yii::app()->user->setFlash("success", "Patient's insurance details is updated successfully");
					if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
					{
						$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
					}
					else
					{
						$this->redirect(array("patient/patientProfile"));
					}
					
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of insurance details.");
					$this->redirect(array("patient/patientProfile"));
					die('fail');
				}
				
			}
		}
		else
		{
			$this->redirect(array("patient/patientProfile"));
		}
	}
	
	
	function actionsavePatientHealthInsurance()
	{
		
		$this->isLogin();
		Yii::app()->session['	active_tab'] = 'profile';
		
		
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientHealthInsurance']))
			{
				$patientInfoData = array();
				if(isset($_POST['pri_insurance_company']) && $_POST['pri_insurance_company']!='')
				{
					$patientInfoData['pri_insurance_company'] = $_POST['pri_insurance_company'];	
				}
				
				if(isset($_POST['pri_insurance_id']) && $_POST['pri_insurance_id']!='')
				{
					$patientInfoData['pri_insurance_id'] = $_POST['pri_insurance_id'];	
				}
				
				if(isset($_POST['pri_insurance_grp']) && $_POST['pri_insurance_grp']!='')
				{
					$patientInfoData['pri_insurance_grp'] = $_POST['pri_insurance_grp'];	
				}
				
				if(isset($_POST['pri_insurance_address']) && $_POST['pri_insurance_address']!='')
				{
					$patientInfoData['pri_insurance_address'] = $_POST['pri_insurance_address'];	
				}
				
				if(isset($_POST['pri_insurance_phonenumber']) && $_POST['pri_insurance_phonenumber']!='')
				{
					$patientInfoData['pri_insurance_phonenumber'] = $_POST['pri_insurance_phonenumber'];	
				}
				
				if(isset($_POST['sec_insurance_company']) && $_POST['sec_insurance_company']!='')
				{
					$patientInfoData['sec_insurance_company'] = $_POST['sec_insurance_company'];	
				}
				
				if(isset($_POST['sec_insurance_id']) && $_POST['sec_insurance_id']!='')
				{
					$patientInfoData['sec_insurance_id'] = $_POST['sec_insurance_id'];	
				}
				
				if(isset($_POST['sec_insurance_grp']) && $_POST['sec_insurance_grp']!='')
				{
					$patientInfoData['sec_insurance_grp'] = $_POST['sec_insurance_grp'];	
				}
				
				if(isset($_POST['sec_insurance_address']) && $_POST['sec_insurance_address']!='')
				{
					$patientInfoData['sec_insurance_address'] = $_POST['sec_insurance_address'];	
				}
				
				if(isset($_POST['sec_insurance_phonenumber']) && $_POST['sec_insurance_phonenumber']!='')
				{
					$patientInfoData['sec_insurance_phonenumber'] = $_POST['sec_insurance_phonenumber'];	
				}
				
				
				$patientMasterData = array();
				if(isset($_REQUEST['pcp']) && $_REQUEST['pcp'] != '')
				{
					$patientMasterData['doctor_id'] = $_REQUEST['pcp'];
					
					$PatientMasterObj = new PatientMaster();
					$PatientMasterObj->setData($patientMasterData);
					$PatientMasterObj->insertData(Yii::app()->session['pingmydoctor_patient']);
					
					$DoctorPatientRelationObj = new DoctorPatientRelation();
					// check weather record already exist or not. In case exists then do nothing otherwise remove old entry and insert new one.
					$arrPatientPCPData = $DoctorPatientRelationObj->checkRecord($_REQUEST['pcp'], Yii::app()->session['pingmydoctor_patient'], 1);
					if (!$arrPatientPCPData)
					{
						$DoctorPatientRelationObj->deletePatientData(Yii::app()->session['pingmydoctor_patient'],1);
						$doctorPatientRelation = array();
						$doctorPatientRelation['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$doctorPatientRelation['doctor_id'] = $_REQUEST['pcp'];
						$doctorPatientRelation['is_share'] = 0;
						$doctorPatientRelation['doctor_type'] = 1;
						$doctorPatientRelation['status'] = 1;
						$doctorPatientRelation['created_at'] = date("Y-m-d H:i:s");
						
						$DoctorPatientRelationObj = new DoctorPatientRelation();
						$DoctorPatientRelationObj->setData($doctorPatientRelation);
						$DoctorPatientRelationObj->insertData();
					}
				}
				
				$patientMasterData = array();
				if(isset($_REQUEST['acp']) && $_REQUEST['acp'] != '')
				{
					$patientMasterData['acp'] = $_REQUEST['acp'];
					// added logic to add entry if not exist otherwise only those entry needs to remove which is not avial in $_REQUEST['acp']
					$DoctorPatientRelationObj = new DoctorPatientRelation();
					$docPatientACPData = $DoctorPatientRelationObj->getACPdetails_by_patientidArray( Yii::app()->session ['pingmydoctor_patient'] );
					$arrDBPatientACP = array();
					foreach ($docPatientACPData as $keyPatientACP => $valuePatientACP)
					{
						$arrDBPatientACP[] = $valuePatientACP['doctor_id'];
					}
					$arrInsertPatientRelationData = array_diff($patientMasterData['acp'], $arrDBPatientACP);
					$arrDeletePatientRelationData = array_diff($arrDBPatientACP, $patientMasterData['acp']);
					// Delete unchecked records.
					foreach($arrDeletePatientRelationData as $keyDelete => $valueDelete)
					{
						if ($valueDelete>0)
						{
							$DoctorPatientRelationObj->deleteDoctorPatientRelation($valueDelete, Yii::app()->session ['pingmydoctor_patient']);
						}
					}
					// insert records
					foreach ($arrInsertPatientRelationData as $keyInsert => $valueInsert)
					{
						if ($valueInsert>0)
						{
							$doctorPatientRelation = array();
							$doctorPatientRelation['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
							$doctorPatientRelation['doctor_id'] = $valueInsert;
							$doctorPatientRelation['is_share'] = 0;
							$doctorPatientRelation['doctor_type'] = 2;
							$doctorPatientRelation['status'] = 1;
							$doctorPatientRelation['created_at'] = date("Y-m-d H:i:s");
								
							$DoctorPatientRelationObj = new DoctorPatientRelation();
							$DoctorPatientRelationObj->setData($doctorPatientRelation);
							$DoctorPatientRelationObj->insertData();
						}
					}
				}
				try 
				{
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
					$patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);

					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						$patientInfoData['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
					Yii::app()->user->setFlash("success", "Patient's health insurance details is updated successfully");
					if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
					{
						$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
					}
					else
					{
						$this->redirect(array("patient/patientProfile"));
					}
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of health insurance details.");
					$this->redirect(array("patient/patientProfile"));
					die('fail');
				}
				
			}
		}
		else
		{
			$this->redirect(array("patient/patientProfile"));
		}
	}
	
	
	function actionsavePatientCompensationInfo()
	{
		
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		/*print "<pre>";
		print_r($_REQUEST);
		die;*/
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientCompensationInfo']))
			{
				$patientInfoData = array();
				if(isset($_POST['comp_insurance']) && $_POST['comp_insurance']!='')
				{
					$patientInfoData['comp_insurance'] = $_POST['comp_insurance'];	
				}
				
				if(isset($_POST['comp_claim']) && $_POST['comp_claim']!='')
				{
					$patientInfoData['comp_claim'] = $_POST['comp_claim'];	
				}
				
				if(isset($_POST['comp_address']) && $_POST['comp_address']!='')
				{
					$patientInfoData['comp_address'] = $_POST['comp_address'];	
				}
				
				if(isset($_POST['comp_injury_date']) && $_POST['comp_injury_date']!='')
				{
					$patientInfoData['comp_injury_date'] = date("Y-m-d",strtotime($_POST['comp_injury_date']));
				}
				
				if(isset($_POST['adjuster_name']) && $_POST['adjuster_name']!='')
				{
					$patientInfoData['adjuster_name'] = $_POST['adjuster_name'];	
				}
				
				if(isset($_POST['adjuster_phone']) && $_POST['adjuster_phone']!='')
				{
					$patientInfoData['adjuster_phone'] = $_POST['adjuster_phone'];	
				}
				
				if(isset($_POST['attorney_name']) && $_POST['attorney_name']!='')
				{
					$patientInfoData['attorney_name'] = $_POST['attorney_name'];	
				}
				
				if(isset($_POST['attorney_phone']) && $_POST['attorney_phone']!='')
				{
					$patientInfoData['attorney_phone'] = $_POST['attorney_phone'];	
				}
				
				
				try 
				{
				$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						$patientInfoData['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
					Yii::app()->user->setFlash("success", "Patient's compensation details is updated successfully");
					if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
					{
						$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
					}
					else
					{
						$this->redirect(array("patient/patientProfile"));
					}
					
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of compensation details.");
					$this->redirect(array("patient/patientProfile"));
					die('fail');
				}
			}
		}
		else
		{
			$this->redirect(array("patient/patientProfile"));
		}
	}
	
	
	
	function actionsavePatientAutoCarrierInfo()
	{
		
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		/*print "<pre>";
		print_r($_REQUEST);
		die;*/
		
		if( (isset(Yii::app()->session['pingmydoctor_patient']) ) && ( Yii::app()->session['pingmydoctor_patient']!='' ) )
		{
			if(isset($_POST['savePatientAutoCarrierInfo']))
			{
				$patientInfoData = array();
				if(isset($_POST['info_insurance']) && $_POST['info_insurance']!='')
				{
					$patientInfoData['info_insurance'] = $_POST['info_insurance'];	
				}
				
				if(isset($_POST['info_claim']) && $_POST['info_claim']!='')
				{
					$patientInfoData['info_claim'] = $_POST['info_claim'];	
				}
				
				if(isset($_POST['claim_address']) && $_POST['claim_address']!='')
				{
					$patientInfoData['claim_address'] = $_POST['claim_address'];	
				}
				
				if(isset($_POST['info_date_injury']) && $_POST['info_date_injury']!='')
				{
					$patientInfoData['info_date_injury'] = date("Y-m-d",strtotime($_POST['info_date_injury']));	
				}
				
				if(isset($_POST['info_adjuster_name']) && $_POST['info_adjuster_name']!='')
				{
					$patientInfoData['info_adjuster_name'] = $_POST['info_adjuster_name'];	
				}
				
				if(isset($_POST['info_adjuster_phone']) && $_POST['info_adjuster_phone']!='')
				{
					$patientInfoData['info_adjuster_phone'] = $_POST['info_adjuster_phone'];	
				}
				
				if(isset($_POST['info_attorney_name']) && $_POST['info_attorney_name']!='')
				{
					$patientInfoData['info_attorney_name'] = $_POST['info_attorney_name'];	
				}
				
				if(isset($_POST['info_attorney_phone']) && $_POST['info_attorney_phone']!='')
				{
					$patientInfoData['info_attorney_phone'] = $_POST['info_attorney_phone'];	
				}
				
				
				try 
				{
				$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patientInfoQuestionnaireData = $patientInfoQuestionnaireObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
					if(isset($patientInfoQuestionnaireData['patient_info_id']))
					{
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData($patientInfoQuestionnaireData['patient_info_id']);
					}
					else
					{
						$patientInfoData['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
						$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
						$patientInfoQuestionnaireObj->setData($patientInfoData);
						$patientInfoQuestionnaireObj->insertData();
					}
					Yii::app()->user->setFlash("success", "Patient's auto carrier details is updated successfully");
					if (isset($_POST) && isset($_POST['tab']) && !empty($_POST['tab']))
					{
						$this->redirect(array("patient/patientProfile/", "tab"=>$_POST['tab']));
					}
					else
					{
						$this->redirect(array("patient/patientProfile"));
					}
					
				}
				catch(Exception $e)
				{
					Yii::app()->user->setFlash("error", "Problem in updation of auto carrier details.");
					$this->redirect(array("patient/patientProfile"));
					die('fail');
				}
				
			}
		}
		else
		{
			$this->redirect(array("patient/patientProfile"));
		}
	}
	
	
	
	function actionchangePassword()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'home';
		Yii::app()->session['active_sub_tab'] = 'home';
		if(isset($_POST['FormSubmit']))
		{
			$validationObj = new Validation();
			$res = $validationObj->changepasswordPatient($_POST);
			
			if($res['status'] != 0)
			{
				Yii::app()->user->setFlash("error",$res['message']);
				$this->render("changePassword");
				exit;	
			}else{
				$generalObj = new General();
				$password = $generalObj->encrypt_password($_POST['newpassword']);
				
				$data = array();
				$data['password'] = $password ; 
				$data['modified_at'] = date("Y-m-d H:i:s") ; 
				
				$PatientMaster = new PatientMaster();
				$PatientMaster->setData($data);
				$insertedId = $PatientMaster->insertData(Yii::app()->session['pingmydoctor_patient']);
				
				Yii::app()->user->setFlash("success","password changed successfully");
				$this->render("changePassword");
				exit;
			}
		
		}
		
		$this->render('changePassword');	
	}
	
	
	function actioncholesterolListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		
		$CholesterolMeasurementObj = new CholesterolMeasurement();	
		$cholesterolList = $CholesterolMeasurementObj->getAllCholesterolListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($cholesterolList) && $cholesterolList!='')
		{		
			$this->render("cholesterolListing",array("cholesterolList"=>$cholesterolList));
		}
		else
		{
			$this->render("cholesterolListing");	
		}
	}
	
	function actionbloodGlucoseListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodGlucose';
		
		$BloodGlucoseMeasurement = new BloodGlucoseMeasurement();	
		$bloodGlucoseList = $BloodGlucoseMeasurement->getAllBloodGlucoselListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($bloodGlucoseList) && $bloodGlucoseList!='')
		{		
			$this->render("bloodGlucoseListing",array("bloodGlucoseList"=>$bloodGlucoseList));
		}
		else
		{
			$this->render("bloodGlucoseListing");	
		}
	}
	
	function actionbloodPressureListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodPressure';
		
		$BloodPressureMeasurement = new BloodPressureMeasurement();	
		$bloodPressureList = $BloodPressureMeasurement->getAllBloodPressureListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($bloodPressureList) && $bloodPressureList!='')
		{		
			$this->render("bloodPressureListing",array("bloodPressureList"=>$bloodPressureList));
		}
		else
		{
			$this->render("bloodPressureListing");	
		}
	}
	
	function actionheightListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'height';
		
		$HeightMeasurement = new HeightMeasurement();	
		$heightList = $HeightMeasurement->getAllHeightListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($heightList) && $heightList!='')
		{		
			$this->render("heightListing",array("heightList"=>$heightList));
		}
		else
		{
			$this->render("heightListing");	
		}
	}
	
	function actionweightListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'weight';
		
		$WeightMeasurement = new WeightMeasurement();	
		$weightList = $WeightMeasurement->getAllWeightListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($weightList) && $weightList!='')
		{		
			$this->render("weightListing",array("weightList"=>$weightList));
		}
		else
		{
			$this->render("weightListing");	
		}
	}
	
	function actionallergyListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'allergy';
		
		$AllergyHealthHistory = new AllergyHealthHistory();	
		$allergyList = $AllergyHealthHistory->getAllergyHealthHistoryListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($allergyList) && $allergyList!='')
		{		
			$this->render("allergyListing",array("allergyList"=>$allergyList));
		}
		else
		{
			$this->render("allergyListing");	
		}
	}
		
	function actionimmunizationListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'immunization';
		
		$ImmunizationHealthHistory = new ImmunizationHealthHistory();	
		$immunizationList = $ImmunizationHealthHistory->getImmunizationHealthHistoryListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($immunizationList) && $immunizationList!='')
		{		
			$this->render("immunizationListing",array("immunizationList"=>$immunizationList));
		}
		else
		{
			$this->render("immunizationListing");	
		}
	}
	
	function actionmedicationListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'medication';
		
		$MedicationHealthHistory = new MedicationHealthHistory();	
		$medicationList = $MedicationHealthHistory->getMedicationListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($medicationList) && $medicationList!='')
		{		
			$this->render("medicationListing",array("medicationList"=>$medicationList));
		}
		else
		{
			$this->render("medicationListing");	
		}
	}
	
	function actionprocedureListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'procedure';
		
		$ProcedureHealthHistory = new ProcedureHealthHistory();	
		$procedureList = $ProcedureHealthHistory->getProcedureListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($procedureList) && $procedureList!='')
		{		
			$this->render("procedureListing",array("procedureList"=>$procedureList));
		}
		else
		{
			$this->render("procedureListing");	
		}
	}
	
	public function actiongetAllFormsForUser()
	{
		Yii::app()->session['active_tab'] = 'form';
// 		$HipaaFormDetailsObj = new HipaaFormDetails();
// 		$hipaaData = $HipaaFormDetailsObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
// 		//print_r($hipaaData); die;
// 		$this->render("formsListing",array('hipaaData'=>$hipaaData));
		
		$DocumentMasterObj = new DocumentMaster();
		$DocumentData = $DocumentMasterObj->getDocumentList(Yii::app()->session['pingmydoctor_patient']);
		$this->render("formsListing",array('DocumentData'=>$DocumentData));
	}
		
	public function actionupdateHipaaForm()
	{
		$HipaaFormDetailsObj = new HipaaFormDetails();
		$hipaaData = $HipaaFormDetailsObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
			$PatientMasterObj = new PatientMaster();
			$patient_data = $PatientMasterObj->getpatientdata(Yii::app()->session['pingmydoctor_patient']);
			if(!empty($patient_data))
			{
				$hipaaData['name']	= $patient_data['name'] . '  ' . $patient_data['surname'];
				$hipaaData['dob']	= $patient_data['dob'];			
			}
		
		//print_r($hipaaData); die;
		$this->render("updateHipaaForm",array('hipaaData'=>(array)$hipaaData));
	}
	
	public function actionsaveHipaaForm()
	{
		if(isset($_POST))
		{
			$data = array();
			if(!empty($_POST['voicemail']))
			{
				$data['voice_mail'] = $_POST['voicemail'];
			}
			else
			{
				$data['voice_mail'] = 0;
			}
			if(!empty($_POST['give_info_to_spouse']))
			{
				$data['give_info_to_spouse'] = $_POST['give_info_to_spouse'];
			}
			else 
			{
				$data['give_info_to_spouse'] = 0;
			}
			
			if(isset($_POST['give_to_chk']))
			{
				$data['give_info_to'] =  1;
			}
			else
			{
				$data['give_info_to'] =  0;
			}
			if(!empty($_POST['form_for']))
			{
				$data['form_for'] = $_POST['form_for'][0];
			}
			if(!empty($_POST['to_name']))
			{
				$data['to_name'] = $_POST['to_name'];
			}
			$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
			//echo $data['patient_id']; die;
			$HipaaFormDetailsObj = new HipaaFormDetails();
			$hipaaData = $HipaaFormDetailsObj->getdetailsByPatientId($data['patient_id']);			
			if(!empty($hipaaData) &&  isset($hipaaData))
			{    // Come for record Update
				$data['modified_at'] = date("Y-m-d H:i:s");
				$HipaaFormDetailsObj = new HipaaFormDetails();
				$HipaaFormDetailsObj->setData($data);
				$id = $HipaaFormDetailsObj->insertData($hipaaData['form_id']);
			}
			else
			{	// come for record Insert
				$data['created_at'] = date("Y-m-d H:i:s");
				$HipaaFormDetailsObj = new HipaaFormDetails();
				$HipaaFormDetailsObj->setData($data);
				$id = $HipaaFormDetailsObj->insertData();
			}
			$this->actionhipaa($data['patient_id']);
			
			$DocumentMasterObj = new DocumentMaster();
			$DocumentData = $DocumentMasterObj->getDocumentList(Yii::app()->session['pingmydoctor_patient']);
			$this->render("formsListing",array('DocumentData'=>$DocumentData));
			
			//$this->redirect(array("patient/getAllFormsForUser"));
			
		}
		
		
	}
	
	public function actionhipaa()
	{
		require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");
	
		$HipaaFormDetailsObj = new HipaaFormDetails();
		$hipaa=$HipaaFormDetailsObj->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById($_REQUEST['patient_id']);
		
		$hipaa = (object) $hipaa;
		$imageURL = 'assets/upload/signatures/patient_sign_'. $_REQUEST['patient_id'].'.png';
		//print "<pre>"; print_r($hipaa);die;
		 $html='<div align="center"><h2>HIPAA Authorization for Release of Information</h2><h2>To Family and/or Friends</h2></div>
        		<table>
        			<tr>
        				<td  align="left">
        					<span><b>Name of Patient :</b></span>
        				</td>
        				<td  align="left">
        					<span>'.$hipaa->name.' '.$hipaa->surname.'</span>
        				</td>
        				<td align="right">
        					<span><b>DOB :</b></span>
        				</td>
        				<td  align="left">
        					<span>'.$hipaa->dob.'</span>
        				</td>
        			</tr>
        			<tr>
        				<td  colspan="4">
	        				<p>
								<span style="font-weight:bold">Neurospine Institute</span> is authorized to release
								protected health information about the above named patient in
								the following manner:
							</p>
						</td>
        			</tr>
        			<tr>
        				<td  colspan="4">
	        				<p>';
        					if($hipaa->voice_mail==""){
        						$html.=" <b> Don't leave information </b>";
        					}
        					else{
        						$html.=' <b>  Leave information on voicemail at :</b>'.($hipaa->voice_mail==0?"Home":($hipaa->voice_mail==1?"Work":"CellPhone"));
        					}
							$html.='</p>
						</td>
        			</tr>
        			<tr>
        				<td  colspan="4">
	        				<p>';
        					if($hipaa->give_info_to_spouse == 1){
        						$html.="<b> Give information to spouse : </b>  Yes ";
        					}
							else
							{
								$html.="<b> Give information to spouse : </b>  No ";
							}
        					
							$html.='</p>
						</td>
        			</tr>
					<tr>
        				<td  colspan="4">
	        				<p>';
        					
        					if($hipaa->give_info_to == 1 )
							{
        						$html.='Give information to : <span style="font-weight:bold">'.$hipaa->to_name."</span>";
        					}
							$html.='</p>
						</td>
        			</tr>
        			<tr>
        				<td  colspan="4">
	        				<p>
								<span style="font-weight:bold">Rights of the Patient :</span> I understand that I
								have the right to revoke this authorization at any time and
								that I have the right to inspect or copy the protected health
								information to be disclosed as described in this document by
								sending a written notification to Neurospine Institute. I
								understand that a revocation is not effective in cases where
								the information has already been disclosed, but will be
								effective going forward. I understand that information used or
								disclosed as a result of this authorization may be subject to
								redisclosure by the recipient and may no longer be protected by
								federal or state law. I understand that I have the right to
								refuse to sign this authorization and that my treatment will
								not be conditioned on signing this authorization. This
								authorization shall be in force and effect until revoked by the
								patient or representative signing the authorization.
							</p>
						</td>
        			</tr>
				</table>
				<table>
				<tr><td><br><br><br></td></tr>
				<tr><td><br><br><br></td></tr>
				<tr><td align="left">Sign</td>
				</tr>
				
				<tr><td align="left"> <img src=' . $imageURL . ' /> </td></tr>
				</table>
				
				';
				//echo $html; die;
				$mpdf = new mPDF();
				//$_REQUEST['patient_id'] = 4;
				$filename = $_REQUEST['patient_id'].'_Hipaa';
				
				$HippaFormdata = array();
				$HippaFormdata['hippa_form'] = $filename.'.pdf'; 
				$HippaFormdata['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				
				$PatientFormsHistoryObj =  new PatientFormsHistory();
				$patientFormsData = $PatientFormsHistoryObj->getFormsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
				if(!empty($patientFormsData) && $patientFormsData['patient_id'] == $HippaFormdata['patient_id'])
				{
					$HippaFormdata['doctor_id'] = $patientData['doctor_id'];
					$HippaFormdata['modified_at'] = date("Y-m-d H:i:s");
					
					$dotorNot = array();
					$dotorNot['doctor_id'] = $patientData['doctor_id'];
					$dotorNot['patient_id'] = $patientData['patient_id'];
					$dotorNot['form'] = 'Hippa';
					$dotorNot['created_at'] = date("Y-m-d H:i:s");
					
					$DoctorNotificationObj = new DoctorNotification();
					$DoctorNotificationObj->setData($dotorNot);
					$DoctorNotificationObj->insertData();
					
					$PatientFormsHistoryObj =  new PatientFormsHistory();
					$PatientFormsHistoryObj->setData($HippaFormdata);
					$PatientFormsHistoryObj->insertData($patientFormsData['patient_forms_id']);
					
					
					
				}
				else
				{
					$HippaFormdata['doctor_id'] = $patientData['doctor_id'];
					$HippaFormdata['created_at'] = date("Y-m-d H:i:s");
					
					$dotorNot = array();
					$dotorNot['doctor_id'] = $patientData['doctor_id'];
					$dotorNot['patient_id'] = $patientData['patient_id'];
					$dotorNot['form'] = 'Hippa';
					$dotorNot['created_at'] = date("Y-m-d H:i:s");
					
					$DoctorNotificationObj = new DoctorNotification();
					$DoctorNotificationObj->setData($dotorNot);
					$DoctorNotificationObj->insertData();
					
					
					$PatientFormsHistoryObj =  new PatientFormsHistory();
					$PatientFormsHistoryObj->setData($HippaFormdata);
					$PatientFormsHistoryObj->insertData();
				}
				$mpdf->WriteHTML($html);
				$mpdf->Output(FILE_PATH."assets/upload/pdf/".$filename.".pdf", 'F');
				//echo $html;
		//die;
	}
	
	function actionappointmentList()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'appointments';
		
		$AppointmentObj = new Appointment();
		$appointmentData = $AppointmentObj->getAppointmentListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		$this->render("appointmentList",array("appointmentData"=>$appointmentData));
	}
	
	function actionappointmentListFromHeader()
	{
		$this->isLogin();
		if(isset($_REQUEST['appointment_id']))
		{
			$appointmentData = array();
			$appointmentData['patient_view'] = 1;
			$appointmentData['modified_at'] = date("Y-m-d H:i:s");
			$AppointmentObj = new Appointment();
			$AppointmentObj->setData($appointmentData);
			$AppointmentObj->insertData($_REQUEST['appointment_id']);
			
		}
		
		Yii::app()->session['active_tab'] = 'appointments';
		
		$AppointmentObj = new Appointment();
		$appointmentData = $AppointmentObj->getAppointmentListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		$this->render("appointmentList",array("appointmentData"=>$appointmentData));
	}
	function actionaddCholesterol()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		
		if(isset($_REQUEST['cholesterol_id']) && ($_REQUEST['cholesterol_id'])!='' )
		{
			$CholesterolMeasurementObj = new CholesterolMeasurement();	
			$cholesterolData = $CholesterolMeasurementObj->getDetailsByCholesterolId($_REQUEST['cholesterol_id']);
			
			if(!empty($cholesterolData) && $cholesterolData!='')
			{
				$this->render("addCholesterol",array("cholesterolData"=>$cholesterolData));
			}
		}
		else
		{
			$this->render("addCholesterol");
		}
	}
	
	function actionsaveCholesterol()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
					
		if(isset($_REQUEST['cholesterol_id']) && ($_REQUEST['cholesterol_id'])!='' )
		{
						
			if(isset($_REQUEST['saveCholesterol']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['ldl']) && !empty($_REQUEST['ldl']) && $_REQUEST['ldl']!='' )
				{	
					if(is_numeric(trim($_REQUEST['ldl'])) == false)
					{
						$validationError['ldlErr'] = "Numbers Only";
					}
					else
					{
						$data['ldl'] = $_REQUEST['ldl'];
					}
				}
				else
				{  $validationError['ldlErr'] = "Required"; }
				
				if( isset($_REQUEST['ldl_unit']) && $_REQUEST['ldl_unit']!='' )
				{	
					$data['unit'] = $_REQUEST['ldl_unit'];
				}
				else
				{  $validationError['ldl_unitErr'] = "Required"; }
				
				if( isset($_REQUEST['hdl']) && !empty($_REQUEST['hdl']) && $_REQUEST['hdl']!='' )
				{
					if(is_numeric(trim($_REQUEST['hdl'])) == false)
					{
						$validationError['hdlErr'] = "Numbers Only";
					}
					else
					{	$data['hdl'] = $_REQUEST['hdl']; }
				}
				else
				{  $validationError['hdlErr'] = "Required"; }
				
				if( isset($_REQUEST['triglycerides']) && !empty($_REQUEST['triglycerides']) && $_REQUEST['triglycerides']!='' )
				{	
					if(is_numeric(trim($_REQUEST['triglycerides'])) == false)
					{
						$validationError['triglyceridesErr'] = "Numbers Only";
					}
					else
					{
						$data['triglycerides'] = $_REQUEST['triglycerides'];
					}
				}
				else
				{  $validationError['triglyceridesErr'] = "Required"; }
				
				if( isset($_REQUEST['total']) && !empty($_REQUEST['total']) && $_REQUEST['total']!='' )
				{ 
					if(is_numeric(trim($_REQUEST['total'])) == false)
					{
						$validationError['totalErr'] = "Numbers Only";
					}
					else
					{
						$data['total'] = $_REQUEST['total'];
					}
				}
				else
				{  $validationError['totalErr'] = "Required"; }
				
				if( isset($_REQUEST['when']) && !empty($_REQUEST['when']) && $_REQUEST['when']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['when']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addCholesterol",array("validationError"=>$validationError,"cholesterolData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$CholesterolMeasurementObj = new CholesterolMeasurement();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$CholesterolMeasurementObj=CholesterolMeasurement::model()->findByPk($_REQUEST['cholesterol_id']);
					 	$CholesterolMeasurementObj->attributes=$data;
					 	if($CholesterolMeasurementObj->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Cholesterol data is updated successfully");
							$this->redirect(array("patient/cholesterolListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Cholesterol Updation.");
							$this->render("addCholesterol",array("validationError"=>$validationError,"cholesterolData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Cholesterol Updation.");
						$this->render("addCholesterol",array("validationError"=>$validationError,"cholesterolData"=>$data));
					}
				}
			}
		}
		else
		{
			if(isset($_REQUEST['saveCholesterol']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['ldl']) && !empty($_REQUEST['ldl']) && $_REQUEST['ldl']!='' )
				{	
					if(is_numeric(trim($_REQUEST['ldl'])) == false)
					{
						$validationError['ldlErr'] = "Numbers Only";
					}
					else
					{
						$data['ldl'] = $_REQUEST['ldl'];
					}
				}
				else
				{  $validationError['ldlErr'] = "Required"; }
				
				if( isset($_REQUEST['ldl_unit']) && $_REQUEST['ldl_unit']!='' )
				{
					$data['unit'] = $_REQUEST['ldl_unit'];
				}
				else
				{ 	$validationError['ldl_unitErr'] = "Required"; }
				
				if( isset($_REQUEST['hdl']) && !empty($_REQUEST['hdl']) && $_REQUEST['hdl']!='' )
				{
					if(is_numeric(trim($_REQUEST['hdl'])) == false)
					{
						$validationError['hdlErr'] = "Numbers Only";
					}
					else
					{	$data['hdl'] = $_REQUEST['hdl']; }
				}
				else
				{  $validationError['hdlErr'] = "Required"; }
				
				if( isset($_REQUEST['triglycerides']) && !empty($_REQUEST['triglycerides']) && $_REQUEST['triglycerides']!='' )
				{	
					if(is_numeric(trim($_REQUEST['triglycerides'])) == false)
					{
						$validationError['triglyceridesErr'] = "Numbers Only";
					}
					else
					{
						$data['triglycerides'] = $_REQUEST['triglycerides'];
					}
				}
				else
				{  $validationError['triglyceridesErr'] = "Required"; }
				
				if( isset($_REQUEST['total']) && !empty($_REQUEST['total']) && $_REQUEST['total']!='' )
				{ 
					if(is_numeric(trim($_REQUEST['total'])) == false)
					{
						$validationError['totalErr'] = "Numbers Only";
					}
					else
					{
						$data['total'] = $_REQUEST['total'];
					}
				}
				else
				{  $validationError['totalErr'] = "Required"; }
				
				if( isset($_REQUEST['when']) && !empty($_REQUEST['when']) && $_REQUEST['when']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['when']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
					
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$CholesterolMeasurementObj = new CholesterolMeasurement();	
					$CholesterolMeasurementObj->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($CholesterolMeasurementObj->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Cholesterol data is inserted successfully");
							//$this->redirect(array("patient/addCholesterol"));
							$this->redirect(array("patient/cholesterolListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Cholesterol Insertion.");
							$this->render("addCholesterol",array("validationError"=>$validationError,"cholesterolData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Cholesterol Insertion.");
						$this->render("addCholesterol",array("validationError"=>$validationError,"cholesterolData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addCholesterol");
				}
			}
		
		}
		
	}
	
	function actiondeleteCholesterol()
	{
		$this->isLogin();
		if(isset($_REQUEST['cholesterol_id']) && ($_REQUEST['cholesterol_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$CholesterolMeasurementObj = new CholesterolMeasurement();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$CholesterolMeasurementObj=CholesterolMeasurement::model()->findByPk($_REQUEST['cholesterol_id']);
				$CholesterolMeasurementObj->attributes=$data;
				
				if($CholesterolMeasurementObj->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Cholesterol data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Cholesterol deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddBloodGlucose()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodGlucose';
		
		if(isset($_REQUEST['blood_glucose_id']) && ($_REQUEST['blood_glucose_id'])!='' )
		{
			$BloodGlucoseMeasurement = new BloodGlucoseMeasurement();	
			$bloodGlucoseData = $BloodGlucoseMeasurement->getDetailsByBloodGlucoseId($_REQUEST['blood_glucose_id']);
			
			if(!empty($bloodGlucoseData) && $bloodGlucoseData!='')
			{
				$this->render("addBloodGlucose",array("bloodGlucoseData"=>$bloodGlucoseData));
			}
		}
		else
		{
			$this->render("addBloodGlucose");
		}
	}
	
	function actionsaveBloodGlucose()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodGlucose';
					
		if(isset($_REQUEST['blood_glucose_id']) && ($_REQUEST['blood_glucose_id'])!='' )
		{
						
			if(isset($_REQUEST['saveBloodGlucose']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['blood_glucose_level']) && !empty($_REQUEST['blood_glucose_level']) && $_REQUEST['blood_glucose_level']!='' )
				{	
					if(is_numeric(trim($_REQUEST['blood_glucose_level'])) === false)
					{
						$validationError['blood_glucose_levelErr'] = "Numbers Only";
					}
					else
					{
						$data['blood_glucose_level'] = $_REQUEST['blood_glucose_level'];
					}
				}
				else
				{  $validationError['blood_glucose_levelErr'] = "Required"; }
				
				if( isset($_REQUEST['unit']) && $_REQUEST['unit']!='' )
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{ 	$validationError['unitErr'] = "Required"; }
				
				if( isset($_REQUEST['measurement_type']) && $_REQUEST['measurement_type']!='' )
				{
					$data['measurement_type'] = $_REQUEST['measurement_type'];
				}
				else
				{ 	$validationError['measurement_typeErr'] = "Required"; }
				
				if( isset($_REQUEST['measurement_context_id']) && $_REQUEST['measurement_context_id']!='' )
				{
					$data['measurement_context_id'] = $_REQUEST['measurement_context_id'];
				}
				else
				{ 	$validationError['measurement_context_idErr'] = "Required"; }
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addBloodGlucose",array("validationError"=>$validationError,"bloodGlucoseData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$BloodGlucoseMeasurement = new BloodGlucoseMeasurement();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$BloodGlucoseMeasurement=BloodGlucoseMeasurement::model()->findByPk($_REQUEST['blood_glucose_id']);
					 	$BloodGlucoseMeasurement->attributes=$data;
					 	if($BloodGlucoseMeasurement->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Blood Glucose data is updated successfully");
							$this->redirect(array("patient/bloodGlucoseListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Blood Glucose Updation.");
							$this->render("addBloodGlucose",array("validationError"=>$validationError,"bloodGlucoseData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Blood Glucose Updation.");
						$this->render("addBloodGlucose",array("validationError"=>$validationError,"cholesterolData"=>$data));
					}
				}
			}
		}
		else
		{
			if(isset($_REQUEST['saveBloodGlucose']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['blood_glucose_level']) && !empty($_REQUEST['blood_glucose_level']) && $_REQUEST['blood_glucose_level']!='' )
				{	
					if(is_numeric(trim($_REQUEST['blood_glucose_level'])) == false)
					{
						$validationError['blood_glucose_levelErr'] = "Numbers Only";
					}
					else
					{
						$data['blood_glucose_level'] = $_REQUEST['blood_glucose_level'];
					}
				}
				else
				{  $validationError['blood_glucose_levelErr'] = "Required"; }
				
				if( isset($_REQUEST['unit']) && $_REQUEST['unit']!='' )
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{ 	$validationError['unitErr'] = "Required"; }
				
				if( isset($_REQUEST['measurement_type']) && $_REQUEST['measurement_type']!='' )
				{
					$data['measurement_type'] = $_REQUEST['measurement_type'];
				}
				else
				{ 	$validationError['measurement_typeErr'] = "Required"; }
				
				if( isset($_REQUEST['measurement_context_id']) && $_REQUEST['measurement_context_id']!='' )
				{
					$data['measurement_context_id'] = $_REQUEST['measurement_context_id'];
				}
				else
				{ 	$validationError['measurement_context_idErr'] = "Required"; }
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$BloodGlucoseMeasurement = new BloodGlucoseMeasurement();	
					$BloodGlucoseMeasurement->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($BloodGlucoseMeasurement->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Blood Glucose data is inserted successfully");
							$this->redirect(array("patient/bloodGlucoseListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Blood Glucose Insertion.");
							$this->render("addBloodGlucose",array("validationError"=>$validationError,"bloodGlucoseData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Blood Glucose Insertion.");
						$this->render("addBloodGlucose",array("validationError"=>$validationError,"bloodGlucoseData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addBloodGlucose");
				}
			}
		
		}
		
	}
	
	function actiondeleteBloodGlucose()
	{
		$this->isLogin();
		if(isset($_REQUEST['blood_glucose_id']) && ($_REQUEST['blood_glucose_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$BloodGlucoseMeasurement = new BloodGlucoseMeasurement();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$BloodGlucoseMeasurement=BloodGlucoseMeasurement::model()->findByPk($_REQUEST['blood_glucose_id']);
				$BloodGlucoseMeasurement->attributes=$data;
				
				if($BloodGlucoseMeasurement->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Blood Glucose data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Blood Glucose deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddBloodPressure()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodPressure';
		
		if(isset($_REQUEST['blood_pressure_id']) && ($_REQUEST['blood_pressure_id'])!='' )
		{
			$BloodPressureMeasurement = new BloodPressureMeasurement();	
			$bloodPressureData = $BloodPressureMeasurement->getDetailsByBloodPressureId($_REQUEST['blood_pressure_id']);
			
			if(!empty($bloodPressureData) && $bloodPressureData!='')
			{
				$this->render("addBloodPressure",array("bloodPressureData"=>$bloodPressureData));
			}
		}
		else
		{
			$this->render("addBloodPressure");	
		}
	}
	
	function actionsaveBloodPressure()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodPressure';
					
		if(isset($_REQUEST['blood_pressure_id']) && ($_REQUEST['blood_pressure_id'])!='' )
		{
						
			if(isset($_REQUEST['saveBloodPressure']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['systolic']) && !empty($_REQUEST['systolic']) && $_REQUEST['systolic']!='' )
				{	
					if(is_numeric(trim($_REQUEST['systolic'])) == false)
					{
						$validationError['systolicErr'] = "Numbers Only";
					}
					else
					{
						$data['systolic'] = $_REQUEST['systolic'];
					}
				}
				else
				{  $validationError['systolicErr'] = "Required"; }
				
				if( isset($_REQUEST['diastolic']) && !empty($_REQUEST['diastolic']) && $_REQUEST['diastolic']!='' )
				{	
					if(is_numeric(trim($_REQUEST['diastolic'])) == false)
					{
						$validationError['diastolicErr'] = "Numbers Only";
					}
					else
					{
						$data['diastolic'] = $_REQUEST['diastolic'];
					}
				}
				else
				{  $validationError['diastolicErr'] = "Required"; }
				
				if( isset($_REQUEST['pulse']) && !empty($_REQUEST['pulse']) && $_REQUEST['pulse']!='' )
				{	
					if(is_numeric(trim($_REQUEST['pulse'])) == false)
					{
						$validationError['pulseErr'] = "Numbers Only";
					}
					else
					{
						$data['pulse'] = $_REQUEST['pulse'];
					}
				}
				else
				{  $validationError['pulseErr'] = "Required"; }
				
				if( isset($_REQUEST['irr_heartbeat']) && $_REQUEST['irr_heartbeat']!='' )
				{
					$data['irr_heartbeat'] = $_REQUEST['irr_heartbeat'];
				}
				else
				{ 	$validationError['irr_heartbeatErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addBloodPressure",array("validationError"=>$validationError,"bloodPressureData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$BloodPressureMeasurement = new BloodPressureMeasurement();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$BloodPressureMeasurement=BloodPressureMeasurement::model()->findByPk($_REQUEST['blood_pressure_id']);
					 	$BloodPressureMeasurement->attributes=$data;
					 	if($BloodPressureMeasurement->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Blood Pressure data is updated successfully");
							$this->redirect(array("patient/bloodPressureListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Blood Pressure Updation.");
							$this->render("addBloodPressure",array("validationError"=>$validationError,"bloodGlucoseData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Blood Pressure Updation.");
						$this->render("addBloodPressure",array("validationError"=>$validationError,"bloodGlucoseData"=>$data));
					}
				}
			}

		}
		else
		{
			if(isset($_REQUEST['saveBloodPressure']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['systolic']) && !empty($_REQUEST['systolic']) && $_REQUEST['systolic']!='' )
				{	
					if(is_numeric(trim($_REQUEST['systolic'])) == false)
					{
						$validationError['systolicErr'] = "Numbers Only";
					}
					else
					{
						$data['systolic'] = $_REQUEST['systolic'];
					}
				}
				else
				{  $validationError['systolicErr'] = "Required"; }
				
				if( isset($_REQUEST['diastolic']) && !empty($_REQUEST['diastolic']) && $_REQUEST['diastolic']!='' )
				{	
					if(is_numeric(trim($_REQUEST['diastolic'])) == false)
					{
						$validationError['diastolicErr'] = "Numbers Only";
					}
					else
					{
						$data['diastolic'] = $_REQUEST['diastolic'];
					}
				}
				else
				{  $validationError['diastolicErr'] = "Required"; }
				
				if( isset($_REQUEST['pulse']) && !empty($_REQUEST['pulse']) && $_REQUEST['pulse']!='' )
				{	
					if(is_numeric(trim($_REQUEST['pulse'])) == false)
					{
						$validationError['pulseErr'] = "Numbers Only";
					}
					else
					{
						$data['pulse'] = $_REQUEST['pulse'];
					}
				}
				else
				{  $validationError['pulseErr'] = "Required"; }
				
				if( isset($_REQUEST['irr_heartbeat']) && $_REQUEST['irr_heartbeat']!='' )
				{
					$data['irr_heartbeat'] = $_REQUEST['irr_heartbeat'];
				}
				else
				{ 	$validationError['irr_heartbeatErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$BloodPressureMeasurement = new BloodPressureMeasurement();	
					$BloodPressureMeasurement->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($BloodPressureMeasurement->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Blood Pressure data is inserted successfully");
							//$this->redirect(array("patient/addbloodPressure"));
							$this->redirect(array("patient/bloodPressureListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Blood Pressure Insertion.");
							$this->render("addBloodPressure",array("validationError"=>$validationError,"bloodPressureData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Blood Pressure Insertion.");
						$this->render("addBloodPressure",array("validationError"=>$validationError,"bloodPressureData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addBloodPressure");
				}
			}
		
		}
		
	}
	
	function actiondeleteBloodPressure()
	{
		$this->isLogin();
		if(isset($_REQUEST['blood_pressure_id']) && ($_REQUEST['blood_pressure_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$BloodPressureMeasurement = new BloodPressureMeasurement();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$BloodPressureMeasurement=BloodPressureMeasurement::model()->findByPk($_REQUEST['blood_pressure_id']);
				$BloodPressureMeasurement->attributes=$data;
				
				if($BloodPressureMeasurement->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Blood Pressure data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Blood Pressure deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddHeight()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'height';
		
		if(isset($_REQUEST['height_id']) && ($_REQUEST['height_id'])!='' )
		{
			$HeightMeasurement = new HeightMeasurement();	
			$heightData = $HeightMeasurement->getDetailsByHeightId($_REQUEST['height_id']);
			
			if(!empty($heightData) && $heightData!='')
			{
				$this->render("addHeight",array("heightData"=>$heightData));
			}
		}
		else
		{
			$this->render("addHeight");	
		}
	}
	
	function actionsaveHeight()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'height';
					
		if(isset($_REQUEST['height_id']) && ($_REQUEST['height_id'])!='' )
		{
						
			if(isset($_REQUEST['saveHeight']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['height_value']) && !empty($_REQUEST['height_value']) && $_REQUEST['height_value']!='' )
				{	
					if(is_numeric(trim($_REQUEST['height_value'])) == false)
					{
						$validationError['height_valueErr'] = "Numbers Only";
					}
					else
					{
						$data['height_value'] = $_REQUEST['height_value'];
					}
				}
				else
				{  $validationError['height_valueErr'] = "Required"; }
				
				if( isset($_REQUEST['unit']) && $_REQUEST['unit']!='' )
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{ 	$validationError['unitErr'] = "Required"; }
				
				
				if( isset($_REQUEST['sub_height']) && !empty($_REQUEST['sub_height']) && $_REQUEST['sub_height']!='' )
				{	
					if(is_numeric(trim($_REQUEST['sub_height'])) == false)
					{
						$validationError['sub_heightErr'] = "Numbers Only";
					}
					else
					{
						$data['sub_height'] = $_REQUEST['sub_height'];
					}
				}
				else
				{  $validationError['sub_heightErr'] = "Required"; }
				
				
				if( isset($_REQUEST['sub_height_unit']) && $_REQUEST['sub_height_unit']!='' )
				{
					$data['sub_height_unit'] = $_REQUEST['sub_height_unit'];
				}
				else
				{ 	$validationError['sub_height_unitErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addHeight",array("validationError"=>$validationError,"heightData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$HeightMeasurement = new HeightMeasurement();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$HeightMeasurement=HeightMeasurement::model()->findByPk($_REQUEST['height_id']);
					 	$HeightMeasurement->attributes=$data;
					 	if($HeightMeasurement->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Height data is updated successfully");
							$this->redirect(array("patient/heightListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Height Updation.");
							$this->render("addHeight",array("validationError"=>$validationError,"heightData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Height Updation.");
						$this->render("addHeight",array("validationError"=>$validationError,"heightData"=>$data));
					}
				}
			}

		}
		else
		{
			if(isset($_REQUEST['saveHeight']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['height_value']) && !empty($_REQUEST['height_value']) && $_REQUEST['height_value']!='' )
				{	
					if(is_numeric(trim($_REQUEST['height_value'])) == false)
					{
						$validationError['height_valueErr'] = "Numbers Only";
					}
					else
					{
						$data['height_value'] = $_REQUEST['height_value'];
					}
				}
				else
				{  $validationError['height_valueErr'] = "Required"; }
				
				if( isset($_REQUEST['unit']) && $_REQUEST['unit']!='' )
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{ 	$validationError['unitErr'] = "Required"; }
				
				
				if( isset($_REQUEST['sub_height']) && !empty($_REQUEST['sub_height']) && $_REQUEST['sub_height']!='' )
				{	
					if(is_numeric(trim($_REQUEST['sub_height'])) == false)
					{
						$validationError['sub_heightErr'] = "Numbers Only";
					}
					else
					{
						$data['sub_height'] = $_REQUEST['sub_height'];
					}
				}
				else
				{  $validationError['sub_heightErr'] = "Required"; }
				
				
				if( isset($_REQUEST['sub_height_unit']) && $_REQUEST['sub_height_unit']!='' )
				{
					$data['sub_height_unit'] = $_REQUEST['sub_height_unit'];
				}
				else
				{ 	$validationError['sub_height_unitErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$HeightMeasurement = new HeightMeasurement();	
					$HeightMeasurement->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($HeightMeasurement->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Height data is inserted successfully");
							//$this->redirect(array("patient/addHeight"));
							$this->redirect(array("patient/heightListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Height Insertion.");
							$this->render("addHeight",array("validationError"=>$validationError,"heightData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Height Insertion.");
						$this->render("addHeight",array("validationError"=>$validationError,"heightData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addHeight");
				}
			}
		
		}
		
	}
	
	function actiondeleteHeight()
	{
		$this->isLogin();
		if(isset($_REQUEST['height_id']) && ($_REQUEST['height_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$HeightMeasurement = new HeightMeasurement();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$HeightMeasurement=HeightMeasurement::model()->findByPk($_REQUEST['height_id']);
				$HeightMeasurement->attributes=$data;
				
				if($HeightMeasurement->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Height data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Height deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddWeight()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'weight';
		
		if(isset($_REQUEST['weight_id']) && ($_REQUEST['weight_id'])!='' )
		{
			$WeightMeasurement = new WeightMeasurement();	
			$weightData = $WeightMeasurement->getDetailsByWeightId($_REQUEST['weight_id']);
			
			if(!empty($weightData) && $weightData!='')
			{
				$this->render("addWeight",array("weightData"=>$weightData));
			}
		}
		else
		{
			$this->render("addWeight");	
		}
	}
	
	function actionsaveWeight()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'weight';
					
		if(isset($_REQUEST['weight_id']) && ($_REQUEST['weight_id'])!='' )
		{
						
			if(isset($_REQUEST['saveWeight']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['weight_value']) && !empty($_REQUEST['weight_value']) && $_REQUEST['weight_value']!='' )
				{	
					if(is_numeric(trim($_REQUEST['weight_value'])) == false)
					{
						$validationError['weight_valueErr'] = "Numbers Only";
					}
					else
					{
						$data['weight_value'] = $_REQUEST['weight_value'];
					}
				}
				else
				{  $validationError['weight_valueErr'] = "Required"; }
				
				if( isset($_REQUEST['unit']) && $_REQUEST['unit']!='' )
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{ 	$validationError['unitErr'] = "Required"; }
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addWeight",array("validationError"=>$validationError,"weightData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$WeightMeasurement = new WeightMeasurement();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$WeightMeasurement=WeightMeasurement::model()->findByPk($_REQUEST['weight_id']);
					 	$WeightMeasurement->attributes=$data;
					 	if($WeightMeasurement->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Weight data is updated successfully");
							$this->redirect(array("patient/weightListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Weight Updation.");
							$this->render("addWeight",array("validationError"=>$validationError,"weightData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Height Updation.");
						$this->render("addWeight",array("validationError"=>$validationError,"weightData"=>$data));
					}
				}
			}

		}
		else
		{
			if(isset($_REQUEST['saveWeight']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['weight_value']) && !empty($_REQUEST['weight_value']) && $_REQUEST['weight_value']!='' )
				{	
					if(is_numeric(trim($_REQUEST['weight_value'])) == false)
					{
						$validationError['weight_valueErr'] = "Numbers Only";
					}
					else
					{
						$data['weight_value'] = $_REQUEST['weight_value'];
					}
				}
				else
				{  $validationError['weight_valueErr'] = "Required"; }
				
				if( isset($_REQUEST['unit']) && $_REQUEST['unit']!='' )
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{ 	$validationError['unitErr'] = "Required"; }
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$WeightMeasurement = new WeightMeasurement();	
					$WeightMeasurement->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($WeightMeasurement->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Weight data is inserted successfully");
							//$this->redirect(array("patient/addWeight"));
							$this->redirect(array("patient/weightListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Weight Insertion.");
							$this->render("addWeight",array("validationError"=>$validationError,"weightData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Weight Insertion.");
						$this->render("addWeight",array("validationError"=>$validationError,"weightData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addWeight");
				}
			}
		
		}
		
	}
	
	function actiondeleteWeight()
	{
		$this->isLogin();
		if(isset($_REQUEST['weight_id']) && ($_REQUEST['weight_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$WeightMeasurement = new WeightMeasurement();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$WeightMeasurement=WeightMeasurement::model()->findByPk($_REQUEST['weight_id']);
				$WeightMeasurement->attributes=$data;
				
				if($WeightMeasurement->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Weight data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Weight deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddAllergy()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'allergy';
		
		if(isset($_REQUEST['allergy_id']) && ($_REQUEST['allergy_id'])!='' )
		{
			$AllergyHealthHistory = new AllergyHealthHistory();	
			$allergyData = $AllergyHealthHistory->getDetailsByAllergyId($_REQUEST['allergy_id']);
			
			if(!empty($allergyData) && $allergyData!='')
			{
				$this->render("addAllergy",array("allergyData"=>$allergyData));
			}
		}
		else
		{
			$this->render("addAllergy");	
		}
	}
	
	function actionsaveAllergy()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'allergy';
			
		if(isset($_REQUEST['allergy_id']) && ($_REQUEST['allergy_id'])!='' )
		{
						
			if(isset($_REQUEST['saveAllergy']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['allergy_name']) && $_REQUEST['allergy_name']!='' )
				{
					$data['allergy_name'] = $_REQUEST['allergy_name'];
				}
				else
				{  $validationError['allergy_nameErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['treatment']) && $_REQUEST['treatment']!='' )
				{
					$data['treatment'] = $_REQUEST['treatment'];
				}
				else
				{ 	$validationError['treatmentErr'] = "Required"; }
				
				
				if( isset($_REQUEST['allergy_master_id']) && $_REQUEST['allergy_master_id']!='' )
				{
					$data['allergy_master_id'] = $_REQUEST['allergy_master_id'];
				}
				else
				{ 	$validationError['allergy_master_idErr'] = "Required"; }
				
				if( isset($_REQUEST['reaction']) && $_REQUEST['reaction']!='' )
				{
					$data['reaction'] = $_REQUEST['reaction'];
				}
				else
				{ 	$validationError['reactionErr'] = "Required"; }
				
				if( isset($_REQUEST['first_observed']) && !empty($_REQUEST['first_observed']) && $_REQUEST['first_observed']!='' )
				{ 
					$first_observed = date("Y-m-d",strtotime($_REQUEST['first_observed']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $first_observed))
					{
						$data['first_observed'] = $first_observed;
					}
					else
					{
						$validationError['first_observedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['first_observedErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addAllergy",array("validationError"=>$validationError,"allergyData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$AllergyHealthHistory = new AllergyHealthHistory();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$AllergyHealthHistory=AllergyHealthHistory::model()->findByPk($_REQUEST['allergy_id']);
					 	$AllergyHealthHistory->attributes=$data;
					 	if($AllergyHealthHistory->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Allergy data is updated successfully");
							$this->redirect(array("patient/allergyListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Allergy Updation.");
							$this->render("addAllergy",array("validationError"=>$validationError,"allergyData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Allergy Updation.");
						$this->render("addAllergy",array("validationError"=>$validationError,"allergyData"=>$data));
					}
				}
			}

		}
		else
		{
			if(isset($_REQUEST['saveAllergy']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['allergy_name']) && $_REQUEST['allergy_name']!='' )
				{
					$data['allergy_name'] = $_REQUEST['allergy_name'];
				}
				else
				{  $validationError['allergy_nameErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['treatment']) && $_REQUEST['treatment']!='' )
				{
					$data['treatment'] = $_REQUEST['treatment'];
				}
				else
				{ 	$validationError['treatmentErr'] = "Required"; }
				
				
				if( isset($_REQUEST['allergy_master_id']) && $_REQUEST['allergy_master_id']!='' )
				{
					$data['allergy_master_id'] = $_REQUEST['allergy_master_id'];
				}
				else
				{ 	$validationError['allergy_master_idErr'] = "Required"; }
				
				if( isset($_REQUEST['reaction']) && $_REQUEST['reaction']!='' )
				{
					$data['reaction'] = $_REQUEST['reaction'];
				}
				else
				{ 	$validationError['reactionErr'] = "Required"; }
				
				if( isset($_REQUEST['first_observed']) && !empty($_REQUEST['first_observed']) && $_REQUEST['first_observed']!='' )
				{ 
					$first_observed = date("Y-m-d",strtotime($_REQUEST['first_observed']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $first_observed))
					{
						$data['first_observed'] = $first_observed;
					}
					else
					{
						$validationError['first_observedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['first_observedErr'] = "When is Required "; }
				
				if( ( isset($_REQUEST['notes']) ) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$AllergyHealthHistory = new AllergyHealthHistory();	
					$AllergyHealthHistory->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($AllergyHealthHistory->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Allergy data is inserted successfully");
							//$this->redirect(array("patient/addAllergy"));
							$this->redirect(array("patient/allergyListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Allergy Insertion.");
							$this->render("addAllergy",array("validationError"=>$validationError,"allergyData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Allergy Insertion.");
						$this->render("addAllergy",array("validationError"=>$validationError,"allergyData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addAllergy");
				}
			}
		
		}
		
	}
	
	function actiondeleteAllergy()
	{
		$this->isLogin();
		if(isset($_REQUEST['allergy_id']) && ($_REQUEST['allergy_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$AllergyHealthHistory = new AllergyHealthHistory();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$AllergyHealthHistory=AllergyHealthHistory::model()->findByPk($_REQUEST['allergy_id']);
				$AllergyHealthHistory->attributes=$data;
				
				if($AllergyHealthHistory->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Allergy data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Allergy deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddImmunization()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'immunization';
		
		if(isset($_REQUEST['immunization_id']) && ($_REQUEST['immunization_id'])!='' )
		{
			$ImmunizationHealthHistory = new ImmunizationHealthHistory();	
			$immunizationData = $ImmunizationHealthHistory->getDetailsByImmunizationId($_REQUEST['immunization_id']);
			
			if(!empty($immunizationData) && $immunizationData!='')
			{
				$this->render("addImmunization",array("immunizationData"=>$immunizationData));
			}
		}
		else
		{
			$this->render("addImmunization");	
		}
	}
	
	function actionsaveImmunization()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'immunization';
	
		if(isset($_REQUEST['immunization_id']) && ($_REQUEST['immunization_id'])!='' )
		{
						
			if(isset($_REQUEST['saveImmunization']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['type']) && $_REQUEST['type']!='' )
				{
					$data['type'] = $_REQUEST['type'];
				}
				else
				{  $validationError['typeErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['facility']) && $_REQUEST['facility']!='' )
				{
					$data['facility'] = $_REQUEST['facility'];
				}
				else
				{ 	$validationError['facilityErr'] = "Required"; }
				
				
				if( isset($_REQUEST['reason']) && $_REQUEST['reason']!='' )
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				else
				{ 	$validationError['reasonErr'] = "Required"; }
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addImmunization",array("validationError"=>$validationError,"immunizationData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$ImmunizationHealthHistory = new ImmunizationHealthHistory();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$ImmunizationHealthHistory=ImmunizationHealthHistory::model()->findByPk($_REQUEST['immunization_id']);
					 	$ImmunizationHealthHistory->attributes=$data;
					 	if($ImmunizationHealthHistory->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Immunization data is updated successfully");
							$this->redirect(array("patient/immunizationListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Immunization Updation.");
							$this->render("addImmunization",array("validationError"=>$validationError,"immunizationData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Immunization Updation.");
						$this->render("addImmunization",array("validationError"=>$validationError,"immunizationData"=>$data));
					}
				}
			}

		}
		else
		{
			if(isset($_REQUEST['saveImmunization']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['type']) && $_REQUEST['type']!='' )
				{
					$data['type'] = $_REQUEST['type'];
				}
				else
				{  $validationError['typeErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['facility']) && $_REQUEST['facility']!='' )
				{
					$data['facility'] = $_REQUEST['facility'];
				}
				else
				{ 	$validationError['facilityErr'] = "Required"; }
				
				
				if( isset($_REQUEST['reason']) && $_REQUEST['reason']!='' )
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				else
				{ 	$validationError['reasonErr'] = "Required"; }
				
				
				if( isset($_REQUEST['report_date']) && !empty($_REQUEST['report_date']) && $_REQUEST['report_date']!='' )
				{ 
					$report_date = date("Y-m-d",strtotime($_REQUEST['report_date']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $report_date))
					{
						$data['report_date'] = $report_date;
					}
					else
					{
						$validationError['report_dateErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['report_dateErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$ImmunizationHealthHistory = new ImmunizationHealthHistory();	
					$ImmunizationHealthHistory->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($ImmunizationHealthHistory->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Immunization data is inserted successfully");
							//$this->redirect(array("patient/addImmunization"));
							$this->redirect(array("patient/immunizationListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Immunization Insertion.");
							$this->render("addImmunization",array("validationError"=>$validationError,"immunizationData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Immunization Insertion.");
						$this->render("addImmunization",array("validationError"=>$validationError,"immunizationData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addImmunization");
				}
			}
		
		}
		
	}
	
	function actiondeleteImmunization()
	{
		$this->isLogin();
		if(isset($_REQUEST['immunization_id']) && ($_REQUEST['immunization_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$ImmunizationHealthHistory = new ImmunizationHealthHistory();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$ImmunizationHealthHistory=ImmunizationHealthHistory::model()->findByPk($_REQUEST['immunization_id']);
				$ImmunizationHealthHistory->attributes=$data;
				
				if($ImmunizationHealthHistory->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Immunization data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Immunization deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddMedication()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'medication';
		
		if(isset($_REQUEST['medication_id']) && ($_REQUEST['medication_id'])!='' )
		{
			$MedicationHealthHistory = new MedicationHealthHistory();	
			$medicationData = $MedicationHealthHistory->getDetailsByMedicationId($_REQUEST['medication_id']);
			
			if(!empty($medicationData) && $medicationData!='')
			{
				$this->render("addMedication",array("medicationData"=>$medicationData));
			}
		}
		else
		{
			$this->render("addMedication");	
		}
	}
	
	function actionsaveMedication()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'medication';
	
		if(isset($_REQUEST['medication_id']) && ($_REQUEST['medication_id'])!='' )
		{
						
			if(isset($_REQUEST['saveMedication']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['medication_name']) && $_REQUEST['medication_name']!='' )
				{
					$data['medication_name'] = $_REQUEST['medication_name'];
				}
				else
				{  $validationError['medication_nameErr'] = "Required"; }
				
				
				if( isset($_REQUEST['dose']) && $_REQUEST['dose']!='' )
				{
					$data['dose'] = $_REQUEST['dose'];
				}
				else
				{ 	$validationError['doseErr'] = "Required"; }
				
				
				if( isset($_REQUEST['dose_unit']) && $_REQUEST['dose_unit']!='' )
				{
					$data['dose_unit'] = $_REQUEST['dose_unit'];
				}
				else
				{ 	$validationError['dose_unitErr'] = "Required"; }
				
				if( isset($_REQUEST['how_taken']) && $_REQUEST['how_taken']!='' )
				{
					$data['how_taken'] = $_REQUEST['how_taken'];
				}
				else
				{ 	$validationError['how_takenErr'] = "Required"; }
				
				if( isset($_REQUEST['is_prescribed']) && $_REQUEST['is_prescribed']!='' )
				{
					$data['is_prescribed'] = $_REQUEST['is_prescribed'];
				}
				else
				{ 	$validationError['is_prescribedErr'] = "Required"; }
				
				if( isset($_REQUEST['how_often_taken']) && $_REQUEST['how_often_taken']!='' )
				{
					$data['how_often_taken'] = $_REQUEST['how_often_taken'];
				}
				else
				{ 	$validationError['how_often_takenErr'] = "Required"; }
				
				if( isset($_REQUEST['strength']) && $_REQUEST['strength']!='' )
				{
					$data['strength'] = $_REQUEST['strength'];
				}
				else
				{ 	$validationError['strengthErr'] = "Required"; }
				
				if( isset($_REQUEST['strength_unit']) && $_REQUEST['strength_unit']!='' )
				{
					$data['strength_unit'] = $_REQUEST['strength_unit'];
				}
				else
				{ 	$validationError['strength_unitErr'] = "Required"; }
				
				if( isset($_REQUEST['reason']) && $_REQUEST['reason']!='' )
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				else
				{ 	$validationError['reasonErr'] = "Required"; }
				
				
				if( isset($_REQUEST['when_started']) && !empty($_REQUEST['when_started']) && $_REQUEST['when_started']!='' )
				{ 
					$when_started = date("Y-m-d",strtotime($_REQUEST['when_started']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $when_started))
					{
						$data['when_started'] = $when_started;
					}
					else
					{
						$validationError['when_startedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['when_startedErr'] = "When is Required "; }
				
				if( isset($_REQUEST['when_stopped']) && !empty($_REQUEST['when_stopped']) && $_REQUEST['when_stopped']!='' )
				{ 
					$when_stopped = date("Y-m-d",strtotime($_REQUEST['when_stopped']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $when_stopped))
					{
						$data['when_stopped'] = $when_stopped;
					}
					else
					{
						$validationError['when_stoppedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['when_stoppedErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
	
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addMedication",array("validationError"=>$validationError,"medicationData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$MedicationHealthHistory = new MedicationHealthHistory();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$MedicationHealthHistory=MedicationHealthHistory::model()->findByPk($_REQUEST['medication_id']);
					 	$MedicationHealthHistory->attributes=$data;
					 	if($MedicationHealthHistory->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Medication data is updated successfully");
							$this->redirect(array("patient/medicationListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Medication Updation.");
							$this->render("addMedication",array("validationError"=>$validationError,"medicationData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Medication Updation.");
						$this->render("addMedication",array("validationError"=>$validationError,"medicationData"=>$data));
					}
				}
			}

		}
		else
		{
			if(isset($_REQUEST['saveMedication']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['medication_name']) && $_REQUEST['medication_name']!='' )
				{
					$data['medication_name'] = $_REQUEST['medication_name'];
				}
				else
				{  $validationError['medication_nameErr'] = "Required"; }
				
				
				if( isset($_REQUEST['dose']) && $_REQUEST['dose']!='' )
				{
					$data['dose'] = $_REQUEST['dose'];
				}
				else
				{ 	$validationError['doseErr'] = "Required"; }
				
				
				if( isset($_REQUEST['dose_unit']) && $_REQUEST['dose_unit']!='' )
				{
					$data['dose_unit'] = $_REQUEST['dose_unit'];
				}
				else
				{ 	$validationError['dose_unitErr'] = "Required"; }
				
				if( isset($_REQUEST['how_taken']) && $_REQUEST['how_taken']!='' )
				{
					$data['how_taken'] = $_REQUEST['how_taken'];
				}
				else
				{ 	$validationError['how_takenErr'] = "Required"; }
				
				if( isset($_REQUEST['is_prescribed']) && $_REQUEST['is_prescribed']!='' )
				{
					$data['is_prescribed'] = $_REQUEST['is_prescribed'];
				}
				else
				{ 	$validationError['is_prescribedErr'] = "Required"; }
				
				if( isset($_REQUEST['how_often_taken']) && $_REQUEST['how_often_taken']!='' )
				{
					$data['how_often_taken'] = $_REQUEST['how_often_taken'];
				}
				else
				{ 	$validationError['how_often_takenErr'] = "Required"; }
				
				if( isset($_REQUEST['strength']) && $_REQUEST['strength']!='' )
				{
					$data['strength'] = $_REQUEST['strength'];
				}
				else
				{ 	$validationError['strengthErr'] = "Required"; }
				
				if( isset($_REQUEST['strength_unit']) && $_REQUEST['strength_unit']!='' )
				{
					$data['strength_unit'] = $_REQUEST['strength_unit'];
				}
				else
				{ 	$validationError['strength_unitErr'] = "Required"; }
				
				if( isset($_REQUEST['reason']) && $_REQUEST['reason']!='' )
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				else
				{ 	$validationError['reasonErr'] = "Required"; }
				
				
				if( isset($_REQUEST['when_started']) && !empty($_REQUEST['when_started']) && $_REQUEST['when_started']!='' )
				{ 
					$when_started = date("Y-m-d",strtotime($_REQUEST['when_started']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $when_started))
					{
						$data['when_started'] = $when_started;
					}
					else
					{
						$validationError['when_startedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['when_startedErr'] = "When is Required "; }
				
				if( isset($_REQUEST['when_stopped']) && !empty($_REQUEST['when_stopped']) && $_REQUEST['when_stopped']!='' )
				{ 
					$when_stopped = date("Y-m-d",strtotime($_REQUEST['when_stopped']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $when_stopped))
					{
						$data['when_stopped'] = $when_stopped;
					}
					else
					{
						$validationError['when_stoppedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['when_stoppedErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$MedicationHealthHistory = new MedicationHealthHistory();	
					$MedicationHealthHistory->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($MedicationHealthHistory->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Medication data is inserted successfully");
							//$this->redirect(array("patient/addMedication"));
							$this->redirect(array("patient/medicationListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Medication Insertion.");
							$this->render("addMedication",array("validationError"=>$validationError,"medicationData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Medication Insertion.");
						$this->render("addMedication",array("validationError"=>$validationError,"medicationData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addMedication");
				}
			}
		
		}
		
	}
	
	function actiondeleteMedication()
	{
		$this->isLogin();
		if(isset($_REQUEST['medication_id']) && ($_REQUEST['medication_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$MedicationHealthHistory = new MedicationHealthHistory();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$MedicationHealthHistory=MedicationHealthHistory::model()->findByPk($_REQUEST['medication_id']);
				$MedicationHealthHistory->attributes=$data;
				
				if($MedicationHealthHistory->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Medication data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Medication deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	function actionaddProcedure()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'procedure';
		
		if(isset($_REQUEST['procedure_id']) && ($_REQUEST['procedure_id'])!='' )
		{
			$ProcedureHealthHistory = new ProcedureHealthHistory();	
			$procedureData = $ProcedureHealthHistory->getDetailsByProcedureId($_REQUEST['procedure_id']);
			
			if(!empty($procedureData) && $procedureData!='')
			{
				$this->render("addProcedure",array("procedureData"=>$procedureData));
			}
		}
		else
		{
			$this->render("addProcedure");	
		}
	}
	
	function actionsaveProcedure()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'procedure';
			
		if(isset($_REQUEST['procedure_id']) && ($_REQUEST['procedure_id'])!='' )
		{
						
			if(isset($_REQUEST['saveProcedure']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['name']) && $_REQUEST['name']!='' )
				{
					$data['name'] = $_REQUEST['name'];
				}
				else
				{  $validationError['nameErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['body_location']) && $_REQUEST['body_location']!='' )
				{
					$data['body_location'] = $_REQUEST['body_location'];
				}
				else
				{ 	$validationError['body_locationErr'] = "Required"; }
				
				
				if( isset($_REQUEST['provider']) && $_REQUEST['provider']!='' )
				{
					$data['provider'] = $_REQUEST['provider'];
				}
				else
				{ 	$validationError['providerErr'] = "Required"; }
				
				
				if( isset($_REQUEST['when_performed']) && !empty($_REQUEST['when_performed']) && $_REQUEST['when_performed']!='' )
				{ 
					$when_performed = date("Y-m-d",strtotime($_REQUEST['when_performed']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $when_performed))
					{
						$data['when_performed'] = $when_performed;
					}
					else
					{
						$validationError['when_performedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['when_performedErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
							
				if(!empty($validationError) && $validationError!='')
					{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addProcedure",array("validationError"=>$validationError,"procedureData"=>$data));
						exit;
					}
			
				if(!empty($data))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					$ProcedureHealthHistory = new ProcedureHealthHistory();	
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$ProcedureHealthHistory=ProcedureHealthHistory::model()->findByPk($_REQUEST['procedure_id']);
					 	$ProcedureHealthHistory->attributes=$data;
					 	if($ProcedureHealthHistory->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Procedure data is updated successfully");
							$this->redirect(array("patient/procedureListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Procedure Updation.");
							$this->render("addProcedure",array("validationError"=>$validationError,"procedureData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Procedure Updation.");
						$this->render("addProcedure",array("validationError"=>$validationError,"procedureData"=>$data));
					}
				}
			}

		}
		else
		{
			if(isset($_REQUEST['saveProcedure']))
			{
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ $validationError['patientErr'] = "Required"; }
				
				if( isset($_REQUEST['name']) && $_REQUEST['name']!='' )
				{
					$data['name'] = $_REQUEST['name'];
				}
				else
				{  $validationError['nameErr'] = "Required"; }
				
				
				
				if( isset($_REQUEST['body_location']) && $_REQUEST['body_location']!='' )
				{
					$data['body_location'] = $_REQUEST['body_location'];
				}
				else
				{ 	$validationError['body_locationErr'] = "Required"; }
				
				
				if( isset($_REQUEST['provider']) && $_REQUEST['provider']!='' )
				{
					$data['provider'] = $_REQUEST['provider'];
				}
				else
				{ 	$validationError['providerErr'] = "Required"; }
				
				
				if( isset($_REQUEST['when_performed']) && !empty($_REQUEST['when_performed']) && $_REQUEST['when_performed']!='' )
				{ 
					$when_performed = date("Y-m-d",strtotime($_REQUEST['when_performed']));
					
					if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $when_performed))
					{
						$data['when_performed'] = $when_performed;
					}
					else
					{
						$validationError['when_performedErr'] = "Invalid Date";
					}
				}
				else
				{  $validationError['when_performedErr'] = "When is Required "; }
				
				if( isset($_REQUEST['notes']) && !empty($_REQUEST['notes']) && $_REQUEST['notes']!='' )
				{ 
					$data['notes'] = $_REQUEST['notes'];
				}
				
				if(!empty($data))
				{
					$data['status']= 1;
					$data['created_at']= date("Y-m-d H:i:s");
				
					$ProcedureHealthHistory = new ProcedureHealthHistory();	
					$ProcedureHealthHistory->attributes=$data;
					$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($ProcedureHealthHistory->save())
						{
							$transaction->commit();
							Yii::app()->user->setFlash("success", "Procedure data is inserted successfully");
							//$this->redirect(array("patient/addProcedure"));
							$this->redirect(array("patient/procedureListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Procedure Insertion.");
							$this->render("addProcedure",array("validationError"=>$validationError,"procedureData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Procedure Insertion.");
						$this->render("addProcedure",array("validationError"=>$validationError,"procedureData"=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please Fill out all the required Information.");
					$this->render("addProcedure");
				}
			}
		
		}
		
	}
	
	function actiondeleteProcedure()
	{
		$this->isLogin();
		if(isset($_REQUEST['procedure_id']) && ($_REQUEST['procedure_id'])!='' )
		{
			$data['status'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$ProcedureHealthHistory = new ProcedureHealthHistory();	
			$transaction=Yii::app()->db->beginTransaction();
			
			try
			{
				$ProcedureHealthHistory=ProcedureHealthHistory::model()->findByPk($_REQUEST['procedure_id']);
				$ProcedureHealthHistory->attributes=$data;
				
				if($ProcedureHealthHistory->save()) 
				{
					$transaction->commit();        
				
					Yii::app()->user->setFlash("success", "Procedure data is deleted successfully");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			catch(Exception $e) // an exception is raised if a query fails
			{
				$transaction->rollback();
				Yii::app()->user->setFlash("error", "Problem in Procedure deletion.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	
	function actionloadFormControlledSubstance()
	{
		$this->render('controlled-substance-contract-content');
	}
	
	function actionloadFormPatientReg()
	{
		
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById(Yii::app()->session['pingmydoctor_patient']);
		
		$PatientMedicalHistoryObj = new PatientMedicalHistory();
		$medicalData = $PatientMedicalHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
		$surgoryData = $PatientSurgeryHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);	
		//$PatientFamilyHistoryObj = new PatientFamilyHistory();
		//$familyData = $PatientFamilyHistory->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);		
		
		$PatientHeighMesurmentObj = new HeightMeasurement();
		$patientHeightData = $PatientHeighMesurmentObj->getHeightDetailsByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		$PatientWeightMesurmentObj = new WeightMeasurement();
		$patientWeightData = $PatientWeightMesurmentObj->getWeightDetailsByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		$patientInfoQuestionnaire = new patientInfoQuestionnaire();
		$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		$patientSocialHostoryObj = new PatientSocialHistory();
		$socialInfo = $patientSocialHostoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		$pationtSymptomsHistoryObj = new PatientSymptomsHistory();
		$symptomsHistoryInfo = $pationtSymptomsHistoryObj->getsymptomsListByPatientWithName(Yii::app()->session['pingmydoctor_patient']);		
		
		$patientMedicationObj = new MedicationHealthHistory();
		$medicationHistoryData = $patientMedicationObj->getMedicationListByPatient(Yii::app()->session['pingmydoctor_patient'],6);		
		
		$allergiesObj = new AllergyHealthHistory();
		$allergiesData = $allergiesObj->getAllergyHealthHistoryListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		$anesthesiaObj = new PatientAnethesiaHistory();
		$anesthesiaData = $anesthesiaObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		$patientFamilyHistoryObj = new PatientFamilyHistory();
		$familyData = $patientFamilyHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		$this->render('New-Patient-Registration-Forms-content',array('patientInfo'=>$patientInfo,
																		'allergiesData'=>$allergiesData, 
																		'medicationHistoryData'=>$medicationHistoryData, 
																		'socialInfo'=> $socialInfo,
																		'anesthesiaData'=>$anesthesiaData, 
																		'symptomsHistoryInfo'=>$symptomsHistoryInfo, 
																		'heightData'=>$patientHeightData,
																		'weightData'=>$patientWeightData,
																		'medicalData'=>$medicalData,
																		'surgoryData'=>$surgoryData,
																		'patientData'=>$patientData,
																		'familyData'=>$familyData));
	}
	
	
	function daysDifference($endDate, $beginDate)
	{
  		/*$d1 = new DateTime($endDate);
		$d2 = new DateTime($beginDate);
		$diff = $d2->diff($d1);
		return  $diff->y;*/
		
		
		$birthDate = $beginDate;
  		//explode the date to get month, day and year
 		 $birthDate = explode("-", $birthDate);
  		//get age from date or birthdate
  		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
 		return  $age;
		
	}

	
	function actionsubmitPatientRegForm()
	{
		//error_reporting(E_ALL);
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById(Yii::app()->session['pingmydoctor_patient']);
		
		$PatientMedicalHistoryObj = new PatientMedicalHistory();
		$medicalData = $PatientMedicalHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
		$surgoryData = $PatientSurgeryHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);		
		
		$patientInfoQuestionnaire = new patientInfoQuestionnaire();
		$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		 $formHtml .='<link href="'. Yii::app()->params->base_url .'themefiles/assets/admin/layout/css/style_content.css" rel="stylesheet"><link href="'. Yii::app()->params->base_url .'themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
        	<p class="ContentPara"><strong>Date:</strong>'.date("Y-m-d").'</p>
            <p class="ContentPara"><strong>Name:</strong>'.$patientData['name'].' '.$patientData['surname'].'</p>
            <p class="ContentPara"><strong>Age:</strong>'.$this->daysDifference(date("Y-m-d"),$patientData['dob']).'</p>
            <p class="ContentPara"><strong>Birthday:</strong>'.$patientData['dob'].'</p>
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
        	<p class="ContentPara"><h4 class="ContentHeading compalint">Medical History: </h4> <b>Height:</b> '.$medicalData['height'].' &nbsp; <b>Average Weight:</b> '.$medicalData['avg_height'].'</p>';
           
		   if(isset($medicalData['is_pregnant']) && $medicalData['is_pregnant'] == 1) 
		   {  $is_pregnant = "Yes"; } else {  $is_pregnant = "No"; }
		   
		   if(isset($medicalData['aids']) && $medicalData['aids'] == 1) { 
             $aids = '<i class="fa fa-check-square-o">Aids</i>, ';
			} 
			if(isset($medicalData['hepatitis']) && $medicalData['hepatitis'] == 1) { 
			 $hepatitis = '<i class="fa fa-check-square-o">Hepatitis</i>';
			}
		   ?>
		   
		   <?php
		  $formHtml .= '<p class="ContentPara"><b>If you are a woman of childbearing years, is there a possibility you may be pregnant?</b>'. $is_pregnant.' </p>
            <p class="ContentPara">Mark any medical condition you have been diagnosed with:</p>
            <p> '.$aids.' '.$hepatitis.'
		</p>';
		$other_disease = '';
		if(isset($medicalData['other_disease']) && $medicalData['other_disease'] != '') { 
			$other_disease = '<i class="fa fa-check-square-o">Other Disease</i>'; 
		}
		else
		{
			$other_disease = $medicalData['other_disease']; 
		}
		$blood_clots = '';
		if(isset($medicalData['blood_clots'])) { $blood_clots = $medicalData['blood_clots']; }
		
		if(isset($medicalData['diet']) && $medicalData['diet'] == 1) { 
			$diet = '<i class="fa fa-check-square-o">Diet</i>, '; 
		}
		if(isset($medicalData['pills']) && $medicalData['pills'] == 1) { 
			$pills = '<i class="fa fa-check-square-o">Pills</i>, ';
		} 
		if(isset($medicalData['insulin']) && $medicalData['insulin'] == 1) { 
			$insulin = '<i class="fa fa-check-square-o">Insulin</i>';
		}
		
		 if(isset($medicalData['epilepsy']) && $medicalData['epilepsy'] == 1) { 
		 	$epilepsy = '<i class="fa fa-check-square-o">epilepsy</i></p>'; 
		 } 
		$heart_problem = '';
		if(isset($medicalData['heart_problem']) && $medicalData['heart_problem'] != '') 
		{  
			$heart_problem =  $medicalData['heart_problem'];  
		} 
		 
		  
		 ?>
		
		
        <?php $formHtml .= '<p>'.$other_disease.'</p>
            <p class="ContentPara"><b>Blood clots :</b>'.$blood_clots.'&nbsp; <b>Diabetes/controlled by :  </b> '.$diet.' '.$pills.'  '.$insulin.' </p>
            <p class="ContentPara"><b>Heart Problems/Type : </b> '.$epilepsy.'</p><p><b>Heart Problems/Type </b> '.$heart_problem.'</p>
            <p class="ContentPara">';
           $high_blood_pressure = ''; 
           if(isset($medicalData['high_blood_pressure']) && $medicalData['high_blood_pressure'] == 1) { 
				$high_blood_pressure = '<i class="fa fa-check-square-o">High Blood Pressure</i>&nbsp;';
		    } 
           $low_thyroid = '';  
           if(isset($medicalData['low_thyroid']) && $medicalData['low_thyroid'] == 1) { 
		   		$low_thyroid = '<i class="fa fa-check-square-o">Low Thyroid</i>&nbsp;';
		   } 
		   $bowel = '';
           if(isset($medicalData['bowel']) && $medicalData['bowel'] == 1) { 
		   		$bowel = '<i class="fa fa-check-square-o">Bowel</i>&nbsp;'; 
		    } 
           $ulcers = ''; 
           if(isset($medicalData['ulcers']) && $medicalData['ulcers'] == 1) { 
		   		$ulcers = '<i class="fa fa-check-square-o">Ulcers</i>&nbsp;';
		   }
           $prolapse = ''; 
           if(isset($medicalData['prolapse']) && $medicalData['prolapse'] == 1) { 
		   		$prolapse = '<i class="fa fa-check-square-o">Prolapse</i>';
		   }
		   $lung_disease = '';
		   if(isset($medicalData['lung_disease'])) {  
		   		$lung_disease = $medicalData['lung_disease']; 
		   }
		    
           $formHtml .= $high_blood_pressure.' '.$low_thyroid.' '.$bowel.' '.$ulcers.' '.$prolapse.'</p>
            <p class="ContentPara"><b>Lung Disease/Type : </b> '. $lung_disease .'</p>
            <p class="ContentPara">';
			
			
            
            if(isset($medicalData['polio']) && $medicalData['polio'] == 1) { 
				$polio = '<i class="fa fa-check-square-o">Polio</i>&nbsp;';
			}
			
			 if(isset($medicalData['arthritis']) && $medicalData['arthritis'] == 1) { 
				$arthritis = '<i class="fa fa-check-square-o">Arthritis</i>&nbsp;';
			}
			
			
			 if(isset($medicalData['tuberculosis']) && $medicalData['tuberculosis'] == 1) { 
				$tuberculosis = '<i class="fa fa-check-square-o">Tuberculosis</i>&nbsp;';
			}
            
            $formHtml .= $polio.' '.$arthritis.' '.$tuberculosis.'</p>';
			$tuberculosis = ''; $other_unknown = '';$injuries ='';$hospitalization='';
			if(isset($medicalData['tuberculosis'])) { $tuberculosis =  $medicalData['tuberculosis']; } 
			if(isset($medicalData['other_unknown'])) { $other_unknown =  $medicalData['other_unknown']; } 
			if(isset($medicalData['injuries'])) { $injuries =  $medicalData['injuries']; } 
			if(isset($medicalData['hospitalization'])) { $hospitalization =  $medicalData['hospitalization']; } 
			
            
            $formHtml .= '<p class="ContentPara"><b>Psychiatric Disorder/Type :</b> '.$tuberculosis.'</p>
            <p class="ContentPara"><b>Please list any other known medical conditions or symptoms not listed above:</b> '.$other_unknown . '</p>
            <p class="ContentPara"><b>Please list any <strong>injuries</strong> including car accident, fall, lifting, etc:</b> '.$injuries .' </p>
            <p class="ContentPara"><b>Please list any <strong>hospitalizations</strong> (other than surgeries):</b> '.$hospitalization.'</p>
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
               <tbody>';
			 
			 foreach($surgoryData as $surgoryRow)
			 { 
                  $str .= '<tr>
                     <td>'.$surgoryRow['procedure'].'</td>
                     <td>'.$surgoryRow['Year'].'</td>
                     <td>'.$surgoryRow['surgeon'].'</td>
                     <td>'.$surgoryRow['hospital'].'</td>
                  	 </tr>';
               }     
             
           $formHtml .= $str.'</tbody></table></div></div>';
   		$formHtml .= '<div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Family History: </h4>
            <p class="ContentPara">Have any of your relatives ever had any of the following:</p>
            <p class="ContentPara">Yes Relationship (Mother, Father, Sister or Brother)</p>
            <p class="ContentPara">Father - Diabetes</p>
            <p class="ContentPara">Mother - Diabetes</p>
            <p class="ContentPara">Sister - Diabetes</p>
        </div>
    </div>';
	$formHtml .= '<div class="row">
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
    </div>';
	
	$formHtml .= '<div class="row">
    	<div class="col-sm-12">
        	<h4 class="ContentHeading ContentUnderline">Review of Systems: </h4>
            <p class="ContentPara">Constitutional symptoms - Easy fatigue</p>
            <p class="ContentPara">Skin - Bruising</p>
            <p class="ContentPara">Head, Ears, Eyes, Nose, Throat (HEENT) - Dizziness</p>
            <p class="ContentPara">Respiratory - Hemoptysis (spitting of blood)</p>
            <p class="ContentPara">Cardiovascular - High blood pressure</p>
            <p class="ContentPara">Gastrointestinal - Nausea and/or vomiting</p>
        </div>
    </div>';
	
	
	$formHtml .= '<div class="row">
    	<div class="col-sm-12">
        	<p class="ContentPara">To My Knowledge, I attest that the above information is true and accurate</p>
        </div>
    </div>
				   <div class="row">
    	<div class="col-sm-6">Patient’s Signature - xxxx xxx xxx xxx</div>
        <div class="col-sm-6">Date - xx xx xxxx</div>
    </div>';
	
	
	$formHtml .= '<div class="row">
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
    </div>';
	
	$formHtml .= '<div class="row">
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
    <div class="row">&nbsp;</div>';
	
	$formHtml .=  ' <div class="row">
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
    </div></div>';
			
		
		$filename = Yii::app()->session['pingmydoctor_patient']."_New-Patient-Registration_".date("Y-m-d").'.pdf';
		$path = "assets/upload/pdf/";
		
		if(!file_exists($path)) 
		{
			mkdir("assets/upload/pdf/", 0777);
		}

		$mpdf = new mPDF();
		$mpdf->WriteHTML($formHtml);
		$mpdf->Output(FILE_PATH.$path."/".$filename, 'F');
		
		$RegisterFormdata = array();
		$RegisterFormdata['patient_register'] = $filename; 
		$RegisterFormdata['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
		
		$PatientFormsHistoryObj =  new PatientFormsHistory();
		$patientFormsData = $PatientFormsHistoryObj->getFormsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($patientFormsData) && $patientFormsData['patient_id'] == $HippaFormdata['patient_id'])
		{
			$RegisterFormdata['doctor_id'] = $patientData['doctor_id'];
			$RegisterFormdata['modified_at'] = date("Y-m-d H:i:s");
			
			$dotorNot = array();
			$dotorNot['doctor_id'] = $patientData['doctor_id'];
			$dotorNot['patient_id'] = $patientData['patient_id'];
			$dotorNot['form'] = 'Patient new registration';
			$dotorNot['created_at'] = date("Y-m-d H:i:s");
			
			$DoctorNotificationObj = new DoctorNotification();
			$DoctorNotificationObj->setData($dotorNot);
			$DoctorNotificationObj->insertData();
			
			
			$PatientFormsHistoryObj =  new PatientFormsHistory();
			$PatientFormsHistoryObj->setData($RegisterFormdata);
			$PatientFormsHistoryObj->insertData($patientFormsData['patient_forms_id']);
		}
		else
		{
			$RegisterFormdata['doctor_id'] = $patientData['doctor_id'];
			$RegisterFormdata['created_at'] = date("Y-m-d H:i:s");
			
			$dotorNot = array();
			$dotorNot['doctor_id'] = $patientData['doctor_id'];
			$dotorNot['patient_id'] = $patientData['patient_id'];
			$dotorNot['form'] = 'Patient new registration';
			$dotorNot['created_at'] = date("Y-m-d H:i:s");
			
			$DoctorNotificationObj = new DoctorNotification();
			$DoctorNotificationObj->setData($dotorNot);
			$DoctorNotificationObj->insertData();
			
			$PatientFormsHistoryObj =  new PatientFormsHistory();
			$PatientFormsHistoryObj->setData($RegisterFormdata);
			$PatientFormsHistoryObj->insertData();
		}

		
		Yii::app()->user->setFlash("success", "Successfully submited for approval.");
		$this->redirect(array("patient/getAllFormsForUser"));
	}
	
	function actionloadFormHealthHistory()
	{
		$this->render('Health-History-forms-2014-update-content');
	}
	
	function actionloadFormPaymentPolicies()
	{
		$this->render('patient-information-payment-policies-content');
	}
	
	function actioneditMedicalHistoryListing()
	{
		error_reporting(E_ALL);
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'medicalhistory';
		
		
		$PatientMedicalHistoryObj = new PatientMedicalHistory();	
		$medicalData = $PatientMedicalHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		$PatientHeighMesurmentObj = new HeightMeasurement();
		$patientHeightData = $PatientHeighMesurmentObj->getHeightDetailsByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		$PatientWeightMesurmentObj = new WeightMeasurement();
		$patientWeightData = $PatientWeightMesurmentObj->getWeightDetailsByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($medicalData) && $medicalData!='')
		{		
			$this->render("addMedicalHistory",array("medicalData"=>$medicalData,'heightData'=>$patientHeightData,'weightData'=>$patientWeightData));
		}
		else
		{
			$this->render("addMedicalHistory");	
		}
	}
	
	function actionaddMedicalHistory()
	{
		$this->render('addMedicalHistory');
	}
	
	function actionsaveMedicalHistory()
	{
			
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'medicalhistory';
		if(isset($_REQUEST['saveMedicalHistory']))
		{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ 
					$validationError['patientErr'] = "Required"; 
				}
				
				if( isset($_REQUEST['height']) && $_REQUEST['height']!='' )
				{ 
					$data['height'] = $_REQUEST['height'];
				}
				
				if( isset($_REQUEST['avg_height']) && $_REQUEST['avg_height']!='' )
				{ 
					$data['avg_height'] = $_REQUEST['avg_height'];
				}
				
				if( isset($_REQUEST['is_pregnant']) && $_REQUEST['is_pregnant']!='' )
				{ 
					$data['is_pregnant'] = $_REQUEST['is_pregnant'];
				}
				else
				{
					$data['is_pregnant'] = 0;
				}
				
				if( isset($_REQUEST['avg_height']) && $_REQUEST['avg_height']!='' )
				{ 
					$data['avg_height'] = $_REQUEST['avg_height'];
				}
				
				if( isset($_REQUEST['aids']) && $_REQUEST['aids']!='' )
				{ 
					$data['aids'] = $_REQUEST['aids'];
				}
				else
				{
					$data['aids'] = 0;
				}
				
				if( isset($_REQUEST['hepatitis']) && $_REQUEST['hepatitis']!='' )
				{ 
					$data['hepatitis'] = $_REQUEST['hepatitis'];
				}
				else
				{
					$data['hepatitis'] = 0;
				}
				
				if( isset($_REQUEST['other_disease']) && $_REQUEST['other_disease']!='' )
				{ 
					$data['other_disease'] = $_REQUEST['other_disease'];
					if( isset($_REQUEST['other_diseases']) && $_REQUEST['other_diseases']!='' )
					{ 
						$data['other_disease'] = $_REQUEST['other_diseases'];
					}
				}
				else
				{
					$data['other_disease'] = '';
				}
				
				
				
				if( isset($_REQUEST['blood_clots']) && $_REQUEST['blood_clots']!='' )
				{ 
					$data['blood_clots'] = $_REQUEST['blood_clots'];
					if( isset($_REQUEST['part_of_body']) && $_REQUEST['part_of_body']!='' )
					{ 
						$data['blood_clots'] = $_REQUEST['part_of_body'];
					}
					else
					{
						$data['blood_clots'] = 0;
					}
				}
				else
				{
					$data['blood_clots'] = '';
				}
				
				
				
				if( isset($_REQUEST['diabetes']) && $_REQUEST['diabetes']!='' )
				{ 
					$data['diabetes'] = $_REQUEST['diabetes'];
				}
				else
				{
					$data['diabetes'] = 0;
				}
				
				if( isset($_REQUEST['diet']) && $_REQUEST['diet']!='' )
				{ 
					$data['diet'] = $_REQUEST['diet'];
				}
				else
				{
					$data['diet'] = 0;
				}
				
				if( isset($_REQUEST['pills']) && $_REQUEST['pills']!='' )
				{ 
					$data['pills'] = $_REQUEST['pills'];
				}
				else
				{
					$data['pills'] = 0;
				}
				
				if( isset($_REQUEST['insulin']) && $_REQUEST['insulin']!='' )
				{ 
					$data['insulin'] = $_REQUEST['insulin'];
				}
				else
				{
					$data['insulin'] = 0;
				}
				
				if( isset($_REQUEST['epilepsy']) && $_REQUEST['epilepsy']!='' )
				{ 
					$data['epilepsy'] = $_REQUEST['epilepsy'];
				}
				else
				{
					$data['epilepsy'] = 0;
				}
				
				if( isset($_REQUEST['heart_problem']) && $_REQUEST['heart_problem'] != '' )
				{ 
					$data['heart_problem'] = $_REQUEST['heart_problem'];
					if( isset($_REQUEST['heart_problems']) && $_REQUEST['heart_problems']!='' )
					{ 
						$data['heart_problem'] = $_REQUEST['heart_problems'];
					}
				}
				else
				{
						$data['heart_problem'] = '';
				}
				
				
				
				
				if( isset($_REQUEST['high_blood_pressure']) && $_REQUEST['high_blood_pressure']!='' )
				{ 
					$data['high_blood_pressure'] = $_REQUEST['high_blood_pressure'];
				}
				else
				{
					$data['high_blood_pressure'] = 0;
				}
				
				if( isset($_REQUEST['low_thyroid']) && $_REQUEST['low_thyroid']!='' )
				{ 
					$data['low_thyroid'] = $_REQUEST['low_thyroid'];
				}
				else
				{
					$data['low_thyroid'] = 0;
				}
				
				if( isset($_REQUEST['bowel']) && $_REQUEST['bowel']!='' )
				{ 
					$data['bowel'] = $_REQUEST['bowel'];
				}
				else
				{
					$data['bowel'] = 0;
				}
				
				if( isset($_REQUEST['ulcers']) && $_REQUEST['ulcers']!='' )
				{ 
					$data['ulcers'] = $_REQUEST['ulcers'];
				}
				else
				{
					$data['ulcers'] = 0;
				}
				
				if( isset($_REQUEST['prolapse']) && $_REQUEST['prolapse']!='' )
				{ 
					$data['prolapse'] = $_REQUEST['prolapse'];
				}
				else
				{
					$data['prolapse'] = 0;
				}
				
				if( isset($_REQUEST['lung_disease']) && $_REQUEST['lung_disease']!='' )
				{ 
					$data['lung_disease'] = $_REQUEST['lung_disease'];
				}
				else
				{
					$data['lung_disease'] = '';
				}
				
			
				
				if( isset($_REQUEST['polio']) && $_REQUEST['polio']!='' )
				{ 
					$data['polio'] = $_REQUEST['polio'];
				}
				else
				{
					$data['polio'] = 0;
				}
				
				if( isset($_REQUEST['arthritis']) && $_REQUEST['arthritis']!='' )
				{ 
					$data['arthritis'] = $_REQUEST['arthritis'];
				}
				else
				{
					$data['arthritis'] = 0;
				}
				
				
				if( isset($_REQUEST['tuberculosis']) && $_REQUEST['tuberculosis']!='' )
				{ 
					$data['tuberculosis'] = $_REQUEST['tuberculosis'];
				}
				else
				{
					$data['tuberculosis'] = 0;
				}
				
				if( isset($_REQUEST['psychiatric_chk']) && $_REQUEST['psychiatric_chk']!='' )
				{ 
					$data['psychiatric'] = $_REQUEST['psychiatrics'];
				}
				else
				{
					$data['psychiatric'] = '';
				}
				
				if( isset($_REQUEST['other_unknown']) && $_REQUEST['other_unknown']!='' )
				{ 
					$data['other_unknown'] = $_REQUEST['other_unknown'];
				}
				
				if( isset($_REQUEST['injuries']) && $_REQUEST['injuries']!='' )
				{ 
					$data['injuries'] = $_REQUEST['injuries'];
				}
				
				if( isset($_REQUEST['hospitalization']) && $_REQUEST['hospitalization']!='' )
				{ 
					$data['hospitalization'] = $_REQUEST['hospitalization'];
				}
				
				
				if(isset($_REQUEST['medical_history_id']) && $_REQUEST['medical_history_id'] != '')
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					$PatientMedicalHistory = new PatientMedicalHistory();
					$PatientMedicalHistory->setData($data);
					$PatientMedicalHistory->insertData($_REQUEST['medical_history_id']);
				
					Yii::app()->user->setFlash("success", "Patient's medical history updated successfully.");
					$this->redirect(array('patient/editMedicalHistoryListing'));
				}
				else
				{
					$data['creation_at'] = date("Y-m-d H:i:s");
					$PatientMedicalHistory = new PatientMedicalHistory();
					$PatientMedicalHistory->setData($data);
					$PatientMedicalHistory->insertData();
					Yii::app()->user->setFlash("success", "Patient's medical history added successfully.");
					$this->redirect(array('patient/editMedicalHistoryListing'));
					
				}
				
		}
		$this->redirect(array('patient/patientHome'));
	}
	
	function actionaddSurgoryHistory()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'surgoryhistory';
		
		if(isset($_GET['patient_surgery_id']))
		{
			$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
			$surgoryData = $PatientSurgeryHistoryObj->getdetailsBySurgeryId($_GET['patient_surgery_id']);
			$this->render('addSurgoryHistory',array('surgoryData'=>$surgoryData));
		}
		else
		{
			$this->render('addSurgoryHistory');
		}
	}
	
	function actionsaveSurgoryHistory()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'surgoryhistory';
		if(isset($_REQUEST['saveSurgoryHistory']))
		{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ 
					$validationError['patientErr'] = "Required"; 
				}
				
				if( isset($_REQUEST['procedure']) && $_REQUEST['procedure']!='' )
				{ 
					$data['procedure'] = $_REQUEST['procedure'];
				}
				
				if( isset($_REQUEST['Year']) && $_REQUEST['Year']!='' )
				{ 
					$data['Year'] = $_REQUEST['Year'];
				}
				else
				{
					$validationError['yearErr'] = 'Required';
				}
				
				if( isset($_REQUEST['surgeon']) && $_REQUEST['surgeon']!='' )
				{ 
					$data['surgeon'] = $_REQUEST['surgeon'];
				}
				else
				{
					$validationError['surgeonErr'] = 'Required';
				}
				
				if( isset($_REQUEST['hospital']) && $_REQUEST['hospital']!='' )
				{ 
					$data['hospital'] = $_REQUEST['hospital'];
				}
				
				if(!empty($validationError) && $validationError!='')
				{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addSurgoryHistory",array("validationError"=>$validationError,"surgoryData"=>$data));
						exit;
				}
				
				
				if(isset($_POST['patient_surgery_id']) && $_POST['patient_surgery_id'] != '')
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
					$PatientSurgeryHistoryObj->setData($data);
					$PatientSurgeryHistoryObj->insertData($_POST['patient_surgery_id']);
					Yii::app()->user->setFlash("success", "Patient's surgory history updated successfully.");
				}
				else
				{
					$data['creation_at'] = date("Y-m-d H:i:s");
					$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
					$PatientSurgeryHistoryObj->setData($data);
					$PatientSurgeryHistoryObj->insertData();
					Yii::app()->user->setFlash("success", "Patient's surgory history added successfully.");
				}
				
				$this->redirect(array('patient/surgoryHistoryListing'));
						
		}
		$this->redirect(array('patient/patientHome'));
	}
	
	function actiondeleteSurgoryHistory()
	{
	
		if(isset($_REQUEST['patient_surgery_id']) && $_REQUEST['patient_surgery_id'] != '')
		{
			$PatientSurgeryHistoryObj = new PatientSurgeryHistory();	
			$surgoryList = $PatientSurgeryHistoryObj->deletePatientSurgoryById($_REQUEST['patient_surgery_id']);
			Yii::app()->user->setFlash("success", "Patient's surgory history deleted successfully.");
		}
		$this->redirect(array('patient/surgoryHistoryListing'));
	}
	
	function actionsurgoryHistoryListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'surgoryhistory';
		
		$PatientSurgeryHistoryObj = new PatientSurgeryHistory();	
		$surgoryList = $PatientSurgeryHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($surgoryList) && $surgoryList!='')
		{		
			$this->render("surgoryHistoryListing",array("surgoryList"=>$surgoryList));
		}
		else
		{
			$this->render("surgoryHistoryListing");	
		}
	}
	
	function actionaddFamilyHistory()
	{
		$familyData = array();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'familyhistory';
		if(isset(Yii::app()->session['pingmydoctor_patient']))
		{
			$PatientFamilyHistoryObj = new PatientFamilyHistory();
			$familyData = $PatientFamilyHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
			
		}
		$this->render("addFamilyHistory",array('familyData' => $familyData));	
	}
	
	function actionsaveFamilyHistory()
	{		
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'familyhistory';
		if(isset($_REQUEST['saveFamilyHistory']))
		{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ 
					$validationError['patientErr'] = "Required"; 
				}
				
				if (isset($_REQUEST['relative_had_history']) && $_REQUEST['relative_had_history'] == 1) 
				{
					if (isset($_REQUEST['surgeon']) && $_REQUEST['surgeon'] !='')
					{
						$data['relative_had_history'] = $_REQUEST['relative_had_history'];
						$data['relative_name'] = $_REQUEST['surgeon'];
						
						if( isset($_REQUEST['hypertension']) && $_REQUEST['hypertension']!='' )
							$data['hypertension'] = $_REQUEST['hypertension'];
						else
							$data['hypertension'] = 0;
						
						if( isset($_REQUEST['tuberculosis']) && $_REQUEST['tuberculosis']!='' )
							$data['tuberculosis'] = $_REQUEST['tuberculosis'];
						else
							$data['tuberculosis'] = 0;
						
						if( isset($_REQUEST['diabetes']) && $_REQUEST['diabetes']!='' )
							$data['diabetes'] = $_REQUEST['diabetes'];
						else
							$data['diabetes'] = 0;
						
						if( isset($_REQUEST['kidney_disease']) && $_REQUEST['kidney_disease']!='' )
							$data['kidney_disease'] = $_REQUEST['kidney_disease'];
						else
							$data['kidney_disease'] = 0;
						
						if( isset($_REQUEST['heart_disease']) && $_REQUEST['heart_disease']!='' )
							$data['heart_disease'] = $_REQUEST['heart_disease'];
						else
							$data['heart_disease'] = 0;
						
						if( isset($_REQUEST['arthritis']) && $_REQUEST['arthritis']!='' )
							$data['arthritis'] = $_REQUEST['arthritis'];
						else
							$data['arthritis'] = 0;
						
						if( isset($_REQUEST['epilepsy']) && $_REQUEST['epilepsy']!='' )
							$data['epilepsy'] = $_REQUEST['epilepsy'];
						else
							$data['epilepsy'] = 0;
						
						if( isset($_REQUEST['convulsions']) && $_REQUEST['convulsions']!='' )
							$data['convulsions'] = $_REQUEST['convulsions'];
						else
							$data['convulsions'] = 0;
						
						if( isset($_REQUEST['cancer']) && $_REQUEST['cancer']!='' )
							$data['cancer'] = $_REQUEST['cancer'];
						else
							$data['cancer'] = 0;
						
						if( isset($_REQUEST['psychological']) && $_REQUEST['psychological']!='' )
							$data['psychological'] = $_REQUEST['psychological'];
						else
							$data['psychological'] = 0;
						
						if( isset($_REQUEST['drug']) && $_REQUEST['drug']!='' )
							$data['drug'] = $_REQUEST['drug'];
						else
							$data['drug'] = 0;
					}
				}
				else 
				{
					$data['relative_had_history'] = 0;
					$data['relative_name'] = "";
					$data['hypertension'] = 0;
					$data['tuberculosis'] = 0;
					$data['diabetes'] = 0;
					$data['kidney_disease'] = 0;
					$data['heart_disease'] = 0;
					$data['arthritis'] = 0;
					$data['epilepsy'] = 0;
					$data['convulsions'] = 0;
					$data['cancer'] = 0;
					$data['psychological'] = 0;
					$data['drug'] = 0;
				}
				
				/*if(!empty($validationError) && $validationError!='')
				{
						Yii::app()->user->setFlash("error", "Please Check the Information You have provided.");
						$this->render("addSurgoryHistory",array("validationError"=>$validationError,"surgoryData"=>$data));
						exit;
				}*/
				
				if(isset($_POST['patient_family_history_id']) && $_POST['patient_family_history_id'] != '')
				{
					$PatientFamilyHistoryObj = new PatientFamilyHistory();
					$PatientFamilyHistoryObj->setData($data);
					$PatientFamilyHistoryObj->insertData($_POST['patient_family_history_id']);
					Yii::app()->user->setFlash("success", "Patient's family history updated successfully.");
				}
				else
				{
					$PatientFamilyHistoryObj = new PatientFamilyHistory();
					$PatientFamilyHistoryObj->setData($data);
					$PatientFamilyHistoryObj->insertData();
					Yii::app()->user->setFlash("success", "Patient's family history added successfully.");
				}				
				$this->redirect(array('patient/addFamilyHistory'));
		}
		$this->redirect(array('patient/patientHome'));
	}
	
	function actionaddSocialHistory()
	{
		$familyData = array();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'socialhistory';
		if(isset(Yii::app()->session['pingmydoctor_patient']))
		{
			$PatientSocialHistoryObj = new PatientSocialHistory();
			$socialData = $PatientSocialHistoryObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
			
		}
		$this->render("addSocialHistory",array('socialData' => $socialData));	
	}
	
	public function actionsaveSocialHistory()
	{
		
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'socialhistory';
		if(isset($_REQUEST['saveSocialHistory']))
		{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ 
					$validationError['patientErr'] = "Required"; 
				}
				
				if(isset($_REQUEST['employed']) && $_REQUEST['employed'] == 1)
				{
					$data['employed'] = 1;
					
					if( isset($_REQUEST['occupation']) && $_REQUEST['occupation']!='' )
					{ 
						$data['occupation'] = $_REQUEST['occupation'];
					}
					else
					{
						$data['occupation'] = 0;
					}
				}
				else
				{
					$data['employed'] = 0;
				}
				
				if( isset($_REQUEST['children']) && $_REQUEST['children'] == 1)
				{ 
					$data['children'] = $_REQUEST['children'];
					if( isset($_REQUEST['how_many']) && $_REQUEST['how_many']!='' )
					{ 
						$data['how_many'] = $_REQUEST['how_many'];
					}
					else
					{
						$data['how_many'] = 0;
					}
				}
				else
				{
					$data['children'] = 0;
				}
				
				
				if( isset($_REQUEST['live']) && $_REQUEST['live']!='' )
				{ 
					$data['live'] = $_REQUEST['live'];
				}
				else
				{
					$data['live'] = 0;
				}
				
				if( isset($_REQUEST['live_other']) && $_REQUEST['live_other']!='' )
				{ 
					$data['live_other'] = $_REQUEST['live_other'];
				}
				else
				{
					$data['live_other'] = 0;
				}
				
				if( isset($_REQUEST['aids']) && $_REQUEST['aids']!='' )
				{ 
					$data['aids'] = $_REQUEST['aids'];
				}
				else
				{
					$data['aids'] = 0;
				}
				
				if( isset($_REQUEST['abuse_type']) && $_REQUEST['abuse_type']!='' )
				{ 
					$data['abuse_type'] = $_REQUEST['abuse_type'];
				}
				
				if( isset($_REQUEST['use_alcohol']) && $_REQUEST['use_alcohol'] == 1)
				{ 
					$data['use_alcohol'] = $_REQUEST['use_alcohol'];
					if( isset($_REQUEST['how_often']) && $_REQUEST['how_often']!='' )
					{ 
						$data['how_often'] = $_REQUEST['how_often'];
					}
					else
					{
						$data['how_often'] = 0;
					}	
				}
				else
				{
					$data['use_alcohol'] = 0;
				}
				
				
				
				if( isset($_REQUEST['smoker']) && $_REQUEST['smoker'] == 1 )
				{ 
					$data['smoker'] = $_REQUEST['smoker'];
					if( isset($_REQUEST['no_of_pack']) && $_REQUEST['no_of_pack']!='' )
					{ 
						$data['no_of_pack'] = $_REQUEST['no_of_pack'];
					}
					else
					{
						$data['no_of_pack'] = 0;
					}
					
					if( isset($_REQUEST['years']) && $_REQUEST['years']!='' )
					{ 
						$data['years'] = $_REQUEST['years'];
					}
					else
					{
						$data['years'] = 0;
					}
				}
				else
				{
					$data['smoker'] = 0;
				}
				
				
				
				if( isset($_REQUEST['when_quit']) && $_REQUEST['when_quit']!='' )
				{ 
					$data['when_quit'] = date("Y-m-d",strtotime($_REQUEST['when_quit']));
				}
				else
				{
					$data['when_quit'] = 0;
				}
				
								
				if(isset($_POST['patient_social_history_id']) && $_POST['patient_social_history_id'] != '')
				{
					$PatientSocialHistoryObj = new PatientSocialHistory();
					$PatientSocialHistoryObj->setData($data);
					$PatientSocialHistoryObj->insertData($_POST['patient_social_history_id']);
					Yii::app()->user->setFlash("success", "Patient's social history updated successfully.");
				}
				else
				{
					$PatientSocialHistoryObj = new PatientSocialHistory();
					$PatientSocialHistoryObj->setData($data);
					$PatientSocialHistoryObj->insertData();
					Yii::app()->user->setFlash("success", "Patient's social history added successfully.");
				}
				
				$this->redirect(array('patient/addSocialHistory'));
						
		}
		$this->redirect(array('patient/patientHome'));
		
		die;
	}
	
	function actionaddSymptoms()
	{
		$familyData = array();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'symptoms';
		if(isset(Yii::app()->session['pingmydoctor_patient']))
		{
			$PatientSymptomsHistoryObj = new PatientSymptomsHistory();
			$symptomData = $PatientSymptomsHistoryObj->getsymptomsListByPatient(Yii::app()->session['pingmydoctor_patient']);
			
		}
		$this->render("addSymptoms",array('symptomData' => $symptomData));	
	}
	
	function actionsaveSymptoms()
	{
		
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'symptoms';
		if(isset($_REQUEST['saveSymptoms']))
		{
			
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['pingmydoctor_patient']) && !empty(Yii::app()->session['pingmydoctor_patient']) && Yii::app()->session['pingmydoctor_patient']!='' )
				{
					$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				}
				else
				{ 
					$validationError['patientErr'] = "Required"; 
				}
				
				if( isset($_REQUEST['const_symptoms']) && $_REQUEST['const_symptoms']!='' )
				{ 
					$data['const_symptoms'] = implode(',',$_REQUEST['const_symptoms']);
				}
				else
				{
					$data['const_symptoms'] = '';
				}
				
				if( isset($_REQUEST['skin']) && $_REQUEST['skin']!='' )
				{ 
					$data['skin'] = implode(',',$_REQUEST['skin']);
				}
				else
				{
					$data['skin'] = '';
				}
				
				if( isset($_REQUEST['heent']) && $_REQUEST['heent']!='' )
				{ 
					$data['heent'] = implode(',',$_REQUEST['heent']);
				}
				else
				{
					$data['heent'] = '';
				}
				
				if( isset($_REQUEST['respiratory']) && $_REQUEST['respiratory']!='' )
				{ 
					$data['respiratory'] = implode(',',$_REQUEST['respiratory']);
				}
				else
				{
					$data['respiratory'] = '';
				}
				
				if( isset($_REQUEST['cardiovascular']) && $_REQUEST['cardiovascular']!='' )
				{ 
					$data['cardiovascular'] = implode(',',$_REQUEST['cardiovascular']);
				}
				else
				{
					$data['cardiovascular'] = '';
				}
				
				if( isset($_REQUEST['gastrointestinal']) && $_REQUEST['gastrointestinal']!='' )
				{ 
					$data['gastrointestinal'] = implode(',',$_REQUEST['gastrointestinal']);
				}
				else
				{
					$data['gastrointestinal'] = '';
				}
				
				if( isset($_REQUEST['genitourinary']) && $_REQUEST['genitourinary']!='' )
				{ 
					$data['genitourinary'] = implode(',',$_REQUEST['genitourinary']);
				}
				else
				{
					$data['genitourinary'] = '';
				}
				
				if( isset($_REQUEST['musculoskeletal']) && $_REQUEST['musculoskeletal']!='' )
				{ 
					$data['musculoskeletal'] = implode(',',$_REQUEST['musculoskeletal']);
				}
				else
				{
					$data['musculoskeletal'] = '';
				}
				
				if( isset($_REQUEST['neurological']) && $_REQUEST['neurological']!='' )
				{ 
					$data['neurological'] = implode(',',$_REQUEST['neurological']);
				}
				else
				{
					$data['neurological'] = '';
				}
				
				
				if( isset($_REQUEST['psychiatric']) && $_REQUEST['psychiatric']!='' )
				{ 
					$data['psychiatric'] = $_REQUEST['psychiatric'];
				}
				else
				{
					$data['psychiatric'] = '';
				}
				
				if( isset($_REQUEST['endocrine']) && $_REQUEST['endocrine']!='' )
				{ 
					$data['endocrine'] =  implode(',',$_REQUEST['endocrine']);
				}
				else
				{
					$data['endocrine'] = '';
				}
				
				if( isset($_REQUEST['hematologic']) && !empty($_REQUEST['hematologic']))
				{ 
					$data['hematologic'] = implode(',',$_REQUEST['hematologic']);
				}
				else
				{
					$data['hematologic'] = '';
				}
				
				
				if(isset($_POST['patient_symptoms_id']) && $_POST['patient_symptoms_id'] != '')
				{
					$PatientSymptomsHistoryObj = new PatientSymptomsHistory();
					$PatientSymptomsHistoryObj->setData($data);
					$PatientSymptomsHistoryObj->insertData($_POST['patient_symptoms_id']);
					Yii::app()->user->setFlash("success", "Patient's symptoms history updated successfully.");
				}
				else
				{
					$PatientSymptomsHistoryObj = new PatientSymptomsHistory();
					$PatientSymptomsHistoryObj->setData($data);
					$PatientSymptomsHistoryObj->insertData();
					Yii::app()->user->setFlash("success", "Patient's symptoms history added successfully.");
				}
				$this->redirect(array('patient/addSymptoms'));
		}
		$this->redirect(array('patient/addSymptoms'));
	}
	
	function actiondoctorListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'doctors';
		Yii::app()->session['active_sub_tab'] = 'doctors';
		
		if(!isset($_REQUEST['start']))
			{
				$_REQUEST['start'] = 0;
			}
			if(!isset($_REQUEST['length']))
			{
				$_REQUEST['length'] = 10;
			}
		
		$DoctorMasterObj = new DoctorMaster();
		$doctorList = $DoctorMasterObj->getAllDoctorList(Yii::app ()->session ['pingmydoctor_patient'],$_REQUEST['start'],$_REQUEST['length']);
			
			$DoctorMasterObj = new DoctorMaster();
			$doctorCount = $DoctorMasterObj->getAllDoctorListCount(Yii::app ()->session ['pingmydoctor_patient']);
		
		
		$this->render("doctorListing",array('doctorList'=>$doctorList,'ext'=>$ext,"recordsTotal"=>$doctorCount,"recordsFiltered"=>$doctorCount));
	}
	
	function actionselectDoctor()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'doctors';
		Yii::app()->session['active_sub_tab'] = 'doctors';
		
		if(isset($_GET['doct_pat_relation_id']) && $_GET['doct_pat_relation_id'] != '')
		{
			$data = array();
			$data['is_share'] = 1;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$DoctorPatientRelationObj =  new DoctorPatientRelation();
			$DoctorPatientRelationObj->setData($data);
			$DoctorPatientRelationObj->insertData($_GET['doct_pat_relation_id']);
			
			Yii::app()->user->setFlash("success", "Now you can share information with this doctor.");
			$this->redirect(array('patient/doctorListing'));
		}
	}
	
	
	function actionanaesthesiaListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'anaesthesia';
		
		
		$PatientAnethesiaObj = new PatientAnethesiaHistory();
		$anaesthesiaList = $PatientAnethesiaObj->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		
		$this->render("anaesthesiaListing",array('anaesthesiaList'=>$anaesthesiaList));
	}
	
	public function actionaddAnethesiaHistory()
	{
		if(isset($_GET['patient_anethesia_id']) && $_GET['patient_anethesia_id'] != '')
		{
			$PatientAnethesiaObj = new PatientAnethesiaHistory();
			$anaesthesiaData = $PatientAnethesiaObj->getdetailsByanethesiaId($_GET['patient_anethesia_id']);
			
			$this->render("addAnethesiaHistory",array('anaesthesiaData'=>$anaesthesiaData));
		}
		else
		{
			$this->render("addAnethesiaHistory");
		}
	}
	
	public function actionsaveAnethesia()
	{
		if(isset($_POST) && isset($_POST['submitAnethesia']))
		{
			$validationObj = new Validation();
			$res = $validationObj->saveAnethesia($_POST);
			
			if($res['status'] != 0)
			{
				Yii::app()->user->setFlash("error", $res['message']);
				$this->render('addAnethesiaHistory',array('anaesthesiaData'=>$_POST));
				die;
			}
			
			$data = array();
			$data['anethesia_type'] = $_POST['anethesia_type'];
			$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
			
			$data['report_date'] = date("Y-m-d",strtotime($_POST['report_date']));
			$data['reaction'] = $_POST['reaction'];
			$data['notes'] = $_POST['notes'];
			$data['created_at'] = date("Y-m-d H:i:s");
			
			
			if(isset($_POST['patient_anethesia_id']) && $_POST['patient_anethesia_id'] != '')
			{
				$data['modified_at'] = date("Y-m-d H:i:s");
				$PatientAnethesiaObj = new PatientAnethesiaHistory();
				$PatientAnethesiaObj->setData($data);
				$PatientAnethesiaObj->insertData($_POST['patient_anethesia_id']);
				Yii::app()->user->setFlash("success", "Anethesia updated successfully.");
			}
			else
			{
				$PatientAnethesiaObj = new PatientAnethesiaHistory();
				$PatientAnethesiaObj->setData($data);
				$PatientAnethesiaObj->insertData();
				
				Yii::app()->user->setFlash("success", "Anethesia added successfully.");
			}
			
			$this->redirect(array('patient/anaesthesiaListing'));
		}
		else
		{
			$this->redirect(array('patient/anaesthesiaListing'));
		}
		die;
	}
	
	function actiondeleteAnethesiaHistory()
	{
	
		if(isset($_REQUEST['patient_anethesia_id']) && $_REQUEST['patient_anethesia_id'] != '')
		{
			$PatientAnethesiaHistoryObj = new PatientAnethesiaHistory();	
			$surgoryList = $PatientAnethesiaHistoryObj->deleteanethesiaById($_REQUEST['patient_anethesia_id']);
			Yii::app()->user->setFlash("success", "Patient's anethesia history deleted successfully.");
		}
		$this->redirect(array('patient/anaesthesiaListing'));
	}
	
	public function actionloadPatinetInfoQuestionnaire()
	{
		
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById(Yii::app()->session['pingmydoctor_patient']);
		
		$patientInfoQuestionnaire = new patientInfoQuestionnaire();
		$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		$patientDoctorObj = new DoctorPatientRelation();
		$doctorInfo = $patientDoctorObj->getPCPdetails_by_patientidArray(Yii::app()->session['pingmydoctor_patient']);
		
		$this->render("patient_information_questionnaire",array("patientData"=>$patientData, "patientInfo"=>$patientInfo,'doctorInfo'=>$doctorInfo));
		
	}
	
	public function actionsubmitPatientQuestionnaireForm()
	{
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById(Yii::app()->session['pingmydoctor_patient']);
		
		$patientInfoQuestionnaire = new patientInfoQuestionnaire();
		$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
	if($patientData['get_newsletter'] == 1) { $get_newsletter =  "Yes"; } else { $get_newsletter = "No"; } 
	$formHtml .= '<div class="row">
    	<div class="col-sm-12">
        	<h3 class="ContentHeading text-center">Neurospine Institute<br>
Robert L. Masson, M.D., Mitchell L. Supler, M.D.<br>
<span class="ContentUnderline">Patient Information Questionnaire</span></h3>
        </div>
    </div><div class="row">
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
            <p class="ContentPara"><strong>Marital Status:</strong> - '.$patientData['marital_status'].'</p>
            <p class="ContentPara"><strong>Sex:</strong> - '.$patientData['gender'].'</p>
            <p class="ContentPara"><strong>Last Name:</strong> - '.$patientData['surname'].'</p>
            <p class="ContentPara"><strong>First Name:</strong> - '.$patientData['name'].'</p>
            <p class="ContentPara"><strong>Patient’s Social Security #:</strong> - '.$patientInfo['patient_security_no'].'</p>
            <p class="ContentPara"><strong>Date of Birth:</strong> - '.$patientData['dob'].'</p>
            <p class="ContentPara"><strong>Home Phone #:</strong> - '.$patientInfo['home_phone'].'</p>
            <p class="ContentPara"><strong>Mobile Phone #</strong> - '.$patientInfo['mobile_phone'].'</p>
            <p class="ContentPara"><strong>Home Address:</strong> - '.$patientInfo['name'].'</p>
            <p class="ContentPara"><strong>Apt #:</strong> - '.$patientInfo['appt_no'].'</p>
            <p class="ContentPara"><strong>City:</strong> - '.$patientInfo['city'].'</p>
            <p class="ContentPara"><strong>State:</strong> - '.$patientInfo['state'].'</p>
            <p class="ContentPara"><strong>Zip:</strong> - '.$patientInfo['zipcode'].'</p>
            <p class="ContentPara"><strong>Alternate Address:</strong> - '.$patientInfo['alternate_address'].'</p>
            <p class="ContentPara"><strong>Email Address:</strong> - '.$patientData['email'].'</p>
            <p class="ContentPara"><strong>Would you like to receive a monthly email newsletter</strong> - '.$get_newsletter.'</p>
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
    <div class="row">&nbsp;</div>';
	
	$formHtml .=  ' <div class="row">
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
    </div></div>';
			
		
		$filename = Yii::app()->session['pingmydoctor_patient']."_Patient_information_questionnaire_".date("Y-m-d").'.pdf';
		$path = "assets/upload/pdf/";
		
		if(!file_exists($path)) 
		{
			mkdir("assets/upload/pdf/", 0777);
		}

		$mpdf = new mPDF();
		$mpdf->WriteHTML($formHtml);
		$mpdf->Output(FILE_PATH.$path."/".$filename, 'F');
		
		$RegisterFormdata = array();
		$RegisterFormdata['patient_questionnaire'] = $filename; 
		$RegisterFormdata['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
		
		$PatientFormsHistoryObj =  new PatientFormsHistory();
		$patientFormsData = $PatientFormsHistoryObj->getFormsByPatientId(Yii::app()->session['pingmydoctor_patient']);
		
		if(!empty($patientFormsData) && $patientFormsData['patient_id'] == Yii::app()->session['pingmydoctor_patient'])
		{
			$RegisterFormdata['doctor_id'] = $patientData['doctor_id'];
			$RegisterFormdata['modified_at'] = date("Y-m-d H:i:s");
			
			$dotorNot = array();
			$dotorNot['doctor_id'] = $patientData['doctor_id'];
			$dotorNot['patient_id'] = $patientData['patient_id'];
			$dotorNot['form'] = 'Patient new registration';
			$dotorNot['created_at'] = date("Y-m-d H:i:s");
			
			$DoctorNotificationObj = new DoctorNotification();
			$DoctorNotificationObj->setData($dotorNot);
			$DoctorNotificationObj->insertData();
			
			
			$PatientFormsHistoryObj =  new PatientFormsHistory();
			$PatientFormsHistoryObj->setData($RegisterFormdata);
			$PatientFormsHistoryObj->insertData($patientFormsData['patient_forms_id']);
		}
		else
		{
			$RegisterFormdata['doctor_id'] = $patientData['doctor_id'];
			$RegisterFormdata['created_at'] = date("Y-m-d H:i:s");
			
			$dotorNot = array();
			$dotorNot['doctor_id'] = $patientData['doctor_id'];
			$dotorNot['patient_id'] = $patientData['patient_id'];
			$dotorNot['form'] = 'Patient new registration';
			$dotorNot['created_at'] = date("Y-m-d H:i:s");
			
			$DoctorNotificationObj = new DoctorNotification();
			$DoctorNotificationObj->setData($dotorNot);
			$DoctorNotificationObj->insertData();
			
			$PatientFormsHistoryObj =  new PatientFormsHistory();
			$PatientFormsHistoryObj->setData($RegisterFormdata);
			$PatientFormsHistoryObj->insertData();
		}

		
		Yii::app()->user->setFlash("success", "Successfully submited for approval.");
		$this->redirect(array("patient/getAllFormsForUser"));
	}
	
	function actionremoveDoctor()
	{
		if(isset($_REQUEST['doct_pat_relation_id']) && $_REQUEST['doct_pat_relation_id'] != '')
		{
			$data = array();
			$data['is_share'] = 0;
			$data['modified_at'] = date("Y-m-d H:i:s");
			
			$DoctorPatientRelationObj =  new DoctorPatientRelation();
			$DoctorPatientRelationObj->setData($data);
			$DoctorPatientRelationObj->insertData($_GET['doct_pat_relation_id']);
			
			Yii::app()->user->setFlash("success", "You have stopped sharing information with doctor.");
			$this->redirect(array('patient/doctorListing'));
		}
	}
	
	function actionaccountSetting()
	{
		$this->render("accountSetting");
	}
	
	public function actioncloseaccount()
	{
		$this->isLogin();
		$patientMasterObj = new PatientMaster();
		$res = $patientMasterObj->deletePatientAccount(Yii::app()->session['pingmydoctor_patient']);
		
		Yii::app()->user->setFlash("success", "Your account has been closed successfully.");
		$this->redirect(array('admin/'));
	}
	
	public function actiongetStates()
	{
		if(isset($_REQUEST['country_id']) && $_REQUEST['country_id'] != '')
		{
			
			$stateObj = new State();
			$stateData = $stateObj->getStatesByCountyId($_REQUEST['country_id']);
			if(!empty($stateData))
			{
				$str = '<option value="">- Select state -</option>';
				foreach($stateData as $row)
				{
					$str .= '<option value="'.$row['state_id'].'">'.$row['state'].'</option>';
				}
				echo $str;
			}
			else
			{
				echo '<option value="">- Select State -</option>';
			}
		}
		else
		{
			echo '<option value="">- Select State -</option>';
		}
	}
	/*Code Added By GK on 17th Sept 2015 Start*/
	public function actionimageListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'imagemanager';
	
		$ImageObj = new PatientImageManager();
		$imageData = $ImageObj->getImageListByPatient(Yii::app()->session['pingmydoctor_patient']);
		
		$this->render("imageListing",array("imageData"=>$imageData));
	}
	
	public function actionaddImage()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'imagemanager';
	
		if( ( isset($_REQUEST['image_id']) ) && ( $_REQUEST['image_id']!='' ) )
		{
			$ImageObj = new PatientImageManager();
			$imageData = $ImageObj->getImageById($_REQUEST['image_id']);
	
			$this->render("addImage",array('imageData'=>$imageData));
		}
		else
		{
			$this->render("addImage");
		}
	}
	
	function actionsaveImage()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'imagemanager';
	
		if( ( isset($_REQUEST['image_id']) ) && ( $_REQUEST['image_id']!='' ) )
		{
			if(isset($_POST['saveImage']))
			{
				$data = array();
				$data['image_id'] = $_REQUEST['image_id'];
				$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				$data['notes'] = $_POST['notes'];
				$data['modified_at'] = date("Y-m-d H:i:s");
	
				if(isset($_FILES['image_name']['name']) && $_FILES['image_name']['name'] != "")
				{
					$arrallowedfiles = array("dcm","jpg","bmp","jpeg","gif","png");
					if (in_array(pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION), $arrallowedfiles))
					{
						$fileUploadPath = FILE_PATH."assets/upload/avatar/filemanager/patient/".Yii::app()->session['pingmydoctor_patient']."/";
	
						$ImageObj = new PatientImageManager();
						$imageData = $ImageObj->getImageById($_REQUEST['image_id']);
	
						$deleteExtistingImageJPG = $fileUploadPath.$imageData['image_name'];
						$deleteExtistingImageDCM = $fileUploadPath.pathinfo($imageData['image_name'], PATHINFO_FILENAME).'.dcm';
						if (unlink($deleteExtistingImageJPG) && unlink($deleteExtistingImageDCM))
						{
							$data['image_name']  = pathinfo($_FILES['image_name']['name'], PATHINFO_FILENAME)."_".time().".".pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION);
							move_uploaded_file($_FILES["image_name"]["tmp_name"], $fileUploadPath.$data['image_name']);
								
							if(pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION) == "dcm")
							{
								$dcm = new dicom_convert;
								$dcm->file = $fileUploadPath.$data['image_name'];
								$dcm->dcm_to_jpg();
									
								$data['image_name'] = pathinfo($data['image_name'], PATHINFO_FILENAME).'.jpg';
							}
						}
						else
						{
							$data['image_name']  = pathinfo($_FILES['image_name']['name'], PATHINFO_FILENAME)."_".time().".".pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION);
							move_uploaded_file($_FILES["image_name"]["tmp_name"], $fileUploadPath.$data['image_name']);
							
							if(pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION) == "dcm")
							{
								$dcm = new dicom_convert;
								$dcm->file = $fileUploadPath.$data['image_name'];
								$dcm->dcm_to_jpg();
									
								$data['image_name'] = pathinfo($data['image_name'], PATHINFO_FILENAME).'.jpg';
							}
							//Yii::app()->user->setFlash("error", "Please select Image.");
						}
						$ImageObj->setData($data);
						$imageData = $ImageObj->insertData($_REQUEST['image_id']);
						Yii::app()->user->setFlash("success", "Image is updated successfully");
						$this->redirect(array("patient/imageListing"));
					}
					else
					{
						Yii::app()->user->setFlash("error", "Please select a valid Image.");
						$this->render("addImage");
					}
						
				}
			}
		}
		else
		{
			if(isset($_POST['saveImage']))
			{
				$data = array();
				$data['patient_id'] = Yii::app()->session['pingmydoctor_patient'];
				$data['notes'] = $_POST['notes'];
				$data['created_at'] = date("Y-m-d H:i:s");
	
				if(isset($_FILES['image_name']['name']) && $_FILES['image_name']['name'] != "")
				{
					$arrallowedfiles = array("dcm","jpg","bmp","jpeg","gif","png");
					if (in_array(pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION), $arrallowedfiles))
					{
						$data['image_name']  = pathinfo($_FILES['image_name']['name'], PATHINFO_FILENAME)."_".time().".".pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION);
						
						$fileUploadPath = FILE_PATH."assets/upload/avatar/filemanager/patient/".Yii::app()->session['pingmydoctor_patient']."/";
						if(!file_exists($fileUploadPath))
						{
							$dir=mkdir($fileUploadPath,0777);
							if($dir)
							{
								chmod($fileUploadPath, 0777);
								move_uploaded_file($_FILES["image_name"]["tmp_name"], $fileUploadPath.$data['image_name']);
							}
						}
						else
						{
							move_uploaded_file($_FILES["image_name"]["tmp_name"], $fileUploadPath.$data['image_name']);
						}
						if(pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION) == "dcm")
						{
							$dcm = new dicom_convert;
							$dcm->file = $fileUploadPath.$data['image_name'];
							$dcm->dcm_to_jpg();
		
							$data['image_name'] = pathinfo($data['image_name'], PATHINFO_FILENAME).'.jpg';
						}
						
						$ImageObj = new PatientImageManager();
						$ImageObj->setData($data);
						$imageData = $ImageObj->insertData();
	
						Yii::app()->user->setFlash("success", "Image is uploaded successfully.");
						//$this->redirect(array("patient/addImage"));
						$this->redirect(array("patient/imageListing"));
					}
					else
					{
						Yii::app()->user->setFlash("error", "Please select a valid Image.");
						$this->render("addImage");
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select an Image.");
					$this->render("addImage");
				}
			}
		}
	}
	
	public function actiondeleteImage()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'imagemanager';
	
		if( ( isset($_REQUEST['image_id']) ) && ( $_REQUEST['image_id']!='' ) )
		{
				
			$fileUploadPath = FILE_PATH."assets/upload/avatar/filemanager/patient/".Yii::app()->session['pingmydoctor_patient']."/";
				
			$ImageObj = new PatientImageManager();
			$imageData = $ImageObj->getImageById($_REQUEST['image_id']);
				
			$deleteExtistingImageJPG = $fileUploadPath.$imageData['image_name'];
			$deleteExtistingImageDCM = $fileUploadPath.pathinfo($imageData['image_name'], PATHINFO_FILENAME).'.dcm';
				
			$ImageObj->deleteImage($_REQUEST['image_id']);
			if (unlink($deleteExtistingImageJPG) || unlink($deleteExtistingImageDCM))
			{
				Yii::app()->user->setFlash("success", "Image is deleted successfully");
			}
			else
			{
				Yii::app()->user->setFlash("error", "Error in deletion of Image, Record is deleted successfully");
			}
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	/*Code Added By GK on 17th Sept 2015 End*/

	public function actionaddDocumentForms()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'form';		
		
		if(isset($_POST['saveDocuments'])) {	
			$data = array();
			$data['modifieddate'] = date('Y-m-d H:i:s');
			
			$PatientDocumentLogObj = new PatientDocumentLog();			
			$PatientDocumentLogData = $PatientDocumentLogObj->getDocumentListByPatientAndDocument(Yii::app()->session['pingmydoctor_patient'],$_REQUEST['documentid']);
			
			$PatientDocumentLogObj->setData($data);
			$PatientDocumentLogData = $PatientDocumentLogObj->insertData($PatientDocumentLogData[0]['patientDocumentLogid']);
			//prepare dynamic PDF file and store it on physical location.
			if (isset($_POST['documentid']) && $_POST['documentid']==1)
			{
				$PatientMasterObj = new PatientMaster();
				$patientData = $PatientMasterObj->getUserById(Yii::app()->session['pingmydoctor_patient']);
			
				$patientInfoQuestionnaire = new patientInfoQuestionnaire();
				$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
			
				$patientDoctorObj = new DoctorPatientRelation();
				$doctorInfo = $patientDoctorObj->getPCPdetails_by_patientidArray(Yii::app()->session['pingmydoctor_patient']);
				$this->layout = 'documenttpl';
				ob_start();
				//$HTMLRenderContents = $this->render("patient_information_questionnaire",array("patientData"=>$patientData, "patientInfo"=>$patientInfo,'doctorInfo'=>$doctorInfo, 'isPDF'=>true), true);
				$this->render("patient_information_questionnaire",array("patientData"=>$patientData, "patientInfo"=>$patientInfo,'doctorInfo'=>$doctorInfo, 'isPDF'=>true));
				$HTMLRenderContents = ob_get_contents();
				ob_end_clean();
				$filename = Yii::app()->session['pingmydoctor_patient']."_Patient_information_questionnaire_".date("Ymdhis").'.pdf';
				$path = "assets/upload/pdf/";
				if(!file_exists($path))
				{
					mkdir("assets/upload/pdf/", 0777);
				}
				$mpdf = new mPDF();
				$mpdf->WriteHTML($HTMLRenderContents);
				$mpdf->Output(FILE_PATH.$path."/".$filename, 'F');
				//added record in to table document_submitted_log
				$DocumentSubmittedLogObj = new DocumentSubmittedLog();
				$arrDocumentSubmittedLogData = array(
						"documentid" => $_POST['documentid'],
						"patient_id" => Yii::app()->session['pingmydoctor_patient'],
						"doctor_id" => $_POST['doctor'],
						"documentpdffile" => $filename,
						"submitteddate" => date("Y-m-d H:i:s"),
				);
				$DocumentSubmittedLogObj->setData($arrDocumentSubmittedLogData);
				$DocumentSubmittedLogObj->insertData();
				//send notification to doctor once document submitted.
				$DoctorNotification = array(
						'doctor_id' => $_POST['doctor'],
						'patient_id' => Yii::app()->session['pingmydoctor_patient'],
						'form' => $filename,
						'created_at' => date("Y-m-d H:i:s")
				);
				
				$DoctorNotificationObj = new DoctorNotification();
				$DoctorNotificationObj->setData($DoctorNotification);
				$DoctorNotificationObj->insertData();
				
				$RegisterFormdata = array(
						'patient_questionnaire' => $filename,
						'patient_id' => Yii::app()->session['pingmydoctor_patient'],
						'doctor_id' => $_POST['doctor'],
						'created_at' => date("Y-m-d H:i:s")
				);
				
				$PatientFormsHistoryObj =  new PatientFormsHistory();
				$PatientFormsHistoryObj->setData($RegisterFormdata);
				$PatientFormsHistoryObj->insertData();
			}
			Yii::app()->user->setFlash("success", "Document Log added successfully.");
			$this->redirect(array("patient/getAllFormsForUser"));
		}
		else if(isset($_POST['previewDocuments'])) {
			//@todo: prepare HTML prior to generate PDF file as preview.
			if (isset($_POST['documentid']) && $_POST['documentid']==1)
			{
				$PatientMasterObj = new PatientMaster();
				$patientData = $PatientMasterObj->getUserById(Yii::app()->session['pingmydoctor_patient']);
				
				$patientInfoQuestionnaire = new patientInfoQuestionnaire();
				$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);
				
				$patientDoctorObj = new DoctorPatientRelation();
				$doctorInfo = $patientDoctorObj->getPCPdetails_by_patientidArray(Yii::app()->session['pingmydoctor_patient']);
				$this->layout = 'documenttpl';
				$HTMLRenderContents = $this->render("patient_information_questionnaire",array("patientData"=>$patientData, "patientInfo"=>$patientInfo,'doctorInfo'=>$doctorInfo, 'isPDF'=>true), true);
// 				echo "<pre>";print_r($_POST);die;
				echo $HTMLRenderContents;
				die;
			}
			//echo "<pre>";print_r($_POST);die;
		} 
		else {
			if( isset($_REQUEST['documentid']) && !empty($_REQUEST['documentid']))
			{
				//collect list of appointment for the logged in patient user.
				$PatientAppointmentObj = new Appointment();
				$PatientAppointmentData = $PatientAppointmentObj->getUpcommingAppointmentListByPatient(Yii::app()->session['pingmydoctor_patient']);
				$this->render("addDocumentForms",array('PatientAppointmentData'=>$PatientAppointmentData));
			} else {
				$this->render("addDocumentForms");
			}
		}
	}
	
	public function actiongetSubmittedAllFormsForUser()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'submittedform';
		$DocumentSubmittedLogObj = new DocumentSubmittedLog();
		$SubmittedDocumentData = $DocumentSubmittedLogObj->GetDocumentSubmittedLogList(Yii::app()->session['pingmydoctor_patient']);
		$this->render("submittedFormsListing",array('SubmittedDocumentData'=>$SubmittedDocumentData));
	}
	
	/*Code Added By Arpita on 19th Sept 2015 Start*/
	public function actionacceptRejectAppointment()
	{
		$this->isLogin();
		$data = array();
		$data['status'] = $_REQUEST['appointment_status'];
		//$data['patient_view'] = 0;
		$data['modified_at'] = date("Y-m-d H:i:s");
	
		$AppointmentObj = new Appointment();
		$AppointmentObj->setData($data);
		$AppointmentObj->insertData($_REQUEST['appointment_id']);
		$AppointmentObj = new Appointment();
		$appointmentData = $AppointmentObj->getAppointmentById($_REQUEST['appointment_id']);
	
		if ($_REQUEST['appointment_status'] == 3)
		{
			$appointmentData['message'] = "Your appointment have been accepted on ".date('M d, Y',strtotime($appointmentData['modified_at'])).' with doctor '.Yii::app()->session['fullName'];
			Yii::app()->user->setFlash("success", "Appointment accepted successfully.");
		}
		else if ($_REQUEST['appointment_status'] == 4)
		{
			$appointmentData['message'] = "Your appointment have been rejected on ".date('M d, Y',strtotime($appointmentData['modified_at'])).' with doctor '.Yii::app()->session['fullName'];
			Yii::app()->user->setFlash("success", "Appointment rejected successfully.");
		}
	
		$this->redirect(array("patient/appointmentList"));
	}
	/*Code Added By Arpita on 19th Sept 2015 End*/
}