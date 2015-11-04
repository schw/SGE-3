<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = 'Update Evento: ' . ' ' . $model->idevento;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idevento, 'url' => ['view', 'id' => $model->idevento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrayTipo' => $arrayTipo,
        'arrayLocal' => $arrayLocal,	
    ]) ?>

</div>
