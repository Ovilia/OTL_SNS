<?php

/**
 * This is the model class for table "atomclass".
 *
 * The followings are the available columns in table 'atomclass':
 * @property integer $ACID
 * @property integer $CID
 * @property integer $BUILDING_NUMBER
 * @property string $CLASSROOM
 * @property integer $TIMEID
 *
 * The followings are the available model relations:
 * @property Classtime $tIME
 * @property Classlocation $bUILDINGNUMBER
 * @property Classlocation $cLASSROOM
 * @property Class $c
 */
class Atomclass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Atomclass the static model class
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
		return 'atomclass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BUILDING_NUMBER, CLASSROOM, TIMEID', 'required'),
			array('CID, BUILDING_NUMBER, TIMEID', 'numerical', 'integerOnly'=>true),
			array('CLASSROOM', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACID, CID, BUILDING_NUMBER, CLASSROOM, TIMEID', 'safe', 'on'=>'search'),
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
			'classtime' => array(self::BELONGS_TO, 'Classtime', 'TIMEID'),
			'buildingNumber' => array(self::BELONGS_TO, 'Classlocation', 'BUILDING_NUMBER'),
			'classRoom' => array(self::BELONGS_TO, 'Classlocation', 'CLASSROOM'),
			'theClass' => array(self::BELONGS_TO, 'Class', 'CID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACID' => 'Acid',
			'CID' => 'Cid',
			'BUILDING_NUMBER' => 'Building Number',
			'CLASSROOM' => 'Classroom',
			'TIMEID' => 'Timeid',
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

		$criteria->compare('ACID',$this->ACID);
		$criteria->compare('CID',$this->CID);
		$criteria->compare('BUILDING_NUMBER',$this->BUILDING_NUMBER);
		$criteria->compare('CLASSROOM',$this->CLASSROOM,true);
		$criteria->compare('TIMEID',$this->TIMEID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAtomClassesOfAClass($cid)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('CID', $cid);

		return new CActiveDataProvider('Atomclass', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}

	public function classLocationToString()
	{
		return $this->BUILDING_NUMBER . "号楼, " . $this->CLASSROOM . '教室';
	}
	
	public function classTimeToString()
	{
		$string = "";
		$classtime = $this->classtime;
		$string .= "第" . $classtime->WEEK_OF_SEMESTER . "周";
		$string .= $classtime->dayOfWeek($classtime->DAY_OF_WEEK) . ", ";
		$string .= $classtime->START_TIME . "-" . $classtime->END_TIME;
		return $string;
	}

	public function atomclassDuplicate($model)
	{
		return (Atomclass::model()->exists(
			"CID=$model->CID and
			TIMEID=$model->TIMEID and
			BUILDING_NUMBER=$model->BUILDING_NUMBER and
			CLASSROOM=$model->CLASSROOM"));
	}

	public function classtimeOccupied($atomclass)
	{
		return (Atomclass::model()->exists(
			"CID=$model->CID and
			TIMEID=$model->TIMEID"));
	}

	public function classlocationOccupied($atomclass)
	{
		return (Atomclass::model()->exists(
			"TIMEID=$model->TIMEID and
			BUILDING_NUMBER=$model->BUILDING_NUMBER and
			CLASSROOM=$model->CLASSROOM"));
	}
}
