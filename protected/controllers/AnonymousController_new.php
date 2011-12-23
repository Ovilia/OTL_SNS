<?php
include("MailSenderFacade.php");

class AnonymousController extends Controller
{
    public $layout="//layouts/no_nav";
   	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow guests to perform 'resetPassword', 'sendPassword' actions
				'actions'=>array('resetPassword', 'sendPassword'),
				'roles'=>array('guest'),
			),
            array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionResetPassword()
	{
		$this->render('ResetPassword');
	}

    public function actionSendPassword($email)
    {
        $model = $this->loadModel($email);
        
        MailSenderFacade::sendMail($model);

        $this->render('SendPassword', array(
            'email'=>$email,
        ));
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

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param email address of the model to be loaded
     */
    public function loadModel($email)
    {
        $model=User::model()->findByAttributes(
                array('EMAIL'=>$email));
        if($model===null)
            throw new CHttpException(404,"$email 邮箱未经注册！");
        return $model;
    }

}
