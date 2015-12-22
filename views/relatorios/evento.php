<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap;
use kartik\widgets\Growl;

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

    <div id="geral" style="width: 100%; text-align: center;">
        <div id="titulo" style= "text-align: left">
            <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
        </div>

    </div>

<br>

<?php  
    $qtd_rows = count($model); 
    
    if($qtd_rows > 0){    
?>
    <table border="1" style= "text-align: left  ">
        <tr>
            <th style= "text-align: center" width = "40px" >#</th>
            <th style= "text-align: center" width = "250px" >Sigla do Evento</th>
            <th style= "text-align: center" width = "300px">Quantidade de Inscrições</th>
        </tr>

    <?php 

        for ($i = 0; $i<$qtd_rows; $i++){
            $coordenador = $model[$i]->sigla;
            $qtd_evento = $model[$i]->qtd_evento;

            echo '<tr>
                <td style= "text-align: center">'.($i+1).'</td>
                <td style= "text-align: left">'.$coordenador.'</td>
                <td align = "center">'.$qtd_evento.'</td>
                </tr>';
        }
            echo '</table>';
    }
    else{
            echo '<div style= "text-align: center; font-weight: bold;"> Não há registros </div>';
        }
    ?>

</div>

</div>
