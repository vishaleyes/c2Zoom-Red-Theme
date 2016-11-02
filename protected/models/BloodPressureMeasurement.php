<?php

/**
 * This is the model class for table "blood_pressure_measurement".
 *
 * The followings are the available columns in table 'blood_pressure_measurement':
 * @property integer $blood_pressure_id
 * @property integer $patient_id
 * @property double $systolic
 * @property double $diastolic
 * @property string $pulse
 * @property integer $irr_heartbeat
 * @property string $notes
 * @property string $report_date
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class BloodPressureMeasurement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BloodPressureMeasurement the static model class
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
		return 'blood_pressure_measurement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, systolic, diastolic, pulse, irr_heartbeat, report_date, created_at', 'required'),
			array('patient_id, irr_heartbeat, status', 'numerical', 'integerOnly'=>true),
			array('systolic, diastolic', 'numerical'),
			array('pulse', 'length', 'max'=>100),
			array('notes', 'length', 'max'=>255),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('blood_pressure_id, patient_id, systolic, diastolic, pulse, irr_heartbeat, notes, report_date, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'blood_pressure_id' => 'Blood Pressure',
			'patient_id' => 'Patient',
			'systolic' => 'Systolic',
			'diastolic' => 'Diastolic',
			'pulse' => 'Pulse',
			'irr_heartbeat' => 'Irr Heartbeat',
			'notes' => 'Notes',
			'report_date' => 'Report Date',
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

		$criteria->compare('blood_pressure_id',$this->blood_pressure_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('systolic',$this->systolic);
		$criteria->compare('diastolic',$this->diastolic);
		$criteria->compare('pulse',$this->pulse,true);
		$criteria->compare('irr_heartbeat',$this->irr_heartbeat);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('report_date',$this->report_date,true);
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
	
	
	function getBloodPressureDetailsByPatient($patient_id)
	{
		$sql = " select * from blood_pressure_measurement where patient_id = '".$patient_id."' and
		status=1 order by blood_pressure_id desc limit 1 ";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllBloodPressureList()
	{
		
		if(isset(Yii::app()->session['selected_patient_id']))
		{
			$sql = "  SELECT * FROM  (
SELECT bp.* FROM blood_pressure_measurement bp
				JOIN patient_master p ON (p.patient_id = bp.patient_id)
				WHERE bp.status=1 AND p.status=1  
				ORDER BY blood_pressure_id DESC
		) a INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
		WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']."";	
		}
		else
		{
			$sql = "select bp.* from blood_pressure_measurement bp
join patient_master p on (p.patient_id = bp.patient_id)
where bp.status=1 and p.status=1 AND p.patient_id IN (
 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." and is_share = 1)
order by blood_pressure_id desc";	
		}
		
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getDetailsByBloodPressureId($id)
	{
		$sql = "select * from blood_pressure_measurement where blood_pressure_id='".$id."' and status=1 ";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllBloodPressureListByPatient($patient_id)
	{
		$sql = " select *   
from blood_pressure_measurement
where status=1 and patient_id='".$patient_id."'
order by blood_pressure_id desc ";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function deletebloodpressureByIds($idArr,$patient_id)
	{
		$sql = "delete from blood_pressure_measurement   
where blood_pressure_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	
}