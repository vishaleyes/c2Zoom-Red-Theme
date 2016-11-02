<?php

/**
 * This is the model class for table "patient_medical_history".
 *
 * The followings are the available columns in table 'patient_medical_history':
 * @property integer $medical_history_id
 * @property integer $patient_id
 * @property string $height
 * @property string $avg_height
 * @property integer $is_pregnant
 * @property integer $aids
 * @property integer $hepatitis
 * @property string $other_disease
 * @property string $blood_clots
 * @property integer $diabetes
 * @property integer $epilepsy
 * @property string $heart_problem
 * @property integer $high_blood_pressure
 * @property integer $low_thyroid
 * @property integer $bowel
 * @property integer $ulcers
 * @property integer $prolapse
 * @property integer $lung_disease
 * @property integer $polio
 * @property integer $arthritis
 * @property integer $tuberculosis
 * @property string $psychiatric
 * @property string $other_unknown
 * @property string $injuries
 * @property string $hospitalization
 * @property integer $status
 * @property string $creation_at
 * @property string $modified_at
 */
class PatientMedicalHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientMedicalHistory the static model class
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
		return 'patient_medical_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id', 'required'),
			array('patient_id, is_pregnant, aids, hepatitis, diabetes, epilepsy, high_blood_pressure, low_thyroid, bowel, ulcers, prolapse, lung_disease, polio, arthritis, tuberculosis, status', 'numerical', 'integerOnly'=>true),
			array('height, avg_height', 'length', 'max'=>10),
			array('other_disease, blood_clots, heart_problem, psychiatric', 'length', 'max'=>50),
			array('other_unknown, injuries, hospitalization', 'length', 'max'=>200),
			array('creation_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('medical_history_id, patient_id, height, avg_height, is_pregnant, aids, hepatitis, other_disease, blood_clots, diabetes, epilepsy, heart_problem, high_blood_pressure, low_thyroid, bowel, ulcers, prolapse, lung_disease, polio, arthritis, tuberculosis, psychiatric, other_unknown, injuries, hospitalization, status, creation_at, modified_at', 'safe', 'on'=>'search'),
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
			'medical_history_id' => 'Medical History',
			'patient_id' => 'Patient',
			'height' => 'Height',
			'avg_height' => 'Avg Height',
			'is_pregnant' => 'Is Pregnant',
			'aids' => 'Aids',
			'hepatitis' => 'Hepatitis',
			'other_disease' => 'Other Disease',
			'blood_clots' => 'Blood Clots',
			'diabetes' => 'Diabetes',
			'epilepsy' => 'Epilepsy',
			'heart_problem' => 'Heart Problem',
			'high_blood_pressure' => 'High Blood Pressure',
			'low_thyroid' => 'Low Thyroid',
			'bowel' => 'Bowel',
			'ulcers' => 'Ulcers',
			'prolapse' => 'Prolapse',
			'lung_disease' => 'Lung Disease',
			'polio' => 'Polio',
			'arthritis' => 'Arthritis',
			'tuberculosis' => 'Tuberculosis',
			'psychiatric' => 'Psychiatric',
			'other_unknown' => 'Other Unknown',
			'injuries' => 'Injuries',
			'hospitalization' => 'Hospitalization',
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

		$criteria->compare('medical_history_id',$this->medical_history_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('avg_height',$this->avg_height,true);
		$criteria->compare('is_pregnant',$this->is_pregnant);
		$criteria->compare('aids',$this->aids);
		$criteria->compare('hepatitis',$this->hepatitis);
		$criteria->compare('other_disease',$this->other_disease,true);
		$criteria->compare('blood_clots',$this->blood_clots,true);
		$criteria->compare('diabetes',$this->diabetes);
		$criteria->compare('epilepsy',$this->epilepsy);
		$criteria->compare('heart_problem',$this->heart_problem,true);
		$criteria->compare('high_blood_pressure',$this->high_blood_pressure);
		$criteria->compare('low_thyroid',$this->low_thyroid);
		$criteria->compare('bowel',$this->bowel);
		$criteria->compare('ulcers',$this->ulcers);
		$criteria->compare('prolapse',$this->prolapse);
		$criteria->compare('lung_disease',$this->lung_disease);
		$criteria->compare('polio',$this->polio);
		$criteria->compare('arthritis',$this->arthritis);
		$criteria->compare('tuberculosis',$this->tuberculosis);
		$criteria->compare('psychiatric',$this->psychiatric,true);
		$criteria->compare('other_unknown',$this->other_unknown,true);
		$criteria->compare('injuries',$this->injuries,true);
		$criteria->compare('hospitalization',$this->hospitalization,true);
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
		$sql = "select medi.*,pat.* from  patient_medical_history  medi
				INNER JOIN patient_master pat on medi.patient_id  = pat.patient_id
 
					where pat.patient_id=".$patient_id ." ORDER BY medi.medical_history_id DESC" ;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
	}
	
	
}