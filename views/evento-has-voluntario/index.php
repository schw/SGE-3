<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoHasVoluntarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Voluntários de '.$evento['descricao'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-has-voluntario-index">
    
    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
    <div id="page-wrapper">
        <div id="geral" class="diviconegeral">
            <div id="titulo" style= "float: left;">
                <h1>Voluntários Adicionados</h1>
            </div>
            <a href=<?= Url::to(['evento/view', 'id' => $evento['idevento']])?>>
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/voltar.png', ['class' => 'imgicone'])?>
                    <p class="labelicone">Voltar</p>
                </div>
            </a>
            <a href=<?= Url::to(['create', 'idevento' => $evento['idevento']])?>>
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/addvolun.png', ['class' => 'imgicone'])?>
                    <p>Adicionar Voluntário</p>
                </div>
            </a>
    </div>
    <h2><?= $evento['descricao']?></h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'voluntario.nome',
            'voluntario.email:email',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'', 'headerOptions' => ['width' => '40'], 'template' => '{delete}{link}'],
        ],
    ]); ?>
    </div>

</div>
