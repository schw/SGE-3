<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemProgramacaoHasPacote */

$this->title = $model->itemProgramacao_iditemProgramacao;
$this->params['breadcrumbs'][] = ['label' => 'Item Programacao Has Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-programacao-has-pacote-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'itemProgramacao_iditemProgramacao' => $model->itemProgramacao_iditemProgramacao, 'pacote_idpacote' => $model->pacote_idpacote], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'itemProgramacao_iditemProgramacao' => $model->itemProgramacao_iditemProgramacao, 'pacote_idpacote' => $model->pacote_idpacote], [
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
            'itemProgramacao_iditemProgramacao',
            'pacote_idpacote',
        ],
    ]) ?>

</div>
