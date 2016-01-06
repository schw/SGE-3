<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventoHasVoluntario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-has-voluntario-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'voluntario_idvoluntario')->dropDownList(
            $arrayVoluntarios,
            ['prompt'=>'Selecione um Voluntário']
        );?>

    <div class="form-group">
        <?= Html::submitButton('Adicionar Voluntário', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
