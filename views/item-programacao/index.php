<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemprogramacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gerenciar Programação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario != 3){?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Adicionar Programação', ['create', 'idevento' => Yii::$app->request->get('idevento')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'iditemProgramacao',
            'titulo',
            'descricao',
            'palestrante',
            ['attribute' => 'data', 'format' => ['date', 'php:d-m-Y']],   
            // 'hora',
            // 'vagas',
            // 'cargaHoraria',
            // 'detalhe',
            // 'notificacao',
            // 'local_idlocal',
            //'evento_idevento',
            ['attribute' => 'tipo', 'value' => 'tipo.titulo'],  //Substitução do idtipo pelo titulo do tipo
            ['class' => 'yii\grid\ActionColumn', 'header'=>'', 'headerOptions' => ['width' => '80'], 'template' => '{view} {update} {delete}{link}'],
        ],
    ]); ?>
    <?php } ?>

    <?php 
    $this->title = 'Programação';
    $this->params['breadcrumbs'][] = $this->title;
    
    if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario == 3){?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'iditemProgramacao',
            'titulo',
            'descricao',
            'palestrante',
            ['attribute' => 'data', 'format' => ['date', 'php:d-m-Y']],
            // 'hora',
            // 'vagas',
            // 'cargaHoraria',
            // 'detalhe',
            // 'notificacao',
            // 'local_idlocal',
            //'evento_idevento',
            ['attribute' => 'tipo', 'value' => 'tipo.titulo'],  //Substitução do idtipo pelo titulo do tipo
            ['class' => 'yii\grid\ActionColumn', 'header'=>'', 'headerOptions' => ['width' => '80'], 'template' => '{view}{link}'],
        ],
    ]); ?>
    <?php } ?>

</div>
