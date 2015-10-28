<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Atualizar: ' . ' ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iditemProgramacao, 'url' => ['view', 'id' => $model->titulo]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="itemprogramacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
