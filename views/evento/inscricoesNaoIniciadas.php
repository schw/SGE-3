<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;
use kartik\widgets\Growl;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos - Inscrições Não Iniciadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
        <div id="geral" class="diviconegeral" style="width: 100%; text-align: center;">
            <div id="titulo" style= "float: left;">
                <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
            </div>
            <a href=<?= Url::to(['evento/create'])?>>
                <div class="divicone divicone-l1" style="padding: 10px;">
                    <?= Html::img('@web/img/novoevento.png', ['class' => 'imgicone']) ?>
                    <p>Novo Evento</p>
                </div>
            </a>
            <div class="clear"></div>
        </div>
        <p></p>

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
                ['attribute' => 'tipo.titulo', 'value' => 'tipo.titulo'],//Substitução do idtipo pelo titulo do tipo
                ['attribute' => 'Vagas', 'value' => 'vagas','headerOptions' => ['width' => '100']],
                ['attribute' => 'qtd_evento', 'value' => 'qtd_evento','headerOptions' => ['width' => '170']],
                //['attribute' => 'Total de Vagas', 'value' => 'vagas', 'visible' => $status == 'passado'],
                ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view} {update} {delete}{link}'],
            ],
        ]); ?>

        <h2><?= Html::encode("Compartilhado") ?></h2>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'showOnEmpty' => 'true',
            'dataProvider' => $dataProvider2,
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'evento.sigla',
                'evento.descricao',
                ['attribute' => 'Responsável', 'value' => 'evento.responsavel0.nome'],
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
                ['attribute' => 'tipo', 'value' => 'evento.tipo.titulo'],//Substitução do idtipo pelo titulo do tipo
                ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view}{link}','buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->evento_idevento]);
                            },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>