<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $MID
 * @property integer $UID
 * @property integer $USE_UID
 * @property string $SEND_TIME
 * @property integer $ISREAD
 * @property string $CONTENT
 *
 * The followings are the available model relations:
 * @property User $uSEU
 * @property User $u
 */
class Message extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Message the static model class
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
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UID, USE_UID, CONTENT', 'required'),
			array('UID, USE_UID', 'exist', 'allowEmpty'=>false,
				'attributeName'=>'UID', 'className'=>'User'),
			array('UID, USE_UID, ISREAD', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MID, UID, USE_UID, SEND_TIME, ISREAD, CONTENT', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'Receiver' => array(self::BELONGS_TO, 'User', 'USE_UID'),
			'Sender' => array(self::BELONGS_TO, 'User', 'UID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MID' => 'Message ID',
			'UID' => '发件人ID',
			'USE_UID' => '收件人ID',
			'SEND_TIME' => '发送时间',
			'ISREAD' => 'Is Read?',
			'CONTENT' => '内容',
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

		$criteria->compare('MID',$this->MID);
		$criteria->compare('UID',$this->UID);
		$criteria->compare('USE_UID',$this->USE_UID);
		$criteria->compare('SEND_TIME',$this->SEND_TIME,true);
		$criteria->compare('ISREAD',$this->ISREAD);
		$criteria->compare('CONTENT',$this->CONTENT,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Handle the ISREAD column.
	 */
	public function beRead()
	{
		// set ISREAD 1 if it's not
		if ($this->ISREAD == 0) {
			$this->ISREAD = 1;
			// save this back to the database
			$this->save();
		}
	}
}
