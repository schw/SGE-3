<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;
use kartik\widgets\Growl;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos - Passados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal fade" id="modalnovoevento1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo Evento</h4>
      </div>
      <div class="modal-body">
            Para eventos com Itens de Programação, apenas informações mais gerais serão consideradas.<br>
            <?= Html::a('OK', ['evento/create'], ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalnovoevento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo Evento</h4>
      </div>
      <div class="modal-body">
        <a data-toggle="modal" data-target="#modalnovoevento1" data-dismiss="modal" class="btn btn-primary">
            Evento com Itens de Programação
        </a>
            <?= Html::a('Evento sem Itens de Programação', ['evento/create'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
  </div>
</div>
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
         <a data-toggle="modal" data-target="#modalnovoevento">
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
            'summary' => false,
            'columns' => [
                'sigla',
                'descricao',

                ['attribute' => 'tipo.titulo', 'value' => 'tipo.titulo'],
                ['attribute' => 'Vagas', 'value' => 'vagas','headerOptions' => ['width' => '100']],
                ['attribute' => 'qtd_evento', 'value' => 'qtd_evento','headerOptions' => ['width' => '170']],
                ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view}'],
            ],
        ]); ?>

        <h2><?= Html::encode("Compartilhado") ?></h2>

        <?= GridView::widget([
            'showOnEmpty' => 'true',
            'dataProvider' => $dataProvider2,
            'columns' => [
                'evento.sigla',
                'evento.descricao',
                'evento.responsavel0.nome',
                
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
