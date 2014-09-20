<?php
/* @var $this Controller */

Yii::app()->sass
    ->register(Yii::getPathOfAlias('application.assets.scss').'/main.scss');

Yii::app()->clientScript
    ->registerCssFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.assets.css').'/main.css'))
    ->registerCssFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.assets.css').'/form.css'));

//include("./templates/script.js");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="keywords" content="merchant empires, games, strategy, trade wars, free, open source, play, galaxy, rpg, game, merchants, empire, war" />
	<title><?= CHtml::encode(Yii::app()->name); ?>: <?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="<?= $this->background; ?>">
	<header>
		<h1><?= CHtml::link(Yii::app()->name, '/'); ?></h1>

        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', [
                'links' => $this->breadcrumbs,
            ]); ?>
            <!-- breadcrumbs -->
        <?php endif?>

    </header>
    <!-- header -->

    <div id="wrapper">
        <?php echo $content; ?>
	</div>

	<div class="clear"></div>

	<footer>
		Copyright &copy; <?= date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?= Yii::powered(); ?>
	</footer>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
