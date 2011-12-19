<?php

class AtomclassController extends Controller
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
			array('allow',
				'actions'=>array('admin', 'delete', 'update'),
				'roles'=>array('admin')
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
			$model = $this->loadModel($id);
			$class_id = $model->CID;

			// we only allow deletion via POST request
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin', 'class_id'=>$class_id));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($class_id)
	{
		$model=new Atomclass('search');
		$model->unsetAttributes();  // clear any default values
		$model->CID=$class_id;
		$time=new Classtime;

		if(isset($_GET['Classtime']))
		{
			// Here's a choice: remember to use array_filter or spend hours on debug
			$array = array_filter($_GET['Classtime']);
			$model->possible_classtimes =
				Classtime::model()->findAllByAttributes($array);
		}
		
		if(isset($_GET['Atomclass']))
			$model->attributes=$_GET['Atomclass'];

		$this->render('admin',array(
			'model'=>$model,
			'time'=>$time,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if (isset($_POST['Atomclass']))
		{
			$model->attributes=$_POST['Atomclass'];
			if ($model->save())
				$this->redirect(array('admin', 'class_id'=>$model->CID));
		}

		$this->render('update', array(
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
		$model=Atomclass::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='atomclass-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
