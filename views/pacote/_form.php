<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Pacote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pacote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'itens')->widget(Select2::classname(), [
    	'data' => $itensProgramacao,
    	'value' => 'itens',
    	'language' => 'pt-BR',
    	'options' => ['placeholder' => 'Selecione os Itens de Programação ...', 'multiple' => true,],
    	'pluginOptions' => [
        	'allowClear' => true
    	],
	]);

	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Pacote' : 'Atualizar Pacote', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
