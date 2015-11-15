<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoordenadorHasEventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coordenador Has Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordenador-has-evento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Coordenador Has Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usuario_idusuario',
            'evento_idevento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
