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
				'actions'=>array('add','cancel'),
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
}
?>
