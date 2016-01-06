<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Editar Item de Programação: ' . ' ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iditemProgramacao, 'url' => ['view', 'id' => $model->titulo]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="itemprogramacao-update">

	<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
    <h1><?= Html::encode($this->title) ?><input type="image" align="right" id ="icone" src="<?php ?>img/icon-voltar.png" onclick="location. href= 'http://localhost/SGE3/web/index.php?r=item-programacao%2Findex&idevento=<?php echo $model->evento_idevento; ?>'" ></h1>  
    <br></br>

    <?= $this->render('_form', [
        'model' => $model,        
        'arrayLocal' => $arrayLocal,
        'arrayPalestrante' => $arrayPalestrante,
    ]) ?>

</div>
