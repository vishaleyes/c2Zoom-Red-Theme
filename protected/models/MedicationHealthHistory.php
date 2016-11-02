<?php

/**
 * This is the model class for table "medication_health_history".
 *
 * The followings are the available columns in table 'medication_health_history':
 * @property integer $medication_id
 * @property string $medication_name
 * @property integer $patient_id
 * @property string $how_often_taken
 * @property string $dose
 * @property integer $dose_unit
 * @property string $strength
 * @property integer $strength_unit
 * @property string $how_taken
 * @property string $reason
 * @property string $when_started
 * @property string $when_stopped
 * @property string $is_prescribed
 * @property string $notes
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class MedicationHealthHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MedicationHealthHistory the static model class
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
		return 'medication_health_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('medication_name, patient_id, how_often_taken, dose, dose_unit, strength, how_taken, reason, when_started, when_stopped, is_prescribed', 'required'),
			array('patient_id, dose_unit, strength_unit, status', 'numerical', 'integerOnly'=>true),
			array('medication_name, how_often_taken, how_taken, is_prescribed', 'length', 'max'=>100),
			array('dose, strength', 'length', 'max'=>50),
			array('reason, notes', 'length', 'max'=>255),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('medication_id, medication_name, patient_id, how_often_taken, dose, dose_unit, strength, strength_unit, how_taken, reason, when_started, when_stopped, is_prescribed, notes, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'medication_id' => 'Medication',
			'medication_name' => 'Medication Name',
			'patient_id' => 'Patient',
			'how_often_taken' => 'How Often Taken',
			'dose' => 'Dose',
			'dose_unit' => 'Dose Unit',
			'strength' => 'Strength',
			'strength_unit' => 'Strength Unit',
			'how_taken' => 'How Taken',
			'reason' => 'Reason',
			'when_started' => 'When Started',
			'when_stopped' => 'When Stopped',
			'is_prescribed' => 'Is Prescribed',
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

		$criteria->compare('medication_id',$this->medication_id);
		$criteria->compare('medication_name',$this->medication_name,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('how_often_taken',$this->how_often_taken,true);
		$criteria->compare('dose',$this->dose,true);
		$criteria->compare('dose_unit',$this->dose_unit);
		$criteria->compare('strength',$this->strength,true);
		$criteria->compare('strength_unit',$this->strength_unit);
		$criteria->compare('how_taken',$this->how_taken,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('when_started',$this->when_started,true);
		$criteria->compare('when_stopped',$this->when_stopped,true);
		$criteria->compare('is_prescribed',$this->is_prescribed,true);
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
	
	
	function getMedicationDetailsByPatient($patient_id)
	{
		$sql = " select * from medication_health_history where patient_id = '".$patient_id."' and
		status=1 order by medication_id desc limit 1 ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getMedicationList()
	{
		if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != '')
		{
			$sql = " SELECT * FROM  (

	SELECT m.* FROM medication_health_history m
	JOIN patient_master p ON (m.patient_id = p.patient_id)
	WHERE m.status=1 AND p.status=1
	ORDER BY medication_id DESC 

) a INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']."";	
		}
		else
		{
			$sql = " select m.* from medication_health_history m
					join patient_master p on (m.patient_id = p.patient_id)
					where m.status=1 and p.status=1 AND p.patient_id IN (
	 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." and is_share = 1) order by medication_id desc ";	
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getDetailsByMedicationId($medication_id)
	{
		$sql = " select * from medication_health_history where medication_id='".$medication_id."' and status=1 ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getMedicationListByPatient($patient_id,$limit = '')
	{
		$sql = "  SELECT *,CASE WHEN  dose_unit = 0 THEN 'doses' WHEN dose_unit = 1 THEN  'bars'
				 WHEN dose_unit = 2 THEN 'grams' WHEN dose_unit = 3 THEN 'capsules' END AS 'dose_units'
				 ,CASE WHEN  strength_unit = 0 THEN 'milligram' WHEN strength_unit = 1 THEN  'microgram'
				 WHEN strength_unit = 2 THEN 'milliliter' WHEN strength_unit = 3 THEN 'unit' 
				WHEN strength_unit = 4 THEN 'percent' END AS 'strength_units'
				FROM medication_health_history
				WHERE STATUS=1 AND patient_id='".$patient_id."'
				ORDER BY medication_id desc ";	
		if($limit != '') {
			$sql .=" LIMIT $limit";
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function deletemedicationByIds($idArr,$patient_id)
	{
		$sql = "delete from medication_health_history   
where medication_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
}