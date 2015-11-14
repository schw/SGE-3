<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$status == 'passado' ? $this->title = 'Meus Eventos - Passados': $this->title = 'Meus Eventos - Ativos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">
    
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>
    
    <div id="page-wrapper">
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
                ['attribute' => 'tipo', 'value' => 'tipo.titulo'],//Substitução do idtipo pelo titulo do tipo
                ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view} {update} {delete}{link}'],
            ],
        ]); ?>
    </div>
</div>
