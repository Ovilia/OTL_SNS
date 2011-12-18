<?php

class ClassController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'rate'),
				'roles'=>array('authenticated'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin', 'delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	    $uid = Yii::app()->user->id;
	    $takes=Takes::model()->findByAttributes(array('UID'=>$uid, 'CID'=>$id));
	    $rate = -1;
	    if ($takes === null)
	       $rate = 0;
	    else {
	       $rate = $takes->RATE;
	    }
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'star'=>$rate,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($course_code, $year, $semester)
	{
		$model=new AClass;
		$model->COURSE_CODE = $course_code;
		$model->YEAR = $year;
		$model->SEMESTER = $semester;
		$model->save();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AClass']))
		{
			$model->attributes=$_POST['AClass'];
			// TODO: save classlocation and classtime
			if($model->save())
				$this->redirect(array('view','id'=>$model->CID));
		}

		$this->render('create',array(
			'model'=>$model,
			'atomclasses'=>$model->getAtomClasses(),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AClass']))
		{
			$model->attributes=$_POST['AClass'];
			// TODO: save classlocation and classtime
			if($model->save())
				$this->redirect(array('view','id'=>$model->CID));
		}

		$this->render('update',array(
			'model'=>$model,
			'atomclasses'=>$model->getAtomClasses(),
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AClass');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AClass('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AClass']))
			$model->attributes=$_GET['AClass'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Add an atom class to the class.
	 * Create the classtime and classlocation it belongs to if they don't exist.
	 * TODO: This action is not finished!
	 */
	public function actionAddAtomClass()
	{
		$week = $_POST['week'];
		$day = $_POST['day'];
		$duration = $_POST['duration'];
		$building = $_POST['building'];
		$classroom = $_POST['classroom'];

		$classtime = new Classtime;
		$classtime->WEEK_OF_SEMESTER = $week;
		$classtime->DAY_OF_WEEK = $day;
		$times = Classtime::model()->decodeTimeDurations($duration);
		$classtime->START_TIME = $times['start'];
		$classtime->END_TIME = $times['end'];

		$this->performAjaxValidationForClasstime($classtime);

		$classlocation = new Classlocation;
		$classlocation->BUILDING_NUMBER = $building;
		$classlocation->CLASSROOM = $classroom;

		$this->performAjaxValidationForClasslocation($classlocation);

		if (isset($_POST['week']) &&
			isset($_POST['day'] &&
			isset($_POST['duration']) &&
			isset($_POST['building']) &&
			isset($_POST['classroom']))
		{
		}
		else
		{
		}
	}

	/**
	 * Rate a class.
	 */
	public function actionRate()
	{
	    if (!isset($_POST['ajax'])) {
			// Do nothing
		} else {
		    $cid = $_POST['cid'];
		    $star = $_POST['star'];
		    $id = Yii::app()->user->id;
    		$model=Takes::model()->findByAttributes(array('UID'=>$id, 'CID'=>$cid));
    		if ($model === null)
    		{
    			//$model = new Takes;
    			//$model->UID = $id;
    			//$model->CID = $cid;
    			//$model->RATE = $star;
    			//$model->save();
    			echo -1;
    		}
    		else {
    		    if ($model->RATE == 0) {
    		        $model->RATE = $star;
    		        $model->save();
    		        echo 1;
    		    }
    		    else
    		        echo 0;
    		}
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=AClass::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='aclass-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function performAjaxValidationForClasstime($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='class-arrangement-form')
		{
			$model->validate();
			foreach($model->getErrors() as $attribute=>$errors)
			{
				if ($attribute==="WEEK_OF_SEMESTER") {
					$result['week']=$errors;
				} elseif ($attribute==="DAY_OF_WEEK") {
					$result['day']=$errors;
				} else {
					$result['duration']=$errors;
				}
			}
			echo function_exists('json_encode') ?
				json_encode($result) : CJSON::encode($result);
			Yii::app()->end();
		}
	}

	public function performAjaxValidationForClasslocation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='class-arrangement-form')
		{
			$model->validate();
			foreach($model->getErrors() as $attribute=>$errors)
			{
				if ($attribute==="BUILDING_NUMBER") {
					$result['building']=$errors;
				} else ($attribute==="CLASSROOM") {
					$result['classroom']=$errors;
				}
			}
			echo function_exists('json_encode') ?
				json_encode($result) : CJSON::encode($result);
			Yii::app()->end();
		}
	}
}
