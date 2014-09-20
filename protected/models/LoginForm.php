<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
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
            ['username, password', 'required'    ],
            ['password',           'authenticate'],
        ];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
            'username'   => 'Username',
            'password'   => 'Password',
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
			$this->_identity = new UserIdentity($this->username, $this->password);
			if(!$this->_identity->authenticate())
            {
                $this->error_code = $this->_identity->errorCode;

                if($this->error_code !== UserIdentity::ERROR_NONE)
                    $this->addError($this->errorAttribute, $this->_identity->errorMessage);
            }
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode === UserIdentity::ERROR_NONE)
		{
			$duration = 3600*24*30; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
		else
			return false;
	}

    public function getErrorView()
    {
        if($this->error_code == UserIdentity::ERROR_USERNAME_INVALID)
        {
            return "//popups/_error_login";
        }
        elseif($this->error_code == UserIdentity::ERROR_PASSWORD_INVALID)
        {
            return "//popups/_error_login";
        }
        elseif($this->error_code == UserIdentity::ERROR_NOT_VALIDATED)
        {
            return "//popups/_error_invalid";
        }
        elseif($this->error_code == UserIdentity::ERROR_BANNED)
        {
            return "//popups/_error_banned";
        }
        else
        {
            return false;
        }

    }

    public function getErrorAttribute()
    {
        if($this->error_code == UserIdentity::ERROR_USERNAME_INVALID)
        {
            return 'username';
        }
        elseif($this->error_code == UserIdentity::ERROR_PASSWORD_INVALID)
        {
            return 'password';
        }
        elseif($this->error_code == UserIdentity::ERROR_NOT_VALIDATED)
        {
            return 'login';
        }
        elseif($this->error_code == UserIdentity::ERROR_BANNED)
        {
            return 'login';
        }
        else
        {
            return false;
        }
    }
}
