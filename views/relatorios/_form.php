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

<div style='float: left ;margin-left: 10%; margin: 0 0 5% 10%;'>
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
</div>
<div style='float: left ;margin-left: 10%; margin: 0 0 5% 10%;'>

<?php echo $form->field($model, 'datafim')->widget(DateControl::classname(), [
    'language' => 'pt-BR',
    'type' => DateControl::FORMAT_DATE,
    //'autoWidget' => $config->autoWidget,
    //'widgetClass' => $config->widgetClass,
   'displayFormat' => 'php:d-F-Y' 
    // display as 'php:d-F-Y' or 'php:d-F-Y H:i:s'
    //'saveOptions' => $saveOptions,
    //'options' => $options
]);?>

</div>

<?= Html::submitButton('relatorios') ?>

    <?php ActiveForm::end(); ?>

</div>
