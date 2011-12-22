<?php
class TakesController extends Controller
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
				'actions'=>array('add','cancel','import'),
				'roles'=>array('authenticated'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdd($class_id)
	{
		$model=new Takes;
		$model->UID=Yii::app()->user->id;
		$model->CID=$class_id;
		if($model->save())
		{
			if(!isset($_GET['ajax']))
			{
				$this->redirect(isset($_POST['returnUrl']) ?
						$_POST['returnUrl'] :
						array('class/view', 'id'=>$class_id));
			}
		}
		else
			throw new CHttpException(400,'Something wrong.');
	}

	public function actionCancel($class_id)
	{
		$model=Takes::model()->find("CID=$class_id and UID=" . Yii::app()->user->id);
		$model->delete();
		if (!isset($_GET['ajax']))
		{
			$this->redirect(isset($_POST['returnUrl']) ?
					$_POST['returnUrl'] :
					array('class/view', 'id'=>$class_id));
		}
	}

	/**
	 * Note: This action is implemented in very bad style and hasn't been tested yet.
	 * I don't even like this piece of code myself.
	 * Maybe I would modify it in some future.
	 */
	public function actionImport()
	{
		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['schedule']))
			{
				$schedules = $_POST['schedule'];
				foreach ($schedules as $schedule)
				{
					$timetable=array();
					foreach ($schedule['classtime'] as $time)
					{
						$start_time=Classtime::model()->getStartFromSjtuTime(
							$time['startTime']);
						$end_time=Classtime::model()->getEndFromSjtuTime(
							$time['startTime']+$time['span']);
						$weekday=$time['weekday'];
						$classtime=Classtime::model()->find("START_TIME=$start_time and
							END_TIME=$end_time and DAY_OF_WEEK=$weekday");
						if (!($classtime===null))
						{
							array_push($timetable, $classtime->TIMEID);
						}
					}

					// Note: this piece of code would not process the duplications of teachers'
					// name correctly.
					$teacher_name=$_POST['teacher'];
					$teacher=Teacher::model()->find("TEACHER_NAME=$teacher_name");
					$teacher_id=$teacher->TID;

					$course_code=$_POST['id'];
					$year=$_POST['year'];
					$semester=$_POST['semester'];

					$classes=AClass::model()->findAll("COURSE_CODE=$course_code and
						YEAR=$year and SEMESTER=$semester");
					foreach ($classes as $class)
					{
						$flag=false;
						foreach($class->teachers as $class_teacher)
						{
							if ($class_teacher->TID==$teacher_id)
							{
								$flag=true;
								break;
							}
						}
						if($flag)
						{
							$flag=false;
							foreach($class->atomclasses as $atomclass)
							{
								$flag=false;
								foreach($timetable as $time_id)
								{
									if ($time_id==$atomclass->TIMEID)
									{
										$flag=true;
										break;
									}
								}
								if(!$flag)
									break;
							}
						}
						if($flag)
						{
							$takes=new Takes;
							$takes->UID=Yii::app()->user->id;
							$takes->CID=$class->CID;
							$takes->save();
						}
					}
				}
			}
		}
	}
}
?>
