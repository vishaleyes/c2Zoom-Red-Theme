<?php

/**
 * This is the model class for table "patient_forms_history".
 *
 * The followings are the available columns in table 'patient_forms_history':
 * @property integer $patient_forms_id
 * @property integer $patient_id
 * @property string $hippa_form
 * @property string $patient_register
 */
class PatientFormsHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientFormsHistory the static model class
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
		return 'patient_forms_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_forms_id', 'required'),
			array('patient_forms_id, patient_id', 'numerical', 'integerOnly'=>true),
			array('hippa_form, patient_register', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_forms_id, patient_id, hippa_form, patient_register', 'safe', 'on'=>'search'),
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
			'patient_forms_id' => 'Patient Forms',
			'patient_id' => 'Patient',
			'hippa_form' => 'Hippa Form',
			'patient_register' => 'Patient Register',
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

		$criteria->compare('patient_forms_id',$this->patient_forms_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('hippa_form',$this->hippa_form,true);
		$criteria->compare('patient_register',$this->patient_register,true);

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
	
	
	public function getFormsByPatientId($patient_id)
	{
		$result = Yii::app()->db->createCommand()
    	->select('*')
    	->from($this->tableName())
   	 	->where('patient_id=:patient_id', array(':patient_id'=>$patient_id))	
   	 	->queryRow();
		
		return $result;
	}
	
	
}