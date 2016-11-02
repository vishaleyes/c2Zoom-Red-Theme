<?php

/**
 * This is the model class for table "patient_master".
 *
 * The followings are the available columns in table 'patient_master':
 * @property integer $patient_id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $phone_number
 * @property string $dob
 * @property integer $gender
 * @property integer $blood_group
 * @property string $patient_image
 * @property string $address
 * @property integer $marital_status
 * @property integer $organ_donor
 * @property string $is_verified
 * @property string $session_id
 * @property integer $login_type
 * @property string $fpasswordconfirm
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class PatientMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'patient_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('name, email, created_at', 'required'),
			array('gender, blood_group, marital_status, organ_donor, login_type, status', 'numerical', 'integerOnly'=>true),
			array('name, surname', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
			array('password, address, is_verified, session_id, fpasswordconfirm', 'length', 'max'=>255),
			array('phone_number', 'length', 'max'=>30),
			array('dob, patient_image, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_id, name, surname, email, password, phone_number, dob, gender, blood_group, patient_image, address, marital_status, organ_donor, is_verified, session_id, login_type, fpasswordconfirm, status, created_at, modified_at', 'safe', 'on'=>'search'),
		);*/
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'patient_id' => 'Patient',
			'name' => 'Name',
			'surname' => 'Surname',
			'email' => 'Email',
			'password' => 'Password',
			'phone_number' => 'Phone Number',
			'dob' => 'Dob',
			'gender' => 'Gender',
			'blood_group' => 'Blood Group',
			'patient_image' => 'Patient Image',
			'address' => 'Address',
			'marital_status' => 'Marital Status',
			'organ_donor' => 'Organ Donor',
			'is_verified' => 'Is Verified',
			'session_id' => 'Session',
			'login_type' => 'Login Type',
			'fpasswordconfirm' => 'Fpasswordconfirm',
			'status' => 'Status',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('blood_group',$this->blood_group);
		$criteria->compare('patient_image',$this->patient_image,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('marital_status',$this->marital_status);
		$criteria->compare('organ_donor',$this->organ_donor);
		$criteria->compare('is_verified',$this->is_verified,true);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('login_type',$this->login_type);
		$criteria->compare('fpasswordconfirm',$this->fpasswordconfirm,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	// set the user data
	function setData($data)
	{
		$this->data = $data;
	}
	
	// insert the user
	function insertData($id=NULL)
	{
		if($id!=NULL)
		{
			$transaction=$this->dbConnection->beginTransaction();
			try
			{
				$post=$this->findByPk($id);
				if(is_object($post))
				{
					$p=$this->data;
					
					foreach($p as $key=>$value)
					{
						$post->$key=$value;
					}
					$post->save(false);
				}
				$transaction->commit();
			}
			catch(Exception $e)
			{						
				$transaction->rollBack();
			}
			
		}
		else
		{
			$p=$this->data;
			foreach($p as $key=>$value)
			{
				$this->$key=$value;
			}
			$this->setIsNewRecord(true);
			$this->save(false);
			return Yii::app()->db->getLastInsertID();
		}
		
	
	
	}
	
	function getUserDataByEmail($email)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('email=:email',
							 array(':email'=>$email))	
					->queryRow();
		
		return $result;
	}
	
	public function getUserById($patient_id=NULL, $fields='*')
	{
		$result = Yii::app()->db->createCommand()
    	->select($fields)
    	->from($this->tableName())
   	 	->where('patient_id=:patient_id', array(':patient_id'=>$patient_id))	
   	 	->queryRow();
		
		return $result;
	}
	
	//Check Session
	function checksession($patient_id=NULL,$session_id=NULL)
	{
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('patient_id=:patient_id and session_id=:session_id', array(':patient_id'=>$patient_id,':session_id'=>$session_id))
		->queryRow();
		
		return $result;
	}
	
	function getPatientDetailsByEmail($email,$fields="*")
	{
		$patient_data	=	Yii::app()->db->createCommand()

						->select($fields)

						->from($this->tableName())

						->where('email=:email and status=:status', array(':email'=>$email,':status'=>1))

						->queryRow();


		return $patient_data;

	}
	
	function getPatientListByDoctor($doctor_id)
	{
		$sql = "SELECT * FROM patient_master WHERE STATUS=1 AND patient_id IN (
 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".$doctor_id.") ";
	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getAllPatientList()
	{
		$sql = "select * from patient_master where status=1 ";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function deletePatient($patient_id)
	{
		$sql = "update patient_master set status=0,modified_at='".date("Y-m-d H:i:s")."' 
				where patient_id='".$patient_id."' ";	
		$result	= Yii::app()->db->createCommand($sql)->execute();
		return $result;
	}
	
	function checkEmailId($email)
	{			
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('email=:email', array(':email'=>$email))
		->queryRow();
			
		return $result ;
	}
	
	function getNameByPatientId($patient_id)
	{
		$sql = " select concat(name,' ',surname) as patient from patient_master where patient_id='".$patient_id."' ";	
		$result	= Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
	function getPasswordById($id)
	{
		$sql = "select password from patient_master where patient_id= ".$id."";
		$result	=Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
	function getpatientdata($id)
	{
		$sql = "select * from patient_master where patient_id= ".$id."";
		$result	=Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function resetpassword($data)
	{
		
		if($data['token']!='')
		{
			if(strlen($data['new_password'])>=6)
			{
				if($data['new_password']==$data['new_password_confirm'])
				{
					$generalObj = new General();
					$algoObj = new Algoencryption();
					$PatientMasterObj=new PatientMaster();
					$id=$PatientMasterObj->getIdByfpasswordConfirm($data['token']);
					
					if($id > 0)
					{
						$new_password =$generalObj->encrypt_password($data['new_password']);
						$User_field['password'] = $new_password;
						$User_field['fpasswordconfirm']= '1';
						
						$this->setData($User_field);
						$this->insertData($id);
				
						return array("status"=>'0',"message"=>"Succefully changed password.");						
					}
					else
					{
						return array('status'=>-1,"message"=>"No User match.");
					}	
				}
				else
				{
					return array('status'=>-2,'message'=>"New password and confirm password does not match.");
				}
			}
			else
			{
				return array('status'=>-3,"message"=>"Password should be minimum six characters.");
			}
		}
		else
		{
			return array('status'=>-4,"message"=>"Invalid token.");
		}
	}
	
	
	function getIdByfpasswordConfirm($token)
	{
		$result = Yii::app()->db->createCommand()
		->select('patient_id')
		->from($this->tableName())
		->where('fpasswordconfirm=:fpasswordconfirm', array(':fpasswordconfirm'=>$token))
		->queryScalar();
		
		return $result;
	}
	
	function deletePatientAccount($patient_id)
	{
		$sql = "CALL deletePatientAccount(".$patient_id."); ";
		$result	=Yii::app()->db->createCommand($sql)->execute();
		return $result;
	}
	
	
}