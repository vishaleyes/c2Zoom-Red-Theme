<?php

/**
 * This is the model class for table "patient_anethesia_history".
 *
 * The followings are the available columns in table 'patient_anethesia_history':
 * @property integer $patient_anethesia_id
 * @property integer $patient_id
 * @property string $anethesia_type
 * @property string $report_date
 * @property string $reaction
 * @property integer $status
 * @property string $creation_at
 * @property string $modified_at
 */
class PatientAnethesiaHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientAnethesiaHistory the static model class
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
		return 'patient_anethesia_history';
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
			array('anethesia_type', 'length', 'max'=>200),
			array('reaction', 'length', 'max'=>250),
			array('report_date, creation_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_anethesia_id, patient_id, anethesia_type, report_date, reaction, status, creation_at, modified_at', 'safe', 'on'=>'search'),
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
			'patient_anethesia_id' => 'Patient Anethesia',
			'patient_id' => 'Patient',
			'anethesia_type' => 'Anethesia Type',
			'report_date' => 'Report Date',
			'reaction' => 'Reaction',
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

		$criteria->compare('patient_anethesia_id',$this->patient_anethesia_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('anethesia_type',$this->anethesia_type,true);
		$criteria->compare('report_date',$this->report_date,true);
		$criteria->compare('reaction',$this->reaction,true);
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
		$sql = "select sur.*,pat.*,sur.created_at AS createdAt,sur.modified_at AS modifiedAt from  patient_anethesia_history  sur
				INNER JOIN patient_master pat on sur.patient_id  = pat.patient_id
 
					where pat.patient_id=".$patient_id." order by sur.created_at DESC";
	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		
		return $result;
		
	}
	public function getdetailsByanethesiaId($patient_anethesia_id)
	{
		$sql = "select * from  patient_anethesia_history  
					where patient_anethesia_id = ".$patient_anethesia_id;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
		
	}
	
	function deleteanethesiaByIds($idArr,$patient_id)
	{
		$sql = "delete from patient_anethesia_history   
where patient_anethesia_id in (".$idArr.") and patient_id='".$patient_id."' ";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	function deleteanethesiaById($id)
	{
		$sql = "delete from patient_anethesia_history   
where patient_anethesia_id = ".$id."";
	
		$result	= Yii::app()->db->createCommand($sql)->query();
		return $result;
	}
	
	
	
	
}