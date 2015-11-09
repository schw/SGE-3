<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inscreve */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Inscreves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscreve-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>


        <?php //echo Html::a('inscrever', ['inscrever', 'usuario_idusuario' => $model->responsavel, 'evento_idevento' => $model->idevento], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Programação', ['programacao', 'id' => $model->idevento], ['class' => 'btn btn-primary']) ?>


        <?= Html::a('inscrever', ['inscrever'], [
                'class' => 'btn btn-primary',
                'data'=>[
                'method' => 'POST',
                'params'=>['usuario_idusuario' => $model->responsavel, 'evento_idevento' => $model->idevento],
            ]
        ]) ?>


        <?= Html::a('cancelar inscrição', ['cancelar'], [
                'class' => 'btn btn-danger',
                'data'=>[
                'method' => 'POST',
                'params'=>['usuario_idusuario' => $model->responsavel, 'evento_idevento' => $model->idevento],
            ]
        ]) ?>


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
            'detalhe',
            'tipo.titulo',
            'local.descricao',
        ],
    ]) ?>


<?php 
    /* antigo:
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

fim do antigo*/
?>
</div>
