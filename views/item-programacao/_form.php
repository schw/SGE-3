<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemprogramacao-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textArea(['maxlength' => '300', 'cols' => 25]) ?>

    <?= $form->field($model, 'palestrante')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'data')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'dd-MM-yyyy',], 'dateFormat' => 'dd-MM-yyyy',]) ?>

    <?= $form->field($model, 'data')->widget(DateControl::classname(), [
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


    <?= $form->field($model, 'hora')->widget(DateControl::classname(), [
    'language' => 'pt-BR',
    'type'=>DateControl::FORMAT_TIME,
    ]) ?>

    <?= $form->field($model, 'vagas')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'cargaHoraria')->textInput() ?>

    <?= $form->field($model, 'detalhe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'local_idlocal')->dropDownList(
            $arrayLocal,
            ['prompt'=>'Selecione um Local']
        );?>
    <p><?= Html::a('Mais Locais', ['local/index'], ['class' => 'btn btn-primary']); ?><p>

    <?php /* Html::activeDropDownList($model, 'local_idlocal',
      ArrayHelper::map(local::find()->all(), 'idlocal', 'descricao')) */?>

    <?php /*$form->field($model, 'evento_idevento')->dropDownList(ArrayHelper::map(\app\models\Evento::find()->all(),'idevento', 'descricao'),[ 'prompt' => '' ]) */?>

    <?php //$form->field($model, 'tipo_idtipo')->textInput() ?>

    <?= $form->field($model, 'tipo_idtipo')->dropDownList(
            $arrayTipo,
            ['prompt'=>'Selecione um Tipo']
    ); ?>
    <p><?= Html::a('Mais Tipos', ['tipo/index'], ['class' => 'btn btn-primary']); ?><p>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Finalizar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
