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
    <div id="geral" style="width: 100%; text-align: center;">
        <div id="titulo" style= "float: left">
            <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
        </div>

    <div style="width: 200px; float: right; padding: 10px 10px;margin-top:20px;">
          <?php echo Html::a('Eventos por Professor', ['relatorios/coordpdf'], ['target' => "_blank"],
          	['class' => 'btn btn-default']); 
            ?>
        </div>
    <div style="width: 200px; float: right; padding: 10px 10px;margin-top:20px;">
            <?php echo Html::a('Eventos por participante', ['relatorios/particpdf'], ['target' => "_blank"],
          	['class' => 'btn btn-default']); 
            ?>
        </div>

    <div style="width: 200px; float: right; padding: 10px; margin-top:20px;">
            <?php echo Html::a('Numero de Inscritos',  ['relatorios/eventopdf'], ['target' => "_blank"],['class' => 'btn btn-default']); 
            ?>
        </div>

</div>