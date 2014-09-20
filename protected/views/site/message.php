<?php
/* @var $this SiteController */
/* @var $error array */
?>

<div class="box <?= $boxClass; ?>">
    <h2><?= $title; ?></h2>
    <div class="text">
        <?= CHtml::encode($message); ?>
    </div>
</div>