<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = $model->iditemProgramacao;
$this->params['breadcrumbs'][] = ['label' => 'Itemprogramacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->iditemProgramacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->iditemProgramacao], [
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
            //'iditemProgramacao',
            'titulo',
            'descricao',
            'palestrante',
            'data',
            'hora',
            'vagas',
            'cagaHoraria',
            'detalhe',
            'notificacao',
            'local_idlocal',
            'evento_idevento',
            'tipo_idtipo',
        ],
    ]) ?>

</div>
