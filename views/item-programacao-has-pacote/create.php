<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemProgramacaoHasPacote */

$this->title = 'Create Item Programacao Has Pacote';
$this->params['breadcrumbs'][] = ['label' => 'Item Programacao Has Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-programacao-has-pacote-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
