<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;
use kartik\widgets\AlertBlock;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'SGE';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="evento-index">
	
	<?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>
	
	<div id="page-wrapper">
        <h1>Eventos Ativos</h1>
        <?php
        	echo Collapse::widget([
                'id' => 'eventosativoscollapse',
                'items' => $eventos
    	    ]);
    	?>
	</div>
</div>