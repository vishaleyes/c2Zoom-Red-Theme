<?php

/**
 * This is the model class for table "doctor_master".
 *
 * The followings are the available columns in table 'doctor_master':
 * @property integer $doctor_id
 * @property string $doctor_name
 * @property integer $gender
 * @property string $dob
 * @property string $address
 * @property string $doctor_image
 * @property integer $doctor_spec_id
 * @property string $qualification
 * @property string $doctor_mobile
 * @property string $email
 * @property string $password
 * @property integer $login_type
 * @property string $session_id
 * @property string $is_verified
 * @property string $fpasswordconfirm
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class DoctorMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DoctorMaster the static model class
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
		return 'doctor_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doctor_name, email, created_at', 'required'),
			array('gender, doctor_spec_id, login_type, status', 'numerical', 'integerOnly'=>true),
			array('doctor_name', 'length', 'max'=>100),
			array('address, password, session_id, is_verified, fpasswordconfirm', 'length', 'max'=>255),
			array('qualification, email', 'length', 'max'=>150),
			array('doctor_mobile', 'length', 'max'=>60),
			array('dob, doctor_image, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('doctor_id, doctor_name, gender, dob, address, doctor_image, doctor_spec_id, qualification, doctor_mobile, email, password, login_type, session_id, is_verified, fpasswordconfirm, status, created_at, modified_at', 'safe', 'on'=>'search'),
		);
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
			'doctor_id' => 'Doctor',
			'doctor_name' => 'Doctor Name',
			'gender' => 'Gender',
			'dob' => 'Dob',
			'address' => 'Address',
			'doctor_image' => 'Doctor Image',
			'doctor_spec_id' => 'Doctor Spec',
			'qualification' => 'Qualification',
			'doctor_mobile' => 'Doctor Mobile',
			'email' => 'Email',
			'password' => 'Password',
			'login_type' => 'Login Type',
			'session_id' => 'Session',
			'is_verified' => 'Is Verified',
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

		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('doctor_name',$this->doctor_name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('doctor_image',$this->doctor_image,true);
		$criteria->compare('doctor_spec_id',$this->doctor_spec_id);
		$criteria->compare('qualification',$this->qualification,true);
		$criteria->compare('doctor_mobile',$this->doctor_mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('login_type',$this->login_type);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('is_verified',$this->is_verified,true);
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
	
	function getdoctorDetailsByEmail($email,$fields="*")
	{
		$patient_data	=	Yii::app()->db->createCommand()

						->select($fields)

						->from($this->tableName())

						->where('email=:email and status=:status', array(':email'=>$email,':status'=>1))

						->queryRow();


		return $patient_data;

	}
	
	function getAllDoctorList($PatientId=NULL)
	{
		// $sql = "select * , CONCAT(NAME,' ',surname)AS doctor_name from doctor_master  where status=1 ";	
		/* $sql = "SELECT doc.* , 
CONCAT(doc.NAME,' ',doc.surname)AS doctor_name,
CASE WHEN rel.doctor_id = doc.doctor_id THEN 'Yes' ELSE 'No' END AS isrelation

 FROM doctor_master doc
 LEFT JOIN doctor_patient_relation rel ON rel.doctor_id = doc.doctor_id where doc.status=1 ";*/
 
		// Wrong query commented
 			/* $sql = "SELECT doc.*,a.doctor_name,
CASE WHEN a.isrelation = 'Yes' THEN 'Yes' ELSE 'No' END AS isrelation,a.doctor_type,a.doct_pat_relation_id,a.is_share

FROM  (
SELECT doc.* , 
CONCAT(doc.NAME,' ',doc.surname)AS doctor_name,rel.doct_pat_relation_id,rel.is_share,
CASE WHEN rel.doctor_id = doc.doctor_id THEN 'Yes' ELSE 'No' END AS isrelation,
CASE WHEN rel.doctor_type = 1 THEN 'PCP' WHEN rel.doctor_type = 2 THEN 'ACP'  ELSE '-' END AS doctor_type
FROM doctor_master doc
LEFT JOIN doctor_patient_relation rel ON rel.doctor_id = doc.doctor_id 
WHERE doc.status=1 AND patient_id = ".Yii::app()->session['pingmydoctor_patient']."
) a  RIGHT JOIN doctor_master doc ON doc.doctor_id = a.doctor_id ORDER BY doc.NAME ASC"; */

		if (is_null($PatientId))
		{
			$PatientId = Yii::app()->session['pingmydoctor_patient'];
		}
		$sql = "SELECT 
				doc.*,
				CONCAT(doc.NAME,' ',doc.surname)AS doctor_name,
				rel.doct_pat_relation_id,
				rel.is_share, 
				CASE WHEN rel.doctor_id = doc.doctor_id THEN 'Yes' ELSE 'No' END AS isrelation, 
				CASE WHEN rel.doctor_type = 1 THEN 'PCP' WHEN rel.doctor_type = 2 THEN 'ACP' ELSE '-' END AS doctor_type,
				CASE WHEN rel.is_share = 1 THEN 'Yes' WHEN rel.is_share = 0 THEN 'No' ELSE '-' END AS isshare
			FROM
				doctor_master as doc
			LEFT JOIN 
				doctor_patient_relation rel
			ON
				(rel.doctor_id=doc.doctor_id AND rel.patient_id=".$PatientId.")
			WHERE
				doc.status=1
			ORDER BY 
			 	doc.NAME ASC";
				
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getAllDoctorListNotinPCP($PatientId=NULL,$doctor_id)
	{
		
		if (is_null($PatientId))
		{
			$PatientId = Yii::app()->session['pingmydoctor_patient'];
		}
		$sql = "SELECT 
				doc.*,
				CONCAT(doc.NAME,' ',doc.surname)AS doctor_name,
				rel.doct_pat_relation_id,
				rel.is_share, 
				CASE WHEN rel.doctor_id = doc.doctor_id THEN 'Yes' ELSE 'No' END AS isrelation, 
				CASE WHEN rel.doctor_type = 1 THEN 'PCP' WHEN rel.doctor_type = 2 THEN 'ACP' ELSE '-' END AS doctor_type,
				CASE WHEN rel.is_share = 1 THEN 'Yes' WHEN rel.is_share = 0 THEN 'No' ELSE '-' END AS isshare
			FROM
				doctor_master as doc
			LEFT JOIN 
				doctor_patient_relation rel
			ON
				(rel.doctor_id=doc.doctor_id AND rel.patient_id=".$PatientId.")
			WHERE
				doc.status=1 AND doc.doctor_id != ".$doctor_id. "
			ORDER BY 
			 	doc.NAME ASC";
				
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getAllDoctorListCount($PatientId=NULL)
	{
		if (is_null($PatientId))
		{
			$PatientId = Yii::app()->session['pingmydoctor_patient'];
		}
		$sql = "SELECT 
				count(*) as total
			FROM
				doctor_master as doc
			LEFT JOIN 
				doctor_patient_relation rel
			ON
				(rel.doctor_id=doc.doctor_id AND rel.patient_id=".$PatientId.")
			WHERE
				doc.status=1
			ORDER BY 
			 	doc.NAME ASC";
		$result	= Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
	
	function getAllDoctorListForMobile($PatientId=NULL,$start=0,$length=10,$keyword,$sort,$sort_type)
	{
		// $sql = "select * , CONCAT(NAME,' ',surname)AS doctor_name from doctor_master  where status=1 ";	
		/* $sql = "SELECT doc.* , 
CONCAT(doc.NAME,' ',doc.surname)AS doctor_name,
CASE WHEN rel.doctor_id = doc.doctor_id THEN 'Yes' ELSE 'No' END AS isrelation

 FROM doctor_master doc
 LEFT JOIN doctor_patient_relation rel ON rel.doctor_id = doc.doctor_id where doc.status=1 ";*/
 
		// Wrong query commented
 			/* $sql = "SELECT doc.*,a.doctor_name,
CASE WHEN a.isrelation = 'Yes' THEN 'Yes' ELSE 'No' END AS isrelation,a.doctor_type,a.doct_pat_relation_id,a.is_share

FROM  (
SELECT doc.* , 
CONCAT(doc.NAME,' ',doc.surname)AS doctor_name,rel.doct_pat_relation_id,rel.is_share,
CASE WHEN rel.doctor_id = doc.doctor_id THEN 'Yes' ELSE 'No' END AS isrelation,
CASE WHEN rel.doctor_type = 1 THEN 'PCP' WHEN rel.doctor_type = 2 THEN 'ACP'  ELSE '-' END AS doctor_type
FROM doctor_master doc
LEFT JOIN doctor_patient_relation rel ON rel.doctor_id = doc.doctor_id 
WHERE doc.status=1 AND patient_id = ".Yii::app()->session['pingmydoctor_patient']."
) a  RIGHT JOIN doctor_master doc ON doc.doctor_id = a.doctor_id ORDER BY doc.NAME ASC"; */

		if (is_null($PatientId))
		{
			$PatientId = Yii::app()->session['pingmydoctor_patient'];
		}
		$sql = "SELECT 
				doc.*,
				CONCAT(doc.NAME,' ',doc.surname)AS doctor_name,
				rel.doct_pat_relation_id,
				rel.is_share, 
				CASE WHEN rel.doctor_id = doc.doctor_id THEN 'Yes' ELSE 'No' END AS isrelation, 
				CASE WHEN rel.doctor_type = 1 THEN 'PCP' WHEN rel.doctor_type = 2 THEN 'ACP' ELSE '-' END AS doctor_type,
				CASE WHEN rel.is_share = 1 THEN 'Yes' WHEN rel.is_share = 0 THEN 'No' ELSE '-' END AS isshare
			FROM
				doctor_master as doc
			LEFT JOIN 
				doctor_patient_relation rel
			ON
				(rel.doctor_id=doc.doctor_id AND rel.patient_id=".$PatientId.")
			WHERE
				doc.status=1 and (doc.`name` LIKE '%".$keyword."%' OR  doc.surname LIKE '%".$keyword."%'
OR doc.qualification LIKE '%".$keyword."%' OR doc.doctor_mobile LIKE '%".$keyword."%')
			ORDER BY 
			 	".$sort." ".$sort_type." limit ".$start.", ".$length;
				
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getAllDoctorListCountForMobile($PatientId=NULL,$keyword=NULL)
	{
		if (is_null($PatientId))
		{
			$PatientId = Yii::app()->session['pingmydoctor_patient'];
		}
		 $sql = "SELECT 
				count(*) as total
			FROM
				doctor_master as doc
			LEFT JOIN 
				doctor_patient_relation rel
			ON
				(rel.doctor_id=doc.doctor_id AND rel.patient_id=".$PatientId.")
			WHERE
				doc.status=1 and (doc.`name` LIKE '%".$keyword."%' OR  doc.surname LIKE '%".$keyword."%'
OR doc.qualification LIKE '%".$keyword."%' OR doc.doctor_mobile LIKE '%".$keyword."%')
			ORDER BY 
			 	doc.NAME ASC";
		$result	= Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
	function getAllDoctorsForAdmin()
	{
		$sql = "SELECT *, CONCAT(doc.NAME,' ',doc.surname)AS doctor_name FROM doctor_master doc where doc.status=1 ";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
 	}
	
	
	function getAllDoctorListForDisplayPaginated($limit=10,$sortType="desc",$sortBy="doctor_id",$keyword=NULL)
	{
		
		$criteria = new CDbCriteria();
		
		$search = "where status=1 ";
		
		if(isset($keyword) && $keyword != NULL )
		{
			$search .= " and (name like '%".$keyword."%' or surname like '%".$keyword."%' or  address like '%".$keyword."%')";
		
		}
		
		$sql = "select * from doctor_master ".$search." order by ".$sortBy." ".$sortType." ";
				
		$sql_count = "select count(*) as count from doctor_master  ".$search." ";
		
		//echo $sql;
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
	//echo $sql_count;
		$result	=	new CSqlDataProvider($sql, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
				
		$index = 0;	
		return array('pagination'=>$result->pagination, 'doctorList'=>$result->getData());
	}
	
	
	public function getDoctorById($doctor_id=NULL, $fields='*')
	{
		$result = Yii::app()->db->createCommand()
    	->select($fields)
    	->from($this->tableName())
   	 	->where('doctor_id=:doctor_id', array(':doctor_id'=>$doctor_id))	
   	 	->queryRow();
		
		return $result;
	}
	
	function deleteDoctor($doctor_id)
	{
		$sql = "update doctor_master set status=0,modified_at='".date("Y-m-d H:i:s")."' 
				where doctor_id='".$doctor_id."' ";	
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
	
	function getPasswordById($id)
	{
		$sql = "select password from doctor_master where doctor_id= ".$id."";
		$result	=Yii::app()->db->createCommand($sql)->queryScalar();
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
					$DoctorMasterObj=new DoctorMaster();
					$id=$DoctorMasterObj->getIdByfpasswordConfirm($data['token']);
					
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
		->select('doctor_id')
		->from($this->tableName())
		->where('fpasswordconfirm=:fpasswordconfirm', array(':fpasswordconfirm'=>$token))
		->queryScalar();
		
		return $result;
	}
	
	
}