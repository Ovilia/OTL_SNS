<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->find("EMAIL=?", array($this->username));
		if($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->UID;
			
			$auth = Yii::app()->authManager;
			if ($user->ISADMIN == "Y") {
				$role = 'admin';
			} else {
				$role = 'authenticated';
			}
			if (!$auth->isAssigned($role, $user->UID)) {
				if ($auth->assign($role, $user->UID)) {
					Yii::app()->authManager->save();
				}
			}
			// store information in session
			Yii::app()->session['email'] = $user->EMAIL;
            Yii::app()->session['username'] = $user->USER_NAME;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}
