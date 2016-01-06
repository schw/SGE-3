<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Palestrante */

$this->title = 'Editar Palestrante: ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Palestrantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPalestrante, 'url' => ['view', 'id' => $model->idPalestrante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="palestrante-update">

	<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">

    <h1><?= Html::encode($this->title) ?></h1>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
    </div>

</div>
