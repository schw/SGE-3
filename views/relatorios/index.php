<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

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

    <div style="width: 100px; float: left; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/pacotes.png'),['relatorios/coordpdf',
            ]); 
            ?>
            <?php echo Html::a('Eventos por Professor', ['relatorios/coordpdf']); 
            ?>
        </div>
    <div style="width: 100px; float: left; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/pacotes.png'),['relatorios/particpdf',
            ]); 
            ?>
            <?php echo Html::a('Eventos por participante', ['relatorios/particpdf']); 
            ?>
        </div>

    <div style="width: 100px; float: left; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/pacotes.png'),['relatorios/eventopdf',
            ]); 
            ?>
            <?php echo Html::a('Numero de Inscritos', ['relatorios/eventopdf']); 
            ?>
        </div>

</div>

