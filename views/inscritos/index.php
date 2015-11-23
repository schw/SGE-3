<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;

?>

<div class="inscritos-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">

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
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '80'], 
            'template' => '{view}{credenciar}{descredenciar}{link}','buttons' => [
                'credenciar' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', ['inscritos/credenciar'],[
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['idusuario' => $model->usuario->idusuario,'evento_idevento' => $model->evento->idevento],
                            ]]);
                },
                'descredenciar' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-remove"></span>', ['inscritos/descredenciar'],[
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['idusuario' => $model->usuario->idusuario,'evento_idevento' => $model->evento->idevento],
                            ]]);
                },
                'view' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['user/view'],[
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['id' => $model->usuario->idusuario],
                            ]]);
                },
        ],
],
     ],
 ]); ?>

 </div>
