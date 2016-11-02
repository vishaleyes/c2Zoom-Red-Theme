<?php

/**
 * This is the model class for table "height_measurement".
 *
 * The followings are the available columns in table 'height_measurement':
 * @property integer $height_id
 * @property string $height_value
 * @property integer $patient_id
 * @property integer $unit
 * @property string $sub_height
 * @property integer $sub_height_unit
 * @property string $notes
 * @property string $report_date
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class HeightMeasurement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HeightMeasurement the static model class
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
		return 'height_measurement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('height_value, patient_id, unit, report_date, created_at', 'required'),
			array('patient_id, unit, sub_height_unit, status', 'numerical', 'integerOnly'=>true),
			array('height_value, sub_height', 'length', 'max'=>100),
			array('notes', 'length', 'max'=>255),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('height_id, height_value, patient_id, unit, sub_height, sub_height_unit, notes, report_date, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'height_id' => 'Height',
			'height_value' => 'Height Value',
			'patient_id' => 'Patient',
			'unit' => 'Unit',
			'sub_height' => 'Sub Height',
			'sub_height_unit' => 'Sub Height Unit',
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

		$criteria->compare('height_id',$this->height_id);
		$criteria->compare('height_value',$this->height_value,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('sub_height',$this->sub_height,true);
		$criteria->compare('sub_height_unit',$this->sub_height_unit);
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
	
	
	function getHeightDetailsByPatient($patient_id)
	{
		$sql = " select * from height_measurement where patient_id = '".$patient_id."' and
		status=1 order by height_id desc limit 1 ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllHeightList()
	{
		
		if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != '')
		{
			$sql = " 
  SELECT * FROM  (

SELECT h.* FROM height_measurement h
					JOIN patient_master p ON (p.patient_id = h.patient_id)
					WHERE h.status=1 AND p.status=1 
					ORDER BY height_id DESC

		) a INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
		WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']." ";
		}
		else
		{
			$sql = " select h.* from height_measurement h
					join patient_master p on (p.patient_id = h.patient_id)
					where h.status=1 and p.status=1  AND p.patient_id IN (
	 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." and is_share = 1)
					 
					order by height_id desc ";
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	function getDetailsByHeightId($id)
	{
		$sql = "select * from height_measurement where height_id='".$id."' and status=1 ";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllHeightListByPatient($patient_id)
	{
		$sql = "  SELECT * , CASE WHEN unit = 0 THEN 'ft' WHEN unit = 1 THEN 'inch' WHEN unit = 2 THEN 'cm' END AS unittype, CASE WHEN sub_height_unit = 0 THEN 'ft' WHEN sub_height_unit = 1 THEN 'inch' WHEN sub_height_unit = 2 THEN 'cm' END AS subunittype  
FROM height_measurement
WHERE STATUS=1 AND patient_id=".$patient_id."
ORDER BY height_id DESC ";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function deleteheightByIds($idArr,$patient_id)
	{
		$sql = "delete from height_measurement   
where height_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	
	
}