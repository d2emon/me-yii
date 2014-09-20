<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ValidationIdentity extends UserIdentity
{
    const ERROR_VALIDATED = 5;

    private $_id;
    private $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

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
        $record = User::model()->findByAttributes(['validation'=>$this->code]);
        if($record===null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif($record->is_validated)
        {
            $this->errorCode = self::ERROR_VALIDATED;
        }
        elseif($record->is_banned)
        {
            $this->errorCode = self::ERROR_BANNED;
        }
		else
        {
            $record->is_validated = true;
            $record->save();

            $this->_id = $record->user_id;
            // $this->setState('is_validated', $record->is_validated);
            // $this->setState('is_banned',    $record->is_banned);
            $this->errorCode = self::ERROR_NONE;
        }
        $this->errorMessage = $this->getErrorMessage();
        return !$this->errorCode;
	}

    public function getId()
    {
        return $this->_id;
    }

    public function getErrorMessage()
    {
        if($this->errorCode == self::ERROR_NONE)
        {
            return '';
        }
        elseif($this->errorCode == self::ERROR_USERNAME_INVALID)
        {
            return 'Incorrect code';
        }
        elseif($this->errorCode == self::ERROR_BANNED)
        {
            return 'User banned';
        }
        elseif($this->errorCode == self::ERROR_VALIDATED)
        {
            return 'User is already validated';
        }
    }
}
