<?php

/*
 * user_id      '$u_id',
 * username      '$username',
 * password     '$password',
 *              'admin',            permission
 * is_validated 0,
 * email        '$email',
 *              'Newbie',           rank
 * validation   '$validation_code',
 * is_banned    0,
 *              0,                  user_ip
 *              0                   email_sent
 *                                  post_trade_screen
 *                                  ignore_newbie
 */

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
            ['username',     'required',          ],
            ['username',     'length', 'max'=>8   ],
            ['email',        'length', 'max'=>128 ],

            ['password', 'required',            'on'=>'register'],
            ['password', 'length',   'max'=>32, 'on'=>'register'],

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['user_id, username, email', 'safe', 'on'=>'search'],

            ['validation',   'unsafe'],
            ['is_validated', 'unsafe'],
            ['is_banned',    'unsafe'],
        ];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return [

        ];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
            'user_id'  => 'User',
            'username' => 'Username',
            'password' => 'Password',
            'email'    => 'Email',
        ];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave()
    {
        if($this->scenario=='register')
        {
            $this->password     = CPasswordHelper::hashPassword($this->password);
            $this->validation   = $this->getNewValidationCode();
            $this->is_validated = false;
            $this->is_banned    = false;
        }
        return true;
    }

    public function afterSave()
    {
        if($this->scenario=='register')
        {
            $email = new YiiMailMessage();
            $email->subject = "New Merchant Empires User";
            $email->from    = Yii::app()->params['adminEmail'];
            $email->view    = 'registration';
            $email->setBody(['validation'=>$this->validation], 'text/html');
            $email->addTo($this->email);
            Yii::app()->mail->send($email);
        }
        return true;
    }

    private function getNewValidationCode()
    {
        return substr(md5(uniqid($this->username, true)), 0, 6).'-'.$this->username;
    }
}
