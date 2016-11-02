<?php

/**
 * This is the model class for table "immunization_health_history".
 *
 * The followings are the available columns in table 'immunization_health_history':
 * @property integer $immunization_id
 * @property string $type
 * @property integer $patient_id
 * @property string $reason
 * @property string $facility
 * @property string $report_date
 * @property string $notes
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class ImmunizationHealthHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImmunizationHealthHistory the static model class
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
		return 'immunization_health_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, patient_id, reason, facility, report_date, created_at', 'required'),
			array('patient_id, status', 'numerical', 'integerOnly'=>true),
			array('type, reason, facility', 'length', 'max'=>100),
			array('notes', 'length', 'max'=>255),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('immunization_id, type, patient_id, reason, facility, report_date, notes, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'immunization_id' => 'Immunization',
			'type' => 'Type',
			'patient_id' => 'Patient',
			'reason' => 'Reason',
			'facility' => 'Facility',
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

		$criteria->compare('immunization_id',$this->immunization_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('facility',$this->facility,true);
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
	
	
	function getImmunizationDetailsByPatient($patient_id)
	{
		$sql = " select * from immunization_health_history where patient_id = '".$patient_id."' and
		status=1 order by immunization_id desc limit 1 ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getImmunizationList()
	{
		
		if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != '')
		{
			$sql = "  SELECT * FROM  (

SELECT i.* FROM immunization_health_history i
					JOIN patient_master p ON (i.patient_id = p.patient_id)
					WHERE i.status=1 AND p.status=1 
					ORDER BY immunization_id DESC
		) a INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
		WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']." ";
		}
		else
		{
			$sql = " select i.* from immunization_health_history i
					join patient_master p on (i.patient_id = p.patient_id)
					where i.status=1 and p.status=1 AND p.patient_id IN (
	 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." and is_share = 1) order by immunization_id desc ";	
		
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getDetailsByImmunizationId($immunization_id)
	{
		$sql = " select * from immunization_health_history where immunization_id='".$immunization_id."' and status=1  ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getImmunizationHealthHistoryListByPatient($patient_id)
	{
		$sql = " select *   
from immunization_health_history
where status=1 and patient_id='".$patient_id."'
order by immunization_id desc ";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function deleteimmunizationByIds($idArr,$patient_id)
	{
		$sql = "delete from immunization_health_history   
where immunization_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
}