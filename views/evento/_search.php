<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idevento') ?>

    <?= $form->field($model, 'sigla') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'dataIni') ?>

    <?= $form->field($model, 'dataFim') ?>

    <?php // echo $form->field($model, 'horaIni') ?>

    <?php // echo $form->field($model, 'horaFim') ?>

    <?php // echo $form->field($model, 'vagas') ?>

    <?php // echo $form->field($model, 'cagaHoraria') ?>

    <?php // echo $form->field($model, 'imagem') ?>

    <?php // echo $form->field($model, 'detalhe') ?>

    <?php // echo $form->field($model, 'allow') ?>

    <?php // echo $form->field($model, 'responsavel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
