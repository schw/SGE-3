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

    <?php if(Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2){ ?>
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
            'palestrante.nome',
            'data',
            'hora',
            'vagas',
            'cargaHoraria',
            'local.descricao',
            'evento.descricao',
            'tipo.titulo',
        ],
    ]) ?>
</div>
