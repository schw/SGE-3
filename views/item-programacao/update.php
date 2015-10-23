<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Update Itemprogramacao: ' . ' ' . $model->iditemProgramacao;
$this->params['breadcrumbs'][] = ['label' => 'Itemprogramacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iditemProgramacao, 'url' => ['view', 'id' => $model->iditemProgramacao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="itemprogramacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
