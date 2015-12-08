<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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

            <!--
                        <div style="width: 200px; margin-top:20px;">
                            <?php echo Html::a('Quantitativo de Eventos Coordenados por Professor', ['relatorios/coordpdf'], 
                                ['target'=>'_blank', 'class' => 'list-group-item list-group-item-info', 'style' => 'width: 400px;text-align: left; float: left']); 
                            ?>
                        </div>

                        <div style="width: 200px;  margin-top:20px;">
                            <?php echo Html::a('Quantitativo de Inscrições por participante', ['relatorios/particpdf'], 
                                ['target' => "_blank" ,	'class' => 'list-group-item list-group-item-info', 'style' => 'width: 400px;text-align: left; float: left']); 
                            ?>
                        </div>

                        <div style="width: 200px; margin-top:20px;">
                            <?php echo Html::a('Quantitativo de inscritos por Evento',  ['relatorios/eventopdf'], 
                                    ['target' => "_blank" ,'class' => 'list-group-item list-group-item-info', 'style' => 'width: 400px;text-align: left; float: left']); 
                            ?>
                        </div>

                </div>

            -->
</div>
