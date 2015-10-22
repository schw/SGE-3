<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemprogramacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemprogramacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'iditemProgramacao') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'palestrante') ?>

    <?= $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'vagas') ?>

    <?php // echo $form->field($model, 'cagaHoraria') ?>

    <?php // echo $form->field($model, 'detalhe') ?>

    <?php // echo $form->field($model, 'notificacao') ?>

    <?php // echo $form->field($model, 'local_idlocal') ?>

    <?php // echo $form->field($model, 'evento_idevento') ?>

    <?php // echo $form->field($model, 'tipo_idtipo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
