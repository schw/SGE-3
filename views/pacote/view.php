<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pacote */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Pacotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacote-view">

    <!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
        
        <div id="geral" class="diviconegeral">
            <div id="titulo" style= "float: left;">
                <h1>Pacote Detalhes</h1>
            </div>
        <a href=<?= Url::to(['pacote/index', 'idevento' => $model->evento_idevento])?>>
            <div class="divicone divicone-l1">
                <?= Html::img('@web/img/voltar.png', ['class' => 'imgicone'])?>
                <p class="labelicone">Voltar</p>
            </div>
        </a>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario != 3){ ?>

                <a href=<?= Url::to(['pacote/update', 'id' => $model->idpacote])?>>
                    <div class="divicone divicone-l1">
                        <?= Html::img('@web/img/editar.png', ['class' => 'imgicone'])?>
                        <p>Atualizar Pacote</p>
                    </div>
                </a>

                <div class="divicone divicone-l1">
                    <?= Html::a(Html::img('@web/img/delete.png', ['class' => 'imgicone']), ['delete', 'id' => $model->idpacote], [
                        'data' => [
                            'confirm' => 'Deseja remover o Pacote "'.$model->descricao.'" ? TODAS as informações relacionada a este Pacote serão APAGADAS.',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('Remover Pacote', ['delete', 'id' => $model->idpacote], [
                        'data' => [
                            'confirm' => 'Deseja remover o Pacote "'.$model->descricao.'" ? TODAS as informações relacionada a este Pacote serão APAGADAS.',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>

                <?php } ?>

        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario == 3){ ?>
            <div class="divicone divicone-l1">
                <?= Html::img('@web/img/ok.png', ['inscreve/addpacote'], ['class' => 'imgicone', 
                    'data'=>[
                        'method' => 'POST',
                        'params'=>['id_pacote' => $model->idpacote, 'id_evento' => $model->evento_idevento],]
                        ])?>
                <?= Html::a('Escolher Pacote', ['inscreve/addpacote'], ['data'=>[
                    'method' => 'POST',
                    'params'=>['id_pacote' => $model->idpacote, 'id_evento' => $model->evento_idevento],]
                ]);
                ?>
            </div>
        <?php } ?>

                <div class="clear"></div>
            </div>

            <h3><?= $model->evento->descricao.": ".$this->title?> </h3>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'titulo',
                'descricao',
                'valormoeda',
            ],
        ]) ?>

        <h1><?= Html::encode('Programação') ?></h1>
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'itemProgramacao.titulo',
                'itemProgramacao.descricao',
                'itemProgramacao.data',
                ['attribute' => 'Local', 'value' => 'itemProgramacao.local.descricao'],
            ],
        ]); ?>
    </div>
</div>
