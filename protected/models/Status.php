<?php

/**
 * This is the model class for table "STATUS".
 *
 * The followings are the available columns in table 'STATUS':
 * @property integer $SID
 * @property integer $UID
 * @property string $UPDATE_TIME
 * @property string $CONTENT
 *
 * The followings are the available model relations:
 * @property COMMENTS[] $cOMMENTSs
 * @property USER $u
 */
class Status extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Status the static model class
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
		return 'STATUS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UID, CONTENT', 'required'),
			array('UID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SID, UID, UPDATE_TIME, CONTENT', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'COMMENTS', 'SID'),
			'user' => array(self::BELONGS_TO, 'USER', 'UID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SID' => 'Sid',
			'UID' => 'Uid',
			'UPDATE_TIME' => 'Update Time',
			'CONTENT' => 'Content',
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

		$criteria->compare('SID',$this->SID);
		$criteria->compare('UID',$this->UID);
		$criteria->compare('UPDATE_TIME',$this->UPDATE_TIME,true);
		$criteria->compare('CONTENT',$this->CONTENT,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}