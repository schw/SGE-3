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

<div class="modal fade" id="modalnovoevento1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo Evento - Programação Única</h4>
      </div>
      <div class="modal-body">
            No caso do <b> evento com programação única</b>, não há necessidade de você inserir um item de programação, basta inserir todas as informações da referida programação na tela de criação do evento. <br>
            Ao apertar o botão "ok", será redirecionado a uma tela, em que será solicitada diversas informações a respeito do evento, você deve preenchê-las de acordo com as informações do único item de programação. <br><br>
            Observação: Os campos <b>Vagas</b> e <b>Carga Horária</b> devem ser preenchidos, respectivamente, pela quantidade de Vagas e pela Carga Horária desse Único Item de Programação .<br> O campo <b>Palestrante</b>, embora não obrigatório, é recomendável nesse caso. <br><br>
            <?= Html::a('Ok. Eu entendi!', ['evento/create'], ['class' => 'btn btn-primary']) ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalnovoevento2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo Evento - Programação Multipla</h4>
      </div>
      <div class="modal-body">
            No caso do <b> evento com multipla programação</b>, após a criação do evento, você deve inserir pelo menos um item de programação.<br>
            Ao apertar o botão "ok", será redirecionado a uma tela, em que será solicitada diversas informações gerais do evento (e não de um item em específico), você deve preenchê-las de acordo com as as informações gerais do evento. <br><br>
            Observação: Os campos <b>Vagas</b> e <b>Carga Horária</b> devem ser preenchidos, respectivamente, pelo total de Vagas do Evento e pela Carga Horária total do evento.<br> O campo <b>Palestrante</b> é dispensável nesse caso. <br><br>
            <?= Html::a('Ok. Eu entendi!', ['evento/create'], ['class' => 'btn btn-primary']) ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalnovoevento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo Evento - Escolha uma modalidade de evento:</h4>
      </div>
      <div class="modal-body">
      <b> OBSERVAÇÃO: </b> <br><br>
      <b> Eventos com Programação única </b> são aqueles que todo o evento é compreendido de apenas um item de Programação, como por exemplo: Uma Palestra.<br><br>
      <b> Eventos com multipla Programação </b> são aqueles que todo o evento é compreendido de várias programações, como por exemplo: Duas Palestras. <br><br>
        <a data-toggle="modal" data-target="#modalnovoevento1" data-dismiss="modal" class="btn btn-primary">
            Evento com Programação Única
        </a>
        <a data-toggle="modal" data-target="#modalnovoevento2" data-dismiss="modal" class="btn btn-primary">
            Eventos com multipla Programação
        </a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
