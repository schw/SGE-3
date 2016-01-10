<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\helpers\Url;
 
 $this->title = "Lista de Inscritos";
?>

<div class="inscritos-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
      <div id="page-wrapper">
        <div id="geral" class="diviconegeral">
            <div id="titulo" style= "float: left;">
                    <h1><?= $this->title ?></h1>
            </div>
            <a href=<?= Url::to(['evento/view', 'id' => $evento['idevento']])?>>
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/voltar.png', ['class' => 'imgicone'])?>
                    <p class="labelicone">Voltar</p>
                </div>
            </a>
            <a href=<?= Url::to(['inscritos/listainscritospdf','evento_idevento' => $evento['idevento']])?> target="_blank">
                <div class="divicone divicone-l2">
                    <?= Html::img('@web/img/listainscritos.png', ['class' => 'imgicone'])?>
                    <p>Gerar Lista (PDF)</p>
                </div>
            </a>
        </div>
        <h2><?= $evento['descricao']?></h2>

    <?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'Participante', 'value' => 'usuario.nome'],
            ['attribute' =>'Pacote', 'value'=> 
                function ($data){

                    if($data->pacote_idpacote == null){
                        return "-----";
                    }
                    else{
                        return $data->pacote->titulo;
                    }
                }
            ],
            ['attribute' =>'dataInscricao', 'value'=> 
                function ($data){
                    return date("d-m-Y", strtotime($data->dataInscricao));
                }
            ],
            ['attribute' => 'credenciado', 'value' => 
            function ($data){
                if ($data->credenciado){
                    return 'Sim';
                }else{
                    return 'Não';
                }
            },],
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '90'], 
            'template' => '{view} {credenciar} {descredenciar} {cancelarinscricao}{link}','buttons' => [
                'credenciar' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', ['inscritos/credenciar'],[
                            'title'=> 'Credenciar',
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['idusuario' => $model->usuario->idusuario,'evento_idevento' => $model->evento->idevento],
                            ]]);
                },
                'descredenciar' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-remove"></span>', ['inscritos/descredenciar'],[
                            'title'=> 'Descredenciar',
                            'data'=>[
                            'confirm' => 'Deseja descredenciar este participante: "'.$model->usuario->nome.'" ?',
                            'method' => 'POST',
                            'params'=>['idusuario' => $model->usuario->idusuario,'evento_idevento' => $model->evento->idevento],
                            ]]);
                },
                'view' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['user/view'],[
                            'title'=> 'Visualizar Detalhes do Participante',
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['id' => $model->usuario->idusuario],
                            ]]);
                },
                'cancelarinscricao' => function ($url,$model,$key) {
                          return Html::a('<span class="glyphicon glyphicon-remove-sign"></span>',['inscritos/cancelar'],[
                            'title'=> 'Cancelar Incrição',
                            'data'=>[
                            'confirm' => 'Deseja cancelar a inscrição deste participante: "'.$model->usuario->nome.'" ?',
                            'method' => 'POST',
                            'params'=>['idusuario' => $model->usuario->idusuario,'evento_idevento' => $model->evento->idevento],
                            ]]);
                },
        ],
],
     ],
 ]); ?>
 </div>

 </div>
