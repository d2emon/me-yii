<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ValidateForm extends CFormModel
{
	public $code;
    public $error_code;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
            ['code', 'required'    ],
            ['code', 'authenticate'],
        ];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
            'code' => 'Code',
        ];
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute, $params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity = new ValidationIdentity($this->code);
            $this->_identity->authenticate();

            $this->error_code = $this->_identity->errorCode;

            if($this->error_code === ValidationIdentity::ERROR_NONE)
            {
                $duration = 3600*24*30; // 30 days
                Yii::app()->user->login($this->_identity, $duration);
            }
            else
            {
                throw new CHttpException(403, $this->_identity->errorMessage);
            }
		}
	}
}
