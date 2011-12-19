<?php

class ClasstimeController extends Controller
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
				'actions'=>array('index','view'),
				'roles'=>array('authenticated'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('list', 'selectView', 'choose', 'create','update', 'admin', 'delete'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionSelectView($class_id)
	{
		$model=new Classtime;
		$this->render('selectView', array(
			'model'=>$model,
			'class_id'=>$class_id
		));
	}

	public function actionCreate($class_id)
	{
		$model=new Classtime;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Classtime']))
		{
			$model->attributes=$_POST['Classtime'];
			if($model->save())
			{
				$this->redirect(array('choose',
					'class_id'=>$class_id,
					'time_id'=>$model->TIMEID));
			}
		}

		$this->renderPartial('_form',array(
			'model'=>$model,
			'class_id'=>$class_id,
		));
	}

	public function actionList($class_id)
	{
		$model=new Classtime;
		$this->renderPartial('_list', array(
			'model'=>$model,
			'class_id'=>$class_id,
		));
	}

	public function actionChoose($time_id, $class_id)
	{
		if (Atomclass::model()->classtimeOccupied($class_id, $time_id))
		{
			Yii::app()->user->setFlash('error',
				"不好意思，这门课在该时段已经有安排了哦!");
			$this->redirect(array(
				'selectView',
				'class_id'=>$class_id,
			));
		}
		$this->redirect(array('classlocation/selectView',
			'class_id'=>$class_id,
			'time_id'=>$time_id
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

		if(isset($_POST['Classtime']))
		{
			$model->attributes=$_POST['Classtime'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->TIMEID));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Classtime');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Classtime('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Classtime']))
			$model->attributes=$_GET['Classtime'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Classtime::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='classtime-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
