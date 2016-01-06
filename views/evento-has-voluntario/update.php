<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EventoHasVoluntario */

$this->title = 'Editar Evento Has Voluntario: ' . ' ' . $model->evento_idevento;
$this->params['breadcrumbs'][] = ['label' => 'Evento Has Voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->evento_idevento, 'url' => ['view', 'evento_idevento' => $model->evento_idevento, 'voluntario_idvoluntario' => $model->voluntario_idvoluntario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evento-has-voluntario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
