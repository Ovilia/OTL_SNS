<?php

/**
 * This is the model class for table "classlocation".
 *
 * The followings are the available columns in table 'classlocation':
 * @property integer $BUILDING_NUMBER
 * @property string $CLASSROOM
 *
 * The followings are the available model relations:
 * @property Atomclass[] $atomclasses
 * @property Atomclass[] $atomclasses1
 */
class Classlocation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Classlocation the static model class
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
		return 'classlocation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BUILDING_NUMBER, CLASSROOM', 'required'),
			array('BUILDING_NUMBER', 'numerical', 'integerOnly'=>true),
			array('CLASSROOM', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('BUILDING_NUMBER, CLASSROOM', 'safe', 'on'=>'search'),
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
			'atomclasses' => array(self::HAS_MANY, 'Atomclass', 'BUILDING_NUMBER'),
			'atomclasses1' => array(self::HAS_MANY, 'Atomclass', 'CLASSROOM'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'BUILDING_NUMBER' => '教学楼号',
			'CLASSROOM' => '教室号',
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

		$criteria->compare('BUILDING_NUMBER',$this->BUILDING_NUMBER);
		$criteria->compare('CLASSROOM',$this->CLASSROOM,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
