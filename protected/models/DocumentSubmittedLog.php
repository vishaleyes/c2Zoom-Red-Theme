<?php
/**
 * This is the model class for table "document_submitted_log".
 *
 * The followings are the available columns in table 'document_submitted_log':
 * @property integer $documentsubmittedlogid
 * @property integer $documentid
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property integer $documentpdffile
 * @property string $submitteddate
 */
class DocumentSubmittedLog extends CActiveRecord
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
		return 'document_submitted_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentid', 'required'),
			array('patient_id', 'required'),
			array('doctor_id', 'required'),
			array('patient_id, doctor_id', 'numerical', 'integerOnly'=>true),
			array('documentpdffile', 'required'),
			array('submitteddate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('	documentsubmittedlogid, documentid,  patient_id, doctor_id, documentpdffile, submitteddate', 'safe', 'on'=>'search'),
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
			'documentsubmittedlogid' => 'Document Submitted Log',
			'documentid' => 'Document Name',
			'patient_id' => 'Patient',
			'doctor_id' => 'Doctor',
			'documentpdffile' => 'Document File',
			'submitteddate' => 'Submitted On'
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
		$criteria->compare('documentsubmittedlogid',$this->documentsubmittedlogid);
		$criteria->compare('documentid',$this->documentid);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('documentpdffile',$this->documentpdffile);
		$criteria->compare('submitteddate',$this->submitteddate,true);
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
	
	function GetDocumentSubmittedLogList($PatientId)
	{
		$sql = "SELECT 
			document_submitted_log.documentsubmittedlogid,
			document_submitted_log.documentid,
			document_submitted_log.patient_id,
			document_submitted_log.doctor_id,
			document_submitted_log.documentpdffile,
			document_submitted_log.submitteddate as SubmittedOn,
			document_master.documentname as Document,
			CONCAT(doctor_master.name, ' ', doctor_master.surname) as DoctorName
		FROM 
			document_submitted_log 
		LEFT JOIN 
			document_master 
		ON
			document_master.documentid = document_submitted_log.documentid
		LEFT JOIN 
			doctor_master 
		ON 
			doctor_master.doctor_id = document_submitted_log.doctor_id 
		WHERE 
			patient_id = ".$PatientId."  
		ORDER BY 
			document_submitted_log.documentsubmittedlogid DESC";
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function GetDocumentSubmittedLogListForMobile($PatientId,$start=0,$length=10,$keyword=NULL,$sort,$sort_type)
	{
		$sql = "SELECT 
			document_submitted_log.documentsubmittedlogid,
			document_submitted_log.documentid,
			document_submitted_log.patient_id,
			document_submitted_log.doctor_id,
			document_submitted_log.documentpdffile,
			document_submitted_log.submitteddate as SubmittedOn,
			document_master.documentname as Document,
			CONCAT(doctor_master.name, ' ', doctor_master.surname) as DoctorName
		FROM 
			document_submitted_log 
		LEFT JOIN 
			document_master 
		ON
			document_master.documentid = document_submitted_log.documentid
		LEFT JOIN 
			doctor_master 
		ON 
			doctor_master.doctor_id = document_submitted_log.doctor_id 
		WHERE 
			patient_id = ".$PatientId."  and  document_master.documentname LIKE '%".$keyword."%' 
		ORDER BY 
			".$sort." ".$sort_type." limit ".$start.", ".$length;
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function GetDocumentSubmittedLogListForMobileCount($PatientId,$start=0,$length=10,$keyword=NULL)
	{
		$sql = "SELECT 
			count(*) as total
		FROM 
			document_submitted_log 
		LEFT JOIN 
			document_master 
		ON
			document_master.documentid = document_submitted_log.documentid
		LEFT JOIN 
			doctor_master 
		ON 
			doctor_master.doctor_id = document_submitted_log.doctor_id 
		WHERE 
			patient_id = ".$PatientId." and  document_master.documentname LIKE '%".$keyword."%' 
		ORDER BY 
			document_submitted_log.documentsubmittedlogid DESC limit ".$start.", ".$length;
		$result	=Yii::app()->db->createCommand($sql)->queryScalar();
		return $result;
	}
	
	/**
	 * Code added to collect list of Received Document for Doctor user.
	 * In case pass $PatientId then filter the records for that patient user only for the logged in Doctor user.
	 * 
	 * @param int $DoctorId
	 * @param int $PatientId Default NULL
	 * @return object
	 * 
	 * @author pratik.shah
	 * @since Oct 2015
	 */
	function GetDocumentReceivedLogList($DoctorId, $PatientId = NULL)
	{
		//@Todo: need to update ORDER BY clause once added field of notify flag, As based on that not notify flag records are going to display on the top most record.
		if (is_null($PatientId))
		{
			$sql = "SELECT
						document_submitted_log.documentsubmittedlogid,
						document_submitted_log.documentid,
						document_submitted_log.patient_id,
						document_submitted_log.doctor_id,
						document_submitted_log.documentpdffile,
						document_submitted_log.notifyPatient,
						document_submitted_log.notifyDatetime,
						document_submitted_log.submitteddate as SubmittedOn,
						document_master.documentname as Document,
						CONCAT(patient_master.name, ' ', patient_master.surname) as PatientName
					FROM
						document_submitted_log
					LEFT JOIN
						document_master
					ON
						document_master.documentid = document_submitted_log.documentid
					LEFT JOIN
						patient_master
					ON
						patient_master.patient_id = document_submitted_log.patient_id
					WHERE
						document_submitted_log.doctor_id = ".$DoctorId."
					ORDER BY
						document_submitted_log.documentsubmittedlogid DESC";
		}
		else
		{
			$sql = "SELECT
						document_submitted_log.documentsubmittedlogid,
						document_submitted_log.documentid,
						document_submitted_log.patient_id,
						document_submitted_log.doctor_id,
						document_submitted_log.documentpdffile,
						document_submitted_log.notifyPatient,
						document_submitted_log.notifyDatetime,
						document_submitted_log.submitteddate as SubmittedOn,
						document_master.documentname as Document,
						CONCAT(patient_master.name, ' ', patient_master.surname) as PatientName
					FROM
						document_submitted_log
					LEFT JOIN
						document_master
					ON
						document_master.documentid = document_submitted_log.documentid
					LEFT JOIN
						patient_master
					ON
						patient_master.patient_id = document_submitted_log.patient_id
					WHERE
						document_submitted_log.doctor_id = ".$DoctorId."
					AND
						patient_master.patient_id = ".$PatientId."
					ORDER BY
						document_submitted_log.documentsubmittedlogid DESC";
		}
		$result	=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
}
?>