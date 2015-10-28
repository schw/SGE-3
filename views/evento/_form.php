<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => true, "size" => 10]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true, "size" => 40]) ?>

    <?= $form->field($model, 'dataIni')->widget(yii\jui\DatePicker::className(),['value' => date('dd-MM-yyy'), 'dateFormat' => 'dd-MM-yyyy']) ?>

    <?= $form->field($model, 'dataFim')->widget(yii\jui\DatePicker::className(),['value' => date('dd-MM-yyy'), 'dateFormat' => 'dd-MM-yyyy']) ?>

    <?= $form->field($model, 'horaIni')->textInput() ?>

    <?= $form->field($model, 'horaFim')->textInput() ?>

    <?= $form->field($model, 'vagas')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'cargaHoraria')->textInput() ?>

    <?= $form->field($model, 'imagem')->fileInput() ?>

    <?= $form->field($model, 'detalhe')->textArea(['maxlength' => true, 'cols' => 25]) ?>

    <?= $form->field($model, 'allow')->dropDownList(
            ['1' => 'Ativo', '0' => 'Inativo']
        ); ?>

    <?= $form->field($model, 'responsavel')->textInput(); ?>

    <?= $form->field($model, 'local_idlocal')->dropDownList(
            ['1' => 'Local 1', '2' => 'Local 2'],
            ['prompt'=>'Selecione um Local']
        );?>
        
    <?= $form->field($model, 'tipo_idtipo')->dropDownList(
            ['1' => 'Tipo 1', '2' => 'Tipo 2'],
            ['prompt'=>'Selecione um Tipo']
        ); ?>

    <?php /* Html::activeDropDownList($model, 'local_idlocal',
      ArrayHelper::map(local::find()->all(), 'idlocal', 'descricao')) */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Evento' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
