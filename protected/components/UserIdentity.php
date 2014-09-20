<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_NOT_VALIDATED = 3;
    const ERROR_BANNED        = 4;

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
        $record = User::model()->findByAttributes(['username'=>$this->username]);
        if($record===null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif(!CPasswordHelper::verifyPassword($this->password, $record->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        elseif(!$record->is_validated)
        {
            $this->errorCode = self::ERROR_NOT_VALIDATED;
        }
        elseif($record->is_banned)
        {
            $this->errorCode = self::ERROR_BANNED;
        }
		else
        {
            $this->_id = $record->user_id;
            $this->setState('is_validated', $record->is_validated);
            $this->setState('is_banned',    $record->is_banned);
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
            return 'Incorrect username';
        }
        elseif($this->errorCode == self::ERROR_PASSWORD_INVALID)
        {
            return 'Incorrect password';
        }
        elseif($this->errorCode == self::ERROR_NOT_VALIDATED)
        {
            return 'User is not validated';
        }
        elseif($this->errorCode == self::ERROR_BANNED)
        {
            return 'User banned';
        }
    }
}
