<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Login';
?>

<div class="side">
    <div class="box info">
        <h2>Create a New User</h2>
        <div class="text">
            <p>If you are new to Merchant Empires you may create a user and join the fun.</p>
            <p><?= CHtml::link('Create User', ['user/create']); ?>&nbsp;&nbsp;
                <?= CHtml::link('Validate User', ['user/validate']); ?></p>
        </div>
    </div>

    <div class="box info">
        <h2>Log in</h2>
        <div class="text">
            <div class="form">
                <? $form = $this->beginWidget('CActiveForm', [
                    'id'          => 'login-form',
                    'htmlOptions' => [
                        'class' => 'form-horizontal',
                    ],
                ]); ?>

                <div class="control-group">
                    <?= $form->label($model,     'username'); ?>
                    <?= $form->textField($model, 'username', ['value' => '']); ?>
                </div>

                <div class="control-group">
                    <?= $form->label($model,         'password'); ?>
                    <?= $form->passwordField($model, 'password', ['value' => '']); ?>
                </div>

                <div class="row submit">
                    <?php echo CHtml::submitButton('Login'); ?>
                </div>

                <? $this->endWidget(); ?>

            </div>
            <!-- form -->
        </div>
    </div>
</div>

