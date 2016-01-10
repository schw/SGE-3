<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PalestranteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Palestrantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="palestrante-index">
    
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
                <div class="divicone divicone-l2">
                    <?= Html::img('@web/img/addpales.png', ['class' => 'imgicone'])?>
                    <p>Novo Palestrante</p>
                </div>
            </a>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'nome',
                'email:email',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

</div>
