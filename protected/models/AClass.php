<?php

/**
 * This is the model class for table "Class".
 *
 * The followings are the available columns in table 'Class':
 * @property integer $CID
 * @property string $COURSE_CODE
 * @property string $YEAR
 * @property string $SEMESTER
 */
class AClass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AClass the static model class
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
		return 'Class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COURSE_CODE, SEMESTER', 'length', 'max'=>16),
			array('YEAR', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CID, COURSE_CODE, YEAR, SEMESTER', 'safe', 'on'=>'search'),
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
			'CID' => 'Cid',
			'COURSE_CODE' => 'Course Code',
			'YEAR' => 'Year',
			'SEMESTER' => 'Semester',
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

		$criteria->compare('CID',$this->CID);
		$criteria->compare('COURSE_CODE',$this->COURSE_CODE,true);
		$criteria->compare('YEAR',$this->YEAR,true);
		$criteria->compare('SEMESTER',$this->SEMESTER,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getClassesOfACourse($course_code, $year, $semester)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('COURSE_CODE', $course_code);
		$criteria->compare('YEAR', $year);
		$criteria->compare('SEMESTER', $semester);

		return new CActiveDataProvider('AClass', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}
}
