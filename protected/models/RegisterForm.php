<?php

class RegisterForm extends CFormModel
{
	public $username;
	public $email;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, email', 'required'),
            array('username, email', 'length', 'max'=>32),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'用户名',
            'email'=>'邮箱（用于登陆）',
		);
	}
}
