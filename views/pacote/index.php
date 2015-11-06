<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PacoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pacotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pacote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'idpacote',
            'titulo',
            'descricao',
            'valor',
            'status',
            // 'evento_idevento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
