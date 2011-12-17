<?php

class SiteController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	/**
	 * Specifies the access control rules.
	 */
	public function accessRules()
	{
		return array(
			array('allow', // the create action can only be executed by a local user
				'actions'=>array('createRoles'),
				'ips'=>array('127.0.0.1'),
			),
			// It's weired this piece of code would deny every one including localhost user.
			// TODO: Fix this.
			/*
			array('deny',  // all users not on localhost cannot perform create action
				'actions'=>array('createRoles'),
				'users'=>array('*'),
			),
			*/
			array('allow', // allow all users to perform all other actions
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/index.php'
		$this->layout = 'index';
		//$this->render('index');
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                // TODO: get real email from database
                //Yii::app()->session['email'] = 'zwl.sjtu@gmail.com';
                //Yii::app()->session['username'] = 'Ovilia';
				$this->redirect(Yii::app()->baseUrl."/index.php/user");
            }
		}
		// display the login form
		$this->render('index',array('model'=>$model));
	}

	/**
	 * This is the action to handle search operations in the site.
	 * It would render a normal search page if a un-ajax request is passed,
	 * or simply return an array of results if the request is an ajax one.
	 * $items should be passed with 'courses' or 'users' (or both) key(s) if
	 * search on this(these) model(s) is(are) required.
	 */
	public function actionSearch()
	{
		if (!isset($_POST['ajax'])) {
			//Render a search page?
		} else {
			$resultNum = 5;
			$name = $_POST['name'];
			$courses = array();
			$users = array();
			$coursesResult = array();
			$usersResult = array();

			$courses = Course::model()->findAll("LOCATE($name, COURSE_NAME)>0 LIMIT $resultNum");
			$users = User::model()->findAll("LOCATE($name, USER_NAME)>0 LIMIT $resultNum");

			foreach ($courses as $course) {
				array_push($coursesResult, array('code'=>$course->COURSE_CODE,
					'year'=>$course->YEAR,
					'semester'=>$course->SEMESTER,
					'coursename'=>$course->COURSE_NAME));
			}
			foreach ($users as $user) {
				array_push($usersResult, array('uid'=>$user->UID,
					'username'=>$user->USER_NAME));
			}

			echo CJSON::encode(array(
				'courses' => $coursesResult,
				'users' => $usersResult,
				));
		}
	} 
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/index.php'
		$this->layout = 'index';
		//$this->render('index');
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->baseUrl."/index.php/user");
		}
		// display the login form
		$this->render('index',array('model'=>$model));
	}

    public function getRandString($length)
    {
        $characters = "abcdefghijklmnopqrstuvwxyz0123456789";
        $char_length = strlen($characters);
        $result = "";
        for ($i = 0; $i < $length; ++$i){
            $result .= $characters[mt_rand(0, $char_length - 1)];
        }
        return $result;
    }
    
    public function actionRegister()
    {
        $regForm=new RegisterForm;
	
		if(isset($_POST['RegisterForm']))
		{
		    $user = new User;
			$regForm->attributes=$_POST['RegisterForm'];
			$user->USER_NAME = $regForm->username;
			$user->EMAIL = $regForm->email;
			$password = $this->getRandString(8);
            $user->PASSWORD = md5($password);
			$user->ISADMIN = "0";
			
            $message = '<div style="font-size: 20px;">OTL SNS 注册用户初始密码</div><br>您刚刚注册了新用户，请使用以下密码登录，并尽快修改默认生成的密码。感谢您对OTL SNS的支持！<div style="color:red">您的初始密码：';
            $message .= $password;
            $message .= '</div><br>请勿直接回复此邮件，联系我们：<br>hnkfliyao@gmail.com<br>tecton69@gmail.com<br>zwl.sjtu@gmail.com<br>';
    
            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
            $mailer->Host = 'localhost';
            $mailer->IsSMTP();
            $mailer->IsHTML(true);
            $mailer->From = 'admin@otl.com';
            $mailer->AddAddress($email);
            $mailer->FromName = 'OTL SNS';
            $mailer->CharSet = 'UTF-8';
            $mailer->Subject = Yii::t('demo', 'OTL SNS 注册用户初始密码');
            $mailer->Body = $message;
            if (!$mailer->Send()){
                throw new CHttpException(400, 'Error in sending email.');
            }
			if($user->save())
				$this->redirect(Yii::app()->baseUrl);
			else
			    throw new CHttpException(400, 'Error in register');
		}

		$this->render('register',array(
			'model'=>$regForm,
		));
    }
    
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * The function to create roles of this application.
	 * It should be run one and only one time.
	 * Make sure you delete or comment this function before you get this
	 * application public.
	 */
	public function actionCreateRoles()
	{
		$auth = Yii::app()->authManager;

		// Uncomment the following piece of code if you haven't execute it.
		
		// Guests are those who have not been logged in yet.
		$bizRule = null;
		$role = $auth->createRole('guest', 'guest user', $bizRule);

		// Authenticated users are those normal users who have successfully logged in.
		$bizRule = null;
		$role = $auth->createRole('authenticated', 'authenticated user', $bizRule);
		$role->addChild('guest'); // an authenticated user can do whatever a guest can do

		// An authenticated user can only update a profile of his/herself.
		$bizRule = 'return Yii::app()->user->id==$params["user_id"];';
		$task = $auth->createTask('updateOwnProfile', 'update the profile of oneself', $bizRule);
		$role->addChild('updateOwnProfile');

		// Admins are those who can manage the website.
		$bizRule = null;
		$role = $auth->createRole('admin', 'administrator', $bizRule);
		$role->addChild('authenticated'); // an admin can do whatever an authenticated user can do

		// Admins can update the profile of anyone.
		$opt  = $auth->createOperation('updateProfile', 'update the profile of a user');
		$task->addChild('updateProfile');
		$role->addChild('updateProfile');
		

		// A message can only be viewed by the sender or receiver.
		$bizRule = 'return Yii::app()->user->id==$params["sender_id"];';
		$auth->createTask('viewSentMsgs', 'check messages sent by oneself', $bizRule);
		$auth->addItemChild('authenticated', 'viewSentMsgs');
		$bizRule = 'return Yii::app()->user->id==$params["receiver_id"];';
		$auth->createTask('viewReceivedMsgs', 'check messages received', $bizRule);
		$auth->addItemChild('authenticated', 'viewReceivedMsgs');
		$auth->createOperation('viewMsgs', 'check messages');
		$auth->addItemChild('viewSentMsgs', 'viewMsgs');
		$auth->addItemChild('viewReceivedMsgs', 'viewMsgs');

		echo "success!";
	}
}
