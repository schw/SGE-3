<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Adicionar Programação';
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p align="right">Campos marcados com * são Obrigatórios</p><div></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
