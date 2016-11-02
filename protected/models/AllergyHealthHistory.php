<?php

/**
 * This is the model class for table "allergy_health_history".
 *
 * The followings are the available columns in table 'allergy_health_history':
 * @property integer $allergy_id
 * @property string $allergy_name
 * @property integer $allergy_master_id
 * @property integer $patient_id
 * @property string $reaction
 * @property string $treatment
 * @property string $first_observed
 * @property string $notes
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class AllergyHealthHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AllergyHealthHistory the static model class
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
		return 'allergy_health_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('allergy_name, allergy_master_id, patient_id, reaction, treatment, first_observed, created_at', 'required'),
			array('allergy_master_id, patient_id, status', 'numerical', 'integerOnly'=>true),
			array('allergy_name, reaction, treatment', 'length', 'max'=>100),
			array('notes', 'length', 'max'=>255),
			array('modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('allergy_id, allergy_name, allergy_master_id, patient_id, reaction, treatment, first_observed, notes, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'allergy_id' => 'Allergy',
			'allergy_name' => 'Allergy Name',
			'allergy_master_id' => 'Allergy Master',
			'patient_id' => 'Patient',
			'reaction' => 'Reaction',
			'treatment' => 'Treatment',
			'first_observed' => 'First Observed',
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

		$criteria->compare('allergy_id',$this->allergy_id);
		$criteria->compare('allergy_name',$this->allergy_name,true);
		$criteria->compare('allergy_master_id',$this->allergy_master_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('reaction',$this->reaction,true);
		$criteria->compare('treatment',$this->treatment,true);
		$criteria->compare('first_observed',$this->first_observed,true);
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
	
	
	function getAllergyDetailsByPatient($patient_id)
	{
		$sql = " select * from allergy_health_history where patient_id = '".$patient_id."' and
		status=1 order by allergy_id desc limit 1 ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllergyHealthHistoryList()
	{
		if(isset(Yii::app()->session['selected_patient_id']) && Yii::app()->session['selected_patient_id'] != '')
		{
		
		$sql = "   SELECT * FROM  (

SELECT a.* FROM allergy_health_history a
				JOIN patient_master p ON (a.patient_id = p.patient_id)
				WHERE a.status=1 AND p.status=1 
				ORDER BY allergy_id DESC

		) a INNER JOIN doctor_patient_relation dpr ON a.patient_id = dpr.patient_id
		WHERE dpr.is_share = 1 AND dpr.doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." AND dpr.patient_id = ".Yii::app()->session['selected_patient_id']."";	
		}
		else
		{
			$sql = " select a.* from allergy_health_history a
				join patient_master p on (a.patient_id = p.patient_id)
				where a.status=1 and p.status=1 AND p.patient_id IN (
 SELECT patient_id FROM doctor_patient_relation WHERE doctor_id = ".Yii::app()->session['pingmydoctor_doctor']." and is_share = 1)
				 
				order by allergy_id desc ";	
		}
		
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getDetailsByAllergyId($allergy_id)
	{
		$sql = " select * from allergy_health_history where allergy_id='".$allergy_id."' and status=1 ";	
		
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllergyHealthHistoryListByPatient($patient_id)
	{
		$sql = " SELECT al.*,mast.name AS allergen_type
FROM allergy_health_history al
INNER JOIN allergy_master mast ON al.allergy_master_id = mast.allergy_master_id
WHERE al.STATUS=1 AND al.patient_id='".$patient_id."'
ORDER BY allergy_id desc";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
		
	function deleteallergyByIds($idArr,$patient_id)
	{
		$sql = "delete from allergy_health_history   
where allergy_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	
}