<?php

class UserController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return [
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return [
            /*
            [
                'allow',
                'actions' => ['create', 'captcha', 'login', 'validate'],
                'users'   => ['*'],
            ],
            [
                'allow',
                'actions' => ['view', 'preferences', 'logout'],
                'users'   => ['@'],
            ],
            [
                'allow',
                'actions' => ['admin', 'delete'],
                'users'   => ['admin'],
            ],
            [
                'deny',
                'users' => ['*'],
            ],
            */
        ];
	}

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return [
            'captcha'=>[
                'class'     =>'CCaptchaAction',
                'backColor' => 0x000000,
                'maxLength' => 6,
                'minLength' => 3,
                'foreColor' => 0x666699,
                'testLimit' => 2,
            ],
        ];
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    /*public function actionCreate()
    {
        $this->pageTitle = "New User";

        $model = new RegisterForm('insert');
        $this->performAjaxValidation($model);
        if(isset($_POST['RegisterForm']))
        {
            $model->attributes = $_POST['RegisterForm'];
            if($model->register())
            {
                $identity = new UserIdentity($model->username, $model->password);
                if($identity->authenticate())
                {
                    Yii::app()->user->login($identity);
                    $this->render('register_success');
                    return;
                }
                else
                {
                    throw new CHttpException(403, $identity->errorMessage);
                }
            }
        }

        $this->render('create',[
            'model'=>$model,
        ]);
    }*/

    /*public function actionValidate()
    {
        $this->pageTitle = "New User";

        $model = new ValidateForm;
        if(isset($_POST['ValidateForm']))
        {
            $model->attributes = $_POST['ValidateForm'];
            if($model->validate())
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->render('validate',[
            'model' => $model,
        ]);

    }*/

    /**
     * Displays the login page
     */
    /*public function actionLogin()
    {
        $this->pageTitle = "Login";
        $this->randomBack();

        $model = new LoginForm;
        if(isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
            if($model->errorView)
                Yii::app()->user->setFlash('sys_msg', $model->errorView);
        }

        $this->render('login',[
            'model' => $model,
        ]);
    }*/

    /**
     * Logs out the current user and redirect to homepage.
     */
    /*public function actionLogout()
    {
        Yii::app()->user->setFlash('old_name', Yii::app()->user->name);
        Yii::app()->user->logout();
        Yii::app()->user->setFlash('sys_msg', '//popups/_info_logout');
        $this->redirect(Yii::app()->homeUrl);
    }*/

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionPreferences()
    {
        $this->pageTitle = "Preferences";
        $this->layout    = "//layouts/menu";

        // sess->register("player_dead")
        // sess->register("user_ignore_newbie")

        // include("./lib/player_config.php")

        // player_config = new ME_Player_config
        // player_config->get_player_config($player_id)

        // if player dead, send to post-death screen
        /*
        if ($player_dead)
        {
            $this->redirect('death');
        }
        */

        $model = $this->loadUser(Yii::app()->user->id);

        $this->performAjaxValidation($model);

        if(isset($_POST['PasswordForm']))
        {
            $model->setScenario('changePassword');
            $model->attributes = $_POST['PasswordForm'];
            $model->save();
        }

        if(isset($_POST['EmailForm']))
        {
            $model->setScenario('changeEmail');
            $model->attributes = $_POST['EmailForm'];
            $model->save();
        }

        if(isset($_POST['Player']))
        {
            //$model->attributes=$_POST['User'];
            /*
            post_trade_screen
            ignore_newbie
            group_combat_forces
            group_combat_planets
            group_combat_ships
            map_size
            */
            $model->save();
        }

        $this->render('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new User('search');
        $model->unsetAttributes();
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('admin', [
            'model'=>$model,
        ]);
    }

    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id = 0)
	{
        if(!$id)
            $id = Yii::app()->user->id;

		$this->render('view', [
            'model' => $this->loadUser($id),
        ]);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadUser($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
	}

    /*
     * Controller utils
     */

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadUser($id)
	{
		$model = User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
            $model->setScenario('ajax');
            echo CActiveForm::validate($model);
            Yii::app()->end();
		}
	}
}
