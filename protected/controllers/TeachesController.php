<?php

class TeachesController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('delete','admin','search'),
				'roles'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdmin($class_id)
	{
		$model=new Teaches('search');
		$model->unsetAttributes();
		$model->CID=$class_id;

		$teacher=new Teacher();

		$model->possible_teachers = array();
		$model->teachers_search_on = false;

		if(isset($_GET['Teacher']))
		{
			$array=array_filter($_GET['Teacher']);
			if(isset($array['TEACHER_NAME']))
			{
				$name=$array['TEACHER_NAME'];
				$model->possible_teachers = Teacher::model()->findAll(
					"LOCATE('$name', TEACHER_NAME)>0");
				$model->teachers_search_on = true;
			}
		}

		if(isset($_GET['Teaches']))
			$model->attributes=$_GET['Teaches'];

		$this->render('admin',array(
			'model'=>$model,
			'teacher'=>$teacher,
		));
	}

	public function actionDelete($class_id, $teacher_id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			$model=$this->loadModel($class_id, $teacher_id);
			$model->delete();

			if (!isset($_GET['ajax']))
			{
				$this->redirect(isset($_POST['returnUrl']) ?
					$_POST['returnUrl'] :
					array(
						'teacher/selectView',
						'class_id'=>$class_id,
						'teacher_id'=>$teacher_id,
					)
				);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function loadModel($class_id, $teacher_id)
	{
		$model=Teaches::model()->find("CID=$class_id and TID=$teacher_id");
		if($model===null)
			throw new CHttpException(404,'The requested page does not exists.');
		return $model;
	}
}
