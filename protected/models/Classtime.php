<?php

/**
 * This is the model class for table "classtime".
 *
 * The followings are the available columns in table 'classtime':
 * @property integer $TIMEID
 * @property string $START_TIME
 * @property string $END_TIME
 * @property integer $DAY_OF_WEEK
 * @property integer $WEEK_OF_SEMESTER
 *
 * The followings are the available model relations:
 * @property Atomclass[] $atomclasses
 */
class Classtime extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Classtime the static model class
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
		return 'classtime';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('START_TIME, END_TIME', 'required'),
			array('DAY_OF_WEEK, WEEK_OF_SEMESTER', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIMEID, START_TIME, END_TIME, DAY_OF_WEEK, WEEK_OF_SEMESTER', 'safe', 'on'=>'search'),
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
			'atomclasses' => array(self::HAS_MANY, 'Atomclass', 'TIMEID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TIMEID' => 'Timeid',
			'START_TIME' => 'Start Time',
			'END_TIME' => 'End Time',
			'DAY_OF_WEEK' => 'Day Of Week',
			'WEEK_OF_SEMESTER' => 'Week Of Semester',
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

		$criteria->compare('TIMEID',$this->TIMEID);
		$criteria->compare('START_TIME',$this->START_TIME,true);
		$criteria->compare('END_TIME',$this->END_TIME,true);
		$criteria->compare('DAY_OF_WEEK',$this->DAY_OF_WEEK);
		$criteria->compare('WEEK_OF_SEMESTER',$this->WEEK_OF_SEMESTER);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}