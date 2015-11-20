<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap;
use kartik\widgets\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscreveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Pacotes Disponíveis:';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inscreve-pacote">


    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

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
            //['class' => 'yii\grid\SerialColumn'],
            'titulo',
            //'evento.descricao',
            'descricao',
            'valor',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '100'], 
            'template' => '{view} {plus} {link}','buttons' => [
                'plus' => function ($url,$model,$key) {
                                return  Html::a('<span class="glyphicon glyphicon-plus"></span>', ['inscreve/addpacote'], [
                                                'data'=>[
                                                'method' => 'POST',
                                                'params'=>['id_pacote' => $model->idpacote, 'id_evento' => $model->evento_idevento],]
                                        ]);
                },
                'view' => function ($url,$model,$key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['pacote/view', 'id' => $model->idpacote]);
                },
        ],
],
     ],
 ]); ?>


<p> <h1> Pacotes Indisponíveis: </h1> </p>

 <?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider2,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'titulo',
            //'evento.descricao',
            'descricao',
            'valor',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '100'], 
            'template' => '{view} {link}','buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['pacote/view', 'id' => $model->idpacote]);
                },]]
            ],  
 ]); ?>



</div>
</div>
