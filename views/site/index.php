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
	<?php
	
	echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Collapsible Group Item #1',
            'content' => 'Anim pariatur cliche...',
            // open its content by default
            
        ],
    /*    // another group item
        [
            'label' => 'Collapsible Group Item #1',
            'content' => 'Anim pariatur cliche...',
            
            
        ],
        // if you want to swap out .panel-body with .list-group, you may use the following
        [
            'label' => 'Collapsible Group Item #1',
            'content' => [
                'Anim pariatur cliche...',
                'Anim pariatur cliche...'
            ],
            
            
            'footer' => 'Footer' // the footer label in list-group
        ],*/
	    ]
	]);
	?>
	</div>

</div>