<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemprogramacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'iditemProgramacao',
            'titulo',
            'descricao',
            'palestrante',
            'data',
            // 'hora',
            // 'vagas',
            // 'cargaHoraria',
            // 'detalhe',
            // 'notificacao',
            // 'local_idlocal',
            //'evento_idevento',
            ['attribute' => 'tipo', 'value' => 'tipo.titulo'],  //Substitução do idtipo pelo titulo do tipo
            ['class' => 'yii\grid\ActionColumn', 'header'=>'', 'headerOptions' => ['width' => '80'], 'template' => '{view} {link}'],
        ],
    ]); ?>

</div>
