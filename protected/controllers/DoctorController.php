<?php
date_default_timezone_set("Asia/Kolkata"); 
class DoctorController extends Controller
{
	public function actionIndex()
	{
		 if (isset(Yii::app()->session['pingmydoctor_doctor'])) {
			 $this->redirect(array("doctor/doctorHome"));
                 }
		 else
		 {
			 $this->redirect(array('admin/index'));
		 }
		
	}

	function isLogin() {
        if (isset(Yii::app()->session['pingmydoctor_doctor'])) {
            return true;
        } else {
            Yii::app()->user->setFlash("error", "Email or password required");
            header("Location: " . Yii::app()->params->base_path . "doctor");
            exit;
        }
    }
	
	function actiondoctorLogin()
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
					
				$doctorMasterObj	=	new DoctorMaster();
				$doctor_data	=	$doctorMasterObj->getdoctorDetailsByEmail($email);
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_POST['password'], $doctor_data['password']);
			
			if ( $isValid === true ) {
				Yii::app()->session['pingmydoctor_doctor'] = $doctor_data['doctor_id'];
				Yii::app()->session['email'] = $doctor_data['email'];
				Yii::app()->session['name'] = $doctor_data['name'];
				Yii::app()->session['doctor_image'] = $doctor_data['doctor_image'];
				Yii::app()->session['fullName'] = $doctor_data['name'] . ' ' . $doctor_data['surname'];
				
				Yii::app()->session['active_tab'] = 'home';
				$this->redirect(array("doctor/doctorHome"));
			
				exit;
			} else {
				Yii::app()->user->setFlash("error","Email or Password is not valid");
				$this->redirect(array('doctor/index'));
				exit;
			}	
		}
		else
		{
			header('location:'.Yii::app()->params->base_path.'doctor/index');
		}
	
	}
	
	function actiondoctorLoginFromAdmin()
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
					
				$doctorMasterObj	=	new DoctorMaster();
				$doctor_data	=	$doctorMasterObj->getdoctorDetailsByEmail($email);
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_REQUEST['password'], $doctor_data['password']);
			
			if ( $isValid === true ) {
				Yii::app()->session['pingmydoctor_doctor'] = $doctor_data['doctor_id'];
				Yii::app()->session['email'] = $doctor_data['email'];
				Yii::app()->session['name'] = $doctor_data['name'];
				Yii::app()->session['doctor_image'] = $doctor_data['doctor_image'];
				Yii::app()->session['fullName'] = $doctor_data['name'] . ' ' . $doctor_data['surname'];
				
				Yii::app()->session['active_tab'] = 'home';
				$this->redirect(array("doctor/doctorHome"));
			
				exit;
			} else {
				Yii::app()->user->setFlash("error","Email or Password is not valid");
				$this->redirect(array('doctor/index'));
				exit;
			}	
		}
		else
		{
			header('location:'.Yii::app()->params->base_path.'doctor/index');
		}
	
	}
	
	function actiondoctorLogout()
	{
		$this->isLogin();
		Yii::app()->session->destroy();
		$this->redirect(array("admin/index"));
	}
	
	function actiondoctorHome()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'home';
		$this->render("doctorHome");
	}
	
	function actionpatientList()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'patient';
		
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getPatientListByDoctor(Yii::app()->session['pingmydoctor_doctor']);
		
		$this->render("patientList",array("patientData"=>$patientData));
	}
	
	function actiongetDetailsByPatient()
	{
		$this->isLogin();
		
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='')
		{ 
			$PatientMaster = new PatientMaster();
			$patientData = $PatientMaster->getUserById($_REQUEST['patient_id']);
			
			$CholesterolMeasurement = new CholesterolMeasurement();
			$cholesterolData = $CholesterolMeasurement->getCholesterolDetailsByPatient($_REQUEST['patient_id']);
			
			$BloodGlucoseMeasurement = new BloodGlucoseMeasurement();
			$bloodGlucoseData = $BloodGlucoseMeasurement->getBloodGlucoseDetailsByPatient($_REQUEST['patient_id']);
			
			$BloodPressureMeasurement = new BloodPressureMeasurement();
			$bloodPressureData = $BloodPressureMeasurement->getBloodPressureDetailsByPatient($_REQUEST['patient_id']);
			$HeightMeasurement = new HeightMeasurement();
			$heightData = $HeightMeasurement->getHeightDetailsByPatient($_REQUEST['patient_id']);
			
			$WeightMeasurement = new WeightMeasurement();
			$weightData = $WeightMeasurement->getWeightDetailsByPatient($_REQUEST['patient_id']);
			
			$AllergyHealthHistory = new AllergyHealthHistory();
			$allergyData = $AllergyHealthHistory->getAllergyDetailsByPatient($_REQUEST['patient_id']);
			
			$MedicationHealthHistory = new MedicationHealthHistory();
			$medicationData = $MedicationHealthHistory->getMedicationDetailsByPatient($_REQUEST['patient_id']);
			
			$ImmunizationHealthHistory = new ImmunizationHealthHistory();
			$immunizationData = $ImmunizationHealthHistory->getImmunizationDetailsByPatient($_REQUEST['patient_id']);
			$ProcedureHealthHistory = new ProcedureHealthHistory();
			$procedureData = $ProcedureHealthHistory->getProcedureDetailsByPatient($_REQUEST['patient_id']);
			
			$this->render("patientDetails",array("patientData"=>$patientData,"cholesterolData"=>$cholesterolData,"bloodGlucoseData"=>$bloodGlucoseData,"bloodPressureData"=>$bloodPressureData,"heightData"=>$heightData,"weightData"=>$weightData,"allergyData"=>$allergyData,"medicationData"=>$medicationData,"immunizationData"=>$immunizationData,"procedureData"=>$procedureData));
		}
	}
	
	
	function actioncholesterolListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		
		$CholesterolMeasurementObj = new CholesterolMeasurement();	
		$cholesterolList = $CholesterolMeasurementObj->getAllCholesterolList();
		
		if(!empty($cholesterolList) && $cholesterolList!='')
		{		
			$this->render("cholesterolListing",array("cholesterolList"=>$cholesterolList));
		}
		else
		{
			$this->render("cholesterolListing");	
		}
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
				if(!isset(Yii::app()->session['selected_patient_id']) || Yii::app()->session['selected_patient_id'] == '')
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addCholesterol",array("cholesterolData"=>$_REQUEST));
					exit;
				}
				
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && !empty(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
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
							$this->redirect(array("doctor/cholesterolListing"));
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
				
				if(!isset(Yii::app()->session['selected_patient_id']) || Yii::app()->session['selected_patient_id'] == '')
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addCholesterol",array("cholesterolData"=>$_REQUEST));
					exit;
				}
				
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && !empty(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
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
							$this->redirect(array("doctor/addCholesterol"));
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
	
	function actionbloodGlucoseListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodGlucose';
		
		$BloodGlucoseMeasurement = new BloodGlucoseMeasurement();	
		$bloodGlucoseList = $BloodGlucoseMeasurement->getAllBloodGlucoseList();
		
		if(!empty($bloodGlucoseList) && $bloodGlucoseList!='')
		{		
			$this->render("bloodGlucoseListing",array("bloodGlucoseList"=>$bloodGlucoseList));
		}
		else
		{
			$this->render("bloodGlucoseListing");	
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
			if(!isset(Yii::app()->session['selected_patient_id']))
			{
				Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
				$this->render("addBloodGlucose",array("cholesterolData"=>$_REQUEST));
				die;
			}
						
			if(isset($_REQUEST['saveBloodGlucose']))
			{
				
				
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && !empty(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{ 
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addBloodGlucose",array("cholesterolData"=>$_REQUEST));
					die;
				
				}
				
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
							$this->redirect(array("doctor/bloodGlucoseListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Blood Glucose Updation.");
							$this->render("addBloodGlucose",array("validationError"=>$validationError,"bloodGlucoseData"=>$_REQUEST));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("Error", "Problem is occured in Blood Glucose Updation.");
						$this->render("addBloodGlucose",array("validationError"=>$validationError,"bloodGlucoseData"=>$_REQUEST));
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
				
				if( isset(Yii::app()->session['selected_patient_id']))
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addBloodGlucose",array("bloodGlucoseData"=>$_REQUEST));
					die;  
				}
				
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
							$this->redirect(array("doctor/addbloodGlucose"));
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
	
	function actionbloodPressureListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'bloodPressure';
		
		$BloodPressureMeasurement = new BloodPressureMeasurement();	
		$bloodPressureList = $BloodPressureMeasurement->getAllBloodPressureList();
		
		if(!empty($bloodPressureList) && $bloodPressureList!='')
		{		
			$this->render("bloodPressureListing",array("bloodPressureList"=>$bloodPressureList));
		}
		else
		{
			$this->render("bloodPressureListing");	
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
			if(!isset(Yii::app()->session['selected_patient_id']))
			{
				Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
				$this->render("addBloodPressure",array("bloodPressureData"=>$_REQUEST));
				die;
			}
						
			if(isset($_REQUEST['saveBloodPressure']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{ 
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addBloodPressure",array("bloodPressureData"=>$_REQUEST));
					die; 
				}
				
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
							$this->redirect(array("doctor/bloodPressureListing"));
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
				
				if( isset(Yii::app()->session['selected_patient_id']) )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addBloodPressure",array("bloodPressureData"=>$_REQUEST));
					die;
				}
				
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
							$this->redirect(array("doctor/addbloodPressure"));
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
	
	function actionheightListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'height';
		
		$HeightMeasurement = new HeightMeasurement();	
		$heightList = $HeightMeasurement->getAllHeightList();
		
		if(!empty($heightList) && $heightList!='')
		{		
			$this->render("heightListing",array("heightList"=>$heightList));
		}
		else
		{
			$this->render("heightListing");	
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
			if(!isset(Yii::app()->session['selected_patient_id']))
			{
				Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addHeight",array("heightData"=>$_REQUEST));
					die;
			}
						
			if(isset($_REQUEST['saveHeight']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{ Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addHeight",array("heightData"=>$_REQUEST));
					die; }
				
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
							$this->redirect(array("doctor/heightListing"));
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
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{ 
					Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addHeight",array("heightData"=>$_REQUEST));
					die;
				}
				
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
							$this->redirect(array("doctor/addHeight"));
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
	
	function actionweightListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'weight';
		
		$WeightMeasurement = new WeightMeasurement();	
		$weightList = $WeightMeasurement->getAllWeightList();
		
		if(!empty($weightList) && $weightList!='')
		{		
			$this->render("weightListing",array("weightList"=>$weightList));
		}
		else
		{
			$this->render("weightListing");	
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
			if(!Yii::app()->session['selected_patient_id'])
			{
				Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addWeight",array("weightData"=>$_REQUEST)) ;
					die;
			}
						
			if(isset($_REQUEST['saveWeight']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']))
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{ 
					Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addWeight",array("weightData"=>$_REQUEST)) ;
					die;
				 }
				
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
							$this->redirect(array("doctor/weightListing"));
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
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addWeight",array("weightData"=>$_REQUEST)) ;
					die;
				}
				
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
							$this->redirect(array("doctor/addWeight"));
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

	function actiondoctorProfile()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		
		if( (isset(Yii::app()->session['pingmydoctor_doctor']) ) && ( Yii::app()->session['pingmydoctor_doctor']!='' ) )
		{
			$DoctorMaster = new DoctorMaster();	
			$doctorData = $DoctorMaster->getDoctorById(Yii::app()->session['pingmydoctor_doctor']);
			
			$this->render("doctorProfile",array('doctorData'=>$doctorData));
		}
		else
		{
			$this->render("doctorProfile");
		}
	}
	
	function actionsaveDoctorProfile()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'profile';
		if( ( isset(Yii::app()->session['pingmydoctor_doctor']) ) && ( Yii::app()->session['pingmydoctor_doctor']!='' ) )
		{
			if(isset($_POST['saveDoctorProfile']))
			{
				$data = array();
				$data['doctor_id'] = Yii::app()->session['pingmydoctor_doctor'];
				
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
				if(isset($_POST['address']) && $_POST['address']!='')
				{
					$data['address'] = $_POST['address'];	
				}
				if(isset($_POST['surname']) && $_POST['surname']!='')
				{
					$data['surname'] = $_POST['surname'];	
				}
				if(isset($_POST['doctor_mobile']) && $_POST['doctor_mobile']!='')
				{
					$data['doctor_mobile'] = $_POST['doctor_mobile'];	
				}
				if(isset($_POST['doctor_spec_id']) && $_POST['doctor_spec_id']!='')
				{
					$data['doctor_spec_id'] = $_POST['doctor_spec_id'];	
				}
				if(isset($_POST['qualification']) && $_POST['qualification']!='')
				{
					$data['qualification'] = $_POST['qualification'];	
				}
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!=''))
				{
				
				if(isset($_FILES['doctor_image']['name']) && $_FILES['doctor_image']['name'] != "")
				 {
					$data['doctor_image']= "doctor_".Yii::app()->session['pingmydoctor_doctor'].".png";
					move_uploaded_file($_FILES['doctor_image']["tmp_name"],"assets/upload/avatar/doctor/".$data['doctor_image']);
				 }
				 
				 if(isset($_POST['latitude']) && $_POST['latitude']!='')
				{
					$data['latitude'] = $_POST['latitude'];	
				}
				
				if(isset($_POST['longitude']) && $_POST['longitude']!='')
				{
					$data['longitude'] = $_POST['longitude'];	
				}
				
				$data['modified_at'] = date("Y-m-d H:i:s");
				
				$DoctorMaster = new DoctorMaster();
				$emailData = $DoctorMaster->checkEmailId($data['email']);
					
					if( ( $emailData=="" || $emailData==NULL ) || ( $emailData['doctor_id'] == Yii::app()->session['pingmydoctor_doctor'] ) )
					{
						try 
						{
							$DoctorMaster = new DoctorMaster();
							$DoctorMaster->setData($data);
							$DoctorMaster->insertData(Yii::app()->session['pingmydoctor_doctor']);
							Yii::app()->user->setFlash("success", "Profile is updated successfully");
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Doctor Data.");
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("doctorProfile",array('doctorData'=>$data,'doctor_id'=>Yii::app()->session['pingmydoctor_doctor']));
						die;
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Patient Name and Email are Required.");
					$this->render("patientProfile",array('patientData'=>$data,'patient_id'=>Yii::app()->session['pingmydoctor_patient']));
					die;
				}
				
				$this->redirect(array("doctor/doctorProfile"));
					
			}
		}
		else
		{
			$this->redirect(array("doctor/doctorHome"));
		}
	}
	
	function actionchangePassword()
	{
		$this->isLogin();
		
		if(isset($_POST['FormSubmit']))
		{
			$validationObj = new Validation();
			$res = $validationObj->changepasswordDoctor($_POST);
			
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
				
				$DoctorMaster = new DoctorMaster();
				$DoctorMaster->setData($data);
				$insertedId = $DoctorMaster->insertData(Yii::app()->session['pingmydoctor_doctor']);
				
				Yii::app()->user->setFlash("success","password changed successfully");
				$this->render("changePassword");
				exit;
			}
		
		}
		
		$this->render('changePassword');	
	}
	
	function actionallergyListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'allergy';
		
		$AllergyHealthHistory = new AllergyHealthHistory();	
		$allergyList = $AllergyHealthHistory->getAllergyHealthHistoryList();
		
		if(!empty($allergyList) && $allergyList!='')
		{		
			$this->render("allergyListing",array("allergyList"=>$allergyList));
		}
		else
		{
			$this->render("allergyListing");	
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
			if(!isset(Yii::app()->session['selected_patient_id']))
			{
				Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
				$this->render("addAllergy",array("allergyData"=>$_REQUEST));
				die;
			}
						
			if(isset($_REQUEST['saveAllergy']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addAllergy",array("allergyData"=>$_REQUEST));
					die; 
				}
				
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
							$this->redirect(array("doctor/allergyListing"));
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
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{ 
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addAllergy",array("allergyData"=>$_REQUEST));
					die;
				}
				
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
							$this->redirect(array("doctor/addAllergy"));
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
	
	function actionimmunizationListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'immunization';
		
		$ImmunizationHealthHistory = new ImmunizationHealthHistory();	
		$immunizationList = $ImmunizationHealthHistory->getImmunizationList();
		
		if(!empty($immunizationList) && $immunizationList!='')
		{		
			$this->render("immunizationListing",array("immunizationList"=>$immunizationList));
		}
		else
		{
			$this->render("immunizationListing");	
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
			if(!isset(Yii::app()->session['selected_patient_id']))
			{
				Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addImmunization",array("immunizationData"=>$_REQUEST));
					die; 
			}
						
			if(isset($_REQUEST['saveImmunization']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addImmunization",array("immunizationData"=>$_REQUEST));
					die;  
				}
				
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
							$this->redirect(array("doctor/immunizationListing"));
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
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] !='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addImmunization",array("immunizationData"=>$_REQUEST));
					die; 
				}
				
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
							$this->redirect(array("doctor/addImmunization"));
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
	
	function actionmedicationListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'medication';
		
		$MedicationHealthHistory = new MedicationHealthHistory();	
		$medicationList = $MedicationHealthHistory->getMedicationList();
		
		if(!empty($medicationList) && $medicationList!='')
		{		
			$this->render("medicationListing",array("medicationList"=>$medicationList));
		}
		else
		{
			$this->render("medicationListing");	
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
			if(!isset(Yii::app()->session['selected_patient_id']))
			{
				Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
				$this->render("addMedication",array("medicationData"=>$data));
				die; 
			}
						
			if(isset($_REQUEST['saveMedication']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addMedication",array("medicationData"=>$data));
					die;  
				}
				
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
							$this->redirect(array("doctor/medicationListing"));
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
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select the patient from patient list.");
					$this->render("addMedication",array("medicationData"=>$data));
					die; 
				}
				
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
							$this->redirect(array("doctor/addMedication"));
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
	
	function actionprocedureListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'healthHistory';
		Yii::app()->session['active_sub_tab'] = 'procedure';
		
		$ProcedureHealthHistory = new ProcedureHealthHistory();	
		$procedureList = $ProcedureHealthHistory->getProcedureList();
		
		if(!empty($procedureList) && $procedureList!='')
		{		
			$this->render("procedureListing",array("procedureList"=>$procedureList));
		}
		else
		{
			$this->render("procedureListing");	
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
			if(!isset(Yii::app()->session['selected_patient_id']))
			{
				Yii::app()->user->setFlash("error", "Please select patient from patient list.");
				$this->render("addProcedure",array("procedureData"=>$_REQUEST)); 
				die;
			}
						
			if(isset($_REQUEST['saveProcedure']))
			{
				
				$data = array();
				$validationError = array();
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addProcedure",array("procedureData"=>$_REQUEST)); 
					die;
				}
				
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
							$this->redirect(array("doctor/procedureListing"));
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
				
				if( isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id']!='' )
				{
					$data['patient_id'] = Yii::app()->session['selected_patient_id'];
				}
				else
				{
					Yii::app()->user->setFlash("error", "Please select patient from patient list.");
					$this->render("addProcedure",array("procedureData"=>$_REQUEST)); 
					die;
				}
				
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
							$this->redirect(array("doctor/addProcedure"));
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
	
	function actionsendPushNotificationForAppointment()
	{
		
		
		$patientObj = new PatientMaster();
		$patientData = $patientObj->getUserById($_REQUEST['patient_id']);
 
 		if(isset($patientData['session_id']) && $patientData['session_id'] != '')
		{
			$data['message'] = "Your appointment is fixed on tommorrow."; 
			$data['date'] = date("Y-m-d H:i:s");
	
			 // create the extra field
			$extra = array();
	 
			 $contents = array();
			 $contents['badge'] = "+1";
			 $contents['alert'] = $data['message'];
			 $contents['sound'] = "cat.caf";
			
			 $notification = array();
			 $notification['ios'] = $contents;
			 $platform = array();
			 array_push($platform, "ios");
			 
			 $push = array("audience"=>$patientData['device_token'], "notification"=>$notification, "device_types"=>$platform);
			 
			 $json = json_encode($push);
			 //echo "Payload: " . $json . "\n"; //show the payload
			 
			 $session = curl_init(PUSHURL);
			 curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET);
			 curl_setopt($session, CURLOPT_POST, True);
			 curl_setopt($session, CURLOPT_POSTFIELDS, $json);
			 curl_setopt($session, CURLOPT_HEADER, False);
			 curl_setopt($session, CURLOPT_RETURNTRANSFER, True);
			 curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/vnd.urbanairship+json; version=3;'));
			 //*************************************************************/
			// Code addeed by Hi-Tech to bypass HOST name verification
			//*************************************************************/
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	start	*********************/
			// Hostname was found in DNS cache
			// Trying 23.61.80.184...
			// Connected to go.urbanairship.com (23.61.80.184) port 443 (#12)
			// SSL certificate problem: unable to get local issuer certificate
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	end	*********************/
			 curl_setopt($session, CURLOPT_VERBOSE, True);
			 curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
			 curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
			 //**********************************************************************************************************************************/
			 $content = curl_exec($session);
			 //echo "Response: " . $content . "\n";
			 
			 // Check if any error occured
			 $response = curl_getinfo($session);
			
			 if($response['http_code'] != 202) {
				
				 Yii::app()->user->setFlash("error", "Got negative response from server: " . $response['http_code'] . "\n");
				 $this->redirect(array("doctor/patientlist"));
				 
			 } else {
			 
				Yii::app()->user->setFlash("success", "Your appointment is fixed on tommorrow.");
				$this->redirect(array("doctor/patientlist"));
				 
			 }
			 
			 curl_close($session);
		}
		else
		{
			Yii::app()->user->setFlash("error", "Patient is not logged in to device.");
			$this->redirect(array("doctor/patientlist"));
		}
		
		
	}

	function actionpatientFormList()
	{
		
		$DoctorPatientRelationObj = new DoctorPatientRelation();
		$doctorPatientData = $DoctorPatientRelationObj->getdetails(Yii::app()->session['pingmydoctor_doctor'],$_REQUEST['patient_id']);
		
		$is_share = NULL;
		if(isset($doctorPatientData) && $doctorPatientData['is_share'] == 0)
		{
			$is_share = 0;
		}
		else
		{
			$is_share = 1;
		}
		if(isset($_REQUEST['doctor_notification_id']) && $_REQUEST['doctor_notification_id'] != '')
		{
			$docNot = array();
			$docNot['is_read'] = 1;
			$DoctorNotificationObj = new DoctorNotification();
			$DoctorNotificationObj->setData($docNot);
			$DoctorNotificationObj->insertData($_REQUEST['doctor_notification_id']);
		}
		$HipaaFormDetailsObj = new HipaaFormDetails();
		$hipaaData = $HipaaFormDetailsObj->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$PatientFormsHistoryObj = new PatientFormsHistory();
		$formsList = $PatientFormsHistoryObj->getFormsByPatientId($_REQUEST['patient_id']);
		//print_r($formsList); die;
		
		$this->render("formsListing",array('hipaaData'=>$hipaaData,'formsList' => $formsList,'is_share'=>$is_share));
	}
	
	public function actionupdateHipaaForm()
	{
		//print_r($_REQUEST); die;
		$hipaaData = array();
		if(isset($_REQUEST['patient_id']) && !empty($_REQUEST['patient_id']))
		{
			$HipaaFormDetailsObj = new HipaaFormDetails();
			$hipaaData = $HipaaFormDetailsObj->getdetailsByPatientId($_REQUEST['patient_id']);
			$PatientMasterObj = new PatientMaster();
			$patient_data = $PatientMasterObj->getpatientdata($_REQUEST['patient_id']);
			if(!empty($patient_data))
			{
				$hipaaData['name']	= $patient_data['name'] . '  ' .  $patient_data['surname'];
				$hipaaData['dob']	= $patient_data['dob'];			
			}
		}
		//print_r($hipaaData); die;
		$this->render("updateHipaaForm",array('hipaaData'=>(array)$hipaaData));
	}
	
	public function actionsaveHipaaForm()
	{
		//echo "<pre>"; print_r($_POST); die;
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
			$data['patient_id'] = $_REQUEST['patient_id'];
			
			$HipaaFormDetailsObj = new HipaaFormDetails();
			$hipaaData = $HipaaFormDetailsObj->getdetailsByPatientId($data['patient_id']);
			if(!empty($hipaaData) &&  isset($hipaaData))
			{    // Come for record Update
				$data['modified_at'] = date("Y-m-d H:i:s");
				$HipaaFormDetailsObj = new HipaaFormDetails();
				$HipaaFormDetailsObj->setData($data);
				$HipaaFormDetailsObj->insertData($hipaaData['form_id']);
			} 
			else
			{	// come for record Insert
				$data['created_at'] = date("Y-m-d H:i:s");
				$HipaaFormDetailsObj = new HipaaFormDetails();
				$HipaaFormDetailsObj->setData($data);
				$HipaaFormDetailsObj->insertData();
			}
			$HipaaFormDetailsObj = new HipaaFormDetails();
			$hipaaData = $HipaaFormDetailsObj->getdetailsByPatientId($_REQUEST['patient_id']);
			//$this->actionhipaa(Yii::app()->session['pingmydoctor_patient']);
			$this->render("formsListing",array('hipaaData'=>$hipaaData));
		
			
		}
		
		
	}
	
	function actionsaveAppointment()
	{
		if(isset($_POST))
		{
			$data = array();
			$data['appointment_date'] = date("Y-m-d",strtotime($_POST['appointment_date']));
			$data['appointment_time'] = date('H:i:s',strtotime($_POST['appointment_time']));
			$data['notes'] = $_POST['notes'];
			$data['patient_id'] = $_POST['patient_id'];
			$data['doctor_id'] = Yii::app()->session['pingmydoctor_doctor'];
			$data['created_at'] = date("Y-m-d H:i:s");
			
			$AppointmentObj = new Appointment();
			$AppointmentObj->setData($data);
			$appointmentId = $AppointmentObj->insertData();
			
			$data['message'] = "Your appointment is fixed on ".$data['appointment_date'].''.$data['appointment_time'].' with doctor '.Yii::app()->session['fullName'];
			
			$patNot = array();
			$patNot['patient_id'] = $_REQUEST['patient_id'];
			$patNot['doctor_id'] = Yii::app()->session['pingmydoctor_doctor'];
			$patNot['message'] = $data['message'];
			$patNot['notification_type'] = 1;
			$patNot['createdAt'] = date("Y-m-d h:i:s");
		
			$PatientNotificationObj = new PatientNotification();
			$PatientNotificationObj->setData($patNot);
			$PatientNotificationObj->insertData();
			
			
			$this->sendAppointmentNotification($data);
			Yii::app()->user->setFlash("success", "Appointment saved successfully.");
			//Added code to redirect user to respective listing page
			if (isset($_POST['parent_page']) && $_POST['parent_page']=='appointmentPage')
				$this->redirect(array("doctor/appointmentList"));
				
			$this->redirect(array("doctor/patientList"));			
		}
		else
		{
			Yii::app()->user->setFlash("error", "Something wrong with url.");
			//Added code to redirect user to respective listing page
			if (isset($_POST['parent_page']) && $_POST['parent_page']=='appointmentPage')
				$this->redirect(array("doctor/appointmentList"));
			
			$this->redirect(array("doctor/patientList"));
		}
		
	}
	
	
	function actionAppointmentList()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'appointment';
		
		$AppointmentObj = new Appointment();
		$appointmentData = $AppointmentObj->getAppointmentListByDoctor(Yii::app()->session['pingmydoctor_doctor']);
		
		$this->render("appointmentList",array("appointmentData"=>$appointmentData));
	}
	
	
	function sendAppointmentNotification($data)
	{
		
		 $patientObj = new PatientMaster();
		 $patientData = $patientObj->getUserById($data['patient_id']);
		 
		 if(isset($patientData['session_id']) && $patientData['session_id'] != '')
		 {
		 
			 $contents = array();
			 $contents['badge'] = "+1";
			 $contents['alert'] = $data['message'];
			 $contents['sound'] = "cat.caf";
			
			 $notification = array();
			 $notification['ios'] = $contents;
			 $platform = array();
			 array_push($platform, "ios");
			 
			 $push = array("audience"=>array("device_token"=>$patientData['device_token']), "notification"=>$notification, "device_types"=>$platform);
			 
			 $json = json_encode($push);
			 //echo "Payload: " . $json . "\n"; //show the payload
			 
			 $session = curl_init(PUSHURL);
			 curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET);
			 curl_setopt($session, CURLOPT_POST, True);
			 curl_setopt($session, CURLOPT_POSTFIELDS, $json);
			 curl_setopt($session, CURLOPT_HEADER, False);
			 curl_setopt($session, CURLOPT_RETURNTRANSFER, True);
			 curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/vnd.urbanairship+json; version=3;'));
			 
			 //*************************************************************/
			// Code addeed by Hi-Tech to bypass HOST name verification
			//*************************************************************/
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	start	*********************/
			// Hostname was found in DNS cache
			// Trying 23.61.80.184...
			// Connected to go.urbanairship.com (23.61.80.184) port 443 (#12)
			// SSL certificate problem: unable to get local issuer certificate
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	end	*********************/
			 curl_setopt($session, CURLOPT_VERBOSE, True);
			 curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
			 curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
			 //**********************************************************************************************************************************/
			 $content = curl_exec($session);
			 //echo "Response: " . $content . "\n";
			 
			 // Check if any error occured
			 $response = curl_getinfo($session);
			
			 if($response['http_code'] != 202) {
				
				 return false;
				 
			 } else {
			 
				return true;
				 
			 }
			 
			 curl_close($session);
		
		 }
		 else
		 {
			Yii::app()->user->setFlash("error", "Patient is not logged in to device.");
			$this->redirect(array("doctor/patientlist"));
		 }
	}
	
	
	function actioncancelAppointment()
	{
		$this->isLogin();
		$data = array();
		$data['status'] = 2;
		$data['notes'] = $_REQUEST['pagedcscription'];
		$data['patient_id'] = $_REQUEST['patient_id'];
		$data['patient_view'] = 0;
		$data['modified_at'] = date("Y-m-d H:i:s");
				
		$AppointmentObj = new Appointment();
		$AppointmentObj->setData($data);
		$AppointmentObj->insertData($_REQUEST['appointment_id']);
		$AppointmentObj = new Appointment();
		$appointmentData = $AppointmentObj->getAppointmentById($_REQUEST['appointment_id']);
		
		$appointmentData['message'] = "Your appointment have been cancelled on ".date('M d, Y',strtotime($appointmentData['modified_at'])).' with doctor '.Yii::app()->session['fullName'];
		$this->sendAppointmentNotification($appointmentData);
		
		Yii::app()->user->setFlash("success", "Appointment cancelled successfully.");
		$this->redirect(array("doctor/appointmentList"));
		
	}
	
	function actionsendPushNotificationForCopay()
	{

		$patientObj = new PatientMaster();
		$patientData = $patientObj->getUserById($_REQUEST['patient_id']);
         
        if(isset($patientData['session_id']) && $patientData['session_id'] != '')
		{
			
			$data['message'] = "Now you have to pay your co-pay amount."; 
			$data['date'] = date("Y-m-d H:i:s");
	
			 // create the extra field
			$extra = array();
	 
			 $contents = array();
			 $contents['badge'] = "+1";
			 $contents['alert'] = $data['message'];
			 $contents['sound'] = "cat.caf";
			
			 $notification = array();
			 $notification['ios'] = $contents;
			 $platform = array();
			 array_push($platform, "ios");
			 
			 $push = array("audience"=>array("device_token"=>$patientData['device_token']), "notification"=>$notification, "device_types"=>$platform);
			 
			 $json = json_encode($push);
			 //echo "Payload: " . $json . "\n"; //show the payload
			 
			 $session = curl_init(PUSHURL);
			 curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET);
			 curl_setopt($session, CURLOPT_POST, True);
			 curl_setopt($session, CURLOPT_POSTFIELDS, $json);
			 curl_setopt($session, CURLOPT_HEADER, False);
			 curl_setopt($session, CURLOPT_RETURNTRANSFER, True);
			 curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/vnd.urbanairship+json; version=3;'));
			 //*************************************************************/
			// Code addeed by Hi-Tech to bypass HOST name verification
			//*************************************************************/
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	start	*********************/
			// Hostname was found in DNS cache
			// Trying 23.61.80.184...
			// Connected to go.urbanairship.com (23.61.80.184) port 443 (#12)
			// SSL certificate problem: unable to get local issuer certificate
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	end	*********************/
			 curl_setopt($session, CURLOPT_VERBOSE, True);
			 curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
			 curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
			 //**********************************************************************************************************************************/
			 $content = curl_exec($session);
			 //echo "Response: " . $content . "\n";
			 
			 // Check if any error occured
			 $response = curl_getinfo($session);
			 if($response['http_code'] != 202) {
				
				 Yii::app()->user->setFlash("error", "Got negative response from server: " . $response['http_code'] . "\n");
				 $this->redirect(array("doctor/patientlist"));
				 
			 } else {
			 
				Yii::app()->user->setFlash("success", "Your Co-Pay Notification sent successfully.");
				$this->redirect(array("doctor/patientlist"));
				 
			 }
			 
			 curl_close($session);
		}
		else
		{
			Yii::app()->user->setFlash("error", "Patient is not logged in to device.");
			$this->redirect(array("doctor/patientlist"));
		}
		
	}
	
	
	function actionloadFormPatientReg()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'patient';
		Yii::app()->session['active_sub_tab'] = 'patient';
		
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById($_REQUEST['patient_id']);
		
		$PatientMedicalHistoryObj = new PatientMedicalHistory();
		$medicalData = $PatientMedicalHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
		$surgoryData = $PatientSurgeryHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);		
		
		$patientInfoQuestionnaire = new patientInfoQuestionnaire();
		$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId($_REQUEST['patient_id']);
		$this->render('New-Patient-Registration-Forms-content',array('patientInfo'=>$patientInfo,'medicalData'=>$medicalData,'surgoryData'=>$surgoryData,'patientData'=>$patientData));
	
			
	}
	
	
	function actionloadPatinetInfoQuestionnaire()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'patient';
		Yii::app()->session['active_sub_tab'] = 'patient';
		
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById($_REQUEST['patient_id']);
		
		$patientInfoQuestionnaire = new patientInfoQuestionnaire();
		$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$this->render("patient_information_questionnaire",array("patientData"=>$patientData, "patientInfo"=>$patientInfo));
	
			
	}
	
	public function actioneditAppointment()
	{
		
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'home';
		Yii::app()->session['active_sub_tab'] = 'appointment';
		if(isset($_POST['appointment_id']) && $_POST['appointment_id'] != '')
		{
			$data = array();
			$data['appointment_date'] = date('Y-m-d H:i:s',strtotime($_POST['appointment_date']));
			$data['appointment_time'] = $_POST['appointment_time'];
			$data['notes'] = $_POST['notes'];
			$data['patient_id'] = $_POST['patient_id'];
			$data['doctor_id'] = Yii::app()->session['pingmydoctor_doctor'];
			
			$Appointment = new Appointment();
			$Appointment->setData($data);
			$Appointment->insertData($_POST['appointment_id']);
			
			$data['message'] = "Your appointment is fixed on ".$data['appointment_date'].''.$data['appointment_time'].' with doctor '.Yii::app()->session['fullName'];
			
			$this->sendAppointmentNotification($data);
			
			
			Yii::app()->user->setFlash("success", "Appointment updated successfully.");
			$this->redirect(array("doctor/appointmentList"));
		}
		die;
	}
	
	function actionselectPatient()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '')
		{
			Yii::app()->session['selected_patient_id'] = $_REQUEST['patient_id'];
			Yii::app()->user->setFlash("success", "Patient selected successfully.");
			$this->redirect(array("doctor/patientList"));
		}
	}
	
	function actionunselectPatient()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '')
		{
			unset(Yii::app()->session['selected_patient_id'] );
			Yii::app()->user->setFlash("success", "Patient unselected successfully.");
			$this->redirect(array("doctor/patientList"));
		}
	}
	/**
	 * Added new action to collect list of Received Document forms with all patients.
	 * In case Doctor selected any of the Patient then UI will display received documents for that Patient only.
	 * 
	 * @author pratik.shah
	 * @since Oct 2015
	 */
	public function actiongetReceivedAllForms()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'receivedform';
		$DocumentSubmittedLogObj = new DocumentSubmittedLog();
		$PatientId = NULL;
		if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != '')
		{
			$PatientId = Yii::app()->session['selected_patient_id'];
		}
		$ReceivedDocumentData = $DocumentSubmittedLogObj->GetDocumentReceivedLogList(Yii::app()->session['pingmydoctor_doctor'], $PatientId);

		$this->render("receivedFormsListing",array('ReceivedDocumentData'=>$ReceivedDocumentData));
	}
	
	
	/**
	 * Added new action to notify patient in phone gap app and web module for received theire documents.
	 * 
	 * 
	 * @author vishal.panchal
	 * @since Oct 2015
	 */
	public function actionnotifyPatient()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'receivedform';
		
		$data = array();
		$data['notifyPatient'] = 1;
		$data['notifyDatetime'] = date("Y-m-d H:i:s");
		
		$DocumentSubmittedLogObj = new DocumentSubmittedLog();
		$DocumentSubmittedLogObj->setData($data);
		$DocumentSubmittedLogObj->insertData($_REQUEST['documentsubmittedlogid']);
		
		$doctorObj = new DoctorMaster();
		$doctorData = $doctorObj->getDoctorById(Yii::app()->session['pingmydoctor_doctor']);
		
		$message = $doctorData['name']." ".$doctorData['surname']. " recieved your submitted documents on ".date("F d, Y H:i:s");
		
		$patNot = array();
		$patNot['patient_id'] = $_REQUEST['patientID'];
		$patNot['doctor_id'] = Yii::app()->session['pingmydoctor_doctor'];
		$patNot['message'] = $message;
		$patNot['notification_type'] = 2;
		$patNot['createdAt'] = date("Y-m-d h:i A");
		
		$PatientNotificationObj = new PatientNotification();
		$PatientNotificationObj->setData($patNot);
		$PatientNotificationObj->insertData();
		
		
		$this->actionsendPushNotificationForNotifyPatient($_REQUEST['patientID'],$message);
		Yii::app()->user->setFlash("success", "Successfully notified to patient.");
		$this->redirect(array("doctor/getReceivedAllForms"));
	}
	
	/**
	 * Added new action to notify patient in phone gap app and web module for received theire documents.
	 * 
	 * 
	 * @author vishal.panchal
	 * @since Oct 2015
	 */
	function actionsendPushNotificationForNotifyPatient($patient_id=NULL,$message=NULL)
	{
		$patientObj = new PatientMaster();
		$patientData = $patientObj->getUserById($patient_id);
 		if(isset($patientData['session_id']) && $patientData['session_id'] != '')
		{
			$data['message'] = $message; 
			$data['date'] = date("Y-m-d H:i:s");
	
			 // create the extra field
			$extra = array();
	 
			 $contents = array();
			 $contents['badge'] = "+1";
			 $contents['alert'] = $data['message'];
			 $contents['sound'] = "cat.caf";
			
			 $notification = array();
			 $notification['ios'] = $contents;
			 $platform = array();
			 array_push($platform, "ios");
			 
			 $push = array("audience"=>array("device_token"=>$patientData['device_token']), "notification"=>$notification, "device_types"=>$platform);
			 
			 //print_r($push);
			 $json = json_encode($push);
			 //echo "Payload: " . $json . "\n"; //show the payload
			 $session = curl_init(PUSHURL);
			 curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET);
			 curl_setopt($session, CURLOPT_POST, True);
			 curl_setopt($session, CURLOPT_POSTFIELDS, $json);
			 curl_setopt($session, CURLOPT_HEADER, False);
			 curl_setopt($session, CURLOPT_RETURNTRANSFER, True);
			 curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/vnd.urbanairship+json; version=3;'));
			 //*************************************************************/
			// Code addeed by Hi-Tech to bypass HOST name verification
			//*************************************************************/
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	start	*********************/
			// Hostname was found in DNS cache
			// Trying 23.61.80.184...
			// Connected to go.urbanairship.com (23.61.80.184) port 443 (#12)
			// SSL certificate problem: unable to get local issuer certificate
			//*****************		Apache Error Log corrected using make CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER value 0	end	*********************/
			 curl_setopt($session, CURLOPT_VERBOSE, True);
			 curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
			 curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
			 //**********************************************************************************************************************************/
			 $content = curl_exec($session);
			 //echo "Response: " . $content . "\n";
			 
			 // Check if any error occured
			 $response = curl_getinfo($session);
			 //print "<pre>";
			 //print_r($response);die;
			 error_log(print_r($response,true),3,"response.txt");
			
			 if($response['http_code'] != 202) {
				
				return false;
				 
			 } else {
			 
				return true;
				 
			 }
			 
			 curl_close($session);
		}
		else
		{
			return false;
		}
		
		
	}
	
		
}