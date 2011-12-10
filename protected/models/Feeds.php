<?php

/**
 * This is the model class for table "feeds".
 *
 * The followings are the available columns in table 'feeds':
 * @property integer $FEEDER_ID
 * @property integer $FED_ID
 * @property string $FEED_TIME
 */
class Feeds extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Feeds the static model class
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
		return 'feeds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FEEDER_ID, FED_ID, FEED_TIME', 'required'),
			array('FEEDER_ID, FED_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FEEDER_ID, FED_UID, FEED_TIME', 'safe', 'on'=>'search'),
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
			'FEEDER_ID' => 'Uid',
			'FED_ID' => 'Use Uid',
			'FEED_TIME' => 'Feed Time',
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

		$criteria->compare('FEEDER_ID',$this->FEEDER_ID);
		$criteria->compare('FED_ID',$this->FED_ID);
		$criteria->compare('FEED_TIME',$this->FEED_TIME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
