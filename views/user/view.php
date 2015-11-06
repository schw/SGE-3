<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar Perfil', ['update', 'id' => $model->idusuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir Conta', ['delete', 'id' => $model->idusuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir sua conta?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idusuario',
            'nome',
            'senha',
            'cracha',
            'email:email',
            'instituicao',
            'tipoUsuario',
            'notificarViaEmail:email',
            'authKey',
            'accessToken',
        ],
    ]) ?>

</div>
