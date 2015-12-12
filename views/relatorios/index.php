<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use app\models\Evento;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

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

<!-- Modal -->
<div class="modal fade" id="modalCoordPdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Intervalo de datas para geração do Relatórios</h4>
      </div>
      <div class="modal-body">
        
        <?php 
        $form = ActiveForm::begin(['action' =>['relatorios/coordpdf'], 'id' => 'forum_post', 
            'method' => 'get','options'=>['target'=>'_blank']]);
            ?>

                <?php
                    echo DatePicker::widget([
                        'name' => 'datainicial',
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
                        'name' => 'datafinal',
                        'options' => ['placeholder' => 'Escolha a data Final ...'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd-mm-yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                ?>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      
        <?= Html::SubmitButton( 'Gerar Relatório',['relatorios/coordpdf/', 'class' => 'btn btn-primary', 'target'=>'_blank'] ) ?> 
            <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
<!-- -->

<!-- Modal -->
<div class="modal fade" id="modalParticPdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Intervalo de datas para geração do Relatórios</h4>
      </div>
      <div class="modal-body">
        
        <?php 
        $form = ActiveForm::begin(['action' =>['relatorios/particpdf'], 'id' => 'forum_post', 
            'method' => 'get','options'=>['target'=>'_blank']]);
            ?>

                <?php
                    echo DatePicker::widget([
                        'name' => 'datainicial',
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
                        'name' => 'datafinal',
                        'options' => ['placeholder' => 'Escolha a data Final ...'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd-mm-yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                ?>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <?= Html::SubmitButton( 'Gerar Relatório',['relatorios/particpdf/', 'class' => 'btn btn-primary', 'target'=>'_blank'] ) ?> 
            <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
<!-- -->

<!-- Modal -->
<div class="modal fade" id="modalEventoPdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Intervalo de datas para geração do Relatórios</h4>
      </div>
      <div class="modal-body">
        
        <?php 
        $form = ActiveForm::begin(['action' =>['relatorios/eventopdf'], 'id' => 'forum_post', 
            'method' => 'get','options'=>['target'=>'_blank']]);
            ?>

                <?php
                    echo DatePicker::widget([
                        'name' => 'datainicial',
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
                        'name' => 'datafinal',
                        'options' => ['placeholder' => 'Escolha a data Final ...'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd-mm-yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                ?>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <?= Html::SubmitButton( 'Gerar Relatório',['relatorios/eventopdf/', 'class' => 'btn btn-primary', 'target'=>'_blank'] ) ?> 
            <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
<!-- -->


            <div id="menu-relatorios" style="width: 100%; text-align: center;">

            <a data-toggle="modal" data-target="#modalCoordPdf">
                <div style="width: 190px; float: left ;  padding: 10px; margin-right: 8%; border-style: solid;">
                    <img src = '../web/img/reportevento.png'><br>
                          N° de Eventos Criados por Professor
                </div>    
            </a>

            <a data-toggle="modal" data-target="#modalEventoPdf">
                <div style="width: 190px; float: left ;  padding: 10px; margin-right: 8%; border-style: solid;">
                    <img src = '../web/img/reportcoord.png'><br>
                           N° de Inscrições por Evento
                </div>    
            </a>

            <a data-toggle="modal" data-target="#modalParticPdf">
                <div style="width: 190px; float: left ;  padding: 10px; margin-right: 8%; border-style: solid;">
                    <img src = '../web/img/reportaluno.png'><br>
                        N° de Inscrições por Participante
                </div>    
            </a>

            </div>
    </div>


</div>
