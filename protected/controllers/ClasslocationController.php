<?php

class ClasslocationController extends Controller
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
				'actions'=>array('selectView', 'list', 'create', 'choose'),
				'roles'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionSelectView($class_id, $time_id)
	{
		$model=new Classlocation;
		$this->render('selectView', array(
			'model'=>$model,
			'class_id'=>$class_id,
			'time_id'=>$time_id
		));
	}

	public function actionList($class_id, $time_id)
	{
		$model=new Classlocation;
		$this->renderPartial('_list', array(
			'model'=>$model,
			'class_id'=>$class_id,
			'time_id'=>$time_id
		));
	}

	public function actionCreate($class_id, $time_id)
	{
		$model=new Classlocation;

		if (isset($_POST['Classlocation']))
		{
			$model->attributes=$_POST['Classlocation'];
			if ($model->save())
			{
				$this->redirect(array(
					'choose',
					'class_id'=>$class_id,
					'time_id'=>$time_id,
					'building'=>$model->BUILDING_NUMBER,
					'classroom'=>$model->CLASSROOM,
				));
			}
		}

		$this->renderPartial('_form', array(
			'model'=>$model,
			'class_id'=>$class_id,
			'time_id'=>$time_id
		));
	}

	public function actionChoose($class_id, $time_id, $building, $classroom)
	{
		$atomclass = new Atomclass;
		$atomclass->CID = $class_id;
		$atomclass->TIMEID = $time_id;
		$atomclass->BUILDING_NUMBER = $building;
		$atomclass->CLASSROOM = $classroom;
		
		// If the atomclass ready exists.
		if (Atomclass::model()->atomclassDuplicate($class_id, $time_id, $building, $classroom))
		{
			Yii::app()->user->setFlash('error',
				"这门课已经安排在这里了，你不会是穿越来的吧？");
			$this->redirect(array(
				'selectView',
				'class_id'=>$class_id,
				'time_id'=>$time_id,
			));
		}

		// If the class already has an atomclass in the given time.
		if (Atomclass::model()->classtimeOccupied($class_id, $time_id))
		{
			Yii::app()->user->setFlash('error',
				"不好意思，这门课在该时段已经有安排了哦!");
			$this->redirect(array(
				'selectView',
				'class_id'=>$class_id,
				'time_id'=>$time_id,
			));
		}

		// If there is already a class taking this classroom in the given time.
		if (Atomclass::model()->classlocationOccupied($time_id, $building, $classroom))
		{
			Yii::app()->user->setFlash('error',
				"不好意思，这个教室在该时段已经被占用了哦!");
			$this->redirect(array(
				'selectView',
				'class_id'=>$class_id,
				'time_id'=>$time_id,
			));
		}

		// TODO: if the two time instances are not the same but have overlap.

		// Everything is fine, just save it.
		if ($atomclass->save())
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
}

?>
