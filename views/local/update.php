<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Local */

$this->title = 'Update Local: ' . ' ' . $model->idlocal;
$this->params['breadcrumbs'][] = ['label' => 'Locals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlocal, 'url' => ['view', 'id' => $model->idlocal]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="local-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
