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
				'actions'=>array('view', 'search', 'tip'),
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

    public function actionTip()
    {
        if (!isset($_POST['ajax'])) {
			// Do nothing
		} else {
		    $name = $_POST['name'];
		    $resultNum = 5;
		    $courses = array();
		    $courseResult = array();
		    $courses = Course::model()->findAll("LOCATE($name, COURSE_NAME)>0 LIMIT $resultNum");
		    foreach ($courses as $course) {
				array_push($coursesResult, array(
					'coursename'=>$course->COURSE_NAME));
			}
			echo CJSON::encode(array(
				'courses' => $name,
				));
		}
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

	public function actionCreate()
	{
		$model=new Course;

		$this->performAjaxValidation($model);

		if(isset($_POST['Course']))
		{
			$model->attributes=$_POST['Course'];
			if($model->save())
				$this->redirect(array('view',
					'course_code'=>$model->COURSE_CODE,
					'year'=>$model->YEAR,
					'semester'=>$model->SEMESTER));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($course_code, $year, $semester)
	{
		$model=$this->loadModel($course_code, $year, $semester);

		if (isset($_POST['Course']))
		{
			$model->attributes=$_POST['Course'];
			if ($model->save()) {
				$this->redirect(array('view',
					'course_code'=>$course_code,
					'year'=>$year,
					'semester'=>$semester,
				));
			}
		}
		$classes=$model->getClasses();

		$this->render('update', array(
			'model'=>$model,
			'classes'=>$classes,
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

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='aclass-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
