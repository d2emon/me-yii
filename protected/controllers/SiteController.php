<?php

class SiteController extends Controller
{
    public $layout = '//layouts/menu';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return [
            'page'=>[
                'class'=>'CViewAction',
            ],
        ];
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        if(isset(Yii::app()->user->is_validated) && !Yii::app()->user->is_validated)
        {
            Yii::app()->user->logout();
            Yii::app()->user->setFlash('sys_msg', '//popups/_error_invalid');
        }
        elseif(isset(Yii::app()->user->is_banned) && Yii::app()->user->is_banned)
        {
            Yii::app()->user->logout();
            Yii::app()->user->setFlash('sys_msg', '//popups/_error_banned');
        }
        else
        {
            Yii::app()->user->setFlash('sys_msg', '//popups/_info_news');
        }

		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}