<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = 'Novo Evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="evento-create">
	
	<?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

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
        'arrayTipo' => $arrayTipo,
        'arrayLocal' => $arrayLocal,
        'arrayPalestrante' => $arrayPalestrante,
    ]) ?>
</div>

</div>
