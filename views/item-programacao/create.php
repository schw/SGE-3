<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Adicionar Programação';
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-create">
	
	<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
    <h1><?= Html::encode($this->title) ?><input type="image" align="right" id ="icone" src="<?php ?>img/icon-voltar.png" onclick="location. href= 'http://localhost/SGE3/web/index.php?r=item-programacao%2Findex&idevento=<?php echo $model->evento_idevento; ?>'" ></h1>  
   	<br></br>
    <p align="right">Campos marcados com * são obrigatórios</p><div></div>

    <?= $this->render('_form', [
        'model' => $model,
        'arrayTipo' => $arrayTipo,
        'arrayLocal' => $arrayLocal,
        'arrayPalestrante' => $arrayPalestrante,
    ]) ?>


</div>
