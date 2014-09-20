<?php
/* @var $this SiteController */
?>

<div class="box error">
    <h2>Please Validate</h2>
    <div class="text">
        <p>Your user has not been validated.  Until you validate your user, you may not join the game of Merchant
            Empires.</p>
        <p>You may validate <?= CHtml::link('here', ['user/validate']); ?>.</p>
    </div>
</div>