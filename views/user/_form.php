<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'senha')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'senha_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cracha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instituicao')->textInput(['maxlength' => true, 'visible' => false]) ?>

    <?php //echo $form->field($model, 'tipoUsuario')->textInput() ?>

    <?= $form->field($model, 'notificarViaEmail')->dropDownList(
            ['0' => 'Não', '1' => 'Sim']
    );?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Usuário' : 'Alterar Perfil', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
