<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemProgramacaoHasPacote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-programacao-has-pacote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'itemProgramacao_iditemProgramacao')->textInput() ?>

    <?= $form->field($model, 'pacote_idpacote')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
