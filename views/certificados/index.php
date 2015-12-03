<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
?>

<script>
function myFunctionCredenciado(tipousuario) {
    var keys = $('#gridview_id_credenciados').yiiGridView('getSelectedRows');
            //console.table(keys, ['usuario_idusuario', 'evento_idevento']);
            //console.log(JSON.stringify(keys));
            //keys = JSON.stringify(keys);
    var ids = [];
    
    var id_evento;

    if (Object.keys(keys).length > 0){

        id_evento = keys[0].evento_idevento;

        for (var i=0 ; i<Object.keys(keys).length ; i++){

                ids[i] = keys[i].usuario_idusuario;
       
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              //document.getElementById("demo").innerHTML = ;
              window.open("index.php?r=certificados/pdfcredenciados&tipousuario="+tipousuario+"&evento_idevento="+id_evento+"&ids="+xhttp.responseText);
              
           }
        };
      
      xhttp.open("GET", "index.php?r=certificados/idsusuarios&ids="+ids, true);
      xhttp.send();
    }
    else{
        alert("não há certificados");
    }

}

function myFunctionPalestrantes(tipousuario) {
    var keys = $('#gridview_id_palestrantes').yiiGridView('getSelectedRows');
            //console.table(keys, ['usuario_idusuario', 'evento_idevento']);
            //console.log(JSON.stringify(keys));
            //keys = JSON.stringify(keys);
    var ids = [];
    
    var id_evento;

    if (Object.keys(keys).length > 0){

        id_evento = keys[0].evento_idevento;

        for (var i=0 ; i<Object.keys(keys).length ; i++){

                ids[i] = keys[i].usuario_idusuario;
       
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              //document.getElementById("demo").innerHTML = ;
              window.open("index.php?r=certificados/pdfpalestrantes&tipousuario="+tipousuario+"&evento_idevento="+id_evento+"&ids="+xhttp.responseText);
              
           }
        };
      
      xhttp.open("GET", "index.php?r=certificados/idsusuarios&ids="+ids, true);
      xhttp.send();
    }
    else{
        alert("não há certificados");
    }

}

function myFunctionVoluntarios(tipousuario) {
    var keys = $('#gridview_id_voluntarios').yiiGridView('getSelectedRows');
            //console.table(keys, ['usuario_idusuario', 'evento_idevento']);
            console.log(JSON.stringify(keys));
            //keys = JSON.stringify(keys);
    var ids = [];
    
    var id_evento;

    if (Object.keys(keys).length > 0){

        id_evento = keys[0].evento_idevento;

        for (var i=0 ; i<Object.keys(keys).length ; i++){

                ids[i] = keys[i].voluntario_idvoluntario;
       
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              //document.getElementById("demo").innerHTML = ;
              window.open("index.php?r=certificados/pdfvoluntarios&tipousuario="+tipousuario+"&evento_idevento="+id_evento+"&ids="+xhttp.responseText);
              
           }
        };
      
      xhttp.open("GET", "index.php?r=certificados/idsusuarios&ids="+ids, true);
      xhttp.send();
    }
    else{
        alert("não há certificados");
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

    <p>
    	</br><h4> Lista de credenciadados:</h4>
	</p>

<?php $id_evento = Yii::$app->request->post('evento_idevento'); ?>


<?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        'summary' => '',
        'options' => ['id' => 'gridview_id_credenciados'],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn','headerOptions' => ['width' => '35'] ],
            ['attribute' => 'Participante', 'value' => 'usuario.nome'],
            //'itemProgramacao.palestrante',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '100'], 
            'template' => '{imprimir} {link}','buttons' => [
                'imprimir' => function ($url,$model,$key) {

                		$id_evento = Yii::$app->request->post('evento_idevento');

                        return Html::a('<span class="glyphicon glyphicon-print"></span>', ['inscreve/pdf'], ['target' => 'blank',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $model->usuario->nome, 'tipousuario_certificado' => 0],
                            ]]);
                },
        ],
],
     ],
 ]); ?>

<?php 
        $model = $dataProvider->getModels();

        $count = $dataProvider->getCount();

        $i = 0;
        while($i<$count){
            $nome[$i] = $model[$i]->usuario->nome;
            $i++;
        }

        if ($count > 0){

            echo '<button onclick="myFunctionCredenciado(0)">Gerar Certificados</button>';

           //echo Html::a('Gerar Certificado em Lote', ['certificados/pdf'], ['target' => 'blank',
           //                     'data'=>[
           //                     'method' => 'POST',
           //                     'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $nome, 'tipousuario_certificado' => 1],
           //                         ]]);
        }

 ?>


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
            //['attribute' => 'Participante', 'value' => 'usuario.nome'],
            'palestrante',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '100'], 
            'template' => '{imprimir} {link}','buttons' => [
                'imprimir' => function ($url,$model,$key) {

                        $id_evento = Yii::$app->request->post('evento_idevento');

                        return Html::a('<span class="glyphicon glyphicon-print"></span>', ['inscreve/pdf'], ['target' => 'blank',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $model->palestrante],
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
            $nome2[$i] = $model2[$i]->palestrante;
            $i++;
        }

        if ($count2 > 0){

            echo '<button onclick="myFunctionPalestrantes(1)">Gerar Certificados</button>';

           //echo Html::a('Gerar Certificado em lote', ['certificados/pdf'], ['target' => 'blank',
           //                     'data'=>[
           //                    'method' => 'POST',
           //                     'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $nome2, 'tipousuario_certificado' => 2],
           //                         ]]);
        }

 ?>

    <p>
        <h4> Lista de Voluntários:</h4>
    </p>

 <?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider3,
        'summary' => '',
        'options' => ['id' => 'gridview_id_voluntarios'],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn','headerOptions' => ['width' => '35'] ],
            //['attribute' => 'Participante', 'value' => 'usuario.nome'],
            'voluntario.nome',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '100'], 
            'template' => '{imprimir} {link}','buttons' => [
                'imprimir' => function ($url,$model,$key) {

                        $id_evento = Yii::$app->request->post('evento_idevento');

                        return Html::a('<span class="glyphicon glyphicon-print"></span>', ['inscreve/pdf'], ['target' => 'blank',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $model->voluntario->nome],
                            ]]);
                },
        ],
],
     ],
 ]); ?>




<?php 
        $model3 = $dataProvider3->getModels();
        $count3 = $dataProvider3->getCount();

        $i = 0;
        while($i<$count3){
            $nome3[$i] = $model3[$i]->voluntario->nome;
            $i++;
        }

        if ($count3 > 0){

            echo '<button onclick="myFunctionVoluntarios(2)">Gerar Certificados</button>';

          //echo Html::a('Gerar Certificado em lote', ['certificados/pdf'], ['target' => 'blank',
          //                      'data'=>[
          //                      'method' => 'POST',
          //                      'params'=>['evento_idevento' => $id_evento, 'usuario_certificado' => $nome3, 'tipousuario_certificado' => 3],
          //                         ]]);
        }

 ?>

</div>