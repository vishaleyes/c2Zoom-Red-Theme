<?php
/**
 * This is the model class for table "document_master".
 *
 * The followings are the available columns in table 'document_master':
 * @property integer $documentid
 * @property string $documentname
 * @property string $viewaction
 * @property datetime $createddate
 * @property datetime $modifieddate
 */
class DocumentMaster extends CActiveRecord
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
			array('documentname, createddate, modifieddate', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentid, documentname, createddate, modifieddate', 'safe', 'on'=>'search'),
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
			'documentid' => 'Document Id',
			'documentname' => 'Document Name',
			'createddate' => 'Created At',
			'modifieddate' => 'Modified At',
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

		$criteria->compare('documentid',$this->documentid);
		$criteria->compare('documentname',$this->documentname,true);
		$criteria->compare('createddate',$this->createddate,true);
		$criteria->compare('modifieddate',$this->modifieddate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getDocumentList($PatientId)
	{
		$sql = "SELECT 
					document_master.documentid, 
					document_master.documentname, 
					document_master.viewaction, 
					document_master.submitaction, 
					document_master.createddate, 
					patient_document_log.modifieddate 
				FROM 
					document_master 
				LEFT JOIN
					patient_document_log
				ON 
					patient_document_log.documentid = document_master.documentid 
				WHERE 
					patient_document_log.patient_id=$PatientId 
				ORDER BY 
					document_master.documentid ASC";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	
	public function getDocumentListMobile($PatientId,$start,$length,$keyword=NULL,$sort="document_master.documentid",$sort_type="ASC")
	{
		 $sql = "SELECT 
					document_master.documentid, 
					document_master.documentname, 
					document_master.viewaction, 
					document_master.submitaction, 
					document_master.createddate, 
					patient_document_log.modifieddate 
				FROM 
					document_master 
				LEFT JOIN
					patient_document_log
				ON 
					patient_document_log.documentid = document_master.documentid 
				WHERE 
					patient_document_log.patient_id=$PatientId  and document_master.documentname LIKE '%".$keyword."%'
				ORDER BY 
					".$sort." ".$sort_type." limit ".$start.", ".$length;
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	public function getDocumentListCountForMobile($PatientId,$start,$length,$keyword)
	{
		 $sql = "SELECT 
					count(*) as total
				FROM 
					document_master 
				LEFT JOIN
					patient_document_log
				ON 
					patient_document_log.documentid = document_master.documentid 
				WHERE 
					patient_document_log.patient_id=$PatientId  and document_master.documentname LIKE '%".$keyword."%'
				ORDER BY 
					document_master.documentid ASC limit ".$start.", ".$length;
		$result	= Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
	public function getDocumentById($documentid)
	{
		$sql = "SELECT * FROM document_master where documentid=$documentid";
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
	public function deleteDocument($documentid)
	{
		$sql = "DELETE FROM document_master WHERE documentid=".$documentid;
		$result	= Yii::app()->db->createCommand($sql)->execute();
		return $result;
	}
}