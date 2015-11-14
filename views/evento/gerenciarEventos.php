<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$status == 'passado' ? $this->title = 'Meus Eventos - Passados': $this->title = 'Meus Eventos - Ativos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">
    <div class="navbar-default sidebar">
            <?php
            $heading = 'Opções';
             echo SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'encodeLabels' => false,
                //'heading' => $heading,
                'items' => [
                    // Important: you need to specify url as 'controller/action',
                    // not just as 'controller' even if default action is used.
                    ['label' => 'Home', 'icon' => 'home', 'url' => ['site/index']],
                    ['label' => 'Eventos', 'icon' => 'tags', 'items' => [
                        ['label' => 'Eventos Ativos', 'url' => ['evento/gerenciareventos']],
                        ['label' => 'Eventos Passados', 'url' => ['evento/gerenciareventos', 'status' => 'passado']],],],
                    Yii::$app->user->isGuest ? ['label' => 'Cadastre-se', 'icon' => 'info-sign', 'url' => ['/user/create']] : ['label' => 'Perfil', 'icon' => 'user', 'url' => ['user/view', 'id' => Yii::$app->user->identity->idusuario]],
                    Yii::$app->user->isGuest ? ['label' => 'Login', 'icon' => 'user', 'url' => ['site/login']] : ['label' => 'Minhas Inscrições', 'icon' => 'flag', 'url' => ['inscreve/index']],
                   /* ['label' => 'Books', 'icon' => 'book', 'items' => [
                        ['label' => '<span class="pull-right badge">10</span> New Arrivals', 'url' => Url::to(['/site/new-arrivals', 'type'=>SideNav::TYPE_DEFAULT])],
                        ['label' => '<span class="pull-right badge">5</span> Most Popular', 'url' => Url::to(['/site/most-popular', 'type'=>SideNav::TYPE_DEFAULT])],
                        ['label' => 'Read Online', 'icon' => 'cloud', 'items' => [
                            ['label' => 'Online 1', 'url' => Url::to(['/site/online-1', 'type'=>SideNav::TYPE_DEFAULT])],
                            ['label' => 'Online 2', 'url' => Url::to(['/site/online-2', 'type'=>SideNav::TYPE_DEFAULT])]
                        ]],
                    ]],*/
                    //['label' => 'Profile', 'icon' => 'user', 'url' => Url::to(['/site/profile', 'type'=>SideNav::TYPE_DEFAULT])],
                    ],
                ]);        
            ?>
       </div>
    <div id="page-wrapper">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Novo Evento', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'showOnEmpty' => 'true',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'sigla',
                'descricao',
                //'dataIni',
                //'dataFim',
                //'horaIni',
                // 'horaFim',
                // 'vagas',
                // 'cagaHoraria',
                // 'imagem',
                // 'detalhe',
                // 'allow',
                //'responsavel',
                ['attribute' => 'tipo', 'value' => 'tipo.titulo'],//Substitução do idtipo pelo titulo do tipo
                ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view} {update} {delete}{link}'],
            ],
        ]); ?>
    </div>
</div>
