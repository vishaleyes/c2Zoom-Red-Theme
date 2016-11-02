<?php

/**
 * This is the model class for table "patient_image_manager".
 *
 * The followings are the available columns in table 'patient_image_manager':
 * @property integer $patient_id
 * @property string $image_name
 * @property string $created_at
 * @property string $modified_at
 */
class PatientImageManager extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientImageManager the static model class
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
		return 'patient_image_manager';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_name, created_at, modified_at', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_id, image_name, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'patient_id' => 'Patient',
			'image_name' => 'Image Name',
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

		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getImageListByPatient($patient_id)
	{
		$sql = "SELECT * FROM patient_image_manager where patient_id=$patient_id ORDER BY image_id DESC";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	public function getImageById($image_id)
	{
		$sql = "SELECT * FROM patient_image_manager where image_id=$image_id";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}	

	public function setData($data)
	{
		$this->data = $data;
	}
	
	public function insertData($id=NULL)
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
			foreach($this->data as $key=>$value)
			{
				$this->$key=$value;
			}			
			$this->setIsNewRecord(true);			
			$this->save(false);			
			return Yii::app()->db->getLastInsertID();
		}
		
	}
	public function deleteImage($image_id)
	{
		$sql = "DELETE FROM patient_image_manager WHERE image_id=".$image_id;
		$result	= Yii::app()->db->createCommand($sql)->execute();
		return $result;
	}
}