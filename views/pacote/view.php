<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pacote */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacote-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->idpacote], ['class' => 'btn btn-primary',]) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->idpacote], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja remover o pacote "'.$model->descricao.'" ?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Pacotes', ['index', 'idevento' => $model->evento_idevento], ['class' => 'btn btn-primary',]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idpacote',
            'titulo',
            'descricao',
            'valor',
            'status',
            'evento_idevento',
        ],
    ]) ?>

    <h1><?= Html::encode('Itens de Programação') ?></h1>

</div>
