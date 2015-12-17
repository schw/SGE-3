<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pacote */

$this->title = 'Criar Pacote';
$this->params['breadcrumbs'][] = ['label' => 'Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacote-create">

	<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
    <h1><?= Html::encode($this->title) ?></h1>
    <p align="right">Campos marcados com * são Obrigatórios</p><div></div>
    
    <?= $this->render('_form', [
        'model' => $model,
        'itensProgramacao' => $itensProgramacao,
    ]) ?>

</div>
