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
            Yii::$app->user->isGuest ? ['label' => 'Recuperar Senha', 'url' => ['site/recuperar']] : ['label' => ''],
            Yii::$app->user->isGuest ? ['label' => 'Cadastre-se', 'url' => ['/user/create']] : ['label' => ''],
            ['label' => 'Eventos', 'url' => ['evento/index']],
            Yii::$app->user->isGuest ? ['label' => 'Home', 'url' => ['index']] : ['label' => 'Home', 'url'=>['site/usuario']],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->nome . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="width: 100%;">
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
