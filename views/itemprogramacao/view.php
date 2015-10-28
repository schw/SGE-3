<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->iditemProgramacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->iditemProgramacao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que você quer excluir este item?',
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
            'cargaHoraria',
            'detalhe',
            'notificacao',
            'local_idlocal',
            'evento_idevento',
            'tipo_idtipo',
        ],
    ]) ?>

</div>
