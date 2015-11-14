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
	<div class="navbar-default sidebar">
	            <?php
	            $heading = 'Opções';
	             echo SideNav::widget([
	                'type' => SideNav::TYPE_DEFAULT,
	                'encodeLabels' => false,
	                //'heading' => $heading,
	                'items' => [
	                    // Important: you need to specify url as 'controller/action',
	                    // not just as 'controller' even if default action is used.
	                    ['label' => 'Home', 'icon' => 'home', 'url' => ['site/index']],
	                    ['label' => 'Eventos', 'icon' => 'tags', 'items' => [
	                        ['label' => 'Eventos Ativos', 'url' => ['evento/gerenciareventos']],
	                        ['label' => 'Eventos Passados', 'url' => ['evento/gerenciareventos', 'status' => 'passado']],],],
	                    Yii::$app->user->isGuest ? ['label' => 'Cadastre-se', 'icon' => 'info-sign', 'url' => ['/user/create']] : ['label' => 'Perfil', 'icon' => 'user', 'url' => ['user/view']],
	                    Yii::$app->user->isGuest ? ['label' => 'Login', 'icon' => 'user', 'url' => ['site/login']] : ['label' => 'Minhas Inscrições', 'icon' => 'flag', 'url' => ['inscreve/index']],
	                   /* ['label' => 'Books', 'icon' => 'book', 'items' => [
	                        ['label' => '<span class="pull-right badge">10</span> New Arrivals', 'url' => Url::to(['/site/new-arrivals', 'type'=>SideNav::TYPE_DEFAULT])],
	                        ['label' => '<span class="pull-right badge">5</span> Most Popular', 'url' => Url::to(['/site/most-popular', 'type'=>SideNav::TYPE_DEFAULT])],
	                        ['label' => 'Read Online', 'icon' => 'cloud', 'items' => [
	                            ['label' => 'Online 1', 'url' => Url::to(['/site/online-1', 'type'=>SideNav::TYPE_DEFAULT])],
	                            ['label' => 'Online 2', 'url' => Url::to(['/site/online-2', 'type'=>SideNav::TYPE_DEFAULT])]
	                        ]],
	                    ]],*/
	                    //['label' => 'Profile', 'icon' => 'user', 'url' => Url::to(['/site/profile', 'type'=>SideNav::TYPE_DEFAULT])],
	                    ],
	                ]);        
	            ?>
	       </div>
	<div id="page-wrapper">
		<?= Html::a(Html::img('@web/img/home_icomp.png', ['id'=>'homeICOMP'])) ?>
	</div>

</div>