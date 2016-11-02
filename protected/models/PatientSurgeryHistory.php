<?php

/**
 * This is the model class for table "patient_surgery_history".
 *
 * The followings are the available columns in table 'patient_surgery_history':
 * @property integer $patient_surgery_id
 * @property integer $patient_id
 * @property string $procedure
 * @property string $Year
 * @property string $surgeon
 * @property string $hospital
 * @property integer $status
 * @property string $creation_at
 * @property string $modified_at
 */
class PatientSurgeryHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientSurgeryHistory the static model class
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
		return 'patient_surgery_history';
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
			array('procedure, surgeon', 'length', 'max'=>250),
			array('Year', 'length', 'max'=>10),
			array('hospital', 'length', 'max'=>100),
			array('creation_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_surgery_id, patient_id, procedure, Year, surgeon, hospital, status, creation_at, modified_at', 'safe', 'on'=>'search'),
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
			'patient_surgery_id' => 'Patient Surgery',
			'patient_id' => 'Patient',
			'procedure' => 'Procedure',
			'Year' => 'Year',
			'surgeon' => 'Surgeon',
			'hospital' => 'Hospital',
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

		$criteria->compare('patient_surgery_id',$this->patient_surgery_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('procedure',$this->procedure,true);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('surgeon',$this->surgeon,true);
		$criteria->compare('hospital',$this->hospital,true);
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
		$sql = "SELECT sur.*,pat.*,sur.creation_at AS createdAt,sur.modified_at AS modifiedAt FROM  patient_surgery_history  sur
				INNER JOIN patient_master pat ON sur.patient_id  = pat.patient_id
 
					WHERE pat.patient_id=".$patient_id." order by sur.creation_at DESC ";
	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		
		return $result;
		
	}
	
	public function getdetailsBySurgeryId($patient_surgery_id)
	{
		$sql = "select * from  patient_surgery_history  
					where patient_surgery_id = ".$patient_surgery_id;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
		
	}
	
	function deletesurgeryByIds($idArr,$patient_id)
	{
		$sql = "delete from patient_surgery_history   
where patient_surgery_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	function deletePatientSurgoryById($id)
	{
		$sql = "delete from patient_surgery_history where patient_surgery_id = ".$id;
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	
	
	
	
	
	
}