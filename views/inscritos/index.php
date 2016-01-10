<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
 
 $this->title = "Lista de Inscritos";
?>

<div class="inscritos-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
      <div id="page-wrapper">
    <div id="geral" class = "diviconegeral" style="width: 100%; text-align: center;">
        <div id="titulo" style= "float: left">
            <label><strong><h1> Lista de Inscritos </h1></strong></label>
        </div>

        <div class="divicone" >
            <?php 
                $id_evento = Yii::$app->request->get('evento_idevento');       
                echo Html::a(Html::img('@web/img/listainscritos.png'), ['inscritos/listainscritospdf','evento_idevento' => $id_evento], ['target' =>'_blank','width' => '10']) 
            ?>
            <div style="width: 90px; text-align:center;">
                <?php echo Html::a('Gerar Lista (PDF)', ['inscritos/listainscritospdf', 'evento_idevento' => $id_evento],['target' =>'_blank']); ?>
            </div>
        </div>
    </div>

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
