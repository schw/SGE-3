<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="../web/js/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap;
use kartik\widgets\Growl;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscreveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Quantidade de Inscritos por Evento';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="inscreve-index">

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
        <a href=<?= Url::to(['relatorios/index'])?>>
            <div class="divicone divicone-l1">
                <?= Html::img('@web/img/voltar.png', ['class' => 'imgicone'])?>
                <p class="labelicone">Voltar</p>
            </div>
        </a>
        <div class="clear"></div>
    </div>

<br>

<?php  
    $qtd_rows = count($model); 
    
    if($qtd_rows > 0){    
?>
    <div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Sigla do Evento</th>
                <th style= "text-align: center">Quantidade de Inscrições</th>
            </tr>
        </thead>

    <?php 

        for ($i = 0; $i<$qtd_rows; $i++){
            $coordenador = $model[$i]->sigla;
            $qtd_evento = $model[$i]->qtd_evento;

            echo '<tr>
                <td>'.($i+1).'</td>
                <td>'.$coordenador.'</td>
                <td align = "center">'.$qtd_evento.'</td>
                </tr>';
        }
            echo '</table></div>';
    }
    else{
            echo '<div style= "text-align: center; font-weight: bold;"> Não há registros </div>';
        }
    ?>

</div>

</div>
