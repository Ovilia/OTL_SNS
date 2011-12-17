<?php

class CourseController extends Controller
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
				'actions'=>array('view', 'search'),
				'roles'=>array('authenticated'),
			),
			array('allow',
				'actions'=>array('create', 'update', 'delete', 'admin'),
				'roles'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($course_code, $year, $semester)
	{
		$course=$this->loadModel($course_code, $year, $semester);
		$classes=$course->getClasses();
		$this->render('view', array(
			'course'=>$course,
			'classes'=>$classes,
		));
	}

	public function actionSearch()
	{
		$model=new Course('search');
		$model->unsetAttributes();
		if (isset($_GET['Course']))
			$model->attributes=$_GET['Course'];
		$this->render('search', array(
			'model'=>$model,
		));
	}

	public function loadModel($code, $year, $semester)
	{
		$model=Course::model()->find(
			"COURSE_CODE='$code' and YEAR=$year and SEMESTER=$semester");
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
