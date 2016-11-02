<?php

/**
 * This is the model class for table "patient_info_questionnaire".
 *
 * The followings are the available columns in table 'patient_info_questionnaire':
 * @property integer $patient_info_id
 * @property integer $patient_id
 * @property string $schedule_for
 * @property string $at_time
 * @property integer $about_practice
 * @property string $magazie_name
 * @property string $other_name
 * @property string $ph_ref_doctorname
 * @property string $ph_ref_phone
 * @property string $ph_address
 * @property string $pr_ref_doctorname
 * @property string $pr_ref_phone
 * @property string $pr_ref_address
 * @property string $patient_security_no
 * @property string $home_phone
 * @property string $mobile_phone
 * @property string $appt_no
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $alternate_address
 * @property integer $get_newsletter
 * @property integer $employment_status
 * @property string $employment_other
 * @property string $employer
 * @property string $occupation
 * @property string $employer_address
 * @property string $insured_firstname
 * @property string $insured_lastname
 * @property string $mi
 * @property string $insured_birthdate
 * @property string $insured_socialno
 * @property string $emergency_name
 * @property string $emergency_phone
 * @property string $emergency_address
 * @property string $relationship_to_patient
 * @property integer $is_auto_accident
 * @property integer $is_work_injury
 * @property string $pri_insurance_company
 * @property string $pri_insurance_id
 * @property string $pri_insurance_grp
 * @property string $pri_insurance_address
 * @property string $pri_insurance_phonenumber
 * @property string $sec_insurance_company
 * @property string $sec_insurance_id
 * @property string $sec_insurance_grp
 * @property string $sec_insurance_address
 * @property string $sec_insurance_phonenumber
 * @property string $comp_insurance
 * @property string $comp_claim
 * @property string $comp_address
 * @property string $comp_injury_date
 * @property string $adjuster_name
 * @property string $adjuster_phone
 * @property string $attorney_name
 * @property string $attorney_phone
 * @property string $info_insurance
 * @property string $info_claim
 * @property string $claim_address
 * @property string $info_date_injury
 * @property string $info_adjuster_name
 * @property string $info_adjuster_phone
 * @property string $info_attorney_name
 * @property string $info_attorney_phone
 * @property integer $status
 * @property string $creation_at
 * @property string $modified_at
 */
class patientInfoQuestionnaire extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return patientInfoQuestionnaire the static model class
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
		return 'patient_info_questionnaire';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, schedule_for, at_time', 'required'),
			array('patient_id, about_practice, get_newsletter, employment_status, is_auto_accident, is_work_injury, status', 'numerical', 'integerOnly'=>true),
			array('schedule_for, ph_address, pr_ref_address, alternate_address, employer, employer_address, emergency_address, pri_insurance_address, sec_insurance_address, comp_address, claim_address', 'length', 'max'=>250),
			array('at_time, zipcode', 'length', 'max'=>15),
			array('magazie_name, other_name, ph_ref_doctorname, pr_ref_doctorname, city, state, employment_other, occupation, insured_firstname, insured_lastname, pri_insurance_company, sec_insurance_company, comp_insurance, adjuster_name, attorney_name, info_insurance, info_claim, info_adjuster_name, info_attorney_name', 'length', 'max'=>100),
			array('ph_ref_phone, pr_ref_phone, adjuster_phone, attorney_phone, info_adjuster_phone, info_attorney_phone', 'length', 'max'=>20),
			array('patient_security_no, home_phone, mobile_phone, appt_no, insured_socialno, emergency_name, emergency_phone, relationship_to_patient, pri_insurance_id, pri_insurance_phonenumber, sec_insurance_id, comp_claim', 'length', 'max'=>50),
			array('mi, pri_insurance_grp, sec_insurance_grp, sec_insurance_phonenumber', 'length', 'max'=>10),
			array('insured_birthdate, comp_injury_date, info_date_injury, creation_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('patient_info_id, patient_id, schedule_for, at_time, about_practice, magazie_name, other_name, ph_ref_doctorname, ph_ref_phone, ph_address, pr_ref_doctorname, pr_ref_phone, pr_ref_address, patient_security_no, home_phone, mobile_phone, appt_no, city, state, zipcode, alternate_address, get_newsletter, employment_status, employment_other, employer, occupation, employer_address, insured_firstname, insured_lastname, mi, insured_birthdate, insured_socialno, emergency_name, emergency_phone, emergency_address, relationship_to_patient, is_auto_accident, is_work_injury, pri_insurance_company, pri_insurance_id, pri_insurance_grp, pri_insurance_address, pri_insurance_phonenumber, sec_insurance_company, sec_insurance_id, sec_insurance_grp, sec_insurance_address, sec_insurance_phonenumber, comp_insurance, comp_claim, comp_address, comp_injury_date, adjuster_name, adjuster_phone, attorney_name, attorney_phone, info_insurance, info_claim, claim_address, info_date_injury, info_adjuster_name, info_adjuster_phone, info_attorney_name, info_attorney_phone, status, creation_at, modified_at', 'safe', 'on'=>'search'),
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
			'patient_info_id' => 'Patient Info',
			'patient_id' => 'Patient',
			'schedule_for' => 'Schedule For',
			'at_time' => 'At Time',
			'about_practice' => 'About Practice',
			'magazie_name' => 'Magazie Name',
			'other_name' => 'Other Name',
			'ph_ref_doctorname' => 'Ph Ref Doctorname',
			'ph_ref_phone' => 'Ph Ref Phone',
			'ph_address' => 'Ph Address',
			'pr_ref_doctorname' => 'Pr Ref Doctorname',
			'pr_ref_phone' => 'Pr Ref Phone',
			'pr_ref_address' => 'Pr Ref Address',
			'patient_security_no' => 'Patient Security No',
			'home_phone' => 'Home Phone',
			'mobile_phone' => 'Mobile Phone',
			'appt_no' => 'Appt No',
			'city' => 'City',
			'state' => 'State',
			'zipcode' => 'Zipcode',
			'alternate_address' => 'Alternate Address',
			'get_newsletter' => 'Get Newsletter',
			'employment_status' => 'Employment Status',
			'employment_other' => 'Employment Other',
			'employer' => 'Employer',
			'occupation' => 'Occupation',
			'employer_address' => 'Employer Address',
			'insured_firstname' => 'Insured Firstname',
			'insured_lastname' => 'Insured Lastname',
			'mi' => 'Mi',
			'insured_birthdate' => 'Insured Birthdate',
			'insured_socialno' => 'Insured Socialno',
			'emergency_name' => 'Emergency Name',
			'emergency_phone' => 'Emergency Phone',
			'emergency_address' => 'Emergency Address',
			'relationship_to_patient' => 'Relationship To Patient',
			'is_auto_accident' => 'Is Auto Accident',
			'is_work_injury' => 'Is Work Injury',
			'pri_insurance_company' => 'Pri Insurance Company',
			'pri_insurance_id' => 'Pri Insurance',
			'pri_insurance_grp' => 'Pri Insurance Grp',
			'pri_insurance_address' => 'Pri Insurance Address',
			'pri_insurance_phonenumber' => 'Pri Insurance Phonenumber',
			'sec_insurance_company' => 'Sec Insurance Company',
			'sec_insurance_id' => 'Sec Insurance',
			'sec_insurance_grp' => 'Sec Insurance Grp',
			'sec_insurance_address' => 'Sec Insurance Address',
			'sec_insurance_phonenumber' => 'Sec Insurance Phonenumber',
			'comp_insurance' => 'Comp Insurance',
			'comp_claim' => 'Comp Claim',
			'comp_address' => 'Comp Address',
			'comp_injury_date' => 'Comp Injury Date',
			'adjuster_name' => 'Adjuster Name',
			'adjuster_phone' => 'Adjuster Phone',
			'attorney_name' => 'Attorney Name',
			'attorney_phone' => 'Attorney Phone',
			'info_insurance' => 'Info Insurance',
			'info_claim' => 'Info Claim',
			'claim_address' => 'Claim Address',
			'info_date_injury' => 'Info Date Injury',
			'info_adjuster_name' => 'Info Adjuster Name',
			'info_adjuster_phone' => 'Info Adjuster Phone',
			'info_attorney_name' => 'Info Attorney Name',
			'info_attorney_phone' => 'Info Attorney Phone',
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

		$criteria->compare('patient_info_id',$this->patient_info_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('schedule_for',$this->schedule_for,true);
		$criteria->compare('at_time',$this->at_time,true);
		$criteria->compare('about_practice',$this->about_practice);
		$criteria->compare('magazie_name',$this->magazie_name,true);
		$criteria->compare('other_name',$this->other_name,true);
		$criteria->compare('ph_ref_doctorname',$this->ph_ref_doctorname,true);
		$criteria->compare('ph_ref_phone',$this->ph_ref_phone,true);
		$criteria->compare('ph_address',$this->ph_address,true);
		$criteria->compare('pr_ref_doctorname',$this->pr_ref_doctorname,true);
		$criteria->compare('pr_ref_phone',$this->pr_ref_phone,true);
		$criteria->compare('pr_ref_address',$this->pr_ref_address,true);
		$criteria->compare('patient_security_no',$this->patient_security_no,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('appt_no',$this->appt_no,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('alternate_address',$this->alternate_address,true);
		$criteria->compare('get_newsletter',$this->get_newsletter);
		$criteria->compare('employment_status',$this->employment_status);
		$criteria->compare('employment_other',$this->employment_other,true);
		$criteria->compare('employer',$this->employer,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('employer_address',$this->employer_address,true);
		$criteria->compare('insured_firstname',$this->insured_firstname,true);
		$criteria->compare('insured_lastname',$this->insured_lastname,true);
		$criteria->compare('mi',$this->mi,true);
		$criteria->compare('insured_birthdate',$this->insured_birthdate,true);
		$criteria->compare('insured_socialno',$this->insured_socialno,true);
		$criteria->compare('emergency_name',$this->emergency_name,true);
		$criteria->compare('emergency_phone',$this->emergency_phone,true);
		$criteria->compare('emergency_address',$this->emergency_address,true);
		$criteria->compare('relationship_to_patient',$this->relationship_to_patient,true);
		$criteria->compare('is_auto_accident',$this->is_auto_accident);
		$criteria->compare('is_work_injury',$this->is_work_injury);
		$criteria->compare('pri_insurance_company',$this->pri_insurance_company,true);
		$criteria->compare('pri_insurance_id',$this->pri_insurance_id,true);
		$criteria->compare('pri_insurance_grp',$this->pri_insurance_grp,true);
		$criteria->compare('pri_insurance_address',$this->pri_insurance_address,true);
		$criteria->compare('pri_insurance_phonenumber',$this->pri_insurance_phonenumber,true);
		$criteria->compare('sec_insurance_company',$this->sec_insurance_company,true);
		$criteria->compare('sec_insurance_id',$this->sec_insurance_id,true);
		$criteria->compare('sec_insurance_grp',$this->sec_insurance_grp,true);
		$criteria->compare('sec_insurance_address',$this->sec_insurance_address,true);
		$criteria->compare('sec_insurance_phonenumber',$this->sec_insurance_phonenumber,true);
		$criteria->compare('comp_insurance',$this->comp_insurance,true);
		$criteria->compare('comp_claim',$this->comp_claim,true);
		$criteria->compare('comp_address',$this->comp_address,true);
		$criteria->compare('comp_injury_date',$this->comp_injury_date,true);
		$criteria->compare('adjuster_name',$this->adjuster_name,true);
		$criteria->compare('adjuster_phone',$this->adjuster_phone,true);
		$criteria->compare('attorney_name',$this->attorney_name,true);
		$criteria->compare('attorney_phone',$this->attorney_phone,true);
		$criteria->compare('info_insurance',$this->info_insurance,true);
		$criteria->compare('info_claim',$this->info_claim,true);
		$criteria->compare('claim_address',$this->claim_address,true);
		$criteria->compare('info_date_injury',$this->info_date_injury,true);
		$criteria->compare('info_adjuster_name',$this->info_adjuster_name,true);
		$criteria->compare('info_adjuster_phone',$this->info_adjuster_phone,true);
		$criteria->compare('info_attorney_name',$this->info_attorney_name,true);
		$criteria->compare('info_attorney_phone',$this->info_attorney_phone,true);
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
		$sql = "select qua.*,pat.* from  patient_info_questionnaire  qua
				RIGHT JOIN patient_master pat on qua.patient_id  = pat.patient_id
 
					where pat.patient_id=".$patient_id;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
		
		
	}
	
	public function getPatientdetails($patient_id)
	{
		$sql = "select * from  patient_info_questionnaire where patient_id=".$patient_id;
	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
		
		
	}
	
	public function getACPPCP($patient_id)
	{
		$sql = "select qua.*,pat.* from  patient_info_questionnaire  qua
				INNER JOIN patient_master pat on qua.patient_id  = pat.patient_id
					where pat.patient_id=".$patient_id;
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
}