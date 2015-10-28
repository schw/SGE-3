<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemprogramacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textArea(['maxlength' => '700', 'cols' => 25]) ?>

    <?= $form->field($model, 'palestrante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'dd-MM-yyyy',], 'dateFormat' => 'dd-MM-yyyy',]) ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'vagas')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'cargaHoraria')->textInput() ?>

    <?= $form->field($model, 'detalhe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notificacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'local_idlocal')->textInput() ?>

    <?php /* Html::activeDropDownList($model, 'local_idlocal',
      ArrayHelper::map(local::find()->all(), 'idlocal', 'descricao')) */?>

    <?= $form->field($model, 'evento_idevento')->dropDownList(ArrayHelper::map(\app\models\Evento::find()->all(),'idevento', 'descricao'),[ 'prompt' => '' ]) ?>

    <?= $form->field($model, 'tipo_idtipo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Finalizar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
