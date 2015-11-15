<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CoordenadorHasEvento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coordenador-has-evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario_idusuario')->dropDownList(
            $arrayUsuarios,
            ['prompt'=>'Selecione um Coordenador']
        );?>

    <?= $form->field($model, 'evento_idevento')->dropDownList(
            $arrayEventosAtivos,
            ['prompt'=>'Selecione um Evento']
    );?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar Coordenador' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
