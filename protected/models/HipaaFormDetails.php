<?php

/**
 * This is the model class for table "hipaa_form_details".
 *
 * The followings are the available columns in table 'hipaa_form_details':
 * @property integer $form_id
 * @property integer $patient_id
 * @property integer $voice_mail
 * @property integer $give_info_to_spouse
 * @property integer $form_for
 * @property integer $give_info_to
 * @property string $to_name
 * @property string $qr_code
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class HipaaFormDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HipaaFormDetails the static model class
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
		return 'hipaa_form_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, created_at', 'required'),
			array('patient_id, voice_mail, give_info_to_spouse, form_for, give_info_to, status', 'numerical', 'integerOnly'=>true),
			array('to_name', 'length', 'max'=>100),
			array('qr_code, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('form_id, patient_id, voice_mail, give_info_to_spouse, form_for, give_info_to, to_name, qr_code, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'form_id' => 'Form',
			'patient_id' => 'Patient',
			'voice_mail' => 'Voice Mail',
			'give_info_to_spouse' => 'Give Info To Spouse',
			'form_for' => 'Form For',
			'give_info_to' => 'Give Info To',
			'to_name' => 'To Name',
			'qr_code' => 'Qr Code',
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

		$criteria->compare('form_id',$this->form_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('voice_mail',$this->voice_mail);
		$criteria->compare('give_info_to_spouse',$this->give_info_to_spouse);
		$criteria->compare('form_for',$this->form_for);
		$criteria->compare('give_info_to',$this->give_info_to);
		$criteria->compare('to_name',$this->to_name,true);
		$criteria->compare('qr_code',$this->qr_code,true);
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
	
	public function getdetailsByPatientId($patient_id)
	{
		$sql = "select hippa.*,pat.* from  hipaa_form_details  hippa
				INNER JOIN patient_master pat on hippa.patient_id  = pat.patient_id
 
					where pat.patient_id=".$patient_id;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
		
		
	}
	
	public function getAllDetailsByPatientId($patient_id)
	{
		$result = Yii::app()->db->createCommand()
    	->select('hd.*, p.name,p.surname,p.email,p.dob')
    	->from('hipaa_form_details hd')
   	 	->leftjoin('patient_master p','p.patient_id=hd.patient_id')
		->where('hd.patient_id=:patient_id', array(':patient_id'=>$patient_id))	
   	 	->queryAll();
		
		return (object)$result;
	}
	
	
	
	
	
	
	
}