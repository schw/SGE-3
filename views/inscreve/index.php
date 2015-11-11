<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscreveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Minhas Inscrições ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscreve-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Lista de Eventos', ['/evento'], ['class' => 'btn btn-success']) ?>
    </p>


<!-- menssagem de sucesso -->
            <?php if (Yii::$app->session->hasFlash('Sucesso')): ?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('Sucesso') ?>
        </div>
        <?php endif; ?>
<!-- fim da mensagem de sucesso -->

<!-- menssagem de falha -->
            <?php if (Yii::$app->session->hasFlash('Falha')): ?>
        <div class="alert alert-danger">
            <?php echo Yii::$app->session->getFlash('Falha') ?>
        </div>
        <?php endif; ?>
<!-- fim da mensagem de falha -->


<?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'evento.descricao',
            'evento.sigla',
            ['attribute' => 'credenciado', 'value' => 
            function ($data) {
                if ($data->credenciado){
                    return 'Sim';
                }else{
                    return 'Não';
                }
            },],
            'evento.tipo.titulo',
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
