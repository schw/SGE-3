<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Palestrante */

$this->title = 'Editar Palestrante';
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
    </div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
    </div>

</div>
