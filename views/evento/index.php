<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

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

            ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view} {update} {delete}{link}',],
        ],
    ]); ?>

</div>
