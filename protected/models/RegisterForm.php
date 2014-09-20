<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * user register form data. It is used by the 'create' action of 'UserController'.
 */
class RegisterForm extends CFormModel
{
	public $username;
	public $password;
	public $verify;
    public $email;
    public $code;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
            ['username, password, verify, email, code', 'required' ],
            ['username', 'length',  'min'=>6, 'max'=>8   ],
            ['password', 'length',  'min'=>6, 'max'=>16  ],
            ['email',    'length',  'max'=>128 ],
            ['username', 'unique',  'className'=>'User'],
            ['verify',   'compare', 'compareAttribute'=>'password'],
            ['email',    'email'    ],
            ['email',    'unique',  'className'=>'User'],
            ['code',     'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'insert'],
        ];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
            'username' => 'Username',
            'password' => 'Password',
            'verify'   => 'Verify',
            'email'    => 'Email Address',
            'code'     => 'Verification code',
        ];
	}

    public function register()
    {
        if(!$this->validate())
            return false;

        $user = new User('register');
        $user->attributes = [
            'username' => $this->username,
            'password' => $this->password,
            'email'    => $this->email,
        ];
        return $user->save();
    }
}
