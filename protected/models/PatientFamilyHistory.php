<?php

/**
 * This is the model class for table "patient_family_history".
 *
 * The followings are the available columns in table 'patient_family_history':
 * @property integer $patient_family_history_id
 * @property integer $hypertension
 * @property integer $tuberculosis
 * @property integer $diabetes
 * @property integer $kidney_disease
 * @property integer $heart_disease
 * @property integer $arthritis
 * @property integer $epilepsy
 * @property integer $convulsions
 * @property integer $cancer
 * @property integer $psychological
 * @property integer $drug
 * @property integer $status
 * @property string $creation_at
 * @property string $modified_at
 */
class PatientFamilyHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientFamilyHistory the static model class
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
		return 'patient_family_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('hypertension, tuberculosis, diabetes, kidney_disease, heart_disease, arthritis, epilepsy, convulsions, cancer, psychological, drug, status', 'numerical', 'integerOnly'=>true),
			array('creation_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_family_history_id, hypertension, tuberculosis, diabetes, kidney_disease, heart_disease, arthritis, epilepsy, convulsions, cancer, psychological, drug, status, creation_at, modified_at', 'safe', 'on'=>'search'),*/
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
			'patient_family_history_id' => 'Patient Family History',
			'hypertension' => 'Hypertension',
			'tuberculosis' => 'Tuberculosis',
			'diabetes' => 'Diabetes',
			'kidney_disease' => 'Kidney Disease',
			'heart_disease' => 'Heart Disease',
			'arthritis' => 'Arthritis',
			'epilepsy' => 'Epilepsy',
			'convulsions' => 'Convulsions',
			'cancer' => 'Cancer',
			'psychological' => 'Psychological',
			'drug' => 'Drug',
			'status' => 'Status',
			'creation_at' => 'Creation At',
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

		$criteria->compare('patient_family_history_id',$this->patient_family_history_id);
		$criteria->compare('hypertension',$this->hypertension);
		$criteria->compare('tuberculosis',$this->tuberculosis);
		$criteria->compare('diabetes',$this->diabetes);
		$criteria->compare('kidney_disease',$this->kidney_disease);
		$criteria->compare('heart_disease',$this->heart_disease);
		$criteria->compare('arthritis',$this->arthritis);
		$criteria->compare('epilepsy',$this->epilepsy);
		$criteria->compare('convulsions',$this->convulsions);
		$criteria->compare('cancer',$this->cancer);
		$criteria->compare('psychological',$this->psychological);
		$criteria->compare('drug',$this->drug);
		$criteria->compare('status',$this->status);
		$criteria->compare('creation_at',$this->creation_at,true);
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
		
	
	
	public function getdetailsByPatientId($patient_id)
	{
	 $sql = "select medi.*,pat.* from  patient_family_history  medi
				INNER JOIN patient_master pat on medi.patient_id  = pat.patient_id
 
					where pat.patient_id=".$patient_id;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
		
		
	}
	
	
	
}