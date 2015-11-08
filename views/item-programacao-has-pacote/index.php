<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemProgramacaoHasPacoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Programacao Has Pacotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-programacao-has-pacote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Programacao Has Pacote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'itemProgramacao_iditemProgramacao',
            'pacote_idpacote',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
