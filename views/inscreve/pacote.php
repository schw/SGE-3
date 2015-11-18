<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap;
use kartik\widgets\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscreveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Escolha um pacote';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inscreve-pacote">

    <div id="geral" style="width: 100%; text-align: center;">
        <div id="titulo" style= "float: left">
            <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
        </div>

        <div style="width: 80px; float: right; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/minhasincricoes.png'), ['/evento'], ['width' => '10']) ?>
            <?php echo Html::a('Listar Eventos', 'index.php?r=evento'); ?>
        </div>
    </div>

<?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'titulo',
            'descricao',
            'valor',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '20'], 
            'template' => '{plus}{link}','buttons' => [
                'plus' => function ($url,$model,$key) {
                                return  Html::a('<span class="glyphicon glyphicon-plus"></span>', ['inscreve/addpacote'], [
                                                'data'=>[
                                                'method' => 'POST',
                                                'params'=>['id_pacote' => $model->idpacote, 'id_evento' => $model->evento_idevento],]
                                        ]);
                },
        ],
],
     ],
 ]); ?>



</div>
