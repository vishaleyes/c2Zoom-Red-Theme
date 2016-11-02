<?php

/**
 * This is the model class for table "cholesterol_measurement".
 *
 * The followings are the available columns in table 'cholesterol_measurement':
 * @property integer $cholesterol_id
 * @property integer $patient_id
 * @property string $ldl
 * @property string $hdl
 * @property string $triglycerides
 * @property integer $unit
 * @property string $total
 * @property string $report_date
 * @property string $notes
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class CholesterolMeasurement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CholesterolMeasurement the static model class
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
		return 'cholesterol_measurement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, ldl, hdl, triglycerides, total, report_date, created_at', 'required'),
			array('patient_id, unit, status', 'numerical', 'integerOnly'=>true),
			array('ldl, hdl, triglycerides, total, notes', 'length', 'max'=>255),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cholesterol_id, patient_id, ldl, hdl, triglycerides, unit, total, report_date, notes, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'cholesterol_id' => 'Cholesterol',
			'patient_id' => 'Patient',
			'ldl' => 'Ldl',
			'hdl' => 'Hdl',
			'triglycerides' => 'Triglycerides',
			'unit' => 'Unit',
			'total' => 'Total',
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

		$criteria->compare('cholesterol_id',$this->cholesterol_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('ldl',$this->ldl,true);
		$criteria->compare('hdl',$this->hdl,true);
		$criteria->compare('triglycerides',$this->triglycerides,true);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('total',$this->total,true);
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
	
	
	function getAllCholesterolList()
	{
		
		if(isset(Yii::app()->session['selected_patient_id'])) {
			$sql = "   SELECT * FROM  (
				SELECT c.* FROM cholesterol_measurement c
					JOIN patient_master p ON (p.patient_id = c.patient_id)
					WHERE c.status=1 AND p.status=1 
					ORDER BY cholesterol_id DESC
		) a
		INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
		WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']."";	
		}
		else
		{
			$sql = " select c.* from cholesterol_measurement c
					join patient_master p on (p.patient_id = c.patient_id)
					where c.status=1 and p.status=1 AND p.patient_id IN (
	 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND is_share = 1)
					order by cholesterol_id desc ";	
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getDetailsByCholesterolId($id)
	{
		$sql = "select * from cholesterol_measurement where cholesterol_id='".$id."' and status=1 ";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllCholesterolListByPatient($patient_id)
	{
		/*$sql = " select cm.*,pm.name, pm.surname,pm.email, pm.phone_number, pm.dob, pm.gender, 
pm.blood_group, pm.patient_image, pm.address, pm.marital_status,pm.organ_donor   
from cholesterol_measurement cm
inner join patient_master pm on (cm.patient_id = pm.patient_id)
where cm.status=1 and cm.patient_id='".$patient_id."'
order by cholesterol_id desc ";	*/
	$sql = " select * from cholesterol_measurement where  patient_id = " .$patient_id . " and status = 1 order by report_date desc ";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function deleteCholesterolByIds($idArr,$patient_id)
	{
		$sql = "delete from cholesterol_measurement   
where cholesterol_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	function getCholesterolByIdAndPatient($id,$patient_id)
	{
		$sql = "select * from cholesterol_measurement 
		where cholesterol_id='".$id."' and patient_id='".$patient_id."' and status=1 ";
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getCholesterolDetailsByPatient($patient_id)
	{
		$sql = " select cm.*,pm.name, pm.surname,pm.email, pm.phone_number, pm.dob, pm.gender, 
pm.blood_group, pm.patient_image, pm.address, pm.marital_status,pm.organ_donor   
from cholesterol_measurement cm
inner join patient_master pm on (cm.patient_id = pm.patient_id)
where cm.status=1 and cm.patient_id='".$patient_id."'
order by cholesterol_id desc limit 1";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	
	
}