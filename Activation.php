<?php

/**
 * Class for filter data from user activation
 */
class Activation extends CFormModel
{
	public $email;
	public $activekey;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('email, activekey', 'required'),
            array('email, activekey','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Mail',
            'activekey'=>'Key',
		);
	}
}
