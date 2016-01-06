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
    

    <?php
      Modal::begin([
        'header' => '<h2>Item de Programação</h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
      ]);

      echo "<div id='modalContent'></div>";
      Modal::end();
    ?>

    <?php if(!Yii::$app->user->isGuest && $evento->canAccess()){ ?>
    <h1><?= Html::encode($this->title) ?></h1>
    

    <div id='external-events'>
        <?php foreach ($arrayTipo as $key => $item) {?>
          <div class='fc-event' id=<?=$key.">".$item?></div>
        <?php } ?>
        <p>Arraste os eventos</p>
        <p></p>
    </div>

    <?php 
    }?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario == 3 || !$evento->canAccess()){ ?>
    <?php $this->title = 'Programação';
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
    }?>
 

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
            var data = (new Date(dateStr)).toISOString().slice(0, 10);
            var hora = (new Date(dateStr)).toISOString().slice(11, 16);
            var idevento = getParameterByName('idevento');

            if(data < '$evento->dataIni' || data > '$evento->dataFim'){
              alert('Data inválida. Informe uma data  entre: $evento->dataIni e $evento->dataFim');
              $('#calendarItemProgramacao').fullCalendar('removeEvents', calEvent._id);
              return false;
            }

            $.get('index.php?r=item-programacao/create', {'data': data, 'hora': hora, 'idevento': idevento, 'tipo': tipo, 'requ': 'AJAX'}, function(data){
                $('#modal').modal('show')
                .find('#modalContent')
                .html(data);
            });
        }"),
        'eventClick' => new JsExpression("function(calEvent, jsEvent, view) {

          if(calEvent.id)
            $.get('index.php?r=item-programacao/view', {'id': calEvent.id, 'requ': 'AJAX'}, function(data){
                  $('#modal').modal('show')
                  .find('#modalContent')
                  .html(data);
              });
          else{

            var titulo = calEvent.title;
            var dateStr = calEvent.start._d;
            if(calEvent.end != null){
              var dateStr2 = calEvent.end._d
              var horaFim = (new Date(dateStr2)).toISOString().slice(11, 16);
            }else
              var horaFim = null;
            var data = (new Date(dateStr)).toISOString().slice(0, 10);
            var hora = (new Date(dateStr)).toISOString().slice(11, 16);

            if(data < (new Date()).toISOString().slice(0, 10)){
              alert('Data inválida. Informe um data futura');
              return false;
            }

            var idevento = getParameterByName('idevento');
            $.get('index.php?r=item-programacao/create', {'data': data, 'hora': hora, 'horafim': horaFim, 'idevento': idevento, 'titulo': titulo, 'requ': 'AJAX'}, function(data){
              $('#modal').modal('show')
              .find('#modalContent')
              .html(data);
            });
          }
        }"),
      'eventDrop' => new JsExpression("function(event, delta, revertFunc) {
        var dateStr = event.start._d;
        var data = (new Date(dateStr)).toISOString().slice(0, 10);
        if(data < '$evento->dataIni' || data > '$evento->dataFim'){
          alert('Data inválida. Informe uma data  entre: $evento->dataIni e $evento->dataFim');
          revertFunc();
          return false;
        }

      }"),
       ],
       //'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar']),
      'events' => $itensProgramacaoCalendar
      ]);
    ?>
    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2)){ ?>
    <?= Html::button('Itens a serem editados', ['id' => 'bota']) ?>
    <?php 
    }?>
    </div>
</div>
