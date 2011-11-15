<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $UID
 * @property string $LOGIN_NAME
 * @property string $EMAIL
 * @property string $PASSWORD
 * @property string $REGISTER_TIME
 * @property string $NICK_NAME
 * @property integer $ISADMIN
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UID, LOGIN_NAME, EMAIL, PASSWORD, REGISTER_TIME', 'required'),
			array('UID, ISADMIN', 'numerical', 'integerOnly'=>true),
			array('LOGIN_NAME, NICK_NAME', 'length', 'max'=>32),
			array('EMAIL', 'length', 'max'=>64),
			array('PASSWORD', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UID, LOGIN_NAME, EMAIL, PASSWORD, REGISTER_TIME, NICK_NAME, ISADMIN', 'safe', 'on'=>'search'),
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
			'LOGIN_NAME' => 'Login Name',
			'EMAIL' => 'Email',
			'PASSWORD' => 'Password',
			'REGISTER_TIME' => 'Register Time',
			'NICK_NAME' => 'Nick Name',
			'ISADMIN' => 'Isadmin',
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
		$criteria->compare('LOGIN_NAME',$this->LOGIN_NAME,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('PASSWORD',$this->PASSWORD,true);
		$criteria->compare('REGISTER_TIME',$this->REGISTER_TIME,true);
		$criteria->compare('NICK_NAME',$this->NICK_NAME,true);
		$criteria->compare('ISADMIN',$this->ISADMIN);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
	{
		return (md5($password) === $this->PASSWORD);
	}
}