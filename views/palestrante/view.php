<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Palestrante */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Palestrantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="palestrante-view">

<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Atualizar', ['update', 'id' => $model->idPalestrante], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Excluir', ['delete', 'id' => $model->idPalestrante], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Deseja Remover \''.$model->nome.'\'?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nome',
                'email:email',
            ],
        ]) ?>
    </div>

</div>
