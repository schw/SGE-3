<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;

?>

<h1>Lista de Inscritos</h1>


<?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'Participante', 'value' => 'usuario.nome'],
            ['attribute' => 'credenciado', 'value' => 
            function ($data){
                if ($data->credenciado){
                    return 'Sim';
                }else{
                    return 'Não';
                }
            },],
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '20'], 
            'template' => '{view}{link}','buttons' => [
                'view' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'index.php?r=evento/view&id='.$model->evento_idevento);
                },
        ],
],
     ],
 ]); ?>


<?= LinkPager::widget(['pagination' => $pagination]) ?>