<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-view">

    <h1><?= Html::encode($this->title) ?><input type="image" align="right" id ="icone" src="<?php ?>img/icon-voltar.png" onclick="location. href= 'http://localhost/SGE3/web/index.php?r=item-programacao%2Findex&id=<?php echo $model->evento_idevento; ?>'" ></h1>  
    <br></br>
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->iditemProgramacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->iditemProgramacao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que você quer excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'iditemProgramacao',
            'titulo',
            'descricao',
            'palestrante',
            'data',
            'hora',
            'vagas',
            'cargaHoraria',
            'detalhe',
            'notificacao',
            'local.descricao',
            'evento.descricao',
            'tipo.titulo',
        ],
    ]) ?>

</div>
