<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?
/*
<script>
bar = new Array();function change(imagename, event) {document [imagename].src = bar[imagename + "-" + event].src;return;}
function load(prefix, imagename) {bar[imagename + "-off"] = new Image();bar[imagename + "-off"].src = prefix + imagename + "-off.png";bar[imagename + "-on"] = new Image();bar[imagename + "-on"].src = prefix + imagename + "-on.png";return;}
load("./images/mainmenu/", "currentsector");load("./images/mainmenu/", "localmap");load("./images/mainmenu/", "galaxymap");load("./images/mainmenu/", "merchants");load("./images/mainmenu/", "alliance");load("./images/mainmenu/", "planets");load("./images/mainmenu/", "news");load("./images/mainmenu/", "help");load("./images/mainmenu/", "selectgame");load("./images/mainmenu/", "logoff");load("./images/mainmenu/", "preferences");load("./images/mainmenu/", "view-messages");load("./images/mainmenu/", "send-messages");load("./images/mainmenu/", "current-players");load("./images/mainmenu/", "rankings");load("./images/mainmenu/", "starbase");
</script>
 */
?>
    <div id="content">
        <?
        if(Yii::app()->user->hasFlash('sys_msg'))
        {
            $this->renderPartial(Yii::app()->user->getFlash('sys_msg'), []);
        }
        ?>
	    <?php echo $content; ?>
    </div>
    <!-- content -->
<?php $this->endContent(); ?>