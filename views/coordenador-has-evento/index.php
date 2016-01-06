<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoordenadorHasEventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coordenadores de ' .$evento['descricao'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordenador-has-evento-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Adicionar Coordenador', ['create', 'idevento' => $idevento], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'usuario.nome',
            ['attribute' => 'Descricao', 'value' => 'usuario.descricaotipousuario'],
            ['class' => 'yii\grid\ActionColumn', 'header'=>'', 'headerOptions' => ['width' => '40'], 'template' => '{delete}{link}'],],
        
        ]);
    ?>
    </div>
</div>
