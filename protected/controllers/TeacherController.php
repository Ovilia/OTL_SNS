<?php

class TeacherController extends Controller
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
				'actions'=>array('selectView','list','create','choose','admin','update'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionSelectView($class_id)
	{
		$model=new Teacher;
		$this->render('selectView', array(
			'model'=>$model,
			'class_id'=>$class_id
		));
	}

	public function actionCreate($class_id)
	{
		$model=new Teacher;

		if(isset($_POST['Teacher']))
		{
			$model->attributes=$_POST['Teacher'];
			if($model->save())
			{
				$this->redirect(array('choose',
					'teacher_id'=>$model->TID,
					'class_id'=>$class_id,
				));
			}
		}

		$this->renderPartial('_form',array(
			'model'=>$model,
			'class_id'=>$class_id,
		));
	}

	public function actionList($class_id)
	{
		$model=new Teacher;
		$this->renderPartial('_list', array(
			'model'=>$model,
			'class_id'=>$class_id,
		));
	}

	public function actionChoose($class_id, $teacher_id)
	{
		$teaches=new Teaches;
		$teaches->CID=$class_id;
		$teaches->TID=$teacher_id;

		// If the teacher is already teaching this class.
		if (Teaches::model()->teacherTeachingAlready($teaches))
		{
			Yii::app()->user->setFlash('error',
				"这位老师已经在教这门课了，你不会是穿越来的吧？"
			);
			$this->redirect(array(
				'selectView',
				'class_id'=>$class_id,
			));
		}

		// Everything is fine, just save it.
		if ($teaches->save())
		{
			$this->redirect(array(
				'class/update',
				'id'=>$class_id,
			));
		}

		// This should never happen.
		Yii::app()->user->setFlash('error',
			"出错了！请联系OTL团队！"
		);
		$this->redirect(array(
			'selectView',
			'class_id'=>$class_id,
		));
	}

	public function actionAdmin($class_id)
	{
		$model=new Teacher('search');
		$model->unsetAttributes();

		$model->possible_TIDs = array();
		$class=AClass::model()->findByPk($class_id);
		foreach ($class->teachers as $teacher)
		{
			array_push($model->possible_TIDs, $teacher->TID);
		}
		if (isset($_GET['Teacher']))
			$model->attributes=$_GET['Teacher'];

		$this->render('admin',array(
			'model'=>$model,
			'class_id'=>$class_id,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Teacher::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='teacher-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
