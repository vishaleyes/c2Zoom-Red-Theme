<?php

/**
 * This is the model class for table "doctor_notification".
 *
 * The followings are the available columns in table 'doctor_notification':
 * @property integer $doctor_notification_id
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property integer $is_read
 * @property string $created_at
 */
class DoctorNotification extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DoctorNotification the static model class
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
		return 'doctor_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, doctor_id, is_read', 'numerical', 'integerOnly'=>true),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('doctor_notification_id, patient_id, doctor_id, is_read, created_at', 'safe', 'on'=>'search'),
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
			'doctor_notification_id' => 'Doctor Notification',
			'patient_id' => 'Patient',
			'doctor_id' => 'Doctor',
			'is_read' => 'Is Read',
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

		$criteria->compare('doctor_notification_id',$this->doctor_notification_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('is_read',$this->is_read);
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
	
	public function getAllNotificationForDoctor($doctor_id)
	{
		
		$sql = "SELECT dn.*,pm.name,pm.surname FROM doctor_notification dn, 
patient_master pm 
WHERE dn.patient_id = pm.patient_id AND dn.doctor_id = ".$doctor_id." and dn.is_read = 0
ORDER BY created_at DESC";
	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		return $result;
		
	}
}