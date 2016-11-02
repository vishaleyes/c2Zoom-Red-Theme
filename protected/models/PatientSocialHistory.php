<?php

/**
 * This is the model class for table "patient_social_history".
 *
 * The followings are the available columns in table 'patient_social_history':
 * @property integer $patient_social_history_id
 * @property integer $patient_id
 * @property integer $employed
 * @property string $occupation
 * @property integer $children
 * @property string $how_many
 * @property integer $live
 * @property string $live_other
 * @property integer $aids
 * @property string $abuse_type
 * @property integer $use_alcohol
 * @property integer $how_often
 * @property integer $smoker
 * @property integer $no_of_pack
 * @property string $years
 * @property string $when_quit
 * @property integer $status
 * @property string $creation_at
 * @property string $modified_at
 */
class PatientSocialHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientSocialHistory the static model class
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
		return 'patient_social_history';
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
			array('patient_id, employed, children, live, aids, use_alcohol, how_often, smoker, no_of_pack, status', 'numerical', 'integerOnly'=>true),
			array('occupation, live_other, abuse_type', 'length', 'max'=>100),
			array('how_many', 'length', 'max'=>50),
			array('years', 'length', 'max'=>10),
			array('when_quit, creation_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_social_history_id, patient_id, employed, occupation, children, how_many, live, live_other, aids, abuse_type, use_alcohol, how_often, smoker, no_of_pack, years, when_quit, status, creation_at, modified_at', 'safe', 'on'=>'search'),
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
			'patient_social_history_id' => 'Patient Social History',
			'patient_id' => 'Patient',
			'employed' => 'Employed',
			'occupation' => 'Occupation',
			'children' => 'Children',
			'how_many' => 'How Many',
			'live' => 'Live',
			'live_other' => 'Live Other',
			'aids' => 'Aids',
			'abuse_type' => 'Abuse Type',
			'use_alcohol' => 'Use Alcohol',
			'how_often' => 'How Often',
			'smoker' => 'Smoker',
			'no_of_pack' => 'No Of Pack',
			'years' => 'Years',
			'when_quit' => 'When Quit',
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

		$criteria->compare('patient_social_history_id',$this->patient_social_history_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('employed',$this->employed);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('children',$this->children);
		$criteria->compare('how_many',$this->how_many,true);
		$criteria->compare('live',$this->live);
		$criteria->compare('live_other',$this->live_other,true);
		$criteria->compare('aids',$this->aids);
		$criteria->compare('abuse_type',$this->abuse_type,true);
		$criteria->compare('use_alcohol',$this->use_alcohol);
		$criteria->compare('how_often',$this->how_often);
		$criteria->compare('smoker',$this->smoker);
		$criteria->compare('no_of_pack',$this->no_of_pack);
		$criteria->compare('years',$this->years,true);
		$criteria->compare('when_quit',$this->when_quit,true);
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
		$sql = "select medi.*,pat.* from  patient_social_history  medi
				INNER JOIN patient_master pat on medi.patient_id  = pat.patient_id
 
					where pat.patient_id=".$patient_id  ;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
		
		
	}
	
	
	
	
	
	
	
}