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
				'actions'=>array('index', 'view', 'search'),
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
		$model=Course::model()->find('COURSE_CODE=? and YEAR=? and SEMESTER=?',
			$code, $year, $semester);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
