<?php

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
			array('allow',  // allow guests to perform 'resetPassword' actions
				'actions'=>array('resetPassword'),
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
}
