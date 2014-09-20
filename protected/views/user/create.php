<?php
/* @var $this UserController */
/* @var $model User */

$this->pageTitle = "New User";
?>

<div class="box info">
    <h2>Create a New User</h2>
    <div class="text">
        <? $this->renderPartial('_form', ['model'=>$model]); ?>
    </div>
</div>