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
				'actions'=>array('index','view','rate','tip'),
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

    public function actionTip()
    {
        if (!isset($_POST['ajax'])) {
			// Do nothing
		} else {
		    //echo 2;
		    $course = $_POST['name'];
		    $id = Yii::app()->user->id;
    		$model=Course::model()->findByAttributes(array('COURSE_NAME'=>$course));
    		if ($model === null)
    		{
    			echo -1;
    			return;
    		}
    		else {
    		    $classes = array();
    		    $classResult = array();
    		    $classes = AClass::model()->findAllByAttributes(array(),
    		                                                    "COURSE_CODE =:code AND YEAR =:year AND SEMESTER =:semester",
    		                                                    array('code'=>$model->COURSE_CODE, 'year'=>$model->YEAR, 'semester'=>$model->SEMESTER));
    		    foreach ($classes as $aclass) {
				    array_push($classResult, array('teachers'=>$aclass->teachers, 'cid'=>$aclass->CID));
    			}
    		    if ($classes === null)
    		        echo -1;
    		    else
    		        echo CJSON::encode(array(
    				    'classes' => $classResult,
    				));
    		}
		}
    }
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	    $uid = Yii::app()->user->id;
	    $takes=Takes::model()->findByAttributes(array('UID'=>$uid, 'CID'=>$id));
	    $rate = 0;
	    if ($takes === null)
	       $rate = -1;
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AClass']))
		{
			$model->attributes=$_POST['AClass'];
			// TODO: save classlocation and classtime
			if($model->save())
			{
				Yii::app()->user->setFlash('success',
					'恭喜你，你成功添加了如下课程安排！下面你可以为这门课程添加老师和课时了。'
				);
				$this->redirect(array('view','id'=>$model->CID));
			}
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
}
