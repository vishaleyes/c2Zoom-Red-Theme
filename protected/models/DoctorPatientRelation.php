<?php

/**
 * This is the model class for table "doctor_patient_relation".
 *
 * The followings are the available columns in table 'doctor_patient_relation':
 * @property integer $doct_pat_relation_id
 * @property integer $doctor_id
 * @property integer $patient_id
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class DoctorPatientRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DoctorPatientRelation the static model class
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
		return 'doctor_patient_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doctor_id', 'required'),
			array('doctor_id, patient_id, status', 'numerical', 'integerOnly'=>true),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('doct_pat_relation_id, doctor_id, patient_id, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'doct_pat_relation_id' => 'Doct Pat Relation',
			'doctor_id' => 'Doctor',
			'patient_id' => 'Patient',
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

		$criteria->compare('doct_pat_relation_id',$this->doct_pat_relation_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('patient_id',$this->patient_id);
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
	
	
	function getdetails_by_patientid($patient_id)
	{
		$sql = "SELECT * FROM  doctor_patient_relation 
				WHERE patient_id = ".$patient_id;
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getdetails_by_patientidArray($patient_id)
	{
		$sql = "SELECT doctor_id FROM  doctor_patient_relation 
				WHERE patient_id = ".$patient_id;
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getdetails_by_patientIdsForAcp($patient_id)
	{
		$sql = "SELECT doctor_id FROM  doctor_patient_relation 
				WHERE patient_id = ".$patient_id." and doctor_type = 2";
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getACPdetails_by_patientidArray($patient_id)
	{
		$sql = "SELECT doctor_id FROM  doctor_patient_relation
				WHERE doctor_type = 2 AND patient_id = ".$patient_id;
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}

	function getPCPdetails_by_patientidArray($patient_id)
	{
		$sql = "SELECT * FROM  doctor_patient_relation LEFT JOIN doctor_master ON doctor_master.doctor_id = doctor_patient_relation.doctor_id 
				WHERE doctor_type = 1 AND patient_id = ".$patient_id;
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}	function getdetails($doctor_id,$patient_id)
	{
		 $sql = "SELECT * FROM  doctor_patient_relation 
				WHERE doctor_id =  " .  $doctor_id . " AND patient_id = ".$patient_id;
		 $result	=Yii::app()->db->createCommand($sql)->queryRow();
		 return $result;
	}
	
	
	function checkRecord($doctor_id,$patient_id,$type)
	{
		 $sql = "SELECT * FROM  doctor_patient_relation 
				WHERE doctor_id =  " .  $doctor_id . " AND patient_id = ".$patient_id." and doctor_type = ".$type."";
		 $result	=Yii::app()->db->createCommand($sql)->queryRow();
		 return $result;
	}
	
	function deleteDoctorPatientRelation($doctor_id,$patient_id)
	{
		$sql = "delete FROM  doctor_patient_relation 
				WHERE doctor_id =  " .  $doctor_id . " AND patient_id = ".$patient_id;
		$result	=Yii::app()->db->createCommand($sql)->execute();
		return true;
	}
	
	
	function deletePatientData($patient_id,$type)
	{
		$sql = "delete FROM  doctor_patient_relation WHERE patient_id = ".$patient_id." and doctor_type = ".$type."";
		$result	=Yii::app()->db->createCommand($sql)->execute();
		return true;
	}
	
	function checkDoctorRelation($doctor_id)
	{
		 $sql = "SELECT * FROM  doctor_patient_relation 
				WHERE doctor_id =  " .  $doctor_id . " ";
		 $result	=Yii::app()->db->createCommand($sql)->queryAll();
		 return $result;
	}
	
	function getDetailsById($doct_pat_relation_id)
	{
		 $sql = "SELECT * FROM  doctor_patient_relation 
				WHERE doct_pat_relation_id =  " .  $doct_pat_relation_id . " ";
		 $result	=Yii::app()->db->createCommand($sql)->queryRow();
		 return $result;
	}
	
	function deleteDoctorPatientRelationById($doct_pat_relation_id)
	{
		$sql = "delete FROM  doctor_patient_relation 
				WHERE doct_pat_relation_id =  " .  $doct_pat_relation_id;
		$result	=Yii::app()->db->createCommand($sql)->execute();
		return true;
	}
}