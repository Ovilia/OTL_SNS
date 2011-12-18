<?php

/**
 * This is the model class for table "COMMENTS".
 *
 * The followings are the available columns in table 'COMMENTS':
 * @property integer $UID
 * @property integer $SID
 * @property integer $COMID
 * @property string $COMMENT_TIME
 * @property string $CONTENT
 */
class Comments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comments the static model class
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
		return 'COMMENTS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UID, SID, CONTENT', 'required'),
			array('UID, SID, COMID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UID, SID, COMID, COMMENT_TIME, CONTENT', 'safe', 'on'=>'search'),
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
			'UID' => 'Uid',
			'SID' => 'Sid',
			'COMID' => 'Comid',
			'COMMENT_TIME' => 'Comment Time',
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

		$criteria->compare('UID',$this->UID);
		$criteria->compare('SID',$this->SID);
		$criteria->compare('COMID',$this->COMID);
		$criteria->compare('COMMENT_TIME',$this->COMMENT_TIME,true);
		$criteria->compare('CONTENT',$this->CONTENT,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}