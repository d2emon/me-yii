<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<? $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id'                     => 'register-form',
    'type'                   => 'horizontal',
    'enableAjaxValidation'   => true,
    'clientOptions'        => [
        'validateOnChange' => true,
    ],
]); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

    <?= $form->textFieldRow($model,     'username', ['value' => '']); ?>
    <?= $form->passwordFieldRow($model, 'password', ['value' => '']); ?>
    <?= $form->passwordFieldRow($model, 'verify',   ['value' => '']); ?>
    <?= $form->textFieldRow($model,     'email',    ['value' => '']); ?>

    <? if(CCaptcha::checkRequirements()): ?>
    <div class="control-group">
        <div id="cap">
            <?= $form->labelEx($model,'code'); ?>
            <? $this->widget('CCaptcha', ['id' => 'cap-code']); ?>
        </div>
        <?= $form->textField($model,'code', ['value' => '']); ?>
        <?= $form->error($model,'code'); ?>
        <p class="hint">Please enter the letters as they are shown in the image above.<br />
            Letters are not case-sensitive.</p>
    </div>

    <? endif; ?>

    <? $this->widget('bootstrap.widgets.TbButton', [
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Submit',
    ]); ?>

    <div class="hint">
        <p>You are allowed to create only one user. Creating multiple users is considered cheating.
            Anyone found to have multiple users will be banned from the game.</p>
        <p>Creating a user and participating in the Merchants Empires universe for any other purpose
            aside from simply playing the game is not allowed.</p>
    </div>

    <? $this->endWidget(); ?>

</div>
<!-- form -->

<?
/*
Username:       <INPUT TYPE="textbox"  NAME="username"                     >
Password:       <INPUT TYPE="password" NAME="password" maxlength=32        >
Verify:         <INPUT TYPE="password" NAME="verify"   maxlength=32        >
Email Address:  <INPUT TYPE="textbox"  NAME="email"    maxlength=32 size=45>
		  	    <INPUT TYPE="submit"   NAME="create"   VALUE="Create"      >

 */
?>