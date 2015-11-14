<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;
use kartik\widgets\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'SGE';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="evento-index">
	
	<?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>
	
	<div id="page-wrapper">
		<?= Html::a(Html::img('@web/img/home_icomp.png', ['id'=>'homeICOMP'])) ?>
	</div>

</div>