<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;
use kartik\widgets\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos Ativos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
    <div id="geral" class="diviconegeral">
            <div id="titulo" style= "float: left;">
                <h1><?= $this->title ?></h1>
            </div>
            <div class="clear"></div>
        </div>

        <?= GridView::widget([
            'showOnEmpty' => 'true',
            'dataProvider' => $dataProvider,
            'columns' => [
                'sigla',
                'descricao',

                ['attribute' => 'tipo', 'value' => 'tipo.titulo'],
                ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view}'],
            ],
        ]); ?>
    </div>
</div>
