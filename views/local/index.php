<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\Growl;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="local-index">

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
            <a href="javascript:window.history.go(-1)">
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/voltar.png', ['class' => 'imgicone'])?>
                    <p class="labelicone">Voltar</p>
                </div>
            </a>
            <a href=<?= Url::to(['create'])?>>
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/addlocal.png', ['class' => 'imgicone'])?>
                    <p>Novo Local</p>
                </div>
            </a>
        </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        
            'descricao',
            'latitude',
            'longitude',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>
