<?php

/**
 * This is the model class for table "cmspage".
 *
 * The followings are the available columns in table 'cmspage':
 * @property integer $pageid
 * @property string $pagetitle
 * @property string $pagedescription
 * @property string $createddate
 * @property string $updateddate
 */
class CmsPage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CmsPage the static model class
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
		return 'cmspage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pagetitle, pagedescription', 'required'),
			array('pagetitle', 'length', 'max'=>255),
			array('createddate, updateddate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pageid, pagetitle, pagedescription, createddate, updateddate', 'safe', 'on'=>'search'),
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
			'pageid' => 'Pageid',
			'pagetitle' => 'Pagetitle',
			'pagedescription' => 'Pagedescription',
			'createddate' => 'Createddate',
			'updateddate' => 'Updateddate',
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

		$criteria->compare('pageid',$this->pageid);
		$criteria->compare('pagetitle',$this->pagetitle,true);
		$criteria->compare('pagedescription',$this->pagedescription,true);
		$criteria->compare('createddate',$this->createddate,true);
		$criteria->compare('updateddate',$this->updateddate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getAllStaticPageList()
	{
		$sql = "SELECT * FROM cmspage";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	public function getStaticPageById($pageid)
	{
		$sql = "SELECT * FROM cmspage where pageid=$pageid";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
}