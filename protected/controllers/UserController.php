<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/home';

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
			array('allow',  // allow guests to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'roles'=>array('guest'),
			),
			array('allow', // allow authenticated user to perform 'create', 'update' and other actions
				'actions'=>array('create','update','feed','unfeed','search','updateProfile','takes','common','getCommon'),
				'roles'=>array('authenticated'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('admin'),
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
		$dataProvider=new CActiveDataProvider('Status', array(
			'criteria'=>array(
				'condition'=>"UID=$id",
				'order'=>'UPDATE_TIME DESC',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
        $fedDataProvider=new CActiveDataProvider('Feeds', array(
            'criteria'=>array(
                'condition'=>"FED_ID=$id",
                'order'=>'FEED_TIME DESC',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $feedDataProvider=new CActiveDataProvider('Feeds', array(
            'criteria'=>array(
                'condition'=>"FEEDER_ID=$id",
                'order'=>'FEED_TIME DESC',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $classmateProvider=new CActiveDataProvider('Takes', array(
            'criteria'=>array(
                'condition'=>"CID in (select CID from takes where UID = $id) and UID != $id",
                'group'=>'UID',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $fedUser = $fedDataProvider->getData();
        $feedUser = $feedDataProvider->getData();
        $classmate = $classmateProvider->getData();
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'dataProvider'=>$dataProvider,
            'feedUser'=>$feedUser,
			'fedUser'=>$fedUser,
            'classmate'=>$classmate,
		));

	}

    public function actionGetCommon()
    {
        if (isset($_POST['ajax'])){
            $UID = split(",", $_POST['uid']);
            $UID_amt = count($UID);
            $classtime = array();
            if ($UID[0] != null){
                for ($i = 0; $i < $UID_amt; ++$i){
                    // class time of others
                    $classtime[] = Classtime::model()->findAll("TIMEID in (select TIMEID from Atomclass where CID in (select CID from Takes where UID = $UID[$i]) and CID in (select CID from Class where year = " . Yii::app()->params['year'] . ")) and WEEK_OF_SEMESTER = " . Yii::app()->params['week_of_semester']);
                }
            }
            // class time of yourself
            $classtime[] = Classtime::model()->findAll("TIMEID in (select TIMEID from Atomclass where CID in (select CID from Takes where UID = " . Yii::app()->user->id . ") and CID in (select CID from Class where year = " . Yii::app()->params['year'] . ")) and WEEK_OF_SEMESTER = " . Yii::app()->params['week_of_semester']);
            echo CJSON::encode(array(
                'common'=>array($classtime),
            ));
        }
    }

    public function actionCommon()
    {
        $this->layout='//layouts/column1';
        $id = Yii::app()->user->id;
        $fedDataProvider=new CActiveDataProvider('Feeds', array(
            'criteria'=>array(
                'condition'=>"FED_ID=$id",
                'order'=>'FEED_TIME DESC',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $feedDataProvider=new CActiveDataProvider('Feeds', array(
            'criteria'=>array(
                'condition'=>"FEEDER_ID=$id",
                'order'=>'FEED_TIME DESC',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $feedUser = $feedDataProvider->getData();
        $fedUser = $fedDataProvider->getData();
        $this->render('common',array(
            'feedUser'=>$feedUser,
            'fedUser'=>$fedUser,
        ));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->UID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	    $this->layout = "//layouts/column1";
		$model=$this->loadModel($id);

		// Check if the user is authorized to update this profile.
		$params = array("user_id"=>$id);
		if (!Yii::app()->user->checkAccess('updateProfile', $params)) {
			Yii::app()->user->setFlash('error',
				"抱歉，你无权修改$model->USER_NAME 的个人资料！");
			$this->redirect(array('view', 'id'=>$params["user_id"]));
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->UID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//$dataProvider=new CActiveDataProvider('User');
		$id = Yii::app()->user->id;
		$dataProvider=new CActiveDataProvider('Status', array(
			'criteria'=>array(
				'condition'=>"UID = $id OR UID in (SELECT FEEDER_ID FROM FEEDS WHERE FED_ID = $id)",
				'order'=>'UPDATE_TIME DESC',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
        $fedDataProvider=new CActiveDataProvider('Feeds', array(
            'criteria'=>array(
                'condition'=>"FED_ID=$id",
                'order'=>'FEED_TIME DESC',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $feedDataProvider=new CActiveDataProvider('Feeds', array(
            'criteria'=>array(
                'condition'=>"FEEDER_ID=$id",
                'order'=>'FEED_TIME DESC',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $classmateProvider=new CActiveDataProvider('Takes', array(
            'criteria'=>array(
                'condition'=>"CID in (select CID from takes where UID = $id) and UID != $id",
                'group'=>'UID',
             ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $fedUser = $fedDataProvider->getData();
        $feedUser = $feedDataProvider->getData();
        $classmate = $classmateProvider->getData();
		$this->render('index',array(
			'model'=>$this->loadModel(Yii::app()->user->id),
			'dataProvider'=>$dataProvider,
            'feedUser'=>$feedUser,
			'fedUser'=>$fedUser,
            'classmate'=>$classmate,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    $this->layout = "//layouts/column1";
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	public function actionUpdateProfile($id)
	{
		$this->layout = "//layouts/column1";
		$model=$this->loadModel($id);

		// Check if the user is authorized to update this profile.
		$params = array("user_id"=>$id);
		if (!Yii::app()->user->checkAccess('updateProfile', $params)) {
			Yii::app()->user->setFlash('error',
				"抱歉，你无权修改$model->USER_NAME 的个人资料！");
			$this->redirect(array('view', 'id'=>Yii::app()->user->id));
		}

		$profile = new ProfileForm;
		$profile->username = $model->USER_NAME;
		$profile->email = $model->EMAIL;
		$profile->isAdmin = $model->ISADMIN;
		$profile->register_time = $model->REGISTER_TIME;
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['ProfileForm']))
		{
			$profile->attributes=$_POST['ProfileForm'];
			if($profile->old_password !== ""
			   && $profile->new_password !== ""
			   && $profile->new_password_repeat !== ""
			   && $profile->new_password === $profile->new_password_repeat)
			{
				if ($model->validatePassword($profile->old_password))
				{
                    $model->PASSWORD = md5($profile->new_password);
				}
			}
			if(isset($profile->username))
				$model->USER_NAME = $profile->username;
			if($model->save())
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}

		$this->render('updateProfile',array(
			'model'=>$profile,
		));
	}

	public function actionFeed($uid)
	{
		if(Yii::app()->request->isPostRequest
		   && $uid !== Yii::app()->user->id)
		{
			$feed = new Feeds;
			$feed->FED_ID = $uid;
			$feed->FEEDER_ID = Yii::app()->user->id;
			$feed->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view','id'=>$uid));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    public function actionUnfeed($uid)
    {
        if(Yii::app()->request->isPostRequest
                && $uid !== Yii::app()->user->id)
        {
            $this->loadFeedModel(Yii::app()->user->id, $uid)->delete();
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view','id'=>$uid));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionTakes($uid)
    {
        $this->layout='//layouts/column1';
        $heFeedsMe= Feeds::model()->find("FEEDER_ID = $uid AND FED_ID = " . Yii::app()->user->id);
        if ($heFeedsMe || $uid == Yii::app()->user->id){
            $dataProvider = new CActiveDataProvider('AClass', array(
                'criteria'=>array(
                    'condition'=>"CID in (select CID from Takes where UID=$uid)",
                ),
                'pagination'=>array(
                    'pageSize'=>20,
                ),
            ));
            $this->render('takes', array(
                'dataProvider'=>$dataProvider,
                'uid'=>$uid,
            ));
        }else{
            throw new CHttpException(400,'别想偷看别人上什么课程哦，私信ta，让ta喂你吧！');
        }
    }

	public function actionSearch()
	{
		$this->layout='//layouts/column2';
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('search',array(
			'model'=>$model,
		));
	}

    /** 
     * Returns takes model
     */
    public function loadTakeModel($uid)
    {
        $model=Takes::model()->findAll("UID=$uid");
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns feeds model
     */
    public function loadFeedModel($feeder_id, $fed_id)
    {
        $model=Feeds::model()->find("FEEDER_ID=$feeder_id AND FED_ID=$fed_id");
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
