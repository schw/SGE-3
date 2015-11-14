<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InscreveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Minhas Inscrições ';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="inscreve-index">

    <div id="geral" style="width: 100%; text-align: center;">
        <div id="titulo" style= "float: left">
            <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
        </div>

        <div style="width: 80px; float: right; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/minhasincricoes.png'), ['/evento'], ['width' => '10']) ?>
            <?php echo Html::a('Listar Eventos', 'index.php?r=evento'); ?>
        </div>
    </div>


    <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
            <?php
            echo \kartik\widgets\Growl::widget([
                'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
                'showSeparator' => true,
                'delay' => 1, //This delay is how long before the message shows
                'pluginOptions' => [
                    'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
                    'showProgressbar' => true,
                    'placement' => [
                        'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                        'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                    ]
                ]
            ]);
            ?>
        <?php endforeach; ?>


<?= GridView::widget([
        'showOnEmpty' => 'true',
        'dataProvider' => $dataProvider,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'evento.descricao',
            'evento.sigla',
            ['attribute' => 'credenciado', 'value' => 
            function ($data) {
                if ($data->credenciado){
                    return 'Sim';
                }else{
                    return 'Não';
                }
            },],
            'evento.tipo.titulo',
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Ação', 'headerOptions' => ['width' => '20'], 
            'template' => '{view}{link}','buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'index.php?r=evento/view&id='.$model->evento_idevento);
                },
        ],
],
     ],
 ]); ?>



</div>
