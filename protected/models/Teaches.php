<?php

/**
 * This is the model class for table "teaches".
 *
 * The followings are the available columns in table 'teaches':
 * @property integer $TID
 * @property integer $CID
 * @property double $SCORE
 */
class Teaches extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Teaches the static model class
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
		return 'teaches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TID, CID', 'required'),
			array('TID, CID', 'numerical', 'integerOnly'=>true),
			array('SCORE', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TID, CID, SCORE', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'teacher' => array(self::BELONGS_TO, 'Teacher', 'TID'),
			'class' => array(self::BELNGS_TO, 'Class', 'CID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TID' => '教师ID',
			'CID' => '课程ID',
			'SCORE' => 'Score',
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

		$criteria->compare('TID',$this->TID);
		$criteria->compare('CID',$this->CID);
		$criteria->compare('SCORE',$this->SCORE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
