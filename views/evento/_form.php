<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => true, "size" => 10]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true, "size" => 40]) ?>

    <?= $form->field($model, 'dataIni')->widget(DateControl::classname(), [
    //'language' => $config->language,
    'type' => DateControl::FORMAT_DATE,
    'language' => 'pt-BR',
    //'autoWidget' => $config->autoWidget,
    //'widgetClass' => $config->widgetClass,
    'displayFormat' => 'php:d-F-Y' 
    // display as 'php:d-F-Y' or 'php:d-F-Y H:i:s'
    //'saveOptions' => $saveOptions,
    //'options' => $options
    ]) ?>

    <?= $form->field($model, 'dataFim')->widget(DateControl::classname(), [
    'language' => 'pt-BR',
    'type' => DateControl::FORMAT_DATE,
    //'autoWidget' => $config->autoWidget,
    //'widgetClass' => $config->widgetClass,
    'displayFormat' => 'php:d-F-Y' 
    // display as 'php:d-F-Y' or 'php:d-F-Y H:i:s'
    //'saveOptions' => $saveOptions,
    //'options' => $options
    ]) ?>

    <?= $form->field($model, 'horaIni')->widget(DateControl::classname(), [
    'language' => 'pt-BR',
    'type'=>DateControl::FORMAT_TIME,
    ]) ?>

    <?= $form->field($model, 'horaFim')->widget(DateControl::classname(), [
    'language' => 'pt-BR',
    'type'=>DateControl::FORMAT_TIME,
    ]) ?>

    <?= $form->field($model, 'vagas')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'cargaHoraria')->textInput() ?>

    <?= $form->field($model, 'imagem')->fileInput() ?>

    <?= $form->field($model, 'detalhe')->textArea(['maxlength' => true, 'cols' => 25]) ?>

    <?= $form->field($model, 'local_idlocal')->dropDownList(
            $arrayLocal,
            ['prompt'=>'Selecione um Local']
        );?>
    <p><?= Html::a('Mais Locais', ['local/index'], ['class' => 'btn btn-primary']); ?><p>
    
    <?= $form->field($model, 'tipo_idtipo')->dropDownList(
            $arrayTipo,
            ['prompt'=>'Selecione um Tipo']
        ); ?>
    <p><?= Html::a('Mais Tipos', ['tipo/index'], ['class' => 'btn btn-primary']); ?><p>


    <?php /* Html::activeDropDownList($model, 'local_idlocal',
      ArrayHelper::map(local::find()->all(), 'idlocal', 'descricao')) */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Evento' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
