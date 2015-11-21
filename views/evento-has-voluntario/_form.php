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

    <?= $form->field($model, 'evento_idevento')->dropDownList(
            $arrayEventosAtivos,
            ['prompt'=>'Selecione um Evento']
    );?>

    <div class="form-group">
        <?= Html::submitButton('Adicionar Voluntário ao evento', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
