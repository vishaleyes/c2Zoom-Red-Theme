<?php

date_default_timezone_set("Asia/Kolkata"); 
require_once("protected/extensions/phpmailer/class.phpmailer.php");
class AdminController extends Controller {

    public $algo;
    public $adminmsg;
	public $errorCode;
    private $msg;
    private $arr = array("rcv_rest" => 200370,"rcv_rest_expire" => 200371,"send_sms" => 200372,"rcv_sms" => 200373,"send_email" => 200374,"todo_updated" => 200375, "reminder" => 200376, "notify_users" => 200377,"rcv_rest_expire"=>200378,"rcv_android_note"=>200379,"rcv_iphone_note"=>200380);
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function beforeAction($action=NULL)
	{
		$this->msg = Yii::app()->params->adminmsg;
		$this->errorCode = Yii::app()->params->errorCode;
		return true;
	
	}

	
	/* =============== Content Of Check Login Session =============== */

    function isLogin() {
        if (isset(Yii::app()->session['pingmydoctor_admin'])) {
            return true;
        } else {
            Yii::app()->user->setFlash("error", "Username or password required");
            header("Location: " . Yii::app()->params->base_path . "admin");
            exit;
        }
    }

    function actionindex() 
	{
		if(isset(Yii::app()->session['pingmydoctor_admin'])){
			$this->redirect(array("admin/adminHome"));
		} else {
			$this->redirect(array("admin/adminLogin"));
		}
    }
	
	function actionLogin()
	{
		//unset(Yii::app()->session['pingmydoctor_admin']);
		$this->render("index");
	}
	
	function actionadminLogin()
	{
		
		if (isset($_POST['loginBtn'])) 
		{
			
			if($_POST['login'][0] == 'patient')
			{
				$this->redirect(array("patient/patientLoginFromAdmin",$_POST));
			}
			if($_POST['login'][0] == 'doctor')
			{
				$this->redirect(array("doctor/doctorLoginFromAdmin",$_POST));
			}
			
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
					
				$adminObj	=	new Admin();
				$admin_data	=	$adminObj->getadminDetailsByEmail($email);
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_POST['password'], $admin_data['password']);
			
			if ( $isValid === true ) {
				Yii::app()->session['pingmydoctor_admin'] = $admin_data['admin_id'];
				Yii::app()->session['email'] = $admin_data['email'];
				Yii::app()->session['name'] = $admin_data['name'];
				
				Yii::app()->session['active_tab'] = 'home';
				$this->redirect(array("admin/adminHome"));
			
				exit;
			} else {
				Yii::app()->user->setFlash("error","Email or Password is not valid");
				$this->redirect(array('admin/index'));
				exit;
			}	
		}
		else
		{
			$this->render("index");	
		}
	
	}
	
	function actionpatientforgotPassword()
	{
		error_reporting(0);
		if(isset($_POST['forgotPassword']))
		{
			$patientMasterObj = new PatientMaster();
			$patientData = $patientMasterObj->getUserDataByEmail($_POST['email']);
			
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
					Yii::app()->user->setFlash("success","Reset password mail have sent to your email address.");
                	$this->redirect('admin');
					
				}
				catch(Exception $e)
				{
					
				}
		}
		else
		{
			Yii::app()->user->setFlash("error","Email address is not registered with us.");
            $this->redirect(array('admin/patientforgotPassword'));
		}
		
		}
		$this->render("patientforgotPassword");
	}
	
	
	public function actionpatientResetPassword() 
	{
		$PatientMasterObj = new PatientMaster();
		$id = $PatientMasterObj->getIdByfpasswordConfirm($_REQUEST['fpassword']);
		
		if(empty($id))
		{
			Yii::app()->user->setFlash("error","Link is expire.");
            $this->redirect('admin');
			die;
		}
		$message = '';
       
        if ($message != '') {
			Yii::app()->user->setFlash("success",$message);
        }
        if( isset($_REQUEST['fPassword']) ) {
			$data['token']	=	trim($_REQUEST['fPassword']);
			$this->render('set_new_password',$data);
			exit;
		}
		$this->render('set_new_password');
    }
	
	public function actionSavePatientResetPassword()
	{
		 if (isset($_POST['submit_reset_password_btn']) && trim($_POST['token']) != "") {
        	$PatientMasterObj = new PatientMaster();
            $result = $PatientMasterObj->resetpassword($_POST);
			$message = $result['message'];
			
			if ($result['status'] == '0') {
				Yii::app()->user->setFlash("success",$message);
                $this->redirect('admin');
                exit;
            }
			else
			{
				Yii::app()->user->setFlash("error",$message);
                $this->redirect(array("admin/patientforgotPassword"));
				//header("Location: " . Yii::app()->params->base_path . 'api/resetpassword/');
                exit;
			}
        }
		else
		{
			Yii::app()->user->setFlash("error",$message);
            $this->redirect(array("admin/patientforgotPassword"));
			exit;
		}
	}	
	
		
	function actiondoctorforgotPassword()
	{
		
		if(isset($_POST['forgotPassword']))
		{
			$DoctorMasterObj = new DoctorMaster();
			$doctorData = $DoctorMasterObj->getdoctorDetailsByEmail($_POST['email']);
			
			if(isset($doctorData['email']) && $doctorData['email'] != '')
			{
				$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
											"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
											"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$fPassword = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$user =array();	
				$user['fpasswordconfirm'] = $fPassword;
				$DoctorMasterObj = new DoctorMaster();
				$DoctorMasterObj->setData($user);
				$DoctorMasterObj->insertData($doctorData['doctor_id']);
					
				$Yii = Yii::app();	
				$emailLink = $Yii->params->base_path."admin/doctorResetPassword/fpassword/".$fPassword;
				
				
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
					Yii::app()->user->setFlash("success","Reset password mail have sent to your email address.");
                	$this->redirect('admin');
					
				}
				catch(Exception $e)
				{
					
				}
		}
		else
		{
			Yii::app()->user->setFlash("error","Email account is not registered with us.");
            $this->redirect(array("admin/doctorforgotPassword"));
			exit;
		}
		
		}
		
		$this->render("doctorforgotPassword");
	}
	
	public function actiondoctorResetPassword() 
	{
		$DoctorMasterObj = new DoctorMaster();
		$id = $DoctorMasterObj->getIdByfpasswordConfirm($_REQUEST['fpassword']);
		
		if(empty($id))
		{
			Yii::app()->user->setFlash("error","Link is expire.");
            $this->redirect('admin');
			die;
		}
		$message = '';
       
        if ($message != '') {
			Yii::app()->user->setFlash("success",$message);
        }
        if( isset($_REQUEST['fpassword']) ) {
			$data['token']	=	trim($_REQUEST['fpassword']);
			$this->render('set_new_password_for_doctor',$data);
			exit;
		}
		$this->render('set_new_password_for_doctor');
    }
	
	public function actionSaveDoctorResetPassword()
	{
		 if (isset($_POST['submit_reset_password_btn']) && trim($_POST['token']) != "") {
        	$DoctorMasterObj = new DoctorMaster();
            $result = $DoctorMasterObj->resetpassword($_POST);
			$message = $result['message'];
			
			if ($result['status'] == '0') {
				Yii::app()->user->setFlash("success",$message);
                $this->redirect('admin');
                exit;
            }
			else
			{
				Yii::app()->user->setFlash("error",$message);
                $this->redirect(array("admin/doctorforgotPassword"));
				//header("Location: " . Yii::app()->params->base_path . 'api/resetpassword/');
                exit;
			}
        }
		else
		{
			Yii::app()->user->setFlash("error",$message);
            $this->redirect(array("admin/doctorforgotPassword"));
			exit;
		}
	}
	

	function actionLogout()
	{
		Yii::app()->session->destroy();
		$this->redirect(array("admin/index"));
	}
	
	function array_sort($array, $on, $order=SORT_ASC)
	{
		
			$new_array = array();
			$sortable_array = array();
		
			if (count($array) > 0) {
				foreach ($array as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if ($k2 == $on) {
								$sortable_array[$k] = $v2;
							}
						}
					} else {
						$sortable_array[$k] = $v;
					}
				}
		
				switch ($order) {
					case SORT_ASC:
						asort($sortable_array);
					break;
					case SORT_DESC:
						arsort($sortable_array);
					break;
				}
		
				foreach ($sortable_array as $k => $v) {
					$new_array[$k] = $array[$k];
				}
			}
			
			return $new_array;
	}
	
	function actionPrefferedLanguage($lang='eng')
	{
		if(isset(Yii::app()->session['pingmydoctor_admin']) && Yii::app()->session['pingmydoctor_admin']>0)
		{
			//$userObj=new User();
			//$userObj->setPrefferedLanguage(Yii::app()->session['userId'],$lang);
		}
		
		Yii::app()->session['prefferd_language']=$lang;
	
		$this->redirect(Yii::app()->params->base_path."admin/index");
	}

	
	function actiondashboard()
	{
		$this->isLogin();
		
		$adminObj = new Admin();
		$adminData = $adminObj->getAdminDetailsById(Yii::app()->session['pingmydoctor_admin']);
		
		Yii::app()->session['current']	=	'dashboard';
		$this->render("dashboard", array("adminData"=>$adminData));	
	}
	
	public function actionerror()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	function actionadminHome()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Home';
		$this->render("adminHome");
	}
	
	function actioncholesterolListing()
	{
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		
		$CholesterolMeasurementObj = new CholesterolMeasurement();	
		$cholesterolList = $CholesterolMeasurementObj->getAllCholesterolList();
		
		$this->render("cholesterolListing",array("cholesterolList"=>$cholesterolList));
	}
	
	function actionaddCholesterol()
	{
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		$this->render("addCholesterol");
	}
	
	function actionsaveCholesterol()
	{
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		
		if(isset($_REQUEST['saveCholesterol']))
		{
			$data = array();
			$data['admin_id'] = 1;
			$data['ldl'] = $_REQUEST['ldl'];
			$data['unit'] = $_REQUEST['ldl_unit'];
			$data['hdl'] = $_REQUEST['hdl'];
			$data['triglycerides'] = $_REQUEST['triglycerides'];
			$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['when']));
			$data['total'] = $_REQUEST['total'];
			$data['notes'] = $_REQUEST['notes'];
			$data['status']= 1;
			$data['created_at']= date("Y-m-d");
			
			if(!empty($data))
			{
				$CholesterolMeasurementObj = new CholesterolMeasurement();	
				$CholesterolMeasurementObj->setData($data);
				$insertedId = $CholesterolMeasurementObj->insertData();
				
				if( ( $insertedId!='' ) && ( !empty($insertedId) ) )
				{
					Yii::app()->user->setFlash("success", "Cholesterol data is inserted successfully");
					$this->render("addCholesterol");
				}
			}
		}
		
		
	}


	function actionpatientListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		$PatientMasterObj = new PatientMaster();	
		$patientList = $PatientMasterObj->getAllPatientList();
		
		$this->render("patientListing",array("patientList"=>$patientList));
		
	}
	
	function actionaddPatient()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		if( ( isset($_REQUEST['patient_id']) ) && ( $_REQUEST['patient_id']!='' ) )
		{
			$PatientMasterObj = new PatientMaster();	
			$patientData = $PatientMasterObj->getUserById($_REQUEST['patient_id']);
			
			$this->render("addPatient",array('patientData'=>$patientData));
		}
		else
		{
			$this->render("addPatient");
		}
	}
	
	function actionsavePatient()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		if( ( isset($_REQUEST['patient_id']) ) && ( $_REQUEST['patient_id']!='' ) )
		{
			if(isset($_POST['savePatientProfile']))
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
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
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') )
				{
				
				if(isset($_FILES['patient_image']['name']) && $_FILES['patient_image']['name'] != "")
				 {
					$data['patient_image']= "patient_".$_REQUEST['patient_id'].".png";
					move_uploaded_file($_FILES['patient_image']["tmp_name"],"assets/upload/avatar/patient/".$data['patient_image']);
				 }
				
				$data['modified_at'] = date("Y-m-d H:i:s");
				
				$PatientMaster = new PatientMaster();
				$emailData = $PatientMaster->checkEmailId($data['email']);
					
					if( ( $emailData=="" || $emailData==NULL ) || ( $emailData['patient_id'] == $_REQUEST['patient_id'] ) )
					{
						try 
						{
							$PatientMaster = new PatientMaster();
							$PatientMaster->setData($data);
							$PatientMaster->insertData($_REQUEST['patient_id']);
							Yii::app()->user->setFlash("success", "Patient data is updated successfully");
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Patient Data.");
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addPatient",array('patientData'=>$data,'patient_id'=>$_REQUEST['patient_id']));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Patient Name and Email are Required.");
					$this->render("addPatient",array('patientData'=>$data,'patient_id'=>$_REQUEST['patient_id']));
				}
				
				$this->redirect(array("admin/patientListing"));
				
					
			}
		}
		else
		{
			if(isset($_POST['savePatientProfile']))
			{
				$data = array();
				
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
				else
				{
					$data['gender'] = 2;
				}
				if(isset($_POST['marital_status']) && $_POST['marital_status']!='')
				{
					$data['marital_status'] = $_POST['marital_status'];	
				}
				else
				{
					$data['marital_status'] = 5;	
				}
				if(isset($_POST['address']) && $_POST['address']!='')
				{
					$data['address'] = $_POST['address'];	
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
				else
				{
					$data['blood_group'] = 0;
				}
				if(isset($_POST['organ_donor']) && $_POST['organ_donor']=='on')
				{
					$data['organ_donor'] = 1;	
				}
				else
				{
					$data['organ_donor'] = 0;	
				}
				
				if(isset($_POST['password']) && $_POST['password']!='')
				{
					$generalObj = new General();
					$data['password'] = $generalObj->encrypt_password($_POST['password']);
				}
				
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') && ( isset($data['password']) && $data['password']!='') )
				{
					$PatientMaster = new PatientMaster();
					$emailData = $PatientMaster->checkEmailId($data['email']);
					
					if($emailData=="" || $emailData==NULL)
					{
						
					$PatientMaster = new PatientMaster();
					$PatientMaster->setData($data);
					
						try {
						$inserted_id = $PatientMaster->insertData();
						
							if( ( $inserted_id!='' ) && ( !empty($inserted_id) ) )
								{
									if(isset($_FILES['patient_image']['name']) && $_FILES['patient_image']['name'] != "")
									 {
										$image_data = array();
										$image_data['patient_image']= "patient_".$inserted_id.".png";
										move_uploaded_file($_FILES['patient_image']["tmp_name"],"assets/upload/avatar/patient/".$image_data['patient_image']);	 
										
										$PatientMaster->setData($image_data);
										$PatientMaster->insertData($inserted_id);
									 }
									
									Yii::app()->user->setFlash("success", "Patient data is inserted successfully");
									$this->render("addPatient");
								}
							else{
									Yii::app()->user->setFlash("error", "Patient data is not inserted successfully.");
									$this->render("addPatient");
								}
						}
						catch(Exception $e)
						{
								Yii::app()->user->setFlash("error", "Error in insertion of Patient.");
								$this->render("addPatient");
						}
					}
					else
					{
						//$data['email'] = '';
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addPatient",array('patientData'=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Patient Name and Email and Password are Required.");
					$this->render("addPatient",array('patientData'=>$data));
				}
				
			}
		
		}
		
		
	}
	
	function actiondeletePatient()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		if( ( isset($_REQUEST['patient_id']) ) && ( $_REQUEST['patient_id']!='' ) )
		{
			$DoctorPatientRelation = new DoctorPatientRelation();
			$doctor_data = $DoctorPatientRelation->getdetails_by_patientid($_REQUEST['patient_id']);
			
			if(!empty($doctor_data))
			{
				Yii::app()->user->setFlash("error", "Reference records found for this patient. so you can not delete this patient at this moment.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				die;
			}
			
			$PatientMasterObj = new PatientMaster();
			try {	
				$patientData = $PatientMasterObj->deletePatient($_REQUEST['patient_id']);
				Yii::app()->user->setFlash("success", "Patient is deleted successfully");
			}
			catch(Exception $e)
			{
				Yii::app()->user->setFlash("error", "Error in deletion of Patient.");
			}
			
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	
	
	function actiondoctorListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		$DoctorMasterObj = new DoctorMaster();	
		$doctorList = $DoctorMasterObj->getAllDoctorsForAdmin();
	
		$this->render("doctorListing",array("doctorList"=>$doctorList));
		
	}
	
	function actionaddDoctor()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		if( ( isset($_REQUEST['doctor_id']) ) && ( $_REQUEST['doctor_id']!='' ) )
		{
			$DoctorMasterObj = new DoctorMaster();	
			$doctorData = $DoctorMasterObj->getDoctorById($_REQUEST['doctor_id']);
			
			$this->render("addDoctor",array('doctorData'=>$doctorData));
		}
		else
		{
			$this->render("addDoctor");
		}
	}
	
	function actionsaveDoctor()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		if( ( isset($_REQUEST['doctor_id']) ) && ( $_REQUEST['doctor_id']!='' ) )
		{
			if(isset($_POST['saveDoctorProfile']))
			{
				$data = array();
				$data['doctor_id'] = $_REQUEST['doctor_id'];
				
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
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') )
				{
					
				if(isset($_FILES['doctor_image']['name']) && $_FILES['doctor_image']['name'] != "")
				 {
					$data['doctor_image']= "doctor_".$_REQUEST['doctor_id'].".png";
					move_uploaded_file($_FILES['doctor_image']["tmp_name"],"assets/upload/avatar/doctor/".$data['doctor_image']);
				 }
				
				$data['modified_at'] = date("Y-m-d H:i:s");
				
				$DoctorMaster = new DoctorMaster();
				$emailData = $DoctorMaster->checkEmailId($data['email']);
					
					if( ( $emailData=="" || $emailData==NULL ) || ( $emailData['doctor_id'] == $_REQUEST['doctor_id'] ) )
					{
						try 
						{
							$DoctorMaster = new DoctorMaster();
							$DoctorMaster->setData($data);
							$DoctorMaster->insertData($_REQUEST['doctor_id']);
							Yii::app()->user->setFlash("success", "Doctor data is updated successfully");
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Doctor Data.");
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addDoctor",array('doctorData'=>$data,'doctor_id'=>$_REQUEST['doctor_id']));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Doctor Name and Email are Required.");
					$this->render("addDoctor",array('doctorData'=>$data,'doctor_id'=>$_REQUEST['doctor_id']));
				}
				
				$this->redirect(array("admin/doctorListing"));
					
			}
		}
		else
		{
			if(isset($_POST['saveDoctorProfile']))
			{
				$data = array();
				
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
				else
				{
					$data['gender'] = 2;
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
				
				if(isset($_POST['qualification']) && $_POST['qualification']!='')
				{
					$data['qualification'] = $_POST['qualification'];	
				}
				if(isset($_POST['doctor_spec_id']) && $_POST['doctor_spec_id']!='')
				{
					$data['doctor_spec_id'] = $_POST['doctor_spec_id'];	
				}
				if(isset($_POST['password']) && $_POST['password']!='')
				{
					$generalObj = new General();
					$data['password'] = $generalObj->encrypt_password($_POST['password']);
				}
				
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') && ( isset($data['password']) && $data['password']!='') )
				{
					$DoctorMaster = new DoctorMaster();
					$emailData = $DoctorMaster->checkEmailId($data['email']);
					
					if($emailData=="" || $emailData==NULL)
					{
					$DoctorMaster = new DoctorMaster();
					$DoctorMaster->setData($data);
					
						try {
						$inserted_id = $DoctorMaster->insertData();
						
							if( ( $inserted_id!='' ) && ( !empty($inserted_id) ) )
								{
									if(isset($_FILES['doctor_image']['name']) && $_FILES['doctor_image']['name'] != "")
									 {
										$image_data = array();
										$image_data['doctor_image']= "doctor_".$inserted_id.".png";
										move_uploaded_file($_FILES['doctor_image']["tmp_name"],"assets/upload/avatar/doctor/".$image_data['doctor_image']);	 
										
										$DoctorMaster->setData($image_data);
										$DoctorMaster->insertData($inserted_id);
									 }
									
									Yii::app()->user->setFlash("success", "Doctor data is inserted successfully");
									$this->render("addDoctor");
								}
							else{
									Yii::app()->user->setFlash("error", "Doctor data is not inserted successfully.");
									$this->render("addDoctor");
								}
						}
						catch(Exception $e)
						{
								Yii::app()->user->setFlash("error", "Error in insertion of Doctor.");
								$this->render("addDoctor");
						}
					}
					else
					{
						//$data['email'] = '';
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addDoctor",array('doctorData'=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Doctor Name and Email and Password are Required.");
					$this->render("addDoctor");
				}
				
			}
		
		}
		
		
	}
	
	function actiondeleteDoctor()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		if( ( isset($_REQUEST['doctor_id']) ) && ( $_REQUEST['doctor_id']!='' ) )
		{
			$docPatRelation = new DoctorPatientRelation();
			$doctPatData = $docPatRelation->checkDoctorRelation($_REQUEST['doctor_id']);
			
			if(!empty($doctPatData))
			{
				Yii::app()->user->setFlash("error", "Reference found for this doctor. so you can not delete this doctor.");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				die;
			}
			$DoctorMasterObj = new DoctorMaster();
			try {	
				$DoctorMasterObj->deleteDoctor($_REQUEST['doctor_id']);
				Yii::app()->user->setFlash("success", "Doctor is deleted successfully");
			}
			catch(Exception $e)
			{
				Yii::app()->user->setFlash("error", "Error in deletion of Doctor.");
			}
			
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	
	function actionprofile()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = 'Profile';
		
		$Admin = new Admin();
		$adminData = $Admin->getAdminById(Yii::app()->session['pingmydoctor_admin']);
		
		$this->render("profile",array("adminData"=>$adminData));
	}
	
	function actionsaveProfile()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = 'Profile';
		
		if(isset(Yii::app()->session['pingmydoctor_admin']) && (Yii::app()->session['pingmydoctor_admin']!=''))
		{
			if(isset($_POST['saveAdminProfile']))
			{
				$data = array();
				
				if( ( isset($_POST['name'] ) ) && ( $_POST['name']!='' ) )
				{
					$data['name'] = $_POST['name'];
				}
				
				if( ( isset($_POST['password'] ) ) && ( $_POST['password']!='' ) )
				{
					$Admin = new Admin();
					$admin_data = $Admin->getAdminById(Yii::app()->session['pingmydoctor_admin']);
				
					if ( $_POST['password'] != $admin_data['password'] ) 
					{
						$generalObj = new General();
						$data['password'] = $generalObj->encrypt_password($_POST['password']);
					}
					
				}
				
				if( ( !empty($data) ) && ( $data!='' ))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					try 
						{
							$Admin = new Admin();
							$Admin->setData($data);
							$Admin->insertData(Yii::app()->session['pingmydoctor_admin']);
							Yii::app()->user->setFlash("success", "Profile data is updated successfully");
							$this->redirect(array("admin/profile"));
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Profile.");
							$this->redirect(array("admin/profile"));
						}
				}
			}
			else
			{
				$this->redirect(array("admin/profile"));
			}
			
		}
	}
	
	function actiondoctorRegister()
	{
		
		if(isset($_POST) && isset($_POST['register-btn']))
		{
			
			if(isset($_POST['email']) && $_POST['email'] == '')
			{
				Yii::app()->user->setFlash("error", "Email is required.");
				$this->redirect(array("admin/"));
			}
			
			if(isset($_POST['password']) && $_POST['password'] == '')
			{
				Yii::app()->user->setFlash("error", "Password is required.");
				$this->redirect(array("admin/"));
			}
			
			$doctorMasterObj = new DoctorMaster();
			$doctorData = $doctorMasterObj->checkEmailId($_POST['email']);
			if(isset($doctorData) && !empty($doctorData))
			{
				Yii::app()->user->setFlash("error", "Email already exist.");
				$this->redirect(array("admin/index"));
				die;
			}
			else
			{
				$validationOBJ = new Validation();
				$res = $validationOBJ->doctorSignup($_POST);
				
				if($res['status']==0)
				{
					$data = array();
					$data['name'] = $_POST['name'];
					$data['surname'] = $_POST['surname'];
					$data['email'] = $_POST['email'];
					$data['doctor_mobile'] = $_POST['mobile_number'];
					$data['dob'] = $_POST['birth_date'];
					$data['address'] = $_POST['address'];
					$data['qualification'] = $_POST['qualitification'];
					$generalObj = new General();
					$data['password'] = $generalObj->encrypt_password($_POST['password']);
					$data['country'] = $_POST['country'];
					$data['is_verified'] = 1;
					$data['status'] = 1;
					$data['created_at'] = date("Y-m-d H:i:s");
					
					$doctorMasterObj = new DoctorMaster();
					$doctorMasterObj->setData($data);
					$doctorMasterObj->insertData();
					
					Yii::app()->user->setFlash("success", "You are successfully register.");
					$this->redirect(array("admin/index"));
					die;
				}
				else
				{
					Yii::app()->user->setFlash("error", $res['message']);
					$this->render("doctorRegister",array('$_POST'=>$_POST));
					die;
				}
			}
						
		}
		
		$this->render("doctorRegister");
	}
	
	function actionpatientRegister()
	{
		
		if(isset($_POST) && isset($_POST['register-btn']))
		{
			if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != '')
			{
				
			
			
				if(isset($_POST['email']) && $_POST['email'] == '')
				{
					Yii::app()->user->setFlash("error", "Email is required.");
					$this->render("patientRegister");die;
				}
				
				if(isset($_POST['password']) && $_POST['password'] == '')
				{
					Yii::app()->user->setFlash("error", "Password is required.");
					$this->render("patientRegister");die;
				}
				
				$validationOBJ = new Validation();
				$res = $validationOBJ->patientSignup($_POST);
				
				if($res['status']==0)
				{
				
				
					$PatientMasterObj = new PatientMaster();
					$patientData = $PatientMasterObj->checkEmailId($_POST['email']);
					if(isset($patientData) && !empty($patientData))
					{
						Yii::app()->user->setFlash("error", "Email already exist.");
						$this->render("patientRegister");
						die;
					}
					else
					{
						$data = array();
						$data['name'] = $_POST['name'];
						$data['surname'] = $_POST['surname'];
						$data['email'] = $_POST['email'];
						$data['phone_number'] = $_POST['phone_number'];
						$data['dob'] = date("Y-m-d",strtotime($_POST['birth_date']));
						//$data['address'] = $_POST['address'];
						if(isset($_POST['gender']) && $_POST['gender'] != '')
						{
							$data['gender'] = $_POST['gender'];
						}
						$generalObj = new General();
						$data['password'] = $generalObj->encrypt_password($_POST['password']);
						if(isset($_POST['country_code']) && $_POST['country_code'] != ''){
							$data['country_code'] = $_POST['countrycode'];
						}
						if(isset($_POST['promotional_offer']) && $_POST['promotional_offer'] != '')
						{
							$data['promotional_offer'] = $_POST['promotional_offer'];
						}
						if(isset($_POST['country']) && $_POST['country'] != '')
						{
							$data['country_id'] = $_POST['country'];
						}
						$data['is_verified'] = 1;
						$data['status'] = 1;
						$data['created_at'] = date("Y-m-d H:i:s");
						
						$PatientMasterObj = new PatientMaster();
						$PatientMasterObj->setData($data);
						$PatientMasterObj->insertData();
						
						Yii::app()->user->setFlash("success", "You are successfully register.");
						$this->redirect(array("admin/index"));
						die;
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", $res['message']);
					$this->render("patientRegister",array('$_POST'=>$_POST));
					die;
				}
			}
			else
			{
				Yii::app()->user->setFlash("error", "Invalid captcha code.");
				$this->render("patientRegister",array('$_POST'=>$_POST));
				die;
			}
						
		}
		
		$this->render("patientRegister");
	}
	
	
	public function actionserviceAgreement()
	{
		$this->render("serviceAgreement");
	}
	
	public function actionprivacy()
	{
		$this->render("privacy");
	}
	
	public function actionstaticPageListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'StaticPage';		
		$staticPageObj = new CmsPage();	
		$staticPageList = $staticPageObj->getAllStaticPageList();
		$this->render("staticPageListing",array("staticPageList"=>$staticPageList));		
	}
	
	public function actioneditStaticPage()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'StaticPage';
		
		if( ( isset($_REQUEST['pageid']) ) && ( $_REQUEST['pageid']!='' ) )
		{
			$staticPageObj = new CmsPage();	
			$staticPageData = $staticPageObj->getStaticPageById($_REQUEST['pageid']);
				
			$this->render("editStaticPage",array('staticPageData'=>$staticPageData));
		}		
	}

	function actionsaveStaticPage()
	{		
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'StaticPage';
		
		if( ( isset($_REQUEST['pageid']) ) && ( $_REQUEST['pageid']!='' ) )
		{
			if(isset($_POST['saveStaticPage']))
			{				
				$data = array();
				
				if( isset($_REQUEST['pagetitle']) && $_REQUEST['pagetitle']!='' )
					$data['pagetitle'] = $_REQUEST['pagetitle'];
				
				if( isset($_REQUEST['pagedescription']) && $_REQUEST['pagedescription']!='' )
					$data['pagedescription'] = $_REQUEST['pagedescription'];
				
				if(!empty($data['pagetitle']) && !empty($data['pagetitle']))
				{
					$data['updateddate'] = date("Y-m-d H:i:s");
					
					$staticPageObj = new CmsPage();		
					$transaction=Yii::app()->db->beginTransaction();
					
					try
					{
					 	$staticPageObj=CmsPage::model()->findByPk($_REQUEST['pageid']);
					 	$staticPageObj->attributes=$data;
					 	if($staticPageObj->save()) // save the change to database 
						{
							$transaction->commit();        
           				
							Yii::app()->user->setFlash("success", "Static Page data is updated successfully");
							$this->redirect(array("admin/staticPageListing"));
						}
						else
						{
							Yii::app()->user->setFlash("error", "Problem is occured in Static Page Updation.");
							$this->render("editStaticPage",array("staticPageData"=>$data));
						}
					}
					catch(Exception $e) // an exception is raised if a query fails
					{
    					$transaction->rollback();
						Yii::app()->user->setFlash("error", "Problem is occured in Static Page Updation.");
						$this->render("editStaticPage",array("staticPageData"=>$data));
					}
				}				
			}
		}		
	}	
}
//classs