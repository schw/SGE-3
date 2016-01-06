<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;

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
    'value' => $model->horaFim, 
    'type'=>DateControl::FORMAT_TIME,
    ]) ?>

    <?= $model->horaFim ?>

    <?= $form->field($model, 'vagas')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'cargaHoraria')->textInput(['type' => 'number'])?>

    <?= $form->field($model, 'imagem2')->fileInput() ?>

    <?= $form->field($model, 'detalhe')->textArea(['maxlength' => true, 'cols' => 25]) ?>

    <?= $form->field($model, 'palestrante_idPalestrante')->widget(Select2::classname(), [
        'data' => $arrayPalestrante,
        'options' => ['placeholder' => 'Selecione um palestrante ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <p><?= Html::a('Mais Palestrantes', ['palestrante/index'], ['class' => 'btn btn-primary']); ?><p>

    <?= $form->field($model, 'local_idlocal')->widget(Select2::classname(), [
        'data' => $arrayLocal,
        'options' => ['placeholder' => 'Selecione um Local ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <p><?= Html::a('Mais Locais', ['local/index'], ['class' => 'btn btn-primary']); ?><p>

    <?= $form->field($model, 'tipo_idtipo')->widget(Select2::classname(), [
        'data' => $arrayTipo,
        'options' => ['placeholder' => 'Selecione um Tipo ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <p><?= Html::a('Mais Tipos', ['tipo/index'], ['class' => 'btn btn-primary']); ?><p>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Evento' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
