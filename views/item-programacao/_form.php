<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemprogramacao-form">
DATA: <?= $model->hora ?><br>
HORA: <?= $model->data ?><br>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textArea(['maxlength' => '300', 'cols' => 25]) ?>

    <?= $form->field($model, 'vagas')->textInput(['type' => 'number']) ?>
    
    <?= $form->field($model, 'cargaHoraria')->textInput(['type' => 'number']) ?>

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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Finalizar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
