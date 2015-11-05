<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inscreve */

$this->title = $model->usuario_idusuario;
$this->params['breadcrumbs'][] = ['label' => 'Inscreves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscreve-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'usuario_idusuario' => $model->usuario_idusuario, 'evento_idevento' => $model->evento_idevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'usuario_idusuario' => $model->usuario_idusuario, 'evento_idevento' => $model->evento_idevento], [
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
            'usuario_idusuario',
            'evento_idevento',
            'credenciado',
            'pacote_idpacote',
        ],
    ]) ?>

</div>
