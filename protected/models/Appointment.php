<?php

/**
 * This is the model class for table "appointment".
 *
 * The followings are the available columns in table 'appointment':
 * @property string $appointment_id
 * @property string $appointment_date
 * @property string $appointment_time
 * @property string $notes
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property string $modified_at
 * @property string $created_at
 */
class Appointment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Appointment the static model class
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
		return 'appointment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, doctor_id', 'numerical', 'integerOnly'=>true),
			array('appointment_date, appointment_time, notes, modified_at, created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('appointment_id, appointment_date, appointment_time, notes, patient_id, doctor_id, modified_at, created_at', 'safe', 'on'=>'search'),
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
			'appointment_id' => 'Appointment',
			'appointment_date' => 'Appointment Date',
			'appointment_time' => 'Appointment Time',
			'notes' => 'Notes',
			'patient_id' => 'Patient',
			'doctor_id' => 'Doctor',
			'modified_at' => 'Modified At',
			'created_at' => 'Created At',
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

		$criteria->compare('appointment_id',$this->appointment_id,true);
		$criteria->compare('appointment_date',$this->appointment_date,true);
		$criteria->compare('appointment_time',$this->appointment_time,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('created_at',$this->created_at,true);

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
	
	function getAppointmentById($appointment_id)
	{
		$sql = "SELECT * FROM appointment WHERE appointment_id=".$appointment_id." 
ORDER BY appointment_date ASC, appointment_time ASC";
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAppointmentListByDoctor($doctor_id)
	{
		if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != '')
		{
			$sql = "SELECT a.*,p.name,p.surname FROM appointment a, patient_master p 
	WHERE a.patient_id = p.patient_id AND a.doctor_id=".$doctor_id." and a.patient_id = ".Yii::app()->session['selected_patient_id']." 
	ORDER BY appointment_date ASC, appointment_time ASC";
		}
		else
		{
			$sql = "SELECT a.*,p.name,p.surname FROM appointment a, patient_master p 
	WHERE a.patient_id = p.patient_id AND a.doctor_id=".$doctor_id." 
	ORDER BY appointment_date ASC, appointment_time ASC";
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getAppointmentListByPatientWithView($patient_id)
	{
		
		$sql = "select * from appointment where patient_id='".$patient_id."' and patient_view = 0";
	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	
	function getAppointmentListByPatient($patient_id)
	{
		$sql = "SELECT a.*,d.name,d.surname,CASE WHEN a.status = 0 THEN 'Pending' WHEN a.status = 1 THEN
'Completed' WHEN a.status = 2 THEN 'Cancelled' WHEN a.status = 3 THEN 'Accepted' WHEN a.status = 4 THEN 'Rejected' END AS app_status FROM appointment a, doctor_master d WHERE  a.doctor_id =  d.doctor_id 
AND patient_id='".$patient_id."' ORDER BY appointment_date ASC, appointment_time ASC";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	
	function getAppointmentListByPatientForMobile($patient_id,$start=0,$length=10)
	{
		$sql = "SELECT a.*,d.name,d.surname,CASE WHEN a.status = 0 THEN 'Pending' WHEN a.status = 1 THEN
'Completed' WHEN a.status = 2 THEN 'Cancelled' WHEN a.status = 3 THEN 'Accepted' WHEN a.status = 4 THEN 'Rejected' END AS app_status FROM appointment a, doctor_master d WHERE  a.doctor_id =  d.doctor_id 
AND patient_id='".$patient_id."' ORDER BY appointment_date ASC, appointment_time ASC LIMIT ".$start.",". $length ;
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	
	function getAppointmentListByPatientCountForMobile($patient_id)
	{
		$sql = "SELECT count(*) as total FROM appointment a, doctor_master d WHERE  a.doctor_id =  d.doctor_id 
AND patient_id='".$patient_id."' ORDER BY appointment_date ASC, appointment_time ASC";
		$result	= Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
	/**
	 * Collect list of Upcomming appointments within 48 hours by passing patientId.
	 * 
	 * @param int $patientId
	 * 
	 * @return Ambigous <multitype:, mixed, unknown>
	 * 
	 * @author pratik.shah
	 * @since September 2015
	 */
	function getUpcommingAppointmentListByPatient($patientId)
	{
		$sql = "SELECT 
					a.*,
					d.name,
					d.surname,
					d.latitude,d.longitude,
					CASE 
						WHEN a.status = 0 THEN 'Pending' 
						WHEN a.status = 1 THEN 'Completed' 
						WHEN a.status = 2 THEN 'Cancelled' 
						WHEN a.status = 3 THEN 'Accepted' 
						WHEN a.status = 4 THEN 'Rejected' 
					END AS app_status 
				FROM 
					appointment a, 
					doctor_master d 
				WHERE 
					a.doctor_id =  d.doctor_id
				AND 
					patient_id='".$patientId."'
				AND 
					a.status = 0 
				AND 
					CONCAT(a.appointment_date,' ',a.appointment_date) >= '".date('Y-m-d H:i:s')."' AND CONCAT(a.appointment_date,' ',a.appointment_date) <= '".date('Y-m-d H:i:s',strtotime('+48 hours'))."'    
				 
				ORDER BY 
					appointment_date ASC, appointment_time ASC";
				
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
}