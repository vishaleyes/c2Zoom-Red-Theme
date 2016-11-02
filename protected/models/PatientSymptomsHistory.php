<?php

/**
 * This is the model class for table "patient_symptoms_history".
 *
 * The followings are the available columns in table 'patient_symptoms_history':
 * @property integer $patient_symptoms_id
 * @property integer $patient_id
 * @property string $const_symptoms
 * @property string $skin
 * @property string $heent
 * @property string $respiratory
 * @property string $cardiovascular
 * @property string $gastrointestinal
 * @property string $genitourinary
 * @property string $musculoskeletal
 * @property string $neurological
 * @property string $psychiatric
 * @property string $endocrine
 * @property string $hematologic
 * @property integer $status
 * @property string $creation_at
 * @property string $modified_at
 */
class PatientSymptomsHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientSymptomsHistory the static model class
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
		return 'patient_symptoms_history';
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
			array('patient_id, status', 'numerical', 'integerOnly'=>true),
			array('const_symptoms, skin, heent, respiratory, cardiovascular, gastrointestinal, genitourinary, musculoskeletal, neurological, psychiatric, endocrine, hematologic', 'length', 'max'=>50),
			array('creation_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_symptoms_id, patient_id, const_symptoms, skin, heent, respiratory, cardiovascular, gastrointestinal, genitourinary, musculoskeletal, neurological, psychiatric, endocrine, hematologic, status, creation_at, modified_at', 'safe', 'on'=>'search'),
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
			'patient_symptoms_id' => 'Patient Symptoms',
			'patient_id' => 'Patient',
			'const_symptoms' => 'Const Symptoms',
			'skin' => 'Skin',
			'heent' => 'Heent',
			'respiratory' => 'Respiratory',
			'cardiovascular' => 'Cardiovascular',
			'gastrointestinal' => 'Gastrointestinal',
			'genitourinary' => 'Genitourinary',
			'musculoskeletal' => 'Musculoskeletal',
			'neurological' => 'Neurological',
			'psychiatric' => 'Psychiatric',
			'endocrine' => 'Endocrine',
			'hematologic' => 'Hematologic',
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

		$criteria->compare('patient_symptoms_id',$this->patient_symptoms_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('const_symptoms',$this->const_symptoms,true);
		$criteria->compare('skin',$this->skin,true);
		$criteria->compare('heent',$this->heent,true);
		$criteria->compare('respiratory',$this->respiratory,true);
		$criteria->compare('cardiovascular',$this->cardiovascular,true);
		$criteria->compare('gastrointestinal',$this->gastrointestinal,true);
		$criteria->compare('genitourinary',$this->genitourinary,true);
		$criteria->compare('musculoskeletal',$this->musculoskeletal,true);
		$criteria->compare('neurological',$this->neurological,true);
		$criteria->compare('psychiatric',$this->psychiatric,true);
		$criteria->compare('endocrine',$this->endocrine,true);
		$criteria->compare('hematologic',$this->hematologic,true);
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
	
	
	function getsymptomsListByPatient($patient_id)
	{
		$sql = " select *   
		from patient_symptoms_history
		where status=1 and patient_id= ".$patient_id;	
				$result	= Yii::app()->db->createCommand($sql)->queryRow();
				return $result;
	}
	
	function getsymptomsListByPatientWithName($patient_id)
	{
		
		//constitutionalsymptoms
		$const_symptoms[1]='Unusual Weight Change';
		$const_symptoms[2]='Easy fatigue';
		
		//Skin
		$skin[1]='Rashes, Hives or Exzema with itching';
		$skin[2]='Bruising';
		$skin[3]='Jaundice';
		$skin[4]='Cyanosis';
		$skin[5]='Change in color';
		$skin[6]='Dryness';
		$skin[7]='Lumps or growths';
		
		//Head, Ears, Eyes, Nose, Throat (HEENT)
		$heent[1]='Difficulty hearing';
		$heent[2]='Ringing in ears';
		$heent[3]='Dizziness';
		$heent[4]='Sinus Trouble';
		$heent[5]='Frequent Sore Throats';
		
		//respiratory
		$respiratory[1]='Cough';
		$respiratory[2]='Asthma';
		$respiratory[3]='Hemoptysis';
		$respiratory[4]='Chronic obstructive';
		
		//cardiovascular
		$cardiovascular[1]='Chest pain';
		$cardiovascular[2]='Palpitations';
		$cardiovascular[3]='Orthopnea';
		$cardiovascular[4]='Heart murmurs';
		$cardiovascular[5]='High blood pressure';
		$cardiovascular[6]='Dyspnea';
		$cardiovascular[7]='Pedal edema';
		$cardiovascular[8]='Coldness of extremities';
		$cardiovascular[9]='Claudication';
		$cardiovascular[10]='Past myocardial infarction';
		
		//gastrointestinal
		$gastrointestinal[1]='Nausea and/or vomiting';
		$gastrointestinal[2]='Hematemesis';
		$gastrointestinal[3]='Indigestion';
		$gastrointestinal[4]='Dysphagia';
		$gastrointestinal[5]='Abdominal pain';
		$gastrointestinal[6]='Change in bowel movementsDiarrhea';
		
		//genitourinary
		$genitourinary[1]='Frequency';
		$genitourinary[2]='Polyuria';
		$genitourinary[3]='Dysuria';
		$genitourinary[4]='Incontinence';
		$genitourinary[5]='Hematuria';
		
		//musculoskeletal
		$musculoskeletal[1]='Muscle or joint pain or stiffness';
		$musculoskeletal[2]='muscle wasting';
		$musculoskeletal[3]='Limitation of motion';
		$musculoskeletal[4]='Arthritis';
		$musculoskeletal[5]='Gout';
		$musculoskeletal[6]='Backache';
		
		//neurological
		$neurological[1]='Syncope';
		$neurological[2]='Weakness';
		$neurological[3]='Unsteadiness of gait';
		$neurological[4]='Paralysis';
		$neurological[5]='Paresthesias';
		$neurological[6]='Loss of sensation';
		$neurological[7]='Loss of memory';
		$neurological[6]='Disorientation';
		
		//psychiatric
		$psychiatric[1]='Depression, Anxiety';
		
		//endocrine
		$endocrine[1]='History';
		$endocrine[2]='Heat or cold intolerance';
		
		//hematologic/lymphatic
		$hematologic[1]='Anemia';
		$hematologic[2]='Enlarged lymph nodes';
		$hematologic[3]='Enlarged Spleen';
		$hematologic[4]='Excess bruising';
		
		$sql = " select *
		from patient_symptoms_history
		where status=1 and patient_id= ".$patient_id;
		$result	= Yii::app()->db->createCommand($sql)->queryRow();		
		foreach ($result as $key=>$row) {
			$arrResult = array();			
			if(isset($$key) && count($$key)>0 && is_array($$key) && $row != '') {				
				$arrSeprateKeys = explode(',',$row);
				foreach ($arrSeprateKeys as $values) {
					$arrSymptoms = $$key;					
					$arrResult[] = $arrSymptoms[$values];
				}				
				$result[$key] = implode(" , ", $arrResult);
			}
			
		}
		return $result;
	}	
	
}