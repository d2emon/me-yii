<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';

$this->renderPartial('_error', [
    'title'=>'Error '.$code,
    'message'=>CHtml::encode($message),
])
?>