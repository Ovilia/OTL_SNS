<?php

class StatusController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view'),
				'roles'=>array('*'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update','comment','publish'),
				'roles'=>array('authenticated'),
				),
			array('allow', 
				'actions'=>array('admin','delete'),
				'roles'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Status'),
		));
	}

    /**
	 * Comment on a status.
	 */
	public function actionComment()
	{
	    if (!isset($_POST['ajax'])) {
			// Do nothing
		} else {
		    $sid = $_POST['sid'];
		    $content = $_POST['content'];
		    $uid = Yii::app()->user->id;
    		$model= new Comments;
    		$model->UID = $uid;
    		$model->SID = $sid;
    		$model->CONTENT = $content;
    		if ($model->save())
    		  echo 1;
		}
	}
    
    public function actionPublish() {
        if (isset($_GET['contents'])) {
			$contents = $_GET['contents'];
			//$cid = $_GET['cid'];
			//if (strstr
            $uid = Yii::app()->user->id;
            $model = new Status;
            $model->UID = $uid;
            $model->CONTENT = $contents;
			if ($model->save()) {
			     $this->redirect(array('user/view', 'id' => $uid));
			}
		}
		else {
		    $this->redirect(array('user/view', 'id' => $uid));
            return 1;
        }
    }
    
	public function actionCreate() {
		$model = new Status;


		if (isset($_POST['Status'])) {
			$model->setAttributes($_POST['Status']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('user/view', 'id' => $uid));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Status');


		if (isset($_POST['Status'])) {
			$model->setAttributes($_POST['Status']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->SID));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Status')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Status');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Status('search');
		$model->unsetAttributes();

		if (isset($_GET['Status']))
			$model->setAttributes($_GET['Status']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}