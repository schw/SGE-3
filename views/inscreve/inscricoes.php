<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscreveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Minhas Inscrições ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricoes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?php //echo Html::a('Minhas inscrições', ['inscricoes'], ['class' => 'btn btn-success']) ?>
    </p>

<?php /* alterado:

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usuario_idusuario',
            'evento_idevento',
            'credenciado',
            'pacote_idpacote',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

*/?>



<?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'idtipo', 'value' => 'tipo.titulo'],
            ['attribute' => 'evento_idevento', 'value' => 'evento.sigla'],//Substitução do idtipo pelo titulo do tipo
            //'usuario_idusuario',
            //'evento_idevento',
            //'credenciado',
            'pacote_idpacote',
            //['class' => 'yii\grid\SerialColumn'],
            //'sigla',
            //'descricao',
            //'dataIni',
            //'dataFim',
            //'horaIni',
            // 'horaFim',
            // 'vagas',
            // 'cagaHoraria',
            // 'imagem',
            // 'detalhe',
            // 'allow',
            //'responsavel',
                

            //['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view} {update} {delete}{link}'],
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Action', 'headerOptions' => ['width' => '80'], 'template' => '{view} {link}'],
        ],
    ]); ?>




</div>
