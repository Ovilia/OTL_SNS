<?php

/**
 * This is the model class for table "Course".
 *
 * The followings are the available columns in table 'Course':
 * @property string $COURSE_CODE
 * @property string $YEAR
 * @property string $SEMESTER
 * @property string $COURSE_NAME
 *
 * The followings are the available model relations:
 * @property Class[] $classes
 * @property Class[] $classes1
 * @property Class[] $classes2
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Course the static model class
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
		return 'Course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COURSE_CODE, YEAR, SEMESTER, COURSE_NAME', 'required'),
			array('COURSE_CODE, SEMESTER', 'length', 'max'=>16),
			array('YEAR', 'length', 'max'=>4),
			array('COURSE_NAME', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('COURSE_CODE, YEAR, SEMESTER, COURSE_NAME', 'safe', 'on'=>'search'),
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
			'classes' => array(self::HAS_MANY, 'Class', 'COURSE_CODE'),
			'classes1' => array(self::HAS_MANY, 'Class', 'YEAR'),
			'classes2' => array(self::HAS_MANY, 'Class', 'SEMESTER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COURSE_CODE' => 'Course Code',
			'YEAR' => 'Year',
			'SEMESTER' => 'Semester',
			'COURSE_NAME' => 'Course Name',
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

		$criteria->compare('COURSE_CODE',$this->COURSE_CODE,true);
		$criteria->compare('YEAR',$this->YEAR,true);
		$criteria->compare('SEMESTER',$this->SEMESTER,true);
		$criteria->compare('COURSE_NAME',$this->COURSE_NAME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}