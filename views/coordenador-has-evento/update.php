<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CoordenadorHasEvento */

$this->title = 'Editar Coordenador do Evento: ' . ' ' . $model->evento_idevento;
$this->params['breadcrumbs'][] = ['label' => 'Coordenador Has Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->evento_idevento, 'url' => ['view', 'id' => $model->evento_idevento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coordenador-has-evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
