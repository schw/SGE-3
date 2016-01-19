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

    <?php if(!Yii::$app->user->isGuest && $evento->canAccess()){ ?>
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->iditemProgramacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->iditemProgramacao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que você quer excluir o item \''.$model->titulo.'\' ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php 
    }?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'descricao',
            'evento.descricao',
            'palestrante.nome',
            'dataformat',
            'horaini',
            'horafim',
            'vagas',
            'cargahoraria',
            'local.descricao',
            'tipo.titulo',
        ],
    ]) ?>
</div>
