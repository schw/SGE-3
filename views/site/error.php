<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;

$this->title = $name;
?>
<div class="site-error">
    
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

    <div id="page-wrapper">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Verifique a url.
    </p>
    </div>

</div>
