<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

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
        <h1><?= Html::encode($this->title) ?></h1>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2){ ?>
            <p>
                <?= Html::a('Alterar', ['update', 'id' => $model->idpacote], ['class' => 'btn btn-primary',]) ?>
                <?= Html::a('Remover', ['delete', 'id' => $model->idpacote], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Deseja remover o pacote "'.$model->descricao.'" ?',
                        'method' => 'post',
                    ],
                ]) ?>
        <?php } ?>
            
        <?= Html::a('Escolher Pacote', ['inscreve/addpacote'], [
                                                'class' => 'btn btn-primary',
                                                'data'=>[
                                                'method' => 'POST',
                                                'params'=>['id_pacote' => $model->idpacote, 'id_evento' => $model->evento_idevento],]
                                        ]);
        ?>
            <?= Html::a('Listar Pacotes', ['index', 'idevento' => $model->evento_idevento], ['class' => 'btn btn-primary',]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'idpacote',
                'titulo',
                'descricao',
                'valor',
                'status',
                'evento_idevento',
            ],
        ]) ?>

        <h1><?= Html::encode('Itens de Programação') ?></h1>
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                //'idpacote',
                'itemProgramacao.titulo',
                'itemProgramacao.descricao',
                'itemProgramacao.data',
                //'status',
                // 'evento_idevento',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
