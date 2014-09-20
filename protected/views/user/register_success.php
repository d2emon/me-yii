<?php
/* @var $this UserController */
?>

<div class="box info">
    <h2>Success</h2>
    <div class="text">
        <p>Your Merchant Empires user was successfully created.</p>
        <p>An email containing a validation code has been sent to your address. In order to log into Merchant Empires,
            you must retrieve that code and enter it at the validation <?= CHtml::link('page', ['user/validate']); ?></p>
    </div>
</div>