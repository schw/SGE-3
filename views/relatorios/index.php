<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use app\models\Evento;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Evento */


$this->title = "Relatórios";
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="evento-view">
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <div id="page-wrapper">
    <div id="geral" style="width: 100%; text-align: left;">
            <div id="titulo" >
                <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
            </div>

<?php 
    echo DatePicker::widget([
    'name' => 'datepicker',
    'options' => ['placeholder' => 'Escolha a data Inicial ...'],
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'format' => 'dd-mm-yyyy',
        'autoclose' => true,
    ]
]);
    echo '<br>';

    echo DatePicker::widget([
        'name' => 'datepicker',
        'options' => ['placeholder' => 'Escolha a data Final ...'],
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'format' => 'dd-mm-yyyy',
            'autoclose' => true,
        ]
    ]);
    echo '<br>';
?>


            <div id="menu-relatorios" style="width: 100%; text-align: center;">
                <div style="width: 190px; float: left ;  padding: 10px; margin-right: 15%;">
                        <?php echo Html::a(Html::img('@web/img/reportcoord.png'), ['relatorios/coordpdf'], 
                                ['target'=>'_blank', 'style' => 'text-align: center ; float: center']); ?>
                        <?php echo '<br>'.Html::a('N° de Eventos Coordenados por Professor', ['relatorios/coordpdf'], 
                                ['target'=>'_blank', 'style' => 'text-align: center']); ?>
                </div>    

                <div style="width: 190px; float: left ;  padding: 10px; margin-right: 15%;">
                        <?php echo Html::a(Html::img('@web/img/reportevento.png'), ['relatorios/eventopdf'], 
                                ['target'=>'_blank', 'style' => 'text-align: center ; float: center']); ?>
                        <?php echo '<br>'.Html::a('N° de Inscrições por Evento', ['relatorios/eventopdf'], 
                                ['target'=>'_blank', 'style' => 'text-align: center']); ?>
                </div>  

                <div style="width: 190px; float: left ; padding: 10px;margin-right: 15%;">
                        <?php echo Html::a(Html::img('@web/img/reportaluno.png'), ['relatorios/particpdf'], 
                                ['target'=>'_blank', 'style' => 'text-align: center ; float: center']); ?>
                        <?php echo '<br>'.Html::a('N° de Inscrições por participante', ['relatorios/particpdf'], 
                                ['target'=>'_blank', 'style' => 'text-align: center']); ?>
                </div>

            </div>
    </div>


</div>
