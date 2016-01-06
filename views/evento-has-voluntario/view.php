<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EventoHasVoluntario */

$this->title = $model->evento_idevento;
$this->params['breadcrumbs'][] = ['label' => 'Evento Has Voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-has-voluntario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'evento_idevento' => $model->evento_idevento, 'voluntario_idvoluntario' => $model->voluntario_idvoluntario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'evento_idevento' => $model->evento_idevento, 'voluntario_idvoluntario' => $model->voluntario_idvoluntario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'evento_idevento',
            'voluntario_idvoluntario',
        ],
    ]) ?>

</div>
