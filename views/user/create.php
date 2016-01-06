<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Novo Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->senha = "";
$model->senha_repeat="";
?>
<div class="user-create">

	<?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>
    
    <div id="page-wrapper">
	    <h1><?= Html::encode($this->title) ?></h1>
	    <p align="right">Campos marcados com * são obrigatórios</p><div></div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
    </div>

</div>
