<?php

class MessageController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','view', 'inbox', 'sentbox'),
				'roles'=>array('authenticated'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);

		// A user can only view a message he/she sent or received
		$params = array("sender_id" => $model->UID,
				"receiver_id" => $model->USE_UID);
		if (!Yii::app()->user->checkAccess('viewMsgs', $params)) {
			Yii::app()->user->setFlash('error',
				"抱歉，那条消息不是你的哦！");
			$this->redirect(array('inbox'));
		}

		// Handle the message's ISREAD column
		if (Yii::app()->user->id == $model->USE_UID)
			$model->beRead();

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @param $id means the receiver's UID, NULL if not decided yet.
	 */
	public function actionCreate($id=NULL)
	{
		$model=new Message;

		$this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];

			// in case someone hack the post form 
			if($model->UID != Yii::app()->user->id)
				$this->redirect(array('inbox'));

			// save and show
			if($model->save())
				$this->redirect(array('view','id'=>$model->MID));
		}

		// the message UID should be the current authenticated user UID
		$model->UID = Yii::app()->user->id;

		if (isset($id))
			$model->USE_UID = $id;

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all messages received.
	 */
	public function actionInbox()
	{
		$id = Yii::app()->user->id;
		$dataProvider=new CActiveDataProvider('Message', array(
			'criteria'=>array(
				'condition'=>"USE_UID=$id",
				'order'=>'SEND_TIME DESC',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'name'=>'收件箱',
		));
	}

	/**
	 * Lists all messages sent.
	 */
	public function actionSentbox()
	{
		$id = Yii::app()->user->id;
		$dataProvider=new CActiveDataProvider('Message', array(
			'criteria'=>array(
				'condition'=>"UID=$id",
				'order'=>'SEND_TIME DESC',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'name'=>'已发送',
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if($model===null)
			//throw new CHttpException(404,'The requested page does not exist.');
			$this->redirect(array('inbox'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
