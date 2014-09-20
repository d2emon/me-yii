<div class="box info">
    <h2>Logged Off</h2>
    <div class="text">
        <h3>Merchant <?= Yii::app()->user->old_name; ?> has successfully logged off.</h3>
        <p>You may <?= CHtml::link('log back in', ['user/login']); ?> at any time.</p>
    </div>
</div>