<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = 'Criar Evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p align="right">Campos marcados com * são Obrigatórios</p><div></div>

    <?= $this->render('_form', [
        'model' => $model,
        'arrayTipo' => $arrayTipo,
    ]) ?>

</div>
