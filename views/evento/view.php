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

    <p> <?php if(Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2){ ?>
        <?= Html::a('Alterar', ['update', 'id' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->idevento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja remover o evento "'.$model->descricao.'" ?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
        
        <?php 
        if(Yii::$app->user->identity->tipoUsuario == 3){
            echo Html::a('Inscreva-se', ['inscreve/inscrever'], [
                'class' => 'btn btn-primary',
                'data'=>[
                'method' => 'POST',
                'params'=>['usuario_idusuario' => $model->responsavel, 'evento_idevento' => $model->idevento],
            ]
        ]);
        }
        ?>

        <?= Html::a('Pacotes', ['pacote/index', 'idevento' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Programação', ['item-programacao/index', 'id' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        

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
            'detalhe',
            'tipo.titulo',
            'local.descricao',
        ],
    ]) ?>
    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2)){ ?>
    <h2>QRCode <?= $model->descricao ?></h2>
    <?= Html::img('plugins/getQRCode.php?conteudo_QRCODE='.$model->idevento, ['alt' => 'QRCode', 'id' => 'imgqrcode']) ?>
    <?php } ?>
</div>
