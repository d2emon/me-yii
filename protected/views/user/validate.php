<?php
/* @var $this UserController */
/* @var $model ValidateForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Validation';
?>

<div class="box info">
    <h2>Validate Your User</h2>
    <div class="text">
        <div class="form">
            <? $form = $this->beginWidget('CActiveForm', [
                'id'          => 'validation-form',
                'htmlOptions' => [
                    'class' => 'form-horizontal',
                ],
            ]); ?>

            <div class="control-group">
                <?= $form->label($model,     'code'); ?>
                <?= $form->textField($model, 'code', ['value' => '']); ?>
                <?= $form->error($model,     'code'); ?>
            </div>

            <div class="row submit">
                <?php echo CHtml::submitButton('Validate'); ?>
            </div>

            <? $this->endWidget(); ?>

        </div>
        <!-- form -->
    </div>
</div>
