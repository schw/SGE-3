<?php

/* @var $this \yii\web\View */
/* @var $content string */
use kartik\widgets\SideNav;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::cssFile('@web/css/temp.css');?>
    <?= Html::jsFile('@web/js/funcoesUteis.js') ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
     <?= Html::a(Html::img('@web/img/banner1.png', ['id'=>'banner']), ['site/index']) ?>

    <?php
    NavBar::begin([
        'brandLabel' => 'SGE',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Item de Programação', 'url' => ['itemprogramacao/index']],
            ['label' => 'Eventos', 'url' => ['evento/index']],
            //['label' => 'About', 'url' => ['/site/about']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="width: 100%;">
        <div id="boasvindas">
            <p>
                Olá $user, bem vindo(a)!<br>
                seu perfil atual é $perfil.<br>
                para sair do sistema faça <i>logout</i>
            </p>
        </div>
        <div id="lateralMenu">
        <?php
        $heading = 'Opções';
         echo SideNav::widget([
            'type' => SideNav::TYPE_DEFAULT,
            'encodeLabels' => false,
            'heading' => $heading,
            'items' => [
                // Important: you need to specify url as 'controller/action',
                // not just as 'controller' even if default action is used.
                ['label' => 'Home', 'icon' => 'home', 'url' => Url::to(['/site/index', 'type'=>SideNav::TYPE_DEFAULT])],
                ['label' => 'Evento', 'icon' => 'info-sign', 'url' => Url::to(['/evento/index', 'type'=>SideNav::TYPE_DEFAULT])],
                ['label' => 'Books', 'icon' => 'book', 'items' => [
                    ['label' => '<span class="pull-right badge">10</span> New Arrivals', 'url' => Url::to(['/site/new-arrivals', 'type'=>SideNav::TYPE_DEFAULT])],
                    ['label' => '<span class="pull-right badge">5</span> Most Popular', 'url' => Url::to(['/site/most-popular', 'type'=>SideNav::TYPE_DEFAULT])],
                    ['label' => 'Read Online', 'icon' => 'cloud', 'items' => [
                        ['label' => 'Online 1', 'url' => Url::to(['/site/online-1', 'type'=>SideNav::TYPE_DEFAULT])],
                        ['label' => 'Online 2', 'url' => Url::to(['/site/online-2', 'type'=>SideNav::TYPE_DEFAULT])]
                    ]],
                ]],
                ['label' => 'Profile', 'icon' => 'user', 'url' => Url::to(['/site/profile', 'type'=>SideNav::TYPE_DEFAULT])],
                ],
            ]);        
        ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

        <p align="center">&copy; ICOMP - Instituto de Computação </br> Desenvolvido no Contexto da Disciplina ICC410 - <?= date('Y'.'/'.'02')?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
