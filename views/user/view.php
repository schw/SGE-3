<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->notificarViaEmail = $model->notificarViaEmail ? "Sim" : "Não";
?>
<div class="user-view">

 <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <div id="page-wrapper">
    <h1><?= Html::encode($this->title) ?></h1>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario != 1){?>
        <p>
            <?= Html::a('Atualizar Perfil', ['update', 'id' => $model->idusuario], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Excluir Conta', ['delete', 'id' => $model->idusuario], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Deseja realmente excluir sua conta?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?php } ?>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'idusuario',
                'nome',
                //'senha',
                'cracha',
                'email:email',
                'instituicao',
                'descricaotipousuario',
                'notificarViaEmail',
            ],
        ]) ?>
    </div>

</div>
