<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\CoordenadorHasEvento */

$this->title = 'Atribuir Coordenador';
$this->params['breadcrumbs'][] = ['label' => 'Coordenador Has Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordenador-has-evento-create">
	
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
                <a href=<?= Url::to(['create', 'idevento' => $evento['idevento']])?>>
                    <div class="divicone divicone-l2">
                        <?= Html::img('@web/img/addcoord.png', ['class' => 'imgicone'])?>
                        <p>Adicionar Coordenador</p>
                    </div>
                </a>
        </div>
        <h2><?= $evento['descricao']?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'arrayUsuarios' => $arrayUsuarios,
    ]) ?>
    </div>

</div>
