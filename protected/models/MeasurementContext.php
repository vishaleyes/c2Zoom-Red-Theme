<?php

/**
 * This is the model class for table "measurement_context".
 *
 * The followings are the available columns in table 'measurement_context':
 * @property integer $measurement_context_id
 * @property string $context_name
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class MeasurementContext extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MeasurementContext the static model class
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
		return 'measurement_context';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('context_name', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('context_name', 'length', 'max'=>255),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('measurement_context_id, context_name, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'measurement_context_id' => 'Measurement Context',
			'context_name' => 'Context Name',
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

		$criteria->compare('measurement_context_id',$this->measurement_context_id);
		$criteria->compare('context_name',$this->context_name,true);
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
	
	
	
	function measurementContextList()
	{
		$sql = " select * from measurement_context where status=1 ";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	function getMeasurementContextById($measurement_context_id)
	{
		$sql = " select context_name from measurement_context where measurement_context_id='".$measurement_context_id."' ";	
		$result	= Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
}