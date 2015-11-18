<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Atualizar: ' . ' ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iditemProgramacao, 'url' => ['view', 'id' => $model->titulo]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="itemprogramacao-update">

    <h1><?= Html::encode($this->title) ?><input type="image" align="right" id ="icone" src="<?php ?>img/icon-voltar.png" onclick="location. href= 'http://localhost/SGE3/web/index.php?r=item-programacao%2Findex&idevento=<?php echo $model->evento_idevento; ?>'" ></h1>  
    <br></br>

    <?= $this->render('_form', [
        'model' => $model,
        'arrayTipo' => $arrayTipo,
        'arrayLocal' => $arrayLocal,
    ]) ?>

</div>
