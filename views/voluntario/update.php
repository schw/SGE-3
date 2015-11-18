<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Voluntario */

$this->title = 'Voluntario: ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idvoluntario, 'url' => ['view', 'id' => $model->idvoluntario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="voluntario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
