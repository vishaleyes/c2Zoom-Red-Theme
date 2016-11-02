<?php

/**
 * This is the model class for table "weight_measurement".
 *
 * The followings are the available columns in table 'weight_measurement':
 * @property integer $weight_id
 * @property string $weight_value
 * @property integer $patient_id
 * @property integer $unit
 * @property string $report_date
 * @property string $notes
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class WeightMeasurement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WeightMeasurement the static model class
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
		return 'weight_measurement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('weight_value, patient_id, report_date, created_at', 'required'),
			array('patient_id, unit, status', 'numerical', 'integerOnly'=>true),
			array('weight_value', 'length', 'max'=>100),
			array('notes', 'length', 'max'=>255),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('weight_id, weight_value, patient_id, unit, report_date, notes, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'weight_id' => 'Weight',
			'weight_value' => 'Weight Value',
			'patient_id' => 'Patient',
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

		$criteria->compare('weight_id',$this->weight_id);
		$criteria->compare('weight_value',$this->weight_value,true);
		$criteria->compare('patient_id',$this->patient_id);
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
	
	
	function getWeightDetailsByPatient($patient_id)
	{
		$sql = " select * from weight_measurement where patient_id = '".$patient_id."' and
		status=1 order by weight_id desc limit 1 ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllWeightList()
	{
		
		if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != '')
		{
			$sql = "
  SELECT * FROM  (

SELECT w.* FROM weight_measurement w
		JOIN patient_master p ON (p.patient_id = w.patient_id)
		WHERE w.status=1 AND p.status=1 
					  
					ORDER BY weight_id DESC

		) a INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
		WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']."";	

		}
		else
		{
			$sql = "select w.* from weight_measurement w
					join patient_master p on (p.patient_id = w.patient_id)
					where w.status=1 and p.status=1 AND p.patient_id IN (
	 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." and is_share = 1)
					  
					order by weight_id desc";	
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getDetailsByWeightId($id)
	{
		$sql = "select * from weight_measurement where weight_id='".$id."' and status=1 ";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllWeightListByPatient($patient_id)
	{
		$sql = " SELECT *, CASE WHEN unit = 0 THEN 'lbs' WHEN unit = 1 THEN 'kg' END AS unittype    
FROM weight_measurement
WHERE STATUS=1 AND patient_id=".$patient_id."
ORDER BY weight_id desc";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}

	function deleteweightByIds($idArr,$patient_id)
	{
		$sql = "delete from weight_measurement   
where weight_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
		
	
}