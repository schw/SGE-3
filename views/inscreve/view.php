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

        <?php $userId = Yii::$app->user->identity->idusuario;



        ?>

        <?= Html::a('inscrever', ['create', 'usuario_idusuario' => $userId, 'evento_idevento' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'usuario_idusuario' => $userId, 'evento_idevento' => $model->idevento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
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
