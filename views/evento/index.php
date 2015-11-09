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

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario != 3){ ?>
    <p>
        <?= Html::a('Novo Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

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
            ['attribute' => 'tipo', 'value' => 'tipo.titulo'],//Substitução do idtipo pelo titulo do tipo

            Yii::$app->user->isGuest || Yii::$app->user->identity->tipoUsuario == 3 ? ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view}'] : 
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view} {update} {delete}{link}'],
            
        ],
    ]); ?>

</div>
