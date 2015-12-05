<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemprogramacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gerenciar Programação';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::jsFile('@web/js/lib/moment.min.js'); ?>
<?= Html::jsFile('@web/js/lib/jquery.min.js');?>
<?= Html::jsFile('@web/js/lib/jquery-ui.custom.min.js');?>



<div class="itemprogramacao-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
      Modal::begin([
        'header' => '<h2>Criar Item de Programação</h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
      ]);

      echo "<div id='modalContent'></div>";
      Modal::end();
    ?>

    <div id='external-events'>
        <?php foreach ($arrayTipo as $key => $item) {?>
          <div class='fc-event' id=<?=$key.">".$item?></div>
        <?php } ?>
        <p>Arraste os evento</p>
        <p></p>
    </div>

    <?= yii2fullcalendar\yii2fullcalendar::widget([
      'id' => 'calendarItemProgramacao',
      'options' => [
        'lang' => 'pt-br',
      ],
      'clientOptions' => [
        'weekends' => true,
        'editable' => true,
        'droppable' => true,
        'defaultView' => 'agendaWeek',
        'drop' => new JsExpression("function(start, end, calEvent) {
            var tipo = calEvent.helper.context.id;
            var dateStr = start;
            var data = (new Date(dateStr)).toISOString().slice(0, 10)
            var hora = (new Date(dateStr)).toISOString().slice(12, 16)
            var idevento = getParameterByName('idevento');

            $.get('index.php?r=item-programacao/create', {'data': data, 'hora': hora, 'idevento': idevento, 'tipo': tipo}, function(data){
                $('#modal').modal('show')
                .find('#modalContent')
                .html(data);
            });
        }"),
        'eventClick' => new JsExpression("function(calEvent, jsEvent, view) {
            $.get('index.php?r=item-programacao/update', {'data': data, 'hora': hora, 'idevento': idevento}, function(data){
                $('#modal').modal('show')
                .find('#modalContent')
                .html(data);
            });
        }"),
       ],
       //'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar']),
      'events' => $itensProgramacaoCalendar
      ]);
    ?>
    <?= Html::button('teste', ['id' => 'bota']) ?>
    </div>
</div>
