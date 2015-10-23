<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idevento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente remover este evento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sigla',
            'descricao',
            'dataIni',
            'dataFim',
            'horaIni',
            'horaFim',
            'vagas',
            'cargaHoraria',
            'imagem',
            'detalhe',
            'allow',
            'responsavel',
            'tipo_idtipo',
            'local_idlocal',
        ],
    ]) ?>

</div>
