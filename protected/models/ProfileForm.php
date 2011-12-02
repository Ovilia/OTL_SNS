<?php

class ProfileForm extends CFormModel
{
	public $username;
	public $email;
	public $old_password;
	public $new_password;
	public $new_password_repeat;
	public $isAdmin;
	public $register_time;
	public $rememberMe;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required'),
            array('username', 'length', 'max'=>32),
            array('old_password, new_password, new_password_repeat', 'length', 'max'=>64),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'user name',
            'old_password'=>'old password',
            'new_password'=>'new password',
            'new_password_repeat'=>'new password repeat',
            'isAdmin'=>'is admin?',
			'rememberMe'=>'Remember me next time',
		);
	}
}
