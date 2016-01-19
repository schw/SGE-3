<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Voluntario */

$this->title = "Detalhes Voluntário";
$this->params['breadcrumbs'][] = ['label' => 'Voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voluntario-view">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
        <div id="geral" class="diviconegeral">
            <div id="titulo" style= "float: left;">
                <h1><?= $this->title ?></h1>
            </div>
            <a href="javascript:window.history.go(-1)">
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/voltar.png', ['class' => 'imgicone'])?>
                    <p class="labelicone">Voltar</p>
                </div>
            </a>
            <a href=<?= Url::to(['update', 'id' => $model->idvoluntario])?>>
                <div class="divicone divicone-l2">
                    <?= Html::img('@web/img/editar.png', ['class' => 'imgicone'])?>
                    <p>Atualizar Voluntário</p>
                </div>
            </a>
            <div class="divicone divicone-l2">
                <?= Html::a(Html::img('@web/img/delete.png'), ['delete', 'id' => $model->idvoluntario], [
                    'data' => [
                        'confirm' => 'Deseja Remover \''.$model->nome.'\'?',
                        'method' => 'post',
                    ],
               ]) ?>
                <?= Html::a('Remover Voluntário', ['delete', 'id' => $model->idvoluntario], [
                    'data' => [
                        'confirm' => 'Deseja Remover \''.$model->nome.'\'?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idvoluntario',
            'nome',
            'email:email',
            'cracha',
            'instituicao',
        ],
    ]) ?>

</div>
