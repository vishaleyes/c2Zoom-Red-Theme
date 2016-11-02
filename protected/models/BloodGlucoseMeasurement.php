<?php

/**
 * This is the model class for table "blood_glucose_measurement".
 *
 * The followings are the available columns in table 'blood_glucose_measurement':
 * @property integer $blood_glucose_id
 * @property integer $patient_id
 * @property string $blood_glucose_level
 * @property integer $measurement_type
 * @property integer $measurement_context_id
 * @property integer $unit
 * @property string $report_date
 * @property string $notes
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class BloodGlucoseMeasurement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BloodGlucoseMeasurement the static model class
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
		return 'blood_glucose_measurement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, blood_glucose_level, measurement_type, report_date, created_at', 'required'),
			array('patient_id, measurement_type, measurement_context_id, unit, status', 'numerical', 'integerOnly'=>true),
			array('blood_glucose_level, notes', 'length', 'max'=>255),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('blood_glucose_id, patient_id, blood_glucose_level, measurement_type, measurement_context_id, unit, report_date, notes, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'blood_glucose_id' => 'Blood Glucose',
			'patient_id' => 'Patient',
			'blood_glucose_level' => 'Blood Glucose Level',
			'measurement_type' => 'Measurement Type',
			'measurement_context_id' => 'Measurement Context',
			'unit' => 'Unit',
			'report_date' => 'Report Date',
			'notes' => 'Notes',
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

		$criteria->compare('blood_glucose_id',$this->blood_glucose_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('blood_glucose_level',$this->blood_glucose_level,true);
		$criteria->compare('measurement_type',$this->measurement_type);
		$criteria->compare('measurement_context_id',$this->measurement_context_id);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('report_date',$this->report_date,true);
		$criteria->compare('notes',$this->notes,true);
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
	
	
	function getBloodGlucoseDetailsByPatient($patient_id)
	{
		$sql = " select * from blood_glucose_measurement where patient_id = '".$patient_id."' and
		status=1 order by blood_glucose_id desc limit 1 ";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllBloodGlucoselListByPatient($patient_id)
	{
		/*$sql = " SELECT *,CASE WHEN  measurement_type = 0 THEN 'plasma'
			 ELSE  'whole blood' END AS measure,
			 CASE WHEN unit = 0 THEN 'mmol/L' ELSE 'mg/dL' END AS units  
			from blood_glucose_measurement
			where status=1 and patient_id='".$patient_id."'
			order by blood_glucose_id desc ";*/
		$sql = "SELECT bg.*,mc.context_name,CASE WHEN  bg.measurement_type = 0 THEN 'plasma' ELSE  'whole blood' END AS measure, CASE WHEN bg.unit = 0 THEN 'mmol/L' ELSE 'mg/dL' END AS units  FROM blood_glucose_measurement bg, measurement_context mc WHERE bg.measurement_context_id = mc.measurement_context_id AND bg.status=1 AND bg.patient_id='".$patient_id."' ORDER BY bg.blood_glucose_id desc";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getAllBloodGlucoseList()
	{
						 
		if(isset(Yii::app()->session['selected_patient_id']))
		{
			$sql = "  SELECT * FROM  (
SELECT bg.*,mc.context_name FROM blood_glucose_measurement bg
				 JOIN patient_master p ON (p.patient_id = bg.patient_id)
				 JOIN measurement_context mc ON (mc.measurement_context_id = bg.measurement_context_id)
				 WHERE bg.status=1 AND p.status=1 
				 ORDER BY blood_glucose_id DESC
				 
		) a INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
		WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']."	ORDER BY blood_glucose_id desc";
		}
		else
		{
		$sql = "SELECT bg.*,mc.context_name FROM blood_glucose_measurement bg
				 JOIN patient_master p ON (p.patient_id = bg.patient_id)
				 JOIN measurement_context mc ON (mc.measurement_context_id = bg.measurement_context_id)
				 WHERE bg.status=1 AND p.status=1 AND p.patient_id IN (
 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." and is_share = 1)
				 ORDER BY blood_glucose_id desc";		 	
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getDetailsByBloodGlucoseId($id)
	{
		$sql = "select * from blood_glucose_measurement where blood_glucose_id='".$id."' and status=1 ";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function deletebloodglucoseByIds($idArr,$patient_id)
	{
		$sql = "delete from blood_glucose_measurement   
where blood_glucose_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
}