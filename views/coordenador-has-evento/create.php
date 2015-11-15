<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CoordenadorHasEvento */

$this->title = 'Create Coordenador Has Evento';
$this->params['breadcrumbs'][] = ['label' => 'Coordenador Has Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordenador-has-evento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
