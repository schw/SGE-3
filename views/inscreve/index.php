<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap;
use kartik\widgets\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscreveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Minhas Inscrições ';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="inscreve-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">

    <div id="geral" style="width: 100%; text-align: center;">
        <div id="titulo" style= "float: left">
            <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
        </div>

        <div style="width: 80px; float: right; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/minhasincricoes.png'), ['/evento'], ['width' => '10']) ?>
            <?php echo Html::a('Listar Eventos', 'index.php?r=evento'); ?>
        </div>
    </div>

    <?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'evento.descricao',
            'evento.sigla',
            'evento.tipo.titulo',
            ['attribute' => 'pacote.titulo', 'value' => 'pacotetitulo',],
            ['attribute' => 'credenciado', 'value' => 'descricaocredenciado',],
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '20'], 
            'template' => '{view}{link}','buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'index.php?r=evento/view&id='.$model->evento_idevento);
                },
        ],
],
     ],
 ]); ?>

</div>

</div>
