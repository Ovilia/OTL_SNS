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
	    echo "in";
		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['schedule']))
			{
				$schedules = CJSON::decode($_POST['schedule']);
				foreach ($schedules as $schedule)
				{
					$timetable=array();
					foreach ($schedule['classtime'] as $time)
					{
						$start_time=Classtime::model()->getStartTimeFromSjtuTime(
							$time['startTime']);
						$end_time=Classtime::model()->getEndTimeFromSjtuTime(
							$time['startTime']+$time['span'] - 1);
						$weekday=$time['weekday'];
						$classtime=Classtime::model()->find("START_TIME='$start_time' and
							END_TIME='$end_time' and DAY_OF_WEEK=$weekday");
						if (!($classtime===null))
						{
							array_push($timetable, $classtime->TIMEID);
						}
						else
						  echo "xxx";
					}

					// Note: this piece of code would not process the duplications of teachers'
					// name correctly.
					$teacher_name=$schedule['teacher'];
					$teacher=Teacher::model()->find("TEACHER_NAME='$teacher_name'");
					if ($teacher===null)
					   continue;
					$teacher_id=$teacher->TID;

					$course_code=$schedule['id'];
					$year=$schedule['year'];
					$semester=$schedule['semester'];

					$classes=AClass::model()->findAll("COURSE_CODE='$course_code' and
						YEAR=$year and SEMESTER=$semester");
				    echo "0";
					foreach ($classes as $class)
					{
					    echo $class->CID."<br>\n";
						$flag=false;
						foreach($class->teachers as $class_teacher)
						{
						    echo "jinle";
							if ($class_teacher->TID==$teacher_id)
							{
								$flag=true;
								break;
							}
							else
							     echo $class_teacher->TID;
						}
						
						if($flag)
						{
							$flag=false;
							foreach($class->atomclasses as $atomclass)
							{
								$flag=false;
								print_r($timetable);
								foreach($timetable as $time_id)
								{
								    
									if ($time_id==$atomclass->TIMEID)
									{
										$flag=true;
										break;
									}
								}
								if(!$flag)
								{
								    echo "time$atomclass->TIMEID\n";
									break;
								}
							}
						}
						else
						  echo "a";
						if($flag)
						{
							$takes=new Takes;
							$takes->UID=Yii::app()->user->id;
							$takes->CID=$class->CID;
							$takes->save();
							echo "success";
						}
						else
						  echo "wrong";
					}
				}
			}
		}
	}
}
?>
