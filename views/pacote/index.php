<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PacoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pacotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacote-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2)){ ?>
        <p>
            <?= Html::a('Criar Pacote', ['create', 'idevento' => $idevento], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'titulo',
            'descricao',
            'valormoeda',

            Yii::$app->user->isGuest || Yii::$app->user->identity->tipoUsuario == 3 ? ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view}'] : 
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
