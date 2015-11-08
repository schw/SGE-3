<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemProgramacaoHasPacote */

$this->title = 'Update Item Programacao Has Pacote: ' . ' ' . $model->itemProgramacao_iditemProgramacao;
$this->params['breadcrumbs'][] = ['label' => 'Item Programacao Has Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->itemProgramacao_iditemProgramacao, 'url' => ['view', 'itemProgramacao_iditemProgramacao' => $model->itemProgramacao_iditemProgramacao, 'pacote_idpacote' => $model->pacote_idpacote]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-programacao-has-pacote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
