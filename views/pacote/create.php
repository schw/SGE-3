<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pacote */

$this->title = 'Criar Pacote';
$this->params['breadcrumbs'][] = ['label' => 'Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacote-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
        'itensProgramacao' => $itensProgramacao,
    ]) ?>

</div>
