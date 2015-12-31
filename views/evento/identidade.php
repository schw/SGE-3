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

    <?php $form = ActiveForm::begin(['id' => 'xxxx','options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'imagem')->fileInput() ?>
    
    <div class="form-group">
        <?php //echo Html::submitButton('Salva e Prever', ['class' => 'btn btn-primary']) ?>

<?php echo Html::submitButton('Salvar', ['name' => 'frag']); ?>

<?= Html::SubmitButton('Salvar e Visualizar', ['class' => 'btn btn-primary']); ?>



    </div>
	
	<?php ActiveForm::end(); ?>

</div>