<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

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

    <p>
        <?= Html::a('Adicionar Programação', ['create', 'idevento' => Yii::$app->request->get('idevento')], ['class' => 'btn btn-success']) ?>
    </p>

    <div id='external-events'>
        <h4>Tipos</h4>
        <?php foreach ($arrayTipo as $item) {?>
          <div class='fc-event'><?= $item ?></div>
        <?php } ?>
        <p>Arraste os evento</p>
        <p></p>
    </div>

    <?= yii2fullcalendar\yii2fullcalendar::widget([
      'options' => [
        'lang' => 'pt-br',
      ],
      'clientOptions' => [
        'weekends' => false,
        'editable' => true,
        'droppable' => true,
       ],
       //'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar']),
      'events' => $itensProgramacaoCalendar
      ]);
    ?>
    </div>
</div>
