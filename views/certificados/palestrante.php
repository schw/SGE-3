<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
?>

<script>

function myFunctionPalestrantes(tipousuario,id_evento) {
    var keys = $('#gridview_id_palestrantes').yiiGridView('getSelectedRows');
    
    if (Object.keys(keys).length > 0){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

              window.open("index.php?r=certificados/pdfpalestrantes&tipousuario="+tipousuario+"&evento_idevento="+id_evento+"&ids="+xhttp.responseText);
              
           }
        };
      
      xhttp.open("GET", "index.php?r=certificados/idsusuarios&ids="+keys, true);
      xhttp.send();
    }
    else{
        alert("Selecione pelo menos um Palestrante.");
    }

}

</script>

<div id="myformcontainer"></div>
<div class="inscritos-index">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">

    <h1>Gerar Certificados</h1>

<?php $id_evento = Yii::$app->request->post('evento_idevento'); ?>

    <p>
        <h4> Lista de Palestrantes:</h4>
    </p>

<?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider2,
        'summary' => '',
        'options' => ['id' => 'gridview_id_palestrantes'],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn','headerOptions' => ['width' => '35'] ],
            ['attribute' => 'Palestrante', 'value' => 'nome'],
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '100'], 
            'template' => '{imprimir} {link}','buttons' => [
                'imprimir' => function ($url,$model,$key) {

                        $id_evento = Yii::$app->request->post('evento_idevento');

//                        var_dump($model->nome);
//                        exit();

                        return Html::a('<span class="glyphicon glyphicon-print"></span>', ['inscreve/pdf'], ['target' => 'blank',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $model->nome],
                            ]]);
                },
        ],
],
     ],
 ]); ?>

<?php 
        $model2 = $dataProvider2->getModels();
        $count2 = $dataProvider2->getCount();

        $i = 0;
        while($i<$count2){
            $nome2[$i] = $model2[$i]->nome;
            $i++;
        }

        if ($count2 > 0){

            echo Html::submitButton('Gerar Certificado', ['onclick' => 'myFunctionPalestrantes(1,'.$id_evento.')' ,
                'class' => 'btn btn-success']);

           //echo Html::a('Gerar Certificado em lote', ['certificados/pdf'], ['target' => 'blank',
           //                     'data'=>[
           //                    'method' => 'POST',
           //                     'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $nome2, 'tipousuario_certificado' => 2],
           //                         ]]);
        }

 ?>
 </div>
</div>