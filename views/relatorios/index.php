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
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>

    function datas(datainicial,datafinal){
            var dia, mes, ano;

            dia = datainicial.substring(0,2);
            mes = datainicial.substring(3,5);
            ano = datainicial.substring(6,10);
            var dateini = new Date(ano, mes, dia);

            dia = datafinal.substring(0,2);
            mes = datafinal.substring(3,5);
            ano = datafinal.substring(6,10);
            var datefim = new Date(ano, mes, dia);

            if ((datainicial.length == 0) || (datafinal.length == 0)){
                return 1;
            }
            else if ((dateini > datefim)) {
                return 0;
            }

            return 1;
    }

    $(function() {
        $("#forum_post").submit(function(e) {
            
            var datainicial,datafinal;
            datainicial = $("#datainicial").val();
            datafinal = $("#datafinal").val();

            var retorno = datas(datainicial,datafinal);

            if (retorno == 0){
                $("#ErroDatas").html("<b>Data inicial deve ser ANTERIOR a Data Final</b>");
                e.preventDefault();
            }
            else {
                $("#ErroDatas").html("<b></b>");
            }

        });


        $("#forum_post1").submit(function(e) {

            var datainicial,datafinal;
            datainicial = $("#datainicial1").val();
            datafinal = $("#datafinal1").val();

            var retorno = datas(datainicial,datafinal);

            if (retorno == 0){
                $("#ErroDatas1").html("<b>Data inicial deve ser ANTERIOR a Data Final</b>");
                e.preventDefault();
            }
            else {
                $("#ErroDatas1").html("<b></b>");
            }
        });

        $("#forum_post2").submit(function(e) {

            var datainicial,datafinal;
            datainicial = $("#datainicial2").val();
            datafinal = $("#datafinal2").val();

            var retorno = datas(datainicial,datafinal);

            if (retorno == 0){
                $("#ErroDatas2").html("<b>Data inicial deve ser ANTERIOR a Data Final</b>");
                e.preventDefault();
            }
            else {
                $("#ErroDatas2").html("<b></b>");
            }
        });

    });

</script>
</head>


<div class="evento-view">
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <div id="page-wrapper">
      <div id="geral" class="diviconegeral">
            <div id="titulo" style= "float: left;">
                <h1><?= $this->title ?></h1>
            </div>
            <div class="clear"></div>
        </div>
    <div id="geral" style="width: 100%; text-align: left;">

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
            'method' => 'get',
            //'options'=>['target'=>'_blank']
            ]);
            ?>

                <?php
                    echo 'Data Inicial'.DatePicker::widget([
                        'name' => 'datainicial',
                        'id' =>'datainicial',
                        'options' => ['placeholder' => 'Escolha a data Inicial ...'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd-mm-yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                   echo '<br>';
                    echo 'Data Final'.DatePicker::widget([
                        'name' => 'datafinal',
                        'id' => 'datafinal',
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

        <div id = 'ErroDatas' style="padding-left:20px; color: #FF0000" > </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      
        <?= Html::SubmitButton( 'Gerar Relatório',['relatorios/coordpdf/', 'class' => 'btn btn-primary', //'target'=>'_blank'
        ] ) ?> 

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
        $form = ActiveForm::begin(['action' =>['relatorios/particpdf'], 'id' => 'forum_post1', 
            'method' => 'get',
                //'options'=>['target'=>'_blank']
            ]);
            ?>

                <?php
                    echo 'Data Inicial'.DatePicker::widget([
                        'name' => 'datainicial',
                        'id' =>'datainicial1',
                        'options' => ['placeholder' => 'Escolha a data Inicial ...'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd-mm-yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                   echo '<br>';
                    echo 'Data Final'.DatePicker::widget([
                        'name' => 'datafinal',
                        'id' =>'datafinal1',
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

        <div id = 'ErroDatas1' style="padding-left:20px; color: #FF0000" > </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <?= Html::SubmitButton( 'Gerar Relatório',['relatorios/particpdf/', 'class' => 'btn btn-primary', //'target'=>'_blank'
        ] ) ?> 
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
        $form = ActiveForm::begin(['action' =>['relatorios/eventopdf'], 'id' => 'forum_post2', 
            'method' => 'get',
                //'options'=>['target'=>'_blank']
                ]);
            ?>

                <?php
                    echo 'Data Inicial'.DatePicker::widget([
                        'name' => 'datainicial',
                        'id' =>'datainicial2',
                        'options' => ['placeholder' => 'Escolha a data Inicial ...'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd-mm-yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                   echo '<br>';
                    echo 'Data Final'.DatePicker::widget([
                        'name' => 'datafinal',
                        'id' =>'datafinal2',
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

        <div id = 'ErroDatas2' style="padding-left:20px; color: #FF0000" > </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <?= Html::SubmitButton( 'Gerar Relatório',['relatorios/eventopdf/', 'class' => 'btn btn-primary', //'target'=>'_blank'
        ] ) ?> 
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

</div>
