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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Adicionar Programação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'iditemProgramacao',
            //'titulo',
            'descricao',
            'palestrante',
            'data',
            'hora',
            'vagas',
            // 'cagaHoraria',
            // 'detalhe',
            // 'notificacao',
            // 'local_idlocal',
            // 'evento_idevento',
            // 'tipo_idtipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
