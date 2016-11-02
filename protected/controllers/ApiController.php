<?php

error_reporting(0);
set_time_limit(0);

require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");
//header("content-type: application/json");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Headers:x-requested-with, Content-Type, origin, authorization, accept, client-security-token");

require_once("protected/extensions/phpmailer/class.phpmailer.php");
class ApiController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public function actions()
	{
		
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	function beforeAction($action=NULL) 
	{
		if(Yii::app()->controller->action->id !="showLogs" && Yii::app()->controller->action->id !="clearLogs")
		{
		$fp = fopen('c2zoom.txt', 'a+');
		fwrite($fp, "\r\r\n<div style='background-color:#F2F2F2; color:#222279; font-weight: bold; padding:10px;box-shadow: 0 5px 2px rgba(0, 0, 0, 0.25);'>");
		fwrite($fp,"<b>Function Name</b> : <font size='6' style='color:orange;'><b><i>".Yii::app()->controller->action->id."</i></b></font>" );
		fwrite($fp, "\r\r\n\n");
		fwrite($fp, "<b>PARAMS</b> : " .print_r($_REQUEST,true));
		fwrite($fp, "\r\r\n");
		$link = "http://". $_SERVER['HTTP_HOST'].''.print_r($_SERVER['REQUEST_URI'],true)."";
		fwrite($fp, "<b>URL</b> :<a style='text-decoration:none;color:#4285F4' target='_blank' href='".$link."'> http://" . $_SERVER['HTTP_HOST'].''.print_r($_SERVER['REQUEST_URI'],true)."</a>");
		fwrite($fp, "</div>\r\r\n");
		fclose($fp);
		
		}
		return true;
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	*/
	public function actionIndex()
	{	
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->renderPartial('apilist');
		//$this->redirect(array("admin/index"));
	}
	
	public function actionpossibleErrors()
	{
		 $this->render('possibleErrorsList');
	}
	
	public function actionpatientLogin()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['email']) && $_REQUEST['email']!='' && isset($_REQUEST['password']) && $_REQUEST['password']!='')
		{
			$data=array();
			$data['email'] 	= $_REQUEST['email'];
			$data['password'] 	= $_REQUEST['password'];
			
			if(empty($_REQUEST['deviceToken']))
			{
				echo json_encode(array('status'=>'-3','message'=>'Device Token not passed.'));exit;
			}
			else
			{
				$deviceToken = $_REQUEST['deviceToken'];
			}
			
			
			$patientObj  =  new PatientMaster();
			$res = $patientObj->getUserDataByEmail($data['email']);
			
			if(!empty($res))
			{
				/*if($res['is_verified'] == "1")
				{*/
					$generalObj = new General();
					$validatePassword = $generalObj->validate_password($data['password'],$res['password']);
					
					if($validatePassword == true)
					{
						$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
												"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
												"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
						$session_id = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
						$session_id = $session_id.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
						$session_id = $session_id.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
						$patient['session_id'] = $session_id;
						$patient['device_token'] = $deviceToken;
						$patient['modified_at'] = date("Y-m-d:H-m-s");

						$patientObj = new PatientMaster();
						$patientObj->setData($patient);
						$patientObj->insertData($res['patient_id']);
						
						$patientObj = new PatientMaster();
						$patientData = $patientObj->getUserById($res['patient_id']);
						
						
						
						
						if(!empty($patientData) && $patientData!='')
						{
							$result['status'] = 1;
							$result['message'] = "success";
							$result['data'] = $patientData ;
							echo json_encode($result);
						}
						else
						{
							$result['status'] = 0;
							$result['message'] = "Data not Found.";
							echo json_encode($result);
						}
					}
					else
					{
						echo json_encode(array('status'=>'-5','message'=>'Invalid email or password.'));
					}	
				/*}
				else
				{
					echo json_encode(array('status'=>'-4','message'=>' Check your e-mail in order to verify your account. Remember to also check your junk folder.'));
				}*/
			}
			else
			{
				echo json_encode(array('status'=>'-3','message'=>'This e-mail is not registered. Please register before log in.'));
			}
		}
		else if(empty($_REQUEST['email']) && $_REQUEST['email'] == '')
		{
			echo json_encode(array('status'=>'-6','message'=>'Please enter Email.'));
			exit;
		}
		else if(empty($_REQUEST['password']) && $_REQUEST['password'] == '')
		{
			echo json_encode(array('status'=>'-6','message'=>'Please enter password.'));
			exit;
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>'permision Denied'));
		}
	}
	
	public function actionpatientLogout()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$patient['session_id'] = "";
				$patient['modified_at'] = date("Y-m-d:H-m-s");

				$patientObj = new PatientMaster();
				$patientObj->setData($patient);
				$patientObj->insertData($sessionData['patient_id']);
				
				echo json_encode(array('status'=>'1','message'=>'Successfully Logged Out.'));
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>'permision Denied'));
		}
	}
	
	public function actiongetProfileByPatientId()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				if(isset($_REQUEST['other_patient_id']) && $_REQUEST['other_patient_id'] != "")
				{
					$id = $_REQUEST['other_patient_id'] ;	
				}else{
					$id = $_REQUEST['patient_id'] ;
				}
				
				$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patientData = $patientInfoQuestionnaireObj->getdetailsByPatientId($id);
				
				if(isset($patientData['patient_image']) && $patientData['patient_image'] != '')
				{
					
						 if(isset($patientData['patient_image']))
						 {
							 $path = 'assets/upload/avatar/patient/'.$patientData['patient_image'];
							 
							 if (file_exists($path)) 
							{
								$fname = 'patient_'.$patientData['patient_id'].'.png';				
							}
							else
							{
								$fname = 'no_image.jpg';
							}
						 }
					 
					 $patientData['patient_image'] = $fname;
					
				}
				
				if(!empty($patientData))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $patientData ;
					
					echo json_encode($result);
				}else{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actionaddCholestrol()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['ldl']) && $_REQUEST['ldl']!='')
				{
					$data['ldl'] = $_REQUEST['ldl'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter ldl is not set.'));exit;
				}
				
				if(isset($_REQUEST['hdl']) && $_REQUEST['hdl']!='')
				{
					$data['hdl'] = $_REQUEST['hdl'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter hdl is not set.'));exit;
				}
				
				if(isset($_REQUEST['triglycerides']) && $_REQUEST['triglycerides']!='')
				{
					$data['triglycerides'] = $_REQUEST['triglycerides'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter triglycerides is not set.'));exit;		}
				
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter unit is not set.'));exit;
				}
				
				if(isset($_REQUEST['total']) && $_REQUEST['total']!='')
				{
					$data['total'] = $_REQUEST['total'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter total is not set.'));exit;				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter report_date is not set.'));exit;		}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				$CholesterolMeasurementObj = new CholesterolMeasurement();	
				$CholesterolMeasurementObj->attributes=$data;
				$transaction=Yii::app()->db->beginTransaction();
					
					try 
					{
						if($CholesterolMeasurementObj->save())
						{
							$transaction->commit();
							$cholesterol_id = $CholesterolMeasurementObj->cholesterol_id;
							
								if(!empty($cholesterol_id))
								{
									$cholesterol_data = $CholesterolMeasurementObj->getDetailsByCholesterolId($cholesterol_id);
									
									if(!empty($cholesterol_data))
									{
										$result['status'] = 1;
										$result['message'] = "success";
										$result['data'] = $cholesterol_data ;
										echo json_encode($result);
									}
									else
									{
										$result['status'] = 0;
										$result['message'] = "Data not found.";
										echo json_encode($result);
									}
								}
								
						}
						else
						{
							throw new Exception();
						}
					}
					catch(Exception $e) 
					{
    					$transaction->rollback();
						echo json_encode(array('status'=>'-7','message'=>' Error in insertion of cholesterol data.'));
					}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteCholestrol()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['cholesterol_id']) && $_REQUEST['cholesterol_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$CholesterolMeasurementObj = new CholesterolMeasurement();
				
					try
						{
							if($CholesterolMeasurementObj->deleteCholesterolByIds($_REQUEST['cholesterol_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Cholesterol data is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of cholesterol data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter cholesterol_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditCholestrol()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				if(isset($_REQUEST['cholesterol_id']) && $_REQUEST['cholesterol_id']!='')
				{
				
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['ldl']) && $_REQUEST['ldl']!='')
				{
					$data['ldl'] = $_REQUEST['ldl'];
				}
				if(isset($_REQUEST['hdl']) && $_REQUEST['hdl']!='')
				{
					$data['hdl'] = $_REQUEST['hdl'];
				}
				if(isset($_REQUEST['triglycerides']) && $_REQUEST['triglycerides']!='')
				{
					$data['triglycerides'] = $_REQUEST['triglycerides'];
				}
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				if(isset($_REQUEST['total']) && $_REQUEST['total']!='')
				{
					$data['total'] = $_REQUEST['total'];
				}
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				
				$data['modified_at'] = date("Y-m-d H:i:s");
				
				$transaction=Yii::app()->db->beginTransaction();
				
				$CholesterolMeasurementObj = CholesterolMeasurement::model()->findByAttributes(
					array('cholesterol_id'=>$_REQUEST['cholesterol_id'],'patient_id'=>$_REQUEST['patient_id']),
					'status=:status',
					array(':status'=>1)
				);
				
				if(!empty($CholesterolMeasurementObj) && $CholesterolMeasurementObj!='')
				{		
					try 
					{
						$CholesterolMeasurementObj->attributes=$data;
						
						if($CholesterolMeasurementObj->update())
						{
							$transaction->commit();
							$cholesterol_id = $CholesterolMeasurementObj->cholesterol_id;
							
								if(!empty($cholesterol_id))
								{
									$cholesterol_data = $CholesterolMeasurementObj->getDetailsByCholesterolId($cholesterol_id);
									if(!empty($cholesterol_data))
									{
										$result['status'] = 1;
										$result['message'] = "success";
										$result['data'] = $cholesterol_data ;
										echo json_encode($result);
									}
									else
									{
										$result['status'] = 0;
										$result['message'] = "Data not found.";
										echo json_encode($result);
									}
								}
						}
						else
						{	throw new Exception();
						}
				
					}
					catch(Exception $e) 
					{
						$transaction->rollback();
						echo json_encode(array('status'=>'-9','message'=>' Error in updation of cholesterol data.'));		
					}
				}
				else
				{	echo json_encode(array('status'=>'-10','message'=>' There is no record in the database with requested cholesterol_id.'));
				}
				
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' Required Parameter cholesterol_id is not set.'));				}
			}
			else
			{	echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{	echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioncholesterolList()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$CholesterolMeasurementObj = new CholesterolMeasurement();
				$cholesterolData = $CholesterolMeasurementObj->getAllCholesterolListByPatient($_REQUEST['patient_id']);
				
				if(!empty($cholesterolData))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $cholesterolData ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actiongetCholesterolById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if( isset($_REQUEST['cholesterol_id']) && $_REQUEST['cholesterol_id']!='' )
				{
					$CholesterolMeasurementObj = new CholesterolMeasurement();
					$cholesterolData = $CholesterolMeasurementObj->getCholesterolByIdAndPatient($_REQUEST['cholesterol_id'],$_REQUEST['patient_id']);
					
					if(!empty($cholesterolData))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $cholesterolData ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter cholesterol_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	///    Start blood glucose  
	public function actionblood_glucose_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$bloodGlucoseMeasurementObj = new BloodGlucoseMeasurement();
				$glucoseData = $bloodGlucoseMeasurementObj->getAllBloodGlucoselListByPatient($_REQUEST['patient_id']);
				
				if(!empty($glucoseData))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $glucoseData ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddBloodGlucose()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['blood_glucose_level']) && $_REQUEST['blood_glucose_level']!='')
				{
					$data['blood_glucose_level'] = $_REQUEST['blood_glucose_level'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter blood_glucose_level is not set.'));exit;
				}
				
				if(isset($_REQUEST['measurement_type']) && $_REQUEST['measurement_type']!='')
				{
					$data['measurement_type'] = $_REQUEST['measurement_type'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter hdl is not set.'));exit;
				}
				if(isset($_REQUEST['measurement_context_id']) && $_REQUEST['measurement_context_id']!='')
				{
					$data['measurement_context_id'] = $_REQUEST['measurement_context_id'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter measurement_context_id is not set.'));exit;
				}
				
				
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter unit is not set.'));exit;
				}
			
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter report_date is not set.'));exit;		
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				$BloodGlucoseMeasurementObj = new BloodGlucoseMeasurement();	
				$BloodGlucoseMeasurementObj->attributes=$data;
				
				$transaction=Yii::app()->db->beginTransaction();
					
				try 
				{
					if($BloodGlucoseMeasurementObj->save())
					{
						$transaction->commit();
						$blood_glucose_id = $BloodGlucoseMeasurementObj->blood_glucose_id;
					
							if(!empty($blood_glucose_id))
							{
								$glucose_data = $BloodGlucoseMeasurementObj->getDetailsByBloodGlucoseId($blood_glucose_id);
								
								if(!empty($glucose_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $glucose_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
							
					}
					else
					{
						throw new Exception();
					}
				}
				catch(Exception $e) 
				{
					$transaction->rollback();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Blood Glucose data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditBloodGlucose()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['blood_glucose_level']) && $_REQUEST['blood_glucose_level']!='')
				{
					$data['blood_glucose_level'] = $_REQUEST['blood_glucose_level'];
				}
				
				
				if(isset($_REQUEST['measurement_type']) && $_REQUEST['measurement_type']!='')
				{
					$data['measurement_type'] = $_REQUEST['measurement_type'];
				}
			
				if(isset($_REQUEST['measurement_context_id']) && $_REQUEST['measurement_context_id']!='')
				{
					$data['measurement_context_id'] = $_REQUEST['measurement_context_id'];
				}
				
				
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['blood_glucose_id'] = $_REQUEST['blood_glucose_id'];
				
			  try 
				{
					
					$BloodGlucoseMeasurementObj = new BloodGlucoseMeasurement();
					$is_data = $BloodGlucoseMeasurementObj->getDetailsByBloodGlucoseId($_REQUEST['blood_glucose_id']);
					///print_r($is_data); die;
					if(!empty($is_data))
					{
						$BloodGlucoseMeasurementObj = new BloodGlucoseMeasurement();
						$BloodGlucoseMeasurementObj->setData($data);	
						$BloodGlucoseMeasurementObj->insertData($_REQUEST['blood_glucose_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$glucose_data = $BloodGlucoseMeasurementObj->getAllBloodGlucoselListByPatient($data['patient_id']);
							
								if(!empty($glucose_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated successfully.";
									$result['data'] = $glucose_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							
							
					
				}
				catch(Exception $e) 
				{
					$transaction->rollback();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Blood Glucose data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteBloodGlucose()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['blood_glucose_id']) && $_REQUEST['blood_glucose_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$BloodGlucoseMeasurementObj = new BloodGlucoseMeasurement();
				
					try
						{
							if($BloodGlucoseMeasurementObj->deletebloodglucoseByIds($_REQUEST['blood_glucose_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Blood Glucose data is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Blood Glucose data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter blood_glucose_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiongetbloodglucoseById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['blood_glucose_id']) && $_REQUEST['blood_glucose_id']!='' )
				{
					$BloodGlucoseMeasurementObj = new BloodGlucoseMeasurement();
					$glucose_data = $BloodGlucoseMeasurementObj->getDetailsByBloodGlucoseId($_REQUEST['blood_glucose_id']);
					
					if(!empty($glucose_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $glucose_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter blood_glucose_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	// end blood glucose
	
	//start blood_pressure
	
	public function actionblood_pressure_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$BloodPressureMeasurementObj = new BloodPressureMeasurement();
				$blood_pressureData = $BloodPressureMeasurementObj->getAllBloodPressureListByPatient($_REQUEST['patient_id']);
				
				if(!empty($blood_pressureData))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $blood_pressureData ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddBloodPressure()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['systolic']) && $_REQUEST['systolic']!='')
				{
					$data['systolic'] = $_REQUEST['systolic'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter systolic is not set.'));exit;
				}
				
				if(isset($_REQUEST['diastolic']) && $_REQUEST['diastolic']!='')
				{
					$data['diastolic'] = $_REQUEST['diastolic'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter diastolic is not set.'));exit;
				}
				if(isset($_REQUEST['pulse']) && $_REQUEST['pulse']!='')
				{
					$data['pulse'] = $_REQUEST['pulse'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter pulse is not set.'));exit;
				}
				
				
				if(isset($_REQUEST['irr_heartbeat']) && $_REQUEST['irr_heartbeat']!='')
				{
					$data['irr_heartbeat'] = $_REQUEST['irr_heartbeat'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter irr_heartbeat is not set.'));exit;
				}
			
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter when is not set.'));exit;		
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				$BloodPressureMeasurementObj = new BloodPressureMeasurement();	
				$BloodPressureMeasurementObj->attributes=$data;
				
				
					
				try 
				{
					if($BloodPressureMeasurementObj->save())
					{
						
						$blood_pressure_id = $BloodPressureMeasurementObj->blood_pressure_id;
					
							if(!empty($blood_pressure_id))
							{
								$pressure_data = $BloodPressureMeasurementObj->getDetailsByBloodPressureId($blood_pressure_id);
								
								if(!empty($pressure_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $pressure_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
							
					}
					else
					{
						throw new Exception();
					}
				}
				catch(Exception $e) 
				{
					
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Blood Pressure data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditBloodPressure()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['systolic']) && $_REQUEST['systolic']!='')
				{
					$data['systolic'] = $_REQUEST['systolic'];
				}
				
				
				if(isset($_REQUEST['diastolic']) && $_REQUEST['diastolic']!='')
				{
					$data['diastolic'] = $_REQUEST['diastolic'];
				}
			
				if(isset($_REQUEST['pulse']) && $_REQUEST['pulse']!='')
				{
					$data['pulse'] = $_REQUEST['pulse'];
				}
				
				
				if(isset($_REQUEST['irr_heartbeat']) && $_REQUEST['irr_heartbeat']!='')
				{
					$data['irr_heartbeat'] = $_REQUEST['irr_heartbeat'];
				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['blood_pressure_id'] = $_REQUEST['blood_pressure_id'];
				
			  try 
				{
					
					$BloodPressureMeasurementObj = new BloodPressureMeasurement();
					$is_data = $BloodPressureMeasurementObj->getDetailsByBloodPressureId($_REQUEST['blood_pressure_id']);
					///print_r($is_data); die;
					if(!empty($is_data))
					{
						$BloodPressureMeasurementObj = new BloodPressureMeasurement();
						$BloodPressureMeasurementObj->setData($data);	
						$BloodPressureMeasurementObj->insertData($_REQUEST['blood_pressure_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$glucose_data = $BloodPressureMeasurementObj->getAllBloodPressureListByPatient($data['patient_id']);
							
								if(!empty($glucose_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $glucose_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							
							
					
				}
				catch(Exception $e) 
				{
					$transaction->rollback();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Blood Pressure data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}	
	
	
	public function actiondeleteBloodPressure()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['blood_pressure_id']) && $_REQUEST['blood_pressure_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$BloodPressureMeasurementObj = new BloodPressureMeasurement();
				
					try
						{
							if($BloodPressureMeasurementObj->deletebloodpressureByIds($_REQUEST['blood_pressure_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Blood Pressure data is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Blood Pressure data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter blood_pressure_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiongetbloodpressureById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['blood_pressure_id']) && $_REQUEST['blood_pressure_id']!='' )
				{
					$BloodPressureMeasurementObj = new BloodPressureMeasurement();
					$glucose_data = $BloodPressureMeasurementObj->getDetailsByBloodPressureId($_REQUEST['blood_pressure_id']);
					
					if(!empty($glucose_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $glucose_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter blood_pressure_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	
	//end blood pressure
	
	
	
	
	
	//start height
	
	public function actionheight_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$HeightMeasurementObj = new HeightMeasurement();
				$height_Data = $HeightMeasurementObj->getAllHeightListByPatient($_REQUEST['patient_id']);
				
				if(!empty($height_Data))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $height_Data ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddHeight()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['height_value']) && $_REQUEST['height_value']!='')
				{
					$data['height_value'] = $_REQUEST['height_value'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter height is not set.'));exit;
				}
				
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter unit is not set.'));exit;
				}
				if(isset($_REQUEST['sub_height']) && $_REQUEST['sub_height']!='')
				{
					$data['sub_height'] = $_REQUEST['sub_height'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter height is not set.'));exit;
				}
				if(isset($_REQUEST['sub_height_unit']) && $_REQUEST['sub_height_unit']!='')
				{
					$data['sub_height_unit'] = $_REQUEST['sub_height_unit'];
				}
				
				
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter when is not set.'));exit;		
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				//print_r($data);//die;
				$HeightMeasurementObj = new HeightMeasurement();	
				$HeightMeasurementObj->setData($data);
				$id = $HeightMeasurementObj->insertData();
				
				try 
				{
						
							if(!empty($id))
							{
								$height_data = $HeightMeasurementObj->getDetailsByHeightId($id);
								
								if(!empty($height_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $height_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
					
				}
				catch(Exception $e) 
				{
					//echo $e->getMessage();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Height data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditHeight()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['height_value']) && $_REQUEST['height_value']!='')
				{
					$data['height_value'] = $_REQUEST['height_value'];
				}
				
				
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				
				if(isset($_REQUEST['sub_height']) && $_REQUEST['sub_height']!='')
				{
					$data['sub_height'] = $_REQUEST['sub_height'];
				}
				
				if(isset($_REQUEST['sub_height_unit']) && $_REQUEST['sub_height_unit']!='')
				{
					$data['sub_height_unit'] = $_REQUEST['sub_height_unit'];
				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['height_id'] = $_REQUEST['height_id'];
				
			  try 
				{
					
					$HeightMeasurementObj = new HeightMeasurement();
					$is_data = $HeightMeasurementObj->getDetailsByHeightId($_REQUEST['height_id']);
					///print_r($is_data); die;
					if(!empty($is_data))
					{
						$HeightMeasurementObj = new HeightMeasurement();
						$HeightMeasurementObj->setData($data);	
						$HeightMeasurementObj->insertData($_REQUEST['height_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$height_data = $HeightMeasurementObj->getAllHeightListByPatient($data['patient_id']);
							
								if(!empty($height_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $height_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							
							
					
				}
				catch(Exception $e) 
				{
					$transaction->rollback();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Height details.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteHeight()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['height_id']) && $_REQUEST['height_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$HeightMeasurementObj = new HeightMeasurement();
				
					try
						{
							if($HeightMeasurementObj->deleteheightByIds($_REQUEST['height_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Height detail is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Height details data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter height_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}	
	
	public function actiongetHeightById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['height_id']) && $_REQUEST['height_id']!='' )
				{
					$HeightMeasurementObj = new HeightMeasurement();
					$height_data = $HeightMeasurementObj->getDetailsByHeightId($_REQUEST['height_id']);
					
					if(!empty($height_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $height_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter height_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	
	//end height
	
	//start weight
	
	public function actionweight_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$WeightMeasurementObj = new WeightMeasurement();
				$weight_Data = $WeightMeasurementObj->getAllWeightListByPatient($_REQUEST['patient_id']);
				
				if(!empty($weight_Data))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $weight_Data ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddWeight()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['weight_value']) && $_REQUEST['weight_value']!='')
				{
					$data['weight_value'] = $_REQUEST['weight_value'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter Weight is not set.'));exit;
				}
				
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter unit is not set.'));exit;
				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter when is not set.'));exit;		
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				//print_r($data);//die;
				$WeightMeasurementObj = new WeightMeasurement();	
				$WeightMeasurementObj->setData($data);
				$id = $WeightMeasurementObj->insertData();
				
				try 
				{
						
							if(!empty($id))
							{
								$weight_data = $WeightMeasurementObj->getDetailsByWeightId($id);
								
								if(!empty($weight_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $weight_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
					
				}
				catch(Exception $e) 
				{
					//echo $e->getMessage();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Height data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditWeight()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['weight_value']) && $_REQUEST['weight_value']!='')
				{
					$data['weight_value'] = $_REQUEST['weight_value'];
				}
				if(isset($_REQUEST['unit']) && $_REQUEST['unit']!='')
				{
					$data['unit'] = $_REQUEST['unit'];
				}
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['weight_id'] = $_REQUEST['weight_id'];
				
			  try 
				{
					
					$WeightMeasurementObj = new WeightMeasurement();	
					$is_data = $WeightMeasurementObj->getDetailsByWeightId($_REQUEST['weight_id']);
					///print_r($is_data); die;
					if(!empty($is_data))
					{
						$WeightMeasurementObj = new WeightMeasurement();
						$WeightMeasurementObj->setData($data);	
						$WeightMeasurementObj->insertData($_REQUEST['weight_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$weight_data = $WeightMeasurementObj->getAllWeightListByPatient($data['patient_id']);
							
								if(!empty($weight_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $weight_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							
							
					
				}
				catch(Exception $e) 
				{
					$transaction->rollback();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Weight details.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteWeight()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['weight_id']) && $_REQUEST['weight_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$WeightMeasurementObj = new WeightMeasurement();
				
					try
						{
							if($WeightMeasurementObj->deleteweightByIds($_REQUEST['weight_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Weight detail is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Weight details data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter Weight_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}	
	
	public function actiongetWeightById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['weight_id']) && $_REQUEST['weight_id']!='' )
				{
					$WeightMeasurementObj = new WeightMeasurement();
					$weight_data = $WeightMeasurementObj->getDetailsByWeightId($_REQUEST['weight_id']);
					
					if(!empty($weight_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $weight_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter weight_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	//end weight
	
	
	//start allergy
	
	public function actionallergy_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$AllergyHealthHistoryObj = new AllergyHealthHistory();
				$allergy_Data = $AllergyHealthHistoryObj->getAllergyHealthHistoryListByPatient($_REQUEST['patient_id']);
				
				if(!empty($allergy_Data))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $allergy_Data ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddAllergy()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['allergy_name']) && $_REQUEST['allergy_name']!='')
				{
					$data['allergy_name'] = $_REQUEST['allergy_name'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter Allergy Name is not set.'));exit;
				}
				
				if(isset($_REQUEST['allergy_master_id']) && $_REQUEST['allergy_master_id']!='')
				{
					$data['allergy_master_id'] = $_REQUEST['allergy_master_id'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter Allergen Type is not set.'));exit;
				}
				
				if(isset($_REQUEST['reaction']) && $_REQUEST['reaction']!='')
				{
					$data['reaction'] = $_REQUEST['reaction'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter reaction is not set.'));exit;		
				}
				if(isset($_REQUEST['first_observed']) && $_REQUEST['first_observed']!='')
				{
					$data['first_observed'] = date("Y-m-d",strtotime($_REQUEST['first_observed']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter First Observed is not set.'));exit;		
				}
				if(isset($_REQUEST['treatment']) && $_REQUEST['treatment']!='')
				{
					$data['treatment'] = $_REQUEST['treatment'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter Treatment is not set.'));exit;		
				}
				
				
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				//print_r($data);//die;
				$AllergyHealthHistoryObj = new AllergyHealthHistory();
				$AllergyHealthHistoryObj->setData($data);
				$id = $AllergyHealthHistoryObj->insertData();
				
				try 
				{
						
							if(!empty($id))
							{
								$allergy_data = $AllergyHealthHistoryObj->getDetailsByAllergyId($id);
								
								if(!empty($allergy_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $allergy_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
					
				}
				catch(Exception $e) 
				{
					//echo $e->getMessage();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Allergy data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditAllergy()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['allergy_name']) && $_REQUEST['allergy_name']!='')
				{
					$data['allergy_name'] = $_REQUEST['allergy_name'];
				}
				if(isset($_REQUEST['allergy_master_id']) && $_REQUEST['allergy_master_id']!='')
				{
					$data['allergy_master_id'] = $_REQUEST['allergy_master_id'];
				}
				if(isset($_REQUEST['reaction']) && $_REQUEST['reaction']!='')
				{
					$data['reaction'] = $_REQUEST['reaction'];
				}
				if(isset($_REQUEST['first_observed']) && $_REQUEST['first_observed']!='')
				{
					$data['first_observed'] = date("Y-m-d",strtotime($_REQUEST['first_observed']));
				}
				if(isset($_REQUEST['treatment']) && $_REQUEST['treatment']!='')
				{
					$data['treatment'] = $_REQUEST['treatment'];
				}
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['allergy_id'] = $_REQUEST['allergy_id'];
				
			  try 
				{
					
					$AllergyHealthHistoryObj = new AllergyHealthHistory();
					$is_data = $AllergyHealthHistoryObj->getDetailsByAllergyId($_REQUEST['allergy_id']);
					///print_r($is_data); die;
					if(!empty($is_data))
					{
						$AllergyHealthHistoryObj = new AllergyHealthHistory();
						$AllergyHealthHistoryObj->setData($data);	
						$AllergyHealthHistoryObj->insertData($_REQUEST['allergy_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$allergy_data = $AllergyHealthHistoryObj->getAllergyHealthHistoryListByPatient($data['patient_id']);
							
								if(!empty($allergy_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $allergy_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							
							
					
				}
				catch(Exception $e) 
				{
					$transaction->rollback();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Allergy details.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteAllergy()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['allergy_id']) && $_REQUEST['allergy_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$AllergyHealthHistoryObj = new AllergyHealthHistory();
				
					try
						{
							if($AllergyHealthHistoryObj->deleteallergyByIds($_REQUEST['allergy_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Allergy detail is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Allergy details data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter allergy_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}	
	
	public function actiongetAllergyById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['allergy_id']) && $_REQUEST['allergy_id']!='' )
				{
					$AllergyHealthHistoryObj = new AllergyHealthHistory();
					$allergy_data = $AllergyHealthHistoryObj->getDetailsByAllergyId($_REQUEST['allergy_id']);
					
					if(!empty($allergy_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $allergy_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter allergy_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	function actionget_allergen()
	{
		$AllergyMasterObj = new AllergyMaster();
		$data = $AllergyMasterObj->getAllergyList();
		
		$result["status"] = "1";
		$result["message"] = "success";
		$result["data"] = $data ;
		echo json_encode($result);
	}
	
	// end allergy
	
	
	//start medication
	
	public function actionmadication_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$MedicationHealthHistoryObj = new MedicationHealthHistory();
				$medication_Data = $MedicationHealthHistoryObj->getMedicationListByPatient($_REQUEST['patient_id']);
				
				if(!empty($medication_Data))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $medication_Data ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddmedication()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['medication_name']) && $_REQUEST['medication_name']!='')
				{
					$data['medication_name'] = $_REQUEST['medication_name'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter Medication Name is not set.'));exit;
				}
				
				if(isset($_REQUEST['how_often_taken']) && $_REQUEST['how_often_taken']!='')
				{
					$data['how_often_taken'] = $_REQUEST['how_often_taken'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter How often taken is not set.'));exit;
				}
				
				if(isset($_REQUEST['dose']) && $_REQUEST['dose']!='')
				{
					$data['dose'] = $_REQUEST['dose'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter dose is not set.'));exit;		
				}
				
				if(isset($_REQUEST['when_started']) && $_REQUEST['when_started']!='')
				{
					$data['when_started'] = date("Y-m-d",strtotime($_REQUEST['when_started']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter when started is not set.'));exit;		
				}
				
				if(isset($_REQUEST['when_stopped']) && $_REQUEST['when_stopped']!='')
				{
					$data['when_stopped'] = date("Y-m-d",strtotime($_REQUEST['when_stopped']));
				}
				
				if(isset($_REQUEST['dose_unit']) && $_REQUEST['dose_unit']!='')
				{
					$data['dose_unit'] = $_REQUEST['dose_unit'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter Dose Unit is not set.'));exit;		
				}
				if(isset($_REQUEST['strength']) && $_REQUEST['strength']!='')
				{
					$data['strength'] = $_REQUEST['strength'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter strength is not set.'));exit;		
				}
				if(isset($_REQUEST['strength_unit']) && $_REQUEST['strength_unit']!='')
				{
					$data['strength_unit'] = $_REQUEST['strength_unit'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter strength Unit is not set.'));exit;		
				}
				if(isset($_REQUEST['how_taken']) && $_REQUEST['how_taken']!='')
				{
					$data['how_taken'] = $_REQUEST['how_taken'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter how taken is not set.'));exit;		
				}
				if(isset($_REQUEST['reason']) && $_REQUEST['reason']!='')
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter reason is not set.'));exit;		
				}
				if(isset($_REQUEST['is_prescribed']) && $_REQUEST['is_prescribed']!='')
				{
					$data['is_prescribed'] = $_REQUEST['is_prescribed'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter is_prescribed is not set.'));exit;		
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				//print_r($data);die;
				$MedicationHealthHistoryObj = new MedicationHealthHistory();
				$MedicationHealthHistoryObj->setData($data);
				$id = $MedicationHealthHistoryObj->insertData();
				
				try 
				{
						
							if(!empty($id))
							{
								$medication_data = $MedicationHealthHistoryObj->getDetailsByMedicationId($id);
								
								if(!empty($medication_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $medication_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
					
				}
				catch(Exception $e) 
				{
					//echo $e->getMessage();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Medication data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditMedication()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['medication_name']) && $_REQUEST['medication_name']!='')
				{
					$data['medication_name'] = $_REQUEST['medication_name'];
				}
				
				if(isset($_REQUEST['how_often_taken']) && $_REQUEST['how_often_taken']!='')
				{
					$data['how_often_taken'] = $_REQUEST['how_often_taken'];
				}
								
				if(isset($_REQUEST['dose']) && $_REQUEST['dose']!='')
				{
					$data['dose'] = $_REQUEST['dose'];
				}
							
				if(isset($_REQUEST['when_started']) && $_REQUEST['when_started']!='')
				{
					$data['when_started'] = date("Y-m-d",strtotime($_REQUEST['when_started']));
				}
				
				if(isset($_REQUEST['when_stopped']) && $_REQUEST['when_stopped']!='')
				{
					$data['when_stopped'] = date("Y-m-d",strtotime($_REQUEST['when_stopped']));
				}
				
				if(isset($_REQUEST['dose_unit']) && $_REQUEST['dose_unit']!='')
				{
					$data['dose_unit'] = $_REQUEST['dose_unit'];
				}
				
				if(isset($_REQUEST['strength']) && $_REQUEST['strength']!='')
				{
					$data['strength'] = $_REQUEST['strength'];
				}
				
				if(isset($_REQUEST['strength_unit']) && $_REQUEST['strength_unit']!='')
				{
					$data['strength_unit'] = $_REQUEST['strength_unit'];
				}
				
				if(isset($_REQUEST['how_taken']) && $_REQUEST['how_taken']!='')
				{
					$data['how_taken'] = $_REQUEST['how_taken'];
				}
				
				if(isset($_REQUEST['reason']) && $_REQUEST['reason']!='')
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				
				if(isset($_REQUEST['is_prescribed']) && $_REQUEST['is_prescribed']!='')
				{
					$data['is_prescribed'] = $_REQUEST['is_prescribed'];
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['medication_id'] = $_REQUEST['medication_id'];
				//print_r($data); die;
				
			  try 
				{
					
					$MedicationHealthHistoryObj = new MedicationHealthHistory();
					$is_data = $MedicationHealthHistoryObj->getDetailsByMedicationId($_REQUEST['medication_id']);
					///print_r($is_data); die;
					if(!empty($is_data))
					{
						$MedicationHealthHistoryObj = new MedicationHealthHistory();
						$MedicationHealthHistoryObj->setData($data);	
						$MedicationHealthHistoryObj->insertData($_REQUEST['medication_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$medication_data = $MedicationHealthHistoryObj->getMedicationListByPatient($data['patient_id']);
							
								if(!empty($medication_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $medication_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
						
				}
				catch(Exception $e) 
				{
					
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Medication details.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteMedication()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['medication_id']) && $_REQUEST['medication_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$MedicationHealthHistoryObj = new MedicationHealthHistory();
				
					try
						{
							if($MedicationHealthHistoryObj->deletemedicationByIds($_REQUEST['medication_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Medication detail is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Medication details data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter medication_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiongetMedicationById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['medication_id']) && $_REQUEST['medication_id']!='' )
				{
					$MedicationHealthHistoryObj = new MedicationHealthHistory();
					$medication_data = $MedicationHealthHistoryObj->getDetailsByMedicationId($_REQUEST['medication_id']);
					
					if(!empty($medication_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $medication_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter medication_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	
	// end medication
	
	
	//start immunization
	
	public function actionimmunization_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$ImmunizationHealthHistoryObj = new ImmunizationHealthHistory();
				$immunization_Data = $ImmunizationHealthHistoryObj->getImmunizationHealthHistoryListByPatient($_REQUEST['patient_id']);
				
				if(!empty($immunization_Data))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $immunization_Data ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddimmunization()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['type']) && $_REQUEST['type']!='')
				{
					$data['type'] = $_REQUEST['type'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter type is not set.'));exit;
				}
				
				if(isset($_REQUEST['reason']) && $_REQUEST['reason']!='')
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter reason is not set.'));exit;
				}
				
				if(isset($_REQUEST['facility']) && $_REQUEST['facility']!='')
				{
					$data['facility'] = $_REQUEST['facility'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter facility is not set.'));exit;		
				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter report date is not set.'));exit;		
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				//print_r($data);die;
				$ImmunizationHealthHistoryObj = new ImmunizationHealthHistory();
				$ImmunizationHealthHistoryObj->setData($data);
				$id = $ImmunizationHealthHistoryObj->insertData();
				
				try 
				{
						
							if(!empty($id))
							{
								$immunization_data = $ImmunizationHealthHistoryObj->getDetailsByImmunizationId($id);
								
								if(!empty($immunization_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $immunization_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
					
				}
				catch(Exception $e) 
				{
					//echo $e->getMessage();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Immunization data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditImmunization()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['type']) && $_REQUEST['type']!='')
				{
					$data['type'] = $_REQUEST['type'];
				}
							
				if(isset($_REQUEST['reason']) && $_REQUEST['reason']!='')
				{
					$data['reason'] = $_REQUEST['reason'];
				}
				
				if(isset($_REQUEST['facility']) && $_REQUEST['facility']!='')
				{
					$data['facility'] = $_REQUEST['facility'];
				}
			
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['immunization_id'] = $_REQUEST['immunization_id'];
				//print_r($data); die;
				
			  try 
				{
					
					$ImmunizationHealthHistoryObj = new ImmunizationHealthHistory();
					$is_data = $ImmunizationHealthHistoryObj->getDetailsByImmunizationId($_REQUEST['immunization_id']);
					///print_r($is_data); die;
					if(!empty($is_data))
					{
						$ImmunizationHealthHistoryObj = new ImmunizationHealthHistory();
						$ImmunizationHealthHistoryObj->setData($data);	
						$ImmunizationHealthHistoryObj->insertData($_REQUEST['immunization_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$immunization_data = $ImmunizationHealthHistoryObj->getImmunizationHealthHistoryListByPatient($data['patient_id']);
							
								if(!empty($immunization_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $immunization_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
						
				}
				catch(Exception $e) 
				{
					
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Immunization details.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteImmunization()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['immunization_id']) && $_REQUEST['immunization_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$ImmunizationHealthHistoryObj = new ImmunizationHealthHistory();
				
					try
						{
							if($ImmunizationHealthHistoryObj->deleteimmunizationByIds($_REQUEST['immunization_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Medication detail is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Immunization details data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter immunization_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiongetImmunizationById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['immunization_id']) && $_REQUEST['immunization_id']!='' )
				{
					$ImmunizationHealthHistoryObj = new ImmunizationHealthHistory();
					$immunization_data = $ImmunizationHealthHistoryObj->getDetailsByImmunizationId($_REQUEST['immunization_id']);
					
					if(!empty($immunization_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $immunization_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter immunization_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	
	// end immunization
	
	//start Procedure
	
	public function actionprocedure_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$ProcedureHealthHistoryObj = new ProcedureHealthHistory();
				$procedure_Data = $ProcedureHealthHistoryObj->getProcedureListByPatient($_REQUEST['patient_id']);
				
				if(!empty($procedure_Data))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $procedure_Data ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddprocedure()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
				{
					$data['name'] = $_REQUEST['name'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter name is not set.'));exit;
				}
				
				if(isset($_REQUEST['body_location']) && $_REQUEST['body_location']!='')
				{
					$data['body_location'] = $_REQUEST['body_location'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter body location is not set.'));exit;
				}
				
				if(isset($_REQUEST['provider']) && $_REQUEST['provider']!='')
				{
					$data['provider'] = $_REQUEST['provider'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter provider is not set.'));exit;		
				}
				
				if(isset($_REQUEST['when_performed']) && $_REQUEST['when_performed']!='')
				{
					$data['when_performed'] = date("Y-m-d",strtotime($_REQUEST['when_performed']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter report date is not set.'));exit;		
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				//print_r($data);die;
				$ProcedureHealthHistoryObj = new ProcedureHealthHistory();
				$ProcedureHealthHistoryObj->setData($data);
				$id = $ProcedureHealthHistoryObj->insertData();
				
				try 
				{
						
							if(!empty($id))
							{
								$procedure_data = $ProcedureHealthHistoryObj->getDetailsByProcedureId($id);
								
								if(!empty($procedure_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $procedure_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
					
				}
				catch(Exception $e) 
				{
					//echo $e->getMessage();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Procedure data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditProcedure()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				
				if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
				{
					$data['name'] = $_REQUEST['name'];
				}
				if(isset($_REQUEST['body_location']) && $_REQUEST['body_location']!='')
				{
					$data['body_location'] = $_REQUEST['body_location'];
				}
				
				if(isset($_REQUEST['provider']) && $_REQUEST['provider']!='')
				{
					$data['provider'] = $_REQUEST['provider'];
				}
				
				if(isset($_REQUEST['when_performed']) && $_REQUEST['when_performed']!='')
				{
					$data['when_performed'] = date("Y-m-d",strtotime($_REQUEST['when_performed']));
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['procedure_id'] = $_REQUEST['procedure_id'];
				//print_r($data); die;
				
			  try 
				{
					
					$ProcedureHealthHistoryObj = new ProcedureHealthHistory();
					$is_data = $ProcedureHealthHistoryObj->getDetailsByProcedureId($_REQUEST['procedure_id']);
				
					if(!empty($is_data))
					{
						$ProcedureHealthHistoryObj = new ProcedureHealthHistory();
						$ProcedureHealthHistoryObj->setData($data);	
						$ProcedureHealthHistoryObj->insertData($_REQUEST['procedure_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$procedure_data = $ProcedureHealthHistoryObj->getProcedureListByPatient($data['patient_id']);
							
								if(!empty($procedure_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $procedure_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
						
				}
				catch(Exception $e) 
				{
					
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Procedure details.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteProcedure()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['procedure_id']) && $_REQUEST['procedure_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$ProcedureHealthHistoryObj = new ProcedureHealthHistory();
				
					try
						{
							if($ProcedureHealthHistoryObj->deleteprocedureByIds($_REQUEST['procedure_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Procedure detail is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Procedure details data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter procedure_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiongetProcedureById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['procedure_id']) && $_REQUEST['procedure_id']!='' )
				{
					$ProcedureHealthHistoryObj = new ProcedureHealthHistory();
					$procedure_data = $ProcedureHealthHistoryObj->getDetailsByProcedureId($_REQUEST['procedure_id']);
					
					if(!empty($procedure_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $procedure_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter procedure_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	// end procedures
	
	//start patient anethesia
	
	public function actionanethesia_List()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				$PatientAnethesiaHistoryObj = new PatientAnethesiaHistory();
				$anethesia_Data = $PatientAnethesiaHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
				
				if(!empty($anethesia_Data))
				{
					$result["status"] = "1";
					$result["message"] = "success";
					$result["data"] = $anethesia_Data ;
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	public function actionaddAnethesia()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_REQUEST['anethesia_type']) && $_REQUEST['anethesia_type']!='')
				{
					$data['anethesia_type'] = $_REQUEST['anethesia_type'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter anethesia type is not set.'));exit;
				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter report date location is not set.'));exit;
				}
				
				if(isset($_REQUEST['reaction']) && $_REQUEST['reaction']!='')
				{
					$data['reaction'] = $_REQUEST['reaction'];
				}
				else
				{	echo json_encode(array('status'=>'-6','message'=>' The required Parameter reaction is not set.'));exit;		
				}
				
				
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				//print_r($data);die;
				$PatientAnethesiaHistoryObj = new PatientAnethesiaHistory();
				$PatientAnethesiaHistoryObj->setData($data);
				$id = $PatientAnethesiaHistoryObj->insertData();
				
				try 
				{
						
							if(!empty($id))
							{
								$anethesia_data = $PatientAnethesiaHistoryObj->getdetailsByanethesiaId($id);
								
								if(!empty($anethesia_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Saved successfully.";
									$result['data'] = $anethesia_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
							}
					
				}
				catch(Exception $e) 
				{
					//echo $e->getMessage();
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Anethesia data.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actioneditAnehtesia()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				
				if(isset($_REQUEST['anethesia_type']) && $_REQUEST['anethesia_type']!='')
				{
					$data['anethesia_type'] = $_REQUEST['anethesia_type'];
				}
				
				if(isset($_REQUEST['report_date']) && $_REQUEST['report_date']!='')
				{
					$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['report_date']));
				}
				
				if(isset($_REQUEST['reaction']) && $_REQUEST['reaction']!='')
				{
					$data['reaction'] = $_REQUEST['reaction'];
				}
				
				if(isset($_REQUEST['notes']) && $_REQUEST['notes']!='')
				{
					$data['notes'] = $_REQUEST['notes'];
				}
				
				$data['status'] = 1;
				$data['modified_at'] = date("Y-m-d H:i:s");
				$data['patient_anethesia_id'] = $_REQUEST['patient_anethesia_id'];
				//print_r($data); die;
				
			  try 
				{
					
					$PatientAnethesiaHistoryObj = new PatientAnethesiaHistory();
					$is_data = $PatientAnethesiaHistoryObj->getdetailsByanethesiaId($_REQUEST['patient_anethesia_id']);
				
					if(!empty($is_data))
					{
						$PatientAnethesiaHistoryObj = new PatientAnethesiaHistory();
						$PatientAnethesiaHistoryObj->setData($data);	
						$PatientAnethesiaHistoryObj->insertData($_REQUEST['patient_anethesia_id']);
					}
					else
					{
							$result['status'] = 0;
							$result['message'] = "Record not found.";
							echo json_encode($result);
					}
					
						
				$anethesia_data = $PatientAnethesiaHistoryObj->getdetailsByPatientId($data['patient_id']);
							
								if(!empty($anethesia_data))
								{
									$result['status'] = 1;
									$result['message'] = "Data Updated Successfully.";
									$result['data'] = $anethesia_data ;
									echo json_encode($result);
								}
								else
								{
									$result['status'] = 0;
									$result['message'] = "Data not found.";
									echo json_encode($result);
								}
						
				}
				catch(Exception $e) 
				{
					
					echo json_encode(array('status'=>'-7','message'=>' Error in insertion of Anethesia details.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteAnethesia()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
			
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['patient_anethesia_id']) && $_REQUEST['patient_anethesia_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$PatientAnethesiaHistoryObj = new PatientAnethesiaHistory();
				
					try
						{
							if($PatientAnethesiaHistoryObj->deleteanethesiaByIds($_REQUEST['patient_anethesia_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Anethesia detail is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Anethesia details data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter patient_anethesia_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiongetAnehtesiaById()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['patient_anethesia_id']) && $_REQUEST['patient_anethesia_id']!='' )
				{
					$PatientAnethesiaHistoryObj = new PatientAnethesiaHistory();
					$anethesia_data = $PatientAnethesiaHistoryObj->getdetailsByanethesiaId($_REQUEST['patient_anethesia_id']);
					
					if(!empty($anethesia_data))
					{
						$result["status"] = "1";
						$result["message"] = "success";
						$result["data"] = $anethesia_data ;
						echo json_encode($result);
					}
					else
					{
						echo json_encode(array('status'=>'0','message'=>'Data not found.'));
					}
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter patient_anethesia_id is not set.'));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	
	}
	
	
	// end patient anethesia
	
	
	
	
	public function actionset_patient_profile()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$otherdata = array();
				 $postdata['patient_id']= $_REQUEST['patient_id'];
				 
				 if(isset($_REQUEST['email']) && ($_REQUEST['email']!=''))
				{
					$patientObj = new PatientMaster();
					$emailData = $patientObj->checkEmailId($_REQUEST['email']);
					
					$patientObj = new PatientMaster();
					$patientDetail = $patientObj->getUserById($_REQUEST['patient_id']);
										
					if(($emailData!='') && (!empty($emailData)))
					{
						if($patientDetail['email'] == $_REQUEST['email'])
						{
							$postdata['email'] = $_REQUEST['email'];
						}
						else
						{
							echo json_encode(array('status'=>'-6','message'=>'This Email is Already Registered.'));die;
						}
					}
					else
					{
						$postdata['email']=$_REQUEST['email'];
					}
				}
				 
				if(isset($_REQUEST['name']))
				{
					$postdata['name']=$_REQUEST['name'];
				}
				if(isset($_REQUEST['middle_name']))
				{
					$postdata['middle_name']=$_REQUEST['middle_name'];
				}
				if(isset($_REQUEST['surname']))
				{
					$postdata['surname']=$_REQUEST['surname'];
				}
				if(isset($_REQUEST['phone_number']))
				{
					$postdata['phone_number']=$_REQUEST['phone_number'];
				}
				if(isset($_REQUEST['dob']))
				{
					$postdata['dob']=  date("Y-m-d",strtotime($_REQUEST['dob']));
				}
				if(isset($_REQUEST['gender']))
				{
					$postdata['gender']=$_REQUEST['gender'];
				}
				if(isset($_REQUEST['blood_group']))
				{
					$postdata['blood_group']=$_REQUEST['blood_group'];
				}
				if(isset($_REQUEST['marital_status']))
				{
					$postdata['marital_status']=$_REQUEST['marital_status'];
				}
				
				if(isset($_REQUEST['organ_donor']))
				{
					$postdata['organ_donor']= $_REQUEST['organ_donor'];
				}
				if(isset($_REQUEST['country_id'])  && !empty($_REQUEST['country_id']))
				{
					$postdata['country_id'] = $_REQUEST['country_id'];
				}
				
				if(isset($_REQUEST['patient_image']) && $_REQUEST['patient_image'] != '')
				{
					
					$pos = substr($_REQUEST['patient_image'], 0,4);
					
					if ($pos != 'http') 
					{
					
					$img = str_replace('data:image/jpeg;base64,', '', $_REQUEST['patient_image']);
					$encodedData = str_replace(' ','+',$img);
					$binary=base64_decode($encodedData);
					
					header('Content-Type: bitmap; charset=utf-8');
					$patientObj = new PatientMaster();
					$patient = $patientObj->getpatientdata($_REQUEST['patient_id']);
			
				     if(!empty($patient))
					 {
						 if(isset($patient['patient_image']))
						 {
							 $path = 'assets/upload/avatar/patient/'.$patient['patient_image'];
							 
							 if (file_exists($path)) 
							{
								unlink($path);						
							}
						 }
					 }
					$fname = 'patient_'.$_REQUEST['patient_id'].'.png';
					$path = 'assets/upload/avatar/patient/'.$fname;
					$success = file_put_contents($path, $binary);
					//$file = fopen($path, 'wb');
					//fwrite($file, $binary);
					//fclose($file);
					$postdata['patient_image'] = $fname;
				  }
				 
					
				}
				$postdata['status']=1;
				$postdata['modified_at']= date("Y-m-d:H-m-s");
				
				if(isset($_REQUEST['address'])&& !empty($_REQUEST['address']))
				{
					$postdata['address']=$_REQUEST['address'];
				}
				if(isset($_REQUEST['appt_no'])&& !empty($_REQUEST['appt_no']))
				{
					$otherdata['appt_no']=$_REQUEST['appt_no'];
				}
				
				if(isset($_REQUEST['city']))
				{
					$otherdata['city'] = $_REQUEST['city'];
				}
				if(isset($_REQUEST['state'])  )
				{
					$otherdata['state'] = $_REQUEST['state'];
				}
				if(isset($_REQUEST['patient_security_no']))
				{
					$otherdata['patient_security_no'] = $_REQUEST['patient_security_no'];
				}
				if(isset($_REQUEST['home_phone']))
				{
					$otherdata['home_phone'] = $_REQUEST['home_phone'];
				}
				if(isset($_REQUEST['mobile_phone']) )
				{
					$otherdata['mobile_phone'] = $_REQUEST['mobile_phone'];
				}
				if(isset($_REQUEST['alternate_address'])  )
				{
					$otherdata['alternate_address'] = $_REQUEST['alternate_address'];
				}
				$otherdata['zipcode'] = $_REQUEST['zipcode'];
				
				
				
				if(isset($_REQUEST['get_newsletter'])  && !empty($_REQUEST['get_newsletter']))				{
					$otherdata['get_newsletter'] = $_REQUEST['get_newsletter'];
				}
				else
				{
					$otherdata['get_newsletter'] = 0;
				}
				
				
				//print_r($postdata);
				//print_r($otherdata); die;
				$PatientMasterObj = new PatientMaster();
				$PatientMasterObj->setData($postdata);
				$id = $PatientMasterObj->insertData($postdata['patient_id']);
				
				$patient_data = $PatientMasterObj->getpatientdata($postdata['patient_id']);
			
				$patientInfoQuestionnaireObj = new  patientInfoQuestionnaire();
				$patient_details = $patientInfoQuestionnaireObj->getPatientdetails($postdata['patient_id']);
				//print_r($patient_details); die;
				if(!empty($patient_details))
				{
					 $patientInfoQuestionnaireObj = new  patientInfoQuestionnaire();
					 $patientInfoQuestionnaireObj->setData($otherdata);
					  $patientInfoQuestionnaireObj->insertData($patient_details['patient_info_id']);
				}
				else
				{
					 $otherdata['patient_id'] = $postdata['patient_id'];
					 $patientInfoQuestionnaireObj = new  patientInfoQuestionnaire();
					 $patientInfoQuestionnaireObj->setData($otherdata);
					 $pat_que_id = $patientInfoQuestionnaireObj->insertData();
				}
				
			
			
				if(!empty($patient_data))
				{
					$result['status'] = 1;
					$result['message'] = "Profile successfully Updated.";
					$result['data'] = $patient_data ;
					
					echo json_encode($result);
				}else{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	function actiongetsignature()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	    if(isset($_REQUEST) && !empty($_REQUEST))
		{
		
		
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' )
		{	$img = $_REQUEST['signature'];
			
			$imgurl = 'assets/upload/signatures/patient_sign'.'_'.$_REQUEST['patient_id'].'.png';
						//$path = 'assets/upload/uservideo/'.$fname ;
						if (file_exists($imgurl)) 
						{
							unlink($imgurl);						
						}
			
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			
			$success = file_put_contents($imgurl, $data);
			$imgpath = '<img src=http://byptserver.com/pingmydoctor/'. $imgurl .' >';
			echo $imgpath;
		}
		else
		{
			echo json_encode(array("status"=>'-1','message'=>' Please passed patient_id.'));	
		}
		 
		}
		else
		{
			echo json_encode(array("status"=>'-3','message'=>' Please write signature..'));	
		}
	}
	
	public function actiondoctorLogin()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['email']) && $_REQUEST['email']!='' && isset($_REQUEST['password']) && $_REQUEST['password']!='')
		{
			$data=array();
			$data['email'] 	= $_REQUEST['email'];
			$data['password'] 	= $_REQUEST['password'];
			
			$DoctorMasterObj  =  new DoctorMaster();
			$res = $DoctorMasterObj->checkEmailId($data['email']);
			
			if(!empty($res))
			{
				if($res['is_verified'] == "1")
				{
					$generalObj = new General();
					$validatePassword = $generalObj->validate_password($data['password'],$res['password']);
					
					if($validatePassword == true)
					{
						$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
												"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
												"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
						$session_id = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
						$session_id = $session_id.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
						$session_id = $session_id.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
						$doctor['session_id'] = $session_id;
						$doctor['modified_at'] = date("Y-m-d:H-m-s");

						$DoctorMasterObj  =  new DoctorMaster();
						$DoctorMasterObj->setData($doctor);
						$DoctorMasterObj->insertData($res['doctor_id']);
						
						$DoctorMasterObj  =  new DoctorMaster();
						$doctorData = $DoctorMasterObj->getUserById($res['doctor_id']);
						
						if(!empty($doctorData) && $doctorData!='')
						{
							$result['status'] = 1;
							$result['message'] = "success";
							$result['data'] = $doctorData ;
							echo json_encode($result);
						}
						else
						{
							$result['status'] = 0;
							$result['message'] = "Data not Found.";
							echo json_encode($result);
						}
					}
					else
					{
						echo json_encode(array('status'=>'-5','message'=>' Invalid email or password.'));
					}	
				}
				else
				{
					echo json_encode(array('status'=>'-4','message'=>' Check your e-mail in order to verify your account. Remember to also check your junk folder.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-3','message'=>' This e-mail is not registered. Please register before log in.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	function actionsendPushNotification($patient_id=NULL,$message=NULL)
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



function actionsendPushNotificationTest()
	{
			$data['message'] = "Testing"; 
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
			 
			 $push = array("audience"=>array("device_token"=>$_REQUEST['device_token']), "notification"=>$notification, "device_types"=>$platform);
			 
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
			 error_log(print_r($response,true),3,"response.txt");
			
			 if($response['http_code'] != 202) {
				
				//return false;
				 
			 } else {
			 
				//return true;
				 
			 }
			 
			 curl_close($session);
		

		echo  json_encode(array("status"=>1,"message"=>"Wow, it worked!\n",'pushStatus'=>$response));

		
	}


	public function actionsavehippaform()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				 $postdata['patient_id']= $_REQUEST['patient_id'];
				if(isset($_REQUEST['voice_mail']))
				{
					$postdata['voice_mail']=$_REQUEST['voice_mail'];
				}
				if(isset($_REQUEST['give_info_to_spouse']))
				{
					$postdata['give_info_to_spouse']=$_REQUEST['give_info_to_spouse'];
				}
				if(isset($_REQUEST['form_for']))
				{
					$postdata['form_for']=$_REQUEST['form_for'];
				}
				if(isset($_REQUEST['give_info_to']))
				{
					$postdata['give_info_to']=$_REQUEST['give_info_to'];
				}
				if(isset($_REQUEST['to_name'])&& !empty($_REQUEST['to_name']))
				{
					$postdata['to_name']=$_REQUEST['to_name'];
				}
			
				$postdata['status']=1;
				$postdata['created_at']= date("Y-m-d:H-m-s");

				//print_r($postdata); die;
				$HipaaFormDetailsObj = new HipaaFormDetails();
				$hippa_data = $HipaaFormDetailsObj->getdetailsByPatientId($postdata['patient_id']);
				if(!empty($hippa_data))
				{  // for update
					$HipaaFormDetailsObj = new HipaaFormDetails();
					$HipaaFormDetailsObj->setData($postdata);
					$id = $HipaaFormDetailsObj->insertData($hippa_data['form_id']);
				}
				else
				{  // go for Insert
					$HipaaFormDetailsObj = new HipaaFormDetails();
					$HipaaFormDetailsObj->setData($postdata);
					$id = $HipaaFormDetailsObj->insertData();
				}
				
				$hippa_data = $HipaaFormDetailsObj->getdetailsByPatientId($postdata['patient_id']);
				
				if(!empty($hippa_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $hippa_data ;
					
					echo json_encode($result);
				}else{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiongethippaform()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			//echo "<pre>"; print_r($_REQUEST); 
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$HipaaFormDetailsObj = new HipaaFormDetails();		
				$hippa_data = $HipaaFormDetailsObj->getdetailsByPatientId($_REQUEST['patient_id']);
				
				if(!empty($hippa_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $hippa_data ;
					
					echo json_encode($result);
				}else{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	public function actionhipaa()
	{
		$HipaaFormDetailsObj = new HipaaFormDetails();
		$hipaa=$HipaaFormDetailsObj->getdetailsByPatientId(4);
		 $html='<div align="center"><h2>HIPAA Authorization for Release of Information</h2><h2>To Family and/or Friends</h2></div>
        		<table>
        			<tr>
        				<td  align="left">
        					<span>Name of Patient :</span>
        				</td>
        				<td  align="left">
        					<span>'.$hipaa->name.' '.$hipaa->name.'</span>
        				</td>
        				<td align="right">
        					<span>DOB :</span>
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
        						$html.="Don't leave information";
        					}
        					else{
        						$html.='Leave information on voicemail at : <span style="font-weight:bold">'.($hipaa->voice_mail==0?"Home":($hipaa->voice_mail==1?"Work":"CellPhone"))."</span>";
        					}
							$html.='</p>
						</td>
        			</tr>
        			<tr>
        				<td  colspan="4">
	        				<p>';
        					if($hipaa->give_info_to_spouse==1){
        						$html.="Give information to spouse";
        					}
        					else{
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
				<table cellpadding="50"><tr><td align="right">Sign</td></tr></table>';
				
				$mpdf = new mPDF();$_REQUEST['patient_id'] = 4;
				$filename = $_REQUEST['patient_id'].'_Hipaa';
				
				$mpdf->WriteHTML($html);
				$mpdf->Output(FILE_PATH."assets/upload/pdf/".$filename.".pdf", 'F');
				echo $html;
				die;
	}
	
	
	
	public function actionsavepatient_info_questionnaire()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				 $postdata['patient_id']= $_REQUEST['patient_id'];
				if(isset($_REQUEST['schedule_for']))
				{
					$postdata['schedule_for']=$_REQUEST['schedule_for'];
				}
				if(isset($_REQUEST['at_time']))
				{
					$postdata['at_time']=$_REQUEST['at_time'];
				}
				if(isset($_REQUEST['about_practice']))
				{
					$postdata['about_practice']=$_REQUEST['about_practice'];
				}
				if(isset($_REQUEST['magazie_name']))
				{
					$postdata['magazie_name']=$_REQUEST['magazie_name'];
				}
				if(isset($_REQUEST['other_name']))
				{
					$postdata['other_name']=$_REQUEST['other_name'];
				}
				if(isset($_REQUEST['ph_ref_doctorname']))
				{
					$postdata['ph_ref_doctorname']=$_REQUEST['ph_ref_doctorname'];
				}
				if(isset($_REQUEST['ph_ref_phone']))
				{
					$postdata['ph_ref_phone']=$_REQUEST['ph_ref_phone'];
				}
				if(isset($_REQUEST['ph_address']))
				{
					$postdata['ph_address']=$_REQUEST['ph_address'];
				}
				if(isset($_REQUEST['pr_ref_doctorname']))
				{
					$postdata['pr_ref_doctorname']=$_REQUEST['pr_ref_doctorname'];
				}
				if(isset($_REQUEST['pr_ref_phone']))
				{
					$postdata['pr_ref_phone']=$_REQUEST['pr_ref_phone'];
				}
				if(isset($_REQUEST['pr_ref_address']))
				{
					$postdata['pr_ref_address']=$_REQUEST['pr_ref_address'];
				}
				if(isset($_REQUEST['patient_security_no']))
				{
					$postdata['patient_security_no']=$_REQUEST['patient_security_no'];
				}
				if(isset($_REQUEST['home_phone']))
				{
					$postdata['home_phone']=$_REQUEST['home_phone'];
				}
				if(isset($_REQUEST['mobile_phone']))
				{
					$postdata['mobile_phone']=$_REQUEST['mobile_phone'];
				}
				
				if(isset($_REQUEST['appt_no']))
				{
					$postdata['appt_no']=$_REQUEST['appt_no'];
				}
				if(isset($_REQUEST['city']))
				{
					$postdata['city']=$_REQUEST['city'];
				}
				if(isset($_REQUEST['state']))
				{
					$postdata['state']=$_REQUEST['state'];
				}
				if(isset($_REQUEST['zipcode']))
				{
					$postdata['zipcode']=$_REQUEST['zipcode'];
				}
				
				if(isset($_REQUEST['alternate_address']))
				{
					$postdata['alternate_address']=$_REQUEST['alternate_address'];
				}
				if(isset($_REQUEST['get_newsletter']))
				{
					$postdata['get_newsletter']=$_REQUEST['get_newsletter'];
				}
				if(isset($_REQUEST['employment_status']))
				{
					$postdata['employment_status']=$_REQUEST['employment_status'];
				}
				if(isset($_REQUEST['employment_other']))
				{
					$postdata['employment_other']=$_REQUEST['employment_other'];
				}
				
				if(isset($_REQUEST['employer']))
				{
					$postdata['employer']=$_REQUEST['employer'];
				}
				if(isset($_REQUEST['occupation']))
				{
					$postdata['occupation']=$_REQUEST['occupation'];
				}
				if(isset($_REQUEST['employer_address']))
				{
					$postdata['employer_address']=$_REQUEST['employer_address'];
				}
				
				if(isset($_REQUEST['insured_firstname']))
				{
					$postdata['insured_firstname']= $_REQUEST['insured_firstname'];
				}
				if(isset($_REQUEST['insured_lastname']))
				{
					$postdata['insured_lastname'] = $_REQUEST['insured_lastname'];
				}
				if(isset($_REQUEST['mi']))
				{
					$postdata['mi']=$_REQUEST['mi'];
				}
				if(isset($_REQUEST['insured_birthdate']))
				{
					$postdata['insured_birthdate']=$_REQUEST['insured_birthdate'];
				}
				
				if(isset($_REQUEST['insured_socialno']))
				{
					$postdata['insured_socialno']=$_REQUEST['insured_socialno'];
				}
				
				if(isset($_REQUEST['emergency_name']))
				{
					$postdata['emergency_name']=$_REQUEST['emergency_name'];
				}
				if(isset($_REQUEST['emergency_phone']))
				{
					$postdata['emergency_phone']=$_REQUEST['emergency_phone'];
				}
				if(isset($_REQUEST['emergency_address']))
				{
					$postdata['emergency_address']=$_REQUEST['emergency_address'];
				}
				if(isset($_REQUEST['relationship_to_patient']))
				{
					$postdata['relationship_to_patient']=$_REQUEST['relationship_to_patient'];
				}
				if(isset($_REQUEST['is_auto_accident']))
				{
					$postdata['is_auto_accident']=$_REQUEST['is_auto_accident'];
				}
				if(isset($_REQUEST['is_work_injury']))
				{
					$postdata['is_work_injury']=$_REQUEST['is_work_injury'];
				}
				
				if(isset($_REQUEST['pri_insurance_company']))
				{
					$postdata['pri_insurance_company']=$_REQUEST['pri_insurance_company'];
				}
				if(isset($_REQUEST['pri_insurance_id']))
				{
					$postdata['pri_insurance_id']=$_REQUEST['pri_insurance_id'];
				}
				if(isset($_REQUEST['pri_insurance_grp']))
				{
					$postdata['pri_insurance_grp']=$_REQUEST['pri_insurance_grp'];
				}
				if(isset($_REQUEST['pri_insurance_address']))
				{
					$postdata['pri_insurance_address']=$_REQUEST['pri_insurance_address'];
				}
				if(isset($_REQUEST['pri_insurance_phonenumber']))
				{
					$postdata['pri_insurance_phonenumber']=$_REQUEST['pri_insurance_phonenumber'];
				}
				if(isset($_REQUEST['pri_coverage_type']))
				{
					$postdata['pri_coverage_type']=$_REQUEST['pri_coverage_type'];
				}
				if(isset($_REQUEST['pri_coverage_type']))
				{
					$postdata['pri_coverage_type']=$_REQUEST['pri_coverage_type'];
				}
				if(isset($_REQUEST['pri_insurance_plan_code']))
				{
					$postdata['pri_insurance_plan_code']=$_REQUEST['pri_insurance_plan_code'];
				}
				if(isset($_REQUEST['pri_person_code']))
				{
					$postdata['pri_person_code']=$_REQUEST['pri_person_code'];
				}
				
				
				if(isset($_REQUEST['sec_insurance_company']))
				{
					$postdata['sec_insurance_company']=$_REQUEST['sec_insurance_company'];
				}
				
				if(isset($_REQUEST['sec_insurance_id']))
				{
					$postdata['sec_insurance_id']=$_REQUEST['sec_insurance_id'];
				}
				if(!empty($_REQUEST['sec_insurance_grp']))
				{
					$postdata['sec_insurance_grp']=$_REQUEST['sec_insurance_grp'];
				}
				if(isset($_REQUEST['sec_insurance_address']))
				{
					$postdata['sec_insurance_address']=$_REQUEST['sec_insurance_address'];
				}
				
				if(isset($_REQUEST['sec_insurance_phonenumber']))
				{
					$postdata['sec_insurance_phonenumber']=$_REQUEST['sec_insurance_phonenumber'];
				}
				if(isset($_REQUEST['sec_coverage_type']))
				{
					$postdata['sec_coverage_type']=$_REQUEST['sec_coverage_type'];
				}
				if(isset($_REQUEST['sec_insurance_plan_code']))
				{
					$postdata['sec_insurance_plan_code']=$_REQUEST['sec_insurance_plan_code'];
				}
				if(isset($_REQUEST['sec_person_code']))
				{
					$postdata['sec_person_code']=$_REQUEST['sec_person_code'];
				}
				
				if(isset($_REQUEST['comp_insurance']))
				{
					$postdata['comp_insurance']=$_REQUEST['comp_insurance'];
				}
				if(isset($_REQUEST['comp_claim']))
				{
					$postdata['comp_claim']=$_REQUEST['comp_claim'];
				}
				if(isset($_REQUEST['comp_address']))
				{
					$postdata['comp_address']=$_REQUEST['comp_address'];
				}
				if(isset($_REQUEST['comp_injury_date']))
				{
					$postdata['comp_injury_date']=$_REQUEST['comp_injury_date'];
				}
				
				if(isset($_REQUEST['adjuster_name']))
				{
					$postdata['adjuster_name']=$_REQUEST['adjuster_name'];
				}
				if(isset($_REQUEST['adjuster_phone']))
				{
					$postdata['adjuster_phone']=$_REQUEST['adjuster_phone'];
				}
				
				if(isset($_REQUEST['attorney_name']))
				{
					$postdata['attorney_name']=$_REQUEST['attorney_name'];
				}
				if(isset($_REQUEST['attorney_phone']))
				{
					$postdata['attorney_phone']=$_REQUEST['attorney_phone'];
				}
				if(isset($_REQUEST['info_insurance']))
				{
					$postdata['info_insurance']=$_REQUEST['info_insurance'];
				}
				if(isset($_REQUEST['info_claim']))
				{
					$postdata['info_claim']=$_REQUEST['info_claim'];
				}
				if(isset($_REQUEST['claim_address']))
				{
					$postdata['claim_address']=$_REQUEST['claim_address'];
				}
				if(isset($_REQUEST['info_date_injury']))
				{
					$postdata['info_date_injury']=$_REQUEST['info_date_injury'];
				}
				
				if(isset($_REQUEST['info_adjuster_name']))
				{
					$postdata['info_adjuster_name']=$_REQUEST['info_adjuster_name'];
				}
				if(isset($_REQUEST['info_adjuster_phone']))
				{
					$postdata['info_adjuster_phone']=$_REQUEST['info_adjuster_phone'];
				}
				if(isset($_REQUEST['info_attorney_name']))
				{
					$postdata['info_attorney_name']=$_REQUEST['info_attorney_name'];
				}
				if(isset($_REQUEST['info_attorney_phone']))
				{
					$postdata['info_attorney_phone'] = $_REQUEST['info_attorney_phone'];
				}
				
				if(isset($_REQUEST['pcp']) && $_REQUEST['pcp'] != '')
				{
					$pcp = $_REQUEST['pcp'];
					$patientDataUpdate = array();
					$patientDataUpdate['doctor_id'] = $pcp;
					$patientObj = new PatientMaster();
					$patientObj->setData($patientDataUpdate);
					$patientObj->insertData($postdata['patient_id']);
					
					
					$DoctorPatientRelationObj = new DoctorPatientRelation();
					// check weather record already exist or not. In case exists then do nothing otherwise remove old entry and insert new one.
					$arrPatientPCPData = $DoctorPatientRelationObj->checkRecord($pcp,$postdata['patient_id'],1);
					if (!$arrPatientPCPData)
					{
						$DoctorPatientRelationObj->deletePatientData($postdata['patient_id'],1);
						$doctorPatientRelation = array();
						$doctorPatientRelation['patient_id'] = $postdata['patient_id'];
						$doctorPatientRelation['doctor_id'] = $pcp;
						$doctorPatientRelation['is_share'] = 0;
						$doctorPatientRelation['doctor_type'] = 1;
						$doctorPatientRelation['status'] = 1;
						$doctorPatientRelation['created_at'] = date("Y-m-d H:i:s");
						
						$DoctorPatientRelationObj = new DoctorPatientRelation();
						$DoctorPatientRelationObj->setData($doctorPatientRelation);
						$DoctorPatientRelationObj->insertData();
					}
					
				}
				
				if(isset($_REQUEST['acp']) && $_REQUEST['acp'] != '')
				{
					$acpArray = explode(",",$_REQUEST['acp']);
					$DoctorPatientRelationObj = new DoctorPatientRelation();
					$docPatientACPData = $DoctorPatientRelationObj->getACPdetails_by_patientidArray($postdata['patient_id']);
					$arrDBPatientACP = array();
					foreach ($docPatientACPData as $keyPatientACP => $valuePatientACP)
					{
						$arrDBPatientACP[] = $valuePatientACP['doctor_id'];
					}
					$arrInsertPatientRelationData = array_diff($acpArray, $arrDBPatientACP);
					$arrDeletePatientRelationData = array_diff($arrDBPatientACP, $acpArray);
					// Delete unchecked records.
					foreach($arrDeletePatientRelationData as $keyDelete => $valueDelete)
					{
						if ($valueDelete>0)
						{
							$DoctorPatientRelationObj->deleteDoctorPatientRelation($valueDelete, $postdata['patient_id']);
						}
					}
					// insert records
					foreach ($arrInsertPatientRelationData as $keyInsert => $valueInsert)
					{
						if ($valueInsert>0)
						{
							$doctorPatientRelation = array();
							$doctorPatientRelation['patient_id'] = $postdata['patient_id'];
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
				$postdata['status']=1;
				

			
				$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patient_data = $patientInfoQuestionnaireObj->getdetailsByPatientId($_REQUEST['patient_id']);
				
				if(!empty($patient_data))
				{  // for update
					$postdata['modified_at']= date("Y-m-d:H-m-s");
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
					$patientInfoQuestionnaireObj->setData($postdata);
					$id = $patientInfoQuestionnaireObj->insertData($patient_data['patient_info_id']);
				}
				else
				{  // go for Insert
					$postdata['creation_at']= date("Y-m-d:H-m-s");
					$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
					$patientInfoQuestionnaireObj->setData($postdata);
					$id = $patientInfoQuestionnaireObj->insertData();
				}
				
				$patient_qua_data = $patientInfoQuestionnaireObj->getdetailsByPatientId($postdata['patient_id']);
				
				if(!empty($patient_qua_data))
				{
					$result['status'] = 1;
					$result['message'] = "Data Updated Successfully.";
					$result['data'] = $patient_qua_data ;
					
					echo json_encode($result);
				}else{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	public function actionget_patient_info_questionnaire()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$patientInfoQuestionnaireObj = new patientInfoQuestionnaire();
				$patient_qua_data = $patientInfoQuestionnaireObj->getdetailsByPatientId($_REQUEST['patient_id']);
				if(!empty($patient_qua_data))
				{
					
					//print_r($patient_qua_data);
					$DoctorMasterObj = new DoctorMaster ();
					$doctorList = $DoctorMasterObj->getAllDoctorList($_REQUEST['patient_id']);
					
					$str = "";
					foreach($doctorList as $row)
					{
						$filter  = "";
						//echo $patient_qua_data['doctor_id'] ."==". $row['doctor_id']."<br/>";
						
						if($patient_qua_data['doctor_id'] == $row['doctor_id'])
						{
							$filter = "selected";
						}
						$str .= '<option value="'.$row['doctor_id'].'" '.$filter.'>'.$row['name'].' '.$row['surname'].'</option>';
					}
					$patient_qua_data['pcp'] = $str;
					
					
					$DoctorPatientRelationObj = new DoctorPatientRelation ();
					$docPatData = $DoctorPatientRelationObj->getACPdetails_by_patientidArray( $_REQUEST['patient_id'] );
					$str = '';
					$doct_array = array ();
					foreach ( $docPatData as $row )
					{
						$doct_array [] = $row ['doctor_id'];
					}
					foreach($doctorList as $row)
					{
						$filter  = "";
						
						if ($patientData['doctor_id'] == $row['doctor_id'])
						{
							continue;
						}
						//echo $patient_qua_data['doctor_id'] ."==". $row['doctor_id']."<br/>";
						
						if(in_array($row['doctor_id'],$doct_array)) 
						{
							$filter = "selected";
						}
						
						
						$str .= '<option value="'.$row['doctor_id'].'" '.$filter.'>'.$row['name'].' '.$row['surname'].'</option>';
					}
					
					$patient_qua_data['acp'] = $str;
					
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $patient_qua_data ;
					
					echo json_encode($result);
				}else{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	function actionfillACPCombo()
	{
		if(isset($_POST['doctor_id']) && !empty($_POST['doctor_id']) && isset($_POST['patient_id']) && !empty($_POST['patient_id']))
		{
			
			$DoctorMasterObj = new DoctorMaster ();
			$doctorList = $DoctorMasterObj->getAllDoctorListNotinPCP($_REQUEST['patient_id'],$_POST['doctor_id']);
				
		$DoctorPatientRelationObj = new DoctorPatientRelation ();
		$docPatData = $DoctorPatientRelationObj->getACPdetails_by_patientidArray($_POST['patient_id']);
					$str = '';
					$doct_array = array ();
					foreach ( $docPatData as $row )
					{
						$doct_array [] = $row ['doctor_id'];
					}
					foreach($doctorList as $row)
					{
						$filter  = "";
						
						if ($patientData['doctor_id'] == $row['doctor_id'])
						{
							continue;
						}
						//echo $patient_qua_data['doctor_id'] ."==". $row['doctor_id']."<br/>";
						
						if(in_array($row['doctor_id'],$doct_array)) 
						{
							$filter = "selected";
						}
						
						
						$str .= '<option value="'.$row['doctor_id'].'" '.$filter.'>'.$row['name'].' '.$row['surname'].'</option>';
					}
					
					$patient_qua_data['acp'] = $str;
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $patient_qua_data ;
					
					echo json_encode($result);die;
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	function actiongetDoctorProfile()
	{
		if(isset($_REQUEST['doctor_id']) && $_REQUEST['doctor_id'] != '')
		{
			
			$DoctorMasterObj = new DoctorMaster();
			$doctorData = $DoctorMasterObj->getDoctorById($_REQUEST['doctor_id']);
			
			echo json_encode(array("status"=>1,"message"=>'success',"data"=>$doctorData));
		}
	}
	
	
	
	
	
	
	
	
	function actionisValidSession()
	{
		
		if(!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' && isset($_REQUEST['login_type']) && $_REQUEST['login_type']!='')
		{
			if($_REQUEST['login_type'] == 1) // For Doctor
			{
				$DoctorMasterObj = new DoctorMaster();
				$sessionData = $DoctorMasterObj->checksession($_REQUEST['user_id'],$_REQUEST['session_id']);
				if(!empty($sessionData))
				{
					$result = array();
					$result["status"] = "1";
					$result["message"] = "Valid Session.";
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
				}
			}
			else if ($_REQUEST['login_type'] == 2) // For Patient
			{
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['user_id'],$_REQUEST['session_id']);
				
				if(!empty($sessionData))
				{
					$result = array();
					$result["status"] = "1";
					$result["message"] = "Valid Session.";
					echo json_encode($result);
				}
				else
				{
					echo json_encode(array("status"=>'-2','message'=>' Invalid Sesssion.'));
				}
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	function actiongetAppointmentListByPatient()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				if(!isset($_REQUEST['start']))
				{
					$_REQUEST['start'] = 0;
				}
				
				if(!isset($_REQUEST['length	']))
				{
					$_REQUEST['length'] = 10;
				}

			
			$AppointmentObj = new Appointment();
			$patientData = $AppointmentObj->getAppointmentListByPatient($_REQUEST['patient_id'],$_REQUEST['start'],$_REQUEST['length']);
			
			$AppointmentObj = new Appointment();
			$totalRecords = $AppointmentObj->getAppointmentListByPatientCountForMobile($_REQUEST['patient_id']);

			
			 if(!empty($patientData))
			 {
				 echo json_encode(array("status"=>1,"message"=>'success',"data"=>$patientData,'recordsTotal'=>$totalRecords,'recordsFiltered'=>$totalRecords));
				 exit;
			 }
			 else
			 {
				 echo json_encode(array("status"=>0,"message"=>'Data Not Found.',"data"=>$patientData,'recordsTotal'=>$totalRecords,'recordsFiltered'=>$totalRecords)); 
			 }
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
			
		}
	}
	
	
	public function actionsave_medical_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				
				if(isset($_REQUEST['height']))
				{
					$postdata['height']=$_REQUEST['height'];
				}
				if(isset($_REQUEST['avg_height']))
				{
					$postdata['avg_height']=$_REQUEST['avg_height'];
				}
				if(isset($_REQUEST['is_pregnant']))
				{
					$postdata['is_pregnant']=$_REQUEST['is_pregnant'];
				}
				if(isset($_REQUEST['aids']))
				{
					$postdata['aids'] = $_REQUEST['aids'];
				}
				if(isset($_REQUEST['hepatitis']))
				{
					$postdata['hepatitis']=$_REQUEST['hepatitis'];
				}
				if(isset($_REQUEST['other_disease']))
				{
					$postdata['other_disease']=$_REQUEST['other_disease'];
				}
				if(isset($_REQUEST['blood_clots']))
				{
					$postdata['blood_clots']=$_REQUEST['blood_clots'];
				}
				if(isset($_REQUEST['diabetes']))
				{
					$postdata['diabetes']=$_REQUEST['diabetes'];
				}
				
				if(isset($_REQUEST['diet']))
				{
					$postdata['diet']=$_REQUEST['diet'];
				}
				if(isset($_REQUEST['pills']))
				{
					$postdata['pills']=$_REQUEST['pills'];
				}
				if(isset($_REQUEST['insulin']))
				{
					$postdata['insulin']=$_REQUEST['insulin'];
				}
				
				if(isset($_REQUEST['epilepsy']))
				{
					$postdata['epilepsy']=$_REQUEST['epilepsy'];
				}
				if(isset($_REQUEST['heart_problem']))
				{
					$postdata['heart_problem']=$_REQUEST['heart_problem'];
				}
				if(isset($_REQUEST['high_blood_pressure']))
				{
					$postdata['high_blood_pressure']=$_REQUEST['high_blood_pressure'];
				}
				if(isset($_REQUEST['low_thyroid']))
				{
					$postdata['low_thyroid']=$_REQUEST['low_thyroid'];
				}
				if(isset($_REQUEST['bowel']))
				{
					$postdata['bowel']=$_REQUEST['bowel'];
				}
				if(isset($_REQUEST['ulcers']))
				{
					$postdata['ulcers']=$_REQUEST['ulcers'];
				}
				if(isset($_REQUEST['prolapse']))
				{
					$postdata['prolapse']=$_REQUEST['prolapse'];
				}
				if(isset($_REQUEST['lung_disease']))
				{
					$postdata['lung_disease']=$_REQUEST['lung_disease'];
				}
				if(isset($_REQUEST['polio']))
				{
					$postdata['polio']=$_REQUEST['polio'];
				}
				if(isset($_REQUEST['arthritis']))
				{
					$postdata['arthritis']=$_REQUEST['arthritis'];
				}
				if(isset($_REQUEST['tuberculosis']))
				{
					$postdata['tuberculosis']=$_REQUEST['tuberculosis'];
				}
				if(isset($_REQUEST['psychiatric']))
				{
					$postdata['psychiatric']=$_REQUEST['psychiatric'];
				}
				if(isset($_REQUEST['other_unknown']))
				{
					$postdata['other_unknown']=$_REQUEST['other_unknown'];
				}
				if(isset($_REQUEST['injuries']))
				{
					$postdata['injuries']=$_REQUEST['injuries'];
				}
				if(isset($_REQUEST['hospitalization']))
				{
					$postdata['hospitalization']=$_REQUEST['hospitalization'];
				}
	
				
				if(!isset($postdata))
				{
					
					$result = array();
					$result["status"] = "-3";
					$result["message"] = "Record not Inserted. Please fill form.";
					echo json_encode($result);
					die;
				}
				
				$postdata['status']=1;
				$postdata['creation_at']= date("Y-m-d:H-m-s");

				
				
				 $postdata['patient_id']= $_REQUEST['patient_id'];
				//print_r($postdata); die;
				$PatientMedicalHistoryObj = new PatientMedicalHistory();
				$medical_data = $PatientMedicalHistoryObj->getdetailsByPatientId($postdata['patient_id']);
				if(!empty($medical_data))
				{  // for update
					$PatientMedicalHistoryObj = new PatientMedicalHistory();
					$PatientMedicalHistoryObj->setData($postdata);
					$id = $PatientMedicalHistoryObj->insertData($medical_data['medical_history_id']);
				}
				else
				{  // go for Insert
					$PatientMedicalHistoryObj = new PatientMedicalHistory();
					$PatientMedicalHistoryObj->setData($postdata);
					$id = $PatientMedicalHistoryObj->insertData();
				}
				
				$medical_data = $PatientMedicalHistoryObj->getdetailsByPatientId($postdata['patient_id']);
				
				if(!empty($medical_data))
				{
					$result['status'] = 1;
					$result['message'] = "Form updated successfully.";
					$result['data'] = $medical_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
		public function actionget_medical_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$PatientMedicalHistoryObj = new PatientMedicalHistory();
				$medical_data = $PatientMedicalHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
				
				if(!empty($medical_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $medical_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	public function actionsave_surgical_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				
				if(isset($_REQUEST['procedure']))
				{
					$postdata['procedure']=$_REQUEST['procedure'];
				}
				if(isset($_REQUEST['Year']))
				{
					$postdata['Year']=$_REQUEST['Year'];
				}
				if(isset($_REQUEST['surgeon']))
				{
					$postdata['surgeon']=$_REQUEST['surgeon'];
				}
				if(isset($_REQUEST['hospital']))
				{
					$postdata['hospital']=$_REQUEST['hospital'];
				}

				
				if(!isset($postdata))
				{
					
					$result = array();
					$result["status"] = "-3";
					$result["message"] = "Record not Inserted. Please fill details.";
					echo json_encode($result);
					die;
				}
				
				$postdata['status']=1;
				$postdata['creation_at']= date("Y-m-d:H-m-s");

				
				$postdata['patient_id']= $_REQUEST['patient_id'];
				//print_r($postdata); die;
				
				$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
				$PatientSurgeryHistoryObj->setData($postdata);
				$id = $PatientSurgeryHistoryObj->insertData();
				
				
				if(!empty($id))
				{
					$result['status'] = 1;
					$result['message'] = "Record Inserted successfully.";
					$result['data'] = $medical_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actionedit_surgical_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' && isset($_REQUEST['patient_surgery_id']) && $_REQUEST['patient_surgery_id']!=''
		)
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				
				if(isset($_REQUEST['procedure']))
				{
					$postdata['procedure']=$_REQUEST['procedure'];
				}
				if(isset($_REQUEST['Year']))
				{
					$postdata['Year']=$_REQUEST['Year'];
				}
				if(isset($_REQUEST['surgeon']))
				{
					$postdata['surgeon']=$_REQUEST['surgeon'];
				}
				if(isset($_REQUEST['hospital']))
				{
					$postdata['hospital']=$_REQUEST['hospital'];
				}

				
				if(!isset($postdata))
				{
					
					$result = array();
					$result["status"] = "-3";
					$result["message"] = "Record not Inserted. Please fill details.";
					echo json_encode($result);
					die;
				}
				
				$postdata['status']=1;
				$postdata['modified_at']= date("Y-m-d:H-m-s");
				//print_r($postdata); die;
				
				$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
				$PatientSurgeryHistoryObj->setData($postdata);
				$id = $PatientSurgeryHistoryObj->insertData($_REQUEST['patient_surgery_id']);
				
				$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
			    $get_data = $PatientSurgeryHistoryObj->getdetailsBySurgeryId($_REQUEST['patient_surgery_id']);
				
				if(!empty($get_data))
				{
					$result['status'] = 1;
					$result['message'] = "Record Updated successfully.";
					$result['data'] = $get_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actionget_surgical_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' && isset($_REQUEST['patient_surgery_id']) && $_REQUEST['patient_surgery_id']!='' )
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
			    $get_data = $PatientSurgeryHistoryObj->getdetailsBySurgeryId($_REQUEST['patient_surgery_id']);
				
				if(!empty($get_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $get_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actionget_surgical_history_list()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
			    $get_data = $PatientSurgeryHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
					if(!empty($get_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $get_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actiondeleteSurgery()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='' )
		{
				$patientObj = new PatientMaster();
				$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData))
			{
				if(isset($_REQUEST['patient_surgery_id']) && $_REQUEST['patient_surgery_id']!='')
				{
					
					$transaction=Yii::app()->db->beginTransaction();
					$PatientSurgeryHistoryObj = new PatientSurgeryHistory($_REQUEST['patient_surgery_id']);
				
					try
						{
							if($PatientSurgeryHistoryObj->deletesurgeryByIds($_REQUEST['patient_surgery_id'],$_REQUEST['patient_id'])) 
							{
								$transaction->commit(); 
								$result['status'] = 1;
								$result['message'] = "Surgery data is deleted successfully.";
								echo json_encode($result);
							}
							else
							{
								throw new Exception();
							}
						}
						catch(Exception $e) 

						{
							$transaction->rollback();
							echo json_encode(array('status'=>'-8','message'=>' Error in deletion of Surgery data.'));
						}
					
				}
				else
				{
					echo json_encode(array('status'=>'-6','message'=>' Required Parameter patient_surgery_id is not set.'));
				}
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	
	public function actionsave_family_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				
				if(isset($_REQUEST['hypertension']))
				{
					$postdata['hypertension']=$_REQUEST['hypertension'];
				}
				if(isset($_REQUEST['tuberculosis']))
				{
					$postdata['tuberculosis']=$_REQUEST['tuberculosis'];
				}
				if(isset($_REQUEST['diabetes']))
				{
					$postdata['diabetes']=$_REQUEST['diabetes'];
				}
				if(isset($_REQUEST['kidney_disease']))
				{
					$postdata['kidney_disease'] = $_REQUEST['kidney_disease'];
				}
				if(isset($_REQUEST['heart_disease']))
				{
					$postdata['heart_disease']=$_REQUEST['heart_disease'];
				}
				if(isset($_REQUEST['arthritis']))
				{
					$postdata['arthritis']=$_REQUEST['arthritis'];
				}
				if(isset($_REQUEST['epilepsy']))
				{
					$postdata['epilepsy']=$_REQUEST['epilepsy'];
				}
				if(isset($_REQUEST['convulsions']))
				{
					$postdata['convulsions']=$_REQUEST['convulsions'];
				}
				
				if(isset($_REQUEST['cancer']))
				{
					$postdata['cancer']=$_REQUEST['cancer'];
				}
				if(isset($_REQUEST['psychological']))
				{
					$postdata['psychological']=$_REQUEST['psychological'];
				}
				if(isset($_REQUEST['drug']))
				{
					$postdata['drug']=$_REQUEST['drug'];
				}
				
				if(!isset($postdata) )
				{
					$result = array();
					$result["status"] = "-3";
					$result["message"] = "Record not Inserted. Please fill form.";
					echo json_encode($result);
					die;
				}
				
				$postdata['status']=1;
				$postdata['creation_at']= date("Y-m-d:H-m-s");

				$postdata['patient_id']= $_REQUEST['patient_id'];
				//print_r($postdata); die;
				$PatientFamilyHistoryObj = new PatientFamilyHistory();
				$family_data = $PatientFamilyHistoryObj->getdetailsByPatientId($postdata['patient_id']);
				if(!empty($family_data))
				{  // for update
					$PatientFamilyHistoryObj = new PatientFamilyHistory();
					$PatientFamilyHistoryObj->setData($postdata);
					$id = $PatientFamilyHistoryObj->insertData($family_data['patient_family_history_id']);
				}
				else
				{  // go for Insert
					$PatientFamilyHistoryObj = new PatientFamilyHistory();
					$PatientFamilyHistoryObj->setData($postdata);
					$id = $PatientFamilyHistoryObj->insertData();
				}
				
				$family_data = $PatientFamilyHistoryObj->getdetailsByPatientId($postdata['patient_id']);
				
				if(!empty($family_data))
				{
					$result['status'] = 1;
					$result['message'] = "Form updated successfully.";
					$result['data'] = $family_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	public function actionget_family_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$PatientFamilyHistoryObj = new PatientFamilyHistory();
				$family_data = $PatientFamilyHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
				
				if(!empty($family_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $family_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	public function actionsave_social_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				
				if(isset($_REQUEST['employed']))
				{
					$postdata['employed']=$_REQUEST['employed'];
				}
				if(isset($_REQUEST['occupation']))
				{
					$postdata['occupation']=$_REQUEST['occupation'];
				}
				if(isset($_REQUEST['children']))
				{
					$postdata['children']=$_REQUEST['children'];
				}
				if(isset($_REQUEST['how_many']))
				{
					$postdata['how_many'] = $_REQUEST['how_many'];
				}
				if(isset($_REQUEST['live']))
				{
					$postdata['live']=$_REQUEST['live'];
				}
				if(isset($_REQUEST['live_other']))
				{
					$postdata['live_other']=$_REQUEST['live_other'];
				}
				if(isset($_REQUEST['aids']))
				{
					$postdata['aids']=$_REQUEST['aids'];
				}
				if(isset($_REQUEST['abuse_type']))
				{
					$postdata['abuse_type']=$_REQUEST['abuse_type'];
				}
				
				if(isset($_REQUEST['use_alcohol']))
				{
					$postdata['use_alcohol']=$_REQUEST['use_alcohol'];
				}
				if(isset($_REQUEST['how_often']))
				{
					$postdata['how_often']=$_REQUEST['how_often'];
				}
				if(isset($_REQUEST['smoker']))
				{
					$postdata['smoker']=$_REQUEST['smoker'];
				}
				if(isset($_REQUEST['no_of_pack']))
				{
					$postdata['no_of_pack']=$_REQUEST['no_of_pack'];
				}
				if(isset($_REQUEST['years']))
				{
					$postdata['years']=$_REQUEST['years'];
				}
				if(isset($_REQUEST['when_quit']))
				{
					$postdata['when_quit']=$_REQUEST['when_quit'];
				}
				
			if(!isset($postdata))
				{
				
					$result = array();
					$result["status"] = "-3";
					$result["message"] = "Record not Inserted. Please fill form.";
					echo json_encode($result);
					die;
				}
				
				$postdata['status']=1;
				$postdata['creation_at']= date("Y-m-d:H-m-s");

				$postdata['patient_id']= $_REQUEST['patient_id'];
				//print_r($postdata); die;
				$PatientSocialHistoryObj = new PatientSocialHistory();
				$social_data = $PatientSocialHistoryObj->getdetailsByPatientId($postdata['patient_id']);
				if(!empty($social_data))
				{  // for update
					$PatientSocialHistoryObj = new PatientSocialHistory();
					$PatientSocialHistoryObj->setData($postdata);
					$id = $PatientSocialHistoryObj->insertData($social_data['patient_social_history_id']);
				}
				else
				{  // go for Insert
					$PatientSocialHistoryObj = new PatientSocialHistory();
					$PatientSocialHistoryObj->setData($postdata);
					$id = $PatientSocialHistoryObj->insertData();
				}
				
				$social_data = $PatientSocialHistoryObj->getdetailsByPatientId($postdata['patient_id']);
				
				if(!empty($social_data))
				{
					$result['status'] = 1;
					$result['message'] = "Form updated successfully.";
					$result['data'] = $social_data ;
					
					echo json_encode($result);
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actionget_social_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$PatientSocialHistoryObj = new PatientSocialHistory();
				$socail_data = $PatientSocialHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
				
				if(!empty($socail_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $socail_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actionsave_symptoms_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				
				if(isset($_REQUEST['const_symptoms']))
				{
					$postdata['const_symptoms']=$_REQUEST['const_symptoms'];
				}
				if(isset($_REQUEST['skin']))
				{
					$postdata['skin']=$_REQUEST['skin'];
				}
				if(isset($_REQUEST['heent']))
				{
					$postdata['heent'] = $_REQUEST['heent'];
				}
				if(isset($_REQUEST['respiratory']))
				{
					$postdata['respiratory'] = $_REQUEST['respiratory'];
				}
				if(isset($_REQUEST['cardiovascular']))
				{
					$postdata['cardiovascular']=$_REQUEST['cardiovascular'];
				}
				if(isset($_REQUEST['gastrointestinal']))
				{
					$postdata['gastrointestinal']=$_REQUEST['gastrointestinal'];
				}
				if(isset($_REQUEST['genitourinary']))
				{
					$postdata['genitourinary']=$_REQUEST['genitourinary'];
				}
				if(isset($_REQUEST['musculoskeletal']))
				{
					$postdata['musculoskeletal']=$_REQUEST['musculoskeletal'];
				}
				
				if(isset($_REQUEST['neurological']))
				{
					$postdata['neurological']=$_REQUEST['neurological'];
				}
				
				if(isset($_REQUEST['psychiatric']))
				{
					$postdata['psychiatric']=$_REQUEST['psychiatric'];
				}
				
				if(isset($_REQUEST['endocrine']))
				{
					$postdata['endocrine']=$_REQUEST['endocrine'];
				}
				
				if(isset($_REQUEST['hematologic']))
				{
					$postdata['hematologic']=$_REQUEST['hematologic'];
				}
				
				
				$postdata['patient_id']= $_REQUEST['patient_id'];
			
			
				$PatientSymptomsHistoryObj = new PatientSymptomsHistory();
				$symptoms_data = $PatientSymptomsHistoryObj->getsymptomsListByPatient($postdata['patient_id']);
				if(!empty($symptoms_data))
				{  // for update
					$postdata['modified_at']= date("Y-m-d:H-m-s");
					$PatientSymptomsHistoryObj = new PatientSymptomsHistory();
					$PatientSymptomsHistoryObj->setData($postdata);
					$id = $PatientSymptomsHistoryObj->insertData($symptoms_data['patient_symptoms_id']);
				}
				else
				{  // go for Insert
					$postdata['status']=1;
					$postdata['creation_at']= date("Y-m-d:H-m-s");
					$PatientSymptomsHistoryObj = new PatientSymptomsHistory();
					$PatientSymptomsHistoryObj->setData($postdata);
					$id = $PatientSymptomsHistoryObj->insertData();
				}
				
				$symptoms_data = $PatientSymptomsHistoryObj->getsymptomsListByPatient($postdata['patient_id']);
				
				if(!empty($symptoms_data))
				{
					$result['status'] = 1;
					$result['message'] = "Form updated successfully.";
					$result['data'] = $symptoms_data ;
					
					echo json_encode($result);
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	public function actionget_symptoms_history()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='' && isset($_REQUEST['session_id']) && $_REQUEST['session_id']!='')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				$PatientSymptomsHistoryObj = new PatientSymptomsHistory();
				$symptoms_data = $PatientSymptomsHistoryObj->getsymptomsListByPatient($_REQUEST['patient_id']);
				
				if(!empty($symptoms_data))
				{
					$result['status'] = 1;
					$result['message'] = "success";
					$result['data'] = $symptoms_data ;
					
					echo json_encode($result);
				}else{ 
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>' permision Denied'));
		}
	}
	
	
	
	public function actionregister_patient()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		
			
				
				if(isset($_REQUEST['name']))
				{
					$postdata['name']=$_REQUEST['name'];
				}
				else
				 {
				 echo json_encode(array('status'=>'-3','message'=>' Please enter FirstName.'));
			exit;
				 }

				if(isset($_REQUEST['surname']))
				{
					$postdata['surname']=$_REQUEST['surname'];
				}
				else
				 {
				 echo json_encode(array('status'=>'-4','message'=>' Please enter LastName.'));
			exit;
				 }

				if(isset($_REQUEST['email']))
				{
					$postdata['email']=$_REQUEST['email'];
				}
				else
				 {
				 echo json_encode(array('status'=>'-5','message'=>' Please enter email.'));
			exit;
				 }
				 
				 $PatientMasterObj = new PatientMaster();
				 $isdata = $PatientMasterObj->checkEmailId($postdata['email']);
				 if(!empty($isdata))
				 {
					 echo json_encode(array('status'=>'-6','message'=>' Email Already Registered.'));
			exit; 
				 }
				
				if(isset($_REQUEST['password']) && !empty($_REQUEST['password']))
				 {
				  
				  $generalObj = new General();
					$password = $generalObj->encrypt_password($_POST['password']);
				   $postdata['password'] = $password ;
				 }
				 else
				 {
				 echo json_encode(array('status'=>'-7','message'=>' Please enter Password.'));
			exit;
				 }
				
				if(isset($_REQUEST['phone_number']))
				{
					$postdata['phone_number']=$_REQUEST['phone_number'];
				}
				if(isset($_REQUEST['dob']))
				{
					$postdata['dob']=$_REQUEST['dob'];
				}
				if(isset($_REQUEST['gender']))
				{
					$postdata['gender']=$_REQUEST['gender'];
				}
				if(isset($_REQUEST['address']))
				{
					$postdata['address']=$_REQUEST['address'];
				}
				if(isset($_REQUEST['countrycode']))
				{
					$postdata['country_code']=$_REQUEST['countrycode'];
				}
				if(isset($_REQUEST['country']))
				{
					$postdata['country_id']=$_REQUEST['country'];
				}
				if(isset($_REQUEST['promotional_offer']))
				{
					$postdata['promotional_offer'] = $_REQUEST['promotional_offer'];
				}
				 
				  	
				
				$postdata['is_verified']=1;
				$postdata['status']=1;
				$postdata['created_at']= date("Y-m-d:H-m-s");
				$postdata['modified_at']= date("Y-m-d:H-m-s");

				//print_r($_REQUEST);
				//print_r($postdata); die;
				$PatientMasterObj = new PatientMaster();
				$PatientMasterObj->setData($postdata);
				$id = $PatientMasterObj->insertData();
				
				$patient_data = $PatientMasterObj->getpatientdata($id);
			
				if(!empty($patient_data))
				{
					$result['status'] = 1;
					$result['message'] = "Registered successfully.";
					$result['data'] = $patient_data ;
					
					echo json_encode($result);
					
				}else{
					echo json_encode(array('status'=>'0','message'=>'Data not found.'));
				}
			
		
	}
	
	function actionpatientforgotPassword()
	{
		error_reporting(0);
		if(isset($_REQUEST['email']))
		{
			$patientMasterObj = new PatientMaster();
			$patientData = $patientMasterObj->getUserDataByEmail($_REQUEST['email']);
			
			if(isset($patientData['email']) && $patientData['email'] != '')
			{
				$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
											"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
											"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$fPassword = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$user =array();	
				$user['fpasswordconfirm'] = $fPassword;
				$patientMasterObj = new PatientMaster();
				$patientMasterObj->setData($user);
				$patientMasterObj->insertData($patientData['patient_id']);
					
				$Yii = Yii::app();	
				$emailLink = $Yii->params->base_path."admin/patientResetPassword/fpassword/".$fPassword;
				
				
				try
				{
							
					//$body             = eregi_replace("[\]",'',$body);
					$mail = new PHPMailer(false);
					$mail->IsSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server
					$mail->Port =   587;//465;                                    // Set the SMTP port
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = "sujal.bandhara@bypt.in";              // SMTP username
					$mail->Password = "3dIPTijkZB0L9d_p4iGkvg";                 // SMTP password
					
					$mail->SMTPSecure =  'tls';//'ssl';   						// Enable encryption, 'ssl' al
					$mail->SetFrom('info@c2zoom.com', 'c2zoom');
					
					
					//$mail->AddReplyTo("user2@gmail.com', 'First Last");
					
					$mail->Subject    = "C2Zoom forgot password link";
					
					//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
					$body='<table cellpadding="5" cellspacing="5" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;background-color:#E5E5E5">
						<tr>
						<td align="left" style="background-color:#333">
							<div><h3 style="color:#fff"><img src="themefiles/assets/admin/layout/img/logo.png" alt="C2Zoom" /></h3></div>
						</td>
						</tr>
						<tr>
						<td>Hello,</td>
						</tr>
						<tr>
						<td>Your forgot password verification code: <b>'.$fPassword.'</b><br /></td>
						</tr>
						<tr>
						<td>Forgot password reset link:<br /><a href="'.$emailLink.'">'.$emailLink.'</a>
						</td>
						</tr>
						<tr>
							<td>
							Thank you,
							</td>
						</tr>
						<tr>
							<td>
							Team C2Zoom.
							</td>
						</tr>
						<tr>
						<td>
							Please do not reply this mail.
						</td>
						</tr>
					</table>';
					
					$mail->MsgHTML($body);
					
					$address =  $_REQUEST['email'];
			
					$mail->AddAddress($address, "user");
	
/*---------------------------------------------email finish------------------------------------------------*/
					$mail->Send();
					echo json_encode(array('status'=>'1','message'=>'Reset password mail have sent to your email address.'));
					
				}
				catch(Exception $e)
				{
					
				}
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Email address is not registered with us.'));
			
		}
		
		}
		
	}
	
	
	
	// start doctor selection
	function actiongetdoctor_list()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				
			if(!isset($_REQUEST['start']))
			{
				$_REQUEST['start'] = 0;
			}
			if(!isset($_REQUEST['length']))
			{
				$_REQUEST['length'] = 10;
			}
			
			if(isset($_REQUEST['order'][0]['column']))
				{
					if($_REQUEST['order'][0]['column'] == 0)
					{ 
						$sort = "doctor_name";
					}
					if($_REQUEST['order'][0]['column'] == 1)
					{ 
						$sort = "isshare";
					}
					if($_REQUEST['order'][0]['column'] == 2)
					{ 
						$sort = "doc.qualification";
					}
					if($_REQUEST['order'][0]['column'] == 3)
					{ 
						$sort = "doc.doctor_mobile";
					}
					if($_REQUEST['order'][0]['column'] == 4)
					{ 
						$sort = "doctor_type";
					}
				}
				else
				{
					$sort = "doc.NAME";
				}
				
				if(isset($_REQUEST['order'][0]['dir']))
				{
					$sort_type = $_REQUEST['order'][0]['dir'];
				}
				else
				{
					$sort_type = "ASC";
				}
			
			
			$keyword = NULL;
			if(isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != '')
			{
				$keyword = $_REQUEST['search']['value'];
			}

			$DoctorMasterObj = new DoctorMaster();
			$doctorList = $DoctorMasterObj->getAllDoctorListForMobile($_REQUEST['patient_id'],$_REQUEST['start'],$_REQUEST['length'],$keyword,$sort,$sort_type);
			
			$DoctorMasterObj = new DoctorMaster();
			$doctorCount = $DoctorMasterObj->getAllDoctorListCountForMobile($_REQUEST['patient_id'],$keyword);
			
			 if(!empty($doctorList))
			 {
				
				 //echo "<pre>"; print_r($doctorList);
				 echo json_encode(array("status"=>1,"message"=>'success',"data"=>$doctorList,"recordsTotal"=>$doctorCount,"recordsFiltered"=>$doctorCount));
				 exit;
			 }
			 else
			 {
				 echo json_encode(array("status"=>0,"message"=>'Data Not Found.',"data"=>$doctorList,"recordsTotal"=>$doctorCount,"recordsFiltered"=>$doctorCount)); 
			 }
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
			
		}
	}
	
	function actionset_doctor_forpatient()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!isset($_REQUEST['doct_pat_relation_id']) && empty($_REQUEST['doct_pat_relation_id']))
			{
				echo json_encode(array("status"=>-4,"message"=>'doct_pat_relation_id parameter is not set.',"data"=>$doctorList)); exit;
			}
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
			// check record is exist or not
			$DoctorPatientRelationObj = new DoctorPatientRelation();
			$getdata = $DoctorPatientRelationObj->getDetailsById($_REQUEST['doct_pat_relation_id']);
			 
			//rint_r($getdata); die;
			 if(!empty($getdata))
			 {
				$result = array();
				$DoctorPatientRelationObj = new DoctorPatientRelation();
				$result['is_share'] = 1;
				$result['modified_at'] = date("Y-m-d:H-m-s");
				$DoctorPatientRelationObj->setData($result);
				$id = $DoctorPatientRelationObj->insertData($_REQUEST['doct_pat_relation_id']);
				//echo $id; die;
				$DoctorMasterObj = new DoctorMaster();
				$doctorList = $DoctorMasterObj->getAllDoctorList($_REQUEST['patient_id']);
				////echo "<pre>"; print_r($doctorList);
				echo json_encode(array("status"=>1,"message"=>'success',"data"=>$doctorList));
				exit;
			 }
			 else
			 {
				 echo json_encode(array("status"=>0,"message"=>'Data Not Found.',"data"=>$doctorList)); 
			 }
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
			
		}
	}
	
	function actiondelete_doctor_forpatient()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!isset($_REQUEST['doct_pat_relation_id']) && empty($_REQUEST['doct_pat_relation_id']))
			{
				echo json_encode(array("status"=>-4,"message"=>'doct_pat_relation_id parameter is not set.',"data"=>$doctorList)); exit;
			}
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
			// check record is exist or not
			$DoctorPatientRelationObj = new DoctorPatientRelation();
			$getdata = $DoctorPatientRelationObj->getDetailsById($_REQUEST['doct_pat_relation_id']);
			 
			//rint_r($getdata); die;
			 if(!empty($getdata))
			 {
				$result = array();
				$DoctorPatientRelationObj = new DoctorPatientRelation();
				$result['is_share'] = 0;
				$result['modified_at'] = date("Y-m-d:H-m-s");
				$DoctorPatientRelationObj->setData($result);
				$id = $DoctorPatientRelationObj->insertData($_REQUEST['doct_pat_relation_id']);
				
				$DoctorMasterObj = new DoctorMaster();
				$doctorList = $DoctorMasterObj->getAllDoctorList($_REQUEST['patient_id']);
				////echo "<pre>"; print_r($doctorList);
				echo json_encode(array("status"=>1,"message"=>'success',"data"=>$doctorList));
				exit;
				
			 }
			 else
			 {
				 echo json_encode(array("status"=>0,"message"=>'Data Not Found.',"data"=>$doctorList)); 
			 }
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
			
		}
	}
	
	function actionacceptRejectAppointment()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!isset($_REQUEST['appointment_id']) && empty($_REQUEST['appointment_id']))
			{
				echo json_encode(array("status"=>-4,"message"=>'appointment_id parameter is not set.',"data"=>$doctorList)); exit;
			}
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
		
		
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
					echo json_encode(array('status'=>'1','message'=>'Appointment accepted successfully.','data'=>$appointmentData['message']));
					die;
					
				}
				else if ($_REQUEST['appointment_status'] == 4)
				{
					$appointmentData['message'] = "Your appointment have been rejected on ".date('M d, Y',strtotime($appointmentData['modified_at'])).' with doctor '.Yii::app()->session['fullName'];
					echo json_encode(array('status'=>'1','message'=>'Appointment rejected successfully.','data'=>$appointmentData['message']));
					die;
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-3','message'=>' Invalid Parameter.'));
		}
	
	}
	
	function actiongetAllDocumentsForAPatient()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				/*print "<pre>";
				print_r($_REQUEST);
				die;*/
				
				
				if(!isset($_REQUEST['start']))
				{
					$_REQUEST['start'] = 0;
				}
				if(!isset($_REQUEST['length']))
				{
					$_REQUEST['length'] = 10;
				}
				
				if(isset($_REQUEST['order'][0]['column']))
				{
					if($_REQUEST['order'][0]['column'] == 0)
					{ 
						$sort = "document_master.documentname";
					}
					if($_REQUEST['order'][0]['column'] == 1)
					{ 
						$sort = "document_master.createddate";
					}
					if($_REQUEST['order'][0]['column'] == 2)
					{ 
						$sort = "patient_document_log.modifieddate";
					}
				}
				else
				{
					$sort = "document_master.documentid";
				}
				
				if(isset($_REQUEST['order'][0]['dir']))
				{
					$sort_type = $_REQUEST['order'][0]['dir'];
				}
				else
				{
					$sort_type = "ASC";
				}
				
				
				
				$keyword = NULL;
				if(isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != '')
				{
					$keyword = $_REQUEST['search']['value'];
				}

				$DocumentMasterObj = new DocumentMaster();
				$DocumentData = $DocumentMasterObj->getDocumentListMobile($_REQUEST['patient_id'],$_REQUEST['start'],$_REQUEST['length'],$keyword,$sort,$sort_type);
				
				$DocumentMasterObj = new DocumentMaster();
				$totalRecords = $DocumentMasterObj->getDocumentListCountForMobile($_REQUEST['patient_id'],$_REQUEST['start'],$_REQUEST['length'],$keyword);
				
				
				echo json_encode(array('status'=>'1','message'=>'success','data'=>$DocumentData,"recordsTotal"=>$totalRecords,"recordsFiltered"=>$totalRecords));
				die;
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-3','message'=>' Invalid Parameter.'));
		}
	}
	
	function actiongetAllSubmittedLog()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				
				if(!isset($_REQUEST['start']))
				{
					$_REQUEST['start'] = 0;
				}
				if(!isset($_REQUEST['length']))
				{
					$_REQUEST['length'] = 10;
				}
				
				if(isset($_REQUEST['order'][0]['column']))
				{
					if($_REQUEST['order'][0]['column'] == 0)
					{ 
						$sort = "document_master.documentname";
					}
					if($_REQUEST['order'][0]['column'] == 1)
					{ 
						$sort = "DoctorName";
					}
					if($_REQUEST['order'][0]['column'] == 2)
					{ 
						$sort = "document_submitted_log.submitteddate";
					}
				}
				else
				{
					$sort = "document_submitted_log.documentsubmittedlogid";
				}
				
				if(isset($_REQUEST['order'][0]['dir']))
				{
					$sort_type = $_REQUEST['order'][0]['dir'];
				}
				else
				{
					$sort_type = "DESC";
				}
				
				
				
				$keyword = NULL;
				if(isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != '')
				{
					$keyword = $_REQUEST['search']['value'];
				}
				
				$DocumentSubmittedLogObj = new DocumentSubmittedLog();
				$SubmittedDocumentData = $DocumentSubmittedLogObj->GetDocumentSubmittedLogListForMobile($_REQUEST['patient_id'],$_REQUEST['start'],$_REQUEST['length'],$keyword,$sort,$sort_type);
				
				$DocumentSubmittedLogObj = new DocumentSubmittedLog();
				$totalRecords = $DocumentSubmittedLogObj->GetDocumentSubmittedLogListForMobileCount($_REQUEST['patient_id'],$_REQUEST['start'],$_REQUEST['length'],$keyword);
				
				echo json_encode(array('status'=>'1','message'=>'success','data'=>$SubmittedDocumentData,"recordsTotal"=>$totalRecords,"recordsFiltered"=>$totalRecords));
				die;
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-3','message'=>' Invalid Parameter.'));
		}
	}
	
	function actionaddDocumentForms()
	{
	
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
				if( isset($_REQUEST['document_id']) && !empty($_REQUEST['document_id']))
				{
				//collect list of appointment for the logged in patient user.
				$PatientAppointmentObj = new Appointment();
				$PatientAppointmentData = $PatientAppointmentObj->getUpcommingAppointmentListByPatient($_REQUEST['patient_id']);
				$str = "";
				foreach ($PatientAppointmentData as $AppointmentData) { 
											$str .= '<option value="'.$AppointmentData['doctor_id'].'">'. $AppointmentData['name']." ".$AppointmentData['surname']. " (".date("m/d/Y h:i A", strtotime($AppointmentData['appointment_date']." ".$AppointmentData['appointment_time'])).")".'</option>';
				}
				$PatientAppointmentData['doctor_list'] = $str;
				
				echo json_encode(array('status'=>'1','message'=>'success','data'=>$PatientAppointmentData));
				}
				else
				{
					echo json_encode(array('status'=>'-8','message'=>'documentid is missing.'));	
				}
				
				die;
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-3','message'=>' Invalid Parameter.'));
		}
	}
	
	function actionsaveDocuments()
	{
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			$validationObj = new Validation();
			$res = $validationObj->saveDocuments($_REQUEST);
			if($res['status'] != 0)
			{
				echo json_encode(array('status'=>$res['status'] ,'message'=>$res['message'] ));
				die;
			}
			
			$patientObj = new PatientMaster();
			$sessionData = $patientObj->checksession($_REQUEST['patient_id'],$_REQUEST['session_id']);
			
			if(!empty($sessionData) && $sessionData['patient_id']!='')
			{
					
			$data = array();
			$data['modifieddate'] = date('Y-m-d H:i:s');
			
			$PatientDocumentLogObj = new PatientDocumentLog();			
			$PatientDocumentLogData = $PatientDocumentLogObj->getDocumentListByPatientAndDocument($_REQUEST['patient_id'],$_REQUEST['document_id']);
			
			$PatientDocumentLogObj->setData($data);
			$PatientDocumentLogData = $PatientDocumentLogObj->insertData($PatientDocumentLogData[0]['patientDocumentLogid']);
			//prepare dynamic PDF file and store it on physical location.
			if (isset($_POST['document_id']) && $_POST['document_id'] != '')
			{
				$PatientMasterObj = new PatientMaster();
				$patientData = $PatientMasterObj->getUserById($_REQUEST['patient_id']);
			
				$patientInfoQuestionnaire = new patientInfoQuestionnaire();
				$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId($_REQUEST['patient_id']);
			
				$patientDoctorObj = new DoctorPatientRelation();
				$doctorInfo = $patientDoctorObj->getPCPdetails_by_patientidArray($_REQUEST['patient_id']);
				$this->layout = 'documenttpl';
				ob_start();
				//$HTMLRenderContents = $this->render("patient_information_questionnaire",array("patientData"=>$patientData, "patientInfo"=>$patientInfo,'doctorInfo'=>$doctorInfo, 'isPDF'=>true), true);
				$this->render("patient_information_questionnaire",array("patientData"=>$patientData, "patientInfo"=>$patientInfo,'doctorInfo'=>$doctorInfo, 'isPDF'=>true));
				$HTMLRenderContents = ob_get_contents();
				ob_end_clean();
				$filename = $_REQUEST['patient_id']."_Patient_information_questionnaire_".date("Ymdhis").'.pdf';
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
						"documentid" => $_POST['document_id'],
						"patient_id" => $_REQUEST['patient_id'],
						"doctor_id" => $_POST['doctor'],
						"documentpdffile" => $filename,
						"submitteddate" => date("Y-m-d H:i:s"),
				);
				$DocumentSubmittedLogObj->setData($arrDocumentSubmittedLogData);
				$DocumentSubmittedLogObj->insertData();
				//send notification to doctor once document submitted.
				$DoctorNotification = array(
						'doctor_id' => $_POST['doctor'],
						'patient_id' => $_REQUEST['patient_id'],
						'form' => $filename,
						'created_at' => date("Y-m-d H:i:s")
				);
				
				$DoctorNotificationObj = new DoctorNotification();
				$DoctorNotificationObj->setData($DoctorNotification);
				$DoctorNotificationObj->insertData();
				
				$RegisterFormdata = array(
						'patient_questionnaire' => $filename,
						'patient_id' => $_REQUEST['patient_id'],
						'doctor_id' => $_POST['doctor'],
						'created_at' => date("Y-m-d H:i:s")
				);
				
				$PatientFormsHistoryObj =  new PatientFormsHistory();
				$PatientFormsHistoryObj->setData($RegisterFormdata);
				$PatientFormsHistoryObj->insertData();
				
				//$doctorObj = new DoctorMaster();
				//$doctorData = $doctorObj->getDoctorById($_POST['doctor']);
				
				//$message = $doctorData['name']." ".$doctorData['suranme']. "recieved your submitted documents at ".date("F d, Y H:i:s");
				
			}
			
			echo json_encode(array('status'=>'1','message'=>'Document Log added successfully.'));
			die;
		
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>' Invalid Sesssion.'));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-3','message'=>' Invalid Parameter.'));
		}
		
		
	}
	
	public function actiongetUpcomingAppointmentByPatient()
	{
			
		if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id'] != '' && isset($_REQUEST['session_id']) && $_REQUEST['session_id'] != '')
		{
			
			//collect list of appointment for the logged in patient user.
			$PatientAppointmentObj = new Appointment();
			$PatientAppointmentData = $PatientAppointmentObj->getUpcommingAppointmentListByPatient($_REQUEST['patient_id']);
			
			echo json_encode(array("status"=>1,"message"=>"Success","data"=>$PatientAppointmentData));
			
		}
		else
		{
			echo json_encode(array('status'=>'-3','message'=>' Invalid Parameter.'));
		}
		
	}
	
	
	public function actiongetPatientRegisterData()
	{
		
		$PatientMasterObj = new PatientMaster();
		$patientData = $PatientMasterObj->getUserById($_REQUEST['patient_id']);
		
		$PatientMedicalHistoryObj = new PatientMedicalHistory();
		$medicalData = $PatientMedicalHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$PatientSurgeryHistoryObj = new PatientSurgeryHistory();
		$surgoryData = $PatientSurgeryHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);	
		//$PatientFamilyHistoryObj = new PatientFamilyHistory();
		//$familyData = $PatientFamilyHistory->getdetailsByPatientId(Yii::app()->session['pingmydoctor_patient']);		
		
		$PatientHeighMesurmentObj = new HeightMeasurement();
		$patientHeightData = $PatientHeighMesurmentObj->getHeightDetailsByPatient($_REQUEST['patient_id']);
		
		$PatientWeightMesurmentObj = new WeightMeasurement();
		$patientWeightData = $PatientWeightMesurmentObj->getWeightDetailsByPatient($_REQUEST['patient_id']);
		
		$patientInfoQuestionnaire = new patientInfoQuestionnaire();
		$patientInfo = $patientInfoQuestionnaire->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$patientSocialHostoryObj = new PatientSocialHistory();
		$socialInfo = $patientSocialHostoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$pationtSymptomsHistoryObj = new PatientSymptomsHistory();
		$symptomsHistoryInfo = $pationtSymptomsHistoryObj->getsymptomsListByPatientWithName($_REQUEST['patient_id']);		
		
		$patientMedicationObj = new MedicationHealthHistory();
		$medicationHistoryData = $patientMedicationObj->getMedicationListByPatient($_REQUEST['patient_id'],6);		
		
		$allergiesObj = new AllergyHealthHistory();
		$allergiesData = $allergiesObj->getAllergyHealthHistoryListByPatient($_REQUEST['patient_id']);
		
		$anesthesiaObj = new PatientAnethesiaHistory();
		$anesthesiaData = $anesthesiaObj->getdetailsByPatientId($_REQUEST['patient_id']);
		
		$patientFamilyHistoryObj = new PatientFamilyHistory();
		$familyData = $patientFamilyHistoryObj->getdetailsByPatientId($_REQUEST['patient_id']);
		echo $this->renderPartial('//patient/New-Patient-Registration-Forms-content',array('patientInfo'=>$patientInfo,
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
	
		
	// end doctor
	
	function actionget_allcountry()
	{
		$CountryObj = new Country();
		$data = $CountryObj->getAllCountry();
		
		$result["status"] = "1";
		$result["message"] = "success";
		$result["data"] = $data ;
		echo json_encode($result);
	}
	function actionget_allstate()
	{
		if(!empty($_POST['country_id']))
		{
			$StateObj = new State();
			$data = $StateObj->getStatesByCountyId($_POST['country_id']);
			
			$result["status"] = "1";
			$result["message"] = "success";
			$result["data"] = $data ;
			echo json_encode($result);
		}
		else
		{
			echo json_encode(array("status"=>0,"message"=>"Please pass country_id.","data"=>''));
		}
	}
	
	function actionshowLogs()
	{
		$handle = @fopen("c2zoom.txt", "r");
		if ($handle) {
   		 while (($buffer = fgets($handle, 4096)) !== false) {
        	echo $buffer;
			echo "<br>";
    		}
    	if (!feof($handle)) {
        	echo " unexpected fgets() fail\n";
    	}
		}
    	fclose($handle);
	}

	function actionclearLogs()
	{
		$handle = fopen("c2zoom.txt", "w");
		fwrite($handle, '');
		fclose($handle);

	}
	
		
}
