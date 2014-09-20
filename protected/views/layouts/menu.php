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
    <aside>
        <time><?= date ("d.m.Y H:i:s"); ?></time>
        <div id="mainmenu">
            <?php $this->widget('zii.widgets.CMenu',[
                'id'    => 'user-menu',
                'items' => [
                    ['label' => 'Login',       'url' => ['/user/login'  ], 'visible' =>  Yii::app()->user->isGuest],
                    ['label' => 'Select game', 'url' => ['/game/select' ], 'visible' => !Yii::app()->user->isGuest],
                    ['label' => 'Logoff',      'url' => ['/user/logout' ], 'visible' => !Yii::app()->user->isGuest],
                ],
            ]); ?>
            <?php $this->widget('zii.widgets.CMenu',[
                'id'    => 'global-menu',
                'items' => [
                    ['label' => 'Help' ,       'url' => ['/site/page', 'view' => 'help']],
                    ['label' => 'Preferences', 'url' => ['/site/contact'                ],
                        'visible' => !Yii::app()->user->isGuest],
                ],
            ]); ?>
        </div>
        <!-- mainmenu -->
    </aside>
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