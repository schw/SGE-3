<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pacote */

$this->title = 'Editar Pacote: ' . ' ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpacote, 'url' => ['view', 'id' => $model->idpacote]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pacote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itensProgramacao' => $itensProgramacao,
    ]) ?>

</div>
