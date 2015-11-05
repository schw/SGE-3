<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inscreve */

$this->title = 'Update Inscreve: ' . ' ' . $model->usuario_idusuario;
$this->params['breadcrumbs'][] = ['label' => 'Inscreves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuario_idusuario, 'url' => ['view', 'usuario_idusuario' => $model->usuario_idusuario, 'evento_idevento' => $model->evento_idevento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inscreve-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

?>
</div>
