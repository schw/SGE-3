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
    <?= Html::cssFile('@web/css/dev.css');?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
     <?= Html::a(Html::img('@web/img/Imagem1.png', ['id'=>'banner']), ['site/index']) ?>

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
            ['label' => 'Home', 'url' => ['site/index']],
            ['label' => 'Recuperar Senha', 'url' => ['site/recuperar'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Eventos', 'visible' => (!Yii::$app->user->isGuest &&  Yii::$app->user->identity->tipoUsuario != 3),'items' => [
                ['label' => 'Inscrições Abertas', 'url' => ['evento/gerenciareventos', 'inscricoes' => 'aberta']],
                '<li class="divider"></li>',
                ['label' => 'Inscrições Não Iniciadas', 'url' => ['evento/gerenciareventos', 'inscricoes' => 'naoiniciada']],
                '<li class="divider"></li>',
                ['label' => 'Inscrições Fechadas', 'url' => ['evento/gerenciareventos', 'inscricoes' => 'fechada']],
                '<li class="divider"></li>',
                ['label' => 'Eventos Passados', 'url' => ['evento/gerenciareventos', 'status' => 'passado']],],], 
            ['label' => 'Eventos Ativos', 'visible' => (!Yii::$app->user->isGuest &&  Yii::$app->user->identity->tipoUsuario == 3), 'url' => ['evento/index']],
            ['label' => 'Cadastre-se', 'url' => ['/user/create'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Voluntários', 'url' => ['voluntario/index'], 'visible' => (!Yii::$app->user->isGuest &&  Yii::$app->user->identity->tipoUsuario != 3)],
            ['label' => 'Palestrantes', 'url' => ['palestrante/index'], 'visible' => (!Yii::$app->user->isGuest &&  Yii::$app->user->identity->tipoUsuario != 3)],
            ['label' => 'Relatórios', 'url' => ['relatorios/index'], 'visible' => (!Yii::$app->user->isGuest &&  Yii::$app->user->identity->tipoUsuario != 3)],
            ['label' => 'Locais', 'url' => ['local/index'], 'visible' => (!Yii::$app->user->isGuest &&  Yii::$app->user->identity->tipoUsuario != 3)],
            ['label' => 'Minhas Inscrições', 'url' => ['inscreve/index'], 'visible' => (!Yii::$app->user->isGuest &&  Yii::$app->user->identity->tipoUsuario == 3),'items' => [
                ['label' => 'Inscrições Atuais', 'url' => ['inscreve/index']],
                '<li class="divider"></li>',
                ['label' => 'Inscrições Passadas', 'url' => ['inscreve/passadas']],],], 

            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Sair (' . Yii::$app->user->identity->nome . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="width: 100%;">
        <div id="boasvindas">
         <?php if(!Yii::$app->user->isGuest){ ?>
            <p>
                Olá <?= Yii::$app->user->identity->nome ?>, <br>
                Perfil: <?= Yii::$app->user->identity->getDescricaoTipoUsuario() ?><br>
            </p>
            <?php } ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

        <p align="center">&copy; ICOMP - Instituto de Computação </br> Desenvolvido no Contexto da Disciplina ICC410 - 2015/02</p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
