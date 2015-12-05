<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Adicionar Programação';
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-create">

    <?= $this->render('_form', [
        'model' => $model,
        'arrayTipo' => $arrayTipo,
        'arrayLocal' => $arrayLocal,
        'arrayPalestrante' => $arrayPalestrante,
    ]) ?>

</div>
