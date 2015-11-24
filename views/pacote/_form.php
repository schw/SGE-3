<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Pacote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pacote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->widget(MaskMoney::classname(), [
    'pluginOptions' => [
        'prefix' => 'R$ ',
        'thousands' => '.',
        'decimal' => ',',
        'allowNegative' => false
    ]
    ]) 
    ?>

    <?= $form->field($model, 'itens')->widget(Select2::classname(), [
    	'data' => $itensProgramacao,
    	'value' => $model->itens,
    	'language' => 'pt-BR',
    	'options' => ['placeholder' => 'Selecione os Itens de Programação ...', 'multiple' => true,],
	]);

	?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Pacote' : 'Atualizar Pacote', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
